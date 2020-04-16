<?php

function like_scripts_register_styles() {
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'like-post', $plugin_url . 'css/post-like.css' );

    wp_enqueue_script( 'like-post', $plugin_url . 'js/post-like.js', array('jquery'), '1.0', 1 );
    wp_localize_script( 'like-post', 'ajax_var', array('url' => admin_url( 'admin-ajax.php' ),'nonce' => wp_create_nonce( 'ajax-nonce' )));
}
add_action( 'wp_enqueue_scripts', 'like_scripts_register_styles' );

add_action( 'wp_ajax_nopriv_post-like', 'post_like' );
add_action( 'wp_ajax_post-like', 'post_like' );
function post_like() {
	
	$nonce = $_POST['nonce'];
	
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Nope!' );
	
	if ( isset( $_POST['post_like'] ) ) {
	
		$post_id = $_POST['post_id'];
		$post_like_count = get_post_meta( $post_id, "_post_like_count", true );
		
		if ( is_user_logged_in() ) {
			global $current_user;
			$user_id = $current_user->ID;
			$meta_POSTS = get_user_meta( $user_id, "_liked_posts" );
			$meta_USERS = get_post_meta( $post_id, "_user_liked" );
			$liked_POSTS = null;
			$liked_USERS = null;
			
			if ( count( $meta_POSTS ) != 0 ) {
				$liked_POSTS = $meta_POSTS[0];
			}
			
			if ( !is_array( $liked_POSTS ) )
				$liked_POSTS = array();
				
			if ( count( $meta_USERS ) != 0 ) {
				$liked_USERS = $meta_USERS[0];
			}		

			if ( !is_array( $liked_USERS ) )
				$liked_USERS = array();
				
			$liked_POSTS['post-'.$post_id] = $post_id;
			$liked_USERS['user-'.$user_id] = $user_id;
			$user_likes = count( $liked_POSTS );
	
			if ( !AlreadyLiked( $post_id ) ) {
				update_post_meta( $post_id, "_user_liked", $liked_USERS );
				update_post_meta( $post_id, "_post_like_count", ++$post_like_count );
				if ( is_multisite() ) { // if multisite support
					update_user_option( $user_id, "_liked_posts", $liked_POSTS );
					update_user_option( $user_id, "_user_like_count", $user_likes );
				} else {
					update_user_meta( $user_id, "_liked_posts", $liked_POSTS );
					update_user_meta( $user_id, "_user_like_count", $user_likes );
				}
				echo esc_attr($post_like_count);
			} else {
				$pid_key = array_search( $post_id, $liked_POSTS );
				$uid_key = array_search( $user_id, $liked_USERS );
				unset( $liked_POSTS[$pid_key] );
				unset( $liked_USERS[$uid_key] );
				$user_likes = count( $liked_POSTS );
				update_post_meta( $post_id, "_user_liked", $liked_USERS );
				update_post_meta($post_id, "_post_like_count", --$post_like_count );
				if ( is_multisite() ) { // if multisite support
					update_user_option( $user_id, "_liked_posts", $liked_POSTS );		
					update_user_option( $user_id, "_user_like_count", $user_likes );
				} else {
					update_user_meta( $user_id, "_liked_posts", $liked_POSTS );
					update_user_meta( $user_id, "_user_like_count", $user_likes );
				}
				echo "already".$post_like_count;
			}
			
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
			$meta_IPS = get_post_meta( $post_id, "_user_IP" );
			$liked_IPS = null;
			if ( count( $meta_IPS ) != 0 ) {
				$liked_IPS = $meta_IPS[0];
			}
			if ( !is_array( $liked_IPS ) ) {
				$liked_IPS = array();
			}
			if ( !in_array( $ip, $liked_IPS ) ) {
				$liked_IPS['ip-'.$ip] = $ip;
			}
			if ( !AlreadyLiked( $post_id ) ) {
				update_post_meta( $post_id, "_user_IP", $liked_IPS );
				update_post_meta( $post_id, "_post_like_count", ++$post_like_count );
				echo esc_attr($post_like_count);
				
			} else {
				$ip_key = array_search( $ip, $liked_IPS );
				unset( $liked_IPS[$ip_key] );
				update_post_meta( $post_id, "_user_IP", $liked_IPS );
				update_post_meta( $post_id, "_post_like_count", --$post_like_count );
				echo "already".$post_like_count;
				
			}
		}
	}
	
	exit;
}

function AlreadyLiked( $post_id ) {
	
	if ( is_user_logged_in() ) {
		$user_id = get_current_user_id();
		$meta_USERS = get_post_meta( $post_id, "_user_liked" );
		$liked_USERS = "";
		if ( count( $meta_USERS ) != 0 ) {
			$liked_USERS = $meta_USERS[0];
		}
		if( !is_array( $liked_USERS ) )
			$liked_USERS = array();
		if ( in_array( get_current_user_id(), $liked_USERS ) ) {
			return true;
		}
		return false;
	} else {
	
		$meta_IPS = get_post_meta($post_id, "_user_IP");
		$ip = $_SERVER["REMOTE_ADDR"];
		$liked_IPS = "";
		if ( count( $meta_IPS ) != 0 ) {
			$liked_IPS = $meta_IPS[0];
		}
		if ( !is_array( $liked_IPS ) ) {
			$liked_IPS = array();
		}
		if ( in_array( $ip, $liked_IPS ) ) {
			return true;
		}
		return false;
	}
	
}

function getPostLikeLink( $post_id ) {
	$like_count = get_post_meta( $post_id, "_post_like_count", true ); // get post likes
	$count = ( empty( $like_count ) || $like_count == "0" ) ? '0' : $like_count;
	if ( AlreadyLiked( $post_id )) {
		$class = ' liked';
		$title = __( 'Unlike', 'ic-elements'  );
		$heart = '<i class="fa fa-heart"></i>';
	} else if ($count == 0) {
		$class = ' no-liked';
		$title = __( 'Like', 'ic-elements'  );
		$heart = '<i class="fa fa-heart-o"></i>';
	} else {
		$class = ' no-liked';
		$title = __( 'Like', 'ic-elements'  );
		$heart = '<i class="fa fa-heart"></i>';
	}
	$output = '<span class="no-ajaxy post-like'.esc_attr( $class ).'" data-post_id="'.esc_attr( $post_id ).'" title="'.esc_attr( $title ).'">'.$heart.'<span class="post-like-count">'.$count.'</span></span>';
	return $output;
}


add_action( 'show_user_profile', 'show_user_likes' );
add_action( 'edit_user_profile', 'show_user_likes' );
function show_user_likes( $user ) { ?>        
    <table class="form-table">
        <tr>
			<th><label for="user_likes"><?php _e( 'You Like:', 'ic-elements' ); ?></label></th>
			<td>
            <?php
			$user_likes = ( is_multisite() ) ? get_user_option( "_liked_posts", $user->ID ) : get_user_meta( $user->ID, "_liked_posts" );
			if ( !empty( $user_likes ) && count( $user_likes ) > 0 ) {
				$the_likes = $user_likes[0];
			} else {
				$the_likes = '';
			}
			if ( !is_array( $the_likes ) )
			$the_likes = array();
			$count = count( $the_likes ); 
			$i=0;
			if ( $count > 0 ) {
				$like_list = '';
				echo "<p>\n";
				foreach ( $the_likes as $the_like ) {
					$i++;
					$like_list .= "<a href=\"" . esc_url( get_permalink( $the_like ) ) . "\" title=\"" . esc_attr( get_the_title( $the_like ) ) . "\">" . get_the_title( $the_like ) . "</a>";
					if ($count != $i) $like_list .= " &middot; ";
					else $like_list .= "</p>\n";
				}
				echo wp_kses_post($like_list);
			} else {
				echo "<p>" . _e( 'You don\'t like anything yet.', 'ic-elements' ) . "</p>\n";
			} ?>
            </td>
		</tr>
    </table>
<?php }

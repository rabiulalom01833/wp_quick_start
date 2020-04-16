jQuery(document).ready(function ($){ 

	$(document).on('click', '.post-like', function(e){
		
		e.preventDefault();
		$heart = $(this);
		post_id = $heart.data('post_id');
		$heart.find('.fa-heart-o, .fa-heart').addClass('heart-pulse');
		
		$.ajax({
			type: "post",
			url: ajax_var.url,
			data: 'action=post-like&nonce='+ajax_var.nonce+'&post_like=&post_id='+post_id,
			success: function(count) {
				if( count.indexOf( 'already' ) !== -1 ) {
					var lecount = count.replace('already','');
					var heartClass = 'no-liked';
					$heart.prop('title', 'Like');
					$heart.removeClass('liked');
					if (lecount == 0) {
						var lecount = '0';
						$heart.html('<i class="fa fa-heart-o"></i><span class="post-like-count">'+lecount+'</span>');
					} else {
						$heart.html('<i class="fa fa-heart"></i><span class="post-like-count">'+lecount+'</span>');
					}
				} else {
					var heartClass = 'liked';
					$heart.prop('title', 'Unlike');
					$heart.addClass('liked');
					$heart.html('<i class="fa fa-heart"><i class="icon-to-x"></i></i><span class="post-like-count">'+count+'</span>');
				}
				$heart.removeClass('liked no-liked').addClass(heartClass)
				$heart.children('.like i').removeClass('heart-pulse');
			}
		});
		
		return false;
	})
	
})

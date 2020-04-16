<?php

ob_start();

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wpquickstart' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'x{#=<zad|?g>L6 _Y4R(4hqr9lD5DhPzyI4]l][Zm}6`cs1BhO!.U0_%mM(SF}i=' );
define( 'SECURE_AUTH_KEY',  'AA26@a+/R}]UTkwLvvekPHmOFx)iJBgx`p-pfnRs8*.~bYZcZO.0CV<jNH ~l3Iw' );
define( 'LOGGED_IN_KEY',    '7!Km$13DIAB~Gv^H;G+o8Z$1*hG~1ygEb><iE;5g?l(Ch-PQ9+g tW}T1LB|L*f[' );
define( 'NONCE_KEY',        'a(S*^%%^zRzoR<OG00=vRy<o NH*,A4wRX9EFDzLyOXvG|6f%Db9J<b[&YdZDn@a' );
define( 'AUTH_SALT',        'k#C7lPbX<1jD-WpFE&hiEwy,Wk,DH+F@bLs<g2MMVv=hAp+;g<9Q6d{d4Xs/P,2Q' );
define( 'SECURE_AUTH_SALT', 'Ya`[tkhf2@d3aR%Tm5Y(1u0Gow)~hMA 8[5P,X`:E9_gM{nB`dTJOMLYke>Q,d[_' );
define( 'LOGGED_IN_SALT',   '6B;?U:n?t2VPP<KNt+]Yg-g:8t``P3y7`%Hy bRy_}4AM#A?}iM4YzZO;y7Gif0A' );
define( 'NONCE_SALT',       '_!qTd?N.@UZ6}1)-k&)+,ht+_.7 2k%Tc-R4v/YOe[5jl%Ek9gXQ!$rCa$IAbzWj' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpquick_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

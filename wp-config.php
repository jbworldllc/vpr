<?php
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
define( 'DB_NAME', 'vpr' );

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
define( 'AUTH_KEY',         '`C!js;H*$X(^+y|X)EnQ6}kafR&7_8IdOhU,t hFLJG9V h<~7-GJyp*_4hjtunj' );
define( 'SECURE_AUTH_KEY',  '?JbhpLCoKyn]29pQ@_`C<-#~pQe{ap5|te`e%G[)(=y}xuQ9(dJ5U/$_EwnRpXTa' );
define( 'LOGGED_IN_KEY',    '.*e-S4Q%EpJ<Zf.%]A.U$ll aFe,1$_r$T@JW)A>#l!Bmr?F)kBYLfc^Z]yL Wlf' );
define( 'NONCE_KEY',        's31Uq $SO~T9RZJeb#:nJ1A:[Z!zrNo#51>y h?,5Hu~gUQU/TnT5qBlJ}.W~EPS' );
define( 'AUTH_SALT',        ')N{`%j31-{l4aL|OyQxx7PT5gUldF{vVx~ ,E#uN3^BL$&D[Q6wAl{7NlTS&>gq6' );
define( 'SECURE_AUTH_SALT', '0rS,MGHO[^Xx&Z*d.3S,VKHu81eBOmF%KDCKxJ-Kx%Tmu=OFrfY)]_c9;$s!3=<y' );
define( 'LOGGED_IN_SALT',   '~<s;L}C3 8xr|dYf(1K&NOB*wqWP$RgC74fJbhFzP$@mSZfEEeFsj:lqKw)ba{>P' );
define( 'NONCE_SALT',       '}E5BJH;o?I&/w2KlU-yeV+){s@}aF>BBH/KaUQu|8C3 hf#5w7aV& }i6`a!Y[_K' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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

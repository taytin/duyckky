<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'homeducky' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '-b,Mo~34kY@.tFg];-YzCs $*r+<@p_2a}xDn>qr^Cr0mCc;wdDZl<8`6T*+J~1P' );
define( 'SECURE_AUTH_KEY',  'gm$!tZN~@;+Ts{nBt!d7;G*sdl,`z@[}*ZMWVq~3Kx~[fEjVSU$0<(g#1i(X`pi-' );
define( 'LOGGED_IN_KEY',    ')61u/Gj~+lH9!1o&_~Cw-)~MR>-Ny[+;>B32m$sCFgW{?$hJ%b&< gMtK8s%cVTf' );
define( 'NONCE_KEY',        ':;#WC%|X#S3wVtj&rj9#svHesddc:1>jss6bw#{n[}$>ksj%a)2B-$K96z&3/W[L' );
define( 'AUTH_SALT',        '5v2q{8oKF))A:|PY>c>sccPN:LJgF3OfXLQd$CV~%/lw 9&`.m*P<ymZDxd5MjR.' );
define( 'SECURE_AUTH_SALT', '_AW;oXQW_Y1LM]K%-eFR[Dp w>LiZ?3Dk~^A-g6()jJl_#1xX22D[EFnA9WK}gSw' );
define( 'LOGGED_IN_SALT',   'Q(EpK5ubV$X^eyfG@UQ4@p#$MssA[x8&uI[)l(J~A;:@(gjyCLV&7&E|YT@DC]6F' );
define( 'NONCE_SALT',       '3B@JbQE4dG2dKj7,nT0=naY$#:q%<i35kb*e)K_Z)I/.l3l!HBCr`~9b&c`A!jGZ' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

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
define( 'DB_NAME', 'coder' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'YvLQW1Y_O,%sW=OJ,EY4vYBQ8K.a)OUDuAk`f`jze$K><g!,M)91<v&<cV*AQrG6' );
define( 'SECURE_AUTH_KEY',  'ApJTjv(xioqnFzv[Fbo9!C;([$9Q{E(}X3s->0?vk=zkL`oxl8;y0`1_?wn[Z9c=' );
define( 'LOGGED_IN_KEY',    'dapEyfOEn%[q(Ls=&uviPC#.]<y|4!4;Z7Hee&{<ehxF1C4AVc}=Q1}$h>YwM=U6' );
define( 'NONCE_KEY',        '~[%GHX*kSe!gn|vlKq.^kUgR+XlX~P1y;Z$5F.iyvHg,oRT@h2&YE22TeRmSQCuS' );
define( 'AUTH_SALT',        'uYX0vLieHI0^ZOCmSg%RpJd}@FOUoHvVf^WwS~{vDshi^hOQ969H.nFUTTC(ErtY' );
define( 'SECURE_AUTH_SALT', '.ASH$=UL$6iw7[>Wbm&6NfpeGWD3.?}31Rc%(/S@bx|?_i8B#zeD!2qn^.+cQEhD' );
define( 'LOGGED_IN_SALT',   's)YD1(#/]&UMMOO;vG^bDp6T-bA6b1PVtQwMA4^_wx2$deh20.ISkX6h{EpzEu-8' );
define( 'NONCE_SALT',       '!Yk8t7xrSXNG#nT#`=zx~*7ACfb1&[]qO`*TF-J7i2Y-p<#xZa+|8lSP@&/GUj-P' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'cs_';

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

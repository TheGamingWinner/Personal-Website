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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'personal_web' );

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
define( 'AUTH_KEY',         's)a[5-G NS#6v}, u32;3L(@j(*KmdI[S9&WS4PCa6MNCK:_nI8s6A*DERNP[6N6' );
define( 'SECURE_AUTH_KEY',  '.`1HfyeF7XN)>jI-.T;D1^_ tLcR2#-Q(t;45{Hc2 zJs3%3]1_+#> cUd*Q>+[R' );
define( 'LOGGED_IN_KEY',    ')SL.+P%mgR-tsp)!+P>nGCTwW8RChE7NpJh_BEDJ`phz8)QjrI(=%1hu$~8sU>(T' );
define( 'NONCE_KEY',        '_`I 6m[u{WN~+d xNVOw;b;<W-yr^W@bU}c~pWR`$hF1=EQS!:R+(AT[Up7WOF6p' );
define( 'AUTH_SALT',        'A,UvW5<MHYPvRmo>~U8X:X_A1efn{d@8MA)SZ$nHIes);skhBR@Qx`<4DTS4ml$M' );
define( 'SECURE_AUTH_SALT', 'Rrp~/H%B3#{^j}/P$[>$&_gR%`RJ5HoU@dU/={]%%CW*m9u[2*5mL|fbs*G b;Ga' );
define( 'LOGGED_IN_SALT',   'JHu6r_1I$VI@!R`;L#v&f#3T3[G)P&,<NREq_B9@cHr>kgI$gKVYTY0olU372u+/' );
define( 'NONCE_SALT',       'qi+L2J>u&$kY_-$0U982>H/.c6SK5}+0[dTWd(J!rQf=cI;[*?T5a,+F3FRZxPYQ' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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

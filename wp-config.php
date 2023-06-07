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
define( 'DB_NAME', 'wpdatabase' );

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
define( 'AUTH_KEY',         's&$|~cPZrvX)9s*8ovsGh~3AhqUJNkf(|uq4A3^1X7L~u@Pg7%@mj!^{^.$%$FpO' );
define( 'SECURE_AUTH_KEY',  '+={w30=I?-mXh@;p)q?p}`/s^|Pyc&cF <9ATOx#|r.zuZ_Hxwp=*;1AJNRh^.33' );
define( 'LOGGED_IN_KEY',    'Pd=fFx$|#3m+HO+Qy?wn+V/8 KT=kBpFPdGdT>([LM l>s^dg&>w1m)#S[m@y$UX' );
define( 'NONCE_KEY',        '+^BBY0p 93SdeX|@3{fLmxmmGPsp@NN&jR,M9298d5.U9F@Rfyyh{;Pm%PK`q*Q8' );
define( 'AUTH_SALT',        'K6W@}/nK90nw;e1C8zv/zPsTK#&Z&$jflBEpG[cNp91H!t{Jzu/z%uWSs:W8Skx;' );
define( 'SECURE_AUTH_SALT', 'e7qHlaD/-wL28|fc6@+ CmB[H@qFMV?a_QNhF.fcR-Rkj(U[sGlk(R)8KGixqd#R' );
define( 'LOGGED_IN_SALT',   '/2C=KW;gAQ2m@ds]K-{:$n+CYPk.bkgr:&nUpBKhU,d1ABx)D!?yB8}zg^y%F}|*' );
define( 'NONCE_SALT',       '46.6rDkkm==0A+=:.XhaS12}sRmj>bux|* }iVNtn ,[P?RS7`vAX^O<)`j_$$K7' );

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

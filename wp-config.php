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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'verdecinematography');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '?c+YXQ$Ie&pE[$^Af1rFxQhvcr0Bs^FgDUuhLIK>#A7?Fcp?|#s^~3_;6Jtn+I7-');
define('SECURE_AUTH_KEY',  'Ns?f7Rl}acs6ts}f)CpUgW8#A6?{ v&zTM6W`GAiS!QZd+L|Pi`R#DSt<K!Z]]t_');
define('LOGGED_IN_KEY',    '+$W~_.ZZJ+O0ER}6,x1.x(=-)],a}G-k;OF$9QLX>qwPf~.c7?u`N`PpK#:f*ldz');
define('NONCE_KEY',        '7uO8DhYW8>:`,m de1zacp8!~.(#h*Fv}8@lmCikRMspHIWR1)veQzFhe9]+{FRC');
define('AUTH_SALT',        '3?.LKyY^!4GI3BF({^#yM>b=tt;:MeQb5aZhVw%RbNl >]lXY6jh2G.r`9dSnXI~');
define('SECURE_AUTH_SALT', 'b-#&MXFa>YRl7hq4LAa0yEeojXetMAt<6bl2YOh?ITT#6V:h-ClL?U$:MjVL,-<<');
define('LOGGED_IN_SALT',   'U(PT3/Btz.?$ H(%@|&Gj#h100D4&q),$N@u:*djM$84q/$#Whv.i6D`-j[&op]p');
define('NONCE_SALT',       '%i|}_Bcspb nE^b>@qs3Z9n&9?HqpHxrFMYvin:xfG Eh .EMf69u*PmXEc<W.<)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'torontomagic');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '$[;~&)-EZglhWG5yQ*yQNX- f -UGB&Hh~>Qx;K*mN8PQ ti*2Y-vpM=.=|S{H-5');
define('SECURE_AUTH_KEY',  'sU3Jz3QS`Q_]$^-GfVfIPPz(WdryD@Oipw<;jMtEOm-7<4G&+I3^DB;hycbJV2)1');
define('LOGGED_IN_KEY',    ';yYL+^@FKOx^R,oV`J7f2&G)+!;`%O4&}Vd-24*/A%@k~w[NoN1Y?wWOxKo4Muj^');
define('NONCE_KEY',        'm1C.Esy[V CD1q9(TpVwyonXod5*XZf|-T-16eW4!8to)fi?9xH)9ga53*J|k=!c');
define('AUTH_SALT',        '8zCRCKe;<ML3z]|F8k|M6Z`#e_)R39E<-=1!+HQ<yq8R-~l8SH$41cEj ;h=vZ,2');
define('SECURE_AUTH_SALT', ']aHwD7u]rw@OZz9#nv2pk-c79@/!U&~ifZcewV)s*JsFI:#Id6F0uISo3Eeh-!X+');
define('LOGGED_IN_SALT',   'jpNk30~yxfnXY-~@ULv=qCHR}N!3-s(28{Id,nS+l5|bpeo6@2t,:<AoH]P==4PD');
define('NONCE_SALT',       '+0PqKMG-QAWZ:(-WY~1@lEd4r|>iYiZ~)GK1_#[)}O7Wd+x0vyg<xdSBv56DB5Y7');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'holidayhelper');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'nPTP6m7JjNXCAeWhs_7,=BqdhYP:0TE4esE5)~R?y HX+HDmZm3x&JzC.2%1-Z)}');
define('SECURE_AUTH_KEY',  '*/M,g^_}EAc|dJ @Iz4MAiC=`Cz]j+eyotm+B~k-2H@|UJwx_(4%@n}lGqzmzjA`');
define('LOGGED_IN_KEY',    '12I&n=J+,|Kc$4F57w$/)ZjK2pwl),VUc+G!94,|?99 &/~7>BAY+iPcqiB5mRo/');
define('NONCE_KEY',        'R7?~I25i^7(2WMH}Cl^XxBniwF#B;5~dPuY9f0nV/_8!~z=cm[_ur+vg,~[y?-%=');
define('AUTH_SALT',        'GE([{%,G90Vgv^8Q+DhsxQuwRu2z*XU1Y %{?CtI0TlV|i%Ao_n@H=HdaxiTV+w3');
define('SECURE_AUTH_SALT', '7>,__+`eiQn}8oBU-r-~|^ru=st]VZ)3Jf7j<geaC<sotb>XyK*-eN.vNn8)S&6E');
define('LOGGED_IN_SALT',   '2<9@shn_.T|G(eLlFYu+mgrP1<FE +Mqd ?-r6-@t&,/IQ|cdYW8e(Brb5??u>:r');
define('NONCE_SALT',       ',<gG*D;ld] ^v qD3k|X7L]Rf1x^g*k<J/u)a(Ns$XNXT<7+74JwY6:GgiwV+$r|');

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

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
define('DB_NAME', 'colorikwp');

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
define('AUTH_KEY',         ')yYyjMBxdY5fC1L<d1oyAT,2fV<m|!UH+l7 V4a=Jy4MBCrY sY{FXhc0~/+PU4o');
define('SECURE_AUTH_KEY',  'mDw?$pf+F_=Es=ny=A<HLia!,pWo(],HfVe RtLd%1[{J`3>^,`4twgO/wF}FoS1');
define('LOGGED_IN_KEY',    'y3tl%Hd5E aRMUgt~etSC63(|tyt;Kv1muLPvv&y0M!Cq/$T4qqw%7;2-k{tV6D+');
define('NONCE_KEY',        'knJ?_G8V`}!8qLj7-XHXxQwrd2gyB5U4s<523m*iM+vYhR4(8dTXY!5{>9ef{bl?');
define('AUTH_SALT',        'v)#q8cpq(]Al%]0enR 7~mV2)k1i-6Bcg<_)t$USxXgbnp}Tx6(mKjLsGK-aAfP3');
define('SECURE_AUTH_SALT', 'g&$Lb^/532.vR</xe8`5yrF5e*{n1,&nD|do-d|)SD)/V)jcnd:7Y5G JWxwdJVk');
define('LOGGED_IN_SALT',   'ip<Qw=r4^ X*:C^j1U>l0aC!emWv:IbUOsU0/46[xvE7<xnTFU3UdnUyeX6d]N,j');
define('NONCE_SALT',       '5_<N]o_Nl+bb&Q#/PjFZ%MD))0sq3kywD;.Ly@,zkp0bD#hNR?=9*xw8)}6UtFZa');

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

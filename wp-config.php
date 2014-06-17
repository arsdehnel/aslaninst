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

// Define Environments - may be a string or array of options for an environment
$environments = array(
	'.local'    	  => 'dev',
	'.arsdehnel.net'  => 'test'
);

// Get Server name
$server_name = $_SERVER['SERVER_NAME'];

//assign the environments
foreach($environments AS $url_partial => $env){
	if(stristr($server_name, $url_partial)){
		define('ENVIRONMENT', $env);
		break;
	}
}

define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-content');

// If no environment is set default to production
if(!defined('ENVIRONMENT')) define('ENVIRONMENT', 'prod');

switch(ENVIRONMENT){

	case 'dev':

		define('WP_PLUGIN_URL', 'http://aslaninst.local/wp-content/plugins');
		define('WP_CONTENT_URL', 'http://aslaninst.local/wp-content');

		define('DB_NAME', 'aslaninstorg');
		define('DB_USER', 'aslaninstorg');
		define('DB_PASSWORD', 't3ZsxVmg');
		define('DB_HOST', 'localhost');
		define('WP_DEBUG', true);

		break;

	case 'test':

		define('WP_PLUGIN_URL', 'http://aslaninst.arsdehnel.net/wp-content/plugins');

		define('DB_NAME', 'aslaninstorg');
		define('DB_USER', 'aslaninstorg');
		define('DB_PASSWORD', '1pFrRooZ');
		define('DB_HOST', 'localhost');
		define('WP_DEBUG', false);

		break;

}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '2-;{op`eM[1d`*n(96,+!4n|0#j?ww&e,=![+A+3+h28qVzUCW;0Dns^+V:6^Zeu');
define('SECURE_AUTH_KEY',  '-#t,hSi)@(9d5(dmNILdb[{G6,{B[[tf)H-`STQj!hkCz*gmvn,fSU]gvd1NY8fV');
define('LOGGED_IN_KEY',    'I/<>c/iMM-k{[zDj(:VZPsvS7C4t88b-R=i9Wdj||@y})21$5uVtlzkf<+7x3-sc');
define('NONCE_KEY',        '.]O%)4y8]*FcT8Vj)&sq`A$eN^xn%|wUy?3+ %Y2M6~9&}vKBo,I^e3uuO,M]|FY');
define('AUTH_SALT',        'Kp0j2fY)$M:p+6.dj2 VIP;aWv@FS_|?c@fB]z$p5FBTY]ceC04/Cc;Uz57!-@76');
define('SECURE_AUTH_SALT', 'm^;m:kO;m$5/{z{<1 /i1Et8YCYmEfvA88KPu$ezy-q}|iTe-KB?Czcn#dJ:#&Y[');
define('LOGGED_IN_SALT',   ',]s3t@c@5k~UH!Bjr`y70[/qmi2xgeB=m;3maMh@MtM~x4uYhh-uV:HAlMGHKTr.');
define('NONCE_SALT',       'X!hyte}5Vv=e|Hfq!MaozQ*[]OzV0O#`ThP0x-+o`{l-e]oU|`+0{U[lLxxeZ]qS');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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

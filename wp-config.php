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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'system');

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
define('AUTH_KEY',         'w{T3PSo;CfUa$cE|$;BbSq?f);@NAD7kg<k3aD*F7{Ei^yq^_n$>Ov;ziQF8ANS-');
define('SECURE_AUTH_KEY',  '!~c!q !NTf$doq-ai7PJi.!s@|3GM#T?x7&2llnlf`!fQT3lYF]}fuo9+c*mJ|+A');
define('LOGGED_IN_KEY',    ')?dDlp@*35~,K2Xn39-r:T/6vIxFn-L:~?J!$W$V{{nlF3B<^3.raQW}MnkY<BW<');
define('NONCE_KEY',        'nFE-Q)D_EiC|HV#h0&lxB:5om.cVw;e;$w5[PA;pM;bHq?%)>[U^Ua5d T&}EA_i');
define('AUTH_SALT',        'rn-QPG^x.#GC[wC`?LngCQ<PuzH}G`n)Khqe~Ezvx1A!>?<:ZyiA3GPgxIxyT7Ff');
define('SECURE_AUTH_SALT', ':&v8IkWDwIBF!&p^Q %:@lub4!]unK}wL.lLde%4cqU}ij6U3<y>hk39o31`xxkS');
define('LOGGED_IN_SALT',   'Y]!xFXW8M]&}v0`OgU#08l,^GzM[b<>i;dGUB2Te+wze:Ul!w~a#pqx?~cxlQkUK');
define('NONCE_SALT',       '7m{*e{T;o/?Q7XD#)fuJ>|S|V_v2l+:B:L*/[Oa?y+:fU*0x*J2B!=!^};4g-r+Z');

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

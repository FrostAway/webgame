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
define('DB_NAME', 'webgame_db');

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
define('AUTH_KEY',         'xcoOz5sow9t0&]n9<g%9;GK``n3yynAC(1GCIA#Cz^)/{3K]%*|:fdV#&NU}/~DL');
define('SECURE_AUTH_KEY',  '9sT}I`^{37A/_.9.E`S?s0RuT[8j^}JxeH^-~mdxfXMk+Hn.TL4,pRGEu5]*Hr5e');
define('LOGGED_IN_KEY',    'UR$:NssI<H5D=6x@0{G_o/]4Ia2+q23?L^jFvs~[.xqw)Lrb+R+,(gMkM$>,HQ7%');
define('NONCE_KEY',        '>n2YiTYE$u+w3#=}_0UfJbhvrCH>}PQ+oO]9y&H]&+>D&8sweI-f>RCI1-N-UI:|');
define('AUTH_SALT',        '1Z`HZJsgJXZ(*b+F_?f7=0a.FX;$VEP;|r=7w6|I;T!#Tz}Eu$7{{+-_ og!EFv%');
define('SECURE_AUTH_SALT', 'Q--VC >z:#)U]=|c%f-1 ntf!OfYOwXNwI4~{bRG.)6-U9QWQAj2]j@`QM,,.cP!');
define('LOGGED_IN_SALT',   '}u+~nG}i(G<WZ~N-^#V-;Mj$(%;P|uN`Zj*?yUXS/7P8RJu2kl]/}t)-k]xs(.m]');
define('NONCE_SALT',       'l:c(?~is-/d*gWXs|itPw/>-)7R2@of!(r%|Q|$CLK|Y82K%>)x!ypc+z6T!7dV^');

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

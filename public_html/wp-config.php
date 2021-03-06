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

// define('WP_HOME','https://www.communitec.co/');
// define('WP_SITEURL','https://www.communitec.co/');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'communiteccoav');

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
define('AUTH_KEY',         'uHSJLPtTql5vXAWWmlPn6IBQLO0kb5amQuyyb0zdHKKSheUtFXDiNChK2bgmhVgq');
define('SECURE_AUTH_KEY',  'z3o1YGuPLpxrF2l8QnncWcRIChujOR98RKjCq1F2iK9UzygyhpEuqqDDnOho1dhq');
define('LOGGED_IN_KEY',    '0x8kIYamPve9QntpeVtlui7j2z4Ka4KDLtK8anqMCSimCWTKtBHzSvAKaIwiSLiZ');
define('NONCE_KEY',        'KR1k7vs90d6poPD6b697qXRwax81mx8owpU9o3gbvuh6QHbVY4lTuJ1fzOadSgV3');
define('AUTH_SALT',        'BKzSL7TVxQ0GZK2n1lYFXLNxVXFVACEY6BHSBaALLtnYVxN62707zjQeyVieEK2j');
define('SECURE_AUTH_SALT', 'woh943ZSE7pWiUUfonOFtk6Wwkwtwz1P1GHbEewjQDzWxXA1AWbvVfMEYyy084Dx');
define('LOGGED_IN_SALT',   'YP64CGL4IehlLk05r3ymvthwzO1w1EyG3E7w6aqIPzSj4c1sa3sli18q5oGCMK7i');
define('NONCE_SALT',       'CfACDVlxm0nRIpRkFTb5bZNwiFSYnVUqgFdNPbGMme8NL6MiqDhv2ER6IXgfMoU0');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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

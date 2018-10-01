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
define('DB_NAME', 'u0359072_wp437');

/** MySQL database username */
define('DB_USER', 'u0359072_wp437');

/** MySQL database password */
define('DB_PASSWORD', '@1v54I5pS]');

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
define('AUTH_KEY',         'ilrndhlznriekqiwjodhckgiwlmk5s6yeiya7jag0pmigr9v8mdkftuggpazkaii');
define('SECURE_AUTH_KEY',  '8khnwd9siya7xscobg1ukvn6srv9mgbiw2i8k06hiz8xwreqy0xso2wkxgdyry5s');
define('LOGGED_IN_KEY',    '9homohlggsk2u9vdp8smictvdizc5eyh1qbpkrvvb00bwm5zu9qmemd97naqlz4w');
define('NONCE_KEY',        'ocz8plr1rypfnc8wx3hzqb3eum7xkqcgmcwssm3o2fq9hn9eyhjvuet6nvpoimoh');
define('AUTH_SALT',        'uhlt8isshlzdoeunj5arhxwq3laaccl3g5mwkjy8aftgdkelaaxgvhqvdqjxekfo');
define('SECURE_AUTH_SALT', 'gqoxvhfnclg3azrz82luxf6lel6v8cn8n2ykxd7cmnpuhiwljsvryjy7zfc9zkab');
define('LOGGED_IN_SALT',   'cc9vbawf8b6vkzojrk7kengequbeajlrfi7ya0i5lj6vhk4frproq0yqbvj9bguz');
define('NONCE_SALT',       'mzme1cwuik3ea3pty6dnx7dvelmoww0lbus7wccj6uyoxmulxkgfcmpyk16qbrqq');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp9v_';

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

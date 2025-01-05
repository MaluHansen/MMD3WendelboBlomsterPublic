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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'OD{5Mz<,0UDGq1%vt&(igENW*V5]7>-E5Cl/YX!pr]>%4Nnf}PU`7eH7b;6J~5-V' );
define( 'SECURE_AUTH_KEY',   'Hfxb 4C[g$x4fM)bDqTNfA2X&$7lQOPhk`#44gla1K&/#0)6O!a9#kPZ_ kaF&E7' );
define( 'LOGGED_IN_KEY',     'l:@2kSdFsytu2.gG:Gd30^o}8Wl!ZM^7>eR}1&MTOFz)rXq+Gsb^C8A?zyVzg<Q+' );
define( 'NONCE_KEY',         '_fanv@0KMR#>b~<_&?D{QbdfG#xkX9A{I,Td;OW5)@])697K9*oVR(n@$}e>7`#m' );
define( 'AUTH_SALT',         'x0Q+L#n@mP7X5M!URzteKwWEiUbS7zd0/1`W;GMzp~ /Z^)>>PZyVF37v536;7d=' );
define( 'SECURE_AUTH_SALT',  'thg%c$=nV?1O)jZ^4p0?ocYoo$$!z_C 0d$1cx.-V/FGG~0/R2@n.YmfG6/.HF@B' );
define( 'LOGGED_IN_SALT',    '4JYOlU(g|f0^{tFa J/l{57y}3xkFvl]/V80EZ9 @^7Xi6s<=7@fS^=jyRwzfzW.' );
define( 'NONCE_SALT',        '>zea<e@-6dDd{l-z s }Y4=_z(RaI:#my0`d/V@AjI[I-j]Vc$GTe8x! pcEF41n' );
define( 'WP_CACHE_KEY_SALT', 'u5$N*I =T3y1:h_wK;bCgP:h6TT--9E1<D~&9s(LO{y|1rIi$i|#0kRG?8<%:o(w' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

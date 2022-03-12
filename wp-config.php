<?php
define( 'WP_CACHE', false /* Modified by NitroPack */ );

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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ialvideo_ial' );

/** MySQL database username */
define( 'DB_USER', 'ialvideo_ial' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ialvideo_ial' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'KXz91p(z+6dG0% oD5n+gsev~9F&/Re+n)#D)gMF wuUwl@Rb$Wj<bfM:ZN`5J3*');
define('SECURE_AUTH_KEY',  '+vD:)[6e0</(/~-Sitq<P!] J-W5qH;ZY+OvpTu/(Q(so@LN)+u$S%@V,`n+R@bJ');
define('LOGGED_IN_KEY',    'zFB34o/1RP _91%o|5{r} Br2L6La6@? 74L$6hFz%VV{j(XJF:xvS&CY==gr`aS');
define('NONCE_KEY',        's;U7mwf_=p-E]J9.|uGC/=.|rTme>x:x73L@_t=jkMpyykc(M; gWOam)`egJbd9');
define('AUTH_SALT',        'Y;.G+t,mx=<KD/MC:nC+nK(VH;P2a/BFgXthli_joO%0:.xT7wg{oH^c`MZniN$D');
define('SECURE_AUTH_SALT', 'd%g%~h]{<R)|k1l:[dHFS8uh4CkH/=U}JimPJZxGO1h0^5^,X+Eyr:QEr=AAu; {');
define('LOGGED_IN_SALT',   'C:b(C2nU:{U)^{?|>P5$nI1-dLw/9)uOnKlh_HTWH;Sj@7s=3$LyAqa^}ru,I3-4');
define('NONCE_SALT',       '5D-R.5@)-(1SUU-T^AdK7rU9,aP>@L?|e+X+/nE-:78rEn(PTDUBV+;aZ,fTI)B<');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_ial';

define( 'AS3CF_SETTINGS', serialize( array(
    'provider' => 'aws',
    'access-key-id' => 'AKIA6PDVUTYIRE5M4CPB',
    'secret-access-key' => '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',
) ) );

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

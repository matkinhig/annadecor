<?php
/**
 * functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 */

/**
 * Define variables
 */

defined( 'XTOCKY_THEME_DIR' )        or   define( 'XTOCKY_THEME_DIR',          trailingslashit( get_template_directory() ) );
defined( 'XTOCKY_THEME_URI' )        or   define( 'XTOCKY_THEME_URI',          trailingslashit(get_template_directory_uri()) );
defined( 'XTOCKY_INC_DIR' )          or   define( 'XTOCKY_INC_DIR',            trailingslashit(XTOCKY_THEME_DIR . 'inc' ));
defined( 'XTOCKY_INC_URI' )          or   define( 'XTOCKY_INC_URI',            XTOCKY_THEME_URI  . 'inc/admin/theme/assets/' );
defined( 'XTOCKY_JS' )               or   define( 'XTOCKY_JS',                 XTOCKY_THEME_URI  . 'assets/js' );
defined( 'XTOCKY_CSS' )              or   define( 'XTOCKY_CSS',                XTOCKY_THEME_URI . 'assets/css' );
defined( 'XTOCKY_IMAGE' )            or   define( 'XTOCKY_IMAGE',              XTOCKY_THEME_URI . 'assets/images' );
defined( 'XTOCKY_PLUGIN' )           or   define( 'XTOCKY_PLUGIN',             XTOCKY_THEME_URI . 'assets/plugin' );
defined( 'XTOCKY_OPTIONS_PRESET' )   or   define( 'XTOCKY_OPTIONS_PRESET',     XTOCKY_INC_DIR . 'presets' );
defined( 'XTOCKY_THEME_VERSION' )    or   define( 'XTOCKY_THEME_VERSION',      wp_get_theme()->get('Version') );

defined( 'XTOCKY_THEME_SLUG' )       or   define( 'XTOCKY_THEME_SLUG',         'xtocky' );

if (!function_exists('xtocky_inc_library')) {
    function xtocky_inc_library(){
        require_once(XTOCKY_INC_DIR . 'admin/image-resize.php');
        require_once(XTOCKY_INC_DIR . 'admin/mega-menu.php');
        require_once(XTOCKY_INC_DIR . 'admin/importer/init.php');
        require_once(XTOCKY_INC_DIR . 'admin/theme-options.php');
        require_once(XTOCKY_INC_DIR . 'conditional.php');
        require_once(XTOCKY_INC_DIR . 'theme-setup.php');
        require_once(XTOCKY_INC_DIR . 'admin-enqueue.php');
        require_once(XTOCKY_INC_DIR . 'layout/pre-loader.php');
        require_once(XTOCKY_INC_DIR . 'layout/wmpl-switcher.php');
        require_once(XTOCKY_INC_DIR . 'layout/breadcrumbs.php');
        require_once(XTOCKY_INC_DIR . 'layout/login-ajax.php');
        require_once(XTOCKY_INC_DIR . 'layout/coming-soon-page.php');
        
        require_once(XTOCKY_INC_DIR . 'configure/header-configure.php');
        require_once(XTOCKY_INC_DIR . 'configure/blog-configure.php');
        require_once(XTOCKY_INC_DIR . 'configure/ajax.php');
        require_once(XTOCKY_INC_DIR . 'configure/template-tags.php');
        require_once(XTOCKY_INC_DIR . 'configure/sidebar-configure.php');
        if(function_exists( 'WC' )){
            require_once(XTOCKY_INC_DIR . 'woocommerce/brands.php');
            require_once(XTOCKY_INC_DIR . 'woocommerce/function.php');
            require_once(XTOCKY_INC_DIR . 'woocommerce/hooks.php');
            require_once(XTOCKY_INC_DIR . 'woocommerce/vendor/init.php');
        }               
        require_once(XTOCKY_INC_DIR . 'theme-functions.php');
        require_once(XTOCKY_INC_DIR . 'theme-filter.php');
        require_once(XTOCKY_INC_DIR . 'register-sidebar.php');
        require_once(XTOCKY_INC_DIR . 'global-localize.php');
        require_once(XTOCKY_INC_DIR . 'customizer.php');
        require_once(XTOCKY_INC_DIR . 'frontend-enqueue.php'); 
        require_once(XTOCKY_INC_DIR . 'visual-composer/init.php');
    }
    xtocky_inc_library();
    
}
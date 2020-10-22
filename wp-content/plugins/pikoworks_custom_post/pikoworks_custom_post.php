<?php

if (!defined('ABSPATH')){
    exit; // if disable direct access
}
/*
 * Plugin Name: Pikoworks Custom Post
 * Plugin URI: 
 * Description: Xtocky WooCommerce theme functions add new Custom post type, shortcodes .
 * Author: Themepiko
 * Text Domain: pikoworks_custom_post
 * Domain Path: /languages
 * Version: 1.1
 * Author URI: http://www.themepiko.com/
 */


define('PIKOWORKS_CUSTOM_POST_BASE_URL', trailingslashit(plugins_url('pikoworks_custom_post')));
define('PIKOWORKS_CUSTOM_POST_DIR_PATH', plugin_dir_path(__FILE__));

define('PIKOWORKS_CUSTOM_POST_LIBS', PIKOWORKS_CUSTOM_POST_DIR_PATH . '/libs/');
define('PIKOWORKS_CUSTOM_POST_CORE', PIKOWORKS_CUSTOM_POST_DIR_PATH .'/core/');
define('PIKOWORKS_CUSTOM_POST_ASSETS', PIKOWORKS_CUSTOM_POST_BASE_URL . 'assets/');
/**
 * Load plugin textdomain
 */

if(!function_exists('pikoworks_custom_post_load_textdomain')){
	function pikoworks_custom_post_load_textdomain(){
		load_plugin_textdomain('pikoworks_custom_post', false, PIKOWORKS_CUSTOM_POST_DIR_PATH . 'languages');
	}
	add_action('plugins_loaded', 'pikoworks_custom_post_load_textdomain');
}

/**
 * Load core 
 */
if ( file_exists( PIKOWORKS_CUSTOM_POST_CORE . 'init.php' ) ) {
    require_once PIKOWORKS_CUSTOM_POST_CORE . 'init.php';
    
}
 if( is_admin() ){
   require_once PIKOWORKS_CUSTOM_POST_CORE . '/js_composer/custom-fields.php';
}

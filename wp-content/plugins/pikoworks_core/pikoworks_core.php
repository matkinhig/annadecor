<?php

if (!defined('ABSPATH')) {
	exit; // if disable direct access
}
/*
 * Plugin Name: Pikoworks Core
 * Plugin URI: 
 * Description: Xtocky WooCommerce theme core functions add metaboxes, shortcodes ...
 * Author: Themepiko
 * Text Domain: pikoworks_core
 * Domain Path: /languages
 * Version: 1.6
 * Author URI: http://www.themepiko.com/
 */

define('PIKOWORKSCORE_VERSION', '1.6.0');
define('PIKOWORKSCORE_BASE_URL', trailingslashit(plugins_url('pikoworks_core')));
define('PIKOWORKSCORE_DIR_PATH', plugin_dir_path(__FILE__));

define('PIKOWORKSCORE_LIBS', PIKOWORKSCORE_DIR_PATH . '/libs/');
define('PIKOWORKSCORE_LIBS_URL', PIKOWORKSCORE_BASE_URL . 'libs/');
define('PIKOWORKSCORE_CORE', PIKOWORKSCORE_DIR_PATH . '/core/');
define('PIKOWORKSCORE_CORE_URL', PIKOWORKSCORE_BASE_URL . 'core/');

define('PIKOWORKSCORE_CSS_URL', PIKOWORKSCORE_BASE_URL . 'assets/css/');
define('PIKOWORKSCORE_JS', PIKOWORKSCORE_BASE_URL . 'assets/js/');
define('PIKOWORKSCORE_IMG_URL', PIKOWORKSCORE_BASE_URL . 'assets/images/');
define('PIKOWORKSCORE_PLUGIN', PIKOWORKSCORE_BASE_URL . 'assets/plugin/');
define('PIKOWORKSCORE_FONTS_URL', PIKOWORKSCORE_BASE_URL . 'assets/fonts/');

define('PIKOWORKSCORE_ADMIN_URL', PIKOWORKSCORE_BASE_URL . 'admin/');

/**
 * Load plugin textdomain
 */

if (!function_exists('pikoworks_core_load_textdomain')) {
	function pikoworks_core_load_textdomain()
	{
		load_plugin_textdomain('pikoworks_core', false, PIKOWORKSCORE_DIR_PATH . 'languages');
	}
	add_action('plugins_loaded', 'pikoworks_core_load_textdomain');
}


/**
 * Load core 
 */
if (file_exists(PIKOWORKSCORE_CORE . 'init.php')) {
	require_once PIKOWORKSCORE_CORE . 'init.php';
}
/**
 * Load libs
 */
if (file_exists(PIKOWORKSCORE_LIBS . 'init.php')) {
	require_once PIKOWORKSCORE_LIBS . 'init.php';
}

if (!function_exists('pikoworks_core_admin_css')) {
	function pikoworks_core_admin_css()
	{
		wp_enqueue_style('pikoworkscore-admin', PIKOWORKSCORE_ADMIN_URL . 'assets/css/admin.css', array(), PIKOWORKSCORE_VERSION, 'all');
	}
	add_action('admin_enqueue_scripts', 'pikoworks_core_admin_css');
}

if (!function_exists('pikoworks_core_admin_js')) {
	function pikoworks_core_admin_js()
	{
		wp_enqueue_script('pikoworks-meta-box', PIKOWORKSCORE_ADMIN_URL . 'assets/js/meta-box.js', array('jquery'), PIKOWORKSCORE_VERSION, 'all');

		global $meta_boxes;
		$meta_box_id = '';
		foreach ($meta_boxes as $box) {
			if (!isset($box['tab'])) {
				continue;
			}
			if (!empty($meta_box_id)) {
				$meta_box_id .= ',';
			}
			$meta_box_id .= '#' . $box['id'];
		}

		wp_localize_script('pikoworks-meta-box', 'meta_box_ids', $meta_box_id);
	}
	add_action('admin_enqueue_scripts', 'pikoworks_core_admin_js');
}
/**
 * working shortcode text widget
 */
add_filter('widget_text', 'do_shortcode');

<?php

if (!defined('ABSPATH')){
    exit; // if disable direct access
}
/*
 * Plugin Name: Xtocky Dummy Content
 * Description: Xtocky theme all dummy content
 * Author: Themepiko
 * Text Domain: pikoworks_dummy
 * Domain Path: /languages
 * Version: 1.0
 * Author URI: https://themepiko.com/
 */

define('PIKOWORKS_DUMMY_DIR_PATH', plugin_dir_path(__FILE__));
define('PIKOWORKS_DUMMY_BASE_URL', trailingslashit(plugins_url('pikoworks_dummy')));


if (!class_exists('Pikoworks_Dummy_Is_Active')) {
	class Pikoworks_Dummy_Is_Active {

		public function __construct() {
			add_action('plugins_loaded', array($this, 'load_textdomain'));
			add_action( 'admin_init', array( $this, 'set_plugin_version_constant' ) );
			$this->load_file();
		}
		public function load_textdomain() {
			/**
			 * Load plugin textdomain
 			*/
			 load_plugin_textdomain('pikoworks_dummy', false, PIKOWORKS_DUMMY_DIR_PATH . 'languages');
		}
		public function set_plugin_version_constant() {
			if ( ! defined( 'PIKOWORKS_DUMMY_VERSION' ) ) {
				$plugin_data = get_plugin_data( __FILE__ );
				define( 'PIKOWORKS_DUMMY_VERSION', $plugin_data['Version'] );
			}
		}
		private function load_file() {
			require_once(PIKOWORKS_DUMMY_DIR_PATH . 'one-click-demo-import/one-click-demo-import.php');
			require_once(PIKOWORKS_DUMMY_DIR_PATH . 'demo_name.php');
			

			
		}
	}
	$Pikoworks_Dummy_Is_Active = new Pikoworks_Dummy_Is_Active();
}
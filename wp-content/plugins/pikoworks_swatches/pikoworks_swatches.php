<?php

if (!defined('ABSPATH')) {
    exit; // if disable direct access
}
/*
 * Plugin Name: Pikoworks Variation Swatches
 * Plugin URI:
 * Description: Woocommerce Product Variation image gallery swatches attribute
 * Author: Themepiko
 * Text Domain: pikoworks_swatches
 * Domain Path: /languages
 * Version: 1.0
 * Author URI: http://www.themepiko.com/
 */

define('PIKOWORKS_VS_DIR', plugin_dir_path(__FILE__));
define('PIKOWORKS_VS_URI', plugins_url('pikoworks_swatches'));

if (!function_exists('pikoworks_vs_install_wc_admin_notice')) {

    /**
     * Print an admin notice if woocommerce is deactivated
     * @use admin_notices hooks
     */
    function pikoworks_vs_install_wc_admin_notice() {
        ?>
        <div class="error"><p><?php esc_html_e('Pikoworks variation switch is enabled but not effective. It requires WooCommerce in order to work.', 'pikoworks_swatches'); ?></p></div>
        <?php        
    }

}
/**
 * Load plugin textdomain
 */
if (!function_exists('pikoworks_vs_load_textdomain')) {

    function pikoworks_vs_load_textdomain() {
        load_plugin_textdomain('pikoworks_vs', false, PIKOWORKS_VS_DIR . 'languages');
    }

    add_action('plugins_loaded', 'pikoworks_vs_load_textdomain');
}

if (!function_exists('pikoworks_vs_install')) {

    function pikoworks_vs_install() {
        if (!function_exists('WC')) {
            add_action('admin_notices', 'pikoworks_vs_install_wc_admin_notice');
        }
    }
}
add_action('plugins_loaded', 'pikoworks_vs_install', 11);
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    require_once PIKOWORKS_VS_DIR . 'core/class_option.php';
    require_once PIKOWORKS_VS_DIR . '/core/class-variation.php';
}

function pikoworks_vs_template($located, $template_name, $args, $template_path, $default_path) {
    if ($template_name == 'single-product/add-to-cart/variable.php') {
        global $post;
        $enable = get_post_meta($post->ID, 'vs_enable_product', true);
        if ($enable == 1) {
            return PIKOWORKS_VS_DIR . 'templates/variable.php';
        }
    }
    return $located;
}

add_filter('wc_get_template', 'pikoworks_vs_template', 10, 5);


if (!function_exists('pikoworks_vs_ajax_url')) {

    function pikoworks_vs_ajax_url() {
        echo '<script type="text/javascript" > var vs_ajax_url = "' . admin_url('admin-ajax.php') . '"; </script>';
    }

    add_action('wp_head', 'pikoworks_vs_ajax_url');
}


if (!function_exists('pikoworks_vs_wc_ajax_variation_threshold')) {

    function pikoworks_vs_wc_ajax_variation_threshold($qty, $product) {
        return 1000;
    }

    add_filter('woocommerce_ajax_variation_threshold', 'pikoworks_vs_wc_ajax_variation_threshold', 100, 2);
}



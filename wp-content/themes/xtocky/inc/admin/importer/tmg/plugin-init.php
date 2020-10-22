<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

add_action('tgmpa_register', 'xtocky_register_required_plugins');
function xtocky_register_required_plugins()
{

    $plugins = array(
        // This is an example of how to include a plugin bundled with a theme.
        array(
            'name'               => 'Pikoworks Core',
            'slug'               => 'pikoworks_core',
            'source'             => 'http://themepiko.com/resources/plugins/stock/pikoworks_core.zip',
            'required'           => true,
            'version'            => '1.0',
            'force_deactivation' => false,
            'external_url'       => '',
            'is_callable'        => ''
        ),
        array(
            'name'         => ' WPBakery Page Builder',
            'slug'         => 'js_composer',
            'source'       => 'http://themepiko.com/resources/plugins/js_composer.zip',
            'required'     => true,
            'version'      => '6.2',
            'external_url' => '',
            'details_url'  => 'https://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431'
        ),
        array(
            'name'         => 'Xtocky Dummy Content',
            'slug'         => 'pikoworks_dummy',
            'source'       => 'http://themepiko.com/resources/plugins/stock/pikoworks_dummy.zip',
            'required'     => false,
            'version'      => '1.0',
        ),
        array(
            'name'         => 'Slider Revolution',
            'slug'         => 'revslider',
            'source'       => 'http://themepiko.com/resources/plugins/revslider.zip',
            'required'     => false,
            'version'      => '6.2',
            'details_url' => 'https://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380'
        ),
        array(
            'name'         => 'Pikoworks Custom Post',
            'slug'         => 'pikoworks_custom_post',
            'source'       => 'http://themepiko.com/resources/plugins/stock/pikoworks_custom_post.zip',
            'required'     => false,
            'version'      => '1.0',
            'external_url' => ''
        ),
        
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
            'details_url' => 'https://wordpress.org/plugins/contact-form-7/'
        ),
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => false,
            'version'   => '3.5',
            'details_url' => 'https://wordpress.org/plugins/woocommerce/'
        ),

        array(
            'name'      => 'MailChimp',
            'slug'      => 'mailchimp-for-wp',
            'required'  => false,
            'details_url' => 'https://wordpress.org/plugins/mailchimp-for-wp/'
        ),
        array(
            'name'      => 'Social Login',
            'slug'      => 'accesspress-social-login-lite',
            'required'  => false,
            'details_url' => 'https://wordpress.org/plugins/accesspress-social-login-lite/'
        ),
        array(
            'name'     => 'Envato Market',
            'slug'     => 'envato-market',
            'source'   => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
            'required' => false,
            'version'  => '2.0.0',
        ),
        array(
            'name'     => 'WooCommerce Product Bundle',
            'slug'     => 'wpa-woocommerce-product-bundle',
            'source'   => 'http://themepiko.com/resources/plugins/wpa-woocommerce-product-bundle.zip',
            'version'  => '1.0.1'
        ),
        array(
            'name'     => 'Variation Swatches',
            'slug'     => 'pikoworks_swatches',
            'source'   => 'http://themepiko.com/resources/plugins/pikoworks_swatches.zip',
            'version'  => '1.0',
            'required' => false
        ),
        array(
            'name'      => 'YITH WooCommerce Ajax Product Filter',
            'slug'     => 'yith-woocommerce-ajax-product-filter-premium',
            'source'   => 'http://themepiko.com/resources/plugins/yith-woocommerce-ajax-product-filter-premium.zip',
            'version'  => '3.5',
            'required' => false
        ),
        array(
            'name'      => 'Instagram Shop',
            'slug'      => 'shop-feed-for-instagram-by-snapppt',
            'required'  => false,
            'details_url' => 'https://wordpress.org/plugins/shop-feed-for-instagram-by-snapppt/'
        ),
        array(
            'name'      => 'YITH WooCommerce Wishlist',
            'slug'      => 'yith-woocommerce-wishlist',
            'required'  => false,
            'details_url' => 'https://wordpress.org/plugins/yith-woocommerce-wishlist/'
        ),
        array(
            'name'      => 'YITH WooCommerce Compare',
            'slug'      => 'yith-woocommerce-compare',
            'required'  => false,
            'details_url' => 'https://wordpress.org/plugins/yith-woocommerce-compare/'
        ), array(
            'name'      => 'YITH WooCommerce Quick View',
            'slug'      => 'yith-woocommerce-quick-view',
            'required'  => false,
            'details_url' => 'https://wordpress.org/plugins/yith-woocommerce-quick-view/'
        ),
        array(
            'name'      => 'Cookie Notice',
            'slug'      => 'cookie-notice',
            'required'  => false,
            'details_url' => 'https://wordpress.org/plugins/cookie-notice/'
        )

    );
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa($plugins, $config);
}

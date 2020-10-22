<?php
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}
if ( !class_exists( 'RW_Meta_Box' ) ){
/**
 * Load meta-boxe 
 */
 require_once PIKOWORKSCORE_CORE . 'meta-box/meta-box-init.php';
}

 /** 
 * Load widgets
 **/

 require_once PIKOWORKSCORE_CORE . '/widgets/latest-posts.php';
 require_once PIKOWORKSCORE_CORE . '/widgets/widget-socials.php';
 require_once PIKOWORKSCORE_CORE . '/widgets/widget-flickr.php';
 require_once PIKOWORKSCORE_CORE . '/widgets/wp-instagram-widget.php';
 require_once PIKOWORKSCORE_CORE . '/widgets/newslatter.php';
 require_once PIKOWORKSCORE_CORE . '/widgets/company-info.php';
// if(function_exists( 'WC' )){
//     
// }
 
 function pikoworks_no_core_no_widgets(){
    register_widget('pikoworks_widget_postimage');      
    register_widget('pikoworks_widgets_socials');
    register_widget('pikoworks_Flickr_Widget');
    register_widget('pikoworks_Instagram_Widget');
    register_widget('pikoworks_widget_newsletter');
    register_widget('Pikoworks_Widget_CompanyInfo');
 }
 add_action('widgets_init', 'pikoworks_no_core_no_widgets');
 

 
/**
 * Initialising Visual Composer
 * 
 */ 
if ( class_exists( 'Vc_Manager', false ) ) {
    
    if ( ! function_exists( 'js_composer_bridge_admin' ) ) {
		function js_composer_bridge_admin( $hook ) {
			wp_enqueue_style( 'js_composer_bridge', PIKOWORKSCORE_CORE_URL . 'js_composer/css/style.css', array() );
		}
	}
    add_action( 'admin_enqueue_scripts', 'js_composer_bridge_admin', 15 );


    require_once PIKOWORKSCORE_CORE.'js_composer/visualcomposer.php';
}


/**
 * currency switcher
 * 
 */ 
if ( ! function_exists( 'pikowroks_currency_switcher' ) ) {
    function pikowroks_currency_switcher( $addons = NULL ) {
            if ( ! class_exists( 'woocommerce_wpml' ) && ! class_exists( 'WC_Product_Price_Based_Country' ) ) {
                    $addons = 'currency';
            } else {
                    $addons = '';
            }
            return apply_filters( 'pikowroks_currency_switcher', $addons );
    }
}

if ( ! class_exists( 'woocommerce_wpml' ) && ! class_exists( 'WC_Product_Price_Based_Country' ) ) {
        require_once PIKOWORKSCORE_CORE . 'currency/init.php';
}
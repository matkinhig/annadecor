<?php
/**
 * @author  themepiko
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Function check if WC Plugin installed
 */
function pikoworks_is_wc(){
    return function_exists( 'is_woocommerce' );
}

if( is_admin() ){
   require_once PIKOWORKSCORE_CORE . 'js_composer/custom-fields.php';
   require_once PIKOWORKSCORE_CORE . 'js_composer/custom-global.php';
}
require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/icon_block.php';




if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
/**
 *if WC Plugin active
 **/ 
    require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/tabs_product.php';
    require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/product_carousel.php'; 
    require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/product-cat-brand.php';  
    require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/widget_products.php'; 
}

require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/countdown.php';
require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/twitter_feed.php';
require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/light-box.php';
require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/progressbars.php';
require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/social.php';
require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/newsletter.php';
require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/brand_logo.php';
require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/blog_post.php';
require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/google_map.php';
require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/instagram.php';
require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/vertical-menu.php';
require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/pricing_table.php';

if(class_exists('WeDevs_Dokan')){
    require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/vendor.php';
    require_once PIKOWORKSCORE_CORE . 'js_composer/shortcodes/dokan_geo_search.php';
}

//vc_map_update( 'vc_custom_heading', array(  'category' => esc_html__('Pikoworks', 'pikoworks_core' ), 'icon' => get_template_directory_uri() . '/assets/images/logo/vc-icon.png',  'name' => esc_html__( 'Heading | Banner', 'pikoworks_core'),) );

if( ! function_exists( 'pikoworks_get_slider_params_enable' ) ) {
	function pikoworks_get_slider_params_enable() {
		return array(
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Carousel Style', 'pikoworks_core'),
                            'param_name' => 'is_slider',
                            'value' => array(
                                esc_html__('Yes', 'pikoworks_core') => 'yes',
                                esc_html__('No', 'pikoworks_core') => 'no',
                                ),
                            'std'         => 'no',
                            'weight'      => 1,
                            'admin_label' => true,
                        ),
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Yes', 'pikoworks_core' ) => 'true',
                                esc_html__( 'No', 'pikoworks_core' )  => 'false'
                            ),
                            'std'         => 'true',
                            'heading'     => esc_html__( 'Navigation', 'pikoworks_core' ),
                            'param_name'  => 'navigation',
                            'description' => esc_html__( "Show buton 'next' and 'prev' buttons.", 'pikoworks_core' ),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),
                            'admin_label' => true,
                        ),                           
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Center', 'pikoworks_core' ) => '',
                                esc_html__( 'Top Center', 'pikoworks_core' )  => 'tc',
                                esc_html__( 'Small Center', 'pikoworks_core' )  => 'sc',
                                esc_html__( 'Small top Center right', 'pikoworks_core' )  => 'stcr',
                            ),                
                            'heading'     => esc_html__( 'Next/Prev Button', 'pikoworks_core' ),
                            'param_name'  => 'navigation_btn',
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'navigation', 'value'     => array( 'true' )),
                        ),
                        array(                
                            'type' => 'checkbox',                
                            "heading" => '',
                            'param_name' => 'btn_hover_show',
                            'value' => array(esc_html__('Hover show Next/Prev Button', 'pikoworks_core') => 'sh'),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'navigation', 'value'     => array( 'true' )),
                        ),
                        array(                
                            'type' => 'checkbox',                
                            "heading" => '',
                            'param_name' => 'btn_light',
                            'value' => array(esc_html__('Button Light', 'pikoworks_core') => 'al'),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'navigation', 'value'     => array( 'true' )),
                        ),            
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Yes', 'pikoworks_core' ) => 'true',
                                esc_html__( 'No', 'pikoworks_core' )  => 'false'
                            ),
                            'std'         => 'false',
                            'heading'     => esc_html__( 'Bullets', 'pikoworks_core' ),
                            'param_name'  => 'dots',
                            'description' => esc_html__( "Show Carousel bullets bottom", 'pikoworks_core' ),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),
                            'admin_label' => true,
                        ),
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Yes', 'pikoworks_core' ) => 'true',
                                esc_html__( 'No', 'pikoworks_core' )  => 'false'
                            ),
                            'std'         => 'false',
                            'heading'     => esc_html__( 'AutoPlay', 'pikoworks_core' ),
                            'param_name'  => 'autoplay',
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),
                            'admin_label' => true,
                        ),
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Yes', 'pikoworks_core' ) => 'true',
                                esc_html__( 'No', 'pikoworks_core' )  => 'false'
                            ),
                            'std'         => 'false',
                            'heading'     => esc_html__( 'Loop', 'pikoworks_core' ),
                            'param_name'  => 'loop',
                            'description' => esc_html__( "Inifnity loop. Duplicate last and first items to get loop illusion.", 'pikoworks_core' ),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),
                            'admin_label' => false,
                            ),            
                        array(
                            "type"        => "checkbox",
                            "heading"     => '',
                            "param_name"  => "margin",
                            'value' => array(esc_html__('No Gap', 'pikoworks_core') => 'no-gap'),                
                            "description" => esc_html__('Distance( or space) between 2 item ', 'pikoworks_core'),
                            'dependency' => array('element'   => 'is_slider', 'value'     => array( 'yes' )),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' )
                                ),

                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Multiple item', 'pikoworks_core' ) => 1,
                                esc_html__( 'Single item', 'pikoworks_core' )  => 0
                            ),
                            'std'         => 1,
                            'heading'     => esc_html__( 'Carosuel type', 'pikoworks_core' ),
                            'param_name'  => 'use_responsive',
                            'description' => esc_html__( "NB: Single item not working below option", 'pikoworks_core' ),
                            'group'       => esc_html__( 'Responsive', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),               
                        ),            
                        array(
                            "type"        => "dropdown",
                            "heading"     => esc_html__("Items large Device", 'pikoworks_core'),
                            "param_name"  => "items_very_large_device",
                            'value' => array(2 => 2,3 => 3,4 => 4,5 => 5,6 => 6,),
                            'std'         => '4',
                            "description" => esc_html__('Screen resolution of device >= 1200px', 'pikoworks_core'),                
                            'group'       => esc_html__( 'Responsive', 'pikoworks_core' ),
                            'admin_label' => true,
                          ),            
                        array(
                            'type' => 'dropdown',
                            "heading"     => esc_html__("Items on Medium Device", 'pikoworks_core'),
                            'param_name' => 'items_large_device',
                            'value' => array(2 => 2,3 => 3,4 => 4,6 => 6,),
                            'std'         => '4',
                            'description' => esc_html__('Resolution < 1200px || Tablet and Mobile auto fixed', 'pikoworks_core'),                            
                            'group'       => esc_html__( 'Responsive', 'pikoworks_core' ),
                            'admin_label' => true,
                        ),
                        array(
                            'type' => 'dropdown',
                            "heading"     => esc_html__("Items on Mobile Device", 'pikoworks_core'),
                            'param_name' => 'items_mobile_device',
                            'value' => array(1 => 1,2 => 2),
                            'std'         => '1',
                            'description' => esc_html__('Resolution < 767px', 'pikoworks_core'),                            
                            'group'       => esc_html__( 'Responsive', 'pikoworks_core' ),
                            'admin_label' => true,
                        ),
			
		);
	}
}

if( ! function_exists( 'pikoworks_get_vc_design' ) ) {
	function pikoworks_get_vc_design() {
		return array(
			 array(
                            "type"        => "textfield",
                            "heading"     => esc_html__( "Extra class name", 'pikoworks_core' ),
                            "param_name"  => "el_class",
                            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks_core" ),
                        ),

                         array(
                            'type'           => 'css_editor',
                            'heading'        => esc_html__( 'Css', 'pikoworks_core' ),
                            'param_name'     => 'css',
                            'group'          => esc_html__( 'Design options', 'pikoworks_core' )
                        )			
		);
	}
}






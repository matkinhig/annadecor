<?php
/**
 * @author  themepiko
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'init', 'pikoworks_instagram');
function pikoworks_instagram(){
    if(!function_exists('vc_map')) return;
        $params = array(
            "name"        => esc_html__( "Instagram", 'pikoworks_core'),
            "base"        => "pikoworks_instagram",
            "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
            "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
            "description" => esc_html__( "Instagram Photo strem", 'pikoworks_core'),
            'params' => array_merge(array(
                    array(
                      "type" => "textfield",
                      "heading" => esc_html__("username", 'pikoworks_core'),
                      "param_name" => "username",
                      'admin_label' => true,
                    ),
                    array(
                      "type" => "textfield",
                      "heading" => esc_html__("Numer of photos", 'pikoworks_core'),
                      "param_name" => "number",
                      'admin_label' => true,
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Photo size', 'pikoworks_core' ),
                        'param_name' => 'size',
                        'value' => array(                                
                                esc_html__( '320x320', 'pikoworks_core' ) => 'small',
                                esc_html__( '150x150', 'pikoworks_core' ) => 'thumbnail',
                                esc_html__( '640x640', 'pikoworks_core' ) => 'large',
                                esc_html__( '1040x1040', 'pikoworks_core' ) => 'original',
                        ),
                        'admin_label' => true,
                    ),                       
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Open links in', 'pikoworks_core' ),
                        'param_name' => 'target',
                        'value' => array(
                                esc_html__( 'Current window (_self)', 'pikoworks_core' ) => '_self',
                                esc_html__( 'New window (_blank)', 'pikoworks_core' ) => '_blank',
                        ),
                    ),
                    array(                
                        'type' => 'checkbox',                
                        "heading" => '',
                        'param_name' => 'disable_meta',
                        'value' => array(esc_html__('Yes, Disable heart, comment btn alternative show read more btn', 'pikoworks_core') => 'yes'),               
                    ),
                    array(
                      "type" => "textfield",
                      "heading" => esc_html__("Link text", 'pikoworks_core'),
                      "param_name" => "link",
                    ),    
            ), 
            pikoworks_get_slider_params_enable(),
            pikoworks_get_vc_design())
        );
        vc_map($params);
}
class WPBakeryShortCode_pikoworks_instagram extends WPBakeryShortCode { 
    
    protected function content($atts, $content = null) {
        $args = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'pikoworks_instagram', $atts ) : $atts;
        $args = shortcode_atts( array(                     
            'title'  => '',
            'username'  => '',
            'number'  => 9,
            'columns'  => 4,
            'size'  => 'small',
            'target'  => '',
            'disable_meta'  => '',            
            'link'  => '',            
            
            //Carousel 
            'use_responsive' => '1',
            'is_slider' => '',                       
            'autoplay'      => "false",
            'loop'          => "false",
            'navigation'    => "true",
            'navigation_btn' => '',
            'btn_hover_show'    => '',
            'btn_light'    => '',            
            'dots'         => "false",
            'margin'       => '',                 
            //Default
            'items_very_large_device'   => 6,
            'items_large_device'   => 4,        
            'el_class'     =>  '',
            'css'           => '',
            
            
        ), $atts );
        extract($args);        
        
        $css_class = 'instagram-wrap hsc ' . $el_class. ' ' .$css. ' ' . $disable_meta;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $args );
        endif;
        
        ob_start();  ?>        
        <div class="<?php echo esc_attr( $css_class ) ?>" >
            <?php the_widget( 'pikoworks_Instagram_Widget', $args ); ?>
        </div>

        <?php
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }    
    
}
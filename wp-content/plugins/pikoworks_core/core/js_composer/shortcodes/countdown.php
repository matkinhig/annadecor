<?php
/**
 * @newsletter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_countdown' );
function pikoworks_countdown(){
// Setting shortcode lastest
vc_map( array(
    "name"        => esc_html__( "Timer Countdown", 'pikoworks_core'),
    "base"        => "pikoworks_countdown",
    "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/favicon.png",
    "description" => esc_html__( "Timer countdown layout", 'pikoworks_core'),
    "params"      => array(
                array(
                    'heading'       => esc_html__( 'Date Setup', 'pikoworks_core' ),
                    'description' => esc_html__( 'Date formate should be: 08/25/2018', 'pikoworks_core' ),
                    'type'          => 'textfield',                    
                    'param_name'    => 'date',
                    'value'    => '08/25/2018',
                    'admin_label' => true, 
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Layout', 'pikoworks_core' ),
                    'param_name' => 'layout',
                    'value' => array(
                            esc_html__( 'default', 'pikoworks_core' ) => '1',
                            esc_html__( 'Classic', 'pikoworks_core' ) => '3',
                    ),
                    'admin_label' => true,
                ),
                array(
                    "heading"     => esc_html__( "before custom text", 'pikoworks_core' ),
                    "type"        => "textfield",            
                    "param_name"  => "custom_text",
                    'value' => 'Ends in'
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => '',
                    'param_name' => 'small',
                    'value' => array(esc_html__('Small Layout', 'pikoworks_core') => 'small'),
                ),                                  
                array(
                    "heading"     => esc_html__( "Extra class name", 'pikoworks_core' ),
                    "type"        => "textfield",            
                    "param_name"  => "el_class",
                    "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks_core" ),
                ),
                 array(
                    'heading'        => esc_html__( 'Css', 'pikoworks_core' ),
                    'type'           => 'css_editor',            
                    'param_name'     => 'css',
                    'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'pikoworks_core' ),
                    'group'          => esc_html__( 'Design options', 'pikoworks_core' )
                )
    )
));
}
class WPBakeryShortCode_pikoworks_countdown extends WPBakeryShortCode { 
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'pikoworks_countdown', $atts ) : $atts;
        $atts = shortcode_atts( array(           
            'date'        =>  '',
            'small'       => '',
            'layout'      => '',
            'custom_text' => '',
            'el_class'    => '',
            'css'         => '',
            
        ), $atts );
        extract($atts);
        
        $css_class = 'piko_countdown-'.$layout.' ' .$small.' ' . $el_class;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;
       
        if(isset($date) && $date != ''){            
            $date = (explode("/",$date));
            if($layout != 3){
                $date = '<div class="'.esc_attr($css_class).' countdown-lastest countdown-show4 coming-countdown" data-y="' .esc_attr( $date[2] ).'" data-m="'.esc_attr($date[0] ).'" data-d="'. esc_attr( $date[1] ).'" data-h="00" data-i="00" data-s="00" ></div>';

            }  else{
                $date = '<div class="'.esc_attr($css_class).' d_flex align-items-center"> <div>'.esc_attr($custom_text).'</div> <div class="countdown-lastest countdown-show4 coming-countdown" data-y="' .esc_attr( $date[2] ).'" data-m="'.esc_attr($date[0] ).'" data-d="'. esc_attr( $date[1] ).'" data-h="00" data-i="00" data-s="00" ></div></div>';

            }      
        }        
        ob_start();                
        
        echo $date;
            
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }    
    
}
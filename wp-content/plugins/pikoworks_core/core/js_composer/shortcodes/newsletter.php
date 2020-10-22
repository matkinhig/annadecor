<?php
/**
 * @newsletter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_newsletter' );
function pikoworks_newsletter(){
 
   global $pikoworks_vc_anim_effects_in;
// Setting shortcode lastest
vc_map( array(
    "name"        => esc_html__( "Newsletter Mailchimp", 'pikoworks_core'),
    "base"        => "pikoworks_newsletter",
    "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
    "description" => esc_html__( "Newsletter Mailchimp API key", 'pikoworks_core'),
    "params"      => array(
                array(
                    'heading'       => esc_html__( 'Mailchimp For WP Plugin Shortcode', 'pikoworks_core' ),
                    'description' => esc_html__( 'Mailchimp Shortcode like as: [mc4wp_form id="4430"] if collect email address contact form7 shortcode: [contact-form-7 id="4439" title="Subscribe Form"]', 'pikoworks_core' ),
                    'type'          => 'textfield',                    
                    'param_name'    => 'mc_shortcode',
                     'admin_label' => true, 
                ),                
                array(
                    'heading'       => esc_html__( 'Select type', 'pikoworks_core' ),
                    'type'          => 'dropdown',                    
                    'param_name'    => 'news_bg',
                    'value'         => array(
                        esc_html__( 'Background Image', 'pikoworks_core' ) => 'newsv1',
                        esc_html__( 'Background Color', 'pikoworks_core' ) => 'newsv2',
                        esc_html__( 'List', 'pikoworks_core' ) => 'newsv3',
                    ),
                    "description" => esc_html__( "Background color use Design Option.", "pikoworks_core" ),
                    'admin_label' => true,  
                ),
                array(
                    'heading'       => esc_html__( 'Image', 'pikoworks_core' ),
                    'type'          => 'attach_image',                    
                    'param_name'    => 'subscribe_img_id',
                    'dependency' => array('element'   => 'news_bg', 'value'     => array('newsv1')),
                ),
                array(
                    'heading'       => esc_html__( 'Title color', 'pikoworks_core' ),
                    'type'          => 'colorpicker',                    
                    'param_name'    => 'text_color',
                ),
                array(
                    'heading'       => esc_html__( 'Small Title', 'pikoworks_core' ),
                    'type'          => 'textfield',                    
                    'param_name'    => 'subscribe_text',
                    'std'           => esc_html__( 'Join our news letter', 'pikoworks_core' ),
                ),
                array(
                    'heading'       => esc_html__( 'Title', 'pikoworks_core' ),
                    'type'          => 'textfield',                    
                    'param_name'    => 'subscribe_form_title',
                    'std'           => esc_html__( 'Stay with us!', 'pikoworks_core' ),
                ),
                array(
                    'heading'       => esc_html__( 'Short Description', 'pikoworks_core' ),
                    'type'          => 'textfield',                    
                    'param_name'    => 'subscribe_short_desc',
                    'std'           => esc_html__( 'Subscribe our community get 25% off your first three order.', 'pikoworks_core' ),
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
class WPBakeryShortCode_pikoworks_newsletter extends WPBakeryShortCode { 
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'pikoworks_newsletter', $atts ) : $atts;
        $atts = shortcode_atts( array(           
            'subscribe_text'        =>  '',
            'subscribe_form_title'        =>  '',
            'subscribe_short_desc'        =>  '',
            'mc_shortcode' =>  '', 
            'subscribe_img_id'            =>  0, 
            'text_color'           => '',
            'news_bg'           => '',
            'el_class'           => '',
            'css'           => '',
            
            
        ), $atts );
        extract($atts);
        
        $css_class = 'signup-newsletter  ' . $el_class . ' ' .$news_bg;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;

        
         $img_html = '';   
        if ( intval( $subscribe_img_id ) > 0 ) {
            $img = wp_get_attachment_image_url( $subscribe_img_id,'full');
            $img_html = '<figure><img src="' . esc_url( $img ) . '" alt=""></figure>';
        }
            
        
        $html = '';        
        $text_style = trim( $text_color ) != '' ? 'color: ' . esc_attr( $text_color ) . ';' : '';
         if ( trim( $text_color ) != '' ) {
            $text_style = 'style="' .  esc_attr($text_style) .  '"';
        }
        
        
        if($subscribe_text != ''){
            $subscribe_text = '<h4 '.$text_style.'>' . sanitize_text_field( $subscribe_text ) . '</h4>';
        }
        if($subscribe_form_title != ''){
            $subscribe_form_title = '<h3 '.$text_style.'>' . sanitize_text_field( $subscribe_form_title ) . '</h3>';
        }
        if($subscribe_short_desc != ''){
            $subscribe_short_desc = '<p class="desc" '.$text_style.'>' . sanitize_text_field( $subscribe_short_desc ) . '</p>';
        }

        
        $subscribe_form_html = '<div class="newsfrom">'.do_shortcode($mc_shortcode).'</div>'; 
        
        ob_start();        
        
         $html .= '<div class="' . esc_attr( $css_class ) . '">
                     ' . $img_html . '  
                    <div class="banner-content">                                           
                          <div class="news-wrap">' . $subscribe_text . '                     
                          ' . $subscribe_form_title . '                     
                          ' . $subscribe_short_desc . ' </div>                    
                          ' . $subscribe_form_html . '                     
                    </div>
                </div>';
        
        echo balanceTags( $html );       
        
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }    
    
}
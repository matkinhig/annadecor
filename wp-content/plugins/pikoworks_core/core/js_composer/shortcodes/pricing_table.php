<?php
/**
 * @author  themepiko
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_pricing_table' );
function pikoworks_pricing_table(){
 
// Setting shortcode lastest
vc_map( array(
    "name"        => esc_html__( "Pricing Table", 'pikoworks_core'),
    "base"        => "pikoworks_pricing_table",
    "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
    "description" => esc_html__( "Pricing table configure", 'pikoworks_core'),
    "params"      => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Title', 'pikoworks_core'),
            'param_name' => 'title',
            'description' => esc_html__('Like as basic, advance, popular', 'pikoworks_core'),
            'admin_label' => true,
        ),
        array(
            'type' => 'textfield',
            'param_name' => 'money',
            'heading' => esc_html__('Money', 'pikoworks_core'),
            'admin_label' => true,
            'description' => esc_html__('Use the money with month, year like as $100', 'pikoworks_core')
        ),
        array(
            'type' => 'textfield',
            'param_name' => 'month',
            'heading' => esc_html__('Month or Years', 'pikoworks_core'),
            'value' => esc_html__('Month', 'pikoworks_core'),
            'admin_label' => true,
        ),
        array(
            'type' => 'textarea',
            'param_name' => 'feature',
            'heading' => esc_html__('Add Featured', 'pikoworks_core'),
            'description' => esc_html__('Use html list tag ul li', 'pikoworks_core'),
            'value' => '<ul><li>Basic Consultancy</li></ul>'
            
        ),
        array(
            'type' => 'vc_link',
            'param_name' => 'link',
            'heading' => esc_html__('Link', 'pikoworks_core')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Enable Price Ribbon', 'pikoworks_core'),
            'param_name' => 'ribbon',
            'value' => array(esc_html__('Yes', 'pikoworks_core') => 'yes'),
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Ribbon title", 'pikoworks_core' ),
            "param_name"  => "ribbon_title",
            'value' => esc_html__( "POPULAR", 'pikoworks_core' ),
            'dependency' => Array('element' => 'ribbon', 'value' => array('yes'))
        ),
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
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'pikoworks_core' ),
            'group'          => esc_html__( 'Design options', 'pikoworks_core' )
	)
    )
));

}
class WPBakeryShortCode_pikoworks_pricing_table extends WPBakeryShortCode { 
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'pikoworks_pricing_table', $atts ) : $atts;
        $atts = shortcode_atts( array(            
            'title' => '',	
            'money' => '',	
            'month' => esc_html__('Month', 'pikoworks_core'),	
            'feature'  => '',
            'ribbon'  => '',
            'ribbon_title'  => esc_html__('POPULAR', 'pikoworks_core'),
            'link'  => '',        
            'el_class'  =>  '',
            'css'     => '',
            
            
        ), $atts );
        extract($atts);
        
        $css_class = 'pricing-box ' . $el_class;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;

       $link = vc_build_link( $link );
        $featured_class = '';  
       $ribbon_html = '';
       if($ribbon == 'yes'){
         $featured_class = 'featured';  
         $ribbon_html = '<div class="pricing-ribbon"><div class="ribbon">'. esc_attr($ribbon_title).'</div></div>';  
       }
        
        
        ob_start();  ?>      
        
        <div class="<?php echo esc_attr( $css_class . ' ' .$featured_class ); ?>">
            <div class="price-head">
                <h4><?php echo esc_html( $title ); ?></h4>
                <?php echo wp_kses_post( $ribbon_html ); ?>
            </div>
            <div class="price">
                <h2><?php echo esc_html( $money ); ?></h2>
                <span><?php echo esc_html( $month ); ?></span>                    
            </div>
            <?php echo wp_kses_post( $feature ); ?>
          
                      
           
            <?php
            if ( $link['url'] ) {
                        if ( ! $link['title'] ) {
                                $link['title'] = esc_html__( 'SIGN UP', 'pikoworks_core' );
                        }
                        if ( ! $link['target'] ) {
                                $link['target'] = '_self';
                        }
                }
            ?>
            <div class="btnwrap small btn-center">
                <a href="<?php echo esc_url($link['url']) ?>" target="<?php echo esc_attr($link['target']) ?>" title="<?php echo esc_attr( $link['title']) ?>" class="button">
                    <span><?php echo esc_attr( $link['title']) ?></span>
                </a>
            </div>
        </div>

        <?php
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }    
    
}
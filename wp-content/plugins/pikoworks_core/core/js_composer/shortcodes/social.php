<?php
/**
 * @social icon
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_socialpage_link' );
function pikoworks_socialpage_link(){

// Setting shortcode lastest
vc_map( array(
    "name"        => esc_html__( "Social Link", 'pikoworks_core'),
    "base"        => "pikoworks_socialpage_link",
    "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
    "description" => esc_html__( "Show social page link", 'pikoworks_core'),
    "params"      => array(
        array(
            'type' => 'dropdown',
            'param_name' => 'social_style',
            'value' => array(
                esc_html__('Gray', 'pikoworks_core') => 'style1',
                esc_html__('Light border', 'pikoworks_core') => 'style2',
                esc_html__('Gray small', 'pikoworks_core') => 'style3',
                esc_html__('Light small border', 'pikoworks_core') => 'style4',
            ),
            'std'     => 'style1',
            'admin_label' => true,
            'heading' => esc_html__('Set social Style', 'pikoworks_core'),
            'description'   => esc_html__( 'Your social icon link collect from theme option', 'pikoworks_core' )
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'social_align',
            'value' => array(
                esc_html__('Left', 'pikoworks_core') => 'text-left',
                esc_html__('Center', 'pikoworks_core') => 'text-center',
                esc_html__('Right', 'pikoworks_core') => 'text-right',
            ),
            'std'           => 'text-center',
            'admin_label' => true,
            'heading' => esc_html__('Social Alignment', 'pikoworks_core'),
        ),
        array(
            'type' => 'textfield',
            'param_name' => 'title_text',
            'heading' => esc_html__('Title', 'pikoworks_core'),
            'value' => 'FOLLOW US',
            'admin_label' => true,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Title color', 'pikoworks_core' ),
            'param_name' => 'title_text_color',            
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Extra class name", 'pikoworks_core' ),
            "param_name"  => "el_class",
            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" ),
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
class WPBakeryShortCode_pikoworks_socialpage_link extends WPBakeryShortCode { 
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'pikoworks_socialpage_link', $atts ) : $atts;
        $atts = shortcode_atts( array(            
            'social_style' => '',
            'title_text' => esc_html__('FOLLOW US', 'pikoworks_core'),	
            'title_text_color' => '',            
            'social_align' => 'center',            
            'el_class'           => '',           
            'css'           => '',           
            
        ), $atts );
        extract($atts);
        $css_class = 'social-icon-wrap '. $social_align . ' ' . $el_class;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;
        
        $title_style = trim( $title_text_color ) != '' ? 'color: ' . esc_attr( $title_text_color ) . ';' : '';
        if ( trim( $title_style ) != '' ) {
            $title_style = 'style="' .  esc_attr($title_style) .  '"';
        }
        $title_html = '';
        if($title_text != ''){
             $title_html = '<h4 '.$title_style .'>' . sanitize_text_field( $title_text ) . '</h4>';   
        }
        
        ob_start(); ?>        
        
        <div class="<?php echo esc_attr( $css_class ) ?>">
            <?php  
            echo balanceTags( $title_html ); 

            if ( trim( $GLOBALS['xtocky']['twitter'] . $GLOBALS['xtocky']['facebook'] . $GLOBALS['xtocky']['googleplus'] . $GLOBALS['xtocky']['dribbble'] . 
                $GLOBALS['xtocky']['behance'] . $GLOBALS['xtocky']['tumblr'] . $GLOBALS['xtocky']['instagram'] . $GLOBALS['xtocky']['pinterest'] .  $GLOBALS['xtocky']['soundcloud'] .
                $GLOBALS['xtocky']['youtube'] . $GLOBALS['xtocky']['vimeo'] . $GLOBALS['xtocky']['linkedin'] . $GLOBALS['xtocky']['flickr'] ) != '' ) {
                    echo '<div class="icon-wrap '.esc_attr($social_style) . '">';
                    get_template_part( 'template-parts/social', 'items' );
                    echo '</div><!-- /.social-wrap -->';
            } 

            ?>
        </div>

        <?php
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }    
    
}
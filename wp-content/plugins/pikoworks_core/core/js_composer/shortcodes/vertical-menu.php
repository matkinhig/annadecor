<?php
/**
 * @vertica menu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_vertical_menu' );
function pikoworks_vertical_menu(){  

 
// Setting shortcode lastest
vc_map( array(
    "name"        => esc_html__( "Vertical Menu", 'pikoworks_core'),
    "base"        => "pikoworks_vertical_menu",
    "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/favicon.png",
    "description" => esc_html__( "Source vertical menu", 'pikoworks_core'),
    "params"      => array(
                array(
                    'heading'       => esc_html__( 'Menu title', 'pikoworks_core' ),
                    'type'          => 'textfield',                    
                    'param_name'    => 'category_title',
                    'value'    => 'ALL Department',                    
                    'admin_label' => true, 
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__( 'Register Menu', 'pikoworks_core' ),
                    'param_name'    => 'menu_list',
                    'value' => array(
                        'Vertical Menu' => 'category',            
                        'Primary Menu' => 'primary',            
                        'Primary Login Menu' => 'primary_login',            
                        'Top Menu' => 'top_menu',            
                        'Footer Links Menu' => 'footer',            
                        'Scondary menu style6' => 'secondary',            
                    ),
                    "description" => esc_html__( "NB: Selected menu should be added menu item & checkmark then Save Menu. where: wp-admin->appearance->menu. (its support mega menu) ", "pikoworks_core" ),
                    'std'           => 'category',
                    "admin_label" => true,
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__( 'Register Menu', 'pikoworks_core' ),
                    'param_name'    => 'menu_effect',
                    'value' => array(
                        'Fade In Right' => 'effect-fadein-right',                                 
                        'Fade In Left' => 'effect-fadein-left',            
                        'Fade In' => 'effect-fadein',   
                        'Drop Down' => 'effect-down',            
                        'Fade In Up' => 'effect-fadein-up',            
                        'Fade In Down' => 'effect-fadein-down',            
                                   
                    ),
                    'std' => 'effect-fadein-right',
                    "admin_label" => true,
                ),
                array(
                    'heading'       => esc_html__( 'Title color', 'pikoworks_core' ),
                    'type'          => 'colorpicker',                    
                    'param_name'    => 'text_color',
                ),                                    
                array(
                    'heading'       => esc_html__( 'Title Background color', 'pikoworks_core' ),
                    'type'          => 'colorpicker',                    
                    'param_name'    => 'bg_color',
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
class WPBakeryShortCode_pikoworks_vertical_menu extends WPBakeryShortCode { 
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'pikoworks_vertical_menu', $atts ) : $atts;
        $atts = shortcode_atts( array(
            'category_title' =>  '', 
            'menu_list' =>  'category', 
            'menu_effect' => 'effect-fadein-right', 
            'text_color'           => '',
            'bg_color'           => '',
            'el_class'           => '',
            'css'           => '',
            
            
        ), $atts );
        extract($atts);
        
        $css_class = 'category-menu mega-shortcode ' . $el_class;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;

                 
        $text_bg = trim( $bg_color ) != '' ? 'background-color: ' . esc_attr( $bg_color ) . ';' : '';
        $text_style = trim( $text_color ) != '' ? 'color: ' . esc_attr( $text_color ) . ';' : '';
    if ( ( $text_color || $text_bg ) != '' ) {
            $text_style = 'style="' .  esc_attr($text_style . $text_bg) .  '"';
        }   
        
        ob_start();
        
        ?>
                <div class="<?php echo esc_attr( $css_class ); ?>">
                <div class="secondary-menu-wrapper">
                    <div class="secondary-title f_w5 c_s2" <?php echo $text_style; ?>><?php echo esc_attr($category_title); ?></div>
                    <div class="secondary-menu">
                     <?php 
                     
                     if(class_exists('Stock_Piko_Walker_Top_Nav_Menu')) {
                                $arg_default = array(
                                        'container' => false,
                                        'menu_class' => 'menu-category-menu main-menu mega-menu '.esc_attr($menu_effect).' subeffect-fadein-right show-arrow',
                                        'fallback_cb' => 'xtocky_main_menu_fallback',
                                        'walker' => new Stock_Piko_Walker_Top_Nav_Menu
                                );
                                $args = array_merge($arg_default , apply_filters( 'xtocky_filter_main_menu_location' , array(
                                        'theme_location' => $menu_list,
                                )) );
                                wp_nav_menu($args);
                        }                   
                     
                     ?>  
                    </div>
                </div>
                </div>
        <?php        
            
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }    
    
}
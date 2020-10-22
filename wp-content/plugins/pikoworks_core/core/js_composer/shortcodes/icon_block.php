<?php
/**
 * @author  themepiko
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_icon_block' );
function pikoworks_icon_block(){
// Setting shortcode lastest
vc_map( array(
    "name"        => esc_html__( "Icon block", 'pikoworks_core'),
    "base"        => "pikoworks_icon_block",
    "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
    "description" => esc_html__( "Show icon block", 'pikoworks_core'),
    "params"      => array( 
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon library', 'pikoworks_core'),
                'value' => array(
                    esc_html__('-- None -- ', 'pikoworks_core') => '',
                    esc_html__('Font Awesome', 'pikoworks_core') => 'fontawesome',
                    esc_html__('Stock icon', 'pikoworks_core') => 'stroke',                    
                    esc_html__('Open Iconic', 'pikoworks_core') => 'openiconic',
                    esc_html__('Typicons', 'pikoworks_core') => 'typicons',
                    esc_html__('Entypo', 'pikoworks_core') => 'entypo',
                    esc_html__('Image', 'pikoworks_core') => 'image',
                ),
                'param_name' => 'icon_type',
                'admin_label' => true, 
                'description' => esc_html__('Select icon library.', 'pikoworks_core'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'pikoworks_core'),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 1000,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => array('element' => 'icon_type', 'value' => 'fontawesome'),
                'description' => esc_html__('Select icon from library.', 'pikoworks_core'),
            ),
            array(
                'type' => 'iconpicker',
                'param_name' => 'icon_stroke',
                'heading' => esc_html__('Stroke Icon', 'pikoworks_core'),
                'settings' => array(
                        'emptyIcon' => true, // default true, display an "EMPTY" icon?
                        'type' => 'stroke',
                        'iconsPerPage' => 1000, // default 100, how many icons per/page to display
                ),
                'dependency' => array('element' => 'icon_type', 'value' => 'stroke'),

            ),           
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'pikoworks_core'),
                'param_name' => 'icon_openiconic',
                'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'openiconic',
                    'iconsPerPage' => 1000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'openiconic',
                ),
                'description' => esc_html__('Select icon from library.', 'pikoworks_core'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'pikoworks_core'),
                'param_name' => 'icon_typicons',
                'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'typicons',
                    'iconsPerPage' => 1000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'typicons',
                ),
                'description' => esc_html__('Select icon from library.', 'pikoworks_core'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'pikoworks_core'),
                'param_name' => 'icon_entypo',
                'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'entypo',
                    'iconsPerPage' => 1000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'entypo',
                ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Upload Image Icon:', 'pikoworks_core'),
                'param_name' => 'icon_image',
                'value' => '',
                'description' => esc_html__('Upload the custom image icon.', 'pikoworks_core'),
                'dependency' => Array('element' => 'icon_type', 'value' => array('image')),
            ),            
            array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__( 'Icon color', 'pikoworks_core' ),
                    'param_name' => 'icon_color',
                    'admin_label' => true, 
                    'description' => esc_html__( 'Default color use theme option', 'pikoworks_core' ),
                    'dependency' => Array('element' => 'icon_type', 'value' => array('icon_fontawesome', 'lineacons', 'stroke', 'openiconic', 'typicons', 'entypo')),
            ),
            array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__( 'Icon block style', 'pikoworks_core' ),
                    'param_name'    => 'style',
                    'value' => array(
                        esc_html__('List', 'pikoworks_core') => '1',
                        esc_html__('Grid', 'pikoworks_core') => '2',
                        esc_html__('Counter UP', 'pikoworks_core') => '3',
                    ),
                    'std'           => 'text-left',
                    'admin_label' => true, 
            ),
            array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__( 'Text Align', 'pikoworks_core' ),
                    'param_name'    => 'text_align',
                    'value' => array(
                        esc_html__('Text left', 'pikoworks_core') => 'text-left',
                        esc_html__('Text Center', 'pikoworks_core') => 'text-center',
                        esc_html__('Text Right', 'pikoworks_core') => 'text-right',
                        esc_html__('Text Justify', 'pikoworks_core') => 'text-justify',
                    ),
                    'std'           => 'text-left',
                    'admin_label' => true, 
                    'dependency' => array(
                                    'element'   => 'style',
                                    'value'     => array( '2' ),
                                ), 
                    
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Block title', 'pikoworks_core'),
                'param_name' => 'block_title',
                'value'  => 'Title here',
                'admin_label' => true, 
            ),
            array(
                'type'          => 'colorpicker',
                'heading'       => esc_html__( 'Title color', 'pikoworks_core' ),
                'param_name'    => 'title_text_color',
            ),          
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Block Description', 'pikoworks_core'),
                'param_name' => 'block_desc',
                'value'  => 'Block short desc here',
            ),
            array(
                'type'          => 'colorpicker',
                'heading'       => esc_html__( 'Desc Text Color', 'pikoworks_core' ),
                'param_name'    => 'text_color',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Button Link', 'pikoworks_core'),
                'param_name' => 'btn_link',
                'value' => array(esc_html__('Yes, please', 'pikoworks_core') => 'yes'),
            ),
            array(
                'type'          => 'vc_link',
                'heading'       => esc_html__( 'Link', 'pikoworks_core' ),
                'param_name'    => 'link',
                'std'           => esc_html__( 'Button link', 'pikoworks_core' ),                 
                'dependency' => array(
                                    'element'   => 'btn_link',
                                    'value'     => array( 'yes' ),
                                ), 
            ), 
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Show Read More Button', 'pikoworks_core' ),
                'param_name'    => 'show_read_more_btn',
                'value' => array(
                    esc_html__( 'Yes', 'pikoworks_core' ) => 'yes',
                    esc_html__( 'No', 'pikoworks_core' ) => 'no',	    
                ),
                'std'           => 'no',
                'admin_label' => true,
                'dependency' => array(
                                'element'   => 'style',
                                'value'     => array( 'style1' ),
                            ),
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__( 'Read More Button Text', 'pikoworks_core' ),
                'param_name'    => 'read_more_text',
                'std'           => esc_html__( 'Read More', 'pikoworks_core' ),                
                'dependency' => array(
                                'element'   => 'show_read_more_btn',
                                'value'     => array( 'yes' ),
                            ),
            ),               
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Extra class name", 'pikoworks_core' ),
            "param_name"  => "el_class",
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
class WPBakeryShortCode_pikoworks_icon_block extends WPBakeryShortCode { 
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'pikoworks_icon_block', $atts ) : $atts;
        $atts = shortcode_atts( array(
            'style' => '',     
            'icon_type' => '',     
            'icon_fontawesome' => '',  
            'icon_stroke' => '',     
            'icon_openiconic' => '',     
            'icon_typicons' => '',     
            'icon_entypo' => '',    
            'icon_image' => '', 
            
            'icon_color' => '',        
            
        
            
            'block_title' => ' ',
            'title_text_color' => '',            
            'block_desc' => '',
            'text_color' => '',
            
            'text_align' => 'text-left',
            'btn_link' => 'yes',
            'link' => '',
            'link_hover' => '',
            'show_read_more_btn'    =>  'no',
            'read_more_text'    =>  '',       
            'el_class'           => '',
            'css'           => '',
            
            
        ), $atts );
        extract($atts);
        
         
      
        
        
        $css_class = 'icon-layout-'. $style . '  ' . $text_align  . ' ' . $el_class;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;

        
            
            if($icon_type!='' && $icon_type!='image' &&  $icon_type!='stroke') {
               vc_icon_element_fonts_enqueue( $icon_type );
                $iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'fa fa-adjust';
                
            }          
      
        
            $block_html = '';
            $block_title_html = '';
            $block_desc_html = '';
            $read_more_html = '';
            //$block_title = '';

            $link_default = array(
                    'url'       =>  '',
                    'title'     =>  '',
                    'target'    =>  '_self'
                );

                if ( $btn_link == 'yes' && function_exists( 'vc_build_link' ) ):
                    $link = vc_build_link( $link );
                else:
                    $link = $link_default;
                endif;
            
            $title_style = trim( $title_text_color ) != '' ? 'color: ' . esc_attr( $title_text_color ) . ';' : '';    
            $text_style = trim( $text_color ) != '' ? 'color: ' . esc_attr( $text_color ) . ';' : '';
            
            
            
            
            if ( trim( $title_style ) != '' ) {
                    $title_style = 'style="' .  esc_attr($title_style) .  '"';
                }
            if ( trim( $text_color ) != '' ) {
                    $text_style = 'style="' .  esc_attr($text_style) .  '"';
                }
                
                

            if ( trim( $block_title ) != '' ) {
                if ( trim( $link['url'] ) != '' ) {
                    $block_title_html = '<h4><a href="' . esc_url( $link['url'] ) . '" target="' . esc_attr( $link['target'] ) . '" title="' . esc_attr( $block_title ) . '" '. $title_style .'>' . sanitize_text_field( $block_title ) . '</a></h4>';
                }
                else{
                    $block_title_html = '<h4 '.$title_style .'>' . sanitize_text_field( $block_title ) . '</h4>';   
                }
            }
            
            $show_read_more_btn = trim( $show_read_more_btn ) == 'yes';
            if ( trim( $link['url'] ) != '' && $show_read_more_btn && trim( $read_more_text ) != '' ) {
                $read_more_html = '<a href="' . esc_url( $link['url'] ) . '" target="' . esc_attr( $link['target'] ) . '" title="' . esc_attr( $block_title ) . '" '.$title_style .' class="btn_read_more">' . sanitize_text_field( $read_more_text ) . '</a>';
            }

            if ( trim( $block_desc ) != '' ) {
                $block_desc_html = '<p '. $text_style .'>' . sanitize_text_field( $block_desc ) .' '. $read_more_html .'</p>';
            }
            
            $icon_color = trim( $icon_color ) != '' ? 'color: ' . esc_attr( $icon_color ) . ';' : '';
            if ( trim( $icon_color ) != '' ) {
                $icon_color = 'style="' . esc_html($icon_color) .  '"';
            }
                    

           $icon_html =$icon_html2 = '';
           if($icon_type !== ''){
            if ( $icon_type == 'image' ) :
                $img = wp_get_attachment_image_src( $icon_image, 'full' );
            
                $icon_html = '<img src=" '. esc_url($img[0]) .' " alt=""/>';
            elseif($icon_type == 'stroke') :                    
               $icon_html = '<span class="' .  esc_attr($icon_stroke).' " aria-hidden="true" ' . $icon_color .'></span>';            
            else :                    
               $icon_html = '<i class="' .  esc_attr($iconClass).' " aria-hidden="true" ' . $icon_color .'></i>'; 

            endif; //$icon_type == 'image' 
            
           }
           if($icon_html != ''){
             $icon_html2 = '<div class="icon-wrap">'. $icon_html .'</div>';
           }
        ob_start(); 
        
        $block_html = ' <div class="icon-block">'.$icon_html2.'
         <div class="icon-content">
         '.$block_title_html.'         
         '. $block_desc_html .'
         </div>
        </div>';

        if($style == 3){
            $block_html = ' <div class="counter-up">
             <div class="icon_count">'.$block_title.'</div>
             <div class="block_desc">'. $block_desc_html .'</div>
            </div>';
        }

        $block_html = '<div class="' . esc_attr( $css_class ) . '">
                        ' . $block_html . '
                    </div>'; //end $css_class

        echo do_shortcode( $block_html ); 
        
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }
}
<?php
/**
 * @vc extension
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('pikoworks_init_vc_global')) {
    add_action('after_setup_theme', 'pikoworks_init_vc_global', 1);
    
    function pikoworks_init_vc_global(){
        if( ! defined( 'WPB_VC_VERSION' )){
            return ;
        }
        if( version_compare( WPB_VC_VERSION , '4.2', '<') ){
            add_action( 'init', 'pikoworks_add_vc_global_params', 100 );
        }else{
            add_action( 'vc_after_mapping', 'pikoworks_add_vc_global_params' );
        }
    }
}
if(!function_exists('pikoworks_add_vc_global_params')) {
    function pikoworks_add_vc_global_params(){
      //  vc_set_shortcodes_templates_dir( PIKOWORKSCORE_CORE . '/js_composer/shortcodes/' );


        global $vc_setting_row, $vc_setting_col, $vc_setting_column_inner, $vc_setting_icon_shortcode;

        vc_add_params( 'vc_icon', $vc_setting_icon_shortcode );
        vc_add_params( 'vc_column', $vc_setting_col );
        vc_add_params( 'vc_column_inner', $vc_setting_column_inner );

        pikoworks_enqueue_custom_script();

        if( function_exists( 'vc_add_shortcode_param')){        
            vc_add_shortcode_param( 'pikoworks_categories', 'pikoworks_vc_categories_settings_field' );
            vc_add_shortcode_param( 'pikoworks_number' , 'pikoworks_vc_number_settings_field');
            vc_add_shortcode_param( 'pikoworks_taxonomy', 'pikoworks_vc_taxonomy_settings_field');
            vc_add_shortcode_param( 'pikoworks_title', 'pikoworks_vc_title_settings_field');
        }else{

            add_shortcode_param( 'pikoworks_categories', 'pikoworks_vc_categories_settings_field' );
            add_shortcode_param( 'pikoworks_number' , 'pikoworks_vc_number_settings_field' );
            add_shortcode_param( 'pikoworks_taxonomy', 'pikoworks_vc_taxonomy_settings_field');
            add_shortcode_param( 'pikoworks_title', 'pikoworks_vc_title_settings_field');

        }
    }
}
if(!function_exists('pikoworks_enqueue_custom_script')) {
    function pikoworks_enqueue_custom_script(){
        wp_enqueue_script( 'pikoworks-chosen-js', PIKOWORKS_CUSTOM_POST_ASSETS.'js/chosen/chosen.jquery.min.js', array( 'jquery' ), '1.4.2', true );
        wp_enqueue_style( 'pikoworks-chosen-css', PIKOWORKS_CUSTOM_POST_ASSETS.'js/chosen/chosen.css' );
    }
}
if(!function_exists('pikoworks_vc_number_settings_field')) {
/**
 * Pikowroks Number field.
 *
 */
    function pikoworks_vc_number_settings_field($settings, $value){
            $dependency = '';
            $param_name = isset( $settings[ 'param_name' ] ) ? $settings[ 'param_name' ] : '';
            $type = isset($settings[ 'type ']) ? $settings[ 'type' ] : '';
            $min = isset($settings[ 'min' ]) ? $settings[ 'min' ] : '';
            $max = isset($settings[ 'max' ]) ? $settings[ 'max'] : '';
            $suffix = isset($settings[ 'suffix' ]) ? $settings[ 'suffix' ] : '';
            $class = isset($settings[ 'class' ]) ? $settings[ 'class' ] : '';
            $output = '<input type="number" min="'.esc_attr( $min ).'" max="'.esc_attr( $max ).'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.esc_attr($value).'" '.$dependency.' style="max-width:100px; margin-right: 10px;" />'.$suffix;
            return $output;
    }
}
if(!function_exists('pikoworks_vc_title_settings_field')) {
    /**
     * pikowroks title dropdown
     *
     */
    function pikoworks_vc_title_settings_field($settings, $value) {
        $value_arr = $value;
        $value_arr = $value;
            if ( ! is_array($value_arr) ) {
                    $value_arr = array_map( 'trim', explode(',', $value_arr) );
            }
        $dependency = '';
        $uniqeID    = uniqid();
        $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
        $param_option = isset($settings['options']) ? $settings['options'] : '';
        $multiple = (!empty($settings['multiple'])) ? 'multiple="multiple"' : '';
        $output = '<select id="pikoworks_title-'.$uniqeID.'" '.$multiple.' name="'. esc_attr($param_name) .'" class="wpb_vc_param_value wpb-input wpb-select '.esc_attr($param_name).' '.$settings['type'].'_field" '.$dependency.'>';

        if ($param_option != '' && is_array($param_option)) {
            foreach ($param_option as $text_val => $val) {
                if (is_numeric($text_val) && (is_string($val) || is_numeric($val))) {
                    $text_val = $val;
                }
                $selected = (in_array( $val, $value_arr )) ? ' selected="selected"' : '';
                $output .= '<option id="' . $val . '" value="' . $val . '" '.$selected.' >' . htmlspecialchars($text_val) . '</option>';
            }
        }  

        $output .= '</select><script type="text/javascript">jQuery("#pikoworks_title-' . $uniqeID . '").chosen();</script>';

        return $output;
    }
}
if(!function_exists('pikoworks_vc_taxonomy_settings_field')) {
    /**
     * pikoworks Taxonomy checkbox list field.
     *
     */
    function pikoworks_vc_taxonomy_settings_field($settings, $value) {
            $dependency = '';

            $value_arr = $value;
            if ( ! is_array($value_arr) ) {
                    $value_arr = array_map( 'trim', explode(',', $value_arr) );
            }
        $output = '';
        if( isset( $settings['hide_empty'] ) && $settings['hide_empty'] ){
            $settings['hide_empty'] = 1;
        }else{
            $settings['hide_empty'] = 0;
        }
            if ( ! empty($settings['taxonomy']) ) {

            $terms_fields = array();
            if(isset($settings['placeholder']) && $settings['placeholder']){
                $terms_fields[] = "<option value=''>".$settings['placeholder']."</option>";
            }

            $terms = get_terms( $settings['taxonomy'] , array('hide_empty' => false, 'parent' => $settings['parent'], 'hide_empty' => $settings['hide_empty'] ));
                    if ( $terms && !is_wp_error($terms) ) {
                            foreach( $terms as $term ) {
                                $selected = (in_array( $term->slug, $value_arr )) ? ' selected="selected"' : '';                
                                $terms_fields[] = '<option value="' .$term->slug. '" '. $selected .' >' . htmlspecialchars($term->name) . '</option>';
                        }
                    }
            $size = (!empty($settings['size'])) ? 'size="'.$settings['size'].'"' : '';
            $multiple = (!empty($settings['multiple'])) ? 'multiple="multiple"' : '';

            $uniqeID    = uniqid();

            $output = '<select id="pikoworks_taxonomy-'.$uniqeID.'" '.$multiple.' '.$size.' name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'_field" '.$dependency.'>'
                        .implode( $terms_fields )
                    .'</select>';

            $output .= '<script type="text/javascript">jQuery("#pikoworks_taxonomy-' . $uniqeID . '").chosen();</script>';

            }

        return $output;
    }
}

if( ! function_exists( 'pikoworks_get_slider_params_enable' ) ) {
	function pikoworks_get_slider_params_enable() {
		return array(
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Carousel Style', 'pikoworks_custom_post'),
                            'param_name' => 'is_slider',
                            'value' => array(
                                esc_html__('Yes', 'pikoworks_custom_post') => 'yes',
                                esc_html__('No', 'pikoworks_custom_post') => 'no',
                                ),
                            'std'         => 'no',
                            'weight'      => 1,
                            'admin_label' => true,
                        ),
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Yes', 'pikoworks_custom_post' ) => 'true',
                                esc_html__( 'No', 'pikoworks_custom_post' )  => 'false'
                            ),
                            'std'         => 'true',
                            'heading'     => esc_html__( 'Navigation', 'pikoworks_custom_post' ),
                            'param_name'  => 'navigation',
                            'description' => esc_html__( "Show buton 'next' and 'prev' buttons.", 'pikoworks_custom_post' ),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_custom_post' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),
                            'admin_label' => true,
                        ),                           
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Center', 'pikoworks_custom_post' ) => '',
                                esc_html__( 'Top Center', 'pikoworks_custom_post' )  => 'tc',
                                esc_html__( 'Small Center', 'pikoworks_custom_post' )  => 'sc',
                                esc_html__( 'Small top Center right', 'pikoworks_custom_post' )  => 'stcr',
                            ),                
                            'heading'     => esc_html__( 'Next/Prev Button', 'pikoworks_custom_post' ),
                            'param_name'  => 'navigation_btn',
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_custom_post' ),
                            'dependency' => array('element'   => 'navigation', 'value'     => array( 'true' )),
                        ),
                        array(                
                            'type' => 'checkbox',                
                            "heading" => '',
                            'param_name' => 'btn_hover_show',
                            'value' => array(esc_html__('Hover show Next/Prev Button', 'pikoworks_custom_post') => 'sh'),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_custom_post' ),
                            'dependency' => array('element'   => 'navigation', 'value'     => array( 'true' )),
                        ),
                        array(                
                            'type' => 'checkbox',                
                            "heading" => '',
                            'param_name' => 'btn_light',
                            'value' => array(esc_html__('Button Light', 'pikoworks_custom_post') => 'al'),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_custom_post' ),
                            'dependency' => array('element'   => 'navigation', 'value'     => array( 'true' )),
                        ),            
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Yes', 'pikoworks_custom_post' ) => 'true',
                                esc_html__( 'No', 'pikoworks_custom_post' )  => 'false'
                            ),
                            'std'         => 'false',
                            'heading'     => esc_html__( 'Bullets', 'pikoworks_custom_post' ),
                            'param_name'  => 'dots',
                            'description' => esc_html__( "Show Carousel bullets bottom", 'pikoworks_custom_post' ),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_custom_post' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),
                            'admin_label' => true,
                        ),
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Yes', 'pikoworks_custom_post' ) => 'true',
                                esc_html__( 'No', 'pikoworks_custom_post' )  => 'false'
                            ),
                            'std'         => 'false',
                            'heading'     => esc_html__( 'AutoPlay', 'pikoworks_custom_post' ),
                            'param_name'  => 'autoplay',
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_custom_post' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),
                            'admin_label' => true,
                        ),
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Yes', 'pikoworks_custom_post' ) => 'true',
                                esc_html__( 'No', 'pikoworks_custom_post' )  => 'false'
                            ),
                            'std'         => 'false',
                            'heading'     => esc_html__( 'Loop', 'pikoworks_custom_post' ),
                            'param_name'  => 'loop',
                            'description' => esc_html__( "Inifnity loop. Duplicate last and first items to get loop illusion.", 'pikoworks_custom_post' ),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_custom_post' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),
                            'admin_label' => false,
                            ),            
                        array(
                            "type"        => "checkbox",
                            "heading"     => '',
                            "param_name"  => "margin",
                            'value' => array(esc_html__('No Gap', 'pikoworks_custom_post') => 'no-gap'),                
                            "description" => esc_html__('Distance( or space) between 2 item ', 'pikoworks_custom_post'),
                            'dependency' => array('element'   => 'is_slider', 'value'     => array( 'yes' )),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_custom_post' )
                                ),

                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Multiple item', 'pikoworks_custom_post' ) => 1,
                                esc_html__( 'Single item', 'pikoworks_custom_post' )  => 0
                            ),
                            'std'         => 1,
                            'heading'     => esc_html__( 'Carosuel type', 'pikoworks_custom_post' ),
                            'param_name'  => 'use_responsive',
                            'description' => esc_html__( "NB: Single item not working below option", 'pikoworks_custom_post' ),
                            'group'       => esc_html__( 'Responsive', 'pikoworks_custom_post' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),               
                        ),            
                        array(
                            "type"        => "dropdown",
                            "heading"     => esc_html__("Items large Device", 'pikoworks_custom_post'),
                            "param_name"  => "items_very_large_device",
                            'value' => array(2 => 2,3 => 3,4 => 4,6 => 6,),
                            'std'         => '4',
                            "description" => esc_html__('Screen resolution of device >= 1200px', 'pikoworks_custom_post'),                
                            'group'       => esc_html__( 'Responsive', 'pikoworks_custom_post' ),
                            'admin_label' => true,
                          ),            
                        array(
                            'type' => 'dropdown',
                            "heading"     => esc_html__("Items on Medium Device", 'pikoworks_custom_post'),
                            'param_name' => 'items_large_device',
                            'value' => array(2 => 2,3 => 3,4 => 4,6 => 6,),
                            'std'         => '4',
                            'description' => esc_html__('Resolution < 1200px || Tablet and Mobile auto fixed', 'pikoworks_custom_post'),                            
                            'group'       => esc_html__( 'Responsive', 'pikoworks_custom_post' ),
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
                            "heading"     => esc_html__( "Extra class name", 'pikoworks_custom_post' ),
                            "param_name"  => "el_class",
                            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks_core" ),
                        ),

                         array(
                            'type'           => 'css_editor',
                            'heading'        => esc_html__( 'Css', 'pikoworks_custom_post' ),
                            'param_name'     => 'css',
                            'group'          => esc_html__( 'Design options', 'pikoworks_custom_post' )
                        )			
		);
	}
}
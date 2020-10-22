<?php
/**
 * Custom heading for visual composer.
 */

function xtocky_vc_add_params_to_custom_heading() {
	vc_add_params(
		'vc_custom_heading',
		array(
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Shortcode Type', 'xtocky' ),
                        'param_name'    => 'type',
                        'value' => array(
                            esc_html__('Custom Heading', 'xtocky') => 'custom_heading',
                            esc_html__('Advance Banner', 'xtocky') => 'custom_banner',
                        ),
                        'std'           => 'custom_heading',
                        'description' => esc_html__('Two type shortcode custom Heading & Advance Banner ', 'xtocky'),
                        'admin_label' => true,
                        'weight'      => 1,
                    ),
                    array(
                        'heading'     => esc_html__( 'Enable divider?', 'xtocky' ),
                        'description' => esc_html__( 'Divider to left and right and divider after to bottom add a thin line of heading.', 'xtocky' ),
                        'type'        => 'dropdown',
                        'param_name'  => 'divider',
                        'weight'      => 1,
                        'value' => array(
                            esc_html__('None', 'xtocky') => '',
                            esc_html__('Divider', 'xtocky') => 'hline',
                            esc_html__('Divider after', 'xtocky') => 'hline_after',
                        ),
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_heading' )), 
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'heading' => esc_html__('Banner Image', 'xtocky'),
                        'weight'      => 1,
                        'description' => esc_html__('The Image size as you want if use grid column use same size', 'xtocky'),
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_banner' )), 
                        
                    ),  
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Banner Ttile Position', 'xtocky' ),
                        'param_name'    => 'title_position',
                        'admin_label' => true, 
                        'weight'      => 1,
                        'value' => array(
                            esc_html__('Center Center', 'xtocky') => 'center',
                            esc_html__('Center Top', 'xtocky') => 'center-top',
                            esc_html__('Center Bottom', 'xtocky') => 'center-bottom',
                            esc_html__('Right Center', 'xtocky') => 'right-center',
                            esc_html__('Right Top', 'xtocky') => 'right-top',                        
                            esc_html__('Right Bottom', 'xtocky') => 'right-bottom',
                            esc_html__('Left Center', 'xtocky') => 'left-center',
                            esc_html__('Left top', 'xtocky') => 'left-top',
                            esc_html__('Left bottom', 'xtocky') => 'left-bottom',
                        ),
                        'group'          => esc_html__( 'Advance Banner', 'xtocky' ),
                        'std'           => 'center',
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_banner' )), 
                    ),
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Main Title Font size', 'xtocky' ),
                        'param_name'    => 'title_font_size',
                        'admin_label' => true, 
                        'weight'      => 1,
                        'value' => array(
                            'default' => '',
                            'Size: 60px' => 'fs60',
                            'Size: 48px' => 'fs48', 
                            'Size: 38px' => 'fs38',
                            'Size: 36px' => 'fs36',
                            'Size: 30px' => 'fs30',
                            'Size: 25px' => 'fs25',
                            'Size: 20px' => 'fs20',
                        ),
                        'description' => esc_html__( 'NB: Dont set general -> Font size. Set fixed font size here font Responsive issue ', 'xtocky' ),                         
                    ),
                    array(
                        'param_name'  => 'title_font_weight',
                        'heading'     => esc_html__( 'Main title font Weight', 'xtocky' ),
                        'type'        => 'pikoworks_number',
                        'value'      => '600',
                        'weight'      => 1,
                        'description' => esc_html__( 'like as: 400, 500, 600, 900', 'xtocky' ),
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_banner' )),
                    ),
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Sub Title Font size', 'xtocky' ),
                        'param_name'    => 'sub_title_font_size',
                        'admin_label' => true, 
                        'weight'      => 1,
                        'value' => array(
                            'Size: 14px' => 'fs14',
                            'Size: 16px' => 'fs16',
                            'Size: 20px' => 'fs20',
                            'Size: 25px' => 'fs25',
                            'Size: 30px' => 'fs30',
                            'Size: 36px' => 'fs36',
                            'Size: 38px' => 'fs38',
                            'Size: 48px' => 'fs48',
                            'Size: 60px' => 'fs60',
                        ),
                        'group'          => esc_html__( 'Advance Banner', 'xtocky' ),
                        'std'           => 'fs20',
                        'description' => esc_html__( 'NB: Responsive issue ', 'xtocky' ),
                        'dependency' => array('element'   => 'type','value' => array( 'custom_banner' )), 
                    ),
                    array(
                        'heading'     => esc_html__( 'Sub Title below Main title', 'xtocky' ),
                        'type'        => 'checkbox',
                        'param_name'  => 'below_title',
                        'weight'      => 1,
                        'value'       => array(
                                esc_html__( 'Yes', 'xtocky' ) => 'yes'
                        ),
                        'group'          => esc_html__( 'Advance Banner', 'xtocky' ),
                        'dependency' => array('element'   => 'type','value' => array( 'custom_banner' )), 
                    ),
                    array(
                            'param_name'  => 'sub_title',
                            'heading'     => esc_html__( 'Sub Title', 'xtocky' ),
                            'description' => esc_html__( 'It shows after the heading', 'xtocky' ),
                            'type'        => 'textarea',
                            'weight'      => 1,
                    ),
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Sub Title Font Family', 'xtocky' ),
                        'param_name'    => 'sub_title_font',
                        'weight'      => 1,
                        'value' => array(
                            'Theme Default' => '',
                            'PlayFair Display' => 'ff3',
                        ),                       
                        'std'           => 'ff3',
                    ),
                    array(
                        'heading'     => esc_html__( 'Sub title shows after Main title', 'xtocky' ),
                        'type'        => 'checkbox',
                        'param_name'  => 'sub_title_before',
                        'weight'      => 1,
                        'value'       => array(
                                esc_html__( 'Yes', 'xtocky' ) => 'yes'
                        ),
                        'group'          => esc_html__( 'Advance Banner', 'xtocky' ),
                        'dependency' => array('element'   => 'type','value' => array( 'custom_banner' )), 
                    ),                    
                    array(
                        'heading'       => esc_html__( 'Sub Title font color', 'xtocky' ),
                        'type'          => 'colorpicker',                    
                        'param_name'    => 'sub_font_color',
                        'weight'      => 1,
                        'group'          => esc_html__( 'Advance Banner', 'xtocky' ),
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_banner' )),
                    ),
                    array(
                        'param_name'  => 'sub_font_weight',
                        'heading'     => esc_html__( 'Sub Title font Weight', 'xtocky' ),
                        'type'        => 'pikoworks_number',
                        'weight'      => 1,
                        'description' => esc_html__( 'like as: 600, 900 etc', 'xtocky' ),
                        'group'          => esc_html__( 'Advance Banner', 'xtocky' ),
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_banner' )),
                    ),
                    array(
                        'heading'       => esc_html__( 'Sub Title font style italic', 'xtocky' ),
                        'type'        => 'checkbox',
                        'param_name'  => 'sub_font_italic',
                        'weight'      => 1,
                        'value'       => array(
                                esc_html__( 'Yes', 'xtocky' ) => 'italic'
                        ),
                        'weight'      => 1,
                        'group'          => esc_html__( 'Advance Banner', 'xtocky' ),
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_banner' )),
                    ),
                    array(
                        'heading' => esc_html__('Link Button Style', 'xtocky'),
                        'type' => 'dropdown',
                        'param_name' => 'banner_btn',
                        'weight' => 1,
                        'value' => array(
                            'None' => 'none',
                            'Button' => 'd_btn',
                            'Line Button' => 'line_button',
                        ),
                        'std'           => 'd_btn',
                        'dependency' => array('element' => 'type', 'value' => array('custom_banner')),
                    ),
		)
	);
}
add_action( 'vc_after_init', 'xtocky_vc_add_params_to_custom_heading' );
<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $source
 * @var $text
 * @var $link
 * @var $google_fonts
 * @var $font_container
 * @var $el_class
 * @var $el_id
 * @var $css
 * @var $css_animation
 * @var $font_container_data - returned from $this->getAttributes
 * @var $google_fonts_data - returned from $this->getAttributes
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
$source = $text = $sub_title = $link = $google_fonts = $font_container = $el_id = $el_class = $css = $css_animation = $font_container_data = $google_fonts_data = $divider = $type
       = $title_font_weight = $image = $title_position = $title_font_size = $below_title = $sub_title_before = $sub_title_font_size = $sub_title_font = $sub_font_color = $sub_font_weight = $sub_font_italic = '';
// This is needed to extract $font_container_data and $google_fonts_data
extract( $this->getAttributes( $atts ) );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if ( $divider == 'hline' ) {
	$divider = 'pa_ba h-line';
}elseif($divider == 'hline_after'){
    $divider = 'pa_b h-line_after';
    
}

/**
 * @var $css_class
 */
extract( $this->getStyles( $el_class . $this->getCSSAnimation( $css_animation ) . $divider, $css, $google_fonts_data, $font_container_data, $atts ) );

$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
} else {
	$subsets = '';
}

if ( ( ! isset( $atts['use_theme_fonts'] ) || 'yes' !== $atts['use_theme_fonts'] ) && isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}
$title_font_weight = trim( $title_font_weight ) != '' ? 'font-weight:' . esc_attr( $title_font_weight ) . ';' : '';
if ( ! empty( $styles ) ) {
	$style = 'style="' .$title_font_weight . esc_attr( implode( ';', $styles ) ) . '"';
} else {
	$style = '';
}

if ( 'post_title' === $source ) {
	$text = get_the_title( get_the_ID() );
}
$btn_before = $btn_after = $btn_title = '';
$sub_font_color = trim( $sub_font_color ) != '' ? 'color:' . esc_attr( $sub_font_color ) . ';' : '';
if ( ! empty( $link ) ) {
	$link = vc_build_link( $link );
        if($type == 'custom_heading'){
           $text = '<a href="' . esc_url( $link['url'] ) . '"' . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' ) . ( $link['rel'] ? ' rel="' . esc_attr( $link['rel'] ) . '"' : '' ) . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' ) . '>' . $text . '</a>';
        }
        $btn_before = '<a href="' . esc_url( $link['url'] ) . '"' . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' ) . ( $link['rel'] ? ' rel="' . esc_attr( $link['rel'] ) . '"' : '' ) . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' ) . '>';
        $btn_after = '</a>';
        
        $extra = '';
        if ( $sub_title_before == '' || empty($sub_title)  ) {
            $extra ='<br>';
        } 
        if ( $text == '' ) {
            $extra ='';
        } 
        if($banner_btn !== 'none'){
            $btn_title = $extra .'<a href="' . esc_url( $link['url'] ) . '" class="banner-btn '.esc_attr($banner_btn).'" style="'.esc_attr($sub_font_color).'">'. $link['title'] .'</a>';
        }
}
$title_before = $title_after = $sub_style =  $below_before = $below_after ='';
$sub_font_weight = trim( $sub_font_weight ) != '' ? 'font-weight:' . esc_attr( $sub_font_weight ) . ';' : '';
$sub_font_italic = trim( $sub_font_italic ) != '' ? 'font-style:' . esc_attr( $sub_font_italic ) .';' : '';
if ( ( $sub_font_color  || $sub_font_weight || $sub_font_italic) != '' ) {
    $sub_style = 'style="' .  esc_attr($sub_font_color.$sub_font_weight.$sub_font_italic) .  '"';
}

if ( $sub_title && $sub_title_before == 'yes') {
    $title_after = '<span class="sub-title '. esc_attr($sub_title_font .' ' .$sub_title_font_size).'" '.$sub_style.'>' . $sub_title . '</span>';
}elseif($sub_title){     
     $title_before = '<span class="sub-title '. esc_attr($sub_title_font .' ' .$sub_title_font_size).'" '.$sub_style.'>' . $sub_title . '</span>';
}
if ( $below_title == 'yes') {
    $below_before = '<span class="title-below fs150" >';
    $below_after = '</span>';
}
//elseif($sub_title){
//     $below_after = '</span>';
//}


$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output = '';
if($type == 'custom_heading'){
    if ( apply_filters( 'vc_custom_heading_template_use_wrapper', false ) ) {
            $output .= '<div class="' . esc_attr( $css_class ) . '" ' . implode( ' ', $wrapper_attributes ) . '>';
            $output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' class"'.esc_attr( $title_font_size ).'">';
            $output .= $text;
            if ( $sub_title ) {
                    $output .= '<span class="sub-title '. esc_attr($sub_title_font).'" >' . $sub_title . '</span>';
            }
            $output .= '</' . $font_container_data['values']['tag'] . '>';
            $output .= '</div>';
    } else {
            $output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' class="' . esc_attr( $css_class. ' ' .$title_font_size ) . '" ' . implode( ' ', $wrapper_attributes ) . '>';
            $output .= $text;
            if ( $sub_title ) {
                    $output .= '<span class="sub-title '. esc_attr($sub_title_font).'" >' . $sub_title . '</span>';
            }
            $output .= '</' . $font_container_data['values']['tag'] . '>';
    }
}else{
    $output .= '<div class="block-wrap ' . esc_attr( $css_class) . '" ' . implode( ' ', $wrapper_attributes ) . '> <figure class="block-box">';
    $output .= '<div class="block-header ' . esc_attr($title_position) . '">';
    $output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . '  class="'. esc_attr($title_font_size) .'">';
    $output .= $title_before;
    $output .= $below_before;
    $output .= $text;
    $output .= $below_after;
    $output .= $title_after;
   
    $output .= $btn_title;
    $output .= '</' . $font_container_data['values']['tag'] . '>';    
    $output .= '</div>';
    $output .= $btn_before;    
    if( $image && $thumbnail = wp_get_attachment_image( $image, 'full') ){   
      $output .= wp_kses_post( $thumbnail, true );          
    } 
    $output .= $btn_after;
    $output .= '</figure></div>';
}
echo do_shortcode( $output);

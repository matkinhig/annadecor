<?php
/**
 * @ brand logo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'init', 'pikoworks_brand_logo' );
function pikoworks_brand_logo(){
// Setting shortcode lastest
$params = array(
    "name"        => esc_html__( "Brand logo", 'pikoworks_core'),
    "base"        => "brand_logo",
    "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
    "description" => esc_html__( "Client/image slide", 'pikoworks_core'),
     'params'      => array_merge(array(
        array(
                'type' => 'attach_images',
                'heading' => esc_html__( 'Images', 'pikoworks_core' ),
                'param_name' => 'images',
                'value' => '',
                'description' => esc_html__( 'Select images from media library.', 'pikoworks_core' ),
        ),
        array(
                'type' => 'textfield',
                'heading' => esc_html__( 'image size', 'pikoworks_core' ),
                'param_name' => 'img_size',
                'value' => 'full',
                'admin_label' => true,
                'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, or full is sizes defined by current image size. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" is image size.', 'pikoworks_core' ),
        ),
        array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'On click action', 'pikoworks_core' ),
                'param_name' => 'onclick',
                'value' => array(
                        esc_html__( 'None', 'pikoworks_core' ) => 'link_no',
                        esc_html__( 'Open Light box', 'pikoworks_core' ) => 'link_image',                        
                        esc_html__( 'Open custom links', 'pikoworks_core' ) => 'custom_link',
                ),
                'description' => esc_html__( 'Select action for click event.', 'pikoworks_core' ),
        ),
        array(
                'type' => 'exploded_textarea_safe',
                'heading' => esc_html__( 'Custom links', 'pikoworks_core' ),
                'param_name' => 'custom_links',
                'description' => esc_html__( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'pikoworks_core' ),
                'dependency' => array(
                        'element' => 'onclick',
                        'value' => array( 'custom_link' ),
                ),
        ),
        array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Custom link target', 'pikoworks_core' ),
                'param_name' => 'custom_links_target',
                'description' => esc_html__( 'Select how to open custom links.', 'pikoworks_core' ),
                'dependency' => array(
                        'element' => 'onclick',
                        'value' => array( 'custom_link' ),
                ),
                'value' => array(
                    esc_html__( 'Same window', 'pikoworks_core' ) => '_self',
                    esc_html__( 'New window', 'pikoworks_core' )  => '_blank'
                ),
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
    ),pikoworks_get_slider_params_enable())
);
vc_map($params);
}
class WPBakeryShortCode_brand_logo extends WPBakeryShortCode { 
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'brand_logo', $atts ) : $atts;
        $atts = shortcode_atts( array( 
            'onclick'   => '',      
            'custom_links'   => '',
            'custom_links_target'   => '', 
            'img_size'   => 'full', 
            'images'   => '',
            'link_image' => '',             
            
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
            'items_very_large_device'   => 4,
            'items_large_device'   => 4,
            'items_mobile_device'   => 1,
            
            'el_class' => '',
            'css'           => '',
            
            
        ), $atts );
        extract($atts);
        
        
        $css_class = 'sc-brand hsc ' . $el_class;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;

         

        
        if ( '' === $images ) {
                $images = '-1,-2,-3';
        }

        if ( 'custom_link' === $onclick ) {
                $custom_links = vc_value_from_safe( $custom_links );
                $custom_links = explode( ',', $custom_links );
        }

        $images = explode( ',', $images );
        $i = - 1;    

        
        ob_start();
       
           
        $popup = '';
        if ( 'link_image' === $onclick ) {
          $popup = 'popup-gallery';  
        }
         $col_md = round(12/$items_large_device);                                
        if($items_large_device == '4'){
          $col_sm =  ($col_md + 1);  
        }elseif($items_large_device == '3'){
            $col_sm =  ($col_md + 2); 
        }elseif($items_large_device == '6'){
            $col_sm =  ($col_md + 1); 
        }else{
            $col_sm =  $col_md; 
        }                                

        $large_device = round(12 / $items_very_large_device);
        if ($items_very_large_device == '5') {
            $large_device = '20';
        }                                
    
        if( ! pikoworks_is_mobile() ){ 
            $col_class[] = 'col-lg-'.$large_device;
            $col_class[] = 'col-md-'.$col_md;
            $col_class[] = 'col-sm-'.$col_sm;
            $col_class = esc_attr( implode(' ', $col_class) );
        }
        if( $is_slider == 'yes' && $use_responsive == '0' || pikoworks_is_mobile()){
             $col_class = 'col-xs-12';
        }
         if(pikoworks_is_mobile() && $navigation = 'true' ){  
            $navigation = 'false'; 
            $dots = 'true';
        }

        $slide_class = 'piko-carousel-grid row';
        $data_slick = '';
        if($is_slider == 'yes' || pikoworks_is_mobile()){
            $slide_class = 'piko-carousel' . ' ' . $navigation_btn . ' ' . $btn_light. ' ' . $btn_hover_show.' '.$margin;                                     

            $res_large = $use_responsive ? '"slidesToShow":'.esc_attr($items_very_large_device).', "slidesToScroll": 1,' : '';
            $res_media = $use_responsive ? ',"responsive":[{"breakpoint": 1200,"settings":{"slidesToShow":'.esc_attr($items_very_large_device).'}},{"breakpoint": 1199,"settings":{"slidesToShow":'.esc_attr($items_large_device).'}},{"breakpoint": 768,"settings":{"slidesToShow": 2}},{"breakpoint": 576,"settings":{"slidesToShow": '.esc_attr($items_mobile_device).'}}]' : '';

            $data_slick = '{'.$res_large.'"arrows":'.esc_attr($navigation).',"dots":'.esc_attr($dots).',"infinite":'.esc_attr($loop).',"autoplay":'.esc_attr($autoplay).$res_media.'}';                                   
        }
           
          
           
            ?>
            <div class="<?php echo esc_attr( $css_class ) ?>" >
                <div class="<?php echo esc_attr( $slide_class . ' ' . $popup) ?>" data-slick='<?php echo  $data_slick; ?>'>    
                    
                    <?php foreach ( $images as $attach_id ) :  ?>
                        <?php

                        $i ++;
                        if ( $attach_id > 0 ) {
                                $post_thumbnail = wpb_getImageBySize( array(
                                        'attach_id' => $attach_id,
                                        'thumb_size' => $img_size,
                                ) );
                        } else {
                                $post_thumbnail = array();
                                $post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
                                $post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );                                
                        }
                        $thumbnail = $post_thumbnail['thumbnail'];
                        $thumb = wp_get_attachment_image_src($attach_id, 'thumbnail');
                        ?>

                        <figure class="<?php esc_attr_e($col_class);?>">  
                            <?php if ( 'link_image' === $onclick ) :  ?>
                                    <?php $p_img_large = $post_thumbnail['p_img_large']; ?>
                                    <?php $p_thumb = $post_thumbnail['thumbnail']; ?>
                                    <a href="<?php echo esc_url($p_img_large[0]) ?>" data-thumb="<?php echo esc_url($thumb[0]) ?>" class="zoom-btn icon">
                                        <?php echo $thumbnail ?>
                                    </a>                                    
                            <?php elseif ( 'custom_link' === $onclick && isset( $custom_links[ $i ] ) && '' !== $custom_links[ $i ] ) :  ?>
                                    <a href="<?php echo $custom_links[ $i ] ?>"<?php echo( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) ?>>
                                            <?php echo $thumbnail; ?>
                                    </a>
                            <?php else : ?>
                                    <?php echo $thumbnail; ?>


                            <?php endif ?>                        
                        </figure>                
                    <?php endforeach ?>
                    
                </div>
                
            </div>
            <?php       
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }    
    
}
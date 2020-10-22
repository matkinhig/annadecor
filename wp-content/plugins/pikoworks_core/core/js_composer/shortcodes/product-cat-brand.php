<?php
/**
 * @author  themepiko
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'init', 'pikoworks_product_brand' );
function pikoworks_product_brand(){
// Setting shortcode lastest
$params = array(
    "name"        => esc_html__( "Product Cats/Brand", 'pikoworks-core'),
    "base"        => "pikoworks_product_brand",
    "category"    => esc_html__('Pikoworks', 'pikoworks-core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
    "description" => esc_html__( "Show product Categories", 'pikoworks-core'),
    'params'      => array_merge(array(   
          array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Select Category Type', 'pikoworks-core' ),
            'param_name'    => 'category_type',
            'value' => array(
                esc_html__('Product Category', 'pikoworks-core') => 'product_cat',
                esc_html__('Product Band', 'pikoworks-core') => 'brand',
            ),
            'std'           => 'product_cat',
            "description" => esc_html__("NB: Type Menu, not working Responsive carousel setting ",'pikoworks-core'),  
            'admin_label' => true,  
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Layout', 'pikoworks-core' ),
            'param_name'    => 'layout_type',
            'value' => array(
                esc_html__('Default', 'pikoworks-core') => '1',
                esc_html__('Layout 2', 'pikoworks-core') => '2',
            ), 
        ),
        array(                
            'type' => 'checkbox',                
            "heading" => '',
            'param_name' => 'layout2_cols',
            'value' => array(esc_html__('Layout 2 default 10 Column check to 6 column ', 'pikoworks_core') => 'yes6cols'),
            'dependency' => array('element'   => 'layout_type', 'value'     => array( '2' )),
        ),
          array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Select Type', 'pikoworks-core' ),
            'param_name'    => 'type',
            'value' => array(
                esc_html__('Menu', 'pikoworks-core') => 'name',
                esc_html__('Image', 'pikoworks-core') => 'image',
            ),
            'std'           => 'image',
            'admin_label' => true,  
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Image Size", 'pikoworks-core' ),
            "param_name"  => "img_size",
            'value' => '100x100',
            "description" => esc_html__( "NB: size size should be like this: 100x100 | Image collect from category thumbnail", "pikoworks-core" ),
            'dependency' => array('element'   => 'type', 'value'     => array( 'image' )),
        ),
        array(                
            'type' => 'checkbox',                
            "heading" => '',
            'param_name' => 'brand_name',
            'value' => array(esc_html__('Enable brand Name?', 'pikoworks_core') => 'yes')
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Count before title", 'pikoworks-core' ),
            "param_name"  => "brand_title",
            'value' => esc_html__( 'item', 'pikoworks-core' ),
            'dependency' => array('element'   => 'brand_name', 'value'     => array( 'yes' )),
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Order by", 'pikoworks-core'),
            "param_name" => "orderby",
            "value"      => array(
        	esc_html__('None', 'pikoworks-core')     => 'none',
                esc_html__('ID', 'pikoworks-core')       => 'ID',
                esc_html__('Author', 'pikoworks-core')   => 'author',
                esc_html__('Name', 'pikoworks-core')     => 'name',
                esc_html__('Date', 'pikoworks-core')     => 'date',
                esc_html__('Modified', 'pikoworks-core') => 'modified',
                esc_html__('Rand', 'pikoworks-core')     => 'rand',
        	),
            'std'         => 'ID',
            "description" => esc_html__("Select how to sort retrieved posts.",'pikoworks-core')
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Order", 'pikoworks-core'),
            "param_name" => "order",
            "value"      => array(
                esc_html__( 'Descending', 'pikoworks-core' ) => 'DESC',
                esc_html__( 'Ascending', 'pikoworks-core' )  => 'ASC'
        	),
            'std'         => 'DESC',
            "description" => esc_html__("Designates the ascending or descending order.",'pikoworks-core')
        ),
        array(                
            'type' => 'checkbox',                
            "heading" => '',
            'param_name' => 'hide_empty',
            'value' => array(esc_html__('Hide Empty', 'pikoworks_core') => '1'),
            'description' => esc_html__( "Terms not assigned to any posts", 'pikoworks-core' ),
        ),
        array(                
            'type' => 'checkbox',                
            "heading" => '',
            'param_name' => 'pad_count',
            'value' => array(esc_html__('Count', 'pikoworks_core') => '1'),
            'description' => esc_html__( "The Quantity of a term\'s children in the quantity of each term\'s count", 'pikoworks-core' ),
        ),        
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Extra class name", 'pikoworks-core' ),
            "param_name"  => "el_class",
            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks-core" ),
        ),
         array(
            'type'           => 'css_editor',
            'heading'        => esc_html__( 'Css', 'pikoworks-core' ),
            'param_name'     => 'css',
            'group'          => esc_html__( 'Design options', 'pikoworks-core' )
	)
    ),pikoworks_get_slider_params_enable())
);
vc_map($params);
}
class WPBakeryShortCode_pikoworks_product_brand extends WPBakeryShortCode { 
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'pikoworks_product_brand', $atts ) : $atts;
        $atts = shortcode_atts( array(
            'category_type' => 'product_cat',
            'layout_type' => '',
            'layout2_cols' => '',
            'type' => '',
            'img_size' => '',
            'pad_count' => '',
            'order' => 'DESC',
            'orderby' => 'ID',
            'hide_empty' => '0',
            'brand_name' => '',
            'brand_title' => '',
            'el_class' => '',
            
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
            
            'css'           => '',
            
            
        ), $atts );
        extract($atts);
        
        $css_class = 'sc-brand hsc sip ' . $el_class;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;

      
        
        ob_start();        
        
        if ( class_exists('WooCommerce') ) :
            
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
        
        if(pikoworks_is_mobile()){
            $navigation = 'false';
            $dots = 'true';
            
        }
        

        $slide_class = 'piko-carousel-grid ' . 'cat-grid-'.$layout_type .' '. $layout2_cols ;
        $data_slick = '';
        if($is_slider == 'yes' || pikoworks_is_mobile()){
            $slide_class = 'piko-carousel' . ' ' . $navigation_btn . ' ' . $btn_light. ' ' . $btn_hover_show.' '.$margin;                                     

            $res_large = $use_responsive ? '"slidesToShow":'.esc_attr($items_very_large_device).', "slidesToScroll": 2,' : '';
            $res_media = $use_responsive ? ',"responsive":[{"breakpoint": 1200,"settings":{"slidesToShow":'.esc_attr($items_very_large_device).'}},{"breakpoint": 1199,"settings":{"slidesToShow": '.esc_attr($items_large_device).'}},{"breakpoint": 768,"settings":{"slidesToShow": 2}},{"breakpoint": 576,"settings":{"slidesToShow": '.esc_attr($items_mobile_device).'}}]' : '';

            $data_slick = '{'.$res_large.'"arrows":'.esc_attr($navigation).',"dots":'.esc_attr($dots).',"infinite":'.esc_attr($loop).',"autoplay":'.esc_attr($autoplay).''.$res_media.'}';                                   
        }
           
            $hide_empty = ($hide_empty == 1) ? true : false;
            $args = array(
                'taxonomy' => $category_type,
                'hide_empty' => $hide_empty,
                'orderby'    => esc_attr($orderby),
                'order'      => esc_attr($order),
                'parent'      => 0,
                'hierarchical' => true,
            );
            $terms =  new WP_Term_Query($args);
            
            $img_size = explode( 'x', $img_size  );           
            
            ?>
            <div class="<?php echo esc_attr( $css_class ); ?>"> 
                <div class="<?php echo esc_attr( $slide_class); if($type == 'name') echo ' widget widget_product_categories'; ?>" data-slick='<?php echo  $data_slick; ?>'>    
                    <?php                    
                    if ( $type == 'name' ) {?>
                    <ul class="product-categories">
                        <?php foreach ($terms->terms as $brand):
                         $countProd = ($pad_count == 1) ? "<span class='count'>(" . esc_html($brand->count) .")</span>" : '';   
                        ?>
                        <li class="cat-item"><a href="<?php echo esc_url(get_term_link($brand)); ?>"><?php echo esc_html($brand->name) . balanceTags($countProd); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php
                    }else{
                        foreach ($terms->terms as $brand):
                        $thumbnail_id = absint(get_term_meta($brand->term_id, 'thumbnail_id', true));
                        $brandImg = wp_get_attachment_image($thumbnail_id, $img_size );
                        $countProd = ($pad_count == 1) ? "<span class='count pact'>" . esc_html($brand->count) ."</span>" : '';  
                        if (!empty( $brandImg )) { ?>
                        <figure class="brand-cat">
                            <?php if($layout_type == 2): ?>
                            <a href="<?php echo esc_url(get_term_link($brand)); ?>">
                                <?php echo $brandImg; ?>
                                 <?php 
                                 if($brand_name == 'yes'){
                                     echo '<div class="meta-after">'.esc_html($brand->name).'</div>';
                                 }  else {
                                   echo balanceTags($countProd); 
                                 }
                                ?>
                            </a>
                            <?php else: ?>
                            <a class="pr" href="<?php echo esc_url(get_term_link($brand)); ?>" title="<?php echo esc_html($brand->name) . ' (' . esc_html($brand->count) . ')'; ?>">
                                <?php echo $brandImg; ?>
                                 <?php 
                                 if($brand_name == 'yes'){
                                     echo '<div class="brand-cat-meta"><h4>'.esc_html($brand->name).' <span>'.esc_html( $brand_title . ' (' . $brand->count).')</span></h4></div>';
                                 }  else {
                                   echo balanceTags($countProd);  
                                 }
                                ?>
                            </a>
                            <?php endif; //$layout_type ?>
                        </figure>
                        <?php }
                        endforeach; 
                    }
                    woocommerce_reset_loop();
                    ?>
                </div>
            </div>
            <?php
            
        endif;     

        $result = ob_get_contents();
        ob_clean();
        return $result;
    }    
    
}
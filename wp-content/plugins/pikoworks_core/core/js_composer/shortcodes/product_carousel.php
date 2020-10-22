<?php
/**
 * @Products carousel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_product_carousel' );
function pikoworks_product_carousel(){
 
   global $pikoworks_vc_anim_effects_in;
// Setting shortcode lastest
vc_map( array(
    "name"        => esc_html__( "Product Carousel", 'pikoworks_core'),
    "base"        => "product_carousel",
    "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
    "description" => esc_html__( "Products 2x carousel", 'pikoworks_core'),
    "params"      => array(                
        array(
            "type"        => "pikoworks_taxonomy",
            "taxonomy"    => "product_cat",
            "heading"     => esc_html__("Display product certain category", 'pikoworks_core'),
            "param_name"  => "taxonomy",
            "value"       => '',
            'parent'      => '',
            'multiple'    => true,
            'hide_empty'  => false,
            'placeholder' => esc_html__('Choose categoy', 'pikoworks_core'),
            "description" => esc_html__("Note: If you want to narrow output, select category(s) above. Only selected categories will be displayed. else leave it", 'pikoworks_core')
        ),
        
            
            array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__( 'Product Style', 'pikoworks_core' ),
                    'param_name'    => 'product_layout',
                    'value' => array(
                        esc_html__('Layout 01', 'pikoworks_core') => '1',                       
                        esc_html__('Layout 03', 'pikoworks_core') => '3',
                    ),
                    'std'           => '1',                    
                    "admin_label" => true,
                    'dependency' => array( 'element'   => 'carousel_layout', 'value'     => array( '1', '2')), 
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'carousel_layout',
                'heading' => esc_html__('Carousel style', 'pikoworks_core'),
                'value' => array(
                        esc_html__( 'Version 1', 'pikoworks_core' ) => '1',
                        esc_html__( 'Version 2', 'pikoworks_core' )  => '2',
                ),
                "admin_label" => true,
            ),            
            array(
                'type' => 'dropdown',
                'param_name' => 'per_page',
                'heading' => esc_html__('Post Load', 'pikoworks_core'),
                'description'   => esc_html__('Default load 9 product', 'pikoworks_core'),
                'value' => array(
                        esc_html__( '9', 'pikoworks_core' ) => '9',
                        esc_html__( '10', 'pikoworks_core' )  => '10',
                        esc_html__( '14', 'pikoworks_core' )  => '14',
                        esc_html__( '15', 'pikoworks_core' )  => '15',
                        esc_html__( '19', 'pikoworks_core' )  => '19',
                        esc_html__( '20', 'pikoworks_core' )  => '20',
                ),
                "admin_label" => true,
            ),
            array(
                'type' => 'dropdown',
                "heading"     => esc_html__("Items on Mobile Device", 'pikoworks_core'),
                'param_name' => 'items_mobile_device',
                'value' => array(1 => 1,2 => 2),
                'std'         => '1',
                'description' => esc_html__('Resolution < 767px', 'pikoworks_core'),
                'admin_label' => true,
            ),
            array(
                'type'  => 'dropdown',
                'value' => array(
                    esc_html__( 'Yes', 'pikoworks_core' ) => 'true',
                    esc_html__( 'No', 'pikoworks_core' )  => 'false'
                ),
                'std'         => 'true',
                'heading'     => esc_html__( 'Navigation', 'pikoworks_core' ),
                'param_name'  => 'navigation',
                'description' => esc_html__( "Show buton 'next' and 'prev' buttons.", 'pikoworks_core' ),
                'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                'admin_label' => true,
            ),                           
            array(
                'type'  => 'dropdown',
                'value' => array(
                    esc_html__( 'Center', 'pikoworks_core' ) => '',
                    esc_html__( 'Top Center', 'pikoworks_core' )  => 'tc',
                    esc_html__( 'Small Center', 'pikoworks_core' )  => 'sc',
                    esc_html__( 'Small top Center right', 'pikoworks_core' )  => 'stcr',
                ),                
                'heading'     => esc_html__( 'Next/Prev Button', 'pikoworks_core' ),
                'param_name'  => 'navigation_btn',
                'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                'dependency' => array('element'   => 'navigation', 'value'     => array( 'true' )),
            ),
            array(                
                'type' => 'checkbox',                
                "heading" => '',
                'param_name' => 'btn_hover_show',
                'value' => array(esc_html__('Hover show Next/Prev Button', 'pikoworks_core') => 'sh'),
                'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                'dependency' => array('element'   => 'navigation', 'value'     => array( 'true' )),
            ),
            array(                
                'type' => 'checkbox',                
                "heading" => '',
                'param_name' => 'btn_light',
                'value' => array(esc_html__('Button Light', 'pikoworks_core') => 'al'),
                'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                'dependency' => array('element'   => 'navigation', 'value'     => array( 'true' )),
            ), 
            array(
                'type'  => 'dropdown',
                'value' => array(
                    esc_html__( 'Yes', 'pikoworks_core' ) => 'true',
                    esc_html__( 'No', 'pikoworks_core' )  => 'false'
                ),
                'std'         => 'false',
                'heading'     => esc_html__( 'Loop', 'pikoworks_core' ),
                'param_name'  => 'loop',
                'description' => esc_html__( "Inifnity loop. Duplicate last and first items to get loop illusion.", 'pikoworks_core' ),
                'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                'admin_label' => false,
            ),
            array(
                'type'  => 'dropdown',
                'value' => array(
                    esc_html__( 'Yes', 'pikoworks_core' ) => 'true',
                    esc_html__( 'No', 'pikoworks_core' )  => 'false'
                ),
                'std'         => 'false',
                'heading'     => esc_html__( 'AutoPlay', 'pikoworks_core' ),
                'param_name'  => 'autoplay',
                'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                'admin_label' => true,
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__( "Extra class name", 'pikoworks_core' ),
                "param_name"  => "el_class",
                "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" ),
            ),    
            array(
                'type' => 'css_editor',
                'heading' => esc_html__('Css', 'pikoworks_core'),
                'param_name' => 'css',
                'group' => esc_html__('Design options', 'pikoworks_core')
            ),
         
    )
));
}
class WPBakeryShortCode_product_carousel extends WPBakeryShortCode { 
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'product_carousel', $atts ) : $atts;
        $atts = shortcode_atts( array(
        'taxonomy'       => '', 
	'product_layout' => '1',
	'carousel_layout' => '1',
	'items_mobile_device' => '1',
        'per_page' => '9',
            
        'autoplay'      => "false",
        'loop'          => "false",
        'navigation'    => "true",
        'navigation_btn' => '',
        'btn_hover_show'    => '',
        'btn_light'    => '',
            
        'el_class'     =>  '',
        'css' => ''           
            
        ), $atts );
        extract($atts);
        
    $css_class = 'products-grid sip big-carousel-' . $product_layout  . ' ' . $el_class ;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;
    
//product type
$new_q = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => esc_attr( $per_page ),                        
);
if( $taxonomy ){
    $new_q['tax_query'] = 
        array(
                array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => explode( ",", $taxonomy )
        )
    );
}
//v1 class
$double_size = "width:235px";
if($carousel_layout == '1'){
   $double_size = "width:526px"; 
}

//for mobile 2 cloumn
$row_mobile =  '';
if($items_mobile_device == '2'){
    $row_mobile = 'mobile';
}
  
        ob_start();
        
        remove_action( 'xtocky_after_shop_loop_item_title', 'xtocky_wc_template_loop_product_button_action', 15 );
             
        $post_count = 0;
        $slide_class = 'piko-carousel '. $navigation_btn . ' ' . $btn_light. ' ' . $btn_hover_show;  
        $data_slick = '{"arrows":'.esc_attr($navigation).',"infinite":'.esc_attr($loop).',"autoplay":'.esc_attr($autoplay).',"variableWidth": true,"responsive":[{"breakpoint": 768,"settings":{"slidesToShow": 2,"variableWidth": false}},{"breakpoint": 480,"settings":{"slidesToShow": '.esc_attr($items_mobile_device).',"variableWidth": false}}]}';
            
        ?>

            <div class="<?php echo esc_attr( $css_class .' '. $row_mobile ) ?>">
                
                <div class="<?php echo esc_attr($slide_class) ?>" data-slick='<?php echo $data_slick ?>'>
                        <div class="slick-slide" style="<?php echo esc_attr($double_size)?>">
                              <?php
                               $product = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $new_q, $atts ) );
                            if ( $product->have_posts() ) {
                                    while ( $product->have_posts() ) : $product->the_post();
                                    $post_count++;                                    
                                    if($carousel_layout === '1'){
                                        $double_class = "";
                                        if($post_count == '1'){ // == fixed layout one
                                            $double_class = "wide";
                                            remove_action( 'woocommerce_before_shop_loop_item_title', 'xtocky_wc_template_loop_product_thumbnail', 10 );
                                            add_action( 'woocommerce_before_shop_loop_item_title', 'xtocky_wc_template_loop_product_thumbnail_2x', 10 );                                            
                                        }else{
                                           remove_action( 'woocommerce_before_shop_loop_item_title', 'xtocky_wc_template_loop_product_coundown', 12 );
                                        }
                                    }elseif($carousel_layout === '2'){
                                        $double_class = "";
                                        if($post_count == '5' || $post_count == '10' || $post_count == '15'){
                                            $double_class = "wide";
                                            remove_action( 'woocommerce_before_shop_loop_item_title', 'xtocky_wc_template_loop_product_thumbnail', 10 );
                                            add_action( 'woocommerce_before_shop_loop_item_title', 'xtocky_wc_template_loop_product_thumbnail_2x', 10 );
                                        }else{
                                            remove_action( 'woocommerce_before_shop_loop_item_title', 'xtocky_wc_template_loop_product_coundown', 12 );                                           

                                        }                                       
                                    }
                                    ?>                            
                                    <article <?php post_class(); ?>>
                                        <div class="product-wrap pl-<?php echo esc_attr($product_layout . ' ' .$double_class); ?>">
                                            <?php  wc_get_template_part( 'vc-tabs', 'product' );  ?>
                                        </div>
                                    </article>
                                      <?php
                                      if($carousel_layout == '1'){
                                          if($post_count == '1'){
                                                echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '3'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '5'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '7'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '9'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '11'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '13'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '15'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '17'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '19'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                            } //end post_count 
                                        
                                        }elseif($carousel_layout == '2'){
                                          if($post_count == '2'){
                                                echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '4'){
                                                  echo '</div><div class="slick-slide" style="width:526px">';
                                              }elseif($post_count == '5'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '7'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '9'){
                                                  echo '</div><div class="slick-slide" style="width:526px">';
                                              }elseif($post_count == '10'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '12'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '14'){
                                                  echo '</div><div class="slick-slide" style="width:526px">';
                                              }elseif($post_count == '15'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                              }elseif($post_count == '17'){
                                                  echo '</div><div class="slick-slide" style="width:235px">';
                                            } //end post_count                                   
                                      }                                      
                                    endwhile;
                            } else {
                                   echo '<article class="product">' . esc_html__( 'No products found', 'pikoworks_core' ) . '</article>';
                            }
                            wp_reset_postdata();?>              
                        </div><!-- End .slick-slide -->
                   
                </div><!-- End .swiper-container -->
            </div><!-- End .deal-carousel-container -->
        <?php
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }  
    
}

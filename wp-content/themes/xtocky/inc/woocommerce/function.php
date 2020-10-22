<?php

/* 
 * woocommerce core function
 */
if(!function_exists('xtocky_header_add_to_cart_fragment')) {
/**
 * woocommerce action
 * */
function xtocky_header_add_to_cart_fragment( $fragments ) { 
    ob_start();
    $count = WC()->cart->cart_contents_count ;  
    ?><span class="cart-items" ><?php echo esc_attr($count); ?></span><?php
 
    $fragments['span.cart-items'] = ob_get_clean();
     
    return $fragments;    
}
add_filter( 'woocommerce_add_to_cart_fragments', 'xtocky_header_add_to_cart_fragment' );
}

if(!function_exists('xtocky_cart_total')) {
	function xtocky_cart_total() {
		global $woocommerce;
		?>
		<span class="shop-text"><span class="total"><?php echo do_shortcode($woocommerce->cart->get_cart_subtotal()); ?></span></span>
		<?php
	}
}


if(!function_exists('xtocky_cart_number')) {
	function xtocky_cart_number() {
		global $woocommerce;
		?>
		<span class="badge-number" data-items-count="<?php echo esc_attr( $woocommerce->cart->cart_contents_count ); ?>"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
		<?php
	}
}

if(!function_exists('xtocky_get_fragments')) {
	add_filter('woocommerce_add_to_cart_fragments', 'xtocky_get_fragments', 30);
	function xtocky_get_fragments($array = array()) {
		ob_start();
		xtocky_cart_total();
		$cart_total = ob_get_clean();

		ob_start();
		xtocky_cart_number();
		$cart_number = ob_get_clean();


		$array['span.shop-text'] = $cart_total;
		$array['span.badge-number'] = $cart_number;

		return $array;
	}
}
if( ! function_exists( 'xtocky_quick_view_button' ) ) {
    function xtocky_quick_view_button(){
        if ( class_exists( 'YITH_WCQV_Frontend' ) ):
        $label = get_option( 'yith-wcqv-button-label' );
        echo '<a href="#" class="btn-quickview yith-wcqv-button" data-product_id="' . get_the_ID() . '">' . esc_html( $label ) . '</a>';
        endif; // YITH_WCQV_Frontend
    }
}

if( ! function_exists( 'xtocky_wc_template_loop_product_thumbnail' ) ) {

function xtocky_wc_template_loop_product_thumbnail() {
 /**
 * woocommerce product thumbnail
 * */    
    global $post, $product;
    $image_html = '';
    $img_count = 0;
    $attachment_ids = $product->get_gallery_image_ids();
    $post_image_title = get_the_title( get_post_thumbnail_id() );
    $post_image_caption = get_post_field( 'post_excerpt', get_post_thumbnail_id() );
    $product_img = xtocky_get_option_data('optn_product_image_type', 'none'); 
				
    if ( has_post_thumbnail() ) {
        $image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );
    } ?> 
    
     <?php if($product_img == 'carousel') :?>
            <figure class="piko-carousel sc psh br" data-slick='{"slidesToShow": 1,"slidesToScroll": 1,}'>                
                    <?php
                    if ( $image_html !== '' ) : ?>
                    
                        <a href="<?php esc_url( the_permalink()) ?>" title="<?php esc_attr( $post_image_caption) ?>" >
                            <?php  echo wp_kses_post($image_html); ?>
                        </a>
                    
                    <?php
                    else:
                        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'xtocky' ) ), $post->ID ); 
                    endif; ?>
                     <?php                
                    if ($attachment_ids) {
                        foreach ( $attachment_ids as $attachment_id ) {
                            if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                                    continue;
                            $img_medium = wp_get_attachment_image_src( $attachment_id, 'shop_catalog');
                            $image_title 	= get_the_title( $attachment_id );
                            $image_caption 	= get_post_field( 'post_excerpt', $attachment_id );

                            ?>
                            
                                <a href="<?php esc_url( the_permalink()) ?>" title="<?php esc_attr( $image_caption) ?>">
                                    <img src="<?php echo esc_url($img_medium[0]); ?>" alt="<?php esc_attr( $image_title) ?>">
                                </a>
                           
                            <?php
                            $img_count++;
                        }
                    }
                    ?>
            </figure>
       <?php elseif($product_img == 'rollover'):?>                
                <figure>
                    <a href="<?php esc_url( the_permalink()) ?>">
            <?php            
            if ( has_post_thumbnail() ) {
                
                
                if ($attachment_ids) {

                    foreach ( $attachment_ids as $attachment_id ) {
                        if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                                continue;
                        echo '<div class="product-image">'. wp_get_attachment_image( $attachment_id, 'shop_catalog' ).'</div>';
                        $img_count++;
                        if ($img_count == 1) break;
                        }
                        echo '<div class="product-image">'. wp_kses_post($image_html) .'</div>';	

                        } else {
                            echo '<div class="product-image">'. wp_kses_post($image_html)  .'</div>';					
                            echo '<div class="product-image">'. wp_kses_post($image_html)  .'</div>';                        
                        }
                
            } else {
                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'xtocky' ) ), $post->ID ); 
            } 
            
            ?>
               </a>         
            </figure>           
       <?php else:?>               
            <figure>
                <a href="<?php esc_url( the_permalink()) ?>">
                    <?php if($image_html !== ''){ 
                        echo wp_kses_post($image_html);
                        }else{
                           echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'xtocky' ) ), $post->ID ); 
                        }
                    ?>
                </a>
            </figure> 
      <?php endif; 
      xtocky_quick_view_button();     
}
}
if( ! function_exists( 'xtocky_wc_template_loop_product_thumbnail_rollover' ) ) {
    function xtocky_wc_template_loop_product_thumbnail_rollover() {
            global $post, $product;
            $image_html = '';
            $img_count = 0;
            $attachment_ids = $product->get_gallery_image_ids();            
             if ( has_post_thumbnail() ) {
                $image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );
            } 
            
            ?>                
                <figure>
                    <a href="<?php esc_url( the_permalink()) ?>">
            <?php            
            if (  $image_html !== '' ) {
                
                
                if ($attachment_ids) {

                    foreach ( $attachment_ids as $attachment_id ) {
                        if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                                continue;
                        echo '<div class="product-image">'. wp_get_attachment_image( $attachment_id, 'shop_catalog' ).'</div>';
                        $img_count++;
                        if ($img_count == 1) break;
                        }
                        echo '<div class="product-image">'. wp_kses_post($image_html) .'</div>';	

                        } else {
                            echo '<div class="product-image">'. wp_kses_post($image_html)  .'</div>';					
                            echo '<div class="product-image">'. wp_kses_post($image_html)  .'</div>';                        
                        }
                
            } else {
                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'xtocky' ) ), $post->ID ); 
            } 
            
            ?>
               </a>         
            </figure>
        <?php
        xtocky_quick_view_button();       
    }
}
if( ! function_exists( 'xtocky_wc_template_loop_product_thumbnail_carousel' ) ) {
    function xtocky_wc_template_loop_product_thumbnail_carousel() {      
        global $post, $product;
        $image_html = '';
        $img_count = 0;
        $attachment_ids = $product->get_gallery_image_ids();
        $post_image_caption = get_post_field( 'post_excerpt', get_post_thumbnail_id() );        
        if ( has_post_thumbnail() ) {
            $image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );
        } ?> 


                <figure class="piko-carousel sc psh br" data-slick='{"slidesToShow": 1,"slidesToScroll": 1,}'>                
                        <?php
                        if ( $image_html !== '' ) : ?>

                            <a href="<?php esc_url( the_permalink()) ?>" title="<?php esc_attr( $post_image_caption) ?>" >
                                <?php  echo wp_kses_post($image_html); ?>
                            </a>

                        <?php
                        else:
                            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'xtocky' ) ), $post->ID ); 
                        endif; ?>
                         <?php                
                        if ($attachment_ids) {
                            foreach ( $attachment_ids as $attachment_id ) {
                                if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                                        continue;
                                $img_medium = wp_get_attachment_image_src( $attachment_id, 'shop_catalog');
                                $image_title 	= get_the_title( $attachment_id );
                                $image_caption 	= get_post_field( 'post_excerpt', $attachment_id );

                                ?>

                                    <a href="<?php esc_url( the_permalink()) ?>" title="<?php esc_attr( $image_caption) ?>">
                                        <img src="<?php echo esc_url($img_medium[0]); ?>" alt="<?php esc_attr( $image_title) ?>">
                                    </a>

                                <?php
                                $img_count++;
                            }
                        }
                        ?>
                </figure>
            <?php
            xtocky_quick_view_button(); 
    }
}
if( ! function_exists( 'xtocky_wc_template_quick_view_product_thumbnail_carousel' ) ) {
    function xtocky_wc_template_quick_view_product_thumbnail_carousel() {      
        global $post, $product;
        $image_html = '';
        $img_count = 0;
        $attachment_ids = $product->get_gallery_image_ids();
        $post_image_caption = get_post_field( 'post_excerpt', get_post_thumbnail_id() );        
        if ( has_post_thumbnail() ) {
            $image_html = wp_get_attachment_image( get_post_thumbnail_id(), array('500', '550') );
        } ?> 


                <figure class="piko-carousel br" data-slick='{"slidesToShow": 1,"slidesToScroll": 1}'>                
                        <?php
                        if ( $image_html !== '' ) : ?>

                            <a href="<?php esc_url( the_permalink()) ?>" title="<?php esc_attr( $post_image_caption) ?>" >
                                <?php  echo wp_kses_post($image_html); ?>
                            </a>

                        <?php
                        else:
                            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'xtocky' ) ), $post->ID ); 
                        endif; ?>
                         <?php                
                        if ($attachment_ids) {
                            foreach ( $attachment_ids as $attachment_id ) {
                                if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                                        continue;
                                $img_medium = wp_get_attachment_image_src( $attachment_id, array('500', '550'));
                                $image_title 	= get_the_title( $attachment_id );
                                $image_caption 	= get_post_field( 'post_excerpt', $attachment_id );

                                ?>

                                    <a href="<?php esc_url( the_permalink()) ?>" title="<?php esc_attr( $image_caption) ?>">
                                        <img src="<?php echo esc_url($img_medium[0]); ?>" alt="<?php esc_attr( $image_title) ?>">
                                    </a>

                                <?php
                                $img_count++;
                            }
                        }
                        ?>
                </figure>
            <?php
    }
}



if( ! function_exists( 'xtocky_wc_template_loop_product_thumbnail_1x' ) ) {

    function xtocky_wc_template_loop_product_thumbnail_1x() {
     /**
     * woocommerce product thumbnail 1x
     * */    
        global $post;
        $image_html = '';

        if ( has_post_thumbnail() ) {
            $image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'thumbnail' );
        } ?> 

            <figure>
                <a href="<?php esc_url( the_permalink()) ?>">
                    <?php if($image_html !== ''){ 
                        echo wp_kses_post($image_html);
                        }else{
                           echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'xtocky' ) ), $post->ID ); 
                        }
                    ?>
                </a>
            </figure>        
        <?php    
    }
}
if( ! function_exists( 'xtocky_wc_template_loop_product_thumbnail_2x' ) ) {
function xtocky_wc_template_loop_product_thumbnail_2x() {
 /**
 * woocommerce product thumbnail 2x
 * */    
    global $post;
    $image_html = '';
				
    if ( has_post_thumbnail() ) {
        $image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_single' );
    } ?> 
    
        <figure>
            <a href="<?php esc_url( the_permalink()) ?>">
                <?php if($image_html !== ''){ 
                    echo wp_kses_post($image_html);
                    }else{
                       echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'xtocky' ) ), $post->ID ); 
                    }
                ?>
            </a>
        </figure>
        <?php
        if ( class_exists( 'YITH_WCQV_Frontend' ) ):
            $label = get_option( 'yith-wcqv-button-label' );
            echo '<a href="#" class="btn-quickview yith-wcqv-button" data-product_id="' . get_the_ID() . '">' . esc_html( $label ) . '</a>';
        endif; // YITH_WCQV_Frontend
        ?>
    <?php    
}
}

function xtocky_wc_template_loop_product_coundown() {
    $id = get_the_ID();
    $time = xtocky_get_max_date_sale( $id );
    $y = date( 'Y', $time );
    $m = date( 'm', $time );
    $d = date( 'd', $time );

    $sale_price_dates_from = ( $date = get_post_meta( $id, '_sale_price_dates_from', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';

    if ( $sale_price_dates_from !== '')  {                    
    ?>                    
        <div class="countdown-lastest product-countdown" data-y="<?php echo esc_attr( $y );?>" data-m="<?php echo esc_attr( $m );?>" data-d="<?php echo esc_attr( $d );?>" data-h="00" data-i="00" data-s="00" ></div>   
    <?php
    } 
}

function xtocky_wc_template_loop_product_cat_rating() {    
    ?>
    <div class="product-meta">
        <?php
        xtocky_wc_template_loop_product_brand();
        xtocky_wc_template_loop_product_rating();               
        ?>
    
    <div class="title-wrap">
        <?php xtocky_wc_template_loop_product_title(); ?>
       <?php if(is_shop() || is_product_category()):  ?>
            <div class="list-content"><?php echo wp_trim_words( get_the_excerpt(), esc_attr(36), ' ... ' ); ?></div> 
       <?php endif; ?>
    </div>
    </div>    
    <?php
}
function xtocky_wc_template_loop_product_rating() {
    global  $product;
    
    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average      = $product->get_average_rating();
    
    if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && !$review_count) {
        return;
    }
    ?>        
    <div class="ratings-container">                        
        <?php if ( $rating_count > 0 ) :  ?>            
            <div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'xtocky' ), $average ); ?>">
                    <span style="width:<?php echo ( ( esc_html($average) / 5 ) * 100 ); ?>%">
                            <strong class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'xtocky' ), '<span>', '</span>' ); ?>
                            <?php printf( esc_html(_n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'xtocky' )), '<span class="rating">' . esc_html($rating_count) . '</span>' ); ?>
                    </span>
            </div>
        <?php endif; ?>
    </div>
    <?php
    if ( is_product() && $review_count > 0 ) {
            /* translators: 1: reviews count 2: product name */
            echo '<div class="product-ratings-desc">';
            printf(  esc_html( _n( ' %1$s review', '%1$s review&#40;s&#41;', $review_count, 'xtocky' ) ), esc_html($review_count ));
            echo '</div>';
    }
}

function xtocky_wc_template_loop_product_brand() {
    ?>
    <div class="product-brand">
            <?php wc_get_template_part( 'product-category' );  ?>
    </div><!-- End .product-brand -->
    <?php
}
function xtocky_wc_template_loop_product_title() {
    ?>
    <h3 class="product-title">
        <a href="<?php esc_url( the_permalink()) ?>"><?php the_title(); ?></a>
    </h3>
    <?php
}

function xtocky_wc_template_loop_product_price() {
    global $product;
    ?>
       <div class="product-price-container">
            <span class="price"><?php echo do_shortcode($product->get_price_html()); ?></span>
        </div><!-- End .product-price-container -->
    <?php
}
function xtocky_wc_template_loop_product_button_wishlist() {
    ?>
     <div class="product-action">         
        <?php
        if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ):
            echo do_shortcode( '[yith_wcwl_add_to_wishlist product_id="' . get_the_ID() . '"]' ); 
        endif; //yith_wcwl_add_to_wishlist
        ?>
         <?php if (in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins')))): ?>
            <a href="<?php the_permalink(); ?>?action=yith-woocompare-add-product&amp;id=<?php the_ID(); ?>"
            class="compare" data-product_id="<?php the_ID(); ?>"><?php echo esc_html__('Add To Compare', 'xtocky'); ?></a>
        <?php endif; // yith-woocommerce-compare ?>
    </div><!-- End .product-action -->
    <?php
}

function xtocky_wc_template_loop_product_button_action() {
    ?>
     <div class="product-action clearfix">
         <div class="cart-btn-wrap"><?php woocommerce_template_loop_add_to_cart(); ?></div>
        <?php
        if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ):
            echo do_shortcode( '[yith_wcwl_add_to_wishlist product_id="' . get_the_ID() . '"]' ); 
        endif; //yith_wcwl_add_to_wishlist
        ?>
        <?php if (in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins')))): ?>
            <a href="<?php the_permalink(); ?>?action=yith-woocompare-add-product&amp;id=<?php the_ID(); ?>"
            class="compare" data-product_id="<?php the_ID(); ?>"><?php echo esc_html__('Add To Compare', 'xtocky'); ?></a>
        <?php endif; // yith-woocommerce-compare ?>
    </div><!-- End .product-action -->
    <?php
}
function xtocky_wc_template_loop_product_button_action_two() {
    ?>
     <div class="product-action">         
        <?php
        if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ):
            echo do_shortcode( '[yith_wcwl_add_to_wishlist product_id="' . get_the_ID() . '"]' ); 
        endif; //yith_wcwl_add_to_wishlist
        ?>
         <div class="cart-btn-wrap"><?php woocommerce_template_loop_add_to_cart(); ?></div>
        <?php if (in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins')))): ?>
            <a href="<?php the_permalink(); ?>?action=yith-woocompare-add-product&amp;id=<?php the_ID(); ?>"
            class="compare" data-product_id="<?php the_ID(); ?>"><?php echo esc_html__('Add To Compare', 'xtocky'); ?></a>
        <?php endif; // yith-woocommerce-compare ?>
    </div><!-- End .product-action -->
    <?php
}


function xtocky_wc_template_loop_product_button_action_middle() {
    ?>
     <div class="product-action">
         <div class="cart-btn-wrap"><?php woocommerce_template_loop_add_to_cart(); ?></div>
        <?php
        if ( class_exists( 'YITH_WCQV_Frontend' ) ):
            $label = get_option( 'yith-wcqv-button-label' );
            echo '<a href="#" class="btn-quickview yith-wcqv-button" data-product_id="' . get_the_ID() . '">' . esc_html( $label ) . '</a>';
        endif; // YITH_WCQV_Frontend
        ?> 
        <?php
        if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ):
            echo do_shortcode( '[yith_wcwl_add_to_wishlist product_id="' . get_the_ID() . '"]' ); 
        endif; //yith_wcwl_add_to_wishlist
        ?>
        <?php if (in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins')))): ?>
            <a href="<?php the_permalink(); ?>?action=yith-woocompare-add-product&amp;id=<?php the_ID(); ?>"
            class="compare" data-product_id="<?php the_ID(); ?>"><?php echo esc_html__('Add To Compare', 'xtocky'); ?></a>
        <?php endif; // yith-woocommerce-compare ?>
    </div><!-- End .product-action -->
    <?php
}




//single product







function xtocky_wc_template_single_product_miscellaneous() {     
     if ( get_post_type( get_the_ID() ) == 'product' && is_singular() && !is_page() ) :
         $enable_miscellaneous = xtocky_get_option_data('enable_miscellaneous','0');
         $guide_title = xtocky_get_option_data('size_guide_title','');
         
         $size_guide_id =  get_post_meta(get_the_ID(),'xtocky_size_guide', true);
        $size_guide['url'] =  wp_get_attachment_image_url($size_guide_id, '') ? wp_get_attachment_image_url($size_guide_id, '') : '';
        if (!isset($size_guide['url']) ||  $size_guide['url'] == '') { 
            $size_guide = xtocky_get_option_data('size_guide','');
        }
         
         $policy_title = xtocky_get_option_data('return_policy_title','');
         $return_policy = xtocky_get_option_data('return_policy','');       
     ?>
    <div class="return_policy_pop" style="display:none">
        <?php echo do_shortcode( $return_policy);?>
    </div>
        <?php if($enable_miscellaneous == '1'): ?>
        <div class="guide-wrap">        
               <?php 
               if(!empty($size_guide['url'])){
                    echo '<div class="modal-open"><a class="open" href="'.esc_url($size_guide['url']).'">'.esc_attr($guide_title).'</a></div>';
               }
               if(!empty($return_policy)){
                    echo  '<div class="modal-open"><a data-sub-html=".return_policy_pop" class="open" href="'. esc_url(XTOCKY_IMAGE.'/blank.gif') .'">'.esc_attr($policy_title).'</a></div>';  
               }           
               ?>
        </div>
        <?php
       endif; //$enable_miscellaneous
    endif; //post type
}
if ( !function_exists( 'xtocky_wc_product_video' ) ) {
	function xtocky_wc_product_video()	{
            $video_src = get_post_meta(get_the_ID(), 'xtocky_single_products_video', true );
            if(!empty($video_src)){
                echo '<div class="video-gallery">
                    <a href="'. esc_url($video_src) .'" class="open"></a>
                </div>';
            } 
	}
}




function xtocky_wc_template_single_product_price() {
    global $product;
    $before = esc_html__('You Pay:', 'xtocky');
    if( $product->is_type( 'variable' ) ){
       $before = esc_html__('Variations:', 'xtocky'); 
    }
?>
    <div class="product-price-container" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <label><?php echo esc_attr($before); ?></label>
        <span class="price"><?php echo do_shortcode($product->get_price_html()); ?></span>
        <meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
        <meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
        <link itemprop="availability" href="http://schema.org/<?php if($product->is_in_stock() ){ echo  'InStock'; }else{  echo 'OutOfStock';  }; ?>" />

    </div>
<?php
}
function xtocky_wc_template_single_product_summary() {
    global $product;
    $prefix = 'xtocky_';
    $thumbnail =  get_post_meta(get_the_ID(), $prefix . 'single_products_thumbnail',true);
    if (!isset($thumbnail) || $thumbnail == '-1' || $thumbnail == '') {
        $thumbnail = xtocky_get_option_data('optn_woo_single_products_thumbnail','1');
    }
    
    
    $review_count = $product->get_review_count();
    
    xtocky_wc_template_loop_product_brand();
    
    echo '<h2 class="product-title">' . get_the_title() . '</h2>';  
    
    if($thumbnail == 2 || $thumbnail == 3){ //for layout 2,3
        echo '<div class="product-price-container">' . $product->get_price_html() . '</div>'; 
    }
    
    if($thumbnail == 3){ //for layout 3, end div content-single-product.php
        echo '<div class="product-details-row"> <div class="details-cell">'; 
    } 
    
    if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && $review_count) {
        echo '<div class="product-ratings-wrapper">';
        xtocky_wc_template_loop_product_rating(); //rating and reviews
        echo '</div>';
     }
       
     
    echo '<ul class="product-meta-list">';?>
        <li><span><?php esc_attr_e( 'Availability: ', 'xtocky' ); ?></span><span class="text-custom"> <?php  $product->is_in_stock() ? esc_attr_e( 'In Stock', 'xtocky')  : esc_attr_e( 'Out of stock', 'xtocky' ); ?></span></li>
    <?php
    if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
        <li><span><?php esc_attr_e( 'Product Code:', 'xtocky' ); ?></span> <?php if( $product->get_sku()){ echo esc_attr($product->get_sku());}else{ esc_html__e( 'N/A', 'xtocky' );} ?></li>
    <?php endif;    
    echo '</ul>';    
    
    
}

function xtocky_wc_template_cart_page_product_code($sku) {
    global $product;    
   
    if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) :         
         if( $product->get_sku()){ echo esc_attr($product->get_sku());}else{ esc_html__e( 'N/A', 'xtocky' );}
          return;
//         print_r($sku);
    endif;   
    
}

add_filter( 'woocommerce_cart_item_name', 'add_sku_in_cart', 20, 3);

function add_sku_in_cart( $title, $values, $cart_item_key ) {
    $sku = '<span class="product-sku">' . $values['data']->get_sku(). '</span>';
    return $sku ? $title . sprintf("%s", $sku) : $title;
}

function xtocky_wc_template_single_product_button_action() {
    ?>
     <div class="product-action">
        <?php
        if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ):
            echo do_shortcode( '[yith_wcwl_add_to_wishlist product_id="' . get_the_ID() . '"]' ); 
        endif; //yith_wcwl_add_to_wishlist
        ?>
        <?php if (in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins')))): ?>
            <a href="<?php the_permalink(); ?>?action=yith-woocompare-add-product&amp;id=<?php the_ID(); ?>"
            class="compare" data-product_id="<?php the_ID(); ?>"><?php echo esc_html__('Add To Compare', 'xtocky'); ?></a>
        <?php endif; // yith-woocommerce-compare ?>
    </div><!-- End .product-action -->
    <?php
}


function xtocky_wc_template_loop_category_thumbnail() {
 /**
 * woocommerce product category thumbnail overlay
 * */
    
    global $post, $product;
    
    $image_html = '';
    $img_count = 0;
    $attachment_ids = $product->get_gallery_image_ids();
				
    if ( has_post_thumbnail() ) {
        $image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );					
    }
    echo '<figure class="category-img-wrap">';    
        if ($attachment_ids) {
            echo '<div class="image-product-gallery">';
            echo '<a href="javascript:void(0)" class="change">' . wp_kses_post($image_html) . '</a>';
            foreach ( $attachment_ids as $attachment_id ) {
                if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                        continue;
                echo '<a href="javascript:void(0)" class="change">'. wp_get_attachment_image( $attachment_id, 'shop_catalog' ) . '</a>';
                $img_count++;
                if ($img_count == 2) break;
                }
                
                echo '</div><div class="image-product"> <a href="javascript:void(0)" class="woocommerce-main-image">'. wp_kses_post($image_html) .'</a></div>';
                } else {
                    echo '<div class="image-product">'. wp_kses_post($image_html)  .'</div>';					
                    echo '<div class="image-product-gallery">'. wp_kses_post($image_html)  .'</div>';                        
                }
    echo '</figure>';       
}


function xtocky_wc_template_loop_price_deals(){    
    global $product;      
    ?>
        <footer class="product-footer">            
            <span class="price"><?php echo do_shortcode($product->get_price_html()); ?></span>            
            <div class="clearfix"></div>
        </footer>
    <?php
    
}

if (!function_exists('xtocky_woocommerce_custom_sales_price')) {

    /**
     * Sale price Percentage
     */ 
    function xtocky_woocommerce_custom_sales_price($product) {

        global $post, $product;
        if (!$product->is_in_stock() || $product->is_type('grouped'))
            return;
        $sale_price = get_post_meta($product->get_id(), '_price', true);
        $regular_price = get_post_meta($product->get_id(), '_regular_price', true);
        if (empty($regular_price)) { //then this is a variable product
            $available_variations = $product->get_available_variations();
            $variation_id = $available_variations[0]['variation_id'];
            $variation = new WC_Product_Variation($variation_id);
            $regular_price = $variation->get_regular_price();
            $sale_price = $variation->get_sale_price();
            if (empty($sale_price)) {
                $variation_id = $available_variations[1]['variation_id'];
                $variation = new WC_Product_Variation($variation_id);
                $sale_price = $variation->get_sale_price();
            }
        }
        $percentage = ceil(( ($regular_price - $sale_price) / $regular_price ) * 100);
        if (!empty($regular_price) && !empty($sale_price) && $regular_price > $sale_price) :
            return sprintf('<span class="product-label discount">-%1$s</span>', esc_attr($percentage) . esc_attr__('%', 'xtocky'), $post, $product);
        endif;
    }
    add_filter('woocommerce_sale_flash', 'xtocky_woocommerce_custom_sales_price');
}

if( ! function_exists( 'woocommerce_enable_review_rating' ) ){
 /**
 * comment rating
 */
    function xtocky_wc_template_loop_rating(){   
    
    global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

    
    
    ?>
        
            <?php if ( $rating_count > 0 ) :  ?>            
		<div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'xtocky' ), esc_html($average) ); ?>">
			<span style="width:<?php echo ( ( esc_html($average) / 5 ) * 100 ); ?>%">
				<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'xtocky' ), '<span itemprop="bestRating">', '</span>' ); ?>
				<?php printf( esc_html( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'xtocky' ) ), '<span itemprop="ratingCount" class="rating">' . esc_attr($rating_count) . '</span>' ); ?>
			</span>
		</div>
            <?php endif; ?>
            <div class="clearfix"></div>        
    <?php
    
}

}

if( ! function_exists( 'woocommerce_enable_review_rating_numeric' ) ){
 /**
 * comment count
 */
    function woocommerce_enable_review_rating_numeric(){ 
    
    global $product;
    if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
            return;
    }

    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average      = $product->get_average_rating();

     if ( $rating_count > 0 ) :  ?>    
        <div class="single-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'xtocky' ), esc_html($average) ); ?>">
            <i class="fa fa-star-o" aria-hidden="true"></i> 
            <span><?php echo esc_html( _n( '%s', '%s', $average, 'xtocky' ) ) . esc_html__( '/5', 'xtocky' ); ?></span>
        </div>            
    <?php endif; 

    }

}

if( class_exists( 'YITH_WCWL_Init') ){
    /**
    * Remove font wishlist font awesome
    **/
    function dequeue_yith_font_awesome_css() {
        wp_dequeue_style('yith-wcwl-font-awesome');
        wp_deregister_style('yith-wcwl-font-awesome');
    }
    add_action('wp_enqueue_scripts','dequeue_yith_font_awesome_css', 100);
}

function xtocky_wc_wishlist_button($product) { ?>
    <div class="single-product-wrap">
        <?php
        if ( shortcode_exists('yith_wcwl_add_to_wishlist') ) {
            echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
        }
        if ( shortcode_exists('yith_compare_button') ) {
            echo do_shortcode('[yith_compare_button]'); 
        }
        ?>
        <div class="clear"></div>   
    </div>
    <?php
        
        
}
//add_action( 'woocommerce_single_product_summary', 'xtocky_wc_wishlist_button', 30 );

add_filter( 'woocommerce_breadcrumb_defaults', 'xtocky_woo_breadcrumbs' );
function xtocky_woo_breadcrumbs() {
    global $xtocky;
    $breadcrubm_name =  isset( $xtocky['optn_breadcrumb_name'] ) ? $xtocky['optn_breadcrumb_name'] : esc_html__('Home', 'xtocky');
    $breadcrubm_delimiter =  isset( $xtocky['optn_breadcrumb_delimiter'] ) ? $xtocky['optn_breadcrumb_delimiter'] : 'icon-arrow-long-right';
//    filtaring breadcrumbs
    return array(
            'delimiter'   => '<i class="'. esc_attr($breadcrubm_delimiter) .'" aria-hidden="true"></i>   &nbsp;',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</nav>',
            'before'      => '',
            'after'       => '',
            'home'        => esc_attr($breadcrubm_name),
        );
}

if( ! function_exists( 'xtocky_get_max_date_sale') ) {
/**
 * Get max date sale variable 
 **/
    function xtocky_get_max_date_sale( $product_id ) {
        $time = 0;
        // Get variations
        $args = array(
            'post_type'     => 'product_variation',
            'post_status'   => array( 'private', 'publish' ),
            'numberposts'   => -1,
            'orderby'       => 'menu_order',
            'order'         => 'asc',
            'post_parent'   => $product_id
        );
        $variations = get_posts( $args );
        $variation_ids = array();
        if( $variations ){
            foreach ( $variations as $variation ) {
                $variation_ids[]  = $variation->ID;
            }
        }
        $sale_price_dates_to = false;
    
        if( !empty(  $variation_ids )   ){
            global $wpdb;
            $sale_price_dates_to = $wpdb->get_var( "
                SELECT
                meta_value
                FROM $wpdb->postmeta
                WHERE meta_key = '_sale_price_dates_to' and post_id IN(" . join( ',', $variation_ids ) . ")
                ORDER BY meta_value DESC
                LIMIT 1
            " );
    
            if( $sale_price_dates_to != '' ){
                return $sale_price_dates_to;
            }
        }
    
        if( ! $sale_price_dates_to ){
            $sale_price_dates_to = get_post_meta( $product_id, '_sale_price_dates_to', true );

            if($sale_price_dates_to == ''){
                $sale_price_dates_to = '0';
            }

            return $sale_price_dates_to;
        }
    }
}



function xtocky_product_share(){
global $xtocky;
$social_share = isset($xtocky['single_product_share_socials']) ? $xtocky['single_product_share_socials']: array();
    
     if ( !empty( $social_share ) ): ?>               
                <?php if ( in_array( 'facebook', $social_share ) ): ?>                    
                    <li class="social-icon fa fa-facebook">
                    <a class="shear-icon-wrap" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">
                       <span class="text"><?php echo sprintf( esc_html__( 'Share "%s" on Facebook', 'xtocky' ), get_the_title() ); ?></span>
                    </a>
                    </li>        
                <?php endif; ?>
                <?php if ( in_array( 'twitter', $social_share ) ): ?>
                <li class="social-icon fa fa-twitter">
                    <a class="shear-icon-wrap" href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank">
                       <span class="text"><?php echo sprintf( esc_html__( 'Post status "%s" on Twitter', 'xtocky' ), get_the_title() ); ?></span>
                    </a>
                </li>    
                <?php endif; ?>
                <?php if ( in_array( 'gplus', $social_share ) ): ?>
                <li class="social-icon fa fa-google-plus">
                    <a class="shear-icon-wrap" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank">
                        <span class="text"><?php echo sprintf( esc_html__( 'Share "%s" on Google Plus', 'xtocky' ), get_the_title() ); ?></span>
                    </a>
                </li>    
                <?php endif; ?>
                <?php if ( in_array( 'pinterest', $social_share ) ): ?>
                <li class="social-icon fa fa-pinterest">
                    <a class="shear-icon-wrap" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;description=<?php echo urlencode( get_the_excerpt() ); ?>" target="_blank">
                        <span class="text"><?php echo sprintf( esc_html__( 'Pin "%s" on Pinterest', 'xtocky' ), get_the_title() ); ?></span>
                    </a>
                </li>    
                <?php endif; ?>
                <?php if ( in_array( 'linkedin', $social_share ) ): ?>
                    <li class="social-icon fa fa-linkedin">
                    <a class="shear-icon-wrap" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode( get_the_title() ); ?>&amp;summary=<?php echo urlencode( get_the_excerpt() ); ?>&amp;source=<?php echo urlencode( get_bloginfo( 'name' ) ); ?>" target="_blank">
                        <span class="text"><?php echo sprintf( esc_html__( 'Share "%s" on LinkedIn', 'xtocky' ), get_the_title() ); ?></span>
                    </a>
                    </li>
                <?php endif; ?>
                <?php if ( in_array( 'email', $social_share ) ): ?>
                <li class="social-icon fa fa-envelope">
                    <a class="shear-icon-wrap" href="mailto:?subject=<?php echo get_the_title(); ?>&amp;body=<?php echo urlencode( get_the_excerpt() ); ?>&amp;title=<?php echo get_the_title(); ?>" title="<?php _e( 'Email', 'xtocky' ) ?>">
                        <span class="text"><?php echo sprintf( esc_html__( 'Share "%s" on Email', 'xtocky' ), get_the_title() ); ?></span>
                    </a>
                </li>    
                <?php endif; ?>
    <?php endif; // End if ( !empty( $socials_shared ) )     
}
function xtocky_product_single_share(){
    $enable_share = xtocky_get_option_data( 'enable_product_single_post_share', '1' );
    if($enable_share){
        echo'<ul class="social-icons">';
        xtocky_product_share();
        echo'</ul>';
    }
}


if( ! function_exists( 'xtocky_related_products_args' ) ) {
/**
* Custom item related_products
**/
    function xtocky_related_products_args( $args ) {
        $args['posts_per_page'] = 9; // 4 to 9 related product
        return $args;
    }
}
add_filter( 'woocommerce_output_related_products_args', 'xtocky_related_products_args' );

//tootls bar

if ( !function_exists( 'get' ) ){
	function get($var){
		return isset($_GET[$var]) ? $_GET[$var] : (isset($_REQUEST[$var]) ? $_REQUEST[$var] : '');
	}
}

if ( !function_exists( 'post' ) ){
	function post($var){
		return isset($_POST[$var]) ? $_POST[$var] : null;
	}
}

if ( !function_exists( 'cookie' ) ){
	function cookie($var){
		return isset($_COOKIE[$var]) ? $_COOKIE[$var] : null;
	}
}

if ( !function_exists( 'xtocky_get_the_content_with_formatting' ) ){
	function xtocky_get_the_content_with_formatting() {
		$content = get_the_content();
		$content = apply_filters('the_content', $content);
		$content = do_shortcode($content);
		return $content;
	}
}

if ( !function_exists( 'xtocky_add_formatting' ) ) {
	function xtocky_add_formatting($content){
		$content = do_shortcode($content);
		return $content;
	}
}


if ( !function_exists( 'xtocky_get_current_page_url' ) ){
	function xtocky_get_current_page_url() {
		$current_url = add_query_arg(null,null);
		return esc_url($current_url);
	}
}


if ( !function_exists( 'xtocky_woocommerce_placeholder_img_src' ) ) {
	function xtocky_woocommerce_placeholder_img_src($src){
		$src = get_template_directory_uri() . '/assets/images/placeholder.jpg';
		return esc_url($src);
	}
}


if ( !function_exists( 'xtocky_woocommerce_add_filter_woocommerce_pagination_args' ) ) {
	function xtocky_woocommerce_add_filter_woocommerce_pagination_args( $args )
	{
		$args[ 'prev_text' ] = esc_html__( 'Prev', 'xtocky' );
		$args[ 'next_text' ] = esc_html__( 'Next', 'xtocky' );
		return $args;
	}
}


if ( !function_exists( 'xtocky_woocommerce_add_badge_new_in_list' ) ) {
	function xtocky_woocommerce_add_badge_new_in_list()
	{
		global $post, $xtocky;
                $enable_new = isset( $xtocky['optn_show_new_product_label'] ) ? $xtocky['optn_show_new_product_label'] : 1;
                $days_count = isset( $xtocky['optn_new_product_label'] ) ? $xtocky['optn_new_product_label'] : '30';
                $label_text = isset( $xtocky['optn_new_product_label_text'] ) ? $xtocky['optn_new_product_label_text'] : esc_html__('New', 'xtocky');
                if($enable_new == 0){
                    return;
                }
		$post_date = get_the_time( 'Y-m-d', $post );
		$post_date_stamp = strtotime( $post_date );
		$newness = esc_attr($days_count);
		if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $post_date_stamp ) {
			$class = 'product-label';
			echo '<span class="' . $class . '">' . esc_attr($label_text) . '</span>';
		}
	}
}

function xtocky_woocommerce_add_badge_out_of_stock() {
    global $product, $xtocky;    
    $out_of_stock_label = isset( $xtocky['optn_product_out_of_stock_label'] ) ? $xtocky['optn_product_out_of_stock_label'] : esc_html__('Out of stock', 'xtocky');
    if(empty($out_of_stock_label)){
        return;
    }
    if ( !$product->is_in_stock() ) {
        echo '<span class="product-label outofstock">' . esc_attr($out_of_stock_label). '</span>';
    }
}

if ( !function_exists( 'xtocky_woocommerce_override_loop_shop_per_page' ) ) {
	function xtocky_woocommerce_override_loop_shop_per_page( $cols )
	{
		$products_per_page = xtocky_get_option_data( 'products_per_page', '20,25,35' );
		$mode_view = apply_filters( 'xtocky_filter_products_mode_view', 'grid' );
		if ( $mode_view == 'list' ) {
			$products_per_page = xtocky_get_option_data( 'products_per_page_list', '20,25,35' );
		}
		$array_per_page = explode( ',', $products_per_page );
		$array_per_page = array_map( 'trim', $array_per_page );
		$per_page = xtocky_get_option_data( 'products_per_page_default', 20 );
		$per_page = apply_filters( 'xtocky_filter_products_per_page', $per_page );
		if ( $per_page && in_array( $per_page, $array_per_page ) ) {
			return $per_page;
		}
		return $cols;
	}
}
if ( !function_exists( 'xtocky_get_filter_trigger_canvas' ) ){
    function xtocky_get_filter_trigger_canvas(){               
         if( is_shop() || is_product_category() || is_tax('brand') || is_product_tag() ):?>
            <div  class="push-fixed push-right push-menu filter-trigger-canvas">
                <h3><?php esc_html_e('FILTER', 'xtocky'); ?> <i class="close-filter pa icon-cross2"></i></h3>
                <?php
                if(is_active_sidebar('sidebar-7')){      
                     echo '<div class="clearfix"></div><div class="filter-sidebar">';
                        dynamic_sidebar('sidebar-7');
                     echo '</div>';
                }
                ?>
            </div>        
        <?php endif;
    }
}

if ( !function_exists( 'xtocky_woocommerce_setcookie_default' ) ) {
	function xtocky_woocommerce_setcookie_default()
	{
		$default_cookie_expire = time() + 3600 * 24 * 30;

		if ( !isset( $_COOKIE[ 'xtocky_products_list_per_page' ] ) ) {
			setcookie(
				'xtocky_products_list_per_page',
				xtocky_get_option_data( 'products_per_page_list_default', 20 ),
				$default_cookie_expire,
				COOKIEPATH
			);
		}
		if ( !isset( $_COOKIE[ 'xtocky_products_grid_per_page' ] ) ) {
			setcookie(
				'xtocky_products_grid_per_page',
				xtocky_get_option_data( 'products_per_page_default', 20 ),
				$default_cookie_expire,
				COOKIEPATH
			);
		}
		if ( !isset( $_COOKIE[ 'xtocky_products_mode_view' ] ) ) {
			setcookie(
				'xtocky_products_mode_view',
				'grid',
				$default_cookie_expire,
				COOKIEPATH
			);
		}

		// check mode_view
		if ( in_array( cookie( 'xtocky_products_mode_view' ), array( 'list', 'grid' ) ) ) {
			add_filter(
				'xtocky_filter_products_mode_view', function ( $per_row ) {
				return cookie( 'xtocky_products_mode_view' );
			}, 99 );
		}
		if ( in_array( get( 'view' ), array( 'list', 'grid' ) ) ) {
			add_filter(
				'xtocky_filter_products_mode_view', function ( $mode ) {
				return get( 'view' );
			}, 99 );
			setcookie(
				'xtocky_products_mode_view',
				get( 'view' ),
				$default_cookie_expire,
				COOKIEPATH
			);
		}

		// Check per_row
		if ( absint( cookie( 'xtocky_products_per_row' ) ) ) {
			add_filter(
				'xtocky_filter_products_per_row', function ( $per_row ) {
				return absint( cookie( 'xtocky_products_per_row' ) );
			}, 99 );
		}
		if ( absint( get( 'per_row' ) ) ) {
			add_filter(
				'xtocky_filter_products_per_row', function ( $per_row ) {
				return absint( get( 'per_row' ) );
			}, 99 );
			setcookie(
				'xtocky_products_per_row',
				absint( get( 'per_row' ) ),
				$default_cookie_expire,
				COOKIEPATH
			);
		}

		// check per_page
		$mode_view = in_array( cookie( 'xtocky_products_mode_view' ), array( 'list', 'grid' ) ) ? cookie( 'xtocky_products_mode_view' ) : 'grid';
		if ( in_array( get( 'view' ), array( 'list', 'grid' ) ) ) {
			$mode_view = get( 'view' );
		}

		if ( $mode_view == 'list' ) {
			if ( absint( cookie( 'xtocky_products_list_per_page' ) ) ) {
				add_filter(
					'xtocky_filter_products_per_page', function ( $per_row ) {
					return absint( cookie( 'xtocky_products_list_per_page' ) );
				}, 99 );
			}
			if ( absint( get( 'per_page' ) ) ) {
				add_filter(
					'xtocky_filter_products_per_page', function ( $per_page ) {
					return absint( get( 'per_page' ) );
				}, 99 );
				setcookie(
					'xtocky_products_list_per_page',
					absint( get( 'per_page' ) ),
					$default_cookie_expire,
					COOKIEPATH
				);
			}
		} else {
			if ( absint( cookie( 'xtocky_products_grid_per_page' ) ) ) {
				add_filter(
					'xtocky_filter_products_per_page', function ( $per_row ) {
					return absint( cookie( 'xtocky_products_grid_per_page' ) );
				}, 99 );
			}
			if ( absint( get( 'per_page' ) ) ) {
				add_filter(
					'xtocky_filter_products_per_page', function ( $per_page ) {
					return absint( get( 'per_page' ) );
				}, 99 );
				setcookie(
					'xtocky_products_grid_per_page',
					absint( get( 'per_page' ) ),
					$default_cookie_expire,
					COOKIEPATH
				);
			}
		}
	}
}

if ( !function_exists( 'xtocky_woocommerce_add_toolbar' ) ) {
	function xtocky_woocommerce_add_toolbar()
	{
		wc_get_template( 'loop/toolbar.php' );
	}
}

if ( !function_exists( 'xtocky_woocommerce_add_toolbar_per_page' ) ) {
	function xtocky_woocommerce_add_toolbar_per_page()
	{
		$link = xtocky_get_current_page_url();
		$mode_view = apply_filters( 'xtocky_filter_products_mode_view', 'grid' );
		$products_per_page = xtocky_get_option_data( 'products_per_page', '9,15,30' );
		$per_page = xtocky_get_option_data( 'products_per_page_default', 9 );
		if ( $mode_view == 'list' ) {
			$products_per_page = xtocky_get_option_data( 'products_per_page_list', '5,10,15' );
			$per_page = xtocky_get_option_data( 'products_per_page_list_default', 5 );			
		}
		$products_per_page = explode( ',', $products_per_page );
		$products_per_page = array_map( 'trim', $products_per_page );
		$per_page = apply_filters( 'xtocky_filter_products_per_page', $per_page );
		if ( count( $products_per_page ) > 1 ) {
			?>
			<div class="sort-by-wrapper sort-by-per-page">
				<div class="sort-by-label"><?php esc_attr_e( 'Per Page', 'xtocky' )?></div>
				<div class="sort-by-content">
					<ul>
						<?php foreach ( $products_per_page as $num ) : ?>
							<li<?php if ( $per_page == $num ) echo ' class="active"'; ?>>
								<a href="<?php echo esc_url(add_query_arg( 'per_page', $num, $link )) ?>"><?php echo esc_html( $num ); ?></a>
							</li>
						<?php endforeach;?>
					</ul>
				</div>
			</div>
		<?php
		}
	}
}

if ( !function_exists( 'xtocky_woocommerce_add_toolbar_position' ) ) {
	function xtocky_woocommerce_add_toolbar_position()
	{
		$link = xtocky_get_current_page_url();
		?>
		<div class="sort-by-wrapper sort-by-order">
			<div class="sort-by-label"><?php esc_attr_e( 'Position', 'xtocky' )?></div>
			<div class="sort-by-content">
				<ul>
					<li<?php if ( strtolower( get( 'order' ) ) == 'asc' ) echo ' class="active"'; ?>>
						<a href="<?php echo esc_url(add_query_arg( 'order', 'asc', $link ))?>"><?php esc_attr_e( 'Ascending', 'xtocky' )?></a>
					</li>
					<li<?php if ( strtolower( get( 'order' ) ) == 'desc' ) echo ' class="active"'; ?>>
						<a href="<?php echo esc_url(add_query_arg( 'order', 'desc', $link ))?>"><?php esc_attr_e( 'Descending', 'xtocky' )?></a>
					</li>
				</ul>
			</div>
		</div>
	<?php
	}
}

if ( !function_exists( 'xtocky_woocommerce_add_gridlist_toggle_button' ) ) {
	function xtocky_woocommerce_add_gridlist_toggle_button()
	{
		global $wp;
		$mode_views = array(
			'list' => array(
				esc_html__( 'List view', 'xtocky' ),
				'<span><i class="icon-list"></i></span>'
			),
                        'grid' => array(
				esc_html__( 'Grid view', 'xtocky' ),
				'<span><i class="icon-grid"></i></span>'
			)
		);
		$active = apply_filters( 'xtocky_filter_products_mode_view', 'grid' );
		$params = array();
		if ( isset( $_GET ) ) {
			foreach ( $_GET as $key => $val ) {
				$params[ $key ] = $val;
			}
		}
		if ( '' == get_option( 'permalink_structure' ) ) {
			$form_action = remove_query_arg( array( 'per_page', 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
		}
		?>
		<div class="gridlist-toggle-wrapper">
			<nav class="gridlist_toggle">
				<?php foreach ( $mode_views as $k => $v ) { ?>
                    <a id="<?php echo esc_attr( $k ); ?>" <?php
                        if ($active == $k) {
                            echo wp_kses('class="active" href="javascript:;"', array('a' => array('class' => array(), 'href' => array())));
                        } else {
                            echo wp_kses('href="' . esc_url(add_query_arg('view', $k, $form_action)) . '"', array('a' => array('href' => array())));
                        } ?>
					   title="<?php echo esc_attr( $v[ 0 ] ) ?>"><?php echo do_shortcode( $v[ 1 ]) ?></a>
				<?php }?>
			</nav>
		</div>
	<?php
	}
}

if ( !function_exists( 'xtocky_woocommerce_add_filter_attribute_on_toolbar' ) ) {
	function xtocky_woocommerce_add_filter_attribute_on_toolbar()
	{
		ob_start();
		if ( is_active_sidebar( 'shop-filter' ) ) {
			dynamic_sidebar( 'shop-filter' );
		}
		$return = ob_get_clean();
		echo wp_kses_post( $return, true );
	}
}

if ( !function_exists( 'xtocky_woocommerce_add_filter_order_by_popularity_post_clauses' ) ) {
	function xtocky_woocommerce_add_filter_order_by_popularity_post_clauses( $args )
	{
		global $wpdb;
		$order = in_array( strtoupper( get( 'order' ) ), array( 'DESC', 'ASC' ) ) ? strtoupper( get( 'order' ) ) : 'DESC';
		if(isset($args[ 'orderby' ])){
			if( strpos($args['orderby'], "$wpdb->postmeta.meta_value+0") !== FALSE ){
				$args[ 'orderby' ] = "$wpdb->postmeta.meta_value+0 $order, $wpdb->posts.post_date DESC";
			}
		}

		return $args;
	}
}

if ( !function_exists( 'xtocky_woocommerce_add_filter_order_by_rating_post_clauses' ) ) {
	function xtocky_woocommerce_add_filter_order_by_rating_post_clauses( $args )
	{
		global $wpdb;
		$order = in_array( strtoupper( get( 'order' ) ), array( 'DESC', 'ASC' ) ) ? strtoupper( get( 'order' ) ) : 'DESC';
		if(isset($args[ 'orderby' ])) {
			if( strpos($args['orderby'], "average_rating") !== FALSE ){
				$args['orderby'] = "average_rating $order, $wpdb->posts.post_date DESC";
			}
		}
		return $args;
	}
}


if ( !function_exists( 'xtocky_woocommerce_custom_stock_html' ) ) {
	function xtocky_woocommerce_custom_stock_html()
	{
		if ( is_product() ) {
			global $product;
			// Availability
			$availability = $product->get_availability();
			$availability_html = empty( $availability[ 'availability' ] ) ? '' : '<p class="stock ' . esc_attr( $availability[ 'class' ] ) . '"><span>' . esc_html__( 'Availability:', 'xtocky' ) . '</span> ' . esc_html( $availability[ 'availability' ] ) . '</p>';
			echo do_shortcode($availability_html);
		}
	}
}
function xtocky_woocommerce_rename_tabs( $tabs ) {
	// Rename the  tab        
        global $product;	
        if( $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) { 
            $tabs['additional_information']['title'] = esc_html__( 'Details', 'xtocky' );
        }
        

	return $tabs;
}
if ( !function_exists( 'xtocky_woocommerce_add_filter_product_tab_accessories' ) ) {
	function xtocky_woocommerce_add_filter_product_tab_accessories( $tabs )
	{
		global $product, $post;
                $enable =  get_post_meta(get_the_ID(),'xtocky_enable_custom_tab_accessories',true);
		if ( $enable == '1') {
			$tabs[ 'custom_tab_accessories' ] = array(
				'title'    => esc_html__('Accessories', 'xtocky'),
				'priority' => 48,
				'callback' => 'xtocky_woocommerce_add_custom_product_tab_accessories_callback'
			);
		}
		return $tabs;
	}
}

if ( !function_exists( 'xtocky_woocommerce_add_custom_product_tab_accessories_callback' ) ) {
	function xtocky_woocommerce_add_custom_product_tab_accessories_callback()	{
            $post_id = get_post_meta(get_the_ID(),'xtocky_custom_tab_accessories_porduct_id',true);
            $full_width = xtocky_get_option_data( 'main-width-content', 'container' );
            $has_sidebar = xtocky_get_option_data( 'optn_product_single_sidebar_pos', 'fullwidth' );
            $slide =  '5';
            if($full_width == 'container' && $has_sidebar != 'fullwidth'){
                $slide = '3';
            }elseif($full_width == 'container'){
                $slide =  '4';
            }
            
            $id = explode( ',', $post_id );
            $product_id = array_map( 'trim', $id );
            $args = array(
                'post_type' => 'product',
                'post_status' => 'publish',
                'post__in' => $product_id,
                'orderby' => 'ID',
                'order'   => 'ASC',
                'posts_per_page' => -1,                        
            );
            $query = new WP_Query( $args ); 
            if ( $query->have_posts() && $post_id != '' ) :  ?>
                    <div class="sip">
                        <div class="piko-carousel" data-slick='{"slidesToShow": <?php echo esc_attr($slide); ?>,"slidesToScroll": 1,"responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 3}},{"breakpoint": 768,"settings":{"slidesToShow": 2}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>

                        <?php
                        while ( $query->have_posts() ) : $query->the_post();                            
                            wc_get_template_part( 'content', 'product' );                            
                        endwhile; // end of the loop.
                        wp_reset_postdata(); ?>
                        </div>
                    </div>
            <?php
            endif;
            
            
	}
}
if ( !function_exists( 'xtocky_woocommerce_add_filter_product_tab_video' ) ) {
	function xtocky_woocommerce_add_filter_product_tab_video( $tabs )
	{
		global $product, $post;
                $enable =  get_post_meta(get_the_ID(),'xtocky_enable_custom_tab_video',true);
		if ( $enable == '1') {
			$tabs[ 'custom_tab_video' ] = array(
				'title'    =>  esc_html__('video', 'xtocky'),
				'priority' => 49,
				'callback' => 'xtocky_woocommerce_add_custom_product_tab_video_callback'
			);
		}
		return $tabs;
	}
}

if ( !function_exists( 'xtocky_woocommerce_add_custom_product_tab_video_callback' ) ) {
	function xtocky_woocommerce_add_custom_product_tab_video_callback()	{
             $embaded = wp_oembed_get(get_post_meta(get_the_ID(), 'xtocky_product_custom_tab_video', true ));            
             echo '<div class="embed-responsive embed-responsive-16by9">' . do_shortcode($embaded) . '</div>';
	}
}

if ( !function_exists( 'xtocky_woocommerce_add_single_product_images_gallery' ) ) {
	function xtocky_woocommerce_add_single_product_images_gallery()	{
            
            $meta_values = get_post_meta( get_the_ID(), 'xtocky_product_single_image_gallery', false );            
            if(count($meta_values) > 0):
                echo ' <div class="mb90 mb70-sm mb50-xs"></div><div class="more-photos popup-gallery"><div class="row">';
                $index = 0;
                foreach( $meta_values as $image):
                    $urls = wp_get_attachment_image_src($image,'full');
                    $urls_thumb = wp_get_attachment_image_src($image,'thumbnail');                   
                        $img = '';
                        if(count($urls)>0){
                            $resize = matthewruddy_image_resize($urls[0],891,495);
                            if($resize!=null && is_array($resize) )
                                $img = $resize['url'];
                        }
                        ?>
                        <div class="col-sm-6 mb30">
                            <div class="pt-overlay pr pt-content">
                                <figure class="overlay">
                                    <img src="<?php echo esc_url($img) ?>" alt="<?php the_title_attribute(); ?>">
                                    <figcaption class="pa c-center text-center">        
                                        <a href="<?php echo esc_url($urls[0]) ?>" data-thumb="<?php echo esc_url($urls_thumb[0]) ?>" class="zoom-btn"><i class="icon-search"></i></a>
                                    </figcaption> 
                                </figure>
                            </div>
                        </div>
                        <?php                  
                endforeach;
                 echo '</div></div>';
            endif;
            
             
	}
}

if ( !function_exists( 'xtocky_woocommerce_add_filter_product_tabs' ) ) {
	function xtocky_woocommerce_add_filter_product_tabs( $tabs )
	{
		global $product, $post;
               
                $custom_html_enable =  get_post_meta(get_the_ID(), 'xtocky_enable_custom_tab_html',true);

                if ( $custom_html_enable === '0') {  
                    $custom_html_enable = xtocky_get_option_data( 'woo_custom_tab', 0 );                    
                }
                $custom_tab_heading =  get_post_meta(get_the_ID(), 'xtocky_product_custom_tab_heading',true);
                if (!isset($custom_tab_heading) || $custom_tab_heading == '-1' || $custom_tab_heading == '') {
                    $custom_tab_heading = xtocky_get_option_data( 'custom_tab_title', esc_html__('Custom Tab', 'xtocky') );
                }
                
		if ( $custom_html_enable ) {
			$tabs[ 'woo_custom_tab' ] = array(
				'title'    => $custom_tab_heading,
				'priority' => 50,
				'callback' => 'xtocky_woocommerce_add_custom_product_tab_callback'
			);
		}
		return $tabs;
	}
}

if ( !function_exists( 'xtocky_woocommerce_add_custom_product_tab_callback' ) ) {
	function xtocky_woocommerce_add_custom_product_tab_callback()
	{
            $custom_html_tab =  get_post_meta(get_the_ID(), 'xtocky_product_custom_tab_content',true);
            if (!isset($custom_html_tab) || $custom_html_tab == '-1' || $custom_html_tab == '') {
                $custom_html_tab = xtocky_get_option_data( 'custom_tab_content' );
            }
		echo xtocky_add_formatting( $custom_html_tab );
	}
}
function xtocky_woocommerce_product_short_description( ) {
    global $post;
    if ( ! $post->post_excerpt ) {
            return;
    }   
    echo '<p>'. wp_trim_words( get_the_excerpt(), esc_attr(12), ' ... ' ) . '<p>';
//    the_excerpt();

}

if ( !function_exists( 'xtocky_woocommerce_before_checkout_form' ) ) {
	function xtocky_woocommerce_before_checkout_form(){
		?>
		<div class="row">
			<div class="large-6 columns"><?php woocommerce_checkout_login_form();?></div>
			<div class="large-6 columns"><?php woocommerce_checkout_coupon_form();?></div>
		</div>
<?php
	}
}

if ( !function_exists( 'xtocky_woocommerce_review_order_before_payment' ) ) {
	function xtocky_woocommerce_review_order_before_payment(){
		echo sprintf(
			'<h3 class="%s">%s</h3>',
			'woocommerce-checkout-payment-heading',
			esc_html__( 'Payment Methods', 'xtocky' )
		);
	}
}

if ( !function_exists( 'xtocky_woocommerce_init_sortable_taxonomies_brand' ) ) {
	add_filter('woocommerce_sortable_taxonomies','xtocky_woocommerce_init_sortable_taxonomies_brand');
	function xtocky_woocommerce_init_sortable_taxonomies_brand( $return )
	{
		global $current_screen;
		$return[ ] = 'product_brand';
		if ( is_object( $current_screen ) && in_array( $current_screen->id, array( 'edit-product_brand' ) ) ) {
			wp_enqueue_media();
		}
		return $return;
	}
}

add_action( 'init', 'xtocky_woocommerce_setcookie_default' );

add_filter( 'loop_shop_per_page', 'xtocky_woocommerce_override_loop_shop_per_page', 20 );


add_filter( 'woocommerce_placeholder_img_src', 'xtocky_woocommerce_placeholder_img_src' );


/**
 * Customize WooCommerce image dimensions.
 */
function xtocky_wc_customize_image_dimensions() {
	global $pagenow;

	if ( $pagenow != 'themes.php' || ! isset( $_GET['activated'] ) ) {
		return;
	}

	// Update WooCommerce image dimensions.
	update_option(
		'shop_catalog_image_size',
		array( 'width' => '570', 'height' => '760', 'crop' => 1 )
	);

	update_option(
		'shop_single_image_size',
		array( 'width' => '750', 'height' => '1100', 'crop' => 1 )
	);

	update_option(
		'shop_thumbnail_image_size',
		array( 'width' => '160', 'height' => '215', 'crop' => 1 )
	);	
		
}
add_action( 'admin_init', 'xtocky_wc_customize_image_dimensions', 1 );

function xtocky_yith_compare_single_page_btn() {
	update_option('yith_woocompare_compare_button_in_product_page', '0', '');
}
add_action( 'admin_init', 'xtocky_yith_compare_single_page_btn', 1 );

function xtocky_yith_withlist_single_page_btn() {
	return;
}
add_filter( 'yith_wcwl_positions', 'xtocky_yith_withlist_single_page_btn' );



//category header image
if ( !function_exists( 'xtocky_wc_show_cat_page_title' ) ) {
    function xtocky_wc_show_cat_page_title(){  
            
          if ( apply_filters( 'woocommerce_show_page_title', true ) && is_product_category() ) : ?>
                <header class="woocommerce-products-header pr">
                    <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>                    
                </header>
            <?php endif;
        
    }
}


if ( !function_exists( 'xtocky_wc_get_header_image_url' ) ) {
    function xtocky_wc_get_header_image_url($cat_ID = false){            
           if ($cat_ID==false && is_product_category()){
                    global $wp_query;

                    // get the query object
                    $cat = $wp_query->get_queried_object();

                    // get the thumbnail id user the term_id
                    $cat_ID = $cat->term_id;
            }

        $thumbnail_id = get_term_meta($cat_ID, 'header_id', true );

        // get the image URL
       return wp_get_attachment_url( $thumbnail_id ); 
    }
}
if ( !function_exists( 'xtocky_wc_get_header_image_html_start' ) ) {
    function xtocky_wc_get_header_image_html_start(){ 
            if(! function_exists('pikoworks_wc_get_header_image_url') ) return;
            $src = pikoworks_wc_get_header_image_url();
            if(empty($src)) return;
            echo '<div class="pikowc_header_image pr" style="background-image:url('.esc_url($src).')">';
            
    }
}
if ( !function_exists( 'xtocky_wc_get_header_image_html_end' ) ) {
    function xtocky_wc_get_header_image_html_end(){
            if(! function_exists('pikoworks_wc_get_header_image_url') ) return;
            $src = pikoworks_wc_get_header_image_url();
            if(empty($src)) return;
            echo '</div>';
    }
}
<?php
/*
 *  Quick view overide.
 *
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $quickview;
$quickview = true;

while ( have_posts() ) : the_post(); ?>

 <div class="products quick-view-custom row">
    <div itemscope  id="product-<?php the_ID(); ?>" <?php post_class('product row product-single'); ?>>
        <div class="col-sm-6 col-md-7">
            <?php
                /**
                 * woocommerce_before_single_product_summary hook                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked xtocky_quick_view_product_images - 20
                 */
                do_action('xtocky_before_quick_view_product_summary');
            ?>               
        </div>
        <div class="col-sm-6 col-md-5">
            <div class="summary entry-summary product-details">
                <?php
                   
                    the_title( '<h1 class="product_title entry-title"><a href="'.esc_url( get_permalink()).'">', '</a></h1>' );
                    /**
                     * woocommerce_single_product_summary hook
                     * @hooked woocommerce_template_single_price - 10
                     * @hooked woocommerce_template_single_excerpt - 20
                     * @hooked woocommerce_template_single_add_to_cart - 30
                     * @hooked woocommerce_template_single_meta - 40
                     * @hooked woocommerce_template_single_sharing - 50
                     */
                    do_action('woocommerce_single_product_summary');
                ?>
            </div>                
        </div>
    </div>
</div>
<?php endwhile; // end of the loop. ?>

<script type="text/javascript">
    (function($) {
        "use strict";
        $(document).ready(function() {
            var is_rtl = $('body,html').hasClass('rtl');
            if ( is_rtl ) { is_rtl: true; }else{ is_rtl: false; }
        $( '.piko-carousel' ).not( '.slick-initialized' ).slick( {rtl: is_rtl });
        $('.modal-open').lightGallery({
            selector: '.open',
            counter: false,
            download: false,
            enableSwipe: false,
            enableDrag: false
        });
        if ( typeof imagesLoaded === 'function' && $(window).width() > 768) {
            $( '.piko-carousel' ).imagesLoaded( function() {
                    var imgHeight = $( '.quick-view-custom .piko-carousel' ).outerHeight();

                    $( '.yith-wcqv-wrapper, .quick-view-custom .row > div' ).css({
                            'height': imgHeight
                    });
                });            
                }
            });
    })(jQuery);
</script>
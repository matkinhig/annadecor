<?php
/**
 * The Template for displaying all single posts. || edit
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$store_user   = get_userdata( get_query_var( 'author' ) );
$store_info   = dokan_get_store_info( $store_user->ID );
$map_location = isset( $store_info['location'] ) ? esc_attr( $store_info['location'] ) : '';

$products_per_row = isset( $GLOBALS['xtocky']['optn_dokan_products_per_row'] ) ? trim( $GLOBALS['xtocky']['optn_dokan_products_per_row']  ) : 3;



get_header( 'shop' );
?>
    <?php do_action( 'woocommerce_before_main_content' ); ?>    
    <div class="col-xs-12 col-sm-8 col-md-9  has-sidebar-left">
        <div id="dokan-primary" class="dokan-single-store">
            <div id="dokan-content" class="store-page-wrap woocommerce" role="main">

                <?php dokan_get_template_part( 'store-header' ); ?>

                <?php do_action( 'dokan_store_profile_frame_after', $store_user, $store_info ); ?>

                <?php if ( have_posts() ) { ?>

                    <div class="seller-items">

                        <?php woocommerce_product_loop_start(); ?>
                            <div class="product-container-row">
                                <div class="products-container max-col-<?php echo esc_attr($products_per_row);?>" data-layoutmode="fitRows">

                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php wc_get_template_part( 'content', 'product' ); ?>

                            <?php endwhile; // end of the loop. ?>

                        <?php woocommerce_product_loop_end(); ?>
                                </div>
                            </div>

                    </div>

                    <?php dokan_content_nav( 'nav-below' ); ?>

                <?php } else { ?>

                    <p class="dokan-info"><?php esc_html_e( 'No products were found of this vendor!', 'xtocky' ); ?></p>

                <?php } ?>
            </div>

        </div><!-- .dokan-single-store -->
    </div>
    <div class="widget-area  col-xs-12 col-sm-4 col-md-3 sidebar sidebar-left">
    <?php if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' ) == 'off' ) { ?>    
        <div id="dokan-secondary" class="dokan-clearfix dokan-store-sidebar" role="complementary">
            <div class="dokan-widget-area widget-collapse">
                 <?php do_action( 'dokan_sidebar_store_before', $store_user, $store_info ); ?>
                <?php
                if ( ! dynamic_sidebar( 'sidebar-store' ) ) {

                    $args = array(
                        'before_widget' => '<aside class="widget">',
                        'after_widget'  => '</aside>',
                        'before_title'  => '<h3 class="widget-title">',
                        'after_title'   => '</h3>',
                    );

                    if ( class_exists( 'Dokan_Store_Location' ) ) {
                        the_widget( 'Dokan_Store_Category_Menu', array( 'title' => esc_html__( 'Store Category', 'xtocky' ) ), $args );

                        if ( dokan_get_option( 'store_map', 'dokan_general', 'on' ) == 'on'  && !empty( $map_location ) ) {
                            the_widget( 'Dokan_Store_Location', array( 'title' => esc_html__( 'Store Location', 'xtocky' ) ), $args );
                        }

                        if ( dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on' ) {
                            the_widget( 'Dokan_Store_Contact_Form', array( 'title' => esc_html__( 'Contact Vendor', 'xtocky' ) ), $args );
                        }
                    }

                }
                ?>

                <?php do_action( 'dokan_sidebar_store_after', $store_user, $store_info ); ?>
            </div>
        </div><!-- #secondary .widget-area -->
    <?php
    } else {
        get_sidebar( 'store' );
    }
    ?>
    </div>    
    <?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer( 'shop' ); ?>
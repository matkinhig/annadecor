<?php
/**
 * edit
 * 
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header( 'shop' );

$sidebar_position = isset( $GLOBALS['xtocky']['optn_product_sidebar_pos'] ) ? trim( $GLOBALS['xtocky']['optn_product_sidebar_pos'] ) : 'fullwidth';
$left_sidebar = isset( $GLOBALS['xtocky']['optn_product_sidebar'] ) ? trim( $GLOBALS['xtocky']['optn_product_sidebar'] ) : '';
$right_sidebar = isset( $GLOBALS['xtocky']['optn_product_sidebar_left'] ) ? trim( $GLOBALS['xtocky']['optn_product_sidebar_left'] ) : '';
$primary_class = xtocky_primary_product_class();
$secondary_class = xtocky_secondary_product_class();




?>
<?php if ( $sidebar_position == 'both' ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( $right_sidebar ); ?>
	</aside><!-- .sidebar left.widget-area -->
<?php endif; ?>

   <div id="primary" class="content-area <?php echo esc_attr( $primary_class ); ?>">
		<main id="main" class="site-main" role="main">                   
	<?php
        
                
        
		/**
                 * Hook: woocommerce_before_main_content.
                 *
                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                 * @hooked woocommerce_breadcrumb - 20
                 * @hooked WC_Structured_Data::generate_website_data() - 30
                 */
                do_action( 'woocommerce_before_main_content' );
	?>
		

		<?php
                    /**
                     * Hook: woocommerce_archive_description.
                     *
                     * @hooked woocommerce_taxonomy_archive_description - 10
                     * @hooked woocommerce_product_archive_description - 10
                     */
                    do_action( 'woocommerce_archive_description' );
                ?>

		<?php if ( have_posts() ) {
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked xtocky_woocommerce_toolbar
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );  
                                
                                woocommerce_product_loop_start();
				
                                
                                if ( wc_get_loop_prop( 'total' ) ) {
                                        while ( have_posts() ) {
                                                the_post();

                                                /**
                                                 * Hook: woocommerce_shop_loop.
                                                 *
                                                 * @hooked WC_Structured_Data::generate_product_data() - 10
                                                 */
                                                do_action( 'woocommerce_shop_loop' );

                                                wc_get_template_part( 'content', 'product' );
                                        }
                                }
                                
                                
                                
			 woocommerce_product_loop_end(); 
                        /**
                         * woocommerce_after_shop_loop hook.
                         *
                         * @hooked woocommerce_pagination - 10
                         */
                        do_action( 'woocommerce_after_shop_loop' );
		} else {
                        /**
                         * Hook: woocommerce_no_products_found.
                         *
                         * @hooked wc_no_products_found - 10
                         */
                        do_action( 'woocommerce_no_products_found' );
                }

            /**
             * Hook: woocommerce_after_main_content.
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            do_action( 'woocommerce_after_main_content' );
	?>                        
    </main>
</div>                       
                  
<?php if ( $sidebar_position != 'fullwidth' || $sidebar_position == 'both' ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( $left_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>                       

<?php get_footer( 'shop' ); ?>

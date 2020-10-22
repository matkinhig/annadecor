<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author 	WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' );



$prefix = 'xtocky_';
$sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
if (($sidebar_position === '') || ($sidebar_position == '-1')) {
    $sidebar_position =  isset( $GLOBALS['xtocky']['optn_product_single_sidebar_pos'] ) ? $xtocky['optn_product_single_sidebar_pos'] : 'fullwidth';

} 

$primary_class = xtocky_primary_product_single_sidebar_class();
$secondary_class = xtocky_secondary_product_single_sidebar_class();

$left_sidebar =  get_post_meta(get_the_ID(), $prefix . 'page_right_sidebar',true);


if (($left_sidebar === '') || ($left_sidebar == '-1')) {    
    $left_sidebar =  isset( $GLOBALS['xtocky']['optn_product_single_sidebar'] ) ? $xtocky['optn_product_single_sidebar'] : 'sidebar-4';
}
$right_sidebar =  get_post_meta(get_the_ID(), $prefix . 'page_left_sidebar',true);
if (($right_sidebar === '') || ($right_sidebar == '-1')) {
    $right_sidebar =  isset( $GLOBALS['xtocky']['optn_product_single_sidebar_left'] ) ? $xtocky['optn_product_single_sidebar_left'] : '';
}

$single_layout= xtocky_get_option_data('optn_product_single_layout', 'product');

?>
<?php if ( $sidebar_position == 'both' ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( $right_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
        
<div id="primary" class="content-area <?php echo esc_attr( $primary_class ); ?>">
	<main id="main" class="site-main" role="main">
	<?php
		/**
                 * @remove hook  woocommerce_output_content_wrapper
                 * 
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-'.$single_layout ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
                 * 
                 *  @Remove hook: woocommerce_output_content_wrapper_end
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
	?>
   </main>
</div>          
        
<?php if ( $sidebar_position != 'fullwidth' || $sidebar_position == 'both' ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php 
                xtocky_product_brand_image_single(); //add brand details
                dynamic_sidebar( $left_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>        

<?php get_footer( 'shop' ); ?>

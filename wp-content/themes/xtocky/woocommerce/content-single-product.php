<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
$prefix = 'xtocky_';
$tab_layout =  get_post_meta(get_the_ID(), $prefix . 'single_tab_layout',true);
if (!isset($tab_layout) || $tab_layout == '') {
   $tab_layout = isset( $GLOBALS['xtocky']['optn_woo_single_tab_layout'] ) ? trim( $GLOBALS['xtocky']['optn_woo_single_tab_layout'] ) : '1';
}
$thumbnail =  get_post_meta(get_the_ID(), $prefix . 'single_products_thumbnail',true);
if (!isset($thumbnail) || $thumbnail == '-1' || $thumbnail == '') {
    $thumbnail = isset( $GLOBALS['xtocky']['optn_woo_single_products_thumbnail'] ) ? trim( $GLOBALS['xtocky']['optn_woo_single_products_thumbnail'] ) : 'bottom';
}
$content_center = '';
$c_center = xtocky_get_option_data('enable_content_center', 0);
if($c_center){
    $content_center = ' dfb';  
}
if( !$product->is_type( 'variable' ) ){
  add_action( 'woocommerce_after_add_to_cart_button', 'xtocky_wc_template_single_product_button_action' ); 
} 

$col_left = 'col-sm-7 pr'; 
$col_right = 'col-sm-5'; 
if($thumbnail === '3'){  
   $col_left = $col_right = 'max-width'; 
}
?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form(); // WPCS: XSS ok.
	 	return;
	 }
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
    <div class="row <?php echo esc_html($content_center) ?>">
        
        <div class="<?php echo esc_attr($col_left); ?>">
            
	<?php
		/**
		 * woocommerce_before_single_product_summary hook.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?> 
                
        </div> <!--piko-woo-left-col-->     
        
        <div class="<?php echo esc_attr($col_right); ?>">        
	<div class="summary entry-summary product-details">

		<?php                        
			/**
			 * woocommerce_single_product_summary hook.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>
	</div><!-- .summary -->	
        </div>
        
    </div> <!-- .piko-woo-single-wrap -->   
   
     <?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
    
    
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
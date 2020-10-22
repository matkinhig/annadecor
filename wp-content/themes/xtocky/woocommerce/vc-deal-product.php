<?php
/**
 * @vc deals product
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}
/**
 * woocommerce hook.
 */
do_action( 'woocommerce_before_shop_loop_item' );
do_action( 'xtocky_deal_before_shop_loop_item_title' );
do_action( 'xtocky_deal_after_shop_loop_item_title' );
do_action( 'woocommerce_after_shop_loop_item' );

?>
	

<?php
/**
 * Product Loop Start || edit
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
 * @version     3.3.0
 */

global $woocommerce_loop , $wp_rewrite , $wp_query;




if ( ( isset($woocommerce_loop['columns']) && $woocommerce_loop['columns'] != "" ) ) {
	$products_per_column = $woocommerce_loop['columns'];
} else {
	$products_per_column = xtocky_get_option_data('optn_woo_products_per_row',3);
	if (isset($_GET["products_per_row"])) $products_per_column = $_GET["products_per_row"];
}


$mode_view = 'grid';
$class = '';
$data_attribute_infinite = '';
?>

<?php
if( is_archive() || is_product_taxonomy() ){
	$mode_view = apply_filters('xtocky_filter_products_mode_view','grid');
	$enable_product_infinite =  xtocky_get_option_data('shop_enable_infinite_scroll',false);

	$rand_id = uniqid();

	if ( $enable_product_infinite ){
		$page_num = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$page_link = get_pagenum_link();
		if ( !$wp_rewrite->using_permalinks() || is_admin() || strpos($page_link, '?') ) {
			if (strpos($page_link, '?') !== false)
				$page_path = apply_filters( 'get_pagenum_link', $page_link . '&amp;paged=');
			else
				$page_path = apply_filters( 'get_pagenum_link', $page_link . '?paged=');
		} else {
			$page_path = apply_filters( 'get_pagenum_link', $page_link . user_trailingslashit( $wp_rewrite->pagination_base . "/" ));
		}
		$data_attribute_infinite = 'data-page_num="' . esc_attr( $page_num ) . '" ';
		$data_attribute_infinite .= 'data-page_num_max="' . esc_attr( $wp_query->max_num_pages ) . '" ';
		$data_attribute_infinite .= 'data-path="' . esc_url( $page_path ) . '" ';

		$class .= 'products-infinite-container ';
	}
	?>
<?php
}
$products_per_row = isset( $GLOBALS['xtocky']['optn_woo_products_per_row'] ) ? trim( $GLOBALS['xtocky']['optn_woo_products_per_row']  ) : 3;
$per_row_mobile = xtocky_get_option_data( 'optn_woo_products_per_row_mobile', '' );
$class .= "{$mode_view} products products-{$mode_view} columns-{$products_per_column}";

if( is_archive() || is_product_taxonomy() || is_product_tag() ): ?>
    <div class="products product-container-row row products-container max-col-<?php echo esc_attr($products_per_row .' '. $per_row_mobile);?> <?php echo esc_attr($class)?>" data-layoutmode="fitRows">
<?php
else: ?>
     <div class="products row">
<?php
endif;





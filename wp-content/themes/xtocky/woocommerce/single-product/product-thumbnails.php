<?php
/**
 * Single Product Thumbnails || edit add carousel
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
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
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce, $quickview;

if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
	$attachment_ids = $product->get_gallery_attachment_ids();
} else {
	$attachment_ids = $product->get_gallery_image_ids();
}
$attachment_count = count( $attachment_ids );
$prefix = 'xtocky_';
$thumbnail =  get_post_meta(get_the_ID(), $prefix . 'single_products_thumbnail',true);
if (!isset($thumbnail) || $thumbnail == '-1' || $thumbnail == '') {
    $thumbnail = xtocky_get_option_data( 'optn_woo_single_products_thumbnail', 'bottom');
}

// Get page options
$options = get_post_meta( get_the_ID(), '_custom_wc_options', true );
if( $quickview == true){
    return;
}

if ( $attachment_ids && has_post_thumbnail() ) {
	?>
	<div class="piko-nav piko-carousel oh" data-slick='{"slidesToShow": 4,"slidesToScroll": 1,"arrows": false, "focusOnSelect": true,"asNavFor": ".piko-thumb", <?php if ( $thumbnail == 'left' || $thumbnail == 'right' ) echo '"vertical": true,"verticalSwiping": true,'; ?> "responsive":[{"breakpoint": 991,"settings":{"slidesToShow": 3}},{"breakpoint": 576,"settings":{"slidesToShow": 4, "vertical":false,"verticalSwiping": false}}]}'>
		<?php
			$image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_thumbnail' ), array(
				'title'	=> get_the_title( get_post_thumbnail_id() )
			) );

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div>%s</div>', $image ), $post->ID );

			foreach ( $attachment_ids as $attachment_id ) {
				$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
				$thumbnail        = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
				$thumbnail_post   = get_post( $attachment_id );
				$image_title      = get_post_field( 'post_title', $attachment_id );

				$attributes = array(
					'title'                   => $image_title,
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);

				$html = '<div>' . wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes ) . '</div>';

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
			}
		?>
	</div>
	<?php
}

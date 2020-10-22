<?php
/**
 * @author  Themepiko
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

?>



<h2 class="product_title entry-title"><?php the_title(); ?></h2>
<?php if ( $price_html = $product->get_price_html() ) : ?>
        <span class="price"><?php echo do_shortcode( $price_html); ?></span>
<?php endif; ?>
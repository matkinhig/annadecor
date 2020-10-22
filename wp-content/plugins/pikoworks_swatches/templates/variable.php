<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product, $quickview;
$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

$default = array();

$vs_options = get_option('pikoworks_vs_option');

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>
		<div class="variations">
			<?php foreach ( $attributes as $attribute_name => $options ) : ?>
				<div class="product-attribute">
					<h4 class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></h4>
					<div style="display: none;">
					<?php $selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
						wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
					?>
					</div>
					<?php $name = $attribute_name; ?>
					<div class="atttribute-value">
						<ul id="<?php echo esc_attr( sanitize_title( $name ) ); ?>" class="vs_warp">
							<?php
								if ( is_array( $options ) ) {

									if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
										$selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $name ) ];
									} elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
										$selected_value = $selected_attributes[ sanitize_title( $name ) ];
										$default[sanitize_title( $name )] = $selected_value;
									} else {
										$selected_value = '';
									}

									// Get terms if this is a taxonomy - ordered
									if ( taxonomy_exists( $name ) ) {
										$terms = wc_get_product_terms( $product->get_id(), $name, array( 'fields' => 'all' ) );
										foreach ( $terms as $term ) {
											if ( ! in_array( $term->slug, $options ) ) {
												continue;
											}
											$class = ( sanitize_title( $selected_value ) == sanitize_title( $term->slug ) ) ? 'selected' : '';

											$thumbnail_id = absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) );
											$image = Pikoworks_VS_Core::get_variation_image_id( $term->term_id, $product->get_id() );
											if ( $image ) {
												$style = "background-image: url('" . esc_url( $image ) . "');text-indent: -99em";
											} else {
												$style = '';
											}

											echo '<li option-value="' . esc_attr( $term->slug ) . '" title="' . esc_attr( $term->name ) . '" class="vs_attribute ' . esc_attr( $class ) . '  ' . esc_attr( $term->slug ) . '" ><span style="' . esc_attr( $style ) . '">' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</span></li>';
										}
									}
								}
							?>
						</ul>
					</div><?php  echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations dib" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) : ''; ?>
				</div>
			<?php endforeach;?>
		</div>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap" style="display:none;">
			<?php
				/**
				 * woocommerce_before_single_variation Hook
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * woocommerce_after_single_variation Hook
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
	<script type="text/javascript">
		(function($) {
			"use strict";
			<?php if ( ! empty( $available_variations ) ) : ?>
				function vs_image_gallery( productId, option ) {

					if ( ! $( '#product-' + productId + ' .piko-product-imges' ).hasClass( 'processing' ) ) {
						$.ajax({
							type: 'post',
							url: vs_ajax_url,
							data: {
								action: 'vs_gallery_image',
                                option: option,
								product_id: productId								
							},
							dataType: 'html',
							beforeSend: function() {
								$( '#product-' + productId + ' .piko-product-imges' ).addClass( 'processing' );
							},
							success: function( data ) {								
								if ( data.length > 0 ) {
									$( document.body ).trigger( 'vs_update_galllery',{ 'html': data, 'productId': productId });
								}
                                $( '#product-' + productId + ' .piko-product-imges' ).removeClass( 'processing' );
								<?php if ( $quickview ) : ?>
									if ( ! $( '.images' ).hasClass( 'piko-carousel' ) ) {
										$( '.images' ).not( '.slick-initialized' ).slick({
											'fade': true
										});
									}
								<?php endif; ?>
							}
						});
					}
				}
			<?php endif; ?>

			$( document ).ready( function() {
				<?php if ( ! empty( $available_variations ) ) : ?>

					<?php if ( $vs_options['attribute_image_select'] != '' ) : ?>
                                                $( 'select#<?php echo esc_attr( $vs_options['attribute_image_select'] ); ?>' ).change(function() {    
							var selected = $( this ).val();
							if ( selected != '' ) {
								vs_image_gallery( '<?php echo ( int )$product->get_id(); ?>',selected );
							}
						});
					<?php endif; ?>

				<?php endif; ?>

				<?php if ( ! empty( $available_variations )  ) : ?>

					var attributes = [<?php foreach ( $attributes as $name => $options ): ?> '<?php echo esc_attr( sanitize_title( $name ));?>', <?php endforeach; ?>],
						$variation_form     = $('.variations_form'),
						$product_variations = $variation_form.data( 'product_variations' );

					$( 'li.vs_attribute' ).on( 'click touchstart', function() {
						var current = $( this );
						if ( ! current.hasClass( 'selected' ) ) {
							var value = current.attr( 'option-value' ),
								selector_name = current.closest( 'ul' ).attr( 'id' );

							if ( selector_name == attributes[0] ) {
								$( 'ul.vs_warp li' ).each( function() {
									$( this ).removeClass( 'selected' );
								});
								$variation_form.find( '.variations select' ).val( '' ).change();
								$variation_form.trigger( 'reset_data' );
							}

							if ( $( 'select#' + selector_name ).find( 'option[value="' + value + '"]' ).length > 0 ) {
								$( this ).closest( 'ul' ).children( 'li' ).each( function() {
									$( this ).removeClass( 'selected' );
									$( this ).removeClass( 'disable' );
								});
								if ( ! $( this ).hasClass( 'selected' ) ) {
									current.addClass( 'selected' );

									$( 'select#' + selector_name ).val( value ).change();
									$( 'select#' + selector_name ).trigger( 'change' );

									// Init after gallery.
									setTimeout( function() {
										$variation_form.trigger( 'check_variations' );
										$variation_form.trigger( 'wc_variation_form' );
									}, 100 );
								}
							} else {
								current.addClass( 'disable' );
							}							
						}
					});

					$variation_form.on( 'reset_data', function() {
						$variation_form.find( '.variations select' ).each( function() {
							if ( $( this ).val() == '' ) {
								var id = $( this ).attr( 'id' );
								$( 'ul#' + id + ' li' ).removeClass( 'selected' );
							}
						});
					});
				<?php endif; ?>
			});
		} )( jQuery );
	</script>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

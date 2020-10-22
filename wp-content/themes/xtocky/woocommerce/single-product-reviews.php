<?php
/**
 * Display single product reviews (comments) || edit
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
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
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

$prefix = 'xtocky_';
$thumbnail =  get_post_meta(get_the_ID(), $prefix . 'single_products_thumbnail',true);
if (!isset($thumbnail) || $thumbnail == '-1' || $thumbnail == '') {
    $thumbnail = isset( $GLOBALS['xtocky']['optn_woo_single_products_thumbnail'] ) ? trim( $GLOBALS['xtocky']['optn_woo_single_products_thumbnail'] ) : '1';
}


?>
<div id="reviews" class="product-comments-section">
    <div class="row">
        <?php if($thumbnail != '3'): ?>
        
        <div id="comments" class="comments col-md-6">
		<?php if ( have_comments() ) : ?>
                        <h2 class="comments-section-title woocommerce-Reviews-title">
			<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
			} else {
				esc_html_e( 'Reviews', 'woocommerce' );
			}
			?>
                            
            </h2>
			<ol class="commentlist media-list">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

		<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>

		<?php endif; ?>
	</div>
        <?php endif; ?>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

		<div id="review_form_wrapper" class="col-md-6">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();
                                        $req = get_option( 'require_name_email' );
                                        $aria_req = ( $req ? " aria-required='true'" : '' );

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a review', 'woocommerce' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
						'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<div class="form-group label-overlay">
                    <input type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' required>
                    <label class="input-desc"><span class="icon-user"></span>' . esc_html__( 'Name', 'woocommerce' ) .
                ( $req ? ' <span class="input-required">*</span>' : '' ) .'</label>
                </div>',
                                                    
							'email'  => '<div class="form-group label-overlay">
                    <input id="email" name="email" type="text" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" ' . $aria_req . ' required>
                    <label class="input-desc"><span class="icon-envalop2"></span>' . esc_html__( 'Email', 'woocommerce' ) .
                    ( $req ? ' <span class="input-required">*</span>' : '' ) .' </label>
                </div>',
						),
						'label_submit'  => __( 'Submit', 'woocommerce' ),
						'logged_in_as'  => '',
						'comment_field' => ''
					);

					$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %slogged in%S to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

				if ( wc_review_ratings_enabled() ) {
					$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
					</select></div>';
				}

					$comment_form['comment_field'] .= '<div class="form-group textarea-group mb30 label-overlay">
                                    <textarea id="comment" name="comment" cols="20" rows="5" class="form-control min-height" aria-required="true" required></textarea>
                                    <label class="input-desc"><span class="icon-pencil"></span>' . esc_html__( 'Your review', 'woocommerce' ) . ' <span class="input-required">*</span></label>
                                </div>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

	<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

	<?php endif; ?>
                
        <?php if($thumbnail === '3'): ?>        
        <div id="comments" class="comments col-xs-12 pb130 pb100-sm pb80-xs">
		<?php if ( have_comments() ) : ?>
                        <h2 class="comments-section-title text-uppercase text-center">
			<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
			} else {
				esc_html_e( 'Reviews', 'woocommerce' );
			}
			?>
                        </h2>
                        <?php if (get_option( 'woocommerce_enable_review_rating' ) === 'yes' && $rating_count > 0 ) : ?> 
                        <div class="text-center mb55 mb40-sm mb30-xs ">   
                            <div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'xtocky' ), $average ); ?>">
                                    <span style="width:<?php echo ( ( esc_html($average) / 5 ) * 100 ); ?>%">
                                            <strong class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'xtocky' ), '<span>', '</span>' ); ?>
                                            <?php printf( esc_html(_n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'xtocky' )), '<span class="rating">' . esc_html($rating_count) . '</span>' ); ?>
                                    </span>
                            </div>
                        </div>
                        <?php endif; ?>
			<ol class="commentlist media-list">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

		<?php endif; ?>
	</div>
        <?php endif; ?>        

	<div class="clear"></div>
    </div> <!--end of row-->
</div>
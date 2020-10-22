<?php
/**
 * Review Comments Template || eidit
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;
$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

$prefix = 'xtocky_';
$thumbnail =  get_post_meta(get_the_ID(), $prefix . 'single_products_thumbnail',true);
if (!isset($thumbnail) || $thumbnail == '-1' || $thumbnail == '') {
    $thumbnail = isset( $GLOBALS['xtocky']['optn_woo_single_products_thumbnail'] ) ? trim( $GLOBALS['xtocky']['optn_woo_single_products_thumbnail'] ) : '1';
}



?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class('media'); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container comment">

		<?php
		/**
		 * The woocommerce_review_before hook
		 *
		 * @hooked woocommerce_review_display_gravatar - 10
		 */
                echo '<div class="media-left">';
		//do_action( 'woocommerce_review_before', $comment );
                echo get_avatar( $comment, 110); 
                echo '</div>';
		?>
                <?php if($thumbnail == 3):  ?> 
                <div class="media-left">
                    <h4><?php do_action( 'woocommerce_review_meta', $comment ); ?></h4>
                    <div class="ratings-container">                    
                    <?php  do_action( 'woocommerce_review_before_comment_meta', $comment ); ?>
                    </div>
                </div>
                <?php endif; ?>

		<div class="comment-text media-body">
                    <div class="media-body-wrapper">

			<?php
			/**
			 * The woocommerce_review_before_comment_meta hook.
			 *
			 * @hooked woocommerce_review_display_rating - 10
			 */
			do_action( 'woocommerce_review_before_comment_meta', $comment );

			
			/**
			 * The woocommerce_review_comment_text hook
			 *
			 * @hooked woocommerce_review_display_comment_text - 10
			 */
			do_action( 'woocommerce_review_comment_text', $comment );

			do_action( 'woocommerce_review_after_comment_text', $comment );
                        
                        
                        /**
			 * The woocommerce_review_meta hook.
			 *
			 * @hooked woocommerce_review_display_meta - 10
			 */
                        echo '<div class="comment-date">';
			do_action( 'woocommerce_review_meta', $comment );

			do_action( 'woocommerce_review_before_comment_text', $comment );
                         echo '</div>';
                        
                        ?>
                        
                        

                    </div>
		</div>
	</div>

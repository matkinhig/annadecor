<?php
/**
 * The template for displaying search results pages
 *
 */

get_header();

$sidebar_position = isset( $GLOBALS['xtocky']['optn_search_sidebar_pos'] ) ? trim( $GLOBALS['xtocky']['optn_search_sidebar_pos'] ) : 'right';
$left_sidebar = isset( $GLOBALS['xtocky']['optn_search_sidebar'] ) ? trim( $GLOBALS['xtocky']['optn_search_sidebar'] ) : 'sidebar';
$right_sidebar = isset( $GLOBALS['xtocky']['optn_search_sidebar_left'] ) ? trim( $GLOBALS['xtocky']['optn_search_sidebar_left'] ) : '';
$primary_class = xtocky_primary_search_class();
$secondary_class = xtocky_secondary_search_class();

?>
<?php if ( $sidebar_position == 'both' ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( $right_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>

	<section id="primary" class="content-area <?php echo esc_attr( $primary_class ); ?>">
		<main id="main" class="site-main  hsc" role="main">

		<?php if ( have_posts() ) : ?>
			<?php
                        /**
                         * xtocky_before_loop_posts hook
                         * 
                         * @hooked xtocky_before_loop_posts_wrap - 10 (locate in inc/template-tags.php )
                         **/ 
                        do_action( 'xtocky_before_loop_posts' ); 
                        
                        
			// Start the loop.
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			// End the loop.
			endwhile;
                        
                        
                        /**
                         * xtocky_after_loop_posts hook
                         * 
                         * @hooked xtocky_after_loop_posts_wrap - 10 (locate in inc/template-tags.php )
                         **/ 
                        do_action( 'xtocky_after_loop_posts' ); 

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => esc_html__( 'Previous page', 'xtocky'),
				'next_text'          => esc_html__( 'Next page', 'xtocky'),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'xtocky' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/archive/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php if ( $sidebar_position != 'fullwidth' || $sidebar_position == 'both' ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( $left_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
<?php get_footer(); ?>

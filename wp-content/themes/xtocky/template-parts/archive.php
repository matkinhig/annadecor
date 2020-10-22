<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header();


$sidebar_position = isset( $GLOBALS['xtocky']['optn_blog_sidebar_pos'] ) ? trim( $GLOBALS['xtocky']['optn_blog_sidebar_pos'] ) : 'right';
$left_sidebar = isset( $GLOBALS['xtocky']['optn_blog_sidebar'] ) ? trim( $GLOBALS['xtocky']['optn_blog_sidebar'] ) : 'sidebar';
$right_sidebar = isset( $GLOBALS['xtocky']['optn_blog_sidebar_left'] ) ? trim( $GLOBALS['xtocky']['optn_blog_sidebar_left'] ) : '';
$archive_layout_style = isset( $GLOBALS['xtocky']['optn_archive_display_type'] ) ? trim( $GLOBALS['xtocky']['optn_archive_display_type'] ) : 'default';
$archive_display_columns = isset( $GLOBALS['xtocky']['optn_archive_display_columns'] ) ? trim( $GLOBALS['xtocky']['optn_archive_display_columns'] ) : '1';
$primary_class = xtocky_primary_blog_class();
$secondary_class = xtocky_secondary_blog_class();
$post_count = 0;



switch ($archive_layout_style) {    
    case 'list':
            $GLOBALS['xtocky_archive_loop']['image-size'] = 'xtocky-2cols-image';
            break;
    case 'grid':
        if($archive_display_columns == '1'){
            $GLOBALS['xtocky_archive_loop']['image-size'] = 'full';
        }elseif($archive_display_columns == '2'){
            $GLOBALS['xtocky_archive_loop']['image-size'] = 'xtocky-2cols-image'; 
        }elseif($archive_display_columns == '3'){
            $GLOBALS['xtocky_archive_loop']['image-size'] = 'xtocky-3cols-image'; 
        }elseif($archive_display_columns == '4'){
            $GLOBALS['xtocky_archive_loop']['image-size'] = 'xtocky-4cols-image'; 
        }
        break;
}

?>
<?php if ( $sidebar_position == 'both' ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( $right_sidebar ); ?>
	</aside><!-- .sidebar left.widget-area -->
<?php endif; ?>

	<div id="primary" class="content-area blog-wrap layout-container <?php echo esc_attr( $primary_class . ' ' . $archive_layout_style ); ?>">
		<main id="main" class="site-main hsc">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>
                        
                        <?php                
                        
                        if($archive_layout_style =='masonry'){
                            get_template_part( 'template-parts/archive/content-masonry', get_post_format() ); 
                        }else{                        
                        
			// Start the loop.
			while ( have_posts() ) : the_post(); 
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
                                switch($archive_layout_style){
                                    case 'list':
                                        get_template_part( 'template-parts/archive/content-list', get_post_format() );
                                        break;
                                    
                                    case 'grid':
                                        get_template_part( 'template-parts/archive/content', get_post_format() );
                                        $post_count++;
                                        if($archive_display_columns == '2'){
                                            if ($post_count % 2 == 0) { echo '<div class="clearfix"> </div>';}
                                        }elseif ($archive_display_columns == '3') {
                                             if ($post_count % 3 == 0) { echo '<div class="clearfix"> </div>';}
                                        }elseif($archive_display_columns == '4'){
                                             if ($post_count % 4 == 0) { echo '<div class="clearfix"> </div>';}
                                        }                                        
                                        break;                                   
                                    default:
                                        get_template_part( 'template-parts/content', get_post_format() );
                                                                              
                                }
                                
			// End the loop.
                        endwhile; }                          
                        xtocky_archive_loop_reset();                        
                        
			echo'<div class="clearfix"></div>';                      
                        // Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => esc_html__( 'Previous', 'xtocky'),
				'next_text'          => esc_html__( 'Next', 'xtocky'),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'xtocky' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			xtocky_get_template( 'archive/content', 'none' );

		endif;
		?>   

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php if ( $sidebar_position != 'fullwidth' || $sidebar_position == 'both' ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( $left_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
<?php get_footer(); ?>

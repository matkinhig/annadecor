<?php
/**
 * page the #buddyPress
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 */

get_header();

$prefix = 'xtocky_';

$bp_pagesID = get_option( 'bp-pages' );
if($bp_pagesID['activity']){
    $bpID = $bp_pagesID["activity"];
}elseif($bp_pagesID['members']){
    $bpID = $bp_pagesID["members"];
}elseif($bp_pagesID['register']){
    $bpID = $bp_pagesID["register"];
}else{ //activate page
    $bpID = $bp_pagesID["activate"];
} 


$sidebar_position =  'fullwidth';
if ( isset($sidebar_position) && $sidebar_position != '-1' ) {
    $sidebar_position =  get_post_meta($bpID, $prefix . 'page_sidebar',true);    
} 
$primary_class = xtocky_primary_page_sidebar_class();
$secondary_class = xtocky_secondary_page_sidebar_class();


$left_sidebar =  '';
if (isset($left_sidebar) && $left_sidebar != '-1') {
    $left_sidebar =  get_post_meta($bpID, $prefix . 'page_right_sidebar',true);
}
$right_sidebar =  '';
if (isset($right_sidebar) && $right_sidebar != '-1') {  
    $right_sidebar =  get_post_meta($bpID, $prefix . 'page_left_sidebar',true);   
}

?>
<?php if ( $sidebar_position == 'both' ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( $right_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
        
<div id="primary" class="content-area <?php echo esc_attr( $primary_class ); ?>">
	<main id="main" class="site-main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->
</div><!-- .content-area -->


<?php if ( $sidebar_position != 'fullwidth' || $sidebar_position == 'both' ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( $left_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
<?php get_footer(); ?>

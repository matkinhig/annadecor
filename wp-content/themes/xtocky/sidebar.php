<?php
/**
 * The template for the sidebar containing the main widget area
 *
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

$sidebar_position = isset( $GLOBALS['xtocky']['optn_blog_sidebar_pos'] ) ? trim( $GLOBALS['xtocky']['optn_blog_sidebar_pos'] ) : 'right';
$secondary_class = xtocky_secondary_class();
?>


<?php if ( $sidebar_position != 'fullwidth' ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>

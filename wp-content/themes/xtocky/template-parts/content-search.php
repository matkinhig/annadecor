<?php
/**
 * The template part for displaying results in search pages
 */
$size = 'full';
if (isset($GLOBALS['xtocky_archive_loop']['image-size'])) {
    $size = $GLOBALS['xtocky_archive_loop']['image-size'];
}
$charlength = isset( $GLOBALS['xtocky']['optn_search_except_word'] ) ? trim( $GLOBALS['xtocky']['optn_search_except_word'] ) : '300';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
        <?php
            $thumbnail = xtocky_post_format($size);
            if (!empty($thumbnail)) : ?>
                <figure class="entry-media">
                    <?php echo wp_kses_post($thumbnail); ?>
                    <?php xtocky_entry_masonry_footer(); ?>
                </figure>
            <?php endif; ?>
        <?php xtocky_entry_header();?>
        <div class="entry-excerpt"><p>
            <?php xtocky_trim_word($charlength); //remove vc shortcode ?>
        </p></div><!-- /.entry-content -->
        <?php echo xtocky_read_more_link(); ?>
</article><!-- #post-## -->
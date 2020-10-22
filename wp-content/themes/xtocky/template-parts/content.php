<?php

/**
 * The template part for displaying content
 */

$size = 'full';
if (isset($GLOBALS['xtocky_archive_loop']['image-size'])) {
    $size = $GLOBALS['xtocky_archive_loop']['image-size'];
}

$charlength = isset($GLOBALS['xtocky']['optn_archive_except_word']) ? trim($GLOBALS['xtocky']['optn_archive_except_word']) : '55';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


    <?php
    $thumbnail = xtocky_post_format($size);
    if (!empty($thumbnail)) : ?>
        <figure class="entry-media">
            <?php echo wp_kses_post($thumbnail); ?>
        </figure>
    <?php endif; ?>
    <?php xtocky_entry_header(); ?>
    <div class="entry-excerpt">
        <p><?php xtocky_trim_word($charlength); ?></p>
        <?php
        wp_link_pages(array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'xtocky') . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            'pagelink'    => '<span class="screen-reader-text">' . esc_html__('Page', 'xtocky') . ' </span>%',
            'separator'   => '<span class="screen-reader-text">, </span>',
        ));
        ?>
        <?php echo '<div class="d_flex justify-content-center">' . xtocky_read_more_link() . '</div>'; ?>
    </div>
</article>
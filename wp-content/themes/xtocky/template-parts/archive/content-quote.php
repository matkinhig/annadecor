<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 */
$size = 'full';
if (isset($GLOBALS['xtocky_archive_loop']['image-size'])) {
    $size = $GLOBALS['xtocky_archive_loop']['image-size'];
}
$archive_title_position = isset( $GLOBALS['xtocky']['optn_archive_title_position'] ) ? trim( $GLOBALS['xtocky']['optn_archive_title_position'] ) : 'image-bottom';
$except_word = isset( $GLOBALS['xtocky']['optn_archive_except_word'] ) ? trim( $GLOBALS['xtocky']['optn_archive_except_word'] ) : '55';

$prefix = 'xtocky_';

$quote_content = get_post_meta(get_the_ID(), $prefix.'post_format_quote', true);
$quote_author = get_post_meta(get_the_ID(), $prefix.'post_format_quote_author', true);
$quote_author_url = get_post_meta(get_the_ID(), $prefix.'post_format_quote_author_url', true);

$class = array();
$class[]= "clearfix";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php xtocky_entry_header();?>       
    <div class="entry-content">
        <?php if (empty($quote_content) || empty($quote_author)) : ?>
        <div class="entry-excerpt"> 
            <?php
                    /* translators: %s: Name of current post */                  
                    
                if ( ! has_excerpt() ) {
                    echo '<p>'. wp_trim_words( get_the_content(), esc_attr($except_word), '...  ' ) . '</p>';
                } else { 
                    echo '<p>'. wp_trim_words( the_excerpt(), esc_attr($except_word), '... ' )  . '</p>';
                }

                    wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'xtocky' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'xtocky' ) . ' </span>%',
                            'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );
                ?>                
            </div>
            <?php echo xtocky_read_more_link(); ?>
        <?php else : ?>
            <blockquote>
                <p><?php echo esc_html($quote_content); ?></p>
                <cite><a href="<?php echo esc_url($quote_author_url) ?>" title="<?php echo esc_attr($quote_author); ?>"><?php echo esc_attr($quote_author); ?></a></cite>
            </blockquote>
        <?php endif; ?>
    </div>
</article>

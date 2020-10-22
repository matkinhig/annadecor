<?php
/**
 * The template part for displaying content
 */

$size = 'full';
if (isset($GLOBALS['xtocky_archive_loop']['image-size'])) {
    $size = $GLOBALS['xtocky_archive_loop']['image-size'];
}
$except_word = isset( $GLOBALS['xtocky']['optn_archive_except_word'] ) ? trim( $GLOBALS['xtocky']['optn_archive_except_word'] ) : '55';
$thumbnail = xtocky_post_format($size);

$html_before = $html_middle = $html_after = '';
if(!empty($thumbnail) && get_post_format() != 'audio'){
    $html_before = '<div class="row"><div class="col-md-7">';
    $html_middle = '</div><div class="col-md-5">';
    $html_after = '</div></div>';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>    
            <?php
            echo wp_kses_post($html_before);
            
            if (!empty($thumbnail)) : ?>
                <figure class="entry-media">
                    <?php echo wp_kses_post($thumbnail); ?>
                </figure>
            <?php endif; ?> 
    
         <?php echo wp_kses_post($html_middle); ?>
    
            <?php xtocky_entry_header();?>
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
         <?php echo wp_kses_post($html_after); ?>
</article>
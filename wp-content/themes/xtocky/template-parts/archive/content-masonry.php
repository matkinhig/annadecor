<?php
/**
 * The template part for displaying content
 */
$display_column = isset( $GLOBALS['xtocky']['optn_archive_display_masonry_columns'] ) ? trim( $GLOBALS['xtocky']['optn_archive_display_masonry_columns'] ) : '2';

?>
<div class="row blog-row">
    <div id="blog-item-container" class="max-col-<?php echo esc_attr($display_column) ?>">
<?php

$post_count = 0;
while ( have_posts() ) : the_post(); 


$post_count++;
if ($post_count % 2 == 0) {
    $GLOBALS['xtocky_archive_loop']['image-size'] = 'xtocky-masonry2';
}elseif ($post_count % 3 == 0) {
    $GLOBALS['xtocky_archive_loop']['image-size'] = 'xtocky-masonry3';
}elseif($post_count % 4 == 0){
     $GLOBALS['xtocky_archive_loop']['image-size'] = 'xtocky-masonry4';
}elseif($post_count % 5 == 0){
     $GLOBALS['xtocky_archive_loop']['image-size'] = 'xtocky-masonry5';
}elseif($post_count % 6 == 0){
     $GLOBALS['xtocky_archive_loop']['image-size'] = 'xtocky-masonry1';
}elseif($post_count % 7 == 0){
     $GLOBALS['xtocky_archive_loop']['image-size'] = 'xtocky-masonry3';
}else{
    $GLOBALS['xtocky_archive_loop']['image-size'] = 'xtocky-masonry1';
} 

$size = 'full';
if (isset($GLOBALS['xtocky_archive_loop']['image-size'])) {
    $size = $GLOBALS['xtocky_archive_loop']['image-size'];    
}


$archive_layout_style = isset( $GLOBALS['xtocky']['optn_archive_layout_style'] ) ? trim( $GLOBALS['xtocky']['optn_archive_layout_style'] ) : '';
$except_word = isset( $GLOBALS['xtocky']['optn_archive_except_word'] ) ? trim( $GLOBALS['xtocky']['optn_archive_except_word'] ) : '55';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-grid-wrapper">
        
            <?php
            $thumbnail = xtocky_post_format($size);
            if (!empty($thumbnail)) : ?>
                <figure class="entry-media">
                 <?php echo wp_kses_post($thumbnail); ?>
                 <?php xtocky_entry_masonry_footer(); ?> 
                </figure>
            <?php endif; ?> 
        <div class="entry-content-wrapper">
            <?php xtocky_entry_header();?>
            <div class="entry-content">                
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
        </div>
    </div>
</article>
<?php 
    endwhile;
    xtocky_archive_loop_reset(); 
?>

    </div>        
</div>        
<?php
 //related post
$GLOBALS['xtocky_archive_loop']['image-size'] = 'xtocky-medium-image'; 
$size = 'full';
if (isset($GLOBALS['xtocky_archive_loop']['image-size'])) {
    $size = $GLOBALS['xtocky_archive_loop']['image-size'];    
}
$target_post = isset( $GLOBALS['xtocky']['optn_blog_single_related_target'] ) ? trim( $GLOBALS['xtocky']['optn_blog_single_related_target'] ) : '';
$post_per_page = isset( $GLOBALS['xtocky']['optn_blog_single_related_post_per'] ) ? trim( $GLOBALS['xtocky']['optn_blog_single_related_post_per'] ) : '3';
$column = isset( $GLOBALS['xtocky']['optn_blog_single_related_post_col'] ) ? trim( $GLOBALS['xtocky']['optn_blog_single_related_post_col'] ) : '2';
$excerpt = '18';
if($column == '1'){
  $excerpt = '40';  
}
 
$orig_post = $post;
global $post;
if($target_post == 'tags'){
    $categories = wp_get_post_tags($post->ID);
}else{
    $categories = get_the_category($post->ID); 
}

    if ($categories) {
        $category_ids = array();
        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
        if($target_post == 'tags'){
            $args=array(
                'tag__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page'=> esc_attr($post_per_page), // Number of related posts that will be shown.
            );
        }else{
            $args=array(
                'category__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page'=> esc_attr($post_per_page), // Number of related posts that will be shown.
            );
        } 
        $navigation = $dots = '';
        if(function_exists(xtocky_is_mobile()) ){  
            $navigation = '"arrows":false,'; 
            $dots = '"dots":true,';
        }

        $related_post = new wp_query( $args );
        if( $related_post->have_posts() ): ?>
        <div class="sc-blog hsc sc-bl-3 mb50 related-column-<?php echo esc_attr($column); ?>">
            <h3 class="pa_ba h-line mb40"><?php esc_html_e( 'You may also like', 'xtocky' ); ?></h3>
            <div class="piko-carousel sh" data-slick='{"slidesToShow": <?php echo esc_attr($column .','. $navigation . $dots  ); ?>"slidesToScroll": 1,"responsive":[{"breakpoint": 768,"settings":{"slidesToShow": 1}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>
                <?php while ( $related_post->have_posts() ) : $related_post->the_post(); ?>
                        <div class="entry entry-grid b1">
                            <div class="row">
                            <figure class="entry-media col-md-6">
                                <?php $thumbnail = xtocky_post_format($size);
                                if (!empty($thumbnail)) : ?>                                            
                                        <?php echo wp_kses_post($thumbnail); ?>                                            
                                <?php endif; ?>
                            </figure>
                            <div class="entry-content-wrapper col-md-6">
                                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" data-rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?> 
                                 <?php xtocky_grid_blog_meta(); ?>
                                <div class="entry-content">
                                  <?php 
                                  if ( ! has_excerpt() ) {
                                    echo '<p>'. wp_trim_words( get_the_content(), esc_attr($excerpt), ' ... ' ) . '</p>';
                                    } else { 
                                          echo '<p>'. wp_trim_words( get_the_excerpt(), esc_attr($excerpt), ' ... ' ) .  '</p>';
                                    }                                      
                                  ?> 
                                </div><!-- End .entry-content -->                                
                            </div><!-- end .entry-content-wrapper -->                              
                            </div>                            
                        </div>                 
                <?php endwhile; ?>                
             </div>
        </div>
        <?php    
        endif;
    }
$post = $orig_post;
wp_reset_postdata();
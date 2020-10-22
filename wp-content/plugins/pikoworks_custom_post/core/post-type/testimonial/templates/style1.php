<?php
/**
 * The template part for displaying content
 */
?>
<article class="testimonial <?php esc_attr_e($col_class);?>">
    <figure>        
            <?php 
            if($open_icon == 'yes'){
                echo '<span class="quote fa fa-quote-left"></span>';
            }else{
                the_post_thumbnail(); 
            } ?>
    </figure>
    <blockquote>
        <?php echo '<p>'. wp_trim_words( get_the_excerpt(), esc_attr($excerpt) ) . '</p>'; ?>
        <div class="owner-meta text-center mb15">
            <h4><?php the_title(); ?><span><?php echo get_the_date( 'd.m.Y' );?></span></h4>            
        </div>
    </blockquote> 
</article>
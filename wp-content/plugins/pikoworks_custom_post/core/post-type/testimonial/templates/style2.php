<?php
/**
 * The template part for displaying content
 */
?>
<article class="testimonial <?php esc_attr_e($col_class);?>">
    <figure>
        <span class="quote fa fa-quote-left"></span>
    </figure>
    <blockquote>
        <?php echo '<p>'. wp_trim_words( get_the_excerpt(), esc_attr($excerpt) ) . '</p>'; ?>
        <div class="owner-meta mb15 dt">
            <div class="dtc"><?php the_post_thumbnail(); ?></div><h4 class="dtc"><?php the_title(); ?><span><?php echo get_the_date( 'd.m.Y' );?></span></h4>            
        </div>
    </blockquote> 
</article>



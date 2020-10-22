<?php
/**
 * @widgets post
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


global $product; ?>

<div class="popular-entry">
    <figure>        
        <a href="<?php echo esc_url( get_permalink( ) ); ?>">
            <?php        
            if ( has_post_thumbnail() ) {
               echo wp_get_attachment_image( get_post_thumbnail_id(), 'thumbnail' );
            }
            ?>
        </a>       
    </figure>
    <div class="pentry-meta">        
        <?php 
        xtocky_entry_date();
        the_title( sprintf( '<h5><a href="%s" data-rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' ); ?> 
    </div>
</div>

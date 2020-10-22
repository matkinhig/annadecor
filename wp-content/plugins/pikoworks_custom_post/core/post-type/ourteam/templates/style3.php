<?php
/**
 * The template part for displaying content
 */
?>
<article class="<?php echo $col_class; ?>">
    <div class="member clearfix">
        <div class="col-md-6">
            <figure>
                <?php echo wp_kses_post($img['thumbnail']); ?>  
            </figure>
        </div>
        <div class="col-md-6">
            <div class="member-meta">
                <h3><?php echo get_the_title() ?><span><?php echo esc_html($job) ?></span></h3>   
                <p><?php echo wp_trim_words( get_the_excerpt(), esc_attr( $excerpt ), ''); ?></p>
                <?php 
                        $meta = get_post_meta(get_the_ID(), 'piko_ourteam_social', TRUE);
                        if(isset($meta) && !empty($meta)): 
                    ?>
                    <div class="text-center">
                        <?php                
                        foreach ($meta['ourteam'] as $col) {
                            $socialName = isset($col['socialName']) ? $col['socialName'] : '';
                            $socialLink = isset($col['socialLink']) ? $col['socialLink'] : '';
                            $socialIcon = isset($col['socialIcon']) ? $col['socialIcon'] : '';
                            ?>
                        <a href="<?php echo esc_url($socialLink) ?>" target="_blank" class="dib"
                                   title="<?php echo esc_attr($socialName) ?>"><i
                                        class=" <?php echo esc_attr($socialIcon) ?>" aria-hidden="true"></i></a>
                            <?php
                        }
                        ?>
                   </div>
                    <?php endif; ?>
            </div><!-- End .member-meta -->
        </div>
    </div>
</article>
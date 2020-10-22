<?php
/**
 * 
 */
$content_sticky  = xtocky_get_option_data('optn_portfolio_content_sticky', false);
?>
<article id="post-<?php the_ID(); ?>">
    <div id="portfolio-details" class="mt0">
        <div class="portfolio-single clearfix">
            <div class="col-md-8">
                 <?php if(count($meta_values) > 0): ?>
                    <div class="portfolio-single-media">
                            <?php
                            $index = 0;
                            foreach($meta_values as $image):
                                $urls = wp_get_attachment_image_src($image,'full');
                                $img = '';
                                if(count($urls)>0){
                                    $resize = matthewruddy_image_resize($urls[0],1200,715);
                                    if($resize!=null && is_array($resize) )
                                        $img = $resize['url'];
                                }
                                ?>
                                 <figure><img src="<?php echo esc_url($img) ?>" alt="<?php the_title_attribute(); ?>"> </figure>                               
                            <?php endforeach; ?>
                    </div>    
                    <?php else:        
                       if(count($imgThumbs)>0) :?>
                            <figure>
                                <img alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url($imgThumbs[0])?>" />
                            </figure>    
                        <?php endif; ?>
                    <?php endif; ?>
                <?php if($embaded!=''):
                    echo '<div class="mb10 clearfix"></div><div id="res_videos" class="max-width embed-responsive embed-responsive-16by9">' . $embaded . '</div>'; 
                endif;
                ?>
            </div>
            <div class="col-md-4 <?php if($content_sticky) echo esc_attr('sidebar-sticky'); ?>">
                 <h2 class="mt0 mb20 portfolio-title"><?php the_title(); ?></h2>
                  <?php the_content() ?>
                 <div class="mb5"></div>
                 <ul class="portfolio-details-list">                                    
                    <li>
                        <label><?php echo esc_html__('Date','pikoworks_custom_post') ?></label>
                        <?php echo date(get_option('date_format'),strtotime($post->post_date)) ?>
                    </li>
                    <li>
                        <label><?php echo esc_html__('Category','pikoworks_custom_post') ?></label>
                        <div class="portfolio-tags">
                            <?php echo wp_kses_post($cat); ?>
                        </div>
                    </li>
                    <li>
                        <?php
                            $meta = get_post_meta(get_the_ID(), 'portfolio_custom_fields', TRUE);
                            if(isset($meta) && is_array($meta) && count($meta['portfolio_custom_fields'])>0){
                                for($i=0; $i<count($meta['portfolio_custom_fields']);$i++){
                                ?>
                                <label><?php echo wp_kses_post($meta['portfolio_custom_fields'][$i]['custom-field-title']) ?> </label>
                                <?php echo wp_kses_post($meta['portfolio_custom_fields'][$i]['custom-field-description']) ?>                                           

                                <?php }
                            }
                            ?>
                    </li>
                    <?php if( function_exists('WC') && $GLOBALS['xtocky']['optn_portfolio_social_shear']== '1'): ?>
                    <li class="portfolio-details-share">                       
                        <?php
                            echo'<ul class="social-icons">';
                                xtocky_product_share();
                            echo'</ul>';                                                      
                        ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>        
        </div>
    </div>
   <div class="mb7 mb50-sm mb30-xs"></div>
</article>

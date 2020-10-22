<?php
/**
 * 
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if(count($meta_values) > 0): ?>
    <div class="portfolio-slider sip hsc">       
           <div class="piko-carousel sh" data-slick='{"infinite": false,"slidesToScroll": 1}'>
            <?php
            $index = 0;
            foreach($meta_values as $image):
                $urls = wp_get_attachment_image_src($image,'full');
                $img = '';
                if(count($urls)>0){
                    $resize = matthewruddy_image_resize($urls[0],1920,1147);
                    if($resize!=null && is_array($resize) )
                        $img = $resize['url'];
                }
                ?>
                <figure>
                    <img src="<?php echo esc_url($img) ?>"/>                                   
                </figure>                
            <?php endforeach; ?>
        </div>        
    </div>    
    <?php else:        
       if(count($imgThumbs)>0) :?>
            <div class="clearfix">
                <figure class="col-xs-12">
                    <img alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url($imgThumbs[0])?>" />
                </figure>    
            </div>    
        <?php endif; ?> 
    <?php endif; ?>
    
    <div class="<?php echo esc_attr($single_class) ?>">
        <div id="portfolio-details" class="clearfix">
                <div class="col-md-9">
                    <h2 class="content-title"><?php echo esc_html__('About.','pikoworks_custom_post') ?></h2>
                     <?php the_content() ?>
                </div><!-- End .col-md-9 -->
                <div class="col-md-3">
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
                </div><!-- End .col-md-3 -->            
        </div><!-- End #portfolio-details -->
         <?php if(count($meta_values) > 0): ?>        
        <div class="popup-gallery"> 
            <?php
            $index = 0;
            foreach($meta_values as $image):
                $urls = wp_get_attachment_image_src($image,'full');
                $thumburl = wp_get_attachment_image_src($image,'thumbnail');
                $img = '';
                if(count($urls)>0){
                    $resize = matthewruddy_image_resize($urls[0],900,580);
                    if($resize!=null && is_array($resize) )
                        $img = $resize['url'];
                }
                ?>
                <div class="col-sm-6 more-images">
                    <div class="pr">
                        <div class="pt-overlay pt-meta pt-content">
                            <figure class="overlay">                           
                                 <img src="<?php echo esc_url($img) ?>" alt="<?php the_title_attribute(); ?>"/>                           
                                <figcaption class="pa c-center text-center">
                                     <a href="<?php echo esc_url($urls[0]) ?>" data-thumb="<?php echo esc_url($thumburl[0]) ?>" class="zoom-btn"><i class="icon-search"></i></a>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>                               
            <?php endforeach; ?>            
        </div><!-- End .more-photos-continer -->
        <div class="mb70 mb50-sm mb40-xs clearfix"></div>
        <?php endif; ?>
        <?php if($embaded!=''):
            echo '<div id="res_videos" class="max-width embed-responsive embed-responsive-16by9">' . $embaded . '</div><div class="mb70 mb50-sm mb40-xs clearfix"></div>'; 
        endif;
        ?>
    </div>
</article>

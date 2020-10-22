<?php
/**
 * @author  themepiko
 */
$index=0;
global $xtocky;
$large = $xtocky['p_related_items_large_device'];
$args = array(
    'post__not_in' => array($post_id),
    'posts_per_page'   => 10,
    'orderby'           => 'rand',
    'post_type'        => PIKO_PORTFOLIO_POST_TYPE,
    'portfolio_category__in'    => $arrCatId,
    'post_status'      => 'publish'
);
$posts_array = new WP_Query( $args );
$m_class = ''; 
if(function_exists(pikoworks_is_mobile()) ){
    $m_class = ' col-xs-12'; 
}
?>


<div class="clearfix mt20 <?php esc_attr_e($m_class); ?>">
    <div class="sip hsc ">
         <h2 class="pa_ba h-line mb50  mb40-sm"><?php esc_html_e( 'Related Project', 'woocommerce' ); ?></h2>
        <div class="piko-carousel sh" data-slick='{"infinite": false, "slidesToShow": <?php echo esc_attr($large); ?>,"slidesToScroll": 1,"responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": <?php echo esc_attr($xtocky['p_related_items_desktop']); ?>}},{"breakpoint": 768,"settings":{"slidesToShow": 2}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>
            <?php
            while ( $posts_array->have_posts() ) : $posts_array->the_post();
                $index++;
                $terms = wp_get_post_terms( get_the_ID(), array( PIKO_PORTFOLIO_CATEGORY_TAXONOMY));
                
                $post_thumbnail_id = get_post_thumbnail_id(  get_the_ID() );
                $arrImages = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );   

                    $width = 360;
                    $height = 275;
                    if($large == 4 ){
                        $width = 278;
                        $height = 278;
                    }elseif($large == 3){
                        $width = 380;
                        $height = 300;
                    }elseif($large == 2){
                        $width = 585;
                        $height = 300;
                    }
                    $thumbnail_url = '';
                    if($arrImages>0){
                        $resize = matthewruddy_image_resize($arrImages[0],$width,$height);
                        if($resize!=null && is_array($resize) )
                            $thumbnail_url = $resize['url'];
                    }
                    $url_origin = $arrImages[0];
                    $thumbimg = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );                 
                $cat_name = '';
                $separator = ', ';
                $arrCatId = array();
                foreach ( $terms as $term ){
                    $cat_link = get_category_link( $term->term_id);
                    $cat .= $term->name . ', ';
                    $cat_name .= '<a class="dib" href="'. esc_url($cat_link).'"> '.$term->name .'</a>' . $separator;
                    $arrCatId[count($arrCatId)] = $term->term_id; 
                }
                 $cat_name =  trim( $cat_name, $separator );

                ?>
            <div class="portfolio-item pt-overlay pt-meta pt-content">
                <figure>
                    <a href="<?php echo get_permalink(get_the_ID()) ?>" class="overlay">
                     <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>
                    </a>
                    <figcaption class="pa c-center text-center popup-gallery">
                         <a href="<?php echo esc_url($url_origin) ?>" data-thumb="<?php echo esc_url($thumbimg[0]) ?>" class="zoom-btn"><i class="icon-search"></i></a>
                    </figcaption>                   
                    <div class="portfolio-tags t-nth-anam meta pa">
                        <?php echo wp_kses_post($cat_name); ?> 
                    </div>  
                </figure>
            </div>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
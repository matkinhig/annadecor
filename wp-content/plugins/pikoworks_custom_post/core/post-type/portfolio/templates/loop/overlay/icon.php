<?php
/**
 * @author  sw-theme
 */
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
<figure>
    <a href="<?php echo get_permalink(get_the_ID()) ?>" class="overlay">
    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>
    </a>
    <?php if($light_box != 'yes' && $title_bottom != 'overlay'): ?>
    <figcaption class="pa c-center text-center">        
        <a href="<?php echo esc_url($url_origin) ?>" data-thumb="<?php echo esc_url($thumbimg[0]) ?>" class="zoom-btn"><i class="icon-search"></i></a>
    </figcaption>
    <?php endif;?> 
    <div class="portfolio-tags t-nth-anam meta pa">
        <?php echo wp_kses_post($cat_name); ?> 
    </div>  
</figure>

<?php if($title_bottom == 'v2'): ?>
<h3 class="portfolio-title">
    <a href="<?php echo get_permalink(get_the_ID()) ?>"><?php echo get_the_title() ?></a>
</h3>
<?php elseif($title_bottom == 'overlay'): ?>
<div class="pa c-center text-center">    
    <h3 class="portfolio-title">
        <a href="<?php echo get_permalink(get_the_ID()) ?>"><?php echo get_the_title() ?></a>
    </h3>    
</div>
<?php if($light_box != 'yes'): ?>
    <div class="t-nth-anam meta pa left">        
        <a class="dib zoom-btn" href="<?php echo esc_url($url_origin) ?>" data-thumb="<?php echo esc_url($thumbimg[0]) ?>" ><i class="icon-search"></i></a>
    </div>
<?php endif; ?>
<?php endif;
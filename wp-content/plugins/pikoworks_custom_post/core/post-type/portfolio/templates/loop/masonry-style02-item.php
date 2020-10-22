<?php
$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
$arrImages = wp_get_attachment_image_src($post_thumbnail_id, 'full');
$width = 603;
$height = 805;
if($column_masonry02 == '2'){
    $width = 901;
    $height = 1203; 
}

$overlay_height = 'height-50';

$matrix = array(
  array(2,1,2),
  array(2,2,2),
  array(2,1,1)
);

$index_row = floor(($index-1) / $column)%3;
$index_col = ($index-1) % $column;
if($matrix[$index_row][$index_col]==1){
    $width = 603;
    $height = 424;
    if($column_masonry02 == '2'){
        $width = 901;
        $height = 634; 
    }
    $overlay_height = '';
}

?>

<div class="portfolio-item pt-overlay pt-meta pt-content <?php echo esc_attr($cat_filter); ?>">
    <?php
    $thumbnail_url = '';
    if ($arrImages > 0) {
        $resize = matthewruddy_image_resize($arrImages[0], $width, $height);
        if ($resize != null && is_array($resize))
            $thumbnail_url = $resize['url'];
    }

    $url_origin = $arrImages[0];    
    include(plugin_dir_path(__FILE__) . '/overlay/icon.php');
    ?>
</div>

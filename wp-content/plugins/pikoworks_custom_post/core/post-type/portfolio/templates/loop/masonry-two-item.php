 <?php
    $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
    $arrImages = wp_get_attachment_image_src($post_thumbnail_id, 'full');

    $matrix = array(
        '3' => array(
            array(2,1,2,1),
            array(2,2,1,2),
            array(1,2,2,1)
        ),
    );
    $column = '3';
    $index_row = floor(($index-1) / $column)%2;
    $index_col = ($index-1) % $column;

    $width = 462;
    $height = 435;
    $fix_class = '';
    if($index % 7 == 0){
        $width = 902;
        $height = 410;
        $fix_class = 'fix';
    }
     $wide_class = '';
    if($matrix[$column][$index_row][$index_col]==1){
        $width = 925;
        $height = 877;
        $wide_class = 'wide';
    }
  ?>  

<div class="portfolio-item pt-overlay pt-meta pt-content <?php echo esc_attr($cat_filter . ' ' . $wide_class . ' ' . $fix_class ); ?>">
    <?php
    $thumbnail_url = '';
    if ($arrImages > 0) {
        $resize = matthewruddy_image_resize($arrImages[0], $width, $height);
        if ($resize != null && is_array($resize))
            $thumbnail_url = $resize['url'];
    }

    $url_origin = $arrImages[0];
    if ($overlay_style == 'left-title-excerpt-link')
        $overlay_style = 'title-excerpt-link';
    include(plugin_dir_path(__FILE__) . '/overlay/icon.php');
    ?>

    <?php
    include(plugin_dir_path(__FILE__) . '/gallery.php');
    ?>
</div>
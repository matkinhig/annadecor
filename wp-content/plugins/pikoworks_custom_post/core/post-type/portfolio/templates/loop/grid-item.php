<div class="portfolio-item pt-overlay pt-meta pt-content <?php echo esc_attr($cat_filter); ?>">
    <?php
    $post_thumbnail_id = get_post_thumbnail_id(  get_the_ID() );
    $arrImages = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );   
     
    $width = 360;
    $height = 275;
    if(isset($image_size) && $image_size=='436x260')
    {
        $width = 436;
        $height = 260;
    }
    if(isset($image_size) && $image_size=='590x393')
    {
        $width = 590;
        $height = 393;
    }
    if(isset($image_size) && $image_size=='590x450')
    {
        $width = 590;
        $height = 450;
    }
    if(isset($image_size) &&  $image_size=='570x460')
    {
        $width = 570;
        $height = 460;
    }
    if(isset($image_size) && $image_size=='585x585')
    {
        $width = 585;
        $height = 585;
    }
    if(isset($image_size) && $image_size=='897x536')
    {
        $width = 897;
        $height = 536;
    }
    if(isset($image_size) && $image_size=='510x672')
    {
        $width = 510;
        $height = 672;
    }
    $thumbnail_url = '';
    if($arrImages>0){
        $resize = matthewruddy_image_resize($arrImages[0],$width,$height);
        if($resize!=null && is_array($resize) )
            $thumbnail_url = $resize['url'];
    }

    $url_origin = $arrImages[0];    
    include(plugin_dir_path( __FILE__ ).'/overlay/icon.php');
    ?>
</div>

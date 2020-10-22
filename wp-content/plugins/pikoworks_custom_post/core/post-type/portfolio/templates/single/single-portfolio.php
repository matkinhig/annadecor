<?php
get_header();
global $xtocky;
$min_suffix = (isset($xtocky['enable_minifile']) && $xtocky['enable_minifile'] == 1) ? '.min' : '';

if ( !function_exists( 'pikoworks_primary_portfolio_class' ) ) {    
    /**
     * Add class to #primary
     * 
     * @return string 
     **/
    function pikoworks_primary_portfolio_class( $class = '' ) {
        global $xtocky;
        
        $sidebar_position = isset( $xtocky['portfolio_single_sidebar_pos'] ) ? trim( $xtocky['portfolio_single_sidebar_pos'] ) : 'right';
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12';
        }
        else{
            $class .= ' col-xs-12 col-sm-8 col-md-9 has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );
        
    }
    
}
if ( !function_exists( 'pikoworks_secondary_portfolio_class' ) ) {
    
    /**
     * Add class to #secondary
     * 
     * @return string 
     **/
    function pikoworks_secondary_portfolio_class( $class = '' ) {
        global $xtocky;
        
        $sidebar_position = isset( $xtocky['portfolio_single_sidebar_pos'] ) ? trim( $xtocky['portfolio_single_sidebar_pos'] ) : 'right';
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12 content-area-fullwidth';
        }
        else{
            $class .= ' col-xs-12 col-sm-4 col-md-3 sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );
        
    }
    
}

$autoplay = isset($xtocky['autoplay']) ? $xtocky['autoplay'] : true;
$navigation = isset($xtocky['navigation']) ? $xtocky['navigation'] : true;
$dots = isset($xtocky['dots']) ? $xtocky['dots'] : false;
$margin = isset($xtocky['margin']) ? $xtocky['margin'] : '';
$loop = isset($xtocky['loop']) ? $xtocky['loop'] : false;
$slidespeed = isset($xtocky['slidespeed']) ? $xtocky['slidespeed'] : '250';
$single_class =  'post-single';

$data_carousel = array(
    "autoplay"      => esc_html($autoplay),
    "navigation"    => esc_html($navigation),
    "margin"        => esc_html($margin),
    "smartSpeed"    => esc_html($slidespeed),
    "loop"          => esc_html($loop),
    "autoheight"    => "false",
    'nav'           => esc_html($navigation),
    'dots'          => esc_html($dots),
);
$data_carousel['items'] =  1;
      


if ( have_posts() ) {    
    // Start the Loop.
    while ( have_posts() ) : the_post();
        $post_id = get_the_ID();
        $categories = get_the_terms($post_id, PIKO_PORTFOLIO_CATEGORY_TAXONOMY);
        $client = get_post_meta($post_id, 'portfolio-client', true );
        $location = get_post_meta($post_id, 'portfolio-location', true );
        $embaded =  wp_oembed_get(get_post_meta($post_id, 'portfolio_video', true ));

        $meta_values = get_post_meta( get_the_ID(), 'portfolio-format-gallery', false );
        $imgThumbs = wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'full');
        $cat = '';
        $arrCatId = array();
        if($categories){
            foreach($categories as $category) {
                $cat_link = get_category_link( $category->term_id);
                $cat .= '<a href="' . esc_url($cat_link). '">'.$category->name.'</a>, ';
                $arrCatId[count($arrCatId)] = $category->term_id;
            }
            $cat = trim($cat, ', ');
        } 

        $detail_style =  get_post_meta(get_the_ID(),'portfolio_detail_style',true);
        if (!isset($detail_style) || $detail_style == 'none' || $detail_style == '') {
            $detail_style = $xtocky['portfolio-single-style'];
        }

        include_once(plugin_dir_path( __FILE__ ).'/'.$detail_style.'.php');

    endwhile;
    }
?>

<?php

if(isset($xtocky['show_portfolio_related']) && $xtocky['show_portfolio_related']=='1' )
   include_once(plugin_dir_path( __FILE__ ).'/related.php');

?>
<?php get_footer(); ?>

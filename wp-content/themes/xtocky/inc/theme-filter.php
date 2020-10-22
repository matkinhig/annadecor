<?php
if ( !function_exists( 'xtocky_widget_tag_cloud_args' ) ) {
    function xtocky_widget_tag_cloud_args( $args ) {
            $args['largest'] = 1;
            $args['smallest'] = 1;
            $args['unit'] = 'em';
            return $args;
    }
    add_filter( 'widget_tag_cloud_args', 'xtocky_widget_tag_cloud_args' );
}

/*remove all redux notice */
if ( ! class_exists( 'reduxNewsflash' ) ){
    class reduxNewsflash {
        public function __construct( $parent, $params ) {}
    }
}
add_filter( 'redux/xtocky/aURL_filter', '__return_empty_string' );

/*remove update notices */
if(class_exists('RevSliderBaseAdmin') || class_exists( 'VC_Manager' ) || class_exists( 'YITH_WCAN' ) ){
    function xtocky_filter_plugin_updates( $value ) {
        
        if( isset($value) && is_object($value)){
            unset( $value->response['js_composer/js_composer.php'] );
            unset( $value->response['revslider/revslider.php'] ); 
            unset( $value->response['yith-woocommerce-ajax-product-filter-premium/init.php'] ); 
        }

        return $value;
    }
  add_filter( 'site_transient_update_plugins', 'xtocky_filter_plugin_updates', 10, 1 );
}
if ( !function_exists( 'xtocky_slug_post_classes' ) ) {
function xtocky_slug_post_classes( $classes, $class, $post_id ) {
    $prefix = 'xtocky_';
    $id = get_the_ID();
    $wp_default = xtocky_get_option_data('optn_archive_display_type','default');
    $archive_blog_columns = xtocky_get_option_data('optn_archive_display_columns','2');
    
    if ( get_post_type( get_the_ID() ) == 'post' && !is_singular() ) {   
        
        $classes[] = 'entry'; 
        
        switch ($wp_default) {    
        case 'list':               
                $classes[] = 'blog-list';              
                break;
        case 'masonry':               
                $classes[] = 'entry-grid';              
                break;
        case 'grid': 
              switch ($archive_blog_columns) {    
                case '2':
                    $classes[] = 'col-md-6 col-sm-6 columns-'. esc_attr($archive_blog_columns);
                    break;
                case '3':
                    $classes[] = 'col-md-4 col-sm-4 columns-'. esc_attr($archive_blog_columns);
                    break;
                case '4':
                    $classes[] = 'col-md-3 col-sm-3 columns-'. esc_attr($archive_blog_columns);
                    break;
                default :
                    $classes[] = 'col-xs-12 columns-'. esc_attr($archive_blog_columns);
                } 
                     
            break;
        default :
            if(!is_search()){
              $classes[] = 'col-xs-12';   
            }                       
        }        
    }    
    if ( get_post_type( get_the_ID() ) == 'post' && is_singular() ) {
       $classes[] = 'entry single';
    }    
    if ( get_post_type( get_the_ID() ) == 'portfolio' && is_singular() ) {
         $classes[] = 'portfolio-single'; 
    }    
    if ( get_post_type( get_the_ID() ) == 'product' && !is_singular() ) {
         $classes[] = 'product-column'; 
    }
    if ( get_post_type( get_the_ID() ) == 'product' && is_singular() && !is_page() ) {
        
        $thumbnail =  get_post_meta(get_the_ID(), $prefix . 'single_products_thumbnail',true);
        if (!isset($thumbnail) || $thumbnail == '-1' || $thumbnail == '') {
            $thumbnail = xtocky_get_option_data('optn_woo_single_products_thumbnail','bottom');
        }
        $classes[] = $thumbnail;
        
        if($thumbnail == '2'){
           $classes[] = 'product-layout-2'; 
        }elseif($thumbnail == '3'){
           $classes[] = 'product-layout-3';
        }
        $classes[] = ( $date = get_post_meta( $id, '_sale_price_dates_from', true ) ) ? esc_attr('product-coundown') : '';
        
        $classes[] = 'product-single';   
    }
 
    return $classes;
}
add_filter( 'post_class', 'xtocky_slug_post_classes', 10, 3 );

}

//preset layout
add_filter( 'xtocky_filter_option_data', 'xtocky_add_filter_theme_options_presets');
if(!function_exists('xtocky_add_filter_theme_options_presets')){
	function xtocky_add_filter_theme_options_presets($options){
            if ( ! class_exists( 'Redux' ) ) {
                return;
            }
		if($_preset = xtocky_get('set')){
			$_file = XTOCKY_OPTIONS_PRESET . '/'.$_preset.'.json';
			if ( file_exists( $_file )) {
				require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-base.php';
				require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-direct.php';
				$piko_fs = new WP_Filesystem_Direct(false);
				if(!is_wp_error($piko_fs)){
					$_content = $piko_fs->get_contents($_file);
					$_options = json_decode( $_content, true );
					$options = array_merge( $options, $_options );
				}
			}
		}
		return $options;
	}
}
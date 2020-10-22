<?php
/**
 * theme functions
 **/
if (!function_exists('xtocky_get_template')) {
    /*
     * get template parts
     */
	function xtocky_get_template($template, $name = null){
		get_template_part( 'template-parts/' . $template, $name);
	}
}

if (!function_exists('xtocky_meta_tags')) {
    /**
     * favicon, Meta tags 
     **/
    function xtocky_meta_tags() {
        // add favicon
       global $xtocky;
       
       if (isset($xtocky['custom_ios_title']) && !empty($xtocky['custom_ios_title'])) {
            echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr($xtocky['custom_ios_title']) . '">';
        }
       
       if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
            if ( isset($xtocky['optn_favicon']['url']) ) {
                    echo '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( $xtocky['optn_favicon']['url']) . '" />' . "\n";
            } else {
                    echo '<link rel="shortcut icon" type="image/x-icon" href="' . get_template_directory_uri() . '/assets/images/logo/favicon.ico" />' . "\n";
            }
       }
       
       //retina favicon
       if (isset($xtocky['custom_ios_icon144']['url']) && !empty($xtocky['custom_ios_icon144']['url'])) {
             echo '<link rel="apple-touch-icon" sizes="144x144" href=" '. esc_url($xtocky['custom_ios_icon144']['url']). '">';
        }
       if (isset($xtocky['custom_ios_icon114']['url']) && !empty($xtocky['custom_ios_icon114']['url'])){
            echo '<link rel="apple-touch-icon" sizes="114x114" href="' . esc_url($xtocky['custom_ios_icon114']['url']).'">';
       }
       if (isset($xtocky['custom_ios_icon72']['url']) && !empty($xtocky['custom_ios_icon72']['url'])) {
            echo '<link rel="apple-touch-icon" sizes="72x72" href="' .  esc_url($xtocky['custom_ios_icon72']['url']) . '">';
        }
        if (isset($xtocky['custom_ios_icon57']['url']) && !empty($xtocky['custom_ios_icon57']['url'])) {
            echo '<link rel="apple-touch-icon" sizes="57x57" href="' . esc_url($xtocky['custom_ios_icon57']['url']) . '">';
        }
        
        echo '<meta name="robots" content="NOODP">';
        
        if ( is_front_page() && is_home() ) {
            // Default home page
            echo '<meta name="description" content="' . esc_attr(get_bloginfo( 'description' )) . '" />';
        } elseif ( is_front_page() ) {
            // static home page
            echo '<meta name="description" content="' . esc_attr(get_bloginfo( 'description' )) . '" />';
        } elseif ( is_home() ) {
            //blog page
            echo '<meta name="description" content="' . esc_attr(get_bloginfo( 'description' )) . '" />';
        } else {
            //  Is a singular
            if ( is_singular() ) {
                echo '<meta name="description" content="' . single_post_title( '', false ) . '" />';
            }
            else{ 
                // Is archive or taxonomy
                if ( is_archive() ) {
                    // Checking for shop archive
                    if ( function_exists( 'is_shop' ) ) { // products category, archive, search page
                        if ( is_shop() ) {
                            $post_id = get_option( 'woocommerce_shop_page_id' );                            
                            echo '<meta name="description" content="' . woocommerce_page_title( false ) . '" />';                           
                        }   
                    } 
                    else{
                        echo '<meta name="description" content="' . get_the_archive_description() . '" />';
                    }
                }
                else{
                    if ( is_404() ) {
                        $error_text =  esc_html__( 'Oops, page not found !', 'xtocky' );
                        echo '<meta name="description" content="' . sanitize_text_field( $error_text ) . '" />';
                    }
                    else{ 
                        if ( is_search() ) {
                            echo '<meta name="description" content="' . sprintf( esc_html__( 'Search results for: %s', 'xtocky' ), get_search_query() ) . '" />';
                        }
                        else{
                            // is category, is tags, is taxonomize
                            echo '<meta name="description" content="' . single_cat_title( '', false ) . '" />';
                        } 
                    }
                }                
                // Is WooCommerce page title
                if ( function_exists( 'is_woocommerce' ) ) {
                    if ( is_woocommerce() && !is_shop() ) {
                        if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
                            echo '<meta name="description" content="' . woocommerce_page_title( false ) . '" />';
                        }
                    }
                }                
            }
        }
        
    }
    add_action( 'wp_head', 'xtocky_meta_tags' );
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */

 if(!function_exists('xtocky_body_classes')){
    function xtocky_body_classes( $classes ) {
        $prefix = 'xtocky_';
        global $xtocky, $post;         
        
        $page_class_extra =  get_post_meta(get_the_ID(), $prefix . 'page_class_extra',true);
        $breadcrubm_layout =  get_post_meta(get_the_ID(), $prefix . 'breadcrubm_layout',true);
        
        $popup_news = xtocky_get_option_data('popup_enable', true);
        $top_menu =  get_post_meta(get_the_ID(), $prefix . 'enable_top_bar',true);
        if (!isset($top_menu) || $top_menu == '0') {
            $top_menu = xtocky_get_option_data('enable_top_bar', true);
        }
        $wmpl = xtocky_get_option_data('menu_bar_right_wpml', false); 
        $wmpl_top_left = xtocky_get_option_data('menu_top_bar_wpml_area', 'left'); 
        $cat_menu_enable = xtocky_get_option_data('enable_main_menu_category', 1); 
        $cat_menu_fontpage = xtocky_get_option_data('main_menu_category_open', 1); 
        $off_canvas = xtocky_get_option_data('mini_cart_layout', 'off_canvas'); 
        
        $menu_style =  get_post_meta(get_the_ID(), $prefix . 'menu_style',true);
        if (!isset($menu_style) || $menu_style == '-1' || $menu_style == '' || class_exists( 'WooCommerce' ) && is_woocommerce()) {
            $menu_style = isset( $xtocky['menu_style'] ) ? $xtocky['menu_style'] : '1';
        }
        
        if( $menu_style == 7){
            $menu_style = '7 header-layout-4';
        }

        $footer_layout =  get_post_meta(get_the_ID(), $prefix . 'footer_layout',true);
        if (!isset($footer_layout) || $footer_layout == '-1' || $footer_layout == '') {
            $footer_layout = isset( $xtocky['footer_layout'] ) ? $xtocky['footer_layout'] : 'layout3';
        } 
        $archive_slider =  isset( $xtocky['woo_archive_side_shortcode'] ) ? $xtocky['woo_archive_side_shortcode'] : ''; 
        
        $transparency = xtocky_get_option_data('header_transparency',false);
        $transparency_option = xtocky_get_option_data('header_transparency_option','fontpage');
        $transparency_meta =  get_post_meta(get_the_ID(), $prefix . 'header_transparency',true);
            
        if(function_exists('WC')){
            if ( $archive_slider != '' && ( is_shop() || is_product_category() || is_product_tag()) ) {	
                $classes[] = 'archive-woocommerce';
            }
        }
        if (in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins')))){
            $classes[] = 'custom-compare';
        }
        // Adds a class of custom-background-image to sites with a custom background image.
        if ( get_background_image() ) {
                $classes[] = 'custom-background-image';
        }

        // Adds a class of group-blog to sites with more than 1 published author.
        if ( is_multi_author() ) {
                $classes[] = 'group-blog';
        }

        // Adds a class of no-sidebar to sites without active sidebar.
        if ( ! is_active_sidebar( 'sidebar-1' ) ) {
                $classes[] = 'no-sidebar';
        }

        // Adds a class of hfeed to non-singular pages.
        if ( ! is_singular() ) {
                $classes[] = 'hfeed';
        }
        if (is_single() ) {
            foreach((wp_get_post_terms( $post->ID)) as $term) {
                // add category slug to the $classes array
                $classes[] = esc_attr( $term->slug );
            }
            foreach((wp_get_post_categories( $post->ID, array('fields' => 'slugs'))) as $category) {
                // add category slug to the $classes array
                $classes[] = esc_attr( $category );
            }
        } 

        if($wmpl == true ){
           $classes[] = 'wmpl-wrap';
        }
        if( $wmpl_top_left != 'none'){
           $classes[] = 'wmpl-wrap-top-'. $wmpl_top_left;
        }
        if($breadcrubm_layout != ''){
           $classes[] = esc_attr($breadcrubm_layout);
        }

        $classes[] = $page_class_extra;
        $classes[] = 'header-layout-' . $menu_style;
        if($transparency && $transparency_option == 'fontpage' && is_front_page() || $transparency_meta == true){
            $classes[] = 'header-transparency';
        }
        if($transparency && $transparency_option == 'allpage'){
            $classes[] = 'header-transparency';
        }
        if($top_menu){
            $classes[] = 'open-top-menu';
        } 
        if($cat_menu_enable == '1'){
            $classes[] = 'category-menu';
        }       
        if($cat_menu_fontpage == '1' && is_front_page()){
            $classes[] = 'category-menu-open';
        }       
        if($popup_news){
            $classes[] = 'open-popup';
        }     
        if($off_canvas == 'off_canvas'){
            $classes[] = 'offcanvas';
        }
        if(is_active_sidebar('sidebar-7')){
           $classes[] = 'filter-active'; 
        }
              

        return $classes;
    }

    add_filter( 'body_class', 'xtocky_body_classes',1000 );
}

//for tab section 6/10
if( ! function_exists('xtocky_get_all_attributes') ){
    function xtocky_get_all_attributes( $tag, $text ) {
        preg_match_all( '/' . get_shortcode_regex() . '/s', $text, $matches );
        $out = array();
        if( isset( $matches[2] ) )
        {
            foreach( (array) $matches[2] as $key => $value )
            {
                if( $tag === $value )
                    $out[] = shortcode_parse_atts( $matches[3][$key] );  
            }
        }
        return $out;
    }
}

if (!function_exists('xtocky_unregister_post_type')) {
    /**
    * UNREGISTER CUSTOM POST TYPES //dont use after switching theme effect
    **/
	function xtocky_unregister_post_type( $post_type, $slug = '' ) {
            global $xtocky, $wp_post_types, $cpt_disable ;
            if ( isset( $xtocky['optn_cpt_disable'] ) ) {
                $cpt_disable = $xtocky['optn_cpt_disable'];
                if ( ! empty( $cpt_disable ) ) {
                    foreach ( $cpt_disable as $post_type => $cpt ) {
                        if ( $cpt == 1 && isset( $wp_post_types[ $post_type ] ) ) {
                            unset( $wp_post_types[ $post_type ] );
                        }
                    }
                }
            }
	}
//    add_action( 'init', 'xtocky_unregister_post_type', 20 );
}

if ( !function_exists( 'xtocky_get' ) ){
	function xtocky_get($var){
		return isset($_GET[$var]) ? $_GET[$var] : (isset($_REQUEST[$var]) ? $_REQUEST[$var] : '');
	}
}
if ( !function_exists( 'xtocky_get_option_data' ) ){
	function xtocky_get_option_data($id, $fallback = false, $param = false){
		global $xtocky;
		$xtocky = apply_filters('xtocky_filter_option_data',$xtocky);
		if ( $fallback == false ){
			$fallback = '';
		}
		if(isset($xtocky[$id]) && $xtocky[$id] !== ''){
			$output = $xtocky[$id];
		}
		else{
			$output = $fallback;
		}
		if ( !empty( $xtocky[$id] ) && $param ) {
			if(isset($xtocky[$id][$param])){
				$output = $xtocky[$id][$param];
			}
			else{
				$output = $fallback;
			}
		}
		return $output;
	}
}

if ( !function_exists( 'xtocky_add_formatting' ) ) {
	function xtocky_add_formatting($content){
		$content = do_shortcode($content);
		return $content;
	}
}

if ( !function_exists( 'xtocky_newsletter_popup' ) ) {
	function xtocky_newsletter_popup()	{
        $enable = xtocky_get_option_data('popup_enable', false);
        $front_page = xtocky_get_option_data('popup_page_enable', 'front');
        $h_height = xtocky_get_option_data('popup_title_bg_height', '150');
        $bg_bottom_img = xtocky_get_option_data('popup_bg_img_pos', 'right');
         global $xtocky;
         if ( $enable == false ) { return;}         
         if($front_page == 'front' && !is_front_page()){return;}
        ?>
            <div class="push_overlay_pop"></div>
            <div class="modal fade"  id="newsletterModal">
              <div class="modal-dialog news-popup">
                <div class="modal-content modal-md">
                  <div class="modal-bottom-image <?php echo esc_attr($bg_bottom_img); ?>">
              <?php if(isset($xtocky['popup_bg_img']['background-image']) && $xtocky['popup_bg_img']['background-image']){?>
                          <img  src="<?php echo esc_url( $xtocky['popup_bg_img']['background-image']); ?>" alt="<?php esc_html_e('popup', 'xtocky') ?>" class="img-responsive"> 
              <?php }?>
                    </div> 
                  <div class="modal-block">			      
                          <div class="pop-header" style="height:<?php echo esc_attr($h_height); ?>px">
                                <button class="pop-close"><span class="icon-cross2"></span></button>
                                <h2 class="pop-title"><?php echo esc_attr( $xtocky['popup_title'] ); ?></h2>
                          </div>
                          <div class="modal-newsletter text-center">                                                                    
                              <?php echo do_shortcode( wpautop( $xtocky['popup_content'] ) ); ?>
                              <?php echo do_shortcode( $xtocky['popup_mc_form'] ); ?>

                            <span class="fix-checkbox">
                                    <input type="checkbox" id="showagain" value="do-not-show">
                                    <label for="showagain" class="checkbox"></label> <span><?php echo esc_html( $xtocky['popup_nomore_text'] ); ?></span>
                            </span>			            	
                          </div>
                  </div>
                </div>
              </div>
            </div>		
        <?php
	}
}
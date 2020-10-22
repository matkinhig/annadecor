<?php
/**
 * Enqueues scripts and styles.
 *
 */

/**
 * Enqueue css, js files
 */
if ( !function_exists( 'xtocky_add_action_wp_enqueue_scripts' ) ){
	add_action( 'wp_enqueue_scripts', 'xtocky_add_action_wp_enqueue_scripts', 9999 );
        function xtocky_add_action_wp_enqueue_scripts(){
            global $xtocky;   
            
            $min_suffix = (isset($xtocky['enable_minifile']) && $xtocky['enable_minifile'] == 1) ? '.min' : '';            
            $enable_min = isset( $xtocky['enable_minifile'] ) ? $xtocky['enable_minifile'] : false;
            $mobile_adjust = xtocky_get_option_data('logo_size_mobile_logo', array('margin-top' => ''));
            $custom_add_css = xtocky_get_option_data('custom_css', '');
            $container_width_custom = xtocky_get_option_data('container_width_custom', '');
            $mobile_icon_color = xtocky_get_option_data('mobile_header_tools_color', '');
           
            $handles_style_remove = array(
                'yith-woocompare-widget',
                'woocommerce_prettyPhoto_css',
                'yith-wcwl-font-awesome',
                'woocomposer-front-slick',
                'jquery-colorbox',
                'font-awesome',
                'fontawsome-css', //social login
                'apsl-frontend-css', //social login
                'dokan-fontawesome', //dokan icon
                'openswatch',
                'cookie-notice-front'
            );
            $handles_script_remove = array(
                'woocomposer-slick',
                'prettyPhoto',
                'prettyPhoto-init',
                'openswatch',
                'openswatch_custom',
            );
            foreach ($handles_style_remove as $style) {
                if ( wp_style_is( $style, $list = 'registered' ) ) {
                        wp_deregister_style( $style );
                }
            }
            foreach ($handles_script_remove as $script) {
                if ( wp_script_is( $script, $list = 'enqueued' ) ) {
                        wp_dequeue_script( $script );
                }
            }            
            /*
             * Stylesheet
             */
            if(wp_style_is('js_composer_front','registered')){
                wp_enqueue_style('js_composer_front');
            }
            
            /*
             * Scripts
             */
            wp_enqueue_style( 'xtocky-style', get_stylesheet_uri(), XTOCKY_THEME_VERSION); // Theme stylesheet.
            wp_style_add_data( 'xtocky-style', 'rtl', 'replace' );
            
            $mobile_adjust_css = $css_dokan = $css_wmp = $css_wcv = $css_buddypress = '';
            if ( xtocky_is_wc_vendors_activated() ) { $css_wcv = xtocky_wc_vendor_styles($css_wcv); } //wc wc vendor
            if ( xtocky_is_wc_marketplace_activated() ) { $css_wmp = xtocky_wc_marketplace_styles($css_wmp); } //wc wmp vendor
            if ( xtocky_is_dokan_activated() ) { $css_dokan = xtocky_dokan_vendor_styles($css_dokan); } //wc dokan vendor
            if ( xtocky_is_buddypress()) { $css_buddypress = xtocky_buddypress_styles($css_buddypress); } //wc dokan vendor
            
            if($mobile_adjust['margin-top'] != ''){
                 $mobile_adjust_css = "@media(max-width:480px){.site-header .sticky-menu-header:not(.active-sticky) .logo .site-logo-image + .site-logo-image, .header-layout-4 .logo .site-logo-image + .site-logo-image{margin-top: {$mobile_adjust['margin-top']}; }}";               
             }
             if($container_width_custom != ''){
                //min width 1200px
                $container_width_custom = '@media (min-width:1200px){.container{max-width:'.esc_attr($container_width_custom).'px} }';            
            }
             if( $mobile_icon_color != ''){
                $mobile_icon_color = '@media (max-width:991px){.tools_button,.header-search-container > a > i,.header-main .header-dropdown.search-full > a i, .cart-dropdown a > i, .header-dropdown.login-dropdown > a > span:not(.dropdown-text){color:'.esc_attr($mobile_icon_color).'!important} }';            
            }

             $combine_css = $css_dokan . $css_wmp . $css_wcv . $custom_add_css . $mobile_adjust_css . $css_buddypress.$container_width_custom.$mobile_icon_color;
             
             wp_add_inline_style( 'xtocky-style', $combine_css );
            
            if($enable_min == false){
               wp_enqueue_script('bootstrap', XTOCKY_JS.'/plugins/bootstrap.min.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
               wp_enqueue_script('jqplugin', XTOCKY_JS.'/plugins/jqplugin.min.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
               wp_enqueue_script('background-check', XTOCKY_JS.'/plugins/background-check.min.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
               wp_enqueue_script('imagesloaded', XTOCKY_JS.'/plugins/imagesloaded.pkgd.min.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
               wp_enqueue_script('isotope', XTOCKY_JS.'/plugins/isotope.pkgd.min.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
               wp_enqueue_script('countdown', XTOCKY_JS.'/plugins/jquery.countdown.min.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
               wp_enqueue_script('debouncedresize', XTOCKY_JS.'/plugins/jquery.debouncedresize.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
               wp_enqueue_script('hoverIntent', XTOCKY_JS.'/plugins/jquery.hoverIntent.min.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
               wp_enqueue_script('waypoints', XTOCKY_JS.'/plugins/jquery.waypoints.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
               wp_enqueue_script('lightgallery', XTOCKY_JS.'/plugins/lightgallery.min.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
               wp_enqueue_script('slick', XTOCKY_JS.'/plugins/slick.min.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
               wp_enqueue_script('zoom', XTOCKY_JS.'/plugins/jquery.zoom.min.js', array('jquery'), XTOCKY_THEME_VERSION, true);
               wp_enqueue_script('chosen', XTOCKY_JS.'/plugins/chosen.min.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
               wp_enqueue_script('counterup', XTOCKY_JS.'/plugins/jquery-counterup.js', array('jquery'), XTOCKY_THEME_VERSION, true); 
               wp_enqueue_script('sticky-kit', XTOCKY_JS.'/plugins/sticky-kit.min.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
               wp_enqueue_script('chookie', XTOCKY_JS.'/plugins/jquery.chookie.min.js', array('jquery'), XTOCKY_THEME_VERSION, true);  
            }
            wp_enqueue_script('xtocky-main', XTOCKY_JS.'/main'.$min_suffix.'.js', array('jquery'), XTOCKY_THEME_VERSION, true); 
            wp_localize_script( 'xtocky-main', 'pikoAjax', array(
                    'ajaxurl' => admin_url( 'admin-ajax.php' ),
                    'nonce' => wp_create_nonce( 'ajax-nonce' ),
                    'show_offcanvas' => xtocky_get_option_data('ajaxcart_show_minicart', 'body.single-product')
            ));
 
            /*
             * inline custome Scripts
             */
            $custom_add_script = xtocky_get_option_data('custom_js', '');
            wp_add_inline_script( 'xtocky-main', $custom_add_script);           
            wp_localize_script( 'xtocky-main', 'xtocky_global_message', apply_filters( 'xtocky_filter_global_message_js', array(
			'compare' => array(
				'view' => esc_attr__('View List Compare','xtocky'),
				'success' => esc_attr__('has been added to comparison list.','xtocky'),
				'error' => esc_attr__('An error occurred ,Please try again !','xtocky')
			),
			'wishlist' => array(
				'view' => esc_attr__('View List Wishlist','xtocky'),
				'success' => esc_attr__('has been added to wishlist.','xtocky'),
				'error' => esc_attr__('An error occurred ,Please try again !','xtocky')
			),
			'addcart' => array(
				'view' => esc_attr__('View Cart','xtocky'),
				'success' => esc_attr__('has been added to cart','xtocky'),
				'error' => esc_attr__('An error occurred ,Please try again !','xtocky')
			),
			'global' => array(
				'error' => esc_attr__('An error occurred ,Please try again !','xtocky'),
				'comment_author'    => esc_attr__('Please enter Name !','xtocky'),
				'comment_email'     => esc_attr__('Please enter valid Email Address !','xtocky'),
				'comment_rating'    => esc_attr__('Please select a rating !','xtocky'),
				'comment_content'   => esc_attr__('Please enter Comment !','xtocky'),
                                'days'   => esc_attr__('Days','xtocky'),
				'hours'   => esc_attr__('Hours','xtocky'),
				'minutes'   => esc_attr__('Mins','xtocky'),
				'seconds'   => esc_attr__('Secs','xtocky')
			),
			'enable_sticky_header' => xtocky_get_option_data('sticky_header',false),
		) ) );            
            
            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }
        }
}
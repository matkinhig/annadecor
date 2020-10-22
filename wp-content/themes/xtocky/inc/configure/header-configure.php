<?php
/*
 * header content function
 */
//menu style
if(!function_exists('xtocky_headers_style')){
    function xtocky_headers_style(){
        $prefix = 'xtocky_';
        global $xtocky;
        
        $menu_style =  get_post_meta(get_the_ID(), $prefix . 'menu_style',true);
        if (!isset($menu_style) || $menu_style == '-1' || $menu_style == '' || class_exists( 'WooCommerce' ) && is_woocommerce()) {
            $menu_style = isset( $xtocky['menu_style'] ) ? $xtocky['menu_style'] : '1';
        }
        switch ($menu_style) {
                case '7':
                {
                    xtocky_get_template('headers/header', '7');
                    break;
                }
                case '6':
                {
                    xtocky_get_template('headers/header', '6');
                    break;
                }
                case '5':
                {
                    xtocky_get_template('headers/header', '5');
                    break;
                }
                case '4':
                {
                    xtocky_get_template('headers/header', '4');
                    break;
                }
                case '3':
                {
                    xtocky_get_template('headers/header', '3'); 
                    break;
                }  
                case '2':
                {
                    xtocky_get_template('headers/header', '2');
                    break;
                }
                default:
                {
                    xtocky_get_template('headers/header', '1'); 
                }
            }
        xtocky_breadcrumbs(); //breadcrumbs 
    }
}

if ( !function_exists( 'xtocky_get_top_bar_menu' ) ){
	function xtocky_get_top_bar_menu(){
		$arg_default = array(
			'fallback_cb'     => false,
			'container'       => false,
			'menu_class'       => 'header-dropdown account-dropdown',
		);
		$args = array_merge($arg_default , apply_filters( 'xtocky_get_top_bar_menu_location' , array(
			'theme_location'  => 'top_menu',
		)) );

		wp_nav_menu($args);
	}
}
if ( !function_exists( 'xtocky_get_primary_login_menu' ) ){
	function xtocky_get_primary_login_menu(){
		$arg_default = array(
			'fallback_cb'     => false,
			'container'       => false,
			'menu_class'       => 'header-dropdown account-dropdown login-menu',
		);
		$args = array_merge($arg_default , apply_filters( 'xtocky_get_primary_login_menu_location' , array(
			'theme_location'  => 'primary_login',
		)) );

		wp_nav_menu($args);
	}
}
if ( !function_exists( 'xtocky_get_primary_login_menu_layout_six' ) ){
	function xtocky_get_primary_login_menu_layout_six(){
		$arg_default = array(
			'fallback_cb'     => false,
			'container'       => false,
			'menu_class'       => 'account-list',
		);
		$args = array_merge($arg_default , apply_filters( 'xtocky_get_primary_login_menu_layout_six_location' , array(
			'theme_location'  => 'primary_login',
		)) );

		wp_nav_menu($args);
	}
}

if( !function_exists('xtocky_main_menu_fallback') ){
	function xtocky_main_menu_fallback(){
		$output = '<ul class="main-menu mega-menu show-arrow effect-fadein-up subeffect-fadein-left">';
		$menu_fallback = wp_list_pages('number=5&depth=2&echo=0&title_li=');
		$menu_fallback = str_replace('page_item','page_item menu-item',$menu_fallback);
		$menu_fallback = str_replace("<ul class='children'>","<ul class='sub-menu'>",$menu_fallback);
		$output .= $menu_fallback;
		$output .= '</ul>';
		echo do_shortcode($output);
	}
}

if( !function_exists('xtocky_main_mobile_menu_fallback') ){
	function xtocky_main_mobile_menu_fallback(){
		$output = '<ul class="mobile-main-menu accordion-menu">';
		$menu_fallback = wp_list_pages('echo=0&title_li=');
		$menu_fallback = str_replace('page_item','page_item menu-item',$menu_fallback);
		$menu_fallback = str_replace("<ul class='children'>","<span class='arrow'></span><ul class='sub-menu'>",$menu_fallback);
		$output .= $menu_fallback;
		$output .= '</ul>';
		echo do_shortcode($output);
	}
}

if ( !function_exists( 'xtocky_get_main_menu' ) ){
	function xtocky_get_main_menu(){
            $menu_anm = xtocky_get_option_data('main_menu_animation','effect-down');
            $submenu_anm = xtocky_get_option_data('sub_menu_animation','subeffect-down'); 
		if(class_exists('Stock_Piko_Walker_Top_Nav_Menu')) {
			$arg_default = array(
				'container' => false,
				'menu_class' => 'main-menu mega-menu  '.esc_attr($menu_anm . ' ' . $submenu_anm).' show-arrow',
				'fallback_cb' => 'xtocky_main_menu_fallback',
				'walker' => new Stock_Piko_Walker_Top_Nav_Menu
			);
			$args = array_merge($arg_default , apply_filters( 'xtocky_filter_main_menu_location' , array(
				'theme_location' => 'primary',
			)) );
			wp_nav_menu($args);
		}
	}
}
if ( !function_exists( 'xtocky_get_secondary_menu' ) ){
	function xtocky_get_secondary_menu(){
            $menu_anm = xtocky_get_option_data('main_menu_animation','effect-down');
            $submenu_anm = xtocky_get_option_data('sub_menu_animation','subeffect-down'); 
		if(class_exists('Stock_Piko_Walker_Top_Nav_Menu')) {
			$arg_default = array(
				'container' => false,
				'menu_class' => 'main-menu mega-menu  '.esc_attr($menu_anm . ' ' . $submenu_anm).' show-arrow',
				'fallback_cb' => 'xtocky_main_menu_fallback',
				'walker' => new Stock_Piko_Walker_Top_Nav_Menu
			);
			$args = array_merge($arg_default , apply_filters( 'xtocky_filter_main_menu_location' , array(
				'theme_location' => 'secondary',
			)) );
			wp_nav_menu($args);
		}
	}
}

if ( !function_exists( 'xtocky_get_mobile_main_menu' ) ){
	function xtocky_get_mobile_main_menu(){
		if(class_exists('Stock_Piko_Walker_Accordion_Nav_Menu')) {
			$arg_default = array(
				'container' => false,
				'menu_class' => 'mobile-main-menu accordion-menu',
				'fallback_cb' => 'xtocky_main_mobile_menu_fallback',
				'walker' => new Stock_Piko_Walker_Accordion_Nav_Menu
			);
			$args = array_merge($arg_default , apply_filters( 'xtocky_filter_main_menu_location' , array(
				'theme_location' => 'primary',
			)) );
			wp_nav_menu($args);
		}
                
                $prefix = 'xtocky_';
                global $xtocky;

                $menu_style =  get_post_meta(get_the_ID(), $prefix . 'menu_style',true);
                if (!isset($menu_style) || $menu_style == '-1' || $menu_style == '') {
                    $menu_style = isset( $xtocky['menu_style'] ) ? $xtocky['menu_style'] : '1';
                } 
                
		if(class_exists('Stock_Piko_Walker_Accordion_Nav_Menu') && $menu_style == '6') {
			$arg_default_secondary = array(
				'container' => false,
				'menu_class' => 'mobile-main-menu accordion-menu',
				'fallback_cb' => 'xtocky_main_mobile_menu_fallback',
				'walker' => new Stock_Piko_Walker_Accordion_Nav_Menu
			);
			$args_secondary = array_merge($arg_default_secondary , apply_filters( 'xtocky_filter_main_menu_location' , array(
				'theme_location' => 'secondary',
			)) );
			wp_nav_menu($args_secondary);
		}
                $vertical_menu = xtocky_get_option_data('enable_main_menu_category', 0);
                if(class_exists('Stock_Piko_Walker_Accordion_Nav_Menu') && ($menu_style == '4' && $vertical_menu == 1 || $menu_style == '5' && $vertical_menu == 1) ) {
			$arg_default_vertical = array(
				'container' => false,
				'menu_class' => 'mobile-main-menu accordion-menu',
				'fallback_cb' => 'xtocky_main_mobile_menu_fallback',
				'walker' => new Stock_Piko_Walker_Accordion_Nav_Menu
			);
			$args_vertical = array_merge($arg_default_vertical , apply_filters( 'xtocky_filter_main_menu_location' , array(
				'theme_location' => 'category',
			)) );
			wp_nav_menu($args_vertical);
		}
	}
}

if ( !function_exists( 'xtocky_get_vertical_menu' ) ){
	function xtocky_get_vertical_menu(){
		if(class_exists('Stock_Piko_Walker_Accordion_Nav_Menu')) {
			$arg_default = array(
				'container' => false,
				'menu_class' => 'mobile-main-menu accordion-menu',
				'fallback_cb' => 'xtocky_main_mobile_menu_fallback',
				'walker' => new Stock_Piko_Walker_Accordion_Nav_Menu
			);
			$args = array_merge($arg_default , apply_filters( 'xtocky_filter_main_menu_location' , array(
				'theme_location' => 'primary',
			)) );
			wp_nav_menu($args);
		}
	}
}
if ( !function_exists( 'xtocky_get_menu_category' ) ){
	function xtocky_get_menu_category(){
            $menu_anm = xtocky_get_option_data('main_menu_animation','effect-down');
            $submenu_anm = xtocky_get_option_data('sub_menu_animation','subeffect-down'); 
		if(class_exists('Stock_Piko_Walker_Top_Nav_Menu')) {
			$arg_default = array(
				'container' => false,
				'menu_class' => 'menu-category-menu main-menu mega-menu  '.esc_attr($menu_anm . ' ' . $submenu_anm).' show-arrow',
				'fallback_cb' => 'xtocky_main_menu_fallback',
				'walker' => new Stock_Piko_Walker_Top_Nav_Menu
			);
			$args = array_merge($arg_default , apply_filters( 'xtocky_filter_main_menu_location' , array(
				'theme_location' => 'category',
			)) );
			wp_nav_menu($args);
		}
	}
}
if ( !function_exists( 'xtocky_get_menu_category_wrap' ) ){
	function xtocky_get_menu_category_wrap(){
            $menu_category = xtocky_get_option_data('enable_main_menu_category', 1);
            $category_title = xtocky_get_option_data('main_menu_category_title', esc_html__('ALL CATEGORIES', 'xtocky'));
            if($menu_category == 1): ?>
                <div class="secondary-menu-wrapper">
                    <div class="secondary-title"><?php echo esc_attr($category_title); ?></div>
                    <div class="secondary-menu">
                     <?php xtocky_get_menu_category();?>  
                    </div>
                </div>
            <?php endif;            
		
	}
}
if ( !function_exists( 'xtocky_get_topbar_right' ) ){
    function xtocky_get_topbar_right(){
        global $xtocky;
        $top_bar_right_wpml = isset( $xtocky['top_bar_right_wpml'] ) ? $xtocky['top_bar_right_wpml'] : 0;
        $top_bar_right_login = isset( $xtocky['top_bar_right_login'] ) ? $xtocky['top_bar_right_login'] : 0;
       ?>
       <div id="site-navigation-top-bar" class="top-bar-navigation">
        <?php xtocky_get_top_bar_menu(); ?>
           <ul class="menu">
                <?php
                if( $top_bar_right_wpml == 1 ){ xtocky_lang_switcher(); } 
                if($top_bar_right_login == 1): ?>
                    <li>                                
                        <a href="javascript:void(0)" class="button-togole togole-loginform" data-togole="piko-show-account">                                
                            <?php if(is_user_logged_in()): ?>
                                    <span class="icon icon-lock2" aria-hidden="true"> <i><?php echo esc_html( $GLOBALS['current_user']->display_name) ?></i></span>
                                    <?php else: ?>
                                    <span class="icon icon-lock2" aria-hidden="true"> <i><?php echo esc_html__('Login', 'xtocky'); ?></i></span>
                            <?php endif;?>
                            <?php if(is_user_logged_in()): ?>
                                    <span class="icon icon-lock" aria-hidden="true"> <i><?php echo  esc_html($GLOBALS['current_user']->display_name) ?></i></span>
                                    <?php else: ?>
                                    <span class="icon icon-lock" aria-hidden="true"> <i><?php echo esc_html__('Login', 'xtocky'); ?></i></span>
                            <?php endif;?>                                
                        </a>
                         <div class="toggle-header">                                 
                            <?php get_template_part( 'template-parts/headers/login' ); ?>
                        </div><!-- /.toggle-header -->
                    </li>
                <?php endif; ?> 
            </ul>
        </div>
    <?php        
    }

}

if ( !function_exists( 'xtocky_get_brand_logo' ) ){
    function xtocky_get_brand_logo(){
    $prefix = 'xtocky_';   
    $default_logo_id =  get_post_meta(get_the_ID(), $prefix . 'logo_upload', true);
    $logo_default['url'] =  wp_get_attachment_image_url($default_logo_id, '') ? wp_get_attachment_image_url($default_logo_id, '') : '';
    if (!isset($logo_default['url']) ||  $logo_default['url'] == '') {   
        $logo_default = isset( $GLOBALS['xtocky']['logo_upload'] ) ? $GLOBALS['xtocky']['logo_upload'] : array( 'url' => get_template_directory_uri() . '/assets/images/logo/logo.png' );
    }
    $mobile_logo_id =  get_post_meta(get_the_ID(), $prefix . 'logo_upload_mobile', true);
    $logo_mobile_src['url'] =  wp_get_attachment_image_url($mobile_logo_id, '') ? wp_get_attachment_image_url($mobile_logo_id, '') : '';
    
    if (!isset($logo_mobile_src['url']) || $logo_mobile_src['url'] == '') { 
        $logo_mobile_src = isset( $GLOBALS['xtocky']['logo_upload_mobile'] ) ? $GLOBALS['xtocky']['logo_upload_mobile'] : array( 'url' => get_template_directory_uri() . '/assets/images/logo/logo-inverse.png' );
    }
    $logo_type = isset( $GLOBALS['xtocky']['enable_text_logo'] ) ? $GLOBALS['xtocky']['enable_text_logo'] == 1 : '';
    $logo_text = isset( $GLOBALS['xtocky']['text_logo_name'] ) ? $GLOBALS['xtocky']['text_logo_name'] : esc_html('xtocky', 'xtocky');
    $logo_width = xtocky_get_option_data('logo_max_width', '135');
    $site_name = get_bloginfo('name');
    $site_description = get_bloginfo('description');
    ?>
        <?php
        if($logo_type): ?>
        <h1 class="site-logo"><a href="<?php echo esc_url(home_url("/"))?>"><?php echo esc_attr($logo_text);?></a></h1>
        <?php else: ?>
            <a href="<?php echo esc_url(home_url("/"))?>" style="max-width:<?php echo esc_attr($logo_width)?>px">
                <img src="<?php echo esc_url($logo_default['url']);?>" alt="<?php echo esc_attr($site_name);?>" title="<?php echo esc_attr($site_description);?>" class="site-logo-image"/>
                <img src="<?php echo esc_url($logo_mobile_src['url']);?>" alt="<?php echo esc_attr($site_name);?>" title="<?php echo esc_attr($site_description);?>" class="site-logo-image"/>
            </a>
        <?php endif;
        
    }
}

if ( !function_exists( 'xtocky_get_sticky_logo' ) ){ //not use
    function xtocky_get_sticky_logo(){
        $prefix = 'xtocky_'; 
        $mobile_logo_id =  get_post_meta(get_the_ID(), $prefix . 'logo_upload_mobile', true);
        $logo_mobile_src['url'] =  wp_get_attachment_image_url($mobile_logo_id, '') ? wp_get_attachment_image_url($mobile_logo_id, '') : '';
        if (!isset($logo_mobile_src['url']) || $logo_mobile_src['url'] == '') { 
            $logo_mobile_src = isset( $GLOBALS['xtocky']['logo_upload_mobile'] ) ? $GLOBALS['xtocky']['logo_upload_mobile'] : array( 'url' => get_template_directory_uri() . '/assets/images/logo/logo-inverse.png' );
        }
        $site_name = get_bloginfo('name');
        $site_description = get_bloginfo('description');
        ?>
        <div class="sticky-logo">
            <a href="<?php echo esc_url(home_url("/"))?>">
                <img src="<?php echo esc_url($logo_mobile_src['url']);?>" alt="<?php echo esc_attr($site_name);?>" title="<?php echo esc_attr($site_description);?>" class="site-logo-image"/>
            </a>
        </div>
        <?php
    }
}
if ( !function_exists( 'xtocky_get_header_toggle' ) ){ //since v1.0.5
    function xtocky_get_header_toggle(){
        $prefix = 'xtocky_';        
        $show_search = xtocky_get_option_data('menu_search','1');   
        
        $menu_style =  get_post_meta(get_the_ID(), $prefix . 'menu_style',true);
        if (!isset($menu_style) || $menu_style == '-1' || $menu_style == ''  || class_exists( 'WooCommerce' ) && is_woocommerce()) {
            $menu_style = xtocky_get_option_data('menu_style','1');
        }
        ?>
        <div class="navbar-toggle">
            <button type="button" class="toggle-menu-mobile-button tools_button">                                                          
                <span class="sr-only"><?php esc_attr_e('Mobile navigation', 'xtocky') ?></span>
                <span class="icon-line3"></span>                               
            </button>
            <?php if($menu_style == '1' || $menu_style == '2' || $menu_style == '3' || $menu_style == '5' || $menu_style == '6'): ?>
                <div class="dropdown header-dropdown search-full hidden visible-sm-inline-block visible-xs-inline-block"><a class="piko-modal-open" href="javascript:void(0);"><i class="fa fa-search"></i></a></div>            
             <?php else: ?>
                 <?php xtocky_get_header_search_two(); ?>
             <?php endif; ?>
        </div> 
<?php        
    }
}

if ( !function_exists( 'xtocky_get_header_search' ) ){
    function xtocky_get_header_search(){
        global $xtocky;
        $prefix = 'xtocky_';
        $show_search = isset( $xtocky['menu_search'] ) ? $xtocky['menu_search'] : 1;
        $menu_style =  get_post_meta(get_the_ID(), $prefix . 'menu_style',true);
        if (!isset($menu_style) || $menu_style == '-1' || $menu_style == '' || class_exists( 'WooCommerce' ) && is_woocommerce()) {
            $menu_style = isset( $xtocky['menu_style'] ) ? $xtocky['menu_style'] : '0';
        }
        
        $ajax_search = xtocky_get_option_data( 'search_ajax' );
        
        if($show_search == 0 || $menu_style == '4'){
           return;
        }        
        ?>
        <div class="header-search-container piko-modal-content" style="display: none;">      
            <?php 
            if($ajax_search == 1 && function_exists('WC')){
                get_template_part('template-parts/search-form/product', 'search-form-full' ); 
            }else{
                get_template_part('template-parts/search-form/wp', 'search-form' );
            }
                                                  
            ?>
        </div><!-- End .header-search-container --> 
<?php
        
    }
}
if ( !function_exists( 'xtocky_get_header_search_two' ) ){
    function xtocky_get_header_search_two(){
        global $xtocky;
        $show_search = isset( $xtocky['menu_search'] ) ? $xtocky['menu_search'] : 0;               
        if($show_search == 0){
           return;
        }
        ?>
        <div class="header-search-container search-dropdown-fix"><a href="javascript:void(0);" class="search-dropdown-btn"><i class="fa fa-search" aria-hidden="true"></i></a>
            <?php                            
                if( function_exists('WC') ){
                    get_template_part('template-parts/search-form/product', 'search-form' );
                }else{
                    get_template_part('template-parts/search-form/post', 'search-form' );
                }                            
            ?>
        </div>
<?php
        
    }
}
if ( !function_exists( 'xtocky_get_header_cart' ) ){
    function xtocky_get_header_cart(){
        $show_cart = xtocky_get_option_data('show_cart_iocn', 1);
        $off_canvas = xtocky_get_option_data('mini_cart_layout', 'off_canvas');
        
         if(function_exists('WC') && $show_cart == 1):?>
            <div class="dropdown header-dropdown cart-dropdown">
                <a href="javascript:void(0);" <?php if($off_canvas == 'normal') echo 'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"'; ?>>                                        
                        <i class="icon-cart" aria-hidden="true"></i>
                        <span class="badge-number"></span>
                </a>
                <?php if($off_canvas != 'off_canvas'): ?>
                <div id="header-mini-cart" class="dropdown-menu" data-dropdown-content>                                            
                        <div class="widget_shopping_cart">
                                <div class="widget_shopping_cart_content">                                                        
                                        <div class="cart-loading"></div>
                                </div>
                        </div>
                </div>
                <?php endif; ?>
            </div>
        <?php endif;
    }
}
if ( !function_exists( 'xtocky_get_header_cart_canvas' ) ){
    function xtocky_get_header_cart_canvas(){
        $show_cart = xtocky_get_option_data('show_cart_iocn', 1);
        $off_canvas = xtocky_get_option_data('mini_cart_layout', 'off_canvas');        
         if(function_exists('WC') && $show_cart == 1 && $off_canvas == 'off_canvas'):?>
            <div id="mini-cart-push" class="push_overlay_cart"></div>
            <div  class="push-fixed push-left push-menu off-canvas-cart">
                <h3><?php esc_html_e('CART', 'xtocky'); ?> <i class="close-cart pa icon-cross2"></i></h3>
                <div class="dropdown header-dropdown cart-dropdown">
                    <div id="header-mini-cart" class="dropdown-menu" data-dropdown-content>                                            
                            <div class="widget_shopping_cart">
                                    <div class="widget_shopping_cart_content">                                                        
                                            <div class="cart-loading"></div>
                                    </div>
                            </div>
                    </div>            
                </div>
            </div>        
        <?php endif;
    }
}


if ( !function_exists( 'xtocky_get_header_right' ) ){
    function xtocky_get_header_right(){
        global $woocommerce, $xtocky;
         $prefix = 'xtocky_';
        $show_search = isset( $xtocky['menu_search'] ) ? $xtocky['menu_search'] == 1 : 1;
        $show_cart = isset( $xtocky['show_cart_iocn'] ) ? $xtocky['show_cart_iocn'] == 1 : 1;
        
        $menu_style =  get_post_meta(get_the_ID(), $prefix . 'menu_style',true);
        if (!isset($menu_style) || $menu_style == '-1' || $menu_style == ''  || class_exists( 'WooCommerce' ) && is_woocommerce()) {
            $menu_style = isset( $xtocky['menu_style'] ) ? $xtocky['menu_style'] : '0';
        }
        $customtext = xtocky_get_option_data('menu_custom_text', ''); 
        $disable_top_menu = xtocky_get_option_data('disable_top_menu_main_menu', true); 
        $disable_top_menu = xtocky_get_option_data('mini_cart_layout', 'off_canvas'); 
        
        ?>
        <div class="dropdowns-container">                        
            
                        <?php if($menu_style == '4' || $menu_style == '7' ){ 
                                echo '<div class="header-boxes-container">'. do_shortcode($customtext) .'</div> ';                            
                               xtocky_get_header_search_two();
                                
                            } ?>
                        <div class="dropdowns-wrapper">  
                            <?php  if($menu_style == '1' || $menu_style == '2' || $menu_style == '3' || $menu_style == '5' || $menu_style == '6'){ echo '<div class="dropdown header-dropdown search-full hidden-xs hidden-sm"><a class="piko-modal-open" href="javascript:void(0);"><i class="fa fa-search"></i></a></div>'; } ?>
                                                       
                            <?php   xtocky_header_login_form(); ?>   
                            <?php if($menu_style === '7') echo '<div class="header-checkout-btn">' ?>                        
                            <?php   xtocky_get_header_cart();?>
                            <?php 
                            $main_menu_wpml = xtocky_get_option_data('menu_bar_right_wpml', '0');
                            if($main_menu_wpml == 0 && $show_cart == 1 && $menu_style === '4' || $main_menu_wpml == 0 && $show_cart == 1 && $menu_style === '5'):?>
                                 <div class="header-dropdown lang"><span class="shop-text"></span></div>
                            <?php elseif(  class_exists( 'WooCommerce' ) && $show_cart == 1 && $menu_style === '7'):?>
                                <div class="dropdown header-dropdown btn-checkout"><a href ="<?php echo esc_url(wc_get_checkout_url()); ?>"><?php esc_html_e('Checkout', 'xtocky'); ?></a></div>
                            
                            <?php if($menu_style === '7') echo '</div>' ?>
                            <?php endif; ?> 
                            <?php
                            if($menu_style == '1' || $menu_style == '3' || $menu_style == '5' || $menu_style == '6'){
                               xtocky_lang_switcher(); 
                            }
                            ?>
                        </div><!-- End .dropdowns-wrapper -->
                    </div><!-- End .dropdowns-container -->
        <?php
    }
}

if( ! function_exists('xtocky_header_login_form') ){
    function xtocky_header_login_form(){
        
         $prefix = 'xtocky_';        
        $loginform =  get_post_meta(get_the_ID(), $prefix . 'menu_login_form',true);
        if (!isset($loginform) || $loginform == '-1' || $loginform == '') {
            $loginform = xtocky_get_option_data('menu_login_form', '1'); 
        }        
        
         if($loginform == '1'):
             xtocky_get_primary_login_menu();  
         ?>
        <?php elseif ($loginform == '2'):?>
          <div class="dropdown header-dropdown login-dropdown">
                <a href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <?php if(is_user_logged_in()): ?>
                            <span><i class="icon-header icon-lock2" aria-hidden="true"></i></span>
                             <span class="dropdown-text"> <?php echo esc_html($GLOBALS['current_user']->display_name) ?></span>
                            <?php else: ?>
                            <span><i class="icon-header icon-lock" aria-hidden="true"></i></span>
                    <?php endif;?>
                </a>
            <div class="dropdown-menu">
                <?php get_template_part( 'template-parts/headers/login' ); ?>
            </div><!-- End .dropdown-menu -->
        </div>     
        <?php
        endif;
    }

}

if( ! function_exists('xtocky_header_topbar_wrap') ){
    function xtocky_header_topbar_wrap(){
        $prefix = 'xtocky_';
        $menu_width =  get_post_meta(get_the_ID(), $prefix . 'manu_width',true);
        if (!isset($menu_width) || $menu_width == '-1' || $menu_width == '') {
            $menu_width = xtocky_get_option_data('full_width_menu', 'container-fluid');
        }

        $topbar =  get_post_meta(get_the_ID(), $prefix . 'enable_top_bar',true);
        if (!isset($topbar) || $topbar == '-1' || $topbar == 0) {
           $topbar = xtocky_get_option_data('enable_top_bar', false); 
        }

        $toptext =  get_post_meta(get_the_ID(), $prefix . 'top_bar_infotext',true);
        if (!isset($toptext) || $toptext == '-1' || $toptext == '') {
            $toptext = xtocky_get_option_data('top_bar_infotext', ''); 
        }
        $wpml_area = xtocky_get_option_data('menu_top_bar_wpml_area', 'right');
        $top_menu_social = xtocky_get_option_data('top_menu_social_area', 'none');
        
         if($topbar): ?>
                <div class="header-top">
                    <div class="<?php echo esc_attr($menu_width); ?>">
                        <div class="header-top-text"> 
                            <?php 
                            if($wpml_area == 'left'){ xtocky_lang_switcher_top();} 
                            if($top_menu_social == 'left'){ xtocky_top_menu_social_icon();}                            
                            ?>  
                             <?php echo do_shortcode($toptext); ?>
                        </div>
                        <div class="top-dropdowns">
                            <?php                            
                            if($wpml_area == 'right'){ xtocky_lang_switcher_top(); }
                            if($top_menu_social == 'right'){ xtocky_top_menu_social_icon(); }                            
                            ?>
                            <?php  xtocky_get_top_bar_menu(); ?>                             
                        </div>                       
                    </div>
                </div>
             <?php endif; 
        
    }

}
/*
 * ------------------------------------
 *          configure footer
 * ----------------------------------- 
 */
if(!function_exists('xtocky_footer_style')){
    function xtocky_footer_style(){        
        get_template_part('template-parts/footer/footer-layout', 'one'); 
    }
}


if(!function_exists('xtocky_footer_sidebar_one')){
    function xtocky_footer_sidebar_one(){
        $prefix = 'xtocky_';
        global $xtocky;
        
        $footer_inner_width =  get_post_meta(get_the_ID(), $prefix . 'footer_inner_width',true);
        if (!isset($footer_inner_width) || $footer_inner_width == '-1' || $footer_inner_width == '' || class_exists( 'WooCommerce' ) && is_woocommerce()) {
            $footer_inner_width = isset( $xtocky['footer_inner_width_content'] ) ? $xtocky['footer_inner_width_content'] : 'container-fluid';
        } 
        $footer_widgets =  get_post_meta(get_the_ID(), $prefix . 'widgets_area',true);
        if (!isset($footer_widgets) || $footer_widgets == '0' || $footer_widgets == '') {
            $footer_widgets = isset( $xtocky['footer_widgets'] ) ? $xtocky['footer_widgets'] : true;
        } 
        $footer_columns =  get_post_meta(get_the_ID(), $prefix . 'footer_cloumn',true);
        if (!isset($footer_columns) || $footer_columns == '-1' || $footer_columns == '') {
            $footer_columns = isset( $xtocky['footer_columns'] ) ? $xtocky['footer_columns'] : 4;
        } 
        $footer_sidebar_one =  get_post_meta(get_the_ID(), $prefix . 'footer_sidebar_one',true);
        if (!isset($footer_sidebar_one) || $footer_sidebar_one == '-1' || $footer_sidebar_one == '') {
            $footer_sidebar_one = isset( $xtocky['optn_footer_Widgets_one'] ) ? $xtocky['optn_footer_Widgets_one'] : 'sidebar-3';
        } 
        
        if ( is_active_sidebar( $footer_sidebar_one ) && $footer_widgets == true ) {
            $widget_areas = $footer_columns;
		if( ! $widget_areas ){
			$widget_areas = 4;
		}
                ?>
                <div class="footer-inner">
                    <div class="<?php echo esc_attr($footer_inner_width); ?>">
                        <div class="row">
                            <div class="columns <?php echo 'cols_' . esc_attr( $widget_areas ); ?>">
                                <?php dynamic_sidebar( $footer_sidebar_one ); ?>
                            </div>
                            </div><!-- End .row -->
                    </div><!-- End .container-fluid -->
                </div><!-- End .footer-inner -->
            <?php
        }
        
    }
}
if(!function_exists('xtocky_footer_sidebar_two')){
    function xtocky_footer_sidebar_two(){
        $prefix = 'xtocky_';
        global $xtocky;
        
        $footer_inner_width =  get_post_meta(get_the_ID(), $prefix . 'footer_inner_width',true);
        if (!isset($footer_inner_width) || $footer_inner_width == '-1' || $footer_inner_width == '' || class_exists( 'WooCommerce' ) && is_woocommerce()) {
            $footer_inner_width = isset( $xtocky['footer_inner_width_content'] ) ? $xtocky['footer_inner_width_content'] : 'container-fluid';
        }
        
        $footer_widgets_two =  get_post_meta(get_the_ID(), $prefix . 'widgets_area_two',true);
        if (!isset($footer_widgets_two) || $footer_widgets_two == '0' || $footer_widgets_two == '') {
            $footer_widgets_two = isset( $xtocky['optn_footer_widgets_two'] ) ? $xtocky['optn_footer_widgets_two'] : true;
        }
        
        $footer_columns_two =  get_post_meta(get_the_ID(), $prefix . 'footer_cloumn_two',true);
        if (!isset($footer_columns_two) || $footer_columns_two == '-1' || $footer_columns_two == '') {
            $footer_columns_two = isset( $xtocky['optn_footer_columns_two'] ) ? $xtocky['optn_footer_columns_two'] : 4;
        }
        
        $footer_sidebar_two =  get_post_meta(get_the_ID(), $prefix . 'footer_sidebar_two',true);
        if (!isset($footer_sidebar_two) || $footer_sidebar_two == '-1' || $footer_sidebar_two == '') {
            $footer_sidebar_two = isset( $xtocky['optn_footer_Widgets_two'] ) ? $xtocky['optn_footer_Widgets_two'] : 'sidebar-5';
        }
        
        
        if ( is_active_sidebar( $footer_sidebar_two ) && $footer_widgets_two == true ){
            $widget_areas_two = $footer_columns_two;
		if( ! $widget_areas_two ){
			$widget_areas_two = 4;
		}
                ?>
                <div class="footer-top">
                    <div class="<?php echo esc_attr($footer_inner_width); ?>">
                        <div class="row">
                            <div class="columns <?php echo 'cols_' . esc_attr( $widget_areas_two ); ?>">
                                <?php dynamic_sidebar( $footer_sidebar_two ); ?>
                            </div>
                            </div><!-- End .row -->
                    </div><!-- End .container-fluid -->
                </div><!-- End .footer-inner -->
            <?php
        }
    }
}
if(!function_exists('xtocky_footer_sidebar_three')){
    //newsletter widgets
    function xtocky_footer_sidebar_three(){
        $prefix = 'xtocky_';
        global $xtocky;
        
        $footer_widgets_two =  get_post_meta(get_the_ID(), $prefix . 'widgets_area_three',true);
        if (!isset($footer_widgets_two) || $footer_widgets_two == '0' || $footer_widgets_two == '') {
            $footer_widgets_two = isset( $xtocky['optn_footer_widgets_three'] ) ? $xtocky['optn_footer_widgets_three'] : true;
        }
        
        $footer_inner_width =  get_post_meta(get_the_ID(), $prefix . 'footer_inner_top_width',true);
        if (!isset($footer_inner_width) || $footer_inner_width == '-1' || $footer_inner_width == ''  || class_exists( 'WooCommerce' ) && is_woocommerce()) {
            $footer_inner_width = isset( $xtocky['footer_inner_top_width_content'] ) ? $xtocky['footer_inner_top_width_content'] : 'container-fluid';
        }
        
        $footer_columns_two =  get_post_meta(get_the_ID(), $prefix . 'footer_cloumn_three',true);
        if (!isset($footer_columns_two) || $footer_columns_two == '-1' || $footer_columns_two == '') {
            $footer_columns_two = isset( $xtocky['optn_footer_columns_three'] ) ? $xtocky['optn_footer_columns_three'] : 1;
        }
        
        $footer_sidebar_two =  get_post_meta(get_the_ID(), $prefix . 'footer_inner_top_bg_color',true);
        $footer_sidebar_two =  get_post_meta(get_the_ID(), $prefix . 'footer_sidebar_three',true);
        if (!isset($footer_sidebar_two) || $footer_sidebar_two == '-1' || $footer_sidebar_two == '') {
            $footer_sidebar_two = isset( $xtocky['optn_footer_Widgets_three'] ) ? $xtocky['optn_footer_Widgets_three'] : 'sidebar-6';
        }
        if($footer_widgets_two == '2'){
            $footer_sidebar_two = '';
        }
        $footer_bg_color = xtocky_get_option_data('footer_inner_top_two_bg_color', '');
        $bg_color = 'two';
        if($footer_bg_color !=''){
            $bg_color = 'has-bg-color';
        }
        
        if ( is_active_sidebar( $footer_sidebar_two ) && $footer_widgets_two == true ){
            $widget_areas_two = $footer_columns_two;
		if( ! $widget_areas_two ){
			$widget_areas_two = 1;
		}
                ?>
                <div class="footer-inner-top <?php echo esc_attr($bg_color);?>">
                    <div class="<?php echo esc_attr($footer_inner_width); ?>">
                        <div class="row">
                            <div class="columns <?php echo 'cols_' . esc_attr( $widget_areas_two ); ?>">
                                <?php dynamic_sidebar( $footer_sidebar_two ); ?>
                            </div>
                            </div><!-- End .row -->
                    </div><!-- End .container-fluid -->
                </div><!-- End .footer-inner -->
            <?php
        }
    }
}


function xtocky_footer_nav_menu(){
    if ( has_nav_menu( 'footer' ) ) : ?>
        <nav class="footer-link-menu" aria-label="<?php esc_attr_e( 'Footer Links Menu', 'xtocky' ); ?>">
                <?php
                        wp_nav_menu( array(
                                'theme_location' => 'footer',
                                'menu_class'     => 'footer-menu',
                                'container' => false,
                                'depth'          => 1,

                        ) );
                ?>
        </nav><!-- .footer-navigation -->           
    <?php
    endif;
}
function xtocky_payment_logo(){
    global $xtocky;
        $payment_logo_upload = isset( $xtocky['optn_payment_logo_upload'] ) ? $xtocky['optn_payment_logo_upload'] : '';
    if ($payment_logo_upload != '') : ?>
        <div class="payments-icon">
                <?php
                $payment_photo_ids = explode( ',', $payment_logo_upload);
                foreach($payment_photo_ids as $payment_photo_id):                                           
                ?>                                           
                <img src="<?php echo wp_get_attachment_url( $payment_photo_id ); ?>" alt="<?php  ?>"/>                                      
                <?php endforeach; ?>
        </div><!-- .payments-icon-->         
    <?php
    endif;
}
function xtocky_footer_social_icon(){
      global $xtocky;
     $footer_social = isset( $xtocky['footer_social'] ) ? $xtocky['footer_social'] : array();
    ?>
    <div class="social-icons">
        <?php
            foreach ($footer_social as $key => $val){
               if(! empty($GLOBALS['xtocky'][$key]) && $val == 1 ){
                   echo "<a target='_blank' href='"  . esc_attr($GLOBALS['xtocky'][$key]) ."'><i class='social-icon fa fa-"  . esc_attr($key) ."'></i></a>";
               }
           }
        ?>
    </div><!-- .social-icon --> 
    <?php
}

function xtocky_top_menu_social_icon(){
    global $xtocky;
    $top_menu_social = isset( $xtocky['top_menu_social'] ) ? $xtocky['top_menu_social'] : array();
    ?>
    <ul class="header-dropdown top-social">
        <?php
            foreach ($top_menu_social as $key => $val){
               if(! empty($GLOBALS['xtocky'][$key]) && $val == 1 ){
                   echo "<li><a target='_blank' href='"  . esc_attr($GLOBALS['xtocky'][$key]) ."'><i class='social-icon fa fa-"  . esc_attr($key) ."'></i></a></li>";
               }
           }
        ?>
    </ul><!-- .social-icon --> 
    <?php
}

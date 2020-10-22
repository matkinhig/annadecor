<?php
/*
 *@Coming soon redirect
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

//coming soon mode
if ( !function_exists( 'xtocky_coming_soon_redirect' ) ) {
    function xtocky_coming_soon_redirect() {
        global $xtocky;
        
        $is_coming_soon_mode = isset( $xtocky['enable_coming_soon_mode'] ) ? $xtocky['enable_coming_soon_mode'] == '1' : false;
        $disable_if_date_smaller_than_current = isset( $xtocky['disable_coming_soon_when_date_small'] ) ? $xtocky['disable_coming_soon_when_date_small'] == '1' : false;
        $coming_date = isset( $xtocky['coming_soon_date'] ) ? $xtocky['coming_soon_date'] : '';
        
        $today = date( 'm/d/Y' );
        
        if ( trim( $coming_date ) == '' || strtotime( $coming_date ) <= strtotime( $today ) ) {
            if ( $disable_if_date_smaller_than_current ) {
                $is_coming_soon_mode = false;
            }
        }
        
        // Dont't show coming soon page if not coming soon mode on or  is user logged in.
        if ( is_user_logged_in() || !$is_coming_soon_mode ) {
            return;
        }
        
        xtocky_coming_soon_template();
        
        exit();
    }
    add_action( 'template_redirect', 'xtocky_coming_soon_redirect' );
}

if ( !function_exists( 'xtocky_coming_soon_mode_admin_toolbar' ) ) {
    // Add Toolbar Menus
    function xtocky_coming_soon_mode_admin_toolbar() {
    	global $wp_admin_bar, $xtocky;
        
        $is_coming_soon_mode = isset( $xtocky['enable_coming_soon_mode'] ) ? $xtocky['enable_coming_soon_mode'] == '1' : false;
        $disable_if_date_smaller_than_current = isset( $xtocky['disable_coming_soon_when_date_small'] ) ? $xtocky['disable_coming_soon_when_date_small'] == '1' : false;
        $coming_date = isset( $xtocky['coming_soon_date'] ) ? $xtocky['coming_soon_date'] : '';
        
        $today = date( 'm/d/Y' ); 
        
        if ( trim( $coming_date ) == '' || strtotime( $coming_date ) <= strtotime( $today ) ) {
            if ( $disable_if_date_smaller_than_current && $is_coming_soon_mode ) {
                $is_coming_soon_mode = false;
                $menu_item_class = 'piko_coming_soon_expired';
                if ( current_user_can( 'administrator' ) ) { // Coming soon date expired
                    
                    $date = isset( $xtocky['coming_soon_date'] ) ? $xtocky['coming_soon_date'] : date();
                    
                    $args = array(
                		'id'     => 'piko_coming_soon',
                		'parent' => 'top-secondary',
                		'title'  => esc_html__( 'Coming Soon Mode Expired', 'xtocky' ),
                		'href'   => esc_url( admin_url( 'themes.php?page=theme_options' ) ),
                		'meta'   => array(
                			'class'          => 'piko_coming_soon_expired',
                			'title'          => esc_html__( 'Coming soon mode is actived but expired', 'xtocky' )
                		),
                	);
                	$wp_admin_bar->add_menu( $args );   
                }
            }
        }        
        
        if ( current_user_can( 'administrator' ) && $is_coming_soon_mode ) {
            
            $date = isset( $xtocky['coming_soon_date'] ) ? $xtocky['coming_soon_date'] : date();
            
            $args = array(
        		'id'     => 'piko_coming_soon',
        		'parent' => 'top-secondary',
        		'title'  => esc_html__( 'Coming Soon Actived', 'xtocky' ),
        		'href'   => esc_url( admin_url( 'themes.php?page=theme_options' ) ),
        		'meta'   => array(
        			'class'          => 'coming_soon piko-countdown-wrap countdown-admin-menu piko-cms-date_' . esc_attr( $date ),
        			'title'          => esc_html( 'Showing date '.esc_attr( $date ).' Coming soon ended')
        		),
        	);
        	$wp_admin_bar->add_menu( $args );   
        }
    
    }
    add_action( 'wp_before_admin_bar_render', 'xtocky_coming_soon_mode_admin_toolbar', 999 );
}



if ( !function_exists( 'xtocky_coming_soon_template' ) ) {
    
    function xtocky_coming_soon_template() {
        global $xtocky;        
        $date = isset( $xtocky['coming_soon_date'] ) ? $xtocky['coming_soon_date'] : date();
        $text = xtocky_get_option_data('coming_soon_text', '');
        $subscribe_form = xtocky_get_option_data('coming_soon_newsletter_shortcode', '');
        $content_pos = xtocky_get_option_data('coming_content_position', 'left');
        $social_icon = xtocky_get_option_data('enable_coming_soon_social', '0');       

        
        get_header( 'coming' );
        
        $html = '';
        $count_down_html = '';
        $social_icon_html = '';
        
         
        if($social_icon == 1 ){
            $value= '';
            foreach ($GLOBALS['xtocky']['coming_soon_social'] as $key => $val){
               if(! empty($GLOBALS['xtocky'][$key]) && $val == 1 ){
                   $value .=  "<a target='_blank' href='".esc_url($GLOBALS['xtocky'][$key])."'><i class='social-icon fa fa-" .esc_attr($key) ."'></i></a>". " ";
                   }
               } 
           $social_icon_html =  '<div class="icon-wrap mt20 mt10-xs"><div class="social-icons">' . wp_kses_post($value) . '</div></div>';
            
        }
        
        
        if(isset($date) && $date != ''){            
            $date = (explode("/",$date));           
            $count_down_html = '<div class="countdown-lastest countdown-show4 coming-countdown mt30 mt20-xs" data-y="' .esc_attr( $date[2] ).'" data-m="'.esc_attr($date[0] ).'" data-d="'. esc_attr( $date[1] ).'" data-h="00" data-i="00" data-s="00" ></div>';
        }
        
        $html .= '<div class="coming-soon">
                    <div class="container-fluid">
                        
                            <div class="soon-content '.esc_attr($content_pos).' pa">
                               ' . do_shortcode($text) . '                             
                                ' . $count_down_html . '
                                <div class="clearfix mb30 mb20-xs"></div>
                                ' . do_shortcode($subscribe_form) . '
                                ' . $social_icon_html . '
                            </div>
                        
                    </div>
                </div>';
        
        
        echo do_shortcode( $html );
        get_footer( 'coming' );
        
    }    
    
}

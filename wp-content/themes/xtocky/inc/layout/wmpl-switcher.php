<?php 
/* 
 * defautl switcher
 */
if ( !function_exists( 'xtocky_wc_get_currency' ) ) {
	function xtocky_wc_get_currency(){
         if ( ! class_exists( 'Pikoworks_Currency_Switcher' ) ) return;
	$currency = Pikoworks_Currency_Switcher::getCurrencies();
        
        if (  $currency > 0  ) :
		$woocurrency = Pikoworks_Currency_Switcher::woo_currency();
		$woocode = $woocurrency['currency'];
		if ( ! isset( $currency[$woocode] ) ) {
			$currency[$woocode] = $woocurrency;
		}
		$default = Pikoworks_Currency_Switcher::woo_currency();
		$current = isset( $_COOKIE['piko_currency'] ) ? $_COOKIE['piko_currency'] : $default['currency'];

		$output = '';

		$output .= '<ul class="piko-currency header-dropdown lang top-social">';
			$output .= '<li><a href="javascript:void(0);" class="current"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;' . esc_html( $current ) . '</a>';
			$output .= '<ul>';
				foreach( $currency as $code => $val ) :
					$output .= '<li>';
						$output .= '<a class="currency-name" href="javascript:void(0);" data-currency="' . esc_attr( $code ) . '">' . esc_html( $code ) . '</a>';
					$output .= '</li>';
				endforeach;
			$output .= '</ul>';
		$output .= '</li></ul>';
	endif;
	return apply_filters( 'xtocky_wc_currency', $output );
        
        
    }
}

/* 
 * language wpml
 */
if( ! function_exists( 'xtocky_lang_switcher' ) ){
    function xtocky_lang_switcher() {
        $wpml = isset( $GLOBALS['xtocky']['menu_bar_right_wpml'] ) ? trim( $GLOBALS['xtocky']['menu_bar_right_wpml'] ) : 0;
        
        if( function_exists( 'icl_get_languages' ) && $wpml == 1 ){
                $languages = icl_get_languages( 'skip_missing=0&orderby=code' );
                $output = '';
                if ( ! empty( $languages ) ) {
                        $output .= '<ul class="header-dropdown lang"><li> <a href="#"><i class="icon-globe" aria-hidden="true"></i> '. ICL_LANGUAGE_NAME_EN .'</a>';
                        $output .= '<ul>';
                        foreach ( $languages as $l ) {
                                if ( ! $l['active'] ) {
                                        $output .= '<li>';
                                        $output .= '<a href="' . $l['url'] . '"> <img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
                                        $output .= icl_disp_language( $l['native_name'] );
                                        $output .= '</a>';
                                        $output .= '</li>';
                                }
                        }
                        $output .= '</ul>';
                        $output .= '</li></ul>';
                        echo wp_kses_post( $output, true );
                }
        }
    }
}

if( ! function_exists( 'xtocky_lang_switcher_top' ) ){
    function xtocky_lang_switcher_top() {
        $wpml = isset( $GLOBALS['xtocky']['menu_top_bar_wpml'] ) ? trim( $GLOBALS['xtocky']['menu_top_bar_wpml'] ) : 0;
        $currency = isset( $GLOBALS['xtocky']['menu_top_bar_currency'] ) ? trim( $GLOBALS['xtocky']['menu_top_bar_currency'] ) : 0;
        
        
        if( $currency == true && !class_exists('SitePress')){ 
            echo xtocky_wc_get_currency(); //theme default 
        }
        if( class_exists('SitePress') && $currency == 1 ){
           echo'<div class="currency">' . (do_shortcode('[currency_switcher]')). '</div>'; 
        }        
        
        if( function_exists( 'icl_get_languages' ) && $wpml == 1 ){
                $languages = icl_get_languages( 'skip_missing=0&orderby=code' );
                $output = '';
                if ( ! empty( $languages ) ) {
                        $output .= '<ul class="header-dropdown lang"><li> <a href="#">'. ICL_LANGUAGE_NAME_EN .'</a>';
                        $output .= '<ul>';
                        foreach ( $languages as $l ) {
                                if ( ! $l['active'] ) {
                                        $output .= '<li>';
                                        $output .= '<a href="' . $l['url'] . '"> <img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
                                        $output .= icl_disp_language( $l['native_name'] );
                                        $output .= '</a>';
                                        $output .= '</li>';
                                }
                        }
                        $output .= '</ul>';
                        $output .= '</li></ul>';
                        echo wp_kses_post( $output, true );
                }
        }
    }
}
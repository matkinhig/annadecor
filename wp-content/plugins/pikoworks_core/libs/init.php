<?php
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}
 function pikoworks_decoding( $val ) {
	return base64_decode( $val );
}

function pikoworks_encoding( $val ) {
	return base64_encode( $val );
}

 /**
 * Load admin pages
 */
if ( function_exists( 'pikoworks_theme_setup' ) ) {
  
}

$theme = wp_get_theme(); // gets the current theme
if ('Xtocky' == $theme->name || 'Xtocky' == $theme->parent_theme) {
    require_once( PIKOWORKSCORE_LIBS . 'admin/admin.php' );  
}


 /**
 * Load Redux Framework 
 */
if ( !class_exists( 'ReduxFramework' ) && file_exists( PIKOWORKSCORE_LIBS . 'admin/ReduxCore/framework.php' ) ) {
    require_once( PIKOWORKSCORE_LIBS . 'admin/ReduxCore/framework.php' );
}

//replace for theme file
//
if( file_exists(PIKOWORKSCORE_LIBS . 'admin/redux-extensions/extensions-init.php') ){
 	require_once(PIKOWORKSCORE_LIBS . 'admin/redux-extensions/extensions-init.php' );
 } 
 /**
 * Load Metaboxes
 */
 if ( ! class_exists( 'RW_Meta_Box' ) ){
    require_once PIKOWORKSCORE_LIBS.'/admin/meta-box/meta-box.php';
}

 //Check Mobile tablet device
if( ! class_exists( 'Mobile_Detect' ) ){
    require_once PIKOWORKSCORE_LIBS.'classes/Mobile_Detect.php';
}
$detect = new Mobile_Detect;
if( ! function_exists( 'pikoworks_is_mobile' ) ){
    function pikoworks_is_mobile(){
        global $detect;
        return $detect->isMobile();
    }
}
if( ! function_exists( 'xtocky_is_mobile' ) ){ //for theme use
    function xtocky_is_mobile(){
        global $detect;
        return $detect->isMobile();
    }
}
if( ! function_exists( 'pikoworks_is_tablet' ) ){
    function pikoworks_is_tablet(){
        global $detect;
        return $detect->isTablet();
    }
}
 /**
 * Load twitter plugin 
 */
require_once PIKOWORKSCORE_LIBS.'/admin/latest-tweets-widget/latest-tweets.php';
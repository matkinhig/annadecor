<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>><head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
        <?php            
            $body_width =  get_post_meta(get_the_ID(),'xtocky_page_layout',true);
            if( class_exists( 'WooCommerce' ) && is_woocommerce() ){
                 $body_width = xtocky_get_option_data('shop-width-content', 'container');
            }
            if (!isset($body_width) || $body_width == '-1' || $body_width == '') {
                $body_width = isset( $GLOBALS['xtocky']['main-width-content'] ) ? $GLOBALS['xtocky']['main-width-content'] : 'container';
            }            
            $menu_style =  get_post_meta(get_the_ID(), 'xtocky_menu_style',true);
            if (!isset($menu_style) || $menu_style == '-1' || $menu_style == '') {
                $menu_style = isset( $GLOBALS['xtocky']['menu_style'] ) ? $GLOBALS['xtocky']['menu_style'] : '1';
            }             
            xtocky_enable_loader(); //Preloader 
            xtocky_headers_style(); //menu style 
         ?>
        <div id="piko-content"> <?php //just div fixed menu layout 3  ?>
	<div class="site-inner <?php echo esc_attr($body_width); ?>">
            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'xtocky' ); ?></a>
            <div id="content" class="site-content">
                <div class="row">
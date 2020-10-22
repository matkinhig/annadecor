<?php

/* 
 * @metabox init
 */

if ( !function_exists( 'piko_get_menu_list' ) ){
    /*
     * show all menu list an array
     */
	function piko_get_menu_list() {

		if ( !is_admin() ) {
			return array();
		}

		$user_menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		$menu_list = array();

		foreach ( $user_menus as $menu ) {
			$menu_list[ $menu->term_id ] = $menu->name;
		}

		return $menu_list;
	}
}

if ( !function_exists( 'piko_get_widgets_list' ) ) {
    /*
     * Sidebar list
     */
    function piko_get_widgets_list( ) {
        $widgets_list = array();
        foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
            $widgets_list[$sidebar['id']] = ucwords( $sidebar['name'] );
        }
        return $widgets_list;
    }
}

/*
 * loading meta-box filed
 */
require_once PIKOWORKSCORE_CORE . '/meta-box/meta-boxes.php';

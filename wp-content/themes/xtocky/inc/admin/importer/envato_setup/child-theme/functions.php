<?php
/*
 * Child Xtocky Theme
  Recommended way to include parent theme styles.
  Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme
*/

/**
 * Enqueue style of child theme
 */
function xtocky_parent_enqueue_script() {
    $parent_style = 'child-theme-styles';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	 wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
	
}
add_action( 'wp_enqueue_scripts', 'xtocky_parent_enqueue_script' );



<?php
/**
 *Theme Customizer.
 *
 */
if (!function_exists('xtocky_customize_register')) {
    /**
     * Add postMessage support for site title and description for the Theme Customizer.
     *
     * @param WP_Customize_Manager $wp_customize Theme Customizer object.
     */
    function xtocky_customize_register( $wp_customize ) {
            $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
            $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
            $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    }
    add_action( 'customize_register', 'xtocky_customize_register' );
}

if (!function_exists('xtocky_customize_js_preview')) {
    /**
     * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
     */
    function xtocky_customize_js_preview() {
            wp_enqueue_script( 'xtocky_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'jquery','customizer-preview' ), '', true );
    }
    add_action( 'customize_preview_init', 'xtocky_customize_js_preview' );
}
if (!function_exists('xtocky_custom_header_and_background')) {
    function xtocky_custom_header_and_background() {

            add_theme_support( 'custom-background', apply_filters( 'xtocky_custom_background_args', array(
                    'default-color' => '',
            ) ) );


            add_theme_support( 'custom-header', apply_filters( 'xtocky_custom_header_args', array(
                    'default-text-color'     => '',

            ) ) );
    }
    add_action( 'after_setup_theme', 'xtocky_custom_header_and_background' );
}
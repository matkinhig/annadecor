<?php
/**
 * Enqueues scripts and styles admin.
 *
 */
if(!function_exists('xtocky_admin_scripts')){
    function xtocky_admin_scripts(){ 
      wp_enqueue_style('stock-piko-fontpiko', XTOCKY_CSS.'/fontpiko.css', false, XTOCKY_THEME_VERSION, 'all' );
      wp_enqueue_media();   
      wp_enqueue_script('stock-piko-admin', XTOCKY_JS.'/admin.js', array('jquery'), XTOCKY_THEME_VERSION, true);     
    }
    add_action( 'admin_enqueue_scripts', 'xtocky_admin_scripts' );
}
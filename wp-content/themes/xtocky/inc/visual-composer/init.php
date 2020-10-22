<?php
/**
 * Initialize viusal composer.
 *
 */

if ( ! class_exists( 'VC_Manager' ) ) return;

// Remove "Design options", "Custom CSS" tabs and prompt message.
vc_set_as_theme();

// Change default template directory.
vc_set_shortcodes_templates_dir( XTOCKY_INC_DIR . '/visual-composer/shortcodes' );

// Include custom functions of vc element
$maps = ' heading';
$maps = array_map( 'trim', explode( ',', $maps ) );
foreach ( $maps as $file ) {
	include XTOCKY_INC_DIR  . 'visual-composer/maps/' . $file . '.php';
}
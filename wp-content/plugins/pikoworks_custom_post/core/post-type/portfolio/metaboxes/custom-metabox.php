<?php
/**
 * init custom meta
 */
require_once PIKOWORKS_CUSTOM_POST_LIBS . 'classes/MetaBox.php';
$class_metabox_qa = new WPAlchemy_MetaBox(array
(
    'id' => 'portfolio_custom_fields',
    'title' => esc_html__('Custom Field', 'pikoworks_custom_post'),
    'template' => plugin_dir_path( __FILE__ ) . 'custom-field.php',
    'types' => array(PIKO_PORTFOLIO_POST_TYPE),
    'autosave' => TRUE,
    'priority' => 'high',
    'context' => 'normal',
    'hide_editor' => FALSE
));



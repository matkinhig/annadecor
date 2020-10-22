<?php
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Load blog
 */
require_once PIKOWORKS_CUSTOM_POST_CORE.'post-type/blog/tags.php';
/**
 * Load brand
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
	require_once PIKOWORKS_CUSTOM_POST_CORE.'post-type/brand/brand.php';
	require_once PIKOWORKS_CUSTOM_POST_CORE.'post-type/brand/category-image.php';
}


/**
 * Load Post type dynamics
 */

require_once PIKOWORKS_CUSTOM_POST_CORE.'post-type/shortcodes.php';
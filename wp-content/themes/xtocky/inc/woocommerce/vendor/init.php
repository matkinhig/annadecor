<?php

/* 
 *support fo vendor plugins
 * 
 */


if ( xtocky_is_dokan_activated() ) {
    /**
     * Dokan Integration
     */
	require XTOCKY_INC_DIR . '/woocommerce/vendor/dokan/support-plugin.php';
}

if ( xtocky_is_wc_vendors_activated() ) {
    /**
     * WC Vendors Integration
     */
	require XTOCKY_INC_DIR . '/woocommerce/vendor/wc-vendors/support-plugin.php';
}
if ( xtocky_is_wc_marketplace_activated() ) {
    /**
     * WC Marketplace Integration
     */
	require XTOCKY_INC_DIR . '/woocommerce/vendor/wc-marketplace/support-plugin.php';
}
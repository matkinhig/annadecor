<?php

/* 
 *support fo wc vendor plugins
 * 
 */

function xtocky_wc_marketplace_styles() {
        $css_wmp = ".product-wrap .product-brand a + a + br + div + a,.product-wrap .product-brand a#report_abuse,.product-wrap .product-brand a#report_abuse + br{display: none;}.entry-summary .product_meta .by-vendor-name-link,.entry-summary .product_meta #report_abuse{display: inline-block !important;margin-right: 10px;margin-bottom: 10px;}.entry-summary .product_meta .by-vendor-name-link:before{font-family: fontpiko;padding-right: 5px;font-size: 85%;color: #535353;}.entry-summary .product_meta .by-vendor-name-link:before{}.entry-summary .product_meta #report_abuse:before{padding-right: 5px;}.entry-summary .product_meta .wcmp-abuse-report-title{font-size: 16px;font-weight: 500;}.entry-summary .product_meta .simplePopup{border: 1px solid}.description_data table td{border-color: #dfdfdf;} ";
        
        return $css_wmp;
}


<?php

/* 
 *support fo wc vendor free / pro plugins
 * 
 */
function xtocky_wc_vendor_styles() {
    $css_wcv = ".product_list_widget .variation{display: -ms-flexbox;display: flex;}.product_list_widget .variation .variation-SoldBy p{margin:0}.product_list_widget .variation .variation-SoldBy a{padding-left: 0 !important;height: auto !important;}.wcv_shop_description,.site-main > h1{text-align: center;padding: 0 15px;}.site-main > h1{text-transform: uppercase;position: relative;}.site-main > h1:after{content: '';position: absolute;width: 120px;background: #555;height: 2px;bottom: -5px;left: 50%;transform: translate(-50%, -50%);}.product-wrap .product-brand .product_meta br + a:not(.wcvendors_cart_sold_by_meta),.product-wrap .product-brand .wcvendors_ships_from,.product-wrap .product-brand .wcvendors_ships_from + br,.product-wrap .product-brand .wcvendors_ships_from + br + a + br,.product-wrap .product-brand .wcvendors_ships_from + br + a + br + a,.product-wrap .wcvendors_sold_by_in_loop,.product-wrap .wcvendors_sold_by_in_loop + br,.entry-summary .wcvendors_ships_from br,.entry-summary .wcvendors_ships_from + br{display: none;}.wcv-form .control-group .select2-container .select2-choice{padding: 8px 10px 8px;height: 42px;} ";
        
    return $css_wcv;     
}





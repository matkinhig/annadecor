<?php

/* 
 *support for wc dokan plugins
 * 
 */

function xtocky_dokan_vendor_styles() {
    
     $css_wcv = '.store-wrapper .store-footer{text-align: center;}.dokan-store-sidebar ul{padding-left: 0;}.piko-location-filters h1{font-size:20px;text-align:center;max-width:420px;margin:0 auto 20px}.layout-1.piko-location-filters h1 {font-size: 16px}@media (min-width:768px){.piko-location-filters .filters-wrap{max-width:768px;background-color:rgba(255,255,255,.9);margin:auto;padding:50px 30px 60px}.overflow-none{overflow:inherit!important}.piko-location-filters.layout-3 .filters-wrap{position:absolute;transform:translate(-50%,50%);left:50%;bottom:0;z-index:10;width:100%}}.product-name dd.variation-Vendor, .product-name dl.variation p, .product-name dl.variation{margin-bottom:0} .dokan-row input:not([type="submit"]):not([type="checkbox"]){padding: .4375rem .9375rem .5625rem;}.piko-vendor a.dokan-btn-theme:hover,.piko-vendor a.dokan-btn-theme:hover{opacity: 0.65}#dokan-geolocation-locations-map.dokan-geolocation-locations-map-top{margin-bottom:28px}.woocommerce-products-header + .woocommerce-notices-wrapper + #dokan-geolocation-locations-map{margin-top:25px}.dokan-geo-map-info-window .info-title {line-height: 1;}.piko-location-filters{padding-top:90px;padding-bottom:80px}.piko-location-filters .dokan-geolocation-location-filters{margin:0 auto}.piko-location-filters .dokan-geolocation-location-filters input,.piko-location-filters .dokan-geolocation-location-filters select{background-color:rgba(255,255,255,.85)}.piko-location-filters .dokan-w12,.piko-location-filters.layout-vendor .dokan-row .dokan-w12,.piko-location-filters.layout-vendor .dokan-row .dokan-w4:first-child,.piko-location-filters:not(.show_cat) .dokan-geo-product-categories,.piko-location-filters:not(.show_cat) .dokan-geo-store-categories,.piko-location-filters:not(.show_cat) .dokan-row .dokan-w4:first-child,.piko-location-filters:not(.show_product_search) .dokan-row .dokan-w4:first-child{display:none!important}.piko-location-filters .dokan-geo-product-categories,.piko-location-filters .dokan-geo-store-categories{width:220px}.piko-location-filters:not(.show_cat) .dokan-w4:nth-child(2){width:100%;padding:0 25px}.piko-location-filters.show_cat .dokan-row .dokan-w4:nth-child(2){width:calc(100% - 220px)}.piko-location-filters.show_cat.show_product_search .dokan-row .dokan-w4:nth-child(2){width:calc(66% - 220px)}.piko-location-filters.show_cat.show_product_search .dokan-geolocation-location-filters{max-width:1170px}.piko-location-filters.show_cat:not(.show_product_search) .dokan-geolocation-location-filters{max-width:992px}.piko-location-filters:not(.show_cat):not(.show_product_search) .dokan-geolocation-location-filters{max-width:768px}.just-wraper+#piko-content #dokan-store-listing-filter-wrap{margin-top:-40px}@media (min-width:992px){.just-wraper+#piko-content .entry-content #dokan-geolocation-locations-map.dokan-geolocation-locations-map-top,.post-type-archive-product .just-wraper+#piko-content #dokan-geolocation-locations-map{height:400px}.piko-location-filters{padding-top:170px;padding-bottom:150px}.just-wraper+#piko-content #dokan-store-listing-filter-wrap,.post-type-archive-product .just-wraper+#piko-content #dokan-geolocation-locations-map{margin-left:calc(50% - 50vw);margin-right:calc(50% - 50vw);width:auto;max-width:1000%;margin-top:-50px;padding:0 0 20px;box-shadow:5px 10px 10px 0 #f9f9f9}.just-wraper+#piko-content #dokan-store-listing-filter-wrap .dokan-geolocation-locations-map-top+.left,.post-type-archive-product .just-wraper+#piko-content #dokan-geolocation-locations-map .dokan-geolocation-locations-map-top+.left{margin-left:calc(25% - 50px)}.just-wraper+#piko-content #dokan-store-listing-filter-wrap .dokan-geolocation-locations-map-top+.left+.right,.post-type-archive-product .just-wraper+#piko-content #dokan-geolocation-locations-map .dokan-geolocation-locations-map-top+.left+.right{margin-right:calc(25% - 50px)}.just-wraper+#piko-content #dokan-seller-listing-wrap{margin-top:40px}}@media (max-width:991px){.piko-location-filters.show_product_search .dokan-row .dokan-w4:first-child{width:100%;padding:0 25px}.piko-location-filters.show_product_search .dokan-row .dokan-w4:nth-child(2){width:calc(100% - 220px)!important;padding-left:25px}.piko-location-filters.show_product_search .dokan-row .dokan-geo-product-categories,.piko-location-filters.show_product_search .dokan-row .dokan-geo-store-categories{padding-right:25px}}.piko-vendor .dokan-seller-wrap li .store-footer{position:relative;padding:15px 20px;background-color:snow!important;-webkit-transition:transform .4s ease-out;transition:padding .3s,transform .4s ease-out;-webkit-transform:translateY(0);transform:translateY(0)}.piko-vendor ul.dokan-seller-wrap li .store-footer .seller-avatar{background:#fff;position:absolute;width:80px;height:80px;top:-40px;right:20px;border-radius:40px;padding:3px;box-shadow:0 0 15px -6px #f2f2f2}.piko-vendor ul.dokan-seller-wrap .woocommerce{list-style-type:none;float:left}@media (min-width:768px){.piko-vendor ul.dokan-seller-wrap{margin-left:-15px;margin-right:-15px}.piko-vendor ul.dokan-seller-wrap .woocommerce{padding-left:15px;padding-right:15px;width:20%}}@media (max-width:767px){.stcr.slick-initialized:not(.product_list_widget){padding-top:20px}.piko-vendor .slick-dots{padding-top:16px}}.piko-vendor .woocommerce .store-wrapper{background-color:snow!important}.piko-vendor .woocommerce:hover .store-footer{-webkit-transform:translateY(-40px);transform:translateY(-40px)}.piko-vendor .woocommerce .store-wrapper .store-header .store-banner{min-height:220px;position:relative}.piko-vendor .woocommerce .store-wrapper .store-header .store-banner img{position:absolute;left:0;top:0;max-width:100%;height:100%;width:-moz-available;width:-webkit-fill-available;width:fill-available}.piko-vendor .woocommerce{overflow:hidden}.piko-vendor .woocommerce .dokan-view-vendor{-webkit-transition:transform .6s ease-out;transition:transform .6s ease-out;-webkit-transform:translateY(100px);transform:translateY(100px);left:0;right:0;bottom:-1.25rem}.piko-vendor .woocommerce:hover .dokan-view-vendor{-webkit-transform:translateY(0);transform:translateY(0)}.piko-vendor .woocommerce .store-footer .seller-avatar{left:0!important;right:0!important;margin:0 auto}.piko-vendor .woocommerce .store-info-1{height:12.5rem}.piko-vendor .woocommerce .store-info-1 img{height:100%;object-fit:cover}.piko-vendor .woocommerce .featured-label{position:absolute;top:.625rem;right:.625rem;background-color:#f76aa5;text-align:center;padding:0 .625rem;font-size:.875rem;color:#fff}.piko-vendor .woocommerce .store-footer h2{font-size:1.25rem;margin-bottom:.375rem}.piko-vendor .woocommerce .dokan-seller-rating{margin:0 auto .3125rem;font-size:.75rem;line-height:.75rem;width:5rem}.dokan-dashboard .media-router .media-menu-item{color:000}.dokan-dashboard .media-router .media-menu-item:hover{color:#fff}.piko-vendor.subtitle-no .stcr .slick-arrow{top:-20px}@media (min-width:768px){.piko-vendor.subtitle-no .stcr .slick-arrow{top:-30px}}.dokan-store-open-close .open-close-day{display:flex;justify-content:space-between}.dokan-store-open-close .open-close-day span{font-size:13px}.post-type-archive-product #dokan-geolocation-locations-map{margin-bottom:35px}#dokan-store-listing-filter-form-wrap .store-lists-other-filter-wrap .store-lists-category .category-input .category-label,#dokan-store-listing-filter-form-wrap .store-lists-other-filter-wrap .item label {font-weight: 500;}#dokan-store-listing-filter-form-wrap .store-lists-other-filter-wrap .store-ratings .dokan-stars .up{ font-size: 13px;top: 0;}.dokan-geolocation-location-filters .dokan-row input[type="range"].dokan-range-slider {width: 100% !important;}.woocommerce-products-header + .woocommerce-notices-wrapper + .dokan-geolocation-location-filters{margin-top: 25px;}.dokan-mapboxgl-ctrl.mapboxgl-ctrl-group > button { padding: 3px 12px; color: black; line-height: 1; }.mapboxgl-ctrl-geocoder--button{height: auto; background-color: transparent;}.mapboxgl-popup-close-button {padding: 0;height: auto;line-height: 1;color: black !important;right: 5px;top: 2px;font-size: 20px !important;background-color: transparent !important; }.dokan-geolocation-location-filters .dokan-w12 .range-slider-container {margin-bottom: 30px !important;}#dokan-product-enquiry textarea{min-width: 320px; margin-bottom: 26px;}.dokan-store-sidebar{margin-right:0}#dokan-seller-listing-wrap.list-view .dokan-seller-wrap .dokan-single-seller .store-wrapper > .store-content{padding-left:0}#dokan-seller-listing-wrap.list-view .dokan-seller-wrap .dokan-single-seller .store-wrapper .store-footer[class] button{margin-right:0}.list-view .dokan-single-seller .dokan-view-vendor {-webkit-transform: translateY(0);transform: translateY(0); position: absolute;}.list-view .dokan-single-seller .store-footer {-webkit-transform: translateY(-40px);transform: translateY(-40px);}#dokan-seller-listing-wrap.grid-view .store-content{position: inherit;}.dokan-view-vendor{bottom:-1.25rem}.dokan-single-seller{overflow:hidden}.dokan-single-seller .dokan-view-vendor{-webkit-transition:transform .5s ease-out;transition:transform .5s ease-out;-webkit-transform:translateY(100px);transform:translateY(100px);left:0;right:0;position: absolute;}.list-view .dokan-single-seller .dokan-view-vendor{left: auto;right: auto} .dokan-single-seller:hover .dokan-view-vendor{-webkit-transform:translateY(0);transform:translateY(0)}.dokan-single-seller .store-footer .seller-avatar{left:0!important;right:0!important;margin:0 auto}.dokan-single-seller .store-wrapper{box-shadow:inherit!important;background-color:snow!important}.dokan-single-seller .store-footer{background-color:snow!important;-webkit-transition:transform .4s ease-out;transition:padding .3s,transform .4s ease-out;-webkit-transform:translateY(0);transform:translateY(0);border:none!important;position: absolute;}.dokan-single-seller .store-footer h2{font-size:1.25rem;margin-bottom:.375rem}.dokan-single-seller:hover .store-footer{-webkit-transform:translateY(-40px);transform:translateY(-40px)}.dokan-single-seller .store-info-1{height:12.5rem}.dokan-single-seller .store-info-1 img{height:100%;object-fit:cover}.dokan-single-seller .featured-label{position:absolute;top:.625rem;right:.625rem;background-color:#f76aa5;text-align:center;padding:0 .625rem;font-size:.875rem;color:#fff}.dokan-single-seller .dokan-seller-rating{margin:0 auto .3125rem;font-size:.75rem;line-height:.75rem;width:5rem}@media (min-width:1200px){.dokan-seller-wrap .dokan-single-seller.coloum-2:nth-child(2n+1),.dokan-seller-wrap .dokan-single-seller.coloum-3:nth-child(3n+1),.dokan-seller-wrap .dokan-single-seller.coloum-4:nth-child(4n+1),.dokan-seller-wrap .dokan-single-seller.coloum-5:nth-child(5n+1),.dokan-seller-wrap .dokan-single-seller.coloum-6:nth-child(6n+1){clear:both}.dokan-single-store .profile-frame .profile-info-box.profile-layout-layout2 .profile-info-summery-wrapper .profile-info-summery .profile-info .dokan-store-info{max-width:34.375rem;margin:0 auto}.dokan-single-store .profile-frame .profile-info-box.profile-layout-layout2 .profile-info-summery-wrapper .profile-info-summery .profile-info .dokan-store-info li{padding-bottom:.3125rem;margin:0 .625rem}.dokan-single-store .profile-frame .profile-info-box.profile-layout-layout2 .profile-info-summery-wrapper{height:16.875rem}.dokan-single-store .profile-frame .profile-info-box.profile-layout-layout2 .profile-info-summery-wrapper .profile-info-summery .profile-info .dokan-store-info li:after{content:inherit}.dokan-single-store .profile-frame .profile-info-box.profile-layout-layout2 .profile-info-summery-wrapper .profile-info-summery .profile-info .store-social-wrapper .store-social{margin-top:.625rem}}.dokan-follow-store-button span+span,[data-status^=following] .dokan-follow-store-button-label-current{display:none}[data-status^=following] .dokan-follow-store-button-label-current+span{display:block}.dokan-seller-search-form{margin-top:0}#dokan-seller-listing-wrap ul.dokan-seller-wrap li{margin-bottom:1.875rem}.dokan-store-tabs .dokan-list-inline .dokan-right button{margin-top:.3125rem}.dokan-single-store .dokan-store-tabs ul li.dokan-store-support-btn-wrap{margin-right:0}.dokan-widget-area .widget-title{margin-bottom:1.5625rem}.dokan-widget-area .dokan-form-group{margin-bottom:.9375rem}.dokan-widget-area .dokan-form-control{border-width:1px!important;padding:10px 15px!important}.vendor-name{font-size:14px;max-width: 240px;}.vendor-name span{color:#7f7f82;margin-right:.375rem}.dokan-store-sidebar #cat-drop-stack a.selected{font-weight:500!important;color:#22222b}#tab-more_seller_product .row{margin:0 -.9375rem}#tab-more_seller_product .row li{padding:0 .9375rem}#tab-more_seller_product .columns-3 li,#tab-more_seller_product .columns-4 li{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}@media (min-width:992px){#tab-more_seller_product .columns-4 li{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}#tab-more_seller_product .columns-3 li{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}}.btn-details-action .dokan-btn.dokan-btn-theme{margin-bottom:1.4375rem}.btn-details-action{position:relative}.btn-details-action form .warranty_info{width:100%;position:absolute;top:-4.0625rem;right:0;text-align:right}.btn-details-action form .warranty_info b{font-weight:500;color:#22222b}.btn-details-action form+form .warranty_info{top:0}.product-single .wc-tab strong{font-weight:500}.product-single .wc-tab hr{border-width:1px 0 0;border-style:dashed;border-color:#eef2f7}.product-single .star-rating strong{position:relative;right:-9.375rem;display:block}.product-single .list-unstyled .text{padding-top:1.25rem;margin-top:.85rem;display:block}.logged-in select{background-image:none!important}.woocommerce-checkout-review-order-table .product-name .variation dd,.woocommerce-checkout-review-order-table .product-name .variation dt{display:inline-block;font-size:.75rem}.dokan-dashboard-wrap select{ background-image: none !important;}.dokan-single-store .dokan-store-tabs ul li.dokan-share-btn-wrap{border:none}.dokan-widget-area .widget-title{font-size:17px}.dokan-store .woocommerce-products-header{display:none}.dokan-add-new-product-popup #dokan-product-images ul.product_images li.image, .dokan-add-new-product-popup #dokan-product-images ul.product_images li.dokan-sortable-placeholder, .dokan-add-new-product-popup #dokan-product-images ul.product_images li.add-image{list-style:none}  @media (max-width:991px){.dokan-store .just-wraper{margin-bottom: 30px;}}@media (max-width:767px){.dokan-single-store .profile-frame .profile-info-box.profile-layout-layout1 .profile-info-summery-wrapper .profile-info-summery .profile-info-head .profile-img img{width: 80px;height: 80px;}.dokan-seller-listing .dokan-seller-search-form input#search{width: 100%;}}.dokan-single-store .commentlist{ margin:0;padding: 0;list-style: none;}#tab-seller .list-unstyled .clearfix{position:relative;margin-top: 30px}.tab-content .seller-rating{margin-top:22px;position: absolute;}.tab-content .seller-rating + .text{padding-left:110px; display:inline-block}.tab-content .seller-rating .star-rating span{position: static;}.tab-content .seller-rating .star-rating span + span{font-size: 0;}.dokan-message .dokan-close{font-size:20px;}.dokan-message .dokan-close:hover{background-color:transparent;}.dokan-reviews-content .dokan-reviews-area .dokan-comments-wrap select{width: calc( 100% - 118px);}.dokan-report-wrap .report-filter .dokan-form-group,.dokan-single-store .commentlist .review_comment_container .dokan-review-author-img img{width: 100px;border-radius:4px;margin-right:30px}.dokan-single-store .commentlist .review_comment_container .comment-text p{margin:0;font-size:12px}.dokan-single-store .commentlist .review_comment_container .comment-text h5{margin:0}.dokan-single-store .commentlist .review_comment_container,.dokan-order-filter-serach .dokan-left .dokan-form-group{display: -ms-flexbox;display: flex;align-items: center;}.dokan-info{background-color: #f4f4f4;}.dokan-widget-area .widget{margin-bottom: 60px;}.dokan-category-menu .widget-title:after{content: inherit;}input.dokan-btn[type="submit"], a.dokan-btn, .dokan-btn{padding: 0 34px}.dokan-btn-theme{color:#fff !important}li.dokan-share-btn-wrap:hover .dokan-share-btn,a.dokan-btn:hover{opacity:0.8}#dokan-seller-listing-wrap ul.dokan-seller-wrap li .store-wrapper {box-shadow: 0px 0px 5px 0px #ddd;} a.dokan-btn, .dokan-btn{  height: 36px!important;line-height: 34px !important;border-radius: 0 !important;}.dokan-btn{ line-height:1 !important;}.dokan-seller-search {border-radius: 0 !important;border: 1px solid !important;background-position: 8px 12px !important;}.dokan-seller-listing .dokan-seller-search-form{margin-top: 0;}#dokan-seller-listing-wrap ul.dokan-seller-wrap li .store-footer .seller-avatar{padding: 3px;box-shadow: 0px 0px 15px -6px #f2f2f2;}#tab-seller ul{list-style: none;padding-left: 0;}';
    if(is_rtl()){
        $css_wcv = '.store-wrapper .store-footer{text-align: center;}.dokan-store-sidebar ul{padding-right: 0;}.piko-location-filters h1{font-size:20px;text-align:center;max-width:420px;margin:0 auto 20px}.layout-1.piko-location-filters h1 {font-size: 16px}@media (min-width:768px){.piko-location-filters .filters-wrap{max-width:768px;background-color:rgba(255,255,255,.9);margin:auto;padding:50px 30px 60px}.overflow-none{overflow:inherit!important}.piko-location-filters.layout-3 .filters-wrap{position:absolute;transform:translate(-50%,50%);left:50%;bottom:0;z-index:10;width:100%}}.product-name dd.variation-Vendor, .product-name dl.variation p, .product-name dl.variation{margin-bottom:0}.dokan-row input:not([type="submit"]):not([type="checkbox"]){padding: .4375rem .9375rem .5625rem;}.piko-vendor a.dokan-btn-theme:hover,.piko-vendor a.dokan-btn-theme:hover{opacity: 0.65}#dokan-geolocation-locations-map.dokan-geolocation-locations-map-top{margin-bottom:28px}.woocommerce-products-header + .woocommerce-notices-wrapper + #dokan-geolocation-locations-map{margin-top:25px}.dokan-geo-map-info-window .info-title {line-height: 1;}.piko-location-filters{padding-top:90px;padding-bottom:80px}.piko-location-filters .dokan-geolocation-location-filters{margin:0 auto}.piko-location-filters .dokan-geolocation-location-filters input,.piko-location-filters .dokan-geolocation-location-filters select{background-color:rgba(255,255,255,.85)}.piko-location-filters .dokan-w12,.piko-location-filters.layout-vendor .dokan-row .dokan-w12,.piko-location-filters.layout-vendor .dokan-row .dokan-w4:first-child,.piko-location-filters:not(.show_cat) .dokan-geo-product-categories,.piko-location-filters:not(.show_cat) .dokan-geo-store-categories,.piko-location-filters:not(.show_cat) .dokan-row .dokan-w4:first-child,.piko-location-filters:not(.show_product_search) .dokan-row .dokan-w4:first-child{display:none!important}.piko-location-filters .dokan-geo-product-categories,.piko-location-filters .dokan-geo-store-categories{width:220px}.piko-location-filters:not(.show_cat) .dokan-w4:nth-child(2){width:100%;padding:0 25px}.piko-location-filters.show_cat .dokan-row .dokan-w4:nth-child(2){width:calc(100% - 220px)}.piko-location-filters.show_cat.show_product_search .dokan-row .dokan-w4:nth-child(2){width:calc(66% - 220px)}.piko-location-filters.show_cat.show_product_search .dokan-geolocation-location-filters{max-width:1170px}.piko-location-filters.show_cat:not(.show_product_search) .dokan-geolocation-location-filters{max-width:992px}.piko-location-filters:not(.show_cat):not(.show_product_search) .dokan-geolocation-location-filters{max-width:768px}.just-wraper+#piko-content #dokan-store-listing-filter-wrap{margin-top:-40px}@media (min-width:992px){.just-wraper+#piko-content .entry-content #dokan-geolocation-locations-map.dokan-geolocation-locations-map-top,.post-type-archive-product .just-wraper+#piko-content #dokan-geolocation-locations-map{height:400px}.piko-location-filters{padding-top:170px;padding-bottom:150px}.just-wraper+#piko-content #dokan-store-listing-filter-wrap,.post-type-archive-product .just-wraper+#piko-content #dokan-geolocation-locations-map{margin-left:calc(50% - 50vw);margin-right:calc(50% - 50vw);width:auto;max-width:1000%;margin-top:-50px;padding:0 0 20px;box-shadow:5px 10px 10px 0 #f9f9f9}.just-wraper+#piko-content #dokan-store-listing-filter-wrap .dokan-geolocation-locations-map-top+.left,.post-type-archive-product .just-wraper+#piko-content #dokan-geolocation-locations-map .dokan-geolocation-locations-map-top+.left{margin-left:calc(25% - 50px)}.just-wraper+#piko-content #dokan-store-listing-filter-wrap .dokan-geolocation-locations-map-top+.left+.right,.post-type-archive-product .just-wraper+#piko-content #dokan-geolocation-locations-map .dokan-geolocation-locations-map-top+.left+.right{margin-right:calc(25% - 50px)}.just-wraper+#piko-content #dokan-seller-listing-wrap{margin-top:40px}}@media (max-width:991px){.piko-location-filters.show_product_search .dokan-row .dokan-w4:first-child{width:100%;padding:0 25px}.piko-location-filters.show_product_search .dokan-row .dokan-w4:nth-child(2){width:calc(100% - 220px)!important;padding-right:25px}.piko-location-filters.show_product_search .dokan-row .dokan-geo-product-categories,.piko-location-filters.show_product_search .dokan-row .dokan-geo-store-categories{padding-left:25px}}.piko-vendor .dokan-seller-wrap li .store-footer{position:relative;padding:15px 20px;background-color:snow!important;-webkit-transition:transform .4s ease-out;transition:padding .3s,transform .4s ease-out;-webkit-transform:translateY(0);transform:translateY(0)}.piko-vendor ul.dokan-seller-wrap li .store-footer .seller-avatar{background:#fff;position:absolute;width:80px;height:80px;top:-40px;right:20px;border-radius:40px;padding:3px;box-shadow:0 0 15px -6px #f2f2f2}.piko-vendor ul.dokan-seller-wrap .woocommerce{list-style-type:none;float:right}@media (min-width:768px){.piko-vendor ul.dokan-seller-wrap{margin-left:-15px;margin-right:-15px}.piko-vendor ul.dokan-seller-wrap .woocommerce{padding-left:15px;padding-right:15px;width:20%}}@media (max-width:767px){.stcr.slick-initialized:not(.product_list_widget){padding-top:20px}.piko-vendor .slick-dots{padding-top:16px}}.piko-vendor .woocommerce .store-wrapper{background-color:snow!important}.piko-vendor .woocommerce:hover .store-footer{-webkit-transform:translateY(-40px);transform:translateY(-40px)}.piko-vendor .woocommerce .store-wrapper .store-header .store-banner{min-height:220px;position:relative}.piko-vendor .woocommerce .store-wrapper .store-header .store-banner img{position:absolute;right:0;top:0;max-width:100%;height:100%;width:-moz-available;width:-webkit-fill-available;width:fill-available}.piko-vendor .woocommerce{overflow:hidden}.piko-vendor .woocommerce .dokan-view-vendor{-webkit-transition:transform .6s ease-out;transition:transform .6s ease-out;-webkit-transform:translateY(100px);transform:translateY(100px);left:0;right:0;bottom:-1.25rem}.piko-vendor .woocommerce:hover .dokan-view-vendor{-webkit-transform:translateY(0);transform:translateY(0)}.piko-vendor .woocommerce .store-footer .seller-avatar{left:0!important;right:0!important;margin:0 auto}.piko-vendor .woocommerce .store-info-1{height:12.5rem}.piko-vendor .woocommerce .store-info-1 img{height:100%;object-fit:cover}.piko-vendor .woocommerce .featured-label{position:absolute;top:.625rem;right:.625rem;background-color:#f76aa5;text-align:center;padding:0 .625rem;font-size:.875rem;color:#fff}.piko-vendor .woocommerce .store-footer h2{font-size:1.25rem;margin-bottom:.375rem}.piko-vendor .woocommerce .dokan-seller-rating{margin:0 auto .3125rem;font-size:.75rem;line-height:.75rem;width:5rem}.dokan-dashboard .media-router .media-menu-item{color:000}.dokan-dashboard .media-router .media-menu-item:hover{color:#fff}.piko-vendor.subtitle-no .stcr .slick-arrow{top:-20px}@media (min-width:768px){.piko-vendor.subtitle-no .stcr .slick-arrow{top:-30px}}.dokan-store-open-close .open-close-day{display:flex;justify-content:space-between}.dokan-store-open-close .open-close-day span{font-size:13px}.post-type-archive-product #dokan-geolocation-locations-map{margin-bottom:35px}.woocommerce.toplevel_page_dokan select{padding: 0 8px 0 24px !important;}#dokan-store-listing-filter-form-wrap .store-lists-other-filter-wrap .store-lists-category .category-input .category-label,#dokan-store-listing-filter-form-wrap .store-lists-other-filter-wrap .item label {font-weight: 500;}#dokan-store-listing-filter-form-wrap .store-lists-other-filter-wrap .store-ratings .dokan-stars .up{ font-size: 13px;top: 0;}.dokan-geolocation-location-filters .dokan-row input[type="range"].dokan-range-slider {width: 100% !important;}.woocommerce-products-header + .woocommerce-notices-wrapper + .dokan-geolocation-location-filters{margin-top: 25px;}.dokan-mapboxgl-ctrl.mapboxgl-ctrl-group > button { padding: 3px 12px; color: black; line-height: 1; }.mapboxgl-ctrl-geocoder--button{height: auto; background-color: transparent;}.mapboxgl-popup-close-button {padding: 0;height: auto;line-height: 1;color: black !important;left: 5px;top: 2px;font-size: 20px !important;background-color: transparent !important; }.dokan-geolocation-location-filters .dokan-w12 .range-slider-container {margin-bottom: 30px !important;}#dokan-product-enquiry textarea{min-width: 320px; margin-bottom: 26px;}.dokan-store-sidebar{margin-left:0}#dokan-seller-listing-wrap.list-view .dokan-seller-wrap .dokan-single-seller .store-wrapper > .store-content{padding-left:0}#dokan-seller-listing-wrap.list-view .dokan-seller-wrap .dokan-single-seller .store-wrapper .store-footer[class] button{margin-right:0}.list-view .dokan-single-seller .dokan-view-vendor {-webkit-transform: translateY(0);transform: translateY(0); position: absolute;}.list-view .dokan-single-seller .store-footer {-webkit-transform: translateY(-40px);transform: translateY(-40px);}#dokan-seller-listing-wrap.grid-view .store-content{position: inherit;}.dokan-view-vendor{bottom:-1.25rem}.dokan-single-seller{overflow:hidden}.dokan-single-seller .dokan-view-vendor{-webkit-transition:transform .5s ease-out;transition:transform .5s ease-out;-webkit-transform:translateY(100px);transform:translateY(100px);right:0;left:0; position: absolute;}.list-view .dokan-single-seller .dokan-view-vendor{left: auto;right: auto}.dokan-single-seller:hover .dokan-view-vendor{-webkit-transform:translateY(0);transform:translateY(0)}.dokan-single-seller .store-footer .seller-avatar{right:0!important;left:0!important;margin:0 auto}.dokan-single-seller .store-wrapper{box-shadow:inherit!important;background-color:snow!important}.dokan-single-seller .store-footer{background-color:snow!important;-webkit-transition:transform .4s ease-out;transition:padding .3s,transform .4s ease-out;-webkit-transform:translateY(0);transform:translateY(0);border:none!important}.dokan-single-seller .store-footer h2{font-size:1.25rem;margin-bottom:.375rem}.dokan-single-seller:hover .store-footer{-webkit-transform:translateY(-40px);transform:translateY(-40px)}.dokan-single-seller .store-info-1{height:12.5rem}.dokan-single-seller .store-info-1 img{height:100%;object-fit:cover}.dokan-single-seller .featured-label{position:absolute;top:.625rem;left:.625rem;background-color:#f76aa5;text-align:center;padding:0 .625rem;font-size:.875rem;color:#fff}.dokan-single-seller .dokan-seller-rating{margin:0 auto .3125rem;font-size:.75rem;line-height:.75rem;width:5rem}@media (min-width:1200px){.dokan-seller-wrap .dokan-single-seller.coloum-2:nth-child(2n+1),.dokan-seller-wrap .dokan-single-seller.coloum-3:nth-child(3n+1),.dokan-seller-wrap .dokan-single-seller.coloum-4:nth-child(4n+1),.dokan-seller-wrap .dokan-single-seller.coloum-5:nth-child(5n+1),.dokan-seller-wrap .dokan-single-seller.coloum-6:nth-child(6n+1){clear:both}.dokan-single-store .profile-frame .profile-info-box.profile-layout-layout2 .profile-info-summery-wrapper .profile-info-summery .profile-info .dokan-store-info{max-width:34.375rem;margin:0 auto}.dokan-single-store .profile-frame .profile-info-box.profile-layout-layout2 .profile-info-summery-wrapper .profile-info-summery .profile-info .dokan-store-info li{padding-bottom:.3125rem;margin:0 .625rem}.dokan-single-store .profile-frame .profile-info-box.profile-layout-layout2 .profile-info-summery-wrapper{height:16.875rem}.dokan-single-store .profile-frame .profile-info-box.profile-layout-layout2 .profile-info-summery-wrapper .profile-info-summery .profile-info .dokan-store-info li:after{content:inherit}.dokan-single-store .profile-frame .profile-info-box.profile-layout-layout2 .profile-info-summery-wrapper .profile-info-summery .profile-info .store-social-wrapper .store-social{margin-top:.625rem}}.dokan-follow-store-button span+span,[data-status^=following] .dokan-follow-store-button-label-current{display:none}[data-status^=following] .dokan-follow-store-button-label-current+span{display:block}.dokan-seller-search-form{margin-top:0}#dokan-seller-listing-wrap ul.dokan-seller-wrap li{margin-bottom:1.875rem}.dokan-store-tabs .dokan-list-inline .dokan-right button{margin-top:.3125rem}.dokan-single-store .dokan-store-tabs ul li.dokan-store-support-btn-wrap{margin-left:0}.dokan-widget-area .widget-title{margin-bottom:1.5625rem}.dokan-widget-area .dokan-form-group{margin-bottom:.9375rem}.dokan-widget-area .dokan-form-control{border-width:1px!important;padding:10px 15px!important}.vendor-name{font-size:14px;max-width: 240px;}.vendor-name span{color:#7f7f82;margin-left:.375rem}.dokan-store-sidebar #cat-drop-stack a.selected{font-weight:500!important;color:#22222b}#tab-more_seller_product .row{margin:0 -.9375rem}#tab-more_seller_product .row li{padding:0 .9375rem}#tab-more_seller_product .columns-3 li,#tab-more_seller_product .columns-4 li{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}@media (min-width:992px){#tab-more_seller_product .columns-4 li{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}#tab-more_seller_product .columns-3 li{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}}.btn-details-action .dokan-btn.dokan-btn-theme{margin-bottom:1.4375rem}.btn-details-action{position:relative}.btn-details-action form .warranty_info{width:100%;position:absolute;top:-4.0625rem;left:0;text-align:left}.btn-details-action form .warranty_info b{font-weight:500;color:#22222b}.btn-details-action form+form .warranty_info{top:0}.product-single .wc-tab strong{font-weight:500}.product-single .wc-tab hr{border-width:1px 0 0;border-style:dashed;border-color:#eef2f7}.product-single .star-rating strong{position:relative;left:-9.375rem;display:block}.product-single .list-unstyled .text{padding-top:1.25rem;margin-top:.85rem;display:block}.logged-in select{background-image:none!important}.woocommerce-checkout-review-order-table .product-name .variation dd,.woocommerce-checkout-review-order-table .product-name .variation dt{display:inline-block;font-size:.75rem}.dokan-dashboard-wrap select{ background-image: none !important;}.dokan-single-store .dokan-store-tabs ul li.dokan-share-btn-wrap{border:none}.dokan-widget-area .widget-title{font-size:17px}.dokan-store .woocommerce-products-header{display:none}.dokan-add-new-product-popup #dokan-product-images ul.product_images li.image, .dokan-add-new-product-popup #dokan-product-images ul.product_images li.dokan-sortable-placeholder, .dokan-add-new-product-popup #dokan-product-images ul.product_images li.add-image{list-style:none}  @media (max-width:991px){.dokan-store .just-wraper{margin-bottom: 30px;}}@media (max-width:767px){.dokan-single-store .profile-frame .profile-info-box.profile-layout-layout1 .profile-info-summery-wrapper .profile-info-summery .profile-info-head .profile-img img{width: 80px;height: 80px;}.dokan-seller-listing .dokan-seller-search-form input#search{width: 100%;}}.dokan-single-store .commentlist{ margin:0;padding: 0;list-style: none;}#tab-seller .list-unstyled .clearfix{position:relative;margin-top: 30px}.tab-content .seller-rating{margin-top:22px;position: absolute;}.tab-content .seller-rating + .text{padding-right:110px; display:inline-block}.tab-content .seller-rating .star-rating span{position: static;}.tab-content .seller-rating .star-rating span + span{font-size: 0;}.dokan-message .dokan-close{font-size:20px;}.dokan-message .dokan-close:hover{background-color:transparent;}.dokan-reviews-content .dokan-reviews-area .dokan-comments-wrap select{width: calc( 100% - 118px);}.dokan-report-wrap .report-filter .dokan-form-group,.dokan-single-store .commentlist .review_comment_container .dokan-review-author-img img{width: 100px;border-radius:4px;margin-left:30px}.dokan-single-store .commentlist .review_comment_container .comment-text p{margin:0;font-size:12px}.dokan-single-store .commentlist .review_comment_container .comment-text h5{margin:0}.dokan-single-store .commentlist .review_comment_container,.dokan-order-filter-serach .dokan-left .dokan-form-group{display: -ms-flexbox;display: flex;align-items: center;}.dokan-info{background-color: #f4f4f4;}.dokan-widget-area .widget{margin-bottom: 60px;}.dokan-category-menu .widget-title:after{content: inherit;}input.dokan-btn[type="submit"], a.dokan-btn, .dokan-btn{padding: 0 34px}.dokan-btn-theme{color:#fff !important}li.dokan-share-btn-wrap:hover .dokan-share-btn,a.dokan-btn:hover{opacity:0.8}#dokan-seller-listing-wrap ul.dokan-seller-wrap li .store-wrapper {box-shadow: 0px 0px 5px 0px #ddd;} a.dokan-btn, .dokan-btn{  height: 36px!important;line-height: 34px !important;border-radius: 0 !important;}.dokan-btn{ line-height:1 !important;}.dokan-seller-search {border-radius: 0 !important;border: 1px solid !important;background-position: 8px 12px !important;}.dokan-seller-listing .dokan-seller-search-form{margin-top: 0;}#dokan-seller-listing-wrap ul.dokan-seller-wrap li .store-footer .seller-avatar{padding: 3px;box-shadow: 0px 0px 15px -6px #f2f2f2;}#tab-seller ul{list-style: none;padding-right: 0;}';
    }
    return $css_wcv;
}
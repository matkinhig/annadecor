<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

$main_domain = 'http://demo.themepiko.com/stock/';

return array(
    'default' => array(
        'title' => 'Default',
        'preview_url' => $main_domain. 'default/',
        'plugins' => array( 'woocommerce','pikoworks_dummy','pikoworks_custom_post', 'revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist','pikoworks_swatches','yith-woocommerce-ajax-product-filter-premium','wpa-woocommerce-product-bundle','accesspress-social-login-lite','mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'main' => array(
        'title' => 'Main',
        'preview_url' => $main_domain. 'default/',
        'plugins' => array( 'woocommerce','pikoworks_dummy','pikoworks_custom_post', 'revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist','pikoworks_swatches','yith-woocommerce-ajax-product-filter-premium','wpa-woocommerce-product-bundle','accesspress-social-login-lite','mailchimp-for-wp' ),
        'type' => 'demo'
    ),
    'electronics' => array(
        'title' => 'Electronics',
        'preview_url' => $main_domain. 'electronics/',
        'plugins' => array( 'woocommerce','pikoworks_dummy','pikoworks_custom_post', 'revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist' ),
        'type' => 'demo'
    ), 
    'petstock' => array(
        'title' => 'Petstock',
        'preview_url' => $main_domain. 'petstock/',
        'plugins' => array( 'woocommerce','pikoworks_dummy','pikoworks_custom_post', 'revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist' ),
        'type' => 'demo'
    ), 
    'motostock' => array(
        'title' => 'Motostock',
        'preview_url' => $main_domain. 'motostock/',
        'plugins' => array( 'woocommerce','pikoworks_dummy','pikoworks_custom_post', 'revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist' ),
        'type' => 'demo'
    ), 
    'babyshop' => array(
        'title' => 'Babyshop',
        'preview_url' => $main_domain. 'babyshop/',
        'plugins' => array( 'woocommerce','pikoworks_dummy','pikoworks_custom_post', 'revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist' ),
        'type' => 'demo'
    ), 
    'organic' => array(
        'title' => 'Organic',
        'preview_url' => $main_domain. 'organic/',
        'plugins' => array( 'woocommerce','pikoworks_dummy','pikoworks_custom_post', 'revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist' ),
        'type' => 'demo'
    ), 
    'wedding' => array(
        'title' => 'Wedding',
        'preview_url' => $main_domain. 'wedding/',
        'plugins' => array( 'woocommerce','pikoworks_dummy','pikoworks_custom_post', 'revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist' ),
        'type' => 'demo'
    ), 
    'furniture' => array(
        'title' => 'Furniture',
        'preview_url' => $main_domain. 'furniture/',
        'plugins' => array( 'woocommerce','pikoworks_dummy','pikoworks_custom_post', 'revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist' ),
        'type' => 'demo'
    ),
    'jewelry' => array(
        'title' => 'Jewelry',
        'preview_url' => $main_domain. 'jewelry/',
        'plugins' => array( 'woocommerce','pikoworks_dummy','pikoworks_custom_post', 'revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist' ),
        'type' => 'demo'
    ),
    'cosmetics' => array(
        'title' => 'Cosmetics',
        'preview_url' => $main_domain. 'cosmetics/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist' ),
        'type' => 'demo'
    ),
    'dokan' => array(
        'title' => 'Multi Vendor dokan',
        'preview_url' => $main_domain. 'dokan/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist','pikoworks_swatches' ),
        'type' => 'demo'
    ),
    'vendor' => array(
        'title' => 'WC Vendor + buddypress',
        'preview_url' => $main_domain. 'vendor/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist' ),
        'type' => 'demo'
    ),
    'demo_rtl' => array(
        'title' => 'RTL Arabic',
        'preview_url' => $main_domain. 'rtl/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist','yith-woocommerce-ajax-product-filter-premium' ),
        'type' => 'demo'
    ),
    'sunglass' => array(
        'title' => 'Sunglass',
        'preview_url' => $main_domain. 'sunglass/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7','yith-woocommerce-quick-view','yith-woocommerce-compare','yith-woocommerce-wishlist' ),
        'type' => 'demo'
    ),
    'home_2' => array(
        'title' => 'Home 2',
        'preview_url' => $main_domain . 'default/home2/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'home_3' => array(
        'title' => 'Home 3',
        'preview_url' => $main_domain . 'default/home3/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'home_4' => array(
        'title' => 'Home 4',
        'preview_url' => $main_domain . 'default/home4/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'home_5' => array(
        'title' => 'Home 5',
        'preview_url' => $main_domain . 'default/home5/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'home_6' => array(
        'title' => 'Home 6',
        'preview_url' => $main_domain . 'default/home6/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'home_7' => array(
        'title' => 'Home 7',
        'preview_url' => $main_domain . 'default/home7/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'home_8' => array(
        'title' => 'Home 8',
        'preview_url' => $main_domain . 'default/home8/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'home_9' => array(
        'title' => 'Home 9',
        'preview_url' => $main_domain . 'default/home9/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'home_10' => array(
        'title' => 'Home 10',
        'preview_url' => $main_domain . 'default/home10/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'home_11' => array(
        'title' => 'Home 11',
        'preview_url' => $main_domain . 'default/home11/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'home_12' => array(
        'title' => 'Home 12',
        'preview_url' => $main_domain . 'default/home12/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7','shop-feed-for-instagram-by-snapppt' ),
        'type' => 'demo'
    ),
    'vendor_home' => array(
        'title' => 'Home 12',
        'preview_url' => $main_domain . 'vendor/',
        'plugins' => array( 'woocommerce','pikoworks_dummy', 'pikoworks_custom_post','revslider', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'about_us' => array(
        'title' => 'about us',
        'preview_url' => $main_domain . 'default/about-us/',
        'plugins' => array( 'pikoworks_dummy', 'pikoworks_custom_post', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'about_me' => array(
        'title' => 'about me',
        'preview_url' => $main_domain . 'default/about-me/',
        'plugins' => array( 'pikoworks_dummy', 'pikoworks_custom_post', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'faq' => array(
        'title' => 'Faq',
        'preview_url' => $main_domain . 'default/faq/',
        'plugins' => array( 'pikoworks_dummy', 'pikoworks_custom_post', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'team' => array(
        'title' => 'team members',
        'preview_url' => $main_domain . 'default/team-layout/',
        'plugins' => array( 'pikoworks_dummy', 'pikoworks_custom_post', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'portfolios' => array(
        'title' => 'Portfolios',
        'preview_url' => $main_domain . 'default/portfolios/portfolio-grid-4col/',
        'plugins' => array( 'pikoworks_dummy', 'pikoworks_custom_post', 'contact-form-7' ),
        'type' => 'demo'
    ),
    'testimonial' => array(
        'title' => 'testimonial',
        'preview_url' => $main_domain . 'default/testimonial-layout/',
        'plugins' => array( 'pikoworks_dummy', 'pikoworks_custom_post', 'contact-form-7' ),
        'type' => 'demo'
    ),
);
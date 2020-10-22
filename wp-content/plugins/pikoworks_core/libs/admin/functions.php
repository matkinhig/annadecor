<?php
if (!defined('ABSPATH')){
    exit; // if disable direct access
}

function pikoworks_check_theme_options() {
    // check default options
    global $pikoworks_settings;

    
    $pikoworks_default_settings = json_decode($options, true);

    foreach ($pikoworks_default_settings as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $key1 => $value1) {
                if ($key1 != 'google' && (!isset($pikoworks_settings[$key][$key1]) || !$pikoworks_settings[$key][$key1])) {
                    $pikoworks_settings[$key][$key1] = $pikoworks_default_settings[$key][$key1];
                }
            }
        } else {
            if (!isset($pikoworks_settings[$key])) {
                $pikoworks_settings[$key] = $pikoworks_default_settings[$key];
            }
        }
    }

    return $pikoworks_settings;
}


function pikoworks_demo_filters() {
    return array(
        '*' => 'Show All',
        'demos' => 'Demos',        
    );
}

function pikoworks_demo_types() {
    return array(
        'classic-original' => array('alt' => 'Main Demo', 'img' => get_template_directory_uri().'/assets/images/theme-options/demos/classic_original.jpg', 'filter' => 'demos'),       
     
    );
}


/**
 * Disply callback remote support page
 */
if(!function_exists('pikoworks_core_get_remote_page')) {
    function pikoworks_core_get_remote_page() {
        ?>
        <div class="piko-support-page">
            <div class="piko-tabs">
                <div class="piko-tabs-header">
                    <h2>Get Support <span>We are here to assist you</span></h2>
                    <a href="https://themepiko.com/forums/" target="_blank">Visit our support Page</a>
                </div>
                <div class="piko-page-body">                    
                    <div class="piko-tabs-content">
                        <div class="piko-columns">
                            <div class="piko-column-full">           
                                <?php pikoworks_core_get_remote_faq(); ?>
                                <script type="text/javascript">
                                    jQuery(document).ready(function($) {
                                        $('body').on('click', '.open-toggle', function(e) {
                                            e.preventDefault();
                                            var content = $(this).parent().find('.piko-toggle-content');

                                            if( content.hasClass('shown') ) {
                                                content.stop().slideUp().removeClass('shown');
                                            } else {
                                                $('.piko-toggle-content.shown').slideUp().removeClass('shown');
                                                content.stop().slideDown().addClass('shown');
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
    }
}
if(!function_exists('pikoworks_core_get_remote_faq')) {
    function pikoworks_core_get_remote_faq() {
        $url = 'https://themepiko.com/forums/';
        $faq_html = pikoworks_decoding(get_transient('piko_faq_html'));
        // if( ! $faq_html ) {
        //     $faq_html = '';
        //     $http = new WP_Http();
        //     $response = $http->request($url);
        //     if( $response['response']['code'] == 200 ) {
        //         $page_html = $response['body'];
        //         preg_match("/<div[^>]*id=\"piko_accordions\">(.*?)<\\/div>/si", $page_html, $match);
        //         $faq_html = $match[1];
        //         set_transient( 'piko_faq_html', pikoworks_encoding($faq_html), 7 * 24 * HOUR_IN_SECONDS );
        //     } else {
        //         echo '<a href="' . esc_url($url) .'" target="_blank">View FaQs page</a>';
        //     }
        // }
        echo '<a href="' . esc_url($url) .'" target="_blank">View FaQs page</a>';
        // echo $faq_html;
    }
}




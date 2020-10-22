<?php

/**
 * @ dokan vendor product
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
add_action('init', 'pikoworks_vendor');
function pikoworks_vendor()
{
    // Setting shortcode lastest
    $params = array(
        "name"        => esc_html__("Multi Vendor", 'pikoworks_core'),
        "base"        => "pikoworks_vendor",
        "category"    => esc_html__('Pikoworks', 'pikoworks_core'),
        "icon" => get_template_directory_uri() . "/assets/images/logo/favicon.png",
        "description" => esc_html__("Display Multivendor name", 'pikoworks_core'),
        'params'      => array_merge(array(

            // array(
            //     'type' => 'dropdown',
            //     'heading' => esc_html__('Layout', 'pikoworks_core'),
            //     'param_name' => 'layout',
            //     'value' => array(
            //         esc_html__('Layout 01', 'pikoworks_core') => '1',
            //         // esc_html__('Layout 02', 'pikoworks_core') => '2',
            //         // esc_html__('Layout 03', 'pikoworks_core') => '3',
            //     ),
            // ),
            array(                
                'type' => 'checkbox',                
                "heading" => '',
                'param_name' => 'show_featured_vendor',
                'value' => array(esc_html__('Show Featured Vendor', 'pikoworks_core') => 'yes'),
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Vendor Orderby', 'pikoworks_core'),
                'param_name' => 'orderby',
                'value' => array(
                        esc_html__('Most Recent', 'pikoworks_core') => 'most_recent',
                        esc_html__('Most Popular', 'pikoworks_core') => 'total_orders',
                        esc_html__('Top Rated', 'pikoworks_core') => 'top_rated',
                        esc_html__('Most Review', 'pikoworks_core') => 'most_reviewed',
                ),
            ),
            array(
                "type" => "pikoworks_number",
                "heading" => esc_html__("Store List Load", 'pikoworks_core'),
                "param_name" => "store_load",
                'std' => 6,
                'description' => esc_html__('NB:-1 is available store load in this section', 'pikoworks_core')
            ),
            array(                
                'type' => 'checkbox',                
                "heading" => '',
                'param_name' => 'show_cat_vendor',
                'value' => array(esc_html__('Show Category By Vendor', 'pikoworks_core') => 'yes'),
                'admin_label' => true,
            ),
            array(
                "type" => "pikoworks_taxonomy",
                "taxonomy" => "store_category",
                "heading" => esc_html__("Display product certain category", 'pikoworks_core'),
                "param_name" => "store_cat",
                "value" => '',
                'parent' => '',
                'multiple' => true,
                'hide_empty' => false,
                'placeholder' => esc_html__('Choose categoy', 'pikoworks_core'),
                "dependency" => array("element" => "show_cat_vendor", "value" => array('yes')),
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Extra class name", 'pikoworks_core'),
                "param_name"  => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks_core"),
            ),
            array(
                'type'           => 'css_editor',
                'heading'        => esc_html__('Css', 'pikoworks_core'),
                'param_name'     => 'css',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'pikoworks_core'),
                'group'          => esc_html__('Design options', 'pikoworks_core')
            )
        ), pikoworks_get_slider_params_enable())
    );
    vc_map($params);
}
class WPBakeryShortCode_pikoworks_vendor extends WPBakeryShortCode
{

    protected function content($atts, $content = null)
    {
        $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('pikoworks_vendor', $atts) : $atts;
        $atts = shortcode_atts(array(
            'layout'   => '1',
            'store_load'   => '6',
            'show_featured_vendor'   => 'no',
            'orderby'   => 'most_recent',
            'show_cat_vendor'   => '',
            'store_cat'   => '',


            //Carousel 
            'use_responsive' => '1',
            'is_slider' => '',
            'slides_scroll' => "",
            'autoplay'      => "false",
            'loop'          => "false",
            'navigation'    => "true",
            'navigation_btn' => '',
            'btn_hover_show'    => '',
            'btn_light'    => '',
            'dots'         => "false",
            'margin'       => 'sip',
            //Default
            'items_very_large_device'   => '4',
            'items_large_device'   => '4',
            'items_mobile_device'   => '',

            'el_class' => '',
            'css' => '',


        ), $atts);
        extract($atts);


        $css_class = 'piko-vendor hsc ' . $el_class;
        if (function_exists('vc_shortcode_custom_css_class')) :
            $css_class .= ' ' . apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '), '', $atts);
        endif;


        ob_start();

        $col_md = round(12 / $items_large_device);
        if ($items_large_device == '4') {
            $col_sm = ($col_md + 1);
        } elseif ($items_large_device == '3') {
            $col_sm = ($col_md + 2);
        } elseif ($items_large_device == '6') {
            $col_sm = ($col_md + 1);
        } else {
            $col_sm =  $col_md;
        }
        $responsive_col = $items_very_large_device;
        $large_device = round(12 / $items_very_large_device);
        if ($items_very_large_device == '5') {
            $large_device = '20';
        }
        if ($items_very_large_device == '5' || $items_very_large_device == '6') {
            $responsive_col = 4;
        }
        $col_class = $slides_scroll_lg = '';
        if ($is_slider != 'yes' && !pikoworks_is_mobile()) {
            $col_class .= 'col-6';
            $col_class .= ' col-md-' . $col_sm;
            $col_class .= ' col-lg-' . $col_md;
            $col_class .= ' col-xl-' . $large_device;
            $col_class = $col_class;
        }
        if (pikoworks_is_mobile() && $navigation = 'true') {
            $navigation = 'false';
            $dots = 'true';
        }
        if ($slides_scroll != 1 && !pikoworks_is_mobile()) {
            $slides_scroll_lg = ',"slidesToScroll": ' . esc_attr($items_large_device);
        }



        $slide_class = 'piko-carousel-grid row';
        $data_slick = '';
        if ($is_slider == 'yes' || pikoworks_is_mobile()) {
            $slide_class = 'piko-carousel' . ' ' . $navigation_btn . ' ' . $btn_light . ' ' . $btn_hover_show . ' ' . $margin;

            $res_large = $use_responsive ? '"slidesToShow":' . esc_attr($items_very_large_device) . ', "slidesToScroll": ' . esc_attr($slides_scroll) . ',' : '';
            $res_media = $use_responsive ? ',"responsive":[{"breakpoint": 1200,"settings":{"slidesToShow":' . esc_attr($responsive_col) . '}},{"breakpoint": 992,"settings":{"slidesToShow":' . esc_attr($items_large_device . $slides_scroll_lg) . '}},{"breakpoint": 768,"settings":{"slidesToShow": 2,"slidesToScroll": 2}},{"breakpoint": 576,"settings":{"slidesToShow": 1, "slidesToScroll": 1}}]' : '';

            $data_slick = '{' . $res_large . '"arrows":' . esc_attr($navigation) . ',"dots":' . esc_attr($dots) . ',"infinite":' . esc_attr($loop) . ',"autoplay":' . esc_attr($autoplay) . $res_media . '}';
        }
       
        ?>
        <div class="<?php echo esc_attr($css_class) ?>">
            <ul class="seller-listing-content dokan-seller-wrap ul-no <?php echo esc_attr($slide_class) ?>" data-slick='<?php echo  $data_slick; ?>'>

                <?php

                        $defaults = array(
                            'per_page' => $store_load,
                            'search'   => 'yes',
                            'per_row'  => 3,
                            'featured' => 'no'
                        );

                        /**
                         * Filter return the number of store listing number per page.
                         *
                         * @since 2.2
                         *
                         * @param array
                         */
                        $attr1   = shortcode_atts(apply_filters('dokan_store_listing_per_page', $defaults), '');
                        $paged  = (int) is_front_page() ? max(1, get_query_var('page')) : max(1, get_query_var('paged'));
                        $limit  = $attr1['per_page'];
                        $offset = ($paged - 1) * $limit;

                        $seller_args = array(
                            'number' => $limit,
                            'offset' => $offset,
                            'featured' => $show_featured_vendor,
                            'stores_orderby' => $orderby,

                        );

                        if($show_cat_vendor == 'yes'){
                            $seller_args['store_category_query'][] = array(
                                'taxonomy' => 'store_category',
                                'field'    => 'slug',
                                'terms'    => explode(",", $store_cat),
                            );
                        }

                       

                        $sellers = dokan_get_sellers(apply_filters('dokan_seller_listing_args', $seller_args, $_GET));
                       

                        ?>

                <?php if ($sellers['users'] ) : ?>
                   
                        <?php
                                    foreach ($sellers['users'] as $seller) {
                                        $vendor            = dokan()->vendor->get($seller->ID);
                                        $store_banner_id   = $vendor->get_banner_id();
                                        $store_name        = $vendor->get_shop_name();
                                        $store_url         = $vendor->get_shop_url();
                                        $store_rating      = $vendor->get_rating();
                                        $is_store_featured = $vendor->is_featured();
                                        $store_phone       = $vendor->get_phone();
                                        $store_info        = dokan_get_store_info($seller->ID);
                                        $store_address     = dokan_get_seller_short_address($seller->ID);
                                        $store_banner_url  = $store_banner_id ? wp_get_attachment_image_src($store_banner_id, 'full') : DOKAN_PLUGIN_ASSEST . '/images/default-store-banner.png';

                                        ?>


                                       
                                        <li class="woocommerce <?php echo esc_attr($col_class); ?> <?php echo (!$store_banner_id) ? 'no-banner-img' : ''; ?>">
                                            <div class="store-wrapper">
                                                <div class="store-content">
                                                    <div class="store-info-1 p_r">
                                                        <img src="<?php echo is_array($store_banner_url) ? esc_attr($store_banner_url[0]) : esc_attr($store_banner_url); ?>" alt="">
                                                        <?php if ($is_store_featured) : ?>
                                                                <div class="featured-label"><?php esc_html_e('Featured', 'pikoworks_core'); ?></div>
                                                            <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="store-footer">
                                                    <div class="seller-avatar">
                                                        <?php echo get_avatar($seller->ID, 150); ?>
                                                    </div>

                                                    <div class="store-data-container">
                                                        <div class="featured-favourite">
                                                        

                                                            <?php do_action('dokan_seller_listing_after_featured', $seller, $store_info); ?>
                                                        </div>

                                                        <div class="store-data t_c mt40">
                                                            <h2><a href="<?php echo esc_attr($store_url); ?>"><?php echo esc_html($store_name); ?></a></h2>

                                                            <?php if (!empty($store_rating['count'])) : ?>
                                                                <div class="star-rating dokan-seller-rating" title="<?php echo sprintf(esc_attr__('Rated %s out of 5', 'pikoworks_core'), esc_attr($store_rating['rating'])) ?>">
                                                                    <span style="width: <?php echo (esc_attr(($store_rating['rating'] / 5)) * 100 - 1); ?>%">
                                                                        <strong class="rating"><?php echo esc_html($store_rating['rating']); ?></strong> <?php _e('out of 5', 'pikoworks_core'); ?>
                                                                    </span>
                                                                </div>
                                                            <?php endif ?>

                                                            <?php if ($store_address) : ?>
                                                                <?php
                                                                                    $allowed_tags = array(
                                                                                        'span' => array(
                                                                                            'class' => array(),
                                                                                        ),
                                                                                        'br' => array()
                                                                                    );
                                                                                    ?>
                                                                <p class="store-address"><?php echo wp_kses($store_address, $allowed_tags); ?></p>
                                                            <?php endif ?>

                                                            <?php if ($store_phone == 'false') { //change false dont show store list 
                                                                                ?>
                                                                <p class="store-phone">
                                                                    <i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html($store_phone); ?>
                                                                </p>
                                                            <?php } ?>

                                                            <?php do_action('dokan_seller_listing_after_store_data', $seller, $store_info); ?>

                                                        </div>

                                                    </div>
                                                    <div class="dokan-view-vendor t_c p_a">
                                                        <a href="<?php echo esc_url($store_url); ?>" class="dokan-btn dokan-btn-theme"><?php esc_html_e('Visit Store', 'pikoworks_core'); ?></a>
                                                        <?php do_action('dokan_seller_listing_footer_content', $seller, $store_info); ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>

                            <?php }  //end for each ?>
                       
                <?php else :  ?>
                    <p class="dokan-error"><?php esc_html_e('No vendor found!', 'pikoworks_core'); ?></p>
                <?php endif; ?>
            </ul>

        </div>
<?php
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }
}

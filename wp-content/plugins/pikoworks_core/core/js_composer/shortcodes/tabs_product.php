<?php

/**
 * @Tabs products
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
add_action('init', 'pikoworks_tab_product');
function pikoworks_tab_product()
{
    if (!function_exists('vc_map')) return;
    // Setting shortcode lastest
    $params = array(
        "name"        => esc_html__("Tabs Product", 'pikoworks_core'),
        "base"        => "tabs_product",
        "category"    => esc_html__('Pikoworks', 'pikoworks_core'),
        "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
        "description" => esc_html__("Show different product tabs", 'pikoworks_core'),
        "params"      => array_merge(
            array(
                array(
                    "type"        => "pikoworks_taxonomy",
                    "taxonomy"    => "product_cat",
                    "heading"     => esc_html__("Display product certain category", 'pikoworks_core'),
                    "param_name"  => "taxonomy",
                    "value"       => '',
                    'parent'      => '',
                    'multiple'    => true,
                    'hide_empty'  => false,
                    'placeholder' => esc_html__('Choose categoy', 'pikoworks_core'),
                    "description" => esc_html__("Note: If you want to narrow output, select category(s) above. Only selected categories will be displayed. else leave it", 'pikoworks_core')
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__('Tabs Panel', 'pikoworks_core'),
                    'param_name'    => 'header_layout',
                    'value' => array(
                        esc_html__('layout 1', 'pikoworks_core') => '1',
                        esc_html__('layout 2', 'pikoworks_core') => '2',
                        esc_html__('layout 3', 'pikoworks_core') => '3',
                        esc_html__('Dont Show', 'pikoworks_core') => '0',
                    ),
                    'std'           => '1',
                    "admin_label" => true,
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__('Tabs Panel Alignment', 'pikoworks_core'),
                    'param_name'    => 'header_layout_align',
                    'value' => array(
                        esc_html__('Left', 'pikoworks_core') => '',
                        esc_html__('Center', 'pikoworks_core') => 'text-center',
                        esc_html__('Right', 'pikoworks_core') => 'text-right',
                    ),
                    'dependency' => array('element'   => 'header_layout', 'value'     => array('1', '2', '3')),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__('Product Style', 'pikoworks_core'),
                    'param_name'    => 'product_layout',
                    'value' => array(
                        esc_html__('Layout 01', 'pikoworks_core') => '1',
                        esc_html__('Layout 02', 'pikoworks_core') => '2',
                        esc_html__('Layout 03', 'pikoworks_core') => '3',
                        esc_html__('Layout 04', 'pikoworks_core') => '4',
                        esc_html__('Layout 05', 'pikoworks_core') => '5',
                    ),
                    'std'           => '1',
                    "admin_label" => true,
                ),
                array(
                    'type' => 'checkbox',
                    'heading'       => '',
                    'param_name' => 'white_product',
                    'value' => array(esc_html__('if Background color gray product backgrount color white', 'pikoworks_core') => 'white-product')
                ),
                array(
                    'type' => 'checkbox',
                    'heading'       => '',
                    'param_name' => 'rating_none',
                    'value' => array(esc_html__('Disable product rating and category name', 'pikoworks_core') => 'tab-rating-none')
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__('Product Image effect', 'pikoworks_core'),
                    'param_name'    => 'product_img',
                    'value' => array(
                        esc_html__('None', 'pikoworks_core') => 'none',
                        esc_html__('Rollover', 'pikoworks_core') => 'rollover',
                        esc_html__('Carousel', 'pikoworks_core') => 'carousel',
                    ),
                    'std'           => 'none',
                    "admin_label" => true,
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => esc_html__('Product Column', 'pikoworks_core'),
                    'description'   => esc_html__('Default set 3 Column', 'pikoworks_core'),
                    'param_name'    => 'product_cols',
                    'value' => array(2 => 2, 3 => 3, 4 => 4, 5 => 5,),
                    'std'           => '4',
                    "dependency"  => array("element" => "is_slider", "value" => array('no')),
                ),
                array(
                    'type' => 'checkbox',
                    'heading'       => '',
                    'param_name' => 'new_product',
                    'value' => array(esc_html__('Disable New Product Tab', 'pikoworks_core') => 'enable'),
                    'std'           => 'enable',
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'new_product_title',
                    'heading' => esc_html__('New Product Title', 'pikoworks_core'),
                    'value' => esc_html__('New Araival', 'pikoworks_core'),
                    'dependency' => array('element'   => 'new_product', 'value'     => array('enable')),
                ),
                array(
                    'type' => 'checkbox',
                    'heading'       => '',
                    'param_name' => 'popular_product',
                    'value' => array(esc_html__('Disable Popular Product Tab', 'pikoworks_core') => 'enable'),
                    'std'           => 'enable',
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'popular_product_title',
                    'heading' => esc_html__('Popular Product Title', 'pikoworks_core'),
                    'value' => esc_html__('Popular', 'pikoworks_core'),
                    'dependency' => array('element'   => 'popular_product', 'value'     => array('enable')),
                    "admin_label" => true,
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'featured_product',
                    'heading'       => '',
                    'value' => array(esc_html__('Disable Featured Product Tab', 'pikoworks_core') => 'enable'),
                    'std'           => 'enable',
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'featured_product_title',
                    'heading' => esc_html__('Featured Product Title', 'pikoworks_core'),
                    'value' => 'Featured',
                    "admin_label" => true,
                    'dependency' => array('element'   => 'featured_product', 'value'     => array('enable')),
                ),
                array(
                    'type' => 'checkbox',
                    'heading'       => '',
                    'param_name' => 'onsale_product',
                    'value' => array(esc_html__('Disable Onsale Product Tab', 'pikoworks_core') => 'enable'),
                    'std'           => 'enable',
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'onsale_product_title',
                    'heading' => esc_html__('Onsale Product Title', 'pikoworks_core'),
                    'value' => esc_html__('Onsale', 'pikoworks_core'),
                    "admin_label" => true,
                    'dependency' => array('element'   => 'onsale_product', 'value'     => array('enable')),
                ),
                array(
                    'type' => 'checkbox',
                    'heading'       => '',
                    'param_name' => 'toprated_product',
                    'value' => array(esc_html__('Enable Top Rated Product Tab', 'pikoworks_core') => 'enable'),
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'toprated_product_title',
                    'heading' => esc_html__('Top Rated Product Title', 'pikoworks_core'),
                    'value' => esc_html__('Top Rated', 'pikoworks_core'),
                    "admin_label" => true,
                    'dependency' => array('element'   => 'toprated_product', 'value'     => array('enable')),
                ),
                array(
                    'type' => 'pikoworks_number',
                    'param_name' => 'per_page',
                    'heading' => esc_html__('Post per page', 'pikoworks_core'),
                    'description'   => esc_html__('Default load 8 product', 'pikoworks_core'),
                    'value' => '8',
                    "admin_label" => true,
                ),
                array(
                    "type"        => "textfield",
                    "heading"     => esc_html__("Extra class name", 'pikoworks_core'),
                    "param_name"  => "el_class",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__('Css', 'pikoworks_core'),
                    'param_name' => 'css',
                    'group' => esc_html__('Design options', 'pikoworks_core')
                ),
            ),
            pikoworks_get_slider_params_enable()
        )
    );
    vc_map($params);
}
class WPBakeryShortCode_tabs_product extends WPBakeryShortCode
{

    protected function content($atts, $content = null)
    {
        $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('tabs_product', $atts) : $atts;
        $atts = shortcode_atts(array(
            'taxonomy'       => '',
            'header_layout' => '1',
            'header_layout_align' => '',
            'product_layout' => '1',
            'product_img' => 'none',
            'new_product' => 'enable',
            'new_product_title' => esc_html__('New Araival', 'pikoworks_core'),
            'per_page' => '8',
            'popular_product' => 'enable',
            'popular_product_title' => esc_html__('Popular', 'pikoworks_core'),
            'featured_product' => 'enable',
            'featured_product_title' => esc_html__('Featured', 'pikoworks_core'),
            'onsale_product' => 'disable',
            'onsale_product_title' => esc_html__('Onsale', 'pikoworks_core'),
            'toprated_product' => 'disable',
            'toprated_product_title' => esc_html__('Top Rated', 'pikoworks_core'),
            'product_cols' => '',

            'white_product' => '',
            'rating_none' => '',

            //Carousel  
            'use_responsive' => '1',
            'is_slider' => '',
            'autoplay'      => "false",
            'loop'          => "false",
            'navigation'    => "true",
            'navigation_btn' => '',
            'btn_hover_show'    => '',
            'btn_light'    => '',
            'dots'         => "false",
            'margin'       => '',
            'items_very_large_device'   => 6,
            'items_large_device'   => 4,
            'items_mobile_device'   => 1,

            'el_class'     =>  '',
            'css' => ''

        ), $atts);
        extract($atts);

        $css_class = 'product-tabs products-grid columns-' . $product_cols . ' tabs-layout-' . $product_layout  . ' ' . $white_product . ' ' . $rating_none . ' ' . $el_class;
        if (function_exists('vc_shortcode_custom_css_class')) :
            $css_class .= ' ' . apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '), '', $atts);
        endif;
        global $product;
        //product type
        $args_new_araival = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => esc_attr($per_page),
        );
        $args_popular = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => esc_attr($per_page),
            'meta_key' => 'total_sales',
            'orderby' => 'meta_value_num'
        );
        $product_visibility_term_ids = wc_get_product_visibility_term_ids();
        $args_featured = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => esc_attr($per_page),
            'no_found_rows'  => 1,
            'meta_query'     => array(),
            'tax_query'      => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $product_visibility_term_ids['featured'],
                ),
            ),
        );

        $product_ids_on_sale = wc_get_product_ids_on_sale();
        $product_ids_on_sale[]  = 0;
        $args_on_sale = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => esc_attr($per_page),
            'post__in' => $product_ids_on_sale
        );
        $args_top_rated = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => esc_attr($per_page),
            'meta_key' => '_wc_average_rating',
            'orderby' => 'meta_value_num'
        );

        if ($taxonomy) {
            $args_top_rated['tax_query'] = $args_on_sale['tax_query'] = $args_featured['tax_query'] = $args_popular['tax_query'] = $args_new_araival['tax_query'] =
                array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => explode(",", $taxonomy)
                    )
                );
        }

        $head_new = $head_toprated = $head_popular = $head_featued = $head_onsale = '';
        $id = uniqid();
        //tab heading

        if ($new_product == 'enable') {
            $head_new = '<li class="active"><a data-toggle="tab" href="#produtA' . esc_attr($id) . '">' . esc_attr($new_product_title) . '</a></li>';
        }
        if ($popular_product == 'enable') {
            $active_class = "";
            if ($new_product !== 'enable') {
                $active_class = "active";
            }
            $head_popular = '<li class="' . $active_class . '"><a data-toggle="tab" href="#produtB' . esc_attr($id) . '">' . esc_attr($popular_product_title) . '</a></li>';
        }
        if ($featured_product == 'enable') {
            $active_class = "";
            if ($new_product !== 'enable' && $popular_product !== 'enable') {
                $active_class = "active";
            }
            $head_featued = '<li class="' . $active_class . '"><a data-toggle="tab" href="#produtC' . esc_attr($id) . '">' . esc_attr($featured_product_title) . '</a></li>';
        }
        if ($onsale_product == 'enable') {
            $head_onsale = '<li><a data-toggle="tab" href="#produtD' . esc_attr($id) . '">' . esc_attr($onsale_product_title) . '</a></li>';
        }
        if ($toprated_product == 'enable') {
            $head_toprated = '<li><a data-toggle="tab" href="#produtE' . esc_attr($id) . '">' . esc_attr($toprated_product_title) . '</a></li>';
        }
        $nav_class = '';
        $tab_wrap_class = 'products-tab';
        if ($header_layout == '1') {
            $nav_class = 'nav-pills nav-bordered simple-tabs';
        } elseif ($header_layout == '2') {
            $nav_class = 'nav-tabs';
        } else {
            $nav_class = 'nav-tabs border b2x';
        }

        $fit_row = 'data-layoutmode=fitRows';




        $tab_panel_html = '<div class="' . esc_attr($header_layout_align) . '">
                            <ul class="nav text-uppercase ' . esc_attr($nav_class) . '">' . balanceTags($head_new) . balanceTags($head_popular) . balanceTags($head_featued)
            . balanceTags($head_onsale) . balanceTags($head_toprated) . '
                            </ul>
                        </div>';


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
        $large_device = round(12 / $items_very_large_device);
        if ($items_very_large_device == '5') {
            $large_device = '20';
        }

        if (!pikoworks_is_mobile()) {
            $col_class[] = 'col-lg-' . $large_device;
            $col_class[] = 'col-md-' . $col_md;
            $col_class[] = 'col-sm-' . $col_sm;
            $col_class = esc_attr(implode(' ', $col_class));
        }
        if ($is_slider == 'yes' && $use_responsive == '0' || pikoworks_is_mobile() && !pikoworks_is_tablet()) {
            $col_class = 'col-xs-12';
        } elseif ($is_slider == 'no') {
            $col_class = 'product-column';
        }
        //    for mobile 2 cloumn
        $row_mobile =  '';
        if ($items_mobile_device == '2') {
            $row_mobile = 'mobile';
        }

        $slide_class = 'piko-carousel-grid';
        $data_slick = '';
        if ($is_slider == 'yes' || pikoworks_is_mobile()) {
            $slide_class = 'piko-carousel' . ' ' . $navigation_btn . ' ' . $btn_light . ' ' . $btn_hover_show . ' ' . $margin;

            $res_large = $use_responsive ? '"slidesToShow":' . esc_attr($items_very_large_device) . ', "slidesToScroll": 1,' : '';
            $res_media = $use_responsive ? '"responsive":[{"breakpoint": 1200,"settings":{"slidesToShow":' . esc_attr($items_large_device) . '}},{"breakpoint": 1024,"settings":{"slidesToShow": 3}},{"breakpoint": 768,"settings":{"slidesToShow": 2}},{"breakpoint": 576,"settings":{"slidesToShow": ' . esc_attr($items_mobile_device) . '}}]' : '';

            $data_slick = '{' . $res_large . '"arrows":' . esc_attr($navigation) . ',"dots":' . esc_attr($dots) . ',"infinite":' . esc_attr($loop) . ',"autoplay":' . esc_attr($autoplay) . ',' . $res_media . '}';
        }

        $slide_before = '<div class="product-container-row"><div class="products-container max-col-' . esc_attr($product_cols) . '" ' . esc_attr($fit_row) . '>';
        $slide_after  = '</div></div>';
        if ($is_slider == 'yes') {
            $slide_before = "<div class='" . esc_attr($slide_class) . "' data-slick='" .  $data_slick . "'>";
            $slide_after  = '</div>';
        }

        if ($product_img == 'rollover') {
            remove_action('woocommerce_before_shop_loop_item_title', 'xtocky_wc_template_loop_product_thumbnail', 10);
            add_action('woocommerce_before_shop_loop_item_title', 'xtocky_wc_template_loop_product_thumbnail_rollover', 10);
        } elseif ($product_img === 'carousel') {
            remove_action('woocommerce_before_shop_loop_item_title', 'xtocky_wc_template_loop_product_thumbnail', 10);
            add_action('woocommerce_before_shop_loop_item_title', 'xtocky_wc_template_loop_product_thumbnail_carousel', 10);
        }

        $layout_class = '';
        if ($product_layout  == 4) {
            $product_layout = '3';
            $layout_class = "pl-4";
        } elseif ($product_layout  == 5) {
            $product_layout = '2';
            $layout_class = "pl-5";
        }


        if ($product_layout === '3') {
            remove_action('xtocky_after_shop_loop_item_title', 'xtocky_wc_template_loop_product_button_action', 15);
            add_action('woocommerce_before_shop_loop_item_title', 'xtocky_wc_template_loop_product_button_wishlist', 7, 1);
        }

        ob_start();
        ?>

    <div class="<?php echo esc_attr($css_class . ' ' . $row_mobile) ?>">
        <div class="<?php echo esc_attr($tab_wrap_class); ?>">

            <?php if ($header_layout != '0') echo balanceTags($tab_panel_html); ?>

            <div class="tab-content hsc row <?php if ($header_layout == '0') echo 'tab-open' ?>">
                <?php
                if (class_exists('WooCommerce') && $new_product == 'enable') :
                    echo '<div id="produtA' . esc_attr($id) . '" class="tab-pane active">';
                    $loop_new_araival = new WP_Query($args_new_araival);
                    ?>
                    <?php echo balanceTags($slide_before); ?>
                    <?php
                    if ($loop_new_araival->have_posts()) {
                        while ($loop_new_araival->have_posts()) : $loop_new_araival->the_post();
                            ?>
                            <article <?php post_class($col_class); ?>>
                                <div class="product-wrap pl-<?php echo esc_attr($product_layout. ' ' . $layout_class); ?>">
                                    <?php wc_get_template_part('vc-tabs', 'product');  ?>
                                </div>
                            </article>
                        <?php
                        endwhile;
                    } else {
                        echo '<article class="product-column">' . esc_html__('No products found', 'pikoworks_core') . '</article>';
                    }
                    wp_reset_postdata();
                    echo balanceTags($slide_after);
                    echo '</div>'; // end #productA 
                endif; //woocommerce
                //popular product
                if (class_exists('WooCommerce') && $popular_product == 'enable') :
                    $active_class = "";
                    if ($new_product !== 'enable') {
                        $active_class = "active";
                    }

                    echo '<div id="produtB' . esc_attr($id) . '" class="tab-pane ' . esc_attr($active_class) . '">';
                    $loop_popular = new WP_Query($args_popular); ?>
                    <?php echo balanceTags($slide_before); ?>
                    <?php
                    if ($loop_popular->have_posts()) {
                        while ($loop_popular->have_posts()) : $loop_popular->the_post();

                            ?>
                            <article <?php post_class($col_class); ?>>
                                <div class="product-wrap pl-<?php echo esc_attr($product_layout. ' ' . $layout_class); ?>">
                                    <?php wc_get_template_part('vc-tabs', 'product');  ?>
                                </div>
                            </article>
                        <?php
                        endwhile;
                    } else {
                        echo '<article class="product-column">' . esc_html__('No products found', 'pikoworks_core') . '</article>';
                    }
                    wp_reset_postdata();
                    echo balanceTags($slide_after);
                    echo '</div>'; // end #productB
                endif; //woocommerce
                //featured product
                if (class_exists('WooCommerce') && $featured_product == 'enable') :
                    $active_class = "";
                    if ($new_product !== 'enable' && $popular_product !== 'enable') {
                        $active_class = "active";
                    }

                    echo '<div id="produtC' . esc_attr($id) . '" class="tab-pane ' . esc_attr($active_class) . '">';
                    $loop_featured = new WP_Query($args_featured); ?>
                    <?php echo balanceTags($slide_before); ?>
                    <?php
                    if ($loop_featured->have_posts()) {
                        while ($loop_featured->have_posts()) : $loop_featured->the_post();
                            ?>
                            <article <?php post_class($col_class); ?>>
                                <div class="product-wrap pl-<?php echo esc_attr($product_layout. ' ' . $layout_class); ?>">
                                    <?php wc_get_template_part('vc-tabs', 'product');  ?>
                                </div>
                            </article>
                        <?php
                        endwhile;
                    } else {
                        echo '<article class="product-column">' . esc_html__('No products found', 'pikoworks_core') . '</article>';
                    }
                    wp_reset_postdata();
                    echo balanceTags($slide_after);
                    echo '</div>'; // end #productC
                endif; //woocommerce
                //on sale product
                if (class_exists('WooCommerce') && $onsale_product == 'enable') :
                    echo '<div id="produtD' . esc_attr($id) . '" class="tab-pane">';
                    $loop_onsale = new WP_Query($args_on_sale); ?>
                    <?php echo balanceTags($slide_before); ?>
                    <?php
                    if ($loop_onsale->have_posts()) {
                        while ($loop_onsale->have_posts()) : $loop_onsale->the_post();
                            ?>
                            <article <?php post_class($col_class); ?>>
                                <div class="product-wrap pl-<?php echo esc_attr($product_layout. ' ' . $layout_class); ?>">
                                    <?php wc_get_template_part('vc-tabs', 'product');  ?>
                                </div>
                            </article>
                        <?php
                        endwhile;
                    } else {
                        echo '<article class="product-column">' . esc_html__('No products found', 'pikoworks_core') . '</article>';
                    }
                    wp_reset_postdata();
                    echo balanceTags($slide_after);
                    echo '</div>'; // end #productD
                endif; //woocommerce
                //top rated product
                if (class_exists('WooCommerce') && $toprated_product == 'enable') :
                    echo '<div id="produtE' . esc_attr($id) . '" class="tab-pane">';
                    $loop_toprated = new WP_Query($args_top_rated); ?>
                    <?php echo balanceTags($slide_before); ?>
                    <?php
                    if ($loop_toprated->have_posts()) {
                        while ($loop_toprated->have_posts()) : $loop_toprated->the_post();
                            ?>
                            <article <?php post_class($col_class); ?>>
                                <div class="product-wrap pl-<?php echo esc_attr($product_layout. ' ' . $layout_class); ?>">
                                    <?php wc_get_template_part('vc-tabs', 'product');  ?>
                                </div>
                            </article>
                        <?php
                        endwhile;
                    } else {
                        echo '<article class="product-column">' . esc_html__('No products found', 'pikoworks_core') . '</article>';
                    }
                    wp_reset_postdata();
                    echo balanceTags($slide_after);
                    echo '</div>'; // end #productE
                endif; //woocommerce           
                ?>
            </div>
        </div>
    </div>
    <?php
    $result = ob_get_contents();
    ob_clean();
    return $result;
}
}

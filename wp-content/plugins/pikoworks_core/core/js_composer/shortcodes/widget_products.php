<?php
/**
 * @author  themepiko
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_action('init', 'pikoworks_widget_products');

function pikoworks_widget_products() {
    if (!function_exists('vc_map'))
        return;
    $params = array(
        "name" => esc_html__("Product Widgets", 'pikoworks_core'),
        "base" => "pikoworks_widget_products",
        "category" => esc_html__('Pikoworks', 'pikoworks_core'),
        "icon" => get_template_directory_uri() . "/assets/images/logo/favicon.png",
        "description" => esc_html__("A list of your products.", 'pikoworks_core'),
        'params' => array_merge(array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", 'pikoworks_core'),
                "param_name" => "title",
                "value" => "Widgets Title here",
                'admin_label' => true,
            ),
            array(
                'type' => 'pikoworks_number',
                'heading' => esc_html__('Number of products to load', 'pikoworks_core'),
                'param_name' => 'number',
                'value' => '3',
                'std' => '3',
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show', 'pikoworks_core'),
                'param_name' => 'show',
                'value' => array(
                    esc_html__('All products', 'pikoworks_core') => '',
                    esc_html__('Featured products', 'pikoworks_core') => 'featured',
                    esc_html__('On-sale products', 'pikoworks_core') => 'onsale',
                    esc_html__('Top-rated products', 'pikoworks_core') => 'top_rated',
                ),
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Order by', 'pikoworks_core'),
                'param_name' => 'orderby',
                'value' => array(
                    esc_html__('Date', 'pikoworks_core') => 'date',
                    esc_html__('Price', 'pikoworks_core') => 'price',
                    esc_html__('Random', 'pikoworks_core') => 'rand',
                    esc_html__('Sales', 'pikoworks_core') => 'sales',
                ),
                'dependency' => array('element' => 'show', 'value' => array('', 'featured', 'onsale'))
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Order', 'pikoworks_core'),
                'param_name' => 'order',
                'value' => array(
                    esc_html__('ASC', 'pikoworks_core') => 'asc',
                    esc_html__('DESC', 'pikoworks_core') => 'desc',
                ),
            ),
            array(
                'type' => 'checkbox',
                "heading" => '',
                'param_name' => 'hide_free',
                'value' => array(esc_html__('Hide free products', 'pikoworks_core') => '0'),
                'dependency' => array('element' => 'show', 'value' => array('', 'featured', 'onsale'))
            ),
            array(
                'type' => 'checkbox',
                "heading" => '',
                'param_name' => 'show_hidden',
                'value' => array(esc_html__('Show hidden products', 'pikoworks_core') => '0'),
                'dependency' => array('element' => 'show', 'value' => array('', 'featured', 'onsale'))
            ),
            array(
                'type' => 'checkbox',
                "heading" => '',
                'param_name' => 'is_slider',
                'group' => esc_html__('Carousel settings', 'pikoworks_core'),
                'value' => array(esc_html__('Carousel Style', 'pikoworks_core') => 'yes'),
            ),
            array(
                'type' => 'pikoworks_number',
                'heading' => esc_html__('Products to show each slide', 'pikoworks_core'),
                'param_name' => 'number_show',
                'value' => '3',
                'std' => '3',
                'group' => esc_html__('Carousel settings', 'pikoworks_core'),
                'dependency' => array('element' => 'is_slider', 'value' => array('yes')),
            ),
            array(
                'type' => 'dropdown',
                'value' => array(
                    esc_html__('Yes', 'pikoworks_core') => 'true',
                    esc_html__('No', 'pikoworks_core') => 'false'
                ),
                'std' => 'false',
                'heading' => esc_html__('Bullets', 'pikoworks_core'),
                'param_name' => 'dots',
                'description' => esc_html__("Show Carousel bullets bottom", 'pikoworks_core'),
                'group' => esc_html__('Carousel settings', 'pikoworks_core'),
                'dependency' => array('element' => 'is_slider', 'value' => array('yes')),
            ),
            array(
                'type' => 'dropdown',
                'value' => array(
                    esc_html__('Yes', 'pikoworks_core') => 'true',
                    esc_html__('No', 'pikoworks_core') => 'false'
                ),
                'std' => 'false',
                'heading' => esc_html__('AutoPlay', 'pikoworks_core'),
                'param_name' => 'autoplay',
                'group' => esc_html__('Carousel settings', 'pikoworks_core'),
                'dependency' => array('element' => 'is_slider', 'value' => array('yes')),
            ),
            array(
                'type' => 'dropdown',
                'value' => array(
                    esc_html__('Yes', 'pikoworks_core') => 'true',
                    esc_html__('No', 'pikoworks_core') => 'false'
                ),
                'std' => 'false',
                'heading' => esc_html__('Loop', 'pikoworks_core'),
                'param_name' => 'loop',
                'description' => esc_html__("Inifnity loop. Duplicate last and first items to get loop illusion.", 'pikoworks_core'),
                'group' => esc_html__('Carousel settings', 'pikoworks_core'),
                'dependency' => array('element' => 'is_slider', 'value' => array('yes')),
            ),
            array(
                'type' => 'dropdown',
                "heading" => 'Carousel show vartical',
                'param_name' => 'is_vertical',
                'group' => esc_html__('Carousel settings', 'pikoworks_core'),
                'value' => array(
                    esc_html__('Yes', 'pikoworks_core') => 'true',
                    esc_html__('No', 'pikoworks_core') => 'false'
                ),
                'std' => 'false',
                'dependency' => array('element' => 'is_slider', 'value' => array('yes')),
            ),
                ), pikoworks_get_vc_design())
    );
    vc_map($params);
}

class WPBakeryShortCode_pikoworks_widget_products extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
        $args = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('pikoworks_widget_products', $atts) : $atts;
        $args = shortcode_atts(array(
            'title' => '',
            'number' => '3',
            'show' => '',
            'orderby' => '',
            'order' => '',
            'hide_free' => '',
            'show_hidden' => '',
            'widget_id' => '',
            //Carousel 
            'is_slider' => '',
            'autoplay' => "false",
            'loop' => "false",
            'dots' => "false",
            'is_vertical' => 'false',
            'number_show' => 3,
            'el_class' => '',
            'css' => '',
                ), $atts);
        extract($args);

        $css_class = 'widget woocommerce hsc ' . $el_class . ' ' . $css;
        if (function_exists('vc_shortcode_custom_css_class')):
            $css_class .= ' ' . apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '), '', $args);
        endif;



        if ($show == 'top_rated') {

            $query_args = array(
                'posts_per_page' => $number,
                'no_found_rows' => 1,
                'post_status' => 'publish',
                'post_type' => 'product',
                'meta_key' => '_wc_average_rating',
                'orderby' => 'meta_value_num',
                'order' => $order,
                'meta_query' => WC()->query->get_meta_query(),
                'tax_query' => WC()->query->get_tax_query(),
            );
        } else {
            $product_visibility_term_ids = wc_get_product_visibility_term_ids();

            $query_args = array(
                'posts_per_page' => $number,
                'post_status' => 'publish',
                'post_type' => 'product',
                'no_found_rows' => 1,
                'order' => $order,
                'meta_query' => array(),
                'tax_query' => array(
                    'relation' => 'AND',
                ),
            );

            if (empty($args['show_hidden'])) {
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'term_taxonomy_id',
                    'terms' => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
                    'operator' => 'NOT IN',
                );
                $query_args['post_parent'] = 0;
            }

            if (!empty($args['hide_free'])) {
                $query_args['meta_query'][] = array(
                    'key' => '_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'DECIMAL',
                );
            }

            if ('yes' === get_option('woocommerce_hide_out_of_stock_items')) {
                $query_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'product_visibility',
                        'field' => 'term_taxonomy_id',
                        'terms' => $product_visibility_term_ids['outofstock'],
                        'operator' => 'NOT IN',
                    ),
                );
            }

            switch ($show) {
                case 'featured' :
                    $query_args['tax_query'][] = array(
                        'taxonomy' => 'product_visibility',
                        'field' => 'term_taxonomy_id',
                        'terms' => $product_visibility_term_ids['featured'],
                    );
                    break;
                case 'onsale' :
                    $product_ids_on_sale = wc_get_product_ids_on_sale();
                    $product_ids_on_sale[] = 0;
                    $query_args['post__in'] = $product_ids_on_sale;
                    break;
            }

            switch ($orderby) {
                case 'price' :
                    $query_args['meta_key'] = '_price';
                    $query_args['orderby'] = 'meta_value_num';
                    break;
                case 'rand' :
                    $query_args['orderby'] = 'rand';
                    break;
                case 'sales' :
                    $query_args['meta_key'] = 'total_sales';
                    $query_args['orderby'] = 'meta_value_num';
                    break;
                default :
                    $query_args['orderby'] = 'date';
            }
        }

        $query_args = new WP_Query(apply_filters('woocommerce_products_widget_query_args', $query_args, $args));


        $slide_before = $slide_after = $slide_class = $data_slick = '';

        if ($is_slider == 'yes') {
            $slide_class = 'piko-carousel stcr al';
            $vertical = $is_vertical ? '"vertical":' . esc_attr($is_vertical) . ',"verticalSwiping":true,' : '';

            $data_slick = '{' . $vertical . '"arrows":true,"dots":' . esc_attr($dots) . ',"infinite":' . esc_attr($loop) . ',"autoplay":' . esc_attr($autoplay) . '}';
            $slide_before = '<ul class="slick-slide pd0">';
            $slide_after = '</ul><ul class="slick-slide pd0">';
        }

        $post_count = 0;

        ob_start();
        ?>        
        <section class="<?php echo esc_attr($css_class) ?>">

        <?php
        if ($title != '') {
            echo '<h4 class="widget-title">' . esc_attr($title) . '</h4>';
        }
        if ($query_args->have_posts()) {

            echo '<ul class="product_list_widget ' . esc_attr($slide_class) . '"  data-slick=\'' . $data_slick . '\' >';

            echo $slide_before;

            $args = array(
                'widget_id' => $args['widget_id'],
                'show_rating' => true,
            );

            while ($query_args->have_posts()) {
                $query_args->the_post();
                $post_count++;

                $template_args = array(
                    'widget_id' => $args['widget_id'],
                    'show_rating' => true,
                );
                wc_get_template('content-widget-product.php', $template_args);

                if ($post_count % $number_show == 0) {
                    echo $slide_after;
                }
            }

            echo '</ul>';
        }
        ?>
        </section>

            <?php
            $result = ob_get_contents();
            ob_clean();
            return $result;
        }

    }
    
<?php

/**
 * Custom post testimonial
 * @author themepiko
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $marin;
if (!class_exists('piko_Shortcode_testimonial')) {
    class piko_Shortcode_testimonial
    {
        function __construct()
        {
            add_action('init', array($this, 'register_taxonomies'), 5);
            add_action('init', array($this, 'register_post_types'), 5);
            add_shortcode('piko_testimonial', array($this, 'testimonial_shortcode'));
            add_filter('rwmb_meta_boxes', array($this, 'register_meta_boxes'));
            if (is_admin()) {
                add_filter('manage_edit-testimonial_columns', array($this, 'add_columns'));
                add_action('manage_testimonial_posts_custom_column', array($this, 'set_columns_value'), 10, 2);
                add_action('admin_menu', array($this, 'addMenuChangeSlug'));
            }
        }

        function register_taxonomies()
        {
            if (taxonomy_exists('testimonial_category')) {
                return;
            }

            $post_type = 'testimonial';
            $taxonomy_slug = 'testimonial_category';
            $taxonomy_name = 'Testimonial Categories';

            $post_type_slug = get_option('piko-' . $post_type . '-config');
            if (
                isset($post_type_slug) && is_array($post_type_slug) &&
                array_key_exists('taxonomy_slug', $post_type_slug) && $post_type_slug['taxonomy_slug'] != ''
            ) {
                $taxonomy_slug = $post_type_slug['taxonomy_slug'];
                $taxonomy_name = $post_type_slug['taxonomy_name'];
            }
            register_taxonomy(
                'testimonial_category',
                'testimonial',
                array(
                    'hierarchical' => true,
                    'label' => $taxonomy_name,
                    'query_var' => true,
                    'rewrite' => array('slug' => $taxonomy_slug)
                )
            );
            flush_rewrite_rules();
        }

        function register_post_types()
        {
            $post_type = 'testimonial';

            if (post_type_exists($post_type)) {
                return;
            }

            $post_type_slug = get_option('piko-' . $post_type . '-config');
            if (!isset($post_type_slug) || !is_array($post_type_slug)) {
                $slug = 'testimonial';
                $name = $singular_name = 'Testimonial';
            } else {
                $slug = $post_type_slug['slug'];
                $name = $post_type_slug['name'];
                $singular_name = $post_type_slug['singular_name'];
            }

            register_post_type(
                $post_type,
                array(
                    'label' => esc_html__('Testimonial', 'pikoworks_custom_post'),
                    'description' => esc_html__('Testimonial Description', 'pikoworks_custom_post'),
                    'labels' => array(
                        'name' => $name,
                        'singular_name' => esc_html($singular_name),
                        'menu_name' => esc_html__($name, 'pikoworks_custom_post'),
                        'parent_item_colon' => esc_html__('Parent Item:', 'pikoworks_custom_post'),
                        'all_items' => esc_html__(sprintf('All %s', $name), 'pikoworks_custom_post'),
                        'view_item' => esc_html__('View Item', 'pikoworks_custom_post'),
                        'add_new_item' => esc_html__(sprintf('Add New  %s', $name), 'pikoworks_custom_post'),
                        'add_new' => esc_html__('Add New', 'pikoworks_custom_post'),
                        'edit_item' => esc_html__('Edit Item', 'pikoworks_custom_post'),
                        'update_item' => esc_html__('Update Item', 'pikoworks_custom_post'),
                        'search_items' => esc_html__('Search Item', 'pikoworks_custom_post'),
                        'not_found' => esc_html__('Not found', 'pikoworks_custom_post'),
                        'not_found_in_trash' => esc_html__('Not found in Trash', 'pikoworks_custom_post'),
                    ),
                    'supports' => array('title', 'excerpt', 'thumbnail', 'revisions'),
                    'public' => true,
                    'show_ui' => true,
                    '_builtin' => false,
                    'has_archive' => true,
                    'rewrite' => array('slug' => $slug, 'with_front' => true),
                    'menu_icon' => 'dashicons-format-quote',
                )
            );
            flush_rewrite_rules();
        }

        function addMenuChangeSlug()
        {
            add_submenu_page('edit.php?post_type=testimonial', 'Setting', 'Settings', 'edit_posts', wp_basename(__FILE__), array($this, 'initPageSettings'));
        }

        function initPageSettings()
        {
            $template_path = ABSPATH . 'wp-content/plugins/pikoworks_custom_post/core/post-type/posttype-settings/settings.php';
            if (file_exists($template_path))
                require_once $template_path;
        }

        function add_columns($columns)
        {
            unset($columns['cb'],
            $columns['title'],
            $columns['date']);
            $cols = array_merge(array('cb' => ('')), $columns);
            $cols = array_merge($cols, array('title' => esc_html__('Name', 'pikoworks_custom_post')));
            $cols = array_merge($cols, array('job' => esc_html__('Company Name', 'pikoworks_custom_post')));
            $cols = array_merge($cols, array('thumbnail' => esc_html__('Client Picture', 'pikoworks_custom_post')));
            $cols = array_merge($cols, array('date' => esc_html__('Comment Date', 'pikoworks_custom_post')));
            return $cols;
        }

        function set_columns_value($column, $post_id)
        {
            switch ($column) {
                case 'id': {
                        echo wp_kses_post($post_id);
                        break;
                    }
                case 'job': {
                        echo get_post_meta($post_id, 'job', true);
                        break;
                    }
                case 'thumbnail': {
                        echo get_the_post_thumbnail($post_id, 'thumbnail');
                        break;
                    }
            }
        }

        function register_meta_boxes($meta_boxes)
        {
            $prefix = 'piko_';
            global $meta_boxes;
            $meta_boxes[] = array(
                'title' => esc_html__('Testimonial Details', 'pikoworks_custom_post'),
                'pages' => array('testimonial'),
                'fields' => array(

                    array(
                        'name' => esc_html__('Designation', 'pikoworks_custom_post'),
                        'id' => $prefix . 'company_designation',
                        'type' => 'text',
                    ),
                    array(
                        'name' => esc_html__('Company Name', 'pikoworks_custom_post'),
                        'id' => 'job',
                        'type' => 'text',
                    ),
                    array(
                        'name' => esc_html__('Company Url', 'pikoworks_custom_post'),
                        'desc' => esc_html__('Add company website', 'pikoworks_custom_post'),
                        'id' => $prefix . 'company_urls',
                        'type' => 'text',
                        'validation' => 'url',
                    ),
                )
            );
            return $meta_boxes;
        }

        function testimonial_shortcode($atts)
        {

            extract(shortcode_atts(array(
                'open_icon' => '',
                'text_color' => '',
                'type' => '1',
                'number'        => 7,
                'category'        => '',
                'order' => 'DESC',
                'orderby' => 'date',
                'excerpt'   => '55',
                'show_company_link' => 'no',
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
                //Default
                'items_very_large_device'   => 4,
                'items_large_device'   => 4,

                'el_class' => '',
                'css'           => '',


            ), $atts));
            global $meta;
            $args = array(
                'post_type' => 'testimonial',
                'post_status' => 'publish',
                'orderby' => esc_attr($orderby),
                'order'   => esc_attr($order),
                'posts_per_page' => esc_attr($number),
            );
            if ($category != '') {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'testimonial_category',
                        'field' => 'slug',
                        'terms' => explode(',', $category),
                        'operator' => 'IN'
                    )
                );
            }

            $query = new WP_Query($args);
            ob_start();
            if ($query->have_posts()) :

                $css_class = 'hsc sc-tl-' . $type . ' ' . $el_class . ' ' . $text_color;
                if (function_exists('vc_shortcode_custom_css_class')) :
                    $css_class .= ' ' . apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '), '', $atts);
                endif;

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

                if (!function_exists(pikoworks_is_mobile())) {
                    $col_class[] = 'col-lg-' . $large_device;
                    $col_class[] = 'col-md-' . $col_md;
                    $col_class[] = 'col-sm-' . $col_sm;
                    $col_class = esc_attr(implode(' ', $col_class));
                }
                if ($is_slider == 'yes' && $use_responsive == '0' || function_exists(pikoworks_is_mobile())) {
                    $col_class = 'col-xs-12';
                }

                $slide_class = 'piko-carousel-grid row';
                $data_slick = '';
                if ($is_slider == 'yes' || function_exists(pikoworks_is_mobile())) {
                    $slide_class = 'piko-carousel' . ' ' . $navigation_btn . ' ' . $btn_light . ' ' . $btn_hover_show . ' ' . $margin;

                    $res_large = $use_responsive ? '"slidesToShow":' . esc_attr($items_very_large_device) . ', "slidesToScroll": 1,' : '';
                    $res_media = $use_responsive ? ',"responsive":[{"breakpoint": 1200,"settings":{"slidesToShow":' . esc_attr($items_very_large_device) . '}},{"breakpoint": 1199,"settings":{"slidesToShow": ' . esc_attr($items_large_device) . '}},{"breakpoint": 768,"settings":{"slidesToShow": 2}},{"breakpoint": 576,"settings":{"slidesToShow": 1}}]' : '';

                    $data_slick = '{' . $res_large . '"arrows":' . esc_attr($navigation) . ',"dots":' . esc_attr($dots) . ',"infinite":' . esc_attr($loop) . ',"autoplay":' . esc_attr($autoplay) . '' . $res_media . '}';
                }



                ?>
            <div class="<?php echo esc_attr($css_class) ?>">
                <div class="<?php echo esc_attr($slide_class) ?>" data-slick='<?php echo  $data_slick; ?>'>
                    <?php
                    while ($query->have_posts()) : $query->the_post();

                        $prefix = 'piko_';
                        $job = get_post_meta(get_the_ID(), 'job', true);
                        $designation = get_post_meta(get_the_ID(), $prefix . 'company_designation', true);
                        $urls = get_post_meta(get_the_ID(), $prefix . 'company_urls', true);


                        $plugin_path = untrailingslashit(plugin_dir_path(__FILE__));
                        switch ($type) {
                            case '3': {
                                    include($plugin_path . '/templates/style3.php');
                                    break;
                                }
                            case '2': {
                                    include($plugin_path . '/templates/style2.php');
                                    break;
                                }
                            default: {
                                    include($plugin_path . '/templates/style1.php');
                                }
                        }
                        ?>
                    <?php endwhile; // end of the loop.  
                    ?>
                </div>
            </div>
        <?php
        endif; //have query post   
        wp_reset_postdata();
        $content = ob_get_clean();
        return $content;
    }
}
new piko_Shortcode_testimonial();
}

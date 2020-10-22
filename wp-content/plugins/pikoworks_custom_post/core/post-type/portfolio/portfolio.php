<?php

/**
 * Custom post Portfolio
 *@author themepiko
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (!defined('PIKO_PORTFOLIO_POST_TYPE'))
    define('PIKO_PORTFOLIO_POST_TYPE', 'portfolio');
if (!defined('PIKO_PORTFOLIO_CATEGORY_TAXONOMY'))
    define('PIKO_PORTFOLIO_CATEGORY_TAXONOMY', 'portfolio-category');
if (!defined('PIKO_PORTFOLIO_DIR_PATH'))
    define('PIKO_PORTFOLIO_DIR_PATH', plugin_dir_path(__FILE__));

include_once(plugin_dir_path(__FILE__) . 'metaboxes/custom-metabox.php');
if (!class_exists('Piko_custom_post_type_Portfolio')) {
    class Piko_custom_post_type_Portfolio
    {
        function __construct()
        {
            add_action('init', array($this, 'register_taxonomies'), 5);
            add_action('init', array($this, 'register_post_types'), 6);
            add_shortcode('piko_portfolio', array($this, 'portfolio_shortcode'));
            add_filter('rwmb_meta_boxes', array($this, 'register_meta_boxes'));
            add_filter('single_template', array($this, 'get_portfolio_single_template'));

            if (is_admin()) {
                add_filter('manage_edit-' . PIKO_PORTFOLIO_POST_TYPE . '_columns', array($this, 'add_portfolios_columns'));
                add_action('manage_' . PIKO_PORTFOLIO_POST_TYPE . '_posts_custom_column', array($this, 'set_portfolios_columns_value'), 10, 2);
                add_action('restrict_manage_posts', array($this, 'portfolio_manage_posts'));
                add_filter('parse_query', array($this, 'convert_taxonomy_term_in_query'));
                add_action('admin_menu', array($this, 'addMenuChangeSlug'));
            }
            $this->includes();
        }

        function front_scripts()
        {
            global $xtocky;
            $min_suffix = (isset($xtocky['enable_minifile']) && $xtocky['enable_minifile'] == 1) ? '.min' : '';
        }
        function register_post_types()
        {

            $post_type = PIKO_PORTFOLIO_POST_TYPE;

            if (post_type_exists($post_type)) {
                return;
            }

            $post_type_slug = get_option('piko-' . $post_type . '-config');
            if (!isset($post_type_slug) || !is_array($post_type_slug)) {
                $slug = 'portfolio';
                $name = $singular_name = 'Portfolio';
            } else {
                $slug = $post_type_slug['slug'];
                $name = $post_type_slug['name'];
                $singular_name = $post_type_slug['singular_name'];
            }

            register_post_type(
                $post_type,
                array(
                    'label' => esc_html__('Portfolio', 'pikoworks_custom_post'),
                    'description' => esc_html__('Portfolio Description', 'pikoworks_custom_post'),
                    'labels' => array(
                        'name' => esc_attr($name),
                        'singular_name' => esc_attr($singular_name),
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
                    'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
                    'public' => true,
                    'show_ui' => true,
                    '_builtin' => false,
                    'has_archive' => true,
                    'menu_icon' => 'dashicons-screenoptions',
                    'rewrite' => array('slug' => $slug, 'with_front' => true),
                )
            );
            flush_rewrite_rules();
        }

        function register_taxonomies()
        {
            if (taxonomy_exists(PIKO_PORTFOLIO_CATEGORY_TAXONOMY)) {
                return;
            }

            $post_type = PIKO_PORTFOLIO_POST_TYPE;
            $taxonomy_slug = PIKO_PORTFOLIO_CATEGORY_TAXONOMY;
            $taxonomy_name = 'Portfolio Categories';

            $post_type_slug = get_option('piko-' . $post_type . '-config');
            if (
                isset($post_type_slug) && is_array($post_type_slug) &&
                array_key_exists('taxonomy_slug', $post_type_slug) && $post_type_slug['taxonomy_slug'] != ''
            ) {
                $taxonomy_slug = $post_type_slug['taxonomy_slug'];
                $taxonomy_name = $post_type_slug['taxonomy_name'];
            }
            register_taxonomy(
                PIKO_PORTFOLIO_CATEGORY_TAXONOMY,
                PIKO_PORTFOLIO_POST_TYPE,
                array(
                    'hierarchical' => true,
                    'label' => $taxonomy_name,
                    'query_var' => true,
                    'rewrite' => array('slug' => $taxonomy_slug)
                )
            );
            flush_rewrite_rules();
        }

        function portfolio_shortcode($atts)
        {
            $this->front_scripts();
            $data_section_id = $tab_category_action = $show_title = $data_source = $excerpt = $menu_social = $portfolio_ids = $order = $title = $subtitle = $overlay_align = $column_masonry = $image_size = $layout_type = $show_title = $offset = $current_page = $overlay_style = $show_pagging_masonry = $show_pagging = $show_category = $category = $column = $item = $padding = $layout_type = $el_class  = '';
            extract(shortcode_atts(array(
                'layout_type' => 'grid',
                'title_bottom' => 'v2',
                'light_box' => '',
                'show_title' => 'yes',
                'is_directioanl' => '',
                'title' => '',
                'subtitle' => '',
                'data_source' => '',
                'show_pagging' => '',
                'show_pagging_masonry' => '',
                'show_category' => 'text-left',
                'excerpt' => '20',
                'tab_category_action' => 'filter',
                'category' => '',
                'portfolio_ids' => '',
                'column' => '3',
                'column_masonry' => '3',
                'column_masonry02' => '2',
                'item' => '',
                'order' => 'DESC',
                'padding' => '',
                'image_size' => '360x202',
                'schema_style' => '',
                'overlay_style' => 'icon',
                'el_class' => '',
                'css_animation' => '',
                'animation_delay'   =>  '0.5',   // In second
                'duration' => '',
                'delay' => '',
                'current_page' => '1',
                'ajax_load' => '0',
                'data_section_id' => '',


            ), $atts));
            if ($show_pagging == '2' || $item == '') {
                $offset = 0;
                $post_per_page = -1;
            } else {
                $post_per_page = $item;
                $offset = ($current_page - 1) * $item;
            }
            $css_class = 'row portfolio-row ' . $title_bottom . ' ' . $el_class . ' ' . $padding;


            if ($layout_type == 'masonry') {
                $column = $column_masonry;
                $show_pagging = $show_pagging_masonry;
            } elseif ($layout_type == 'masonry-style02') {
                $column = $column_masonry02;
            } elseif ($layout_type == 'masonry-two') {
                $column = '4';
            }
            $plugin_path = untrailingslashit(plugin_dir_path(__FILE__));

            switch ($layout_type) {
                case 'masonry-classic': {
                        $column = 4;
                    }
                default: {
                        $template_path = $plugin_path . '/templates/listing.php';
                    }
            }
            ob_start();
            include($template_path);
            $result = ob_get_contents();
            ob_end_clean();
            return $result;
        }

        function register_meta_boxes($meta_boxes)
        {
            global $meta_boxes;
            $widgets_list = array();
            foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
                $widgets_list[$sidebar['id']] = ucwords($sidebar['name']);
            }

            $meta_boxes[] = array(
                'title' => esc_html__('Portfolio Single Page Slider image', 'pikoworks_custom_post'),
                'id' => 'piko-meta-box-portfolio-format-gallery',
                'pages' => array(PIKO_PORTFOLIO_POST_TYPE),
                'fields' => array(
                    array(
                        'name' => esc_html__('Gallery', 'pikoworks_custom_post'),
                        'id' => 'portfolio-format-gallery',
                        'type' => 'image_advanced',
                    ),
                    array(
                        'name'     => esc_html__('View Detail Style', 'pikoworks_custom_post'),
                        'id'       => 'portfolio_detail_style',
                        'type'     => 'select',
                        'options'  => array(
                            'none'      => esc_html__('Inherit from theme options', 'pikoworks_custom_post'),
                            'detail-01' => esc_html__('Horizontal slide', 'pikoworks_custom_post'),
                            'detail-02' => esc_html__('Vertical Image', 'pikoworks_custom_post'),
                            'detail-03' => esc_html__('Slide with sidebar', 'pikoworks_custom_post'),
                        ),
                        'multiple'    => false,
                        'std'         => 'none',
                    ),
                    array(
                        'name'     => esc_html__('Single page Sidebar', 'pikoworks_custom_post'),
                        'id'     => 'portfolio_detail_sidebar',
                        'type'     => 'select',
                        'placeholder' => esc_html__('Select a Sidebar', 'pikoworks_custom_post'),
                        'options' => $widgets_list,
                        'required-field' => array('portfolio_detail_style', '=', array('detail-03')),
                    ),
                    array(
                        'name' => esc_html__('Video Embaded', 'pikoworks_custom_post'),
                        'desc' => esc_html__('If Have portfolio video else leave it', 'pikoworks_custom_post'),
                        'id' => 'portfolio_video',
                        'type' => 'oembed',
                    ),
                )
            );
            return $meta_boxes;
        }

        function get_portfolio_single_template($single)
        {
            global $post;
            /* Checks for single template by post type */
            if ($post->post_type == PIKO_PORTFOLIO_POST_TYPE) {
                $plugin_path = untrailingslashit(PIKO_PORTFOLIO_DIR_PATH);
                $template_path = $plugin_path . '/templates/single/single-portfolio.php';
                if (file_exists($template_path))
                    return $template_path;
            }
            return $single;
        }

        function add_portfolios_columns($columns)
        {
            unset($columns['cb'],
            $columns['title'],
            $columns['date']);
            $cols = array_merge(array('cb' => ('')), $columns);
            $cols = array_merge($cols, array('title' => esc_html__('Name', 'pikoworks_custom_post')));
            $cols = array_merge($cols, array('thumbnail' => esc_html__('Thumbnail', 'pikoworks_custom_post')));
            $cols = array_merge($cols, array(PIKO_PORTFOLIO_CATEGORY_TAXONOMY => esc_html__('Categories', 'pikoworks_custom_post')));
            $cols = array_merge($cols, array('date' => esc_html__('Date', 'pikoworks_custom_post')));
            return $cols;
        }

        function set_portfolios_columns_value($column, $post_id)
        {

            switch ($column) {
                case 'id': {
                        echo wp_kses_post($post_id);
                        break;
                    }
                case 'thumbnail': {
                        echo get_the_post_thumbnail($post_id, 'thumbnail');
                        break;
                    }
                case PIKO_PORTFOLIO_CATEGORY_TAXONOMY: {
                        $terms = wp_get_post_terms(get_the_ID(), array(PIKO_PORTFOLIO_CATEGORY_TAXONOMY));
                        $cat = '<ul>';
                        foreach ($terms as $term) {
                            $cat .= '<li><a href="' . get_term_link($term, PIKO_PORTFOLIO_CATEGORY_TAXONOMY) . '">' . $term->name . '<a/></li>';
                        }
                        $cat .= '</ul>';
                        echo wp_kses_post($cat);
                        break;
                    }
            }
        }

        function portfolio_manage_posts()
        {
            global $typenow;
            if ($typenow == PIKO_PORTFOLIO_POST_TYPE) {
                $selected = isset($_GET[PIKO_PORTFOLIO_CATEGORY_TAXONOMY]) ? $_GET[PIKO_PORTFOLIO_CATEGORY_TAXONOMY] : '';
                $args = array(
                    'show_count' => true,
                    'show_option_all' => esc_html__('Show All Categories', 'pikoworks_custom_post'),
                    'taxonomy' => PIKO_PORTFOLIO_CATEGORY_TAXONOMY,
                    'name' => PIKO_PORTFOLIO_CATEGORY_TAXONOMY,
                    'selected' => $selected,

                );
                wp_dropdown_categories($args);
            }
        }

        function convert_taxonomy_term_in_query($query)
        {
            global $pagenow;
            $qv = &$query->query_vars;
            if (
                $pagenow == 'edit.php' &&
                isset($qv[PIKO_PORTFOLIO_CATEGORY_TAXONOMY]) &&
                is_numeric($qv[PIKO_PORTFOLIO_CATEGORY_TAXONOMY])
            ) {
                $term = get_term_by('id', $qv[PIKO_PORTFOLIO_CATEGORY_TAXONOMY], PIKO_PORTFOLIO_CATEGORY_TAXONOMY);
                $qv[PIKO_PORTFOLIO_CATEGORY_TAXONOMY] = $term->slug;
            }
        }

        function addMenuChangeSlug()
        {
            add_submenu_page('edit.php?post_type=portfolio', 'Setting', 'Settings', 'edit_posts', wp_basename(__FILE__), array($this, 'initPageSettings'));
        }

        function initPageSettings()
        {
            $template_path = ABSPATH . 'wp-content/plugins/pikoworks_custom_post/core/post-type/posttype-settings/settings.php';
            if (file_exists($template_path))
                require_once $template_path;
        }

        private function includes()
        {
            include_once('action/ajax-action.php');
            if (class_exists('Vc_Manager', false)) {
                include_once('portfolio_slide.php');
            }
        }
    }
    new Piko_custom_post_type_Portfolio();
}

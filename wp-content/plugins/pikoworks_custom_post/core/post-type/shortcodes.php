<?php
/**
 * post type vc shortcode
 */
if (!class_exists('piko_custom_post_shortcodes')) {
    class piko_custom_post_shortcodes  {

        private static $instance;

        public static function init()
        {
            if (!isset(self::$instance)) {
                self::$instance = new piko_custom_post_shortcodes;
                add_action('init', array(self::$instance, 'includes'), 0);
                add_action('init', array(self::$instance, 'register_vc_map'), 10);
            }
            return self::$instance;
        }

        public function includes()
        {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
            
            require_once PIKOWORKS_CUSTOM_POST_CORE . '/post-type/custom-fields.php';
           
            include_once(PIKOWORKS_CUSTOM_POST_CORE . 'post-type/portfolio/portfolio.php');            
            include_once(PIKOWORKS_CUSTOM_POST_CORE . 'post-type/ourteam/ourteam.php');
            include_once(PIKOWORKS_CUSTOM_POST_CORE . 'post-type/testimonial/testimonial.php');
            
            if (!is_plugin_active('js_composer/js_composer.php')) {
                return;
            }
            
        }

        public static function  substr($str, $txt_len, $end_txt = '...')
        {
            if (empty($str)) return '';
            if (strlen($str) <= $txt_len) return $str;

            $i = $txt_len;
            while ($str[$i] != ' ') {
                $i--;
                if ($i == -1) break;
            }
            while ($str[$i] == ' ') {
                $i--;
                if ($i == -1) break;
            }

            return substr($str, 0, $i + 1) . $end_txt;
        }


        public function register_vc_map()
        {

            if (function_exists('vc_map')) {

                $get_slider_param = array();
                if (function_exists('pikoworks_get_slider_params_enable')){
                    $get_slider_param = pikoworks_get_slider_params_enable();
                }
                
                $add_image_size = array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Image size', 'pikoworks_custom_post'),
                        'param_name' => 'image_size',
                        'value' => array('360x202' => '360x202', '585x585' => '585x585', '590x393' => '590x393', '570x460', '200x140' => '200x140',),                       
                    );                
                $add_el_class = array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra class name', 'pikoworks_custom_post'),
                    'param_name' => 'el_class',
                    'admin_label' => false,
                    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'pikoworks_custom_post'),
                );                
                
                    $portfolio_categories = get_terms(PIKO_PORTFOLIO_CATEGORY_TAXONOMY, array('hide_empty' => 0, 'orderby' => 'ASC'));
                    $portfolio_cat = array();
                    if (is_array($portfolio_categories)) {
                        foreach ($portfolio_categories as $cat) {
                            $portfolio_cat[$cat->name] = $cat->slug;
                        }
                    }
                    

                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => PIKO_PORTFOLIO_POST_TYPE,
                        'post_status' => 'publish');
                    $list_portfolio = array();
                    $post_array = get_posts($args);
                    foreach ($post_array as $post) : setup_postdata($post);
                    $list_portfolio[$post->post_title] = $post->ID;
                    endforeach;
                    wp_reset_postdata();
                    vc_map(array(
                        'name' => esc_html__('Portfolio', 'pikoworks_custom_post'),
                        'base' => 'piko_portfolio',
                        'icon' => PIKOWORKS_CUSTOM_POST_ASSETS . 'images/vc-icon.png',
                        'description' => esc_html__( 'Display Different type Project layout', 'pikoworks_custom_post'),
                        'category' => 'Pikoworks',
                        'params' => array(
                             array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Display Category Tab Panel Name', 'pikoworks_custom_post'),
                                'param_name' => 'show_category',
                                'admin_label' => true,
                                'value' => array(
                                    esc_html__('None', 'pikoworks_custom_post') => '',
                                    esc_html__('Left', 'pikoworks_custom_post') => 'text-left',
                                    esc_html__('Center', 'pikoworks_custom_post') => 'text-center',
                                    esc_html__('Right', 'pikoworks_custom_post') => 'text-right'),
                                'std' => 'text-left',                                
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Different Layout style', 'pikoworks_custom_post'),
                                'param_name' => 'layout_type',
                                'admin_label' => true,
                                'value' => array(esc_html__('Grid', 'pikoworks_custom_post') => 'grid',                                    
                                    esc_html__('Masonry 01', 'pikoworks_custom_post') => 'masonry',                                   
                                    esc_html__('Masonry 02', 'pikoworks_custom_post') => 'masonry-style02',
                                     esc_html__('Masonry 03', 'pikoworks_custom_post') => 'masonry-two',
                                    esc_html__('Masonry Classic', 'pikoworks_custom_post') => 'masonry-classic',                                    
                                )
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Title position ', 'pikoworks_custom_post'),
                                'param_name' => 'title_bottom',
                                'value' => array(
                                    esc_html__('None', 'pikoworks_custom_post') => '',
                                    esc_html__('After image', 'pikoworks_custom_post') => 'v2',
                                    esc_html__('Overlay', 'pikoworks_custom_post') => 'overlay',
                                   ),
                                'std' => 'v2',                                                                
                            ),
                            array(                
                                'type' => 'checkbox',                
                                "heading" => '',
                                'param_name' => 'light_box',
                                'value' => array(esc_html__('Mark to Didable light box icon', 'pikoworks_custom_post') => 'yes'),
                            ),                   
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Target Source', 'pikoworks_custom_post'),
                                'param_name' => 'data_source',
                                'admin_label' => true,
                                'value' => array(
                                    esc_html__('From Category', 'pikoworks_custom_post') => '',
                                    esc_html__('From Title(IDs)', 'pikoworks_custom_post') => 'list_id')
                            ),

                            array(
                                'type' => 'pikoworks_taxonomy',
                                'heading' => esc_html__('Portfolio Category', 'pikoworks_custom_post'),
                                'param_name' => 'category',
                                'admin_label' => true,
                                "taxonomy"    => PIKO_PORTFOLIO_CATEGORY_TAXONOMY,
                                "value"       => '',
                                'parent'      => 0,
                                'multiple'    => true,
                                'description' => esc_html__('Select multiple specific Category or all Category', 'pikoworks_custom_post'),
                                'dependency' => Array('element' => 'data_source', 'value' => array(''))
                            ),
                            array(
                                'type' => 'pikoworks_title',
                                'heading' => esc_html__('Select Portfolio', 'pikoworks_custom_post'),
                                'param_name' => 'portfolio_ids',
                                'options' => $list_portfolio,
                                'multiple'    => true,
                                'description' => esc_html__('Select multiple specific title or all Title IDs', 'pikoworks_custom_post'),
                                'dependency' => Array('element' => 'data_source', 'value' => array('list_id'))
                            ),                            
                            
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Number of column', 'pikoworks_custom_post'),
                                'param_name' => 'column',                                
                                'value' => array('2' => '2', '3' => '3', '4' => '4'),
                                'std' => '3',
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid'))
                            ),                            
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Number of column masonry', 'pikoworks_custom_post'),
                                'param_name' => 'column_masonry',
                                'value' => array('3' => '3', '4' => '4'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array('masonry'))
                            ),                          
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Number of column masonry', 'pikoworks_custom_post'),
                                'param_name' => 'column_masonry02',
                                'value' => array('2' => '2', '3' => '3'),
                                'dependency' => Array('element' => 'layout_type', 'value' => array( 'masonry-style02'))
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Order Post Date By', 'pikoworks_custom_post'),
                                'param_name' => 'order',
                                'value' => array(esc_html__('Descending', 'pikoworks_custom_post') => 'DESC', esc_html__('Ascending', 'pikoworks_custom_post') => 'ASC')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Padding/ Gap each item', 'pikoworks_custom_post'),
                                'param_name' => 'padding',
                                'value' => array(esc_html__('Default', 'pikoworks_custom_post') => '', 'No Padding' => 'no-padding', '02 px' => 'col-padding-02', '05 px' => 'col-padding-05'),
                                'dependency' => array('element'   => 'title_bottom', 'value'     => array( '', 'overlay' ) ), 
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Image size', 'pikoworks_custom_post'),
                                'param_name' => 'image_size',
                                'value' => array('360x275' => '360x275', '436x260' => '436x260', '585x585' => '585x585', '590x393' => '590x393', '590x450' => '590x450', '897x536' => '897x536','510x672' => '510x672'), 
                                'dependency' => Array('element' => 'layout_type', 'value' => array('grid', 'title')),
                                'std' => '433x260', 
                            ),
                            array(
                                'type'           => 'css_editor',
                                'heading'        => esc_html__( 'Css', 'pikoworks_custom_post' ),
                                'param_name'     => 'css',
                                'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'pikoworks_custom_post' ),
                                'group'          => esc_html__( 'Design options', 'pikoworks_custom_post' )
                            ),
                            $add_el_class,                            
                        )
                    ));

      
                    $ourteam_cat = array();
                    $ourteam_categories = get_terms('ourteam_category', array('hide_empty' => 0, 'orderby' => 'ASC'));
                    if (is_array($ourteam_categories)) {
                        foreach ($ourteam_categories as $cat) {
                            $ourteam_cat[$cat->name] = $cat->slug;
                        }
                    }
                    $params = array(
                        'name' => esc_html__('Our Team', 'pikoworks_custom_post'),
                        'base' => 'piko_ourteam',
                        'description' => esc_html__('Differnt style Team', 'pikoworks_custom_post'),
                        'icon' => PIKOWORKS_CUSTOM_POST_ASSETS . 'images/vc-icon.png',
                        'category' => 'Pikoworks',
                        'params'      => array_merge(array(                           
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Layout Style', 'pikoworks_custom_post'),
                                'param_name' => 'type',
                                'admin_label' => true,
                                'value' => array(
                                    esc_html__('Classic', 'pikoworks_custom_post') => '1', 
                                    esc_html__('Modern', 'pikoworks_custom_post') => '2',
                                    esc_html__('List', 'pikoworks_custom_post') => '3',
                                    esc_html__('Modern 2', 'pikoworks_custom_post') => '4',
                                    ),
                            ),                         
                            array(
                                'type' => 'dropdown',
                                'param_name' => 'target_team',
                                'value' => array(
                                    esc_html__('All Team Member', 'pikoworks_custom_post') => 'target_team',
                                    esc_html__('Multi Category Team', 'pikoworks_custom_post') => 'cat_team',
                                ),                
                                'heading' => esc_html__('Target Team Member', 'pikoworks_custom_post'),                               
                                'admin_label' => true,
                            ),                           
                            array(
                                'type' => 'pikoworks_taxonomy',
                                'heading' => esc_html__('Category', 'pikoworks_custom_post'),
                                'param_name' => 'category',
                                'taxonomy' => 'ourteam_category',
                                'multiple'    => true,
                                'dependency' => array(
                                                'element'   => 'target_team',
                                                'value'     => array( 'cat_team' ),
                                            ),
                            ), 
                             array(
                                "type"        => "pikoworks_number",
                                "heading"     => esc_html__("Number team Member load", 'pikoworks_custom_post'),
                                "param_name"  => "number",
                                "value"       => 8,                                
                                "description" => esc_html__('Enter number of Product if you use "-1" load all product load. or Enter specific as you want like as 7, 8,10...', 'pikoworks_custom_post')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Image size', 'pikoworks_custom_post'),
                                'param_name' => 'img_size',                              
                                'value' => array(
                                    esc_html__('270x270', 'pikoworks_custom_post') => '270x270', 
                                    esc_html__('390x271', 'pikoworks_custom_post') => '390x271',
                                    esc_html__('306x302', 'pikoworks_custom_post') => '306x302',
                                    esc_html__('436x430', 'pikoworks_custom_post') => '436x430',
                                    ),
                                'std' => '436x430',
                            ),
                            array(
                                "type"       => "dropdown",
                                "heading"    => esc_html__("Order by", 'pikoworks_custom_post'),
                                "param_name" => "orderby",
                                "value"      => array(
                                    esc_html__('None', 'pikoworks_custom_post')     => 'none',
                                    esc_html__('ID', 'pikoworks_custom_post')       => 'ID',
                                    esc_html__('Author', 'pikoworks_custom_post')   => 'author',
                                    esc_html__('Name', 'pikoworks_custom_post')     => 'name',
                                    esc_html__('Date', 'pikoworks_custom_post')     => 'date',
                                    esc_html__('Modified', 'pikoworks_custom_post') => 'modified',
                                    esc_html__('Rand', 'pikoworks_custom_post')     => 'rand',
                                    ),
                                'std'         => 'date',
                                'dependency' => array(
                                                'element'   => 'target_team',
                                                'value'     => array( 'target_team' ),
                                            ),
                                "description" => esc_html__("Select how to sort retrieved posts.",'pikoworks_custom_post')
                            ),
                            array(
                                "type"       => "dropdown",
                                "heading"    => esc_html__("Order", 'pikoworks_custom_post'),
                                "param_name" => "order",
                                "value"      => array(
                                    esc_html__( 'Descending', 'pikoworks_custom_post' ) => 'DESC',
                                    esc_html__( 'Ascending', 'pikoworks_custom_post' )  => 'ASC'
                                    ),
                                'std'         => 'DESC',
                                'dependency' => array(
                                                'element'   => 'target_team',
                                                'value'     => array( 'target_team' ),
                                            ),
                                "description" => esc_html__("Designates the ascending or descending order.",'pikoworks_custom_post')
                            ),                             
                             array(
                                    'type' => 'textfield',
                                    'param_name' => 'excerpt',
                                    'heading' => esc_html__('Excerpt word', 'pikoworks_custom_post'),
                                    'description' => esc_html__('Default use Excerpt 25 words ', 'pikoworks_custom_post'),
                                    'value' => '25',
                                ),
                            array(
                                "type"        => "textfield",
                                "heading"     => esc_html__( "Extra class name", 'pikoworks_custom_post' ),
                                "param_name"  => "el_class",
                                "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks-core" ),
                            ),
                       ),$get_slider_param)
                    );
                    vc_map($params);
               
                

                    $testimonial_cat = array();
                    $testimonial_categories = get_terms('testimonial_category', array('hide_empty' => 0, 'orderby' => 'ASC'));
                    if (is_array($testimonial_categories)) {
                        foreach ($testimonial_categories as $cat) {
                            $testimonial_cat[$cat->name] = $cat->slug;
                        }
                    }
                    $params1 = array(
                        'name' => esc_html__('Testimonial', 'pikoworks_custom_post'),
                        'description' => esc_html__('Display Differnt style', 'pikoworks_custom_post'),
                        'base' => 'piko_testimonial',
                        'icon' => PIKOWORKS_CUSTOM_POST_ASSETS . 'images/vc-icon.png',
                        'category' => 'Pikoworks',
                        'params'      => array_merge(array(                            
                            array(
                                'type' => 'dropdown',
                                'param_name' => 'target_team',
                                'value' => array(
                                    esc_html__('All Team Member', 'pikoworks_custom_post') => 'target_team',
                                    esc_html__('Multi Category Team', 'pikoworks_custom_post') => 'cat_team',
                                ),                
                                'heading' => esc_html__('Target Team Member', 'pikoworks_custom_post'),                               
                                'admin_label' => true,
                            ),                           
                            array(
                                 'type' => 'pikoworks_taxonomy',
                                'heading' => esc_html__('Category', 'pikoworks_custom_post'),
                                'param_name' => 'category',
                                'multiple'    => true,
                                'taxonomy' => 'testimonial_category',
                                'dependency' => array('element'   => 'target_team', 'value'     => array( 'cat_team' )),
                            ), 
                            array(
                                'type'          => 'dropdown',
                                'heading'       => esc_html__( 'select style', 'pikoworks_custom_post' ),
                                'param_name'    => 'type',
                                'value' => array(
                                    esc_html__('style 1', 'pikoworks_custom_post') => '1',
                                    esc_html__('style 2', 'pikoworks_custom_post') => '2',
                                    esc_html__('style 3', 'pikoworks_custom_post') => '3',
                                ),
                                'std'           => '1',
                                'admin_label' => true,  
                            ),                            
                            array(                
                                'type' => 'checkbox',                
                                "heading" => '',
                                'param_name' => 'open_icon',
                                'value' => array(esc_html__('Image replace with icon', 'pikoworks_custom_post') => 'yes'),
                                'dependency' => array('element'   => 'type', 'value'     => array( '1','3' )),
                            ),
                            array(                
                                'type' => 'checkbox',                
                                "heading" => '',
                                'param_name' => 'text_color',
                                'value' => array(esc_html__('All text color white', 'pikoworks_custom_post') => 'tl-white'),
                            ),
                            array(
                                "type"        => "pikoworks_number",
                                "heading"     => esc_html__("Number testimonial load", 'pikoworks_custom_post'),
                                "param_name"  => "number",
                                "value"       => 7,
                                "description" => esc_html__('Enter number of estimonial if you use "-1" load all product load. or Enter specific as you want like as 7, 8,10...', 'pikoworks_custom_post')
                            ),    
                            array(
                                "type"       => "dropdown",
                                "heading"    => esc_html__("Order by", 'pikoworks_custom_post'),
                                "param_name" => "orderby",
                                "value"      => array(
                                    esc_html__('None', 'pikoworks_custom_post')     => 'none',
                                    esc_html__('ID', 'pikoworks_custom_post')       => 'ID',
                                    esc_html__('Author', 'pikoworks_custom_post')   => 'author',
                                    esc_html__('Name', 'pikoworks_custom_post')     => 'name',
                                    esc_html__('Date', 'pikoworks_custom_post')     => 'date',
                                    esc_html__('Modified', 'pikoworks_custom_post') => 'modified',
                                    esc_html__('Rand', 'pikoworks_custom_post')     => 'rand',
                                    ),
                                'std'         => 'date',
                                "description" => esc_html__("Select how to sort retrieved posts.",'pikoworks_custom_post')
                            ),
                            array(
                                "type"       => "dropdown",
                                "heading"    => esc_html__("Order", 'pikoworks_custom_post'),
                                "param_name" => "order",
                                "value"      => array(
                                    esc_html__( 'Descending', 'pikoworks_custom_post' ) => 'DESC',
                                    esc_html__( 'Ascending', 'pikoworks_custom_post' )  => 'ASC'
                                    ),
                                'std'         => 'DESC',
                                "description" => esc_html__("Designates the ascending or descending order.",'pikoworks_custom_post')
                            ),
                             array(
                                    'type' => 'textfield',
                                    'param_name' => 'excerpt',
                                    'heading' => esc_html__('Excerpt word', 'pikoworks_custom_post'),
                                    'description' => esc_html__('Default use Excerpt 55 words ', 'pikoworks_custom_post'),
                                    'value' => '55'
                             ),
                            array(
                                "type"        => "textfield",
                                "heading"     => esc_html__( "Extra class name", 'pikoworks_custom_post' ),
                                "param_name"  => "el_class",
                                "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks-core" ),
                            ),
                             array(
                                'type'           => 'css_editor',
                                'heading'        => esc_html__( 'Css', 'pikoworks_custom_post' ),
                                'param_name'     => 'css',
                                'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'pikoworks_custom_post' ),
                                'group'          => esc_html__( 'Design options', 'pikoworks_custom_post' )
                            ),
                        ),$get_slider_param)
                    );
                    vc_map($params1);                   
                //testimonial
            }
        }
    }

    if (!function_exists('piko_init_custom_post_shortcodes')) {
        function piko_init_custom_post_shortcodes()
        {
            return piko_custom_post_shortcodes::init();
        }

        piko_init_custom_post_shortcodes();
    }
}
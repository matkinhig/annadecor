<?php

/**
 * @ brand logo
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
add_action('init', 'pikoworks_vendor_search');
function pikoworks_vendor_search()
{
    // Setting shortcode lastest
    $params = array(
        "name"        => esc_html__("Vendor Search", 'pikoworks_core'),
        "base"        => "pikoworks_vendor_search",
        "category"    => esc_html__('Pikoworks', 'pikoworks_core'),
        "icon" => get_template_directory_uri() . "/assets/images/logo/favicon.png",
        "description" => esc_html__("Display Vendor Search", 'pikoworks_core'),
        'params'      => array_merge(array(

            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Layout', 'pikoworks_core'),
                'param_name' => 'layout',
                'value' => array(
                    esc_html__('Layout 01', 'pikoworks_core') => '1',
                    esc_html__('Layout 02', 'pikoworks_core') => '2',
                    esc_html__('Layout 03', 'pikoworks_core') => '3'
                ),
                'admin_label' => true,
            ),
            
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Title", 'pikoworks_core'),
                "param_name"  => "title",
                "description" => esc_html__("Title Empty to nothing show", "pikoworks_core"),

            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Search By', 'pikoworks_core'),
                'param_name' => 'vendor',
                'value' => array(
                    esc_html__('Vendor', 'pikoworks_core') => 'vendor',
                    esc_html__('Product', 'pikoworks_core') => 'product'
                ),
                'admin_label' => true,
            ),
            array(                
                'type' => 'checkbox',                
                "heading" => '',
                'param_name' => 'show_cat',
                'value' => array(esc_html__('Show Category', 'pikoworks_core') => 'show_cat'),
                'std' => 'show_cat',
                'admin_label' => true,      
            ),
            array(                
                'type' => 'checkbox',                
                "heading" => '',
                'param_name' => 'show_product_search',
                'value' => array(esc_html__('Show Product Name Search', 'pikoworks_core') => 'show_product_search'),
                'admin_label' => true,
                'dependency' => array('element' => 'vendor', 'value' => array('product')),
            ),
            array(
                'type' => 'attach_image',
                'param_name' => 'image',
                'admin_label' => true,
                'heading' => esc_html__('Add Background Image', 'pikoworks_core')
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
        )
        )
    );
    vc_map($params);
}
class WPBakeryShortCode_pikoworks_vendor_search extends WPBakeryShortCode
{

    protected function content($atts, $content = null)
    {
        $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('pikoworks_vendor_search', $atts) : $atts;
        $atts = shortcode_atts(array(
            'vendor'   => 'vendor',
            'show_cat'   => '',
            'show_product_search'   => '',

            'title' => '',
            'layout' => '1',
            'image' => '',
            'el_class' => '',
            'css' => '',


        ), $atts);
        extract($atts);


        $css_class = 'piko-location-filters ' . $el_class .' layout-' .$vendor . ' ' . $show_cat . ' ' . $show_product_search . ' layout-' . $layout;
        if (function_exists('vc_shortcode_custom_css_class')) :
            $css_class .= ' ' . apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '), '', $atts);
        endif;

        $img = wp_get_attachment_image_src($image, 'full');
        $search = '[dokan-geolocation-filter-form scope="'. esc_attr($vendor) .'"]';


        ob_start();

        ?>
        <div class="<?php echo esc_attr($css_class) ?>" style="background: url(<?php echo  esc_url($img[0]) ?>) center no-repeat;background-size: cover">
           
        <?php 
        if($layout !='1' ){ echo '<div class="filters-wrap">';}
        if($title !=''){
            echo '<h1>' . esc_html($title). '</h1>';
        }
        echo do_shortcode( $search);
        if($layout !='1'){ echo '</div>';}
        ?>
        </div>
<?php
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }
}

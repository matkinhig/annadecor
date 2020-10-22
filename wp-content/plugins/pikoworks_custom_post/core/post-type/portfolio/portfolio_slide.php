<?php

/**
 * @author  themepiko
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
add_action('init', 'pikoworks_portfolio_slide');
function pikoworks_portfolio_slide()
{
    $get_slider_param = array();
    if (function_exists('pikoworks_get_slider_params_enable')){
        $get_slider_param = pikoworks_get_slider_params_enable();
    }
    // Setting shortcode lastest
    $params = array(
        "name"        => esc_html__("Portfolio slide", 'pikoworks-core'),
        "base"        => "pikoworks_portfolio_slide",
        "category"    => esc_html__('Pikoworks', 'pikoworks-core'),
        "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
        "description" => esc_html__("Show product Categories", 'pikoworks-core'),
        'params'      => array_merge(array(
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Image Size", 'pikoworks-core'),
                "param_name"  => "img_size",
                'value' => '400x540',
                "description" => esc_html__("NB: size size should be like this: 400x400 | Image collect from category thumbnail", "pikoworks-core"),
                'dependency' => array('element'   => 'type', 'value'     => array('image')),
            ),
            array(
                "type"       => "dropdown",
                "heading"    => esc_html__("Order by", 'pikoworks-core'),
                "param_name" => "orderby",
                "value"      => array(
                    esc_html__('None', 'pikoworks-core')     => 'none',
                    esc_html__('ID', 'pikoworks-core')       => 'ID',
                    esc_html__('Author', 'pikoworks-core')   => 'author',
                    esc_html__('Name', 'pikoworks-core')     => 'name',
                    esc_html__('Date', 'pikoworks-core')     => 'date',
                    esc_html__('Modified', 'pikoworks-core') => 'modified',
                    esc_html__('Rand', 'pikoworks-core')     => 'rand',
                ),
                'std'         => 'ID',
                "description" => esc_html__("Select how to sort retrieved posts.", 'pikoworks-core')
            ),
            array(
                "type"       => "dropdown",
                "heading"    => esc_html__("Order", 'pikoworks-core'),
                "param_name" => "order",
                "value"      => array(
                    esc_html__('Descending', 'pikoworks-core') => 'DESC',
                    esc_html__('Ascending', 'pikoworks-core')  => 'ASC'
                ),
                'std'         => 'DESC',
                "description" => esc_html__("Designates the ascending or descending order.", 'pikoworks-core')
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Extra class name", 'pikoworks-core'),
                "param_name"  => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks-core"),
            ),
            array(
                'type'           => 'css_editor',
                'heading'        => esc_html__('Css', 'pikoworks-core'),
                'param_name'     => 'css',
                'group'          => esc_html__('Design options', 'pikoworks-core')
            )
        ), $get_slider_param)
    );
    vc_map($params);
}
class WPBakeryShortCode_pikoworks_portfolio_slide extends WPBakeryShortCode
{

    protected function content($atts, $content = null)
    {
        $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('pikoworks_portfolio_slide', $atts) : $atts;
        $atts = shortcode_atts(array(

            'img_size' => '',
            'order' => 'DESC',
            'orderby' => 'ID',
            'el_class' => '',

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
            'items_mobile_device'   => 1,

            'css'           => '',


        ), $atts);
        extract($atts);

        $css_class = 'portfolio-item-container portfolio-slide popup-gallery hsc sip ' . $el_class;
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

        $large_device = round(12 / $items_very_large_device);
        if ($items_very_large_device == '5') {
            $large_device = '20';
        }                                
    
        if( ! pikoworks_is_mobile() ){ 
            $col_class[] = 'col-lg-'.$large_device;
            $col_class[] = 'col-md-' . $col_md;
            $col_class[] = 'col-sm-' . $col_sm;
            $col_class = esc_attr(implode(' ', $col_class));
        }
        if ($is_slider == 'yes' && $use_responsive == '0' || pikoworks_is_mobile()) {
            $col_class = 'col-xs-12';
        }
        if (pikoworks_is_mobile()) {
            $navigation = 'false';
            $dots = 'true';
        }


        $slide_class = 'piko-carousel-grid';
        $data_slick = '';
        if ($is_slider == 'yes' || pikoworks_is_mobile()) {
            $slide_class = 'piko-carousel' . ' ' . $navigation_btn . ' ' . $btn_light . ' ' . $btn_hover_show . ' ' . $margin;

            $res_large = $use_responsive ? '"slidesToShow":' . esc_attr($items_very_large_device) . ', "slidesToScroll": 2,' : '';
            $res_media = $use_responsive ? ',"responsive":[{"breakpoint": 1200,"settings":{"slidesToShow":' . esc_attr($items_very_large_device) . '}},{"breakpoint": 1199,"settings":{"slidesToShow": ' . esc_attr($items_large_device) . '}},{"breakpoint": 768,"settings":{"slidesToShow": 2}},{"breakpoint": 576,"settings":{"slidesToShow": ' . esc_attr($items_mobile_device) . '}}]' : '';

            $data_slick = '{' . $res_large . '"arrows":' . esc_attr($navigation) . ',"dots":' . esc_attr($dots) . ',"infinite":' . esc_attr($loop) . ',"autoplay":' . esc_attr($autoplay) . '' . $res_media . '}';
        }



        $img_size = explode('x', $img_size);






        $args = array(
            'posts_per_page' => esc_attr($post_per_page),
            'post_type' => PIKO_PORTFOLIO_POST_TYPE,
            'order' => esc_attr($order),
            'orderby' => esc_attr($orderby),
            'post_status' => 'publish'
        );


        $posts_array = new WP_Query($args);


        ?>
    <div class="<?php echo esc_attr($css_class); ?>">
        <div class="<?php echo esc_attr($slide_class) ?>" data-slick='<?php echo  $data_slick; ?>'>

            <?php while ($posts_array->have_posts()) : $posts_array->the_post();






                ?>

                <div class="portfolio-item pt-overlay pt-meta pt-content fahison ">
                    <figure>
                        <a href="<?php echo get_permalink(get_the_ID()) ?>" class="overlay">
                            <?php echo get_the_post_thumbnail(get_the_ID(), $img_size); ?>
                        </a>
                        <figcaption class="pa c-center text-center">
                            <a href="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?>" data-thumb="<?php echo get_the_post_thumbnail_url() ?>" class="zoom-btn"><i class="icon-search"></i></a>
                        </figcaption>
                    </figure>
                    <h3 class="portfolio-title">
                        <a href="<?php echo get_permalink(get_the_ID()) ?>"><?php echo get_the_title() ?></a>

                        <?php
                        $meta_values = get_post_meta(get_the_ID(), 'portfolio-format-gallery', false);
                        $photo = esc_html__('Photos', 'pikoworks-core');
                        if (count($meta_values) > 0) :
                            $index = 0;
                            foreach ($meta_values as $image) :
                                $index++;
                            endforeach;
                            echo '<em>' . $index . ' ' . $photo . '</em>';
                        else :
                            echo '<em>1 ' . $photo . '</em>';
                        endif;
                        ?>
                    </h3>
                </div>

            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <script type="text/javascript">
        (function($) {
            "use strict";
            $(document).ready(function() {
                $('.popup-gallery').lightGallery({
                    selector: '.zoom-btn',
                    thumbnail: true,
                    exThumbImage: 'data-thumb',
                    download: false,
                    thumbWidth: 80,
                    thumbContHeight: 80
                });

            });
        })(jQuery);
    </script>
    <?php

    $result = ob_get_contents();
    ob_clean();
    return $result;
}
}

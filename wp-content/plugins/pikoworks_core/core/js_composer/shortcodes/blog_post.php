<?php

/**
 * @blog post
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
add_action('init', 'pikoworks_blog_post');
function pikoworks_blog_post()
{
    // Setting shortcode lastest
    $params = array(
        "name"        => esc_html__("Blog Post", 'pikoworks_core'),
        "base"        => "pikoworks_blog_post",
        "category"    => esc_html__('Pikoworks', 'pikoworks_core'),
        "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
        "description" => esc_html__("Show blog posts", 'pikoworks_core'),
        'params'      => array_merge(array(
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('News style', 'pikoworks_core'),
                'param_name'    => 'type',
                'value' => array(
                    esc_html__('Lyaout 1', 'pikoworks_core') => '1',
                    esc_html__('Layout 2', 'pikoworks_core') => '2',
                    esc_html__('Layout 3', 'pikoworks_core') => '3',
                ),
                'std'           => '1',
                'admin_label' => true,
            ),
            array(
                "type"        => "pikoworks_number",
                "heading"     => esc_html__("Number Post load", 'pikoworks_core'),
                "param_name"  => "number",
                "value"       => 7,
                'admin_label' => true,
                "description" => esc_html__('Enter number of Product if you use "-1" load all product load. or Enter specific as you want like as 7, 8,10...', 'pikoworks_core')
            ),
            array(
                "type"       => "dropdown",
                "heading"    => esc_html__("Image Size", 'pikoworks_core'),
                "param_name" => "size",
                "value"      => array(
                    esc_html__('1770x780px', 'pikoworks_core')     => 'xtocky-image-full-width',
                    esc_html__('870x580px', 'pikoworks_core')       => 'xtocky-image-sidebar',
                    esc_html__('400x267px', 'pikoworks_core')   => 'xtocky-medium-image',
                    esc_html__('570x315px', 'pikoworks_core')     => 'xtocky-2cols-image',
                    esc_html__('370x247px', 'pikoworks_core')     => 'xtocky-3cols-image',
                    esc_html__('255x147px', 'pikoworks_core') => 'xtocky-4cols-image',
                    esc_html__('340x300px', 'pikoworks_core') => 'xtocky-s340',
                    esc_html__('370x450px', 'pikoworks_core') => 'xtocky-s370',
                ),
                'std'         => 'xtocky-3cols-image',
                'admin_label' => true,
            ),
            array(
                "type"       => "dropdown",
                "heading"    => esc_html__("Order by", 'pikoworks_core'),
                "param_name" => "orderby",
                "value"      => array(
                    esc_html__('None', 'pikoworks_core')     => 'none',
                    esc_html__('ID', 'pikoworks_core')       => 'ID',
                    esc_html__('Author', 'pikoworks_core')   => 'author',
                    esc_html__('Name', 'pikoworks_core')     => 'name',
                    esc_html__('Date', 'pikoworks_core')     => 'date',
                    esc_html__('Modified', 'pikoworks_core') => 'modified',
                    esc_html__('Rand', 'pikoworks_core')     => 'rand',
                ),
                'std'         => 'date',
                'admin_label' => true,
                "description" => esc_html__("Select how to sort retrieved posts.", 'pikoworks_core')
            ),
            array(
                "type"       => "dropdown",
                "heading"    => esc_html__("Order", 'pikoworks_core'),
                "param_name" => "order",
                "value"      => array(
                    esc_html__('Descending', 'pikoworks_core') => 'DESC',
                    esc_html__('Ascending', 'pikoworks_core')  => 'ASC'
                ),
                'std'         => 'DESC',
                'admin_label' => true,
                "description" => esc_html__("Designates the ascending or descending order.", 'pikoworks_core')
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'excerpt',
                'heading' => esc_html__('Excerpt word', 'pikoworks_core'),
                'description' => esc_html__('Default use Excerpt 25 words ', 'pikoworks_core'),
                'value' => '25',
                'admin_label' => true,
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Show Read More Button', 'pikoworks_core'),
                'param_name'    => 'show_read_more_btn',
                'admin_label' => true,
                'value' => array(
                    esc_html__('Yes', 'pikoworks_core') => 'yes',
                    esc_html__('No', 'pikoworks_core') => 'no',
                ),
                'std'           => 'no',
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Read More Button Text', 'pikoworks_core'),
                'param_name'    => 'read_more_text',
                'std'           => esc_html__('Read more', 'pikoworks_core'),
                'dependency' => array(
                    'element'   => 'show_read_more_btn',
                    'value'     => array('yes'),
                ),
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__("Extra class name", 'pikoworks_core'),
                "param_name"  => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
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
class WPBakeryShortCode_pikoworks_blog_post extends WPBakeryShortCode
{

    protected function content($atts, $content = null)
    {
        $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('pikoworks_blog_post', $atts) : $atts;
        $atts = shortcode_atts(array(
            'type' => '1',
            'number' => 7,
            'size' => 'xtocky-3cols-image',
            'order' => 'DESC',
            'orderby' => 'date',
            'excerpt'   => '25',
            'show_read_more_btn' =>  'no',
            'read_more_text'  =>  '',

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


        ), $atts);
        extract($atts);
        $css_class = 'sc-blog hsc sip sc-bl-' . $type . ' ' . $el_class;
        if (function_exists('vc_shortcode_custom_css_class')) :
            $css_class .= ' ' . apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '), '', $atts);
        endif;

        $show_read_more_btn = trim($show_read_more_btn) == 'yes';
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'orderby' => esc_attr($orderby),
            'order'   => esc_attr($order),
            'posts_per_page' => esc_attr($number),
        );

        $query = new WP_Query($args);


        ob_start();
        if ($query->have_posts()) :

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
            if ($is_slider == 'yes' && $use_responsive == '0' || pikoworks_is_mobile()) {
                $col_class = 'col-xs-12';
            }


            if (pikoworks_is_mobile()) {
                $navigation = 'false';
                $dots = 'true';
            }


            $slide_class = 'piko-carousel-grid row';
            $data_slick = '';
            if ($is_slider == 'yes' || pikoworks_is_mobile()) {
                $slide_class = 'piko-carousel' . ' ' . $navigation_btn . ' ' . $btn_light . ' ' . $btn_hover_show . ' ' . $margin;

                $res_large = $use_responsive ? '"slidesToShow":' . esc_attr($items_very_large_device) . ', "slidesToScroll": 1,' : '';
                $res_media = $use_responsive ? ',"responsive":[{"breakpoint": 1200,"settings":{"slidesToShow":' . esc_attr($items_large_device) . '}},{"breakpoint": 1024,"settings":{"slidesToShow": 3}},{"breakpoint": 768,"settings":{"slidesToShow": 2}},{"breakpoint": 576,"settings":{"slidesToShow": 1}}]' : '';

                $data_slick = '{' . $res_large . '"arrows":' . esc_attr($navigation) . ',"dots":' . esc_attr($dots) . ',"infinite":' . esc_attr($loop) . ',"autoplay":' . esc_attr($autoplay) . $res_media . '}';
            }


            ?>
        <div class="<?php echo esc_attr($css_class) ?>">
            <div class="<?php echo esc_attr($slide_class) ?>" data-slick='<?php echo  $data_slick; ?>'>
                <?php
                while ($query->have_posts()) : $query->the_post(); ?>
                    <article class="<?php echo $col_class; ?>">
                        <?php if ($type == '1') : ?>
                            <div class="entry entry-grid">
                                <figure class="entry-media">
                                    <?php $thumbnail = xtocky_post_format($size);
                                    if (!empty($thumbnail)) : ?>
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    <?php endif; ?>
                                </figure>
                                <div class="entry-content-wrapper">
                                    <?php if ($excerpt == 0) : ?>
                                        <div class="mt25">
                                            <?php xtocky_grid_blog_meta(); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" data-rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

                                    <?php if ($excerpt != 0) : ?>
                                        <?php xtocky_grid_blog_meta(); ?>
                                        <div class="entry-content">
                                            <?php
                                            if (!has_excerpt()) {
                                                echo '<p>' . wp_trim_words(get_the_content(), esc_attr($excerpt), ' ... ') . '</p>';
                                            } else {
                                                echo '<p>' . wp_trim_words(the_excerpt(), esc_attr($excerpt), ' ... ')  . '</p>';
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($show_read_more_btn && trim($read_more_text) != '') : ?>
                                        <a href="<?php the_permalink(); ?>" class="block_read_more" data-rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo sanitize_text_field($read_more_text); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php elseif ($type == '2') : ?>
                            <div class="entry entry-grid b1">
                                <figure class="entry-media">
                                    <?php $thumbnail = xtocky_post_format($size);
                                    if (!empty($thumbnail)) : ?>
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    <?php endif; ?>
                                    <?php xtocky_entry_masonry_footer(); ?>
                                </figure>
                                <div class="entry-content-wrapper">
                                    <?php xtocky_entry_header(); ?>
                                    <div class="entry-content">
                                        <?php
                                        if (!has_excerpt()) {
                                            echo '<p>' . wp_trim_words(get_the_content(), esc_attr($excerpt), ' ... ') . '</p>';
                                        } else {
                                            echo '<p>' . wp_trim_words(get_the_excerpt(), esc_attr($excerpt), ' ... ') .  '</p>';
                                        }
                                        ?>
                                    </div><!-- End .entry-content -->
                                    <?php if ($show_read_more_btn && trim($read_more_text) != '') : ?>
                                        <a href="<?php the_permalink(); ?>" class="block_read_more" data-rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo sanitize_text_field($read_more_text); ?></a>
                                    <?php endif; ?>
                                </div><!-- end .entry-content-wrapper -->
                            </div>
                        <?php else : ?>
                            <div class="entry entry-grid b1">
                                <div class="row">
                                    <figure class="entry-media col-md-6">
                                        <?php $thumbnail = xtocky_post_format($size);
                                        if (!empty($thumbnail)) : ?>
                                            <?php echo wp_kses_post($thumbnail); ?>
                                        <?php endif; ?>
                                    </figure>
                                    <div class="entry-content-wrapper col-md-6">
                                        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" data-rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                                        <?php xtocky_grid_blog_meta(); ?>
                                        <div class="entry-content">
                                            <?php
                                            if (!has_excerpt()) {
                                                echo '<p>' . wp_trim_words(get_the_content(), esc_attr($excerpt), ' ... ') . '</p>';
                                            } else {
                                                echo '<p>' . wp_trim_words(get_the_excerpt(), esc_attr($excerpt), ' ... ') .  '</p>';
                                            }
                                            ?>
                                        </div><!-- End .entry-content -->
                                        <?php if ($show_read_more_btn && trim($read_more_text) != '') : ?>
                                            <a href="<?php the_permalink(); ?>" class="block_read_more" data-rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo sanitize_text_field($read_more_text); ?></a>
                                        <?php endif; ?>
                                    </div><!-- end .entry-content-wrapper -->
                                </div>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endwhile; // end of the loop.
                ?>
            </div>
        </div>
    <?php

    endif;

    wp_reset_postdata();
    wp_reset_query();
    $result = ob_get_contents();
    ob_clean();
    return $result;
}
}

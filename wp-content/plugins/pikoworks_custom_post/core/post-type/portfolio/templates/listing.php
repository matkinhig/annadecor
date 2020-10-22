<?php
/**
 * Custom post
 * @author themepiko
 */
$args = array(
    'offset' => esc_attr($offset),
    'orderby' => 'post__in',
    'post__in' => explode(",", $portfolio_ids),
    'posts_per_page' => esc_attr($post_per_page),
    'post_type' => PIKO_PORTFOLIO_POST_TYPE,
    'post_status' => 'publish');

if ($data_source == '') {
    $args = array(
        'offset' => esc_attr($offset),
        'posts_per_page' => esc_attr($post_per_page),
        'orderby' => 'post_date',
        'order' => esc_attr($order),
        'post_type' => PIKO_PORTFOLIO_POST_TYPE,
        PIKO_PORTFOLIO_CATEGORY_TAXONOMY => strtolower($category),
        'post_status' => 'publish');
}

$posts_array = new WP_Query($args);
$total_post = $posts_array->found_posts;
$col_class = '';
if ($data_section_id == '')
    $data_section_id = uniqid();
?>
<div class="portfolio-container">
    <div class="<?php echo esc_attr( $css_class) ?> "
        id="portfolio-<?php echo esc_attr($data_section_id) ?>" >
        <?php if ($show_category != '') { ?>
            <div class="portfolio-tabs <?php if($show_category!=''){ echo 'category ';} ?>">
                <?php
                if ($show_category != '') {
                    $termIds = array();
                    $portfolio_terms = get_terms(PIKO_PORTFOLIO_CATEGORY_TAXONOMY);
                    if ($category != '') {
                        $slugSelected = explode(',', $category);
                        foreach ($portfolio_terms as $term) {
                            if (in_array($term->slug, $slugSelected))
                                $termIds[$term->term_id] = $term->term_id;
                        }
                    }
                    $array_terms = array(
                        'include' => $termIds
                    );
                    $terms = get_terms(PIKO_PORTFOLIO_CATEGORY_TAXONOMY, $array_terms);

                    if (count($terms) > 0) {
                        $index = 1;
                        ?>
                        <div class="tab-wrapper <?php echo esc_attr($show_category) ?>">
                            <ul id="portfolio-filter">
                                <li class="active">
                                    <a class="isotope-portfolio ladda-button tab-btn active"
                                       data-section-id="<?php echo esc_attr($data_section_id) ?>"
                                       data-load-type="<?php echo esc_attr($tab_category_action) ?>"
                                       data-category=""
                                       data-overlay-style="<?php echo esc_attr($overlay_style) ?>"
                                       data-source="<?php echo esc_attr($data_source) ?>"
                                       data-portfolio-ids="<?php echo esc_attr($portfolio_ids) ?>"
                                       data-group="all" data-filter="*"
                                       data-layout-type="<?php echo esc_attr($layout_type) ?>"
                                       data-current-page="1"
                                       data-offset="<?php echo esc_attr($offset) ?>"
                                       data-post-per-page="<?php echo esc_attr($post_per_page) ?>"
                                       data-order="<?php echo esc_attr($order) ?>"
                                       data-column="<?php echo esc_attr($column) ?>"
                                       data-show-paging="<?php echo esc_attr($show_pagging) ?>"
                                       data-style="zoom-out" data-spinner-color="#fff"
                                       href="javascript:void(0)">
                                        <?php echo esc_html__('All', 'pikoworks_custom_post') ?>
                                    </a>
                                </li>
                                <?php
                                foreach ($terms as $term) {
                                    ?>
                                    <li class="<?php if ($index == count($terms)) {
                                        echo "last";
                                    } ?>">
                                        <a class="isotope-portfolio ladda-button tab-btn"
                                           href="javascript:void(0)" data-section-id="<?php echo esc_attr($data_section_id) ?>"
                                           data-load-type="<?php echo esc_attr($tab_category_action) ?>"
                                           data-category="<?php echo esc_attr($term->slug) ?>"
                                           data-overlay-style="<?php echo esc_attr($overlay_style) ?>"
                                           data-source="<?php echo esc_attr($data_source) ?>"
                                           data-portfolio-ids="<?php echo esc_attr($portfolio_ids) ?>"
                                           data-layout-type="<?php echo esc_attr($layout_type) ?>"
                                           data-current-page="1"
                                           data-offset="<?php echo esc_attr($offset) ?>"
                                           data-post-per-page="<?php echo esc_attr($post_per_page) ?>"
                                           data-column="<?php echo esc_attr($column) ?>"
                                           data-order="<?php echo esc_attr($order) ?>"
                                           data-group="<?php echo preg_replace('/\s+/', '', $term->slug) ?>"
                                           data-show-paging="<?php echo esc_attr($show_pagging) ?>"
                                           data-filter=".<?php echo esc_attr($term->slug) ?>"
                                           data-style="zoom-out"
                                           data-spinner-color="#45bf55">
                                            <?php echo wp_kses_post($term->name) ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                    <?php
                    }
                }
                ?>
            </div>
        <?php }
        
        ?>
        <div class="portfolio-item-container popup-gallery max-col-<?php echo esc_attr($column); ?>" data-layoutmode="fitRows"
            data-section-id="<?php echo esc_attr($data_section_id) ?>"
            id="portfolio-container-<?php echo esc_attr($data_section_id) ?>"
            data-columns="<?php echo esc_attr($column) ?>">
            <?php
            $index = 0;

            while ($posts_array->have_posts()) : $posts_array->the_post();
                $index++;
                $permalink = get_permalink();
                $title_post = get_the_title();
                $terms = wp_get_post_terms(get_the_ID(), array(PIKO_PORTFOLIO_CATEGORY_TAXONOMY));
                $cat = $cat_filter = '';
                foreach ($terms as $term) {
                    $cat_filter .= $term->slug . ' ';
                    $cat .= $term->name . ', ';
                }
                $cat = rtrim($cat, ', ');
                
               

                ?>

                <?php
                include(plugin_dir_path(__FILE__) . '/loop/' . esc_attr($layout_type). '-item.php');
                ?>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>

        </div>
        <?php if ($show_pagging == '1' && $post_per_page > 0 && $total_post / $post_per_page > 1 && $total_post > ($post_per_page * $current_page)) { ?>
            <div style="clear: both"></div>
            <div class="paging" id="load-more-<?php echo esc_attr($data_section_id) ?>">
                <a href="javascript:void(0)" class="piko-button style1 ladda-button "
                   data-source="<?php echo esc_attr($data_source) ?>"
                   data-tab-category-action="<?php echo esc_attr($tab_category_action) ?>"
                   data-load-type="<?php echo esc_attr($tab_category_action) ?>"
                   data-overlay-style="<?php echo esc_attr($overlay_style) ?>"
                   data-category="<?php echo esc_attr($category) ?>"
                   data-portfolio-ids="<?php echo esc_attr($portfolio_ids) ?>"
                   data-section-id="<?php echo esc_attr($data_section_id) ?>"
                   data-current-page="<?php echo esc_attr($current_page + 1) ?>"
                   data-column="<?php echo esc_attr($column); ?>"
                   data-offset="<?php echo esc_attr($offset) ?>"
                   data-current-page="<?php echo esc_attr($current_page) ?>"
                   data-post-per-page="<?php echo esc_attr($post_per_page) ?>"
                   data-show-paging="<?php echo esc_attr($show_pagging) ?>"
                   data-padding="<?php echo esc_attr($padding) ?>"
                   data-layout-type="<?php echo esc_attr($layout_type) ?>"
                   data-order="<?php echo esc_attr($order) ?>"
                   data-style="zoom-out" data-spinner-color="#fff"
                    ><?php esc_html_e('Load more', 'pikoworks_custom_post') ?></a>
            </div>
        <?php } ?>
    </div>
</div>
<?php if (isset($ajax_load) && $ajax_load == '0') { ?>
    <script type="text/javascript">
        (function ($) {
            "use strict";
            <?php if($show_pagging!='2') {?>
            $(document).ready(function () {
                <?php if(isset($tab_category_action) && $tab_category_action=='filter') { ?>
                var $tab_container = jQuery('#portfolio-<?php echo esc_attr($data_section_id); ?>');
                $('.portfolio-tabs .isotope-portfolio', $tab_container).off();
                $('.portfolio-tabs .isotope-portfolio', $tab_container).click(function () {
                    $('.portfolio-tabs .isotope-portfolio', $tab_container).removeClass('active');
                    $('.portfolio-tabs li', $tab_container).removeClass('active');
                    $(this).addClass('active');
                    $(this).parent().addClass('active');
                    var dataSectionId = $(this).attr('data-section-id');
                    var filter = $(this).attr('data-filter');
                    var $container = jQuery('div[data-section-id="' + dataSectionId + '"]').isotope({ filter: filter});
                    $container.imagesLoaded(function () {
                        $container.isotope('layout');
                    });
                });
                var $container = jQuery('div[data-section-id="<?php echo esc_attr($data_section_id); ?>"]');
                $container.imagesLoaded(function () {
                    $container.isotope({
                        itemSelector: '.portfolio-item'
                    }).isotope('layout');
                });
                <?php } ?>
            });

            <?php } ?>

            $(document).ready(function () {
                $('.popup-gallery').lightGallery({
                    selector: '.zoom-btn',
                    thumbnail:true,
                    exThumbImage: 'data-thumb',
                    download: false,
                    thumbWidth: 80,
                    thumbContHeight: 80
                });            
                
            });

        })(jQuery);
    </script>
<?php } ?>



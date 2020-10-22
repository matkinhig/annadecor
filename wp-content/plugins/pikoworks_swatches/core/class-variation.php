<?php

/**
 * variation swatch product
 * themepiko
 */
class Pikoworks_VS_Core {

    public function init() {


        global $thepostid, $wc_product_attributes;

        $attributes = maybe_unserialize(get_post_meta($thepostid, '_product_attributes', true));
        add_action('admin_enqueue_scripts', array($this, 'register_scripts'));

        if (is_array($attributes)) {
            foreach ($attributes as $key => $val) {
                if ($val) {
                    add_action($key . '_add_form_fields', array($this, 'add_attribute_fields'));
                    add_action($key . '_edit_form_fields', array($this, 'edit_attribute_fields'), 10);
                    add_action('created_term', array($this, 'save_attribute_fields'), 10, 3);
                    add_action('edit_term', array($this, 'save_attribute_fields'), 10, 3);
                }
            }
        }
        add_action('add_meta_boxes', array($this, 'add_gallery_meta_boxes'), 30);

        add_action('woocommerce_process_product_meta', array($this, 'meta_save_image'), 20, 2);


        add_action('wp_ajax_vs_gallery_image', array($this, 'vs_gallery_image'));
        add_action("wp_ajax_nopriv_vs_gallery_image", array($this, 'vs_gallery_image'));

        add_action('woocommerce_product_write_panel_tabs', array($this, 'create_admin_tab'));
        add_action('woocommerce_product_data_panels', array($this, 'create_admin_tab_content'));
        add_action('woocommerce_process_product_meta', array($this, 'save_product_attribute'), 1);


        //list for loop
        $vs_options = get_option('pikoworks_vs_option');
        if ($vs_options['attribute_product_loop_position'] == 'inside-product_image') {
            add_action('woocommerce_before_shop_loop_item_title', array($this, 'wc_list_loop_attribute'), 11);
        } elseif ($vs_options['attribute_product_loop_position'] == 'above-product-title') {
            add_action('woocommerce_after_shop_loop_item_title', array($this, 'wc_list_loop_attribute'), 11);
        } else {
            add_action('woocommerce_after_shop_loop_item_title', array($this, 'wc_list_loop_attribute'), 11);
        }

        add_action('woocommerce_product_query', array($this, 'vs_wc_product_query'), 55);

        //add product setting
    }

    public function register_scripts() {
        wp_enqueue_script('media-upload');
        wp_enqueue_style('vs_admin', PIKOWORKS_VS_URI . '/assets/css/admin.css');
        wp_enqueue_script('vs_admin', PIKOWORKS_VS_URI . '/assets/js/admin.js');
        wp_enqueue_media();
    }

    public function add_attribute_fields() {
        ?>
        <div class="form-field">
            <label><?php _e('Thumbnail', 'pikoworks_vs'); ?></label>
            <div id="product_cat_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" width="60px" height="60px" /></div>
            <div style="line-height: 60px;">
                <input type="hidden" name="is_attribute" value="1">
                <input type="hidden" id="product_attribute_thumbnail_id" name="product_attribute_thumbnail_id" />
                <button type="button" class="upload_image_button button"><?php esc_html_e('Add image', 'pikoworks_vs'); ?></button>
                <button type="button" class="remove_image_button button"><?php esc_html_e('Remove image', 'pikoworks_vs'); ?></button>
            </div>
            <script type="text/javascript">
                (function ($) {
                    "use strict";
                    // Only show the "remove image" button when needed

                    if (!$('#product_attribute_thumbnail_id').val()) {
                        $('.remove_image_button').hide();
                    }
                    // Uploading files
                    var file_frame;
                    $(document).ready(function () {
                        $(document).on('click', '.upload_image_button', function (event) {

                            event.preventDefault();

                            // If the media frame already exists, reopen it.
                            if (file_frame) {
                                file_frame.open();
                                return;
                            }

                            // Create the media frame.
                            file_frame = wp.media.frames.downloadable_file = wp.media({
                                title: '<?php esc_attr_e('Choose an image', 'pikoworks_vs'); ?>',
                                button: {
                                    text: '<?php esc_attr_e('Use image', 'pikoworks_vs'); ?>'
                                },
                                multiple: false
                            });

                            // When an image is selected, run a callback.
                            file_frame.on('select', function () {
                                var attachment = file_frame.state().get('selection').first().toJSON();
                                $('#product_attribute_thumbnail_id').val(attachment.id);
                                $('#product_cat_thumbnail img').attr('src', attachment.url);
                                $('.remove_image_button').show();
                            });

                            // Finally, open the modal.
                            file_frame.open();
                        });

                        $(document).on('click', '.remove_image_button', function () {
                            $('#product_cat_thumbnail img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                            $('#product_attribute_thumbnail_id').val('');
                            $('.remove_image_button').hide();
                            return false;
                        });
                    })
                })(jQuery);

            </script>
            <div class="clear"></div>
        </div>
        <?php
    }

    public function edit_attribute_fields($term) {
        $thumbnail_id = absint(get_term_meta($term->term_id, 'thumbnail_id', true));
        if ($thumbnail_id) {
            $image = wp_get_attachment_thumb_url($thumbnail_id);
        } else {
            $image = wc_placeholder_img_src();
        }
        ?>

        <tr class="form-field">
            <th scope="row" valign="top"><label><?php _e('Thumbnail', 'pikoworks_vs'); ?></label></th>
            <td>
                <div id="product_cat_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url($image); ?>" width="60px" height="60px" /></div>
                <div style="line-height: 60px;">
                    <input type="hidden" name="is_attribute" value="1">
                    <input type="hidden" id="product_attribute_thumbnail_id" name="product_attribute_thumbnail_id" value="<?php echo esc_attr($thumbnail_id); ?>" />
                    <button type="button" class="upload_image_button button"><?php esc_html_e('Add image', 'pikoworks_vs'); ?></button>
                    <button type="button" class="remove_image_button button"><?php esc_html_e('Remove image', 'pikoworks_vs'); ?></button>
                </div>
                <script type="text/javascript">
                    (function ($) {
                        "use strict";
                        // Only show the "remove image" button when needed
                        if ('0' === $('#product_attribute_thumbnail_id').val()) {
                            $('.remove_image_button').hide();
                        }

                        // Uploading files
                        var file_frame;
                        $(document).ready(function () {
                            $(document).on('click', '.upload_image_button', function (event) {

                                event.preventDefault();

                                // If the media frame already exists, reopen it.
                                if (file_frame) {
                                    file_frame.open();
                                    return;
                                }

                                // Create the media frame.
                                file_frame = wp.media.frames.downloadable_file = wp.media({
                                    title: '<?php esc_attr_e('Choose an image', 'pikoworks_vs'); ?>',
                                    button: {
                                        text: '<?php esc_attr_e('Use image', 'pikoworks_vs'); ?>'
                                    },
                                    multiple: false
                                });

                                // When an image is selected, run a callback.
                                file_frame.on('select', function () {
                                    var attachment = file_frame.state().get('selection').first().toJSON();

                                    $('#product_attribute_thumbnail_id').val(attachment.id);

                                    $('#product_cat_thumbnail img').attr('src', attachment.url);
                                    $('.remove_image_button').show();
                                });

                                // Finally, open the modal.
                                file_frame.open();
                            });

                            $(document).on('click', '.remove_image_button', function () {
                                $('#product_cat_thumbnail img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                                $('#product_attribute_thumbnail_id').val('');
                                $('.remove_image_button').hide();
                                return false;
                            });
                        })
                    })(jQuery);

                </script>
                <div class="clear"></div>
            </td>
        </tr>
        <?php
    }

    public function save_attribute_fields($term_id, $tt_id = '', $taxonomy = '') {
        if (isset($_POST['product_attribute_thumbnail_id']) && isset($_POST['is_attribute']) && $_POST['is_attribute'] == 1) {
            update_woocommerce_term_meta($term_id, 'thumbnail_id', absint($_POST['product_attribute_thumbnail_id']));
        }
    }

    public function add_setting_boxes() {
        global $post;
        $vs_value = get_post_meta($post->ID, 'vs_enable_product', true);
        if ($vs_value != 0) {
            $vs_value = 1;
        }

        $_wc_pf = new WC_Product_Factory();
        $product = $_wc_pf->get_product($post->ID);
        if ($product->is_type('variable')) {
            ?>
            <div class="vs-enable-button"><span class="dashicons dashicons-controls-repeat" style="padding-right:8px;margin-top:5px;color:#82878c"></span>
                <select name="vs_enable_variation" style="width:100px">
                    <option <?php echo selected(1, $vs_value) ?> value="1"><?php esc_html_e('Enable', 'pikoworks_vs'); ?></option>
                    <option <?php echo selected(0, $vs_value) ?> value="0"><?php esc_html_e('Disable', 'pikoworks_vs'); ?></option>
                </select>
            </div>
            <?php
        } else {
            return;
        }
    }

    public function wc_template_loop_product_thumbnail() {
        global $post;
        $_wc_pf = new WC_Product_Factory();
        $product = $_wc_pf->get_product($post->ID);
        $attributes = $product->get_attributes();
        $vs_options = get_option('pikoworks_vs_option');
        $vs_attr = $vs_options['attribute_image_select'];

        if (isset($attributes[$vs_attr])) {

            $vs_value = get_post_meta($product->get_id(), '_product_image_gallery_vs', true);

            if (!$vs_value && $product->is_type('variable')) {
                $variations = $product->get_available_variations();
                $vs_value = array();

                foreach ($variations as $variation) {
                    $id = $variation['variation_id'];
                    if (isset($variation['attributes']['attribute_' . $vs_attr])) {
                        if ($variation['image_src'] != '') {
                            $option = $variation['attributes']['attribute_' . $vs_attr];
                            $vari = new WC_Product_Variation($id);
                            $vs_value[$option] = $vari->get_image_id();
                        }
                    }
                }
            }
            if ($vs_value) {
                foreach ($vs_value as $option => $value) {

                    $attachment_ids = array_filter(explode(',', $value));
                    $html = '';



                    if (!empty($attachment_ids)) {
                        $attr = array('style' => "display:none;", 'swatch' => $option);
                        $post_thumbnail_id = (int) $attachment_ids[0];
                        $size = apply_filters('post_thumbnail_size', 'shop_catalog');
                        if ($post_thumbnail_id) {

                            do_action('begin_fetch_post_thumbnail_html', $post->ID, $post_thumbnail_id, $size);
                            if (in_the_loop())
                                update_post_thumbnail_cache();
                            $html = wp_get_attachment_image($post_thumbnail_id, $size, false, $attr);
                            do_action('end_fetch_post_thumbnail_html', $post->ID, $post_thumbnail_id, $size);
                        }
                        echo apply_filters('post_thumbnail_html', $html, $post->ID, $post_thumbnail_id, $size, $attr);
                    }
                }
            }
        }
    }

    public static function get_variation_image_id($term_id, $product_id = 0) {
        $attachment_id = absint(get_term_meta($term_id, 'thumbnail_id', true));
        if ($product_id) {
            $vs_product_id = get_post_meta($product_id, 'vs_product_id', true);
            if (is_array($vs_product_id)) {
                foreach ($vs_product_id as $attribute => $term) {
                    if (isset($term[$term_id]) && $term[$term_id] > 0) {
                        $attachment_id = $term[$term_id];
                    }
                }
            }
        }
        $image = false;

        if ((int) $attachment_id == 0) {
            // start get global image
            $attachment_id = absint(get_term_meta($term_id, 'thumbnail_id', true));
            //end global image
        }
        if ((int) $attachment_id > 0) {
            $image = wp_get_attachment_thumb_url($attachment_id);
        }
        return $image;
    }

    public function save_product_attribute($post_id) {
        $vs_attr = array();
        if (isset($_POST['product_vs'])) {
            $vs_attr = $_POST['product_vs'];
        }
        update_post_meta($post_id, 'vs_product_id', $vs_attr);
    }

    public function create_admin_tab() {
        global $post;
        $vs_value = get_post_meta($post->ID, 'vs_enable_product', true);
        if ($vs_value == 1) {
            ?>
            <li class="vs_options">
                <a href="#pikowroks_vs_tab_data">
                    <?php esc_html_e('Variation Swatches', 'pikoworks_vs'); ?>
                </a>
            </li>

            <?php
        }
    }

    public function create_admin_tab_content() {
        global $post, $thepostid, $wc_product_attributes;
        $vs_value = get_post_meta($post->ID, 'vs_enable_product', true);

        if ($vs_value == 1) {
            $attributes = maybe_unserialize(get_post_meta($thepostid, '_product_attributes', true));
            ?>
            <div id="pikowroks_vs_tab_data" class="panel woocommerce_options_panel">
                <?php
                foreach ($attributes as $attr => $val):


                    $attribute = $attributes[$attr];
                    $position = empty($attribute['position']) ? 0 : absint($attribute['position']);
                    $taxonomy = '';
                    $metabox_class = array();

                    if ($attribute['is_taxonomy']) {
                        $taxonomy = $attribute['name'];

                        if (!taxonomy_exists($taxonomy)) {
                            continue;
                        }

                        $attribute_taxonomy = $wc_product_attributes[$taxonomy];
                        $metabox_class[] = 'taxonomy';
                        $metabox_class[] = $taxonomy;
                        $attribute_label = wc_attribute_label($taxonomy);
                        $all_terms = get_terms($taxonomy, 'orderby=name&hide_empty=0');
                    }
                    $vs_product_id = get_post_meta($post->ID, 'vs_product_id', true);

                    if ($attribute['is_taxonomy']):
                        ?>
                        <div class="options_group vs_group">
                            <h2><strong><?php echo sanitize_text_field($attribute_label); ?></strong></h2>
                            <?php foreach ($all_terms as $term): ?>
                                <?php
                                if (isset($vs_product_id[esc_attr($taxonomy)][$term->term_id]) && $thumbnail_id = $vs_product_id[esc_attr($taxonomy)][$term->term_id]) {

                                    $image = wp_get_attachment_thumb_url($thumbnail_id);
                                } else {
                                    $image = wc_placeholder_img_src();
                                }
                                ?>
                                <?php if (has_term(absint($term->term_id), $taxonomy, $thepostid)): ?>
                                    <span class="form-field">
                                        <div  class="vs-attribute-img">
                                            <label><strong><?php echo sanitize_text_field($term->name); ?></strong></label>
                                            <img src="<?php echo esc_url($image); ?>" width="60px" height="60px">
                                            <input type="hidden" name="is_attribute" value="1">
                                            <input type="hidden" id="product_attribute_thumbnail_id" value="<?php echo isset($vs_product_id[esc_attr($taxonomy)][$term->term_id]) ? $vs_product_id[esc_attr($taxonomy)][$term->term_id] : ''; ?>" name="product_vs[<?php echo esc_attr($taxonomy); ?>][<?php echo absint($term->term_id); ?>]" />
                                            <button type="button" class="vs_upload_image_button button"><?php esc_html_e('Add image', 'pikoworks_vs'); ?></button>
                                            <button style="<?php if ($image == wc_placeholder_img_src()): ?>display: none;<?php endif; ?>" type="button" class="remove_image_button button"><?php _e('Remove image', 'pikoworks_vs'); ?></button>
                                        </div>
                                    </span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <script type="text/javascript">
                            (function ($) {
                                "use strict";
                                // Uploading files

                                $(document).on('click', '.vs_upload_image_button', function (event) {
                                    var current = $(this);
                                    var product_attribute_thumbnail_id_input = current.closest('.vs-attribute-img').find('input#product_attribute_thumbnail_id');
                                    var image_thumb = current.closest('.vs-attribute-img').find('img');
                                    var removebtn = current.closest('.vs-attribute-img').find('.remove_image_button');
                                    var file_frame;
                                    if (!$(this).hasClass('opening'))
                                    {
                                        $(this).addClass('opening');
                                        event.preventDefault();

                                        // If the media frame already exists, reopen it.
                                        if (file_frame) {
                                            file_frame.open();
                                            return;
                                        }

                                        // Create the media frame.
                                        file_frame = wp.media.frames.downloadable_file = wp.media({
                                            title: '<?php esc_attr_e('Choose an image', 'pikoworks_vs'); ?>',
                                            button: {
                                                text: '<?php esc_attr_e('Use image', 'pikoworks_vs'); ?>'
                                            },
                                            multiple: false
                                        });

                                        // When an image is selected, run a callback.
                                        file_frame.on('select', function () {
                                            var attachment = file_frame.state().get('selection').first().toJSON();
                                            product_attribute_thumbnail_id_input.val(attachment.id);
                                            image_thumb.attr('src', attachment.url);
                                            removebtn.show();
                                            current.removeClass('opening');
                                        });

                                        // Finally, open the modal.
                                        file_frame.open();
                                    }

                                });

                                $(document).on('click', '.remove_image_button', function () {
                                    var current = $(this);
                                    var product_attribute_thumbnail_id_input = current.closest('.vs-attribute-img').find('input#product_attribute_thumbnail_id');
                                    var image_thumb = current.closest('.vs-attribute-img').find('img');
                                    var removebtn = current.closest('.vs-attribute-img').find('.remove_image_button');
                                    image_thumb.attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                                    product_attribute_thumbnail_id_input.val('');
                                    removebtn.hide();
                                    return false;
                                });
                            })(jQuery);
                        </script>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>
            <?php
        }
    }

    public function add_gallery_meta_boxes() {
        global $post;
        $_wc_pf = new WC_Product_Factory();
        $product = $_wc_pf->get_product($post->ID);


        if ($post->post_type == 'product' && $product->is_type('variable')) {

            add_meta_box('product-images-setting_vs', __('Enable Variation Swatches', 'pikoworks_vs'), array($this, 'add_setting_boxes'), 'product', 'side', 'high');
            $vs_options = get_option('pikoworks_vs_option');
            $vs_attr = $vs_options['attribute_image_select'];

            $attributes = $product->get_attributes();
            $vs_value = get_post_meta($post->ID, 'vs_enable_product', true);

            if ($vs_attr && isset($attributes[$vs_attr]) && $attributes[$vs_attr]['is_variation'] == 1 && $vs_value == 1) {
                $attribute = $attributes[$vs_attr];
                if ($attribute['is_taxonomy']) {

                    $values = wc_get_product_terms($product->get_id(), $attribute['name'], array('fields' => 'names'));
                } else {
                    $values = array_map('trim', explode(WC_DELIMITER, $attribute['value']));
                }

                foreach ($values as $val) {
                    $key = esc_attr($val);
                    add_meta_box('product-images-vs-' . $key, __('Product Gallery', 'pikoworks_vs') . '- ' . $val, array($this, 'gallery_meta_box_config'), 'product', 'side', 'low', $key);
                }
            }
        }
    }

    public function gallery_meta_box_config($post, $box) {
//        global $post;
        $attr = esc_attr(sanitize_title($box['args']));
        $vs_value = get_post_meta($post->ID, 'vs_enable_product', true);
        if ($vs_value == 1):
            ?>

            <div id="product_images_container_vs">
                <ul class="product_images_vs product_images_<?php echo esc_attr($attr); ?>">
                    <?php
                    if (metadata_exists('post', $post->ID, '_product_image_gallery_vs')) {
                        $vs_value = get_post_meta($post->ID, '_product_image_gallery_vs', true);
                        if (isset($vs_value[$attr])) {
                            $product_image_gallery_vs = $vs_value[$attr];
                        } else {
                            $product_image_gallery_vs = '';
                        }
                    } else {
                        $attachment_ids = array();
                        $product_image_gallery_vs = '';
                    }

                    $attachments = array_filter(explode(',', $product_image_gallery_vs));

                    if (!empty($attachments)) {
                        foreach ($attachments as $attachment_id) {
                            echo '<li class="image" data-attachment_id="' . esc_attr($attachment_id) . '">
								' . wp_get_attachment_image($attachment_id, 'thumbnail') . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . esc_attr__('Delete image', 'pikoworks_vs') . '">' . __('Delete', 'pikoworks_vs') . '</a></li>
								</ul>
							</li>';
                        }
                    }
                    ?>
                </ul>

                <input type="hidden" id="product_image_gallery_<?php echo esc_attr($attr); ?>" class="vs_product_image_gallery" name="product_image_gallery_vs[<?php echo esc_attr($attr); ?>]" value="<?php echo esc_attr($product_image_gallery_vs); ?>" />

            </div>
            <p class="add_product_images_vs hide-if-no-js">
                <a href="#" data-choose="<?php esc_attr_e('Add Images to Product Gallery', 'pikoworks_vs'); ?>" data-update="<?php esc_attr_e('Add to gallery', 'pikoworks_vs'); ?>" data-delete="<?php esc_attr_e('Delete image', 'pikoworks_vs'); ?>" data-text="<?php esc_attr_e('Delete', 'pikoworks_vs'); ?>"><?php esc_html_e('Add product gallery images', 'pikoworks_vs'); ?></a>
            </p>

            <?php
        endif;
    }

    public function meta_save_image($post_id, $post) {
        $attachment_ids = isset($_POST['product_image_gallery_vs']) ? $_POST['product_image_gallery_vs'] : array();
        update_post_meta($post_id, '_product_image_gallery_vs', $attachment_ids);
        $enable_variation = 0;
        if (isset($_POST['vs_enable_variation'])) {
            $enable_variation = (int) $_POST['vs_enable_variation'];
        }

        update_post_meta($post_id, 'vs_enable_product', $enable_variation);
    }

    public function vs_wc_product_query($q) {
        global $wpdb;

        $post_in = array();
        $check = false;


        if (!empty($post_in)) {
            $q->set('post__in', $post_in);
        } else {
            if ($check) {
                $sql = "SELECT ID FROM " . $wpdb->posts . "  WHERE post_type = 'product' AND post_status = 'publish' ";
                $rows = $wpdb->get_results($sql, ARRAY_A);
                foreach ($rows as $row) {
                    $post_in[] = $row['ID'];
                }
                $q->set('post__in', $post_in);
            }
        }
    }

    public function vs_gallery_image() { //gallery single product
        $productId = esc_attr($_POST['product_id']);
        $option = esc_attr($_POST['option']);
        $_wc_pf = new WC_Product_Factory();
        $product = $_wc_pf->get_product($productId);
        $attributes = $product->get_attributes();
        $vs_options = get_option('pikoworks_vs_option');
        $vs_attr = $vs_options['attribute_image_select'];
        $images = $thumb = '';
        $attachment_ids = array();
        if (isset($attributes[$vs_attr]) || $option == 'null') {
            $attribute = $attributes[$vs_attr];

            $vs_value = get_post_meta($productId, '_product_image_gallery_vs', true);
            if (isset($vs_value[$option]) || $option == 'null') {
                if ($option == 'null') {
                    $attachment_ids = $product->get_gallery_attachment_ids();
                } else {
                    $attachment_ids = explode(',', $vs_value[$option]);
                }

                //  attachment
                $attachment_ids = array_filter($attachment_ids);
                $attachment_count = count($attachment_ids);
                $thumb_layout = woomega_get_option_data('optn_woo_single_products_thumbnail', 'bottom');
                $rtl = '';
                if (is_rtl()) {
                    $rtl = '"rtl": true,';
                }

                if ($attachment_count > 0) {

                    // Get page variable option
                    $options = get_post_meta(get_the_ID(), '_custom_wc_options', true);
                    // Get product single thumbnail
                    $slick_attr = '';
                    $slick_class = array();
                    if ($thumb_layout != 'sticky') {
                        $slick_attr = 'data-slick=\'{"slidesToShow": 1, "slidesToScroll": 1,' . wp_kses_post($rtl) . '"arrows": false, "asNavFor": ".piko-nav", "fade":true}\'';
                        $slick_class[] = 'piko-thumb';
                        $slick_class[] = 'piko-carousel';
                    }
                    if ($thumb_layout == 'carousel') {
                        $slick_class[] = 'piko-carousel row';
                        $slick_attr = 'data-slick=\'{"slidesToShow": 4,"slidesToScroll": 1,' . wp_kses_post($rtl) . '"responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 3}},{"breakpoint": 576,"settings":{"slidesToShow": 2}}]}\'';
                    }
                    ?>
                    <figure class="woocommerce-product-gallery__wrapper <?php echo esc_attr(implode(' ', $slick_class)); ?>"  <?php echo wp_kses_post($slick_attr); ?>>
                        <?php
                        if ($attachment_ids) {
                            foreach ($attachment_ids as $attachment_id) {
                                $image_link = wp_get_attachment_url($attachment_id);
                                if (!$image_link)
                                    continue;

                                $image_title = esc_attr(get_the_title($attachment_id));
                                $image_caption = esc_attr(get_post_field('post_excerpt', $attachment_id));
                                $attr = array('alt' => $image_title);

                                $image = wp_get_attachment_image(
                                        $attachment_id, apply_filters('single_product_small_thumbnail_size', 'shop_single'), 0, $attr
                                );

                                echo apply_filters('woocommerce_single_product_image_thumbnail_html', sprintf('<div class="woocommerce-product-gallery__image piko-image-zoom oh"><a href="%s" title="%s" >%s</a></div>', $image_link, $image_caption, $image), $attachment_id, $productId);
                            }
                        }
                        ?>
                    </figure>

                    <?php
                    $nav_position = woomega_get_option_data('optn_woo_single_products_thumbnail', 'bottom');
                    if ($attachment_ids && $nav_position != ('sticky' || 'carousel')) {
                        ?>
                        <div class="piko-nav piko-carousel oh" data-slick='{"slidesToShow": 4,"slidesToScroll": 1,<?php echo wp_kses_post($rtl) ?>"arrows": false, "focusOnSelect": true,"asNavFor": ".piko-thumb", <?php if ($nav_position == 'left' || $nav_position == 'right') echo '"vertical": true,"verticalSwiping": true,'; ?> "responsive":[{"breakpoint": 991,"settings":{"slidesToShow": 3}},{"breakpoint": 576,"settings":{"slidesToShow": 4, "vertical":false,"verticalSwiping": false}}]}'>
                            <?php
                            foreach ($attachment_ids as $attachment_id) {
                                $image_link = wp_get_attachment_url($attachment_id);

                                if (!$image_link)
                                    continue;

                                $image_title = esc_attr(get_the_title($attachment_id));
                                $image_caption = esc_attr(get_post_field('post_excerpt', $attachment_id));

                                $image = wp_get_attachment_image($attachment_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'), 0, $attr = array(
                                    'title' => $image_title,
                                    'alt' => $image_title
                                ));

                                echo apply_filters('woocommerce_single_product_image_thumbnail_html', sprintf('<div>%s</div>', $image), $attachment_id, $productId);
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
            }
        }
        exit;
    }

    public function wc_list_loop_attribute() { // loop product list attribute
        global $post;
        $_wc_pf = new WC_Product_Factory();
        $product = $_wc_pf->get_product($post->ID);
        $attributes = $product->get_attributes();
        $vs_options = get_option('pikoworks_vs_option');
        $vs_attr = $vs_options['attribute_image_select'];
        if ($product->is_type('variable')) {
            $vs_value = get_post_meta($post->ID, 'vs_enable_product', true);
            if (isset($attributes[$vs_attr]) && $vs_value == 1) {
                $html = '';
                $vs_value = get_post_meta($product->get_id(), '_product_image_gallery_vs', true);
                $vs_value = is_array($vs_value) ? array_filter($vs_value) : array();
                $vs_value1 = array();
                if ($product->is_type('variable')) {

                    $variations = $product->get_available_variations();


                    foreach ($variations as $variation) {
                        $id = $variation['variation_id'];
                        if (isset($variation['attributes']['attribute_' . $vs_attr])) {
                            if (isset($variation['image_src']) && $variation['image_src'] != '') {
                                $option = $variation['attributes']['attribute_' . $vs_attr];
                                $vari = new WC_Product_Variation($id);
                                $vs_value1[$option] = $vari->get_image_id();
                            }
                        }
                    }
                }
                $vs_value = array_merge($vs_value1, $vs_value);

                $attribute = $attributes[$vs_attr];


                $slug = array();
                $ids = array();
                if ($attribute['is_taxonomy']) {

                    $values = wc_get_product_terms($product->get_id(), $attribute['name'], array('fields' => 'names'));
                    $slug = wc_get_product_terms($product->get_id(), $attribute['name'], array('fields' => 'slugs'));
                    $ids = wc_get_product_terms($product->get_id(), $attribute['name'], array('fields' => 'ids'));
                } else {
                    $values = array_map('trim', explode(WC_DELIMITER, $attribute['value']));
                }


                if (!empty($values)) {
                    $html .= '<div class="vs_product_list"><ul>';
                    $slug = array_values($slug);
                    $ids = array_values($ids);
                    foreach ($values as $key => $value) {
                        $image = '';
                        if (isset($slug[$key])) {
                            $sl = $slug[$key];
                            if (isset($vs_value[$sl])) {
                                $attachment_ids = array_filter(explode(',', $vs_value[$sl]));
                                if (!empty($attachment_ids)) {
                                    $post_thumbnail_id = (int) $attachment_ids[0];
                                    $size = apply_filters('post_thumbnail_size', 'shop_catalog');
                                    if ($post_thumbnail_id) {

                                        $vs_value_image = wp_get_attachment_image_src($post_thumbnail_id, $size);
                                        $image = $vs_value_image[0];
                                    }
                                }
                            }
                            $attr_bg_list = $this->get_variation_image_id($ids[$key], $product->get_id());
                            if (!$attr_bg_list) {
                                $thumbnail_id = absint(get_term_meta($ids[$key], 'thumbnail_id', true));
                                $attr_bg_list = wp_get_attachment_thumb_url($thumbnail_id);
                            }



                            $style = '';
                            if ($attr_bg_list) {
                                $style = "background: url('" . esc_url($attr_bg_list) . "'); background-size: cover; text-indent: -99em";
                            }
                            $html .= '<li><a href="javascript:void(0);" data-thumb="' . $image . '" style="' . wp_kses_post($style) . '">' . $value . '</a></li>';
                        } else {

                            $html .= '<li><a href="javascript:void(0);">' . $value . '</a></li>';
                        }
                    }
                    $html .= '</ul></div>';
                }

                echo balanceTags($html);
            }
        }
    }

}

$vs_value = new Pikoworks_VS_Core();
$vs_value->init();

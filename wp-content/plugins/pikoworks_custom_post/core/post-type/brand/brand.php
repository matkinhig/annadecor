<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
        exit;
}
if (!function_exists('pikoworks_create_taxonomy_brand')) {

        function pikoworks_create_taxonomy_brand()
        {
                // Taxonomy 
                $labels = array(
                        'name'              => esc_html__('Brands', 'pikoworks-core'),
                        'singular_name'     => esc_html__('Brand', 'pikoworks-core'),
                        'search_items'      => esc_html__('Search Brands', 'pikoworks-core'),
                        'all_items'         => esc_html__('All Brands', 'pikoworks-core'),
                        'parent_item'       => esc_html__('Parent Brand', 'pikoworks-core'),
                        'parent_item_colon' => esc_html__('Parent Brand:', 'pikoworks-core'),
                        'edit_item'         => esc_html__('Edit Brand', 'pikoworks-core'),
                        'update_item'       => esc_html__('Update Brand', 'pikoworks-core'),
                        'add_new_item'      => esc_html__('Add New Brand', 'pikoworks-core'),
                        'new_item_name'     => esc_html__('New Brand Name', 'pikoworks-core'),
                        'menu_name'         => esc_html__('Brands', 'pikoworks-core'),
                );
                $args = array(
                        'hierarchical'      => true,
                        'labels'            => $labels,
                        'show_ui'           => true,
                        'show_admin_column' => true,
                        'query_var'         => true,
                        'capabilities'      => array(
                                'manage_terms'      => 'manage_product_terms',
                                'edit_terms'         => 'edit_product_terms',
                                'delete_terms'  => 'delete_product_terms',
                                'assign_terms'         => 'assign_product_terms',
                        ),
                        'rewrite'           => array('slug' => 'brand'),
                );
                register_taxonomy('brand', array('product'), $args);
                flush_rewrite_rules();
        }
        add_action('init', 'pikoworks_create_taxonomy_brand');
}






if(class_exists('WP_Widget')) {
        //add brand widgets
        
            class Pikoworks_core_Brands_Widget extends WP_Widget {
                /**
                 * Current Brand.
                 *
                 * @var bool
                 */
                 public $current_cat;
        
                /**
                 * Constructor.
                 */
                 public function __construct() {
                            $widget_ops = array(
                                    'classname' => 'sidebar-widget pikoworks_widget_brands',
                                    'description' => esc_html__( 'A list or dropdown of product brands.', 'pikoworks_custom_post' ),
                                    'customize_selective_refresh' => true,
                            );
                            parent::__construct( 'pikoworks_widget_brands', esc_html__( '[Pikoworks] Product Brands', 'pikoworks_custom_post' ), $widget_ops );
                }
        
                /**
                 * Output widget.
                 *
                 * @see WP_Widget
                 *
                 * @param array $args
                 * @param array $instance
                 */
                public function widget( $args, $instance ) {
        
                    $count              = isset( $instance['count'] ) ? $instance['count'] : $this->settings['count']['std'];
                    $title              = isset( $instance['title'] ) ? $instance['title'] : $this->settings['title']['std'];
                    $dropdown           = isset( $instance['dropdown'] ) ? $instance['dropdown'] : $this->settings['dropdown']['std'];
                    $displayType        = isset( $instance['displayType'] ) ? $instance['displayType'] : $this->settings['displayType']['std'];
                    $hide_empty         = isset( $instance['hide_empty'] ) ? $instance['hide_empty'] : $this->settings['hide_empty']['std'];
        
                    // Setup Current Category
                    $this->current_cat   = false;
                    $hide_empty = ($hide_empty == 1) ? true : false;
                    $args = array(
                        'taxonomy' => PIKOWORKS_PRODUCT_BRANDS_TAXONOMY,
                        'hide_empty' => $hide_empty,
                    );
                    $terms =  new WP_Term_Query($args);
        
                    // Dropdown
                    echo '<section class="widget pikoworks_widget_brands">
                            <h4 class="widget-title">'. esc_html($title).'</h4>
                            ';
        
                    if ( $dropdown ) { ?>
                            <select name="product_brand" class="dropdown_product_brand">
                                <option value="" selected="selected"><?php esc_attr_e('Select a brand', 'pikoworks_custom_post'); ?></option>
                                <?php foreach ($terms->terms as $brand) {
                                    $countProd = ($count == 1) ? "({$brand->count})" : '';
                                    ?>
                                    <option class="level-0" value="<?php echo esc_attr($brand->name); ?>"><?php echo esc_html($brand->name .' '. $countProd); ?></option>
                                <?php } ?>
                            </select>
                        <?php
                        wc_enqueue_js( "
                                            jQuery( '.dropdown_product_brand' ).change( function() {
                                                    if ( jQuery(this).val() != '' ) {
                                                            var this_page = '';
                                                            var home_url  = '" . esc_js( home_url( '/' ) ) . "';
                                                            if ( home_url.indexOf( '?' ) > 0 ) {
                                                                    this_page = home_url + '&brand=' + jQuery(this).val();
                                                            } else {
                                                                    this_page = home_url + '?brand=' + jQuery(this).val();
                                                            }
                                                            location.href = this_page;
                                                    }
                                            });
                                    " );
                    // List
                    } else {
                        echo '<ul>';            
                            foreach ($terms->terms as $brand) {
                                $thumbnail_id = absint(get_term_meta($brand->term_id, 'thumbnail_id', true)); ?>
                                 <?php
                                    $countProd = ($count == 1) ? "<span class='count'>(" . esc_html($brand->count) .")</span>" : '';
                                    $countProd2 = ($count == 1) ? "<span class='count'>" . esc_html($brand->count) ."</span>" : '';
                                    if ( $displayType == 'name' ) { ?>
                                    <li class="cat-item">
                                        <a href="<?php echo esc_url(get_term_link($brand)); ?>">
                                            <?php echo esc_attr($brand->name); ?>
                                            <?php echo wp_kses_post($countProd); ?>
                                        </a>
                                    </li>    
                                    <?php } elseif( $displayType == 'image' ) {
                                        $brandImg = wp_get_attachment_image($thumbnail_id, array(100,100) );
                                        if (!empty( $brandImg )) { ?>
                                        <li class="cat-img">
                                            <a class="brand-logo" href="<?php echo esc_url(get_term_link($brand)); ?>" title="<?php echo esc_attr($brand->name) . ' (' . esc_attr($brand->count) . ')'; ?>">
                                                <?php echo wp_kses_post($brandImg); ?>
                                                 <?php echo wp_kses_post($countProd2); ?>
                                            </a>
                                        </li>    
                                        <?php }
                                    } ?>
        
                            <?php }            
                        echo '</ul>';
                    }
                    echo '</section>';
                }
        
                 function update( $new_instance, $old_instance ) {
                           $instance = $old_instance;
        
                           /* Strip tags (if needed) and update the widget settings. */
                           $instance['title'] = strip_tags( $new_instance['title'] );
                           $instance['displayType'] = strip_tags( $new_instance['displayType'] );
                           $instance['dropdown'] = strip_tags( $new_instance['dropdown'] );
                           $instance['count'] = strip_tags( $new_instance['count'] );
                           $instance['hide_empty'] = strip_tags( $new_instance['hide_empty'] );               
        
                           return $instance;
                   }
                   function form($instance) {               
                           //Defaults
                            $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
                            $title = sanitize_text_field( $instance['title'] );
                            $displayType = isset($instance['displayType']) ? (bool) $instance['displayType'] :false;
                            $dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
                            $count = isset($instance['count']) ? (bool) $instance['count'] :false;
                            $hide_empty = isset( $instance['hide_empty'] ) ? (bool) $instance['hide_empty'] : false;		
        
                           ?>
        
                           <p>
                                   <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html__('Widget Title:', 'pikoworks_core') ?></label>
                                   <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
                           </p>
                           <p>
                                <label for="<?php echo $this->get_field_id( 'displayType' ); ?>"><?php esc_html_e( 'Display type:', 'pikoworks_custom_post' ); ?></label>
                                <select id="<?php echo $this->get_field_id( 'displayType' ); ?>" name="<?php echo $this->get_field_name( 'displayType' ); ?>">
                                        <option value="name"><?php esc_html_e( 'Name', 'pikoworks_custom_post' ); ?></option>
                                        <option value="image"><?php esc_html_e( 'Image', 'pikoworks_custom_post'  ); ?></option>                            
                                </select>
                            </p>
                            <p>                    
                                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
                                <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php esc_html_e( 'Display as dropdown', 'pikoworks_custom_post'  ); ?></label><br />
        
                                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
                                <label for="<?php echo $this->get_field_id('count'); ?>"><?php esc_html_e( 'Show product counts', 'pikoworks_custom_post'  ); ?></label><br />
        
                                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hide_empty'); ?>" name="<?php echo $this->get_field_name('hide_empty'); ?>"<?php checked( $hide_empty ); ?> />
                                <label for="<?php echo $this->get_field_id('hide_empty'); ?>"><?php esc_html_e( 'Hide empty brands', 'pikoworks_custom_post'  ); ?></label><br />
                            </p>
        
               <?php
                   }
        
            }
        }
if (!function_exists('pikowroks_core_brand_widgets')) {
        function pikowroks_core_brand_widgets()
        {
               register_widget('Pikoworks_core_Brands_Widget');
        }
        add_action('widgets_init', 'pikowroks_core_brand_widgets');
}

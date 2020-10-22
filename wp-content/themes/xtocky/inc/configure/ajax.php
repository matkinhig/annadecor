<?php

// ---------------------------------------------------------------------------//
// ! Search SKU
// ---------------------------------------------------------------------------//

if(!function_exists('xtocky_variation_query')) {
    add_filter('the_posts', 'xtocky_variation_query');
    function xtocky_variation_query($posts, $query = false) {
        if ( xtocky_get_option_data('search_by_sku') ) {
            if (is_search() && !is_admin()) {
                $ignoreIds = array(0);
                foreach( $posts as $post ) {
                    $ignoreIds[] = $post->ID;
                }

                //get_search_query does sanitization
                $matchedSku = xtocky_get_parent_post_by_sku(get_search_query(), $ignoreIds);

                if ( $matchedSku ) {
                    foreach( $matchedSku as $product_id ) {
                        $posts[] = get_post($product_id->post_id);
                    }
                }
                return $posts;
            }
        }
        return $posts;
    }
}

if(!function_exists('xtocky_get_parent_post_by_sku')) {
    function xtocky_get_parent_post_by_sku($sku, $ignoreIds) {
        //Check for
        global $wpdb, $wp_query;

        //Should the query do some extra joins for WPML Enabled sites...
        $wmplEnabled = false;

        if(defined('WPML_TM_VERSION') && defined('WPML_ST_VERSION') && class_exists("woocommerce_wpml")){
            $wmplEnabled = true;
            //What language should we search for...
            $languageCode = ICL_LANGUAGE_CODE;
        }

        $results = array();
        //Search for the sku of a variation and return the parent.
        $ignoreIdsForMySql = implode(",", $ignoreIds);
        $variationsSql = "
          SELECT p.post_parent as post_id FROM $wpdb->posts as p
          join $wpdb->postmeta pm
          on p.ID = pm.post_id
          and pm.meta_key='_sku'
          and pm.meta_value LIKE '%$sku%'
            ";
        //IF WPML Plugin is enabled join and get correct language product.
        if($wmplEnabled)
        {
            $variationsSql .=
                "join ".$wpdb->prefix."icl_translations t on
                 t.element_id = p.post_parent
                 and t.element_type = 'post_product'
                 and t.language_code = '$languageCode'";
            ;
        }
        $variationsSql .= "
          where 1
          AND p.post_parent <> 0
          and p.ID not in ($ignoreIdsForMySql)
          and p.post_status = 'publish'
          group by p.post_parent
          ";

        $variations = $wpdb->get_results($variationsSql);

        foreach( $variations as $post ) {
            $ignoreIds[] = $post->post_id;
        }
        //If not variation try a regular product sku
        //Add the ids we just found to the ignore list...
        $ignoreIdsForMySql = implode(",", $ignoreIds);
        $regularProductsSql =
            "SELECT p.ID as post_id FROM $wpdb->posts as p
            join $wpdb->postmeta pm
            on p.ID = pm.post_id
            and  pm.meta_key='_sku' 
            AND pm.meta_value LIKE '%$sku%'
            ";
        //IF WPML Plugin is enabled join and get correct language product.
        if($wmplEnabled)
        {
            $regularProductsSql .=
                "join ".$wpdb->prefix."icl_translations t on
                 t.element_id = p.ID
                 and t.element_type = 'post_product'
                 and t.language_code = '$languageCode'";
        }
        $regularProductsSql .=
            "where 1
            and (p.post_parent = 0 or p.post_parent is null)
            and p.ID not in ($ignoreIdsForMySql)
            and p.post_status = 'publish'
            group by p.ID";

        $regular_products = $wpdb->get_results($regularProductsSql);
        $results = array_merge($variations, $regular_products);
        $wp_query->found_posts += sizeof($results);

        return $results;
    }
}

//---------------------------------------------------------------------// 
// ajax search
//---------------------------------------------------------------------// 



add_action( 'wp_ajax_xtocky_ajax_search', 'xtocky_ajax_search_action');
add_action( 'wp_ajax_nopriv_xtocky_ajax_search', 'xtocky_ajax_search_action');
if(!function_exists('xtocky_ajax_search_action')) {
    function xtocky_ajax_search_action() {
        global $woocommerce;
        $ajax_product_count = xtocky_get_option_data( 'search_ajax_product' );
        $ajax_post_count = xtocky_get_option_data( 'search_ajax_post' );
        
        $product_count = 8; // condition is opposite when off post ajax
        if($ajax_post_count == 0){
            $product_count = 9;
        }
        $post_count = 8; // condition is opposite when off product ajax
        if($ajax_product_count == 0){
            $post_count = 9;
        }
        $result = array(
            'status' => 'error',
            'html' => ''
        );
        if(isset($_REQUEST['s'])) {

            if ( xtocky_get_option_data('search_by_sku') ) {
                global $wpdb, $wp_query, $product;
                $sku = $_REQUEST['s'];

                //Should the query do some extra joins for WPML Enabled sites...
                $wmplEnabled = false;

                if(defined('WPML_TM_VERSION') && defined('WPML_ST_VERSION') && class_exists("woocommerce_wpml")){
                    $wmplEnabled = true;
                    //What language should we search for...
                    $languageCode = ICL_LANGUAGE_CODE;
                }

                //Search for the sku of a variation and return the parent.
                $variationsSql = "
                  SELECT p.post_parent as post_id FROM $wpdb->posts as p
                  join $wpdb->postmeta pm
                  on p.ID = pm.post_id
                  and pm.meta_key='_sku'
                  and pm.meta_value LIKE '%$sku%'
                  ";

                //IF WPML Plugin is enabled join and get correct language product.
                if($wmplEnabled)
                {
                    $variationsSql .=
                        "join ".$wpdb->prefix."icl_translations t on
                         t.element_id = p.post_parent
                         and t.element_type = 'post_product'
                         and t.language_code = '$languageCode'";
                    ;
                }

                $variationsSql .= "
                      where 1
                      AND p.post_parent <> 0
                      and p.post_status = 'publish'
                      group by p.post_parent
                  ";
                $variations = $wpdb->get_results($variationsSql);


                $regularProductsSql =
                    "SELECT p.ID as post_id FROM $wpdb->posts as p
                        join $wpdb->postmeta pm
                        on p.ID = pm.post_id
                        and  pm.meta_key='_sku' 
                        AND pm.meta_value LIKE '%$sku%'
                    ";
                //IF WPML Plugin is enabled join and get correct language product.
                if($wmplEnabled)
                {
                    $regularProductsSql .=
                        "join ".$wpdb->prefix."icl_translations t on
                         t.element_id = p.ID
                         and t.element_type = 'post_product'
                         and t.language_code = '$languageCode'";
                }
                $regularProductsSql .=
                    "where 1
                    and (p.post_parent = 0 or p.post_parent is null)
                    and p.post_status = 'publish'
                    group by p.ID";
                $regular_products = $wpdb->get_results($regularProductsSql);
            }


            $wc_get_template = function_exists( 'wc_get_template' ) ? 'wc_get_template' : 'woocommerce_get_template';
            $s = sanitize_text_field($_REQUEST['s']);
            $ordering_args = $woocommerce->query->get_catalog_ordering_args( 'title', 'asc' );

            $args = array(
                's'                   => $s,
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'orderby'             => $ordering_args['orderby'],
                'order'               => $ordering_args['order'],
                'posts_per_page'      => $product_count,
                'suppress_filters'    => false,
            );

            $args['tax_query'][] = array(
              'taxonomy' => 'product_visibility',
              'field'    => 'name',
              'terms'    => 'hidden',
              'operator' => 'NOT IN',
            );

            if ( $_REQUEST['cat'] ) {
                $args['tax_query'] = array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => $_REQUEST['cat']
                    ) );
            }

            $products = ( xtocky_get_option_data( 'search_ajax_product' ) ) ? get_posts( $args ) : '' ;

            if ( ! empty( $products) ) {

                ob_start();

                foreach ( $products as $post ) {
                    setup_postdata( $post );
                    $product = wc_get_product( $post->ID );

                    if ( ! $product->is_visible() ) continue;
                   
                    $wc_get_template( 'content-widget-product.php' );
                }

                $result['status'] = 'success';
                $result['html'] .= '<div class="product-piko-ajax-list">';
                $result['html'] .= '<h3 class="search-results-title">' . esc_html__('Products found', 'xtocky') . '<a href="' . esc_url( home_url() ) . '/?s='. $s .'&post_type=product">' . esc_html__('View all', 'xtocky' ) . '</a></h3>';
                $result['html'] .= '<ul>' . ob_get_clean() . '</ul>';
                $result['html'] .= '</div>';
            }

            wp_reset_postdata();

            /* get sku results */
            
            if ( ( !empty( $regular_products ) || !empty( $variations ) ) && xtocky_get_option_data('search_by_sku') ) {

                $result['status'] = 'success';
                if ( empty($products) ) {
                    $result['html'] .= '<div class="product-piko-ajax-list product-sku-piko-ajax-list">';
                    $result['html'] .= '<h3 class="search-results-title">' . esc_html__('Products found', 'xtocky') . '<a href="' . esc_url( home_url() ) . '/?s='. $s .'&post_type=product">' . esc_html__('View all', 'xtocky' ) . '</a></h3>';
                    $result['html'] .= '<ul>';
                }

                $products = array_merge($variations, $regular_products);

                $arrayID = array(); 
                foreach ($products as $object) { 
                    array_push($arrayID, $object->post_id); 
                } 
                $arrayID = array_unique($arrayID); 

                $newObjects = array(); 
                foreach ($arrayID as $id) { 
                    foreach ($products as $object) { 
                        if ($object->post_id == $id) { 
                            array_push($newObjects, $object); 
                            break; 
                        } 
                    } 
                }

                foreach ( $newObjects as $product ) {
                    $_product = wc_get_product( $product->post_id );

                        $result['html'] .= '<li>';
                            $result['html'] .= '<a href="'.get_the_permalink($product->post_id).'" title="'.get_the_title($product->post_id).'" class="product-list-image">';
                                $result['html'] .= get_the_post_thumbnail($product->post_id);
                            $result['html'] .='</a>';
                            $result['html'] .= '<p class="product-title"><a href="'.get_the_permalink($product->post_id).'" title="'.get_the_title($product->post_id).'">'.get_the_title($product->post_id).'</a></p>';
                            $result['html'] .= '<div class="price">'.$_product->get_price_html().'</div>';
                        $result['html'] .= '</li>';
                }            

                $result['html'] .= '</ul></div>';                  
            }


            /* get posts results */

            $args = array(
                's'                   => $s,
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'posts_per_page'      => $post_count,
            );

            if ( $_REQUEST['cat'] && ! xtocky_get_option_data( 'search_ajax_product' ) ) $args['category_name'] = $_REQUEST['cat'];

            $posts = ( xtocky_get_option_data( 'search_ajax_post' ) ) ? get_posts( $args ) : '' ;

            if ( !empty( $posts ) ) {
                ob_start();
                foreach ( $posts as $post ) {
                    ?>
                        <li>
                            <a href="<?php echo get_the_permalink( $post->ID ); ?>" class="post-list-image"><?php echo get_the_post_thumbnail( $post->ID, 'thumbnail');?></a>
                            <span class="post-title"><a href="<?php echo get_the_permalink( $post->ID ); ?>"><?php echo get_the_title( $post->ID ) ?></a></span>
                            <span class="post-date"><?php echo get_the_date( '',$post->ID ); ?></span>
                        </li>
  
                    <?php
                }

                $result['status'] = 'success';
                $result['html'] .= '<div class="posts-piko-ajax-list">';
                $result['html'] .= '<h3 class="search-results-title">' . esc_html__('Posts found', 'xtocky') . '<a href="' . esc_url( home_url() ) . '/?s='. $s .'&post_type=post">' . esc_html__('View all', 'xtocky' ) . '</a></h3>';
                $result['html'] .= '<ul>' . ob_get_clean() . '</ul>';
                $result['html'] .= '</div>';
            }
            wp_reset_postdata();

            if ( empty( $products ) && empty( $posts ) && empty( $regular_products ) && empty( $variations ) ) {
                $result['status'] = 'error';
                $result['html'] = '<div class="empty-result-block">';
                $result['html'] .= '<h3>' . esc_html__( 'Sorry, No results were found', 'xtocky' ) . '</h3>';
                $result['html'] .= '<p class="not-found-text">' .  esc_html__( 'Please try again with different keywords. Surely you can find something for yourself!', 'xtocky' ). '</p>';
                $result['html'] .= '</div>';
            }

            wp_reset_postdata();

       }

         echo json_encode($result);

        die();
    }
}


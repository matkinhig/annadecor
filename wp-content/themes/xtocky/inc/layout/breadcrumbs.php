<?php

if(!function_exists('xtocky_breadcrumbs')){
    function xtocky_breadcrumbs() {
      //page title style
      global $xtocky;
      // Get header layout style
      
    if( function_exists( 'is_woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() || is_product() )){
       $header_img = isset( $xtocky['optn_archive_header_img'] ) ? $xtocky['optn_archive_header_img'] : array( 'url' => get_template_directory_uri() . '/assets/images/page-title.gif' );
        $header_title_text_align =  isset( $xtocky['woo_header_title_text_align'] ) ? $xtocky['woo_header_title_text_align'] : 'left'; 
        $page_header_title =  isset( $xtocky['woo_page_header_title'] ) ? $xtocky['woo_page_header_title'] : 1;
        
        
        $breadcrumb_layout =  get_post_meta(get_the_ID(),'xtocky_breadcrumb_layout',true);
        if (!isset($breadcrumb_layout) || $breadcrumb_layout == 'global' || $breadcrumb_layout == '') {
            $breadcrumb_layout =  isset( $xtocky['woo_breadcrumb_layout'] ) ? $xtocky['woo_breadcrumb_layout'] : 'one_cols';
        }
        
        if(is_product()){
            $page_header_title =  get_post_meta(get_the_ID(),'xtocky_single_header_title_section',true);
            if (!isset($page_header_title) || $page_header_title == 'global' || $page_header_title == '') { 
               $page_header_title =  isset( $xtocky['woo_single_header_title'] ) ? $xtocky['woo_single_header_title'] : 0;
            }
            $breadcrumb_layout =  get_post_meta(get_the_ID(),'xtocky_breadcrumb_layout',true);
            if (!isset($breadcrumb_layout) || $breadcrumb_layout == 'global' || $breadcrumb_layout == '') {   
               $breadcrumb_layout =  isset( $xtocky['woo_single_breadcrumb_layout'] ) ? $xtocky['woo_single_breadcrumb_layout'] : 'one_cols';
            }           
           $header_title_text_align =  isset( $xtocky['woo_single_header_title_text_align'] ) ? $xtocky['woo_single_header_title_text_align'] : 'left'; 
        }
        
        $layout_2column =  get_post_meta(get_the_ID(),'xtocky_breadcrumb_layout_title',true);
        if (!isset($layout_2column) || $layout_2column == '-1' || $layout_2column == '') {
        $layout_2column =  isset( $xtocky['woo_breadcrumb_layout_title'] ) ? $xtocky['woo_breadcrumb_layout_title'] : 'title-left';
        }

    }else{
      $header_img = isset( $xtocky['optn_header_img'] ) ? $xtocky['optn_header_img'] : array( 'url' => get_template_directory_uri() . '/assets/images/page-title.gif' );  
      $header_title_text_align =  isset( $xtocky['optn_header_title_text_align'] ) ? $xtocky['optn_header_title_text_align'] : 'center'; 
        $page_header_title =  get_post_meta(get_the_ID(),'xtocky_single_header_title_section',true);
        if (!isset($page_header_title) || $page_header_title == 'global' || $page_header_title == '') { 
        $page_header_title =  isset( $xtocky['page_header_title'] ) ? $xtocky['page_header_title'] : 1;
        }
        $breadcrumb_layout =  get_post_meta(get_the_ID(),'xtocky_breadcrumb_layout',true);
        if (!isset($breadcrumb_layout) || $breadcrumb_layout == 'global' || $breadcrumb_layout == '') { 
            $breadcrumb_layout =  isset( $xtocky['breadcrumb_layout'] ) ? $xtocky['breadcrumb_layout'] : 'one_cols';
        }     
        $layout_2column =  get_post_meta(get_the_ID(),'xtocky_breadcrumb_layout_title',true);
        if (!isset($layout_2column) || $layout_2column == '-1' || $layout_2column == '') {
            $layout_2column =  isset( $xtocky['breadcrumb_layout_title'] ) ? $xtocky['breadcrumb_layout_title'] : 'title-left';
        }
      
    }  
    
    $breadcrubm_layout =  get_post_meta(get_the_ID(),'xtocky_disable_breadcrubm_layout',true);
    if (!isset($breadcrubm_layout) || $breadcrubm_layout == 'global' || $breadcrubm_layout == '') {
        $breadcrubm_layout =  isset( $xtocky['optn_breadcrubm_layout'] ) ? $xtocky['optn_breadcrubm_layout'] : 1;        
    }
    
    $woo_disable =  isset( $xtocky['woo_breadcrumbs_disable'] ) ? $xtocky['woo_breadcrumbs_disable'] : 1;
    $woo_single_disable =  isset( $xtocky['woo_single_breadcrumbs_disable'] ) ? $xtocky['woo_single_breadcrumbs_disable'] : 1;
    
    $breadcrubm_width =  isset( $xtocky['optn_breadcrubm_width'] ) ? $xtocky['optn_breadcrubm_width'] : 'container-fluid';
    
    $breadcrumb_disable =  isset( $xtocky['breadcrumbs_disable'] ) ? $xtocky['breadcrumbs_disable'] : 1;
    
    
    $woo_breadcrumb_disable =  isset( $xtocky['woo_disable_breadcrubm'] ) ? $xtocky['woo_disable_breadcrubm'] : 1;
    $enable_widget =  isset( $xtocky['woo_archive_widget_enable'] ) ? $xtocky['woo_archive_widget_enable'] : 0;
    $woo_archive_widget =  isset( $xtocky['woo_archive_widget'] ) ? $xtocky['woo_archive_widget'] : '';
    
    if($enable_widget == 1 && ( is_shop() || is_product_category() || is_product_tag())){ //for shop page
       echo '<div class="woo-archive-widget">'; dynamic_sidebar( $woo_archive_widget );
       echo '</div>';
    }   
    
    
    $breadcrubm_name =  isset( $xtocky['optn_breadcrumb_name'] ) ? $xtocky['optn_breadcrumb_name'] : esc_html__('Home', 'xtocky');
    $breadcrubm_delimiter =  isset( $xtocky['optn_breadcrumb_delimiter'] ) ? $xtocky['optn_breadcrumb_delimiter'] : 'icon-arrow-long-right';
    $header_img_repeat =  isset( $xtocky['optn_header_img_repeat'] ) ? $xtocky['optn_header_img_repeat'] : 'repeat';
    $breadcrumbs_prefix =  isset( $xtocky['breadcrumbs_prefix'] ) ? $xtocky['breadcrumbs_prefix'] : '';  
    $page_sub_title = strip_tags(term_description());    
    
    $sub_title_html = '';
    $breadcrumbs_prefix_html ='';
   if ($page_sub_title != '') :
        $sub_title_html = '<span class="banner-subtitle"> ' . esc_attr($page_sub_title) .'</span>';
     endif;    
   if ($breadcrumbs_prefix != '') :
        $breadcrumbs_prefix_html = '<span class="prefix"> ' . esc_attr($breadcrumbs_prefix) .'</span>';
     endif;

$showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
$delimiter = '<i class="'. esc_attr($breadcrubm_delimiter) .'" aria-hidden="true"></i> '; // delimiter between crumbs
$home = $breadcrubm_name; // text for the 'Home' link
$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
$before = '<span class="current">'; // tag before the current crumb
$after = '</span>'; // tag after the current crumb


    
$top_banner_class = '';
$top_banner_style = '';
if ( trim( $header_img['url'] ) != '' ) {
    $top_banner_class .= ' has-bg-img';
    $top_banner_style = 'style="background: ' . esc_attr(isset($xtocky['optn_header_img_bg_color']) ? $xtocky['optn_header_img_bg_color'] : '#f4f4f4' ) .' url(' . esc_url( $header_img['url'] ) . ') ' . esc_attr( $header_img_repeat ) . ' center center;"';
}
else{
    $top_banner_class .= ' no-bg-img';
}


$title = '';

if ( is_front_page() && is_home() ) {
    // Default homepage
    
} elseif ( is_front_page() ) {
    // static homepage
    
} elseif ( is_home() ) {
    // blog page
    $post_id = get_option( 'page_for_posts' );
    $title = xtocky_single_title( $post_id );
    $top_banner_style = xtocky_single_header_bg_style( $post_id );
//    $header_title_text_align = xtocky_single_title_align( $post_id );
    
    if ( trim( $top_banner_style ) != '' ) {
        $top_banner_class = 'has-bg-img';
    }
    else{
        $top_banner_class = 'no-bg-img';
    }
    
} else {
    
     if ( is_404() ) { //404 page return
         return;
     }
    //everything else
    
    // Is a singular
    if ( is_singular()) {
        $show_single_title_section = xtocky_is_single_show_header_title_section();
        if ( !$show_single_title_section ) {
            echo '<div class="just-wraper"></div>';
            return;   
        }        
        $title = xtocky_single_title();
        $top_banner_style = xtocky_single_header_bg_style();
        $header_title_text_align = xtocky_single_title_align();
        if (!isset($header_title_text_align) || $header_title_text_align == '-1' || $header_title_text_align == '') {
            $header_title_text_align =  isset( $xtocky['optn_header_title_text_align'] ) ? $xtocky['optn_header_title_text_align'] : 'center'; 
        } 
        if ( function_exists( 'is_woocommerce' ) && is_product() ) {
           $header_title_text_align = xtocky_single_title_align(); 
        }
    }else{
        // Is archive or taxonomy
        if ( is_archive() ) {
            
        // $title = post_type_archive_title( '', true );
            
            if( is_post_type_archive() ){
                 $title = post_type_archive_title( '', false );
                  
                if ( function_exists( 'is_woocommerce' ) ) { 
                 if ( is_woocommerce() ) {
                      if ( apply_filters( 'woocommerce_show_page_title', false ) ) {
                        $title = woocommerce_page_title( true ); 
                        }
                      }
                }
                      
            }else{
                $title = get_the_archive_title();
                if( function_exists( 'is_woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() || is_product() )){
                    $title = woocommerce_page_title( false );
                }
                
            }
            
            // Checking for shop archive
            if ( function_exists( 'is_woocommerce' ) ) { // Products archive, products category, products search page...               
                
                   if ( !is_woocommerce() && is_shop() ) {
                    if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
                        $post_id = get_option( 'woocommerce_shop_page_id' );
                        $use_custom_title = get_post_meta( $post_id, 'xtocky_use_custom_title', true ) == 'yes';
                        
                        if ( $use_custom_title ) {
                            $title = xtocky_single_title( $post_id );
                        }
                        else{
                            $title = woocommerce_page_title( false );    
                        }
                        
                        $top_banner_style = xtocky_single_header_bg_style( $post_id );
                        $header_title_text_align = xtocky_single_title_align( $post_id );
                         
                    }
                }
                 
            } 
            
        }else{           
            if ( is_404() ) {
                $title = isset( $xtocky['optn_404_breadcrumb'] ) ? $xtocky['optn_404_breadcrumb'] : esc_html__( 'Oops 404 !', 'xtocky' );
            }else{ 
                if ( is_search() ) {
                    $title = sprintf( esc_html__( 'Search results for: %s', 'xtocky' ), get_search_query() );
                }
                else{
                    // is category, is tag, is tax
                    $title = single_cat_title( '', false );   
                } 
            }
        }        
    }
}

if ( trim( $top_banner_style ) != '' ) {
    $top_banner_class = 'has-bg-img';
}
else{
    $top_banner_class = 'no-bg-img';
}
$layout_two = '';
if($breadcrumb_layout == 'two_cols'){
    $layout_two = $layout_2column;
}

$top_banner_text_align = '';
$top_banner_text_align .= ' text-' .$header_title_text_align . ' ' .$layout_two ;

$title_html ='';
$font_size =  get_post_meta(get_the_ID(),'xtocky_custom_header_font_size',true);
if($font_size != ''){
    $font_size = 'font-size:'.esc_attr($font_size).'px;line-height:'.esc_attr($font_size).'px;font-weight:400';
}

if($page_header_title == 1){
    $title_html = '<h1 style="'.$font_size.'">' . wp_kses_post($title) . '</h1>' . wp_kses_post($sub_title_html);
    
    if(function_exists( 'is_woocommerce' ) &&  is_product_category()){
        $title_html ='';
    }
}


    // custom breadcrumbs
      global $post;
      $homeLink = home_url( '/' );
      $woo_padding = '';
      if( function_exists( 'is_woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag()) ){
        $woo_padding .= 'woo-breadcrumb';  
      }else{
         $woo_padding .= 'woo-single';   
      }
      

      if (is_front_page()) {

        if ($showOnHome == 1)  echo '<div class="just-wraper"></div>';

      } elseif(function_exists( 'is_woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() || is_product() )){
            if($woo_disable == 0 && ( is_shop() || is_product_category() || is_product_tag() ) || $woo_single_disable == 0 && is_product() ){
                echo '<div class="just-wraper"></div>';
                return;
            }          
          
             echo '<section class="page-header '. esc_attr($top_banner_class . ' ' . $woo_padding . ' ' . $top_banner_text_align).'" '.  wp_kses_post($top_banner_style) .'>
                <div class="' . esc_attr($breadcrubm_width) . '">  ' . wp_kses_post($title_html);
             
//                     echo  wp_kses_post($sub_title_html); //product category list for double load
             
            if($woo_breadcrumb_disable == 1){                
              echo '<div class="breadcrumb">';  
                woocommerce_breadcrumb();
              echo '</div></div>';                
            }             
            echo '</section>';
      }else {
          
          if($breadcrumb_disable == 0 || is_tax('dc_vendor_shop') || function_exists( 'dokan_is_store_page' ) && dokan_is_store_page()  ){
                echo '<div class="just-wraper"></div>';
                return;
            }
           echo '<section class="page-header '. esc_attr($top_banner_class . ' ' . $top_banner_text_align).'" '.  wp_kses_post($top_banner_style) .'>
                <div class="' . esc_attr($breadcrubm_width) . '">  ' . wp_kses_post($title_html);
           
           if($breadcrubm_layout == 1 && !is_home()){
              if( is_tax('brand')){
                    echo '</div></section>';
                    return; //stop the next code when show breadcrubm brand
                }  
              echo '<div class="breadcrumb">' . wp_kses_post($breadcrumbs_prefix_html);
              echo  '<a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a> ' . wp_kses_post($delimiter) . ' ';
            }else{
                echo '</div></section>';
                return; //stop the next code when not show breadcrubm
            }          

        if ( is_category() ) {
          $thisCat = get_category(get_query_var('cat'), false);
          if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
          echo wp_kses_post($before) .  esc_html__('Archive by category ', 'xtocky') . '"' . single_cat_title('', false) . '" ' . wp_kses_post($after);

        }elseif ( is_home() ) {            
          echo wp_kses_post($before). get_the_title( get_the_ID() ) . wp_kses_post($after);
        } elseif ( is_search() ) {
          echo wp_kses_post($before). esc_html__('Search results for ', 'xtocky') . '"' . get_search_query() . '"' . wp_kses_post($after);

        } elseif ( is_day() ) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
          echo wp_kses_post($before). get_the_time('d') . wp_kses_post($after);

        } elseif ( is_month() ) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo wp_kses_post($before). get_the_time('F') . wp_kses_post($after);

        } elseif ( is_year() ) {
          echo wp_kses_post($before). get_the_time('Y') . wp_kses_post($after);

        } elseif ( is_single() && !is_attachment() ) {
          if ( get_post_type() != 'post' ) {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . esc_url($homeLink) . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
            if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . wp_kses_post($before). get_the_title() . wp_kses_post($after);
          } else {
           $cat = get_the_category(); $cat = $cat[0];
           $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
           if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
           echo do_shortcode($cats);
            if ($showCurrent == 1) echo wp_kses_post($before). get_the_title() . wp_kses_post($after);
          }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
          $post_type = get_post_type_object(get_post_type());
          echo wp_kses_post($before). $post_type->labels->singular_name . wp_kses_post($after);

        } elseif ( is_attachment() ) {
          $parent = get_post($post->post_parent);
          $cat = get_the_category($parent->ID); $cat = $cat[0];
          echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
          echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
          if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . wp_kses_post($before). get_the_title() . wp_kses_post($after);

        } elseif ( is_page() && !$post->post_parent ) {
         if(xtocky_is_buddypress()){ //buddy press since v 1.0.4
            if ( bp_is_group() ) {
                echo '<a href="' . esc_url( bp_get_groups_directory_permalink()) . '">' . esc_html__('Groups', 'xtocky') . '</a>' . ' ' . $delimiter;
              } elseif ( bp_is_user() ) {
                echo '<a href="' . esc_url( bp_get_members_directory_permalink()) . '">' . esc_html__('Members', 'xtocky') . '</a>' . ' ' . $delimiter;
              }             
          }
          
          if ($showCurrent == 1) echo wp_kses_post($before). get_the_title() . wp_kses_post($after);

        } elseif ( is_page() && $post->post_parent ) {
          $parent_id  = $post->post_parent;
          $breadcrumbs = array();
          while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id  = $page->post_parent;
          }
          $breadcrumbs = array_reverse($breadcrumbs);
          for ($i = 0; $i < count($breadcrumbs); $i++) {
            echo do_shortcode($breadcrumbs[$i]);
            if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
          }
          if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . wp_kses_post($before). get_the_title() . wp_kses_post($after);

        } elseif ( is_tag() ) {
          echo wp_kses_post($before). esc_html__('Posts tagged ', 'xtocky') . '"' . single_tag_title('', false) . '"' . wp_kses_post($after);

        } elseif ( is_author() ) {
           global $author;
          $userdata = get_userdata($author);
          echo wp_kses_post($before). esc_html__('Articles posted by ', 'xtocky') . $userdata->display_name . wp_kses_post($after);

        } elseif ( is_404() ) {
          echo wp_kses_post($before). esc_html__('Error 404 ', 'xtocky') . wp_kses_post($after);
        }

        if ( get_query_var('paged') ) {
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
          //echo esc_html__('Page', 'xtocky') . ' ' . get_query_var('paged');
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }

        if(!is_home()){
            echo'</div> </div>';
        }    
        echo '</section>';

      }
    } 
} // end xtocky_breadcrumbs()


if ( !function_exists( 'xtocky_single_title' ) ) {
    function xtocky_single_title( $post_id = 0 ) {
        //for global meta
        global $xtocky;
        
        $post_id = max( 0, intval( $post_id ) );
        $title = '';
        
        if ( $post_id == 0 && is_singular() ) {
            $post_id = get_the_ID();
        }
        
        if ( $post_id > 0 ) {
            
            $show_single_title_section_setting = get_post_meta( $post_id, 'xtocky_single_header_title_section', true );
            $use_custom_title = get_post_meta( $post_id, 'xtocky_use_custom_title', true ) == 'yes';
            
            // if is single post, check options title type 
            if ( get_post_type( $post_id ) == 'post' ) {
                // check using single post title or blgo title for header title section
                $title_type = isset( $xtocky['opt_single_post_title_type'] ) ? trim( $xtocky['opt_single_post_title_type'] ) : 'single'; // single, blog
                if ( $title_type == 'blog' ) {
                    // if using global setting or show title but not use custom title
                    if ( $show_single_title_section_setting == 'global' || $show_single_title_section_setting == 'show' && !$use_custom_title ) {
                        $post_id = get_option( 'page_for_posts' );
                        $use_custom_title = get_post_meta( $post_id, 'xtocky_use_custom_title', true ) == 'yes';
                    }
                    
                }
            }
            
            $title = get_the_title( $post_id );
            
            if ( $use_custom_title ) {
                $title = get_post_meta( $post_id, 'xtocky_custom_header_title', true );
            } 
            else{
                
            }
            
        }
        
        return $title;
        
    }
}

if ( !function_exists( 'xtocky_single_header_bg_style' ) ) {
    function xtocky_single_header_bg_style( $post_id = 0 ) {
        global $xtocky;
        $post_id = max( 0, intval( $post_id ) );
        $top_banner_style = '';
        
        if ( $post_id == 0 && is_singular() ) {
            $post_id = get_the_ID();
        }
        
        $header_img = array(
            'url' => get_template_directory_uri() . '/assets/images/page-title.gif'
        );
        $header_img_repeat = 'repeat';
        
        if ( $post_id > 0 ) {
            $header_bg_type = get_post_meta( $post_id, 'xtocky_header_bg_type', true );
            if ( trim( $header_bg_type ) == '' ) {
                $header_bg_type = 'global';
            }            
            switch ( $header_bg_type ){
                case 'global':
                    
                    if( function_exists( 'is_woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() || is_product() )){
                       $header_img = isset( $xtocky['optn_archive_header_img'] ) ? $xtocky['optn_archive_header_img'] : array( 'url' => get_template_directory_uri() . '/assets/images/page-title.gif' );
                    }else{
                        $header_img = isset( $xtocky['optn_header_img'] ) ? $xtocky['optn_header_img'] : $header_img;
                    } 
                    
                    $header_img_repeat =  isset( $xtocky['optn_header_img_repeat'] ) ? $xtocky['optn_header_img_repeat'] : $header_img_repeat;
                    break;
                case 'image':
                    $header_img_id = get_post_meta( $post_id, 'xtocky_header_bg_src', true );
                    $header_img['url'] = wp_get_attachment_image_url($header_img_id, '') ? wp_get_attachment_image_url($header_img_id, '') : $header_img['url'];
                    $header_img_repeat = trim( get_post_meta( $post_id, 'xtocky_header_bg_repeat', true ) ) != '' ? trim( get_post_meta( $post_id, 'xtocky_header_bg_repeat', true ) ) : $header_img_repeat;
                    break;
                case 'no_image':
                    $header_img['url'] = '';
                    break;
            }
        }
        $padding_top =  get_post_meta(get_the_ID(),'xtocky_custom_header_padding_top',true);
        $padding_bottom =  get_post_meta(get_the_ID(),'xtocky_custom_header_padding_bottom',true);
        
        if($padding_top != ''){
            $padding_top = 'padding-top:'.esc_attr($padding_top).'px;';
        }
        if($padding_bottom != ''){
            $padding_bottom = 'padding-bottom:'.esc_attr($padding_bottom).'px;';
        }
        
        if ( trim( $header_img['url'] ) != '' ) {
            if ( $header_img_repeat == 'no-repeat' ) {                
             $top_banner_style = 'style="'.$padding_top.$padding_bottom.'background: '. esc_attr(isset($xtocky['optn_header_img_bg_color']) ? $xtocky['optn_header_img_bg_color'] : '#f4f4f4' ) .' url(' . esc_url( $header_img['url'] ) . ') ' . esc_attr( $header_img_repeat ) . ' center center; background-size: cover !important;"';   
            }
            elseif ( $header_img_repeat == 'fixed' ) {                
             $top_banner_style = 'style="'.$padding_top.$padding_bottom.'background: '. esc_attr(isset($xtocky['optn_header_img_bg_color']) ? $xtocky['optn_header_img_bg_color'] : '#f4f4f4' ) .' url(' . esc_url( $header_img['url'] ) . ') ' . esc_attr( $header_img_repeat ) . ' center center; background-size: cover !important; background-attachment: fixed; background-position: 50% 50%"';   
            }
            else{
                $top_banner_style = 'style="'.$padding_top.$padding_bottom.'background: '. esc_attr(isset($xtocky['optn_header_img_bg_color']) ? $xtocky['optn_header_img_bg_color'] : '#f4f4f4' ) .' url(' . esc_url( $header_img['url'] ) . ') ' . esc_attr( $header_img_repeat ) . ' center center;"';
            }
        }        
        return $top_banner_style;
        
    }
}

if ( !function_exists( 'xtocky_single_title_align' ) ) {
    function xtocky_single_title_align( $post_id = 0 ) {
        global $xtocky;
         $header_title_text_align =  isset( $xtocky['optn_header_title_text_align'] ) ? $xtocky['optn_header_title_text_align'] : 'center';
        
        if(function_exists( 'is_woocommerce' ) && is_product()){
           $header_title_text_align =  isset( $xtocky['woo_single_header_title_text_align'] ) ? $xtocky['woo_single_header_title_text_align'] : 'left'; 
        }
        
        $post_id = max( 0, intval( $post_id ) );
        
        if ( $post_id == 0 ) {
            $post_id = get_the_ID();
        }
        
        if ( $post_id > 0 ) {
            
            $post_title_align = get_post_meta( $post_id, 'xtocky_header_title_text_align', true );
            
            if ( $post_title_align != 'global' ) {
                $header_title_text_align = $post_title_align;
            }
            
        }
        
        return $header_title_text_align;
        
    }
}


if ( !function_exists( 'xtocky_is_single_show_header_title_section' ) ) {
    function xtocky_is_single_show_header_title_section( $post_id = 0 ) {
        global $xtocky;
        
        $show_single_title_section_setting = 'show';
        $show_single_title_section = true;
        
        $post_id = max( 0, intval( $post_id ) );
        $title = '';
        
        if ( $post_id == 0 ) {
            $post_id = get_the_ID();
        }
        
        if ( get_post_type( $post_id ) == 'product' ) {
            $show_single_title_section = isset( $xtocky['optn_single_product_header_title_section'] ) ? $xtocky['optn_single_product_header_title_section'] == 1 : true;  
        }
        if ( get_post_type( $post_id ) == 'post' ) {
            $show_single_title_section = isset( $xtocky['optn_single_post_header_title_section'] ) ? $xtocky['optn_single_post_header_title_section'] == 1 : true;  
        }
        
        $show_single_title_section_setting = get_post_meta( $post_id, 'xtocky_single_header_title_section', true );
        if ( $show_single_title_section_setting == 'show' ) {
            $show_single_title_section = true;
        }
        if ( $show_single_title_section_setting == 'dont_show' ) {
            $show_single_title_section = false;
        }
        
        return $show_single_title_section;
    }
}
<?php
/**
 * sidebar congifure function css class
 */
if ( !function_exists( 'xtocky_primary_page_sidebar_class' ) ) {    
    /**
     * Add class to #primary
     * @return string 
     **/
    function xtocky_primary_page_sidebar_class( $class = '' ) {
        global $xtocky;
        
        $prefix = 'xtocky_';
        
        if( class_exists('BuddyPress') && bp_current_component() ){ //when buddy press directory #since v1.0.4
            $bp_pagesID = get_option( 'bp-pages' );
            if($bp_pagesID['activity']){
                $bpID = $bp_pagesID["activity"];
            }elseif($bp_pagesID['members']){
                $bpID = $bp_pagesID["members"];
            }elseif($bp_pagesID['register']){
                $bpID = $bp_pagesID["register"];
            }else{ //activate page
                $bpID = $bp_pagesID["activate"];
            }            
            
            $sidebar_position =  get_post_meta($bpID, $prefix . 'page_sidebar',true);
            $sidebar_width =  get_post_meta($bpID, $prefix . 'sidebar_width',true);
            
        }else{
           $sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
            $sidebar_width =  get_post_meta(get_the_ID(), $prefix . 'sidebar_width',true); 
        }
        
             
         
             
       
        if (($sidebar_position === '') || ($sidebar_position == '-1')) {            
            $sidebar_position = isset( $xtocky['optn_page_sidebar_pos'] ) ? $xtocky['optn_page_sidebar_pos'] : 'fullwidth';
        }

        if (($sidebar_width === '') || ($sidebar_width == '-1')) {
                $sidebar_width = $xtocky['optn_page_sidebar_width'];
        } 
        
        //calculating cloumn
        if ($sidebar_position == 'left' || $sidebar_position == 'right') {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-8 ';
                } else {
                        $content_col = 'col-md-9 ';
                }
        }
        if ($sidebar_position == 'both' ) {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-4 ';
                } else {
                        $content_col = 'col-md-6 ';
                }
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-6 '. esc_attr($content_col);
        }else{
            $class .= ' col-xs-12 col-sm-8 '. esc_attr($content_col) . ' has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }
    
}
if ( !function_exists( 'xtocky_secondary_page_sidebar_class' ) ) {    
    /**
     * Add class to #secondary
     * @return string 
     **/
    function xtocky_secondary_page_sidebar_class( $class = '' ) {
        global $xtocky;
        
        $prefix = 'xtocky_';    
            
        if( class_exists('BuddyPress') && bp_current_component() ){ //when buddy press directory #since v1.0.4
            $bp_pagesID = get_option( 'bp-pages' );
            if($bp_pagesID['activity']){
                $bpID = $bp_pagesID["activity"];
            }elseif($bp_pagesID['members']){
                $bpID = $bp_pagesID["members"];
            }elseif($bp_pagesID['register']){
                $bpID = $bp_pagesID["register"];
            }else{ //activate page
                $bpID = $bp_pagesID["activate"];
            }            
            
            $sidebar_position =  get_post_meta($bpID, $prefix . 'page_sidebar',true);
            $sidebar_width =  get_post_meta($bpID, $prefix . 'sidebar_width',true);
            
        }else{
           $sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
            $sidebar_width =  get_post_meta(get_the_ID(), $prefix . 'sidebar_width',true); 
        }
            
            
            
            
        if (($sidebar_position === '') || ($sidebar_position == '-1')) {
            $sidebar_position = $xtocky['optn_page_sidebar_pos'];
        }        
        
        if (($sidebar_width === '') || ($sidebar_width == '-1')) {
            $sidebar_width = $xtocky['optn_page_sidebar_width'];
        }
        
        $sidebar_col = 'col-md-3 ';        
        if ($sidebar_width == 'large') {
            $sidebar_col = 'col-md-4 ';
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12 content-area-fullwidth';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-3 ' . esc_attr($sidebar_col) ;
        }
        else{
            $class .= ' col-xs-12 col-sm-4 ' . esc_attr($sidebar_col) . 'sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }    
}
/*----------------------------blog -----------------------------------------*/
if ( !function_exists( 'xtocky_primary_blog_class' ) ) {    
    /**
     * Add class to #primary
     * @return string 
     **/
    function xtocky_primary_blog_class( $class = '' ) {
        global $xtocky;        
          
        $sidebar_position = isset( $xtocky['optn_blog_sidebar_pos'] ) ? trim( $xtocky['optn_blog_sidebar_pos'] ) : 'right'; 
        $sidebar_width = isset( $xtocky['optn_blog_sidebar_width'] ) ? trim( $xtocky['optn_blog_sidebar_width'] ) : 'small';
       
        
        //calculating cloumn
        if ($sidebar_position == 'left' || $sidebar_position == 'right') {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-8 ';
                } else {
                        $content_col = 'col-md-9 ';
                }
        }
        if ($sidebar_position == 'both' ) {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-4 ';
                } else {
                        $content_col = 'col-md-6 ';
                }
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-6 '. esc_attr($content_col);
        }else{
            $class .= ' col-xs-12 col-sm-8 '. esc_attr($content_col) . ' has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }
    
}
if ( !function_exists( 'xtocky_secondary_blog_class' ) ) {    
    /**
     * Add class to #secondary
     * @return string 
     **/
    function xtocky_secondary_blog_class( $class = '' ) {
        global $xtocky;        
        
        $sidebar_position = isset( $xtocky['optn_blog_sidebar_pos'] ) ? trim( $xtocky['optn_blog_sidebar_pos'] ) : 'right'; 
        $sidebar_width = isset( $xtocky['optn_blog_sidebar_width'] ) ? trim( $xtocky['optn_blog_sidebar_width'] ) : 'small';
        
        $sidebar_col = 'col-md-3 ';        
        if ($sidebar_width == 'large') {
            $sidebar_col = 'col-md-4 ';
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12 content-area-fullwidth';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-3 ' . esc_attr($sidebar_col) ;
        }
        else{
            $class .= ' col-xs-12 col-sm-4 ' . esc_attr($sidebar_col) . 'sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }    
}

/*-------------------------------blog single--------------------------------------*/
if ( !function_exists( 'xtocky_primary_blog_single_sidebar_class' ) ) {    
    /**
     * Add class to #primary
     * @return string 
     **/
    function xtocky_primary_blog_single_sidebar_class( $class = '' ) {
        global $xtocky;
        
        $prefix = 'xtocky_';       
        
        $sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
        $sidebar_width =  get_post_meta(get_the_ID(), $prefix . 'sidebar_width',true);        
        
        if (($sidebar_position === '') || ($sidebar_position == '-1')) { 
            $sidebar_position = isset( $xtocky['optn_blog_single_sidebar_pos'] ) ? $xtocky['optn_blog_single_sidebar_pos'] : 'fullwidth';
        }

        if (($sidebar_width === '') || ($sidebar_width == '-1')) {
                $sidebar_width = $xtocky['optn_blog_single_sidebar_width'];
        } 
        
        //calculating cloumn
        if ($sidebar_position == 'left' || $sidebar_position == 'right') {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-8 ';
                } else {
                        $content_col = 'col-md-9 ';
                }
        }
        if ($sidebar_position == 'both' ) {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-4 ';
                } else {
                        $content_col = 'col-md-6 ';
                }
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-6 '. esc_attr($content_col);
        }else{
            $class .= ' col-xs-12 col-sm-8 '. esc_attr($content_col) . ' has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }
    
}
if ( !function_exists( 'xtocky_secondary_blog_single_sidebar_class' ) ) {    
    /**
     * Add class to #secondary
     * @return string 
     **/
    function xtocky_secondary_blog_single_sidebar_class( $class = '' ) {
        global $xtocky;
        
        $prefix = 'xtocky_';       
        
        $sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
        $sidebar_width =  get_post_meta(get_the_ID(), $prefix . 'sidebar_width',true);
        
        if (($sidebar_position === '') || ($sidebar_position == '-1')) {
            $sidebar_position = $xtocky['optn_blog_single_sidebar_pos'];
        }        
        
        if (($sidebar_width === '') || ($sidebar_width == '-1')) {
            $sidebar_width = $xtocky['optn_blog_single_sidebar_width'];
        }
        
        $sidebar_col = 'col-md-3 ';        
        if ($sidebar_width == 'large') {
            $sidebar_col = 'col-md-4 ';
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12 content-area-fullwidth';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-3 ' . esc_attr($sidebar_col) ;
        }
        else{
            $class .= ' col-xs-12 col-sm-4 ' . esc_attr($sidebar_col) . 'sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }    
}
/*--------------------------------search-------------------------------------*/
if ( !function_exists( 'xtocky_primary_search_class' ) ) {    
    /**
     * Add class to #primary
     * @return string 
     **/
    function xtocky_primary_search_class( $class = '' ) {
        global $xtocky;        
          
        $sidebar_position = isset( $xtocky['optn_search_sidebar_pos'] ) ? trim( $xtocky['optn_search_sidebar_pos'] ) : 'right'; 
        $sidebar_width = isset( $xtocky['optn_search_sidebar_width'] ) ? trim( $xtocky['optn_search_sidebar_width'] ) : 'small';
       
        
        //calculating cloumn
        if ($sidebar_position == 'left' || $sidebar_position == 'right') {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-8 ';
                } else {
                        $content_col = 'col-md-9 ';
                }
        }
        if ($sidebar_position == 'both' ) {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-4 ';
                } else {
                        $content_col = 'col-md-6 ';
                }
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-6 '. esc_attr($content_col);
        }else{
            $class .= ' col-xs-12 col-sm-8 '. esc_attr($content_col) . ' has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }
    
}
if ( !function_exists( 'xtocky_secondary_search_class' ) ) {    
    /**
     * Add class to #secondary
     * @return string 
     **/
    function xtocky_secondary_search_class( $class = '' ) {
        global $xtocky;
        
        $sidebar_position = isset( $xtocky['optn_search_sidebar_pos'] ) ? trim( $xtocky['optn_search_sidebar_pos'] ) : 'right'; 
        $sidebar_width = isset( $xtocky['optn_search_sidebar_width'] ) ? trim( $xtocky['optn_search_sidebar_width'] ) : 'small';
        
        $sidebar_col = 'col-md-3 ';        
        if ($sidebar_width == 'large') {
            $sidebar_col = 'col-md-4 ';
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12 content-area-fullwidth';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-3 ' . esc_attr($sidebar_col) ;
        }
        else{
            $class .= ' col-xs-12 col-sm-4 ' . esc_attr($sidebar_col) . 'sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }    
}
/*----------------------------service -----------------------------------------*/
if ( !function_exists( 'xtocky_primary_service_class' ) ) {    
    /**
     * Add class to #primary
     * @return string 
     **/
    function xtocky_primary_service_class( $class = '' ) {
        global $xtocky;        
          
        $sidebar_position = isset( $xtocky['optn_archive_service_sidebar_pos'] ) ? trim( $xtocky['optn_archive_service_sidebar_pos'] ) : 'right'; 
        $sidebar_width = isset( $xtocky['optn_archive_service_sidebar_width'] ) ? trim( $xtocky['optn_archive_service_sidebar_width'] ) : 'small';
       
        
        //calculating cloumn
        if ($sidebar_position == 'left' || $sidebar_position == 'right') {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-8 ';
                } else {
                        $content_col = 'col-md-9 ';
                }
        }
        if ($sidebar_position == 'both' ) {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-4 ';
                } else {
                        $content_col = 'col-md-6 ';
                }
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-6 '. esc_attr($content_col);
        }else{
            $class .= ' col-xs-12 col-sm-8 '. esc_attr($content_col) . ' has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }
    
}
if ( !function_exists( 'xtocky_secondary_service_class' ) ) {    
    /**
     * Add class to #secondary
     * @return string 
     **/
    function xtocky_secondary_service_class( $class = '' ) {
        global $xtocky;        
        
        $sidebar_position = isset( $xtocky['optn_archive_service_sidebar_pos'] ) ? trim( $xtocky['optn_archive_service_sidebar_pos'] ) : 'right'; 
        $sidebar_width = isset( $xtocky['optn_archive_service_sidebar_width'] ) ? trim( $xtocky['optn_archive_service_sidebar_width'] ) : 'small';
        
        $sidebar_col = 'col-md-3 ';        
        if ($sidebar_width == 'large') {
            $sidebar_col = 'col-md-4 ';
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12 content-area-fullwidth';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-3 ' . esc_attr($sidebar_col) ;
        }
        else{
            $class .= ' col-xs-12 col-sm-4 ' . esc_attr($sidebar_col) . 'sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }    
}
/*----------------------------Archive product -----------------------------------------*/
if ( !function_exists( 'xtocky_primary_product_class' ) ) {    
    /**
     * Add class to #primary
     * @return string 
     **/
    function xtocky_primary_product_class( $class = '' ) {
        global $xtocky;        
          
        $sidebar_position = isset( $xtocky['optn_product_sidebar_pos'] ) ? trim( $xtocky['optn_product_sidebar_pos'] ) : 'fullwidth'; 
        $sidebar_width = isset( $xtocky['optn_product_sidebar_width'] ) ? trim( $xtocky['optn_product_sidebar_width'] ) : 'small';
       
        
        //calculating cloumn
        if ($sidebar_position == 'left' || $sidebar_position == 'right') {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-8 ';
                } else {
                        $content_col = 'col-md-9 ';
                }
        }
        if ($sidebar_position == 'both' ) {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-4 ';
                } else {
                        $content_col = 'col-md-6 ';
                }
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-6 '. esc_attr($content_col);
        }else{
            $class .= ' col-xs-12 col-sm-8 '. esc_attr($content_col) . ' has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }
    
}
if ( !function_exists( 'xtocky_secondary_product_class' ) ) {    
    /**
     * Add class to #secondary
     * @return string 
     **/
    function xtocky_secondary_product_class( $class = '' ) {
        global $xtocky;        
        
        $sidebar_position = isset( $xtocky['optn_product_sidebar_pos'] ) ? trim( $xtocky['optn_product_sidebar_pos'] ) : 'fullwidth'; 
        $sidebar_width = isset( $xtocky['optn_product_sidebar_width'] ) ? trim( $xtocky['optn_product_sidebar_width'] ) : 'small';
        
        $sidebar_col = 'col-md-3 ';        
        if ($sidebar_width == 'large') {
            $sidebar_col = 'col-md-4 ';
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12 content-area-fullwidth';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-3  ' . esc_attr($sidebar_col) ;
        }
        else{
            $class .= ' col-xs-12 col-sm-4 ' . esc_attr($sidebar_col) . 'sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }    
}
/*-------------------------------blog single--------------------------------------*/
if ( !function_exists( 'xtocky_primary_product_single_sidebar_class' ) ) {    
    /**
     * Add class to #primary
     * @return string 
     **/
    function xtocky_primary_product_single_sidebar_class( $class = '' ) {
        global $xtocky;
        
        $prefix = 'xtocky_';                
        $sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
         $sidebar_width =  get_post_meta(get_the_ID(), $prefix . 'sidebar_width',true);             
       
        if (($sidebar_position === '') || ($sidebar_position == '-1')) {            
            $sidebar_position = isset( $xtocky['optn_product_single_sidebar_pos'] ) ? $xtocky['optn_product_single_sidebar_pos'] : 'fullwidth';
        }        

        if (($sidebar_width === '') || ($sidebar_width == '-1')) {
                $sidebar_width = $xtocky['optn_product_single_sidebar_width'];
        } 
        
        //calculating cloumn
        if ($sidebar_position == 'left' || $sidebar_position == 'right') {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-8 ';
                } else {
                        $content_col = 'col-md-9 ';
                }
        }
        if ($sidebar_position == 'both' ) {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-md-4 ';
                } else {
                        $content_col = 'col-md-6 ';
                }
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-6 '. esc_attr($content_col);
        }else{
            $class .= ' col-xs-12 col-sm-8 '. esc_attr($content_col) . ' has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }
    
}
if ( !function_exists( 'xtocky_secondary_product_single_sidebar_class' ) ) {    
    /**
     * Add class to #secondary
     * @return string 
     **/
    function xtocky_secondary_product_single_sidebar_class( $class = '' ) {
        global $xtocky;
        
        $prefix = 'xtocky_';               
        $sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
        $sidebar_width =  get_post_meta(get_the_ID(), $prefix . 'sidebar_width',true); 
        
        if (($sidebar_position === '') || ($sidebar_position == '-1')) {
            $sidebar_position = $xtocky['optn_product_single_sidebar_pos'];
        }        
        
        if (($sidebar_width === '') || ($sidebar_width == '-1')) {
            $sidebar_width = $xtocky['optn_product_single_sidebar_width'];
        }
        
        $sidebar_col = 'col-md-3 ';        
        if ($sidebar_width == 'large') {
            $sidebar_col = 'col-md-4 ';
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-xs-12 content-area-fullwidth';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-xs-12 col-sm-3 ' . esc_attr($sidebar_col) ;
        }
        else{
            $class .= ' col-xs-12 col-sm-4 ' . esc_attr($sidebar_col) . 'sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }    
}
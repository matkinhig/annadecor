<?php
/**
 * The template for displaying search forms
 *
 */
$ajax['enable'] = xtocky_get_option_data( 'search_ajax' );
$ajax['product'] = xtocky_get_option_data( 'search_ajax_product' );
$ajax['post'] = xtocky_get_option_data( 'search_ajax_post' );

$ajax['taxonomy'] = $ajax['name'] = 'category';
if( function_exists('WC') && $ajax['product'] ){
   $ajax['taxonomy'] = $ajax['name'] = 'product_cat'; 
}

$class 	= '';
if( $ajax['enable'] ) {
	$class .= 'piko-ajax-search-form';
	if ( $ajax['post'] && $ajax['product'] ) {
		$class .= ' all-results-on';
	} elseif ( $ajax['product'] ) {
		$class .= ' product-results-on';
	} elseif ( $ajax['post'] ) {
		$class .= ' post-results-on';
		$ajax['taxonomy'] = 'category';
		$ajax['name'] = 'cat';
	}
}
$unique_id = esc_attr( uniqid( 'search-form-' ) );
?>
<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-search-form-full <?php echo esc_attr($class); ?>">
    <div class="wrap">    
       <input type="text" id="<?php echo esc_attr($unique_id); ?>" placeholder="<?php esc_attr_e( 'Type here...', 'xtocky' ); ?>" value="<?php echo get_search_query(); ?>" autocomplete="off" class="form-control" name="s"/>
       <input type="hidden" name="post_type" value="<?php echo ( function_exists('WC')&& $ajax['product'] ) ? 'product': 'post' ; ?>" />
       <?php if ( defined( 'ICL_LANGUAGE_CODE' ) && ! defined( 'LOCO_LANG_DIR' ) ) : ?>
            <input type="hidden" name="lang" value="<?php echo ICL_LANGUAGE_CODE; ?>"/>
        <?php endif ?>
        <div class="dropdown search-dropdown">
            <div data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="search">
                <?php wp_dropdown_categories(array( 'show_option_all' => esc_html__( 'All categories', 'xtocky' ) ,'taxonomy' => $ajax['taxonomy'], 'hierarchical' => true, 'name' => $ajax['name'], 'value_field' => 'slug')) ?>            
            </div>
        </div><!-- End .dropdown --> 
        <?php if( !function_exists('WC') && $ajax['enable'] == 0  || function_exists('WC') && $ajax['enable'] == 0  || function_exists('WC') && !function_exists('pikoworks_core_load_textdomain') ){ echo '<input type="submit" class="hidden"/>'; } ?>
    </div>
    <a id="piko-modal-close" class="pa" href="#"><i class="icon-cross1"></i></a>
    <div class="text-right loading search-loading"> <i class="fa fa-circle-o-notch fa-spin fa-fw"></i></div>
    <?php if($ajax['enable']): ?>
            <div class="piko-ajax-results-wrapper"><div class="piko-ajax-results"></div></div>
    <?php endif ?>
</form>
<?php
/**
 * The template for displaying search forms
 *
 */
$ajax['enable'] = xtocky_get_option_data( 'search_ajax' );
$ajax['taxonomy'] = $ajax['name'] = 'product_cat';
$ajax['product'] = xtocky_get_option_data( 'search_ajax_product' );
$ajax['post'] = xtocky_get_option_data( 'search_ajax_post' );
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
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>"  class="header-search-form <?php echo esc_attr($class); ?>" method="get">    
       <input type="text" value="" placeholder="<?php esc_attr_e( 'Type here...', 'xtocky' ); ?>" autocomplete="off" class="form-control" name="s" id="s" required/>
       <input type="hidden" name="post_type" value="<?php  if($ajax['product']){  echo 'product'; }else{ echo 'post'; } ?>" />
       <?php if ( defined( 'ICL_LANGUAGE_CODE' ) && ! defined( 'LOCO_LANG_DIR' ) ) : ?>
            <input type="hidden" name="lang" value="<?php echo ICL_LANGUAGE_CODE; ?>"/>
        <?php endif ?>
        <div class="dropdown search-dropdown">
            <div  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="search">
                <?php wp_dropdown_categories(array( 'show_option_all' => esc_html__( 'All categories', 'xtocky' ) ,'taxonomy' => $ajax['taxonomy'], 'hierarchical' => true, 'name' => $ajax['name'], 'value_field' => 'slug')) ?>            
            </div>    
        </div><!-- End .dropdown -->
        <button type="submit" class="btn loading"><i class="fa fa-circle-o-notch fa-spin fa-fw"></i></button>    
        <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>   
    <?php if($ajax['enable']): ?>
            <div class="piko-ajax-results-wrapper"><div class="piko-ajax-results"></div></div>
    <?php endif ?>
</form>

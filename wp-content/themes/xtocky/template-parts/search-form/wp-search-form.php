<?php
/**
 *
 * @package themepiko
 * @version 1.1.1
 */

?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>


<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-search-form-full no-results">
    <div class="wrap">
        <input type="search" id="<?php echo esc_attr($unique_id); ?>" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'xtocky' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" class="search-submit"><i class="icon-arrow-long-right"></i></button>
    </div>
    <a id="piko-modal-close" class="pa" href="#"><i class="icon-cross1"></i></a>
</form>


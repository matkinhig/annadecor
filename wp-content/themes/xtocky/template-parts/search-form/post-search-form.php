<?php
/**
 * Post search
 */
?>
<form action="<?php echo esc_url( home_url( '/' ) ) ?>" class="header-search-form" method="get">    
    <input type="hidden" name="post_type" value="post" />
    <input value="<?php echo esc_attr( get_search_query() );?>" type="text" name="s" class="form-control" required>
    <button type="submit" class="btn"><i class="icon-search" aria-hidden="true"></i></button>
    <div class="dropdown search-dropdown">
        <div data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  role="search">
            <?php wp_dropdown_categories(array( 'show_option_all' => esc_html__('All categories', 'xtocky') ,'taxonomy' => 'category', 'hierarchical' => true, 'name' => 'post', 'value_field' => 'slug')) ?>      
        </div>
    </div><!-- End .dropdown -->
</form>
<?php 
/**
 * search
 */
?>
<div class="search-form">
    <form method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
        <input value="<?php echo esc_attr( get_search_query() );?>" type="text" name="s" class="form-control" required>
        <?php if( function_exists('WC') ): ?>
        <input type="hidden" name="post_type" value="product" />
        <?php else: ?>
        <input type="hidden" name="post_type" value="post" />
        <?php endif; ?>          
        <span class="overlay-search">
            <i class="icon-header icon-search"  aria-hidden="true"></i>
            <span><?php esc_attr_e('Search', 'xtocky') ?></span>
        </span>
        <button class="btn btn-link" type="submit" title="Search">
            <i class="icon-header icon-search"  aria-hidden="true"></i>
        </button>
    </form>
</div>



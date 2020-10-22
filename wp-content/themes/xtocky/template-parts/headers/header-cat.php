<?php
/**
 * Template part for displaying header layout cat.
 * 
 * @author themepiko
 */
$prefix = 'xtocky_';
$menu_width =  get_post_meta(get_the_ID(), $prefix . 'manu_width',true);
if (!isset($menu_width) || $menu_width == '-1' || $menu_width == '' || class_exists( 'WooCommerce' ) && is_woocommerce()) {
    $menu_width = isset( $GLOBALS['xtocky']['full_width_menu'] ) ? $GLOBALS['xtocky']['full_width_menu'] : 'container';
}
?>
<div class="header-wrapper header-side-nav">
	<header id="header" class="site-header sticky-menu-header">
		<div class="header-main">
                    <div class="container">
			<div class="row">
				<div class="columns">					
					<div class="header-right">
						<div class="mega-menu-sidebar">
							<div class="main-menu-wrap">
								<div id="main-menu">
									<?php xtocky_get_menu_category();?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
                    </div>
		</div>
	</header>
</div>
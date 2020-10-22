<div class="woocommerce-toolbar">
	<div class="woocommerce-toolbar-inner row">
		<?php
		/**
		 * @hooked open wrapper " toolbar-left " - 10
		 * @hooked xtocky_woocommerce_add_toolbar_per_page - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 * @hooked xtocky_woocommerce_add_toolbar_position - 40
		 * @hooked xtocky_woocommerce_add_gridlist_toggle_button - 50
		 * @hooked end wrapper " toolbar-left " - 60
		 * @hooked open wrapper " toolbar-right " - 70
		 * @hooked xtockyn_woocommerce_add_filter_attribute_on_toolbar - 80
		 * @hooked woocommerce_result_count - 99
		 * @hooked end wrapper " toolbar-right " - 100
		 */
		do_action( 'xtocky_woocommerce_toolbar');
		?>
	</div>
</div>
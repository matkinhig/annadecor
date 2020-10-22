<?php
/**
 * Template part for displaying header layout.
 * 
 */
$menu_sidebar = xtocky_get_option_data('vertical_menu_sidebar','');
?>
<div class="header-wrapper">
	<header id="header" class="site-header vertical">             
            <div id="mobile_menu_wrapper" class="push-fixed push-menu header-main">
                 <?php xtocky_get_header_toggle(); ?>                           
                <div class="logo">
                    <?php xtocky_get_brand_logo(); ?>
                </div>
                <div class="header">
                    <?php xtocky_get_header_right();?>
                </div>
                <div class="clearfix hidden-sm hidden-xs"></div>
                <nav class="verticale-menu hidden-sm hidden-xs">
                    <?php xtocky_get_vertical_menu();  ?>
                </nav>
                <?php
                if(is_active_sidebar($menu_sidebar)){
                        echo '<div class="clearfix"></div><div class="menu-widgets hidden-sm hidden-xs">';
                                dynamic_sidebar( $menu_sidebar );
                        echo '</div>';
                }
                ?>
            </div> 
	</header>
</div>
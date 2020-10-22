<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 */
?>


                    </div><!-- .row -->
		</div><!-- .site-content -->
            </div><!-- .site-inner -->           
            </div> <?php //just end div fixed menu layout 3  ?>
            
            <div id="mobile_menu_wrapper_overlay" class="push_overlay"></div>            
            <div id="mobile_menu_wrapper" class="hidden-md hidden-lg push-fixed push-menu">
                <h3><?php esc_html_e('MENU', 'xtocky'); ?> <i class="close-menu pa icon-cross2"></i></h3>
            <?php xtocky_get_mobile_main_menu();  ?>
            </div>             
            <?php 
            xtocky_get_header_cart_canvas();
            if(class_exists( 'WooCommerce' )){ xtocky_get_filter_trigger_canvas(); }            
            xtocky_footer_style();
            xtocky_get_header_search();
            xtocky_newsletter_popup();
            ?>
	
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>

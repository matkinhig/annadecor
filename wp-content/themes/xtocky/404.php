<?php
/**
 * The template for displaying 404 pages (not found)
 *
 */
get_header(); ?>
<?php
$layout_404_404 = isset( $GLOBALS['xtocky']['optn_404_404'] ) ? $GLOBALS['xtocky']['optn_404_404'] : esc_html__('404', 'xtocky');
$optn_404_heading = isset( $GLOBALS['xtocky']['optn_404_heading'] ) ? $GLOBALS['xtocky']['optn_404_heading'] : esc_html__('PAGE NOT FOUND','xtocky');
$optn_404_content = isset( $GLOBALS['xtocky']['optn_404_content'] ) ? $GLOBALS['xtocky']['optn_404_content'] : esc_html__('Sorry, the page you are looking for is not available. Maybe you want to perform a search?', 'xtocky');
$optn_404_btn = isset( $GLOBALS['xtocky']['optn_404_btn'] ) ? $GLOBALS['xtocky']['optn_404_btn'] : esc_html__('Go Home', 'xtocky');
$optn_404_contact_btn = isset( $GLOBALS['xtocky']['optn_404_contact_btn'] ) ? $GLOBALS['xtocky']['optn_404_contact_btn'] : 'contact';
?>
<div id="primary" class="content-area">
    <main id="main" class="error-page">            
            <section class="text-center">                
                <div class="error-page-text">
                    <?php if($layout_404_404 != ''){ echo '<h1>' . wp_kses_post($layout_404_404).'</h1>'; } ?>
                    <?php  if($optn_404_heading != ''){ echo '<h2>' . esc_attr($optn_404_heading).'</h2>';  } ?>
                    <div class="details"><?php echo do_shortcode( $optn_404_content); ?></div>
                    <div class="action-container">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button dib"><?php echo esc_attr($optn_404_btn); ?></a>
                        <a href="<?php echo esc_url( home_url( '/' . $optn_404_contact_btn ) ); ?>" class="button dib"><?php echo esc_attr($optn_404_contact_btn); ?></a>
                    </div><!-- End .action-container -->
                </div><!-- End .error-page-text -->                
            </section><!-- End .row -->            
    </main><!-- End .error-page -->
</div>        
<?php get_footer(); ?>

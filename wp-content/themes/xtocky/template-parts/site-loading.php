<?php
/**
 * @author themepiko
 *
 */
$home_preloader = xtocky_get_option_data('home_preloader', 'various-8');

$home_preloader_bg_color = xtocky_get_option_data('home_preloader_bg_color');
$home_preloader_spinner_color = xtocky_get_option_data('home_preloader_spinner_color');

$custom_bg_color = '';
if ($home_preloader_bg_color && isset($home_preloader_bg_color['rgba'])) {
    $custom_bg_color = 'style="background-color:'. $home_preloader_bg_color['rgba'].';"';
}

$custom_spinner_color = '';
if (!empty($home_preloader_spinner_color)) {
    $custom_spinner_color = 'style="background-color:'. $home_preloader_spinner_color.';"';
}

?>
<div id="site-loading" <?php echo do_shortcode($custom_bg_color);?> class="<?php echo esc_attr($home_preloader); ?>">
    <div class="loading-center">
        <div class="site-loading-center-absolute">            
            <?php if ($home_preloader == 'round-1') : ?>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner" id="spinner_one"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner" id="spinner_two"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner" id="spinner_three"></div>
            <?php endif; ?>           
            <?php if ($home_preloader == 'various-4') : ?>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner"></div>
            <?php endif; ?>

            <?php if ($home_preloader == 'various-7') : ?>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner" id="spinner_four"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner" id="spinner_three"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner" id="spinner_two"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner" id="spinner_one"></div>
            <?php endif; ?>

            <?php if ($home_preloader == 'various-8') : ?>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner" id="spinner_four"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner" id="spinner_three"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner" id="spinner_two"></div>
                <div <?php echo do_shortcode($custom_spinner_color);?> class="spinner" id="spinner_one"></div>
            <?php endif; ?>
        </div>
    </div>
</div>


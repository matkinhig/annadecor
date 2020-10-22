<?php
$theme = wp_get_theme();
if ($theme->parent_theme) {
    $template_dir =  basename(get_template_directory());
    $theme = wp_get_theme($template_dir);
}
?>
<div class="wrap about-wrap theme-wrap">
    <h1><?php esc_attr_e('Welcome to Xtocky!', 'pikoworks_core'); ?></h1>
    <div class="about-text"><?php echo esc_html__('Xtocky is now installed and ready to use! Read below for additional information. We hope you enjoy it!', 'pikoworks_core'); ?></div>
    <div class="theme-logo"><span class="theme-version"><?php esc_attr_e('Version', 'pikoworks_core'); ?> <?php echo $theme->get('Version'); ?></span></div>
    <h2 class="nav-tab-wrapper">
        <?php
        printf('<a href="javascript:void(0)" class="nav-tab nav-tab-active">%s</a>', esc_html__("Welcome", 'pikoworks_core'));
        printf('<a href="%s" class="nav-tab">%s</a>', admin_url('admin.php?page=pikoworks-system'), esc_html__("System Status", 'pikoworks_core'));
        printf('<a href="%s" class="nav-tab">%s</a>', admin_url('admin.php?page=pikoworks-demo'), esc_html__("Demo", 'pikoworks_core'));
        printf('<a href="%s" class="nav-tab">%s</a>', admin_url('plugins.php'), esc_html__("Plugins", 'pikoworks_core'));
        printf('<a href="%s" class="nav-tab">%s</a>', admin_url('admin.php?page=theme_options'), esc_html__("Theme Options", 'pikoworks_core'));
        printf('<a href="%s" class="nav-tab">%s</a>', admin_url('admin.php?page=pikoworks_currency'), esc_html__("Currency", 'pikoworks_core'));

        ?>
    </h2>
    <div class="theme-section">
        <p class="about-description">
            <?php wp_kses(printf(__('Before you get started, please be sure to always check out <a href="%s" target="_blank">this documentation</a>. We outline all kinds of good information, and provide you with all the details you need to use Xtocky.', 'pikoworks_core'), 'http://demo.themepiko.com/stock/documentation/'), array('strong' => array(), 'br' => array(), 'a' => array('href' => array(), 'target' => array()))); ?>
        </p>
        <p class="about-description">
            <?php wp_kses(printf(__('If you are unable to find your answer in our documentation, we encourage you to contact us through <a href="%s" target="_blank">support page</a> with your site CPanel (or FTP) and WordPress admin details. We are very happy to help you and you will get reply from us more faster than you expected.', 'pikoworks_core'), 'https://themepiko.com/forums/'), array('strong' => array(), 'br' => array(), 'a' => array('href' => array(), 'target' => array()))); ?>
        </p>
        <p class="about-description">
            <a target="_blank" href="http://demo.themepiko.com/stock/documentation/#changelog"><?php esc_attr_e('Click here to view change logs.', 'pikoworks_core') ?></a>
        </p>
        <p class="about-description">
            <?php
            // printf( 'Please regenerate again default css files in <a href="%s">Theme Options > Skin > Compile Default CSS</a> after update theme.', admin_url( 'admin.php?page=pikoworks&tab=5' ) );
            ?>
        </p>
    </div>
    <div class="theme-thanks">
        <p class="description"><?php esc_attr_e('Thank you, we hope you to enjoy using Xtocky!', 'pikoworks_core'); ?></p>
    </div>
</div>
<?php

$theme = wp_get_theme();
if ($theme->parent_theme) {
    $template_dir =  basename(get_template_directory());
    $theme = wp_get_theme($template_dir);
}
?>
<div class="wrap about-wrap theme-wrap">
    <h1><?php esc_attr_e( 'Welcome to Xtocky!', 'pikoworks_core' ); ?></h1>
    <div class="about-text"><?php echo esc_html__( 'Xtocky is now installed and ready to use! Read below for additional information. We hope you enjoy it!', 'pikoworks_core' ); ?></div>
    <div class="theme-logo"><span class="theme-version"><?php esc_attr_e( 'Version', 'pikoworks_core' ); ?> <?php echo $theme->get('Version'); ?></span></div>
    <h2 class="nav-tab-wrapper">
        <?php
        
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=pikoworks' ), esc_html__( "Welcome", 'pikoworks_core' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=pikoworks-system' ), esc_html__( "System Status", 'pikoworks_core' ) );
        printf( '<a href="javascript:void(0)" class="nav-tab nav-tab-active">%s</a>', esc_html__( "Demo", 'pikoworks_core' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'plugins.php' ), esc_html__( "Plugins", 'pikoworks_core' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=theme_options' ), esc_html__( "Theme Options", 'pikoworks_core' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=pikoworks_currency' ), esc_html__( "Currency", 'pikoworks_core' ) );
        ?>
    </h2>
    <div class="theme-section">
        <?php
        if (!class_exists('Pikoworks_Dummy_Is_Active')) {
            echo ' <p class="piko-message">
			   ' . esc_html__('The following required plugin is currently inactive: ', 'pikoworks_core') . '<a href="' . admin_url('plugins.php') . '" >' . esc_html__('Xtocky Dummy Content', 'pikoworks_core') . '</a>
			</p> ';
        }
        ?>
    </div>
    <div class="theme-thanks">
        <p class="description"><?php esc_attr_e( 'Thank you, we hope you to enjoy using Xtocky!', 'pikoworks_core' ); ?></p>
    </div>
</div>
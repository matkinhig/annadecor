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
        printf('<a href="%s" class="nav-tab">%s</a>', admin_url('admin.php?page=pikoworks'), esc_html__("Welcome", 'pikoworks_core'));
        printf('<a href="javascript:void(0)" class="nav-tab nav-tab-active">%s</a>', esc_html__("System Status", 'pikoworks_core'));
        printf('<a href="%s" class="nav-tab">%s</a>', admin_url('admin.php?page=pikoworks-demo'), esc_html__("Demo", 'pikoworks_core'));
        printf('<a href="%s" class="nav-tab">%s</a>', admin_url('plugins.php'), esc_html__("Plugins", 'pikoworks_core'));
        printf('<a href="%s" class="nav-tab">%s</a>', admin_url('admin.php?page=theme_options'), esc_html__("Theme Options", 'pikoworks_core'));
        printf('<a href="%s" class="nav-tab">%s</a>', admin_url('admin.php?page=pikoworks_currency'), esc_html__("Currency", 'pikoworks_core'));
        ?>
    </h2>
    <div class="theme-section">
        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th><?php esc_html_e(' Theme Name', 'pikoworks_core'); ?></th>
                    <th><?php echo esc_html($theme->get('Name')); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php esc_attr_e('Current Version:', 'pikoworks_core'); ?></td>
                    <td><?php echo $theme->get('Version'); ?></td>
                </tr>
            </tbody>
        </table>
        <?php
        if (class_exists('Xtocky_System_Requirements')) {
            $system_requirements = new Xtocky_System_Requirements();
            $system_requirements->html();
            $system = $system_requirements->get_system();
            $requirements = $system_requirements->get_requirements();
            $result = $system_requirements->result();
        }
        ?>
        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="2"><?php esc_attr_e('Website Information', 'pikoworks_core'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php esc_attr_e('Home URL:', 'pikoworks_core'); ?></td>
                    <td><?php echo home_url(); ?></td>
                </tr>
                <tr>
                    <td><?php esc_attr_e('Site URL:', 'pikoworks_core'); ?></td>
                    <td><?php echo site_url(); ?></td>
                </tr>

                <tr>
                    <td><?php esc_attr_e('WP Multisite:', 'pikoworks_core'); ?></td>
                    <td><?php if (is_multisite()) echo '&#10004;';
                        else echo '&ndash;'; ?></td>
                </tr>

                <tr>
                    <td><?php esc_html_e('WP Debug Mode:', 'pikoworks_core'); ?></td>
                    <td><?php if (defined('WP_DEBUG') && WP_DEBUG) echo '<mark class="yes">' . '&#10004;' . '</mark>';
                        else echo '<mark class="no">' . '&ndash;' . '</mark>'; ?></td>
                </tr>
                <tr>
                    <td><?php esc_html_e('Language:', 'pikoworks_core'); ?></td>
                    <td><?php echo get_locale() ?></td>
                </tr>
            </tbody>
        </table>

        <table class="widefat" cellspacing="0" id="status">
            <thead>
                <tr>
                    <th colspan="2"><?php esc_attr_e('Active Plugins', 'pikoworks_core'); ?> (<?php echo count((array) get_option('active_plugins')); ?>)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $active_plugins = (array) get_option('active_plugins', array());

                if (is_multisite()) {
                    $active_plugins = array_merge($active_plugins, get_site_option('active_sitewide_plugins', array()));
                }

                foreach ($active_plugins as $plugin) {

                    $plugin_data    = @get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
                    $dirname        = dirname($plugin);
                    $version_string = '';
                    $network_string = '';

                    if (!empty($plugin_data['Name'])) {

                        // link the plugin name to the plugin url if available
                        $plugin_name = esc_html($plugin_data['Name']);

                        if (!empty($plugin_data['PluginURI'])) {
                            $plugin_name = '<a href="' . esc_url($plugin_data['PluginURI']) . '" title="' . esc_html__('Visit plugin homepage', 'pikoworks_core') . '">' . $plugin_name . '</a>';
                        }
                        ?>
                        <tr>
                            <td><?php echo $plugin_name; ?></td>
                            <td><?php printf(_x('by %s', 'by author', 'pikoworks_core'), $plugin_data['Author']) . ' &ndash; ' . esc_html($plugin_data['Version']) . $version_string . $network_string; ?></td>
                        </tr>
                    <?php
                    }
                }
                ?>
            </tbody>
        </table>

    </div>
    <div class="theme-thanks">
        <p class="description"><?php esc_attr_e('Thank you, we hope you to enjoy using Xtocky!', 'pikoworks_core'); ?></p>
    </div>
</div>
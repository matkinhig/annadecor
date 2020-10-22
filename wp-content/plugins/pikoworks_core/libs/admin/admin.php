<?php

class pikoworks_theme_Admin {

    public function __construct() {
        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'wp_before_admin_bar_render', array( $this, 'add_wp_toolbar_menu' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        // add_action( 'after_switch_theme', array( $this, 'activation_redirect' ) );
    }

    public function add_wp_toolbar_menu() {

        if ( current_user_can( 'edit_theme_options' ) ) {

            $pikoworks_parent_menu_title = '<span class="ab-icon"></span><span class="ab-label">Xtocky</span>';

            $this->add_wp_toolbar_menu_item( $pikoworks_parent_menu_title, false, admin_url( 'admin.php?page=pikoworks' ), array( 'class' => 'pikoworks-menu' ), 'pikoworks' );
            $this->add_wp_toolbar_menu_item( esc_html__( 'System Status', 'pikoworks_core' ), 'pikoworks', admin_url( 'admin.php?page=pikoworks-system' ) );
            $this->add_wp_toolbar_menu_item( esc_html__( 'Demo Import', 'pikoworks_core' ), 'pikoworks', admin_url( 'admin.php?page=pikoworks-demo' ) );
            $this->add_wp_toolbar_menu_item( esc_html__( 'Theme Options', 'pikoworks_core' ), 'pikoworks', admin_url( 'admin.php?page=theme_options' ) );
            $this->add_wp_toolbar_menu_item( esc_html__( 'Currency Switcher', 'pikoworks_core' ), 'pikoworks', admin_url( 'admin.php?page=pikoworks_currency' ) );
        }
    }

    public function add_wp_toolbar_menu_item( $title, $parent = false, $href = '', $custom_meta = array(), $custom_id = '' ) {

        global $wp_admin_bar;

        if ( current_user_can( 'edit_theme_options' ) ) {
            if ( ! is_super_admin() || ! is_admin_bar_showing() ) {
                return;
            }

            // Set custom ID
            if ( $custom_id ) {
                $id = $custom_id;
            } else { // Generate ID based on $title
                $id = strtolower( str_replace( ' ', '-', $title ) );
            }

            // links from the current host will open in the current window
            $meta = strpos( $href, site_url() ) !== false ? array() : array( 'target' => '_blank' ); // external links open in new tab/window
            $meta = array_merge( $meta, $custom_meta );

            $wp_admin_bar->add_node( array(
                'parent' => $parent,
                'id'     => $id,
                'title'  => $title,
                'href'   => $href,
                'meta'   => $meta,
            ) );
        }

    }

    public function activation_redirect() {
        if ( current_user_can( 'edit_theme_options' ) ) {
            header( 'Location:' . admin_url() . 'admin.php?page=pikoworks' );
        }
    }

    public function admin_init() {

        if ( current_user_can( 'edit_theme_options' ) ) {
            if ( isset( $_GET['pikoworks-deactivate'] ) && 'deactivate-plugin' == $_GET['pikoworks-deactivate'] ) {
                check_admin_referer( 'pikoworks-deactivate', 'pikoworks-deactivate-nonce' );

                $plugins = TGM_Plugin_Activation::$instance->plugins;

                foreach ( $plugins as $plugin ) {
                    if ( $plugin['slug'] == $_GET['plugin'] ) {
                        deactivate_plugins( $plugin['file_path'] );
                    }
                }
            } if ( isset( $_GET['pikoworks-activate'] ) && 'activate-plugin' == $_GET['pikoworks-activate'] ) {
                check_admin_referer( 'pikoworks-activate', 'pikoworks-activate-nonce' );

                $plugins = TGM_Plugin_Activation::$instance->plugins;

                foreach ( $plugins as $plugin ) {
                    if ( isset( $_GET['plugin'] ) && $plugin['slug'] == $_GET['plugin'] ) {
                        activate_plugin( $plugin['file_path'] );

                        wp_redirect( admin_url( 'admin.php?page=pikoworks-plugins' ) );
                        exit;
                    }
                }
            }
        }
    }

    public function admin_menu(){

        if ( current_user_can( 'edit_theme_options' ) ) {
            $welcome_screen = add_menu_page( 'Xtocky', 'Xtocky', 'administrator', 'pikoworks', array( $this, 'welcome_screen' ), 'dashicons-theme-logo', 59 );
            $welcome       = add_submenu_page( 'pikoworks', esc_html__( 'Welcome', 'pikoworks_core' ), esc_html__( 'Welcome', 'pikoworks_core' ), 'administrator', 'pikoworks', array( $this, 'welcome_screen' ) );
            $system_status = add_submenu_page( 'pikoworks', esc_html__( 'System Status', 'pikoworks_core' ), esc_html__( 'System Status', 'pikoworks_core' ), 'administrator', 'pikoworks-system', array( $this, 'system_tab' ) );
            if(!class_exists('Pikoworks_Dummy_Is_Active')){
                $demo = add_submenu_page( 'pikoworks', esc_html__( 'Demo Import', 'pikoworks_core' ), esc_html__( 'Demo Import', 'pikoworks_core' ), 'administrator', 'pikoworks-demo', array( $this, 'demo_tab' ) );
            }
        }
    }

    public function welcome_screen() {
        require_once( PIKOWORKSCORE_LIBS . '/admin/admin_pages/welcome.php' );
    }
    public function system_tab() {
        require_once( PIKOWORKSCORE_LIBS . '/admin/admin_pages/system-status.php' );
    }
    public function demo_tab() {
        require_once( PIKOWORKSCORE_LIBS . '/admin/admin_pages/demo.php' );
    }
    public function let_to_num( $size ) {
        $l   = substr( $size, -1 );
        $ret = substr( $size, 0, -1 );
        switch ( strtoupper( $l ) ) {
            case 'P':
                $ret *= 1024;
            case 'T':
                $ret *= 1024;
            case 'G':
                $ret *= 1024;
            case 'M':
                $ret *= 1024;
            case 'K':
                $ret *= 1024;
        }
        return $ret;
    }
}

new pikoworks_theme_Admin();

require_once(PIKOWORKSCORE_LIBS . '/admin/theme_options.php');



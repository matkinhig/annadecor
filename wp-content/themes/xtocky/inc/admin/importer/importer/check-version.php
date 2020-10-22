<?php  if ( ! defined( 'ABSPATH' ) ) exit;

class Xtocky_Check_Version {

    private $current_version = '';
    private $new_version = '';
    private $theme_name = '';
    private $api_url = '';
    private $ignore_key = 'theme_notice';
    public $information;
    public $api_key;
    public $url = 'http://demo.themepiko.com/stock/change-log.php';
    public $notices;


    function __construct() {
        $this->activate( '', array( 'token' => '') );
        $theme_data = wp_get_theme('xtocky');
        $activated_data = get_option( 'xtocky_activated_data' );
        $this->current_version = $theme_data->get('Version');
        $this->theme_name = strtolower($theme_data->get('Name'));
        $this->api_url = 'https://themepiko.com/api/envato/';
        $this->api_key = ( ! empty( $activated_data['api_key'] ) ) ? $activated_data['api_key'] : false;

        add_action('admin_init', array($this, 'dismiss_notices'));
        add_action('admin_notices', array($this, 'show_notices'), 50 );

        if( ! get_option( 'envato_setup_complete', false ) ) {
            $this->setup_notice();
        }

        if( ! xtocky_is_activated() ) {
            $this->activation_notice();
            return;
        }

        if( $this->is_update_available() ) {
            if ( $this->major_update( 'both' ) ) add_action( 'admin_head', array( $this, 'major_update_holder' ) );
            $this->update_notice();
        }

        add_action( 'switch_theme', array( $this, 'update_dismiss' ) );

        add_action( 'current_screen', array( $this, 'api_results_init' ) );
        
        add_filter( 'site_transient_update_themes', array( $this, 'update_transient' ), 20, 2 );
        add_filter( 'pre_set_site_transient_update_themes', array( $this, 'set_update_transient' ) );
        add_filter( 'themes_api', array(&$this, 'api_results'), 10, 3);

    }
    
    public function api_results_init( $current_screen ) {
        if ( $current_screen->base !== 'woocommerce_page_wc-status' ) {
            add_filter( 'themes_api', array(&$this, 'api_results'), 10, 3);
        }
        
    }

    public function activation_page() {
        ?>
            
            <?php if ( xtocky_is_activated() ): ?>
                <?php 
                    $activated_data = get_option( 'xtocky_activated_data' );
                    $activated_data = ( isset( $activated_data['purchase'] ) && ! empty( $activated_data['purchase'] ) ) ? $activated_data['purchase'] : '';
                ?>

                    <p><?php esc_html_e('Your theme is activated! Now you have lifetime updates, top-notch 24/7 live support and much more.', 'xtocky'); ?></p>
                    <?php $this->process_form(); ?>
                    <p class="themepiko-purchase"><i class="piko-admin-icon piko-key"></i> <span><?php echo substr($activated_data, 0, -8) . '********'; ?></span></p>
                    <span class="piko-button piko-button-active piko_theme-deactivator no-loader last-button"><?php esc_html_e( 'Deactivate theme', 'xtocky' ); ?></span>
                        <p class="piko-message piko-warning">
                        <?php esc_html_e('One standard license is valid only for 1 website. Running multiple websites on a single license is a copyright violation. When moving a site from one domain to another please deactivate theme first.', 'xtocky'); ?>
                    </p>
            <?php else: ?>

                <p class="piko-message piko-error"><?php esc_html_e('Your product should be activated so you may get the access to all the Xstore demos, auto theme updates and included premium plugins. The instructions below in toggle format must be followed exactly.', 'xtocky'); ?></p>

                <?php $this->process_form(); ?>

                <form class="themepiko-form" method="post">
                    <input type="text" name="purchase-code" placeholder="Example: f20b1cdd-ee2a-1c32-a146-66eafea81761" id="purchase-code" />
                    <input class="piko-button no-loader" name="xtocky-purchase-code" type="submit" value="<?php esc_attr_e( 'Register theme', 'xtocky' ); ?>" />
                </form>

            <?php endif; ?>
        <?php 
    }

    public function old_purchase_code() {
        $code = '';

        $activated_data = get_option( 'xtocky_activated_data' );

        $option = $activated_data['purchase'];

        if( $option && ! empty( $option ) ) {
            $code = $option;
        }

        if( isset( $_POST['purchase-code'] ) && ! empty( $_POST['purchase-code'] ) ) $code = $_POST['purchase-code'];

        return $code;
    }

    public function show_notices() {
        global $current_user;
        $user_id = $current_user->ID;
        if( ! empty( $this->notices ) ) {
            foreach ($this->notices as $key => $notice) {
                if ( ! get_user_meta($user_id, $this->ignore_key . $key) ) {
                    echo '<div class="piko-message piko-info">' . $notice['message'] . '</div>';
                }
            }
        }
    }

    public function dismiss_notices() {
        global $current_user;
        $user_id = $current_user->ID;
        if ( isset( $_GET['piko-hide-notice'] ) && isset( $_GET['_piko_notice_nonce'] ) ) {
            if ( ! wp_verify_nonce( $_GET['_piko_notice_nonce'], 'themepiko_hide_notices_nonce' ) ) {
                return;
            }

            add_user_meta($user_id, $this->ignore_key . '_' . $_GET['piko-hide-notice'], 'true', true);
        }
    }

    public function setup_notice() {
        $this->notices['_setup'] = array(
            'message' => '
                <p><strong>Welcome to Xtocky</strong> – You\'re almost ready to start selling :)</p>
                <p><a href="' . admin_url( 'themes.php?page=xtocky-setup' ) . '" class="button-primary">Run the Setup Wizard</a> <a class="button-secondary skip" href="' . esc_url( wp_nonce_url( add_query_arg( 'piko-hide-notice', 'setup' ), 'themepiko_hide_notices_nonce', '_piko_notice_nonce' ) ). '">Skip Setup</a></p>
            '
        );
    }

    public function activation_notice() {
        $this->notices['_activation'] = array(
            'message' => '
                <p><strong>You need to activate Xtocky</strong></p>
                <p><a href="' . admin_url( 'themes.php?page=xtocky-setup' ) . '" class="button-primary">Activate theme</a></p>
            '
        );
    }

    public function update_notice() {
        if( isset( $_GET['_wpnonce'] )) return;

        $this->notices['_update'] = array(
            'message' => '
                    <p>There is a new version of ' . THEMEPIKO_THEME_NAME . ' Theme available.</p>' . $this->major_update( 'msg-b' ) . '
                    <p><a href="' . admin_url( 'update-core.php?force-check=1&theme_force_check=1' ) . '" class="button-primary">Update now</a> <a class="button-secondary skip" href="' . esc_url( wp_nonce_url( add_query_arg( 'piko-hide-notice', 'update' ), 'themepiko_hide_notices_nonce', '_piko_notice_nonce' ) ). '">Dismiss</a></p>
                ',
        );
    }

    private function api_get_version() {

        $raw_response = wp_remote_get($this->api_url . '?theme=' . THEMEPIKO_THEME_SLUG);
        if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)) {
            $response = json_decode($raw_response['body'], true);
            if(!empty($response['version'])) $this->new_version = $response['version'];
        }
    }

    public function update_dismiss() {
        global $current_user;
        #$user_id = $current_user->ID;
        #delete_user_meta($user_id, $this->ignore_key);
    }


    public function update_transient($value, $transient) {
        // if(isset($_GET['theme_force_check']) && $_GET['theme_force_check'] == '1') return false;
        if(isset($_GET['force-check']) && $_GET['force-check'] == '1') return false;
        return $value;
    }


    public function set_update_transient($transient) {
    
        $this->check_for_update();

        if( isset( $transient ) && ! isset( $transient->response ) ) {
            $transient->response = array();
        }

        if( ! empty( $this->information ) && is_object( $this->information ) ) {
            if( $this->is_update_available() ) {
                $transient->response[ $this->theme_name ] = json_decode( json_encode( $this->information ), true );
            }
        }
        // just remove for envator validate issue
        // remove_filter( 'site_transient_update_themes', array( $this, 'update_transient' ), 20, 2 );

        return $transient;
    }


    public function api_results($result, $action, $args) {
    
        $this->check_for_update();

        if( isset( $args->slug ) && $args->slug == $this->theme_name && $action == 'theme_information') {
            if( is_object( $this->information ) && ! empty( $this->information ) ) {
                $result = $this->information;
            }
        }

        return $result;
    }


    protected function check_for_update() {
        $force = false;

        // if( isset( $_GET['theme_force_check'] ) && $_GET['theme_force_check'] == '1') $force = true;

        if( isset( $_GET['force-check'] ) && $_GET['force-check'] == '1') $force = true;

        // Get data
        if( empty( $this->information ) ) {
            $version_information = get_option( 'xtocky-update-info', false );
            $version_information = $version_information ? $version_information : new stdClass;
            
            $this->information = is_object( $version_information ) ? $version_information : maybe_unserialize( $version_information );
            
        }
        
        $last_check = get_option( 'xtocky-update-time' );
        if( $last_check == false ){ 
            update_option( 'xtocky-update-time', time() );
        }
        
        if( time() - $last_check > 172800 || $force || $last_check == false ){
            
            $version_information = $this->api_info();

            if( isset( $version_information ) ) {
                update_option( 'xtocky-update-time', time() );
                
                // $this->information          = $version_information;
                // $this->information->checked = time();
                // $this->information->url     = $this->url;
                // $this->information->package = $this->download_url();

            }

        }
        
        // Save results
        update_option( 'xtocky-update-info', $this->information );
    }

    public function api_info() {
        $version_information = new stdClass;

        $response = wp_remote_get( $this->api_url . 'info/' . $this->theme_name . '?plugin=piko-core' );
        $response_code = wp_remote_retrieve_response_code( $response );

        if( $response_code != '200' ) {
            return array();
        }

        $response = json_decode( wp_remote_retrieve_body( $response ) );
        if( ! isset( $response ) || ! isset( $response->new_version ) || empty( $response->new_version ) ) {
            return $version_information;
        } 

        $version_information = $response;

        return $version_information;
    }

    public function is_update_available() {
        return version_compare( $this->current_version, $this->release_version(), '<' );
    }

    public function download_url() {
        return 'https://themepiko.com/api/envato/' . 'files/get/' . $this->theme_name . '.zip?token=' . $this->api_key;
    }
    public function release_version() {
        $this->check_for_update();

        if ( isset( $this->information ) && isset( $this->information->new_version ) ) {
            return $this->information->new_version;
        }
    }


    public function activate( $purchase, $args ) {

        $data = array(
            'api_key' => $args['token'],
            'theme' => 'xtocky_',
            'purchase' => $purchase,
        );

        foreach ( $args as $key => $value ) {
           $data['item'][$key] = $value;
        }

        update_option( 'envato_purchase_code_20528207', $purchase );
        update_option( 'xtocky_activated_data', maybe_unserialize( $data ) );
        update_option( 'xtocky_is_activated', true );
    }

    public function process_form() {
        if( isset( $_POST['xtocky-purchase-code'] ) && ! empty( $_POST['xtocky-purchase-code'] ) ) {
            $code = trim( $_POST['purchase-code'] );

            if( empty( $code ) ) {
               echo  '<p class="piko-message piko-error">Oops, the code is missing, please, enter it to continue.</p>';
                return;
            }

            $theme_id = 20528207;
            $response = wp_remote_get( $this->api_url . 'activate/' . $code . '?envato_id='. $theme_id .'&domain=' .$this->domain() );
            $response_code = wp_remote_retrieve_response_code( $response );

            if( $response_code != '200' ) {
                echo  '<p class="piko-message piko-error">API request call error. Contact your server providers and ask to update OpenSSL system library to the 1.0 version</p>';
                return;
            }

            $data = json_decode( wp_remote_retrieve_body($response), true );

            if( isset( $data['error'] ) ) {
               echo  '<p class="piko-message piko-error">' . $data['error'] . '</p>';
                return;
            } 

            if( ! $data['verified'] ) {
               echo  '<p class="piko-message piko-error">Sorry, the code is incorrect, try again.</p>';
                return;
            }

            $this->activate( $code, $data );

            echo '<div class="purchase-default"><p class="themepiko-purchase"><i class="piko-admin-icon piko-key"></i> <span>' . substr($code, 0, -8) . '********' . '</span></p>
                <span class="piko-button piko-button-active piko_theme-deactivator no-loader last-button">' . esc_html__( 'Deactivate theme', 'xtocky' ) . '</span>
                    <p class="piko-message piko-error">
                    ' . esc_html__('One standard license is valid only for 1 website. Running multiple websites on a single license is a copyright violation. When moving a site from one domain to another please deactivate the theme first.', 'xtocky') . '
                </p></div>';
            echo '<script type="text/javascript"> setTimeout( function() { window.location.href = window.location.href; }, 2000 ); </script>';


        }
    }
    
    public function domain() {
        $domain = get_option('siteurl'); //or home
        $domain = str_replace('http://', '', $domain);
        $domain = str_replace('https://', '', $domain);
        $domain = str_replace('www', '', $domain); //add the . after the www if you don't want it
        return urlencode($domain);
    }

    public function major_update( $type = 'msg' ) {

        // ! major update versions
        $versions = array( '1.5', '2.0');

        // ! current release version
        $release = $this->release_version();

        if ( ! in_array( $release , $versions ) ) return;

        $message = esc_html__( 'This is major theme update! Please, do the backup of your files and database before proceed to update. If you use WC plugin make sure that its version is 3.5 or higher.', 'xtocky' );

        switch ( $type ) {
            case 'msg':
                $return = $message;
                break;
            case 'msg-b':
                $return = '<p class="piko_major-update">' . $message . '</p>';
                break;
            case 'ver':
                $return = $release;
                break;
            case 'both':
                $return['msg'] = $message;
                $return['ver'] = $release;
                break;
            default:
                $return = $release;
                break;
        }
        return $return;
    }

    public function major_update_holder() {
        $major_update = $this->major_update( 'both' );
        echo '<span class="hidden piko_major-version" data-version="' . $major_update['ver'] . '" data-message="' . $major_update['msg'] . '"></span>';
    }

}

if(!function_exists('xtocky_check_theme_update')) {
    add_action('init', 'xtocky_check_theme_update');
    function xtocky_check_theme_update() {
        new Xtocky_Check_Version();
    }
}

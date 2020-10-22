<?php

if ( !function_exists( 'xtocky_custom_login' ) ) {
    
    /**
     * Custom login inherit from wp_login_form 
     **/
    
    /**
     * Provides a simple login form for use anywhere within WordPress. By default, it echoes
     * the HTML immediately. Pass array('echo'=>false) to return the string instead.
     *
     * @since 3.0.0
     *
     * @param array $args Configuration options to modify the form output.
     * @return string|null String when retrieving, null when displaying.
     */
    function xtocky_custom_login( $args = array() ) {
        global $wp;
    	$defaults = array(
    		'echo' => true,
    		'redirect' => home_url( add_query_arg( array(), $wp->request ) ), // Default redirect is back to the current page
    		'form_id' => 'loginform',
    		'label_username' => esc_html__( 'Username', 'xtocky' ),
    		'label_password' => esc_html__( 'Password', 'xtocky' ),
    		'label_remember' => esc_html__( 'Remember Me', 'xtocky' ),
    		'label_log_in' => esc_html__( 'Log In', 'xtocky' ),
    		'id_username' => 'user_login',
    		'id_password' => 'user_pass',
    		'id_remember' => 'rememberme',
    		'id_submit' => 'wp-submit',
    		'remember' => true,
    		'value_username' => '',
    		'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
            'lost_pass_link' => home_url( add_query_arg( array(), $wp->request ) ), // Default redirect is back to the current page
            'show_lost_pass_link' => true,
            'show_register_link' => true,
    	);
    
    	/**
    	 * Filter the default login form output arguments.
    	 *
    	 * @since 3.0.0
    	 *
    	 * @see wp_login_form()
    	 *
    	 * @param array $defaults An array of default login form arguments.
    	 */
    	$args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );
    
    	/**
    	 * Filter content to display at the top of the login form.
    	 *
    	 * The filter evaluates just following the opening form tag element.
    	 *
    	 * @since 3.0.0
    	 *
    	 * @param string $content Content to display. Default empty.
    	 * @param array  $args    Array of login form arguments.
    	 */
    	$login_form_top = apply_filters( 'login_form_top', '', $args );
    
    	/**
    	 * Filter content to display in the middle of the login form.
    	 *
    	 * The filter evaluates just following the location where the 'login-password'
    	 * field is displayed.
    	 *
    	 * @since 3.0.0
    	 *
    	 * @param string $content Content to display. Default empty.
    	 * @param array  $args    Array of login form arguments.
    	 */
    	$login_form_middle = apply_filters( 'login_form_middle', '', $args );
    
    	/**
    	 * Filter content to display at the bottom of the login form.
    	 *
    	 * The filter evaluates just preceding the closing form tag element.
    	 *
    	 * @since 3.0.0
    	 *
    	 * @param string $content Content to display. Default empty.
    	 * @param array  $args    Array of login form arguments.
    	 */
    	$login_form_bottom = apply_filters( 'login_form_bottom', '', $args );
        
        $lost_pass_link = '';
        if ( $args['show_lost_pass_link'] === true ) {
            $lost_pass_link = '<a class="lost-pass-link" href="' . esc_url( wp_lostpassword_url( get_permalink() ) ) . '" title="' . esc_html__( 'Forgot Your Password', 'xtocky' ) . '">' . esc_html__( 'Forgot Your Password', 'xtocky' ) . '</a>';
        }
        
        $register_url = home_url( add_query_arg( array(), $wp->request ) );
        $register_url = esc_url( add_query_arg( array( 'action' => 'register' ), $register_url ) );
        $login_socaial = "[apsl-login-lite]";
    
    	$form = '
    		<form name="' . esc_attr( $args['form_id'] ) . '" id="' . esc_attr( $args['form_id'] ) . '" class="login-form" action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '" method="post">
    			' . $login_form_top . '
    			<div class="login-username form-group label-overlay">
                            <input type="text" name="log" id="' . esc_attr( $args['id_username'] ) . '" class="input form-control" value="' . esc_attr( $args['value_username'] ) . '" required />
                            <label class="lb-user-login input-desc"><i class="input-icon icon-user" aria-hidden="true"></i>' . esc_html( $args['label_username'] ) . '<span class="input-required">*</span></label>
                        </div>
    			<div class="login-password form-group label-overlay">    				
    				<input type="password" name="pwd" id="' . esc_attr( $args['id_password'] ) . '" class="input form-control" value="" />
                                <label class="lb-user-pw input-desc"><i class="input-icon icon-lock2" aria-hidden="true"></i>' .esc_html( $args['label_password'] ) . '<span class="input-required">*</span></label>
    			</div><!-- /.login-password -->
                <div class="login-submit form-group">
                    <button type="submit">' . sanitize_text_field( $args['label_log_in'] ) . '</button>
    				<input type="hidden" name="redirect_to" value="' . esc_url( $args['redirect'] ) . '" />
    			</div><!-- /.login-submit -->
    			' . $login_form_middle . '
                <div class="bottom-login">
    			' . ( $args['remember'] ? '<div class="checkbox-remember"><label class="lb-remember"><input name="rememberme" type="checkbox" id="' . esc_attr( $args['id_remember'] ) . '" value="forever"' . ( $args['value_remember'] ? ' checked="checked"' : '' ) . ' /> ' . esc_html( $args['label_remember'] ) . '</label></div>' : '' ) . '
                ' . $lost_pass_link . '
                ' . wp_nonce_field( 'ajax-login-nonce', 'login-ajax-nonce', true, false ) . '
                </div><!-- /.bottom-login -->
    			' . $login_form_bottom . '
    		</form>';
        
    	if ( $args['echo'] ) {
    		echo do_shortcode( $form );
    	}
        else{
            return do_shortcode( $form );
        }
        if(class_exists( 'APSL_Lite_Class' )){
            echo do_shortcode($login_socaial);
        }	
    }
    
    
}


/**
 * Do login via ajax 
 **/
function xtocky_do_login_via_ajax() {
    global $current_user;
    
    $response = array(
        'html' => '',
        'is_logged_in' => is_user_logged_in() ? 'yes' : 'no',
        'message' => ''
    );
    
    if ( $response['is_logged_in'] == 'yes' ) {
        $response['message'] = '<p class="text-primary bg-primary login-message">' . esc_html__( 'You are logged in!', 'xtocky' ) . '</p>';
        wp_send_json( $response );
        die();
    }
    
    $user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : '';
    $user_pass = isset( $_POST['user_pass'] ) ? $_POST['user_pass'] : '';
    $rememberme = isset( $_POST['rememberme'] ) ? $_POST['rememberme'] == 'yes' : false;
    //$redirect_to = isset( $_POST['redirect_to'] ) ? esc_url( $_POST['redirect_to'] ) : '';
    $login_nonce = isset( $_POST['login_nonce'] ) ? $_POST['login_nonce'] : '';
    
    if ( !wp_verify_nonce( $login_nonce, 'ajax-login-nonce' ) ) {
        $response['message'] = '<p class="text-danger bg-danger login-message">' . esc_html__( 'Security check error!', 'xtocky' ) . '</p>';
        wp_send_json( $response );
        die(); 
    }
    
    if ( trim( $user_login ) == '' ) {
        $response['message'] = '<p class="text-danger bg-danger login-message">' . esc_html__( 'User name can not be empty!', 'xtocky' ) . '</p>';
        wp_send_json( $response );
        die();
    }
    
    $info = array();
    $info['user_login'] = $user_login;
    $info['user_password'] = $user_pass;
    $info['remember'] = $rememberme;
    
    $user_signon = wp_signon( $info, false );
    
    if ( is_wp_error( $user_signon ) ) {
        $response['message'] = '<p class="text-danger bg-danger login-message">' . esc_html__( 'Wrong username or password.', 'xtocky' ) . '</p>';
    } else {
        $response['is_logged_in'] = 'yes';
        $response['message'] = '<p class="text-success bg-success login-message">' . esc_html__( 'Logged in successfully', 'xtocky' ) . '</p>';
        $response['html'] = '<h3>' . esc_html__( 'Welcome', 'xtocky' ) . '</h3>
                            <p>' . sprintf( esc_html__( 'Hello %s!', 'xtocky' ), $current_user->display_name ) . '</p>';
    }
    
    wp_send_json( $response );
    
    die();
}
add_action( 'wp_ajax_nopriv_xtocky_do_login_via_ajax', 'xtocky_do_login_via_ajax' );
add_action( 'wp_ajax_xtocky_do_login_via_ajax', 'xtocky_do_login_via_ajax' );

function xtocky_do_register_via_ajax() {
    
    $response = array(
        'html' => '',
        'register_ok' => 'no',
        'message' => ''
    );
    
    $username = isset( $_POST['username'] ) ? $_POST['username'] : '';
    $email = isset( $_POST['email'] ) ? $_POST['email'] : '';
    $password = isset( $_POST['password'] ) ? $_POST['password'] : '';
    $repassword = isset( $_POST['repassword'] ) ? $_POST['repassword'] : '';
    $agree = isset( $_POST['agree'] ) ? $_POST['agree'] : 'no';
    $register_nonce = isset( $_POST['register_nonce'] ) ? $_POST['register_nonce'] : '';
    
    if ( !wp_verify_nonce( $register_nonce, 'ajax-register-nonce' ) ) {
        $response['message'] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'Security check error!', 'xtocky' ) . '</p>';
        wp_send_json( $response );
        die(); 
    }
    
    if ( trim( $username ) == '' ) {
        $response['message'] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'User name can not be empty!', 'xtocky' ) . '</p>';
        wp_send_json( $response );
        die();
    }
    
    if ( !is_email( $email ) ) {
        $response['message'] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'The Email Address is in an invalid format!', 'xtocky' ) . '</p>';
        wp_send_json( $response );
        die();
    }
    
    if ( trim( $password ) == '' ) {
        $response['message'] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'Please enter a password!', 'xtocky' ) . '</p>';
        wp_send_json( $response );
        die();
    }
    
    if ( trim( $password ) != trim( $repassword ) ) {
        $response['message'] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'Passwords did not match. Please try again!', 'xtocky' ) . '</p>';
        wp_send_json( $response );
        die();
    }    
    if ( trim( $agree ) != 'yes' ) {
        $response['message'] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'You must agree to our terms of use!', 'xtocky' ) . '</p>';
        wp_send_json( $response );
        die();
    }
    
    $user_id = username_exists( $username );
    
    if ( !$user_id and email_exists( $email ) == false ) {
    	$user_id = wp_create_user( $username, $password, $email );
        if ( !is_wp_error( $user_id ) ) {
            $response['register_ok'] = 'yes';
            $response['message'] = '<p class="text-success bg-success register-message">' . esc_html__( 'Thank you! Registered successfully, now you can login.', 'xtocky' ) . '</p>';
        }
        else{
            $response['message'] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'Registration failed. Please try again latter!', 'xtocky' ) . '</p>';
        }
    } else {
        $response['message'] = '<p class="text-danger bg-danger register-message">' . esc_html__( 'User already exists.', 'xtocky' ) . '</p>';
    }
    
    wp_send_json( $response );
    
    die();
}
add_action( 'wp_ajax_nopriv_xtocky_do_register_via_ajax', 'xtocky_do_register_via_ajax' );

<?php
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}
$class_login = is_user_logged_in() ? 'logged-in' : 'not-logged-in';
$login_form_args = array(
	'echo' => true,
	'form_id' => 'loginform',
	'label_username' => esc_html__( 'Username or email address ', 'xtocky' ),
	'label_password' => esc_html__( 'Password ', 'xtocky' ),
	'label_remember' => esc_html__( 'Remember Me', 'xtocky' ),
	'label_log_in' => esc_html__( 'LogIn Account', 'xtocky' ),
	'id_username' => 'user_login',
	'id_password' => 'user_pass',
	'id_remember' => 'rememberme',
	'id_submit' => 'wp-submit',
	'remember' => true,
	'value_username' => '',
	'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
);

$login_div_id = uniqid( 'piko-login-form-' );
$redister_div_id = uniqid( 'piko-register-form-' );

$wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id', '' );
$logout_endpoint = get_option( 'woocommerce_logout_endpoint', '' );
$my_count_page = get_option( 'woocommerce_myaccount_page_id', 0 );
$my_account_url = get_current_user_id() != 0 ? get_edit_user_link( get_current_user_id() ) : wp_login_url();
$logout_url = wp_logout_url();

if ( intval( $my_count_page ) > 0 && class_exists( 'WooCommerce' ) ) {
    $my_account_url = get_permalink( $my_count_page );
    if ( trim( $logout_endpoint ) != '' ) {
        $logout_url = rtrim( $my_account_url, '/' ) . '/' . $logout_endpoint;
    }
}
?>

<div id="piko-show-account" class="piko-show-account fullheight <?php echo esc_attr( $class_login ); ?>">
    <?php if ( is_user_logged_in() ): ?>
    
        <div class="piko-my-account">
            <h4><?php
            $login_socaial = "[apsl-login-lite]";
            $userName =  $GLOBALS['current_user']->display_name;
            
            if(class_exists( 'APSL_Lite_Class' )){
               $userName = do_shortcode($login_socaial); 
            }
            
            
            echo sprintf( esc_html__( 'Welcome %s', 'xtocky' ), $userName ); ?>
            
            </h4>
            <?php if ( class_exists( 'WooCommerce' ) ): ?>
                <ol class="link-external">
                    <li><a href="<?php echo esc_url( $my_account_url ); ?>"><?php esc_html_e( 'My account', 'xtocky' ); ?></a></li>
                    <?php if ( class_exists( 'YITH_WCWL' ) && trim( $wishlist_page_id ) != '' ): ?>
                        <li><a href="<?php echo esc_url( get_permalink( $wishlist_page_id ) ); ?>"><?php esc_html_e( 'My wishlist', 'xtocky' ); ?></a></li>
                    <?php endif; // End if ( class_exists( 'YITH_WCWL' ) ) ?>
                    <li><a href="<?php echo esc_url( $logout_url ); ?>"><?php esc_html_e( 'Logout', 'xtocky' ); ?></a></li>
                </ol>                
            <?php endif; // End if ( !class_exists( 'WooCommerce' ) ): ?>
        </div><!-- /.piko-my-account -->
        
    <?php else: ?>
        
        <div class="piko-my-account">
            <div class="inner-my-acount">                
            <div id="<?php echo esc_attr( $login_div_id ); ?>" class="piko-login-form piko-my-account-form show slide">
                <span class="title"><?php esc_html_e( 'Login Form', 'xtocky' ); ?></span>
                <?php xtocky_custom_login( $login_form_args ); ?>
                <span class="hr"></span>
                    <span class="no-account"><?php esc_html_e( 'Don\'t have account?', 'xtocky' ); ?></span>
                    <a href="#<?php echo esc_attr( $redister_div_id ); ?>" class="piko-togoleform button"><?php esc_html_e( 'Register Now', 'xtocky' ); ?></a>
             </div><!-- /.piko-login-form -->
                <?php
                    $terms_of_use_url = isset(  $GLOBALS['xtocky']['optn_terms_of_use_url'] ) ? esc_url(  $GLOBALS['xtocky']['optn_terms_of_use_url'] ) : '';
                ?>
                <div id="<?php echo esc_attr( $redister_div_id ); ?>" class="piko-register-form piko-my-account-form">
                    <span class="title"><?php esc_html_e( 'Register Form', 'xtocky' ); ?></span>
                    
                    <form name="registerform" class="register-form" method="POST" >
                        <div class="form-group label-overlay">
                            <input type="text" class="form-control" id="username" name="username" />                            
                            <label class="input-desc"><i class="input-icon input-icon icon-user" aria-hidden="true"></i><?php esc_html_e( 'Enter your username ', 'xtocky' ); ?> <span class="input-required">*</span></label>
                        </div>
                        <div class="form-group label-overlay">
                            <input type="text" class="form-control" id="email-register" name="email" />                           
                            <label class="input-desc"><i class="input-icon icon-envalop2" aria-hidden="true"></i><?php esc_html_e( 'Enter your email ', 'xtocky' ); ?> <span class="input-required">*</span></label>
                        </div>
                        <div class="form-group label-overlay">
                             <input type="password" class="form-control" id="password" name="password" />
                            <label class="input-desc"><i class="input-icon icon-lock2" aria-hidden="true"></i><?php esc_html_e( 'Enter your password ', 'xtocky' ); ?><span class="input-required">*</span></label>
                        </div>
                        <div class="form-group label-overlay">
                             <input type="password" class="form-control" id="confirm-password" name="confirm-password" />
                            <label class="input-desc"><i class="input-icon icon-lock2" aria-hidden="true"></i><?php esc_html_e( 'Enter Confirm Password ', 'xtocky' ); ?><span class="input-required">*</span></label>
                        </div>
                        <div class="remember">
                            <label><input type="checkbox" name="agree" /> <?php echo esc_html__( 'I Agree To The ', 'xtocky' ); ?>
                                <?php if ( trim( $terms_of_use_url ) != '' ): ?>
                                    <a href="<?php echo esc_url( $terms_of_use_url ); ?>" target="_blank"><?php esc_html_e( 'Terms Of Use ?', 'xtocky' ); ?></a>
                                <?php else: ?>
                                    <?php esc_html_e( 'Terms Of Use? ', 'xtocky' ); ?>
                                <?php endif; ?>
                            </label>
                        </div>
                        
                        <?php wp_nonce_field( 'ajax-register-nonce', 'register-ajax-nonce' ); ?>
                        <button type="submit"><?php esc_html_e( 'Register Account', 'xtocky' ); ?></button>
                        <span class="hr"></span>
                        <a href="#<?php echo esc_attr( $login_div_id ); ?>" class="piko-togoleform button"><?php esc_html_e( 'Login Account', 'xtocky' ); ?></a>
                    </form><!-- /.register-form -->
                </div><!-- /piko-register-form -->
            </div><!-- /.inner-my-acount -->
        </div><!-- /.piko-my-account -->
        
    <?php endif; //is_user_logged_in ?>
</div>

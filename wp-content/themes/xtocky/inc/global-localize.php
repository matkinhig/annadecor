<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

$xtocky_woocommerce_global_message_js = array(
			'compare' => array(
				'view' => esc_attr__('View List Compare','xtocky'),
				'success' => esc_attr__('has been added to comparison list.','xtocky'),
				'error' => esc_attr__('An error occurred ,Please try again !','xtocky')
			),
			'wishlist' => array(
				'view' => esc_attr__('View List Wishlist','xtocky'),
				'success' => esc_attr__('has been added to wishlist.','xtocky'),
				'error' => esc_attr__('An error occurred ,Please try again !','xtocky')
			),
			'addcart' => array(
				'view' => esc_attr__('View Cart','xtocky'),
				'success' => esc_attr__('has been added to cart','xtocky'),
				'error' => esc_attr__('An error occurred ,Please try again !','xtocky')
			),
			'global' => array(
				'error' => esc_attr__('An error occurred ,Please try again !','xtocky'),
				'comment_author'    => esc_attr__('Please enter Name !','xtocky'),
				'comment_email'     => esc_attr__('Please enter Email Address !','xtocky'),
				'comment_rating'    => esc_attr__('Please select a rating !','xtocky'),
				'comment_content'   => esc_attr__('Please enter Comment !','xtocky')
			),
    
			//'enable_sticky_header' => xtocky_get_option_data('sticky_header',false) //need to checking
		);

//admin bar and countdown coming soon page
$xtocky_coundown_global_localize = array(
    'html'      => array(
        'countdown_admin_menu' =>  '<div class="date_warp">
                                        <span class="number">%D</span>
                                        <span class="name">' . esc_html__( 'Day', 'xtocky' ) . '</span>
                                    </div>
                                    <div class="date_warp">
                                        <span class="number">%H</span>
                                        <span class="name">' . esc_html__( 'Hour', 'xtocky' ) . '</span>
                                    </div>
                                    <div class="date_warp">
                                        <span class="number">%M</span>
                                        <span class="name">' . esc_html__( 'Min', 'xtocky' ) . '</span>
                                    </div>
                                    <div class="date_warp">
                                        <span class="number">%S</span>
                                        <span class="name">' . esc_html__( 'Sec', 'xtocky' ) . '</span>
                                    </div>',
        
                'countdown' => '<div class="date_warp">
                                <h3 class="number">%D</h3>
                                <h4 class="name">' . esc_html__( 'Days', 'xtocky' ) . '</h4>
                            </div>
                            <div class="date_warp">
                                <h3 class="number">%H</h3>
                                <h4 class="name">' . esc_html__( 'Hours', 'xtocky' ) . '<h4>
                            </div>
                            <div class="date_warp">
                                <h3 class="number">%M</h3>
                                <h4 class="name">' . esc_html__( 'Minutes', 'xtocky' ) . '</h4>
                            </div>
                            <div class="date_warp">
                                <h3 class="number">%S</h3>
                                <h4 class="name">' . esc_html__( 'Seconds', 'xtocky' ) . '</h4>
                            </div>'       
    ),
);
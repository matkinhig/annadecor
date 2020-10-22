<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Redux')) {
    return;
}


// This is your option name where all the Redux data is stored.
$opt_name = "xtocky";
$theme = wp_get_theme();

$args = array(
    'opt_name'             => $opt_name,
    'display_name'         => 'Xtocky ' . esc_html__('Options', 'xtocky') . '<a class="admin-theme-link" href="' . admin_url('admin.php?page=pikoworks') . '">Theme Support</a>',
    'display_version'      => esc_html__('Theme Version: ', 'xtocky') . $theme->get('Version'),
    'menu_type'            => 'submenu',
    'allow_sub_menu'       => true,
    'menu_title'           => esc_html__('Theme Options', 'xtocky'),
    'page_title'           => esc_html__('Theme Options', 'xtocky'),
    'google_api_key'       => '',
    'google_update_weekly' => false,
    'async_typography'     => true,
    //'disable_google_fonts_link' => true,
    'admin_bar'            => false,
    'global_variable'      => '',
    'dev_mode'             => false,
    'update_notice'        => false,
    'customizer'           => true,
    'page_priority'        => 61,
    'page_parent'          => 'pikoworks',
    'page_permissions'     => 'manage_options',
    'menu_icon'            => 'dashicons-admin-generic',
    'last_tab'             => '',
    'page_icon'            => 'icon-themes',
    'page_slug'            => 'theme_options',
    'save_defaults'        => true,
    'default_show'         => false,
    'default_mark'         => '',
    'show_import_export'   => true,
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    'output_tag'           => true,
    'database'             => '',
    'use_cdn'              => true,
    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    ),
    'output'                => true,
    'output_tag'            => true,
    'compiler'              => true,
    'page_permissions'      => 'manage_options',
    'save_defaults'         => true,
    'database'              => 'options',
    'transient_time'        => '3600',
    'show_import_export'    => false,
    'network_sites'         => true
);

Redux::setArgs($opt_name, $args);
//  START general option Fields
Redux::setSection($opt_name, array(
    'title'            => esc_html__('General', 'xtocky'),
    'id'               => 'basic',
    'customizer_width' => '400px',
    'icon'             => 'el el-home',
    'fields'           => array(
        array(
            'id'      => 'main-width-content',
            'type'    => 'button_set',
            'title'   => esc_html__('Main body Content width', 'xtocky'),
            'options' => array(
                'container' => 'Container',
                'container-fluid' => 'Container Fluid',
            ),
            'default' => 'container'
        ),
        
        array(
            'id' => 'container_width_custom',
            'type' => 'text',
            'title' => esc_html__('Container width', 'xtocky'),
            'default' => '1200',
            'validate' => 'numeric',
            'required' => array('main-width-content', '=', 'container', ),
            'desc' => esc_html__('Defined in pixels. Do not add the \'px\' unit and its effect all section tabs container button value.', 'xtocky'),
        ),

        array(
            'id'      => 'optn_enable_loader',
            'type'    => 'switch',
            'title'   => esc_html__('Enable Page Loader', 'xtocky'),
            'default' => '0',
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
        ),
        array(
            'id'       => 'home_preloader',
            'type'     => 'select',
            'title'    => esc_html__('Preloader style', 'xtocky'),
            'options' => array(
                'various-8'    => 'Spinner',
                'various-7'    => 'Spinner 02',
                'round-1'    => 'Round',
                'various-4'    => 'Squre up down',
            ),
            'default'  => 'square-1',
            'required' => array('optn_enable_loader', '=', true,),
        ),
        array(
            'id'       => 'home_preloader_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Preloader background color', 'xtocky'),
            'subtitle' => esc_html__('Set Preloader background color.', 'xtocky'),
            'default'  => array(),
            'required' => array('optn_enable_loader', '=', true,),
        ),
        array(
            'id'       => 'home_preloader_spinner_color',
            'type'     => 'color',
            'title'    => esc_html__('Preloader spinner color', 'xtocky'),
            'subtitle' => esc_html__('Pick a preloader spinner color for the Top Bar', 'xtocky'),
            'default'  => '',
            'validate' => 'color',
            'required' => array('optn_enable_loader', '=', true,),
        ),

    )

));
// coming soon    
Redux::setSection($opt_name, array(
    'title'   => esc_html__('Maintanence Mode', 'xtocky'),
    'subsection' => true,
    'icon'    => 'el el-icon-time',
    'fields' => array(
        array(
            'id'            => 'enable_coming_soon_mode',
            'type'          => 'switch',
            'title'         => esc_html__('Coming soon mode', 'xtocky'),
            'subtitle'      => esc_html__('Turn coming soon mode on/off', 'xtocky'),
            'desc'          => esc_html__('If turn on, All member login then see the site', 'xtocky'),
            'default'       => 0,
            'on'            => esc_html__('On', 'xtocky'),
            'off'           => esc_html__('Off', 'xtocky'),
        ),
        array(
            'id'            => 'coming_soon_date',
            'type'          => 'date',
            'title'         => esc_html__('Date configure', 'xtocky'),
            'required'      => array('enable_coming_soon_mode', '=', 1),
            'subtitle'          => esc_html__('Date is important current date to next date ', 'xtocky'),
        ),
        array(
            'id'            => 'disable_coming_soon_when_date_small',
            'type'          => 'switch',
            'title'         => esc_html__('Coming soon disable when count down date expired', 'xtocky'),
            'default'       => 1,
            'on'            => esc_html__('Disable', 'xtocky'),
            'off'           => esc_html__('Don\'t disable', 'xtocky'),
            'required'      => array('enable_coming_soon_mode', '=', 1),
        ),
        array(
            'id' => 'coming_soon_bg',
            'type' => 'background',
            'url' => true,
            'title' => esc_html__('Coming Soon Background image', 'xtocky'),
            'compiler' => 'true',
            'preview' => 'false',
            'preview_media' => 'true',
            'background-position' => 'false',
            'background-repeat' => 'false',
            'background-size' => 'false',
            'background-attachment' => 'false',
            'default'  => array(
                'background-color' => '',
                'background-image' => ''
            ),
            'output'   => array('background-image'    => '.coming-soon'),
            'required'      => array('enable_coming_soon_mode', '=', 1),
        ),
        array(
            'id'            => 'coming_soon_text',
            'type'          => 'editor',
            'title'         => esc_html__('Coming soon text', 'xtocky'),
            'subtitle'      => esc_html__('Allow custom html and style', 'xtocky'),
            'default'       => wp_kses(__('Unfortunately, we are not quite ready yet. But, you can see our progres above. <a href="help@example.com">help@example.com</a>', 'xtocky'), array('br', 'a' => array('href' => array()), 'b')),
            'required'      => array('enable_coming_soon_mode', '=', 1),
        ),
        array(
            'id'            => 'coming_soon_newsletter_shortcode',
            'type'          => 'text',
            'title'         => esc_html__('Form Shortcode', 'xtocky'),
            'desc' => esc_html__('Mailchimp Shortcode like as: [mc4wp_form id="4430"] if collect email address contact form7 shortcode: [contact-form-7 id="4439" title="Subscribe Form"]', 'xtocky'),
            'required'      => array('enable_coming_soon_mode', '=', 1),
        ),
        array(
            'id'            => 'enable_coming_soon_social',
            'type'          => 'switch',
            'title'         => esc_html__('Social Icon', 'xtocky'),
            'subtitle'      => esc_html__('Social icon on/off', 'xtocky'),
            'required'      => array('enable_coming_soon_mode', '=', 1),
            'default'       => 0,
            'on'            => esc_html__('On', 'xtocky'),
            'off'           => esc_html__('Off', 'xtocky'),
        ),
        array(
            'id'       => 'coming_soon_social',
            'type'     => 'checkbox',
            'title'    => esc_html__('Footer Social Media Icons to display', 'xtocky'),
            'subtitle' => esc_html__('NB: If dont show shocial icon just uncheck. The Social urls taken from Social Media settings tab', 'xtocky'),
            'required'      => array('enable_coming_soon_social', '=', 1),
            'default' => array(
                'facebook' => '1',
                'twitter' => '1',
                'instagram' => '1',
                'flickr' => '1'
            ),
            'options'  => array(
                'facebook'   => 'Facebook',
                'twitter'    => 'Twitter',
                'flickr'     => 'Flickr',
                'instagram'  => 'Instagram',
                'behance'    => 'Behance',
                'dribbble'   => 'Dribbble',
                'git'        => 'Git',
                'linkedin'   => 'Linkedin',
                'pinterest'  => 'Pinterest',
                'yahoo'      => 'Yahoo',
                'delicious'  => 'Delicious',
                'dropbox'    => 'Dropbox',
                'reddit'     => 'Reddit',
                'soundcloud' => 'Soundcloud',
                'google'     => 'Google',
                'google-plus' => 'Google Plus',
                'skype'      => 'Skype',
                'youtube'    => 'Youtube',
                'vimeo'      => 'Vimeo',
                'tumblr'     => 'Tumblr',
                'whatsapp'   => 'Whatsapp',
            ),
        ),
        array(
            'id'      => 'coming_content_position',
            'type'    => 'button_set',
            'title'   => esc_html__('Content Position', 'xtocky'),
            'options' => array(
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ),
            'default' => 'left',
            'required'      => array('enable_coming_soon_mode', '=', 1),
        ),
        array(
            'id'       => 'coming_countdown_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Count font color', 'xtocky'),
            'default'  => '',
            'required'      => array('enable_coming_soon_mode', '=', 1),
            'output'   => array(
                'color'    => '.coming-soon .countdown-section'
            )
        ),
    ),
));
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Performance', 'xtocky'),
    'icon'   => 'el el-dashboard',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'enable_minifile',
            'type'    => 'switch',
            'title'   => esc_html__('Enable Mini File CSS, JS', 'xtocky'),
            'default' => '0',
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
        ),
    )
));
//404 style    
Redux::setSection($opt_name, array(
    'title'   => esc_html__('Page 404', 'xtocky'),
    'icon'    => 'el el-remove-sign',
    'subsection' => true,
    'fields'  => array(
        array(
            'id'       => 'optn_404_bg_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('404 background Color', 'xtocky'),
            'default'  => '',
            'output'   => array(
                'background-color'    => '.error404 .site .piko-content'
            )
        ),
        array(
            'id'       => 'optn_404_404',
            'type'     => 'textarea',
            'title'    => esc_html__('Error numbers', 'xtocky'),
            'default'  => sprintf(wp_kses(__('4<span class="text-custom">0</span>4', 'xtocky'), array('span' => array('class' => array(),)))),
        ),
        array(
            'id'      => 'optn_404_heading',
            'type'    => 'text',
            'title'   => esc_html__('Heading text', 'xtocky'),
            'default' => esc_html__('PAGE NOT FOUND', 'xtocky'),

        ),
        array(
            'id'       => 'optn_404_content',
            'type'     => 'editor',
            'title'    => esc_html__('Content body Text', 'xtocky'),
            'subtitle'     => esc_html__('Custom html allow', 'xtocky'),
            'args'   => array(
                'teeny'            => true,
            ),
            'default'  => esc_html__('Sorry, the page you are looking for is not available. Maybe you want to perform a search?', 'xtocky'),

        ),
        array(
            'id'      => 'optn_404_btn',
            'type'    => 'text',
            'title'   => esc_html__('Button text', 'xtocky'),
            'default' => 'Go Home',

        ),
        array(
            'id'      => 'optn_404_contact_btn',
            'type'    => 'text',
            'title'   => esc_html__('Button Contact link slug', 'xtocky'),
            'default' => 'contact',
        ),
    )
));
//  header option
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Header', 'xtocky'),
    'desc'             => esc_html__('These are really basic fields!', 'xtocky'),
    'customizer_width' => '400px',
    'icon'             => 'dashicons dashicons-archive'
));

//header logo, menu
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Logo upload', 'xtocky'),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'      => 'enable_text_logo',
            'type'    => 'switch',
            'title'   => esc_html__('Text logo', 'xtocky'),
            'default' => '0',
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky')
        ),
        array(
            'id'       => 'text_logo_name',
            'type'     => 'text',
            'title'    => esc_html__('Name your site', 'xtocky'),
            'default'  => esc_html__('Xtocky', 'xtocky'),
            'required' => array('enable_text_logo', '=', 1),
        ),
        array(
            'id'       => 'logo_upload',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__('Logo upload', 'xtocky'),
            'subtitle' => esc_html__('Normal logo', 'xtocky'),
            'compiler' => true,
            'default'  => array(
                'url' => get_template_directory_uri() . '/assets/images/logo/logo.png'
            ),
            'required' => array('enable_text_logo', '=', 0),
        ),
        array(
            'id'       => 'logo_upload_mobile',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__('Mobile, Sticky upload mobile', 'xtocky'),
            'subtitle' => esc_html__('its also work inverse menu', 'xtocky'),
            'compiler' => true,
            'default'  => array(
                'url' => get_template_directory_uri() . '/assets/images/logo/logo-inverse.png'
            ),
            'required' => array('enable_text_logo', '=', 0),
        ),
        array(
            'id' => 'logo_max_width',
            'type' => 'text',
            'title' => esc_html__('Logo Max Width', 'xtocky'),
            'subtitle'       => esc_html__('Numeric value its calculate px, don\'t write px', 'xtocky'),
            'default' => '135'
        ),
        array(
            'id'             => 'logo_size_increase',
            'type'           => 'spacing',
            'mode'           => 'margin',
            'units'          => 'px',
            'units_extended' => 'false',
            'title'          => esc_html__('Increase logo size', 'xtocky'),
            'subtitle'       => esc_html__('Like numeric default 36, its calculate px', 'xtocky'),
            'desc' => esc_html__('Use less value if your logo size big', 'xtocky'),
            'left'          => false,
            'right'          => false,
            'bottom'          => false,
            'output'        => array('.logo, .header-layout-4 .logo,.header-layout-2 .logo'),
            'default'            => array(
                'margin-top'     => '',
                'units'          => 'px',
            ),
        ),
        array(
            'id'             => 'logo_size_increase_sticky',
            'type'           => 'spacing',
            'mode'           => 'margin',
            'units'          => 'px',
            'units_extended' => 'false',
            'title'          => esc_html__('Increase logo size Sticky', 'xtocky'),
            'subtitle'       => esc_html__('Like numeric default 20, its calculate px', 'xtocky'),
            'desc' => esc_html__('Use less value if your logo size big', 'xtocky'),
            'left'          => false,
            'right'          => false,
            'bottom'          => false,
            'output'        => array('.site-header .active-sticky .logo, .header-layout-4  .active-sticky .logo'),
            'default'            => array(
                'margin-top'     => '',
                'units'          => 'px',
            ),
        ),
        array(
            'id'             => 'logo_size_mobile_logo',
            'type'           => 'spacing',
            'mode'           => 'margin',
            'units'          => 'px',
            'units_extended' => 'false',
            'title'          => esc_html__('Mobile logo Adjustment', 'xtocky'),
            'desc' => esc_html__('Use less value if your logo size big', 'xtocky'),
            'left'          => false,
            'right'          => false,
            'bottom'          => false,
            //                'output'        => array('.site-header .sticky-menu-header:not(.active-sticky) .logo .site-logo-image + .site-logo-image, .header-layout-4 .logo .site-logo-image + .site-logo-image'),
            'default'            => array(
                'margin-top'     => '',
                'units'          => 'px',
            ),
        ),
    )
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Custom Favicon', 'xtocky'),
    'subsection' => true,
    'fields'     => array(
        array(
            'id' => 'optn_favicon',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Custom favicon', 'xtocky'),
            'subtitle' => esc_html__('Upload a 16px x 16px Png/Gif/ico image that will represent your website favicon', 'xtocky'),
            'compiler' => true,
            'default'  => array(
                'url' => get_template_directory_uri() . '/assets/images/logo/favicon.png'
            )
        ),
        array(
            'id' => 'custom_ios_title',
            'type' => 'text',
            'title' => esc_html__('Custom iOS Bookmark Title', 'xtocky'),
            'subtitle' => esc_html__('Enter a custom title for your site for when it is added as an iOS bookmark.', 'xtocky'),
            'default' => ''
        ),
        array(
            'id' => 'custom_ios_icon57',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Custom iOS 57x57', 'xtocky'),
            'subtitle' => esc_html__('Upload a 57px x 57px Png image that will be your website bookmark on non-retina iOS devices.', 'xtocky'),
        ),
        array(
            'id' => 'custom_ios_icon72',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Custom iOS 72x72', 'xtocky'),
            'subtitle' => esc_html__('Upload a 72px x 72px Png image that will be your website bookmark on non-retina iOS devices.', 'xtocky'),
        ),
        array(
            'id' => 'custom_ios_icon114',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Custom iOS 114x114', 'xtocky'),
            'subtitle' => esc_html__('Upload a 114px x 114px Png image that will be your website bookmark on retina iOS devices.', 'xtocky'),
        ),
        array(
            'id' => 'custom_ios_icon144',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Custom iOS 144x144', 'xtocky'),
            'subtitle' => esc_html__('Upload a 144px x 144px Png image that will be your website bookmark on retina iOS devices.', 'xtocky'),
        ),

    )
));

//header main menu 
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Menu Layout', 'xtocky'),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'      => 'full_width_menu',
            'type'    => 'button_set',
            'title'   => esc_html__('Manu width', 'xtocky'),
            'options' => array(
                'container' => 'Container',
                'container-fluid' => 'Container Fluid',
            ),
            'default' => 'container-fluid'
        ),
        array(
            'id'       => 'menu_style',
            'type'     => 'image_select',
            'title'    => esc_html__('Manu style', 'xtocky'),
            'subtitle' => esc_html__('Select a header layout option from the examples.', 'xtocky'),
            'options' => array(
                '1' => array('alt'   => 'style 1', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-1.jpg'),
                '2' => array('alt'   => 'style 2', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-2.jpg'),
                '3' => array('alt'   => 'style 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-3.jpg'),
                '4' => array('alt'   => 'style 4', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-4.jpg'),
                '5' => array('alt'   => 'style 5', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-5.jpg'),
                '6' => array('alt'   => 'style 6', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-6.jpg'),
                '7' => array('alt'   => 'style 7', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-7.jpg'),
            ),
            'default' => '1'
        ),
        array(
            'id'      => 'menu_bar_right_wpml',
            'type'    => 'switch',
            'title'   => esc_html__('Main Menu WPML Language Switcher', 'xtocky'),
            'default' => '0',
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
        ),
        array(
            'id'       => 'menu_login_form',
            'type'     => 'button_set',
            'title'    => esc_html__('Login Menu or From', 'xtocky'),
            'subtitle' => esc_html__('Login Menu mean? Primary Login Menu', 'xtocky'),
            'default' => '0',
            'options' => array(
                '0' => esc_html__('None', 'xtocky'),
                '1' => esc_html__('Login Menu', 'xtocky'),
                '2' => esc_html__('Login Form', 'xtocky'),
            ),
            'default' => '1'
        ),
        array(
            'id'       => 'menu_custom_text',
            'type'     => 'textarea',
            'title'    => esc_html__('Custom Text', 'xtocky'),
            'subtitle' => esc_html__('NB: add Your custom text flowing html', 'xtocky'),
            'required' => array('menu_style', '=', array('4')),
            'default'  => '',
            'desc'  =>  esc_attr('<ul>
                                <li>
                                   <i class="fa fa-truck" aria-hidden="true"></i>
                                   <span>Free Delivery</span>
                                   <p>on local zone</p>
                                </li>
                                <li>
                                   <i class="fa fa-phone" aria-hidden="true"></i>
                                   <span class="text-custom">(+1700) 000 888</span>
                                   <p>call us now</p>
                                </li>
                            </ul>'),

        ),
        array(
            'id'      => 'enable_main_menu_category',
            'type'    => 'switch',
            'title'   => esc_html__('Enable Secondary category vertical Menu', 'xtocky'),
            'default' => '0',
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
            'required' => array('menu_style', '=', array('4', '5')),
        ),
        array(
            'id'       => 'main_menu_category_title',
            'type'     => 'text',
            'title'    => esc_html__('Category menu title', 'xtocky'),
            'default'    => esc_html__('ALL CATEGORIES', 'xtocky'),
            'required' => array('enable_main_menu_category', '=', 1),
        ),
        array(
            'id'      => 'main_menu_category_open',
            'type'    => 'switch',
            'title'   => esc_html__('Category vertical Menu Open Fontpage', 'xtocky'),
            'subtitle' => esc_html__('Fontpage Always show other page show, when hover', 'xtocky'),
            'default' => '1',
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
            'required' => array('enable_main_menu_category', '=', 1),
        ),
        array(
            'id' => 'vertical_menu_sidebar',
            'type' => 'select',
            'title' => esc_html__('Vertical menu bottom Sidebar', 'xtocky'),
            'subtitle' => "Choose Your sidebar",
            'data'      => 'sidebars',
            'default' => '',
            'required' => array('menu_style', '=', array('3')),
        ),
        array(
            'id' => 'main_menu_bg',
            'type' => 'background',
            'url' => true,
            'title' => esc_html__('Menu Background Image', 'xtocky'),
            'compiler' => 'true',
            'preview' => 'true',
            'preview_media' => 'true',
            'background-size' => 'true',
            'background-attachment' => 'true',
            'output'   => array('background-image'    => '.header-wrapper .site-header,.header-layout-7 .site-header .header-main .menu4')
        ),
        array(
            'title' => esc_html__('Mobile header tools icon Color', 'xtocky'),
            'subtitle' => esc_html__('when you select header Background color or image', 'xtocky'),
            'id' => 'mobile_header_tools_color',
            'type' => 'color',
            'transparent' => false,
        ),
    )
));
//header top menu 
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Top Menu', 'xtocky'),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'      => 'enable_top_bar',
            'type'    => 'switch',
            'title'   => esc_html__('Top bar.', 'xtocky'),
            'default' => '0',
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disable', 'xtocky'),
        ),
        array(
            'id' => 'tob_menu_Bar_configure',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 style="margin: 0;">Tob Menu Configuration</h3>',
            'required' => array('enable_top_bar', '=', 1),
        ),
        array(
            'id'      => 'menu_top_bar_wpml_area',
            'type'    => 'button_set',
            'title'   => esc_html__('Language Switcher Position', 'xtocky'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'none' => 'None',
            ),
            'default' => 'right',
            'required' => array('enable_top_bar', '=', 1),
        ),
        array(
            'id'      => 'menu_top_bar_currency',
            'type'    => 'switch',
            'title'   => esc_html__('Currency Switcher', 'xtocky'),
            'default' => '0',
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
            'required' => array('menu_top_bar_wpml_area', '=', array('left', 'right')),
        ),
        array(
            'id'      => 'menu_top_bar_wpml',
            'type'    => 'switch',
            'title'   => esc_html__('WPML Language Switcher', 'xtocky'),
            'default' => '0',
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
            'required' => array('menu_top_bar_wpml_area', '=', array('left', 'right')),
        ),
        array(
            'title' => esc_html__('Top Menu Bar Custom Text', 'xtocky'),
            'subtitle' => esc_html__('If empty noting show anything.', 'xtocky'),
            'id' => 'top_bar_infotext',
            'type' => 'textarea',
            'required' => array('top_bar_left', '=', array('custom', 'both'),),
            'default' => '',
            'desc'  =>  esc_attr('You can easily put custom text like this: You can easily put custom text like this: <ul>
                        <li><i class="fa fa-phone"></i>(123) 4567 890</li>
                        <li><i class="fa fa-clock-o"></i>MON - SAT: 08 am - 17 pm</li>
                        <li><i class="fa fa-envelope-o"></i><a href="mailto:support@example.com">Support@example.com</a></li>
                </ul> or without html markup text: Now shipping to Canada '),
            'required' => array('enable_top_bar', '=', 1),
        ),
        array(
            'id'      => 'top_menu_social_area',
            'type'    => 'button_set',
            'title'   => esc_html__('Social icon Position', 'xtocky'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'none' => 'None',
            ),
            'default' => 'right',
            'required' => array('enable_top_bar', '=', 1),
        ),
        array(
            'id'       => 'top_menu_social',
            'type'     => 'checkbox',
            'title'    => esc_html__('Social Media Icons to display', 'xtocky'),
            'subtitle' => esc_html__('The Social urls taken from Social Media settings tab please enter first the social Urls.', 'xtocky'),
            'required' => array(
                array('top_menu_social_area', '=', array('left', 'right')),
            ),
            'default' => array(
                'facebook' => '1',
                'twitter' => '1',
                'instagram' => '1',
                'flickr' => '1'
            ),
            'options'  => array(
                'facebook'   => 'Facebook',
                'twitter'    => 'Twitter',
                'flickr'     => 'Flickr',
                'instagram'  => 'Instagram',
                'behance'    => 'Behance',
                'dribbble'   => 'Dribbble',
                'git'        => 'Git',
                'linkedin'   => 'Linkedin',
                'pinterest'  => 'Pinterest',
                'yahoo'      => 'Yahoo',
                'delicious'  => 'Delicious',
                'dropbox'    => 'Dropbox',
                'reddit'     => 'Reddit',
                'soundcloud' => 'Soundcloud',
                'google'     => 'Google',
                'google-plus' => 'Google Plus',
                'skype'      => 'Skype',
                'youtube'    => 'Youtube',
                'vimeo'      => 'Vimeo',
                'tumblr'     => 'Tumblr',
                'whatsapp'   => 'Whatsapp',
            ),
        ),
        array(
            'id'        => 'top_menu_border_color',
            'type'      => 'color_rgba',
            'title'     => 'Top Menu border color',
            'subtitle' => esc_html__('Default color use: #e6e6e6;.', 'xtocky'),
            'default'   => array(
                'color'     => '',
                'alpha'     => 1
            ),
            'required' => array('enable_top_bar', '=', 1),
            'output'    => array(
                'border-bottom-color' => '.site-header .header-top',
                'border-right-color' => '.header-top-text .currency, .header-top-text ul > li',
                'border-left-color' => '.top-dropdowns .currency, .top-dropdowns ul > li > a',
            ),
        ),
        array(
            'id'        => 'top_menu_bg_color',
            'type'      => 'color_rgba',
            'title' => esc_html__('Top Menu Background color', 'xtocky'),
            'default'   => array(
                'color'     => '',
                'alpha'     => 1
            ),
            'required' => array('enable_top_bar', '=', 1),
            'output'    => array(
                'background-color' => '.site-header .header-top'
            ),
        ),
        array(
            'title' => esc_html__('Top Menu Link Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #777777.', 'xtocky'),
            'id' => 'top_menu_link_color',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'output'    => array('color' => '.header-top-text > ul > li,.header-top-text ul li a, .top-dropdowns ul > li > a'),
            'required' => array('enable_top_bar', '=', 1),
        ),
        array(
            'title' => esc_html__('Top Menu link icon Color', 'xtocky'),
            'id' => 'top_menu_icon_color',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'required' => array('enable_top_bar', '=', 1),
            'output'    => array('color' => '.header-top-text ul li i,.top-dropdowns .header-dropdown > li > a > i'),
        ),
        array(
            'title' => esc_html__('Top Menu Link Hover Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: ##56cfe1.', 'xtocky'),
            'id' => 'top_menu_link_hover_color',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'required' => array('enable_top_bar', '=', 1),
            'output'    => array('color' => '.header-top-text ul li a:hover,.top-dropdowns li li a:hover,.header-dropdown ul li a i:hover'),
        ),
        array(
            'title' => esc_html__('Top Menu dropdown Background Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #56cfe1.', 'xtocky'),
            'id' => 'top_menu_hover_background_color',
            'type' => 'color',
            'default' => '',
            'transparent' => true,
            'required' => array('enable_top_bar', '=', 1),
            'output'    => array(
                'background-color' => '.top-dropdowns ul > li > ul > li',
                'border-top-color' => '.top-dropdowns ul > li > ul > li > a,.top-dropdowns ul > li > ul > li > a:hover',
            ),
        ),
    )
));
//header main menu config
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Menu Configure', 'xtocky'),
    'subsection' => true,
    'fields'     => array(
        array(
            'id' => 'main_menu_Bar_configure',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 style="margin: 0;">Menu Configuration</h3>',
        ),
        array(
            'id' => 'main_menu_animation',
            'type' => 'select',
            'title' => esc_html__('Main menu animation', 'xtocky'),
            'subtitle' => esc_html__('Dropdown and mega menu', 'xtocky'),
            'options' => array(
                'effect-down'    => 'Effect Down',
                'effect-fadein-down'    => 'Effect fadein down big',
                'effect-fadein-up'  => 'Effect fadein up big',
                'effect-fadein'    => 'Effect Fadein',
            ),
            'default' => 'effect-down',
        ),
        array(
            'id' => 'sub_menu_animation',
            'type' => 'select',
            'title' => esc_html__('Sub menu animation', 'xtocky'),
            'options' => array(
                'subeffect-down'    => 'Subeffect Down',
                'subeffect-fadein-left'    => 'Subeffect fadein left',
                'subeffect-fadein-right'  => 'Subeffect fadein right',
                'subeffect-fadein-up'  => 'Subeffect fadein up',
                'subeffect-fadein-down'  => 'subeffect fadein down',
                'subeffect-fadein'    => 'Subeffect fadein',
            ),
            'default' => 'subeffect-down',
        ),
        array(
            'id'      => 'menu_search',
            'type'    => 'switch',
            'title'   => sprintf(wp_kses(__('<i class="fa fa-search" ></i> Search the icon', 'xtocky'), array('i' => array('class' => array(),)))),
            'default' => '1',
        ),
        array(
            'id' => 'search_ajax',
            'type' => 'switch',
            'title' => esc_html__('AJAX Search', 'xtocky'),
            'default' => false,
            'required' => array('menu_search', '=', 1),
        ),
        array(
            'id' => 'search_ajax_post',
            'type' => 'switch',
            'title' => esc_html__('Search by posts', 'xtocky'),
            'default' => false,
            'required' => array('menu_search', '=', 1),
        ),
        array(
            'id' => 'search_ajax_product',
            'type' => 'switch',
            'title' => esc_html__('Search by products', 'xtocky'),
            'default' => true,
            'required' => array('menu_search', '=', 1),
        ),
        array(
            'id' => 'search_by_sku',
            'type' => 'switch',
            'title' => esc_html__('Search by sku', 'xtocky'),
            'default' => true,
            'required' => array('menu_search', '=', 1),
        ),

        array(
            'id'      => 'show_cart_iocn',
            'type'    => 'switch',
            'title'   => sprintf(wp_kses(__('<i class="fa fa-shopping-cart" ></i> Cart Icon Menu Bar', 'xtocky'), array('i' => array('class' => array(),)))),
            'default' => '1',
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
        ),
        array(
            'id'      => 'mini_cart_layout',
            'type'    => 'button_set',
            'title'   => esc_html__('Cart Layout', 'xtocky'),
            'options' => array(
                'off_canvas' => esc_html__('off Canvas', 'xtocky'),
                'normal' => esc_html__('Normal', 'xtocky'),
            ),
            'default' => 'off_canvas',
            'required' => array('show_cart_iocn', '=', 1),
        ),
        array(
            'id'      => 'disable_top_menu_main_menu',
            'type'    => 'switch',
            'title'   => esc_html__('Disable Top menu from main menu ', 'xtocky'),
            'default' => '1',
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
            'required' => array('menu_style', '=', array('1', '5', '6')),
        ),
    )
));
//main menu color 
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Menu Color configure', 'xtocky'),
    'subsection' => true,
    'fields'     => array(
        array(
            'id' => 'header_bg_options',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3>Header Main color configure</h3>',
        ),
        array(
            'id'        => 'header_background',
            'type'      => 'color_rgba',
            'title'     => 'Header Background Color',
            'default'   => array(
                'color'     => '',
                'alpha'     => 1
            ),
            'output'    => array(
                'background-color' => 'body:not(.header-layout-4):not(.header-layout-5) .site-header .header-main, .header-layout-3 .site-header .header-main, .header-layout-4 .site-header .header-main .menu4, .header-layout-5 .site-header .header-main .menu5',
                'border-bottom-color' => '.site-header .header-main',
            ),
        ),
        array(
            'id'        => 'header_background_middle',
            'type'      => 'color_rgba',
            'title'     => 'Header Middle Background Color',
            'default'   => array(
                'color'     => '',
                'alpha'     => 1
            ),
            'required' => array('menu_style', '=', array('4', '5')),
            'output'    => array(
                'background-color' => '.header-layout-4 .site-header .header-main,.header-layout-5 .site-header .header-main',

            ),
        ),
        array(
            'id'        => 'header_background_middle_text',
            'type'      => 'color',
            'title'     => 'Header Middle text, icon Color',
            'transparent' => false,
            'default' => '',
            'required' => array('menu_style', '=', array('4', '5')),
            'output'    => array(
                'color' => '.tools_button,.tools_button:hover,.header-dropdown.login-dropdown > a > span:not(.dropdown-text), .cart-dropdown a > i, .header-dropdown > li > a > i,.header-boxes-container li,.header-dropdown.lang .amount',

            ),
        ),
        array(
            'title' => esc_html__('Header Link Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #222.', 'xtocky'),
            'id' => 'header_link_color',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'output'    => array(
                'color' => '.header-main .header-dropdown.search-full > a i, .header-layout-2 .header-dropdown.login-dropdown > a > span:not(.dropdown-text),.category-menu .secondary-menu-wrapper .secondary-title,.category-menu .secondary-menu-wrapper .secondary-title:after,.header-layout-3 .mobile-main-menu li.menu-item a, .header-layout-3 .mobile-main-menu li.menu-item h5,.header-layout-3 .mobile-main-menu span.arrow,.header-layout-3 .menu-widgets .widget-title, .header-layout-3 .menu-widgets .social-icons a, .mega-menu > li.menu-item > a, body:not(.header-layout-4):not(.header-layout-5) .cart-dropdown a > i, .header-dropdown > li > a > i, .header-layout-6 .header-dropdown.login-dropdown > a > span:not(.dropdown-text), .header-layout-1 .header-dropdown.login-dropdown > a > span:not(.dropdown-text), .header-search-container > a > i, .header-layout-4 .mega-menu > li.menu-item > a,.header-layout-2 .header-dropdown > a,.header-layout-2 .search-form .overlay-search,.header-layout-3 .cart-dropdown a > i, .header-layout-3 .header-search-container > a > i, .header-layout-3 .mega-menu > li.menu-item > a,.header-layout-3 .header-dropdown.login-dropdown > a > span:not(.dropdown-text),.navbar-toggle button span:not(.icon-line3)'
            ),
        ),
        array(
            'title' => esc_html__('Header Link Background Color', 'xtocky'),
            'subtitle' => esc_html__('Default color no.', 'xtocky'),
            'id' => 'header_link_background_color',
            'type' => 'color',
            'default' => '',
            'transparent' => true,
            'output'    => array('background-color' => '.mega-menu > li.menu-item > a, .header-layout-4 .mega-menu > li.menu-item > a,.header-layout-3 .mega-menu > li.menu-item > a'),

        ),
        array(
            'title' => esc_html__('Header Link Hover Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #ffffff.', 'xtocky'),
            'id' => 'header_link_hover_color',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'output'    => array('color' => '.mega-menu > li:hover > a, .header-layout-4 .mega-menu > li:hover > a, .header-dropdown.cart-dropdown > a .cart-items, .header-layout-5 .mega-menu > li:hover > a,.header-layout-3 .mega-menu>li:hover>a'),

        ),
        array(
            'title' => esc_html__('Header Link Hover Background Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #56cfe1.', 'xtocky'),
            'id' => 'header_link_hover_background_color',
            'type' => 'color',
            'default' => '',
            'transparent' => true,
            'output'    => array('background-color' => '.mega-menu > li:hover > a, .header-layout-4 .mega-menu > li:hover > a, .header-dropdown.cart-dropdown > a .cart-items, .header-layout-5 .mega-menu > li:hover > a,.header-layout-3 .mega-menu > li:hover > a'),

        ),
        array(
            'id' => 'header_dropdown_menu_options',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3>Header Dropdown menu Color configure</h3>',
        ),
        array(
            'title' => esc_html__('Header dropdown Link Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #666666.', 'xtocky'),
            'id' => 'header_dropdown_link_color',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'output'    => array('color' => '.mega-menu .narrow .popup > .inner > ul.sub-menu > li > a,.main-menu-wrap .header-dropdown.lang ul li > a,.main-menu-wrap .header-dropdown.lang ul li a'),

        ),
        array(
            'title' => esc_html__('Header dropdown Link Hover Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #ffffff.', 'xtocky'),
            'id' => 'header_dropdown_link_hover_color',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'output'    => array('color' => '.mega-menu .narrow .popup > .inner > ul.sub-menu > li:hover > a, .mega-menu .narrow .popup > .inner > ul.sub-menu > li.current-menu-item a,.main-menu-wrap .header-dropdown.lang ul li:hover > a,.main-menu-wrap .header-dropdown.lang ul li a:hover'),

        ),
        array(
            'title' => esc_html__('Header dropdown Link Hover Background Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #56cfe1.', 'xtocky'),
            'id' => 'header_dropdown_link_hover_background_color',
            'type' => 'color',
            'default' => '',
            'transparent' => true,
            'output'    => array(
                'background-color' => '.mega-menu .narrow .popup > .inner > ul.sub-menu > li:hover > a, .mega-menu .narrow .popup > .inner > ul.sub-menu > li.current-menu-item a,.main-menu-wrap .header-dropdown.lang ul li:hover > a,.main-menu-wrap .header-dropdown.lang ul li a:hover',
                'border-color' => '.main-menu-wrap .header-dropdown.lang ul li:hover > a, .main-menu-wrap .header-dropdown.lang ul li a:hover',
            ),

        ),
        array(
            'title' => esc_html__('Cart icon background color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #222.', 'xtocky'),
            'id' => 'header_cart_icon_bgcolor',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'output'    => array('background-color' => '.header-layout-7 .header-search-container .btn,.dropdown.header-dropdown.btn-checkout a,.header-search-container .btn,.header-dropdown.cart-dropdown > a .badge-number')
        ),
        array(
            'id' => 'header_sub_menu_options',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3>Header Sub menu Color configure</h3>',
        ),
        array(
            'title' => esc_html__('Header sub Link Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #666666.', 'xtocky'),
            'id' => 'header_sub_link_color',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'output'    => array('color' => '.mega-menu .narrow .popup > .inner > ul.sub-menu ul.sub-menu li a'),
        ),
        array(
            'title' => esc_html__('Header sub Link Hover Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #ffffff.', 'xtocky'),
            'id' => 'header_sub_link_hover_color',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'output'    => array('color' => '.mega-menu .narrow .popup > .inner > ul.sub-menu ul.sub-menu li:hover a, .mega-menu .narrow .popup > .inner > ul.sub-menu ul.sub-menu li.current-menu-item a'),
        ),
        array(
            'title' => esc_html__('Header sub Link Hover Background Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #56cfe1.', 'xtocky'),
            'id' => 'header_dropdown_sub_hover_background_color',
            'type' => 'color',
            'default' => '',
            'transparent' => true,
            'output'    => array('background-color' => '.mega-menu .narrow .popup > .inner > ul.sub-menu ul.sub-menu li:hover a, .mega-menu .narrow .popup > .inner > ul.sub-menu ul.sub-menu  li.current-menu-item a'),
        ),
        array(
            'id' => 'header_mega_menu_options',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3>Header Mega menu Color configure</h3>',
        ),
        array(
            'title' => esc_html__('Header mega Link Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #666666.', 'xtocky'),
            'id' => 'header_mega_link_color',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'output'    => array('color' => '.mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item > h5, .mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item > a, .mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item > h5,.mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item > a'),
        ),
        array(
            'title' => esc_html__('Header mega Link Hover Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #56cfe1.', 'xtocky'),
            'id' => 'header_mega_link_hover_color',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'output'    => array('color' => '.mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item > h5:hover, .mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item > a:hover, .mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item > h5:hover,.mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item > a:hover, .mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item > a:focus, .mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item.current_page_item > a'),
        ),
        array(
            'title' => esc_html__('Header Mega menu Background Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #f9f9f9.', 'xtocky'),
            'id' => 'header_mega_menu_background_color',
            'type' => 'color',
            'default' => '',
            'transparent' => true,
            'output'    => array(
                'background-color' => '.mega-menu .wide .popup > .inner',
                'border-color' => '.mega-menu .wide .popup > .inner',
            ),
        ),
    )
));
//header sticky menu 
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Menu Sticky Mode', 'xtocky'),
    'subsection' => true,
    'fields'     => array(

        array(
            'title' => esc_html__('Sticky Header', 'xtocky'),
            'subtitle' => esc_html__('Enable / Disable the Sticky Header.', 'xtocky'),
            'id' => 'sticky_header',
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
            'type' => 'switch',
            'default' => 0,
        ),
        array(
            'id' => 'header_sticky_options',
            'icon' => true,
            'type' => 'info',
            'required' => array('sticky_header', '=', '1'),
            'raw' => '<h3>Header Sticky color configure</h3>',
        ),
        array(
            'id'        => 'header_sticky_background',
            'type'      => 'color_rgba',
            'title'     => 'Sticky Header Background Color',
            'required' => array('sticky_header', '=', '1'),
            'default'   => array(
                'color'     => '',
                'alpha'     => 1
            ),
            'output'    => array('background-color' => '.site-header .active-sticky, .header-layout-3 .site-header.active-sticky.sticky-menu-header .header-main, ..header-layout-4 .site-header .header-main .menu4.active-sticky,.header-layout-5 .site-header .header-main .menu5.active-sticky'),
        ),
        array(
            'title' => esc_html__('Sticky Header Link Color', 'xtocky'),
            'subtitle' => esc_html__('Default use color: #555555.', 'xtocky'),
            'id' => 'header_sticky_link_color',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'output'    => array('color' => '.active-sticky .mega-menu > li.menu-item > a, .active-sticky .cart-dropdown a > i, .header-layout-3 .active-sticky .header-dropdown.login-dropdown > a > span:not(.dropdown-text), .active-sticky .header-dropdown > li > a > i, .header-layout-6 .active-sticky .header-dropdown.login-dropdown > a > span:not(.dropdown-text),.header-main .header-dropdown.search-full > a i,.header-dropdown.login-dropdown > a > span:not(.dropdown-text), .cart-dropdown a > i, .header-dropdown > li > a > i.header-dropdown.login-dropdown > a > span:not(.dropdown-text), .cart-dropdown a > i, .header-dropdown > li > a > i, .header-layout-1 .active-sticky .header-dropdown.login-dropdown > a > span:not(.dropdown-text), .active-sticky .header-search-container > a > i'),
            'required' => array('sticky_header', '=', '1')
        ),
        array(
            'title' => esc_html__('Sticky Header Link Background Color', 'xtocky'),
            'subtitle' => esc_html__('Default color no.', 'xtocky'),
            'id' => 'header_sticky_link_background_color',
            'type' => 'color',
            'default' => '',
            'transparent' => true,
            'output'    => array('background-color' => '.active-sticky .mega-menu > li.menu-item > a'),
            'required' => array('sticky_header', '=', '1')
        ),
        array(
            'title' => esc_html__('Sticky Header Link Hover Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #ffffff.', 'xtocky'),
            'id' => 'header_sticky_link_hover_color',
            'type' => 'color',
            'default' => '',
            'transparent' => false,
            'output'    => array('color' => '.active-sticky .mega-menu > li:hover > a, .active-sticky .header-dropdown.cart-dropdown > a .cart-items'),
            'required' => array('sticky_header', '=', '1')
        ),
        array(
            'title' => esc_html__('Sticky Header Link Hover Background Color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #56cfe1.', 'xtocky'),
            'id' => 'header_sticky_link_hover_background_color',
            'type' => 'color',
            'default' => '',
            'transparent' => true,
            'output'    => array('background-color' => '.active-sticky .mega-menu > li:hover > a, .active-sticky .header-dropdown.cart-dropdown > a .cart-items'),
            'required' => array('sticky_header', '=', '1')
        ),
    )
));
//header transparency
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Transparency', 'xtocky'),
    'desc'       => esc_html__('Configure your Main Menu Header Transparency Bellow the Option Available', 'xtocky'),
    'subsection' => true,
    'fields'     => array(
        array(
            'title' => esc_html__('Transparency', 'xtocky'),
            'id' => 'header_transparency',
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
            'type' => 'switch',
            'default' => 0,
        ),
        array(
            'id'      => 'header_transparency_option',
            'type'    => 'button_set',
            'title'   => esc_html__('Transparency Action', 'xtocky'),
            'options' => array(
                'fontpage' => esc_html__('Font Page', 'xtocky'),
                'allpage' => esc_html__('All Page', 'xtocky'),
            ),
            'default' => 'fontpage',
            'required' => array('header_transparency', '=', 1),
        ),
        array(
            'type'      => 'color',
            'title' => esc_html__('Font color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #fff.', 'xtocky'),
            'id' => 'header_transparency_font',
            'output'    => array('color' => '.header-transparency .sticky-menu-header:not(.active-sticky) .mega-menu > li > a,.header-transparency .sticky-menu-header:not(.active-sticky) .mega-menu > li > h5,.header-transparency .sticky-menu-header:not(.active-sticky) .header-dropdown.search-full > a i,.header-transparency .sticky-menu-header:not(.active-sticky) .header-dropdown > li > a,.header-transparency .sticky-menu-header:not(.active-sticky) .cart-dropdown a > i,.header-transparency .sticky-menu-header:not(.active-sticky) .header-dropdown > li > a > i,.header-transparency .sticky-menu-header:not(.active-sticky) .header-dropdown.login-dropdown > a > span:not(.dropdown-text)'),
            'default'   => '',
            'required' => array('header_transparency', '=', '1')
        ),
        array(
            'type'      => 'color_rgba',
            'title' => esc_html__('Border color', 'xtocky'),
            'subtitle' => esc_html__('Default color use: #fff.', 'xtocky'),
            'id' => 'header_transparency_border',
            'output'    => array('border-color' => '.header-layout-2 .header-dropdown.login-menu > li > a, .header-layout-2 .header-dropdown > a,.site-header .header-main,.site-header .header-top,.header-top-text .currency, .header-top-text ul > li,.top-dropdowns .currency, .top-dropdowns ul > li > a'),
            'default'   => array(
                'color'     => '',
                'alpha'     => 1
            ),
            'required' => array('header_transparency', '=', '1')
        ),
    )
));

//Breadcrumb
Redux::setSection($opt_name, array(
    'title'   => esc_html__('Breadcrumbs', 'xtocky'),
    'icon'    => 'el el-credit-card',
    'fields'  => array(
        array(
            'title' => esc_html__('Disable Breadcrumbs', 'xtocky'),
            'id' => 'breadcrumbs_disable',
            'on' => esc_html__('Enabled', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
            'type' => 'switch',
            'default' => 1,
        ),
        array(
            'id'      => 'optn_breadcrubm_width',
            'type'    => 'button_set',
            'title'   => esc_html__('Breadcrumb width', 'xtocky'),
            'options' => array(
                'container' => 'Container',
                'container-fluid' => 'Container Fluid',
            ),
            'default' => 'container-fluid',
            'required' => array('breadcrumbs_disable', '=', 1),
        ),
        array(
            'id'       => 'breadcrumb_layout',
            'type'     => 'image_select',
            'title'    => esc_html__('Breadcrumb Layout', 'xtocky'),
            'subtitle' => esc_html__('One Cloumn or Two Cloumn', 'xtocky'),
            'required' => array('breadcrumbs_disable', '=', 1),
            'options'  => array(
                'one_cols'      => array(
                    'alt'   => 'One Cloumn',
                    'img'   => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'two_cols'      => array(
                    'alt'   => 'Two Cloumn',
                    'img'   => get_template_directory_uri() . '/assets/images/theme-options/2columns.png'
                ),
            ),
            'default' => 'one_cols'
        ),
        array(
            'id'      => 'breadcrumb_layout_title',
            'type'    => 'button_set',
            'title'   => esc_html__('Title Align', 'xtocky'),
            'options' => array(
                'title-left' => 'Left',
                'title-right' => 'Right',
            ),
            'default' => 'title-left',
            'required' => array('breadcrumb_layout', '=', 'two_cols'),
        ),
        array(
            'id'       => 'breadcrumbs_prefix',
            'type'     => 'text',
            'title'    => esc_html__('Breadcrumb prefix', 'xtocky'),
            'subtitle' => esc_html__('if empty nothing', 'xtocky'),
            'required' => array('breadcrumbs_disable', '=', 1),
        ),
        array(
            'id'       => 'optn_breadcrumb_name',
            'type'     => 'text',
            'compiler' => true,
            'title'    => esc_html__('Breadcrumb Home Link', 'xtocky'),
            'subtitle' => esc_html__('Default use Home', 'xtocky'),
            'default'  => 'Home',
            'required' => array('breadcrumbs_disable', '=', 1),
        ),
        array(
            'id'       => 'optn_breadcrumb_delimiter',
            'type'     => 'text',
            'compiler' => true,
            'title'    => esc_html__('Breadcrumb delimiter', 'xtocky'),
            'subtitle' => esc_html__('Delimiter use font Awesome class', 'xtocky'),
            'desc'     => sprintf(wp_kses(__('Just use class like as: fa fa-angle-right  <a href="%s" target="__blank">Click font awesome</a>', 'xtocky'), array('a' => array('href' => array(), 'target' => array()))), 'http://fontawesome.io/icons/'),
            'default'  => 'icon-arrow-long-right',
            'required' => array('breadcrumbs_disable', '=', 1),
        ),
        array(
            'title' => esc_html__('Disable title', 'xtocky'),
            'id' => 'page_header_title',
            'on' => esc_html__('Enabled', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
            'type' => 'switch',
            'default' => 1,
            'required' => array('breadcrumbs_disable', '=', 1),
        ),
        array(
            'id'             => 'page_header_font_size',
            'type'           => 'typography',
            'title'          => esc_html__('Page title', 'xtocky'),
            'subtitle' => esc_html__('Font size and color', 'xtocky'),
            'compiler'       => true,
            'google'         => false,
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => false,
            'font-family'    => false,
            'text-align'     => false,
            'font-style'     => false,
            'subsets'        => false,
            'font-size'      => true,
            'line-height'    => true,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array('body:not(.single-product):not(.post-type-archive-product) .page-header h1'),
            'units'          => 'px',
            'default'        => '',
            'required' => array('page_header_title', '=', 1),
        ),
        array(
            'title' => esc_html__('Disable Breadcrumb', 'xtocky'),
            'id' => 'optn_breadcrubm_layout',
            'on' => esc_html__('Enabled', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
            'type' => 'switch',
            'default' => 1,
            'required' => array('breadcrumbs_disable', '=', 1),
        ),

        array(
            'id'       => 'page_link_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Breadcrumb Link Color', 'xtocky'),
            'subtitle' => esc_html__('Default white color', 'xtocky'),
            'required' => array('optn_breadcrubm_layout', '=', 1),
            'output'   => array(
                'color'    => '.page-header:not(.woo-breadcrumb) .breadcrumb a,.page-header:not(.woo-breadcrumb) .breadcrumb i'
            )
        ),
        array(
            'id'       => 'page_link_hover_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Breadcrumb Link hover Color', 'xtocky'),
            'subtitle' => esc_html__('Default white color', 'xtocky'),
            'default'  => '#56cfe1',
            'required' => array('optn_breadcrubm_layout', '=', 1),
            'output'   => array(
                'color'    => '.page-header:not(.woo-breadcrumb) .breadcrumb a:hover'
            )
        ),
        array(
            'id'       => 'page_link_active',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Active & Prefix Color', 'xtocky'),
            'subtitle' => esc_html__('Default white color', 'xtocky'),
            'default'  => '#878787',
            'required' => array('optn_breadcrubm_layout', '=', 1),
            'output'   => array(
                'color'    => '.breadcrumb > .current, .breadcrumb .prefix, .woocommerce-breadcrumb'
            )
        ),
        array(
            'id'             => 'optn_page_title_padding',
            'type'           => 'spacing',
            'mode'           => 'padding',
            'units'          => 'px',
            'units_extended' => 'false',
            'title'          => esc_html__('Breadcrumb padding', 'xtocky'),
            'subtitle'       => esc_html__('This must be numeric (no px). Leave for default.', 'xtocky'),
            'left'          => false,
            'right'          => false,
            'output'        => array('.page-header'),
            'default'            => array(
                'padding-top'     => '30px',
                'padding-bottom'  => '30px',
                'units'          => 'px',
            ),
            'required' => array('breadcrumbs_disable', '=', 1),
        ),
        array(
            'id' => 'optn_header_img',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Header Image', 'xtocky'),
            'compiler' => 'true',
            'subtitle' => esc_html__('Upload header image', 'xtocky'),
            'default'  => array(
                'url' => get_template_directory_uri() . '/assets/images/page-title.gif'
            ),
            'required' => array('breadcrumbs_disable', '=', 1),
        ),
        array(
            'id'       => 'optn_header_img_bg_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Bankground Color', 'xtocky'),
            'output'    => array('background-color' => 'body:not(.single-product):not(.post-type-archive-product) .page-header'),
            'default'  => '',
            'required' => array('breadcrumbs_disable', '=', 1),

        ),
        array(
            'id'       => 'optn_header_img_repeat',
            'type'     => 'button_set',
            'multi'    => false,
            'title'    => esc_html__('Header Image Repeat', 'xtocky'),
            'options'  => array(
                'repeat'   => esc_html__('Repeat', 'xtocky'),
                'no-repeat'  => esc_html__('No repeat', 'xtocky'),
                'fixed'  => esc_html__('Fixed', 'xtocky'),
            ),
            'default'   => 'no-repeat',
            'subtitle' => esc_html__('Header background image repeat', 'xtocky'),
            'required' => array('breadcrumbs_disable', '=', 1),
        ),
        array(
            'id'       => 'optn_header_title_text_align',
            'type'     => 'button_set',
            'multi'    => false,
            'title'    => esc_html__('Breadcrubm Text Align', 'xtocky'),
            'options'  => array(
                'left'   => esc_html__('Left', 'xtocky'),
                'center'  => esc_html__('Center', 'xtocky'),
                'right'  => esc_html__('Right', 'xtocky'),
            ),
            'default'   => 'center',
            'required' => array('breadcrumbs_disable', '=', 1),
        ),
    )
));
//page setup
Redux::setSection($opt_name, array(
    'title' => esc_html__('Page Setting', 'xtocky'),
    'icon'  => 'el el-list-alt',
    'fields'     => array(
        array(
            'id'       => 'optn_page_sidebar_pos',
            'type'     => 'image_select',
            'title'    => esc_html__('Page Layout', 'xtocky'),
            'subtitle' => esc_html__('Select Page layout No Sidebar, Left, Right and both', 'xtocky'),
            'options'  => array(
                'fullwidth'      => array(
                    'alt'   => 'Full Width',
                    'img'   => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'left'      => array(
                    'alt'   => 'Left sidebar',
                    'img'   => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'right'      => array(
                    'alt'   => 'Right sidebar',
                    'img'  => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'both'      => array(
                    'alt'   => 'Both sidebar',
                    'img'  => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default' => 'fullwidth'
        ),
        array(
            'id' => 'optn_page_sidebar',
            'type' => 'select',
            'title' => esc_html__('Page Sidebar', 'xtocky'),
            'subtitle' => "Choose Your sidebar",
            'data'      => 'sidebars',
            'default' => 'sidebar-2',
            'required' => array('optn_page_sidebar_pos', '=', array('left', 'right', 'both'),),
        ),
        array(
            'id' => 'optn_page_sidebar_left',
            'type' => 'select',
            'title' => esc_html__('Page sidebar left', 'xtocky'),
            'subtitle' => "Choose Your sidebar",
            'data'      => 'sidebars',
            'required' => array('optn_page_sidebar_pos', '=', 'both',),
        ),
        array(
            'id'       => 'optn_page_sidebar_width',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Width', 'xtocky'),
            'default'  => 'small',
            'options'  => array(
                'large' => esc_html__('Large(1/4)', 'xtocky'),
                'small' => esc_html__('Small(1/3)', 'xtocky'),
            ),
            'required' => array('optn_page_sidebar_pos', '=', array('left', 'right', 'both'),),
        ),
    )
));


//footer option
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Footer', 'xtocky'),
    'icon'             => 'el el-photo',
    'fields'     => array(
        array(
            'id'      => 'footer-width-content',
            'type'    => 'button_set',
            'title'   => esc_html__('Footer bottom width', 'xtocky'),
            'options' => array(
                'container' => 'Container',
                'container-fluid' => 'Container Fluid',
            ),
            'default' => 'container-fluid'
        ),
        array(
            'id'      => 'optn_footer_bottom_layout',
            'type'    => 'image_select',
            'title'   => esc_html__('Footer bottom layout Design.', 'xtocky'),
            'default' => '3',
            'options'  => array(
                '1'      => array(
                    'alt'   => 'style 1',
                    'img'   => get_template_directory_uri() . '/assets/images/theme-options/footer-bottom1.png'
                ),
                '2'      => array(
                    'alt'   => 'style 2',
                    'img'   => get_template_directory_uri() . '/assets/images/theme-options/footer-bottom2.png'
                ),
                '3'      => array(
                    'alt'   => 'style 3',
                    'img'   => get_template_directory_uri() . '/assets/images/theme-options/footer-bottom3.png'
                ),
                '4'      => array(
                    'alt'   => 'style 4',
                    'img'   => get_template_directory_uri() . '/assets/images/theme-options/footer-bottom4.png'
                ),
            ),
        ),
        array(
            'id'      => 'footer_layout_bg',
            'type'    => 'button_set',
            'title'   => esc_html__('Footer Background Image', 'xtocky'),
            'options' => array(
                '0' => 'Default',
                'bg_img' => 'Background Image',
            ),
            'default' => 'default'
        ),
        array(
            'id'       => 'footer_layout_bg_img',
            'type'     => 'media',
            'title'    => esc_html__('Footer background image', 'xtocky'),
            'compiler' => 'true',
            'preview' => 'true',
            'preview_media' => 'true',
            'required' => array('footer_layout_bg', '=', 'bg_img'),
            'default'  => array(
                'background-color' => '#ffffff'
            )
        ),
        array(
            'id'       => 'sub_footer_text',
            'type'     => 'editor',
            'title'    => esc_html__('Copyright text', 'xtocky'),
            'subtitle' => esc_html__('Something like that default', 'xtocky'),
            'args'   => array(
                'teeny'            => true,
            ),
            'default'  => wp_kses(__('<div class="payment-info">
                        <p>Copyright &nbsp;&copy; All right reserved</p>
                    </div>', 'xtocky'), array('div' => array('class' => array(),), 'h5' => array(), 'p' => array('class' => array()), 'a' => array('href' => array()))),
        ),
        array(
            'id'        => 'optn_payment_logo_upload',
            'type'      => 'gallery',
            'title'    => esc_html__('Payment logo upload', 'xtocky'),
            'subtitle' => esc_html__('Add your payment logo', 'xtocky'),
            'compiler' => true,
        ),
        array(
            'id'       => 'footer_social',
            'type'     => 'checkbox',
            'title'    => esc_html__('Footer Social Media Icons to display', 'xtocky'),
            'subtitle' => esc_html__('The Social urls taken from Social Media settings tab please enter first the social Urls.', 'xtocky'),
            'options'  => array(
                'facebook'   => 'Facebook',
                'twitter'    => 'Twitter',
                'flickr'     => 'Flickr',
                'instagram'  => 'Instagram',
                'behance'    => 'Behance',
                'dribbble'   => 'Dribbble',
                'git'        => 'Git',
                'linkedin'   => 'Linkedin',
                'pinterest'  => 'Pinterest',
                'yahoo'      => 'Yahoo',
                'delicious'  => 'Delicious',
                'dropbox'    => 'Dropbox',
                'reddit'     => 'Reddit',
                'soundcloud' => 'Soundcloud',
                'google'     => 'Google',
                'google-plus' => 'Google Plus',
                'skype'      => 'Skype',
                'youtube'    => 'Youtube',
                'vimeo'      => 'Vimeo',
                'tumblr'     => 'Tumblr',
                'whatsapp'   => 'Whatsapp',
            ),
        ),
        array(
            'id'        => 'footer_bottom_bg_color',
            'type'      => 'color_rgba',
            'title'     => esc_html__('Footer bottom Background Color', 'xtocky'),
            'output'    => array('background-color' => '.footer-bottom'),
            //                'required' => array( 'footer_layout', '=', 'layout3' ),
            'default'   => array(
                'color'     => '#fff',
                'alpha'     => 1
            ),
        ),
        array(
            'id'       => 'footer_bottom_text_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Footer bottom Text and Link Color', 'xtocky'),
            'default'  => '#a8a8a8',
            'output'   => array(
                'color'    => '.footer-bottom, .footer .footer-bottom a:not(.scroll-top), .footer-bottom .payment-info h5, .footer-bottom .footer-menu li + li:before '
            )
        ),
        array(
            'id'       => 'footer_bottom_link_hover_color',
            'type'     => 'color_rgba',
            'compiler' => true,
            'title'    => esc_html__('Footer bottom link hover color', 'xtocky'),
            'default'   => array(
                'color'     => '#56cfe1',
                'alpha'     => 1
            ),
            'output'   => array(
                'background-color' => '.footer-bottom .social-icons .social-icon:hover, .footer-bottom .social-icons .social-icon:focus',
                'color'    => '.footer .footer-bottom a:hover, .footer .footer-bottom a:focus '
            )
        ),

        array(
            'id'       => 'footer_bottom_social_bg_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Footer bottom social icon background color', 'xtocky'),
            'default'  => '#cfcfcf',
            'output'   => array(
                'background-color'    => '.footer-bottom .social-icons .social-icon '
            )
        ),
        array(
            'id'       => 'footer_bottom_social_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Footer bottom social icon color', 'xtocky'),
            'default'  => '#fff',
            'output'   => array(
                'color'    => '.footer-bottom .social-icons i'
            )
        ),
    )
));
//footer option
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Footer Inner', 'xtocky'),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'      => 'footer_inner_width_content',
            'type'    => 'button_set',
            'title'   => esc_html__('Footer inner width', 'xtocky'),
            'options' => array(
                'container' => 'Container',
                'container-fluid' => 'Container Fluid',
            ),
            'default' => 'container'
        ),
        array(
            'id'      => 'footer_widgets',
            'type'    => 'switch',
            'title'   => esc_html__('Footer inner widgets area.', 'xtocky'),
            'default' => 1,
        ),
        array(
            'id'       => 'footer_columns',
            'type'     => 'image_select',
            'title'    => esc_html__('Footer inner columns', 'xtocky'),
            'desc'     => esc_html__('Select the number of columns appear to display in the footer inner.', 'xtocky'),
            'default'  => '5',
            'required' => array('footer_widgets', '=', true,),
            'options'  => array(
                '1'      => array('alt'   => 'style 1', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/1columns.png'),
                '2'      => array('alt'   => 'style 2', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/2columns.png'),
                '3'      => array('alt'   => 'style 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/3columns.png'),
                '4'      => array('alt'   => 'style 4', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/4columns.png'),
                '5'      => array('alt'   => 'style 5', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/5columns.png'),
            ),
        ),
        array(
            'id' => 'optn_footer_Widgets_one',
            'type' => 'select',
            'title' => esc_html__('Footer inner sidebar', 'xtocky'),
            'subtitle' => "Choose Your sidebar",
            'data'      => 'sidebars',
            'required' => array('footer_widgets', '=', true,),
            'default'  => 'sidebar-3',
        ),
        array(
            'id'        => 'footer_inner_bg_color',
            'type'      => 'color_rgba',
            'title'     => esc_html__('Footer inner background Color', 'xtocky'),
            'subtitle'  => esc_html__('Default use #f2f2f2', 'xtocky'),
            'output'    => array('background-color' => '.footer'),
            'default'   => array(
                'color'     => '',
                'alpha'     => 1
            ),
            'required' => array('footer_widgets', '=', 1),
        ),
        array(
            'id'       => 'footer_widgets_title_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Widgets title color', 'xtocky'),
            'subtitle'  => esc_html__('Default use #555555', 'xtocky'),
            'default'  => '',
            'required' => array('footer_widgets', '=', 1),
            'output'   => array(
                'color'    => '.footer .widget .widget-title '
            )
        ),
        array(
            'id'       => 'footer_widgets_link_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Widgets Text and Link Color', 'xtocky'),
            'subtitle'  => esc_html__('Default use #999999', 'xtocky'),
            'default'  => '',
            'required' => array('footer_widgets', '=', 1),
            'output'   => array(
                'color'    => '.footer, .footer a '
            )
        ),

        array(
            'id'        => 'footer_link_hover_color',
            'type'      => 'color_rgba',
            'title'    => esc_html__('Widgets Link hover color', 'xtocky'),
            'subtitle'  => esc_html__('Default use #56cfe1', 'xtocky'),
            'output'   => array(
                'color'    => '.footer a:hover, .footer a:focus '
            ),
            'compiler' => true,
            'default'   => array(
                'color'     => '',
                'alpha'     => 1
            ),
            'required' => array('footer_widgets', '=', 1),
        ),

    )
));
//footer option
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Footer inner top', 'xtocky'),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'      => 'optn_footer_widgets_two',
            'type'    => 'switch',
            'title'   => esc_html__('Enable footer inner top widget area.', 'xtocky'),
            'default' => 0,
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
        ),
        array(
            'id'       => 'optn_footer_columns_two',
            'type'     => 'image_select',
            'title'    => esc_html__('Footer Inner top Columns', 'xtocky'),
            'desc'     => esc_html__('Select the number of columns appear to Display in the footer inner top.', 'xtocky'),
            'default'  => '4',
            'required' => array('optn_footer_widgets_two', '=', true,),
            'options'  => array(
                '1'      => array('alt'   => 'style 1', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/1columns.png'),
                '2'      => array('alt'   => 'style 2', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/2columns.png'),
                '3'      => array('alt'   => 'style 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/3columns.png'),
                '4'      => array('alt'   => 'style 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/4columns.png'),
                '5'      => array('alt'   => 'style 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/5columns.png'),
            ),
        ),
        array(
            'id' => 'optn_footer_Widgets_two',
            'type' => 'select',
            'title' => esc_html__('Footer Inner top Sidebar', 'xtocky'),
            'subtitle' => "Choose Your sidebar",
            'data'      => 'sidebars',
            'required' => array('optn_footer_widgets_two', '=', true,),
            'default'  => 'sidebar-5',
        ),
        array(
            'id'       => 'footer_inner_top_bg_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Footer inner top background Color', 'xtocky'),
            'default'  => '#fcfcfc',
            'required' => array('optn_footer_widgets_two', '=', true,),
            'output'   => array(
                'background-color'    => '.footer-top'
            )
        ),
        array(
            'id'       => 'footer_inner_top_title_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Footer Inner top title color', 'xtocky'),
            'default'  => '#555555',
            'required' => array('optn_footer_widgets_two', '=', true,),
            'output'   => array(
                'color'    => '.footer .footer-top .widget .widget-title '
            )
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer inner top 2', 'xtocky'),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'      => 'optn_footer_widgets_three',
            'type'    => 'switch',
            'title'   => esc_html__('Enable footer inner top 2 widgets area.', 'xtocky'),
            'default' => 0,
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
        ),
        array(
            'id'      => 'footer_inner_top_width_content',
            'type'    => 'button_set',
            'title'   => esc_html__('Footer inner top 2 width', 'xtocky'),
            'options' => array(
                'container' => 'Container',
                'container-fluid' => 'Container Fluid',
            ),
            'default' => 'container-fluid',
            'required' => array('optn_footer_widgets_three', '=', true,),
        ),
        array(
            'id'       => 'optn_footer_columns_three',
            'type'     => 'image_select',
            'title'    => esc_html__('Footer Inner top 2 Columns', 'xtocky'),
            'desc'     => esc_html__('Select the number of columns appear to Display in the footer inner top.', 'xtocky'),
            'default'  => '1',
            'required' => array('optn_footer_widgets_three', '=', true,),
            'options'  => array(
                '1'      => array('alt'   => 'style 1', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/1columns.png'),
                '2'      => array('alt'   => 'style 2', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/2columns.png'),
                '3'      => array('alt'   => 'style 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/3columns.png'),
                '4'      => array('alt'   => 'style 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/4columns.png'),
                '5'      => array('alt'   => 'style 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/5columns.png'),
            ),
        ),
        array(
            'id' => 'optn_footer_Widgets_three',
            'type' => 'select',
            'title' => esc_html__('Footer Inner top 2 Sidebar', 'xtocky'),
            'subtitle' => "Choose Your sidebar",
            'data'      => 'sidebars',
            'required' => array('optn_footer_widgets_three', '=', true,),
            'default'  => 'sidebar-6',
        ),
        array(
            'id'       => 'footer_inner_top_two_bg_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Footer inner top 2 background Color', 'xtocky'),
            'subtitle' => "default use: #fff",
            'default'  => '',
            'required' => array('optn_footer_widgets_three', '=', true,),
            'output'   => array(
                'background-color'    => '.footer-inner-top.has-bg-color'
            )
        ),
        array(
            'id'       => 'footer_inner_top_two_title_color',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Footer Inner top 2 title color', 'xtocky'),
            'default'  => '',
            'required' => array('optn_footer_widgets_three', '=', true,),
            'output'   => array(
                'color'    => '.footer .footer-inner-top .widget .widget-title '
            )
        ),
    )
));


//Blog setup   
Redux::setSection($opt_name, array(
    'title' => esc_html__('Blog Setting', 'xtocky'),
    'icon'  => 'el el-pencil-alt',
    'fields'     => array(
        array(
            'id'       => 'optn_blog_sidebar_pos',
            'type'     => 'image_select',
            'title'    => esc_html__('Blog Layout', 'xtocky'),
            'subtitle' => esc_html__('Select Page layout No Sidebar, Left, Right and both', 'xtocky'),
            'options'  => array(
                'fullwidth'      => array(
                    'alt'   => 'Full Width',
                    'img'   => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'left'      => array(
                    'alt'   => 'Left sidebar',
                    'img'   => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'right'      => array(
                    'alt'   => 'Right sidebar',
                    'img'  => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'both'      => array(
                    'alt'   => 'Both sidebar',
                    'img'  => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default' => 'right'
        ),
        array(
            'id' => 'optn_blog_sidebar',
            'type' => 'select',
            'title' => esc_html__('Blog Sidebar', 'xtocky'),
            'subtitle' => "Choose Your sidebar",
            'data'      => 'sidebars',
            'default' => 'sidebar-1',
            'required' => array('optn_blog_sidebar_pos', '=', array('left', 'right', 'both'),),
        ),
        array(
            'id' => 'optn_blog_sidebar_left',
            'type' => 'select',
            'title' => esc_html__('Page sidebar left', 'xtocky'),
            'subtitle' => "Choose Your sidebar",
            'data'      => 'sidebars',
            'required' => array('optn_blog_sidebar_pos', '=', 'both',),
        ),
        array(
            'id'       => 'optn_blog_sidebar_width',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Width', 'xtocky'),
            'default'  => 'small',
            'options'  => array(
                'large' => esc_html__('Large(1/4)', 'xtocky'),
                'small' => esc_html__('Small(1/3)', 'xtocky'),
            ),
            'required' => array('optn_blog_sidebar_pos', '=', array('left', 'right', 'both'),),
        ),

        array(
            'id' => 'optn_archive_display_type',
            'type' => 'button_set',
            'title' => esc_html__('Archive Display Type', 'xtocky'),
            'subtitle' => esc_html__('Select archive display type', 'xtocky'),
            'default'  => 'default',
            'options'  => array(
                'default' => esc_html__('Default', 'xtocky'),
                'grid' => esc_html__('Grid', 'xtocky'),
                'list' => esc_html__('List', 'xtocky'),
                'masonry' => esc_html__('Masonry', 'xtocky'),
            ),
        ),
        array(
            'id' => 'optn_archive_display_masonry_columns',
            'type' => 'select',
            'title' => esc_html__('Archive Display Columns', 'xtocky'),
            'options' => array(
                '2'        => '2',
                '3'        => '3',
                '4'        => '4',
            ),
            'default' => '2',
            'required' => array('optn_archive_display_type', '=', array('masonry'),),
        ),
        array(
            'id' => 'optn_archive_display_columns',
            'type' => 'select',
            'title' => esc_html__('Archive Display Columns', 'xtocky'),
            'subtitle' => esc_html__('Choose the number of columns to display on archive pages.', 'xtocky'),
            'options' => array(
                '1'        => '1',
                '2'        => '2',
                '3'        => '3',
                '4'        => '4',
            ),
            'default' => '2',
            'required' => array('optn_archive_display_type', '=', array('grid'),),
        ),
        array(
            'id' => 'opt_blog_continue_reading',
            'type' => 'text',
            'title' => esc_html__('Read More Button Text', 'xtocky'),
            'default' => 'Read More',
        ),
        array(
            'id' => 'optn_archive_except_word',
            'type' => 'text',
            'title' => esc_html__('Excerpt Word', 'xtocky'),
            'default' => '55',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => esc_html__('Single Post', 'xtocky'),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'optn_blog_single_sidebar_pos',
            'type'     => 'image_select',
            'title'    => esc_html__('Blog single Layout', 'xtocky'),
            'subtitle' => esc_html__('Select Page layout No Sidebar, Left, Right and both', 'xtocky'),
            'options'  => array(
                'fullwidth'      => array(
                    'alt'   => 'Full Width',
                    'img'   => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'left'      => array(
                    'alt'   => 'Left sidebar',
                    'img'   => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'right'      => array(
                    'alt'   => 'Right sidebar',
                    'img'  => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'both'      => array(
                    'alt'   => 'Both sidebar',
                    'img'  => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default' => 'fullwidth'
        ),
        array(
            'id' => 'optn_blog_single_sidebar',
            'type' => 'select',
            'title' => esc_html__('Blog single Sidebar', 'xtocky'),
            'subtitle' => "Choose Your sidebar",
            'data'      => 'sidebars',
            'default' => 'sidebar-1',
            'required' => array('optn_blog_single_sidebar_pos', '=', array('left', 'right', 'both'),),
        ),
        array(
            'id' => 'optn_blog_single_sidebar_left',
            'type' => 'select',
            'title' => esc_html__('Page sidebar left', 'xtocky'),
            'subtitle' => "Choose Your sidebar",
            'data'      => 'sidebars',
            'required' => array('optn_blog_single_sidebar_pos', '=', 'both',),
        ),
        array(
            'id'       => 'optn_blog_single_sidebar_width',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Width', 'xtocky'),
            'default'  => 'small',
            'options'  => array(
                'large' => esc_html__('Large(1/4)', 'xtocky'),
                'small' => esc_html__('Small(1/3)', 'xtocky'),
            ),
            'required' => array('optn_blog_single_sidebar_pos', '=', array('left', 'right', 'both'),),
        ),
        array(
            'id' => 'blog_single_social_share',
            'type' => 'switch',
            'title' => esc_html__('Social share links', 'xtocky'),
            'default' => 0,
        ),
        array(
            'id'       => 'blog_single_social_share_page',
            'type'     => 'select',
            'multi'    => true,
            'title'    => esc_html__('Choose socials to share single post', 'xtocky'),
            'required' => array('blog_single_social_share', '=', true,),
            'options'  => array(
                'facebook'  => 'Facebook',
                'gplus'     => 'Google Plus',
                'twitter'   => 'Twitter',
                'pinterest' => 'Pinterest',
                'linkedin'  => 'Linkedin',
            ),
            'sortable' => true,
            'default'  => array('facebook', 'gplus', 'twitter', 'pinterest', 'linkedin'),
        ),
        array(
            'id'       => 'optn_blog_post_metatag_single',
            'type'     => 'select',
            'multi'    => true,
            'title'    => esc_html__('Add Extra Meta option', 'xtocky'),
            'options'  => array(
                'format' => esc_html__('Post Format', 'xtocky'),
                'view' => esc_html__('Post view', 'xtocky'),
                'love' => esc_html__('Post love', 'xtocky'),
            ),
        ),
        array(
            'id'      => 'optn_blog_single_related_post',
            'type'    => 'switch',
            'title'   => esc_html__('Disable Related post', 'xtocky'),
            'default' => 0,
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
        ),
        array(
            'id'      => 'optn_blog_single_related_target',
            'type'    => 'button_set',
            'title'   => esc_html__('Related Target post', 'xtocky'),
            'default' => 'cats',
            'options'  => array(
                'cats' => esc_html__('Categories', 'xtocky'),
                'tags' => esc_html__('Tags', 'xtocky'),
            ),
            'required' => array('optn_blog_single_related_post', '=', 1),
        ),
        array(
            "type"        => "text",
            "title"     => esc_html__("Related post load", 'xtocky'),
            "subtitle" => esc_html__('Default use 3 post', 'xtocky'),
            "id"  => "optn_blog_single_related_post_per",
            "default"       => "3",
            'validate' => 'numeric',
            'required' => array('optn_blog_single_related_post', '=', 1),
        ),
        array(
            "type"        => "select",
            "title"     => esc_html__("Related post Column", 'xtocky'),
            "id"  => "optn_blog_single_related_post_col",
            "default"       => "1",
            'options'  => array(
                '1' => esc_html__('1 Column', 'xtocky'),
                '2' => esc_html__('2 Column', 'xtocky'),
            ),
            'required' => array('optn_blog_single_related_post', '=', 1),
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => esc_html__('Search Page', 'xtocky'),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'optn_search_sidebar_pos',
            'type'     => 'image_select',
            'title'    => esc_html__('Blog single Layout', 'xtocky'),
            'subtitle' => esc_html__('Select Page layout No Sidebar, Left, Right and both', 'xtocky'),
            'options'  => array(
                'fullwidth'      => array(
                    'alt'   => 'Full Width',
                    'img'   => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'left'      => array(
                    'alt'   => 'Left sidebar',
                    'img'   => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'right'      => array(
                    'alt'   => 'Right sidebar',
                    'img'  => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'both'      => array(
                    'alt'   => 'Both sidebar',
                    'img'  => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default' => 'fullwidth'
        ),
        array(
            'id' => 'optn_search_sidebar',
            'type' => 'select',
            'title' => esc_html__('Blog single Sidebar', 'xtocky'),
            'subtitle' => "Choose Your sidebar",
            'data'      => 'sidebars',
            'required' => array('optn_search_sidebar_pos', '=', array('left', 'right', 'both'),),
            'default' => 'sidebar-1',
        ),
        array(
            'id' => 'optn_search_sidebar_left',
            'type' => 'select',
            'title' => esc_html__('Page sidebar left', 'xtocky'),
            'subtitle' => "Choose Your sidebar",
            'data'      => 'sidebars',
            'required' => array('optn_search_sidebar_pos', '=', 'both',),
        ),
        array(
            'id'       => 'optn_search_sidebar_width',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Width', 'xtocky'),
            'default'  => 'small',
            'options'  => array(
                'large' => esc_html__('Large(1/4)', 'xtocky'),
                'small' => esc_html__('Small(1/3)', 'xtocky'),
            ),
            'required' => array('optn_search_sidebar_pos', '=', array('left', 'right', 'both'),),
        ),
        array(
            'id' => 'optn_search_except_word',
            'type' => 'text',
            'title' => esc_html__('Excerpt Word', 'xtocky'),
            'default' => '300',
        ),
    )
));
//    Redux::setSection( $opt_name, array(
//        'title'   => esc_html__( 'Custom Post type', 'xtocky' ),        
//        'icon'    => 'el el-screenshot',
//        'fields'  => array(
//                    array(
//                        'id' => 'optn_cpt_disable',
//                        'type' => 'checkbox',
//                        'title' => esc_html__('Disable Custom Post Types', 'xtocky'),
//                        'subtitle' => esc_html__( 'Check is Disable or Uncheck is Enable', 'xtocky' ),
//                        'desc' => esc_html__('If you do not needs any custom post just check, Then reloaded WP Admin panel.', 'xtocky'),
//                        'options' => array(
//                            'portfolio' => 'Portfolio',
//                            'ourteam' => 'Our Team',
//                            'testimonial' => 'Testimonial'                            
//                        ),
//                        'default' => array(
//                            'portfolio' => '0',
//                            'ourteam' => '0',
//                            'testimonial' => '0'
//                            
//                        )
//                    ),
//              )
//    )); 
//portfolio style 
Redux::setSection($opt_name, array(
    'title'   => esc_html__('Portfolio Single', 'xtocky'),
    'icon'    => 'el el-th-large',
    //        'subsection' => true,
    'fields'  => array(
        array(
            'id' => 'portfolio-single-style',
            'type' => 'button_set',
            'title' => esc_html__('Single Portfolio Layout', 'xtocky'),
            'subtitle' => esc_html__('Select Single Portfolio Layout', 'xtocky'),
            'desc' => '',
            'options' => array(
                'detail-01' => esc_html__('Horizontal Slide', 'xtocky'),
                'detail-02' => esc_html__('Verticle Image', 'xtocky'),
                'detail-03' => esc_html__('Slide with Sidebar', 'xtocky'),
            ),
            'default' => 'detail-01'
        ),
        array(
            'id'      => 'optn_portfolio_content_sticky',
            'type'    => 'switch',
            'title'   => esc_html__('Content sticky', 'xtocky'),
            'subtitle' => esc_html__('When scroll contect sticky', 'xtocky'),
            'default' => false,
            'required' => array('portfolio-single-style', '=', 'detail-02',),
        ),
        array(
            'id'       => 'portfolio_single_sidebar_pos',
            'type'     => 'image_select',
            'title'    => esc_html__('Single Portfolio Sideber Position', 'xtocky'),
            'subtitle' => esc_html__('Select single position Left sidebar and Right sidebar', 'xtocky'),
            'options'  => array(
                'left'      => array(
                    'alt'   => 'Left sidebar',
                    'img'   => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'right'      => array(
                    'alt'   => 'Right sidebar',
                    'img'  => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
            ),
            'default' => 'right',
            'required' => array('portfolio-single-style', '=', 'detail-03',),
        ),
        array(
            'id' => 'portfolio_single_sidebar',
            'type' => 'select',
            'title' => esc_html__('Portfolio Single Sidebar', 'xtocky'),
            'subtitle' => "Choose Your sidebar",
            'data'      => 'sidebars',
            'required' => array('portfolio-single-style', '=', 'detail-03',),

        ),
        array(
            'id'      => 'optn_portfolio_social_shear',
            'type'    => 'switch',
            'title'   => esc_html__('Disable Portfolio Social Shear', 'xtocky'),
            'subtitle' => esc_html__('Enable or Disable Social shear', 'xtocky'),
            'default' => 1,
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),
        ),
        array(
            'id'       => 'show_portfolio_related',
            'type'     => 'switch',
            'title'    => esc_html__('Disable Related Portfolio', 'xtocky'),
            'subtitle' => esc_html__('Enable or Disable related in single portfolio', 'xtocky'),
            'default' => 1,
            'on' => esc_html__('Enable', 'xtocky'),
            'off' => esc_html__('Disabled', 'xtocky'),

        ),
        array(
            "type"        => "text",
            'subtitle' => esc_html__('Responsive Portfolio Related Column.', 'xtocky'),
            "id"  => "p_related_items_large_device",
            "default"       => "4",
            "title" => esc_html__('Large Device Column', 'xtocky'),
            'required'  => array('show_portfolio_related', '=', array('1'))
        ),
        array(
            "type"        => "text",
            'subtitle'  => esc_html__("Tab and Mobile auto fixed", 'xtocky'),
            "default"       => "3",
            "id"  => "p_related_items_desktop",
            "title" => esc_html__('Medium Device Column', 'xtocky'),
            'validate' => 'numeric',
            'required'  => array('show_portfolio_related', '=', array('1'))
        ),
    )
));

/**
 * Check if WooCommerce is active
 **/
if (class_exists('WooCommerce')) {
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Woocommerce', 'xtocky'),
        'icon'  => 'el el-shopping-cart',
        'fields'     => array(
            array(
                'id'      => 'woo_archive_widget_enable',
                'type'    => 'switch',
                'title'   => esc_html__('Shop Catalog Sidebar', 'xtocky'),
                'default' => 0,
                'on' => esc_html__('Enable', 'xtocky'),
                'off' => esc_html__('Disabled', 'xtocky'),
            ),
            array(
                'id' => 'woo_archive_widget',
                'type' => 'select',
                'title' => esc_html__('Product Cataglog Sidebar', 'xtocky'),
                'subtitle' => "Choose Your sidebar",
                'data'      => 'sidebars',
                'default' => 'sidebar-8',
                'desc'  => esc_html__('NB: widgets: wp-admin->appearance-> widgets->Shop Catalog Sidebar', 'xtocky'),
                'required'  => array('woo_archive_widget_enable', '=', 1)
            ),
            array(
                'id'       => 'product-border',
                'type'     => 'border',
                'title'    => esc_html__('Product border Option', 'xtocky'),
                'output'   => array('.product-wrap figure .product-image + .product-image,.product-top figure, .woocommerce-product-gallery .slick-slide img, .woocommerce-product-gallery .flex-viewport,.products.products-list .product-top figure')
            ),
            array(
                'title' => esc_html__('Catalog Mode', 'xtocky'),
                'subtitle' => esc_html__('Enable / Disable the Catalog Mode.', 'xtocky'),
                'desc' => esc_html__('When enabled, the feature Turns Off the shopping functionality of compare view.', 'xtocky'),
                'id' => 'catalog_mode',
                'on' => esc_html__('Enabled', 'xtocky'),
                'off' => esc_html__('Disabled', 'xtocky'),
                'type' => 'switch',
                'default'  => false,
            ),
            array(
                'title' => esc_html__('Topbar tool Products per Page on Grid Allowed Values', 'xtocky'),
                'desc' => esc_html__('Comma-separated.', 'xtocky'),
                'id' => 'products_per_page',
                'type' => 'text',
                'default' => '20,25,35'
            ),
            array(
                'title' => esc_html__('Topbar tool Products per Page On Grid Default', 'xtocky'),
                'id' => 'products_per_page_default',
                'min' => '1',
                'step' => '1',
                'max' => '80',
                'type' => 'slider',
                'edit' => '1',
                'default' => '20',
            ),
            array(
                'title' => esc_html__('Topbar tool Products per Page on List Allowed Values', 'xtocky'),
                'desc' => esc_html__('Comma-separated.', 'xtocky'),
                'id' => 'products_per_page_list',
                'type' => 'text',
                'default' => '20,25,35'
            ),
            array(
                'title' => esc_html__('Topbar tool Products per Page On List Default', 'xtocky'),
                'id' => 'products_per_page_list_default',
                'min' => '1',
                'step' => '1',
                'max' => '80',
                'type' => 'slider',
                'edit' => '1',
                'default' => '20',
            ),
            array(
                'id' => 'ajaxcart_show_minicart',
                'type' => 'button_set',
                'title' => esc_html__('Show Mini Cart', 'xtocky'),
                'subtitle' => esc_html__('Mini cart is open after ajax product add to cart ', 'xtocky'),
                'options' => array(
                    'body' => esc_html__('Enable', 'xtocky'),
                    'body.single-product' => esc_html__('Disable', 'xtocky'),
                ),
                'default' => 'body.single-product',
            ),
            array(
                'id'      => 'optn_show_new_product_label',
                'type'    => 'switch',
                'title'   => esc_html__('New product label', 'xtocky'),
                'default' => 1,
                'on' => esc_html__('Enable', 'xtocky'),
                'off' => esc_html__('Disabled', 'xtocky'),
            ),
            array(
                "type"        => "text",
                "title" => esc_html__('How many days show', 'xtocky'),
                "id"  => "optn_new_product_label",
                "default"       => "30",
                'validate' => 'numeric',
                'required'  => array('optn_show_new_product_label', '=', 1)
            ),
            array(
                "type"        => "text",
                "title" => esc_html__('Label Text', 'xtocky'),
                "id"  => "optn_new_product_label_text",
                "default"       => "New",
                'required'  => array('optn_show_new_product_label', '=', 1)
            ),
            array(
                "type"        => "text",
                "title" => esc_html__('Out of stock label', 'xtocky'),
                'subtitle'     => esc_html__('if empty dont show label', 'xtocky'),
                "id"  => "optn_product_out_of_stock_label",
                "default"       => "Out of stock",
            ),

        )
    ));
    //woo Breadcrumb
    Redux::setSection($opt_name, array(
        'title'   => esc_html__('Breadcrumbs', 'xtocky'),
        'subsection' => true,
        'fields'  => array(
            array(
                'title' => esc_html__('Disable Breadcrumbs Layout', 'xtocky'),
                'id' => 'woo_breadcrumbs_disable',
                'on' => esc_html__('Enabled', 'xtocky'),
                'off' => esc_html__('Disabled', 'xtocky'),
                'type' => 'switch',
                'default' => 1,
            ),
            array(
                'id'       => 'woo_breadcrumb_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Breadcrumb Layout', 'xtocky'),
                'subtitle' => esc_html__('One Cloumn or Two Cloumn', 'xtocky'),
                'required' => array('woo_breadcrumbs_disable', '=', 1),
                'options'  => array(
                    'one_cols'      => array(
                        'alt'   => 'One Cloumn',
                        'img'   => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'two_cols'      => array(
                        'alt'   => 'Two Cloumn',
                        'img'   => get_template_directory_uri() . '/assets/images/theme-options/2columns.png'
                    ),
                ),
                'default' => 'two_cols'
            ),
            array(
                'id' => 'optn_archive_header_img',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Header Backgrund Image', 'xtocky'),
                'compiler' => 'true',
                'subtitle' => esc_html__('Upload header Backgrund image', 'xtocky'),
                'default'  => array(
                    'url' => get_template_directory_uri() . '/assets/images/page-title.gif'
                ),
                'required' => array('woo_breadcrumbs_disable', '=', 1),
            ),
            array(
                'id'       => 'woo_archive_header_img_bg_color',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__('Bankground Color', 'xtocky'),
                'output'    => array('background-color' => '.page-header.woo-breadcrumb'),
                'default'  => '#f4f4f4',
                'required' => array('woo_breadcrumbs_disable', '=', 1),

            ),
            array(
                'id'      => 'woo_breadcrumb_layout_title',
                'type'    => 'button_set',
                'title'   => esc_html__('Title Align', 'xtocky'),
                'options' => array(
                    'title-left' => esc_html__('Left', 'xtocky'),
                    'title-right' => esc_html__('Right', 'xtocky'),
                ),
                'default' => 'title-left',
                'required' => array('woo_breadcrumb_layout', '=', 'two_cols'),
            ),
            array(
                'title' => esc_html__('Disable title', 'xtocky'),
                'id' => 'woo_page_header_title',
                'on' => esc_html__('Enabled', 'xtocky'),
                'off' => esc_html__('Disabled', 'xtocky'),
                'type' => 'switch',
                'default' => 0,
                'required' => array('woo_breadcrumbs_disable', '=', 1),
            ),
            array(
                'id'             => 'woo_page_header_font_size',
                'type'           => 'typography',
                'title'          => esc_html__('Page title', 'xtocky'),
                'subtitle' => esc_html__('Font size and color', 'xtocky'),
                'compiler'       => true,
                'google'         => false,
                'font-backup'    => false,
                'all_styles'     => true,
                'font-weight'    => false,
                'font-family'    => false,
                'text-align'     => false,
                'font-style'     => false,
                'subsets'        => false,
                'font-size'      => true,
                'line-height'    => false,
                'word-spacing'   => false,
                'letter-spacing' => false,
                'color'          => true,
                'preview'        => true,
                'output'         => array('.page-header.woo-breadcrumb h1'),
                'units'          => 'px',
                'default'        => array(
                    'font-size' => '18px',
                    'color' => '#333',
                ),
                'required' => array('woo_page_header_title', '=', 1),
            ),
            array(
                'title' => esc_html__('Disable Breadcrumb', 'xtocky'),
                'id' => 'woo_disable_breadcrubm',
                'on' => esc_html__('Enabled', 'xtocky'),
                'off' => esc_html__('Disabled', 'xtocky'),
                'type' => 'switch',
                'default' => 1,
                'required' => array('woo_breadcrumbs_disable', '=', 1),
            ),
            array(
                'id'             => 'woo_page_title_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => 'px',
                'units_extended' => 'false',
                'title'          => esc_html__('Breadcrumb padding', 'xtocky'),
                'subtitle'       => esc_html__('This must be numeric (no px). Leave for default.', 'xtocky'),
                'left'          => false,
                'right'          => false,
                'output'        => array('.page-header.woo-breadcrumb'),
                'default'            => array(
                    'padding-top'     => '18px',
                    'padding-bottom'  => '18px',
                    'units'          => 'px',
                ),
                'required' => array('woo_breadcrumbs_disable', '=', 1),
            ),
            array(
                'id'       => 'woo_header_title_text_align',
                'type'     => 'button_set',
                'multi'    => false,
                'title'    => esc_html__('Breadcrubm Text Align', 'xtocky'),
                'options'  => array(
                    'left'   => esc_html__('Left', 'xtocky'),
                    'center'  => esc_html__('Center', 'xtocky'),
                    'right'  => esc_html__('Right', 'xtocky'),
                ),
                'default'   => 'center',
                'required' => array('woo_breadcrumb_layout', '=', 'one_cols'),
            ),

            array(
                'id' => 'woo_single_divide',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;">Single Page Breadcrumbs Configure</h3>',
            ),
            array(
                'title' => esc_html__('Disable single Breadcrumbs Layout', 'xtocky'),
                'id' => 'woo_single_breadcrumbs_disable',
                'on' => esc_html__('Enabled', 'xtocky'),
                'off' => esc_html__('Disabled', 'xtocky'),
                'type' => 'switch',
                'default' => 1,
            ),
            array(
                'id'       => 'woo_single_breadcrumb_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Breadcrumb Layout', 'xtocky'),
                'subtitle' => esc_html__('One Cloumn or Two Cloumn', 'xtocky'),
                'required' => array('woo_single_breadcrumbs_disable', '=', 1),
                'options'  => array(
                    'one_cols'      => array(
                        'alt'   => 'One Cloumn',
                        'img'   => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'two_cols'      => array(
                        'alt'   => 'Two Cloumn',
                        'img'   => get_template_directory_uri() . '/assets/images/theme-options/2columns.png'
                    ),
                ),
                'default' => 'one_cols'
            ),
            array(
                'title' => esc_html__('Disable single page title', 'xtocky'),
                'id' => 'woo_single_header_title',
                'on' => esc_html__('Enabled', 'xtocky'),
                'off' => esc_html__('Disabled', 'xtocky'),
                'type' => 'switch',
                'default' => 0,
                'required' => array('woo_single_breadcrumbs_disable', '=', 1),
            ),
            array(
                'id'             => 'woo_single_page-header_font_size',
                'type'           => 'typography',
                'title'          => esc_html__('Single Page title', 'xtocky'),
                'subtitle' => esc_html__('Font size and color', 'xtocky'),
                'compiler'       => true,
                'google'         => false,
                'font-backup'    => false,
                'all_styles'     => true,
                'font-weight'    => false,
                'font-family'    => false,
                'text-align'     => false,
                'font-style'     => false,
                'subsets'        => false,
                'font-size'      => true,
                'line-height'    => false,
                'word-spacing'   => false,
                'letter-spacing' => false,
                'color'          => true,
                'preview'        => true,
                'output'         => array('.page-header.woo-single h1'),
                'units'          => 'px',
                'default'        => array(
                    'font-size' => '18px',
                    'color' => '#777777',
                ),
                'required' => array('woo_single_header_title', '=', 1),
            ),
            array(
                'id'       => 'woo_single_header_bg_color',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__('Bankground Color', 'xtocky'),
                'output'    => array('background-color' => '.page-header.woo-single'),
                'required' => array('woo_single_breadcrumbs_disable', '=', 1),

            ),
            array(
                'id'             => 'woo_single_page_title_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => 'px',
                'units_extended' => 'false',
                'title'          => esc_html__('Breadcrumb padding', 'xtocky'),
                'subtitle'       => esc_html__('This must be numeric (no px). Leave for default.', 'xtocky'),
                'left'          => false,
                'right'          => false,
                'output'        => array('.page-header.woo-single'),
                'default'            => array(
                    'padding-top'     => '15px',
                    'padding-bottom'  => '15px',
                    'units'          => 'px',
                ),
                'required' => array('woo_single_breadcrumbs_disable', '=', 1),
            ),
            array(
                'id'       => 'woo_single_page_link_color',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__('Single Breadcrumb Link Color', 'xtocky'),
                'default'  => '#777777',
                'required' => array('woo_single_breadcrumbs_disable', '=', 1),
                'output'   => array(
                    'color'    => '.page-header.woo-single .breadcrumb a'
                )
            ),
            array(
                'id'       => 'woo_single_page_link_hover_color',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__('Breadcrumb Link hover Color', 'xtocky'),
                'subtitle' => esc_html__('Default white color', 'xtocky'),
                'default'  => '#56cfe1',
                'required' => array('woo_single_breadcrumbs_disable', '=', 1),
                'output'   => array(
                    'color'    => '.page-header.woo-single .breadcrumb a:hover, .page-header.woo-single .breadcrumb a:focus'
                )
            ),
            array(
                'id'       => 'woo_single_page_link_active',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__('Active  Color', 'xtocky'),
                'default'  => '#b0afaf',
                'required' => array('woo_single_breadcrumbs_disable', '=', 1),
                'output'   => array(
                    'color'    => '.page-header.woo-single .breadcrumb > .current, .page-header.woo-single .breadcrumb .prefix, .page-header.woo-single .woocommerce-breadcrumb'
                )
            ),
            array(
                'id'       => 'woo_single_header_title_text_align',
                'type'     => 'button_set',
                'multi'    => false,
                'title'    => esc_html__('Breadcrubm single Text Align', 'xtocky'),
                'options'  => array(
                    'left'   => esc_html__('Left', 'xtocky'),
                    'center'  => esc_html__('Center', 'xtocky'),
                    'right'  => esc_html__('Right', 'xtocky'),
                ),
                'default'   => 'left',
                'required' => array('woo_single_breadcrumb_layout', '=', 'one_cols'),
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => esc_html__('Shop Page', 'xtocky'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'      => 'shop-width-content',
                'type'    => 'button_set',
                'title'   => esc_html__('Shop body Content width', 'xtocky'),
                'options' => array(
                    'container' => 'Container',
                    'container-fluid' => 'Container Fluid',
                ),
                'default' => 'container'
            ),
            array(
                'id'       => 'catalog_display_type_global',
                'type'     => 'button_set',
                'title'    => esc_html__('Catalog Display Type', 'xtocky'),
                'default' => 'grid',
                'options'  => array(
                    'grid'      => esc_html__('Grid', 'xtocky'),
                    'list'      => esc_html__('List', 'xtocky'),
                )
            ),
            array(
                'id'        => 'optn_woo_products_per_row',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Product Column', 'xtocky'),
                'options'   => array(
                    '2' => array('alt' => '2 Column ',      'img' => get_template_directory_uri() . '/assets/images/theme-options/2columns.png'),
                    '3' => array('alt' => '3 Column ',      'img' => get_template_directory_uri() . '/assets/images/theme-options/3columns.png'),
                    '4' => array('alt' => '4 Column ',      'img' => get_template_directory_uri() . '/assets/images/theme-options/4columns.png'),
                    '5' => array('alt' => '5 Column ',      'img' => get_template_directory_uri() . '/assets/images/theme-options/5columns.png')
                ),
                'default'   => '3',
                'required' => array('catalog_display_type_global', '=', 'grid',),
            ),
            array(
                'id'       => 'optn_woo_products_per_row_mobile',
                'type'     => 'button_set',
                'title'    => esc_html__('Product Column Mobile', 'xtocky'),
                'default'  => '',
                'options'  => array(
                    '' => '1',
                    'mobile' => '2',
                ),
            ),
            array(
                'id'       => 'optn_product_sidebar_pos',
                'type'     => 'image_select',
                'title'    => esc_html__('Archive Product sidebar', 'xtocky'),
                'subtitle' => esc_html__('Select Page layout No Sidebar, Left, Right and both', 'xtocky'),
                'options'  => array(
                    'fullwidth'      => array(
                        'alt'   => 'Full Width',
                        'img'   => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'left'      => array(
                        'alt'   => 'Left sidebar',
                        'img'   => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'right'      => array(
                        'alt'   => 'Right sidebar',
                        'img'  => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),
                    'both'      => array(
                        'alt'   => 'Both sidebar',
                        'img'  => ReduxFramework::$_url . 'assets/img/3cm.png'
                    ),
                ),
                'default' => 'right'
            ),
            array(
                'id' => 'optn_product_sidebar',
                'type' => 'select',
                'title' => esc_html__('Product Sidebar', 'xtocky'),
                'subtitle' => "Choose Your sidebar",
                'data'      => 'sidebars',
                'default' => 'sidebar-4',
                'required' => array('optn_product_sidebar_pos', '=', array('left', 'right', 'both'),),
            ),
            array(
                'id' => 'optn_product_sidebar_left',
                'type' => 'select',
                'title' => esc_html__('Product sidebar left', 'xtocky'),
                'subtitle' => "Choose Your sidebar",
                'data'      => 'sidebars',
                'required' => array('optn_product_sidebar_pos', '=', 'both',),
            ),
            array(
                'id'       => 'optn_product_sidebar_width',
                'type'     => 'button_set',
                'title'    => esc_html__('Sidebar Width', 'xtocky'),
                'default'  => 'small',
                'options'  => array(
                    'large' => esc_html__('Large(1/4)', 'xtocky'),
                    'small' => esc_html__('Small(1/3)', 'xtocky'),
                ),
                'required' => array('optn_product_sidebar_pos', '=', array('left', 'right', 'both'),),
            ),
            array(
                'id'        => 'optn_woo_archive_products_layout',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Archive Product Layout', 'xtocky'),
                'options'   => array(
                    '1' => array('alt' => 'layout 1',      'img' => get_template_directory_uri() . '/assets/images/theme-options/product1.jpg'),
                    '2' => array('alt' => 'layout 2 ',      'img' => get_template_directory_uri() . '/assets/images/theme-options/product2.jpg'),
                    '3' => array('alt' => 'layout 3',      'img' => get_template_directory_uri() . '/assets/images/theme-options/product3.jpg'),
                    '4' => array('alt' => 'layout 4',      'img' => get_template_directory_uri() . '/assets/images/theme-options/product4.jpg'),
                    '5' => array('alt' => 'layout 5',      'img' => get_template_directory_uri() . '/assets/images/theme-options/product5.jpg')
                ),
                'default'   => '1',
            ),
            array(
                'id'       => 'optn_product_image_type',
                'type'     => 'button_set',
                'title'    => esc_html__('Rollover image', 'xtocky'),
                'default'  => 'small',
                'options'  => array(
                    'none' => esc_html__('None', 'xtocky'),
                    'rollover' => esc_html__('Rollover', 'xtocky'),
                    'carousel' => esc_html__('Carousel', 'xtocky'),
                ),
                'default'   => 'none',
            ),
        )
    ));
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Product Page', 'xtocky'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id' => 'enable_single_ajax_cart',
                'type' => 'switch',
                'title' => esc_html__('Single product button AJAX', 'xtocky'),
                'default' => false,
            ),
            array(
                'id'       => 'optn_product_single_sidebar_pos',
                'type'     => 'image_select',
                'title'    => esc_html__('Product single Layout', 'xtocky'),
                'subtitle' => esc_html__('Select Page layout No Sidebar, Left, Right and both', 'xtocky'),
                'options'  => array(
                    'fullwidth'      => array(
                        'alt'   => 'Full Width',
                        'img'   => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'left'      => array(
                        'alt'   => 'Left sidebar',
                        'img'   => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'right'      => array(
                        'alt'   => 'Right sidebar',
                        'img'  => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),
                    'both'      => array(
                        'alt'   => 'Both sidebar',
                        'img'  => ReduxFramework::$_url . 'assets/img/3cm.png'
                    ),
                ),
                'default' => 'right'
            ),
            array(
                'id' => 'optn_product_single_sidebar',
                'type' => 'select',
                'title' => esc_html__('Product single Sidebar', 'xtocky'),
                'subtitle' => "Choose Your sidebar",
                'data'      => 'sidebars',
                'default' => 'sidebar-4',
                'required' => array('optn_product_single_sidebar_pos', '=', array('left', 'right', 'both'),),
            ),
            array(
                'id' => 'optn_product_single_sidebar_left',
                'type' => 'select',
                'title' => esc_html__('Page sidebar left', 'xtocky'),
                'subtitle' => "Choose Your sidebar",
                'data'      => 'sidebars',
                'required' => array('optn_product_single_sidebar_pos', '=', 'both',),
            ),
            array(
                'id'       => 'optn_product_single_sidebar_width',
                'type'     => 'button_set',
                'title'    => esc_html__('Sidebar Width', 'xtocky'),
                'default'  => 'small',
                'options'  => array(
                    'large' => esc_html__('Large(1/4)', 'xtocky'),
                    'small' => esc_html__('Small(1/3)', 'xtocky'),
                ),
                'required' => array('optn_product_single_sidebar_pos', '=', array('left', 'right', 'both'),),
            ),
            array(
                'id'       => 'optn_product_single_layout',
                'type'     => 'button_set',
                'title'    => esc_html__('Porduct layout', 'xtocky'),
                'default'  => 'product',
                'options'  => array(
                    'product' => esc_html__('Layout 1', 'xtocky'),
                    'product-2' => esc_html__('Layout 2', 'xtocky'),
                ),
            ),
            array(
                'id'        => 'optn_woo_single_products_thumbnail',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Single Product Thumbnai', 'xtocky'),
                'options'   => array(
                    'bottom' => array('alt' => 'layout 1',      'img' => get_template_directory_uri() . '/assets/images/theme-options/single-thumb1.png'),
                    'left' => array('alt' => 'layout 2 ',      'img' => get_template_directory_uri() . '/assets/images/theme-options/single-thumb2.png'),
                    'right' => array('alt' => 'layout 3',      'img' => get_template_directory_uri() . '/assets/images/theme-options/single-thumb3.png'),
                ),
                'default'   => 'bottom',
            ),
            array(
                'id' => 'enable_super_zoom',
                'type' => 'switch',
                'title' => esc_html__('Super Zoom', 'xtocky'),
                'subtitle' => esc_html__('Enable / Disable', 'xtocky'),
                'default' => 0,
            ),
            array(
                'id' => 'enable_content_center',
                'type' => 'switch',
                'title' => esc_html__('Product Details center', 'xtocky'),
                'default' => 0,
            ),
            array(
                'id' => 'enable_miscellaneous',
                'type' => 'switch',
                'title' => esc_html__('Miscellaneous', 'xtocky'),
                'subtitle' => esc_html__('Enable / Disable', 'xtocky'),
                'default' => 0,
                'on' => esc_html__('Enable', 'xtocky'),
                'off' => esc_html__('Disabled', 'xtocky'),

            ),
            array(
                'id'            => 'size_guide_title',
                'type'          => 'text',
                'title'         => esc_html__('Size Guide Title', 'xtocky'),
                'default'       => esc_html__('Size Guide', 'xtocky'),
                'required' => array('enable_miscellaneous', '=', array('1'))
            ),
            array(
                'id'       => 'size_guide',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__('Size Guide Image', 'xtocky'),
                'compiler' => true,
                'default'  => array(
                    'url' => ''
                ),
                'required' => array('enable_miscellaneous', '=', array('1'))
            ),
            array(
                'id'            => 'return_policy_title',
                'type'          => 'text',
                'title'         => esc_html__('Shipping & Return Title', 'xtocky'),
                'default'       => esc_html__('Delivery & Return', 'xtocky'),
                'required' => array('enable_miscellaneous', '=', array('1'))
            ),
            array(
                'id'       => 'return_policy',
                'type'     => 'editor',
                'title'    => esc_html__('Shipping & Return Content', 'xtocky'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 10
                ),
                'default'    => '',
                'required' => array('enable_miscellaneous', '=', array('1'))
            ),
            array(
                'id' => 'enable_product_single_post_share',
                'type' => 'switch',
                'title' => esc_html__('Social share links', 'xtocky'),
                'default' => 0,
            ),
            array(
                'id'       => 'single_product_share_socials',
                'type'     => 'select',
                'multi'    => true,
                'title'    => esc_html__('Choose socials to share single product post', 'xtocky'),
                'required' => array('enable_product_single_post_share', '=', true,),
                'options'  => array(
                    'facebook'  => 'Facebook',
                    'gplus'     => 'Google Plus',
                    'twitter'   => 'Twitter',
                    'pinterest' => 'Pinterest',
                    'linkedin'  => 'Linkedin',
                    'email'  => 'Email',
                ),
                'sortable' => true,
                'default'  => array('facebook', 'gplus', 'twitter', 'pinterest', 'linkedin'),
            ),
            array(
                'title' => esc_html__('Related Products', 'xtocky'),
                'id' => 'related_products',
                'type' => 'switch',
                'default' => 1,
            ),
            array(
                'id'       => 'optn_product_single_related_title',
                'subtitle' => esc_html__('left is title left carousel button right', 'xtocky'),
                'type'     => 'button_set',
                'title'    => esc_html__('Title layout', 'xtocky'),
                'default'  => 'left',
                'options'  => array(
                    'left' => esc_html__('Left', 'xtocky'),
                    'center' => esc_html__('Center', 'xtocky'),
                ),
                'required' => array('related_products', '=', 1),
            ),
            array(
                'title' => esc_html__('Upsell Products', 'xtocky'),
                'id' => 'upsell_products',
                'type' => 'switch',
                'default' => 1,
            ),
            array(
                'id'        => 'optn_woo_single_tab_layout',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Single product tab style', 'xtocky'),
                'options'   => array(
                    '1' => array('alt' => 'Layout 1 ',      'img' => get_template_directory_uri() . '/assets/images/theme-options/single-tab1.jpg'),
                    '2' => array('alt' => 'Layout 2 ',      'img' => get_template_directory_uri() . '/assets/images/theme-options/single-tab2.jpg'),
                ),
                'default'   => '1',
            ),
            array(
                'title' => esc_html__('Active tabs', 'xtocky'),
                'subtitle' => esc_html__('if its On active tabs description else first count tabs3 if available its active', 'xtocky'),
                'id' => 'woo_active_tab',
                'type' => 'switch',
                'default' => 1,
            ),
            array(
                'title' => esc_html__('Custom Tab', 'xtocky'),
                'subtitle' => esc_html__('Enable / Disable Custom Tab.', 'xtocky'),
                'id' => 'woo_custom_tab',
                'type' => 'switch',
                'default' => 0,
            ),
            array(
                'id'       => 'custom_tab_title',
                'type'     => 'text',
                'title'    => esc_html__('Custom Tab Title', 'xtocky'),
                'default'  => 'Custom Tab',
                'required' => array('woo_custom_tab', '=', '1')
            ),
            array(
                'id'       => 'custom_tab_content',
                'type'     => 'editor',
                'title'    => esc_html__('Custom Tab Content', 'xtocky'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 10
                ),
                'default' => 'Your custom tab text here dummy text of the printing and typesetting industry.',
                'required' => array('woo_custom_tab', '=', '1')
            ),
        )
    ));
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Product Brand', 'xtocky'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'      => 'show_brand',
                'type'    => 'switch',
                'title'   => esc_html__('Enable/Disable Product Band.', 'xtocky'),
                'default' => 0,
                'on' => esc_html__('Enable', 'xtocky'),
                'off' => esc_html__('Disabled', 'xtocky'),
            ),
            array(
                'id' => 'show_brand_name_achive',
                'type' => 'switch',
                'title' => esc_html__('Brand Name Archive page', 'xtocky'),
                'desc'     => esc_html__('If you need to archive product page product short-code show only product category. just off it', 'xtocky'),
                'default' => true,
                'required' => array(
                    array('show_brand', 'equals', true),
                )
            ),
            array(
                'id' => 'header_dropdown_menu_options',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3>Single Product Page</h3>',
            ),
            array(
                'id' => 'show_brand_image',
                'type' => 'switch',
                'title' => esc_html__('Show brand image single Product', 'xtocky'),
                'default' => false,
                'required' => array(
                    array('show_brand', 'equals', true),
                )
            ),
            array(
                'id' => 'show_brand_image_single',
                'type' => 'switch',
                'title' => esc_html__('Brand details single Product widget', 'xtocky'),
                'desc'     => esc_html__('if on show brand details single product widget top aria', 'xtocky'),
                'default' => false,
                'required' => array(
                    array('show_brand', 'equals', true),
                )
            ),
            array(
                'id' => 'show_brand_title',
                'type' => 'switch',
                'title' => esc_html__('Show brand title', 'xtocky'),
                'default' => false,
                'required' => array(
                    array('show_brand_image_single', 'equals', true),
                )
            ),
            array(
                'id' => 'show_brand_desc',
                'type' => 'switch',
                'title' => esc_html__('Show brand description', 'xtocky'),
                'default' => false,
                'required' => array(
                    array('show_brand_image_single', 'equals', true),
                )
            ),
        )
    ));


    if (class_exists('WeDevs_Dokan')) {
        Redux::setSection($opt_name, array(
            'title' => esc_html__('Multi vendor', 'xtocky'),
            'subsection' => true,
            'fields' => array(
                array(
                    'id' => 'optn_dokan_products_per_row',
                    'type' => 'image_select',
                    'compiler' => true,
                    'title' => esc_html__('Vendor Store Column', 'xtocky'),
                    'options' => array(
                        '2' => array('alt' => '2 Column ', 'img' => get_template_directory_uri() . '/assets/images/theme-options/2columns.png'),
                        '3' => array('alt' => '3 Column ', 'img' => get_template_directory_uri() . '/assets/images/theme-options/3columns.png'),
                        '4' => array('alt' => '4 Column ', 'img' => get_template_directory_uri() . '/assets/images/theme-options/4columns.png'),
                        '5' => array('alt' => '5 Column ', 'img' => get_template_directory_uri() . '/assets/images/theme-options/5columns.png')
                    ),
                    'default' => '3'
                ),
                // array(
                //     'id' => 'vendor_profile_cover',
                //     'type' => 'button_set',
                //     'title' => esc_html__('Vendor Profile', 'xtocky'),
                //     'options' => array(
                //         'default' => esc_html__('Default', 'xtocky'),
                //         'full' => esc_html__('Full width', 'xtocky'),
                //     ),
                //     'default' => 'full'
                // ),
                // array(
                //     'id' => 'vendor_seller_name',
                //     'type' => 'button_set',
                //     'title' => esc_html__('Vendor Name', 'xtocky'),
                //     'options' => array(
                //         'shop' => esc_html__('Only Shop page', 'xtocky'),
                //         'all' => esc_html__('All page', 'xtocky'),
                //         'none' => esc_html__('None', 'xtocky'),
                //     ),
                //     'default' => 'shop'
                // )
            )
        ));
    }
}  //end of woocommece  

//login info    
Redux::setSection($opt_name, array(
    'title' => esc_html__('Login/Register', 'xtocky'),
    'icon' => 'el-icon-user',
    'fields'  => array(
        array(
            'id'            => 'optn_terms_of_use_url',
            'type'          => 'text',
            'title'         => esc_html__('Terms of use link', 'xtocky'),
            'subtitle'      => esc_html__('The terms of use link page show on register form', 'xtocky'),
            'default'       => '',
            'validate'      => 'url',
        ),
    )
));

//typography    
Redux::setSection($opt_name, array(
    'title'   => esc_html__('Typography', 'xtocky'),
    'icon'    => 'el-icon-font',
    'submenu' => true,
    'fields'  => array(
        array(
            'id'             => 'body_fontfamily',
            'type'           => 'typography',
            'title'          => esc_html__('Body Font', 'xtocky'),
            'subtitle'       => esc_html__('Select Google custom font for your main body text.', 'xtocky'),
            'compiler'       => true,
            'google'         => true,
            'font-backup'    => false,
            'font-weight'    => false,
            'all_styles'     => true,
            'font-style'     => true,
            'text-align'     => false,
            'subsets'        => true,
            'font-size'      => true,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array('body'),
            'units'          => 'px',
            'default'        => array(
                'color'       => "#888888",
                'font-weight'       => "400",
            )
        ),
        array(
            'id'             => 'font_heading',
            'type'           => 'typography',
            'title'          => esc_html__('Heading', 'xtocky'),
            'subtitle'       => esc_html__('Select custom font for headings', 'xtocky'),
            'compiler'       => true,
            'google'         => true,
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => false,
            'font-style'     => true,
            'subsets'        => true,
            'text-align'     => false,
            'font-size'      => false,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => false,
            'preview'        => true,
            'units'          => 'px',
            'output'         => array('h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6'),
            //                    'default'        => array(                            
            //                            'font-family' => 'Hind',                            
            //                    )

        ),
        array(
            'id'             => 'h1_params',
            'type'           => 'typography',
            'title'          => esc_html__('H1', 'xtocky'),
            'compiler'       => true,
            'google'         => false,
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => true,
            'font-family'    => false,
            'text-align'     => false,
            'font-style'     => false,
            'subsets'        => false,
            'font-size'      => true,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array('h1,.h1'),
            'units'          => 'px',
            'default'        => array(
                'font-size'     => '28px',
                'color'         => "#222",
                'font-weight'   => "600",
            )
        ),
        array(
            'id'             => 'h2_params',
            'type'           => 'typography',
            'title'          => esc_html__('H2', 'xtocky'),
            'compiler'       => true,
            'google'         => false,
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => true,
            'font-family'    => false,
            'text-align'     => false,
            'font-style'     => false,
            'subsets'        => false,
            'font-size'      => true,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array('h2,.h2'),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '25px',
                'color'         => "#222",
                'font-weight'   => "600",
            )
        ),
        array(
            'id'             => 'h3_params',
            'type'           => 'typography',
            'title'          => esc_html__('H3', 'xtocky'),
            'compiler'       => true,
            'google'         => false,
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => true,
            'font-family'    => false,
            'text-align'     => false,
            'font-style'     => false,
            'subsets'        => false,
            'font-size'      => true,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array('h3,.h3'),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '22px',
                'color'         => "#222",
                'font-weight'   => "600",
            )
        ),
        array(
            'id'             => 'h4_params',
            'type'           => 'typography',
            'title'          => esc_html__('H4', 'xtocky'),
            'compiler'       => true,
            'google'         => false,
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => true,
            'font-family'    => false,
            'text-align'     => false,
            'font-style'     => false,
            'subsets'        => false,
            'font-size'      => true,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array('h4,.h4'),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '18px',
                'color'         => "#222",
                'font-weight'   => "600",
            )
        ),
        array(
            'id'             => 'h5_params',
            'type'           => 'typography',
            'title'          => esc_html__('H5', 'xtocky'),
            'compiler'       => true,
            'google'         => false,
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => true,
            'font-family'    => false,
            'text-align'     => false,
            'font-style'     => false,
            'subsets'        => false,
            'font-size'      => true,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array('h5,.h5'),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '16px',
                'color'         => "#222",
                'font-weight'   => "600",
            )
        ),
        array(
            'id'             => 'h6_params',
            'type'           => 'typography',
            'title'          => esc_html__('H6', 'xtocky'),
            'compiler'       => true,
            'google'         => false,
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => true,
            'font-family'    => false,
            'text-align'     => false,
            'font-style'     => false,
            'subsets'        => false,
            'font-size'      => true,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array('h6,.h6'),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '14px',
                'color'         => "#222",
                'font-weight'   => "600",
            )
        ),
    )
));
//color skin    
Redux::setSection($opt_name, array(
    'title'   => esc_html__('Color Skin', 'xtocky'),
    'icon'    => 'el el-brush',
    'fields'  => array(
        array(
            'id'      => 'color_skin',
            'type'    => 'button_set',
            'title'   => esc_html__('Color Skin', 'xtocky'),
            'default' => 'default',
            'options' => array(
                'default'            => esc_html__('Default', 'xtocky'),
                'skin_custom' => esc_html__('Custom color', 'xtocky')
            ),
        ),
        array(
            'id'       => 'main_color_scheme',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Main Color Scheme', 'xtocky'),
            'subtitle'    => esc_html__('Default color use #56cfe1', 'xtocky'),
            'default'  => '',
            'required' => array('color_skin', '=', 'skin_custom'),
            'output'   => array(
                'background-color'    => '
.product-action a:hover,.vc_custom_heading .block-header .banner-btn:not(.line_button):hover,.pl-5 .product-action a:hover,.entry .entry-date.sticky-post,.entry.entry-grid.entry-quote blockquote,.filter-sidebar .pikoworks_widget_brands li a:hover,.filter-sidebar .tagcloud a:hover,.footer .widget.instagram-widget .btn.btn-follow,.footer .widget.instagram-widget .btn.btn-follow:focus,.footer .widget.instagram-widget .btn.btn-follow:hover,.footer-bottom .social-icons .social-icon:hover,.hesperiden.tparrows:focus,.hesperiden.tparrows:hover,.mega-menu .tip,.menu-btn.open .icon-bar,.menu-btn:focus .icon-bar,.menu-btn:hover .icon-bar,.nav.nav-pills>li.active>a,.nav.nav-pills>li>a:focus,.nav.nav-pills>li>a:hover,.overlay-container .overlay.custom,.overlay-container .overlay.custom2,.page-links a:focus,.page-links a:hover,.pagination .next:focus:after,.pagination .next:hover:after,.pagination .prev:focus:before,.pagination .prev:hover:before,.pagination>li>a:focus,.pagination>li>a:hover,.pagination>li>span:focus,.pagination>li>span:hover,.piko-ajax-load a:hover,.piko-layout-header .piko-show-account.logged-in .link-account,.piko-my-account .piko-togoleform,.piko-show-account.logged-in .link-account:hover,.popup-gallery .woocommerce-product-gallery__image a:hover:before,.product-action a:hover,.product-label,.reset_variations:focus,.reset_variations:hover,.round-1 .spinner,.sc-pl-2 .progress .progress-bar,.scroll-top span:hover,.select2-container--default .select2-results__option--highlighted[aria-selected],.site-header .header-actions .tools_button .badge-number,.slick-dots li.slick-active button,.social-icons i:hover,.summary .single_add_to_cart_button,.tp-bullets .tp-bullet.selected,.tp-bullets .tp-bullet:focus,.tp-bullets .tp-bullet:hover,.tparrows:focus,.tparrows:hover,.various-4 .spinner,.video-gallery a.open:hover:before,.widget_shopping_cart_content .buttons>a.button+a.button,.widget_shopping_cart_content .buttons>button.button+a.button,.widget_shopping_cart_content .buttons>input.button+a.button,.woocommerce-pagination .page-numbers li .page-numbers:hover,.yith-woocompare-widget a.clear-all,.yith-woocompare-widget a.compare.button,a.button:hover,button:hover,button[disabled]:focus,button[disabled]:hover,input[type=submit]:hover,input[type=submit][disabled]:focus,input[type=submit][disabled]:hover,input[type=button],input[type=button][disabled]:focus,input[type=button][disabled]:hover,input[type=reset],input[type=reset][disabled]:focus,input[type=reset][disabled]:hover,.woocommerce .widget_layered_nav ul.yith-wcan-label li a:hover,.woocommerce-page .widget_layered_nav ul.yith-wcan-label li a:hover,.woocommerce .widget_layered_nav ul.yith-wcan-label li.chosen a,.woocommerce-page .widget_layered_nav ul.yith-wcan-label li.chosen a
',
                'color'  => ' 
.arrow li:before,.breadcrumb a:hover,.cart_totals table tr.order-total td .amount,.chosen-container .chosen-results li.highlighted,.comments .comment .comment-date a:hover,.comments .comment h4 a:hover,.default .entry .entry-meta-container .entry-meta a:hover,.entry .entry-author .author-content .more-link:focus,.entry .entry-author .author-content .more-link:hover,.entry .entry-author a:hover,.filter-brand-list a:focus,.filter-brand-list a:hover,.filter-price-container .price-label #high-price-val,.filter-price-container .price-label #low-price-val,.filter-size-box.active,.filter-size-box:focus,.filter-size-box:hover,.footer-bottom .footer-menu li.active a,.header-boxes-container i,.header-boxes-container li .fa-phone+span,.header-boxes-container li .icon-telephone4+span,.header-search-container .dropdown.search-dropdown .chosen-results li.highlighted,.header-search-container .dropdown.search-dropdown .chosen-results li:hover,.info-product .piko-viewdetail:hover,.info-product>h3 a:hover,.member a:hover,.nav.nav-pills.nav-bordered>li.active>a,.nav.nav-pills.nav-bordered>li>a:focus,.nav.nav-pills.nav-bordered>li>a:hover,.page-header.bg-image .breadcrumb li a:hover,.page-header.parallax .breadcrumb li a:hover,.pagination .current,.pagination>li.active>a,.pagination>li.active>a:focus,.pagination>li.active>a:hover,.pagination>li.active>span,.pagination>li.active>span:focus,.pagination>li.active>span:hover,.portfolio-details-list a:hover,.post-navigation a:focus .post-title,.post-navigation a:hover .post-title,.product .new,.product .onsale,.product-category.product h3:hover,.product-innercotent .info-product .piko-viewdetail:hover,.product-innercotent .info-product .title-product a:hover,.product-piko-ajax-list .woocommerce-Price-amount,.product-price-container,.product.outofstock .product.product4 .product-action .product_type_simple:before,.product_list_widget span.quantity,.quantity .qty-wrap a:hover,.search-results-title a:hover,.shop_table tbody .cart_item .product-name a:hover,.shop_table tbody tr.cart_item td.product-remove a:hover,.shop_table tbody tr.cart_item td.product-subtotal,.shop_table.order_details td.product-name a:hover,.side-account-menu .account-list li a:focus,.side-account-menu .account-list li a:hover,.side-menu .megamenu ul li a:focus,.side-menu .megamenu ul li a:hover,.side-menu .megamenu ul li.open>a,.side-menu .mmenu-title:focus,.side-menu .mmenu-title:hover,.side-menu .open>.mmenu-title,.side-menu li a:focus,.side-menu li a:hover,.side-menu li.open>a,.side-menu ul ul li a:focus,.side-menu ul ul li a:hover,.side-menu ul ul li.open>a,.side-menu>li.open>a,.side-menu>li>a:focus,.side-menu>li>a:hover,.text-custom,.woo-single .breadcrumb a:hover,.woocommerce #content table.wishlist_table.cart a.remove:hover,.woocommerce-MyAccount-navigation ul li.is-active a,.woocommerce-info:before,.woocommerce-pagination .page-numbers li .page-numbers.current,a:focus,a:hover
',
                'border-color' => '
.vc_custom_heading .block-header .banner-btn:hover,.cart_totals .wc-proceed-to-checkout .checkout-button:hover,.filter-color-box.active,.filter-color-box:focus,.filter-color-box:hover,.filter-sidebar .pikoworks_widget_brands li a:hover,.filter-sidebar .tagcloud a:hover,.filter-sidebar .widget_price_filter .price_slider_amount button:hover,.filter-size-box.active,.filter-size-box:focus,.filter-size-box:hover,.footer .widget.instagram-widget .btn.btn-follow,.footer .widget.instagram-widget .btn.btn-follow:focus,.footer .widget.instagram-widget .btn.btn-follow:hover,.header-search-container .dropdown.search-dropdown .dropdown-menu,.hesperiden.tparrows:focus,.hesperiden.tparrows:hover,.lg-outer .lg-thumb-item.active,.lg-outer .lg-thumb-item:focus,.lg-outer .lg-thumb-item:hover,.nav.nav-pills.nav-bordered>li.active>a,.nav.nav-pills.nav-bordered>li>a:focus,.nav.nav-pills.nav-bordered>li>a:hover,.pagination .current,.pagination .next:focus:after,.pagination .next:hover:after,.pagination .prev:focus:before,.pagination .prev:hover:before,.pagination>li.active>a,.pagination>li.active>a:focus,.pagination>li.active>a:hover,.pagination>li.active>span,.pagination>li.active>span:focus,.pagination>li.active>span:hover,.pagination>li>a:focus,.pagination>li>a:hover,.pagination>li>span:focus,.pagination>li>span:hover,.panel.panel-custom .panel-heading a,.panel.panel-custom .panel-heading a:focus,.panel.panel-custom .panel-heading a:hover,.piko-ajax-load a:hover,.piko-layout-header .piko-show-account.logged-in .link-account,.piko-my-account .piko-togoleform,.piko-show-account.logged-in .link-account:hover,.popup-gallery .woocommerce-product-gallery__image a:hover:before,.product .new,.product .onsale,.product-action a:hover,.reset_variations:focus,.reset_variations:hover,.scroll-top span:hover,.summary .single_add_to_cart_button,.tp-bullets .tp-bullet.selected,.tp-bullets .tp-bullet:focus,.tp-bullets .tp-bullet:hover,.tparrows:focus,.tparrows:hover,.video-gallery a.open:hover:before,.woocommerce-checkout-payment .form-row.place-order input[type=submit]:hover,.woocommerce-pagination .page-numbers li .page-numbers.current,.woocommerce-pagination .page-numbers li .page-numbers:hover,a.button:hover,button:hover,button[disabled]:focus,button[disabled]:hover,input[type=submit]:hover,input[type=submit][disabled]:focus,input[type=submit][disabled]:hover,input[type=button],input[type=button][disabled]:focus,input[type=button][disabled]:hover,input[type=reset],input[type=reset][disabled]:focus,input[type=reset][disabled]:hover,table.shop_table td.actions .coupon>input[type=submit]:hover,table.shop_table td.actions>input[type=submit]:hover,.category-menu .secondary-menu-wrapper .secondary-menu .main-menu,.woocommerce .widget_layered_nav ul.yith-wcan-label li a:hover,.woocommerce-page .widget_layered_nav ul.yith-wcan-label li a:hover,.woocommerce .widget_layered_nav ul.yith-wcan-label li.chosen a,.woocommerce-page .widget_layered_nav ul.yith-wcan-label li.chosen a
',
                'border-top-color' => '
.various-8 .spinner',
                'border-left-color' => '
.various-7 .spinner,.various-8 .spinner,.category-menu .secondary-menu-wrapper .secondary-title
',
                'border-right-color' => '
.various-7 .spinner,.category-menu .secondary-menu-wrapper .secondary-title
'
            )
        ),

        array(
            'id'       => 'secondary_color_scheme',
            'type'     => 'color',
            'compiler' => true,
            'title'    => esc_html__('Secondary Color Scheme', 'xtocky'),
            'subtitle'    => esc_html__('Default color use #51cdeb', 'xtocky'),
            'default'  => '',
            'required' => array('color_skin', '=', 'skin_custom'),
            'output'   => array(
                'background-color'    => '
.mega-menu .tip.hot,.product-label.discount,.widget .woof .widget_price_filter .ui-slider .ui-slider-handle,.widget .woof .widget_price_filter .ui-slider .ui-slider-range,.widget_price_filter .ui-slider .ui-slider-handle,.widget_price_filter .ui-slider .ui-slider-range
',
                'color'  => ' 
#review_form #commentform .stars>span a.active:before,#review_form #commentform .stars>span a:hover:before,.star-rating span,.text-custom4,.woocommerce-message:before
',
                'border-top-color' => '
.widget .woof .widget_price_filter .ui-slider .ui-slider-handle:after,.widget_price_filter .ui-slider .ui-slider-handle:after
',
                'border-bottom-color' => '
.woocommerce-message'
            )
        ),
    )
));
//    social media    
Redux::setSection($opt_name, array(
    'title'   => esc_html__('Social Media', 'xtocky'),
    'icon'    => 'el el-user',
    'desc'    => esc_html__('Enter social media Page urls here as you want. then enable them for header. Please put the full URLs like this "https://facebook.com".', 'xtocky'),
    'submenu' => true,
    'fields'  => array(
        array(
            'id'       => 'facebook',
            'type'     => 'text',
            'title'    => esc_html__('Facebook', 'xtocky'),
            'subtitle' => '',
            'default' => 'https://www.facebook.com/',
            'desc'     => esc_html__('Enter your Facebook URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'twitter',
            'type'     => 'text',
            'title'    => esc_html__('Twitter', 'xtocky'),
            'subtitle' => '',
            'default' => 'https://www.twitter.com/',
            'desc'     => esc_html__('Enter your Twitter URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'flickr',
            'type'     => 'text',
            'title'    => esc_html__('Flickr', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Flickr URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'instagram',
            'type'     => 'text',
            'title'    => esc_html__('Instagram', 'xtocky'),
            'subtitle' => '',
            'default' => 'https://www.instagram.com/',
            'desc'     => esc_html__('Enter your Instagram URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'behance',
            'type'     => 'text',
            'title'    => esc_html__('Behance', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Behance URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'dribbble',
            'type'     => 'text',
            'title'    => esc_html__('Dribbble', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Dribbble URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'git',
            'type'     => 'text',
            'title'    => esc_html__('Git', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Git URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'linkedin',
            'type'     => 'text',
            'title'    => esc_html__('Linkedin', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Linkedin URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'pinterest',
            'type'     => 'text',
            'title'    => esc_html__('Pinterest', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Pinterest URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'yahoo',
            'type'     => 'text',
            'title'    => esc_html__('Yahoo', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Yahoo URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'delicious',
            'type'     => 'text',
            'title'    => esc_html__('Delicious', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Delicious URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'dropbox',
            'type'     => 'text',
            'title'    => esc_html__('Dropbox', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Dropbox URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'reddit',
            'type'     => 'text',
            'title'    => esc_html__('Reddit', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Reddit URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'soundcloud',
            'type'     => 'text',
            'title'    => esc_html__('Soundcloud', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Soundcloud URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'google',
            'type'     => 'text',
            'title'    => esc_html__('Google', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Google URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'googleplus',
            'type'     => 'text',
            'title'    => esc_html__('Google+', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Google Plus URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'skype',
            'type'     => 'text',
            'title'    => esc_html__('Skype', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Skype URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'youtube',
            'type'     => 'text',
            'title'    => esc_html__('Youtube', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Youtube URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'vimeo',
            'type'     => 'text',
            'title'    => esc_html__('Vimeo', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your vimeo URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'tumblr',
            'type'     => 'text',
            'title'    => esc_html__('Tumblr', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Tumblr URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'whatsapp',
            'type'     => 'text',
            'title'    => esc_html__('Whatsapp', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Whatsapp URL.', 'xtocky'),
            'validate' => 'url'
        ),
        array(
            'id'       => 'whatsapp',
            'type'     => 'text',
            'title'    => esc_html__('Whatsapp', 'xtocky'),
            'subtitle' => '',
            'desc'     => esc_html__('Enter your Whatsapp URL.', 'xtocky'),
            'validate' => 'url'
        ),
    )
));

//popup Settings    
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Popup Settings', 'xtocky'),
    'id'               => 'popup_settings',
    'desc'             => esc_html__('Popup for email subscription', 'xtocky'),
    'customizer_width' => '400px',
    'icon'             => 'el el-website-alt',
    'fields'           => array(
        array(
            'id'       => 'popup_enable',
            'type'     => 'switch',
            'title'    => esc_html__('Popup', 'xtocky'),
            'subtitle' => esc_html__('Enable or Disable popup on site', 'xtocky'),
            'on'       => esc_html__('Enable', 'xtocky'),
            'off'       => esc_html__('Disable', 'xtocky'),
            'default'  => false,
        ),
        array(
            'id'      => 'popup_page_enable',
            'type'    => 'button_set',
            'title'   => esc_html__('Popup show', 'xtocky'),
            'options' => array(
                'front' => esc_html__('Front Page', 'xtocky'),
                'all' => esc_html__('All Pages', 'xtocky'),
            ),
            'default' => 'all',
            'required' => array('popup_enable', '=', true),
        ),
        array(
            'id'       => 'popup_title',
            'type'     => 'text',
            'title'    => esc_html__('Title', 'xtocky'),
            'subtitle' => esc_html__('Popup title which one will be shown at top of popup', 'xtocky'),
            'default'  => 'Sign Up Newsletter',
            'required' => array('popup_enable', '=', true),
        ),
        array(
            'id'             => 'page-popup_title_font_size',
            'type'           => 'typography',
            'title'          => esc_html__('Title font size', 'xtocky'),
            'subtitle' => esc_html__('Font size and color', 'xtocky'),
            'compiler'       => true,
            'google'         => true,
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => true,
            'font-family'    => true,
            'text-align'     => true,
            'font-style'     => false,
            'subsets'        => false,
            'font-size'      => true,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array('.pop-header h2'),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '17px',
                'color' => '#fff',
            ),
            'required' => array('popup_enable', '=', true),
        ),
        array(
            'id' => 'popup_title_bg_img',
            'type' => 'background',
            'url' => true,
            'title' => esc_html__('Title Background Image', 'xtocky'),
            'compiler' => 'true',
            'preview' => 'true',
            'preview_media' => 'true',
            'background-size' => 'false',
            'background-attachment' => 'false',
            'default'  => array(
                'background-color' => '#fffff',
            ),
            'output'   => array('background-image'    => '.pop-header'),
            'required' => array('popup_enable', '=', true),
        ),
        array(
            'id'       => 'popup_title_bg_height',
            'type'     => 'text',
            'title'    => esc_html__('Background height', 'xtocky'),
            'required' => array('popup_enable', '=', true),
            'default'  => '150',
            'validate' => 'numeric',
            'subtitle' => esc_html__('This must be numeric value.', 'xtocky'),
        ),
        array(
            'id'       => 'popup_content',
            'type'     => 'editor',
            'title'    => esc_html__('Main content', 'xtocky'),
            'subtitle' => esc_html__('It will be shown at just below title', 'xtocky'),
            'required' => array('popup_enable', '=', true),
            'default'  => '<h3>Sign up our newsletter and save 25% off for the next purchase!</h3> Subscribe to the <strong>Our store</strong> mailing list to receive updates on new arrivals, offers and other discount information.'
        ),
        array(
            'id'       => 'popup_mc_form',
            'type'     => 'text',
            'title'    => esc_html__('MailChimp Form', 'xtocky'),
            'desc'     => 'Mailchimp Shortcode like as: [mc4wp_form id="4430"] if collect email address contact form7 shortcode: [contact-form-7 id="4439" title="Subscribe Form"]',
            'required' => array('popup_enable', '=', true),
            'default'  => ''
        ),
        array(
            'id'       => 'popup_nomore_text',
            'type'     => 'text',
            'title'    => esc_html__('Don\'t show checkbox title', 'xtocky'),
            'required' => array('popup_enable', '=', true),
            'default'  => 'Don\'t show it again'
        ),
        array(
            'id'       => 'popup_bg_img',
            'type'     => 'background',
            'title'    => esc_html__('Background bottom image', 'xtocky'),
            'compiler' => 'true',
            'preview' => 'true',
            'preview_media' => 'true',
            'background-position' => 'false',
            'background-repeat' => 'false',
            'background-size' => 'false',
            'background-attachment' => 'false',
            'required' => array('popup_enable', '=', true),
            'default'  => array(
                'background-color' => '#ffffff'
            )
        ),
        array(
            'id'      => 'popup_bg_img_pos',
            'type'    => 'button_set',
            'title'   => esc_html__('Background bottom image position', 'xtocky'),
            'options' => array(
                'left' => esc_html__('Left', 'xtocky'),
                'right' => esc_html__('Right', 'xtocky'),
            ),
            'default' => 'right',
            'required' => array('popup_enable', '=', true),
        ),
    )
));


//    custom css
Redux::setSection($opt_name, array(
    'title'   => esc_html__('Custom Code', 'xtocky'),
    'icon'    => 'el el-icon-css',
    'fields'  => array(
        array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => esc_html__('CSS Code', 'xtocky'),
            'subtitle' => esc_html__('Wirte or Paste your custom CSS code here.', 'xtocky'),
            'mode'     => 'css',
            'default'  => " "
        ),
        array(
            'id'       => 'custom_js',
            'type'     => 'ace_editor',
            'title'    => esc_html__('Javascript Code', 'xtocky'),
            'subtitle' => esc_html__('Wirte or Paste your custom javascript code here.', 'xtocky'),
            'mode'     => 'javascript',
            'default'  => ""
        )
    )
));
// import export   
Redux::setSection($opt_name, array(
    'title'   => esc_html__('Options', 'xtocky'),
    'icon'    => 'el el-refresh',
    'fields'    => array(
        array(
            'id'            => 'piko-import-export',
            'type'          => 'import_export',
            'full_width'    => true,
        ),
    ),
));


/*
     * <--- END SECTIONS
     */

function compiler_action($options)
{ }
function xtocky_redux_update_options_user_can_register($options)
{
    global $xtocky;
    $users_can_register = isset($xtocky['opt-users-can-register']) ? $xtocky['opt-users-can-register'] : 0;
    update_option('users_can_register', $users_can_register);
}
function xtocky_redux_update_options_post_type_portfolio($options)
{
    global $xtocky;
    $post_type_portfolio = isset($xtocky['optn_enable_portfolio']) ? $xtocky['optn_enable_portfolio'] : 0;
    update_option('optn_enable_portfolio', $post_type_portfolio);
}


if (!function_exists('xtocky')) {
    function xtocky($id, $fallback = false, $key = false)
    {
        global $xtocky;
        if ($fallback == false) {
            $fallback = '';
        }
        $output = (isset($xtocky[$id]) && $xtocky[$id] !== '') ? $xtocky[$id] : $fallback;
        if (!empty($xtocky[$id]) && $key) {
            $output = $xtocky[$id][$key];
        }

        return $output;
    }
}

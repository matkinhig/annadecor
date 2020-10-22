<?php
/*
*Meta Box Function admin 
*------------------------
*/
global $meta_boxes;

if ('xtocky' == get_option('template')) {
	// theme active piko stock
}

/**
 * Register meta boxes
 * @return void
 */
function piko_register_meta_boxes()
{
	global $meta_boxes;
	$prefix = 'xtocky_';
	/* menu list */
	$menu_list = array();
	$sidebar_list = array();
	if (function_exists('piko_get_menu_list')) {
		$menu_list = piko_get_menu_list();
	}
	/* widgets list */
	if (function_exists('piko_get_widgets_list')) {
		$widgets_list = piko_get_widgets_list();
	}


	// POST FORMAT: Video
	//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Video', 'pikoworks_core'),
		'id' => $prefix . 'meta_box_post_format_video',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__('Video Embeded URL', 'pikoworks_core'),
				'id'   => $prefix . 'post_format_video',
				'type' => 'oembed',
			),
		),
	);

	// POST FORMAT: Audio
	//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Audio', 'pikoworks_core'),
		'id' => $prefix . 'meta_box_post_format_audio',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__('Audio  Embeded url', 'pikoworks_core'),
				'id'   => $prefix . 'post_format_audio',
				'type' => 'oembed',
			),
		),
	);

	// POST FORMAT: Image
	//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Image', 'pikoworks_core'),
		'id' => $prefix . 'meta_box_post_format_image',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__('Image', 'pikoworks_core'),
				'id' => $prefix . 'post_format_image',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'desc' => esc_html__('Select a image for post', 'pikoworks_core')
			),
		),
	);

	// POST FORMAT: Gallery
	//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Gallery', 'pikoworks_core'),
		'id' => $prefix . 'meta_box_post_format_gallery',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__('Images Multiple', 'pikoworks_core'),
				'id' => $prefix . 'post_format_gallery',
				'type' => 'image_advanced',
				'desc' => esc_html__('Select images gallery for post', 'pikoworks_core')
			),
		),
	);

	// POST FORMAT: QUOTE
	//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Quote', 'pikoworks_core'),
		'id' => $prefix . 'meta_box_post_format_quote',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__('Quote', 'pikoworks_core'),
				'id'   => $prefix . 'post_format_quote',
				'type' => 'textarea',
			),
			array(
				'name' => esc_html__('Author', 'pikoworks_core'),
				'id'   => $prefix . 'post_format_quote_author',
				'type' => 'text',
			),
			array(
				'name' => esc_html__('Author Url', 'pikoworks_core'),
				'id'   => $prefix . 'post_format_quote_author_url',
				'type' => 'url',
			),
		),
	);
	// POST FORMAT: LINK
	//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Link', 'pikoworks_core'),
		'id' => $prefix . 'meta_box_post_format_link',
		'post_types' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__('Url', 'pikoworks_core'),
				'id'   => $prefix . 'post_format_link_url',
				'type' => 'url',
			),
			array(
				'name' => esc_html__('Text', 'pikoworks_core'),
				'id'   => $prefix . 'post_format_link_text',
				'type' => 'text',
			),
		),
	);

	$meta_boxes[] = array(
		'id' => $prefix . 'product_setting_meta_box',
		'title' => esc_html__('Product setting', 'pikoworks_core'),
		'post_types' => array('product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__('Single Product Thumbnail', 'pikoworks_core'),
				'id'    => $prefix . 'single_products_thumbnail',
				'type'  => 'image_set',
				'allowClear' => true,
				'desc'  => esc_html__('If check mark overite theme-option', 'pikoworks_core'),
				'options' => array(
					'bottom' => get_template_directory_uri() . '/assets/images/theme-options/single-thumb1.png',
					'left' => get_template_directory_uri() . '/assets/images/theme-options/single-thumb2.png',
					'right' => get_template_directory_uri() . '/assets/images/theme-options/single-thumb3.png'
				),
				'std'	=> '',
				'multiple' => false,

			),
			array(
				'name' => esc_html__('Product Video url', 'pikoworks_core'),
				'id'   => $prefix . 'single_products_video',
				'desc'  => esc_html__('Youtube, Vimeo embaded link', 'pikoworks_core'),
				'type' => 'oembed',
			),
			array(
				'name' => esc_html__('Product Size Guide image', 'pikoworks_core'),
				'id'   => $prefix . 'size_guide',
				'desc'  => esc_html__('Override size guide image', 'pikoworks_core'),
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__('Single Product tab style', 'pikoworks_core'),
				'id'    => $prefix . 'single_tab_layout',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'1' => get_template_directory_uri() . '/assets/images/theme-options/single-product-tab1.png',
					'2' => get_template_directory_uri() . '/assets/images/theme-options/single-product-tab2.png',
				),
				'std'	=> '',
				'multiple' => false,
				'required-field' => array($prefix . 'single_products_thumbnail', '=', array('1', '2')),

			),

		)
	);
	// product single tabs
	$meta_boxes[] = array(
		'id' => $prefix . 'product_tabs_layout_meta_box',
		'title' => esc_html__('Product Tabs', 'pikoworks_core'),
		'post_types' => array('product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__('Enable Product Custom Tab.', 'pikoworks_core'),
				'desc'  => esc_html__('Override theme option', 'pikoworks_core'),
				'id'    => $prefix . 'enable_custom_tab_html',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			array(
				'name' 	=> esc_html__('Custom Tab heading', 'pikoworks_core'),
				'id' 	=> $prefix . 'product_custom_tab_heading',
				'type' 	=> 'text',
				'std' 	=> '',
				'required-field' => array($prefix . 'enable_custom_tab_html', '=', array('1')),
			),
			array(
				'name'  => esc_html__('Custom Tab Content.', 'pikoworks_core'),
				'id'    => $prefix . 'product_custom_tab_content',
				'type'  => 'wysiwyg',
				'required-field' => array($prefix . 'enable_custom_tab_html', '=', array('1')),
			),
			array(
				'name'  => esc_html__('Enable Product video tab.', 'pikoworks_core'),
				'id'    => $prefix . 'enable_custom_tab_video',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			array(
				'name'  => esc_html__('Custom Tab video.', 'pikoworks_core'),
				'desc'  => esc_html__('Any embaded video like as youtube, vimeo', 'pikoworks_core'),
				'id'    => $prefix . 'product_custom_tab_video',
				'type'  => 'oembed',
				'required-field' => array($prefix . 'enable_custom_tab_video', '=', array('1')),
			),
			array(
				'name'  => esc_html__('Enable Product accessories tab.', 'pikoworks_core'),
				'id'    => $prefix . 'enable_custom_tab_accessories',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			array(
				'name' => esc_html__('Accessories Product ID', 'sconto'),
				'desc' => esc_html__('Comma-separated. example: 415,515,200 NB: WP ADMIN->Product-> Mouse circer over Product Title then see id: 401 or  the browser bottom like link: yoursite/wp-admin/post.php?post=401&action=edit  401 is Product id,  or see the doc file NB: Not working product layout 3', 'pikoworks_core'),
				'id'    => $prefix . 'custom_tab_accessories_porduct_id',
				'type' 	=> 'text',
				'required-field' => array($prefix . 'enable_custom_tab_accessories', '=', array('1')),
			),

		)
	);
	$meta_boxes[] = array(
		'id' => $prefix . 'product_more_image_meta_box',
		'title' => esc_html__('Product Images', 'pikoworks_core'),
		'post_types' => array('product'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__('Display single image gallery.', 'pikoworks_core'),
				'desc' => esc_html__('Image show tab before or empty is nothing', 'pikoworks_core'),
				'id'    => $prefix . 'product_single_image_gallery',
				'type' => 'image_advanced',
			),

		)
	);
	// PAGE LAYOUT
	$meta_boxes[] = array(
		'id' => $prefix . 'page_layout_meta_box',
		'title' => esc_html__('Page Layout', 'pikoworks_core'),
		'post_types' => array('post', 'page',  'portfolio', 'product', 'lookbook'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__('Page Layout', 'pikoworks_core'),
				'id'    => $prefix . 'page_layout',
				'type'  => 'button_set',
				'options' => array(
					'-1'    => esc_html__('Default', 'pikoworks_core'),
					'container' => esc_html__('Container', 'pikoworks_core'),
					'container-fluid'  => esc_html__('Container Fluid', 'pikoworks_core'),
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => esc_html__('Page Sidebar', 'pikoworks_core'),
				'id'    => $prefix . 'page_sidebar',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'fullwidth' => PIKOWORKSCORE_ADMIN_URL . '/assets/images/theme-options/sidebar-none.png',
					'left'	  => PIKOWORKSCORE_ADMIN_URL . '/assets/images/theme-options/sidebar-left.png',
					'right'	  => PIKOWORKSCORE_ADMIN_URL . '/assets/images/theme-options/sidebar-right.png',
					'both'	  => PIKOWORKSCORE_ADMIN_URL . '/assets/images/theme-options/sidebar-both.png'
				),
				'std'	=> '',
				'multiple' => false,

			),
			array(
				'name' 	=> esc_html__('Page Sidebar', 'pikoworks_core'),
				'id' 	=> $prefix . 'page_right_sidebar',
				'type' 	=> 'select',
				'placeholder' => esc_html__('Select Sidebar', 'pikoworks_core'),
				'options' 	=> $widgets_list,
				'required-field' => array($prefix . 'page_sidebar', '=', array('left', 'right', 'both')),
			),

			array(
				'name' 	=> esc_html__('Left Sidebar', 'pikoworks_core'),
				'id' 	=> $prefix . 'page_left_sidebar',
				'type' 	=> 'select',
				'placeholder' => esc_html__('Select Sidebar', 'pikoworks_core'),
				'options' 	=> $widgets_list,
				'required-field' => array($prefix . 'page_sidebar', '=', array('both')),
			),

			array(
				'name'  => esc_html__('Sidebar Width', 'pikoworks_core'),
				'id'    => $prefix . 'sidebar_width',
				'type'  => 'button_set',
				'options' => array(
					'-1'	=> esc_html__('Default', 'pikoworks_core'),
					'large' => esc_html__('Large(1/4)', 'pikoworks_core'),
					'small' => esc_html__('Small(1/3)', 'pikoworks_core'),
				),
				'std'	=> '-1',
				'multiple' => false,
				'required-field' => array($prefix . 'page_sidebar', '=', array('left', 'right', 'both')),
			),

			array(
				'name' 	=> esc_html__('Page Class Extra', 'pikoworks_core'),
				'id' 	=> $prefix . 'page_class_extra',
				'type' 	=> 'text',
				'std' 	=> ''
			),
		)
	);
	// breadcrumb
	$meta_boxes[] = array(
		'id' => $prefix . 'page_breadcrumb_meta_box',
		'title' => esc_html__('Title and Breadcrumb', 'pikoworks_core'),
		'post_types' => array('post', 'page',  'portfolio', 'product', 'lookbook'),
		'tab' => true,
		'fields' => array(
			array(
				'name' => esc_html__('Show header title section', 'pikoworks_core'),
				'id' => $prefix . 'single_header_title_section',
				'type' => 'select',
				'options' => array(
					'global' => esc_html__('Global settings theme options use', 'pikoworks_core'),
					'1' => esc_html__('Show', 'pikoworks_core'),
					'dont_show' => esc_html__('Don\'t show', 'pikoworks_core'),
				),
				'std' => 'global',
			),
			array(
				'name' => esc_html__('Use Custom Title', 'pikoworks_core'),
				'desc' => esc_html__('If <strong>Yes</strong>, custom title will show on the frontend', 'pikoworks_core'),
				'id' => $prefix . 'use_custom_title',
				'type' => 'select',
				'options' => array(
					'no' => esc_html__('No', 'pikoworks_core'),
					'yes' => esc_html__('Yes', 'pikoworks_core'),
				),
				'std' => 'no',
				'required-field' => array($prefix . 'single_header_title_section', '=', array('1')),
			),
			array(
				'name' => esc_html__('Custom Header Title', 'pikoworks_core'),
				'desc' => '',
				'id' => $prefix . 'custom_header_title',
				'type' => 'text',
				'required-field' => array($prefix . 'use_custom_title', '=', 'yes'),
			),
			array(
				'name' => esc_html__('Header Background Tyle', 'pikoworks_core'),
				'desc' => esc_html__('Background type can be a slider or a image', 'pikoworks_core'),
				'id' => $prefix . 'header_bg_type',
				'type' => 'select',
				'options' => array(
					'global' => esc_html__('Global settings theme options use', 'pikoworks_core'),
					'image' => esc_html__('Custom background image', 'pikoworks_core'),
					'no_image' => esc_html__('No background image', 'pikoworks_core'),
				),
				'std' => 'global',
				'required-field' => array($prefix . 'single_header_title_section', '=', array('1')),
			),
			array(
				'name' => esc_html__('Background Image', 'pikoworks_core'),
				'desc' => esc_html__('Upload a background image or enter an URL. This background image only show if background type is "Custom background image".', 'pikoworks_core'),
				'id' => $prefix . 'header_bg_src',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'required-field' => array($prefix . 'header_bg_type', '=', 'image'),
			),
			array(
				'name' => esc_html__('Background Repeat', 'pikoworks_core'),
				'desc' => esc_html__('This option for background type is "Custom background image"', 'pikoworks_core'),
				'id' => $prefix . 'header_bg_repeat',
				'type' => 'select',
				'options' => array(
					'repeat' => esc_html__('Repeat', 'pikoworks_core'),
					'no-repeat' => esc_html__('No Repeat', 'pikoworks_core'),
				),
				'std' => 'repeat',
				'required-field' => array($prefix . 'header_bg_type', '=', array('image')),
			),

			array(
				'name'  => esc_html__('Breadcrumb Layout', 'pikoworks_core'),
				'id'    => $prefix . 'breadcrumb_layout',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'one_cols' => ReduxFramework::$_url . 'assets/img/1col.png',
					'two_cols' => get_template_directory_uri() . '/assets/images/theme-options/2columns.png',
				),
				'std'	=> '',
				'multiple' => false,
				'required-field' => array($prefix . 'single_header_title_section', '=', array('1')),

			),
			array(
				'name'  => esc_html__('Title Align', 'pikoworks_core'),
				'id'    => $prefix . 'breadcrumb_layout_title',
				'type'  => 'button_set',
				'options' => array(
					'-1'    => esc_html__('Default', 'pikoworks_core'),
					'title-left' => esc_html__('Left', 'pikoworks_core'),
					'title-right'  => esc_html__('Right', 'pikoworks_core'),
				),
				'std'	=> '-1',
				'multiple' => false,
				'required-field' => array($prefix . 'single_header_title_section', '=', array('1')),
			),
			array(
				'name' => esc_html__('Header Title Align', 'pikoworks_core'),
				'desc' => esc_html__('This option for header title, text alignment', 'pikoworks_core'),
				'id' => $prefix . 'header_title_text_align',
				'type' => 'select',
				'options' => array(
					'global' => esc_html__('Global settings theme options use', 'pikoworks_core'),
					'left'   => esc_html__('Left', 'pikoworks_core'),
					'right'  => esc_html__('Right', 'pikoworks_core'),
					'center' => esc_html__('Center', 'pikoworks_core'),
				),
				'std' => 'global',
				'required-field' => array($prefix . 'single_header_title_section', '=', array('1')),
			),
			array(
				'name' => esc_html__('Show Breadcrubm', 'pikoworks_core'),
				'id' => $prefix . 'disable_breadcrubm_layout',
				'type' => 'select',
				'options' => array(
					'global' => esc_html__('Global settings theme options use', 'pikoworks_core'),
					'dont_show' => esc_html__('Don\'t show', 'pikoworks_core'),
				),
				'std' => 'global',
			),
			array(
				'name'  => esc_html__('Breadcrubm Layout', 'pikoworks_core'),
				'id'    => $prefix . 'breadcrubm_layout',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'breadcrubm_layout2' => get_template_directory_uri() . '/assets/images/theme-options/breadcrumb-layout2.png',
					'breadcrubm_layout3' => get_template_directory_uri() . '/assets/images/theme-options/breadcrumb-layout3.png',
				),
				'std'	=> '',
				'multiple' => false,
			),
			array(
				'name' => esc_html__('Header Font Size', 'pikoworks_core'),
				'desc' => '',
				'id' => $prefix . 'custom_header_font_size',
				'type' => 'text',
				'required-field' => array($prefix . 'single_header_title_section', '=', '1'),
			),
			array(
				'name' => esc_html__('Padding top', 'pikoworks_core'),
				'desc' => '',
				'id' => $prefix . 'custom_header_padding_top',
				'type' => 'text',
				'required-field' => array($prefix . 'single_header_title_section', '=', '1'),
			),
			array(
				'name' => esc_html__('Padding bottom', 'pikoworks_core'),
				'desc' => '',
				'id' => $prefix . 'custom_header_padding_bottom',
				'type' => 'text',
				'required-field' => array($prefix . 'single_header_title_section', '=', '1'),
			),

		)
	);
	// header
	$meta_boxes[] = array(
		'id' => $prefix . 'header_layout_meta_box',
		'title' => esc_html__('Header', 'pikoworks_core'),
		'post_types' => array('post', 'page',  'portfolio', 'product', 'lookbook'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__('Manu width', 'pikoworks_core'),
				'id'    => $prefix . 'manu_width',
				'type'  => 'button_set',
				'options' => array(
					'-1'    => esc_html__('Default', 'pikoworks_core'),
					'container' => esc_html__('Container', 'pikoworks_core'),
					'container-fluid'  => esc_html__('Container Fluid', 'pikoworks_core'),
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => esc_html__('Override Brand Logo theme option', 'pikoworks_core'),
				'id'    => $prefix . 'enable_overight',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			array(
				'name'  => esc_html__('Normal Logo Upload', 'pikoworks_core'),
				'id'    => $prefix . 'logo_upload',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'required-field' => array($prefix . 'enable_overight', '=', 1),
			),
			array(
				'name'  => esc_html__('Mobile Logo Upload', 'pikoworks_core'),
				'id'    => $prefix . 'logo_upload_mobile',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'required-field' => array($prefix . 'enable_overight', '=', 1),
			),
			array(
				'name'  => esc_html__('Manu style', 'pikoworks_core'),
				'id'    => $prefix . 'menu_style',
				'type'  => 'image_set',
				'options' => array(
					'-1' => PIKOWORKSCORE_ADMIN_URL . '/assets/images/theme-options/theme-default.jpg',
					'1' => get_template_directory_uri() . '/assets/images/theme-options/header-1.jpg',
					'2' => get_template_directory_uri() . '/assets/images/theme-options/header-2.jpg',
					'3' => get_template_directory_uri() . '/assets/images/theme-options/header-3.jpg',
					'4' => get_template_directory_uri() . '/assets/images/theme-options/header-4.jpg',
					'5' => get_template_directory_uri() . '/assets/images/theme-options/header-5.jpg',
					'6' => get_template_directory_uri() . '/assets/images/theme-options/header-6.jpg',
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => esc_html__('Enable Top menu?', 'pikoworks_core'),
				'id'    => $prefix . 'enable_top_bar',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			array(
				'name'  => esc_html__('Top Bar Custom Text', 'pikoworks_core'),
				'id'    => $prefix . 'top_bar_infotext',
				'type'  => 'textarea',
				'required-field' => array($prefix . 'enable_top_bar', '=', 1),
			),
			array(
				'name'  => esc_html__('Enable Header Transparency', 'pikoworks_core'),
				'id'    => $prefix . 'header_transparency',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			array(
				'name'  => esc_html__('Login Menu or From', 'pikoworks_core'),
				'id'    => $prefix . 'menu_login_form',
				'type'  => 'button_set',
				'std'	=> '-1',
				'allowClear' => true,
				'options' => array(
					'0'    => esc_html__('None', 'pikoworks_core'),
					'1' => esc_html__('Login Menu', 'pikoworks_core'),
					'2' => esc_html__('Login Form', 'pikoworks_core'),
				),
			),

		)
	);
	// footer
	$meta_boxes[] = array(
		'id' => $prefix . 'footer_layout_meta_box',
		'title' => esc_html__('Footer', 'pikoworks_core'),
		'post_types' => array('post', 'page',  'portfolio', 'product', 'lookbook'),
		'tab' => true,
		'fields' => array(
			array(
				'name'  => esc_html__('Footer Layout', 'pikoworks_core'),
				'id'    => $prefix . 'footer_layout',
				'type'  => 'button_set',
				'options' => array(
					'0' => esc_html__('Default', 'pikoworks_core'),
					'bg_img'  => esc_html__('Background Image', 'pikoworks_core'),
				),
				'std'	=> '0',
				'multiple' => false,
			),
			array(
				'name' => esc_html__('Background Image', 'pikoworks_core'),
				'id' => $prefix . 'footer_layout_img',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'required-field' => array($prefix . 'footer_layout', '=', array('bg_img')),
			),
			
			array(
				'name'  => esc_html__('Footer inner width', 'pikoworks_core'),
				'id'    => $prefix . 'footer_inner_width',
				'type'  => 'button_set',
				'options' => array(
					'-1'    => esc_html__('Default', 'pikoworks_core'),
					'container' => esc_html__('Container', 'pikoworks_core'),
					'container-fluid'  => esc_html__('Container Fluid', 'pikoworks_core'),
				),
				'std'	=> '-1',
				'multiple' => false,
			),

			array(
				'name'  => esc_html__('Footer inner widgets', 'pikoworks_core'),
				'id'    => $prefix . 'widgets_area',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			array(
				'name'  => esc_html__('Footer inner cloumn', 'pikoworks_core'),
				'id'    => $prefix . 'footer_cloumn',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'1' => get_template_directory_uri() . '/assets/images/theme-options/1columns.png',
					'2' => get_template_directory_uri() . '/assets/images/theme-options/2columns.png',
					'3' => get_template_directory_uri() . '/assets/images/theme-options/3columns.png',
					'4' => get_template_directory_uri() . '/assets/images/theme-options/4columns.png',
					'5' => get_template_directory_uri() . '/assets/images/theme-options/5columns.png',
				),
				'std'	=> '',
				'multiple' => false,
				'required-field' => array($prefix . 'widgets_area', '=', array('1')),

			),
			array(
				'name' 	=> esc_html__('Footer inner sidebar', 'pikoworks_core'),
				'id' 	=> $prefix . 'footer_sidebar_one',
				'type' 	=> 'select',
				'placeholder' => esc_html__('Select Sidebar', 'pikoworks_core'),
				'options' 	=> $widgets_list,
				'required-field' => array($prefix . 'widgets_area', '=', array('1')),
			),


			array(
				'name'  => esc_html__('Enable footer inner top.', 'pikoworks_core'),
				'id'    => $prefix . 'widgets_area_two',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			array(
				'name'  => esc_html__('Footer inner top cloumn', 'pikoworks_core'),
				'id'    => $prefix . 'footer_cloumn_two',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'1' => get_template_directory_uri() . '/assets/images/theme-options/1columns.png',
					'2' => get_template_directory_uri() . '/assets/images/theme-options/2columns.png',
					'3' => get_template_directory_uri() . '/assets/images/theme-options/3columns.png',
					'4' => get_template_directory_uri() . '/assets/images/theme-options/4columns.png',
					'5' => get_template_directory_uri() . '/assets/images/theme-options/5columns.png',

				),
				'std'	=> '',
				'multiple' => false,
				'required-field' => array($prefix . 'widgets_area_two', '=', array('1')),

			),
			array(
				'name' 	=> esc_html__('Footer inner top Sidebar', 'pikoworks_core'),
				'id' 	=> $prefix . 'footer_sidebar_two',
				'type' 	=> 'select',
				'placeholder' => esc_html__('Select Sidebar', 'pikoworks_core'),
				'options' 	=> $widgets_list,
				'required-field' => array($prefix . 'widgets_area_two', '=', array('1')),
			),


			array(
				'name'  => esc_html__('Footer inner top 2.', 'pikoworks_core'),
				'id'    => $prefix . 'widgets_area_three',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			array(
				'name'  => esc_html__('Footer inner top 2 width', 'pikoworks_core'),
				'id'    => $prefix . 'footer_inner_top_width',
				'type'  => 'button_set',
				'options' => array(
					'-1'    => esc_html__('Default', 'pikoworks_core'),
					'container' => esc_html__('Container', 'pikoworks_core'),
					'container-fluid'  => esc_html__('Container Fluid', 'pikoworks_core'),
				),
				'std'	=> '-1',
				'multiple' => false,
				'required-field' => array($prefix . 'widgets_area_three', '=', array('1')),
			),
			array(
				'name'  => esc_html__('Footer inner top 2 cloumn', 'pikoworks_core'),
				'id'    => $prefix . 'footer_cloumn_three',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'1' => get_template_directory_uri() . '/assets/images/theme-options/1columns.png',
					'2' => get_template_directory_uri() . '/assets/images/theme-options/2columns.png',
					'3' => get_template_directory_uri() . '/assets/images/theme-options/3columns.png',
					'4' => get_template_directory_uri() . '/assets/images/theme-options/4columns.png',
					'5' => get_template_directory_uri() . '/assets/images/theme-options/5columns.png',

				),
				'std'	=> '',
				'multiple' => false,
				'required-field' => array($prefix . 'widgets_area_three', '=', array('1')),

			),
			
			array(
				'name' 	=> esc_html__('Footer inner top 2 Sidebar', 'pikoworks_core'),
				'id' 	=> $prefix . 'footer_sidebar_three',
				'type' 	=> 'select',
				'placeholder' => esc_html__('Select Sidebar', 'pikoworks_core'),
				'options' 	=> $widgets_list,
				'required-field' => array($prefix . 'widgets_area_three', '=', array('1')),
			),

			array(
				'name'  => esc_html__('Footer width', 'pikoworks_core'),
				'id'    => $prefix . 'footer_width',
				'type'  => 'button_set',
				'options' => array(
					'-1'    => esc_html__('Default', 'pikoworks_core'),
					'container' => esc_html__('Container', 'pikoworks_core'),
					'container-fluid'  => esc_html__('Container Fluid', 'pikoworks_core'),
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => esc_html__('Footer bottom layout Design.', 'pikoworks_core'),
				'id'    => $prefix . 'footer_bottom_layout',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'1' => get_template_directory_uri() . '/assets/images/theme-options/footer-bottom1.png',
					'2' => get_template_directory_uri() . '/assets/images/theme-options/footer-bottom2.png',
					'3' => get_template_directory_uri() . '/assets/images/theme-options/footer-bottom3.png',
				),
				'std'	=> '',
				'multiple' => false,

			),
			array(
				'name'  => esc_html__('Copyright text', 'pikoworks_core'),
				'id'    => $prefix . 'sub_footer_text',
				'type'  => 'wysiwyg',
				'std'	=> '',
			),
		)
	);



	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if (class_exists('RW_Meta_Box')) {
		foreach ($meta_boxes as $meta_box) {
			new RW_Meta_Box($meta_box);
		}
	}
}

add_action('admin_init', 'piko_register_meta_boxes');

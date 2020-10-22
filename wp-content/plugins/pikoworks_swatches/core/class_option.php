<?php

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Class description.
 * plugin options
 */
class Pikoworks_VS_Setting
{
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private static $options;

	/**
	 * Initialize.
	 *
	 * @return  void
	 */
	public function __construct()
	{
		add_action('admin_menu', array(__CLASS__, 'add_plugin_page'));
		add_action('admin_init', array(__CLASS__, 'page_init'));

		self::$options = get_option('pikoworks_vs_option');
	}
	/**
	 * Get product vs data.
	 *
	 * @return  string
	 */
	public static function get_product_vs_data($key)
	{
		if (!empty(self::$options[$key]))
			return self::$options[$key];
		return '';
	}
	/**
	 * Add options page
	 */
	public static function add_plugin_page()
	{
		// This page will be under "Settings"		
		add_options_page(
			'Variation Swatches',
			'Variation Swatches ',
			'manage_options',
			'pikoworks_vs_option',
			array(__CLASS__, 'create_admin_page')
		);
	}

	/**
	 * Options page callback
	 */
	public static function create_admin_page()
	{
		?>
		<div class="wrap">
			<h1><?php esc_html_e('Variation Swatches Settings', 'pikoworks_vs'); ?></h1>
			<form method="post" action="options.php">
				<?php
				// This prints out all hidden setting fields
				settings_fields('pikoworks_vs_group');
				do_settings_sections('pikowroks_vs_settings_page');
				submit_button();
				?>
			</form>
		</div>
	<?php
	}

	/**
	 * Register and add settings
	 */
	public static function page_init()
	{

		$attributes = array();
		if (class_exists('WooCommerce')) {
			$attribute_taxonomies = wc_get_attribute_taxonomies();
			$attributes = array();
			foreach ($attribute_taxonomies as $attr) {
				if ($attr->attribute_type == 'select') {
					$key1 = 'pa_' . $attr->attribute_name;
					$attributes[$key1] = $attr->attribute_label;
				}
			}
		}
		$default = array_keys($attributes);
		
		

		register_setting(
			'pikoworks_vs_group', // Option group
			'pikoworks_vs_option', // Option name
			array(__CLASS__, 'sanitize') // Sanitize
		);

		add_settings_section(
			'pikowroks_vs_section_settings',
			esc_html__('General Settings', 'pikoworks_vs'),
			array(),
			// array( __CLASS__, 'print_section_info' ),
			'pikowroks_vs_settings_page'
		);
		add_settings_field(
			'vs_attribute_image_swatch',
			esc_html__('Variation Images when select', 'pikoworks_vs'),
			array(__CLASS__, 'vs_select_callback'),
			'pikowroks_vs_settings_page',
			'pikowroks_vs_section_settings',
			array(
				'id'      => 'attribute_image_select',
				'val'     => $attributes
			)
		);
		add_settings_field(
			'vs_attribute_product_loop',
			esc_html__('Show attribute list Shop page', 'pikoworks_vs'),
			array(__CLASS__, 'vs_select_callback'),
			'pikowroks_vs_settings_page',
			'pikowroks_vs_section_settings',
			array(
				'id'      => 'attribute_product_loop',
				'default' => 1,
				'val'     => array(1 => 'Yes', 0 => 'No')
			)
		);

		add_settings_field(
			'vs_attribute_product_loop_position',
			esc_html__('Show attribute position', 'pikoworks_vs'),
			array(__CLASS__, 'vs_select_callback'),
			'pikowroks_vs_settings_page',
			'pikowroks_vs_section_settings',
			array(
				'id'      => 'attribute_product_loop_position',
				'default' => 'inside-product_image',
				'val'     => array(
					'inside-product_image' => esc_html__('Inside product image', 'pikoworks_vs'),
					'above-product-title'    => esc_html__('Above product title', 'pikoworks_vs'),
					'below-product-title'    => esc_html__('Below product title', 'pikoworks_vs')
				)
			)
		);
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize($input)
	{
		$new_input = array();
		$data_key = array('attribute_image_select', 'attribute_meta_image_upload', 'attribute_product_loop', 'attribute_product_loop_position');
		foreach ($data_key as $key => $value) {
			if (isset($input[$value])) {
				$new_input[$value] = sanitize_text_field($input[$value]);
			}
		}

		return $new_input;
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public static function vs_select_callback($args)
	{
		extract(shortcode_atts(array(
			'id'	   => '',
			'default'  => '',
			'px_class' => '',
			'val'	   => array()
		), $args));
		$select_value = isset(self::$options[$id]) ? esc_attr(self::$options[$id]) : $default;

		echo '<select id="' . $id . '" name="pikoworks_vs_option[' . $id . ']">';
		if (count($val) > 0) {
			foreach ($val as $key => $value) {
				echo '<option value="' . $key . '" ' . selected($select_value, $key, false) . '>' . $value . '</option>';
			}
		}
		echo '</select>';
	}
}
if (is_admin()) {
	$Pikoworks_VS_Setting = new Pikoworks_VS_Setting();
}

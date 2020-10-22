<?php
defined( 'ABSPATH' ) || exit;
/**
 * Class Pikoworks_Currency_Switcher
 *
 * @author  themepiko
 */

class Pikoworks_Currency_Switcher {
	/**
	 * Construct function.
	 *
	 * @return  void
	 */
	function __construct() {
		// Admin menu
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 11 );
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		add_action( 'wp_ajax_list-currency', array( $this, 'list_currency' ) );
		add_action( 'wp_ajax_nopriv_list-currency', array( $this, 'list_currency' ) );

		add_action( 'wp_ajax_save-currency', array( $this, 'save_currency' ) );
		add_action( 'wp_ajax_save-currency', array( $this, 'save_currency' ) );

		add_action( 'wp_ajax_remove-currency', array( $this, 'remove_currency' ) );
		add_action( 'wp_ajax_remove-currency', array( $this, 'remove_currency' ) );

		add_action( 'wp_ajax_update-currency-rate', array( $this, 'update_currency_rate' ) );
		add_action( 'wp_ajax_update-currency-rate', array( $this, 'update_currency_rate' ) );

		add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'save_current_rate_to_order' ), 10, 2 );

		add_filter( 'woocommerce_currency',     array( $this, 'piko_currency_woocommerce_currency'     ), 10, 1 );
		add_filter( 'woocommerce_price_format', array( $this, 'piko_currency_woocommerce_price_format' ), 10, 2 );
		add_filter( 'wc_price_args',            array( $this, 'piko_currency_price_args'               ), 10, 1 );

		add_filter( 'raw_woocommerce_price'                  , array( $this, 'piko_currency_raw_woocommerce_price' ), 10, 1 );
		add_filter( 'woocommerce_order_amount_item_subtotal' , array( $this, 'piko_currency_raw_woocommerce_price' ), 10, 1 );
		add_filter( 'woocommerce_order_item_get_subtotal_tax', array( $this, 'piko_currency_raw_woocommerce_price' ), 10, 1 );
		add_filter( 'woocommerce_order_get_total'            , array( $this, 'piko_currency_raw_woocommerce_price' ), 10, 1 );
		add_filter( 'woocommerce_order_get_total_tax'        , array( $this, 'piko_currency_raw_woocommerce_price' ), 10, 1 );
		add_filter( 'woocommerce_order_get_shipping_tax'     , array( $this, 'piko_currency_raw_woocommerce_price' ), 10, 1 );
		add_filter( 'woocommerce_order_get_shipping_total'   , array( $this, 'piko_currency_raw_woocommerce_price' ), 10, 1 );
		add_filter( 'woocommerce_order_get_total_discount'   , array( $this, 'piko_currency_raw_woocommerce_price' ), 10, 1 );

		// Revert currency when viewing order in backend.
		// if ( is_admin() ) {
		// 	add_filter( 'get_post_metadata', array( $this, 'revert_order_curreny' ), 999999, 4 );
		// }
	}

	/**
	 * Add sub-menu to theme menu.
	 *
	 * @return  void
	 */
	public static function admin_menu() {
		add_submenu_page(
			'pikoworks',
			__( 'All Currency', 'pikoworks_core' ),
			__( 'Currency Switcher', 'pikoworks_core' ),
			'manage_options',
			'pikoworks_currency',
			array( __CLASS__, 'render_html' )
		);
	}

	/**
	 * Register auto update settings.
	 *
	 * @return  void
	 */
	public static function register_settings() {
		register_setting( 'pikoworks_currency', 'piko_currency_auto_update_hours', 'intval' );
		register_setting( 'pikoworks_currency', 'piko_currency_auto_update_last_time', 'string' );
                register_setting( 'pikoworks_currency', 'piko_currency_apikey', 'string' );
	}

	/**
	 * Render admin html.
	 *
	 * @return  void
	 */
	public static function render_html() {
		if ( current_user_can( 'manage_options' ) )  {
			include PIKOWORKSCORE_CORE . '/currency/currency.php';
		}
	}

	/**
	 * Get default currency.
	 *
	 * @return  void
	 */
	public static function get_default() {
		return array(
			'currency'                       => 'USD',
			'woocommerce_currency_pos'       => 'left',
			'woocommerce_price_thousand_sep' => ',',
			'woocommerce_price_decimal_sep'  => '.',
			'woocommerce_price_num_decimals' => '2',
			'woocommerce_price_rate'         => '1'
		);
	}

	/**
	 * Get woocommerce currency.
	 *
	 * @return  void
	 */
	public static function woo_currency() {
		$currency = get_option( 'woocommerce_currency' );
		return array(
			'currency'                       => $currency,
			'woocommerce_currency_pos'       => get_option( 'woocommerce_currency_pos', 'left'    ),
			'woocommerce_price_thousand_sep' => get_option( 'woocommerce_price_thousand_sep', ',' ),
			'woocommerce_price_decimal_sep'  => get_option( 'woocommerce_price_decimal_sep', '.'  ),
			'woocommerce_price_num_decimals' => get_option( 'woocommerce_price_num_decimals', '2' ),
			'woocommerce_price_rate'         => '1'
		);

	}

	/**
	 * Get all currencies.
	 *
	 * @return  void
	 */
	public static function getCurrencies() {
		return get_option( 'piko_currencies' );
	}

	/**
	 * Get custom currency.
	 *
	 * @return  void
	 */
	public static function getCurrency( $code ) {
		$currencies = self::getCurrencies();
		if ( isset( $currencies[$code] ) ) {
			return array_merge( self::get_default(), $currencies[$code] );
		}
		return false;
	}

	/**
	 * Save currency.
	 */
	public static function saveCurrency( $code, $data ) {
		if ( $code == get_option( 'woocommerce_currency' ) ) {
			$data = self::woo_currency();
		}
		if ( $code != '' ) {
			$data['currency']  = $code;
			$currencies        = self::getCurrencies();
			$currencies[$code] = array_merge( self::get_default(), $data );
			$curs = array();

			foreach( $currencies as $code => $c ) {
				if ( $code != '' && $c['currency'] != '' ) {
					$curs[$code] = $c;
				}

			}
			update_option( 'piko_currencies', $curs );
		}
	}

	/**
	 * Delete currency.
	 */
	public static function delCurrency( $code ) {
		$currencies = self::getCurrencies();
		if ( isset( $currencies[$code] ) ) {
			unset( $currencies[$code] );
			update_option( 'piko_currencies', $currencies );
		}
	}

	/**
	 * Update currency rate.
	 */
	public static function autoUpdateCurrencyRate() {
		$currencies = self::getCurrencies();
		$woo        = self::woo_currency();
		$woo_code   = $woo['currency'];
                $api_key     = get_option('piko_currency_apikey');
                
                if ($api_key == '') {
			echo 'Please insert api key';
			exit();
		}

		//start get rate from fixer
		$codes = array();
		$code_rate = array();
		foreach( $currencies as $code => $val ) {
			if ( $code != $woo_code && $code != '' ) {
				$key = $woo_code.$code;
				$codes[$code] = $key;
				$code_rate[$key] = $code;
			}
		}

		// Get all rates from fixer data
		$all_rates = array();
		$all_rates["USD"] = 1;
		try {
                        $all_currencies_data_text = file_get_contents( 'http://data.fixer.io/api/latest?access_key=' . $api_key );
			$all_currencies_data      = json_decode( $all_currencies_data_text );
                        $all_rates = (array) $all_currencies_data->rates;
                        
//			foreach ( $all_currencies_data->list->resources AS $currency_resource ) {
//				$all_rates[substr( $currency_resource->resource->fields->name, 4 )] = $currency_resource->resource->fields->price;
//			}
		} catch ( Exception $e ) {
			echo 'Can not get currency data from fixer';
			exit();
		}

		// Calculator rate
		$rates = array();
		foreach ( $code_rate AS $code ) {
			if ( ! isset( $all_rates[$woo_code] ) ) {
				echo 'Can not get rate of base currency. ( ' . $woo_code . ' )';
				exit();
			}

			if ( isset( $all_rates[$code] ) ) {
				// If default currency is USD
				if ( $woo_code == "USD" ) {
					$rates['USD'.$code] = $all_rates[$code];
				} else {
					// Calculator rate of 2 currencies based on USD
					// For example: USDVND = 20000, USDCND = 10000
					// Result: VNDCND = 0.5
					if ( ! isset( $all_rates[$code] ) ) {
						echo 'Can not get rate of second currency. (' . $code . ')';
						exit();
					}  else {
						$rates[$woo_code.$code] = floatval( $all_rates[$code]/$all_rates[$woo_code] );
					}
				}
			}
		}

		// Save
		foreach( $rates as $key => $rate ) {
			$code = $code_rate[$key];
			$current = $currencies[$code];
			$current['woocommerce_price_rate'] = $rate;
			self::saveCurrency( $code, $current );
		}
	}

	/**
	 * List custom currency.
	 */
	public static function list_currency() {
		$currencies  = self::getCurrencies();
		$woocurrency = self::woo_currency();
		$woocode     = $woocurrency['currency'];
		if ( ! isset($currencies[$woocode] ) ) {
			$currencies[$woocode] = $woocurrency;
		}
		$html = '';
		if ( ! empty( $currencies ) ) {
			foreach( $currencies as $c ) {

				if ( $c['currency'] != $woocode ) {
					$html .= '<tr>';
				} else {
					$html .= '<tr style="background-color: #cc8d1e;">';
				}

				$html .= '<td>';
				$html .=  $c['currency'];
				$html .= '</td>';

				$html .= '<td>';
				$html .=  $c['woocommerce_currency_pos'];
				$html .= '</td>';

				$html .= '<td>';
				$html .=  $c['woocommerce_price_thousand_sep'];
				$html .= '</td>';

				$html .= '<td>';
				$html .=  $c['woocommerce_price_decimal_sep'];
				$html .= '</td>';

				$html .= '<td>';
				$html .=  $c['woocommerce_price_num_decimals'];
				$html .= '</td>';

				$html .= '<td>';
				$html .=  number_format_i18n($c['woocommerce_price_rate'], 4);
				$html .= '</td>';

				$html .= '<td>';
				if ( $c['currency'] != $woocode ) {
					$html .=  '<a href="javascript:void(0);" data-currency="' . esc_attr( $c['currency'] ) . '" class="remove-currency">Delete</a>';
				}
				$html .= '</td>';

				$html .= '</tr>';
			}
		}
		echo $html;
		exit;
	}

	/**
	 * Save currency.
	 */
	public static function save_currency() {
		$return = array( 'result' => 0 );
		if ( $_POST['currency'] != '' ) {
			$currency = array();
			$default  = self::get_default();
			foreach( $default as $key => $val ) {
				if ( isset($_POST[$key] ) ) {
					$currency[$key] = $_POST[$key];
				} else {
					$currency[$key] = $val;
				}
			}
			self::saveCurrency( $currency['currency'], $currency );
			$return['result'] = 1;
		}
		echo json_encode( $return );
		exit;
	}

	/**
	 * Remove currency.
	 */
	function remove_currency() {
		if ( $_POST['code'] != '' ) {
			$code = esc_attr($_POST['code'] );
			self::delCurrency( $code );
		}
	}

	/**
	 * Update currency rate.
	 */
	function update_currency_rate() {
		self::autoUpdateCurrencyRate();
		exit;
	}

	/**
	 * Get current currency.
	 */
	public static function getCurrentCurrency() {
		$default    = self::woo_currency();
		$currencies = self::getCurrencies();
		$current    = $default;
		$code       = isset( $_COOKIE['piko_currency'] ) ? $_COOKIE['piko_currency'] : '';

		if ( $code != '' && isset( $currencies[$code] ) ) {
			$current = $currencies[$code];
		}
		return $current;
	}

	/**
	 * Default currency.
	 */
	public static function piko_currency_woocommerce_currency( $default_currency ) {
		$current          = self::getCurrentCurrency();
		$default_currency = self::woo_currency();

		if ( isset( $current['currency'] ) && $current['currency'] != $default_currency['currency'] ) {
			return $current['currency'];
		}
		return $default_currency['currency'];
	}

	/**
	 * Currency price format.
	 */
	public static function piko_currency_woocommerce_price_format( $format, $currency_pos ) {
		global $post;
		$currency = false;
		if ( isset( $post->ID ) ) {
			$currency = get_post_meta( $post->ID, '_piko_currency', true );
		}
		$current = self::getCurrentCurrency();
		if ( $currency && is_array( $currency ) && !empty( $currency ) ) {
			$current = $currency;
		}

		$default_currency = self::woo_currency();
		if ( isset( $current['currency'] ) && $current['currency'] != $default_currency['currency'] ) {
			$currency_pos = $current['woocommerce_currency_pos'];
			$format = '%1$s%2$s';

			switch ( $currency_pos ) {
				case 'left' :
					$format = '%1$s%2$s';
					break;
				case 'right' :
					$format = '%2$s%1$s';
					break;
				case 'left_space' :
					$format = '%1$s&nbsp;%2$s';
					break;
				case 'right_space' :
					$format = '%2$s&nbsp;%1$s';
					break;
			}

		}
		return apply_filters( 'piko_currency_woocommerce_price_format', $format, $currency_pos );
	}

	/**
	 * Currency raw price.
	 */
	public static function piko_currency_raw_woocommerce_price( $price ) {
		global $post;
		$currency = false;

		if ( ! doing_filter( 'raw_woocommerce_price' ) && ( ! isset( $_REQUEST['wc-ajax'] ) || $_REQUEST['wc-ajax'] != 'checkout' || ! isset( $_REQUEST['payment_method'] ) || $_REQUEST['payment_method'] != 'paypal' ) ) {
			return ( $price );
		}
		
		if ( isset( $post->ID ) ) {
			$currency = get_post_meta( $post->ID,' _piko_currency', true );
		}
		$current = self::getCurrentCurrency();
		if ( $currency && is_array( $currency ) && ! empty( $currency ) ) {
			$current = $currency;
		}

		$default_currency = self::woo_currency();
		if ( isset( $current['currency'] ) && $current['currency'] != $default_currency['currency'] ) {
			if ( isset( $current['woocommerce_price_rate'] ) && $current['woocommerce_price_rate'] != 1 ) {
				$price = $price * floatval( $current['woocommerce_price_rate'] );
			}
		}

		return ( $price );
	}

	/**
	 * Revert order currency.
	 *
	 * @param   mixed   $value      Current meta value.
	 * @param   int     $object_id  Object ID.
	 * @param   string  $meta_key   Meta key.
	 * @param   bool    $single     Whether to return only the first value of the specified $meta_key.
	 */
	public static function revert_order_curreny( $value, $object_id, $meta_key, $single ) {
		if ( $meta_key == '_order_currency' ) {
			return get_option( 'woocommerce_currency' );
		}
	}

	/**
	 * List custom currency.
	 */
	public static function piko_currency_price_args( $args ) {
		global $post;
		$currency = false;
		if ( isset( $post->ID ) ) {
			$currency = get_post_meta( $post->ID, '_piko_currency', true );
		}
		$current = self::getCurrentCurrency();
		if ( $currency && is_array( $currency ) && !empty( $currency ) ) {
			$current = $currency;
		}

		$default_currency = self::woo_currency();

		if ( isset( $current['currency'] ) && $current['currency'] != $default_currency['currency'] ) {
			if ( isset( $current['woocommerce_price_decimal_sep'] ) ) {
				$args['decimal_separator'] = $current['woocommerce_price_decimal_sep'];
			}
			if ( isset( $current['woocommerce_price_thousand_sep'] ) ) {
				$args['thousand_separator'] = $current['woocommerce_price_thousand_sep'];
			}
			if ( isset( $current['woocommerce_price_num_decimals'] ) ) {
				$args['decimals'] = $current['woocommerce_price_num_decimals'];
			}
		}
		
		return $args;
	}
	/**
	 * Call when an order is created and save current rate to order
	 *
	 * @param   int   $orderId      order id
	 */
	public static function save_current_rate_to_order($orderId, $data) {
		$current = self::getCurrentCurrency();
		if ( ! add_post_meta( $orderId, '_piko_currency', $current, true ) ) { 
		   update_post_meta( $orderId, '_piko_currency', $current );
		}
	}

}
$currency = new Pikoworks_Currency_Switcher;
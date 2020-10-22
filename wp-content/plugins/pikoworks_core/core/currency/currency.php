<?php
$theme = wp_get_theme();
if ($theme->parent_theme) {
    $template_dir =  basename(get_template_directory());
    $theme = wp_get_theme($template_dir);
}
?>
<div class="wrap about-wrap theme-wrap">
<h1><?php esc_attr_e( 'Welcome to Xtocky!', 'pikoworks_core' ); ?></h1>
    <div class="about-text"><?php echo esc_html__( 'Xtocky is now installed and ready to use! Read below for additional information. We hope you enjoy it!', 'pikoworks_core' ); ?></div>
    <div class="theme-logo"><span class="theme-version"><?php esc_attr_e( 'Version', 'pikoworks_core' ); ?> <?php echo $theme->get('Version'); ?></span></div>
    <h2 class="nav-tab-wrapper">
        <?php
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=pikoworks' ), esc_html__( "Welcome", 'pikoworks_core' ) );    
		printf('<a href="%s" class="nav-tab">%s</a>', admin_url('admin.php?page=pikoworks-system'), esc_html__("System Status", 'pikoworks_dummy'));
        printf('<a href="%s" class="nav-tab">%s</a>', admin_url('admin.php?page=pikoworks-demo'), esc_html__("Demo", 'pikoworks_core'));
		printf('<a href="%s" class="nav-tab">%s</a>', admin_url('plugins.php'), esc_html__("Plugins", 'pikoworks_dummy'));
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=theme_options' ), esc_html__( "Theme Options", 'pikoworks_core' ) );    
        printf( '<a href="javascript:void(0)" class="nav-tab nav-tab-active">%s</a>', esc_html__( "Currency", 'pikoworks_core' ) );
        ?>
    </h2>
    <div class="theme-section">
        
    <div class="currencies-container">	
	<div class="currencies-list">
		<?php $default = Pikoworks_Currency_Switcher::woo_currency(); ?>
		<table>
			<thead>
				<tr>
					<th><?php _e( 'Currency', 'pikoworks_core' ); ?></th>
					<th><?php _e( 'Currency Position', 'pikoworks_core' ); ?></th>
					<th><?php _e( 'Thousand Separator', 'pikoworks_core' ); ?></th>
					<th><?php _e( 'Decimal Separator', 'pikoworks_core' ); ?></th>
					<th><?php _e( 'Number of Decimals', 'pikoworks_core' ); ?></th>
					<th><?php printf( __( 'Exchange Rate(In %s)', 'pikoworks_core' ), $default['currency'] ); ?></th>
					<th><?php _e( 'Action', 'pikoworks_core' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr class="tr-not-found">
					<td colspan="7"><p style="text-align: center"> <?php _e( 'Loading...', 'pikoworks_core' ); ?> </p></td>
				</tr>
			</tbody>
			<tfoot>
			<tr class="currencies-list-footer">
				<td colspan="7">
					<div class="currency-action" style="text-align: right;">
						<a class="button button-secondary" id="update-currency-rate" href="javascript:void(0);"><?php _e( 'Update Rate', 'pikoworks_core' ); ?></a>
						<a class="button button-primary" id="add-new-currency" href="javascript:void(0);"><?php _e( 'Add New Currency', 'pikoworks_core' ); ?></a>
					</div>
				</td>
			</tr>
			</tfoot>
		</table>
	</div>
    </div>

    <div class="currencies-auto-update-setting">
	<h3><?php _e( 'Auto update currency', 'pikoworks_core' ); ?></h3>
	<form method="post" action="options.php">
		<?php settings_fields( 'pikoworks_currency' ); ?>
		<?php do_settings_sections( 'pikoworks_currency' ); ?>
		<?php
		$time_format = get_option( 'time_format' );
		$last_update_time = 'Never';
		$last_update_time = esc_attr( get_option( 'piko_currency_auto_update_last_time' ) );
		if ( $last_update_time != 'Never' ) { ?>
			<input name="piko_currency_auto_update_last_time" type="hidden" id="piko_currency_auto_update_last_time"  value="<?php echo $last_update_time;?>">
		<?php }  ?>
                        <table class="form-table auto-update">
			<tbody>
                        <tr>
				<th>
					<label for="piko_currency_apikey"><?php _e( 'Api Key', 'pikoworks_core' ); ?></label>
				</th>
				<td>
					<input name="piko_currency_apikey" type="text" id="piko_currency_apikey"  value="<?php echo esc_attr( get_option('piko_currency_apikey') ); ?>">
					<p><?php _e( 'Get Free Api Key from <a href="https://fixer.io/signup/free" target="_blank">Click Fixer.io</a>', 'pikoworks_core' ); ?></p>
				</td>
			</tr>    
			<tr>
				<th>
					<label for="piko_currency_auto_update_hours"><?php _e( 'Auto update after', 'pikoworks_core' ); ?></label>
				</th>
				<td>
					<input name="piko_currency_auto_update_hours" type="number" id="piko_currency_auto_update_hours"  value="<?php echo esc_attr( get_option('piko_currency_auto_update_hours') ); ?>"> hour(s)
					<p><?php _e( 'Disable auto update type 0  and click save change button', 'pikoworks_core' ); ?></p>
				</td>
			</tr>
			<?php if ( $last_update_time ) { ?>
				<tr>
					<th><label><?php _e( 'Last update:', 'pikoworks_core' ); ?></label></th>
					<td><p><?php echo get_option( 'piko_currency_auto_update_last_time' );?></p></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<?php
		submit_button();
		?>
	</form>
    </div>

<div id="dialog" title="<?php _e( 'Add New Currency', 'pikoworks_core' ); ?>" style="display: none;">
	<?php
		$currency_code_options = get_woocommerce_currencies();

		foreach ( $currency_code_options as $code => $name ) {
			$currency_code_options[ $code ] = $name . '(' . get_woocommerce_currency_symbol( $code ) . ')';
		}
	?>
	<form id="currency-form">
		<input type="hidden" name="action" value="save-currency"/>
		<ul>
			<li>
				<div class="piko-label"><?php _e( 'Currency', 'pikoworks_core' ); ?></div>
				<div class="piko-input">
					<select name="currency">
						<?php foreach( $currency_code_options as $code => $name): ?>
							<option value="<?php echo esc_attr( $code ); ?>"><?php echo esc_html( $name ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</li>
			<li>
				<div class="piko-label"><?php _e( 'Currency Position', 'pikoworks_core' ); ?></div>
				<div class="piko-input">
					<select name="woocommerce_currency_pos" id="woocommerce_currency_pos"  class="wc-enhanced-select enhanced" tabindex="-1" title="Currency Position">
						<option value="left" selected="selected"><?php _e( 'Left ($99.99)', 'pikoworks_core' ); ?></option>
						<option value="right"><?php _e( 'Right (99.99$)', 'pikoworks_core' ); ?></option>
						<option value="left_space"><?php _e( 'Left with space ($ 99.99)', 'pikoworks_core' ); ?></option>
						<option value="right_space"><?php _e( 'Right with space (99.99 $)', 'pikoworks_core' ); ?></option>
					</select>
				</div>
			</li>
			<li>
				<div class="piko-label"><?php _e( 'Thousand Separator', 'pikoworks_core' ); ?></div>
				<div class="piko-input"><input name="woocommerce_price_thousand_sep" id="woocommerce_price_thousand_sep" type="text" style="width:50px;" value="," class="" placeholder=""></div>
			</li>
			<li>
				<div class="piko-label"><?php _e( 'Decimal Separator', 'pikoworks_core' ); ?></div>
				<div class="piko-input"><input name="woocommerce_price_decimal_sep" id="woocommerce_price_decimal_sep" type="text" style="width:50px;" value="." class="" placeholder=""></div>
			</li>
			<li>
				<div class="piko-label"><?php _e( 'Number of Decimals', 'pikoworks_core' ); ?></div>
				<div class="piko-input"><input name="woocommerce_price_num_decimals" id="woocommerce_price_num_decimals" type="number" style="width:50px;" value="2" class="" placeholder="" min="0" step="1"></div>
			</li>
			<li>
				<div class="piko-label"><?php _e( 'Exchange Rate', 'pikoworks_core' ); ?></div>
				<div class="piko-input"><input name="woocommerce_price_rate" id="woocommerce_price_num_decimals" type="text" style="width:100px;" value="1" class="" placeholder="" min="0" step="1"></div>
			</li>
			<li style="text-align: right;">
			   <input type="submit" id="currency-submit" value="<?php _e( 'Save', 'pikoworks_core' ); ?>">
			</li>
		</ul>
	</form>
</div>
        
    <p class="about-description">
        <?php _e( 'Currency exchange rate update form fixer', 'pikoworks_core' ); ?>
        <a target="_blank" href="https://fixer.io/"><?php esc_attr_e('View More info fixer.', 'pikoworks_core') ?></a>
    </p>    
    </div>
    <div class="theme-thanks">
        <p class="description"><?php esc_attr_e( 'Thank you, we hope you to enjoy using Kable!', 'pikoworks_core' ); ?></p>
    </div>
</div>
<script>
	( function( $ ) {
		function loadCurrency() {
			$.ajax({
				url:'<?php echo admin_url( 'admin-ajax.php' ); ?>',
				type:'post',
				data: { action:'list-currency' },
				success:function( data ) {
					if( data.length > 5 ) {
						$( 'tr#tr-not-found' ).remove();
						$( '.currencies-list tbody' ).html( data );
					}
				}
			});
		}

		$(function() {
			loadCurrency();
			$( '#add-new-currency' ).click(function() {
				$( "#dialog" ).dialog({
					modal: true,
					minWidth: 550
				});
			});

			$( 'body' ).on( 'submit', '#currency-form',function( event ) {
				event.preventDefault();
				$.ajax({
					url:'<?php echo admin_url( 'admin-ajax.php' ); ?>',
					type:'post',
					data: $( 'form#currency-form' ).serialize(),
					dataType: 'json',
					success:function( data ) {
						if ( data.result == 0 ) {
							alert( 'Your data is incorrect. Please check it again.' );
						} else {
							$( '#dialog' ).dialog( 'close' );
							loadCurrency();
						}
					}
				});
			});

			$( 'body' ).on( 'click', '.remove-currency', function() {
				var currency = $(this).data( 'currency' );
				if ( confirm( 'Are you sure to delete?' ) ) {
					$.ajax({
						url:'<?php echo admin_url( 'admin-ajax.php' ); ?>',
						type:'post',
						data: { action:'remove-currency', code: currency },
						dataType: 'json',
						success:function(data){
							loadCurrency();
						}
					});
				}
			});

			$( '#update-currency-rate' ).click( function() {
                                var $thisbutton = $( this );
                                $.ajax({
                                        url:'<?php echo admin_url( 'admin-ajax.php' ); ?>',
                                        type:'post',
                                        data: {action:'update-currency-rate'},
                                        dataType: 'json',
                                        beforeSend: function() { 
                                            $thisbutton.prepend( '<i class="fa fa-spinner fa-pulse"></i>' );                                                    
                                        },
                                        complete: function() {
                                            $thisbutton.children('.fa-spinner').remove();
                                        },
                                        success:function( data ) {
                                                loadCurrency();
                                                $thisbutton.text('Rate Update Successful');
                                        }
                                });
			});        
		});
	} )( jQuery );
</script>
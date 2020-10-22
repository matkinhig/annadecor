<?php
/**
 * Author: themepiko
 * Category Header fields image. *
 * @access public
 * @return void
 */

function pikoworks_wc_add_category_header_img() {

	global $woocommerce;

	?>

	<div class="form-field">
		<label><?php esc_html_e( 'Category Header image', 'pikoworks_custom_post' ); ?></label>
		<div id="product_cat_header" style="float:left;margin-right:10px;"><img src="<?php echo wc_placeholder_img_src(); ?>" width="60px" height="60px" /></div>
		<div style="line-height:60px;">
			<input type="hidden" id="product_cat_header_id" name="product_cat_header_id" />
			<button type="submit" class="upload_header_button button"><?php esc_html_e( 'Upload/Add image', 'pikoworks_custom_post' ); ?></button>
			<button type="submit" class="remove_header_image_button button"><?php esc_html_e( 'Remove image', 'pikoworks_custom_post' ); ?></button>
		</div>

		<script type="text/javascript">

			// Only show the "remove image" button when needed
			if ( ! jQuery('#product_cat_header_id').val() )
				jQuery('.remove_header_image_button').hide();

			// Uploading files
			var header_file_frame;
			
			jQuery(document).on( 'click', '.upload_header_button', function( event ){

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( header_file_frame ) {
					header_file_frame.open();
					return;
				}

				// Create the media frame.
				header_file_frame = wp.media.frames.downloadable_file = wp.media({
					title: '<?php esc_html_e( 'Choose an image', 'pikoworks_custom_post' ); ?>',
					button: {
						text: '<?php esc_html_e( 'Use image', 'pikoworks_custom_post' ); ?>',
					},
					multiple: false
				});

				// When an image is selected, run a callback.
				header_file_frame.on( 'select', function() {
					attachment = header_file_frame.state().get('selection').first().toJSON();
					jQuery('#product_cat_header_id').val( attachment.id );
					jQuery('#product_cat_header img').attr('src', attachment.url );
					jQuery('.remove_header_image_button').show();
				});

				// Finally, open the modal.
				header_file_frame.open();

			});

			jQuery(document).on( 'click', '.remove_header_image_button', function( event ){
				jQuery('#product_cat_header img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
				jQuery('#product_cat_header_id').val('');
				jQuery('.remove_header_image_button').hide();
				return false;
			});

		</script>

		<div class="clear"></div>

	</div>

	<?php

}

add_action( 'product_cat_add_form_fields', 'pikoworks_wc_add_category_header_img' );




/**
 * Edit category header field. *
 * @access public
 * @param mixed $term Term (category) being edited
 * @param mixed $taxonomy Taxonomy of the term being edited
 * @return void
 */

function pikoworks_wc_edit_category_header_img( $term, $taxonomy ) {

	global $woocommerce;

	$display_type	= get_term_meta( $term->term_id, 'display_type', true );
	$image 			= '';
	$header_id 	= absint( get_term_meta( $term->term_id, 'header_id', true ) );
	if ($header_id) :
		$image = wp_get_attachment_url( $header_id );
	else :
		$image = wc_placeholder_img_src();
	endif;

	?>

	<tr class="form-field">
		<th scope="row" valign="top"><label><?php esc_html_e( 'Header', 'pikoworks_custom_post' ); ?></label></th>
		<td>
			<div id="product_cat_header" style="float:left;margin-right:10px;"><img src="<?php echo $image; ?>" width="60px" height="60px" /></div>
			<div style="line-height:60px;">
				<input type="hidden" id="product_cat_header_id" name="product_cat_header_id" value="<?php echo $header_id; ?>" />
				<button type="submit" class="upload_header_button button"><?php esc_html_e( 'Upload/Add image', 'pikoworks_custom_post' ); ?></button>
				<button type="submit" class="remove_header_image_button button"><?php esc_html_e( 'Remove image', 'pikoworks_custom_post' ); ?></button>
			</div>

			<script type="text/javascript">			 

			if (jQuery('#product_cat_thumbnail_id').val() == 0)
				 jQuery('.remove_image_button').hide();

			if (jQuery('#product_cat_header_id').val() == 0)
				 jQuery('.remove_header_image_button').hide();

				// Uploading files
				var header_file_frame;

				jQuery(document).on( 'click', '.upload_header_button', function( event ){

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( header_file_frame ) {
						header_file_frame.open();
						return;
					}

					// Create the media frame.
					header_file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php esc_html_e( 'Choose an image', 'pikoworks_custom_post' ); ?>',
						button: {
							text: '<?php esc_html_e( 'Use image', 'pikoworks_custom_post' ); ?>',
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					header_file_frame.on( 'select', function() {
						attachment = header_file_frame.state().get('selection').first().toJSON();
						jQuery('#product_cat_header_id').val( attachment.id );
						jQuery('#product_cat_header img').attr('src', attachment.url );
						jQuery('.remove_header_image_button').show();
					});

					// Finally, open the modal.
					header_file_frame.open();
				});

				jQuery(document).on( 'click', '.remove_header_image_button', function( event ){
					jQuery('#product_cat_header img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
					jQuery('#product_cat_header_id').val('');
					jQuery('.remove_header_image_button').hide();
					return false;
				});

			</script>

			<div class="clear"></div>

		</td>

	</tr>

	<?php

}

add_action( 'product_cat_edit_form_fields', 'pikoworks_wc_edit_category_header_img', 10,2 );




/**
 *
 * @access public
 * @param mixed $term_id Term ID being saved
 * @param mixed $tt_id
 * @param mixed $taxonomy Taxonomy of the term being saved
 * @return void
 */

function pikoworks_wc_category_header_img_save( $term_id, $tt_id, $taxonomy ) {	

	if ( isset( $_POST['product_cat_header_id'] ) )
		update_woocommerce_term_meta( $term_id, 'header_id', absint( $_POST['product_cat_header_id'] ) );

	delete_transient( 'wc_term_counts' );

}

add_action( 'created_term', 'pikoworks_wc_category_header_img_save', 10,3 );
add_action( 'edit_term', 'pikoworks_wc_category_header_img_save', 10,3 );



/**
 * Header column added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @return void
 */

function pikoworks_wc_product_cat_header_columns( $columns ) {

	$new_columns = array();
	$new_columns['cb'] = $columns['cb'];
	$new_columns['thumb'] = esc_html__( 'Image', 'pikoworks_custom_post' );
	$new_columns['header'] = esc_html__( 'Header', 'pikoworks_custom_post' );
	unset( $columns['cb'] );
	unset( $columns['thumb'] );

	return array_merge( $new_columns, $columns );

}

add_filter( 'manage_edit-product_cat_columns', 'pikoworks_wc_product_cat_header_columns' );


/**
 * Thumbnail column value added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @param mixed $column
 * @param mixed $id
 * @return void
 */

function pikoworks_wc_product_cat_header_column( $columns, $column, $id ) {

	global $woocommerce;

	if ( $column == 'header' ) {
		
		$image 			= '';
		$thumbnail_id 	= get_term_meta( $id, 'header_id', true );

		if ($thumbnail_id)
			$image = wp_get_attachment_url( $thumbnail_id );
		else
			$image = wc_placeholder_img_src();

		$columns .= '<img src="' . $image . '" alt="Thumbnail" class="wp-post-image" height="40" width="40" />';

	}

	return $columns;
	
}

add_filter( 'manage_product_cat_custom_column', 'pikoworks_wc_product_cat_header_column', 10, 3 );





/** 
 * @access public
 * @param mixed $cat_ID -image's product category ID (if empty/false auto loads curent product category ID)
 * @return mixed (string|false)
 */

function pikoworks_wc_get_header_image_url($cat_ID = false) {

	if ($cat_ID==false && is_product_category()){
		global $wp_query;
		
		// get the query object
		$cat = $wp_query->get_queried_object();
		
		// get the thumbnail id user the term_id
		$cat_ID = $cat->term_id;
	}

    $thumbnail_id = get_term_meta($cat_ID, 'header_id', true );

    // get the image URL
   return wp_get_attachment_url( $thumbnail_id ); 

}

//add_action('woocommerce_archive_description','pikoworks_wc_show_category_header_image'); //when you not use  our theme 
function pikoworks_wc_show_category_header_image() {
	$category_header_src = pikoworks_wc_get_header_image_url();	
	echo ($category_header_src!="") ? '<div class="woocommerce_category_header_image"><img src="'.$category_header_src.'" style="width:100%; height:auto; margin:0 0 20px 0" /></div>' : "";
}









// STYLING THE ADMIN AREA
function product_cat_header_column() {
   echo '<style type="text/css">
			table.wp-list-table .column-header {
				width: 52px;
				text-align: center;
				white-space: nowrap;
			}
         </style>';
}

add_action('admin_head', 'product_cat_header_column');

?>
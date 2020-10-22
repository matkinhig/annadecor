<?php
/*
Plugin Name: WP Instagram Widget
Plugin URI: https://github.com/scottsweb/wp-instagram-widget
Description: A WordPress widget for showing your latest Instagram photos.
Version: 2.0.4
Author: Scott Evans
Author URI: https://scott.ee
Text Domain: wp-instagram-widget
Domain Path: /assets/languages/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
GitHub Plugin URI: scottsweb/wp-instagram-widget
Copyright © 2013 Scott Evans
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

Class pikoworks_Instagram_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'null-instagram-feed',
			esc_html__( '[Pikoworks] Instagram', 'pikoworks_core' ),
			array(
				'classname' => 'null-instagram-feed clearfix',
				'description' => esc_html__( 'Displays your latest Instagram photos', 'pikoworks_core' ),
				'customize_selective_refresh' => true,
			)
		);
	}

	function widget( $args, $instance ) {

		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$username = empty( $instance['username'] ) ? '' : $instance['username'];
		$limit = empty( $instance['number'] ) ? 9 : $instance['number'];
		$size = empty( $instance['size'] ) ? 'large' : $instance['size'];
		$target = empty( $instance['target'] ) ? '_self' : $instance['target'];
		$link = empty( $instance['link'] ) ? '' : $instance['link'];
                
                $columns = empty($instance['columns']) ? 3 : (int) $instance['columns'];
                $spacing = empty($instance['spacing']) ? false : true;
                $disable_meta = empty($instance['disable_meta']) ? false : true;                
                
                //slider
		$is_slider = empty($instance['is_slider']) ? '' : 'yes';		
		$autoplay = empty($instance['autoplay']) ? 'true' : $instance['autoplay'];		
		$navigation = empty($instance['navigation']) ? 'true' : $instance['navigation'];
                $navigation_btn = empty($instance['navigation_btn']) ? ' ' : $instance['navigation_btn'];
		$margin = empty($instance['margin']) ? '' : $instance['margin'];		
                $loop = empty($instance['loop']) ? 'false' : $instance['loop'];
                $dots = empty($instance['dots']) ? 'false': $instance['dots'];
                $btn_light = empty($instance['btn_light']) ? '' : $instance['btn_light'];
                $btn_hover_show = empty($instance['btn_hover_show']) ? '' : $instance['btn_hover_show'];
                
                $use_responsive = empty($instance['use_responsive']) ? '0' : $instance['use_responsive'];
                $items_large_device = empty($instance['items_large_device']) ? '4' : $instance['items_large_device']  ;
                $items_very_large_device = empty($instance['items_very_large_device']) ? '6' : $instance['items_very_large_device']  ;
                $items_mobile_device = empty($instance['items_mobile_device']) ? '1' : $instance['items_mobile_device']  ;

		echo $args['before_widget'];

		if ( ! empty( $title ) ) { echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title']; };

		do_action( 'wpiw_before_widget', $instance );

		if ( '' !== $username ) {

			$media_array = $this->scrape_instagram( $username );

			if ( is_wp_error( $media_array ) ) {

				echo wp_kses_post( $media_array->get_error_message() );

			} else {

				// filter for images only?
				if ( $images_only = apply_filters( 'wpiw_images_only', false ) ) {
					$media_array = array_filter( $media_array, array( $this, 'images_only' ) );
				}

				// slice list down to required limit.
				$media_array = array_slice( $media_array, 0, $limit );

				// filters for custom classes.
				$ulclass = apply_filters( 'wpiw_list_class', 'instagram-pics instagram-size-' . $size );
				$liclass = apply_filters( 'wpiw_item_class', '' );
				$aclass = apply_filters( 'wpiw_a_class', '' );
				$imgclass = apply_filters( 'wpiw_img_class', '' );
				$template_part = apply_filters( 'wpiw_template_part', 'parts/wp-instagram-widget.php' );

				if($spacing){ 
                                    $spacing = 'no-gap';                                            
                                }                                
                                $col_md = round(12/$items_large_device);
                                
                                if($items_large_device == '4'){
                                  $col_sm =  ($col_md + 1);  
                                }elseif($items_large_device == '3'){
                                    $col_sm =  ($col_md + 2); 
                                }elseif($items_large_device == '6'){
                                    $col_sm =  ($col_md + 1); 
                                }else{
                                    $col_sm =  $col_md; 
                                }                                
                                
                                if( ! pikoworks_is_mobile() ){ 
                                    $col_class[] = 'col-lg-'.round(12/$items_very_large_device);
                                    $col_class[] = 'col-md-'.$col_md;
                                    $col_class[] = 'col-sm-'.$col_sm;
                                    $col_class = esc_attr( implode(' ', $col_class) );
                                }
                                if( $is_slider == 'yes' && $use_responsive == '0' || pikoworks_is_mobile()){
                                     $col_class = 'col-12';
                                }
                                
                                $slide_class = 'piko-carousel-grid row '. $spacing;
                                $data_slick = '';
                                if($is_slider == 'yes' || pikoworks_is_mobile()){
                                    $slide_class = 'piko-carousel' . ' ' . $navigation_btn . ' ' . $btn_light. ' ' . $btn_hover_show.' '.$margin;                                     
                                    
                                    $res_large = $use_responsive ? '"slidesToShow":'.esc_attr($items_very_large_device).', "slidesToScroll": 1,' : '';
                                    $res_media = $use_responsive ? '"responsive":[{"breakpoint": 1200,"settings":{"slidesToShow":'.esc_attr($items_large_device).'}},{"breakpoint": 1024,"settings":{"slidesToShow": 3}},{"breakpoint": 768,"settings":{"slidesToShow": 2}},{"breakpoint": 480,"settings":{"slidesToShow":  '.esc_attr($items_mobile_device).'}}]' : '';
                                    
                                    $data_slick = '{'.$res_large.'"arrows":'.esc_attr($navigation).',"dots":'.esc_attr($dots).',"infinite":'.esc_attr($loop).',"autoplay":'.esc_attr($autoplay).','.$res_media.'}';                                   
                                }
                                
                                
                                ?>


<ul class="<?php echo esc_attr($slide_class.' ' .$ulclass) ?>" data-slick='<?php echo $data_slick ?>'>                                    
                                    <?php
				foreach( $media_array as $item ) {
                                    
                                    if($disable_meta == 'yes'){
                                            $button_wrap =  '<a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'" class="btn-instagram">'. esc_html__('View Item', 'pikoworks_core') . '</a>';
                                    }else{
                                    $button_wrap ='<div class="ins-meta btn-instagram">
                                                    <div class="ins-info">
                                                        <a href="#"><i class="ins-icon fa fa-heart" aria-hidden="true"></i><span>' . esc_attr($item['likes']). '</span></a>
                                                        <a href="#"><i class="ins-icon fa fa-comment" aria-hidden="true"></i><span>' . esc_attr($item['comments']). '</span></a>
                                                    </div><!-- End .ins-info -->
                                                </div>';  
                                    }

                                    
					// copy the else line into a new file (parts/wp-instagram-widget.php) within your theme and customise accordingly.
					if ( locate_template( $template_part ) !== '' ) {
						include locate_template( $template_part );
					} else { 
                                            
                                            echo '<li class="' .esc_attr($col_class .' ' .$liclass) .'">
                                                <div class="ins-feed">
                                                    <figure>
                                                        <a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'"  class="ing-hashtag '. esc_attr( $aclass ) .'"><img src="'. esc_url( $item[$size] ) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'" width="1080" height="1080" class="'. esc_attr( $imgclass ) .'"/></a>
                                                        <figcaption>'.balanceTags($button_wrap).'</figcaption>
                                                    </figure>                                                    
                                                </div><!-- End .ins-feed -->
                                            </li>';
					}
				}
				?></ul><?php
			}
		}

		$linkclass = apply_filters( 'wpiw_link_class', 'clearfix' );
		$linkaclass = apply_filters( 'wpiw_linka_class', '' );

		switch ( substr( $username, 0, 1 ) ) {
			case '#':
				$url = '//www.instagram.com/explore/tags/' . str_replace( '#', '', $username );
				break;

			default:
				$url = '//www.instagram.com/' . str_replace( '@', '', $username );
				break;
		}

		if ( '' !== $link ) {
			?><p class="<?php echo esc_attr( $linkclass ); ?>"><a href="<?php echo trailingslashit( esc_url( $url ) ); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>" class="<?php echo esc_attr( $linkaclass ); ?>"><?php echo wp_kses_post( $link ); ?></a></p><?php
		}

		do_action( 'wpiw_after_widget', $instance );

		echo $args['after_widget'];
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title' => esc_html__( 'Instagram', 'pikoworks_core' ),
			'username' => '',
			'size' => 'large',
			'link' => esc_html__( 'Follow Me!', 'pikoworks_core' ),
			'number' => 9,
			'target' => '_self',
			'columns' => 3,
			'spacing' => false,
		) );
		$title = $instance['title'];
		$username = $instance['username'];
		$number = absint( $instance['number'] );
		$size = $instance['size'];
		$target = $instance['target'];
		$link = $instance['link'];
                $columns = $instance['columns'];
                $spacing = $instance['spacing'];
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'pikoworks_core' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'username', 'pikoworks_core' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" /></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of photos', 'pikoworks_core' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" /></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Photo size', 'pikoworks_core' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" class="widefat">
				<option value="thumbnail" <?php selected( 'thumbnail', $size ); ?>><?php esc_html_e( 'Thumbnail', 'pikoworks_core' ); ?></option>
				<option value="small" <?php selected( 'small', $size ); ?>><?php esc_html_e( 'Small', 'pikoworks_core' ); ?></option>
				<option value="large" <?php selected( 'large', $size ); ?>><?php esc_html_e( 'Large', 'pikoworks_core' ); ?></option>
				<option value="original" <?php selected( 'original', $size ); ?>><?php esc_html_e( 'Original', 'pikoworks_core' ); ?></option>
			</select>
		</p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open links in', 'pikoworks_core' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" class="widefat">
				<option value="_self" <?php selected( '_self', $target ); ?>><?php esc_html_e( 'Current window (_self)', 'pikoworks_core' ); ?></option>
				<option value="_blank" <?php selected( '_blank', $target ); ?>><?php esc_html_e( 'New window (_blank)', 'pikoworks_core' ); ?></option>
			</select>
		</p>
<!--                <p><label for="<?php echo $this->get_field_id('columns'); ?>"><?php esc_html_e('Columns', 'pikoworks_core'); ?>:</label>
			<select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>" class="widefat">
				<option value="2" <?php selected(2, $columns) ?>>2</option>
				<option value="3" <?php selected(3, $columns) ?>>3</option>
				<option value="4" <?php selected(4, $columns) ?>>4</option>
			</select>
		</p>-->
<!--                <p>
			<input type="checkbox" <?php checked( true, $spacing, true); ?> id="<?php echo $this->get_field_id('spacing'); ?>" name="<?php echo $this->get_field_name('spacing'); ?>">
			<label for="<?php echo $this->get_field_id('spacing'); ?>"><?php esc_html_e('Without spacing', 'pikoworks_core'); ?></label>
		</p>                -->
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link text', 'pikoworks_core' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" /></label></p>
		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = trim( strip_tags( $new_instance['username'] ) );
		$instance['number'] = ! absint( $new_instance['number'] ) ? 9 : $new_instance['number'];
		$instance['size'] = ( ( 'thumbnail' === $new_instance['size'] || 'large' === $new_instance['size'] || 'small' === $new_instance['size'] || 'original' === $new_instance['size'] ) ? $new_instance['size'] : 'large' );
		$instance['target'] = ( ( '_self' === $new_instance['target'] || '_blank' === $new_instance['target'] ) ? $new_instance['target'] : '_self' );
		$instance['link'] = strip_tags( $new_instance['link'] );
                $instance['columns'] = !absint($new_instance['columns']) ? 3 : $new_instance['columns'];
                $instance['spacing'] = ($new_instance['spacing'] != '') ? true : false;
                $instance['slider'] = ($new_instance['slider'] != '') ? true : false;

		return $instance;
	}

	// based on https://gist.github.com/cosmocatalano/4544576.
	function scrape_instagram( $username ) {

		global $wp_version;

		$proxies = array(
			'https://boomproxy.com/browse.php?u=',
			'https://us.hidester.com/proxy.php?u=',
			'https://proxy-us1.toolur.com/browse.php?u=',
			'https://proxy-fr1.toolur.com/browse.php?u=',
		);

		$username = trim( strtolower( $username ) );
		switch ( substr( $username, 0, 1 ) ) {
			case '#':
				$url              = 'https://www.instagram.com/explore/tags/' . str_replace( '#', '', $username ) . '?__a=1';
				$transient_prefix = 'h';
				break;
			default:
				$url             = 'https://www.instagram.com/' . str_replace( '@', '', $username ) . '?__a=1';
				$transient_prefix = 'u';
				break;
		}
		if ( false === ( $instagram = get_transient( 'insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ) ) ) ) {
			
			$remote = wp_remote_get( $url, array(
				'user-agent' => 'Instagram/' . $wp_version . '; ' . home_url()
			) );

			if ( is_wp_error( $remote ) ) {
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'wp-instagram-widget' ) );
			}

			if ( 200 !== wp_remote_retrieve_response_code( $remote ) ) {
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'wp-instagram-widget' ) );
			}

			$insta_array = json_decode( $remote['body'], true );

			if ( ! $insta_array ) {
				return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'wp-instagram-widget' ) );
			}

			if ( isset( $insta_array['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
				$images = $insta_array['graphql']['user']['edge_owner_to_timeline_media']['edges'];
			} elseif ( isset( $insta_array['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
				$images = $insta_array['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
			} else {
				return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'wp-instagram-widget' ) );
			}

			if ( ! is_array( $images ) ) {
				return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'wp-instagram-widget' ) );
			}

			$instagram = array();
			foreach ( $images as $image ) {
				if ( true === $image['node']['is_video'] ) {
					$type = 'video';
				} else {
					$type = 'image';
				}
				$caption = __( 'Instagram Image', 'pikoworks_core' );
				if ( ! empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
					$caption = wp_kses( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'], array() );
				}
				$instagram[] = array(
					'description' => $caption,
					'link'        => trailingslashit( '//instagram.com/p/' . $image['node']['shortcode'] ),
					'time'        => $image['node']['taken_at_timestamp'],
					'comments'    => $image['node']['edge_media_to_comment']['count'],
					'likes'       => $image['node']['edge_liked_by']['count'],
					'thumbnail'   => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ),
					'small'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ),
					'large'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src'] ),
					'original'    => preg_replace( '/^https?\:/i', '', $image['node']['display_url'] ),
					'type'        => $type,
				);
			} // End foreach().
			// do not set an empty transient - should help catch private or empty accounts. Set a shorter transient in other cases to stop hammering Instagram
			if ( ! empty( $instagram ) ) {
				$instagram = base64_encode( serialize( $instagram ) );
				set_transient( 'wpiw-01-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 3 ) );
			} else {
				$instagram = base64_encode( serialize( array() ) );
				set_transient( 'wpiw-01-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', MINUTE_IN_SECONDS * 10 ) );
			}
		}
		if ( ! empty( $instagram ) ) {
			return unserialize( base64_decode( $instagram ) );
		} else {
			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'pikoworks_core' ) );
		}
	}

	function images_only( $media_item ) {

		if ( 'image' === $media_item['type'] ) {
			return true;
		}

		return false;
	}
}

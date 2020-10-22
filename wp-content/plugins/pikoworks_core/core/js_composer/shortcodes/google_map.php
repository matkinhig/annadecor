<?php
/**
 * @google map
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_google_map' );
function pikoworks_google_map(){
// Setting shortcode lastest
vc_map( array(
    "name"        => esc_html__( "Google Map", 'pikoworks_core'),
    "base"        => "pikoworks_google_map",
    "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
    "description" => esc_html__( "Show different type of product", 'pikoworks_core'),
    "params"      => array(
        
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__( 'Google Map style', 'pikoworks_core' ),
            'param_name' => 'map_style',
            'admin_label' => true,
            'value'      => array(
                esc_html__( 'Only Map', 'pikoworks_core' )    => 'map',
                esc_html__( 'Map with Contact', 'pikoworks_core' ) => 'map_contact',
            )
        ),
        array(
            'type' => 'textfield',
            'param_name' => 'title',
            'heading' => esc_html__('Contact from Title', 'pikoworks_core'),
            'value' => esc_html__('Get in Touch', 'pikoworks_core'),
            'admin_label' => true,
            'dependency' => array(
                    'element'   => 'map_style',
                    'value' => 'map_contact',
                ),
        ),
        
        array(
            'type' => 'textfield',
            'param_name' => 'contact_form',
            'heading' => esc_html__('Contact form 7 or other shortcode', 'pikoworks_core'),
            'description' => esc_html__('NB: WP Admin -> Contact -> Contact from ->shortcode like as: [contact-form-7 id="3789" title="Contact page 2"]', 'pikoworks_core'),
            'value' => '[contact-form-7 id="3789" title="Contact page 2"]',
            'dependency' => array(
                    'element'   => 'map_style',
                    'value' => 'map_contact',
                ),
        ),        
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Map Zooming", 'pikoworks_core' ),
            "param_name"  => "map_zoom",
            'value' => '5',
            'admin_label' => true,
            'description' => esc_html__('Default zoom 5, Type numeric value to change zoom label', 'pikoworks_core'),
            
        ),
        array(
            'type' => 'attach_image',
            'param_name' => 'image',
            'heading' => esc_html__('Map Marker', 'pikoworks_core'),
        ),        
        array(
            'type' => 'textfield',
            'param_name' => 'latitude',
            'heading' => esc_html__('Latitude', 'pikoworks_core'),
            'description'     => sprintf( wp_kses( __( 'Enter your Latitude value. Visit  <a href="%s" target="__blank"> Click </a>  Search your location the copy the code and paste here', 'pikoworks_core' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), 'http://www.mapcoordinates.net/' ),
            'value' => '51.4102657',
        ),
        array(
            'type' => 'textfield',
            'param_name' => 'longitude',
            'heading' => esc_html__('Longitude', 'pikoworks_core'),
            'description' => esc_html__('Enter your Longitude value', 'pikoworks_core'),
            'value' => '-0.2162178',
        ),        
        array(
            'type' => 'textfield',
            'param_name' => 'place_id',
            'heading' => esc_html__('Pleace ID', 'pikoworks_core'),
            'description'     => sprintf( wp_kses( __( 'Enter your Pleace ID important for marker. Visit  <a href="%s" target="__blank"> Click </a>  Search your location then you see bellow marker like as Place ID: Eh40OCBPeGZvcmQgQXZlLCBMb25kb24gU1cyMCwgVUs', 'pikoworks_core' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), 'https://developers.google.com/places/place-id/' ),
            'value' => 'Eh40OCBPeGZvcmQgQXZlLCBMb25kb24gU1cyMCwgVUs',
        ),
        array(
            'type' => 'textfield',
            'param_name' => 'api_key',
            'heading' => esc_html__('API key', 'pikoworks_core'),
            'description'     => sprintf( wp_kses( __( 'Get an API key Maps. Visit  <a href="%s" target="__blank"> Click </a>', 'pikoworks_core' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), 'https://developers.google.com/maps/documentation/javascript/get-api-key/' ),
            'value' => 'AIzaSyB1IQgdCAoyoSnQozXOIoX6L1UB7PT99rU&libraries=places',
        ),
        array(
            'type' => 'textfield',
            'param_name' => 'office_name',
            'heading' => esc_html__('Your office name', 'pikoworks_core'),
            'value' => 'pikoworks LTD',
        ),
        array(
            'type' => 'textfield',
            'param_name' => 'phone',
            'heading' => esc_html__('Your Phone number', 'pikoworks_core'),
            'value' => '880173 143 9170',
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__( 'Map layout', 'pikoworks_core' ),
            'param_name' => 'map_layout',
            'admin_label' => true,            
            'value'      => array(
                esc_html__( 'Standard', 'pikoworks_core' )    => '1',
                esc_html__( 'style 01', 'pikoworks_core' ) => '2',
            ),
            'std' => '2',
            
        ),         
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Extra class name", 'pikoworks_core' ),
            "param_name"  => "el_class",
            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks_core" ),
        ),
         array(
            'type'           => 'css_editor',
            'heading'        => esc_html__( 'Css', 'pikoworks_core' ),
            'param_name'     => 'css',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'pikoworks_core' ),
            'group'          => esc_html__( 'Design options', 'pikoworks_core' )
	)
    )
));
}
class WPBakeryShortCode_pikoworks_google_map extends WPBakeryShortCode { 
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'pikoworks_google_map', $atts ) : $atts;
        $atts = shortcode_atts( array(            
            'map_style' => 'map',
            'title' => '',
            'contact_form' => '[contact-form-7 id="3789" title="Contact page 2"]',            
            'image'   => '',
            'map_zoom'   => '5',
            'latitude'   => '38.23205',
            'longitude'   => '-85.80710',
            'place_id'   => 'Eh40OCBPeGZvcmQgQXZlLCBMb25kb24gU1cyMCwgVUs',
            'api_key'   => 'AIzaSyB1IQgdCAoyoSnQozXOIoX6L1UB7PT99rU&libraries=places',
            'office_name' =>  esc_html('Pikoworks Llt', 'pikoworks_core'),
            'phone'     =>  esc_html('880173 143 9170', 'pikoworks_core'),
            'map_layout'     =>  '3',
            'el_class'           => '',
            'css'           => '',
            
            
        ), $atts );
        extract($atts);       
        $css_class = 'google-map ' . $el_class;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;
       
            $image_attributes = wp_get_attachment_image_src( $image );
        
        ob_start();        
        ?>
		<?php if($map_style == 'map'): ?>

    
        <div class="<?php echo esc_attr( $css_class ); ?>">
           <div id="map"></div>
        </div>        
        <?php else: ?>

        <div class="map-container">
            <div id="map"></div><!-- End #map -->
            <div class="form-container <?php echo esc_attr( $css_class ); ?>">
                <h2><?php echo esc_attr($title); ?></h2>
                <?php echo do_shortcode( $contact_form ); ?>
            </div><!-- End .form-container -->
        </div>
        <?php endif;?>
<script>      
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: <?php echo esc_attr($latitude); ?>, lng: <?php echo esc_attr($longitude); ?>},
            zoom: <?php echo esc_attr($map_zoom); ?>,
            scrollwheel: false,
            navigationControl: true,
            mapTypeControl: false,
            scaleControl: false,
            draggable: true,
            <?php if($map_layout == '2'): ?>
            styles: [{featureType: 'all',stylers: [{ saturation: -80 }]},{featureType: 'road.arterial', elementType: 'geometry',stylers: [{ hue: '#00ffee' },{ saturation: 50 }]},{featureType: 'poi.business',elementType: 'labels',stylers: [{ visibility: 'off' }]}]
            <?php endif; ?>
        });

        var infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);

        service.getDetails({
          placeId: '<?php echo esc_attr($place_id); ?>'
        }, function(place, status) {
          if (status === google.maps.places.PlacesServiceStatus.OK) {
            var marker = new google.maps.Marker({
              map: map,
              position: place.geometry.location,
              icon: '<?php echo balanceTags($image_attributes[0], true ); ?>'
            });
            google.maps.event.addListener(marker, 'click', function() {
              infowindow.setContent('<div><strong><?php echo esc_attr($office_name); ?></strong> <br><strong><?php echo esc_html__('Address: ','pikoworks_core'); ?> </strong>' +
                place.formatted_address + '<br><strong><?php echo esc_html__('Phone: ','pikoworks_core'); ?> </strong><?php echo esc_attr($phone); ?></div>');
              infowindow.open(map, this);
            });
          }
        });
      }
    </script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($api_key); ?>&callback=initMap">
    </script>
        <?php        
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }    
    
}
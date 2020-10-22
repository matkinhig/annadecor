<?php
/**
 * @social twitter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_twitter_feed' );
function pikoworks_twitter_feed(){
// Setting shortcode lastest
vc_map( array(
    "name"        => esc_html__( "Twitter Feed", 'pikoworks_core'),
    "base"        => "pikoworks_twitter_feed",
    "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
    "description" => esc_html__( "Twitter Feed widget", 'pikoworks_core'),
    "params"      => array(        
        array(
            'type' => 'textfield',
            'param_name' => 'title',
            'heading' => esc_html__('Title', 'pikoworks_core'),
            'value' => esc_html('LATEST TWEETS', 'pikoworks_core'),
            'group' => esc_html__( 'Twitter', 'pikoworks_core' ),
            "admin_label" => true,  
        ),    
        array(
            'type' => 'pikoworks_number',
            'param_name' => 'num',
            'heading' => esc_html__('Number of tweets', 'pikoworks_core'),
            'value'       => '3',
            "admin_label" => true,  
            'group' => esc_html__( 'Twitter', 'pikoworks_core' ),
        ),        
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Extra class name", 'pikoworks_core' ),
            "param_name"  => "el_class",
            "admin_label" => true,
            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks_core" ),
        ),
         array(
            'type'           => 'css_editor',
            'heading'        => esc_html__( 'Css', 'pikoworks_core' ),
            'param_name'     => 'css',
            'group'          => esc_html__( 'Design options', 'pikoworks_core' )
	)
    )
));

}
class WPBakeryShortCode_pikoworks_twitter_feed extends WPBakeryShortCode { 
    
    protected function content($atts, $content = null) {
        $args = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'pikoworks_twitter_feed', $atts ) : $atts;
        $args = shortcode_atts( array( 
            'num' => '3',
            'title' => esc_html('LATEST TWEETS', 'pikoworks_core'),
            'el_class'     =>  '',
            'css'           => '',            
            
        ), $atts );
        extract($args);
        
        $css_class = 'twiiter-feed ' . $el_class;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $args );
        endif; 
        ob_start();  ?>
        <div class="<?php echo esc_attr( $css_class ) ?>">               
            <?php the_widget( 'Latest_Tweets_Widget', $args ); ?>           
        </div>

        <?php
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }   
    
}
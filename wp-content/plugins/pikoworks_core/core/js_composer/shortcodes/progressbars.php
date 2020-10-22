<?php
/**
 * @progress bar
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_progressbars' );
function pikoworks_progressbars(){

vc_map( array(
    "name"                    => esc_html__( "Progressbars", 'pikoworks-core'),
    "base"                    => "pikoworks_progressbars",
    "category"                => esc_html__('Pikoworks', 'pikoworks-core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
    "description"             => esc_html__( "Show tabs categories", 'pikoworks-core'),
    "as_parent"               => array('only' => 'progress_section'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element"         => true,
    "show_settings_on_create" => true,
    "params"                  => array(
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Heading Title", 'pikoworks_core' ),
            "param_name"  => "heading_title",
            "admin_label" => true,                
        ),
        array(
            'type'        => 'css_editor',
            'heading'     => esc_html__( 'Css', 'pikoworks-core' ),
            'param_name'  => 'css',
            'group'       => esc_html__( 'Design options', 'pikoworks-core' ),
            'admin_label' => false,
	),
        
    ),
    "js_view" => 'VcColumnView'
));
vc_map( array(
    "name"            => esc_html__("Progress Tab", 'pikoworks-core'),
    "base"            => "progress_section",
    "content_element" => true,
    "as_child"        => array('only' => 'pikoworks_progressbars'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params"          => array(
        // add params same as with any other content element
        array(
            "type"        => "dropdown",
            "heading"     => esc_html__("Progress Layout", 'pikoworks-core'),
            "param_name"  => "layout",
            "admin_label" => true,
            'value'       => array(
        	esc_html__( 'layout 1', 'pikoworks-core' ) => '1',
                esc_html__( 'layout 2', 'pikoworks-core' ) => '2',
        	),
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Skill Title", 'pikoworks-core' ),
            "param_name"  => "heading",
            "value" => esc_html__('Skill Name','pikoworks_core'),
            "admin_label" => true,
        ),
        array(
            "type"        => "pikoworks_number",
            "heading"     => esc_html__("Value that progress", 'pikoworks_core'),
            "param_name"  => "number",
            "value"       => 80,
            'admin_label' => true
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Extra class name", "pikoworks_core" ),
            "param_name"  => "el_class",
            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks_core" ),
            'admin_label' => false,
        ),
    )    
) );

}
class WPBakeryShortCode_pikoworks_progressbars extends WPBakeryShortCodesContainer {
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'pikoworks_progressbars', $atts ) : $atts;
        extract( shortcode_atts( array(
            'heading_title'       => '',
            'el_class'       => '',
            'css'           => '',
        ), $atts ) );
        
        $css_class = 'prograss-layout ' . $el_class;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;
        
        $tabs = xtocky_get_all_attributes( 'progress_section', $content );
        if($heading_title != ''){
            $heading_title = '<h2>'.esc_attr($heading_title).'</h2>';
        }
        
        if( count( $tabs ) > 0 ):                         
            ob_start();?> 
            <div class="<?php echo esc_attr($css_class); ?>">
                <?php echo balanceTags($heading_title); ?>
                <?php pikoworks_progressbars_generate($tabs); ?>
            </div>
            <?php 
            return ob_get_clean();
            
        endif;
    }
}

function pikoworks_progressbars_generate( $tabs = array() ){
    foreach( $tabs as $i => $tab ): $class = "tab-nav"; ?>
        <?php
            extract( shortcode_atts( array(
                'heading' => esc_html__('Skill Name','pikoworks_core'),
                'layout'       => '1',              
                'number'       => '80',              
            ), $tab ) );
            
        ?>
         <div class="progress-container sc-pl-<?php echo esc_attr($layout); ?>">
            <h4 class="progress-title"><?php echo esc_attr($heading); ?></h4>
            <div class="progress">
                <div class="progress-bar progress-animate" role="progressbar" data-width="<?php echo esc_attr($number); ?>" aria-valuenow="<?php echo esc_attr($number); ?>" aria-valuemin="0" aria-valuemax="100">
                    <span class="progress-val"><?php echo esc_attr($number); ?>%</span>
                </div>
            </div>
        </div>       
    <?php
    endforeach;
}
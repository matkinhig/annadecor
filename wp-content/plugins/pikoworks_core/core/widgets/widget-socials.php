<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    exit;
} 

/**
 * widgets social icon
 */
 
class pikoworks_widgets_socials extends WP_Widget {     
  
    
    function __construct() {
		parent::__construct( 'piko-socials-icon', esc_html__('[Pikoworks] Socials icon', 'pikoworks_core'), // Name
			array( 'description' => esc_html__( 'Social link load from theme option', 'pikoworks_core' ),  ) // Args
		);
	}
    
    
    public function widget( $args, $instance ) {
        global $post, $xtocky;
        
        $title = apply_filters( 'widget_title', $instance['title'] ); 
        
        
        // before and after widget defined by themes file 
        echo $args['before_widget'];   
        
        if ( trim( $title ) != '' ) {
            if ( isset( $args['before_title']) ){
                echo $args['before_title'];
                echo $title;
                echo $args['after_title'];
            }    
        }
        
        if ( trim( $xtocky['twitter'] . $xtocky['facebook'] . $xtocky['googleplus'] . $xtocky['dribbble'] . 
            $xtocky['behance'] . $xtocky['tumblr'] . $xtocky['instagram'] . $xtocky['pinterest'] .  $xtocky['soundcloud'] .
            $xtocky['youtube'] . $xtocky['vimeo'] . $xtocky['linkedin'] . $xtocky['flickr'] ) != '' ) {
                echo '<div class="widgets-icon">';
                get_template_part( 'template-parts/social', 'items' );
                echo '</div><!-- /.social-wrap -->';
        }        
        echo $args['after_widget']; 
    }
    
    public function form( $instance ) {
        if ( isset( $instance['title'] )) { 
            $title = $instance['title'];  
        }
        else { 
            $title = esc_html__('Socials', 'pikoworks_core'); 
        }        
        // Widget admin form
        ?> 
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'pikoworks_core' ); ?>: </label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"  />
        </p>
        
        <?php 
    }
    
    public function update( $new_instance, $old_instance ) {
        $instance = array(); 
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }    
}

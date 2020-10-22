<?php
/**
 * Recent post widget.
 */
class pikoworks_widget_postimage extends WP_Widget {       
       /**
	 * Register recent post with image widgets.
	 */
       function __construct() {
		parent::__construct( 'recent_postimage', esc_html__('[Pikoworks] Recent Posts with image', 'pikoworks_core'), // Name
			array( 'description' => esc_html__( 'Display latest posts with images', 'pikoworks_core' ), ) // Args
		);
	}

           function widget($args, $instance) {
                   extract($args);
                   $title = apply_filters('widget_title', $instance['title']);
                   $show = $instance['show'];
                   global $post, $wpdb;
                   $pop = new WP_Query();
                   $pop->query('showposts='.$show.'');
                   echo $before_widget;
//                   echo $before_title;
//                   echo $title;
//                   echo $after_title;                   
                   if(!empty($title)) { echo $before_title . $title . $after_title; };
                  
                   while  ($pop->have_posts()) : $pop->the_post(); ?> 
                        <div class="media">
                            <div class="media-left">                           
                               <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">   
                                     <?php if( has_post_thumbnail()){
                                             the_post_thumbnail(array(64, 64));
                                        }elseif( has_post_format( 'video' ) ){ 
                                            echo '<i class="widgets-post-icon fa fa-4x fa-video-camera" aria-hidden="true"></i>';
                                        }elseif(has_post_format( 'gallery' )){
                                            echo '<i class="widgets-post-icon fa fa-4x fa-picture-o" aria-hidden="true"></i>';
                                        }elseif (has_post_format( 'audio' )) {
                                            echo ' <i class="widgets-post-icon fa fa-4x fa-volume-up" aria-hidden="true"></i>';       
                                        }elseif (has_post_format( 'quote' )) {
                                            echo '<i class="widgets-post-icon fa fa-4x fa-quote-left" aria-hidden="true"></i>';       
                                        }elseif (has_post_format( 'link' )) {
                                             echo '<i class="widgets-post-icon fa fa-4x fa-quote-left" aria-hidden="true"></i>';       
                                        }elseif (has_post_format( 'chat' )) {
                                                echo '<i class="widgets-post-icon fa fa-4x fa-comments-o" aria-hidden="true"></i>';  
                                        }  else {
                                            echo '<i class="widgets-post-icon fa fa-4x fa-info-circle" aria-hidden="true"></i> ';   
                                        } 
                                        ?>
                                </a>    
                            </div>
                            <div class="media-body">
                                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" ><?php the_title(); ?></a><br>
                                <i><?php echo get_the_date(); ?></i>
                            </div>
                        </div>
                           
                       <?php endwhile;
                   
                   echo $after_widget;

                   wp_reset_postdata();
            }
        
       function update( $new_instance, $old_instance ) {
               $instance = $old_instance;

               /* Strip tags (if needed) and update the widget settings. */
               $instance['title'] = strip_tags( $new_instance['title'] );
               $instance['show'] = strip_tags( $new_instance['show'] );

               return $instance;
       }
       function form($instance) {
               $defaults = array( 'title' => 'Latest Posts', 'show' => '3' );
               $instance = wp_parse_args( (array) $instance, $defaults ); ?>

               <p>
                       <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html__('Widget Title:', 'pikoworks_core') ?></label>
                       <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
               </p>

               <p>
                       <label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php esc_html__('Number of Posts:', 'pikoworks_core') ?></label>
                       <input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>" value="<?php echo $instance['show']; ?>" style="width:100%;" />
               </p>
   <?php
       }
}
<?php
/*---------------POST FORMATE--------------- */
if (!function_exists('xtocky_post_format')) {
    function xtocky_post_format($size = '') {
        $html = '';
        $prefix = 'xtocky_';
        $width = '';
        $height = '';
        global $xtocky_image_size;
        if (isset($xtocky_image_size[$size])) {
            $width = $xtocky_image_size[$size]['width'];
            $height = $xtocky_image_size[$size]['height'];
        }
        switch(get_post_format()) {
            case 'image' :
                $args = array(
                    'size' => $size,
                    'meta_key' => $prefix.'post_format_image'
                );
                $image = xtocky_get_image($args);
                if (!$image) break;
                $html = xtocky_get_image_warp($image,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID());
                break;
            case 'gallery':
                $images = get_post_meta(get_the_ID(), $prefix.'post_format_gallery');
                if (count($images) > 0) {                   
                    $html = '<div class="piko-carousel sh" data-slick="{"slidesToScroll": 1,}">';                    
                    foreach ($images as $image) {

                        if (empty($width) || empty($height)) {
                            $image_src_arr = wp_get_attachment_image_src( $image, $size );
                            if ($image_src_arr) {
                                $image_src = $image_src_arr[0];
                            }
                        } else {
                            $image_src = matthewruddy_image_resize_id($image,$width,$height);
                        }

                        if (!empty($image_src)) {
                            $html .= xtocky_get_image_warp($image_src,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID(),1);
                        }
                    }
                    $html .= '</div>';
                } else {
                    $args = array(
                        'size' => $size,
                        'meta_key' => ''
                    );
                    $image = xtocky_get_image($args);
                    if (!$image) break;
                    $html = xtocky_get_image_warp($image,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID());
                }
                break;
            case 'video':
                $video = get_post_meta(get_the_ID(), $prefix.'post_format_video');
                if (!is_single()) {
                    $args = array(
                        'size' => $size,
                        'meta_key' => ''
                    );
                    $image = xtocky_get_image($args);
                    if (!$image) {
                        if (count($video) > 0) {                            
                            $video = $video[0];
                            // If URL: show oEmbed HTML
                            if (filter_var($video, FILTER_VALIDATE_URL)) {
                                $args = array(
                                    'wmode' => 'transparent'
                                );
                                $embaded = wp_oembed_get($video, $args);
                                echo '<div class="embed-responsive embed-responsive-16by9">' . $embaded . '</div>'; 
                            }
                            
                        }
                    } else {                        
                        if(count($video) > 0){
                               $video = $video[0];
                        }else{
                                $video = '';
                        }
                        if (filter_var($video, FILTER_VALIDATE_URL)) {
                            $html .= xtocky_get_video_warp($image, get_permalink(), the_title_attribute('echo=0'), $video);
                        }
                    }
                } else {
                    if (count($video) > 0) {
                        
                        $video = $video[0];
                        // If URL: show oEmbed HTML
                        if (filter_var($video, FILTER_VALIDATE_URL)) {
                            $args = array(
                                'wmode' => 'transparent'
                            );
                            $embaded = wp_oembed_get($video, $args);
                            echo '<div class="embed-responsive embed-responsive-16by9">' . $embaded . '</div>'; 
                        } // If embed code: just display
                        
                    }
                }
                break;
            case 'audio':
                $audio = get_post_meta(get_the_ID(), $prefix.'post_format_audio');
                if (count($audio) > 0) {
                    $audio = $audio[0];
                    if (filter_var($audio, FILTER_VALIDATE_URL)) {                        
                        $embaded =  wp_oembed_get($audio);
                        echo '<div class="embed-responsive embed-responsive-16by9">' . $embaded . '</div>'; 
                    }
                    $html .= '<div style="clear:both;"></div>';
                }
                break;
            default:
                $args = array(
                    'size' => $size,
                    'meta_key' => ''
                );
                $image = xtocky_get_image($args);
                if (!$image) break;
                $html = xtocky_get_image_warp($image,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID());
                break;
        }
        return $html;
    }
}
/*------------------------GET POST IMAGE-------------------- */
if (!function_exists('xtocky_get_image')) {
    function xtocky_get_image($args) {
        $default = apply_filters(
            'xtocky_get_image_default_args',
            array(
                'post_id'  => get_the_ID(),
                'size'    => '',
                'width'    => '',
                'height'   => '',
                'attr'     => '',
                'meta_key' => '',
                'scan'     => false,
                'default'  => ''
            )
        );
        $args = wp_parse_args( $args, $default );
        $size = $args['size'];

        $width = '';
        $height = '';

        global $xtocky_image_size;
        if (isset($xtocky_image_size[$size])) {
            $width = $xtocky_image_size[$size]['width'];
            $height = $xtocky_image_size[$size]['height'];
        }
        if ( ! $args['post_id'] ) {
            $args['post_id'] = get_the_ID();
        }
        // Get image from cache
        $key         = md5( serialize( $args ) );
        $image_cache = wp_cache_get( $args['post_id'], 'xtocky_get_image' );

        if ( ! is_array( $image_cache ) ) {
            $image_cache = array();
        }

        if ( empty( $image_cache[$key] ) ) {

            $image_src = '';

            // Get post thumbnail
            if (has_post_thumbnail($args['post_id'])) {
                $post_thumbnail_id   = get_post_thumbnail_id($args['post_id']);

                if (empty($width) || empty($height)) {
                    $image_src_arr = wp_get_attachment_image_src( $post_thumbnail_id, $size );
                    if ($image_src_arr) {
                        $image_src = $image_src_arr[0];
                    }
                } else {
                    $image_src = matthewruddy_image_resize_id($post_thumbnail_id,$width,$height);
                }
            }

            // Get the first image in the custom field
            if ((!isset($image_src) || empty($image_src))  && $args['meta_key']) {
                $post_thumbnail_id = get_post_meta( $args['post_id'], $args['meta_key'], true );
                if ( $post_thumbnail_id ) {

                    if (empty($width) || empty($height)) {
                        $image_src_arr = wp_get_attachment_image_src( $post_thumbnail_id, $size );
                        if ($image_src_arr) {
                            $image_src = $image_src_arr[0];
                        }
                    } else {
                        $image_src = matthewruddy_image_resize_id($post_thumbnail_id,$width,$height);
                    }
                }
            }

            // Get the first image in the post content
            if ((!isset($image_src) || empty($image_src)) && ($args['scan'])) {
                preg_match( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field( 'post_content', $args['post_id'] ), $matches );
                if ( ! empty( $matches ) ){
                    $image_src  = $matches[1];
                }
            }

            // Use default when nothing found
            if ( (!isset($image_src) || empty($image_src)) && ! empty( $args['default'] ) ){
                if ( is_array( $args['default'] ) ){
                    $image_src  = $args['src'];
                } else {
                    $image_src = $args['default'];
                }
            }

            if (!isset($image_src) || empty($image_src)) {
                return false;
            }
            $image_cache[$key] = $image_src;
            wp_cache_set( $args['post_id'], $image_cache, 'xtocky_get_image' );
        } else {
            $image_src = $image_cache[$key];
        }
        $image_src = apply_filters( 'xtocky_get_image', $image_src, $args );
        return $image_src;
    }
}

if (!function_exists('xtocky_get_video_warp')) {
    function xtocky_get_video_warp($image, $url, $title, $video_url) {
        return sprintf('<div class="entry-thumbnail video-gallery pr">
                        <a class="entry-thumbnail_overlay video" href="%4$s" title="%2$s">
                            <img class="img-responsive" src="%3$s" alt="%2$s"/>
                            <i class="video-btn fa fa-play"></i>
                        </a>                       
                      </div>',
            $url,
            $title,
            $image,
            $video_url
        );
    }
}
/*--------------------GET IMAGE WARP------------------------- */
if (!function_exists('xtocky_get_image_warp')) {
    function xtocky_get_image_warp($image,$size, $url, $title, $post_id,$gallery = 0) {
        $attachment_id = xtocky_get_attachment_id_from_url($image);
        
        $image_full_arr = wp_get_attachment_image_src($attachment_id,'full');

        $image_full = $image;

        if (isset($image_full_arr)) {
            $image_full = $image_full_arr[0];
        }

	    $width = '';
	    $height = '';

	    global $xtocky_image_size;
	    if (isset($xtocky_image_size[$size])) {
		    $width = $xtocky_image_size[$size]['width'];
		    $height = $xtocky_image_size[$size]['height'];
	    } else {
		    global $_wp_additional_image_sizes;
		    if ( in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
			    $width = get_option( $size . '_size_w' );
			    $height = get_option( $size . '_size_h' );

		    } elseif ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
			    $width = $_wp_additional_image_sizes[ $size ]['width'];
			    $height = $_wp_additional_image_sizes[ $size ]['height'];
		    }
	    }

        $prettyPhoto = 'single';
        if ($gallery == 1) {
            $prettyPhoto= 'gallary';
        }

	    if (empty($width) || empty($height)) {
		    return sprintf('<div class="entry-thumbnail">
                        <a href="%1$s" title="%2$s" class="entry-thumbnail_overlay">
                            <img class="img-responsive" src="%3$s" alt="%2$s"/>
                        </a>                        
                      </div>',
			    $url,
			    $title,
			    $image,
			    $image_full,
			    $prettyPhoto
		    );
	    } else {               
                
		    return sprintf('<div class="entry-thumbnail">
                        <a href="%1$s" title="%2$s" class="entry-thumbnail_overlay">
                            <img width="%6$s" height="%7$s" class="img-responsive" src="%3$s" alt="%2$s"/>
                        </a>                        
                      </div>',
			    $url,
			    $title,
			    $image,
			    $image_full,
			    $prettyPhoto,
			    $width,
			    $height
		    );
	    }
        }
    }
/*--------------------GET ATTACHMENT ID FROM URL---------------------- */
if (!function_exists('xtocky_get_attachment_id_from_url')) {
    function xtocky_get_attachment_id_from_url($attachment_url = '') {
        global $wpdb;
        $attachment_id = false;
        // If there is no url, return.
        if ( '' == $attachment_url )
            return;
        // Get the upload directory paths
        $upload_dir_paths = wp_upload_dir();
        // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
        if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
            // If this is the URL of an auto-generated thumbnail, get the URL of the original image
            $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
            // Remove the upload path base directory from the attachment URL
            $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
            // Finally, run a custom database query to get the attachment ID from the modified attachment URL
            $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

        }
        return $attachment_id;
    }
}
/*--------------IMAGE ARCHIVE LOOP RESET---------------*/
if (!function_exists('xtocky_archive_loop_reset')) {
    function xtocky_archive_loop_reset()
    {
        global $xtocky_archive_loop;
        $xtocky_archive_loop['image-size'] = '';
        $xtocky_archive_loop['style'] = '';
    }
}





function xtocky_comment_callback($comment, $args, $depth) {
    if ( 'article' === $args['style'] ) {
        $tag       = 'article';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo do_shortcode($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? ' media' : 'parent media' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <article id="div-comment-<?php comment_ID() ?>" class="comment-body comment">
    <?php endif; ?>
    <div class="comment-author vcard media-left">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 140 ); ?>        
    </div>
    <div class="media-body">
        <div class="media-body-wrapper">
            <h4 class="media-heading"><?php printf( esc_html__( '%s', 'xtocky' ), get_comment_author_link() ); ?></h4>
            <div class="reply btn reply-btn">
                <?php comment_reply_link( array_merge( $args, array( 'before' => '<i class="icon-backward-arrow" aria-hidden="true"></i> ', 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                 <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'xtocky' ); ?></em>
                  <br />
            <?php endif; ?>
            <?php comment_text(); ?>
            <div class="comment-meta commentmetadata comment-date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                <?php
                /* translators: 1: date, 2: time */
                printf( esc_html__('%1$s at %2$s', 'xtocky'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( esc_html__( '(Edit)', 'xtocky' ), '  ', '' );
                ?>
            </div>            
          </div><!-- End .media-body-wrapper -->
    </div><!-- End .media-body -->
    <?php if ( 'article' != $args['style'] ) : ?>
    </article>
    <?php endif; ?>
    <?php
    }
    
function xtocky_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'xtocky_move_comment_field_to_bottom' );
    
    function xtocky_comment_form_callback() {     
        $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        
        
        $fields =  array(
              'author' =>
                '<div class="col-sm-6"><div class="form-group label-overlay">
                    <input type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' required>
                    <label class="input-desc"><span class="icon-user"></span>Enter your username ' .
                ( $req ? '<span class="input-required">*</span>' : '' ) .'</label>
                </div>',

              'email' =>
                '<div class="form-group label-overlay">
                    <input id="email" name="email" type="text" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" ' . $aria_req . ' required>
                    <label class="input-desc"><span class="icon-envalop2"></span>Enter your e-mail ' .
                    ( $req ? '<span class="input-required">*</span>' : '' ) .' </label>
                </div>',

              'url' =>
                '<div class="form-group label-overlay">
                    <input  id="url" name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) .'">
                    <label class="input-desc"><span class="icon-globe"></span>Enter web page/blog</label>
                </div>',
            
              'info' =>
                '<p class="comment-notes text-muted">' .
                esc_html__( 'Your email address will not be published. Required fields are marked *', 'xtocky' ) .
                '</p></div>',
            );
        
        
        
        $comments_args = array(
              'id_form'           => 'commentform',
              'class_form'      => 'comment-form clearfix',
              'id_submit'         => 'submit',
              'class_submit'      => 'submit',
              'name_submit'       => 'submit',
              'title_reply'       => esc_html__( 'Write Your Review', 'xtocky' ),
              'title_reply_to'    => esc_html__( 'Write Your Review to %s', 'xtocky'),
              'cancel_reply_link' => esc_html__( 'Cancel Reply', 'xtocky' ),
              'label_submit'      => esc_html__( 'Post Comment', 'xtocky' ),
              'format'            => 'xhtml',
              'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title col-xs-12">',
			  'title_reply_after'  => '</h3>',
            
            
            'comment_field' =>  '<div class="col-sm-6"> <div class="form-group textarea-group mb30 label-overlay">
                                    <textarea id="comment" name="comment" cols="20" rows="5" class="form-control min-height" aria-required="true" required></textarea>
                                    <label class="input-desc"><span class="icon-pencil"></span>' . esc_html__('Write your comment', 'xtocky') . '<span class="input-required">*</span></label>
                                </div>
                                <p class="form-submit custom"><input name="submit" class="submit  btn-custom" value="'. esc_html__('Post Comment', 'xtocky').'" type="submit"></p></div>',

              'must_log_in' => '<p class="must-log-in">' .
                sprintf(__( 'You must be <a href="%s">logged in</a> to post a comment.', 'xtocky' ),
                  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
                ) . '</p>',

              'logged_in_as' => '<p class="logged-in-as">' .
                sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'xtocky' ),
                  admin_url( 'profile.php' ),
                  esc_attr( $commenter['comment_author'] ),
                  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
                ) . '</p>',

              'comment_notes_before' => '',            
            
            'fields' =>  apply_filters( 'comment_form_default_fields', $fields ),
              
            );
        
        echo'<div class="row">';
        comment_form($comments_args);
        echo'</div>';
        
    }
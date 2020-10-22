<?php

/**
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 */
//search form
if (!function_exists('xtocky_search_form')) {
    function xtocky_search_form($form)
    {
        $key = get_search_query();
        $form = '<form class="search-form" method="get"  action="' . esc_url(home_url('/')) . '">
                <input type="search" name="s" placeholder="' . esc_html__('Search here...', 'xtocky') . '" value="' . esc_attr($key) . '" class="search-field">
                <button type="submit" class="search-submit"><i class="icon-arrow-long-right"></i></button>
            </form>';

        return $form;
    }
    add_filter('get_search_form', 'xtocky_search_form');
}


if (!function_exists('xtocky_entry_meta')) :
    /**
     * Prints HTML with meta information for the categories, tags.
     *
     * Create your own marn_entry_meta() function to override in a child theme.
     *
     */
    function xtocky_entry_meta()
    {

        $format = get_post_format();
        if (current_theme_supports('post-formats', $format)) {
            printf(
                '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
                sprintf('<span class="screen-reader-text">%s </span>', _x('Format', 'Used before post format.', 'xtocky')),
                esc_url(get_post_format_link($format)),
                get_post_format_string($format)
            );
        }
        if (is_sticky() && is_home() && !is_paged()) {
            printf('<span class="sticky-post">%s</span>', esc_html__('Featured', 'xtocky'));
        }
        if ('post' === get_post_type()) {
            xtocky_entry_taxonomies();
        }

        if (!is_singular() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(sprintf(esc_html__('Leave a comment<span class="screen-reader-text"> on %s</span>', 'xtocky'), get_the_title()));
            echo '</span>';
        }
    }
endif;


if (!function_exists('xtocky_blog_meta')) {
    /* *
     * blog meta
     * */
    function xtocky_blog_meta()
    {
        ?>
        <ul class="title-blog-meta">
            <li><?php if (!is_single()) {
                    echo get_the_date('Y');
                } else {
                    echo xtocky_entry_date();
                }  ?></li>
            <li><?php esc_html_e('By: ', 'xtocky'); ?><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></li>

            <?php
            if ('post' === get_post_type()) {

                $categories_list = get_the_category_list(esc_html__(', ', 'xtocky'));
                if ($categories_list && xtocky_categorized_blog()) {
                    printf('<li>' . esc_html__('Posted in: %1$s', 'xtocky') . '</li>', $categories_list);
                }
            }

            if (!is_singular() && !post_password_required() && (comments_open() || get_comments_number())) {
                echo '<li>';
                echo comments_popup_link(esc_html__('To Write First', 'xtocky'), esc_html__('1 Comment', 'xtocky'), esc_html__('% Comments', 'xtocky'));
                echo '</li>';
            } ?>
        </ul>
    <?php
    }
}
//blog meta grid
if (!function_exists('xtocky_grid_blog_meta')) {
    function xtocky_grid_blog_meta()
    {
        ?>
        <div class="blog-title">
            <ul class="title-blog-meta">
                <?php if (is_sticky() && is_home() && !is_paged()) {
                    printf('<li><i class="fa fa-star"></i>%s</li>', esc_html__('Featured', 'xtocky'));
                } ?>
                <li><?php esc_html_e('by', 'xtocky'); ?> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></li>
                <li><?php esc_html_e('on ', 'xtocky'); ?><?php echo xtocky_entry_date(); ?></li>
            </ul>
        </div>
    <?php
    }
}

if (!function_exists('xtocky_blog_shortcode_meta')) {
    function xtocky_blog_shortcode_meta()
    {
        ?>
        <div class="blog-date">
            <p>
                <span><?php echo get_the_date('M'); ?></span>
                <span><?php echo get_the_date('y'); ?></span>
            </p>
        </div>
    <?php
    }
}


if (!function_exists('xtocky_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags.
     *
     * Create your own xtocky_entry_meta() function to override in a child theme.
     *
     */
    function xtocky_entry_footer()
    {
        global $xtocky;
        $social_shear = isset($xtocky['blog_single_social_share']) ? trim($xtocky['blog_single_social_share']) : true;

        $format = get_post_format() ? get_post_format() : esc_html__('Standard', 'xtocky');
        $format_link = get_post_format_link($format);
        if (function_exists('xtocky_setPostViews')) {
            xtocky_setPostViews(get_the_ID());
        }
        $categories_list = get_the_category_list(esc_html__(', ', 'xtocky'));
        $metaTag = xtocky_get_option_data('optn_blog_post_metatag_single', array(''));
        ?>
        <div class="entry-meta-container">
            <span class="entry-meta">
                <i class="icon-user"></i>
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
            </span>
            <span class="entry-meta">
                <i class="icon-chat"></i>
                <?php echo comments_popup_link(esc_html__('0 Comment', 'xtocky'), esc_html__('1 Comment', 'xtocky'), esc_html__('% Comments', 'xtocky')); ?>
            </span>
            <?php if (!empty($metaTag)) : ?>
                <?php if (in_array('format', $metaTag)) : ?>
                    <span class="entry-meta">
                        <i class="fa fa-bookmark" aria-hidden="true"></i>
                        <a href="<?php echo esc_url($format_link); ?>"><?php echo esc_html($format); ?></a>
                    </span>
                <?php endif; ?>
                <?php if (is_single() && function_exists('xtocky_post_love_display') && in_array('love', $metaTag)) : ?>
                    <span class="entry-meta">
                        <?php xtocky_post_love_display(); ?>
                    </span>
                <?php endif; ?>
                <?php if (function_exists('xtocky_getPostViews') && in_array('view', $metaTag)) : ?>
                    <span class="entry-meta">
                        <i class="icon-eye"></i>
                        <span><?php echo xtocky_getPostViews(get_the_ID()); ?></span>
                    </span>
                <?php endif; ?>
            <?php endif; ?>
            <br>
            <?php

            if ($categories_list) {
                printf('<span class="entry-meta entry-tags"><i class="fa fa-tags"></i>' . esc_html__('%1$s ', 'xtocky') . '</span>', $categories_list);
            }

            ?>
        </div><!-- End .entry-meta-container -->
        <?php if ($social_shear == 1 && is_singular()) {
            xtocky_post_share();
        }
    }
endif; //end entry footer

function xtocky_post_share()
{
    global $xtocky;
    $social_share = isset($xtocky['blog_single_social_share_page']) ? $xtocky['blog_single_social_share_page'] : array();
    if (!empty($social_share)) : ?>
        <ul class="social-icons">
            <?php if (in_array('facebook', $social_share)) : ?>
                <li class="social-icon fa fa-facebook">
                    <a class="shear-icon-wrap" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">
                        <span class="text"><?php echo sprintf(esc_html__('Share "%s" on Facebook', 'xtocky'), get_the_title()); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('twitter', $social_share)) : ?>
                <li class="social-icon fa fa-twitter">
                    <a class="shear-icon-wrap" href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank">
                        <span class="text"><?php echo sprintf(esc_html__('Post status "%s" on Twitter', 'xtocky'), get_the_title()); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('gplus', $social_share)) : ?>
                <li class="social-icon fa fa-google-plus">
                    <a class="shear-icon-wrap" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank">
                        <span class="text"><?php echo sprintf(esc_html__('Share "%s" on Google Plus', 'xtocky'), get_the_title()); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('pinterest', $social_share)) : ?>
                <li class="social-icon fa fa-pinterest">
                    <a class="shear-icon-wrap" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;description=<?php echo urlencode(get_the_excerpt()); ?>" target="_blank">
                        <span class="text"><?php echo sprintf(esc_html__('Pin "%s" on Pinterest', 'xtocky'), get_the_title()); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('linkedin', $social_share)) : ?>
                <li class="social-icon fa fa-linkedin">
                    <a class="shear-icon-wrap" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>&amp;summary=<?php echo urlencode(get_the_excerpt()); ?>&amp;source=<?php echo urlencode(get_bloginfo('name')); ?>" target="_blank">
                        <span class="text"><?php echo sprintf(esc_html__('Share "%s" on LinkedIn', 'xtocky'), get_the_title()); ?></span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    <?php endif; // End if ( !empty( $socials_shared ) )     
}


if (!function_exists('xtocky_entry_masonry_footer')) :
    function xtocky_entry_masonry_footer()
    {
        $format = get_post_format() ? get_post_format() : esc_html__('Standard', 'xtocky');
        $format_link = get_post_format_link($format);
        if (function_exists('xtocky_setPostViews')) {
            xtocky_setPostViews(get_the_ID());
        }
        $categories_list = get_the_category_list(esc_html__(', ', 'xtocky'));
        $tags_list = get_the_tag_list('', esc_html__(' ', 'xtocky'));
        $archive_layout_style = isset($GLOBALS['xtocky']['optn_archive_display_type']) ? trim($GLOBALS['xtocky']['optn_archive_display_type']) : 'default';
        $metaTag = xtocky_get_option_data('optn_blog_post_metatag_single', array(''));

        ?>
        <div class="entry-meta-container">
            <?php if ($archive_layout_style == 'default') : ?>
                <span class="entry-meta">
                    <i class="icon-user"></i>
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                </span>
            <?php endif; ?>
            <span class="entry-meta">
                <i class="icon-chat"></i>
                <?php echo comments_popup_link(esc_html__('0 Comment', 'xtocky'), esc_html__('1 Comment', 'xtocky'), esc_html__('% Comments', 'xtocky')); ?>
            </span>
            <?php if (!empty($metaTag)) : ?>
                <?php if (in_array('format', $metaTag)) : ?>
                    <span class="entry-meta">
                        <i class="fa fa-bookmark" aria-hidden="true"></i>
                        <a href="<?php echo esc_url($format_link); ?>"><?php echo esc_html($format); ?></a>
                    </span>
                <?php endif; ?>
                <?php if (is_single() && in_array('love', $metaTag) && function_exists('xtocky_post_love_display')) : ?>
                    <span class="entry-meta">
                        <?php xtocky_post_love_display(); ?>
                    </span>
                <?php endif; ?>
                <?php if (function_exists('xtocky_getPostViews') && in_array('view', $metaTag)) : ?>
                    <span class="entry-meta">
                        <i class="icon-eye"></i>
                        <span><?php echo xtocky_getPostViews(get_the_ID()); ?></span>
                    </span>
                <?php endif; ?>
            <?php endif; ?>

            <br>
            <?php

            if ($categories_list && $archive_layout_style == 'default') {
                printf('<span class="entry-meta entry-tags"><i class="fa fa-tags" aria-hidden="true"></i>' . esc_html__('%1$s ', 'xtocky') . '</span>', $categories_list);
            }

            if ($tags_list && $archive_layout_style == 'default') {
                printf('<span class="entry-meta entry-tags"><i class="fa fa-paw" aria-hidden="true"></i>' . esc_html__('%1$s ', 'xtocky') . '</span>', $tags_list);
            }

            ?>

        </div><!-- End .entry-meta-container -->
    <?php
    }
endif; //end entry footer





if (!function_exists('xtocky_entry_date')) :
    /**
     * Prints HTML with date information for current post.
     *
     * Create your own xtocky_entry_date() function to override in a child theme.
     *
     */
    function xtocky_entry_date()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" style="display:none" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date('c')),
            get_the_date(),
            esc_attr(get_the_modified_date('c')),
            get_the_modified_date()
        );

        printf(
            '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
            esc_html(_x('Posted on', 'Used before publish date.', 'xtocky')),
            esc_url(get_permalink()),
            $time_string
        );
    }
endif;

if (!function_exists('xtocky_entry_taxonomies')) :
    /**
     * Prints HTML with category and tags for current post.
     *
     * Create your own xtocky_entry_taxonomies() function to override in a child theme.
     *
     */
    function xtocky_entry_taxonomies()
    {
        $categories_list = get_the_category_list(esc_html__(', ', 'xtocky'));
        if ($categories_list && xtocky_categorized_blog()) {
            printf('<div class="cat-links">' . esc_html__('Posted in %1$s', 'xtocky') . '</div> <br />', $categories_list);
        }
        $tags_list = get_the_tag_list('', esc_html__(' ', 'xtocky'));
        if ($tags_list) {
            printf('<div class="tags-links">' . esc_html__('%1$s', 'xtocky') . '</div>',    $tags_list);
        }
    }
endif;


if (!function_exists('xtocky_entry_header')) :
    /**
     * entry header blog list.
     */
    function xtocky_entry_header()
    { ?>
        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');  ?>
        <?php if ('post' === get_post_type()) : ?>
            <span class="entry-date"><?php echo get_the_date('F j, Y'); ?></span>
            <?php
            if (is_sticky() && is_home() && !is_paged()) {
                printf('<span class="entry-date sticky-post">%s</span>', esc_html__('Featured', 'xtocky'));
            }
            if (has_post_format('quote')) {
                printf('<span class="entry-date sticky-post">%s</span>', esc_html__('Quote', 'xtocky'));
            }
            if (has_post_format('link')) {
                printf('<span class="entry-date sticky-post">%s</span>', esc_html__('Link', 'xtocky'));
            }
            ?>
        <?php endif;
    }
endif; //xtocky_entry_header



if (!function_exists('xtocky_entry_header_two')) :
    /**
     * entry header tile date meta.
     */
    function xtocky_entry_header_two()
    {
        $link_icon = '';
        if (has_post_format('link')) {
            $link_icon = '<div class="blog-date two"><i class="title-icon fa fa-link"></i></div>';
        } elseif (has_post_format('quote')) {
            $link_icon = '<div class="blog-date two"><i class="title-icon fa fa-quote-left"></i></div>';
        }

        ?>
        <div class="blog-title-wrap two">
            <?php echo wp_kses_post($link_icon); ?>
            <div class="blog-title">
                <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">',   esc_url(get_permalink())), '</a></h2>'); ?>
                <?php xtocky_blog_meta(); ?>
            </div>
        </div>
        <div class="clearfix"></div>
    <?php
    }
endif; //xtocky_entry_header



if (!function_exists('xtocky_read_more_link')) {
    function xtocky_read_more_link()
    {
        global $xtocky;
        $read_more_text = isset($xtocky['opt_blog_continue_reading']) ? sanitize_text_field($xtocky['opt_blog_continue_reading']) : esc_html__('READ MORE', 'xtocky');
        if ($read_more_text == '') {
            return;
        }
        return '<a href="' . get_permalink() . '" class="button">' . esc_attr($read_more_text) . '<span class="screen-reader-text">' . get_the_title() . '</span></a>';
    }
    add_filter('the_content_more_link', 'xtocky_read_more_link');
}

if (!function_exists('xtocky_remove_vc_from_excerpt')) {
    function xtocky_remove_vc_from_excerpt($excerpt)
    {
        $patterns = "/\[[\/]?vc_[^\]]*\]/";
        $replacements = "";
        return preg_replace($patterns, $replacements, $excerpt);
    }
}
if (!function_exists('xtocky_trim_word')) {
    function xtocky_trim_word($charlength)
    {
        global $word_count, $post;
        $word_count = isset($word_count) && $word_count != "" ? $word_count : $charlength;
        $post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);
        $clean_excerpt = strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;
        $clean_excerpt = strip_shortcodes(xtocky_remove_vc_from_excerpt($clean_excerpt));
        $excerpt_word_array = explode(' ', $clean_excerpt);
        $excerpt_word_array = array_slice($excerpt_word_array, 0, $word_count);
        $excerpt = implode(' ', $excerpt_word_array) . '...';
        echo '' . $excerpt . '';
    }
}

if (!function_exists('xtocky_excerpt')) :
    /**
     * Displays the optional excerpt.
     *
     * Wraps the excerpt in a div element
     *
     * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
     */
    function xtocky_excerpt($class = 'entry-summary')
    {
        $class = esc_attr($class);

        if (has_excerpt() || is_search()) : ?>
            <div class="<?php echo esc_attr($class); ?>">
                <?php the_excerpt(); ?>
            </div>
        <?php endif;
    }
endif;
if (!function_exists('xtocky_excerpt_more') && !is_admin()) :
    /**
     * Replaces "[...]" (appended to automatically generated excerpts) with ... and
     * a 'Continue reading' link.
     *
     * Create your own xtocky_excerpt_more() function to override in a child theme.
     *
     *
     * @return string 'Continue reading' link prepended with an ellipsis.
     */
    function xtocky_excerpt_more()
    {
        global $xtocky;
        $read_more_text = isset($xtocky['opt_blog_continue_reading']) ? sanitize_text_field($xtocky['opt_blog_continue_reading']) : esc_html__('Read more', 'xtocky');
        $link = sprintf(
            '<a href="%1$s" class="more-link">%2$s</a>',
            esc_url(get_permalink(get_the_ID())),
            /* translators: %s: Name of current post */
            sprintf(esc_attr($read_more_text), '')
        );
        return $link;
    }
    add_filter('excerpt_more', 'xtocky_excerpt_more');
endif;



if (!function_exists('xtocky_excerpt_max_charlength')) {

    function xtocky_excerpt_max_charlength($charlength)
    {
        $excerpt = get_the_excerpt();
        $charlength++;

        if (mb_strlen($excerpt) <= $charlength) {
            $excerpt = strip_tags(get_the_content());
        }

        if (mb_strlen($excerpt) > $charlength) {
            $subex = mb_substr($excerpt, 0, $charlength - 5);
            $exwords = explode(' ', $subex);
            $excut = -(mb_strlen($exwords[count($exwords) - 1]));
            if ($excut < 0) {
                $subex = mb_substr($subex, 0, $excut);
            }
            $subex .= '...';
            $excerpt = $subex;
        }

        return $excerpt;
    }
}


/**
 * Determines whether blog/site has more than one category.
 *
 * Create your own xtocky_categorized_blog() function to override in a child theme.
 *
 * @return bool True if there is more than one category, false otherwise.
 */
function xtocky_categorized_blog()
{
    if (false === ($all_the_cool_cats = get_transient('xtocky_categories'))) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields'     => 'ids',
            // We only need to know if there is more than one category.
            'number'     => 2,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('xtocky_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so xtocky_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so xtocky_categorized_blog should return false.
        return false;
    }
}

/**
 * Flushes out the transients used in xtocky_categorized_blog().
 *
 * @since xtocky
 */
function xtocky_category_transient_flusher()
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('xtocky_categories');
}
add_action('edit_category', 'xtocky_category_transient_flusher');
add_action('save_post',     'xtocky_category_transient_flusher');

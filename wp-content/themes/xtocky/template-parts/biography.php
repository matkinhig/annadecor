<?php
/**
 * The template part for displaying an Author biography
 */
?>

<div class="entry-author">
	<figure>
		<?php
		/**
		 * Filter the Twenty Sixteen author bio avatar size.		 
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'xtocky_author_bio_avatar_size', 120 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
                <h4>
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                        <?php echo get_the_author(); ?> 
                    </a>
                </h4>
	</figure><!-- .author-avatar -->
	<div class="author-content">		

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>			
		</p><!-- .author-bio -->
                <a class="author-link more-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                        <?php printf( esc_html__( 'More posts by %s', 'xtocky' ), get_the_author() ); ?>
                </a>
	</div><!-- .author-description -->
</div><!-- .author-info -->




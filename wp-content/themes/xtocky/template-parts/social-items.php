<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="social-icons">
<?php if ( trim( $GLOBALS['xtocky']['twitter'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['xtocky']['twitter'] ); ?>">
        <i class="social-icon fa fa-twitter"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Twitter link', 'xtocky' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['xtocky']['facebook'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['xtocky']['facebook'] ); ?>">
        <i class="social-icon fa fa-facebook"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Facebook link', 'xtocky' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['xtocky']['googleplus'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['xtocky']['googleplus'] ); ?>">
        <i class="social-icon fa fa-google-plus"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Google Plus link', 'xtocky' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['xtocky']['dribbble'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['xtocky']['dribbble'] ); ?>">
        <i class="social-icon fa fa-dribbble"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Dribbble link', 'xtocky' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['xtocky']['behance'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['xtocky']['behance'] ); ?>">
        <i class="social-icon fa fa-behance"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Behance link', 'xtocky' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['xtocky']['tumblr'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['xtocky']['tumblr'] ); ?>">
        <i class="social-icon fa fa-tumblr"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Tumblr link', 'xtocky' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['xtocky']['instagram'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['xtocky']['instagram'] ); ?>">
        <i class="social-icon fa fa-instagram"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Instagram link', 'xtocky' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['xtocky']['pinterest'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['xtocky']['pinterest'] ); ?>">
        <i class="social-icon fa fa-pinterest"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Pinterest link', 'xtocky' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['xtocky']['youtube'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['xtocky']['youtube'] ); ?>">
        <i class="social-icon fa fa-youtube"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Youtube link', 'xtocky' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['xtocky']['vimeo'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['xtocky']['vimeo'] ); ?>">
        <i class="social-icon fa fa-vimeo"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Vimeo link', 'xtocky' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['xtocky']['linkedin'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['xtocky']['linkedin'] ); ?>">
        <i class="social-icon fa fa-linkedin"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'LinkedIn link', 'xtocky' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['xtocky']['flickr'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['xtocky']['flickr'] ); ?>">
        <i class="social-icon fa fa-flickr"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Flickr feed', 'xtocky' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['xtocky']['soundcloud'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['xtocky']['soundcloud'] ); ?>">
        <i class="social-icon fa fa-soundcloud"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Soundcloud', 'xtocky' ); ?></span>
    </a>  
<?php endif; ?>
</div>
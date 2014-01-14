<?php
/**
 * Display your social icons
 *
 * @package WordPress
 * @subpackage GoodInc
 * @since 1.0
 */
  
if ( !function_exists('wpex_display_social') ) {
	
	function wpex_display_social() {
		
		$wpex_social_icons_location = apply_filters( 'wpex_social_icons_location', get_template_directory_uri() .'/images/social/' );
	
		// Twitter
		if( wpex_get_data( 'twitter' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'twitter' ); ?>" title="<?php _e( 'Follow Us' , 'wpex' ); ?>" id="header-social-twitter"><img src="<?php echo $wpex_social_icons_location; ?>/twitter.png" alt="Twitter" /></a></li>
		<?php }
		// Facebook
		if( wpex_get_data( 'facebook' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'facebook' ); ?>" title="<?php _e( 'Facebook Us' , 'wpex' ); ?>" id="header-social-facebook"><img src="<?php echo $wpex_social_icons_location; ?>/facebook.png" alt="Facebook" /></a></li>
		<?php }
		// Pinterest
		if( wpex_get_data( 'pinterest' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'pinterest' ); ?>" title="<?php _e( 'Pinterest' , 'wpex' ); ?>" id="header-social-pinterest"><img src="<?php echo $wpex_social_icons_location; ?>/pinterest.png" alt="Pinterest" /></a></li>
		<?php }
		// Dribbble
		if( wpex_get_data( 'dribbble' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'dribbble' ); ?>" title="<?php _e( 'Dribbble' , 'wpex' ); ?>" id="header-social-dribbble"><img src="<?php echo $wpex_social_icons_location; ?>/dribbble.png" alt="Dribbble" /></a></li>
		<?php }
		// Google Plus
		if( wpex_get_data( 'googleplus' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'googleplus' ); ?>" title="<?php _e( 'Google Plus' , 'wpex' ); ?>" id="header-social-googleplus"><img src="<?php echo $wpex_social_icons_location; ?>/googleplus.png" alt="Google Plus" /></a></li>
		<?php }
		// LinkedIn
		if( wpex_get_data( 'linkedin' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'linkedin' ); ?>" title="<?php _e( 'LinkedIn' , 'wpex' ); ?>" id="header-social-linkedin"><img src="<?php echo $wpex_social_icons_location; ?>/linkedin.png" alt="LinkedIn" /></a></li>
		<?php }
		// Behance
		if( wpex_get_data( 'dribbble' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'behance' ); ?>" title="<?php _e( 'Behance' , 'wpex' ); ?>" id="header-social-behance"><img src="<?php echo $wpex_social_icons_location; ?>/behance.png" alt="Behance" /></a></li>
		<?php }  
		// Flickr
		if( wpex_get_data( 'flickr' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'flickr' ); ?>" title="<?php _e( 'Flickr' , 'wpex' ); ?>" id="header-social-flickr"><img src="<?php echo $wpex_social_icons_location; ?>/flickr.png" alt="Flickr" /></a></li>
		<?php }
		// Vimeo
		if( wpex_get_data( 'vimeo' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'vimeo' ); ?>" title="<?php _e( 'Vimeo' , 'wpex' ); ?>" id="header-social-vimeo"><img src="<?php echo $wpex_social_icons_location; ?>/vimeo.png" alt="Vimeo" /></a></li>
		<?php }
		// Youtube
		if( wpex_get_data( 'youtube' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'youtube' ); ?>" title="<?php _e( 'Youtube Channel' , 'wpex' ); ?>" id="header-social-youtube"><img src="<?php echo $wpex_social_icons_location; ?>/youtube.png" alt="YouTube" /></a></li>
		<?php }
		// Forrst
		if( wpex_get_data( 'forrst' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'forrst' ); ?>" title="<?php _e( 'Forrst' , 'wpex' ); ?>" id="header-social-forrst"><img src="<?php echo $wpex_social_icons_location; ?>/forrst.png" alt="Forrst" /></a></li>
		<?php }
		// Github
		if( wpex_get_data( 'github' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'github' ); ?>" title="<?php _e( 'Github' , 'wpex' ); ?>" id="header-social-github"><img src="<?php echo $wpex_social_icons_location; ?>/github.png" alt="github" /></a></li>
		<?php }
		// Instagram
		if( wpex_get_data( 'instagram' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'instagram' ); ?>" title="<?php _e( 'Instagram' , 'wpex' ); ?>" id="header-social-instagram"><img src="<?php echo $wpex_social_icons_location; ?>/instagram.png" alt="Instagram" /></a></li>
        <?php }
		// RSS
		if( wpex_get_data( 'rss' ) !== '' ) { ?>
			<li><a href="<?php echo wpex_get_data( 'rss' ); ?>" title="<?php _e( 'RSS Feed' , 'wpex' ); ?>" id="header-social-rss"><img src="<?php echo $wpex_social_icons_location; ?>/rss.png" alt="RSS" /></a></li>
		<?php } 
	
	}

}
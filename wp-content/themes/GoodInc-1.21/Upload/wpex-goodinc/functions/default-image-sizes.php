<?php
/**
 * Creates a function for your featured image sizes which can be altered via your child theme
 *
 * @package WordPress
 * @subpackage GoodInc
 * @since 1.0
 */
 
if ( ! function_exists( 'wpex_img' ) ) {

	function wpex_img( $args ){
		
		global $post;
		
		// Get meta
		if ( $post ) {
			$post_layout = get_post_meta ( $post->ID, 'wpex_post_layout', true );
			$post_media_size = get_post_meta ( $post->ID, 'wpex_post_media_size', true );
		} else {
			$post_layout = 'Full Width';
			$post_media_size = 'standard';
		}
		
		//homapage flexslider
		if( $args == 'flex_home_slide_width' ) return '630';
		if( $args == 'flex_home_slide_height' ) return '390';
		if( $args == 'flex_home_slide_crop' ) return true;
		
		//blog entries
		if( $args == 'entry_width' ) return '620';
		if( $args == 'entry_height' ) return '320';
		if( $args == 'entry_crop' ) return true;
		
		//blog posts
		if( $args == 'post_width' ) {
			if( $post_layout == 'Full Width' || $post_media_size == 'full' ) {
				return '940';
			} else {
				return '620';
			}
		}
		if( $args == 'post_height' ) {
			if( $post_layout == 'Full Width' || $post_media_size == 'full' ) {
				return '400';
			} else {
				return '320';
			}
		}
		if( $args == 'post_crop' ) {
			if( $post_layout == 'Full Width' || $post_media_size == 'full' ) {
				return true;
			} else {
				return true;
			}
		}
		
	}

}
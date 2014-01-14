<?php
/**
 * Adds classes to the body tag for various page/post layout styles
 *
 * @package WordPress
 * @subpackage GoodInc
 * @since 1.0
*/

add_filter( 'body_class', 'wpex_body_classes' );

if ( !function_exists('wpex_body_classes') ) {
	
	function wpex_body_classes( $classes ) {
		
		if( wpex_get_data( 'responsive', '1' ) == '1' ) {
			$classes[] = 'wpex-responsive';
		}
		
		if ( ! is_singular() ) return $classes; // not a post or page, return standard classes
		
		global $post;
		
		$post_layout = get_post_meta ( $post->ID, 'wpex_post_layout', true );
		if ( $post_layout ) {
			if ( $post_layout == 'Full Width' ) {
				$classes[] = 'full-width-post';
			} elseif ( $post_layout == 'Left Sidebar' ) {
				$classes[] = 'left-sidebar-post';
			} else {
				$classes[] = 'right-sidebar-post';
			}
		}
		
		return $classes;
	}
}


/**
 * Used to hide the sidebar when not needed
 *
 * @package WordPress
 * @subpackage GoodInc
 * @since 1.0
*/
if ( !function_exists('wpex_sidebar_enabled') ) {
	
	function wpex_sidebar_enabled() {
		if ( ! is_singular() ) return true;
		global $post;
		$post_layout = get_post_meta ( $post->ID, 'wpex_post_layout', true );
		if ( ! $post ) return true;
		if ( empty($post_layout) ) return true;
		if ( $post_layout == 'Full Width' ) {
			return false;
		} else {
			return true;
		}
	}
	
}
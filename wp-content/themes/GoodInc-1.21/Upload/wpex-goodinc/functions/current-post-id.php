<?php
/**
 * Get current post ID
 *
 * @package WordPress
 * @subpackage GoodInc
 * @since 1.0
 */

if ( ! function_exists( 'wpex_get_current_post_id' ) ) {	
	function wpex_get_current_post_id() {
		global $post;
		if ( !$post ) return;
		return $post ? $post->ID : $wp_query->post->ID;
	}
}
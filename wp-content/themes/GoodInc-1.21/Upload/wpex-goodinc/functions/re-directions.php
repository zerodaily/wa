<?php
/**
 * Redirect link post formats
 *
 * @package WordPress
 * @subpackage GoodInc
 * @since 1.0
 */

if ( ! function_exists( 'wpex_redirect_link_post_format' ) ) {
	
	function wpex_redirect_link_post_format() {
		global $post;
		if ( !$post ) return;
		$postid = $post->ID;
		if ( is_singular( 'post' ) && get_post_format( $postid ) == 'link' ) {
			wp_redirect( esc_url( get_post_meta( $postid, 'wpex_post_url', true ) ) , 301);
			exit;
		}
	}
	
}
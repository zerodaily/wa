<?php
/**
 * Get featured image captions
 *
 * @package WordPress
 * @subpackage GoodInc
 * @since 1.0
 */

if ( ! function_exists( 'wpex_get_thumbnail_caption' ) ) {
	function wpex_get_thumbnail_caption() {
		global $post;
		$thumbnail_id = get_post_thumbnail_id( $post->ID );
		$thumbnail_image = get_posts( array( 'p' => $thumbnail_id, 'post_type' => 'attachment') );
		if ($thumbnail_image && isset( $thumbnail_image[0]) ) {
			return $thumbnail_image[0]->post_excerpt;
		}
	}
}
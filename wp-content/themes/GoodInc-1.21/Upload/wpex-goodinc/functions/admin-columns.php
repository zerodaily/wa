<?php
/**
 * Create Custom Columns for the WP dashboard
 *
 * @package WordPress
 * @subpackage GoodInc
 */

 
/**
* Add thumbnails to post admin dashboard
* @since 1.0
*/
add_filter('manage_posts_columns', 'wpex_posts_columns', 5);
add_action('manage_posts_custom_column', 'wpex_posts_custom_columns', 5, 2);

function wpex_posts_columns($defaults){
    $defaults['wpex_post_thumbs'] = __( 'Thumbnail', 'wpex' );
    return $defaults;
}

function wpex_posts_custom_columns( $column_name, $id ){
    if( $column_name != 'wpex_post_thumbs' ) {
        return;	
	}
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');
	if (  $thumbnail ) {
		echo '<img src="' . $thumbnail[0] . '" alt="' . the_title_attribute('echo=0') . '" height="100" width="100" style="max-width:100%;height:auto;" />';
	} else {
		return;
	}
}
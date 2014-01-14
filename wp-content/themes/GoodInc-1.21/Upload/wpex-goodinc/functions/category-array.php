<?php
/**
 * Create an array of WordPress Categories
 *
 * @package WordPress
 * @subpackage GoodInc
 * @since 1.0
*/

if ( ! function_exists( 'wpex_category_array' ) ) {
	function wpex_category_array(){
		$blog_categories = array();  
		$blog_categories_obj = get_categories('hide_empty=0');	
		foreach ($blog_categories_obj as $blog_cat) {
		    $blog_categories[$blog_cat->cat_ID] = $blog_cat->slug;}
		$categories_tmp = array_unshift( $blog_categories, "None" );
		return $blog_categories;		
	}	
}
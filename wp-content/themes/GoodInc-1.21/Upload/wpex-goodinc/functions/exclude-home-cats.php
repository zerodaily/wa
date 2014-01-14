<?php
/**
 * Exclude Categories from the homepage
 *
 * @package WordPress
 * @subpackage GoodInc
 * @since 1.0
 */

add_action( 'pre_get_posts', 'wpex_exclude_home_cats' );
if ( ! function_exists( 'wpex_exclude_home_cats' ) ) {
	
	function wpex_exclude_home_cats( $query ) {
		
		 if ( !isset( $query ) ) return; // no query, bye bye
		 
		 $excluded_cats = array(); // setup array for excluded cats
		
		// Only run on homepage 
		if ( !is_home() ) return;
		
		// Exclude slider items
		if ( wpex_get_data( 'homepage_slider_cat_exclude', '1' ) == '1' && wpex_get_data( 'homepage_slider_cat', 'None' ) !== 'None' ) {
			$slider_cat = wpex_get_data( 'homepage_slider_cat' );
			$slider_cat_obj = get_category_by_slug($slider_cat);
			$slider_cat_id = $slider_cat_obj->term_id;
			$excluded_cats[] = $slider_cat_id;
		}
		
		// Exclude carousel items
		if ( wpex_get_data( 'homepage_carousel_cat_exclude', '1' ) == '1' && wpex_get_data( 'homepage_carousel_cat', 'None' ) !== 'None' ) {
			$carousel_cat = wpex_get_data( 'homepage_carousel_cat' );
			$carousel_cat_obj = get_category_by_slug($carousel_cat);
			$carousel_cat_id = $carousel_cat_obj->term_id;
			$excluded_cats[] = $carousel_cat_id;
		}
		
		if ( empty($excluded_cats) ) return; // no categories to exclude
		
		// Create comma seperated list of negative category ID's
		$excluded_cat_list = '';
		foreach ($excluded_cats as $excluded_cat) {
			if ( !empty($excluded_cats[1]) ) {
				$excluded_cat_list .=  '-'. $excluded_cat .', ';
			} else {
				$excluded_cat_list .=  '-'. $excluded_cat;
			}
		}
		
		if ( $query->is_home() && $query->is_main_query() ) {
			$query->set( 'cat', ''.  $excluded_cat_list .'' );
		}

	}
	
}
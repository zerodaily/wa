<?php
/**
 * Function used to load content via AJAX
 *
 * @package WordPress
 * @subpackage GoodInc
 */


/**
 * Important action Hooks
 * @since 1.0
 */
add_action( 'wp_ajax_wpex_load_more_query', 'wpex_load_more_query' );
add_action( 'wp_ajax_nopriv_wpex_load_more_query', 'wpex_load_more_query' );



/**
 * Get AJAx Query and display posts
 * @since 1.0
 */
function wpex_load_more_query() {
	
	// Get $_POST Data
	$page 			= $_POST['pagenum'];
	$archive_type 	= $_POST['archive_type'];
	$archive_id 	= $_POST['archive_id'];
	$archive_month 	= $_POST['archive_month'];
	$archive_year 	= $_POST['archive_year'];
	$post_format 	= $_POST['post_format'];
	$author 		= $_POST['author'];
	$s 				= $_POST['s'];
	
	// Loop Arguments
	$args = array(
		'paged' 		=> $page,
		'post_status'	=> 'publish'
	);
	
	// Archives - category, tags, dates
	if( !empty( $archive_type ) ) {
		
		switch($archive_type) {
			
			case 'category':
				$args['cat'] = $archive_id;
				break;
				
			case 'post_tag':
				$args['tag_id'] = $archive_id;
				break;
				
			case 'date':
				$args['monthnum'] = $archive_month;
				$args['year'] = $archive_year;
				break;
				
		}
	}
	
	// Post Format
	if( !empty( $post_format ) ) {
		$args['tax_query'] = array(
		    array(
		      'taxonomy'	=> 'post_format',
		      'field'		=> 'slug',
		      'terms'		=> "post-format-$post_format"
		    )
		);
	}
	
	// Author archives
	if(!empty($author)) {
		$args['author'] = $author;
	}
	
	// Search results
	if( !empty($s) ) {
		$args['s'] = $s;
	}
	
	query_posts($args);
	
	// Capture output
	ob_start();
	if ( have_posts() ) { 
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() );
		}
	}
	$output = ob_get_clean();
	
	echo $output;
	
	wp_die();
}


if ( ! function_exists( 'wpex_load_more' ) ) {
	
	function wpex_load_more($page = 2, $archive = null) {
		
		/**
		* Load scripts
		* @since 1.0
		*/
		$load_more_string = apply_filters( 'wpex_load_more_string', __( 'Load More', 'wpex' ) );
		$loading_string = apply_filters( 'wpex_load_more_loading_string', __( 'Loading...', 'wpex' ) );
		$ajax_args =  array(
						'ajaxUrl'			=> admin_url( 'admin-ajax.php' ),
						'loadMoreString'	=> $load_more_string,
						'loadingString'		=> $loading_string,
					);
		wp_enqueue_script( 'wpex-ajax-load', WPEX_JS_DIR .'/load-more.js', array( 'jquery' ), 1.0, true);	
		wp_localize_script( 'wpex-ajax-load', 'wpexLoadMoreVars', $ajax_args );

		
		/**
		 * The Function
		 * @since 1.0
		 */
		global $wp_query;
		
		$output = '';
		
		// Build query data
		$archive_type = '';
		$archive_id = '';
		$archive_month = '';
		$archive_year = '';
		$post_format = isset($wp_query->post_format) ? $wp_query->post_format : '';
		$author = isset($wp_query->author) ? $wp_query->author : '';
		
		if ( is_category() ) {
			
			$archive_type = 'category';
			$archive_id = get_query_var( 'cat' );		
			
		} elseif (is_tag() ) {
			$archive_type = 'post_tag';
			$archive_id = get_query_var( 'tag' );
			
		} elseif( is_date() ) {
			
			$archive_type = 'date';
			$archive_month = get_query_var( 'monthnum' );
			$archive_year = get_query_var( 'year' );
			
		}
		
		$maxpage = $wp_query->max_num_pages;
			
		//display load more if next page exists
		if( $maxpage >= 2) {
			$output .= '<div id="wpex-load-more">';
				$output .= '<input id="wpex-ajax-load-more-nonce" type="hidden" value="'. wp_create_nonce  ( 'wpex-ajax-load-more-nonce' ) .'" />';
				$output .= '<a href="#" data-pagenum="'. $page .'" data-maxpage="'. $maxpage .'" data-archive_type="'. $archive_type .'" data-archive_id="'. $archive_id .'" data-post_format="'. $post_format .'" data-author="'. $author .'" data-archive_month="'. $archive_month .'" data-archive_year="'. $archive_year .'" data-s="'.get_query_var( 's' ).'" alt="'. __( 'Load More', 'wpex' ).'">'. $load_more_string .'</a>';
			$output .= '</div>';
		}
		
		echo $output;
	}

}
?>
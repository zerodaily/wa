<?php
/**
 * This file loads the CSS and Javascript used for the theme.
 *
 * @package WordPress
 * @subpackage GoodInc
 * @since 1.0
 */
 
 
add_action( 'wp_enqueue_scripts','wpex_load_scripts' );
function wpex_load_scripts() {

	/*************
	* CSS
	*************/
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'raleway-googlefont', 'http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,900,800,200,100' );
		

	/*************
	* jQuery
	*************/
	wp_enqueue_script( 'jpanel-menu', WPEX_JS_DIR .'/jpanel-menu.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'images-loaded', WPEX_JS_DIR .'/images-loaded.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'fitvids', WPEX_JS_DIR .'/fitvids.js', array( 'jquery' ), 1.0, true );
	wp_enqueue_script( 'magnific-popup', WPEX_JS_DIR .'/magnific-popup.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'global', WPEX_JS_DIR .'/global.js', array( 'jquery', 'magnific-popup', 'fitvids', 'jpanel-menu' ), '1.0', true) ;
	
	wp_register_script( 'flexslider', WPEX_JS_DIR .'/flexslider.js', array( 'jquery' ), '2.1', true );
	
	if ( ! wp_is_mobile() && wpex_get_data( 'fixed_nav', '1' ) == '1' ) {
		wp_enqueue_script( 'wpex-nonmobile', WPEX_JS_DIR .'/non-mobile.js', array( 'jquery' ), '1.0', true );
	}
		
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( wpex_get_data( 'retina' ) == '1' ) {
		wp_enqueue_script('retina', WPEX_JS_DIR .'/retina.js', array('jquery'), '0.0.2', true);
	}
		
	
} //end wpex_load_scripts()



/**
* Site Tracking
* @Since 1.0
*/
if ( !function_exists('wpex_site_tracking') ) {
	add_action('wp_head', 'wpex_site_tracking');
	function wpex_site_tracking() {
		if ( wpex_get_data( 'google_analytics' ) ) {
			echo wpex_get_data('google_analytics');
		}
	}
}


/**
* HTML5 & CSS3 IE Dependencies
* @Since 1.0
*/
if ( ! function_exists( 'wpex_html_css_dependencies' ) ) {
	function wpex_html_css_dependencies() {
		echo '<!--[if lt IE 9]>';
			echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
		echo '<![endif]-->';
		echo '<!--[if IE 7]><link rel="stylesheet" type="text/css" href="'. WPEX_CSS_DIR .'/font-awesome-ie7.min.css" media="screen" /><![endif]-->';
	}
	add_action( 'wp_head', 'wpex_html_css_dependencies' );
}



/**
* Load twitter widgets.js script for AJAX support for status post formats
* @since 1.0
*/
add_action( 'wp_footer', 'wpex_get_twitter_widgets_js' );
if ( ! function_exists( 'wpex_get_twitter_widgets_js' ) ) {
	function wpex_get_twitter_widgets_js() {
		echo '<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';
    }
}
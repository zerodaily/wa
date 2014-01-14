<?php
/**
 * Outputs custom CSS to the wp_head() hook.
 *
 * @package WordPress
 * @subpackage GoodInc
 */

add_action('wp_head', 'wpex_custom_css');
if ( !function_exists( 'wpex_custom_css' ) ) {
	
	function wpex_custom_css() {
	
		$custom_css ='';
		
		// Custom BG Color
		$custom_skin = wpex_get_data( 'custom_skin', '#f26c4f' );
		if ( $custom_skin !== '#f26c4f' ) {
			$custom_css .= '
						#archive-post-count, .entry-thumb-readmore, .aside-entry, .aside-entry .post-entry-details, .gallery-entry-slider .flex-direction-nav a:hover, #single-post-slider .flex-direction-nav a:hover, #post-tags a, #wp-calendar tbody td:hover, #wp-calendar tbody td:hover a, #sidebar .tagcloud a, .wpex-flickr-widget .flickr_badge_image:hover, #sidebar .widget_nav_menu a:hover, #sidebar .widget_nav_menu .current-menu-item > a, .entry input[type="button"]:hover, .entry input[type="submit"]:hover, #comments input[type="submit"]:hover, .theme-button:hover, .review-final-score, .review-percentage .review-item span span, #jPanelMenu-menu a.active, #jPanelMenu-menu a.active:hover { background-color: '. $custom_skin .' !important; }
						
						.entry a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .single h1, #sidebar .wpex-widget-featured-posts .title:hover, .contributor-entry a, .site-map-template-section a, .archives-list a, .comment-meta .fn a, .comment-reply-link, #comments .logged-in-as a { color: '. $custom_skin .'; }
						
						#page-heading, #navigation .nav-main > li:hover > a, #navigation .nav-main > li > a:hover, #navigation .nav-main > .current-menu-item > a, #navigation .nav-main > .current-menu-item > a:hover, #featured-flexslider .text-caption, .bypostauthor .comment-author .avatar { border-color: '. $custom_skin .'; }
						
						#featured-flexslider .text-caption:before { border-left-color: '. $custom_skin .'; }
						.rtl #featured-flexslider .text-caption:before { border-right-color: '. $custom_skin .'; }
						
						#posts-carousel-wrap .bx-wrapper li:hover .overlay-plus { background: url("'. get_template_directory_uri().'/images/carousel-overlay.png") 0 0 no-repeat; }';
		}
		
		// Body Background
		$body_background = wpex_get_data( 'body_background', '#ebebeb');
		if ( $body_background !== '#ebebeb' && $body_background !== '' ) {
			$custom_css .= 'body { background-color: '. $body_background .' }';
		}
		
		// Top Bar Background
		$top_bar_background = wpex_get_data( 'top_bar_background', '#373737');
		if ( $top_bar_background !== '#373737' ) {
			$custom_css .= '#top-bar-wrap { background-color: '. $top_bar_background .' }';
		}
		
		// Logo Color
		$top_bar_color = wpex_get_data( 'top_bar_color', '#ffffff');
		if ( $top_bar_color !== '#ffffff' ) {
			$custom_css .= '#top-bar-wrap, #logo h2 a { color: '. $top_bar_color .' }';
		}
		
		// Menu Bar Background
		$menu_background = wpex_get_data( 'menu_background', '#474747');
		if ( $menu_background !== '#474747' ) {
			$custom_css .= '#navigation, #nav-extend-bg, #navigation .nav-main ul, #responsive-toggles { background-color: '. $menu_background .' }';
			$custom_css .= '#navigation .nav-main ul:before { border-bottom-color: '. $menu_background .'; }';
		}
		
		// Menu Bar Color
		$menu_color = wpex_get_data( 'menu_color', '#ffffff');
		if ( $menu_color !== '#ffffff' ) {
			$custom_css .= '#navigation .nav-main a, #navigation .nav-main ul a, #navigation #navigation-responsive-toggle, #search-responsive-toggle { color: '. $menu_color .' }';
		}
		
		// Menu Bar Color Hover/Active
		$menu_color_hover = wpex_get_data( 'menu_color_hover', '#ffffff');
		if ( $menu_color_hover !== '#ffffff' ) {
			$custom_css .= '#navigation .nav-main > li:hover > a, #navigation .nav-main > li > a:hover, #navigation .nav-main > .current-menu-item > a, #navigation .nav-main > .current-menu-item > a:hover, #navigation .nav-main ul li > a:hover { color: '. $menu_color_hover .' }';
		}
		
		// Footer Bar Background
		$footer_bar_background = wpex_get_data( 'footer_bar_background', '#474747');
		if ( $footer_bar_background !== '#474747' ) {
			$custom_css .= '#footer-nav, #footer-wrap:after { background-color: '. $footer_bar_background .' }';
		}
		
		// Footer Bar Color
		$footer_bar_color = wpex_get_data( 'footer_bar_color', '#ffffff');
		if ( $footer_bar_color !== '#ffffff' ) {
			$custom_css .= '#footer-nav a { color: '. $footer_bar_color .' }';
		}
		
		
		// Footer Background
		$footer_background = wpex_get_data( 'footer_background', '#373737');
		if ( $footer_background !== '#373737' ) {
			$custom_css .= '#footer-wrap { background-color: '. $footer_background .' }';
		}
		
		// Footer color
		$footer_color = wpex_get_data( 'footer_color', '#7e7e7e7');
		if ( $footer_color !== '#7e7e7e7' ) {
			$custom_css .= '#footer-copy { color: '. $footer_color .' }';
		}
		
		// Footer padding
		$footer_padding = wpex_get_data( 'footer_padding', '200px');
		if ( $footer_padding !== '200px' ) {
			$custom_css .= '#footer-wrap { padding-bottom: '. $footer_padding .' }';
		}
		
		// Menu icon
		$menu_icon = wpex_get_data( 'menu_icon', '1');
		if ( $menu_icon !== '1' ) {
			$custom_css .= '#navigation { padding-left: 40px; background-image: none; }';
		}
		
		// Search Icon
		$search_icon = wpex_get_data( 'search_icon', '1' );
		if ( $search_icon !== '1' ) {
			$custom_css .= '#header-search input { background-image: none; }';
		}
		
		// trim white space for faster page loading
		$custom_css_trimmed =  preg_replace( '/\s+/', ' ', $custom_css );
		
		// output css on front end
		$css_output = "<!-- Custom CSS -->\n<style type=\"text/css\">\n" . $custom_css_trimmed . "\n</style>";
		if( !empty($custom_css) ) { echo $css_output;}
		
	} //end wpex_custom_css()
	
}
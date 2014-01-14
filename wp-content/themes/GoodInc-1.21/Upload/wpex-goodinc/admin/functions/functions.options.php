<?php
/**
 * Create options for this theme
 *
 * @package WordPress
 * @subpackage GoodInc
 */

add_action( 'init', 'of_options' );

if (!function_exists( 'of_options' )) {
	
	function of_options() {
	
	// Set the Options Array
	global $of_options;
	$of_options = array();
	

		// GENERAl SETTINGS
		$of_options[] = array( 
			"name"	=> "General",
			"type"	=> "heading"
		);
	
		//logos + fav
		$of_options[] = array(
			"name"	=> __( 'Custom Logo', 'wpex' ),
			"desc"	=> __( 'Use this field to upload your custom logo for use in the theme header', 'wpex' ),
			"id"	=> "custom_logo",
			"std"	=> '',
			"type"	=> "media"
		);
		
		$of_options[] = array(
			"name"	=> __("Footer Logo", "wpex"),
			"desc"	=> __("WPL O CKER. COM - Upload your custom logo for the footer area. Leave blank to disable.", "wpex"),
			"std"	=> "",
			"id"	=> "custom_footer_logo",
			"type"	=> "media",
		);
		
		$of_options[] = array(
			"name"	=> __( 'Custom Favicon', 'wpex' ),
			"desc"	=> __( 'Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.', 'wpex' ),
			"id"	=> "custom_favicon",
			"std"	=> "",
			"type"	=> "media"
		);
		
		//misc
		$of_options[] = array( 
			"name"	=> __( 'Responsiveness', 'wpex' ),
			"desc"	=> __( 'Do you wish to enable or disable the responsive CSS for this theme?', 'wpex' ),
			"id"	=> "responsive",
			"std"	=> '1',
			"on"	=> __( 'Enable', 'wpex' ),
			"off"	=> __( 'Disable', 'wpex' ),
			"type"	=> "switch"
		);
		
		$of_options[] = array( 
			"name"	=> __( 'Fixed Navigation', 'wpex' ),
			"desc"	=> __( 'Do you wish the navigation to stay static when scrolling down the site?', 'wpex' ),
			"id"	=> "fixed_nav",
			"std"	=> '1',
			"on"	=> __( 'Enable', 'wpex' ),
			"off"	=> __( 'Disable', 'wpex' ),
			"type"	=> "switch"
		);
		
		$of_options[] = array( 
			"name"	=> __( 'Retina Support', 'wpex' ),
			"desc"	=> __( 'Do you wish to enable or disable the built-in retina support?', 'wpex' ),
			"id"	=> "retina",
			"std"	=> '0',
			"on"	=> __( 'Enable', 'wpex' ),
			"off"	=> __( 'Disable', 'wpex' ),
			"type"	=> "switch"
		);
		
		// Styling
		$of_options[] = array( 
			"name"	=> "Styling",
			"type"	=> "heading"
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Highlight', 'wpex' ),
			"desc"		=>  __( 'Select a custom color.', 'wpex' ),
			"id"		=> "custom_skin",
			"std"		=> "#f26c4f",
			"type"		=> "color",
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Body Background', 'wpex' ),
			"desc"		=>  __( 'Select a custom color.', 'wpex' ),
			"id"		=> "body_background",
			"std"		=> "#ebebeb",
			"type"		=> "color",
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Top Bar Background', 'wpex' ),
			"desc"		=>  __( 'Select a custom color.', 'wpex' ),
			"id"		=> "top_bar_background",
			"std"		=> "#373737",
			"type"		=> "color",
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Top Bar Logo Color', 'wpex' ),
			"desc"		=>  __( 'Select a custom color.', 'wpex' ),
			"id"		=> "top_bar_color",
			"std"		=> "#ffffff",
			"type"		=> "color",
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Menu Background', 'wpex' ),
			"desc"		=>  __( 'Select a custom color.', 'wpex' ),
			"id"		=> "menu_background",
			"std"		=> "#474747",
			"type"		=> "color",
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Menu Color', 'wpex' ),
			"desc"		=>  __( 'Select a custom color.', 'wpex' ),
			"id"		=> "menu_color",
			"std"		=> "#ffffff",
			"type"		=> "color",
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Menu Hover & Active Color', 'wpex' ),
			"desc"		=>  __( 'Select a custom color.', 'wpex' ),
			"id"		=> "menu_color_hover",
			"std"		=> "#ffffff",
			"type"		=> "color",
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Footer Bar Background', 'wpex' ),
			"desc"		=>  __( 'Select a custom color.', 'wpex' ),
			"id"		=> "footer_bar_background",
			"std"		=> "#474747",
			"type"		=> "color",
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Footer Bar Color', 'wpex' ),
			"desc"		=>  __( 'Select a custom color.', 'wpex' ),
			"id"		=> "footer_bar_color",
			"std"		=> "#ffffff",
			"type"		=> "color",
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Footer Background', 'wpex' ),
			"desc"		=>  __( 'Select a custom color.', 'wpex' ),
			"id"		=> "footer_background",
			"std"		=> "#373737",
			"type"		=> "color",
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Footer Text Color', 'wpex' ),
			"desc"		=>  __( 'Select a custom color.', 'wpex' ),
			"id"		=> "footer_color",
			"std"		=> "#7e7e7e7",
			"type"		=> "color",
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Footer Padding', 'wpex' ),
			"desc"		=>  __( 'Enter your custom bottom padding for your footer.', 'wpex' ),
			"id"		=> "footer_padding",
			"std"		=> "200px",
			"type"		=> "text",
		);
		
		$of_options[] = array( 
			"name"	=> __( 'Menu Icon', 'wpex' ),
			"desc"	=> __( 'Do you wish to enable or disable the pin icon in the main menu?', 'wpex' ),
			"id"	=> "menu_icon",
			"std"	=> '1',
			"on"	=> __( 'Enable', 'wpex' ),
			"off"	=> __( 'Disable', 'wpex' ),
			"type"	=> "switch"
		);
		
		$of_options[] = array( 
			"name"	=> __( 'Main Search Icon', 'wpex' ),
			"desc"	=> __( 'Do you wish to enable or disable the main search icon?', 'wpex' ),
			"id"	=> "search_icon",
			"std"	=> '1',
			"on"	=> __( 'Enable', 'wpex' ),
			"off"	=> __( 'Disable', 'wpex' ),
			"type"	=> "switch"
		);
		
		
		// TPYPOGRAPHY
		$of_options[] = array( 
			"name"	=> "Typography",
			"type"	=> "heading"
		);
		
		
		$of_options[] = array(
			"name"		=> __('Logo Font', 'wpex'),
			"desc"		=> __('Select your desired font family for your logo.', 'wpex'),
			"id"		=> "logo_font",
			"std"		=> 'default',
			"type"		=> "select_google_font",
			"preview"	=> array(
							"text"	=> __('Font Preview Text', 'wpex'),
							"size"	=> "30px"
			),
			"options"	=>  listgooglefontoptions()
		);
							
		$of_options[] = array(
			"name"		=> __('Main Body Font', 'wpex'),
			"desc"		=> __('Select your desired font family for your body text.', 'wpex'),
			"id"		=> "body_font",
			"std"		=> 'default',
			"type"		=> "select_google_font",
			"preview"	=> array(
							"text"	=> __('Font Preview Text', 'wpex'),
							"size"	=> "30px"
			),
			"options"	=>  listgooglefontoptions()
		);
		
		$of_options[] = array( 
			"name"		=> __('Menu Font', 'wpex'),
			"desc"		=> __('Select your desired font family for your main navigation menu.', 'wpex'),
			"id"		=> "menu_font",
			"std"		=> 'default',
			"type"		=> "select_google_font",
			"preview"	=> array(
							"text"	=> __('Font Preview Text', 'wpex'),
							"size"	=> "30px"
			),
			"options"	=>  listgooglefontoptions()
		);
						
		$of_options[] = array(
			"name"		=> __('Headings Font', 'wpex'),
			"desc"		=> __('Select your desired font family for your headings.', 'wpex'),
			"id"		=> "headings_font",
			"std"		=> 'default',
			"type"		=> "select_google_font",
			"preview"	=> array(
							"text"	=> __('Font Preview Text', 'wpex'),
							"size"	=> "30px"
			),
			"options"	=>  listgooglefontoptions()
		);
		
			
		// SLIDER SETTINGS	
		$of_options[] = array( 
			"name"	=> __( 'Sliders', 'wpex' ),
			"type"	=> "heading"
		);
		
		$of_options[] = array(
			"name"	=> "",
			"desc"	=> "",
			"id"	=> "subheading",
			"std"	=> "<h3 style=\"margin: 0;\">". __( 'Image Slider', 'wpex' ) ."</h3>",
			"icon"	=> true,
			"type"	=> "info"
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Slider Category', 'wpex' ),
			"desc"		=>  __( 'Select posts category for your homepage slider.', 'wpex' ),
			"id"		=> "homepage_slider_cat",
			"std"		=> "",
			"type"		=> "select",
			"options"	=> wpex_category_array(),
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Slides Count', 'wpex' ),
			"desc"		=>  __( 'How many slides do you wish to display for the homepage slider?', 'wpex' ),
			"id"		=> "homepage_slider_count",
			"std"		=> "4",
			"type"		=> "text",
		);
		
		$of_options[] = array(
			"name"	=> __( 'Exclude Slider Category From Homepage?', 'wpex' ),
			"desc"	=> __( 'Do you wish to exclude the category for the slider from the homepage recent posts area?', 'wpex' ),
			"id"	=> "homepage_slider_cat_exclude",
			"std"	=> '0',
			"on"	=> __( 'Yes', 'wpex' ),
			"off"	=> __( 'No', 'wpex' ),
			"type"	=> "switch",
		);
	
		$of_options[] = array(
			"name"	=>  __( 'Animation', 'wpex' ),
			"desc"	=>  __( 'Select your desired slider animation.', 'wpex' ),
			"id"	=> "slider_animation",
			"std"	=> "fade",
			"type"	=> "select",
			"options"	=> array(
				'fade'	=> 'fade',
				'slide'	=> 'slide',
			)
		);
						
		$of_options[] = array(
			"name"	=> __( 'Auto Slideshow', 'wpex' ),
			"desc"	=> __( 'Do you wish to enable or disable the automatic slideshow', 'wpex' ),
			"id"	=> "slider_slideshow",
			"std"	=> '1',
			"on"	=> __( 'Enable', 'wpex' ),
			"off"	=> __( 'Disable', 'wpex' ),
			"type"	=> "switch"
		);
						
		$of_options[] = array(
			"name"	=> __( 'Randomize Slideshow', 'wpex' ),
			"desc"	=> __( 'Do you wish to enable or disable random slide order.', 'wpex' ),
			"id"	=> "slider_randomize",
			"std"	=> '0',
			"on"	=> __( 'Enable', 'wpex' ),
			"off"	=> __( 'Disable', 'wpex' ),
			"type"	=> "switch"
		);
						
		$of_options[] = array(
			"name"	=> __( 'Slideshow Speed', 'wpex' ),
			"desc"	=> __( 'Adjust the slideshow speed of your homepage slider. Time in milliseconds', 'wpex' ),
			"id"	=> "slider_slideshow_speed",
			"std"	=> "7000",
			"min"	=> "2000",
			"step"	=> "500",
			"max"	=> "20000",
			"type"	=> "sliderui" ,
		);
					
		$of_options[] = array(
			"name"	=>  __( 'Slider Alternate', 'wpex' ),
			"desc"	=>  __( 'Use this field to insert a shortcode or other HTML to replace the default flexslider', 'wpex' ),
			"id"	=> "slider_alternative",
			"std"	=> "",
			"type"	=> "textarea",
		);
		
		
		// CAROUSEl SETTINGS	
		$of_options[] = array(
			"name"	=> "",
			"desc"	=> "",
			"id"	=> "subheading",
			"std"	=> "<h3 style=\"margin: 0;\">". __( 'Carousel', 'wpex' ) ."</h3>",
			"icon"	=> true,
			"type"	=> "info"
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Carousel Category', 'wpex' ),
			"desc"		=>  __( 'Select posts category for your homepage carousel. This category must have at least 3 or nothing will display.', 'wpex' ),
			"id"		=> "homepage_carousel_cat",
			"std"		=> "",
			"type"		=> "select",
			"options"	=> wpex_category_array(),
		);
		
		$of_options[] = array( 
			"name"		=>  __( 'Slides Count', 'wpex' ),
			"desc"		=>  __( 'How many slides do you wish to display for the homepage carousel?', 'wpex' ),
			"id"		=> "homepage_carousel_count",
			"std"		=> "6",
			"type"		=> "text",
		);
		
		$of_options[] = array(
			"name"	=> __( 'Exclude Carousel Category From Homepage?', 'wpex' ),
			"desc"	=> __( 'Do you wish to exclude the category for the carousel from the homepage recent posts area?', 'wpex' ),
			"id"	=> "homepage_carousel_cat_exclude",
			"std"	=> '0',
			"on"	=> __( 'Yes', 'wpex' ),
			"off"	=> __( 'No', 'wpex' ),
			"type"	=> "switch",
		);
			
		// BLOG SETTINGS	
		$of_options[] = array(
			"name"	=> __( 'Blog', 'wpex' ),
			"type"	=> "heading"
		);
		
		$of_options[] = array(
			"name"	=>  __( 'Pagination Style', 'wpex' ),
			"desc"	=>  __( 'What pagination style do you want for your homepage and archives', 'wpex' ),
			"id"	=> "pagination_style",
			"std"	=> "infinite_scroll",
			"type"	=> "select",
			"options"	=> array( 'infinite_scroll', 'load_more', 'standard' )
		);
		
		$of_options[] = array(
			"name"	=>  __( 'Excerpt Length', 'wpex' ),
			"desc"	=>  __( 'Enter a custom excerpt width. Default is 60 (words)', 'wpex' ),
			"id"	=> "excerpt_width",
			"std"	=> "",
			"type"	=> "text",
		);
		
		$of_options[] = array(
			'name'	=> __( 'Auto Excerpts', 'wpex' ),
			'desc'	=> __( 'Select to enable or disable auto excerpts.', 'wpex' ),
			'id'	=> 'auto_excerpts',
			"std"	=> '1',
				"on"	=> __( 'Enable', 'wpex' ),
				"off"	=> __( 'Disable', 'wpex' ),
				"type"	=> "switch"
		); 
			
		$of_options[] = array(
			'name'	=> __( 'Featured Images On Standard Format Posts?', 'wpex' ),
			'desc'	=> __( 'Display featured images on single blog posts?', 'wpex' ),
			'id'	=> 'blog_single_thumbnail',
			"std"	=> '1',
				"on"	=> __( 'Enable', 'wpex' ),
				"off"	=> __( 'Disable', 'wpex' ),
				"type"	=> "switch"
		);
			
		$of_options[] = array(
			'name'	=> __( 'Author Bio', 'wpex' ),
			'desc'	=> __( 'Display author bio at the bottom of standard posts?', 'wpex' ),
			'id'	=> 'blog_bio',
			"std"	=> '1',
				"on"	=> __( 'Enable', 'wpex' ),
				"off"	=> __( 'Disable', 'wpex' ),
				"type"	=> "switch"
			);
				
		$of_options[] = array(
			'name'	=> __( 'Display Tags', 'wpex' ),
			'desc'	=> __( 'Display current post tags at the bottom of standard posts?', 'wpex' ),
			'id'	=> 'blog_tags',
			"std"	=> '1',
				"on"	=> __( 'Enable', 'wpex' ),
				"off"	=> __( 'Disable', 'wpex' ),
				"type"	=> "switch"
		); 
			
		$of_options[] = array(
			'name'	=> __( 'Related Posts', 'wpex' ),
			'desc'	=> __( 'Display related posts on standard posts?', 'wpex' ),
			'id'	=> 'blog_related',
			"std"	=> '1',
				"on"	=> __( 'Enable', 'wpex' ),
				"off"	=> __( 'Disable', 'wpex' ),
				"type"	=> "switch"
		);
				
		
		// SOCIAL SETTINGS	
		$of_options[] = array(
			"name"	=> __( 'Social', 'wpex' ),
			"type"	=> "heading"
		);
		
		$of_options[] = array(
			"name"	=> __( 'Twitter', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "twitter",
			"std"	=> "#",
			"type"	=> "text"
		);
		
		$of_options[] = array(
			"name"	=> __( 'Facebook', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "facebook",
			"std"	=> "#",
			"type"	=> "text"
		);
		
		$of_options[] = array(
			"name"	=> __( 'Pinterest', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "pinterest",
			"std"	=> "#",
			"type"	=> "text"
		);
		
		$of_options[] = array(
			"name"	=> __( 'Dribbble', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "dribbble",
			"std"	=> "#",
			"type"	=> "text"
		);
		
		$of_options[] = array(
			"name"	=> __( 'Google Plus', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "googleplus",
			"std"	=> "#",
			"type"	=> "text"
		);
		
		$of_options[] = array(
			"name"	=> __( 'LinkedIn', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "linkedin",
			"std"	=> "#",
			"type"	=> "text"
		);
		
		$of_options[] = array(
			"name"	=> __( 'Flickr', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "flickr",
			"std"	=> "#",
			"type"	=> "text"
		);
		
		$of_options[] = array(
			"name"	=> __( 'Behance', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "behance",
			"std"	=> "#",
			"type"	=> "text"
		);
		
		$of_options[] = array(
			"name"	=> __( 'Vimeo', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "vimeo",
			"std"	=> "#",
			"type"	=> "text"
		);
		
		$of_options[] = array(
			"name"	=> __( 'Youtube', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "youtube",
			"std"	=> "#",
			"type"	=> "text"
		);
		
		$of_options[] = array(
			"name"	=> __( 'Forrst', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "forrst",
			"std"	=> "#",
			"type"	=> "text"
		);
		
		$of_options[] = array(
			"name"	=> __( 'Github', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "github",
			"std"	=> "#",
			"type"	=> "text"
		);
		
		$of_options[] = array(
			"name"	=> __( 'Instagram', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "instagram",
			"std"	=> "#",
			"type"	=> "text"
		);
		
		$of_options[] = array(
			"name"	=> __( 'RSS', 'wpex' ),
			"desc"	=> __( 'Enter the full URL to your social profile', 'wpex' ),
			"id"	=> "rss",
			"std"	=> "#",
			"type"	=> "text"
		);
		
					
	
		// FOOTER SETTINGS	
		$of_options[] = array(
			"name"	=> __( 'Footer', 'wpex' ),
			"type"	=> "heading"
		);
						
		$of_options[] = array(
			"name"	=> __( 'Copyright Text', 'wpex' ),
			"desc"	=> __( 'You can use the following shortcodes in your footer text: [wp-link] [theme-link] [loginout-link] [blog-title] [blog-link] [the-year]', 'wpex' ),
			"id"	=> "footer_text",
			"std"	=> "",
			"type"	=> "textarea",
		);
		
		
		// Tracking
		$of_options[] = array(
			"name"	=> __( 'Tracking', 'wpex' ),
			"type"	=> "heading"
		);
		$of_options[] = array(
			"name"	=>	__( 'Tracking Code', 'wpex' ),
			"desc"	=>	__( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'wpex' ),
			"id"	=>	"google_analytics",
			"std"	=>	"",
			"type"	=>	"textarea"
		);
				
					
		// BACKUP
		$of_options[] = array(
			"name"	=> __( 'Backup', 'wpex' ),
			"type"	=> "heading"
		);
					
		$of_options[] = array(
			"name"	=> __( 'Backup and Restore Options', 'wpex' ),
			"id"	=> "of_backup",
			"std"	=> "",
			"type"	=> "backup",
			"desc"	=> __( 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'wpex' ),
		);
						
		$of_options[] = array(
			"name"	=> __( 'Transfer Theme Options Data', 'wpex' ),
			"id"	=> "of_transfer",
			"std"	=> "",
			"type"	=> "transfer",
			"desc"	=> __( 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'wpex' ),
		);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>

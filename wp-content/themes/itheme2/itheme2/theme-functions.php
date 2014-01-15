<?php	

/*
To add custom PHP functions to the theme, create a new 'custom-functions.php' file in the theme folder. 
They will be added to the theme automatically.
*/

/* 	Enqueue Stylesheets and Scripts
/***************************************************************************/
add_action('wp_enqueue_scripts', 'themify_theme_enqueue_scripts');
function themify_theme_enqueue_scripts(){

	///////////////////
	//Enqueue styles
	///////////////////
	
	//Themify base styling
	wp_enqueue_style( 'themify-styles', get_bloginfo('stylesheet_url'));
	
	//Themify Media Queries CSS
	wp_enqueue_style( 'themify-media-queries', get_template_directory_uri() . '/media-queries.css');
	
	//User stylesheet
	if(is_file(TEMPLATEPATH . "/custom_style.css"))
		wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/custom_style.css');
	
	//prettyPhoto styles
	wp_enqueue_style( 'pretty-photo', get_template_directory_uri() . '/prettyPhoto.css');

	///////////////////
	//Enqueue scripts
	///////////////////
	
	//prettyPhoto, lightbox script
	wp_enqueue_script( 'pretty-photo', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), false, true );
	
	//Carousel script
	wp_enqueue_script( 'carousel', get_template_directory_uri() . '/js/carousel.min.js', array('jquery'), false, true );

	//Themify internal scripts
	wp_enqueue_script( 'theme-script',	get_template_directory_uri() . '/js/themify.script.js', array('jquery'), false, true );
	
	//WordPress internal script to move the comment box to the right place when replying to a user
	if ( is_single() || is_page() ) wp_enqueue_script( 'comment-reply' );
	
}

/**
 * Add JavaScript files if IE version is lower than 9
 * @package themify
 */
function themify_ie_enhancements(){
	echo '
<!-- media-queries.js -->
<!--[if lt IE 9]>
	<script src="' . get_template_directory_uri() . '/js/respond.js"></script>
<![endif]-->';
}
add_action( 'wp_head', 'themify_ie_enhancements' );

/**
 * Add viewport tag for responsive layouts
 * @package themify
 */
function themify_viewport_tag(){
	echo '<meta name="viewport" content="width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;">';
}
add_action( 'wp_head', 'themify_viewport_tag' );

/* 	Custom Write Panels
/***************************************************************************/

	///////////////////////////////////////
	// Setup Write Panel Options
	///////////////////////////////////////
	
	// Post Meta Box Options
	$post_meta_box_options = array(
	// Layout
	array(
		  "name" 		=> "layout",	
		  "title" 		=> __('单一布局', 'themify'), 	
		  "description" => "", 				
		  "type" 		=> "layout",			
		  "meta"		=> array(
		  						array("value" => "default", "img" => "images/layout-icons/default.png", "selected" => true),

								 array("value" => "sidebar1", 	"img" => "images/layout-icons/sidebar1.png"),
								 array("value" => "sidebar1 sidebar-left", 	"img" => "images/layout-icons/sidebar1-left.png"),
								 array("value" => "sidebar-none",	 	"img" => "images/layout-icons/sidebar-none.png")
								 )			
		),
   	// Post Image
	array(
		  "name" 		=> "post_image",
		  "title" 		=> __('特色图片', 'themify'),
		  "description" => '',
		  "type" 		=> "image",
		  "meta"		=> array()
		),
   	// Featured Image Size
	array(
		'name'	=>	'feature_size',
		'title'	=>	__('图片尺寸', 'themify'),
		'description' => __('图片尺寸可以在 <a href="options-media.php">媒体设置</a>和<a href="admin.php?page=regenerate-thumbnails">Regenerated</a>设置', 'themify'),
		'type'		 =>	'featimgdropdown'
		),
	// Image Width
	array(
		  "name" 		=> "image_width",	
		  "title" 		=> __('图片宽度', 'themify'), 
		  "description" => "", 				
		  "type" 		=> "textbox",			
		  "meta"		=> array("size"=>"small")			
		),
	// Image Height
	array(
		  "name" 		=> "image_height",	
		  "title" 		=> __('图片高度', 'themify'), 
		  "description" => "", 				
		  "type" 		=> "textbox",			
		  "meta"		=> array("size"=>"small")			
		),
	// Hide Post Title
	array(
		  "name" 		=> "hide_post_title",	
		  "title" 		=> __('隐藏文章标题', 'themify'), 	
		  "description" => "", 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )			
		),
	// Unlink Post Title
	array(
		  "name" 		=> "unlink_post_title",	
		  "title" 		=> __('取消文章标题链接', 'themify'), 	
		  "description" => __('取消文章标题链接 (显示文章标题，但是标题没有链接)', 'themify'), 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )			
		),

	// Hide Post Meta
	array(
		  "name" 		=> "hide_post_meta",	
		  "title" 		=> __('隐藏文章Meta', 'themify'), 	
		  "description" => "", 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )			
		),
	// Hide Post Date
	array(
		  "name" 		=> "hide_post_date",	
		  "title" 		=> __('隐藏文章日期', 'themify'), 	
		  "description" => "", 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )			
		),
	// Hide Post Image
	array(
		  "name" 		=> "hide_post_image",	
		  "title" 		=> __('隐藏特色图片', 'themify'), 	
		  "description" => "", 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )			
		),
		// Unlink Post Image
	array(
		  "name" 		=> "unlink_post_image",	
		  "title" 		=> __('取消特色图片链接', 'themify'), 	
		  "description" => __('显示没有链接的特色图片', 'themify'), 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )			
		),
	// External Link
	array(
		  "name" 		=> "external_link",	
		  "title" 		=> __('外部链接', 'themify'), 	
		  "description" => __('外部URL链接特色图片', 'themify'), 				
		  "type" 		=> "textbox",			
		  "meta"		=> array()			
		)
	);
								
	
	// Page Meta Box Options
	$page_meta_box_options = array(
  	// Page Layout
	array(
		  "name" 		=> "page_layout",
		  "title"		=> __('边栏选项', 'themify'),
		  "description"	=> "",
		  "type"		=> "layout",
		  "meta"		=> array(
		  						array("value" => "default", "img" => "images/layout-icons/default.png", "selected" => true),
								
								 array("value" => "sidebar1", 	"img" => "images/layout-icons/sidebar1.png"),
								 array("value" => "sidebar1 sidebar-left", 	"img" => "images/layout-icons/sidebar1-left.png"),
								 array("value" => "sidebar-none",	 	"img" => "images/layout-icons/sidebar-none.png")
								 )
		),
	// Featured Image Size
	array(
		  'name'	=>	'feature_size_page',
		  'title'	=>	__('图片尺寸', 'themify'),
		  'description' => __('图片尺寸可以在 <a href="options-media.php">媒体设置</a> 和 <a href="admin.php?page=regenerate-thumbnails">Regenerated</a>设置', 'themify'),
		  'type'		 =>	'featimgdropdown'
		),
	// Image Width
	array(
		  "name" 		=> "image_width",	
		  "title" 		=> __('图片宽度', 'themify'), 
		  "description" => "", 				
		  "type" 		=> "textbox",			
		  "meta"		=> array("size"=>"small")			
		),
	// Image Height
	array(
		  "name" 		=> "image_height",	
		  "title" 		=> __('图片高度', 'themify'), 
		  "description" => "", 				
		  "type" 		=> "textbox",			
		  "meta"		=> array("size"=>"small")			
		),
	// Hide page title
	array(
		  "name" 		=> "hide_page_title",
		  "title"		=> __('隐藏页面标题', 'themify'),
		  "description"	=> "",
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )	
		),
   // Query Category
	array(
		  "name" 		=> "query_category",
		  "title"		=> __('查询类别', 'themify'),
		  "description"	=> __('选择一个类别，或输入多个类别ID（如2,5,6）。输入0来显示所有类别。', 'themify'),
		  "type"		=> "query_category",
		  "meta"		=> array()
		),
	// Section Categories
	array(
		  "name" 		=> "section_categories",	
		  "title" 		=> __('部分分类', 'themify'), 	
		  "description" => __('分别显示多个查询类别', 'themify'), 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )			
		),
	// Post Layout
	array(
		  "name" 		=> "layout",
		  "title"		=> __('查询文章布局', 'themify'),
		  "description"	=> "",
		  "type"		=> "layout",
		  "meta"		=> array(
								 array("value" => "list-post", "img" => "images/layout-icons/list-post.png", "selected" => true),
								 array("value" => "grid4", "img" => "images/layout-icons/grid4.png"),
								 array("value" => "grid3", "img" => "images/layout-icons/grid3.png"),
								 array("value" => "grid2", "img" => "images/layout-icons/grid2.png"),
								 array("value" => "list-large-image", "img" => "images/layout-icons/list-large-image.png"),
								 array("value" => "list-thumb-image", "img" => "images/layout-icons/list-thumb-image.png"),
								 array("value" => "grid2-thumb", "img" => "images/layout-icons/grid2-thumb.png")
								 )
		),
	// Posts Per Page
	array(
		  "name" 		=> "posts_per_page",
		  "title"		=> __('每页文章数', 'themify'),
		  "description"	=> "",
		  "type"		=> "textbox",
		  "meta"		=> array("size" => "small")
		),
	
	// Display Content
	array(
		  "name" 		=> "display_content",
		  "title"		=> __('显示内容', 'themify'),
		  "description"	=> "",
		  "type"		=> "dropdown",
		  "meta"		=> array(
								 array('name' => __('全部内容', 'themify'),"value"=>"content","selected"=>true),
		  						 array('name' => __('片段', 'themify'),"value"=>"excerpt"),
								 array('name' => __('无', 'themify'),"value"=>"none")
								 )
		),
	// Hide Title
	array(
		  "name" 		=> "hide_title",
		  "title"		=> __('隐藏文章标题', 'themify'),
		  "description"	=> "",
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )
		),
	// Unlink Post Title
	array(
		  "name" 		=> "unlink_title",	
		  "title" 		=> __('除去文章标题链接', 'themify'), 	
		  "description" => __('除去文章标题链接(显示没有链接的文章标题)', 'themify'), 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )			
		),
	// Hide Post Date
	array(
		  "name" 		=> "hide_date",
		  "title"		=> __('隐藏文章日期', 'themify'),
		  "description"	=> "",
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )
		),
	// Hide Post Meta
	array(
		  "name" 		=> "hide_meta",
		  "title"		=> __('隐藏文章Meta', 'themify'),
		  "description"	=> "",
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )
		),
	// Hide Post Image
	array(
		  "name" 		=> "hide_image",	
		  "title" 		=> __('隐藏特色图片', 'themify'), 	
		  "description" => "", 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )			
		),
	// Unlink Post Image
	array(
		  "name" 		=> "unlink_image",	
		  "title" 		=> __('除去特色图片链接', 'themify'), 	
		  "description" => __('显示没有链接的特色图片)', 'themify'), 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )			
		),
	// Page Navigation Visibility
	array(
		  "name" 		=> "hide_navigation",
		  "title"		=> __('隐藏页面导航', 'themify'),
		  "description"	=> "",
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),

								 array("value" => "yes", 'name' => __('是', 'themify')),
								 array("value" => "no",	'name' => __('否', 'themify'))
								 )
		)
	
	);
								 
	///////////////////////////////////////
	// Build Write Panels
	///////////////////////////////////////
	themify_build_write_panels(array(
				array(
					 "name"		=> __('文章选项', 'themify'),			// Name displayed in box
					 "options"	=> $post_meta_box_options, 	// Field options
					 "pages"	=> "post"					// Pages to show write panel
					 ),
				array(
					 "name"		=> __('页面选项', 'themify'),	
					 "options"	=> $page_meta_box_options, 		
					 "pages"	=> "page"
					 )
				)
			);
	
/* 	Custom Functions
/***************************************************************************/

	///////////////////////////////////////
	// Enable WordPress feature image
	///////////////////////////////////////
	add_theme_support( 'post-thumbnails');

	///////////////////////////////////////
	// Add wmode transparent and post-video container for responsive purpose
	///////////////////////////////////////	
	function themify_add_video_wmode_transparent($html, $url, $attr) {
		$services = array(
			'youtube.com',
			'youtu.be',
			'blip.tv',
			'vimeo.com',
			'dailymotion.com',
			'hulu.com',
			'viddler.com',
			'qik.com',
			'revision3.com',
			'wordpress.tv',
			'wordpress.com',
			'funnyordie.com'
		);
		$video_embed = false;
		foreach( $services as $service ){
			if(stripos($html, $service)){
				$video_embed = true;
				break;
			}
		}
		if( $video_embed ){
			$html = '<div class="post-video">' . $html . '</div>';
			if (strpos($html, "<embed src=" ) !== false) {
				$html = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed wmode="transparent" ', $html);
				return $html;
			}
			else {
				if(strpos($html, "wmode=transparent") == false){
					if(strpos($html, "?fs=" ) !== false){
						$search = array('?fs=1', '?fs=0');
						$replace = array('?fs=1&wmode=transparent', '?fs=0&wmode=transparent');
						$html = str_replace($search, $replace, $html);
						return $html;
					}
					else{
						$youtube_embed_code = $html;
						$patterns[] = '/youtube.com\/embed\/([a-zA-Z0-9._-]+)/';
						$replacements[] = 'youtube.com/embed/$1?wmode=transparent';
						return preg_replace($patterns, $replacements, $html);
					}
				}
				else{
					return $html;
				}
			}
		} else {
			return '<div class="post-embed">' . $html . '</div>';
		}
	}
	add_filter('embed_oembed_html', 'themify_add_video_wmode_transparent');
	
	///////////////////////////////////////
	// Adds a rel="prettyPhoto" tag to all linked image files
	///////////////////////////////////////
	add_filter('the_content', 'addlightboxrel_replace', 12);
	add_filter('the_excerpt', 'addlightboxrel_replace');
	add_filter('widget_text', 'addlightboxrel_replace');
	add_filter('get_comment_text', 'addlightboxrel_replace');
	function addlightboxrel_replace ($content)
	{   global $post;
		$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
		$replacement = '<a$1href=$2$3.$4$5 rel="prettyPhoto['.$post->ID.']"$6>$7</a>';
		$content = preg_replace($pattern, $replacement, $content);
		return $content;
	}
	
	// Register Custom Menu Function
	function register_custom_nav() {
		if (function_exists('register_nav_menus')) {
			register_nav_menus( array(
				'main-nav' => __( '主导航', 'themify' ),
				'footer-nav' => __( '底部导航', 'themify' ),
			) );
		}
	}
	
	// Register Custom Menu Function - Action
	add_action('init', 'register_custom_nav');
	
	// Default Main Nav Function
	function default_main_nav() {
		echo '<ul id="main-nav" class="main-nav clearfix">';
		wp_list_pages('title_li=');
		echo '</ul>';
	}

	// Add home link to menus
	function new_nav_menu_items($items) {
		$homelink = '<li class="home"><a href="' . home_url( '/' ) . '">' . __('首页', 'themify') . '</a></li>';
		$items = $homelink . $items;
		return $items;
	}
	add_filter( 'wp_nav_menu_items', 'new_nav_menu_items' );
	add_filter( 'wp_list_pages', 'new_nav_menu_items' );


	// Register Widgets
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => 'Sidebar',
			'before_widget' => '<div class="widgetwrap"><div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => 'Social_Widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<strong class="widgettitle">',
			'after_title' => '</strong>',
		));
		register_sidebar(array(
			'name' => 'Header_Widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<strong class="widgettitle">',
			'after_title' => '</strong>',
		));
	}

	// Footer Widgets
	if ( function_exists('register_sidebar') ) {
		$data = get_data();
		$columns = array('footerwidget-4col' 			=> 4,
						 'footerwidget-3col'			=> 3,
						 'footerwidget-2col' 			=> 2,
						 'footerwidget-1col' 			=> 1,
						 'none'			 			=> 0, );
		$option = ($data['setting-footer_widgets'] == "" || !isset($data['setting-footer_widgets'])) ?  "footerwidget-3col" : $data['setting-footer_widgets'];
		for($x=1;$x<=$columns[$option];$x++){
			register_sidebar(array(
				'name' => 'Footer_Widget_'.$x,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widgettitle">',
				'after_title' => '</h4>',
			));			
		}
	}
	
	// Custom Theme Comment
	function custom_theme_comment($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; 
	   ?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<p class="comment-author">
				<?php echo get_avatar($comment,$size='36'); ?>
				<?php printf('<cite>%s</cite>', get_comment_author_link()) ?><br />
				<small class="comment-time"><strong><?php comment_date('M d, Y'); ?></strong> @ <?php comment_time('H:i:s'); ?><?php edit_comment_link( __('编辑', 'themify'),' [',']') ?></small>
			</p>
			<div class="commententry">
				<?php if ($comment->comment_approved == '0') : ?>
				<p><em><?php _e('你的评论正等待审核。', 'themify') ?></em></p>
				<?php endif; ?>
			
				<?php comment_text() ?>
			</div>
			<p class="reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'comment', 'reply_text' => __('回复', 'themify'), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
		<?php
	}

?>
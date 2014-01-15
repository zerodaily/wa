<?php

/**

 * Bootstrap file for getting the ABSPATH constant to wp-load.php

 * This is requried when a plugin requires access not via the admin screen.

 *

 * If the wp-load.php file is not found, then an error will be displayed

 *

 * @package themify

 * @since 1.1.1.0

 * @author Elio Rivero

 */



if ( !defined('WP_LOAD_PATH') ) {



	$fullpath = explode( 'wp-content', __FILE__ );

	

	$wploadpath = $fullpath[0];

	

	//$wploadpath = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/' ;

	if (file_exists( $wploadpath . 'wp-load.php') )

		define( 'WP_LOAD_PATH', $wploadpath);

}



// let's load WordPress

require_once( WP_LOAD_PATH . 'wp-load.php');



global $wpdb;



load_theme_textdomain( 'themify', TEMPLATEPATH.'/languages' );



// check for rights

if ( !is_user_logged_in() || !current_user_can('edit_posts') )

	wp_die(__('你不能在这里', 'themify'));



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<title><?php echo $_GET['title'] . ' ' . __('段代码选项', 'themify'); ?></title>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		

		<link href="<?php echo admin_url( '/css/colors-fresh.css'); ?>"  rel="stylesheet" />

		<style type="text/css">

		#shortcode-options{

			font-family: Arial, sans-serif;

		}

		#shortcode-options select{

			height: 30px;

		}

		#shortcode-options p{

			margin-bottom: 5px;

		}

		#shortcode-options .label-inner{

			margin-bottom: 5px;

			display: block;

			cursor: pointer;

			font-size: 12px;

		}

		#shortcode-options .description{

			margin-bottom: 10px;

		}

		</style>

		<script src="<?php	echo includes_url( '/js/jquery/jquery.js'); ?>"	language="javascript" type="text/javascript" ></script>

		<script src="<?php	echo includes_url( '/js/tinymce/tiny_mce_popup.js');   ?>"	language="javascript" type="text/javascript" ></script>

		<script src="<?php	echo includes_url( '/js/tinymce/utils/form_utils.js'); ?>"	language="javascript" type="text/javascript" ></script>

		<script language="javascript" type="text/javascript">

		function init() {

			tinyMCEPopup.resizeToInnerSize();

		}

		function themifyRepaint(sc_content){

			if(window.tinyMCE) {

				window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, '<p>'+sc_content+'</p>');

				tinyMCEPopup.editor.execCommand('mceRepaint');

				tinyMCEPopup.close();

			}

		}

		</script>

		<base target="_self" />

	</head>

	<body id="wp-admin" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" style="display: none">

		

		<script language="javascript" type="text/javascript">

		var shortcode_type = '<?php echo $_GET['shortcode'] ?>';

		<?php

		if( isset($_GET['selection']) )

			echo "var selection = '" . $_GET['selection'] . "';";

		?>

		function themify_scparams(scparams, sctype, allowempty){

			var sccontent = '';

			jQuery.each(scparams, function(index, v){

				if( '' != jQuery('#' + v + '_' + sctype).val() )

					sccontent += v + "=\"" + jQuery('#' + v + '_' + sctype).val() + "\" ";

			});

			if( '' != sccontent || undefined != allowempty )

				return sccontent;

			else

				tinyMCEPopup.close();

		}

		function themify_insert_shortcode(type) {

			var sc_content = '';

			

			switch(type){

				case 'video':

					sc_content = '[' + type + ' ' + themify_scparams(Array('src', 'width', 'height'), type) + ']';

				break;

				

				case 'img':

					sc_content = '[' + type + ' ' + themify_scparams(Array('src', 'w', 'h'), type) + ']';

				break;

				

				case 'button':

					sc_content = '[' + type + ' ' + themify_scparams(Array('style', 'color', 'link', 'text', 'target'), type, true) + ']'

					+ jQuery('#label' + '_' + type).val() + '[/' + type + ']';

				break;

				

				case 'hr':

					sc_content = '[' + type + ' ' + themify_scparams(Array('color', 'width', 'border_width'), type) + ']';

				break;

				

				case 'box':

					sc_content = '[' + type + ' ' + themify_scparams(Array('style'), type, true) + ']' + selection + '[/' + type + ']';

				break;

				

				case 'map':

					sc_content = '[' + type + ' ' + themify_scparams(Array('address', 'width', 'height', 'zoom'), type) + ']';

				break;

				

				case 'author_box':

					sc_content = '[' + type + ' ' + themify_scparams(Array('avatar', 'avatar_size', 'style', 'author_link'), type) + ']';

				break;

				

				case 'flickr':

					sc_content = '[' + type + ' ' + themify_scparams(Array('user', 'set', 'group', 'limit', 'size', 'display'), type) + ']';

				break;

				

				case 'post_slider':

					sc_content = '[' + type + ' ' + themify_scparams( Array( 'limit', 'category', 'image', 'image_w', 'image_h', 'post_meta', 'more_text', 'visible', 'scroll', 'auto', 'wrap', 'speed', 'slider_nav', 'width', 'height', 'class', 'image_size' ), type ) + ']';

				break;

				

				case 'list_posts':

					sc_content = '[' + type + ' ' + themify_scparams(Array('limit', 'category', 'image', 'image_w', 'image_h', 'post_meta', 'more_text', 'post_date', 'style', 'image_size'), type) + ']';

				break;

				

				case 'slider':

					sc_content = '[' + type + ' ' + themify_scparams(Array( 'visible', 'scroll', 'auto', 'wrap', 'speed', 'slider_nav', 'class'), type, true) + ']' + selection + '[/' + type + ']';

				break;

			}

			

			themifyRepaint( '<p>' + sc_content + '</p>');

			

			return;

		}

		</script>

		

		<form name="shortcode-options" id='shortcode-options' action="#">

			<div class="panel current" style="margin-bottom: 0px;">

			<?php

			switch( $_GET['shortcode'] ){

				case 'video':

					$fields = array(

						array(

							'id' => 'src_video',

							'type' => 'text',

							'value' => 'http://',

							'label' => __('输入视频地址:', 'themify')

						),

						array(

							'id' => 'width_video',

							'type' => 'text',

							'label' => __('视频宽度 (in px or %):', 'themify'),

							'help' => __('例如: 400px or 94%.', 'themify')

						),

						array(

							'id' => 'height_video',

							'type' => 'text',

							'label' => __('视频高度 (in px or %):', 'themify'),

							'help' => __('例如: 400px or 94%.', 'themify')

						)

					);

					break;

				case 'img':

					$fields = array(

						array(

							'id' => 'src_img',

							'type' => 'text',

							'value' => 'http://',

							'label' => __('原始图片地址:', 'themify')

						),

						array(

							'id' => 'w_img',

							'type' => 'text',

							'label' => __('图片宽度 (in px):', 'themify'),

							'help' => __('例如: 300px.', 'themify')

						),

						array(

							'id' => 'h_img',

							'type' => 'text',

							'label' => __('图片高度 (in px):', 'themify'),

							'help' => __('例如: 300px.', 'themify')

						)

					);

					break;

				case 'button':

					$fields = array(

						array(

							'id' => 'label_button',

							'type' => 'text',

							'label' => __('按钮文本:', 'themify')

						),

						array(

							'id' => 'style_button',

							'type' => 'text',

							'label' => __('按钮样式:', 'themify'),

							'help' => __('您可以结合 (eg "large yellow rounded")如下设置:', 'themify')

							. '<br/><ul><li>'

							. __('可用颜色: yellow, orange, blue, green, red, black, purple, gray, light-yellow, light-blue, light-green, pink, lavender', 'themify') . '</li>'

							. '<li>' .

							__('可用尺寸: small, large, xlarge', 'themify') . '</li>'

							. '<li>' .

							__('可用样式: flat, rect, rounded, embossed', 'themify') . '</li>'

							. '</ul>' . __('例如: ') . 'large red rounded'

						),

						array(

							'id' => 'color_button',

							'type' => 'text',

							'label' => __('自定义背景颜色:', 'themify'),

							'help' => __('输入颜色的十六进制格式. 例如, #ddd.', 'themify')

						),

						array(

							'id' => 'link_button',

							'type' => 'text',

							'value' => 'http://',

							'label' => __('按钮链接:', 'themify')

						),

						array(

							'id' => 'text_button',

							'type' => 'text',

							'label' => __('自定义按钮文字颜色:', 'themify'),

							'help' => __('输入颜色的十六进制格式.输入颜色的十六进制格式. 例如, #000.', 'themify')

						),

						array(

							'id' => 'target_button',

							'type' => 'text',

							'label' => __('链接目标:', 'themify'),

							'help' => sprintf( __('输入 %s 将在新窗口打开 (留空为默认).', 'themify'), '<strong>_blank</strong>')

						)

					);

					break;

				case 'hr':

					$fields = array(

						array(

							'id' => 'color_hr',

							'type' => 'text',

							'label' => __('Rule颜色:', 'themify'),

							'help' => __('例如: pink, red, light-gray, dark-gray, black, orange, yellow, white.', 'themify')

						),

						array(

							'id' => 'width_hr',

							'type' => 'text',

							'label' => __('水平宽度 (in px or %):', 'themify'),

							'help' => __('例如: 50px or 50%.', 'themify')

						),

						array(

							'id' => 'border_width_hr',

							'type' => 'text',

							'label' => __('边框宽度 (in px):', 'themify'),

							'help' => __('例如: 1px.', 'themify')

						)

					);

					break;

				case 'box':

					$fields = array(

						array(

							'id' => 'style_box',

							'type' => 'text',

							'label' => __('Box样式:', 'themify'),

							'help' => __('您可以结合（例如："yellow map rounded"）下列选项:', 'themify')

							. '<br/><ul><li>'

							. __('可用颜色: blue, green, red, purple, yellow, orange, pink, lavender, gray, black, light-yellow, light-blue, light-green', 'themify') . '</li>'

							. '<li>' .

							__('可用icons: announcement, comment, question, upload, download, highlight, map, warning, info, note, contact', 'themify') . '</li>'

							. '<li>' .

							__('可用样式: rounded, shadow', 'themify') . '</li>'

							. '</ul>'

						)

					);

					break;

				case 'map':

					$fields = array(

						array(

							'id' => 'address_map',

							'type' => 'text',

							'label' => __('联系地址:', 'themify'),

							'help' => __('例如: 238 Street Ave., Toronto, Ontario, Canada')

						),

						array(

							'id' => 'width_map',

							'type' => 'text',

							'label' => __('地图宽度 (in px or %):', 'themify'),

							'help' => __('例如: 400px or 94%.', 'themify')

						),

						array(

							'id' => 'height_map',

							'type' => 'text',

							'label' => __('地图高度 (in px or %):', 'themify'),

							'help' => __('例如: 400px or 94%.', 'themify')

						),

						array(

							'id' => 'zoom_map',

							'type' => 'selectbasic',

							'options' => array( '1', '2', '3', '4', '5', '6', '7', '8' ),

							'label' => __('地图缩放级别:', 'themify'),

							'help' => __('默认 = 8', 'themify')

						)

					);

					break;

				case 'author_box':

					$fields = array(

						array(

							'id' => 'avatar_author_box',

							'type' => 'select',

							'options' => array(

								__('是', 'themify') => 'yes',

								__('否', 'themify') => 'no'

							),

							'label' => __('作者简介的头像:', 'themify'),

							'help' => __('默认 = yes')

						),

						array(

							'id' => 'avatar_size_author_box',

							'type' => 'text',

							'label' => __('头像图片大小:', 'themify'),

							'help' => __('默认 = 48.', 'themify')

						),

						array(

							'id' => 'style_author_box',

							'type' => 'text',

							'label' => __('作者 box 样式:', 'themify'),

							'help' => __('您可以结合（例如 "yellow rounded"）下列选项：', 'themify')

							. '<br/><ul><li>'

							. __('可用颜色: blue, green, red, purple, yellow, orange, pink, lavender, gray, black, light-yellow, light-blue, light-green', 'themify') . '</li>'

							. '<li>' .

							__('可用 icons: announcement, comment, question, upload, download, highlight, map, warning, info, note, contact', 'themify') . '</li>'

							. '<li>' .

							__('请注意，您还可以添加自定义CSS类(eg. "yellow custom-class")', 'themify') . '</li>'

							. '</ul>'

						),

						array(

							'id' => 'author_link_author_box',

							'type' => 'select',

							'options' => array(

								__('是', 'themify') => 'yes',

								__('否', 'themify') => 'no'

							),

							'label' => __('只看该作者个人资料链接:', 'themify'),

							'help' => __('默认 = no', 'themify')

						)

					);

					break;

				case 'flickr':

					$fields = array(

						array(

							'id' => 'user_flickr',

							'type' => 'text',

							'label' => __('Flickr ID:', 'themify'),

							'help' => sprintf( __('例如: 52839779@N02. Use %s to find your user ID', 'themify'), '<a href="http://idgettr.com/" target="_blank">idGettr.com</a>' )

						),

						array(

							'id' => 'set_flickr',

							'type' => 'text',

							'label' => __('Flickr Set ID:', 'themify')

						),

						array(

							'id' => 'group_flickr',

							'type' => 'text',

							'label' => __('Flickr Group ID:', 'themify')

						),

						array(

							'id' => 'limit_flickr',

							'type' => 'selectbasic',

							'options' => array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10' ),

							'label' => __('显示的项目数:', 'themify'),

							'help' => __('默认 = 8.', 'themify')

						),

						array(

							'id' => 'size_flickr',

							'type' => 'selectbasic',

							'options' => array(	's', 't', 'm' ),

							'label' => __('照片尺寸:', 'themify'),

							'help' => __('输入 s, t 或 m. 默认 = s.', 'themify')

						),

						array(

							'id' => 'display_flickr',

							'type' => 'select',

							'options' => array(

								__('最新', 'themify') => 'latest',

								__('随机', 'themify') => 'random',

							),

							'label' => __('显示:', 'themify'),

							'help' => __('显示最新的照片或随机的（默认值=最新）', 'themify')

						)

					);

					break;

				case 'post_slider':

					$fields = array(

						array(

							'id' => 'limit_post_slider',

							'type' => 'text',

							'label' => __('文章发表数:', 'themify'),

							'help' => __('默认= 5', 'themify')

						),

						array(

							'id' => 'category_post_slider',

							'type' => 'text',

							'label' => __('Categories to include', 'themify'),

							'help' => __('输入分类id (eg. 2,5,6)或留空(全部分类).使用减号编号，以排除类 (eg. category=-1 will exclude category 1).', 'themify')

						),

						array(

							'id' => 'image_post_slider',

							'type' => 'select',

							'options' => array(

								__('是', 'themify') => 'yes',

								__('否', 'themify') => 'no'

							),

							'label' => __('显示文章图片:', 'themify'),

							'help' => __('默认 = yes', 'themify')

						),

						array(

							'id' => 'image_w_post_slider',

							'type' => 'text',

							'label' => __('文章图片宽度:', 'themify'),

							'help' => __('例如: 400px or 94%.', 'themify')

						),

						array(

							'id' => 'image_h_post_slider',

							'type' => 'text',

							'label' => __('文章图片高度:', 'themify'),

							'help' => __('例如: 400px or 94%.', 'themify')

						),

						array(

							'id' => 'image_size_post_slider',

							'type' => 'select',

							'options' => array(

								__('缩略图l', 'themify') => 'thumbnail',

								__('中', 'themify') => 'medium',

								__('大', 'themify') => 'large',

								__('原始', 'themify') => 'full'

							),

							'label' => __('文章图片大小:', 'themify'),

							'help' => __('如果您已禁用 img.php', 'themify')

						),

						array(

							'id' => 'title_post_slider',

							'type' => 'select',

							'options' => array(

								__('是', 'themify') => 'yes',

								__('否', 'themify') => 'no',

							),

							'label' => __('显示文章标题:', 'themify'),

							'help' => __('默认 = yes', 'themify')

						),

						array(

							'id' => 'display_post_slider',

							'type' => 'select',

							'options' => array(

								__('内容', 'themify') => 'yes',

								__('摘要', 'themify') => 'no'

							),

							'label' => __('显示文章文本:', 'themify'),

							'help' => __('默认= none, 无论是内容或摘录.', 'themify')

						),

						array(

							'id' => 'post_meta_post_slider',

							'type' => 'select',

							'options' => array(

								__('是', 'themify') => 'yes',

								__('否', 'themify') => 'no'

							),

							'label' => __('显示文章Meta:', 'themify'),

							'help' => __('默认 = no.', 'themify')

						),

						array(

							'id' => 'more_text_post_slider',

							'type' => 'text',

							'label' => __('更多内容:', 'themify'),

							'help' => __('仅当显示=内容和文章有更多的标签.', 'themify')

						),

						array(

							'id' => 'visible_post_slider',

							'type' => 'text',

							'label' => __('同时可见的文章数:', 'themify'),

							'help' => __('默认= 1.', 'themify')

						),

						array(

							'id' => 'scroll_post_slider',

							'type' => 'text',

							'label' => __('项目数滚动:', 'themify'),

							'help' => __('默认= 1.', 'themify')

						),

						array(

							'id' => 'auto_post_slider',

							'type' => 'text',

							'label' => __('自动播放滑块的秒数:', 'themify'),

							'help' => __('默认= 0, 滑块不会自动播放.', 'themify')

						),

						array(

							'id' => 'wrap_post_slider',

							'type' => 'select',

							'options' => array(

								__('是', 'themify') => 'yes',

								__('否', 'themify') => 'no'

							),

							'label' => __('包装滑块文章:', 'themify'),

							'help' => __('默认 = yes,滑块将环回的第一个项目', 'themify')

						),

						array(

							'id' => 'speed_post_slider',

							'type' => 'select',

							'options' => array(

								__('一般', 'themify') => 'normal',

								__('慢', 'themify') => 'slow',

								__('快', 'themify') => 'fast'

							),

							'label' => __('动画速度:', 'themify')

						),

						array(

							'id' => 'slider_nav_post_slider',

							'type' => 'select',

							'options' => array(

								__('是', 'themify') => 'yes',

								__('否', 'themify') => 'no'

							),

							'label' => __('显示滑块导航:', 'themify'),

							'help' => __('默认= yes.', 'themify')

						),

						array(

							'id' => 'width_post_slider',

							'type' => 'text',

							'label' => __('滑块div标签宽度:', 'themify')

						),

						array(

							'id' => 'height_post_slider',

							'type' => 'text',

							'label' => __('滑块div标签高度:', 'themify')

						),

						array(

							'id' => 'class_post_slider',

							'type' => 'text',

							'label' => __('自定义css类名:', 'themify')

						)

					);

					break;

				case 'list_posts':

					$fields = array(

						array(

							'id' => 'limit_list_posts',

							'type' => 'text',

							'label' => __('文章发表数:', 'themify'),

							'help' => __('默认= 5', 'themify')

						),

						array(

							'id' => 'category_list_posts',

							'type' => 'text',

							'label' => __('包含分类', 'themify'),

							'help' => __('输入分类id (eg. 2,5,6)或留空(全部分类)使用减号编号，以排除类(eg. category=-1 will exclude category 1).', 'themify')

						),

						array(

							'id' => 'image_list_posts',

							'type' => 'select',

							'options' => array(

								__('是', 'themify') => 'yes',

								__('否', 'themify') => 'no'

							),

							'label' => __('系那是文章图片:', 'themify'),

							'help' => __('默认 = yes', 'themify')

						),

						array(

							'id' => 'image_w_list_posts',

							'type' => 'text',

							'label' => __('文章图片宽度:', 'themify'),

							'help' => __('例如: 400px or 94%.', 'themify')

						),

						array(

							'id' => 'image_h_list_posts',

							'type' => 'text',

							'label' => __('文章图片高度:', 'themify'),

							'help' => __('例如: 400px or 94%.', 'themify')

						),

						array(

							'id' => 'image_size_list_posts',

							'type' => 'select',

							'options' => array(

								__('缩略图', 'themify') => 'thumbnail',

								__('中', 'themify') => 'medium',

								__('大', 'themify') => 'large',

								__('原始', 'themify') => 'full'

							),

							'label' => __('文章图片大小:', 'themify'),

							'help' => __('如果您已禁用 img.php', 'themify')

						),

						array(

							'id' => 'title_list_posts',

							'type' => 'select',

							'options' => array(

								__('是', 'themify') => 'yes',

								__('否', 'themify') => 'no'

							),

							'label' => __('显示文章标题:', 'themify'),

							'help' => __('默认 = yes', 'themify')

						),

						array(

							'id' => 'display_list_posts',

							'type' => 'select',

							'options' => array(

								__('内容', 'themify') => 'yes',

								__('摘要', 'themify') => 'no'

							),

							'label' => __('显示文章文本:', 'themify'),

							'help' => __('默认 = none, 无论是内容或摘录.', 'themify')

						),

						array(

							'id' => 'post_meta_list_posts',

							'type' => 'select',

							'options' => array(

								__('是', 'themify') => 'yes',

								__('否', 'themify') => 'no'

							),

							'label' => __('显示文章Meta:', 'themify'),

							'help' => __('默认 = no.', 'themify')

						),

						array(

							'id' => 'more_text_list_posts',

							'type' => 'text',

							'label' => __('更多内容:', 'themify'),

							'help' => __('仅当显示=内容和文章有更多的标签.', 'themify')

						),

						array(

							'id' => 'post_date_list_posts',

							'type' => 'select',

							'options' => array(

								__('是', 'themify') => 'yes',

								__('否', 'themify') => 'no'

							),

							'label' => __('显示文章日期:', 'themify'),

							'help' => __('默认 = no.', 'themify')

						),

						array(

							'id' => 'style_list_posts',

							'type' => 'select',

							'options' => array(

								__('文章列表', 'themify') => 'list-post',

								__('4 格', 'themify') => 'grid4',

								__('3 格', 'themify') => 'grid3',

								__('2 格', 'themify') => 'grid2',

								__('2 格-thumb', 'themify') => 'grid2-thumb',

								__('列表-thumb', 'themify') => 'list-thumb-image'

							),

							'label' => __('布局样式:', 'themify'),

							'help' => __('默认 = list-post.', 'themify')

						)

					);

					break;

				case 'slider':
					$fields = array(

						array(

							'id' => 'visible_slider',

							'type' => 'text',

							'label' => __('项目在同一时间可见数:', 'themify'),

							'help' => __('默认 = 1.', 'themify')

						),

						array(

							'id' => 'scroll_slider',

							'type' => 'text',

							'label' => __('项目数滚动:', 'themify'),

							'help' => __('默认 = 1.', 'themify')

						),

						array(

							'id' => 'auto_slider',

							'type' => 'text',

							'label' => __('自动播放滑块的秒数:', 'themify'),

							'help' => __('默认 = 0, 滑块不会自动播放.', 'themify')

						),

						array(

							'id' => 'wrap_slider',

							'type' => 'select',

							'options' => array(

								__('是', 'themify') => 'yes',

								__('否', 'themify') => 'no',

							),

							'label' => __('包装滑块项目:', 'themify'),

							'help' => __('默认= 是,滑块将环回的第一个项目', 'themify')

						),

						array(

							'id' => 'speed_slider',

							'type' => 'select',

							'options' => array(

								__('一般', 'themify') => 'normal',

								__('慢', 'themify') => 'slow',

								__('快', 'themify') => 'fast'

							),

							'label' => __('动画速度:', 'themify')

						),

						array(

							'id' => 'slider_nav_slider',

							'type' => 'select',

							'options' => array(

								__('是', 'themify') => 'yes',

								__('否', 'themify') => 'no',

							),

							'label' => __('Show slider navigation:', 'themify'),

							'help' => __('默认 =是.', 'themify')

						),

						array(

							'id' => 'class_slider',

							'type' => 'text',

							'label' => __('自定义css类名称:', 'themify')

						),

						array(

							'type' => 'info',

							'info' => __('查看 <a href="http://themify.me/docs/shortcodes#slider">文档</a> 获取更多细节', 'themify'),

						)

					);
					break;

			}

			

			foreach ($fields as $field) {

				?>

				<p>

					<?php if(isset($field['id']) && isset($field['label'])){ ?>

						<label for="<?php echo $field['id'] ?>"><span class="label-inner"><?php echo $field['label']; ?></span>

					<?php }	?>

						<?php

						if('text' == $field['type']){

						?>

							<input type="text" style="padding: 5px; width:200px;" id="<?php echo $field['id'] ?>" name="<?php echo $field['id'] ?>" placeholder="<?php if(isset($field['value'])) echo $field['value']; ?>" />

						<?php

						} elseif('select' == $field['type']){

						?>

							<select style="padding: 5px; width:200px;" id="<?php echo $field['id'] ?>" name="<?php echo $field['id'] ?>" >

								<?php

								echo '<option value=""></option>';

								foreach ($field['options'] as $key => $value) {
									echo '<option value="' . $value . '">' . $key . '</option>';
								}

								?>

							</select>

						<?php

						} elseif('selectbasic' == $field['type']){

						?>

							<select style="padding: 5px; width:200px;" id="<?php echo $field['id'] ?>" name="<?php echo $field['id'] ?>" >

								<?php

								echo '<option value=""></option>';

								foreach ($field['options'] as $value) {

									echo '<option value="' . $value . '">' . $value . '</option>';

								}

								?>

							</select>

						<?php

						} elseif ('info' == $field['type']){

						?>

							<p><?php if(isset($field['info'])) echo $field['info']; ?></p>

						<?php

						}

						?>

					<?php if(isset($field['id']) && isset($field['label'])){ ?>

					</label>

					<?php } ?>

				</p>

				<div class="description"><?php if(isset($field['help'])) echo $field['help']; ?></div>

			<?php
			}

			

			?>

			</div><!--/panel current-->

			<div class="mceActionPanel submitbox" style="border-top: 1px solid #CCC;padding-top: 5px;">

				<div id="delete-action" style="float: left;">

					<a class="submitdelete deletion" onclick="tinyMCEPopup.close();" style="text-decoration: underline;cursor:pointer;padding: 0 2px;"><?php _e('取消', 'themify'); ?></a>

				</div>

		

				<div id="wp-link-update" style="float: right;">

					<input class="button-primary" type="submit" id="wp-link-submit" name="insert" value="<?php _e('插入', 'ilc'); ?>" onclick="themify_insert_shortcode(shortcode_type);" style="padding: 4px 8px;border-radius: 10px;cursor:pointer;" />

				</div>

			</div>

			

		</form>

		

	</body>

</html>	

<?php

//finish box

?>
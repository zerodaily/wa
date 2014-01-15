<?php /*



**************************************************************************



Plugin Name:  Regenerate Thumbnails

Plugin URI:   http://www.viper007bond.com/wordpress-plugins/regenerate-thumbnails/

Description:  Allows you to regenerate all thumbnails after changing the thumbnail sizes.

Version:      2.1.3

Author:       Viper007Bond

Author URI:   http://www.viper007bond.com/



**************************************************************************



Copyright (C) 2008-2010 Viper007Bond



This program is free software: you can redistribute it and/or modify

it under the terms of the GNU General Public License as published by

the Free Software Foundation, either version 3 of the License, or

(at your option) any later version.



This program is distributed in the hope that it will be useful,

but WITHOUT ANY WARRANTY; without even the implied warranty of

MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

GNU General Public License for more details.



You should have received a copy of the GNU General Public License

along with this program.  If not, see <http://www.gnu.org/licenses/>.



**************************************************************************/



class RegenerateThumbnails {

	var $menu_id;

	var $uripath;

	var $dirpath;



	// Plugin initialization

	function RegenerateThumbnails() {

		if ( ! function_exists( 'admin_url' ) )

			return false;

		

		$this->uripath = THEMIFY_URI . '/regenerate-thumbnails';

		$this->dirpath = THEMIFY_DIR . '/regenerate-thumbnails';



		add_action( 'admin_menu',                              array( &$this, 'add_admin_menu' ) );

		add_action( 'admin_enqueue_scripts',                   array( &$this, 'admin_enqueues' ) );

		add_action( 'wp_ajax_regeneratethumbnail',             array( &$this, 'ajax_process_image' ) );

		add_action( 'wp_ajax_collectposts', 				   array( &$this, 'ajax_collectposts' ) );

		add_action( 'wp_ajax_processposts', 				   array( &$this, 'ajax_processposts' ) );

		add_filter( 'media_row_actions',                       array( &$this, 'add_media_row_action' ), 10, 2 );

		add_filter( 'bulk_actions-upload',                     array( &$this, 'add_bulk_actions' ), 99 );

		add_action( 'admin_action_bulk_regenerate_thumbnails', array( &$this, 'bulk_action_handler' ) );

	}





	// Register the management page

	function add_admin_menu() {

		$this->menu_id = add_submenu_page('themify', __( '重建缩略图', 'themify' ), __( '重建缩略图', 'themify' ), 'manage_options', 'regenerate-thumbnails', array(&$this, 'regenerate_interface') );

	}





	// Enqueue the needed Javascript and CSS

	function admin_enqueues( $hook_suffix ) {

		if ( $hook_suffix != $this->menu_id )

			return;



		// WordPress 3.1 vs older version compatibility

		if ( wp_script_is( 'jquery-ui-widget', 'registered' ) )

			wp_enqueue_script( 'jquery-ui-progressbar', $this->uripath .  '/jquery-ui/jquery.ui.progressbar.min.js', array( 'jquery-ui-core', 'jquery-ui-widget' ), '1.8.6' );

		else

			wp_enqueue_script( 'jquery-ui-progressbar', $this->uripath . 'jquery-ui/jquery.ui.progressbar.min.1.7.2.js', array( 'jquery-ui-core' ), '1.7.2' );



		wp_enqueue_style( 'jquery-ui-regenthumbs', $this->uripath . '/jquery-ui/redmond/jquery-ui-1.7.2.custom.css', array(), '1.7.2' );

	}





	// Add a "Rebuild Thumbnails" link to the media row actions

	function add_media_row_action( $actions, $post ) {

		if ( 'image/' != substr( $post->post_mime_type, 0, 6 ) )

			return $actions;



		$url = wp_nonce_url( admin_url( 'admin.php?page=regenerate-thumbnails&goback=1&ids=' . $post->ID ), 'regenerate-thumbnails' );

		$actions['regenerate_thumbnails'] = '<a href="' . esc_url( $url ) . '" title="' . esc_attr( __( "Rebuild the thumbnails for this single image", 'themify' ) ) . '">' . __( 'Rebuild Thumbnails', 'themify' ) . '</a>';



		return $actions;

	}





	// Add "Rebuild Thumbnails" to the Bulk Actions media dropdown

	function add_bulk_actions( $actions ) {

		$delete = false;

		if ( ! empty( $actions['delete'] ) ) {

			$delete = $actions['delete'];

			unset( $actions['delete'] );

		}

		$actions['bulk_regenerate_thumbnails'] = __( '重建缩略图', 'themify' );



		if ( $delete )

			$actions['delete'] = $delete;



		return $actions;

	}





	// Handles the bulk actions POST

	function bulk_action_handler() {

		check_admin_referer( 'bulk-media' );



		if ( empty( $_POST['media'] ) && is_array( $_POST['media'] ) )

			return;



		$ids = implode( ',', array_map( 'intval', $_POST['media'] ) );



		// Can't use wp_nonce_url() as it escapes HTML entities

		wp_redirect( add_query_arg( '_wpnonce', wp_create_nonce( 'regenerate-thumbnails' ), admin_url( 'tools.php?page=regenerate-thumbnails&goback=1&ids=' . $ids ) ) );

		

		exit();

	}



	// The user interface plus thumbnail regenerator

	function regenerate_interface() {

		global $wpdb;



		?>



<div id="message" class="updated fade" style="display:none"></div>



<div class="wrap regenthumbs">

	<h2><?php _e('重建缩略图', 'themify'); ?></h2>



<?php



		// If the button was clicked

		if ( ! empty( $_POST['regenerate-thumbnails'] ) || ! empty( $_REQUEST['ids'] ) ) {

			// Capability check

			if ( !current_user_can( 'manage_options' ) )

				wp_die( __( 'Cheatin&#8217; uh?' ) );



			// Form nonce check

			check_admin_referer( 'regenerate-thumbnails' );



			// Create the list of image IDs

			if ( ! empty( $_REQUEST['ids'] ) ) {

				$images = array_map( 'intval', explode( ',', trim( $_REQUEST['ids'], ',' ) ) );

				$ids = implode( ',', $images );

			} else {

				// Directly querying the database is normally frowned upon, but all

				// of the API functions will return the full post objects which will

				// suck up lots of memory. This is best, just not as future proof.

				if ( ! $images = $wpdb->get_results( "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND post_mime_type LIKE 'image/%' ORDER BY ID DESC" ) ) {

					echo '	<p>' . sprintf( __( "Unable to find any images. Are you sure <a href='%s'>some exist</a>?", 'themify' ), admin_url( 'upload.php?post_mime_type=image' ) ) . "</p></div>";

					return;

				}



				// Generate the list of IDs

				$ids = array();

				foreach ( $images as $image )

					$ids[] = $image->ID;

				$ids = implode( ',', $ids );

			}



			echo '	<p>' . __( "Please be patient while the thumbnails are regenerated. This can take a while if your server is slow or if you have many images. Do not navigate away from this page until this script is done or the thumbnails will not be resized. You will be notified via this page when the regenerating is completed.", 'themify' ) . '</p>';



			$count = count( $images );



			$text_goback = ( ! empty( $_GET['goback'] ) ) ? sprintf( __( '要返回到前一个页面， <a href="%s">点击这里</a>.', 'themify' ), 'javascript:history.go(-1)' ) : '';

			

			$text_failures = sprintf( __( '全部完成! %1$s image(s))成功调整大小使用 %2$s秒且%3$s 失败. 再次尝试再生失败的图像，, <a href="%4$s">click here</a>. %5$s', 'themify' ), "' + rt_successes + '", "' + rt_totaltime + '", "' + rt_errors + '", esc_url( wp_nonce_url( admin_url( 'admin.php?page=regenerate-thumbnails&goback=1' ), 'regenerate-thumbnails' ) . '&ids=' ) . "' + rt_failedlist + '", $text_goback );

			$text_nofailures = sprintf( __( '全部完成 %1$s image(s)成功调整大小使用 %2$s秒且0个失败. %3$s', 'themify' ), "' + rt_successes + '", "' + rt_totaltime + '", $text_goback );

?>





	<noscript><p><em><?php _e( '您必须启用JavaScript才能继续进行！', 'themify' ) ?></em></p></noscript>



	<div id="regenthumbs-bar" style="position:relative;height:25px;">

		<div id="regenthumbs-bar-percent" style="position:absolute;left:50%;top:50%;width:300px;margin-left:-150px;height:25px;margin-top:-9px;font-weight:bold;text-align:center;"></div>

	</div>



	<p><input type="button" class="button hide-if-no-js" name="regenthumbs-stop" id="regenthumbs-stop" value="<?php _e( '中止调整图像尺寸', 'themify' ) ?>" /></p>



	<h3 class="title"><?php _e( '调试信息', 'themify' ) ?></h3>



	<p>

		<?php printf( __( '全部图片: %s', 'themify' ), $count ); ?><br />

		<?php printf( __( '图片调整大小: %s', 'themify' ), '<span id="regenthumbs-debug-successcount">0</span>' ); ?><br />

		<?php printf( __( '调整失败: %s', 'themify' ), '<span id="regenthumbs-debug-failurecount">0</span>' ); ?>

	</p>



	<ol id="regenthumbs-debuglist">

		<li style="display:none"></li>

	</ol>



	<script type="text/javascript">

	// <![CDATA[

		jQuery(document).ready(function($){

			var i;

			var rt_images = [<?php echo $ids; ?>];

			var rt_total = rt_images.length;

			var rt_count = 1;

			var rt_percent = 0;

			var rt_successes = 0;

			var rt_errors = 0;

			var rt_failedlist = '';

			var rt_resulttext = '';

			var rt_timestart = new Date().getTime();

			var rt_timeend = 0;

			var rt_totaltime = 0;

			var rt_continue = true;



			// Create the progress bar

			$("#regenthumbs-bar").progressbar();

			$("#regenthumbs-bar-percent").html( "0%" );



			// Stop button

			$("#regenthumbs-stop").click(function() {

				rt_continue = false;

				$('#regenthumbs-stop').val("<?php echo $this->esc_quotes( __( '停止...', 'themify' ) ); ?>");

			});



			// Clear out the empty list element that's there for HTML validation purposes

			$("#regenthumbs-debuglist li").remove();



			// Called after each resize. Updates debug information and the progress bar.

			function RegenThumbsUpdateStatus( id, success, response ) {

				$("#regenthumbs-bar").progressbar( "value", ( rt_count / rt_total ) * 100 );

				$("#regenthumbs-bar-percent").html( Math.round( ( rt_count / rt_total ) * 1000 ) / 10 + "%" );

				rt_count = rt_count + 1;



				if ( success ) {

					rt_successes = rt_successes + 1;

					$("#regenthumbs-debug-successcount").html(rt_successes);

					$("#regenthumbs-debuglist").append("<li>" + response.success + "</li>");

				}

				else {

					rt_errors = rt_errors + 1;

					rt_failedlist = rt_failedlist + ',' + id;

					$("#regenthumbs-debug-failurecount").html(rt_errors);

					$("#regenthumbs-debuglist").append("<li>" + response.error + "</li>");

				}

			}



			// Called when all images have been processed. Shows the results and cleans up.

			function RegenThumbsFinishUp() {

				rt_timeend = new Date().getTime();

				rt_totaltime = Math.round( ( rt_timeend - rt_timestart ) / 1000 );



				$('#regenthumbs-stop').hide();



				if ( rt_errors > 0 ) {

					rt_resulttext = '<?php echo $text_failures; ?>';

				} else {

					rt_resulttext = '<?php echo $text_nofailures; ?>';

				}



				$("#message").html("<p><strong>" + rt_resulttext + "</strong></p>");

				$("#message").show();

			}



			// Regenerate a specified image via AJAX

			function RegenThumbs( id ) {

				$.ajax({

					type: 'POST',

					url: ajaxurl,

					data: { action: "regeneratethumbnail", id: id },

					success: function( response ) {

						if ( response.success ) {

							RegenThumbsUpdateStatus( id, true, response );

						}

						else {

							RegenThumbsUpdateStatus( id, false, response );

						}



						if ( rt_images.length && rt_continue ) {

							RegenThumbs( rt_images.shift() );

						}

						else {

							RegenThumbsFinishUp();

						}

					},

					error: function( response ) {

						RegenThumbsUpdateStatus( id, false, response );



						if ( rt_images.length && rt_continue ) {

							RegenThumbs( rt_images.shift() );

						} 

						else {

							RegenThumbsFinishUp();

						}

					}

				});

			}



			RegenThumbs( rt_images.shift() );

		});

	// ]]>

	</script>

	

<?php

		}



		// No button click? Display the form.

		else {

?>

<?php

/**

 * Collect posts which don't have a wp post thumbnail and fix them by attaching

 * the legacy feature image to the post and setting it as the post thumbnail 

 */

?>

<div class="listapost" style="float: left; width: 48%; margin-right: 2%;">

	<small><?php _e('检查文章缩略图...', 'themify'); ?> </small>

</div>

<?php

/**

 * Part of conversion from legacy feature image to post thumbnail.

 */

?>

<script type="text/javascript">

// <![CDATA[

jQuery(document).ready(function($){

	jQuery.ajax({

		type: 'POST',

		url: ajaxurl,

		data:{

			action: 'collectposts'

		},

		success: function(response){



			if(response == true){

				jQuery('div.listapost').remove();

			}

			else{

				jQuery('div.listapost small').remove();

				jQuery('div.listapost').append( response.collectedposts );



				//Now let's process the posts!

				$('#showdetails').click(function(){

					$('.posttofix').slideToggle();

				});

				//flag to check if the user has already processed the posts

				postsAlreadyProcessed = 0;

				//number of posts to process

				postsToProcess = response.idstofix;

				postsToProcess = postsToProcess.length;

				jQuery('div.listapost').append('<div id="processedposts" style="display: none; height: 200px; overflow: scroll; overflow-x: hidden; overflow-y: scroll; border: 1px solid #EEE; padding: 0 10px; background: #F6F6F6; font-size: 11px; line-height: 120%;">');

				jQuery('#processposts').click(function(){

					if( 0 == postsAlreadyProcessed ){

						if(confirm('<?php _e('这将转换后的图像和特征图形自定义字段到WordPress的特色图片（如果适用的话）。', 'themify'); ?>')){

							jQuery('#processedposts').show();

							jQuery.each(response.idstofix, function(){

								var postid = this.toString();

								jQuery('#processedposts').append('<p><?php _e('根据ID处理文章 ', 'themify'); ?> ' + postid + '...</p>');

								jQuery.post(

									ajaxurl,

									{

										action: 'processposts',

										postid: postid

									},

									function(response){

										jQuery('#processedposts').append( response );

										//decrement number of posts to process

										postsToProcess--;

										if( postsToProcess <= 0){

											jQuery('div.listapost').append('<p><?php _e('全部完成。', 'themify'); ?> <a href="<?php echo admin_url('admin.php?page=themify'); ?>"><?php _e('玩得开心！', 'themify'); ?></a></p>');

										}

									}

								);

							});

							postsAlreadyProcessed = 1;

						}

						else{

							return false;

						}

					}

					else{

						alert('<?php _e('你已经处理了这些文章。', 'themify');?>');

					}

				});

			}

			

		},

		error: function(response){

			

		},

		dataType: 'json'

	});

});

// ]]>

</script>

<form method="post" action="" style="overflow: hidden">

	<?php wp_nonce_field('regenerate-thumbnails') ?>

	

	<h3><?php _e('重建缩略图', 'themify'); ?></h3>

	

	<p><?php printf( __( "使用此工具来重建缩略图上传到你的博客，你的所有图像。这是非常有用的，如果你已经改变了的缩略图尺寸<a href='%s'>media settings page</a>. 旧的缩略图将被保留，以避免任何损坏的图像，由于硬编码的URL。", 'themify' ), admin_url( 'options-media.php' ) ); ?></p>



	<p><?php _e( "缩略图再生是不可逆的，但你可以改变你的缩略图尺寸返回旧的值，并再次单击该按钮，如果你不喜欢的结果。", 'themify' ); ?></p>



	<p><input type="submit" class="button hide-if-no-js" name="regenerate-thumbnails" id="regenerate-thumbnails" value="<?php _e( '全部重新生成缩略图', 'themify' ) ?>" /></p>



	<noscript>

		<p>

			<em><?php _e( '您必须启用JavaScript才能继续进行！', 'themify' ) ?></em>

			</p>

	</noscript>

</form>

	

<?php

		} // End if button

?>

</div>



<?php

	}

	

	/**

	 * Part of conversion from legacy feature image to post thumbnail.

	 * Collect all posts that must and CAN be fixed.

	 * @since 1.1.3

	 */

	function ajax_collectposts(){

		//Get all CPT created by Themify

		$posttypes = themify_post_types();

		

		//Get list of posts that have a path in feature_image

		$themify_postlist = get_posts( array(

			'numberposts' => -1,

			'post_type' => $posttypes,

			'meta_query' => array(

				'relation' => 'OR',

				array(

					'key' => 'post_image'

				),

				array(

					'key' => 'feature_image'

				)

			)

		));

		$html = '<style type="text/css">

		.posttofix{

			display: none;

			height: 500px;

			overflow: scroll;

			overflow-x: hidden;

			overflow-y: scroll;

			border: 1px solid #EEE;

			padding: 0 20px 0 10px;

			background: #F6F6F6;

			font-size: 11px;

			line-height: 120%;

		}

		.posttofix ol li{

			margin-bottom:20px;

		}

		.posttofix ol p{

			margin-top: -0.5em;

		}

		.posttofix ol h3 small{

			font-weight:normal;

			clear:both;

			display: block;

			margin-top: .5em;

		}

		</style>';

		//Start displaying errors

		$html .= '<h3>' . __('文章图片迁移', 'themify') . '</h3>';

		$html .= '<p>'.__("使用此工具来邮政的Themify，图片和特征的人影像自定义字段转换到WordPress特色图片。如果图片的URL是不是比你的WordPress网站在同一个域中，处理器将跳过它。", 'themify') . '</p><p><a href="#" id="processposts" class="button hide-if-no-js" title="' . __('处理的所有，可以迁移的文章。', 'themify') . '">' . __('处理所有文章', 'themify') . '</a> &nbsp; <a href="#" id="showdetails">' . __('查看细节', 'themify') . '</a></p>';

		$html .= '<div class="posttofix">';

		$html .= '<p id="fix-types">' . __('过滤视图:', 'themify') . ' ';

		$html .= '<a href="#" id="fix-all" style="margin-right: 10px;">' . __('全部', 'themify') . '</a>';

		$fixtypes = array( 'post', 'slider', 'highlights', 'menu' );

		foreach($fixtypes as $type){

			if( post_type_exists($type) )

				$html .= '<a href="#" id="fix-' . $type . '" style="margin-right: 10px;">' . ucwords($type) . '</a>';

		}

		$html .= '</p>';

		$html .= '<ol>';

		//Initialize list of posts to be fixed

		$themify_postfix = array();

		foreach ($themify_postlist as $post) {

			//Get wp post thumbnail

			$thumbnailid = get_post_meta($post->ID, '_thumbnail_id', true);

			//Get themify legacy Post Image. We give priority to this field.

			$featimg = get_post_meta($post->ID, 'post_image', true);

			//If there was no URL here, we will try another field

			if( empty($featimg) ){

				//Get themify legacy Feature Image. If the Post Image field is empty, try this one.

				$featimg = get_post_meta($post->ID, 'feature_image', true);

			}			

			//Parse URL of legacy feature image to obtain the host later

			$featimgurl = parse_url($featimg);

			//Save ID, post type, title and a link to edit the post

			$postedit = '<li class="fix-all fix-' . $post->post_type . '">

				<h3>' . $post->post_title . '

						<small>ID: '. $post->ID .' | Type: ' . ucwords($post->post_type) . ' | <a href="' . get_edit_post_link($post->ID) . '">Edit post</a>

						</small>

				</h3>';

			

			if( $thumbnailid ){

				$thumbpost = get_post($thumbnailid);

				

				if($featimg == $thumbpost->guid){

					//$html .=  $postedit . '<p><strong style="color:#060;">' . __("Featured Image and Themify's Post Image match!", 'themify') . '</strong></p>';

				}

				else{

					

					//Display details and edit link for this post

					$html .= $postedit;

					///Parse URL of wp post thumbnail to obtain the host later

					$thumburl = parse_url($thumbpost->guid);

					//Display the hosts of the wp post thumbnail and legacy feature image

					$html .=  '<p><strong>' . __('特色图片:', 'themify') . '</strong><br/>'. $thumbpost->guid . '</p>';

					$html .=  '<p><strong>' . __("Themify's 文章图片:", 'themify') . '</strong><br/>' . $featimg . '</p>';

					

					if($featimgurl['host'] == $thumburl['host']){

						//Image is in the same server, so we can add it.

						$html .=  '<p style="color:#480;">' . __("文章图像的URL似乎是在同一台服务器上，且WordPress安装的，它会被设置为特色图片。", 'themify') . '</p>';

						//Add post to list of posts to be fixed

						$themify_postfix[] = $post;

					}

					else{

						//Legacy image is not in the same server so it can't be added as the post thumbnail

						$html .=  '<p style="color:#d00;">' . __("The post image URL is not in the same server than your WordPress installation so it can't be set as the Featured Image.", 'themify') . '</p>';

					}

				}

			}

			else{

				// Initialize WP Filesystem API

				require_once(ABSPATH . 'wp-admin/includes/file.php');

				$url = wp_nonce_url('admin.php?page=regenerate-thumbnails','themify-regen_thumbs');

				if (false === ($creds = request_filesystem_credentials($url, '', true, false, null) ) ) {

					return true;

				}

				if ( ! WP_Filesystem($creds) ) {

					request_filesystem_credentials($url, '', true, false, null);

					return true;

				}

				global $wp_filesystem, $blog_id;

				//get site or blog upload dir

				$updir = wp_upload_dir();

				

				//since WPMS redirects the upload dir, we need to build the path to the image in the server

				if( is_multisite() ){

					//if $blog_id has been correctly instanced and it's a blog

					if ( isset($blog_id) && $blog_id > 0) {

						//split image url in two and remove /files string

						$imgexp = explode('/files', $featimg);

						//if we have the last portion with the directories path ordered by date

						if (isset($imgexp[1])) {

							//get server path to the image

							$serverimgpath = $updir['basedir'] . $imgexp[1];

						} else {

							$html .=  '<p style="color:#d00;">' . __('图片没有找到。图像的路径不存在。', 'themify') . '<br/><small>' . $featimg . '</small></p>';

						}

					} else {

						$html .=  '<p style="color:#d00;">' . __('Multisite reference OK but bad blog ID.', 'themify') . '<br/><small>' . $featimg . '</small></p>';

					}

				} else {

					//split image url in two and remove /files string

					$imgexp = explode('/uploads', $featimg);

					$serverimgpath = $updir['basedir'] . $imgexp[1];

				}

				

				//Display details and edit link for this post

				$html .= $postedit;

				//get home url to check later

				$homeurl = home_url();

				///Parse home URL to obtain the host later

				$localurl = parse_url( $homeurl );

				

				//same domain or host

				if($featimgurl['host'] == $localurl['host']){

					//check if file exists

					if($wp_filesystem->exists($serverimgpath)){

						if( is_multisite() ){

							//multisite install, same domain

							$featimginfo = pathinfo($featimg);

							$featimgpath = $featimginfo['dirname'];

							$featimgpath = split('files', $featimgpath);

							if( home_url().'/' == $featimgpath[0]){

								$html .=  '<p style="color:#480;">' . __('没有特色图片集，但文章图像可以设置为特色的图像。', 'themify') . '<br/><small>' . $featimg . '</small></p>';

								$themify_postfix[] = $post;

							} else {

								$html .=  '<p style="color:#d00;">' . __('没有特色图片集文章的图像是从多站点安装在不同的网站。', 'themify') . '<br/><small>' . $featimg . '</small></p>';

							}

						}

						else {

							//is single wordpress

							$existe = $wp_filesystem->is_file($serverimgpath);

							$fiinfo = pathinfo($featimg);

							$fipath = $fiinfo['dirname'];

							$fipath = split('/wp-content/uploads', $fipath);

							/*ob_start();

							dumpit($serverimgpath);

							dumpit($existe);

							dumpit($fipath);

							dumpit($homeurl);

							//$html .= ob_get_contents();

							ob_end_clean();*/

							if($homeurl != $fipath[0]){

								//single wordpress, same domain or host, different subdirectory

								$html .=  '<p style="color:#d00;">' . __('文章图像的URL是从你的主机在不同的子目录。', 'themify') . '<br/><small>' . $featimg . '</small></p>';

							}

							else{

								$html .=  '<p style="color:#480;">' . __('没有特色图片集，但文章图像可以设置为特色的图像。', 'themify') . '<br/><small>' . $featimg . '</small></p>';

									$themify_postfix[] = $post;

							}

						}

					}

					else {

						$html .=  '<p style="color:#d00;">' . __('引用的文章图像不存在。', 'themify') . '<br/><small>' . $featimg . '</small></p>';

					}

				}

				else{

					$html .=  '<p style="color:#d00;">' . __('文章的图像是不是在同一个服务器，而不是你的WordPress安装，所以它不能被设置为特色的图像。', 'themify') . '<br/><small>' . $featimg . '</small></p>';

				}

			}

			$html .=  '</li>';

		}

		$html .=  '</ol></div><!-- END posts to fix --><br/>';

		

		$html .= "

			<script type='text/javascript'>

			jQuery(document).ready(function() {

				jQuery('#fix-types a').click(function(){

					jQuery('.fix-all').fadeOut();

					jQuery('.' + jQuery(this).attr('id')).fadeIn();

				});

			});

			</script>

		";

		

		$idstofix = array();

		foreach($themify_postfix as $post){

			$idstofix[] = $post->ID;

		}

		/////////////////////////////////////////////////////////////

		// THIS IS JUST TO MAKE IT FAIL SO WE CAN SEE THE OUTPUT!! //

						$themify_postfix[] = '';

		// IT MUST BE REMOVED FOR PRODUCTION                       //

		/////////////////////////////////////////////////////////////

		if( empty($themify_postfix) ){

			echo 'true';

			die();

		}

		else echo json_encode( array('collectedposts' => $html, 'idstofix' => $idstofix) );

		

		die();

	}

	/**

	 * Part of conversion from legacy feature image to post thumbnail.

	 * Process posts that must be fixed. Image is:

	 * 1) attached to post

	 * 2) inserted into media library and thumbnail sizes are generated

	 * 3) set as the post thumbnail

	 * @since 1.1.3

	 */

	function ajax_processposts(){

		//Get ID of post sent by AJAX

		$postid = $_POST['postid'];

		//get legacy image URI from Post Image to attach into media library and set as post thumbnail

		$url = get_post_meta( $postid, 'post_image', true );



		//If there was no URL here, we will try another field

		if( !isset($url) || '' == $url ){

			//Get themify legacy Feature Image. If the Post Image field is empty, try this one.

			$url = get_post_meta($postid, 'feature_image', true);

		}

		if ( is_multisite() ) {

			//if is multisite, truncate on files remove everything but year/month folders and filename

			$datefile = split('files', $url);

		}

		else{

			//if it's a single install, truncate on uploads remove everything but year/month folders and filename

			$datefile = split('uploads', $url);

		}



		//get upload directory location

		$upload_dir = wp_upload_dir();

		

		//build path using the wp upload dir and filename

		$filename = $upload_dir['basedir'] . $datefile[1];

		//check file type

		$wp_filetype = wp_check_filetype( basename( $filename ) );

		$attachment = array(

			'post_mime_type' => $wp_filetype['type'],

			'post_title' 	 => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),

			'post_content'	 => '',

			'post_status'	 => 'inherit',

			'guid'		  	 => $url

		);

		//insert image into media library

		$attach_id = wp_insert_attachment( $attachment, $filename, $postid );

		//If image could not be inserted as attachment

		if( 0 == $attach_id ) {

			_e('图片无法连接。', 'themify');

			die();

		}

		//include image.php for function wp_generate_attachment_metadata() to work

		require_once(ABSPATH . 'wp-admin/includes/image.php');

		//generate metadata and image sizes as set on Settings\Media in WP Admin

		$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );



		//write metadata into attachment

		if( false == wp_update_attachment_metadata( $attach_id, $attach_data ) ){

			echo sprintf( '<p>'.__('对图像的元数据 %s 不能写入.', 'themify').'</p>', $attach_id);

			die();

		}

		//set as post thumbnail

		if( false == set_post_thumbnail( $postid, $attach_id ) ){

			echo sprintf('<p>'.__('不能为文章设置图片 %s 成为缩略图  %s.', 'themify').'</p>', $attach_id, $postid);

			die();

		}

		update_post_meta($postid, 'feature_size', 'blank');

		//display success message

		echo sprintf('<p>' .__('图片添加到媒体库ID %s 的文章，ID设置为特色图片 %s', 'themify'). '</p>', $attach_id.'<br/><small>'.$url.'</small><br/>', $postid, get_the_title($postid));

		//finish script execution

		die();

	}



	// Process a single image ID (this is an AJAX handler)

	function ajax_process_image() {

		@error_reporting( 0 ); // Don't break the JSON result



		header( 'Content-type: application/json' );



		$id = (int) $_REQUEST['id'];

		$image = get_post( $id );



		if ( ! $image || 'attachment' != $image->post_type || 'image/' != substr( $image->post_mime_type, 0, 6 ) )

			die( json_encode( array( 'error' => sprintf( __( '无法调整大小: %s无效的图片ID.', 'themify' ), esc_html( $_REQUEST['id'] ) ) ) ) );



		if ( !current_user_can( 'manage_options' ) )

			$this->die_json_error_msg( $image->ID, __( "您的用户帐户没有权限来调整图像", 'themify' ) );



		$fullsizepath = get_attached_file( $image->ID );



		if ( false === $fullsizepath || ! file_exists( $fullsizepath ) )

			$this->die_json_error_msg( $image->ID, sprintf( __( '最初上传的图像文件不能被发现 %s', 'themify' ), '<code>' . esc_html( $fullsizepath ) . '</code>' ) );



		@set_time_limit( 900 ); // 5 minutes per image should be PLENTY



		$metadata = wp_generate_attachment_metadata( $image->ID, $fullsizepath );



		if ( is_wp_error( $metadata ) )

			$this->die_json_error_msg( $image->ID, $metadata->get_error_message() );

		if ( empty( $metadata ) )

			$this->die_json_error_msg( $image->ID, __( '未知错误.', 'themify' ) );



		// If this fails, then it just means that nothing was changed (old value == new value)

		wp_update_attachment_metadata( $image->ID, $metadata );



		die( json_encode( array( 'success' => sprintf( __( '&quot;%1$s&quot; (ID %2$s) 成功调整 %3$s秒.', 'themify' ), esc_html( get_the_title( $image->ID ) ), $image->ID, timer_stop() ) ) ) );

	}





	// Helper to make a JSON error message

	function die_json_error_msg( $id, $message ) {

		die( json_encode( array( 'error' => sprintf( __( '&quot;%1$s&quot; (ID %2$s) 调整失败.错误信息: %3$s', 'themify' ), esc_html( get_the_title( $id ) ), $id, $message ) ) ) );

	}





	// Helper function to escape quotes in strings for use in Javascript

	function esc_quotes( $string ) {

		return str_replace( '"', '\"', $string );

	}

}



// Start up this plugin

add_action( 'init', 'RegenerateThumbnails' );

function RegenerateThumbnails() {

	global $RegenerateThumbnails;

	$RegenerateThumbnails = new RegenerateThumbnails();

}



?>
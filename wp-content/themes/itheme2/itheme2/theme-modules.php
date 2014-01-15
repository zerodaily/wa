<?php

/*
To add custom modules to the theme, create a new 'custom-modules.php' file in the theme folder.
They will be added to the theme automatically.
*/

/* 	Custom Modules
/***************************************************************************/	
	
	///////////////////////////////////////////
	// Comments in Pages Function
	///////////////////////////////////////////
	function themify_comments_in_pages($data=array()){
		$data = get_data();
		if($data['setting-comments_pages']){
			$pages_checked = "checked='checked'";	
		}
		return '<p><input type="checkbox" name="setting-comments_pages" '.$pages_checked.' /> Exclude comments in Pages</p>';	
	}
	
	///////////////////////////////////////////
	// Featured Image Function
	///////////////////////////////////////////
	function themify_post_image($data=array()){
		$data = get_data();
		$options = array("left","right");
		
		if($data['setting-post_image_single_disabled']){
			$checked = 'checked="checked"';
		}
		
		$output .= '<p>
						<span class="label">' . __('文章列表图像大小', 'themify') . '</span>  
						<input type="text" class="width2" name="setting-image_post_width" value="'.$data['setting-image_post_width'].'" /> ' . __('宽度', 'themify') . ' <small>(px)</small>  
						<input type="text" class="width2" name="setting-image_post_height" value="'.$data['setting-image_post_height'].'" /> ' . __('高度', 'themify') . ' <small>(px)</small>
					</p>
					<p>
						<span class="label">' . __('文章列表图像对齐', 'themify') . '</span>
						<select name="setting-image_post_align">
							<option></option>';
		foreach($options as $option){
			if($option == $data['setting-image_post_align']){
				$output .= '<option value="'.$option.'" selected="selected">'.$option.'</option>';
			} else {
				$output .= '<option value="'.$option.'">'.$option.'</option>';
			}
		}
		$output .=	'</select>
					</p>
					<hr />
					<p>
						<span class="label">' . __('单一文章图片大小', 'themify') . '</span>  
						<input type="text" class="width2" name="setting-image_post_single_width" value="'.$data['setting-image_post_single_width'].'" /> ' . __('宽度', 'themify') . ' <small>(px)</small>  
						<input type="text" class="width2" name="setting-image_post_single_height" value="'.$data['setting-image_post_single_height'].'" /> ' . __('高度', 'themify') . ' <small>(px)</small>
					</p>
					<p>
						<span class="label">' . __('单一文章图片对齐', 'themify') . '</span>
						<select name="setting-image_post_single_align">
							<option></option>';
		foreach($options as $option){
			if($option == $data['setting-image_post_single_align']){
				$output .= '<option value="'.$option.'" selected="selected">'.$option.'</option>';
			} else {
				$output .= '<option value="'.$option.'">'.$option.'</option>';
			}
		}
		$output .=	'</select>
					</p>
					<p>
						<span class="pushlabel">
							<input type="checkbox" name="setting-post_image_single_disabled" '.$checked.' >
							' . __('在单篇文章排除图像', 'themify') . '
						</span>
					</p>';
		return $output;
	}
	
	///////////////////////////////////////////
	// Footer Text Function
	///////////////////////////////////////////
	function themify_footer_text($data=array()){
		$data = get_data();
		return '<p><textarea class="widthfull" rows="4" name="setting-footer_text_left">'.$data['setting-footer_text_left'].'</textarea></p>';
	}

	///////////////////////////////////////
	// Footer Text Right Function
	///////////////////////////////////////
	function themify_footer_text_right($data=array()){
		$data = get_data();
		return '<p><textarea class="widthfull" rows="4" name="setting-footer_text_right">'.$data['setting-footer_text_right'].'</textarea></p>';	
	}
	
	///////////////////////////////////////////
	// Header Slider Function
	///////////////////////////////////////////
	function themify_header_slider($data=array()){
		$data = get_data();
		
		if($data['setting-header_slider_enabled']){
			$enabled_checked = "checked='checked'";	
		} else {
			$enabled_display = "style='display:none;'";	
		}
		if($data['setting-header_slider_visible'] == "" ||!isset($data['setting-header_slider_visible'])){
			$data['setting-header_slider_visible'] = "4";	
		}
		
		if($data['setting-header_slider_display'] == 'images'){
			$display_images = "checked='checked'";
			$display_posts_display = "style='display:none;'";
		} else {
			$display_posts = "checked='checked'";	
			$display_images_display = "style='display:none;'";
		}
		$title_options = array('' => '',__('是', 'themify') => 'yes', __('否', 'themify') => 'no');
		$auto_options = array(0,1,2,3,4,5,6,7);
		$scroll_options = array(1,2,3,4,5,6,7);
		$display_options = array('none','excerpt','content');
		$speed_options = array(__('快', 'themify') => 300, __('一般', 'themify') => 1000, __('慢', 'themify') => 2000);
		$wrap_options = array("no","yes");
		$image_options = array("one","two","three","four","five","six","seven","eight","nine","ten");
		
		$output .= '<p><span class="label">' . __('滑块', 'themify') . '</span> <input type="checkbox" name="setting-header_slider_enabled" class="feature_box_enabled_check" '.$enabled_checked.' />  Enable<br />
					<small>' . __('检查滑块', 'themify') . '</small>
					</p>
					<div class="feature_box_enabled_display" '.$enabled_display.'>
					
					<p><span class="label">' . __('显示', 'themify') . '</span> <input type="radio" class="feature-box-display" name="setting-header_slider_display" value="posts" '.$display_posts.' /> ' . __('文章', 'themify') . ' <input type="radio" class="feature-box-display" name="setting-header_slider_display" value="images" '.$display_images.' /> ' . __('图片', 'themify') . '</p>
					
					<p class="pushlabel feature_box_posts" '.$display_posts_display.'>';
							$output .= wp_dropdown_categories(array("show_option_all"=>__('所有分类', 'themify'),"show_option_all"=>__('所有分类', 'themify'),"hide_empty"=>0,"echo"=>0,"name"=>"setting-header_slider_posts_category","selected"=>$data['setting-header_slider_posts_category']));
		$output .=	'	<input type="text" name="setting-header_slider_posts_slides" value="'.$data['setting-header_slider_posts_slides'].'" class="width2" /> ' . __('被查询的文章数目', 'themify') . ' 
					</p>
					
					<p class="feature_box_posts" '.$display_posts_display.'>
						<span class="label">' . __('内容显示', 'themify') . ' </span>
								<select name="setting-header_slider_default_display">
								';
								
								foreach($display_options as $option){
									if($option == $data['setting-header_slider_default_display']){
										$output .= '<option value="'.$option.'" selected="selected">'.$option.'</option>';
									} else {
										$output .= '<option value="'.$option.'">'.$option.'</option>';
									}
								}
								
			$output .= '
						</select>
					</p>';
					
			$output .= '<p class="feature_box_posts" '.$display_posts_display.'>
						<span class="label">' . __('隐藏标题', 'themify') . '</span>
						<select name="setting-header_slider_hide_title">
						';
						foreach($title_options as $name => $option){
							if($option == $data['setting-slider_hide_title']){
								$output .= '<option value="'.$option.'" selected="selected">'.$name.'</option>';
							} else {
								$output .= '<option value="'.$option.'">'.$name.'</option>';
							}
						}		
		$output .= '
						</select>
					</p>';
					
			$output .= '<div class="feature_box_images" '.$display_images_display.'>';
					
					$x = 0;
					foreach($image_options as $option){
						$x++;
						$output .= '
						<p>
							<span class="label">' . __('标题', 'themify') . ' '.$x.'</span>
							<input type="text" class="width10" name="setting-header_slider_images_'.$option.'_title" value="'.$data['setting-header_slider_images_'.$option.'_title'].'" />
							<span class="label">' . __('链接', 'themify') . ' '.$x.'</span>
							<input type="text" class="width10" name="setting-header_slider_images_'.$option.'_link" value="'.$data['setting-header_slider_images_'.$option.'_link'].'" />
							<span class="label">' . __('图片', 'themify') . ' '.$x.'</span>
							<input type="text" class="width10 feature_box_img" name="setting-header_slider_images_'.$option.'_image" value="'.$data['setting-header_slider_images_'.$option.'_image'].'" /> 
							<span class="pushlabel" style="display:block;"><a href="#" class="upload-btn upload-image simple" id="slider_image_'.$option.'">' . __('+ 上传', 'themify') . '</a></span>
						</p>';
					}
		
		$output .= '</div>
					<hr />
					<p>
						<span class="label">' . __('可见', 'themify') . '</span> 
						<select name="setting-header_slider_visible">';
						for($x=1;$x<=5;$x++){
							if($data['setting-header_slider_visible'] == $x){
								$output .= '<option value="'.$x.'" selected="selected">'.$x.'</option>';	
							} else {
								$output .= '<option value="'.$x.'">'.$x.'</option>';	
							}
						}
			$output .=	'</select> <small>' . __('(# 在同一时间可见幻灯片)', 'themify') . '</small>
					</p>
					<p>
					<span class="label">' . __('自动播放', 'themify') . '</span>
								<select name="setting-header_slider_auto">
								';
							foreach($auto_options as $option){
								if($option == $data['setting-header_slider_auto']){
									$output .= '<option value="'.$option.'" selected="selected">'.$option.'</option>';
								} else {
									$output .= '<option value="'.$option.'">'.$option.'</option>';
								}
							}		
			$output .= '
						</select> <small>' . __('(自动进幻灯片, 0 = off)', 'themify') . '</small>
					</p>
					<p>
					<span class="label">' . __('滚动', 'themify') . '</span>
								<select name="setting-header_slider_scroll">
								';
							foreach($scroll_options as $option){
								if($option == $data['setting-header_slider_scroll']){
									$output .= '<option value="'.$option.'" selected="selected">'.$option.'</option>';
								} else {
									$output .= '<option value="'.$option.'">'.$option.'</option>';
								}
							}		
			$output .= '
						</select>
					</p>
					<p>
						<span class="label">' . __('速度', 'themify') . '</span> 
						<select name="setting-header_slider_speed">';
						foreach($speed_options as $name => $val){
							if($data['setting-header_slider_speed'] == $val){
								$output .= '<option value="'.$val.'" selected="selected">'.$name.'</option>';	
							} else {
								$output .= '<option value="'.$val.'">'.$name.'</option>';	
							}	
						}
			$output .= '</select>
					</p>
					<p>
						<span class="label">' . __('幻灯片换行', 'themify') . '</span> 
						<select name="setting-header_slider_wrap">';
						foreach($wrap_options as $name){
							if($data['setting-header_slider_wrap'] == $name){
								$output .= '<option value="'.$name.'" selected="selected">'.$name.'</option>';	
							} else {
								$output .= '<option value="'.$name.'">'.$name.'</option>';	
							}
						}
			$output .=	'</select>
					</p>
					<hr />
					<p>
						<span class="label">' . __('特色图片尺寸', 'themify') . '</span>
						<input type="text" name="setting-header_slider_width" class="width2" value="'.$data['setting-header_slider_width'].'" /> ' . __('宽度', 'themify') . ' <small>(in px)</small>
						<input type="text" name="setting-header_slider_height" class="width2" value="'.$data['setting-header_slider_height'].'" /> ' . __('高度', 'themify') . ' <small>(in px)</small>
					</p>
					</div>';		
		return $output;
	}
	
	///////////////////////////////////////////
	// Header Slider Function - Action
	///////////////////////////////////////////
	function themify_header_slider_action($data=array()){
		$data = get_data();
		$wrap = 'false';
		if($data['setting-header_slider_wrap'] == 'yes'){
			$wrap = 'true';	
		}
		if($data['setting-header_slider_visible'] == ""){
			$visible = "1";	
		} else {
			$visible = $data['setting-header_slider_visible'];	
		}
		if('' == $data['setting-header_slider_speed']){
			$speed = '2500';
		} else {
			$speed = $data['setting-header_slider_speed'];
		}
		if($data['setting-header_slider_scroll'] == ""){
			$scroll = 1;	
		} else {
			$scroll = $data['setting-header_slider_scroll'];	
		}
		if($data['setting-header_slider_auto'] == ""){
			$auto = 0;	
		} else {
			$auto = $data['setting-header_slider_auto'];	
		}
		if( '0' == $auto )
			$play = 'false';
		else
			$play = 'true';
		
		?>
		<script type='text/javascript'>
		/////////////////////////////////////////////
		// Slider	 							
		/////////////////////////////////////////////
		jQuery(window).load(function(){
			
			if(jQuery('#header-slider').length > 0){
				jQuery('#header-slider .slides').carouFredSel({
					responsive: true,
					prev: '#header-slider .carousel-prev',
					next: '#header-slider .carousel-next',
					width: '100%',
					circular: <?php echo $wrap; ?>,
					infinite: <?php echo $wrap; ?>,
					auto: {
						play : <?php echo $play; ?>,
						pauseDuration: <?php echo $auto*1000; ?>,
						duration: <?php echo $speed; ?>
					},
					scroll: {
						items: <?php echo $scroll; ?>,
						duration: <?php echo $speed; ?>,
						wipe: true
					},
					items: {
						visible: {
							min: 1,
							max: <?php echo $visible; ?>
						},
						width: 150
					},
					onCreate : function (){
						jQuery('#header-slider').css( {
							'height': 'auto',
							'visibility' : 'visible'
						});
					}
				});
			}
			
		});
		</script>
        <?php
	}
	if(themify_check('setting-header_slider_enabled'))
		add_action('wp_footer', 'themify_header_slider_action');
		
	///////////////////////////////////////////
	// Footer Widgets Function
	///////////////////////////////////////////
	function themify_footer_widgets($data=array()){
		$data = get_data();
		$options = array(
			array("value" => "footerwidget-4col", "img" => "images/layout-icons/footerwidget-4col.png", "selected" => true),
			array("value" => "footerwidget-3col", "img" => "images/layout-icons/footerwidget-3col.png"),
			array("value" => "footerwidget-2col", "img" => "images/layout-icons/footerwidget-2col.png"),
			array("value" => "footerwidget-1col", "img" => "images/layout-icons/footerwidget-1col.png"),
			array("value" => "none",			  "img" => "images/layout-icons/none.png")
		);
		$val = $data['setting-footer_widgets'];
		$output = "";
		foreach($options as $option){
			if(($val == "" || !$val || !isset($val)) && $option['selected']){ 
				$val = $option['value'];
			}
			if($val == $option['value']){ 
				$class = "selected";
			} else {
				$class = "";	
			}
			$output .= '<a href="#" class="preview-icon '.$class.'"><img src="'.get_bloginfo('template_directory').'/'.$option['img'].'" alt="'.$option['value'].'"  /></a>';	
		}
		
		$output .= '<input type="hidden" name="setting-footer_widgets" class="val" value="'.$val.'" />';
		
		return $output;
	}

	///////////////////////////////////////////
	// Exclude RSS
	///////////////////////////////////////////
	function themify_exclude_rss($data=array()){
		$data = get_data();
		if($data['setting-exclude_rss']){
			$pages_checked = "checked='checked'";	
		}
		return '<p><input type="checkbox" name="setting-exclude_rss" '.$pages_checked.'/> ' . __('在这里检查排除RSS 图标/按钮', 'themify') . '</p>';	
	}

	///////////////////////////////////////////
	// Exclude Search Form
	///////////////////////////////////////////
	function themify_exclude_search_form($data=array()){
		$data = get_data();
		if($data['setting-exclude_search_form']){
			$pages_checked = "checked='checked'";	
		}
		return '<p><input type="checkbox" name="setting-exclude_search_form" '.$pages_checked.'/> ' . __('检查排除搜索表单', 'themify') . '</p>';	
	}

	///////////////////////////////////////////
	// Default Page Layout Module
	///////////////////////////////////////////
	function themify_default_page_layout($data=array()){
		$data = get_data();
		
		$options = array(
			array("value" => "sidebar1", "img" => "images/layout-icons/sidebar1.png", "selected" => true),
			array("value" => "sidebar1 sidebar-left", "img" => "images/layout-icons/sidebar1-left.png"),
			array("value" => "sidebar-none", "img" => "images/layout-icons/sidebar-none.png")
		);
		
		$default_options = array(
			array('name'=>'','value'=>''),
			array('name'=>__('是', 'themify'),'value'=>'yes'),
			array('name'=>__('否', 'themify'),'value'=>'no')
		);
							 
		$val = $data['setting-default_page_layout'];
		
		$output .= '<p>
						<span class="label">' . __('页边栏选项', 'themify') . '</span>';
		foreach($options as $option){
			if(($val == "" || !$val || !isset($val)) && $option['selected']){ 
				$val = $option['value'];
			}
			if($val == $option['value']){ 
				$class = "selected";
			} else {
				$class = "";	
			}
			$output .= '<a href="#" class="preview-icon '.$class.'"><img src="'.get_bloginfo('template_directory').'/'.$option['img'].'" alt="'.$option['value'].'"  /></a>';	
		}
		$output .= '<input type="hidden" name="setting-default_page_layout" class="val" value="'.$val.'" /></p>';
		$output .= '<p>
						<span class="label">' . __('隐藏所有页面的标题', 'themify') . '</span>
						
						<select name="setting-hide_page_title">';
						foreach($default_options as $title_option){
							if($title_option['value'] == $data['setting-hide_page_title']){
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
						
						
		$output .=	'</select>
					</p>';
		if($data['setting-comments_pages']){
			$pages_checked = "checked='checked'";	
		}
		$output .= '<p><span class="label">' . __('页评论', 'themify') . '</span><input type="checkbox" name="setting-comments_pages" '.$pages_checked.' /> ' . __('禁止在所有页面的评论', 'themify') . '</p>';	
		
		return $output;													 
	}
	
	///////////////////////////////////////////
	// Default Index Layout Module
	///////////////////////////////////////////
	function themify_default_layout($data=array()){
		$data = get_data();
		
		if($data['setting-default_more_text'] == ""){
			$more_text = __('更多', 'themify');
		} else {
			$more_text = $data['setting-default_more_text'];
		}
		
		$default_options = array(
								array('name'=>'','value'=>''),
								array('name'=>__('是', 'themify'),'value'=>'yes'),
								array('name'=>__('否', 'themify'),'value'=>'no')
								);
		$default_layout_options = array(
								array('name' => __('内容', 'themify'),'value'=>'content'),
								array('name' => __('摘要', 'themify'),'value'=>'excerpt'),
								array('name' => __('无', 'themify'),'value'=>'none')
								);	
		$default_post_layout_options = array(
			array("value" => "list-post", "img" => "images/layout-icons/list-post.png", "selected" => true),
			array("value" => "grid4", "img" => "images/layout-icons/grid4.png"),
			array("value" => "grid3", "img" => "images/layout-icons/grid3.png"),
			array("value" => "grid2", "img" => "images/layout-icons/grid2.png"),
			array("value" => "list-large-image", "img" => "images/layout-icons/list-large-image.png"),
			array("value" => "list-thumb-image", "img" => "images/layout-icons/list-thumb-image.png"),
			array("value" => "grid2-thumb", "img" => "images/layout-icons/grid2-thumb.png")
		);
																 	 
		$options = array(
			array("value" => "sidebar1", "img" => "images/layout-icons/sidebar1.png", "selected" => true),
			array("value" => "sidebar1 sidebar-left", "img" => "images/layout-icons/sidebar1-left.png"),
			array("value" => "sidebar-none", "img" => "images/layout-icons/sidebar-none.png")
		);
						 
		$val = $data['setting-default_layout'];
		
		$output = "";
		
		$output .= '<p>
						<span class="label">' . __('存档侧边栏选项', 'themify') . '</span>';
		foreach($options as $option){
			if(($val == "" || !$val || !isset($val)) && $option['selected']){ 
				$val = $option['value'];
			}
			if($val == $option['value']){ 
				$class = "selected";
			} else {
				$class = "";	
			}
			$output .= '<a href="#" class="preview-icon '.$class.'"><img src="'.get_bloginfo('template_directory').'/'.$option['img'].'" alt="'.$option['value'].'"  /></a>';	
		}
		
		$output .= '<input type="hidden" name="setting-default_layout" class="val" value="'.$val.'" />';
		$output .= '</p>';
		$output .= '<p><span class="label">' . __('文字布局', 'themify') . '</span>';
						
		$val = $data['setting-default_post_layout'];
		
		foreach($default_post_layout_options as $option){
			if(($val == "" || !$val || !isset($val)) && $option['selected']){ 
				$val = $option['value'];
			}
			if($val == $option['value']){ 
				$class = "selected";
			} else {
				$class = "";	
			}
			$output .= '<a href="#" class="preview-icon '.$class.'"><img src="'.get_bloginfo('template_directory').'/'.$option['img'].'" alt="'.$option['value'].'"  /></a>';	
		}
		
		$output .= '<input type="hidden" name="setting-default_post_layout" class="val" value="'.$val.'" />
					</p>
					<p>
						<span class="label">' . __('显示内容', 'themify') . '</span> 
						<select name="setting-default_layout_display">';
						foreach($default_layout_options as $layout_option){
							if($layout_option['value'] == $data['setting-default_layout_display']){
								$output .= '<option selected="selected" value="'.$layout_option['value'].'">'.$layout_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$layout_option['value'].'">'.$layout_option['name'].'</option>';
							}
						}
		$output .=	'	</select>
					</p>
					<p>
						<span class="label">' . __('查询分类', 'themify') . '</span>  
						<input type="text" name="setting-default_query_cats" value="'.$data['setting-default_query_cats'].'"><br />
						<span class="pushlabel"><small>' . __('使用减号（ - ）来排除类别。', 'themify') . '</small></span><br />
						<span class="pushlabel"><small>' . __('例如："1,4，-7"只包括第1类，第4排除7类。', 'themify') . '</small></span>
					</p>
					<p>
						<span class="label">' . __('更多内容', 'themify') . '</span>
						<input type="text" name="setting-default_more_text" value="'.$more_text.'">
					</p>
					<p>
						<span class="label">' . __('隐藏文章标题', 'themify') . '</span>
						
						<select name="setting-default_post_title">';
						foreach($default_options as $title_option){
							if($title_option['value'] == $data['setting-default_post_title']){
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('去文章标题链接', 'themify') . '</span>
						
						<select name="setting-default_unlink_post_title">';
						foreach($default_options as $title_option){
							if($title_option['value'] == $data['setting-default_unlink_post_title']){
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('隐藏文章Meta', 'themify') . '</span>
						
						<select name="setting-default_post_meta">';
						foreach($default_options as $title_option){
							if($title_option['value'] == $data['setting-default_post_meta']){
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('隐藏文章日期', 'themify') . '</span>
						
						<select name="setting-default_post_date">';
						foreach($default_options as $title_option){
							if($title_option['value'] == $data['setting-default_post_date']){
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('隐藏特色图片', 'themify') . '</span>
						
						<select name="setting-default_post_image">';
						foreach($default_options as $title_option){
							if($title_option['value'] == $data['setting-default_post_image']){
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('去特色图片链接', 'themify') . '</span>
						
						<select name="setting-default_unlink_post_image">';
						foreach($default_options as $title_option){
							if($title_option['value'] == $data['setting-default_unlink_post_image']){
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>';
		
		$output .= themify_feature_image_sizes_select('image_post_feature_size');
		$data = get_data();
		$options = array("left","right");
		
		if($data['setting-post_image_single_disabled']){
			$checked = 'checked="checked"';
		}
		
		$output .= '<p>
						<span class="label">' . __('图片尺寸', 'themify') . '</span>  
						<input type="text" class="width2" name="setting-image_post_width" value="'.$data['setting-image_post_width'].'" /> ' . __('宽度', 'themify') . ' <small>(px)</small>  
						<input type="text" class="width2" name="setting-image_post_height" value="'.$data['setting-image_post_height'].'" /> ' . __('高度', 'themify') . ' <small>(px)</small>
					</p>
					<p>
						<span class="label">' . __('图片对齐', 'themify') . '</span>
						<select name="setting-image_post_align">
							<option></option>';
		foreach($options as $option){
			if($option == $data['setting-image_post_align']){
				$output .= '<option value="'.$option.'" selected="selected">'.$option.'</option>';
			} else {
				$output .= '<option value="'.$option.'">'.$option.'</option>';
			}
		}
		$output .=	'</select>
					</p>
					';
		return $output;
	}
	
	///////////////////////////////////////////
	// Default Single ' . __('Post Layout', 'themify') . ' Module
	///////////////////////////////////////////
	function themify_default_post_layout($data=array()){
		
		$data = get_data();
		
		$default_options = array(
								array('name'=>'','value'=>''),
								array('name'=>__('是', 'themify'),'value'=>'yes'),
								array('name'=>__('否', 'themify'),'value'=>'no')
							);
		
		$val = $data['setting-default_page_post_layout'];

		$output .= '<p>
						<span class="label">' . __('图片对齐', 'themify') . '</span>';
						
		$options = array(
			array("value" => "sidebar1", 	"img" => "images/layout-icons/sidebar1.png", "selected" => true),
			array("value" => "sidebar1 sidebar-left", 	"img" => "images/layout-icons/sidebar1-left.png"),
			array("value" => "sidebar-none",	 	"img" => "images/layout-icons/sidebar-none.png")
		);
										
		foreach($options as $option){
			if(($val == "" || !$val || !isset($val)) && $option['selected']){ 
				$val = $option['value'];
			}
			if($val == $option['value']){ 
				$class = "selected";
			} else {
				$class = "";	
			}
			$output .= '<a href="#" class="preview-icon '.$class.'"><img src="'.get_bloginfo('template_directory').'/'.$option['img'].'" alt="'.$option['value'].'"  /></a>';	
		}
		
		$output .= '<input type="hidden" name="setting-default_page_post_layout" class="val" value="'.$val.'" />';
		$output .= '</p>
					<p>
						<span class="label">' . __('隐藏文章标题', 'themify') . '</span>
						
						<select name="setting-default_page_post_title">';
						foreach($default_options as $title_option){
							if($title_option['value'] == $data['setting-default_page_post_title']){
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('去文章标题链接', 'themify') . '</span>
						
						<select name="setting-default_page_unlink_post_title">';
						foreach($default_options as $title_option){
							if($title_option['value'] == $data['setting-default_page_unlink_post_title']){
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('隐藏文章Meta', 'themify') . '</span>
						
						<select name="setting-default_page_post_meta">';
						foreach($default_options as $title_option){
							if($title_option['value'] == $data['setting-default_page_post_meta']){
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('隐藏文章日期', 'themify') . '</span>
						
						<select name="setting-default_page_post_date">';
						foreach($default_options as $title_option){
							if($title_option['value'] == $data['setting-default_page_post_date']){
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('隐藏特色图片', 'themify') . '</span>
						
						<select name="setting-default_page_post_image">';
						foreach($default_options as $title_option){
							if($title_option['value'] == $data['setting-default_page_post_image']){
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p><p>
						<span class="label">' . __('去特色图片链接', 'themify') . '</span>
						
						<select name="setting-default_page_unlink_post_image">';
						foreach($default_options as $title_option){
							if($title_option['value'] == $data['setting-default_page_unlink_post_image']){
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .= '</select></p>';
		$output .= themify_feature_image_sizes_select('image_post_single_feature_size');
		$output .= '<p>
				<span class="label">' . __('图片尺寸', 'themify') . '</span>
						<input type="text" class="width2" name="setting-image_post_single_width" value="'.$data['setting-image_post_single_width'].'" /> ' . __('宽度', 'themify') . ' <small>(px)</small>  
						<input type="text" class="width2" name="setting-image_post_single_height" value="'.$data['setting-image_post_single_height'].'" /> ' . __('高度', 'themify') . ' <small>(px)</small>
					</p>
					<p>
						<span class="label">' . __('图片对齐', 'themify') . '</span>
						<select name="setting-image_post_single_align">
							<option></option>';
		$options = array("left","right");
		foreach($options as $option){
			if($option == $data['setting-image_post_single_align']){
				$output .= '<option value="'.$option.'" selected="selected">'.$option.'</option>';
			} else {
				$output .= '<option value="'.$option.'">'.$option.'</option>';
			}
		}
		$output .=	'</select>
					</p>';
		if($data['setting-comments_posts']){
			$comments_posts_checked = "checked='checked'";	
		}
		$output .= '<p><span class="label">' . __('文章评论', 'themify') . '</span><input type="checkbox" name="setting-comments_posts" '.$comments_posts_checked.' /> ' . __('在所有的帖子中禁用评论', 'themify') . '</p>';	
		
		if($data['setting-post_author_box']){
			$author_box_checked = "checked='checked'";	
		}
		$output .= '<p><span class="label">' . __('Show Author Box', 'themify') . '</span><input type="checkbox" name="setting-post_author_box" '.$author_box_checked.' /> ' . __('只看该作者中的所有文章', 'themify') . '</p>';	
			
		return $output;
	}

?>
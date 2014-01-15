<div id="sidebar">

	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>

		<div class="widget">
			<h4 class="widgettitle"><?php _e('页面','themify'); ?></h4>
			<ul>
			<?php wp_list_pages('title_li=' ); ?>
			</ul>
		</div>

		<div class="widget">
			<h4 class="widgettitle"><?php _e('分类','themify'); ?></h4>
			<ul>
			<?php wp_list_categories('show_count=1&title_li='); ?>
			</ul>
		</div>

	<?php endif; ?>

</div>
<!--/sidebar -->

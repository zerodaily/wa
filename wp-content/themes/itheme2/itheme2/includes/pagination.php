<?php if(function_exists('themify_pagenav')){ ?>
	<?php themify_pagenav(); ?> 
<?php } else { ?>
	<div class="post-nav">
		<span class="prev"><?php next_posts_link(__('&laquo; 旧条目', 'themify')) ?></span>
		<span class="next"><?php previous_posts_link(__('较新的条目 &raquo;', 'themify')) ?></span>
	</div>
<?php } ?>
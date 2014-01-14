<?php
/**
 * Random post button function
 *
 * @package WordPress
 * @subpackage GoodInc
 * @since 1.0
*/


add_action('init','wpex_random_add_rewrite');
add_action('template_redirect','wpex_random_template');

	function wpex_random_add_rewrite() {
		global $wp;
		$wp->add_query_var('random');
		add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
	}	
	
	function wpex_random_template() {
		if (get_query_var('random') == 1) {
		$posts = get_posts('post_type=post&orderby=rand&numberposts=1');
		foreach($posts as $post) {
			$link = get_permalink($post);
		}
		wp_redirect($link,307);
		exit;
	}
	
}
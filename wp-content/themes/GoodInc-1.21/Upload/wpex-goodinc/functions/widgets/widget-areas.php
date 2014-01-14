<?php
/**
 * Define sidebars for use in this theme
 * @package GoodInc WordPress Theme
 * @since 1.0
 * @author WPExplorer : http://www.wpexplorer.com

 * @author WPExplorer : http://www.wpexplorer.com */


//SIDEBAR
register_sidebar(array(
	'name' 			=> __( 'Sidebar','wpex'),
	'id' 			=> 'sidebar',
	'description' 	=> __( 'Widgets in this area are used on the main sidebar region.','wpex' ),
	'before_widget'	=> '<div class="sidebar-box %2$s">',
	'after_widget' 	=> '<div class="clear"></div></div>',
	'before_title'	=> '<h6>',
	'after_title'	=> '</h6>',
));
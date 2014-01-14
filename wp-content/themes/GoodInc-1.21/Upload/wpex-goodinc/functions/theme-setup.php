<?php
/**
 * Setup the main theme functions
 *
 * @package WordPress
 * @subpackage GoodInc
 * @since 1.0
 */
 

add_action( 'after_setup_theme', 'wpex_theme_setup' );
function wpex_theme_setup() {
	
	// Localization support
	load_theme_textdomain( 'wpex', get_template_directory() .'/languages' );

	// Register navigation menus
	register_nav_menus (
		array(
			'main'		=> __( 'Main', 'wpex' ),
			'footer'	=> __( 'Footer', 'wpex' ),
		)
	);
		
	// Add theme support
	add_theme_support( 'post-formats', array( 'image', 'video', 'quote', 'link', 'aside', 'status', 'audio', 'gallery' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header', array(
		'header-text'	=> false
	) );

}
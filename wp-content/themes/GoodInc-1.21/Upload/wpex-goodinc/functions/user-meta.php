<?php
/**
 * Custom User profile settings
 * Enables more fields (twitter,facebook,etc)
 *
 * @package WordPress
 * @subpackage GoodInc
 * @since 1.0
 */

if ( !function_exists( 'wpex_add_user_fields' ) ) {
	add_filter( 'user_contactmethods', 'wpex_add_user_fields', 10, 1 );
	function wpex_add_user_fields( $contactmethods ) {
		
	 // Add Twitter
	if ( !isset( $contactmethods['wpex_twitter'] ) )
		$contactmethods['wpex_twitter'] = 'Twitter URL';
		
	// Add Facebook
	if ( !isset( $contactmethods['wpex_facebook'] ) )
		$contactmethods['wpex_facebook'] = 'Facebook URL';
		
	// Add GoglePlus
	if ( !isset( $contactmethods['wpex_googleplus'] ) )
		$contactmethods['wpex_googleplus'] = 'Google+ URL';
		
	// Add GoglePlus
	if ( !isset( $contactmethods['wpex_pinterest'] ) )
		$contactmethods['wpex_pinterest'] = 'Pinterest URL';
	
	  return $contactmethods;
	}
}
?>
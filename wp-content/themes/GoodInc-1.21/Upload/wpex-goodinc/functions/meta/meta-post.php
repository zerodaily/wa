<?php
/**
 * Create meta options for the post post type
 *
 * @package WordPress
 * @subpackage GoodInc
 */
 
$prefix = 'wpex_';

$wpex_post_meta = array(
	'id' 		=> 'wpex-post-meta',
	'title' 	=>  __( 'Post Settings', 'wpex' ),
	'page' 		=> 'post',
	'context' 	=> 'normal',
	'priority'	=> 'high',
	'fields'	=> array(
		array(
           'name'		=> __( 'Post Layout', 'wpex' ),
           'id'		=> $prefix . 'post_layout',
			'desc'		=> __( 'Select your desired layout.', 'wpex' ),
           'type'		=> 'select',
           'options'	=> array( 'Right Sidebar', 'Left Sidebar', 'Full Width' ),
			'std'		=> 'Right Sidebar'
        ),
		array(
           'name'		=> __('Media Size', 'wpex'),
           'id'		=> $prefix . 'post_media_size',
			'desc'		=> __( 'Select your desired media size.', 'wpex' ),
			'std'		=> '',
            'type'		=> 'select',
			'options'	=> array ( 'standard', 'full' )
        ),
		array(
           'name'		=> __( 'Link URL', 'wpex' ),
           'id'		=> $prefix . 'post_url',
			'desc'		=> __( 'Enter the url for your link format URL.', 'wpex' ),
			'std'		=> '',
           'type'		=> 'text',
        ),
		array(
           'name'		=> __( 'Quote Author', 'wpex' ),
           'id'		=> $prefix . 'quote_author',
			'desc'		=> __( 'Enter the author of the quote.', 'wpex' ),
			'std'		=> '',
           'type'		=> 'text',
        ),
		array(
            'name'		=> __( 'oEmbed URL', 'wpex' ),
            'id'		=> $prefix . 'post_oembed',
            'desc'		=>  __( 'Enter in a URL that is compatible with WordPress\'s built-in oEmbed feature. Video, audio and status post formats make use of this field.', 'wpex') .' <a href="http://codex.wordpress.org/Embeds" target="_blank">'. __( 'Learn More', 'wpex' ),
			'std'		=> '',
            'type'		=> 'text',
        ),
	),
);

/*-----------------------------------------------------------------------------------*/
// Display meta box in edit post page
/*-----------------------------------------------------------------------------------*/

add_action('admin_menu', 'wpex_add_post_meta');

function wpex_add_post_meta() {
	global $wpex_post_meta;
	
	add_meta_box($wpex_post_meta['id'], $wpex_post_meta['title'], 'wpex_show_post_meta', $wpex_post_meta['page'], $wpex_post_meta['context'], $wpex_post_meta['priority']);

}

/*-----------------------------------------------------------------------------------*/
//	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function wpex_show_post_meta() {
	global $wpex_post_meta, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="wpex_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($wpex_post_meta['fields'] as $field) {
		
		// get current post meta data & set default value if empty
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		if (empty ($meta)) {
			$meta = $field['std']; 
		}
		
		switch ($field['type']) {
			
			//If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#777; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If Select	
			case 'select':
			
				echo '<tr>',
				'<tr style="border-bottom:1px solid #eeeeee;">',
				'<th style="width:50%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#777; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				echo'<select name="'.$field['id'].'">';
			
				foreach ($field['options'] as $option) {
					
					echo'<option';
					if ($meta == $option ) { 
						echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				
				} 
				
				echo'</select>';

		}

	}
 
	echo '</table>';
}
 
add_action('save_post', 'wpex_save_post_meta_data');

/*-----------------------------------------------------------------------------------*/
//	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
 
function wpex_save_post_meta_data($post_id) {
	global $wpex_post_meta;
	
	if(!isset($_POST['wpex_meta_box_nonce'])) $_POST['wpex_meta_box_nonce'] = "undefine";
 
	// verify nonce
	if (!wp_verify_nonce($_POST['wpex_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	//Save fields
	foreach ($wpex_post_meta['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}
?>
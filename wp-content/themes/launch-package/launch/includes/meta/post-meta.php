<?php

/**
 * Create the Post meta boxes
 */
 
add_action('add_meta_boxes', 'zilla_metabox_posts');
function zilla_metabox_posts(){
    
    /* Create an image metabox -------------------------------------------------------*/
	$meta_box = array(
		'id' => 'zilla-metabox-post-image',
		'title' =>  __('Image & Display Settings', 'zilla'),
		'description' => __('Upload images to this portfolio using the below controls. Please note that the Featured Image will be used as the "cover" image and will be skipped in the gallery.', 'zilla'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
    		array(
    				'name' =>  __('Upload Images', 'zilla'),
    				'desc' => __('Click to upload images to this post.', 'zilla'),
    				'id' => '_zilla_image_upload',
    				'type' => 'images',
    				'std' => __('Upload Images', 'zilla')
    			)
		)
	);
    zilla_add_meta_box( $meta_box );
    
    /* Create a quote metabox -----------------------------------------------------*/
    $meta_box = array(
		'id' => 'zilla-metabox-post-quote',
		'title' =>  __('Quote Settings', 'zilla'),
		'description' => __('Input your quote.', 'zilla'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' =>  __('The Quote', 'zilla'),
					'desc' => __('Input your quote.', 'zilla'),
					'id' => '_zilla_quote_quote',
					'type' => 'textarea',
                    'std' => ''
				)
		)
	);
    zilla_add_meta_box( $meta_box );
	
	/* Create a link metabox ----------------------------------------------------*/
	$meta_box = array(
		'id' => 'zilla-metabox-post-link',
		'title' =>  __('Link Settings', 'zilla'),
		'description' => __('Input your link', 'zilla'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' =>  __('The Link', 'zilla'),
					'desc' => __('Insert your link URL, e.g. http://www.themezilla.com.', 'zilla'),
					'id' => '_zilla_link_url',
					'type' => 'text',
					'std' => ''
				)
		)
	);
    zilla_add_meta_box( $meta_box );
    
    /* Create a video metabox -------------------------------------------------------*/
    $meta_box = array(
		'id' => 'zilla-metabox-post-video',
		'title' => __('Video Settings', 'zilla'),
		'description' => __('These settings enable you to embed videos into your posts.', 'zilla'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => __('Video Height', 'zilla'),
					'desc' => __('The video height (e.g. 500).', 'zilla'),
					'id' => '_zilla_video_height',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('M4V File URL', 'zilla'),
					'desc' => __('The URL to the .m4v video file', 'zilla'),
					'id' => '_zilla_video_m4v',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('OGV File URL', 'zilla'),
					'desc' => __('The URL to the .ogv video file', 'zilla'),
					'id' => '_zilla_video_ogv',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Poster Image', 'zilla'),
					'desc' => __('The preview image. The preview image should be 500px wide.', 'zilla'),
					'id' => '_zilla_video_poster_url',
					'type' => 'text',
					'std' => ''
				),
			array(
					'name' => __('Embedded Code', 'zilla'),
					'desc' => __('If you are using something other than self hosted video such as Youtube or Vimeo, paste the embed code here. Width is best at 500px with any height.<br><br> This field will override the above.', 'zilla'),
					'id' => '_zilla_video_embed_code',
					'type' => 'textarea',
					'std' => ''
				)
		)
	);
	zilla_add_meta_box( $meta_box );
	
	/* Create an audio metabox ------------------------------------------------------*/
	$meta_box = array(
		'id' => 'zilla-metabox-post-audio',
		'title' =>  __('Audio Settings', 'zilla'),
		'description' => __('These settings enable you to embed audio into your posts. You must provide both .mp3 and .agg/.oga file formats in order for self hosted audio to function accross all browsers.', 'zilla'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => __('MP3 File URL', 'zilla'),
					'desc' => __('The URL to the .mp3 audio file', 'zilla'),
					'id' => '_zilla_audio_mp3',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('OGA File URL', 'zilla'),
					'desc' => __('The URL to the .oga, .ogg audio file', 'zilla'),
					'id' => '_zilla_audio_ogg',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Audio Poster Image', 'zilla'),
					'desc' => __('The preview image for this audio track. Image width should be 500px.', 'zilla'),
					'id' => '_zilla_audio_poster_url',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Audio Poster Image Height', 'zilla'),
					'desc' => __('The height of the poster image', 'zilla'),
					'id' => '_zilla_audio_height',
					'type' => 'text',
					'std' => ''
				)
		)
	);
	zilla_add_meta_box( $meta_box );
}
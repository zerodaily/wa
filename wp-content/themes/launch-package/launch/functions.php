<?php

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-------------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*  Set Max Content Width (use in conjuction with ".entry-content img" css)
/* ----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) )
	$content_width = 540;


/*-----------------------------------------------------------------------------------*/
/*	Our theme set up
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_theme_setup' ) ) {
    function zilla_theme_setup() {
        
        /* Load translation domain --------------------------------------------------*/
    	load_theme_textdomain( 'zilla', TEMPLATEPATH . '/languages' );
        
        $locale = get_locale();
    	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
    	if ( is_readable( $locale_file ) )
    		require_once( $locale_file );
    		
    	/* Configure WP 2.9+ Thumbnails ---------------------------------------------*/
    	add_theme_support( 'post-thumbnails' );
    	set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails
    	add_image_size( 'thumbnail-large', 500, '', false); // for use on blog pages
    	
    	/* Add support for post formats ---------------------------------------------*/
    	/* 
         * To add an admin UI to the post formats, use Alex King's plugin at
         * https://github.com/crowdfavorite/wp-post-formats 
         */
        add_theme_support( 
            'post-formats', 
            array(
                'aside',
                'gallery',
                'image',
                'link',
                'quote',
                'video',
                'audio'
            ) 
        );
    }
}
add_action( 'after_setup_theme', 'zilla_theme_setup' );


/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_sidebars_init' ) ) {

    function zilla_sidebars_init() {
    	register_sidebar(array(
    		'name' => __('Main Sidebar', 'zilla'),
    		'id' => 'sidebar-main',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<h3 class="widget-title"><span>',
    		'after_title' => '</span></h3>',
    	));
	}
	
}
add_action( 'widgets_init', 'zilla_sidebars_init' );


/*-----------------------------------------------------------------------------------*/
/*	Change Default Excerpt Length (uncomment if required)
/*-----------------------------------------------------------------------------------*/

/*if ( !function_exists( 'zilla_excerpt_length' ) ) {
	function zilla_excerpt_length($length) {
		return 55; 
	}
}
add_filter('excerpt_length', 'zilla_excerpt_length');
*/


/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_excerpt_more' ) ) {
	function zilla_excerpt_more($excerpt) {
		return str_replace('[...]', '...', $excerpt); 
	}
}
add_filter('wp_trim_excerpt', 'zilla_excerpt_more');


/*-----------------------------------------------------------------------------------*/
/*	Custom More Link Output
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_custom_more_link' ) ) {
    function zilla_custom_more_link($more_link, $more_link_text) {
        return str_replace($more_link_text, "<span>$more_link_text</span>", $more_link);
   }
}
add_filter('the_content_more_link', 'zilla_custom_more_link', 10, 2);


/*-----------------------------------------------------------------------------------*/
/*	Configure Default Title
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_wp_title' ) ) {
	function zilla_wp_title($title) {
		if( !zilla_is_third_party_seo() ){
			if( is_front_page() ){
				return get_bloginfo('name') .' | '. get_bloginfo('description'); 
			} else {
				return trim($title) .' | '. get_bloginfo('name'); 
			}
		}
		return $title;
	}
}
add_filter('wp_title', 'zilla_wp_title');


/*-----------------------------------------------------------------------------------*/
/*	Register and load JS
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_enqueue_scripts' ) ) {
	function zilla_enqueue_scripts() {
	    /* Register our scripts -----------------------------------------------------*/
		wp_register_script('validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery', '1.9', true);
		wp_register_script('jplayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js', 'jquery', '2.1');
		wp_register_script('slides', get_template_directory_uri() . '/js/slides.min.jquery.js', 'jquery', '1.1.9');
		wp_register_script('respond', get_template_directory_uri() . '/js/respond.min.js', '', '1.1', TRUE);
		
		/* Enqueue our scripts ------------------------------------------------------*/
		wp_enqueue_script('jquery');
		wp_enqueue_script('jplayer');
		wp_enqueue_script('slides');
		wp_enqueue_script('respond');
		
		if( is_singular() ) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 
		if( is_page_template('template-contact.php') ) wp_enqueue_script('validation');
	}
}
add_action('wp_enqueue_scripts', 'zilla_enqueue_scripts');


/*-----------------------------------------------------------------------------------*/
/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_enqueue_admin_scripts' ) ) {
    function zilla_enqueue_admin_scripts() {
        wp_register_script( 'zilla-admin', get_template_directory_uri() . '/includes/js/jquery.custom.admin.js', 'jquery' );
        wp_enqueue_script( 'zilla-admin' );
    }
}
add_action( 'admin_enqueue_scripts', 'zilla_enqueue_admin_scripts' );


/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_comment' ) ) {
	function zilla_comment($comment, $args, $depth) {
	
        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

            <div id="comment-<?php comment_ID(); ?>">
                <span class="avatar"><?php echo get_avatar($comment,$size='40'); ?></span>
                <div class="comment-author vcard">
                    <?php printf(__('<cite class="fn">%s</cite>', 'zilla'), get_comment_author_link()) ?>
                </div>

                    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'zilla'),'  ','') ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>

                <?php if ($comment->comment_approved == '0') { ?>
                    <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'zilla') ?></em>
                    <br />
                <?php } ?>

                <div class="comment-body">
                <?php comment_text() ?>
                </div>

            </div>
	<?php
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_list_pings' ) ) {
	function zilla_list_pings($comment, $args, $depth) {
	    $GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
		<?php 
	}
}


/*-----------------------------------------------------------------------------------*/
/*  Output gallery slideshow
/*
/*  @param int $postid the post id
/*  @param int $imagesize the image size 
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_gallery' ) ) {
    function zilla_gallery($postid, $imagesize) { ?>
        <script type="text/javascript">
    		jQuery(document).ready(function($){
    		    // fire slides
    			$("#slider-<?php echo $postid; ?>").slides({
    				preload: true,
    				preloadImage: $("#slider-<?php echo $postid; ?>").attr('data-loader'), 
    				generatePagination: false,
    				generateNextPrev: true,
    				next: 'slides_next',
    				prev: 'slides_prev',
    				effect: 'fade',
    				crossfade: true,
    				autoHeight: true,
    				bigTarget: true,
    				animationComplete: function(current) {
                        var myImgs = $("#slider-<?php echo $postid; ?>").find('img'),
                            myTitle = myImgs[current-1].title;

    				    $("#slider-<?php echo $postid; ?>").next('.entry-title').html(myTitle);
    				}
    			});
    			
    			// set title of first image
                var firstTitle = $("#slider-<?php echo $postid; ?>").find('img').first().attr('title');
                $("#slider-<?php echo $postid; ?>").next('.entry-title').text(firstTitle);
    		});
    	</script>
    <?php 
        $loader = 'ajax-loader.gif';
        $thumbid = 0;
    
        // get the featured image for the post
        if( has_post_thumbnail($postid) ) {
            $thumbid = get_post_thumbnail_id($postid);
        }
        echo "<!-- BEGIN #slider-$postid -->\n<div id='slider-$postid' class='slider' data-loader='" . get_template_directory_uri() . "/images/$loader'>";
        
        $posttitle = the_title_attribute( array( 'echo' => 0 ) );
        
        // get all of the attachments for the post
        $args = array(
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1
        );
        $attachments = get_posts($args);
        if( !empty($attachments) ) {
            echo '<div class="slides_container">';
            $i = 0;
            foreach( $attachments as $attachment ) {
                if( $attachment->ID == $thumbid ) continue;
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $caption = $attachment->post_excerpt;
                $caption = ($caption) ? $caption : $posttitle;
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<div><img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' title='$caption' /></div>";
                $i++;
            }
            echo '</div>';
        }
        echo "<!-- END #slider-$postid -->\n</div>";
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Output Audio
/* 
/*  @param int $postid the post id
/*  @param int $width the width of the audio player
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_audio' ) ) {
    function zilla_audio($postid, $width = 560) {
	
    	$mp3 = get_post_meta($postid, '_zilla_audio_mp3', TRUE);
    	$ogg = get_post_meta($postid, '_zilla_audio_ogg', TRUE);
    	$poster = get_post_meta($postid, '_zilla_audio_poster_url', TRUE);
    	$height = get_post_meta($postid, '_zilla_audio_height', TRUE);
    	$height = ($height) ? $height : 75;
	
    ?>

    		<script type="text/javascript">
		
    			jQuery(document).ready(function($){
	
    				if($().jPlayer) {
    					$("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
    						ready: function () {
    							$(this).jPlayer("setMedia", {
    							    <?php if($poster != '') : ?>
    							    poster: "<?php echo $poster; ?>",
    							    <?php endif; ?>
    							    <?php if($mp3 != '') : ?>
    								mp3: "<?php echo $mp3; ?>",
    								<?php endif; ?>
    								<?php if($ogg != '') : ?>
    								oga: "<?php echo $ogg; ?>",
    								<?php endif; ?>
    								end: ""
    							});
    						},
    						size: {
            				    width: "<?php echo $width; ?>px",
            				    height: "<?php echo $height . 'px'; ?>"
            				},
    						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
    						cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
    						supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
    					});
					    
					    $('#jquery_jplayer_<?php echo $postid; ?>').bind($.jPlayer.event.playing, function(event) {
            			    $(this).add('#jp_interface_<?php echo $postid; ?>').hover( function() {
            			        $('#jp_interface_<?php echo $postid; ?>').stop().animate({ opacity: 1 }, 400);
        			        }, function() {
        			            $('#jp_interface_<?php echo $postid; ?>').stop().animate({ opacity: 0 }, 400);
        			        });
            			});

            			$('#jquery_jplayer_<?php echo $postid; ?>').bind($.jPlayer.event.pause, function(event) {
            			    $('#jquery_jplayer_<?php echo $postid; ?>').add('#jp_interface_<?php echo $postid; ?>').unbind('hover');

            			    $('#jp_interface_<?php echo $postid; ?>').stop().animate({ opacity: 1 }, 400);

            			});
    				}
    			});
    		</script>
		
    	    <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-audio"></div>

            <div class="jp-audio-container">
                <div class="jp-audio">
                    <div class="jp-type-single">
                        <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                            <ul class="jp-controls">
                            	<li><div class="seperator-first"></div></li>
                                <li><div class="seperator-second"></div></li>
                                <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                                <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                                <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                                <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                            </ul>
                            <div class="jp-progress-container">
                                <div class="jp-progress">
                                    <div class="jp-seek-bar">
                                        <div class="jp-play-bar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="jp-volume-bar-container">
                                <div class="jp-volume-bar">
                                    <div class="jp-volume-bar-value"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	<?php 
    }
}


/*-----------------------------------------------------------------------------------*/
/*  Output video
/*
/*  @param int $postid the post id
/*  @param int $width the width of the video player
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_video' ) ) {
    function zilla_video($postid, $width = 560) {
	
    	$height = get_post_meta($postid, '_zilla_video_height', true);
    	$height = ($height) ? $height : 435;
    	$m4v = get_post_meta($postid, '_zilla_video_m4v', true);
    	$ogv = get_post_meta($postid, '_zilla_video_ogv', true);
    	$poster = get_post_meta($postid, '_zilla_video_poster_url', true);
	
    ?>
    <script type="text/javascript">
    	jQuery(document).ready(function($){
		
    		if($().jPlayer) {
    			$("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
    				ready: function () {
    					$(this).jPlayer("setMedia", {
    						<?php if($m4v != '') : ?>
    						m4v: "<?php echo $m4v; ?>",
    						<?php endif; ?>
    						<?php if($ogv != '') : ?>
    						ogv: "<?php echo $ogv; ?>",
    						<?php endif; ?>
    						<?php if ($poster != '') : ?>
    						poster: "<?php echo $poster; ?>"
    						<?php endif; ?>
    					});
    				},
    				size: {
    				    width: "<?php echo $width ?>px",
    				    height: "<?php echo $height . 'px'; ?>"
    				},
    				swfPath: "<?php echo get_template_directory_uri(); ?>/js",
    				cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
    				supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
    			});
    			
    			$('#jquery_jplayer_<?php echo $postid; ?>').bind($.jPlayer.event.playing, function(event) {
    			    $(this).add('#jp_interface_<?php echo $postid; ?>').hover( function() {
    			        $('#jp_interface_<?php echo $postid; ?>').stop().animate({ opacity: 1 }, 400);
			        }, function() {
			            $('#jp_interface_<?php echo $postid; ?>').stop().animate({ opacity: 0 }, 400);
			        });
    			});
    			
    			$('#jquery_jplayer_<?php echo $postid; ?>').bind($.jPlayer.event.pause, function(event) {
    			    $('#jquery_jplayer_<?php echo $postid; ?>').add('#jp_interface_<?php echo $postid; ?>').unbind('hover');
    			    
    			    $('#jp_interface_<?php echo $postid; ?>').stop().animate({ opacity: 1 }, 400);
			        
    			});
    		}
    	});
    </script>

    <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-video"></div>

    <div class="jp-video-container">
        <div class="jp-video">
            <div class="jp-type-single">
                <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                    <ul class="jp-controls">
                    	<li><div class="seperator-first"></div></li>
                        <li><div class="seperator-second"></div></li>
                        <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                        <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                        <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                        <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                    </ul>
                    <div class="jp-progress-container">
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                    </div>
                    <div class="jp-volume-bar-container">
                        <div class="jp-volume-bar">
                            <div class="jp-volume-bar-value"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php }
}


/*-----------------------------------------------------------------------------------*/
/*	Include the ThemeZilla Framework
/*-----------------------------------------------------------------------------------*/

$tempdir = get_template_directory();
require_once($tempdir .'/framework/init.php');
require_once($tempdir .'/includes/init.php');

?>
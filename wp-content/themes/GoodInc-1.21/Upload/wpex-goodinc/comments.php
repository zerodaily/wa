 <?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments and the comment
 * form. The actual display of comments is handled by a callback to
 * wpex_comment() which is located at functions/comments-callback.php
 *
 * @package WordPress
 * @subpackage GoodInc
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return; ?>


<div id="comments" class="comments-area clr">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title"><?php comments_number( __('0 Comments', 'wpex' ), __('1 Comment', 'wpex' ), __('% Comments', 'wpex' ) ); ?></h2>

		<ol class="comment-list">
			<?php wp_list_comments( array( 'callback' => 'wpex_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .comment-list -->

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation row clr" role="navigation">
			<h4 class="assistive-text section-heading heading"><span><?php _e( 'Comment navigation', 'wpex' ); ?></span></h4>
			<div class="nav-previous span_12 col clr-margin"><?php previous_comments_link( __( '&larr; Older Comments', 'wpex' ) ); ?></div>
			<div class="nav-next span_12 col"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wpex' ) ); ?></div>
		</nav>
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'wpex' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php if ( is_singular('portfolio') && comments_open() ) { ?>
    	<div class="toggle-comments-form">
        	<a href="#" class="toggle-comments-link">
            	<span class="leave-reply"><i class="icon-reply"></i><?php _e('Leave A Reply','wpex'); ?></span>
                <span class="cancel-reply"><i class="icon-remove"></i><?php _e('Cancel Reply','wpex'); ?></span>
			</a>
        </div><!-- .toggle-comments-form -->
    <?php } ?>	
        
	<?php comment_form(
		$fields =  array(
			'title_reply'		=> '<span>'. __( 'Leave a Reply', 'wpex') .'</span>',
			'cancel_reply_link'	=> __( 'cancel reply', 'wpex') ,
		)
	); ?>

</div><!-- #comments -->
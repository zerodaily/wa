<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( '这篇文章是密码保护的。输入密码以查看。', 'themify' ); ?></p>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() || comments_open() ) : ?>
<div id="comments" class="commentwrap">
<?php endif; // end commentwrap ?>

<?php if ( have_comments() ) : ?>
	<h4 class="comment-title"><?php comments_number(__('没有评论','themify'), __('1条评论','themify'), __('%条评论','themify') );?></h4>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<div class="pagenav top clearfix">
			<?php paginate_comments_links( array('prev_text' => '&laquo;', 'next_text' => '&raquo;') );?>
		</div> 
		<!-- /.pagenav -->
	<?php endif; // check for comment navigation ?>

	<ol class="commentlist">
		<?php wp_list_comments('callback=custom_theme_comment'); ?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<div class="pagenav bottom clearfix">
			<?php paginate_comments_links( array('prev_text' => '&laquo;', 'next_text' => '&raquo;') );?>
		</div>
		<!-- /.pagenav -->
	<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>

<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php 
$custom_comment_form = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
    'author' => '<p class="comment-form-author">' .
			'<input id="author" name="author" type="text" value="' .
			esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' class="required" />' .
			'<label for="author">' . __( '名字' , 'themify' ) . '</label> ' .
			( $req ? '<span class="required">*</span>' : '' ) .
			'</p>',
    'email'  => '<p class="comment-form-email">' .
			'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' class="required email" />' .
			'<label for="email">' . __( '邮箱' , 'themify' ) . '</label> ' .
			( $req ? '<span class="required">*</span>' : '' ) .
			'</p>',
    'url'    =>  '<p class="comment-form-url">' .
			'<input id="url" name="url" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30"' . $aria_req . ' />' .
			'<label for="website">' . __( '网站' , 'themify' ) . '</label> ' .
			'</p>') ),
	'comment_field' => '<p class="comment-form-comment">' .
			'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="required"></textarea>' .
			'</p>',
	'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( '登录为<a href="%1$s">%2$s</a>. <a href="%3$s">注销?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
	'title_reply' => __( '评论' , 'themify' ),
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'cancel_reply_link' => __( '取消' , 'themify' ),
	'label_submit' => __( '发表评论' , 'themify' ),
);
comment_form($custom_comment_form); 
?>

<?php if ( have_comments() || comments_open() ) : ?>
</div>
<!-- /.commentwrap -->
<?php endif; // end commentwrap ?>
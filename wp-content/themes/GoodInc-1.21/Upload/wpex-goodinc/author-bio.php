<?php
/**
 * The template for displaying Author bios.
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>

<div id="single-author" class="clr">
    <div id="author-image">
       <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_avatar( get_the_author_meta('user_email'), '70', '' ); ?></a>
    </div><!-- #author-image --> 
    <div id="author-bio">
        <div id="single-author-title"><?php _e('Written by ','wpex') . the_author_meta('display_name'); ?></div>
        <p><?php the_author_meta('description'); ?></p>
        <ul id="author-bio-meta" class="clr">
        	<li id="author-bio-profile-link" class="clr">
				<i class="icon-file"></i> <?php _e( 'Read other posts by', 'wpex') ; ?> <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a>
            </li>
            <?php if ( get_the_author_meta( 'url', $post->post_author ) !== '' ) { ?>
                <li id="authot-bio-site-link" class="clr">
                    <i class="icon-external-link-sign"></i> <?php _e( 'Website:', 'wpex') ; ?> <a href="<?php echo get_the_author_meta( 'url', $post->post_author ); ?>" title="<?php _e( 'Visit Website', 'wpex') ; ?>" target="_blank"><?php echo get_the_author_meta( 'url', $post->post_author ); ?></a>
                </li>
            <?php } ?>
            <li id="author-bio-social-links" class="clr">
            	<?php
				// Display twitter url
				if ( get_the_author_meta( 'wpex_twitter', $post->post_author ) !== '' ) { ?>
					<a href="<?php echo get_the_author_meta( 'wpex_twitter', $post->post_author ); ?>" title="Twitter" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/twitter.png" alt="Twitter" /></a>
				<?php }
				// Display facebook url
				if ( get_the_author_meta( 'wpex_facebook', $post->post_author ) !== '' ) { ?>
					<a href="<?php echo get_the_author_meta( 'wpex_facebook', $post->post_author ); ?>" title="Facebook" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/facebook.png" alt="Facebook" /></a>
				<?php }
				// Display google plus url
				if ( get_the_author_meta( 'wpex_googleplus', $post->post_author ) !== '' ) { ?>
					<a href="<?php echo get_the_author_meta( 'wpex_googleplus', $post->post_author ); ?>" title="Google Plus" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/googleplus.png" alt="Google Plus" /></a>
				<?php }
				// Display pinterest plus url
				if ( get_the_author_meta( 'wpex_pinterest', $post->post_author ) !== '' ) { ?>
					<a href="<?php echo get_the_author_meta( 'wpex_pinterest', $post->post_author ); ?>" title="Pinterest" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/pinterest.png" alt="Pinterest" /></a>
				<?php } ?>
            </li>
        </ul><!-- #author-bio-meta -->
    </div><!-- #author-bio -->
</div><!-- #single-author -->
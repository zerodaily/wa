<?php
/**
 * This file is used for your status post format
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?> 
 
<?php
/******************************************************
 * Single Posts
 * @since 1.0
*****************************************************/
if ( is_singular() ) { ?>
	
	<?php if( get_post_meta($post->ID, 'wpex_post_oembed', true) !== '') { ?>
		<div id="post-status"><?php echo wp_oembed_get( get_post_meta( get_the_ID(), 'wpex_post_oembed', true ) ); ?></div>
	<?php } ?>

<?php
/******************************************************
 * Entries
 * @since 1.0
*****************************************************/
} else { ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('post-entry clr'); ?>>
        <?php if( get_post_meta($post->ID, 'wpex_post_oembed', true) !== '') { ?>
			 <?php echo '<div class="post-entry-status">'. wp_oembed_get( get_post_meta( get_the_ID(), 'wpex_post_oembed', true ) ) .'</div>'; ?>
		 <?php } ?>
    </article><!-- /post-entry -->

<?php } ?>
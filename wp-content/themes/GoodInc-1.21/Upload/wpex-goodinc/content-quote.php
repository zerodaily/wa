<?php
/**
 * This file is used for your quote post format
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('quote-entry post-entry clr'); ?>>
    <div class="quote-entry-text">
        <?php the_content(); ?>
    </div><!-- .quote-entry-text -->
    <footer class="quote-entry-footer">
    	<?php if ( get_post_meta( get_the_ID(), 'wpex_quote_author', true ) !== '' ) { ?>
		<?php _e( 'By', 'wpex' ); ?> <?php echo get_post_meta( get_the_ID(), 'wpex_quote_author', true ); ?> | <?php } ?><?php echo get_the_date(); ?>
    </footer><!-- .quote-entry-footer -->
    <?php if ( is_rtl() ) { ?>
    	<i class="icon-quote-left"></i>
    <?php } else { ?>
    	<i class="icon-quote-right"></i>
    <?php } ?>
</article><!-- .quote-entry -->
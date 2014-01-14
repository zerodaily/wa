<?php
/**
 * This file is used for your link post format
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
if ( is_singular() ) {
	
	// Do nothing here because this post format will redirect

/******************************************************
 * Entries
 * @since 1.0
*****************************************************/
} else { ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('post-entry clr'); ?>>  
        <?php if( has_post_thumbnail() ) {  ?>
            <div class="post-entry-thumbnail">
                <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'wpex_post_url', true ) ); ?>" title="<?php the_title(); ?>" target="_blank">
                	<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ),  wpex_img( 'entry_width' ), wpex_img( 'entry_height' ), wpex_img( 'entry_crop' ) ); ?>" alt="<?php echo the_title(); ?>" />
                </a>
            </div><!-- /post-entry-thumbnail -->
        <?php } else { ?>
        	<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'wpex_post_url', true ) ); ?>" title="<?php echo esc_url( get_post_meta( get_the_ID(), 'wpex_post_url', true ) ); ?>" target="_blank" class="entry-noimg-viewpost"><?php _e('View Post','wpex'); ?></a>	
        <?php } ?>
        <div class="post-entry-details <?php if( !has_post_thumbnail() ) echo 'full-width'; ?>">
        	<h2><a href="<?php echo get_post_meta( get_the_ID(), 'wpex_post_url', true); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></h2>
            <?php $get_meta = get_post_custom( get_the_ID() ); ?>
            <?php if( function_exists( 'taqyeem_get_score' ) && !empty( $get_meta['taq_review_position'][0] ) ) { ?>
            	<div class="post-entry-rating clr">
					<?php taqyeem_get_score( get_the_ID(), 'large' ); ?>
                </div><!-- .post-entry-rating -->
			<?php } ?>
            <div class="post-entry-excerpt">
            	<?php if ( wpex_get_data( 'auto_excerpts', '1' ) == '1' ) { ?>
            		<?php wpex_excerpt( wpex_get_data( 'excerpt_width', '60' ) ); ?>
                <?php } else { ?>
					<?php the_content(); ?>
                <?php } ?>
            </div><!-- /post-entry-excerpt -->
        </div><!-- /post-entry-details -->
		<footer class="post-entry-footer clr">
			<div class="post-entry-date"><i class="icon-time"></i><?php echo get_the_date(); ?></div>
            <?php if( comments_open() ) { ?>
            	<div class="post-entry-url">
                	<i class="icon-link"></i>
					<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'wpex_post_url', true ) ); ?>" title="<?php echo esc_url( get_post_meta( get_the_ID(), 'wpex_post_url', true ) ); ?>" target="_blank"><?php echo esc_url( get_post_meta( get_the_ID(), 'wpex_post_url', true ) ); ?></a>
                </div><!--.post-entry-url -->
            <?php } ?><!-- .post-entry-comments -->
		</footer><!-- .post-entry-footer -->
    </article><!-- /post-entry -->

<?php } ?>
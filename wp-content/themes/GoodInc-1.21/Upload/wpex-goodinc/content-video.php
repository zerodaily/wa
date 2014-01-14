<?php
/**
 * This file is used for your video post format
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
	
	if( get_post_meta($post->ID, 'wpex_post_oembed', true ) !== '') { ?>
		<div id="post-video" class="fitvids wpex-fadein"><?php echo wp_oembed_get( get_post_meta( get_the_ID(), 'wpex_post_oembed', true ) ); ?></div>
	<?php } ?>

<?php
/******************************************************
 * Entries
 * @since 1.0
*****************************************************/
} else { ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('post-entry clr'); ?>>  
        <?php if( get_post_meta($post->ID, 'wpex_post_oembed', true ) !== '') { ?>
			<div class="post-entry-video fitvids wpex-fadein"><?php echo wp_oembed_get( get_post_meta( get_the_ID(), 'wpex_post_oembed', true ) ); ?></div>
		<?php } ?>
        <div class="post-entry-details <?php if( !has_post_thumbnail() ) echo 'full-width'; ?>">
        	<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
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
            	<div class="post-entry-comments">
                	<i class="icon-comments"></i>
					<?php comments_popup_link( __( '0 Comments', 'wpex' ), __( '1 Comment',  'wpex' ), __( '% Comments', 'wpex' ), 'comments-link' ); ?>
                </div><!--.post-entry-footer -->
            <?php } ?><!-- .post-entry-comments -->
		</footer><!-- .post-entry-footer -->
    </article><!-- /post-entry -->

<?php } ?>
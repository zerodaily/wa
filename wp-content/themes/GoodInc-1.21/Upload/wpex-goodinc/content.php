<?php
/**
 * This file is used for your entries and post media
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
	
	
	<?php if( wpex_get_data( 'blog_single_thumbnail', '1' ) == '1' && has_post_thumbnail() ) { ?>
        <div id="post-thumbnail">
			<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), wpex_img('post_width'),  wpex_img('post_height'),  wpex_img('post_crop') ); ?>" alt="<?php the_title(); ?>" />
        </div><!-- #post-thumbnail -->
	<?php } ?>


<?php
/******************************************************
 * Entries
 * @since 1.0
*****************************************************/
} else { ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('post-entry clr'); ?>>  
        <?php if( has_post_thumbnail() ) {  ?>
            <div class="post-entry-thumbnail">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), wpex_img('entry_width'),  wpex_img('entry_height'),  wpex_img('entry_crop') ); ?>" alt="<?php the_title(); ?>" /></a>
                <div class="post-entry-thumbnail-bottom wpex-fadein">
                	<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="entry-thumb-lightbox wpex-lightbox"></a>
                    <a href="<?php the_permalink(); ?>" title="<?php _e('View Post','wpex'); ?>" class="entry-thumb-readmore"></a>
                </div><!-- .post-entry-thumbnail-bottom -->
            </div><!-- .post-entry-thumbnail -->
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
            </div><!-- .post-entry-excerpt -->
        </div><!-- .post-entry-details -->
		<footer class="post-entry-footer clr">
			<div class="post-entry-date"><i class="icon-time"></i><?php echo get_the_date(); ?></div>
            <?php if( comments_open() ) { ?>
            	<div class="post-entry-comments">
                	<i class="icon-comments"></i>
					<?php comments_popup_link( __( '0 Comments', 'wpex' ), __( '1 Comment',  'wpex' ), __( '% Comments', 'wpex' ), 'comments-link' ); ?>
                </div><!--.post-entry-footer -->
            <?php } ?><!-- .post-entry-comments -->
		</footer><!-- .post-entry-footer -->
    </article><!-- .post-entry -->

<?php } ?>
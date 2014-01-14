<?php
/**
 * This file is used for your gallery post format
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
		
	// Get attachments
	$attachments = wpex_get_gallery_ids();
	
	// If image attachments exist lets create a sweet slider
	if( $attachments ) {
	
		// Load your js files to fire up the slider
		wp_enqueue_script( 'flexslider' );
		wp_enqueue_script( 'wpex-flexslider-post-gallery', WPEX_JS_DIR .'/flexslider-post-gallery.js', array( 'jquery', 'flexslider' ), 1.0, true); ?>
    
        <div id="single-post-slider" class="flexslider">
			<ul class="slides">
              <?php foreach ( $attachments as $attachment ) : $attachment_meta = wpex_get_attachment( $attachment ); ?>
              	<li class="slide">
					<?php if ( wpex_gallery_is_lightbox_enabled() == 'on' ) { ?>
                	<a href="<?php echo wp_get_attachment_url( $attachment ); ?>" title="<?php echo $attachment_meta['title']; ?>" class="wpex-gallery-lightbox">
					<?php } ?>
                        <img src="<?php echo aq_resize( wp_get_attachment_url( $attachment ), wpex_img('post_width'),  wpex_img('post_height'),  wpex_img('post_crop') ); ?>" alt="<?php echo $attachment_meta['title']; ?>" />
                        <?php if ( get_post_field( 'post_excerpt', $attachment ) !== '' ) { ?>
                            <div class="single-post-slider-caption">
                                <?php echo $attachment_meta['title']; ?>
                            </div><!-- .single-post-slider-caption -->
                        <?php } ?>
                    <?php if ( wpex_gallery_is_lightbox_enabled() == 'on' ) { ?></a><?php } ?>
                </li>
              <?php endforeach; ?>
            </ul><!--.slides -->
        </div><!-- #single-post-slider -->
    
    <?php }

/******************************************************
 * Entries
 * @since 1.0
*****************************************************/
} else { ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('post-entry clr'); ?>>  
		<?php
		// Get attachments
		$attachments = wpex_get_gallery_ids();
		
		// If image attachments exist lets create a sweet slider
		if( $attachments ) {
		
			// Load your js files to fire up the slider
			wp_enqueue_script( 'flexslider' );
			wp_enqueue_script( 'wpex-flexslider-entry-gallery', WPEX_JS_DIR .'/flexslider-entry-gallery.js', array( 'jquery', 'flexslider' ), 1.0, true ); ?>
		
			<div class="gallery-entry-slider flexslider">
				<ul class="slides">
				  <?php foreach ( $attachments as $attachment ) : $attachment_meta = wpex_get_attachment( $attachment ); ?>
					<li><img src="<?php echo aq_resize( wp_get_attachment_url( $attachment ), wpex_img('entry_width'),  wpex_img('entry_height'),  wpex_img('entry_crop') ); ?>" alt="<?php echo $attachment_meta['title']; ?>" /></li>
				  <?php endforeach; ?>
				</ul><!--.slides -->
			</div><!-- .single-post-slider -->
		 <?php } elseif( has_post_thumbnail() ) {  ?>
            <div class="post-entry-thumbnail">
               <img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), wpex_img('entry_width'),  wpex_img('entry_height'),  wpex_img('entry_crop') ); ?>" alt="<?php the_title(); ?>" />
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
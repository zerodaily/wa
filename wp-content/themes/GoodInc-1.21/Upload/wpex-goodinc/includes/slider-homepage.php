<?php
/**
 * This file is used for the homepage flexslider
 * @package GoodInc WordPress Theme
 * @since 1.0
 * @author WPExplorer : http://www.wpexplorer.com
 */

if( wpex_get_data('homepage_slider_cat','') !== '' ) {
	
	// Get posts
	global $post;
	$wpex_blog_featured_posts = get_posts(
		array(
			'post_type' =>'post',
			'numberposts' => wpex_get_data('homepage_slider_count','8'),
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field' => 'id',
					'terms' => wpex_get_data('homepage_slider_cat','')
					)
				),
			'suppress_filters' => false, // WPML support
		)
	);
	if( $wpex_blog_featured_posts ) {
		
		// Get Scripts
		wp_enqueue_script('flexslider');
		wp_enqueue_script('wpex-flexslider-home-init'); ?>
        
		<div id="featured-flexslider" class="flexslider">
			<ul class="slides">
				<?php foreach ($wpex_blog_featured_posts as $post ) : setup_postdata( $post ); ?> 
				<li class="featured-flexslider">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="featured-flexslider-img">
                        <img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ),  wpex_img( 'flex_home_slide_width' ), wpex_img( 'flex_home_slide_height' ),  wpex_img( 'flex_home_slide_crop' ) ); ?>" alt="<?php echo the_title(); ?>" />
                    </a>
                    <div class="img-caption">
						<?php the_title(); ?>
                    </div><!-- /img-caption -->
                    <article class="text-caption">
                    	<h2><?php the_title(); ?></h2>
                        <?php echo wp_trim_words( strip_shortcodes( get_the_excerpt() ) , 50 ); ?>
                        <div class="date"><?php echo get_the_date(); ?></div><!-- /dated -->
                    </article><!-- /text-caption -->
				</li><!-- .featured-flexslider--> 
			   <?php endforeach; ?>
			</ul><!--.slides -->
		</div><!-- #featured-flexslider -->
    
	<?php
	}
	wp_reset_postdata();
} ?>
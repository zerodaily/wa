<?php
/**
 * This file is used for the homepage carousel
 * @package GoodInc WordPress Theme
 * @since 1.0
 * @author WPExplorer : http://www.wpexplorer.com
 */

if( wpex_get_data('homepage_carousel_cat','') !== '' ) {

	$wpex_carousel_posts = get_posts( array(
				'post_type' =>'post',
				'numberposts' => wpex_get_data('footer_carousel_count','6'),
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'id',
						'terms' => wpex_get_data('homepage_carousel_cat','')
						)
					),
				'suppress_filters' => false, // WPML support
				) );
				
	if( $wpex_carousel_posts && count($wpex_carousel_posts) > 3 ) {
		
		// Load scripts
		wp_enqueue_script('bxslider');
		wp_enqueue_script('wpex-homepage-carousel-init'); ?>
		
		<section id="homepage-carousel-wrap" class="clr">
			<div id="homepage-carousel-inner" class="container">
				<ul id="homepage-carousel" class="bxslider">
					<?php
					//start loop
					global $post;
					foreach($wpex_carousel_posts as $post) : setup_postdata($post);
						if( has_post_thumbnail() ) {  ?>
							<li>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="homepage-carousel-item">
									<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ),  300, 190, true ); ?>" alt="<?php the_title(); ?>" />
								</a>
								<article>
									<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
									<?php the_excerpt(); ?>
								</article>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="overlay"></a>
							</li>
						<?php }
					endforeach; wp_reset_postdata(); ?>
				</ul>
			</div><!-- /homepage-carousel-inner -->
		</section><!-- /homepage-carousel -->
	<?php }
	
} ?>
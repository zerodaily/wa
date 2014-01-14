<?php
/**
 * This file is used for the homepage carousel
 *
 * @package WordPress
 * @subpackage GoodInc
 */

// Show homepage carousel if category is defined in the theme panel
if( wpex_get_data( 'homepage_carousel_cat' ) !== '' && wpex_get_data( 'homepage_carousel_cat' ) !== 'None' ) {

	// Get cached query
	$home_carousel_posts = get_transient ( 'home_carousel_posts' );
	
	//Check for cached query, if there is none create it
	if ( !$home_carousel_posts || isset( $_GET['clear-cache'] ) ) {
	
		// Get posts based on featured category
		$home_carousel_posts = new WP_Query( array(
			'post_type'			=>'post',
			'posts_per_page'	=> wpex_get_data( 'homepage_carousel_count', '6' ),
			'no_found_rows'		=> true,
			'tax_query'			=> array(
				'relation'	=> 'AND',
				array(
					'taxonomy'	=> 'category',
					'field'		=> 'slug',
					'terms'		=> wpex_get_data( 'homepage_carousel_cat' )
				),
				array (
					 'taxonomy'	=> 'post_format',
					 'field' 	=> 'slug',
					 'terms' 	=> array( 'post-format-quote', 'post-format-link' ),
					 'operator'	=> 'NOT IN',
				),
			),
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id',
				)
			)
		) );
		
		// Cache query for 4 hours - set transient
		set_transient( 'home_carousel_posts', $home_carousel_posts, 4*60*60 );
	
	}
	
	// If posts exists display carousel
	if( $home_carousel_posts->have_posts() && $home_carousel_posts->post_count >= 3 ) {
		
		// Load scripts
		if ( $home_carousel_posts->post_count != '3' ) {
		wp_enqueue_script('bxslider', WPEX_JS_DIR .'/bxslider.js', array('jquery'), '1.0', true);
		wp_enqueue_script('equal-heights', WPEX_JS_DIR .'/equal-heights.js', array( 'jquery' ), '1.0', true);
		wp_enqueue_script('wpex-posts-carousel-init', WPEX_JS_DIR .'/posts-carousel-init.js', array( 'jquery', 'bxslider', 'equal-heights' ), '1.0', true);
		} ?>
		
		<section id="posts-carousel-wrap" class="clr <?php if ( $home_carousel_posts->post_count == '3' ) { echo 'no-carousel'; } else { echo 'bx-loading'; } ?>">
			<div id="posts-carousel-inner" class="container">
				<ul id="posts-carousel" class="bxslider">
					<?php while( $home_carousel_posts->have_posts() ) : $home_carousel_posts->the_post(); ?>
						<?php if( has_post_thumbnail() ) {  ?>
							<li>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="posts-carousel-item">
									<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ),  300, 190, true ); ?>" alt="<?php the_title(); ?>" />
                                    <i class="overlay-plus"></i>
								</a>
								<article class="posts-carousel-article">
									<h2>
                                    	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php
										// Display trimmmed title
                                        if ( strlen( get_the_title() ) > 35) {
												echo substr( the_title( $before = '', $after = '', FALSE ), 0, 35 ) . '...';
											} else {
												the_title();
										} ?>
                                    	</a>
                                    </h2>
									<p><?php echo wp_trim_words( strip_shortcodes( get_the_content() ), 15); ?></p>
								</article>
							</li>
						<?php } ?>
					<?php endwhile; ?>
				</ul>
			</div><!-- /posts-carousel-inner -->
		</section><!-- /posts-carousel -->
	<?php } ?>
	<?php wp_reset_postdata(); ?>
<?php } ?>
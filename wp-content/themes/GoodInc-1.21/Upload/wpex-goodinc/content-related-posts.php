<?php
/**
 * This file is used for your entries and post media
 *
 * @package WordPress
 * @subpackage GoodInc
 */

// Get the first category of this post
$wpex_related_category = NULL;
$wpex_related_category = get_the_category(); //get first current category ID
$wpex_related_category = $wpex_related_category[0];

// If first category has more then 3 posts create
// tax_query for the related posts otherwise show random posts
if ( $wpex_related_category->category_count > 3 ) {
	$wpex_related_category_id = $wpex_related_category->cat_ID;
	$wpex_related_tax_query = array(
		'relation'	=> 'AND',
		array(
			'taxonomy'	=> 'category',
			'field'		=> 'id',
			'terms'		=> $wpex_related_category_id
		),
		array (
			 'taxonomy'	=> 'post_format',
			 'field' 	=> 'slug',
			 'terms' 	=> array( 'post-format-quote', 'post-format-link' ),
			 'operator'	=> 'NOT IN',
		),
	);
} else {
	$wpex_related_tax_query = NULL;
}


$this_post = $post->ID; // get ID of current post

// Get posts based on featured category
$carousel_posts = new WP_Query( array(
		'post_type' 		=>'post',
		'exclude' 			=> $this_post,
		'orderby' 			=> 'rand',
		'offset' 			=> null,
		'posts_per_page'	=> wpex_get_data('related_rand_count', '6'),
		'no_found_rows'		=> true,
		'tax_query'			=> $wpex_related_tax_query,
		'meta_query' => array(
			array(
				'key' => '_thumbnail_id',
			)
		)
) );

// If posts exists display carousel
if( $carousel_posts->have_posts() && $carousel_posts->post_count >= 3 ) {
	
	// Load scripts
	if ( $carousel_posts->post_count != '3' ) {
		wp_enqueue_script( 'bxslider', WPEX_JS_DIR .'/bxslider.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script('equal-heights', WPEX_JS_DIR .'/equal-heights.js', array( 'jquery' ), '1.0', true);
		wp_enqueue_script( 'wpex-posts-carousel-init', WPEX_JS_DIR .'/posts-carousel-init.js', array( 'jquery', 'bxslider' ), '1.0', true );
	} ?>
    
    <div id="related-posts" class="clr">
    
        <h4 id="related-posts-heading"><?php _e( 'Related Articles', 'wpex' ); ?></h4>
        
        <section id="posts-carousel-wrap" class="related-posts-carousel clr <?php if ( $carousel_posts->post_count == '3' ) { echo 'no-carousel'; } ?>">
            <div id="posts-carousel-inner" class="container">
                <ul id="posts-carousel" class="bxslider">
                    <?php while( $carousel_posts->have_posts() ) : $carousel_posts->the_post(); ?>
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
            </div><!-- .posts-carousel-inner -->
        </section><!-- .posts-carousel -->
    </div><!-- #related-posts -->
<?php }
wp_reset_postdata();
$carousel_posts = NULL;	?>
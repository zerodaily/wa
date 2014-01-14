<?php
/**
 * This file is used for the homepage flexslider
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>
 

<?php if ( wpex_get_data( 'slider_alternative', '' ) !== '' ) { ?>

	<?php echo apply_filters( 'the_content', wpex_get_data( 'slider_alternative' ) ); ?>
    
<?php } else { ?> 

	<?php
    // Show homepage featured slider if theme panel category isn't blank
    if( wpex_get_data( 'homepage_slider_cat' ) !== '' && wpex_get_data( 'homepage_slider_cat' ) !== 'None' ) {
        
        // Get cached query
        $home_featured_posts = get_transient ( 'home_featured_posts' );
        
        //Check for cached query, if there is none create it
        if ( !$home_featured_posts || isset( $_GET['clear-cache'] ) ) {
            
            // Get posts based on featured category
            $home_featured_posts = new WP_Query( array(
                'post_type'			=>'post',
                'posts_per_page'	=> wpex_get_data( 'homepage_slider_count', '4' ),
                'no_found_rows'		=> true,
                'tax_query'			=> array(
                    'relation'	=> 'AND',
                    array(
                        'taxonomy'	=> 'category',
                        'field'		=> 'slug',
                        'terms'		=> wpex_get_data( 'homepage_slider_cat' )
                        )
                    ),
                    array (
                         'taxonomy'	=> 'post_format',
                         'field' 	=> 'slug',
                         'terms' 	=> array( 'post-format-quote', 'post-format-link' ),
                         'operator'	=> 'NOT IN',
                    ),
                'meta_query' => array(
                    array(
                        'key' => '_thumbnail_id',
                    )
                )
            ) );
            
            // Cache query for 4 hours - set transient
            set_transient( 'home_featured_posts', $home_featured_posts, 4*60*60 );
        
        }
        
        if( $home_featured_posts->have_posts() ) {
            
            // Get Scripts
            wp_enqueue_script( 'flexslider' );
            wp_enqueue_script( 'wpex-flexslider-home', WPEX_JS_DIR .'/flexslider-home.js', array( 'jquery','flexslider' ), '1.0', true);
            
            //Vars
            $wpex_slideshow = ( wpex_get_data('slider_slideshow', '1') == 1 ) ? 'true' : 'false';
            $wpex_slider_randomize = ( wpex_get_data('slider_randomize', '1') == 1 ) ? 'true' : 'false';
            
            // Set slider options
            $flex_params = array(
                'slideshow'			=> $wpex_slideshow,
                'randomize'			=> $wpex_slider_randomize,		
                'animation'			=> wpex_get_data( 'slider_animation', 'slide' ),
                'direction'			=> wpex_get_data( 'slider_direction', 'horizontal' ),
                'slideshowSpeed'		=> wpex_get_data( 'slider_slideshow_speed', '7000' )
            );
            
            // Localize slider script
            wp_localize_script( 'wpex-flexslider-home', 'flexLocalize', $flex_params ); ?>
            
            <div id="featured-flexslider" class="flexslider flex-loading">
                <ul class="slides">
                    <?php
                    // Loop through each post
                    while( $home_featured_posts->have_posts() ) : $home_featured_posts->the_post();
                        if ( has_post_thumbnail() || get_post_format() == 'video' ) { ?> 
                            <li class="featured-flexslider">
                                <div class="featured-flexslider-img">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ),  wpex_img( 'flex_home_slide_width' ), wpex_img( 'flex_home_slide_height' ),  wpex_img( 'flex_home_slide_crop' ) ); ?>" alt="<?php echo the_title(); ?>" />
                                    </a>
                                </div><!-- /featured-flexslider-img -->
                                <?php if ( get_post_format() !== 'video' && wpex_get_thumbnail_caption() !== '' ) { ?>
                                    <div class="img-caption">
                                        <?php echo wpex_get_thumbnail_caption(); ?>
                                    </div><!-- /img-caption -->
                                <?php } ?>
                                <article class="text-caption">
                                    <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                    <?php echo wp_trim_words( strip_shortcodes( get_the_excerpt() ) , 30 ); ?>
                                    <div class="slider-meta">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="slider-readmore"><?php _e('read more','wpex'); ?></a>
                                        <div class="date"><?php echo get_the_date(); ?></div>
                                    </div><!-- /slider-meta -->
                                </article><!-- /text-caption -->
                            </li><!-- .featured-flexslider--> 
                        <?php }
                    endwhile; ?>
                </ul><!--.slides -->
            </div><!-- #featured-flexslider -->
        
        <?php } ?>
        <?php wp_reset_postdata(); ?>
    <?php } ?>
 <?php } ?>
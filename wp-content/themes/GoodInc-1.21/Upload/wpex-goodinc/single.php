<?php
/**
 * Default file for single regular posts.
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>
<?php wpex_redirect_link_post_format(); ?>
<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
    
    	<?php if ( get_post_meta ( get_the_ID(), 'wpex_post_media_size', true ) == 'full' && !post_password_required() ) { ?>
        	<div id="post-full-media" class="clr">
        		<?php get_template_part( 'content', get_post_format() ); ?>
            </div><!-- #post-full-media -->
        <?php } ?>
    
        <section id="post" class="span_16 col col-1 clr">
        
        	<?php
			// show media (image/video/gallery) if NOT a private post
			if ( !post_password_required() && get_post_meta ( get_the_ID(), 'wpex_post_media_size', true ) !== 'full' ) { ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php } ?>
        
        	<?php if ( get_post_format() !== 'quote' && get_post_format() !== 'status' && get_post_format() !== 'aside' ) { ?>
          
            	<div class="boxed-container">
          
                    <header id="post-heading">
                        <ul class="meta clr">
                            <li class="meta-date"><i class="icon-time"></i><?php echo get_the_date(); ?></li> 
                            <li class="seperator">|</li>
                            <?php
                            // Display first category
                            $category = get_the_category(); 
                            if($category[0]){ ?>
                                <li class="meta-category"><i class="icon-file-text-alt"></i><a href="<?php echo get_category_link($category[0]->term_id ); ?>" title="<?php echo $category[0]->cat_name; ?>"><?php echo $category[0]->cat_name; ?></a></li>
                            <?php } ?>
                            <li class="seperator">|</li>
                            <?php if( comments_open() && !post_password_required() ) { ?>
                                <li class="meta-comments comment-scroll"><i class="icon-comments-alt"></i><?php comments_popup_link( __( '0 Comments', 'wpex' ), __( '1 Comment',  'wpex' ), __( '% Comments', 'wpex' ), 'comments-link' ); ?></li>
                            <?php } ?>
                        </ul><!-- .meta --> 
                        <h1><?php the_title(); ?></h1>
                    </header><!-- #page-heading -->
                    
                    <article class="entry fitvids clr">
                        <?php
                        // Display post content
                        the_content();
                        
                        // Paginate pages when <!--nextpage--> is used
                        wp_link_pages( array(
                            'before'		=>	'<div id="paginate-post" class="clr">',
                            'after'			=>	'</div>',
                            'link_before'	=>	'<span>',
                            'link_after'	=>	'</span>',
                        ) );
                        
                        // Show button on link posts
                        if ( get_post_format() == 'link' ) {
                            echo '<a href="'. get_post_meta( get_the_ID(), 'wpex_post_url', true) .'" title="'. get_the_title() .'" target="_blank" class="theme-button" id="post-link-button">'. __('visit website','wpex') .'</a>';
                        }
                        
                        // Post Tags
                        if ( wpex_get_data( 'blog_tags', '1' ) == '1' ) {
                            the_tags( '<div id="post-tags" class="clr">', '', '</div>');
                        } ?>
                    </article><!-- .entry -->
                
                </div><!--.boxed-container -->
                
                <?php
                // Author bio
                if( wpex_get_data( 'blog_bio', '1' ) == '1' ) { ?>
                    <?php get_template_part( 'author', 'bio' ); ?>
                <?php } ?>
            
			<?php } // if ( get_post_format() ) !== 'quote' ) ?>
            
            <?php
            // Comments
            if ( comments_open() || '0' != get_comments_number() ) { ?>
                <?php comments_template(); ?>
            <?php } ?>
            
            <nav id="single-nav" class="clr">
            	<div id="single-nav-inner" class="clr">
                <?php
				// Set arrows depending on screen direction
				$wpex_arrow_prev = is_rtl() ? 'icon-long-arrow-right' : 'icon-long-arrow-left';
				$wpex_arrow_next = is_rtl() ? 'icon-long-arrow-left' : 'icon-long-arrow-right'; ?>
                <?php next_post_link('<div class="single-nav-left span_12 col col-1 clr">%link</div>', '<span><i class="'. $wpex_arrow_prev .'"></i>'. __( 'Previous', 'wpex' ) .'</span>%title', false); ?>
                <?php previous_post_link('<div class="single-nav-right span_12 col clr">%link</div>', '<span>'. __( 'Next', 'wpex' ) .'<i class="'. $wpex_arrow_next .'"></i></span>%title', false); ?>
                </div><!-- #single-nav-inner -->
            </nav><!-- #single-nav -->
                
        </section><!-- #post -->
    
    <?php endwhile; ?>
    
    <?php
	// Sidebar Widgets
    get_sidebar(); ?>
    
    <div class="clear"></div>
    
    <?php
    // Related Posts
    if ( wpex_get_data('blog_related','1' ) == '1' && !wp_is_mobile() ) { ?>
        <?php get_template_part( 'content', 'related-posts' ); ?>
    <?php } ?>

<?php get_footer(); ?>
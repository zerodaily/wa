<?php
/**
 * Author.php loads the author pages with a listing of their posts
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    
	<?php the_post(); ?>

	<header id="page-heading" class="clr">
		<h1><?php _e( 'Posts written by', 'wpex' ); ?>: <?php echo get_the_author(); ?></h1>
	</header><!-- #page-heading -->

    <div id="post" class="post span_16 col col-1 clr">
            
            <div id="post-entries" class="clr">
            	<?php rewind_posts(); ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', get_post_format() ); ?>
                <?php endwhile; ?>
            </div><!-- #post-entries -->
           
            <?php if ( wpex_get_data( 'pagination_style', 'infinite_scroll' ) == 'infinite_scroll' ) { ?>
                <?php wpex_infinite_scroll(); ?>
            <?php } elseif ( wpex_get_data( 'pagination_style', 'load_more' ) == 'load_more' ) { ?>
                <?php echo wpex_load_more(); ?>
            <?php } else { ?>
                <?php wpex_pagination(); ?>
            <?php } ?>
        
    </div><!--/post -->
    
<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
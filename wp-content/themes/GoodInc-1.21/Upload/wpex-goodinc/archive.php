<?php
/**
 * Archive.php renders your categories, tags and archive pages
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>

<?php get_header(); ?>

<header id="page-heading" class="archive-heading">
    <h1><?php single_term_title(); ?></h1> 
    <div id="archive-post-count">
       <?php echo $wp_query->found_posts; ?> <?php _e( 'articles', 'wpex' ); ?>
    </div><!-- #archive-post-count -->
</header><!-- #page-heading -->

<div id="post" class="post span_16 col col-1 clr"> 
  
	<?php if ( have_posts() ) : ?>
    
        <div id="post-entries" class="clr">
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
        
    <?php endif; ?>
    
</div><!-- #post -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php
/**
 * Search.php is used for your search result pages.
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>

<?php get_header(); ?>

<header id="page-heading">
	<h1 id="archive-title"><?php _e('Search Results For','wpex'); ?> &#8220;<?php the_search_query(); ?>&#8221;</h1>
    <?php if ( have_posts() ) { ?>
        <div id="archive-post-count">
           <?php echo $wp_query->found_posts; ?> <?php _e( 'results', 'wpex' ); ?>
        </div><!-- /archive-post-count -->
    <?php } ?>
</header><!-- #page-heading -->

<div id="post" class="span_16 col col-1 clr">

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
		
		<?php else : ?>
        
        <div class="boxed-container">
			<?php _e('There were no results found for that query. Please try again.', 'wpex'); ?>
        </div><!-- .entry -->
        
	<?php endif; ?>

</div><!-- #post  -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
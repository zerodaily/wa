<?php
/**
 * Index.php is the default template.
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>

<?php get_header(); ?>

<div id="post" class="span_16 col col-1 clr">

	<?php if ( have_posts() ) : ?>
    
        <div id="post-entries" class="clr">
            <?php while (have_posts()) : the_post(); ?>
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
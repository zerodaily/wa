<?php
/**
 * Page.php is used to render your regular pages.
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php if( has_post_thumbnail() ) { ?>
    	<div id="page-featured-img">
        	<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" alt="<?php the_title(); ?>" />
		</div><!-- #page-featured-img -->
    <?php } ?>
    
    <div id="post" class="span_16 col col-1 clr">
        <div class="boxed-container">
            <header id="post-heading">
                <h1><?php the_title(); ?></h1>
            </header>
            <article class="entry fitvids clr">	
                <?php the_content(); ?>
            </article><!-- /entry --> 
        </div><!-- /boxed-container -->
    </div><!-- #post -->
 
<?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
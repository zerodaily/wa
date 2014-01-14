<?php
/**
 * Template Name: Full-Width
 * @package GoodInc WordPress Theme
 * @since 1.0
 * @author WPExplorer : http://www.wpexplorer.com
 */
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php if( has_post_thumbnail() ) { ?>
		<div id="page-featured-img">
        	<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" alt="<?php the_title(); ?>" />
        </div><!-- #full-page-featured-img -->
    <?php } ?>
    
    <header id="page-heading">
		<h1><?php the_title(); ?></h1>
	</header><!-- #page-heading -->
    
    <div id="full-width-post" class="clr">
        <div class="boxed-container">  
            <article class="entry fitvids clr">	
                <?php the_content(); ?>
            </article><!-- .entry -->
        </div><!-- .boxed-container -->
    </div><!-- #full-width-post -->
 
<?php endwhile; ?>
<?php get_footer(); ?>
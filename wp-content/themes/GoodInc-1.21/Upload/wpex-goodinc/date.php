<?php
/**
 * Date.php is used for date based archives
 *
 * @package WordPress
 * @subpackage GoodInc
 */

get_header(); ?>

<header id="page-heading" class="archive-heading">
    <?php /* If this is a daily archive */ if ( is_day() ) { ?>
    <h1><?php _e('Archive For','wpex'); ?> <?php the_time( 'F jS, Y' ); ?></h1>
    <?php /* If this is a monthly archive */ } elseif ( is_month() ) { ?>
    <h1><?php _e('Archive For','wpex'); ?> <?php the_time( 'F, Y' ); ?></h1>
    <?php /* If this is a yearly archive */ } elseif ( is_year() ) { ?>
    <h1><?php _e('Archive For','wpex'); ?> <?php the_time( 'Y' ); ?></h1>
    <?php } ?>
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
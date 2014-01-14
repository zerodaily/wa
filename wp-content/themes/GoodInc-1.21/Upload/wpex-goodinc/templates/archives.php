<?php
/**
 * Template Name: Archives
 * @package GoodInc WordPress Theme
 * @since 1.0
 * @author WPExplorer : http://www.wpexplorer.com
 */
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<header id="page-heading">
		<h1><?php the_title(); ?></h1>
	</header><!-- #page-heading -->

    <div id="post" class="archives-template span_16 col col-1 clr">
        
        <div class="boxed-container">
            <article class="entry clr">	
                <?php the_content(); ?>
            </article><!-- .entry -->
            <?php
            $terms = get_terms( 'category' );
            foreach($terms as $term) { ?>
            <div id="archives-wrap" class="clr">
                <section class="archives-section">
                    <h2><a href="<?php echo get_term_link($term->slug, 'category'); ?>" title="<?php echo $term->name; ?>"><?php echo $term->name; ?></a></h2>
                    <ul class="archives-list clr">
                        <?php
                        $term_posts = get_posts(array(
                            'post_type' => 'post',
                            'numberposts' => -1,
                            'orderby' => 'post_date',
                            'order' => 'ASC',
                            'tax_query' => array( array( 'taxonomy' => 'category', 'terms' => $term->slug, 'field' => 'slug' ) )
                        ));
                        $count=0;
                        foreach ($term_posts as $post) : setup_postdata($post);
                        $count++; ?>
                            <li><i class="icon-file-text-alt"></i><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="archives-count"><?php echo $count; ?></span><?php the_title(); ?></a></li>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </ul>
                </section><!-- .archives-section -->
            </div><!-- .archives-wrap -->
            <?php } ?>
        </div><!-- .boxed-container -->   
    </div><!-- .archives-template -->
 
<?php endwhile; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
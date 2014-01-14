<?php
/**
 * Template Name: Site Map
 *
 * @package GoodInc WordPress Theme
 * @since 1.0
 */
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <div id="post" class="clr">
        <header id="page-heading">
            <h1><?php the_title(); ?></h1>
        </header><!-- #page-heading -->
        <section class="boxed-container">
            <article class="entry clr">	
                <?php the_content(); ?>
            </article><!-- .entry -->
            <div id="site-map-template-wrap" class="clr">
                <div class="site-map-template-section span_8 col col-1 clr">
                    <h2><?php _e( 'Pages', 'wpex' ); ?></h2>
                    <?php $wpex_cat_args = array(
                        'depth'        => 0,
                        'show_date'    => '',
                        'date_format'  => get_option('date_format'),
                        'child_of'     => 0,
                        'exclude'      => '',
                        'include'      => '',
                        'title_li'     => '',
                        'echo'         => 1,
                        'authors'      => '',
                        'sort_column'  => 'menu_order, post_title',
                        'link_before'  => '<i class="icon-file-text"></i>',
                        'link_after'   => '',
                        'walker'       => '',
                        'post_type'    => 'page',
                        'post_status'  => 'publish' 
                    ); ?>
                    <ul><?php wp_list_pages( $wpex_cat_args ); ?></ul>
                </div><!-- .site-map-template-section -->
                <div class="site-map-template-section span_8 col clr">
                    <h2><?php _e( 'Categories', 'wpex' ); ?></h2>
                    <?php $wpex_cats = get_categories(); ?>
                    <?php if( $wpex_cats ) { ?>
                        <ul>
                            <?php foreach ($wpex_cats as $cat) { ?>
                                <li><a href="<?php echo get_category_link( $cat->term_id ); ?>" title="<?php echo sprintf( __( 'View all posts in %s', 'wpex' ), $cat->name ) ?>"><i class="icon-folder-open"></i><?php echo $cat->name; ?></a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div><!-- .site-map-template-section -->
                <div class="site-map-template-section span_8 col clr">
                    <h2><?php _e( 'Tags', 'wpex' ); ?></h2>
                    <?php $wpex_tags = get_tags(); ?>
                    <?php if( $wpex_tags ) { ?>
                        <ul>
                            <?php foreach ($wpex_tags as $tag) { ?>
                                <li><a href="<?php echo get_tag_link( $tag->term_id ); ?>" title="<?php echo sprintf( __( "View all posts in %s", "wpex" ), $tag->name ) ?>"><i class="icon-tag"></i><?php echo $tag->name; ?></a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div><!-- .site-map-template-section -->
            </div><!-- #site-map-template-wrap -->
        </section><!-- .boxed-container -->   
    </div><!-- #post -->
 
<?php endwhile; ?>
<?php get_footer(); ?>
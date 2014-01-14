<?php
/**
 * Template Name: Authors
 *
 * @package GoodInc WordPress Theme
 * @since 1.0
 */
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php $users = get_users(
		array(
			'orderby'	=> 'post_count',
			'order'	=> 'ASC',
		)
	); ?>
	<?php $users_count = count($users); ?>

    <div id="post" class="clr">
        <header id="page-heading">
            <h1><?php the_title(); ?></h1>
            <div id="archive-post-count">
       			<?php echo $users_count ?> <?php _e( 'contributors', 'wpex' ); ?>
    		</div><!-- #archive-post-count -->
        </header><!-- #page-heading -->
        <section class="boxed-container">
            <article class="entry clr">	
                <?php the_content(); ?>
            </article><!-- .entry -->
            <div id="contributors-template-wrap" class="clr">
                <?php $count=$count2=0; ?>
				<?php foreach($users as $user) { ?>
                	<?php $count++; $count2++; ?>
                    <?php
					// Get user meta
					$display_name = $user->display_name;
					$avatar = get_avatar($user->ID, '120');
					$author_profile_url = get_author_posts_url( $user->ID ); ?>
                    <?php if ( count_user_posts( $user->ID ) >= '1' ) { ?>
                        <article class="contributor-entry clr col-<?php echo $count; ?> <?php if ( $count2 == $users_count ) { echo 'last-entry'; } ?>">
                            <div class="contributor-entry-avatar">
                                <a href="<?php echo $author_profile_url; ?>" title="<?php _e( 'Posts by', 'wpex' ); ?> <?php echo $display_name; ?>"><?php echo $avatar; ?></a>
                            </div><!-- .contributor-entry-avatar -->
                            <div class="contributor-entry-desc">
                                <h2><?php echo $display_name; ?></h2>
                                <p><?php echo get_user_meta( $user->ID, 'description', true ); ?></p>
                                <ul class="contributor-entry-footer clr">
                                	<li class="contributor-entry-count"><a href="<?php echo $author_profile_url; ?>" title="<?php _e( 'Posts by', 'wpex' ); ?> <?php echo $display_name; ?>"><i class="icon-file-text-alt"></i><?php echo count_user_posts( $user->ID ); ?> <?php _e( 'articles', 'wpex' ); ?></a></li>
                                    <?php
									// Author URL
                                    if ( get_the_author_meta( 'url', $user->ID ) !== '' ) { ?>
                                    	<li class="contributor-site"><a href="<?php echo get_the_author_meta( 'url', $user->ID ); ?>" title="<?php _e( 'Visit Website', 'wpex') ; ?>" target="_blank"><i class="icon-external-link"></i><?php _e( 'Website', 'wpex') ; ?></a></li>
                                    <?php } ?>
                                </ul><!-- .contributor-entry-footer -->
                            </div><!-- .contributor-entry-desc -->
                        </article><!-- .contributor-entry -->
                        <div class="clr"></div>
                    <?php } ?>
                    <?php if ( $count == '2' ) { ?>
                    	<?php $count=0; ?>
                    <?php } ?>
				<?php } ?>
            </div><!-- #contributors-template-wrap -->
        </section><!-- .boxed-container -->   
    </div><!-- #post -->
 
<?php endwhile; ?>
<?php get_footer(); ?>
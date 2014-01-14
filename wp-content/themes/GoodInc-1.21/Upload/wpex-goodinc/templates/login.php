<?php
/**
 * Template Name: Login
 *
 * @package GoodInc WordPress Theme
 * @since 1.0
 */
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php if( has_post_thumbnail() ) { ?>
    	<div id="page-featured-img">
        	<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" alt="<?php the_title(); ?>" />
		</div><!-- #page-featured-img -->
    <?php } ?>
    
    <div id="post" class="clr">
        <div class="boxed-container">
            <header id="post-heading">
                <h1><?php the_title(); ?></h1>
            </header>
            <article class="entry clr">	
                <?php the_content(); ?>
                <div id="wpex-loginform-wrap">
                	<?php if ( !is_user_logged_in() ) { ?>
						<?php
                        // Login Form Arguments
                        $args = array(
                        'echo' 				=> true,
                        'redirect' 			=> site_url( $_SERVER['REQUEST_URI'] ), 
                        'form_id' 			=> 'loginform',
                        'label_username' 	=> __( 'Username', 'wpex' ),
                        'label_password' 	=> __( 'Password', 'wpex' ),
                        'label_remember' 	=> __( 'Remember Me', 'wpex' ),
                        'label_log_in' 		=> __( 'Log In', 'wpex' ),
                        'id_username' 		=> 'user_login',
                        'id_password' 		=> 'user_pass',
                        'id_remember' 		=> 'rememberme',
                        'id_submit' 		=> 'wp-submit',
                        'remember' 			=> true,
                        'value_username'	=> NULL,
                        'value_remember'	=> false ); ?>
                    <?php wp_login_form($args); ?>
                    <?php } else { ?>
                    	<?php $current_user = wp_get_current_user(); ?>
                    	<p class="wpex-alredy-loggedin"><i class="icon-unlock"></i><?php _e( 'You are now logged in as', 'wpex' ); ?> <strong><?php echo $current_user->user_login; ?></strong>. <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout"><?php _e( 'Logout?', 'wpex' ); ?></a></p>
                    <?php } ?>
                </div><!-- #wpex-loginform-wrap -->
            </article><!-- .entry --> 
        </div><!-- .boxed-container -->
    </div><!-- #post -->
 
<?php endwhile; ?>
<?php get_footer(); ?>
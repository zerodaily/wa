<?php
/**
 * 404.php is used when your server reaches a 404 error page
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>

<?php get_header(); ?>

<div id="post">

    <div id="page-heading">
        <h1><?php _e( '404 Error', 'wpex' ); ?></h1>
        <p><?php _e( 'WP LOC KE R .CO M - Unfortunately the page you were trying to access does not exist.', 'wpex' ); ?></p>
    </div><!-- #page-heading -->

</div><!-- #post -->

<?php get_footer(); ?>
<?php
/**
 * Image.php is used to showcase your image media files.
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>

<?php get_header(); ?>

    <div id="post">
    
        <div id="page-heading">
            <h1><?php the_title(); ?></h1>	
        </div><!-- #page-heading -->
        
        <div id="img-wpexch-page">
            <a href="<?php echo wp_get_attachment_url( get_the_ID() ); ?>" class="fancybox">
                <?php echo preg_replace('#(width|height)="\d+"#','', wp_get_attachment_image( get_the_ID(), 'large' ) );?>
            </a>
        </div><!-- /img-wpexch-page -->
    
    </div><!-- #post -->

<?php get_footer(); ?>
<?php
/**
 * Footer.php outputs the code for footer hooks and closing body/html tags
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>
		<div class="clear"></div><!-- /clear any floats -->          
	</div><!-- /main-content -->
</div><!-- /wrap -->

<div id="footer-wrap">
    <footer id="footer" class="container">   
    	<nav id="footer-nav" class="clr <?php if( wpex_get_data( 'custom_footer_logo' ) == '' ) { echo 'without-logo'; } ?>">
        	<div id="footer-logo">
            	 <?php
                // Footer Logo
                if( wpex_get_data( 'custom_footer_logo' ) !== '' ) { ?>
                    <a href="<?php echo home_url(); ?>/" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo wpex_get_data( 'custom_footer_logo' ); ?>" alt="<?php get_bloginfo( 'name' ) ?>" /></a>
            	<?php } ?>
            </div><!-- #footer-logo -->
			<?php
			// Footer Menu
            wp_nav_menu( array(
                'theme_location'	=> 'footer',
                'sort_column'		=> 'menu_order',
                'menu_class'		=> 'footer-nav-links',
                'fallback_cb'		=> false
            )); ?>
        </nav><!-- #footer-nav -->       
        <div id="footer-copy" class="clr">
			<?php
			// Copyright
            if ( wpex_get_data('footer_text') !== '' ) { ?>           
                <?php echo wpex_get_data('footer_text'); ?>         
            <?php } else { ?>
                <?php _e('Copyright','wpex'); ?> <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>"><?php echo get_bloginfo('name'); ?></a>
            <?php } ?>
        </div><!-- #footer-copy -->       
    </footer><!-- #ooter -->
</div><!-- #footer-wrap -->

<?php wp_footer(); // Footer hook, do not delete, ever ?>
</body>
</html>
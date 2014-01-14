<?php
/**
 * Header.php is generally used on all the pages of your site and is called somewhere near the top
 * of your template files. It's a very important file that should never be deleted.
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' |'; } ?> <?php bloginfo('name'); ?></title>   
	<?php if ( wpex_get_data('custom_favicon') ) : ?>
    	<link rel="shortcut icon" href="<?php echo wpex_get_data('custom_favicon'); ?>" />
    <?php endif; ?> 
    <?php wp_head(); // Very important WordPress core hook. If you delete this bad things WILL happen. ?>
</head>

<body <?php body_class(); ?>>

    <header id="header">
    
        <div id="top-bar-wrap">
            <div id="top-bar-inner" class="container clr">
                <div id="logo">
                    <?php
                    // Show custom image logo if defined in the admin
                    if( wpex_get_data( 'custom_logo' ) !== '' ) { ?>
                        <a href="<?php echo home_url(); ?>/" title="<?php echo get_bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo wpex_get_data( 'custom_logo' ); ?>" alt="<?php echo get_bloginfo( 'name' ) ?>" /></a>
                    <?php }
                    // No custom img logo - show text
                        else { ?>
                         <h2><a href="<?php echo home_url(); ?>/" title="<?php echo get_bloginfo( 'name' ); ?>" rel="home"><?php echo get_bloginfo( 'name' ); ?></a></h2>
                    <?php } ?>
                </div><!-- /logo -->
                <div id="top-bar-right" class="clr">
                    <ul id="header-social">
                            <?php wpex_display_social(); // see functions/social-output.php ?>
                    </ul><!-- /header-social -->
                </div><!-- #top-bar-right -->
            </div><!-- #top-bar-inner -->
        </div><!-- #top-bar-wrap -->
        
        <?php if (get_header_image() != '') {?>
        	<img style="display:block;" class="container" src="<?php header_image(); ?>" alt="" />
        <?php } ?>
        
        <div id="navigation-wrap" class="clr <?php if ( wpex_get_data( 'fixed_nav', '1' ) == '1' ) { echo 'fixed-scroll'; } ?>">
            <div id="navigation-inner" class="container">
                <nav id="navigation" class="site-navigation clr">
                	<?php if( wpex_get_data( 'responsive', '1' ) == '1' ) { ?>
                        <div id="responsive-toggles" class="clr">
                            <span id="navigation-responsive-toggle"><i class="icon-reorder"></i><?php _e( 'Browse', 'wpex' ); ?></span>
                            <span id="search-responsive-toggle"><i class="icon-search"></i><?php _e( 'Search', 'wpex' ); ?></span>
                        </div><!-- #responsive-toggles -->
                    <?php } ?>
                    <?php wp_nav_menu( array(
                        'theme_location'	=> 'main',
                        'menu_class'		=> 'nav-main dropdown-nav',
                        'fallback_cb'		=> false,
						'walker'			=> new WPEX_Dropdown_Walker_Nav_Menu(),
                    ) ); ?> 
                </nav><!-- /main-navigation -->
                <div id="header-search">
                	<?php get_search_form(); ?>
            	</div><!-- #header-search -->
                <?php if( wpex_get_data( 'responsive', '1' ) == '1' ) { ?>
                    <div id="mobile-search">
                        <?php get_search_form(); ?>
                    </div><!-- #mobile-search -->
                <?php } ?>
            </div><!-- /container --> 
            <div id="nav-extend-bg"></div>
        </div><!-- /navigation-wrap -->
    
    </header><!-- /header -->
    
    <div id="wrap" class="container clr">
    
        <?php
        // Homepage Slider & Carousel
        if ( is_front_page () && !is_paged() ) {  ?>
           <?php get_template_part( 'content', 'homepage-slider' ); ?>
			<?php if ( !wp_is_mobile() ) { ?>
				<?php get_template_part( 'content', 'homepage-carousel' ); ?>
			<?php } ?>
        <?php } ?>
    
        <div id="main-content" class="clr fitvids">
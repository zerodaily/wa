<?php
/**
 * Sidebar.php is used to show your sidebar widgets on pages/posts
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>

<?php if ( wpex_sidebar_enabled() == true ) { ?>
    <aside id="sidebar" class="span_8 col clr">
        <?php dynamic_sidebar('sidebar'); ?>
    </aside><!-- #sidebar -->
<?php } ?>
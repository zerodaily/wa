<?php
/**
 * Default searchform
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?>
<form method="get" class="main-searchbar" action="<?php echo home_url( '/' ); ?>">
<input type="search" name="s" value="<?php _e( 'Type and hit enter to search...', 'wpex' ); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
</form>
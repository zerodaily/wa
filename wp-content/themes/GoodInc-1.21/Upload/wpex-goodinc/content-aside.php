<?php
/**
 * This file is used for your aside post format
 *
 * @package WordPress
 * @subpackage GoodInc
 */
?> 

<article id="post-<?php the_ID(); ?>" <?php post_class('post-entry aside-entry clr'); ?>>  
    <div class="post-entry-details">
        <div class="post-entry-excerpt">
            <?php the_content() ?>
        </div><!-- .post-entry-excerpt -->
    </div><!-- .post-entry-details -->
</article><!-- .post-entry -->
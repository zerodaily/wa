<?php 
    $format = get_post_format(); 

    // if standard post format 
    if ( !$format ) { ?>
        
        <div class="entry-meta entry-header">
            <span class="published"><?php _e('Posted ', 'zilla') ?><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago ', 'zilla'); ?>&middot;</span>
            <span class="entry-tags"><?php the_tags('&nbsp;'.__('Tagged:', 'zilla').' ', ', ', ' &middot; '); ?></span>
            <span class="comment-count"><?php comments_popup_link(__('0 Comments', 'zilla'), __('1 Comment', 'zilla'), __('% Comments', 'zilla')); ?></span>     
        </div>
        
    <?php } elseif ( in_array( $format, array('image', 'gallery', 'audio', 'video', 'link') ) ) { ?>
        
        <!--BEGIN .entry-meta .entry-footer-->
        <div class="entry-meta entry-footer">
            <span class="entry-tags"><?php the_tags(__('Tagged:', 'zilla').' ', ', ', ''); ?></span>
            <span class="comment-count"><?php comments_popup_link(__('0 Comments', 'zilla'), __('1 Comment', 'zilla'), __('% Comments', 'zilla')); ?></span>     
            <span class="published">
                <?php if( !is_singular() ) { ?>
                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>"><?php echo __('Posted ', 'zilla') . human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago &middot;', 'zilla'); ?></a>
                <?php } else {
                    echo __('Posted ', 'zilla') . human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago &middot;', 'zilla');
                } ?>
            </span>
        <!--END .entry-meta .entry-footer-->
        </div>
        
    <?php } ?>
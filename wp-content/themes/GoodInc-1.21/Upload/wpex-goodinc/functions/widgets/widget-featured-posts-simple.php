<?php
/**
 * Featured Posts Widget
 *
 * @package GoodInc WordPress Theme
 * @since 1.0
 */
 
class wpex_featured_posts_simple extends WP_Widget {
    /** constructor */
    function wpex_featured_posts_simple() {
        parent::WP_Widget(false, $name = __('GoodInc - Recent Posts','wpex') );
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$category = apply_filters('widget_title', $instance['category']);
        $number = apply_filters('widget_title', $instance['number']);
        $offset = apply_filters('widget_title', $instance['offset']); ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							<ul class="wpex-widget-featured-posts">
                            	<?php $current_post = wpex_get_current_post_id(); ?>
								<?php $featured_posts = new WP_Query( array(
										'post_type'			=>'post',
										'posts_per_page'	=> $number,
										'offset'			=> $offset,
										'no_found_rows'		=> true,
										'cat'				=> $category,
										'post__not_in'		=> array( $current_post ),
										'tax_query'			=> array(
											array(
												 'taxonomy'	=> 'post_format',
												 'field' 	=> 'slug',
												 'terms' 	=> array( 'post-format-quote', 'post-format-link', 'post-format-status' ),
												 'operator'	=> 'NOT IN',
											 )
										),
								) );
								if( $featured_posts->have_posts() ) { ?>
									<?php while( $featured_posts->have_posts() ) : $featured_posts->the_post(); ?>
                                        <li class="clr">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="title"><?php the_title(); ?></a>
                                               <?php wpex_excerpt('25'); ?>
                                                <div class="wpex-widget-featured-posts-date">
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="icon-plus"></i></a><?php echo get_the_date(); ?>
                                                </div>
                                        </li>
                                   <?php endwhile; ?>
                               <?php } ?>
                               <?php wp_reset_postdata(); ?>
							</ul>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance 				= $old_instance;
	$instance['title'] 		= strip_tags($new_instance['title']);
	$instance['category']	= strip_tags($new_instance['category']);
	$instance['number']		= strip_tags($new_instance['number']);
	$instance['offset']		= strip_tags($new_instance['offset']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {	
	    $instance = wp_parse_args( (array) $instance, array(
			'title' 	=> '',
			'category'	=> '',
			'number' 	=> '2',
			'offset'	=> '0'
		));					
        $title 		= esc_attr($instance['title']);
		$category	= esc_attr($instance['category']);
        $number 	= esc_attr($instance['number']);
        $offset 	= esc_attr($instance['offset']); ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wpex'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title','wpex'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select a Category:', 'wpex'); ?></label>
            <br />
            <select class='wpex-select' name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>">
            <option value="all-cats" <?php if($category == 'all-cats') { ?>selected="selected"<?php } ?>><?php _e('All', 'wpex'); ?></option>
            <?php
            //get terms
            $cat_terms = get_terms('category', array( 'hide_empty' => '1' ) );
            foreach ( $cat_terms as $cat_term) { ?>
                <option value="<?php echo $cat_term->term_id; ?>" id="<?php echo $cat_term->term_id; ?>" <?php if($category == $cat_term->term_id) { ?>selected="selected"<?php } ?>><?php echo $cat_term->name; ?></option>
            <?php } ?>
            </select>
        </p>
        
		<p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number to Show:', 'wpex'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Offset (the number of posts to skip):', 'wpex'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>" type="text" value="<?php echo $offset; ?>" />
        </p>
        <?php
    }


} // class wpex_featured_posts_simple
// register Recent Posts widget
add_action('widgets_init', create_function('', 'return register_widget("wpex_featured_posts_simple");'));	
?>
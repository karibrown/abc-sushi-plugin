<?php
/*Plugin Name: Widget to display latest custom posts 
Description: This plugin registers a widget to display latest custom posts
Authors: Dewshan Sarathchandra, Amrita Singh, Kariann Brown 
*/

/* ------------------------------------------------------
Register the 'Latest Custom Posts' widget
-------------------------------------------------------*/
add_action( 'widgets_init', 'init_abc_latest_posts' );
function init_abc_latest_posts() { return register_widget('abc_latest_posts'); }

class abc_latest_posts extends WP_Widget {
	// Constructor
	function abc_latest_posts() {
		parent::WP_Widget( 'abc_latest_custom_posts', $name = 'Latest Custom Posts' );
	}

	/** Widget **/
	function widget( $args, $instance ) {
		global $post;
		extract($args);

		/** Options for the widget **/
		// Title
		$title 	 = apply_filters('widget_title', $instance['title'] );
		// All types of posts
		$cpt 	 = $instance['types'];	

	    $types   = explode(',', $cpt); 
	    // Number of posts to display
		$number	 = $instance['number'];
		
        // Output
		echo $before_widget;
	    if ( $title ) echo $before_title . $title . $after_title;
			
		$mlq = new WP_Query(array( 'post_type' => $types, 'showposts' => $number ));
		if( $mlq->have_posts() ) : 
		?>
		<ul>
		<?php while($mlq->have_posts()) : $mlq->the_post(); ?>
		<li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>
		<?php wp_reset_query(); 
		endwhile; ?>
		</ul>
			
		<?php endif; ?>			
		<?php
		// Echo the widget closing Tag
		echo $after_widget;
	}

	/** Update widget control **/
	function update( $new_instance, $old_instance ) {
		$instance    = $old_instance;
		$types       = implode(',', (array)$new_instance['types']);

		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['types']  = $types;
		$instance['number'] = strip_tags( $new_instance['number'] );
		return $instance;
	}
	
	/**  Widget settings **/
	function form( $instance ) {	
	
		    // Check to see if instance exists, if not set defaults
		    if ( $instance ) {
				$title  = $instance['title'];
		        $types  = $instance['types'];
		        $number = $instance['number'];
		    } else {
			//Fallback defaults settings
				$title  = '';
		        $types  = 'post';
		        $number = '5';
		    }
			//Turn $types into an array
			$types = explode(',', $types);
			
			//Count post types for box sizing
			$cpt_types = get_post_types( array( 'public' => true ), 'names' );
			foreach ($cpt_types as $cpt ) {
			   $cpt_ar[] = $cpt;
			}
			$n = count($cpt_ar);
			if($n > 10) { $n = 10;}

			// The widget form
			?>
			<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __( 'Title:' ); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" class="widefat" />
			</p>
			<p>
			<label for="<?php echo $this->get_field_id('types'); ?>"><?php echo __( 'Select post type(s):' ); ?></label>
			<select name="<?php echo $this->get_field_name('types'); ?>[]" id="<?php echo $this->get_field_id('types'); ?>" class="widefat" style="height: auto;" size="<?php echo $n ?>" multiple>
			<?php 
			$args = array( 'public' => true );
			$post_types = get_post_types( $args, 'names' );
			foreach ($post_types as $post_type ) { ?>
				<option value="<?php echo $post_type; ?>" <?php if( in_array($post_type, $types)) { echo 'selected="selected"'; } ?>><?php echo $post_type;?></option>
			<?php }	?>
			</select>
			</p>
			<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php echo __( 'Number of posts to show:' ); ?></label>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
			</p>
	<?php 
	}
} 
?>

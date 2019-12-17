<?php

/*

	Plugin Name: Commented Posts
	Description: Plugin is used for latest posts.
	Version: 1.0
 
*/

class commented_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function commented_Widget() {

	$widget_options = array(
		'classname' => 'commented_widget',
		'description' => __('Custom commented posts.','crofts')
	);

	$control_options = array(    //dodama svoje incializirane mere
		'width' => 200,
		'height' => 400,
		'id_base' => 'commented_widget'
	);

	$this->WP_Widget( 'commented_widget', __('Pego - Commented Posts Widget','crofts'), $widget_options, $control_options );
	
}



function widget( $args, $instance ) {
	
	extract( $args );
	global $post;
	
	$order_select = 'date';
	$order_direction_select = 'DESC';
	
	$title = apply_filters('widget_title', $instance['title'] );
	$posts_number = $instance['posts_number'];




	global $post;
	
	echo $before_widget;
	
	if ( $title )
	{
		echo $before_title;
		echo esc_html($title);
		echo $after_title;
	}
	

	
	$args = array('posts_per_page' => esc_attr($posts_number), 'order'=> 'DESC', 'orderby' => 'comment_count');
	
	$port_query = new WP_Query( $args );
		
	$counter = 0;	
		
		
	echo '<div class="commented-posts">';

	       
   	if( $port_query->have_posts() ) : while( $port_query->have_posts() ) : $port_query->the_post();  
			
					$format = get_post_format( $post->ID );	
					$counter++;
					$title = get_the_title(); 
					$link = get_the_permalink();
					$strip_title = strip_tags($title);
					$dateFormat = get_option( 'date_format' );
					$post_date = get_the_date($dateFormat);
					$time_format = get_option( 'time_format' );
					$post_time = get_the_time($time_format);
					if ($format == 'link') {
							$link = get_post_meta($post->ID , 'pego_post_link_url' , true);
					}
					$comment_caption = " Comments";
					if (get_comments_number($post->ID) == 1) {
						$comment_caption = " Comment";
					}
					?>
					
						<div class="commented-post">
							<div class="commented-icon-wrap">
								<i class="commented-icon pe-7s-chat"></i>
							</div>
							<div class="commented-details">
								<a class="commented-url" href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a> 
								<div class="commented-author">by <?php the_author_posts_link(); ?></div>
								<div class="commented-number-of-comments"><a href="<?php comments_link(); ?>" ><?php echo esc_html(get_comments_number($post->ID)); ?><span><?php echo esc_html($comment_caption); ?></span></a></div>
								<div class="clear"></div>
								<?php
								if ($posts_number > $counter) {
								?>
									<div class="commented-border"></div>
								<?php
								}
								?>
							</div>
						</div>
						<div class="clear"></div>
				<?php	
	endwhile; endif; wp_reset_postdata();  

		echo '</div>';
	
	?>
	<div class="clear"></div>		
	<?php
     
 	
	echo $after_widget;
	
}


function form( $instance ) {  

	/* Set the default values  */
		$defaults = array(
		'title' => 'Commented Posts Widget',
		'posts_number' => '3',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 

	 ?>

		<label for="<?php echo $this->get_field_id( 'title' ); ?>">
		<?php _e('Title:','crofts'); ?>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" 
				 name="<?php echo $this->get_field_name( 'title' ); ?>" 
				 value="<?php echo $instance['title']; ?>" />
		</label>
																													
		<label for="<?php echo $this->get_field_id( 'posts_number' ); ?>">
		<?php _e('Number of posts:','crofts'); ?>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'posts_number' ); ?>" 
				 name="<?php echo $this->get_field_name( 'posts_number' ); ?>" 
				 value="<?php echo $instance['posts_number']; ?>" />
		</label>
		
	<?php
	}
}


/*     Adding widget to widgets_init   */
add_action( 'widgets_init', 'commented_widgets' );

function commented_widgets() {
	register_widget( 'commented_Widget' );
}
?>
<?php
add_action('widgets_init', 'zn_latest_news_widget');

function zn_latest_news_widget()
{
	register_widget('ZnLatestNews');
}

class ZnLatestNews extends WP_Widget {

	var $options;

	function __construct() {

		$widget_ops = array('classname' => 'widget-latest-news', 'description' => __( "Latest news.", 'zn_framework') );
		parent::__construct('themefuzz_latest_news', __('ThemeFuzz : Latest news', 'zn_framework'), $widget_ops);
		$this->alt_option_name = 'widget_themefuzz_latest_news';
		
		$args = array(
			'type' => 'post'
		);	
				
		$post_categories = get_categories($args);
		$option_post_cat = array();

		foreach ($post_categories as $category) {
			$option_post_cat[$category->cat_ID] = $category->cat_name;
		}

		$this->options = array(
				array(
						'id'          => 'category',
						'name'        => 'Categories',
						'description' => 'Select your desired categories for post items to be displayed',
						'type'        => 'select',
						'options'	  => $option_post_cat,
						'multiple'	  => true

					),
				array(
					'id'         	=> 'number',
					'name'       	=> 'Number of posts to show:',
					'description' 	=> 'Please enter how many posts you want to show ( default is 2 )',
					'type'        	=> 'text',
					'std'        	=> '2',
					'class'			=> 'zn_full'
				),
				array(
					'id'         	=> 'only_images',
					'name'       	=> 'Get only posts with image ?',
					'description' 	=> 'Choose if you want to only load the posts that have a featured image',
					'type'        	=> 'toggle2',
					'value'			=> 'yes',
					'std'			=> '',
					'class'			=> 'zn_full'
				),
				array(
					'id'         	=> 'show_date',
					'name'       	=> 'Show post date ?',
					'description' 	=> 'Choose if you want to show the post date.',
					'type'        	=> 'toggle2',
					'value'			=> 'yes',
					'std'			=> 'yes',
					'class'			=> 'zn_full'
				),
				array(
					'id'         	=> 'show_categories',
					'name'       	=> 'Show post categories ?',
					'description' 	=> 'Choose if you want to show the post categories.',
					'type'        	=> 'toggle2',
					'value'			=> 'yes',
					'std'			=> 'yes',
					'class'			=> 'zn_full'
				),
				array(
					'id'         	=> 'show_likes',
					'name'       	=> 'Show post likes ?',
					'description' 	=> 'Choose if you want to show the post likes.',
					'type'        	=> 'toggle2',
					'value'			=> 'yes',
					'std'			=> 'yes',
					'class'			=> 'zn_full'
				),
				array(
					'id'         	=> 'show_comments',
					'name'       	=> 'Show post comments number ?',
					'description' 	=> 'Choose if you want to show the post comments number.',
					'type'        	=> 'toggle2',
					'value'			=> 'yes',
					'std'			=> 'yes',
					'class'			=> 'zn_full'
				),
				array(
					'id'         	=> 'image_dimension',
					'name'       	=> 'Choose post thumbnail dimension',
					'description' 	=> 'Choose the desired post thumbnail dimension. The value is in pixels for both height and width.',
					'type'        	=> 'text',
					'std'			=> '68',
					'class'			=> 'zn_full'
				),
			 );
		
	}

	function widget($args, $instance)
	{
	
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? esc_attr($instance['title']) : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( esc_attr($instance['number']) ) : 2;
		$image_dimension = ( ! empty( $instance['image_dimension'] ) ) ? absint( esc_attr($instance['image_dimension']) ) : 68;
		$category = ! empty( $instance['category'] ) ? $instance['category'] : '';
		if ( ! $number ){$number = 10; }

		$args =  array( 
			'posts_per_page' => $number, 
			'no_found_rows' => true, 
			'post_status' => 'publish', 
			'ignore_sticky_posts' => true, 
			'category__in' => $category 
		);

		if ( !empty( $instance['only_images'] ) && $instance['only_images'] == 'yes'){ 
			$args['meta_key'] = '_thumbnail_id';
		}

		$r = new WP_Query( $args );

		echo $before_widget; 
		
		
		if ($r->have_posts()) :

			if ( $title ) echo $before_title . $title . $after_title; 

			echo '<ul class="reset-list">';

				while ( $r->have_posts() ) : $r->the_post();
					echo '<li class="clearfix mbottom20">';
						global $post;
						if( has_post_thumbnail( get_the_ID() ) ) {
							echo zn_get_post_image(  get_the_ID(), $image_dimension, $image_dimension );
						}

						echo '<div class="post_meta">';
							echo '<h5><a class="zn-paragraph-color" href="'. get_permalink() .'">'. get_the_title( get_the_ID() ).'</a></h5>';

							if ( !empty( $instance['show_date'] ) && $instance['show_date'] == 'yes'){
								echo '<div class="tcolor">'.get_the_date('', get_the_ID() ).'</div>';
							}
						
							if ( !empty( $instance['show_categories'] ) && $instance['show_categories'] == 'yes'){
								echo '<div class="tag">'.get_the_category_list( ', ' ).'</div>';
							}

							if ( !empty( $instance['show_likes'] ) && $instance['show_likes'] == 'yes'){
								zn_show_hearts( $post );
							}

							if ( !empty( $instance['show_comments'] ) && $instance['show_comments'] == 'yes'){
								echo '<span class="icon-bubbles4 mleft10 mright10"><span class="mleft5 zn-paragraph-color">'.get_comments_number().'</span></span>';
							}

							

						echo '</div>';

					echo '</li>';
				endwhile;

				echo '</ul>';

			
			wp_reset_postdata();
		endif;
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
	
		$instance = $old_instance;

		foreach( $this->options as $option ){
			$instance[$option['id']] = $new_instance[$option['id']];
			
		} 
	
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}


	function form( $instance ) {

		global $zn_framework;
		//print_z($instance);

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'zn_framework' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>


<?php

		foreach( $this->options as $option ){
			if( !empty( $instance[  $option['id'] ] ) ) {
				$option['std'] = $instance[  $option['id'] ];
			}
	
			$option['id'] = $this->get_field_name( $option['id'] );
	
			echo $zn_framework->html()->zn_render_single_option($option);
	
		}

	}
}
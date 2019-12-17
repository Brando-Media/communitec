<?php
/*
	Plugin Name: AboutMe Widget
	Description: Plugin is used for About me description.
	Author:
	Version: 1.0
	Author URI:  
*/

class aboutme_widget extends WP_Widget {
/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function aboutme_Widget() {

	$widget_options = array(
		'classname' => 'aboutme_widget',
		'description' => __('Custom AboutMe widget.','crofts'));

	$control_options = array(   
		'width' => 200,
		'height' => 400,
		'id_base' => 'aboutme_widget'
	);

	$this->WP_Widget( 'aboutme_widget', __('Pego - AboutMe Widget','crofts'), $widget_options, $control_options );
	
}
function widget( $args, $instance ) {
	
	extract( $args );
	//$title = apply_filters('widget_title', $instance['title'] );
	$image1 = $instance['image1'];
	$image2 = $instance['image2'];
	$image3 = $instance['image3'];
	$image4 = $instance['image4'];
	$image5 = $instance['image5'];
	$signatureimage = $instance['signatureimage'];
	$description = $instance['description'];
	echo $before_widget;	
	/*
	if ( $title )
	{
		echo $before_title;
		echo $title;
		echo $after_title;
	}
	*/
	wp_enqueue_script('pego_owl_carousel');
	$array_of_images = array();
	if ($image1 != '') { $array_of_images[] = $image1; }
	if ($image2 != '') { $array_of_images[] = $image2; }
	if ($image3 != '') { $array_of_images[] = $image3; }
	if ($image4 != '') { $array_of_images[] = $image4; }
	if ($image5 != '') { $array_of_images[] = $image5; }
	
	
	?>
	<div class="about-me-thumbs">
	<?php
	if (count($array_of_images) > 1) {
	?>
		
		<div  class="about-me-slide owl-carousel owl-theme">
			<?php
			foreach($array_of_images as $single_image) {	 
			?>
				<div class="item"><img src="<?php echo esc_url($single_image); ?>" alt="" /></div>
			<?php
			}
			?>
		</div>
		<?php
	} else {

		foreach($array_of_images as $single_image) {	 
			?>
				<div class="single-about-me-image"><img src="<?php echo esc_url($single_image); ?>" alt="" /></div>
			<?php
		}
	}
	?>
	</div>
	<?php
		if ($description != '') {  echo '<div class="textwidget about-me-text">'.$description.'</div>'; }
		if ($signatureimage != '') {  echo '<div class="signatureimage"><img src="'. esc_url($signatureimage).'" alt="" /></div>'; }
		?>
		<div class="clear"></div><?php
	echo $after_widget;	
}
function form( $instance ) {  

		/* Set default values. */
		$defaults = array(
		'title' => __('AboutMe Widget','crofts'),
		'username' => '52617155@N08',
		'pics_number' => '9'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 

	 ?>
		
		
		<label for="<?php echo $this->get_field_id( 'image1' ); ?>">
		<?php _e('Image #1 url:','crofts'); ?>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'image1' ); ?>" 
				 name="<?php echo $this->get_field_name( 'image1' ); ?>" 
				 value="<?php echo $instance['image1']; ?>" />
		</label>
																													
		<label for="<?php echo $this->get_field_id( 'image2' ); ?>">
		<?php _e('Image #2 url:','crofts'); ?>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'image2' ); ?>" 
				 name="<?php echo $this->get_field_name( 'image2' ); ?>" 
				 value="<?php echo $instance['image2']; ?>" />
		</label>
		
		<label for="<?php echo $this->get_field_id( 'image3' ); ?>">
		<?php _e('Image #3 url:','crofts'); ?>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'image3' ); ?>" 
				 name="<?php echo $this->get_field_name( 'image3' ); ?>" 
				 value="<?php echo $instance['image3']; ?>" />
		</label>
		
		<label for="<?php echo $this->get_field_id( 'image4' ); ?>">
		<?php _e('Image #4 url:','crofts'); ?>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'image4' ); ?>" 
				 name="<?php echo $this->get_field_name( 'image4' ); ?>" 
				 value="<?php echo $instance['image4']; ?>" />
		</label>
		
		<label for="<?php echo $this->get_field_id( 'image5' ); ?>">
		<?php _e('Image #5 url:','crofts'); ?>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'image5' ); ?>" 
				 name="<?php echo $this->get_field_name( 'image5' ); ?>" 
				 value="<?php echo $instance['image5']; ?>" />
		</label>
		
		<label for="<?php echo $this->get_field_id( 'description' ); ?>">
		<?php _e('Description:','crofts'); ?>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'description' ); ?>" 
				 name="<?php echo $this->get_field_name( 'description' ); ?>"  ><?php echo $instance['description']; ?></textarea>
		</label>

		<label for="<?php echo $this->get_field_id( 'signatureimage' ); ?>">
		<?php _e('Signature image url:','crofts'); ?>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'signatureimage' ); ?>" 
				 name="<?php echo $this->get_field_name( 'signatureimage' ); ?>" 
				 value="<?php echo $instance['signatureimage']; ?>" />
		</label>
			
	<?php
	}
}


/*     Adding widget to widgets_init and registering aboutme widget    */
add_action( 'widgets_init', 'aboutme_widgets' );

function aboutme_widgets() {
	register_widget( 'aboutme_Widget' );
}
?>
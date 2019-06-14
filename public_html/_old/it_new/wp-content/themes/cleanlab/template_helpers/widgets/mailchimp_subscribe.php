<?php
add_action('widgets_init', 'zn_mailchimp_subscribe_widget');

function zn_mailchimp_subscribe_widget()
{
	register_widget('ZnMailchimpSubscribeWidget');
}

class ZnMailchimpSubscribeWidget extends WP_Widget {

	var $options;

	function __construct() {

		$widget_ops = array('classname' => 'widget-mailchimp-subscribe', 'description' => __( "Mailchimp subscribe.", 'zn_framework') );
		parent::__construct('themefuzz-mailchimp-subscribe', __('ThemeFuzz : Mailchimp subscribe', 'zn_framework'), $widget_ops);
		$this->alt_option_name = 'widget_themefuzz_mailchimp_subscribe';
		
		$this->options = array(
				array(
					'id'          => 'mailchimp_list',
					'name'        => 'Mailchimp List',
					'description' => 'Please select your desired Mailchimp list. If this is empty, please make sure that you have entered your Mailchimp API key inside the theme options panel',
					'type'        => 'select',
					'options'	  => generate_mailchimp_lists( 'mailchimp_api' , 'general_options' ),
					'class'		  => 'zn_full'
				),
				array(
					'id'         	=> 'description_text',
					'name'       	=> 'Description text',
					'description' 	=> 'Please enter a description text for this subscribe widget.',
					'type'        	=> 'textarea',
					'std'			=> 'By subscribing to our mailing list you will always be update with the latest news from us.',
					'class'		  => 'zn_full'
				),
				array(
					    'id'          => 'button_style',
					    'name'        => 'Button style',
					    'description' => 'Select the style for the button.',
					    'type'        => 'select',
					    'std'		  => 'zn_btn_3d',
					    'options'	  => zn_get_button_styles()
					)
			 );
		
	}

	function widget($args, $instance) 
	{
	
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? esc_attr($instance['title']) : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $before_widget; 
		if ( $title ) echo $before_title . $title . $after_title; 
		
		if ( empty(  $instance['mailchimp_list'] ) ) {
			echo '<div class="zn-pb-notification">It seems that you didn\'t selected any mailchimp list. Please go to the widget settings and select a mailchimp list.</div>';
			echo $after_widget;
			return;
		}
		
		if (empty($instance['button_style'])) {
			$instance['button_style'] = 'zn_btn_3d';
		}
				
		 if ( !empty( $instance['mailchimp_list'] ) && zget_option( 'mailchimp_api' , 'general_options' ) ) { ?>
			<div class="cs_newsletter zn_subscribe">
				<form method="post" class="zn_newsletter newsletter-signup" name="newsletter_form">	
					<input type="hidden" name="zn_mailchimp_list_id" class="zn_mailchimp_list_id" value="<?php echo $instance['mailchimp_list']; ?>">
					<div class="zn_newsletter_inputs">
						<button class="submit btn <?php echo $instance['button_style']; ?> zn_icon" type="submit" name="subscribe">
							<span class="zn_icon" data-unicode="ue855" data-zniconfam="icomoon" data-zn_icon="&#xe69f;"></span>
						</button>
						<div class="zn_input_stretch">
							<input type="text" name="zn_mc_email" class="nl-email zn-alternative-bkg" value="" placeholder="<?php _e('Enter your email address', 'zn_framework'); ?>">
						</div>
					</div>
				</form>
				<div class="zn_mailchimp_message"></div>
				<?php
					if( !empty( $instance['description_text'] ) ) { echo '<div class="zn_mc_description">'.esc_html( $instance['description_text'] ).'</div>'; }
				?>
			</div>
	
		<?php } 

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
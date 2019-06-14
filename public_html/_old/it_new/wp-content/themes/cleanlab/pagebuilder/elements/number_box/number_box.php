<?php
/*
	Name: Number Box
	Description: This element will generate a text box with a title, subtitle and description
	Class: ZnNumberBox
	Category: content
	Level: 3
	Style: true
	Scripts: true
*/

class ZnNumberBox extends ZnElements {

	function options() {
		global $zn_framework;
		$options = array(		
					//array(
					//        'id'          => 'style',
					//        'name'        => 'Style',
					//        'description' => 'Select a style for this element',
					//        'type'        => 'select',
					//        'options'	  => array( ''=>'Style 1' , 'style2' => 'Style 2', 'style3' => 'Style 3', 'style4' => 'Style 4'),
					//        'live' => array(
					//            'type'		=> 'class',
					//            'css_class' => '.'.$this->data['uid']
					//        )
					//    ),
					//array(
					//    'id'          => 'alignment',
					//    'name'        => 'Alignment',
					//    'description' => 'Select the horizontal alignment.',
					//    'type'        => 'select',
					//    'std'		  => 'left',
					//    'options'        => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
					//    'live' => array(
					//        'type'		=> 'class',
					//        'css_class' => '.'.$this->data['uid'] //.' > div:first-child'
					//    )
					//),
					array(
						'id'          => 'end_number',
						'name'        => 'Number',
						'description' => 'Please enter a number for this element',
						'type'        => 'text',
						'std'		=> ''
					),
					array(
						'id'          => 'start_number',
						'name'        => 'Start Number',
						'description' => 'Please enter a number from which you wish to start the animation. Enter the same number for no animation.',
						'type'        => 'text',
						'std'		=> ''
					),
					array(
						'id'          => 'description',
						'name'        => 'Description',
						'description' => 'Please enter a description for this element',
						'type'        => 'text',
						'std'		=> ''
					),
					array(
						'id'          => 'speed',
						'name'        => 'Animation Speed',
						'description' => 'Please enter the desired speed for animation (in miliseconds).',
						'type'        => 'text',
						'std'		=> '2500'
					),
			);

		return $options;

	}

	function scripts() {
		wp_enqueue_script( 'zncountto', THEME_BASE_URI .'/pagebuilder/elements/number_box/assets/js/jquery.countTo.js', array('jquery'), ZN_FW_VERSION, true );
	}
	
	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		$number = $this->opt('end_number','');
		$start_number = $this->opt('start_number',$number);
		$description = $this->opt('description','');
		$speed = $this->opt('speed',5000);
		
		if ( empty( $number ) && empty($description)) {
			echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
			return;
		}
		

		
		?>
		
		<div class="timer-box zn-primary-as-bg center <?php echo $this->data['uid']; ?>">
			<span class="zn_timer zn-alternative-color" data-from="<?php echo esc_attr( $start_number ); ?>" data-to="<?php echo esc_attr( $number ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>"><?php echo $start_number; ?></span>
			<div class="zn_desc zn-alternative-color"><?php echo $description; ?></div>
		</div>

		<?php
	}

}

?>
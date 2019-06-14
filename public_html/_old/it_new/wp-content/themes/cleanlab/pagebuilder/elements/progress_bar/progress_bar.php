<?php
/*
	Name: Progress Bar Circular
	Description: This element will generate a progress bar
	Class: ZnProgressBar
	Category: content
	Level: 3
	Style: true
	Scripts: true
*/

class ZnProgressBar extends ZnElements {

	function options() {
		global $zn_framework;
		$options = array(
				'has_tabs'  => true,
                'general' => array(
                    'title' => 'General options',
                    'options' => array(
						array(
						'id'          => 'progress_percent',
						'name'        => 'Progress percent',
						'description' => 'Select the progress percent.',
						'type'        => 'slider',
						'std'		  => '100',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '100',
							'step' => '1'
						),
					),
					array(
						'id'          => 'title',
						'name'        => 'Title',
						'description' => 'Please enter your desired title',
						'type'        => 'text'
					),
					array(
						'id'          => 'desc',
						'name'        => 'Description',
						'description' => 'Please enter your desired description',
						'type'        => 'visual_editor',
						'std' => '',
						'class'		  => 'zn_full'
					),
					
					
					)
				),
				'styling' => array(
                    'title' => 'Styling options',
                    'options' => array(
						array(
						'id'          => 'foreground_color',
						'name'        => 'Progress foreground color',
						'description' => 'Please select a color for the progress foreground color',
						'type'        => 'colorpicker',
						'std'         => '#ff525e'
					),
					array(
						'id'          => 'background_color',
						'name'        => 'Progress background color',
						'description' => 'Please select a color for the progress background color',
						'type'        => 'colorpicker',
						'std'         => '#fafafa'
					),
					array(
				        'id'          => 'size',
				        'name'        => 'Size',
				        'description' => 'Select a size for the circle of this progress bar',
				        'std'		  => '200',
						'type'		  => 'slider',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '50',
							'max' => '300',
							'step' => '50'
						),
				    ),
					array(
				        'id'          => 'thickness',
				        'name'        => 'Thickness',
				        'description' => 'Set a thickness for this bar (100 = full circle)',
				        'std'		  => '10',
						'type'		  => 'slider',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '1',
							'max' => '100',
							'step' => '1'
						),
				    ),
					array(
						'id'          => 'linecap',
						'name'        => 'Line Cap',
						'description' => 'Set the gauge stroke endings.',
						'type'        => 'select',
						'std'		  => 'round',
						'options'	  => array( 'round' => 'Round', 'butt' => 'Butt')
					),
					array(
				        'id'          => 'top_spacing',
				        'name'        => 'Top spacing',
				        'description' => 'Select a top spacing for this element',
				        'std'		  => '10',
						'type'		  => 'slider',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '200',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'], 
							'css_rule'	=> 'margin-top',
							'unit'		=> 'px'
						)
				    ),
					array(
				        'id'          => 'middle_spacing',
				        'name'        => 'Middle spacing',
				        'description' => 'Select a middle spacing for this element',
				        'std'		  => '20',
						'type'		  => 'slider',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '200',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'].' .procent', 
							'css_rule'	=> 'margin-top',
							'unit'		=> 'px'
						)
				    ),
					)
				),
				'icon' => array(
                    'title' => 'Icon',
                    'options' => array(
						array(
						'id'          => 'icon',
						'name'        => '',
						'description' => '',
						'type'        => 'icon_list',
						'std'		  => '',
						'class' 	  => 'zn_full'
					),	
					
					
					)
				),
				'misc' => array(
                    'title' => 'Miscellaneous',
                    'options' => array(
						array(
						'id'          => 'speed',
						'name'        => 'Animation Speed',
						'description' => 'Please enter the desired speed for animation (in milliseconds).',
						'type'        => 'text',
						'std'		=> '2500'
					),
					)
				),
			);

		return $options;

	}

	function scripts() {
		wp_enqueue_script( 'znknob', THEME_BASE_URI .'/pagebuilder/elements/progress_bar/assets/js/jquery.knob.js', array('jquery'), ZN_FW_VERSION, true );
	}

	function element() {
		global $zn_framework;
		
		//$style = $this->opt('style')  ? $this->opt('style') : '';
		$iconHolder = $this->opt('icon');
		$icon = !empty( $iconHolder['family'] )  ? '<span class="progress-icon zn-paragraph-color" '.zn_generate_icon( $this->opt('icon') ).'></span>' : '';
		$title = $this->opt('title', '');
		$desc = $this->opt('desc', '');
		$progress_percent = $this->opt('progress_percent', '');
		$foreground_color = $this->opt('foreground_color','transparent');
		$background_color = $this->opt('background_color','transparent');
		$size = $this->opt('size',200);
		$speed = $this->opt('speed',2500);
		$thickness = $this->opt('thickness', 10) / 100;
		$linecap = $this->opt('linecap', 'round');

		if ( empty($desc) && empty( $title ) && empty( $icon ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}

		?>

		<div class="circular-bar center <?php echo $this->data['uid']; // .' '.$style ?>">
			<input type="text" class="zn_dial" data-fgColor="<?php echo esc_attr( $foreground_color ); ?>" data-bgColor="<?php echo esc_attr( $background_color ); ?>" data-width="<?php echo esc_attr( $size ); ?>" data-height="<?php echo esc_attr( $size ); ?>" data-linecap="<?php echo esc_attr( $linecap ); ?>" value="<?php echo esc_attr( $progress_percent ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-thickness="<?php echo esc_attr( $thickness ); ?>">
			<?php echo $icon; ?>
			<span class="procent zn-secondary-color"><?php echo $progress_percent; ?>%</span>
			<h4 class="zn-paragraph-color"><?php echo $title; ?></h4>
			<div class="separator2"></div>
			<?php echo wpautop($desc); ?>
		</div> 

		<?php
	}
	
		function css(){

		$uid = $this->data['uid'];
		$size = $this->opt('size',200);
		$top_spacing = $this->opt('top_spacing', 0);
		$middle_spacing = $this->opt('middle_spacing', 20);
		
		$iconTop = round($size / 2 - 17);
		$procFont = round($size * 0.2);
		
		$css = ".$uid.circular-bar .progress-icon { top: ".$iconTop."px; }
				.$uid.circular-bar .procent {font-size: ".$procFont."px; margin-top:".$middle_spacing."px;}
				.$uid.circular-bar {margin-top:".$top_spacing."px;}";

		return $css;
	}

}

?>
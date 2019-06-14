<?php
/*
	Name: Separator
	Description: This element will generate a separator line
	Class: ZnSeparator
	Category: Content, Fullwidth
	Level: 3
*/

class ZnSeparator extends ZnElements {

	function options() {

		$options = array(
				array(
					'id'          => 'top_margin',
					'name'        => 'Top margin',
					'description' => 'Select the top margin (in pixels).',
					'type'        => 'slider',
					'std'		  => '0',
					'class'		  => 'zn_full',
					'helpers'	  => array(
						'min' => '0',
						'max' => '500',
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
					'id'          => 'bottom_margin',
					'name'        => 'Bottom margin',
					'description' => 'Select the bottom margin (in pixels).',
					'type'        => 'slider',
					'std'		  => '35',
					'class'		  => 'zn_full',
					'helpers'	  => array(
						'min' => '0',
						'max' => '500',
						'step' => '1'
					),
					'live' => array(
						'type'		=> 'css',
						'css_class' => '.'.$this->data['uid'], 
						'css_rule'	=> 'margin-bottom',
						'unit'		=> 'px'
					)
				),
                array(
					'id'          => 'color',
					'name'        => 'Separator color',
					'description' => 'Select the color for separator line.',
					'type'        => 'colorpicker',
					'std'		  => '', // zget_option( 'default_text_color' , 'style_options' ),
                    'live' => array(
                        'type'		=> 'css',
                        'css_class' => '.'.$this->data['uid'], 
                        'css_rule'	=> 'border-color',
                        'unit'		=> ''
                    )
				),
                array(
					'id'          => 'height',
					'name'        => 'Separator height',
					'description' => 'Select the separator line height (in pixels).',
					'type'        => 'slider',
					'std'		  => '1',
					'class'		  => 'zn_full',
					'helpers'	  => array(
						'min' => '0',
						'max' => '15',
						'step' => '1'
					),
					'live' => array(
						'type'		=> 'css',
						'css_class' => '.'.$this->data['uid'], 
						'css_rule'	=> 'border-top-width',
						'unit'		=> 'px'
					)
				),
			);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		?>
			<div class="zn_separator clearfix <?php echo $this->data['uid']; ?>"></div>
		<?php
	}


	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		$tmargin = $this->opt('top_margin')  || $this->opt('top_margin') === '0' ? 'margin-top : '.$this->opt('top_margin').'px;' : '';
		$bmargin = $this->opt('bottom_margin') || $this->opt('bottom_margin') === '0' ? 'margin-bottom:'.$this->opt('bottom_margin').'px;' : 'margin-bottom:35px;';
		$height = $this->opt('height') || $this->opt('height') === '0' ? 'border-top-width:'.$this->opt('height').'px;' : 'border-top-width:1px;';
        $color = $this->opt('color') ? 'border-color:'.$this->opt('color').';' : 'border-color:transparent;';
		$uid = $this->data['uid'];

		$css = ".$uid {
				$tmargin
				$bmargin
                $height
                $color
		}";

		return $css;
	}

}

?>
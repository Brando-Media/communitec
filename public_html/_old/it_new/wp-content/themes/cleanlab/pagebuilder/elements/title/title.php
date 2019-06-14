<?php
/*
	Name: Title
	Description: This element will generate a simple title
	Class: ZnSectionTitle
	Category: content
	Level: 3
	Style: true
	
*/

class ZnSectionTitle extends ZnElements {

	function options() {
		global $zn_framework;
		$options = array(
				'has_tabs'  => true,
                'general' => array(
                    'title' => 'General options',
                    'options' => array(
						array(
							'id'          => 'title',
							'name'        => 'Title',
							'description' => 'Please enter your desired title',
							'type'        => 'textarea',
							'std'		=> ''
						),
						array(
							"id"            => "heading",
							"name"          => "Heading",
							"description"   => "Select a heading you for this element. It's recommended to have one and only one H1 heading in each page.",
							"type"          => "select",
							"std"         => "h2",
							"options"		=> array( 'div' => 'No heading' , 'h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'h4' => 'H4', 'h5' => 'H5', 'h6' => 'H6' ),
						),
					)
				),
				'styling' => array(
                    'title' => 'Styling options',
                    'options' => array(
						//array(
						//        'id'          => 'style',
						//        'name'        => 'Element Style',
						//        'description' => 'Please choose the desired style you want to use',
						//        'type'        => 'select',
						//        'std'			=> '',
						//        'options'	  => array( ''=>'Style 1' , 'm0' => 'Style 2' , 'mbottom20' => 'Style 3', 'mbottom50' => 'Style 4'  ),
						//        'live' => array(
						//            'type'		=> 'class',
						//            'css_class' => '.'.$this->data['uid']
						//        )
						//),
						array(
								'id'          => 'color_style',
								'name'        => 'Color Style',
								'description' => 'Please choose the desired color style you want to use',
								'type'        => 'select',
								'std'			=> 'zn-secondary-color',
								'options'	  => zn_get_theme_color_styles(),
													//array( 'zn-secondary-color'=>'Secondary color' , 
													//    'zn-primary-color' => 'Primary color' , 
													//    'zn-alternative-color' => 'Alternative color', 
													//    'zn-paragraph-color' => 'Paragraph color',
													//    'zn-background-color-color' => 'Background color',
													//    'zn-alternative-bkg-color' => 'Alternative background color',
													//    'zn-border-color' => 'Border color'
													//    ),
								'live' => array(
									'type'		=> 'class',
									'css_class' => '.'.$this->data['uid']
								)
						),
						array(
								'id'          => 'alignment',
								'name'        => 'Alignment',
								'description' => 'Select the horizontal alignment of the title.',
								'type'        => 'select',
								'std'		  => '',
								'options'        => array( '' => 'Left', /*'fleft' => 'Force left',*/ 'center' => 'Center', 'right' => 'Right' ),
								'live' => array(
										'type'		=> 'class',
										'css_class' => '.'.$this->data['uid']
								)
						),
						array(
							"id"            => "font_weight",
							"name"          => "Font weight",
							"description"   => "Select a font weight for this element",
							"type"          => "select",
							"std"         => "div",
							"options"		=> array( '300' => 'Light' , '400' => 'Normal', '500' => 'Strong', '700' => 'Bold', '900' => 'Bolder' ),
							'live' => array(
								'type'		=> 'css',
								'css_class' => '.'.$this->data['uid'], 
								'css_rule'	=> 'font-weight',
								'unit'		=> ''
							)
						),
						array(
							'id'          => 'font_size',
							'name'        => 'Font size',
							'description' => 'Select the font size for this element.',
							'type'        => 'slider',
							'std'		  => '30',
							'class'		  => 'zn_full',
							'helpers'	  => array(
								'min' => '1',
								'max' => '200',
								'step' => '1'
							),
							'live' => array(
								'type'		=> 'css',
								'css_class' => '.'.$this->data['uid'], 
								'css_rule'	=> 'font-size',
								'unit'		=> 'px'
							)
						),
						array(
							'id'          => 'line_height',
							'name'        => 'Line height',
							'description' => 'Select the line height for this element.',
							'type'        => 'slider',
							'std'		  => '35',
							'class'		  => 'zn_full',
							'helpers'	  => array(
								'min' => '1',
								'max' => '250',
								'step' => '1'
							),
							'live' => array(
								'type'		=> 'css',
								'css_class' => '.'.$this->data['uid'], 
								'css_rule'	=> 'line-height',
								'unit'		=> 'px'
							)
						),
						array(
							'id'          => 'bottom_margin',
							'name'        => 'Bottom margin',
							'description' => 'Select the bottom margin (in pixels).',
							'type'        => 'slider',
							'std'		  => '20',
							'class'		  => 'zn_full',
							'helpers'	  => array(
								'min' => '0',
								'max' => '250',
								'step' => '1'
							),
							'live' => array(
								'type'		=> 'css',
								'css_class' => '.'.$this->data['uid'], 
								'css_rule'	=> 'margin-bottom',
								'unit'		=> 'px'
							)
						),
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
		$title = $this->opt('title')  ? $this->opt('title') : '';
		//$style = $this->opt('style')  ? $this->opt('style') : '';
		$alignment = $this->opt('alignment')  ? $this->opt('alignment') : '';
		$colorStyle = $this->opt('color_style','');
		$heading = $this->opt('heading','h2');
		$uid = $this->data['uid'];
		
		if ( empty($title) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}
		
		echo "<$heading class='$colorStyle $alignment $uid'>$title</$heading>";
	}
	
	function css(){
		$uid = $this->data['uid'];
		$bmargin = $this->opt('bottom_margin', 20);
		$font_size = $this->opt('font_size',30);
		$line_height = $this->opt('line_height',35);
		$font_weight = $this->opt('font_weight',300);

		$css = ".$uid { margin-bottom: {$bmargin}px; font-weight: $font_weight; font-size: {$font_size}px; line-height: {$line_height}px; }";

		return $css;
	}

}

?>
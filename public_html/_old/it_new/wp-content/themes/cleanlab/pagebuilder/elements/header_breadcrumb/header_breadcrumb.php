<?php
/*
	Name: Title Bar
	Description: This element will generate an icon box
	Class: ZnHeaderBreadcrumb
	Category: Content, Fullwidth
	Level: 3
	Style: true
	
*/

class ZnHeaderBreadcrumb extends ZnElements {

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
						'type'        => 'text'
					),
					array ( 
						"name" => "Page description",
						"description" => "Please enter a description",
						"id" => "zn_page_subtitle",
						"std" => "",
						"type" => "text"
					),
					array ( 
						'id'         	=> 'show_breadcrumb',
						'name'       	=> 'Show breadcrumbs',
						'description' 	=> 'Select if you want to show the breadcrumbs',
						'type'        	=> 'toggle2',
						'value'			=> 'yes',
						'std'			=> 'yes',
						'dependency'	=> array( 'element' => 'title_bar_display' , 'value'=> array('bg_title_left','bg_title_right', 'bg_title_center', 'default_title_bar' ) )
					),
					array(
						'id'          => 'title_bar_bg',
						'name'        => 'Background image',
						'description' => 'Choose a background image for the element',
						'type'        => 'background',
						'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
						'std'		  => false,
						'dependency'	=> array( 'element' => 'title_bar_display' , 'value'=> array('bg_title_left','bg_title_right', 'bg_title_center', 'default_title_bar' ) ),
						'class'		  => 'zn_full'
					),
				)
			),
			'styling' => array(
				'title' => 'Styling option',
				'options' => array(
					array ( 
						'id'         	=> 'title_bar_display',
						'name'       	=> 'Title bar display',
						'description' 	=> 'Choose how the title bar should be displayed. ',
						'std'			=> '',
						"type" => "select",
						"options" => array( 
							'' => 'Set in theme options', 
							'default_title_bar' => 'Default title bar',
							'bg_title_left' => 'Title and description on left / with background image',
							// 'bg_title_right' => 'Title and description on right / with background image',
							'bg_title_center' => 'Title and description centered / with background image'
						)
					),
					array(
						'id'          => 'header_ustyle',
						'name'        => 'Color Style',
						'std'         => '',
						'description' => 'Using this option you can use a style that was created using the custom colors option from the theme options panel.',
						'type'        => 'select',
						'options'	  => $zn_framework->unlimited_styles(),
						'dependency'	=> array( 'element' => 'title_bar_display' , 'value'=> array('bg_title_left','bg_title_right', 'bg_title_center', 'default_title_bar' ) )
					),
					array(
						'id'          => 'top_margin',
						'name'        => 'Top margin',
						'description' => 'Select the top margin (in pixels) for this element.',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '400',
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
						'description' => 'Select the bottom margin ( in pixels ) for this element.',
						'type'        => 'slider',
						'std'		  => '50',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '400',
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


	function element() {

		$title = $this->opt('title','');
		$description = $this->opt('zn_page_subtitle','');
		$layout = $this->opt('title_bar_display','');
		$args = array();

		if ( !empty( $title ) ) { $args['title'] = $this->opt('title',''); }
		if ( !empty( $description ) ) { $args['description'] = $this->opt('zn_page_subtitle',''); }
		if ( !empty( $layout ) ) {
			$args['layout'] = $this->opt('title_bar_display','');
			$args['color_style'] = $this->opt('header_ustyle','');
			$args['background'] = $this->opt('title_bar_bg','');
			$args['show_bread'] = $this->opt('show_breadcrumb','');
		}

		$args['class'] = $this->data['uid'];

		zn_get_header_breadcrumb($args, true); //** $ignorePostType = tue

	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		//print_z($this);
		$uid = $this->data['uid'];
		$tmargin = $this->opt('top_margin') || $this->opt('top_margin') === '0' ? 'margin-top : '.$this->opt('top_margin').'px;' : '';
		$bmargin = $this->opt('bottom_margin') || $this->opt('bottom_margin') === '0' ? 'margin-bottom:'.$this->opt('bottom_margin').'px;' : '';


		$css = ".$uid {
				$tmargin
				$bmargin
			}";

		return $css;
	}

}

?>
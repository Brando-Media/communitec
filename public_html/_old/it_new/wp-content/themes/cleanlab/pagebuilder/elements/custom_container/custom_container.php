<?php
/*
	Name: Custom Container
	Description: This element will generate a custom container in which you can add elements
	Class: ZnCustomContainer
	Category: Layout
	Level: 3
    Style: true
*/

	class ZnCustomContainer extends ZnElements {

	function options() {
		global $zn_framework;
		
		$newStyles = array('' => 'Use section colors');
		$old = $zn_framework->unlimited_styles();
		unset( $old['zn_cs_DefaultColors'] );
		$newStyles = array_merge($newStyles,   $old );
	
		$options = array(
			'has_tabs'  => true,
			'background' => array(
				'title' => 'Style options',
				'options' => array(
					array(
						'id'          => 'background_color',
						'name'        => 'Background color',
						'description' => 'Here you can choose a custom background color for this container.',
						'type'        => 'colorpicker',
						'std'         => '',
						'live'        => array(
												'type'		=> 'css',
												'css_class' => '.'.$this->data['uid'], 
												'css_rule'	=> 'background-color',
												'unit'		=> ''
											)
					),
					array(
						'id'          => 'background_image',
						'name'        => 'Background image',
						'description' => 'Please choose a background image for this section.',
						'type'        => 'background',
						'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
						'class'		  => 'zn_full'
					),
					array (
							'id'          => 'ustyle',
							'name'        => 'Color style',
							'description' => 'Select a color style you wish to use inside this container.',
							'type'        => 'select',
							'options'	  => $newStyles,
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid']
							)
						),
				)
			),
			'padding' => array(
				'title' => 'Padding options',
				'options' => array(
					array(
						'id'          => 'top_padding',
						'name'        => 'Top padding',
						'description' => 'Select the top padding (in percent) for this container.',
						'type'        => 'slider',
						'std'		  => '1',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'], 
							'css_rule'	=> 'padding-top',
							'unit'		=> '%'
						)
					),
					array(
						'id'          => 'right_padding',
						'name'        => 'Right padding',
						'description' => 'Select the right padding (in percent) for this container.',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'], 
							'css_rule'	=> 'padding-right',
							'unit'		=> '%'
						)
					),
					array(
						'id'          => 'bottom_padding',
						'name'        => 'Bottom padding',
						'description' => 'Select the bottom padding (in percent) for this container.',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'], 
							'css_rule'	=> 'padding-bottom',
							'unit'		=> '%'
						)
					),
					array(
						'id'          => 'left_padding',
						'name'        => 'Left padding',
						'description' => 'Select the left padding (in percent) for this container.',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'], 
							'css_rule'	=> 'padding-left',
							'unit'		=> '%'
						)
					),
				)
			),
			'border' => array(
				'title' => 'Border options',
				'options' => array(
					array (
							'id'          => 'border_style',
							'name'        => 'Border style',
							'description' => 'Select a border style you wish to use for this container.',
							'type'        => 'select',
							'options'	  => array( 'none'		=> 'None',
													'solid'		=> 'Solid',
													'dotted'	=> 'Dotted',
													'dashed'	=> 'Dashed',
													'double'	=> 'Double',
													'groove'	=> 'Groove',
													'ridge'		=> 'Ridge',
													'inset'		=> 'Inset',
													'outset'	=> 'Outset'),
							'live' => array(
								'type'		=> 'css',
								'css_class' => '.'.$this->data['uid'],
								'css_rule'	=> 'border-style',
								'unit'		=> ''
							)
						),
					array(
						'id'          => 'border_width',
						'name'        => 'Border width',
						'description' => 'Select the border width you wish to use for this container.',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'], 
							'css_rule'	=> 'border-width',
							'unit'		=> 'px'
						)
					),
					array(
						'id'          => 'border_color',
						'name'        => 'Border color',
						'description' => 'Here you can override the background color for this section.',
						'type'        => 'colorpicker',
						'std'         => '',
						'live'        => array(
												'type'		=> 'css',
												'css_class' => '.'.$this->data['uid'], 
												'css_rule'	=> 'border-color',
												'unit'		=> ''
											)
					),
					array(
						'id'          => 'corner_radius',
						'name'        => 'Corner radius',
						'description' => 'Select a corner radius (in pixels) for this container.',
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
							'css_rule'	=> 'border-radius',
							'unit'		=> 'px'
						)
					),
				)
			),
		);	

		return $options;

	}

	function element() {

		global $zn_framework;		
		$ustyle = $this->opt('ustyle', '');
		//var_dump($this->data['content']);
	?>
	<div class="row zn_columns_container zn_content zn_custom_container <?php echo $ustyle.' '.$this->data['uid']; ?>" data-droplevel="1">
	<?php
		if ( empty( $this->data['content']) ) {
			$column = $zn_framework->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' );
			$this->data['content'] = array ( $column );
		} 
		if ( !empty( $this->data['content'] ) ) {
            $zn_framework->pagebuilder->zn_render_content( $this->data['content'] );
        }
	?>
	
	</div>
		
		
	<?php
	}
	
	function css(){

		//print_z($this);
		$uid = $this->data['uid'];
		$tpadding = $this->opt('top_padding') || $this->opt('top_padding') === '0' ? 'padding-top : '.$this->opt('top_padding').'%;' : 'padding-top:1%;';
		$rpadding = $this->opt('right_padding') ? 'padding-right : '.$this->opt('right_padding').'%;' : '';
		$bpadding = $this->opt('bottom_padding') ? 'padding-bottom:'.$this->opt('bottom_padding').'%;' : '';
		$lpadding = $this->opt('left_padding') ? 'padding-left:'.$this->opt('left_padding').'%;' : '';
		$stored_background = $this->opt('background_image', false);
		$background_color = $this->opt('background_color', '');
		
		//** Set the background image for the container
		$background_image = '';
		if ( $stored_background && !empty( $stored_background['image'] ) ){
			$background_image = "background-image: url('".$stored_background['image']."');";
			$background_image .= 'background-repeat:'. $stored_background['repeat'].';';
			$background_image .= 'background-position:'. $stored_background['position']['x'].' '.$stored_background['position']['y'].';';
			$background_image .= 'background-attachment:'. $stored_background['attachment'].';';
			$background_image .= 'background-size:'. $stored_background['size'].';';
		}
		
		//** Set the background color for the container
		$bkg_color = '';
		if (!empty($background_color))
		{
			$bkg_color = " background-color:$background_color !important; ";
		}
		
		//** Set the border for the container
		$border = "";
		$border_style = $this->opt('border_style','none');
		if ($border_style !== 'none') {
			$border_width = $this->opt('border_width',0);
			$border_color = $this->opt('border_color','transparent');
			$border = " border-style:$border_style; border-width:{$border_width}px; border-color:$border_color;";
		}
		
		//** Set the corner radius
		$border_radius = "";
		$corner_radius = $this->opt('corner_radius','');
		if (!empty($corner_radius))
		{
			$border_radius =  "-moz-border-radius:{$corner_radius}px; -webkit-border-radius:{$corner_radius}px; border-radius:{$corner_radius}px;";
		}
		
		$css = ".$uid {
				$tpadding
				$rpadding
				$bpadding
				$lpadding
				$background_image
				$bkg_color
				$border
				$border_radius}
		";

		return $css;
	}

}

?>
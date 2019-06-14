<?php
/*
	Name: Section
	Description: This element will generate a section in which you can add elements
	Class: ZnSection
	Category: Layout, Fullwidth
	Level: 1
	Style: true
	
*/

class ZnSection extends ZnElements {

	function options() {
		global $zn_framework;
		$options = array(

					array(
						'id'          => 'top_padding',
						'name'        => 'Top padding',
						'description' => 'Select the top padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'		  => '35',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'], 
							'css_rule'	=> 'padding-top',
							'unit'		=> 'px'
						)
					),
					array(
						'id'          => 'bottom_padding',
						'name'        => 'Bottom padding',
						'description' => 'Select the bottom padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'		  => '35',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'], 
							'css_rule'	=> 'padding-bottom',
							'unit'		=> 'px'
						)
					),
					array (
						'id'          => 'size',
						'name'        => 'Section Size',
						'description' => 'Select the desired size for this section.',
						'type'        => 'select',
						'options'	  => array( 'container' => 'Fixed width' , 'full_width' => 'Full width' ),
						'live' => array(
							'type'		=> 'class',
							'css_class' => '.'.$this->data['uid'].' .zn_section_size'
						)
					),
					array (
						'id'          => 'ustyle',
						'name'        => 'Color Style',
						'description' => 'Using this option you can add a style that was created using the custom colors option from the theme options panel.',
						'type'        => 'select',
						'options'	  => $zn_framework->unlimited_styles(),
						'live' => array(
							'type'		=> 'class',
							'css_class' => '.'.$this->data['uid']
						)
					),
					array(
						'id'          => 'background_color',
						'name'        => 'Background color',
						'description' => 'Here you can override the background color for this section.',
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
						'class'		  => 'zn_full',
						'dependency' => array( 'element' => 'background_type' , 'value'=> array('image') )
					),
					array(
						'id'            => 'enable_parallax',
						'name'          => 'Enable parallax',
						'description'   => 'Select if you want to enable parallax effect on background image',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => 'yes'
					)
			);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		global $zn_framework;
		
		$css_class = $this->opt('ustyle') ? ' '.$this->opt('ustyle').' ' : '';
		$size = $this->opt('size') ? $this->opt('size') : 'container';
		$enable_parallax = $this->opt('enable_parallax') === 'yes' ? 'zn_parallax' : '';

		if ( empty( $this->data['content'] ) ) {
			$this->data['content'] = array ( $zn_framework->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' ) );
		}

		?>
		<section class="zn_section <?php echo $css_class.' '.$this->data['uid'].' '.$enable_parallax; ?>">
			<div class="zn_section_size <?php echo $size;?>">
				<div class="row zn_columns_container zn_content" data-droplevel="1">
					
					<?php 
						$zn_framework->pagebuilder->zn_render_content( $this->data['content'] );
					?>
				
				</div>
			</div>
		</section>
	<?php
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		//print_z($this);
		$uid = $this->data['uid'];
		$tpadding = $this->opt('top_padding') || $this->opt('top_padding') === '0' ? 'padding-top : '.$this->opt('top_padding').'px;' : 'padding-top:35px;';
		$bpadding = $this->opt('bottom_padding') || $this->opt('bottom_padding') === '0' ? 'padding-bottom:'.$this->opt('bottom_padding').'px;' : 'padding-bottom:35px;';
		$stored_background = $this->opt('background_image')  ? $this->opt('background_image') : false;
		$background_color = $this->opt('background_color') ? $this->opt('background_color') : '';

		$background_image = $bkg_color = '';

		if ( $stored_background && !empty( $stored_background['image'] ) ){
			$background_image = "background-image: url('".set_url_scheme( $stored_background['image'] )."');";
			$background_image .= 'background-repeat:'. $stored_background['repeat'].';';
			$background_image .= 'background-position:'. $stored_background['position']['x'].' '.$stored_background['position']['y'].';';
			$background_image .= 'background-attachment:'. $stored_background['attachment'].';';
			if (!empty($stored_background['size'])) {
				$background_image .= 'background-size:'. $stored_background['size'].';';
			}
		}
		
		//** Set background color of the section
		if (!empty($background_color))
		{
			$bkg_color = ".zn_section.$uid{ background-color:$background_color}";
		}
		
		$css = ".$uid {
				$tpadding
				$bpadding
				$background_image }
		$bkg_color";

		return $css;
	}

}

?>
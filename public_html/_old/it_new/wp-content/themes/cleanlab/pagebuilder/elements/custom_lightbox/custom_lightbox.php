<?php
/*
	Name: Custom Lightbox
	Description: This element will generate a simple lightbox for a specific URL
	Class: ZnCustomLightbox
	Category: content, media
	Level: 3
	Style: true
	
*/

class ZnCustomLightbox extends ZnElements {

	function options() {
		global $zn_framework;
		$options = array(
				'has_tabs'  => true,
                'general' => array(
                    'title' => 'General options',
                    'options' => array(
						array(
							'id'          => 'link',
							'name'        => 'Lightbox URL',
							'description' => 'Enter a link for this lightbox. It can be a video (youtube, vimeo), or just a HTML.',
							'type'        => 'link'
						),
					)
				),
				'styling' => array(
                    'title' => 'Styling options',
                    'options' => array(
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
									'css_class' => '.'.$this->data['uid'].' span'
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
						//array(
						//    "id"            => "font_weight",
						//    "name"          => "Font weight",
						//    "description"   => "Select a font weight for this element",
						//    "type"          => "select",
						//    "std"         => "div",
						//    "options"		=> array( '300' => 'Light' , '400' => 'Normal', '500' => 'Bold', '700' => 'Bolder' ),
						//    'live' => array(
						//        'type'		=> 'css',
						//        'css_class' => '.'.$this->data['uid'], 
						//        'css_rule'	=> 'font-weight',
						//        'unit'		=> ''
						//    )
						//),
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
						//array(
						//    'id'          => 'line_height',
						//    'name'        => 'Line height',
						//    'description' => 'Select the line height for this element.',
						//    'type'        => 'slider',
						//    'std'		  => '35',
						//    'class'		  => 'zn_full',
						//    'helpers'	  => array(
						//        'min' => '1',
						//        'max' => '250',
						//        'step' => '1'
						//    ),
						//    'live' => array(
						//        'type'		=> 'css',
						//        'css_class' => '.'.$this->data['uid'], 
						//        'css_rule'	=> 'line-height',
						//        'unit'		=> 'px'
						//    )
						//),
						array(
							'id'          => 'top_padding',
							'name'        => 'Top padding',
							'description' => 'Select the top padding (in pixels).',
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
								'css_rule'	=> 'padding-top',
								'unit'		=> 'px'
							)
						),
						array(
							'id'          => 'bottom_padding',
							'name'        => 'Bottom padding',
							'description' => 'Select the bottom padding (in pixels).',
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
								'css_rule'	=> 'padding-bottom',
								'unit'		=> 'px'
							)
						),
					)
				),
				'icon' => array(
                    'title' => 'Play Icon',
                    'options' => array(
						array(
							'id'          => 'icon',
							'name'        => '',
							'description' => '',
							'type'        => 'icon_list',
							'std'		  => array('family'=>'icomoon', 'unicode'=>'ue864'),
							'class' 	  => 'zn_full'
						),
					))
			);
		

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		$link_extracted = $this->opt('link') ? zn_extract_link( $this->opt('link') , 'zn-nivo-lightbox', 'data-lightbox-type="iframe"' ) : '';
		$alignment = $this->opt('alignment')  ? $this->opt('alignment') : '';
		$colorStyle = $this->opt('color_style','');
		$iconHolder = $this->opt('icon');
		$icon = !empty( $iconHolder['family'] )  ? '<span class="zn-primary-hover '.$colorStyle.'" '.zn_generate_icon( $this->opt('icon') ).'></span>' : '';
		$uid = $this->data['uid'];
		
		if ( empty($link_extracted['start']) || empty($icon)) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}
		
		?>
		
		<div class="zn_lightbox <?php echo $alignment.' '.$uid; ?>">
			<?php echo $link_extracted['start'] . $icon . $link_extracted['end']; ?>
		</div>
		
		<?php
	}
	
	function css(){
		$uid = $this->data['uid'];
		$bpadding = $this->opt('bottom_padding', 20);
		$tpadding = $this->opt('top_padding', 20);
		$font_size = $this->opt('font_size',30);
		//$line_height = $this->opt('line_height',35);
		//$font_weight = $this->opt('font_weight',300);

		$css = ".$uid { padding-top: {$tpadding}px; padding-bottom: {$bpadding}px; font-size: {$font_size}px; }";

		return $css;
	}

}

?>
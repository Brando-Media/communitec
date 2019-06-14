<?php
/*
	Name: Call to Action 2
	Description: This element will generate a Call to action box
	Class: ZnCallToAction2
	Category: content
	Level: 3
	Style: true
	
*/

class ZnCallToAction2 extends ZnElements {

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
						'description' => 'Please enter the title for this element',
						'type'        => 'text',
						'std'		=> ''
					),
					array(
						'id'          => 'subtitle',
						'name'        => 'Description',
						'description' => 'Please enter a description for this element',
						'type'        => 'visual_editor',
						'class'		=> 'zn_full',
						'std'		=> ''
					),
					array(
						'id'          => 'image',
						'name'        => 'Image',
						'description' => 'Optionally select an image you want to use as background for this element',
						'type'        => 'media',
						//'supports'    => 'id',
						'class'		  => 'zn_full'
					),
					//array(
					//    'id'            => 'custom_img_size',
					//    'name'          => 'Custom image size',
					//    'description'   => 'Select if you want to enter a custom size for the image. If not, full size of the image will be used.',
					//    'type'          => 'toggle2',
					//    'std'           => '',
					//    'value'         => 'yes'
					//),
					//array(
					//    'id'          => 'img_width',
					//    'name'        => 'Image width',
					//    'description' => 'Enter the desired image width.',
					//    'type'        => 'slider',
					//    'std'		  => '200',
					//    'class'		  => 'zn_full',
					//    'helpers'	  => array(
					//        'min' => '10',
					//        'max' => '1920',
					//        'step' => '1'
					//    ),
					//    'dependency'  => array( 'element' => 'custom_img_size' , 'value'=> array('yes') ),
					//),
					//array(
					//    'id'          => 'img_height',
					//    'name'        => 'Image height',
					//    'description' => 'Enter the desired image height.',
					//    'type'        => 'slider',
					//    'std'		  => '150',
					//    'class'		  => 'zn_full',
					//    'helpers'	  => array(
					//        'min' => '10',
					//        'max' => '1080',
					//        'step' => '1'
					//    ),
					//    'dependency'  => array( 'element' => 'custom_img_size' , 'value'=> array('yes') ),
					//),
					array(
						'id'          => 'link',
						'name'        => 'Button 1 link',
						'description' => 'Enter a link for this element',
						'type'        => 'link'
					),
					array(
						'id'          => 'link_text',
						'name'        => 'Button 1 text',
						'description' => 'Enter a text for this element\'s button',
						'type'        => 'text',
						'std'		=> ''
					),
					array(
						'id'          => 'link2',
						'name'        => 'Button 2 link',
						'description' => 'Enter a link for this element. It will be opened in a lightbox.',
						'type'        => 'link'
					),
					array(
						'id'          => 'link2_text',
						'name'        => 'Button 2 text',
						'description' => 'Enter a text for this element\'s button',
						'type'        => 'text',
						'std'		=> ''
					),
				)
			),
			'styling' => array(
				'title' => 'Styling options',
				'options' => array(
					//array(
					//        'id'          => 'style',
					//        'name'        => 'Style',
					//        'description' => 'Select a style for this element',
					//        'type'        => 'select',
					//        'options'	  => array( 'style1'=>'Style 1' , 
					//                                'style2' => 'Style 2', 
					//                                'style3' => 'Style 3', 
					//                                'style4' => 'Style 4', 
					//                                'style5' => 'Style 5',
					//                                'style6' => 'Style 6'),
					//        'live' => array(
					//            'type'		=> 'class',
					//            'css_class' => '.'.$this->data['uid']
					//        )
					//    ),
					array(
						'id'          => 'alignment',
						'name'        => 'Alignment',
						'description' => 'Select the horizontal alignment.',
						'type'        => 'select',
						'std'		  => 'left',
						'options'        => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
                        'live' => array(
							'type'		=> 'class',
							'css_class' => '.'.$this->data['uid'] //.' > div:first-child'
						)
					),
					array(
						'id'          => 'link_style',
						'name'        => 'Button 1 style',
						'description' => 'Select a style for this button',
						'type'        => 'select',
						'std'		=> 'btn-default',
						'options'	=> zn_get_button_styles(),
						'live' => array(
					        'type'		=> 'class',
					        'css_class' => '.'.$this->data['uid'] .' .btn'
					    )
					),
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
				)
			),
			'icon' => array(
				'title' => 'Button 2 Icon',
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
			)
		);


		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		$title = $this->opt('title')  ? $this->opt('title') : '';
		$subTitle = $this->opt('subtitle', '');
		$alignment = $this->opt('alignment')  ? $this->opt('alignment') : '';
		//$style = $this->opt('style')  ? $this->opt('style') : '';
		$link_text = $this->opt('link_text', '');
		$link_style = $this->opt('link_style','btn-default');
		$link = zn_extract_link( $this->opt('link') , 'btn btn1 '.$link_style );
		$iconHolder = $this->opt('icon');
		$icon = !empty( $iconHolder['family'] )  ? '<span class="cta2-icon" '.zn_generate_icon( $this->opt('icon') ).'></span>' : '';
		$link2_text = $this->opt('link2_text','');
		$link2 = zn_extract_link( $this->opt('link2') , 'btn btn2 zn-nivo-lightbox zn-secondary-hover');
		//$image_src ='';
		//$image = $this->opt('image', '');
		//if ($image) {
			//$custom_img_size = $this->opt('custom_img_size') === 'yes' ? true : false;
			//if ($custom_img_size) {
			//    $img_width = $this->opt('img_width', 200);
			//    $img_height = $this->opt('img_height', 150);
			//    $image_src = zn_get_image( $image , $img_width, $img_height, array('class' => 'cta-image img-responsive' ) );
			//}
			//else {
			//	$image_src = wp_get_attachment_image( $image, 'full', false, array( 'class' => 'cta-image img-responsive' ) );
			//}
		//}
		
		if ( empty( $title ) && empty($subTitle) && empty($link_text) && empty($link2_text)) {
			echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
			return;
		}
		
		?>
		<div class="row zn_callToAction2 <?php echo $this->data['uid'].' '.$alignment; ?>">
			<div class="zn-img-overlay"></div>
			<div class="col-sm-12">
				<h2 class="title"><?php echo $title; ?></h2>
				<div class="desc"><?php echo wpautop( $subTitle ); ?></div>
				<?php echo $link['start'] . $link_text . $link['end']; ?>
				<?php echo $link2['start'] . $icon . $link2_text . $link2['end']; ?>
			</div>
		</div>
		<?php
	}
	
	function css(){
		$css = "";
		$uid = $this->data['uid'];
		$image = esc_url( $this->opt('image', '') );
		$tpadding = $this->opt('top_padding') || $this->opt('top_padding') === '0' ? 'padding-top : '.$this->opt('top_padding').'px;' : 'padding-top:35px;';
		$bpadding = $this->opt('bottom_padding') || $this->opt('bottom_padding') === '0' ? 'padding-bottom:'.$this->opt('bottom_padding').'px;' : 'padding-bottom:35px;';
		$imgBkg = '';		
		if (!empty($image)) {
			$imgBkg = "background-image:url('$image');";
		}
		
		$css .= ".$uid { $tpadding $bpadding $imgBkg}";
		
		return $css;
	}

}

?>
<?php
/*
	Name: Image
	Description: This element adds an image.
	Class: ZnImageContainer
	Category: Content, Media
	Level: 3
	Styles: true
*/

class ZnImageContainer extends ZnElements {

	function options() {
		$options = array(
				'has_tabs'  => true,
                'general' => array(
                    'title' => 'General options',
                    'options' => array(
						 array(
							'id'          => 'image',
							'name'        => 'Image',
							'description' => 'Select the image you want to use',
							'type'        => 'media',
							'supports'    => 'id',
							'class'		  => 'zn_full'
						),
						array(
							'id'            => 'custom_img_size',
							'name'          => 'Custom image size',
							'description'   => 'Select if you want to enter a custom size for the images. If not, full size of each image will be used.',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),
						array(
							'id'          => 'img_width',
							'name'        => 'Image width',
							'description' => 'Enter the desired image width.',
							'type'        => 'slider',
							'std'		  => '653',
							'class'		  => 'zn_full',
							'helpers'	  => array(
								'min' => '10',
								'max' => '1920',
								'step' => '1'
							),
							'dependency'  => array( 'element' => 'custom_img_size' , 'value'=> array('yes') ),
						),
						array(
							'id'          => 'img_height',
							'name'        => 'Image height',
							'description' => 'Enter the desired image height.',
							'type'        => 'slider',
							'std'		  => '361',
							'class'		  => 'zn_full',
							'helpers'	  => array(
								'min' => '10',
								'max' => '1080',
								'step' => '1'
							),
							'dependency'  => array( 'element' => 'custom_img_size' , 'value'=> array('yes') ),
						),
						array(
							'id'          => 'link',
							'name'        => 'Image link',
							'description' => 'Optionally enter a link for the image',
							'type'        => 'link',
							'dependency'  => array( 'element' => 'click_action' , 'value'=> array('link') ),
						),
					)
				),
				'styling' => array(
                    'title' => 'Styling options',
                    'options' => array(
						//array(
						//    'id'          => 'style',
						//    'name'        => 'Element Style',
						//    'description' => 'Please choose the desired style you want to use',
						//    'type'        => 'select',
						//    'options'	  => array( ''=>'Style 1' , 'style2' => 'Style 2'  ),
						//    'live' => array(
						//        'type'		=> 'class',
						//        'css_class' => '.'.$this->data['uid']
						//    )
						//),
						array(
							'id'          => 'alignment',
							'name'        => 'Alignment',
							'description' => 'Select the horizontal alignment.',
							'type'        => 'select',
							'std'		  => 'zn_img_center',
							'options'        => array( '' => 'Left', 'zn_img_center' => 'Center', 'zn_img_right' => 'Right' ),
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid'] //.' > div:first-child'
							)
						),
						array(
						    'id'          => 'top_padding',
						    'name'        => 'Top padding',
						    'description' => 'Select the top padding (in pixels) for this image.',
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
							    'css_rule'	=> 'padding-top',
							    'unit'		=> 'px'
						    )
					    ),
					    array(
						    'id'          => 'bottom_padding',
						    'name'        => 'Bottom padding',
						    'description' => 'Select the bottom padding (in pixels) for this image.',
						    'type'        => 'slider',
						    'std'		  => '40',
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
						array(
							'id'            => 'round_img',
							'name'          => 'Round corners',
							'description'   => 'Select if you wish to make the corners round. Provide a square image if you wish the result to be a circle.',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'round',
							'live' => array(
							    'type'		=> 'class',
							    'css_class' => '.'.$this->data['uid'], 
						    )
						),
					)
				),
			);


		return $options;

	}

	function element(){
        //$style = $this->opt('style') ? $this->opt('style') : '';
		$image = $this->opt('image') ? $this->opt('image') : '';
		$alignment = $this->opt('alignment', '');
		$custom_img_size = $this->opt('custom_img_size') === 'yes' ? true : false;
		$link = zn_extract_link( $this->opt('link'));
		$round_img = $this->opt('round_img','');
        
		if ( empty( $image ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		} 
        
        //$image_src = wp_get_attachment_image( $image, 'full', false, array('class' => 'img-responsive '.$alignment.' '.$this->data['uid']) );
		
		if ($custom_img_size) {
			$img_width = $this->opt('img_width', 660);
			$img_height = $this->opt('img_height', 420);
			$image_src = zn_get_image( $image , $img_width, $img_height, array('class' => 'img-responsive '.$alignment) );
		}
		else {
			$image_src = wp_get_attachment_image( $image, 'full', false, array('class' => 'img-responsive '.$alignment) );
		}
        
		echo '<div class="zn-image '.$round_img.' '.$this->data['uid'].'">';
        echo $link['start'];
		echo $image_src;
		echo $link['end'];   
		echo '</div>';
	}
    
    function css(){

		//print_z($this);
        $uid = $this->data['uid'];
		$tpadding = $this->opt('top_padding') || $this->opt('top_padding') === '0' ? 'padding-top : '.$this->opt('top_padding').'px;' : 'padding-top:35px;';
		$bpadding = $this->opt('bottom_padding') || $this->opt('bottom_padding') === '0' ? 'padding-bottom:'.$this->opt('bottom_padding').'px;' : 'padding-bottom:35px;';
        
		$css = ".$uid { $tpadding $bpadding }";

		return $css;
	}

}


?>
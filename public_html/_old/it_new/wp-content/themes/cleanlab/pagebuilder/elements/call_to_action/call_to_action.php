<?php
/*
	Name: Call to Action
	Description: This element will generate a Call to action box
	Class: ZnCallToAction
	Category: content
	Level: 3
	Style: true
	
*/

class ZnCallToAction extends ZnElements {

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
							'description' => 'Select the image you want to use',
							'type'        => 'media',
							'supports'    => 'id',
							'class'		  => 'zn_full'
						),
						array(
							'id'            => 'custom_img_size',
							'name'          => 'Custom image size',
							'description'   => 'Select if you want to enter a custom size for the image. If not, full size of the image will be used.',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),
						array(
							'id'          => 'img_width',
							'name'        => 'Image width',
							'description' => 'Enter the desired image width.',
							'type'        => 'slider',
							'std'		  => '200',
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
							'std'		  => '150',
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
							'name'        => 'Button link',
							'description' => 'Enter a link for this element',
							'type'        => 'link'
						),
						array(
							'id'          => 'link_text',
							'name'        => 'Button text',
							'description' => 'Enter a text for this element\'s button',
							'type'        => 'text',
							'std'		=> ''
						),
					)
				),
				'styling' => array(
                    'title' => 'Styling options',
                    'options' => array(
						array(
								'id'          => 'style',
								'name'        => 'Style',
								'description' => 'Select a style for this element',
								'type'        => 'select',
								'options'	  => array( 'style1'=>'Style 1' , 
														'style2' => 'Style 2', 
														'style3' => 'Style 3', 
														'style4' => 'Style 4', 
														'style5' => 'Style 5',
														'style6' => 'Style 6'),
								'live' => array(
									'type'		=> 'class',
									'css_class' => '.'.$this->data['uid']
								)
							),
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
							'name'        => 'Button style',
							'description' => 'Select a style for this button',
							'type'        => 'select',
							'std'		=> 'btn-default',
							'options'	=> zn_get_button_styles(),
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid'] .' .btn'
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
		$subTitle = $this->opt('subtitle')  ? $this->opt('subtitle') : '';
		//$image = $this->opt('image') ? $this->opt('image') : '';
		$alignment = $this->opt('alignment')  ? $this->opt('alignment') : '';
		$style = $this->opt('style')  ? $this->opt('style') : '';
		$link_text = $this->opt('link_text') ? $this->opt('link_text') : '';
		$link_style = $this->opt('link_style','btn-default');
		$link = zn_extract_link( $this->opt('link') , 'btn '.$link_style );
		$textCols = (empty($link_text) || empty( $link['start'] ))? 'col-sm-12' : 'col-sm-9';
		$image_src ='';
		$image = $this->opt('image', false);
		if ($image) {
			$custom_img_size = $this->opt('custom_img_size') === 'yes' ? true : false;
			if ($custom_img_size) {
				$img_width = $this->opt('img_width', 200);
				$img_height = $this->opt('img_height', 150);
				$image_src = zn_get_image( $image , $img_width, $img_height, array('class' => 'cta-image img-responsive' ) );
			}
			else {
				$image_src = wp_get_attachment_image( $image, 'full', false, array( 'class' => 'cta-image img-responsive' ) );
			}
		}
		
		if ( empty( $title ) && empty($subTitle) && empty($link_text) && empty($image_src)) {
			echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
			return;
		}
		
		?>
		<div class="row zn_callToAction <?php echo $style.' '.$this->data['uid'].' '.$alignment; ?>">
			<div class="<?php echo $textCols; ?>">
				<?php echo $image_src; ?>
				<h2 class="section-title"><?php echo $title; ?></h2>
				<?php echo wpautop( $subTitle ); ?>
			</div>
			<?php if (!empty($link_text) && !empty( $link['start'] )) {?>
				<div class="col-sm-3">
					<?php echo $link['start'] . $link_text . $link['end']; ?>
				</div>
			<?php }?>
		</div>
		<?php
	}

}

?>
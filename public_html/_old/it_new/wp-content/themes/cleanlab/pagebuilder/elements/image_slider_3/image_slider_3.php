<?php
/*
	Name: Image Slider 3
	Description: This element will generate an image slider
	Class: ZnImageSlider3
	Category: Content, Media
	Level: 3
	Styles: true
*/

class ZnImageSlider3 extends ZnElements {

	function options() {
	
		global $zn_framework;
		
		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
                            'id'	      => 'title',
                            'name'        => 'Title',
                            'description' => 'Enter a title for this element.',
                            'type'        => 'text',
                        ),
						array(
							'id'         	=> 'images',
							'name'       	=> 'Slider images',
							'description' 	=> 'Here you can add your images.',
							'type'        	=> 'group',
							'sortable'	  	=> true,
							'element_title' => 'name',
							'subelements' 	=> array(
													array(
														'id'          => 'image',
														'name'        => 'Image',
														'description' => 'Select the image you want to use for this slide',
														'type'        => 'media',
														'supports'    => 'id',
														'class'		  => 'zn_full'
													),
													array(
														'id'          => 'link',
														'name'        => 'Image link',
														'description' => 'Optionally, enter a link for this image',
														'type'        => 'link'
													),
													array(
														'id'			=> 'name',
														'name'			=> 'Name',
														'description'	=> 'Short text that helps identifying the image in the slider options',
														'type'			=> 'text',
													)
											)

						),
						array(
							'id'            => 'show_img_caption',
							'name'          => 'Show image caption',
							'description'   => 'Select if you want to display the image caption.',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
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
							'id'            => 'custom_img_size_t',
							'name'          => 'Custom thumbnail size',
							'description'   => 'Select if you want to enter a custom size for the image thumbnails. If not, a default of 160px width will be used.',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),
						array(
							'id'          => 'img_width_t',
							'name'        => 'Thumbnail width',
							'description' => 'Enter the desired thumbnail width.',
							'type'        => 'slider',
							'std'		  => '160',
							'class'		  => 'zn_full',
							'helpers'	  => array(
								'min' => '10',
								'max' => '1920',
								'step' => '1'
							),
							'dependency'  => array( 'element' => 'custom_img_size_t' , 'value'=> array('yes') ),
						),
						array(
							'id'          => 'img_height_t',
							'name'        => 'Thumbnail height',
							'description' => 'Enter the desired thumbnail height.',
							'type'        => 'slider',
							'std'		  => '100',
							'class'		  => 'zn_full',
							'helpers'	  => array(
								'min' => '10',
								'max' => '1080',
								'step' => '1'
							),
							'dependency'  => array( 'element' => 'custom_img_size_t' , 'value'=> array('yes') ),
						),
						array(
							'id'            => 'use_max_height',
							'name'          => 'Use a maximum image height',
							'description'   => 'Select if you want to enter a maximum height for the images. This is useful when working with images with different aspect ratios.',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),
						array(
							'id'          => 'max_height',
							'name'        => 'Maximum image height',
							'description' => 'Enter the desired maximum image height.',
							'type'        => 'slider',
							'std'		  => '250',
							'class'		  => 'zn_full',
							'helpers'	  => array(
								'min' => '10',
								'max' => '1920',
								'step' => '1'
							),
							'dependency'  => array( 'element' => 'use_max_height' , 'value'=> array('yes') ),
						),
						array(
							'id'            => 'use_max_height_t',
							'name'          => 'Use a maximum image thumbnail height',
							'description'   => 'Select if you want to enter a maximum height for the image thumbnails. This is useful when working with images with different aspect ratios.',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),
						array(
							'id'          => 'max_height_t',
							'name'        => 'Maximum image thumbnails height',
							'description' => 'Enter the desired maximum height for the thumbnails.',
							'type'        => 'slider',
							'std'		  => '50',
							'class'		  => 'zn_full',
							'helpers'	  => array(
								'min' => '10',
								'max' => '1920',
								'step' => '1'
							),
							'dependency'  => array( 'element' => 'use_max_height_t' , 'value'=> array('yes') ),
						),
				)
			),
			'styling' => array(
				'title' => 'Styling options',
				'options' => array(
					array(
							'id'          => 'title_color',
							'name'        => 'Title Color',
							'description' => 'Choose the color of the title',
							'type'        => 'select',
							'std'		  => 'zn-secondary-color',
							'options'     => zn_get_theme_color_styles(),
							 'live' => array(
							    'type'		=> 'class',
							    'css_class' => '.'.$this->data['uid'].' .zn_title'
							    )
						),
						array(
						    'id'            => 'show_bullets',
						    'name'          => 'Show bullets',
						    'description'   => 'Select if you want to show the navigation bullets',
						    'type'          => 'toggle2',
						    'std'           => '',
						    'value'         => 'yes'
						),
						array(
							'id'            => 'show_navigation',
							'name'          => 'Show navigation',
							'description'   => 'Select if you want to show the navigation arrows',
							'type'          => 'toggle2',
							'std'           => 'yes',
							'value'         => 'yes'
						),
						array(
							'id'            => 'nav_style',
							'name'          => 'Navigation style',
							'description'   => 'Select a style for the navigation buttons of this carousel',
							'type'          => 'select',
							'std'           => 'sideNav hollowNav',
							'options'	    => zn_get_navigation_styles(),
							'dependency'  => array( 'element' => 'show_navigation' , 'value'=> array('yes') ),
							'live' => array(
									'type'		=> 'class',
									'css_class' => '.'.$this->data['uid'].' .zn_owl_carousel'
							)
						),
				)
			),
			'misc' => array(
				'title' => 'Miscellaneous',
				'options' => array(
					array(
							'id'            => 'visible_imgs',
							'name'          => 'Visible images',
							'description'   => 'Select the number of image thumbnails that should be visible at one time',
							'type'        => 'slider',
							'std'		  => '4',
							'class'		  => 'zn_full',
							'helpers'	  => array(
								'min' => '2',
								'max' => '20',
								'step' => '1'
							),
						),
					array(
							'id'            => 'auto_scroll',
							'name'          => 'Auto scroll',
							'description'   => 'Select if you want the carousel to scroll automatically',
							'type'          => 'toggle2',
							'std'           => 'yes',
							'value'         => 'yes'
						),
						array(
							'id'          => 'timeout_duration',
							'name'        => 'Timeout duration',
							'description' => 'Enter the time interval between scrolls (in milliseconds).',
							'type'        => 'text',
							'std'		  => '5000',
							'dependency'  => array( 'element' => 'auto_scroll' , 'value'=> array('yes') ),
						),
				)
			),
		);

		return $options;

	}

	function element(){
		//$style = $this->opt('style','');
		$title_color = $this->opt('title_color','zn-secondary-color');
		$navStyle = $this->opt('nav_style','sideNav hollowNav');
		$title = $this->opt('title','');
		$images = $this->opt('images') ? $this->opt('images') : false;
		$show_img_caption = $this->opt('show_img_caption') === 'yes' ? true : false;
		$custom_img_size = $this->opt('custom_img_size') === 'yes' ? true : false;
		$custom_img_size_t = $this->opt('custom_img_size_t') === 'yes' ? true : false;
		$autoScroll = $this->opt('auto_scroll') === 'yes' ? $this->opt('timeout_duration',5000) : 'false';
		$show_bullets = $this->opt('show_bullets') === 'yes' ? 'true' : 'false';
		$show_navigation = $this->opt('show_navigation') === 'yes' ? 'true' : 'false';
		$visible_imgs = $this->opt('visible_imgs',1);
		$single = $visible_imgs > 1 ? 'false' : 'true';
		$uid = $this->data['uid'];
        
		if ( empty( $images ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}

	?>

	    <div class="zn_img_slider3 zn_connected_owl <?php echo $uid; ?>">
	    	<?php if ( !empty( $title ) ) : ?>
				<h2 class="zn_title <?php echo $title_color; ?>"><?php echo $title; ?></h2>
			<?php endif; ?>
			
			<div class="zn_owl_carousel owl-carousel owl-theme zn_main_owl <?php echo $navStyle; ?>" data-auto="<?php echo esc_attr( $autoScroll ); ?>" data-pagination="false" data-navigation="<?php echo $show_navigation; ?>" data-single="true">
			<?php
					foreach ( $images as $image ) {
						$image_src ='';
						$link = zn_extract_link( $image['link'] , ' source ' );
						
						if ($custom_img_size) {
						    $img_width = $this->opt('img_width', 660);
						    $img_height = $this->opt('img_height', 420);
						    $image_src = zn_get_image( $image['image'] , $img_width, $img_height, array('class' => 'img-responsive' ) );
						}
						else {
							$image_src = wp_get_attachment_image( $image['image'], 'full', false, array( 'class' => 'img-responsive' ) );
						}

						echo '<div class="item center">';
							echo $link['start'];
							echo $image_src;
							echo $link['end'];
							if ($show_img_caption) {
								$attachment = get_post($image['image']);
								echo '<div class="caption">'.$attachment->post_excerpt.'</div>';
							}
						echo '</div>';
					}
				?>
			</div>
			<div class="zn_owl_carousel owl-carousel owl-theme zn_secondary_owl" data-auto="false" data-pagination="<?php echo $show_bullets; ?>"  data-single="false" data-items="<?php echo esc_attr( $visible_imgs ); ?>">
			<?php
					foreach ( $images as $image ) {
						$image_src ='';
						if ($custom_img_size_t) {
						    $img_width = $this->opt('img_width_t', 160);
						    $img_height = $this->opt('img_height_t', 100);
						    $image_src = zn_get_image( $image['image'] , $img_width, $img_height, array('class' => 'img-responsive' ) );
						}
						else {
							$image_src = zn_get_image( $image['image'] , 160, 0, array('class' => 'img-responsive' ) );
						}

						echo '<div class="item owl-secondary-item center">';
							echo $image_src;
						echo '</div>';
					}
				?>
			</div>
		</div>
		
	<?php
	}

	function css(){

	    $uid = $this->data['uid'];
		$css = '';
		$use_max_height = $this->opt('use_max_height') === 'yes' ? true : false;
		if ($use_max_height) 
		{
			$max_height = $this->opt('max_height', 250);
			$css .= ".$uid .zn_main_owl .item img {max-height: {$max_height}px; width:auto;}";
		}
		$use_max_height_t = $this->opt('use_max_height_t') === 'yes' ? true : false;
		if ($use_max_height_t) 
		{
			$max_height_t = $this->opt('max_height_t', 50);
			$css .= ".$uid .zn_secondary_owl .item img {max-height: {$max_height_t}px; width:auto;}";
		}
	    return $css;
	}
	
}


?>
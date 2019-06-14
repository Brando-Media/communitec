<?php
/*
	Name: Image Slider 2
	Description: This element will generate an image slider
	Class: ZnImageSlider2
	Category: Content,Media,Fullwidth
	Level: 3
	Styles: true
*/

class ZnImageSlider2 extends ZnElements {

	function options() {

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
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
														'id'            => 'use_lightbox',
														'name'          => 'Use lightbox',
														'description'   => 'Select if you want to open the link in a lightbox.',
														'type'          => 'toggle2',
														'std'           => '',
														'value'         => 'yes'
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
					        'id'          => 'count',
					        'name'        => 'Number of maximum visible images',
					        'description' => 'Please choose the desired number of maximum visible images.',
					        'type'        => 'slider',
							'std'		  => '3',
							'class'		  => 'zn_full',
							'helpers'	  => array(
								'min' => '1',
								'max' => '20',
								'step' => '1'
							),
						),
						array(
							'id'            => 'custom_img_size',
							'name'          => 'Custom image size',
							'description'   => 'Select if you want to enter a custom size for the images. If not, the size will be computed according to visible items count.',
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
				)
			),
			'styling' => array(
				'title' => 'Styling options',
				'options' => array(
					array(
							'id'            => 'show_img_caption',
							'name'          => 'Show image caption',
							'description'   => 'Select if you want to display the image caption.',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
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
							'std'           => 'sideNav solidNav2',
							'options'	    => zn_get_navigation_styles(),
												//array('sideNav hollowNav' => 'Side/Hollow 1',
												//     'sideNav hollowNav style2' => 'Side/Hollow 2',
												//     'sideNav solidNav' => 'Side/Solid 1',
												//     'sideNav solidNav2' => 'Side/Solid 2',
												//     'overTop hollowNav' => 'Top/Hollow 1', 
												//     'overTop hollowNav style2' => 'Top/Hollow 2',
												//     'overTop solidNav' => 'Top/Solid 1',
												//     'overTop solidNav2' => 'Top/Solid 2'),
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
							'description' => 'Enter the time interval between scrolls (in miliseconds).',
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
		$images = $this->opt('images') ? $this->opt('images') : false;
		$count = ( int )$this->opt('count',5);
		$show_img_caption = $this->opt('show_img_caption') === 'yes' ? true : false;
		$custom_img_size = $this->opt('custom_img_size') === 'yes' ? true : false;
		$autoScroll = $this->opt('auto_scroll') === 'yes' ? $this->opt('timeout_duration',5000) : 'false';
		$show_bullets = $this->opt('show_bullets') === 'yes' ? 'true' : 'false';
		$show_navigation = $this->opt('show_navigation') === 'yes' ? 'true' : 'false';
		$navStyle = $this->opt('nav_style','sideNav solidNav2');
		$uid = $this->data['uid'];
        
		if ( empty( $images ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}

	?>

	    <div class="zn_img_slider2 <?php echo $uid; ?>">
			<div class="zn_owl_carousel owl-carousel owl-theme <?php echo $navStyle; ?>" data-auto="<?php echo esc_attr( $autoScroll ); ?>" data-pagination="<?php echo $show_bullets; ?>" data-navigation="<?php echo $show_navigation; ?>" data-items="<?php echo $count; ?>" data-single="<?php echo $count > 1 ? 'false' : 'true';?>">
			<?php
					foreach ( $images as $image ) {
						$image_src ='';
						$use_lightbox = $image['use_lightbox'] == 'yes' ? 'zn-nivo-lightbox' : '';
						$link = zn_extract_link( $image['link'] , ' imgLink '.$use_lightbox.' ' );
						
						if ($custom_img_size) {
						    $img_width = $this->opt('img_width', 660);
						    $img_height = $this->opt('img_height', 420);
						    $image_src = zn_get_image( $image['image'] , $img_width, $img_height, array('class' => 'img-responsive' ) );
						}
						else {
							$img_width = 1980 / $count - 60; //60 is the padding
							$image_src = zn_get_image( $image['image'] , $img_width, 0, array('class' => 'img-responsive') );
							//$image_src = wp_get_attachment_image( $image['image'], 'full', false, array( 'class' => 'img-responsive' ) );
						}

						echo '<div class="item center">';
							echo $link['start'];
							echo $image_src;
							if ($show_img_caption) {
								$attachment = get_post($image['image']);
								echo '<div class="caption">'.$attachment->post_excerpt.'</div>';
							}
							echo $link['end'];
						echo '</div>';
					}
				?>
			</div>
		</div>
		
	<?php
	}

	
}


?>
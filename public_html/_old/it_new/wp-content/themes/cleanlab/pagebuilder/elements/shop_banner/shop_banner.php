<?php
/*
	Name: Shop Banner
	Description: This element will generate an icon box
	Class: ZnShopBanner
	Category: Content, Media
	Level: 3
	Style: true
	
*/

class ZnShopBanner extends ZnElements {

	function options() {
		global $zn_framework;

		$options = array(
				'has_tabs'	=> true,
				'general' => array(
					'title' => 'General options',
					'options' => array(
						array(
								'id'          => 'image',
								'name'        => 'Image',
								'description' => 'Select the image you want to use for this banner',
								'type'        => 'media',
								'supports'    => 'id',
								'class'		  => 'zn_full'
						),
						// array(
						//     'id'          => 'style',
						//     'name'        => 'Element Style',
						//     'description' => 'Select the desired element style. Please note that based on the banners and content height the style can be changed automatically to properly display the element.',
						//     'type'        => 'select',
						//     'std'		  => 'left',
						//     'options'        => array( '' => 'Default', 'content_centered' => 'All centered over main image', 'content_c_b_d' => 'Content centered, banners bellow', 'all_bellow' => 'Content and banners bellow' ),
						// ),
					)
				),
				'styling' => array(
					'title' => 'Content options',
					'options' => array(
						array(
							'id'          => 'title',
							'name'        => 'Title',
							'description' => 'Please enter a title for this element',
							'type'        => 'text',
							'std'		=> '',
						),
						array(
							'id'          => 'subtitle',
							'name'        => 'Subtitle',
							'description' => 'Please enter a subtitle for this element',
							'type'        => 'text',
							'std'		=> ''
						),
						array(
							'id'          => 'description',
							'name'        => 'Description',
							'description' => 'Please enter a description for this element',
							'type'        => 'visual_editor',
							'class'		=> 'zn_full',
							'std'		=> ''
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
				'banners' => array(
					'title'	=> 'Banners setup',
					'options'	=> array(
						array(
							'id'         	=> 'images',
							'name'       	=> 'Slider images',
							'description' 	=> 'Here you can add your images.',
							'type'        	=> 'group',
							'sortable'	  	=> true,
							'element_title' => 'Image',
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
							)

						)
					)
				)
			);

		return $options;

	}


	function element() {
		global $zn_framework;
		
		// General settings
		$image = $this->opt('image') ? $this->opt('image') : '';
		//$style = $this->opt('style','');
		$style = '';

		// Banners
		$main_image_src = wp_get_attachment_image( $image, 'full', false, array('class' => 'img-responsive') );
		$images = $this->opt('images') ? $this->opt('images') : false;

		// CONTENT
		$title = $this->opt('title')  ? $this->opt('title') : '';

		$subTitle = $this->opt('subtitle')  ? $this->opt('subtitle') : '';
		$description = $this->opt('description')  ? $this->opt('description') : '';
		$link_text = $this->opt('link_text') ? $this->opt('link_text') : '';
		$link_style = $this->opt('link_style','btn-default');
		$link = $this->opt('link') ? zn_extract_link( $this->opt('link') , 'btn '.$link_style ) : '';


		if ( empty( $image ) ) {
			echo '<div class="zn-pb-notification">Please configure the element and add an image.</div>';
			return;
		}

		$banners = '';
		$banners .= '<div class="col-sm-3 zn_sb_inner_banners">';
		$banners .= '<div class="banners">';

			foreach ( $images as $image ) {
				$image_src ='';
				$link = $image['link'] ? zn_extract_link( $image['link'] , ' source ' ) : '';

				$image_src = wp_get_attachment_image( $image['image'], 'full', false, array( 'class' => 'img-responsive' ) );
				

				$banners .= '<div class="item center">';
					$banners .= $link['start'];
					$banners .= $image_src;
					$banners .= $link['end'];
				$banners .= '</div>';
			}

		$banners .= '</div>';
		$banners .= '</div>';


		echo '<div class="zn_shop_banner '.$this->data['uid'].' '.$style.'">';
			echo $main_image_src;

			// MAIN IMAGE
			echo '<div class="zn_shop_banner_inner">';
?>
			<div class="col-sm-9 right zn_sb_inner_content">
				<?php if (!empty($title)) { ?>
				<h2 class="shop-title"><?php echo $title; ?></h2>
				<?php } ?>
				<?php if (!empty($subTitle)) { ?>
				<h3 class="shop-title mbottom30"><?php echo $subTitle; ?></h3>
				<?php } ?>
				<?php if (!empty($description)) { ?>
					<div class="zn_description zn-secondary-color"><?php echo wpautop($description); ?></div>
				<?php } ?>
				<?php if (!empty($link_text) && is_array( $link )) {
					echo $link['start'] . $link_text . $link['end']; 
					}?>
			</div>

			<?php
				if ( $style == '' ||  $style == 'content_centered' ) { echo $banners; }
			?>		

			

		<?php
			echo '</div>';

			//if ( $style == 'content_c_b_d' ||  $style == 'all_bellow' ) { echo $banners; }

		echo '</div>';


		

	}

}

?>
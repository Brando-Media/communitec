<?php
/*
	Name: Image Gallery
	Description: This element will generate an icon box
	Class: ZnImageGallery
	Category: Content,Media,Fullwidth
	Level: 3
	Style: true
	
*/

class ZnImageGallery extends ZnElements {

	function options() {

		$options = array(
			array(
				'id'          => 'images',
				'name'        => 'Gallery images',
				'description' => 'Select the desired images for this gallery.',
				'type'        => 'gallery',
				'class'		  => 'zn_full'
			),
			array(
				'id'          => 'columns',
				'name'        => 'Columns',
				'description' => 'Select how many columns to use for this gallery',
				'type'        => 'select',
				'std'		  => 'col-sm-4',
				'options'	  => array( 'col-sm-12' => '1 Column', 'col-sm-6' => '2 Columns', 'col-sm-4' => '3 Columns', 'col-sm-3'=> '4 Columns' ),
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
		);

		return $options;

	}


	function element() {

		$columns = $this->opt('columns','col-sm-3');
		$images = $this->opt('images');
		$custom_img_size = $this->opt('custom_img_size') === 'yes' ? true : false;

		if ( empty( $title ) && empty( $images ) ) {
			echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
			return;
		}


		echo '<div class="zn_image_gallery '.$this->data['uid'].'">';

			if ($custom_img_size) {
				$img_width = $this->opt('img_width', 660);
				$img_height = $this->opt('img_height', 420);
			}
			else {
				$image_size = zn_get_wp_image_size( $columns, 1.6 );
				$img_width  = $image_size['width'];
				$img_height = $image_size['height'];
			}

			if (!empty($images)) { 

				$attachments = get_posts(array(
					'include' => $images,
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order' => 'ASC',
					'orderby' => 'post__in')
				);

				if(!empty($attachments) && is_array($attachments))
				{
					echo '<div class="zn_image_gallery_container">';
						echo '<div class="row">';
							foreach ($attachments as $attachment) {

								$image_src = zn_get_image( $attachment->ID , $img_width, $img_height, array('class' => 'img-responsive') );
								$image_url =  wp_get_attachment_image_src($attachment->ID, 'full');
								$caption = trim($attachment->post_excerpt) ? wptexturize($attachment->post_excerpt) : "";

								echo '<div class="'.$columns.'">';
									echo '<div class="gallery-overlay">';
										echo '<a href="'.esc_url( $image_url[0] ).'" class="zn-nivo-lightbox" title="'.esc_attr( $caption ).'" data-lightbox-gallery="zn_gallery_'.$this->data['uid'].'" >';
											echo $image_src;
										echo '</a>';
									echo '</div>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				}

			}

		echo '</div>';

	}

}

?>
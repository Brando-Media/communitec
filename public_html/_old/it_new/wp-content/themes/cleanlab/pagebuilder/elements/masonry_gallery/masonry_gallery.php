<?php
/*
	Name: Masonry Gallery
	Description: This element will generate an icon box
	Class: ZnMasonryGallery
	Category: Content,Media,Fullwidth
	Level: 3
	Style: true
	
*/

class ZnMasonryGallery extends ZnElements {

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
				'id'          => 'gap',
				'name'        => 'Images gap',
				'description' => 'Select the desired gap between images in pixels.',
				'type'        => 'slider',
				'std'		  => '0',
				'class'		  => 'zn_full',
				'helpers'	  => array(
					'min' => '0',
					'max' => '200',
					'step' => '1'
				)
			),
			array(
				'id'          => 'use_pagination',
				'name'        => 'Pagination',
				'description' => 'Select the pagination settings you want to use.',
				'type'        => 'select',
				'std'		  => 'use_pagination',
				'options'	  => array( 
					'pagination' => 'Use normal pagination', 
					// 'load_more' => 'Show load more button', 
					'no' => 'No pagination' ),
			),
			array(
				'id'          => 'per_page',
				'name'        => 'How many items to load per page ?',
				'description' => 'Select how many items you want to display on a page.',
				'type'        => 'slider',
				'std'		  => '10',
				'class'		  => 'zn_full',
				'helpers'	  => array(
					'min' => '1',
					'max' => '100',
					'step' => '1'
				),
			),
			// array(
			// 	'id'            => 'custom_img_size',
			// 	'name'          => 'Custom image size',
			// 	'description'   => 'Select if you want to enter a custom size for the images. If not, full size of each image will be used.',
			// 	'type'          => 'toggle2',
			// 	'std'           => '',
			// 	'value'         => 'yes'
			// ),
			// array(
			// 	'id'          => 'img_width',
			// 	'name'        => 'Image width',
			// 	'description' => 'Enter the desired image width.',
			// 	'type'        => 'slider',
			// 	'std'		  => '653',
			// 	'class'		  => 'zn_full',
			// 	'helpers'	  => array(
			// 		'min' => '10',
			// 		'max' => '1920',
			// 		'step' => '1'
			// 	),
			// 	'dependency'  => array( 'element' => 'custom_img_size' , 'value'=> array('yes') ),
			// ),
			// array(
			// 	'id'          => 'img_height',
			// 	'name'        => 'Image height',
			// 	'description' => 'Enter the desired image height.',
			// 	'type'        => 'slider',
			// 	'std'		  => '361',
			// 	'class'		  => 'zn_full',
			// 	'helpers'	  => array(
			// 		'min' => '10',
			// 		'max' => '1080',
			// 		'step' => '1'
			// 	),
			// 	'dependency'  => array( 'element' => 'custom_img_size' , 'value'=> array('yes') ),
			// ),
		);

		return $options;

	}


	function element() {

		$columns = $this->opt('columns','col-sm-3');
		$ids = $this->opt('images');
		//$custom_img_size = $this->opt('custom_img_size') === 'yes' ? true : false;

		if ( empty( $ids ) ) {
			echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
			return;
		}


		echo '<div class="zn_masonry_gallery '.$this->data['uid'].'">';

			if (!empty($ids)) { 

				$this->get_query_by_id( $ids );

				if(empty($this->query) || empty($this->query->posts)) {
					echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
					echo '</div>'; // CLOSE THE MAIN DIV
					return;
				}
				
				wp_enqueue_script( 'isotope' );

				echo '<div class="zn_masory_gallery_container">';
						foreach ($this->query->posts as $attachment) {
							setup_postdata( $attachment );

							$image_url =  wp_get_attachment_image_src( $attachment->ID, 'full' );
							$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true);
							$alt = !empty($alt) ? esc_attr($alt) : '';
							$title = esc_attr( get_the_title( $attachment->ID ) );
							$caption = trim($attachment->post_excerpt) ? wptexturize($attachment->post_excerpt) : "";
							$image_html = '<img src="'.esc_url( $image_url[0] ).'" title="'.esc_attr( get_the_title() ).'" alt="'.esc_attr( $alt ).'" />';


							echo '<div class="zn_masonry_entry '.$columns.'">';
								echo '<div class="gallery-overlay">';
									echo '<a href="'.esc_url( $image_url[0] ).'" class="zn-nivo-lightbox" title="'.esc_attr( $caption ).'" data-lightbox-gallery="zn_gallery_'.$this->data['uid'].'" >';
										echo $image_html;
									echo '</a>';
								echo '</div>';
							echo '</div>';
						}
				echo '</div>';
				
				if ( $this->opt('use_pagination', 'pagination') == 'pagination' ) {
					echo '<div class="center">';
						zn_pagination( array( 'pages' => $this->query->max_num_pages ) );
					echo '</div>';
				}
				elseif ( $this->opt('use_pagination') == 'load_more' ) {
					echo 'TO DO LOAD MORE';
				}


			}

		echo '</div>';

	}

	function get_query_by_id( $ids ){

		$ids = is_array($ids) ? $ids : array_filter(explode(',',$ids));
		$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
		if(!$page || $this->opt('use_pagination') == 'no') $page = 1;

		$args = array(
			'post__in' => $ids,
			'orderby' => 'post__in',
			'order' 	=> 'ASC',
			'paged' 	=> $page,
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'post_status' => 'inherit',
			'posts_per_page' => $this->opt('per_page', 10),
		);

		$this->query = new WP_Query($args);
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		//print_z($this);
		$uid = $this->data['uid'];
		$padding = $this->opt('gap') || $this->opt('gap') === '0' ? 'padding : '.$this->opt('gap').'px;' : '';
		$css = ".$uid .zn_masonry_entry, .$uid { $padding }";

		return $css;
	}

}

?>
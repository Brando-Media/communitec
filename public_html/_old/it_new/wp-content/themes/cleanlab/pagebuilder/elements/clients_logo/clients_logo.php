<?php
/*
	Name: Clients Logos
	Description: This element will generate an icon box
	Class: ZnClientsLogos
	Category: Content, Media
	Level: 3
	Style: true
	
*/

class ZnClientsLogos extends ZnElements {

	function options() {

		$options = array(
			array(
				'id'          => 'columns',
				'name'        => 'Columns',
				'description' => 'Here you can select the number of columns to use for the clients logos',
				'type'        => 'select',
				'std'        => '6',
				'options'	  => array(
						'1' => '1 Column',
						'2' => '2 Columns',
						'3' => '3 Columns',
						'4' => '4 Columns',
						'6' => '6 Columns'
				)
			),
			array(
				'id'          => 'logo_height',
				'name'        => 'Logo minimum height',
				'description' => 'Choose the desired minimum height for the logos. This will help you please all the logos evenly.',
				'type'        => 'slider',
				'std'		  => '100',
				'class'		  => 'zn_full',
				'helpers'	  => array(
					'min' => '0',
					'max' => '400',
					'step' => '1'
				)
			),
			array(
				'id'         	=> 'images',
				'name'       	=> 'Logo images',
				'description' 	=> 'Here you can add your images.',
				'type'        	=> 'group',
				'sortable'	  	=> true,
				'element_title' => 'Image',
				'subelements' 	=> array(
										array(
											'id'          => 'image',
											'name'        => 'Image',
											'description' => 'Select the image you want to use. Please note that in order to display the logos properly, your images should be equaly sized.',
											'type'        => 'media',
											'supports'    => 'id',
											'class'		  => 'zn_full'
										),
										array(
											'id'          => 'link',
											'name'        => 'Logo link',
											'description' => 'Enter a link for this logo',
											'type'        => 'link'
										),
									)
			)
		);

		return $options;

	}


	function element() {

		$columns = $this->opt('columns', 6 );
		$images = $this->opt('images') ? $this->opt('images') : false;

		$columns_class = 12/$columns;

		if ( empty( $images ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}

		?>
		<div class="zn_client_logos <?php echo $this->data['uid']; ?>">
			<div class="row">

			<?php
				foreach ($images as $image) {

					echo '<div class="col-sm-3 col-md-'.$columns_class.' col-lg-'.$columns_class.'">';

						if ( !empty( $image['image'] ) ) {
							$image_src = wp_get_attachment_image( $image['image'], 'full', false, array( 'class' => 'img-responsive' ) );
							$link_extracted = zn_extract_link( $image['link'] );

							echo '<div class="client_container zn-alternative-bkg">';
								echo $link_extracted['start'] . $image_src . $link_extracted['end'];
							echo '</div>';

						}

					echo '</div>';
				}

			?>


			</div>
		</div>
		<?php

	}

	function css(){
        $logo_height = $this->opt('logo_height', 100 );
        $uid = $this->data['uid'];

		$css = "
			.$uid .client_container { min-height:{$logo_height}px; line-height:{$logo_height}px; }
		";


		return $css;
	}


}

?>
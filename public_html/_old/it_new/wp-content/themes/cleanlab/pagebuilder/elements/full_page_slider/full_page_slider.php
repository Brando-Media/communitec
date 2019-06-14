<?php
/*
	Name: Full Page Slider
	Description: This element will generate a full screen slider
	Class: ZnFullPageSlider
	Category: Content, Fullwidth
	Level: 3
	Scripts: true
*/

class ZnFullPageSlider extends ZnElements {

	function options() {

		$options = array(
						//    array(
						//    'id'         	=> 'images',
						//    'name'       	=> 'Slider images',
						//    'description' 	=> 'Here you can add your images. Note that this element will cover the whole page. Therefore, you should add only this element into this page.',
						//    'type'        	=> 'group',
						//    'sortable'	  	=> true,
						//    'element_title' => 'Image',
						//    'subelements' 	=> array(
						//                            array(
						//                                'id'          => 'image',
						//                                'name'        => 'Image',
						//                                'description' => 'Select the image you want to use for this slide',
						//                                'type'        => 'media',
						//                                //'supports'    => 'id',
						//                                'class'		  => 'zn_full'
						//                            )
						//                    )

						//),
						
						array(
							'id'         	=> 'images',
							'name'       	=> 'Slider images',
							'description' 	=> 'Here you can add your images. Note that this element will cover the whole page. Therefore, you should add only this element into this page.',
							'type'        	=> 'gallery',
							'class'			=> 'zn_full'
						),
						
						//array(
						//    'id'            => 'auto_scroll',
						//    'name'          => 'Auto scroll',
						//    'description'   => 'Select if you want the slider to scroll automatically',
						//    'type'          => 'toggle2',
						//    'std'           => 'yes',
						//    'value'         => 'yes'
						//),
						//array(
						//    'id'          => 'timeout_duration',
						//    'name'        => 'Timeout duration',
						//    'description' => 'Enter the time interval between scrolls (in miliseconds).',
						//    'type'        => 'text',
						//    'std'		  => '5000',
						//    'dependency'  => array( 'element' => 'auto_scroll' , 'value'=> array('yes') ),
						//),
			);

		return $options;

	}

	//function element_edit() {

	//    echo '<div class="zn-pb-notification">This element will be rendered only on the final page and not in pagebuilder edit mode. It will cover the whole page except the menu. This should be the only element from this page.</div>';

	//}
	
	function element(){
		$images = $this->opt('images', false);
		//$autoPlay = $this->opt('auto_scroll') === 'yes' ? 'true' : 'false'; 
		//$timeout_duration = $this->opt('timeout_duration',1000);
		//** $autoPlay It's not yet used here. The autoplay feature is set directly in JavaScript function. 
        
		if ( empty( $images ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}

	?>

	<div class="zn_fullPage <?php echo $this->data['uid']; ?>">
	<?php
		$attachments = get_posts(array(
									'include' => $images,
									'post_status' => 'inherit',
									'post_type' => 'attachment',
									'post_mime_type' => 'image',
									'order' => 'ASC',
									'orderby' => 'post__in'
									)
									);
		foreach ( $attachments as $image ) {
			$image_src = wp_get_attachment_image_src($image->ID, 'full');
			echo '<div class="section" style="background-size:cover; background-image:url('.esc_url( $image_src[0] ).')"></div>';
		}
	?>
	</div>
	
		
	<?php
	}

	function element_edit(){
		if ( empty( $images ) ) {
			echo '<div class="zn-pb-notification">This element will appear in view page mode only.</div>';
			return;
		}

	}


	function scripts() {
	    wp_enqueue_script( 'zn_fullPage', THEME_BASE_URI .'/pagebuilder/elements/full_page_slider/assets/js/jquery.fullPage.min.js', array('jquery'), ZN_FW_VERSION, true );
	}
	
}


?>
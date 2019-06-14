<?php
/*
	Name: Image Carousel
	Description: This element will generate an image carousel
	Class: ZnImageCarousel
	Category: Content, Media
	Level: 3
	Scripts: true
	Styles: true
*/

class ZnImageCarousel extends ZnElements {

	function options() {

		$options = array(
						//array(
						//    'id'         	=> 'images',
						//    'name'       	=> 'Slider images',
						//    'description' 	=> 'Here you can add your images.',
						//    'type'        	=> 'group',
						//    'sortable'	  	=> true,
						//    'element_title' => 'Image',
						//    'subelements' 	=> array(
						//                            array(
						//                                'id'          => 'image',
						//                                'name'        => 'Image',
						//                                'description' => 'Select the image you want to use for this slide',
						//                                'type'        => 'media',
						//                                'supports'    => 'id',
						//                                'class'		  => 'zn_full'
						//                            )
						//                    )

						//),
						array(
							'id'          => 'images',
							'name'        => 'Carousel images',
							'description' => 'Select the desired images for this carousel.',
							'type'        => 'gallery',
							'class'		  => 'zn_full'
						),
                        array(
                            'id'            => 'auto_scroll',
                            'name'          => 'Auto scroll',
                            'description'   => 'Select if you want the carousel to scroll automatically',
                            'type'          => 'toggle2',
                            'std'           => 'yes',
                            'value'         => 'yes'
                        )
			);

		return $options;

	}

	function element(){
		$images = $this->opt('images');;
        $autoPlay = $this->opt('auto_scroll') === 'yes' ? 'true' : 'false'; 
		//** $autoPlay It's not yet used here. The autoplay feature is set directly in JavaScript function. 
        
		if ( empty( $images ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}

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
		
	?>

	    <div class="carousel-container <?php echo $this->data['uid']; ?>">
			<div id="icarousel<?php echo $this->data['uid']; ?>" class="icarousel" data-autoplay="<?php echo $autoPlay; ?>">
			<?php
					foreach ($attachments as $attachment) {
						$image_src = wp_get_attachment_image( $attachment->ID, 'full', false, array( 'class' => 'img-responsive' ) );
						//** Am scos lightbox-ul pt ca nu aducea niciun beneficiu in plus (in afara de caption pe title :P)
						//$image_url =  wp_get_attachment_image_src($attachment->ID, 'full');
						//$caption = trim($attachment->post_excerpt) ? wptexturize($attachment->post_excerpt) : "";
								

						echo '<div class="slide2">';
							//echo '<a href="'.$image_url[0].'" class="zn-nivo-lightbox" title="'.$caption.'" data-lightbox-gallery="zn_gallery_'.$this->data['uid'].'" >';
								echo $image_src;
							//echo '</a>';
						echo '</div>';
					}
				?>
			</div>
		</div>
		
	<?php
		}
	}

	function scripts() {
		wp_enqueue_script( 'zn_raphael', THEME_BASE_URI .'/pagebuilder/elements/image_carousel/assets/js/raphael-min.js', array('jquery'), ZN_FW_VERSION, true );
		wp_enqueue_script( 'zn_jquery_mousewheel', THEME_BASE_URI .'/pagebuilder/elements/image_carousel/assets/js/jquery.mousewheel.js', array('jquery'), ZN_FW_VERSION, true );
		wp_enqueue_script( 'zn_jquery_easing_1_3.js', THEME_BASE_URI .'/pagebuilder/elements/image_carousel/assets/js/jquery.easing.1.3.js', array('jquery'), ZN_FW_VERSION, true );
		wp_enqueue_script( 'zn_icarousel', THEME_BASE_URI .'/pagebuilder/elements/image_carousel/assets/js/icarousel.packed.js', array('jquery'), ZN_FW_VERSION, true );
	}
	
	function js() {
			$uid = $this->data['uid'];
			$autoPlay = $this->opt('auto_scroll') === 'yes' ? 'true' : 'false';
			$zn_my_carousel_js = array("icarousel".$uid =>"
					$(document).ready(function(){
						if ($('#icarousel$uid').length > 0) {
							$('#icarousel$uid').iCarousel({autoPlay: $autoPlay});
						}
					});");			

		return $zn_my_carousel_js;
	}
	
}


?>
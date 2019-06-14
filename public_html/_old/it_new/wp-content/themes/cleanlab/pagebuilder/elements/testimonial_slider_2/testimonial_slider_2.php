<?php
/*
Name: Testimonial Slider 2
Description: This element will generate a testimonial slider
Class: ZnTestimonialSlider2
Category: content
Level: 3
 */

class ZnTestimonialSlider2 extends ZnElements {

	function options() {

		$options = array(
				'has_tabs'  => true,
				'general' => array(
					'title' => 'General options',
					'options' => array(
						array(
							'id'          => 'title',
							'name'        => 'Title',
							'description' => 'Enter a title for this element.',
							'type'        => 'text',
						),
						array(
						'id'            => 'testimonials',
						'name'          => 'Testimonials',
						'description'   => 'Using this options you can create unlimited testimonials',
						'type'          => 'group',
						'sortable'      => true,
						'element_title' => 'testimonial',
						'subelements'   => array(
												array(
													'id'          => 'testimonial',
													'name'        => 'Testimonial',
													'description' => 'Enter the testimonial text',
													'type'        => 'textarea'
												),
												array(
													'id'          => 'author_image',
													'name'        => 'Author image',
													'description' => 'Select an image for this testimonial.',
													'type'        => 'media',
													'class'       => 'zn_full',
													'supports'    => 'id'
												),
												array(
													'id'          => 'author',
													'name'        => 'Author',
													'description' => 'Enter the testimonial author.',
													'type'        => 'text',
												),
												array(
													'id'          => 'position',
													'name'        => 'Description',
													'description' => 'Enter a description for the author.',
													'type'        => 'text',
												)
										)

					),
					),
				),
				'styling' => array(
					'title' => 'Styling options',
					'options' => array(
						array(
							'id'          => 'style',
							'name'        => 'Style',
							'description' => 'Choose the style of the elements',
							'type'        => 'select',
							'std'         => '',
							'options'     => array( '' => 'Style 1', 'style2' => 'Style 2', 'style3' => 'Style 3', 'style4' => 'Style 4', 'style5' => 'Style 5'),
						),
						array(
							'id'          => 'alignment',
							'name'        => 'Alignment',
							'description' => 'Select the horizontal alignment.',
							'type'        => 'select',
							'std'         => 'center',
							'options'        => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
							'live' => array(
								'type'      => 'class',
								'css_class' => '.'.$this->data['uid'] //.' > div:first-child'
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
							'id'            => 'author_image_circle',
							'name'          => 'Show author image as circle ?',
							'description'   => 'Select if you want to show the author image as a circle',
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
							'std'           => 'sideNav hollowNav style2',
							'options'	    => zn_get_navigation_styles(),
							'dependency'  => array( 'element' => 'show_navigation' , 'value'=> array('yes') ),
							'live' => array(
									'type'		=> 'class',
									'css_class' => '.'.$this->data['uid'].' .zn_owl_carousel'
							)
						),
					),
				),
				'misc' => array(
					'title' => 'Misc options',
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
							'std'         => '5000',
							'dependency'  => array( 'element' => 'auto_scroll' , 'value'=> array('yes') ),
						),
					),
				),
			);

		return $options;

	}

	function element(){
		$style = $this->opt('style','');
		$alignment = $this->opt('alignment','center');
		$title = $this->opt('title','');
		$testimonials = ( $this->opt('testimonials') ) ? $this->opt('testimonials') : array();
		//$testimonial_style = $this->opt('testimonial_style','zn_t_style1');
		$autoScroll = $this->opt('auto_scroll') === 'yes' ? $this->opt('timeout_duration',5000) : 'false';
		$autoScroll = esc_attr( $autoScroll );
		$show_bullets = $this->opt('show_bullets') === 'yes' ? 'true' : 'false';
		$show_navigation = $this->opt('show_navigation') === 'yes' ? 'true' : 'false';
		$navStyle = $this->opt('nav_style','sideNav hollowNav');
		$circle_author_image = $this->opt('author_image_circle') === 'yes' ? 'zn_circle_image' : '';
		//$elemStyle = $this->opt('carousel_style') ? $this->opt('carousel_style') : '';
		//$testStyle = $this->opt('testimonial_style') ? $this->opt('testimonial_style') : '';
		$uid = $this->data['uid'];
		
		if ( empty($testimonials) ) {
			echo '<div  class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}

		echo "<div class='testimonials3-carousel $style $alignment $uid'>";
		//if (!empty($title)) {
			echo "<h2 class='zn_title $style'>$title</h2>";
		//}
		echo "<div class='zn_owl_carousel owl-carousel owl-theme $navStyle ' data-auto='$autoScroll' data-pagination='$show_bullets' data-navigation='$show_navigation'>"; 
		foreach($testimonials as $testimonial)
		{
			echo '<div class="item">';
			echo '  <blockquote class="zn-secondary-color">'.$testimonial['testimonial'].'</blockquote>';
			if ( $testimonial['author_image'] ) {
				//$resizedImg = mr_image_resize($testimonial['author_image'], 100, 100, true, 'c', false);
				//echo '<img alt="Author" src="'.$resizedImg['url'].'" />';
				echo zn_get_image($testimonial['author_image'], 100, 100, array('class' => "img-responsive $circle_author_image"));
			}
			if ( $testimonial['author'] ) {
				echo '<h4 class="zn-secondary-color">'.$testimonial['author'].'</h4>';
			}
			if ( $testimonial['position'] ) {
				echo '<p class="position">'.$testimonial['position'].'</p>';
			}
			echo '</div>';
		}
		echo '</div>';
		echo '</div>';
	}

	function css(){
		$uid = $this->data['uid'];
		$style = $this->opt('style','');
		$alignment = $this->opt('alignment','center');
		$show_navigation = $this->opt('show_navigation') === 'yes' ? true : false;
		$css = "";
		
		if ($show_navigation && $alignment === 'right' && ($style === 'style3' || $style === 'style4' || $style === 'style5')) {
			$css .= ".$uid.testimonials3-carousel.right .zn_title { padding-right: 115px; }";
		}

		return $css;
	}
	
}


?>
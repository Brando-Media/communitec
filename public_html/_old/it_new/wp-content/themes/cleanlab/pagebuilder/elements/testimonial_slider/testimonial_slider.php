<?php
/*
Name: Testimonial Slider 1
Description: This element will generate a testimonial slider
Class: ZnTestimonialSlider
Category: content
Level: 3
 */

class ZnTestimonialSlider extends ZnElements {

    function options() {

        $options = array(
				'has_tabs'  => true,
				'general' => array(
                    'title' => 'General options',
                    'options' =>  array(
					array(
                        'id'         	=> 'testimonials',
                        'name'       	=> 'Testimonials',
                        'description' 	=> 'Using this options you can create unlimited testimonials',
                        'type'        	=> 'group',
                        'sortable'	  	=> true,
                        'element_title' => 'testimonial',
                        'subelements' 	=> array(
                                                array(
                                                    'id'          => 'testimonial',
                                                    'name'        => 'Testimonial',
                                                    'description' => 'Enter the testimonial text',
                                                    'type'        => 'textarea'
                                                ),
                                                array(
                                                    'id'          => 'author',
                                                    'name'        => 'Author',
                                                    'description' => 'Enter the testimonial author.',
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
						'id'          => 'testimonial_style',
						'name'        => 'Style',
						'description' => 'Choose the style of the elements',
						'type'        => 'select',
						'std'		  => 'zn_t_style1',
						'options'     => array( 'zn_t_style1' => 'Style 1',
						                        'zn_t_style2' => 'Style 2'),
						 'live' => array(
						    'type'		=> 'class',
						    'css_class' => '.'.$this->data['uid']
						    )
						),
					array(
                        'id'            => 'show_bullets',
                        'name'          => 'Show bullets',
                        'description'   => 'Select if you want to show the navigation bullets',
                        'type'          => 'toggle2',
                        'std'           => 'yes',
                        'value'         => 'yes'
                    ),
					array(
                        'id'            => 'show_navigation',
                        'name'          => 'Show navigation',
                        'description'   => 'Select if you want to show the navigation arrows',
                        'type'          => 'toggle2',
                        'std'           => '',
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
									'css_class' => '.'.$this->data['uid'].'.zn_owl_carousel'
							)
						),
					),
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
                        'description' => 'Enter the time interval between scrolls (in millseconds).',
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
        $testimonials = ( $this->opt('testimonials') ) ? $this->opt('testimonials') : array();
		$testimonial_style = $this->opt('testimonial_style','zn_t_style1');
        $autoScroll = $this->opt('auto_scroll') === 'yes' ? $this->opt('timeout_duration',5000) : 'false';
		$show_bullets = $this->opt('show_bullets') === 'yes' ? 'true' : 'false';
		$show_navigation = $this->opt('show_navigation') === 'yes' ? 'true' : 'false';
		$navStyle = $this->opt('nav_style','sideNav hollowNav style2');
		
		//$elemStyle = $this->opt('carousel_style') ? $this->opt('carousel_style') : '';
		//$testStyle = $this->opt('testimonial_style') ? $this->opt('testimonial_style') : '';
		
        if ( empty($testimonials) ) {
            echo '<div  class="zn-pb-notification">Please configure the element options.</div>';
			return;
        }

        echo '<div class="zn_owl_carousel testimonials-carousel owl-carousel owl-theme '.$navStyle.' '.$testimonial_style.' '.$this->data['uid'].'" data-auto="'.esc_attr( $autoScroll ).'" data-pagination="'.$show_bullets.'"  data-navigation="'.$show_navigation.'">'; 
        foreach($testimonials as $testimonial)
        {
            echo '<div class="item">';
			echo '  <blockquote>'.$testimonial['testimonial'].'</blockquote>';
			echo '  <p>'.$testimonial['author'].'</p>';
            echo '</div>';
        }
        echo '</div>';
    }

}


?>
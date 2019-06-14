<?php
/*
Name: Testimonials List
Description: This element will generate a list of testimonials
Class: ZnTestimonialsList
Category: content
Level: 3
Scripts: true
 */

class ZnTestimonialsList extends ZnElements {

    function options() {

        $options = array(
				//'has_tabs'  => true,
				//'general' => array(
				//    'title' => 'General options',
				//    'options' =>  array(
					array(
                        'id'         	=> 'testimonials',
                        'name'       	=> 'Testimonials',
                        'description' 	=> 'Using this options you can create unlimited testimonials',
                        'type'        	=> 'group',
                        'sortable'	  	=> true,
                        'element_title' => 'testimonial',
                        'subelements' 	=> array(
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
                                                ),
												array(
                                                    'id'          => 'testimonial',
                                                    'name'        => 'Testimonial',
                                                    'description' => 'Enter the testimonial text',
                                                    'type'        => 'textarea'
                                                ),
                                        )

                    ),
				//    ),
				//),
				//'styling' => array(
				//    'title' => 'Styling options',
				//    'options' => array(
				//    array(
				//        'id'          => 'style',
				//        'name'        => 'Style',
				//        'description' => 'Choose the style of the elements',
				//        'type'        => 'select',
				//        'std'		  => 'zn_t_style1',
				//        'options'     => array( 'zn_t_style1' => 'Style 1',
				//                                'zn_t_style2' => 'Style 2'),
				//         'live' => array(
				//            'type'		=> 'class',
				//            'css_class' => '.'.$this->data['uid']
				//            )
				//        ),
					
				//    ),
				//),
			);
				
        return $options;

    }

	function scripts() {
		wp_enqueue_script( 'isotope' );
	}
	
    function element(){
        $testimonials = ( $this->opt('testimonials') ) ? $this->opt('testimonials') : array();
		$style = $this->opt('style','');
		
        if ( empty($testimonials) ) {
            echo '<div  class="zn-pb-notification">Please configure the element options.</div>';
			return;
        }
		?>
        <div class="zn_testimonials_list <?php echo $style.' '.$this->data['uid'] ?>" >
		
		<?php 
        foreach($testimonials as $testimonial)
        {
		?>
			<div class="item">
				<div class="testimonial">
					<?php
					if (!empty($testimonial['author_image'])) {
						echo zn_get_image($testimonial['author_image'], 50, 50, array('class' => "img-responsive"));
					}
					else {
						echo '<img src="'.THEME_BASE_URI .'/pagebuilder/elements/testimonials_list/assets/img/no-img.png" alt="" />';
					}
					?>
					
					<h3><?php echo $testimonial['author'];?></h3>
					<p class="zn-primary-color mbottom20"><?php echo $testimonial['position'];?></p>
					<div class="gray"><?php echo $testimonial['testimonial'];?></div>
				</div>
			</div>
		<?php	
        }
		?>
        </div>
		<?php
    }

}


?>
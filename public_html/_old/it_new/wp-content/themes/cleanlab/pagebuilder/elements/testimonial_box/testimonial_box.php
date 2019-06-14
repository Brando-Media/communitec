<?php
/*
	Name: Testimonial Box
	Description: This element will generate a testimonial box
	Class: ZnTestimonial
	Category: content
	Level: 3
	Style: true
	
*/

class ZnTestimonial extends ZnElements {

	function options() {
		global $zn_framework;
		$options = array(	
					array(
                        'id'          => 'avatar',
						'name'        => 'Image',
						'description' => 'Please select an image for this box',
						'supports'    => 'id',
						'type'        => 'media',
                        'class'       => 'zn_full'
						),
					array(
						'id'          => 'testimonial',
						'name'        => 'Testimonial',
						'description' => 'Enter the testimonial',
						'type'        => 'textarea'
					),
					array(
						'id'          => 'author',
						'name'        => 'Author',
						'description' => 'Enter the name of the author',
						'type'        => 'text',
					),
					array(
						'id'          => 'position',
						'name'        => 'Position',
						'description' => 'Enter the position of the author',
						'type'        => 'text'
					)
			);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		
		$avatar = $this->opt('avatar', false);
        $testimonial = $this->opt('testimonial') ? $this->opt('testimonial') : '';
        $author = $this->opt('author') ? $this->opt('author') : '';
        $position = $this->opt('position') ? $this->opt('position') : '';
		

		if ( empty($testimonial) || !$avatar || empty( $author )) { // || empty($position) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}

		?>


			<div class="zn-testimonial-box <?php echo $this->data['uid']; ?>">
				<div class="feedback-box zn-alternative-bkg">
					<?php  if ($avatar)  { 
						echo zn_get_image( $avatar , 100, 100, array('class' => 'img-responsive' ) ); 
					} ?>
					<span class="icon-quotes-right2 zn-primary-color"></span>
					<blockquote class="zn-secondary-color"> <?php echo $testimonial; ?></blockquote>
				</div>
				<h5 class="mtop20 zn-secondary-color"><?php echo $author; ?></h5>
				<p><?php echo $position; ?></p>
			</div>
		<?php
	}

}

?>
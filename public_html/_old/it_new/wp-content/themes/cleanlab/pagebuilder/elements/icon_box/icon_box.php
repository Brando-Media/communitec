<?php
/*
	Name: Icon Box 1
	Description: This element will generate an icon box
	Class: ZnServiceBox
	Category: content
	Level: 3
	Style: true
	
*/

class ZnServiceBox extends ZnElements {

	function options() {
		global $zn_framework;
		$options = array(
				'has_tabs'  => true,
                'general' => array(
                    'title' => 'General options',
                    'options' => array(
						array(
							'id'          => 'title',
							'name'        => 'Title',
							'description' => 'Please enter your desired title',
							'type'        => 'text'
						),
						array(
							'id'          => 'desc',
							'name'        => 'Description',
							'description' => 'Please enter your desired description',
							'type'        => 'visual_editor',
							'std' => '',
							'class'		  => 'zn_full'
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
							'description' => 'Enter a text for this element',
							'type'        => 'text'
						),
					)
					),
				'styling' => array(
                    'title' => 'Styling options',
                    'options' => array(
						array(
							'id'          => 'style',
							'name'        => 'Style',
							'description' => 'Select a style for this element',
							'type'        => 'select',
							'options'	  => array( 'style1'=>'Style 1' , 'style2' => 'Style 2', 'style3' => 'Style 3', 'style4' => 'Style 4', 
													'style5' => 'Style 5 (animated)', 'style6' => 'Style 6', 'style7' => 'Style 7', 'style8' => 'Style 8',
													'style9' => 'Style 9', 'style10' => 'Style 10', 'style11' => 'Style 11 (animated)' ),
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid']
							)
						),
						array(
							'id'          => 'button_style',
							'name'        => 'Button style',
							'description' => 'Select the style for the button.',
							'type'        => 'select',
							'std'		  => 'zn_btn_simple',
							'options'	=> zn_get_button_styles(),
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid'] .'>.btn'
							)
						),
						//array(
						//    'id'          => 'icon',
						//    'name'        => 'Icon',
						//    'description' => 'Please select your desired icon',
						//    'type'        => 'icon_list',
						//    'std'		  => '',
						//    'class' 	  => 'zn_full'
						//),
					)
					),
				'icon' => array(
                    'title' => 'Icon',
                    'options' => array(
						array(
							'id'          => 'icon',
							'name'        => '',
							'description' => '',
							'type'        => 'icon_list',
							'std'		  => '',
							'class' 	  => 'zn_full'
						),
					))
				);


		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		global $zn_framework;
		
		$style = $this->opt('style')  ? $this->opt('style') : '';
		$iconHolder = $this->opt('icon');
		$icon = !empty( $iconHolder['family'] )  ? '<span '.zn_generate_icon( $this->opt('icon') ).'></span>' : '';
		$title = $this->opt('title')  ? $this->opt('title') : '';
		$desc = $this->opt('desc')  ? $this->opt('desc') : '';
		//$desc = $this->opt('desc')  ? $this->opt('desc') : '';
		$button_style = $this->opt('button_style','zn_btn_simple');
		$link_extracted = $this->opt('link') ? zn_extract_link( $this->opt('link') , 'btn '.$button_style ) : '';
		$link_text      = $this->opt('link_text') ? $this->opt('link_text') : '';

		if ( empty($desc) && empty( $title ) && empty( $icon ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}

		?>


			<div class="services-box clearfix <?php echo $style.' '.$this->data['uid']; ?>">
				<?php 
					echo $icon; 
					if (!empty($title)) {
						echo '<h3>'.$title.'</h3>';
					}
					echo wpautop($desc); 
					if (!empty($link_extracted)) {
						echo $link_extracted['start'] . $link_text . $link_extracted['end'];
					}
				?>
			</div>
		<?php
	}

}

?>
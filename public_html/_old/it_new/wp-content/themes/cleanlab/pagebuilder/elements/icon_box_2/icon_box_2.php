<?php
/*
	Name: Icon Box 2
	Description: This element will generate an icon box
	Class: ZnIconBox2
	Category: content
	Level: 3
	Style: true
	
*/

class ZnIconBox2 extends ZnElements {

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
							'options'	  => array( 'style1'=>'Style 1' , 'style2' => 'Style 2', 'style3' => 'Style 3', 'style4' => 'Style 4', 'style5' => 'Style 5'),
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid']
							)
						),
						array(
							'id'          => 'bg_style',
							'name'        => 'Background color',
							'description' => 'Select the desired background color.',
							'type'        => 'select',
							'options'	  => array( 'zn-alternative-bkg'=>'Alternative background color' , 'zn-background-color' => 'Section background color'),
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
							'options'	  => zn_get_button_styles(),
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid'] .'>.btn'
							)
						),
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
					)
				),
			);

		return $options;

	}


	function element() {
		global $zn_framework;
		
		$style = $this->opt('style')  ? $this->opt('style') : '';
		$bg_style = $this->opt('bg_style')  ? $this->opt('bg_style') : 'zn-alternative-bkg';
		$iconHolder = $this->opt('icon');
		$icon = !empty( $iconHolder['family'] )  ? '<span class="ibox-icon zn-primary-color" '.zn_generate_icon( $this->opt('icon') ).'></span>' : '';
		$title = $this->opt('title')  ? $this->opt('title') : '';
		$desc = $this->opt('desc')  ? $this->opt('desc'): '';
		$button_style = $this->opt('button_style','zn_btn_simple');
		$link_extracted = $this->opt('link') ? zn_extract_link( $this->opt('link') , 'btn '.$button_style ) : '';
		$link_text      = $this->opt('link_text') ? $this->opt('link_text') : '';

		if ( empty($desc) && empty( $title ) && empty( $icon ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}

		?>
			<div class="ibox2 clearfix center <?php echo $style.' '.$bg_style.' '.$this->data['uid']; ?>">
				<?php 
					if (!empty($title)) {
						echo '<h3 class="ibox-title zn-secondary-color">'.$title.'</h3>';
					}
					echo $icon; 
					echo '<div class="ibox-desc zn-paragraph-color">'.wpautop($desc).'</div>'; 
					if (!empty($link_extracted)) {
						echo $link_extracted['start'] . $link_text . $link_extracted['end'];
					}
				?>
			</div>
		<?php
	}

}

?>
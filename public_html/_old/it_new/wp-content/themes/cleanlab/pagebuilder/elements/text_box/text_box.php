<?php
/*
	Name: Text Box
	Description: This element will generate a text box with a title, subtitle and description
	Class: ZnTextBox
	Category: content
	Level: 3
	Style: true
	
*/

class ZnTextBox extends ZnElements {

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
							'description' => 'Please enter a title for this element',
							'type'        => 'text',
							'std'		=> '',
							// 'live' => array(
							//     'type'		=> 'html',
							//     'css_class' => '.'.$this->data['uid'],
							//     'wrap'		=> '<span class="zn-primary-color zn_title">%s</span>',
							//     'html_data'	=> array( 'method' => 'append', 'selector' => '.'.$this->data['uid'] )
							// )
						),
						//array(
						//    'id'          => 'subtitle',
						//    'name'        => 'Subtitle',
						//    'description' => 'Please enter a subtitle for this element',
						//    'type'        => 'text',
						//    'std'		=> ''
						//),
						array(
							'id'          => 'desc',
							'name'        => 'Description',
							'description' => 'Please enter a description for this element',
							'type'        => 'visual_editor',
							'class'		=> 'zn_full',
							'std'		=> ''
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
							'description' => 'Enter a text for this element\'s button',
							'type'        => 'text',
							'std'		=> ''
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
							'options'	  => array( ''=>'Style 1' , 'style2' => 'Style 2', 'style3' => 'Style 3', 'style4' => 'Style 4', 'style5' => 'Style 5'),
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid']
							)
						),
						array(
							'id'          => 'alignment',
							'name'        => 'Alignment',
							'description' => 'Select the horizontal alignment.',
							'type'        => 'select',
							'std'		  => 'left',
							'options'        => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid'] //.' > div:first-child'
							)
						),
						array(
							'id'          => 'button_style',
							'name'        => 'Button style',
							'description' => 'Select a style for this button',
							'type'        => 'select',
							'std'		=> 'btn-default',
							'options'	=> zn_get_button_styles(),
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid'] .' .btn'
							)
						),
					
					)
				),
			);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		$title = $this->opt('title','');
		//$subTitle = $this->opt('subtitle')  ? $this->opt('subtitle') : '';
		$desc = $this->opt('desc', '');
		$alignment = $this->opt('alignment', '');
		$style = $this->opt('style', '');
		$link_text = $this->opt('link_text', '');
		$button_style = $this->opt('button_style','btn-default');
		$link = zn_extract_link( $this->opt('link') , 'btn '.$button_style );
		
		
		if ( empty( $title ) && empty($subTitle) && empty($desc) && empty($link_text)) {
			echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
			return;
		}
		
		
		
		
		?>
		
		<div class="zn_textbox <?php echo $alignment.' '.$style.' '.$this->data['uid']; ?>">
			<?php if (!empty($title)) { ?>
				<h2 class="section-title zn_subtitle"><?php echo $title; ?></h2>
			<?php } ?>
			<?php if (!empty($desc)) { ?>
				<div class="zn_description"><?php echo wpautop($desc); ?></div>
			<?php } 
			echo $link['start'] . $link_text . $link['end']; 
			?>
		</div>

		<?php
	}

}

?>
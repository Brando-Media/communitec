<?php
/*
	Name: Timeline
	Description: This element will generate an icon box
	Class: ZnTimelineBox
	Category: content
	Level: 3
	Style: true
	
*/

class ZnTimelineBox extends ZnElements {

	function options() {

		$options = array(
			array(
				'id'          => 'boxes',
				'name'        => 'Timeline boxes',
				'description' => 'Using this options you can add your timeline boxes',
				'type'        => 'group',
				'element_title' => 'title',
				'subelements' 	=> array(
					array(
						'id'          => 'date',
						'name'        => 'Date',
						'description' => 'Please enter your desired date',
						'type'        => 'text'
					),
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
					array(
						'id'          => 'button_style',
						'name'        => 'Button style',
						'description' => 'Select the style for the button.',
						'type'        => 'select',
						'std'		  => 'zn_btn_simple',
						'options'	  => zn_get_button_styles()
					),
					array(
						'id'          => 'iconbg',
						'name'        => 'Icon background color',
						'description' => 'Please select your desired background color for the icon',
						'type'        => 'colorpicker',
						'std'		  => '#75ce66'
					),
					array(
						'id'          => 'icon',
						'name'        => 'Icon',
						'description' => 'Please select your desired icon',
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

		$boxes = $this->opt('boxes');
		$args = array();
		$i = 0;

		if ( empty( $boxes ) ) {
			echo '<div class="zn-pb-notification">Please configure the element and add at least timeline box.</div>';
			return;
		}

		?>
		<div class="zn_timeline_container <?php echo $this->data['uid']; ?>">

		<?php
			foreach ($boxes as $box) {

				$icon = (!empty( $box['icon'] ) && !empty( $box['icon']['family'] ) )  ? '<div class="zn-timeline-img zn-picture"><span class="zn-timeline-icon zn-alternative-color" '.zn_generate_icon( $box['icon'] ).'></span></div>' : '';
				$link_extracted = $box['link'] ? zn_extract_link( $box['link'] , 'btn '.$box['button_style'] ) : '';
				$link_text      = $box['link_text'] ? $box['link_text'] : '';
				

				echo '<div class="zn-timeline-block clearfix timeline_box_'.$i.'">';
					echo $icon;

					echo '<div class="zn-timeline-content zn-alternative-bkg clearfix">';
						echo '<h3>'.$box['title'].'</h3>'; // Title
						echo '<div>'.wpautop( $box['desc'] ).'</div>'; // Description

						// Link
						if (!empty($link_extracted)) {
							echo $link_extracted['start'] . $link_text . $link_extracted['end'];
						}

						// DATE
						if ( !empty( $box['date'] ) ) {
							echo '<span class="zn-date">'.$box['date'].'</span>';
						}
						
					echo '</div>';
				echo '</div>';

				$i++;
			}
		?>
		</div>
		<?php

	}

	function css(){
		$css = '';
		$uid = $this->data['uid'];
		$boxes = $this->opt('boxes');
		$i = 0;

		if ( empty( $boxes ) ) {
			return;
		}

		foreach ($boxes as $box) {
			if( !empty( $box['iconbg'] ) ) {
				$bg_color = $box['iconbg'];
				$css .= ".$uid .timeline_box_$i .zn-timeline-img { background: $bg_color; }";
			}

			$i++;
		}

		return $css;
	}


}

?>
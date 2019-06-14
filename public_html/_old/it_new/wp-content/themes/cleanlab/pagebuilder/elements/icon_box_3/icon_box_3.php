<?php
/*
	Name: Icon Box 3
	Description: This element will generate an icon box
	Class: ZnIconBox3
	Category: content
	Level: 3
	Style: true
	
*/

class ZnIconBox3 extends ZnElements {

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
							'description' => 'Please enter a text for this element',
							'type'        => 'visual_editor',
							'std' => '',
							'class'		  => 'zn_full'
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
						'options'	  => array( 'style1'=>'Style 1' , 'style2' => 'Style 2'),
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
		$title = $this->opt('title','');
		$desc = wpautop($this->opt('desc', ''));
		$cls  = ( $style == 'style2' ) ? 'tcolor' : 'zn-paragraph-color';
		$iconHolder = $this->opt('icon');
		$icon = !empty( $iconHolder['family'] )  ? '<span class="ibox-icon '.$cls.'" '.zn_generate_icon( $this->opt('icon') ).'></span>' : '';
		
		
		if ( empty($title) && empty($desc) && empty( $icon ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}
		?>

			<div class="ibox3 clearfix <?php echo $this->data['uid'] .' '.$style; ?>">
				<?php 
					echo $icon;
					echo "<div class='ibox-title zn-secondary-color'>".$title."</div>";
					echo "<div class='ibox-desc'>".wpautop($desc)."</div>"; 
				?>
			</div>
		<?php
	}

}

?>
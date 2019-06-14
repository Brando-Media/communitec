<?php
/*
	Name: Icon Box 4
	Description: This element will generate an icon box
	Class: ZnIconBox4
	Category: content
	Level: 3
	Style: true
	
*/

class ZnIconBox4 extends ZnElements {

	function options() {
		global $zn_framework;
		$options = array(
				'has_tabs'  => true,
                'general' => array(
                    'title' => 'General options',
                    'options' => array(
						array(
						'id'          => 'line1text',
						'name'        => 'Line 1 text',
						'description' => 'Please enter your desired text that will appear on the first line',
						'type'        => 'text'
					),	
					array(
						'id'          => 'line2text',
						'name'        => 'Line 2 text',
						'description' => 'Please enter your desired text that will appear on the second line',
						'type'        => 'text'
					),
					)
				),
				//'styling' => array(
				//    'title' => 'Styling options',
				//    'options' => array(
						
				//    )
				//),
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
		
		//$style = $this->opt('style')  ? $this->opt('style') : '';
		$line1text = $this->opt('line1text','');
		$line2text = $this->opt('line2text','');
		$iconHolder = $this->opt('icon');
		$icon = !empty( $iconHolder['family'] )  ? '<span class="ibox-icon zn-secondary-color" '.zn_generate_icon( $this->opt('icon') ).'></span>' : '';
		
		
		if ( empty($title) && empty($desc) && empty( $icon ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}

		?>

			<div class="shop-banner">
				<?php echo $icon; ?>
				<h3 class="tcolor"><?php echo $line1text; ?></h3>
				<h3><?php echo $line2text; ?></h3>
			</div>

		<?php
	}

}

?>
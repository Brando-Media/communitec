<?php
/*
	Name: Raw HTML
	Description: This element will generate a text box with a title, subtitle and description
	Class: ZnRawHtml
	Category: content
	Level: 3
	Style: true
	
*/

class ZnRawHtml extends ZnElements {

	function options() {
		global $zn_framework;
		$options = array(
				array(
					'id'          => 'html',
					'name'        => 'HTML code',
					'description' => 'Here you can add your desired HTML code',
					'type'        => 'textarea',
					'class'		=> 'zn_full',
					'std'		=> ''
				),
		);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		$html = $this->opt('html', '');

		if ( empty( $html ) ) {
			echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
			return;
		}
		?>
		
		<div class="zn_raw_html <?php echo $this->data['uid']; ?>">
			<?php echo $html; ?>
		</div>

		<?php
	}

}

?>
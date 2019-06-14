<?php
/*
	Name: News Bar
	Description: This element will generate a news bar
	Class: ZnNewsBar
	Category: content
	Level: 3
	Style: true
	
*/

class ZnNewsBar extends ZnElements {

	function options() {
		global $zn_framework;
		$options = array(		
					array(
                        'id'            => 'use_default',
                        'name'          => 'Use default news',
                        'description'   => 'Select if you want to use the default news set in theme options',
                        'type'          => 'toggle2',
                        'std'           => 'yes',
                        'value'         => 'yes'
                    ),
					array(
                        'id'          => 'news_date',
                        'name'        => 'News date',
                        'description' => 'Choose a date for this news.',
                        'type'        => 'date_picker',
						'class'		  => 'zn_full',
						'value'			=> '',
						'std'			=> '',
						'dependency'  => array( 'element' => 'use_default' , 'value'=> array('zn_dummy_value', '') ),
                    ),
					array(
						'id'          => 'news_text',
						'name'        => 'News text',
						'description' => 'Enter a text for this news.',
						'type'        => 'text',
						'value'		=> '',
						'std'			=> '',
						'dependency'  => array( 'element' => 'use_default' , 'value'=> array('zn_dummy_value', '') ),
					),
			);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		$use_default = $this->opt('use_default') === 'yes'  ? true : false;
		$news_date = null;
		$news_text = null;
		
		if ($use_default) {
			//$news_date = zget_option('news_date', 'general_options');
			//$news_text = zget_option('news_text', 'general_options');
		}
		else {
			$news_date = $this->opt('news_date', '');
			$news_text = $this->opt('news_text', '-');
		}
		
		
		//if ( empty( $news_date ) && empty($news_text) && $use_default) {
		//    echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
		//    return;
		//}
		
		zn_get_news_bar($news_date, $news_text, $this->data['uid'], true);
		
		
		?>
		
		

		<?php
	}

}

?>
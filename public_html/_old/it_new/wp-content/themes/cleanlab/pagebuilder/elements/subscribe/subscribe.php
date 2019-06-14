<?php
/*
	Name: Subscribe
	Description: This element will generate a subscribe element
	Class: ZnSubscribe
	Category: content
	Level: 3
	Style: true
	
*/

class ZnSubscribe extends ZnElements {

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
						'std'		=> ''
					),
					array(
						'id'          => 'subtitle',
						'name'        => 'Subtitle',
						'description' => 'Please enter a subtitle for this element',
						'type'        => 'text',
						'std'		=> ''
					),
					array(
						'id'          => 'placeholder',
						'name'        => 'Placeholder',
						'description' => 'Please enter a placeholder for the email input box',
						'type'        => 'text',
						'std'		  => 'Enter your email to subscribe'
					),
					array(
						'id'          => 'mailchimp_list',
						'name'        => 'Mailchimp List',
						'description' => 'Please select your desired Mailchimp list. If this is empty, please make sure that you have entered your Mailchimp API key inside the theme options panel',
						'type'        => 'select',
						'options'	  => generate_mailchimp_lists( 'mailchimp_api' , 'general_options' ),
					),
				)
			),
			'fields' => array(
				'title' => 'Additional Fields',
				'options' => array(
					array(
							'id'         	=> 'fields',
							'name'       	=> '',
							'description' 	=> 'Here you can create additional fields for your mailchimp list',
							'type'        	=> 'group',
							'sortable'	  	=> true,
							'element_title' => 'placeholder',
							'subelements'	=> array(
								array(
									'id'          => 'placeholder',
									'name'        => 'Placeholder',
									'description' => 'Enter a placeholder for this field.',
									'type'        => 'text'
								),
								array(
									'id'          => 'tag',
									'name'        => 'Mailchimp tag',
									'description' => 'Enter the mailchimp tag for this field.',
									'type'        => 'text'
								)
							)
					)
				)
			),
			
			'styling' => array(
				'title' => 'Styling options',
				'options' => array(
					array(
					    'id'          => 'alignment',
					    'name'        => 'Alignment',
					    'description' => 'Select the horizontal alignment.',
					    'type'        => 'select',
					    'std'		  => 'center',
					    'options'        => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
					    'live' => array(
					        'type'		=> 'class',
					        'css_class' => '.'.$this->data['uid'] //.' > div:first-child'
					    )
					),
					array(
					    'id'          => 'button_style',
					    'name'        => 'Button style',
					    'description' => 'Select the style for the button.',
					    'type'        => 'select',
					    'std'		  => 'zn_btn_3d',
					    'options'	  => zn_get_button_styles(),
					    'live' => array(
					        'type'		=> 'class',
					        'css_class' => '.'.$this->data['uid'] .' .submit'
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
						'std'		  => array('family'=>'icomoon', 'unicode'=>'ue69f'),
						'class' 	  => 'zn_full'
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
		$title = $this->opt('title')  ? $this->opt('title') : '';
		$subTitle = $this->opt('subtitle')  ? $this->opt('subtitle') : '';
		$placeholder = $this->opt('placeholder','');
		$mailchimp_list = $this->opt('mailchimp_list', '');
		$icon = $this->opt('icon')  ? '<span '.zn_generate_icon( $this->opt('icon') ).'></span>' : '';
		$alignment = $this->opt('alignment', '');
		$btn_style = $this->opt('button_style','zn_btn_3d');
		$additionalFields = ( $this->opt('fields') ) ? $this->opt('fields') : '';
		
		if ( empty($mailchimp_list)) {
			echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
			return;
		}
		
		?>
		
		<div class="zn_subscribe center <?php echo $alignment.' '. $this->data['uid']; ?>">
			<?php if (!empty($title)) { ?>
			<h2 class="section-title mbottom5"><?php echo $title; ?></h2>
			<?php } ?>
			<?php if (!empty($subTitle)) { ?>
			<h5 class="section-title zn-paragraph-color"><?php echo $subTitle; ?></h5>
			<?php } ?>
			<form method="post" class="zn_newsletter newsletter-signup" name="newsletter_form">
				
				<input type="hidden" name="zn_mailchimp_list_id" class="zn_mailchimp_list_id" value="<?php echo $mailchimp_list; ?>">
				<div class="zn_newsletter_inputs">
					<?php 
					if ($additionalFields) {
						foreach($additionalFields as $myField){ ?>
							<div class='zn_input_stretch'>
								<input type="text" name="zn_mc_<?php echo $myField["tag"]; ?>" class="subscribe-field nl-<?php echo $myField["tag"]; ?>" value="" placeholder="<?php echo $myField["placeholder"]; ?>" data-field-tag="<?php echo $myField["tag"]; ?>">
							</div>
						<?php }
					}
					?>
					<button class="submit btn <?php echo $btn_style; ?>" type="submit" name="subscribe" id="mc-embedded-subscribe"><?php echo $icon; ?></button>
					<div class="zn_input_stretch">
						<input type="text" name="zn_mc_email" class="nl-email zn-alternative-bkg" value="" placeholder="<?php echo esc_attr( $placeholder ); ?>" autocomplete="off">
					</div>
				</div>
				
			</form>
			<div class="zn_mailchimp_message"></div>			
		</div>

		<?php
	}

}

?>
<?php
/*
	Name: Contact Form
	Description: This element will generate a contact form
	Class: ZnContactForm
	Category: content
	Level: 3
	Styles: true
*/

class ZnContactForm extends ZnElements {

	// Will allow multiple forms on a single page. It will be incremented on each form created
	static $form_id = 1;

	var $submit = true;

	var $form_fields;

	function options() {
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
							'id'          => 'description',
							'name'        => 'Description',
							'description' => 'Please enter a description for this element',
							'type'        => 'visual_editor',
							'class'		=> 'zn_full',
							'std'		=> ''
						),
						array(
							'id'          => 'email',
							'name'        => 'Email address',
							'description' => 'Please enter the email adress where you want the form submissions to be sent.',
							'type'        => 'text'
						),
						array(
							'id'          => 'submit_label',
							'name'        => 'Submit button label',
							'description' => 'Enter a text for the submit button label.',
							'std' 		  => 'Send message',
							'type'        => 'text'
						),
						array(
							'id'          => 'button_style',
							'name'        => 'Submit button style',
							'description' => 'Select a style for the submit button',
							'type'        => 'select',
							'std'		=> 'zn_btn_3d',
							'options'	=> zn_get_button_styles(),
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid'] .' .btn'
							)
						),
						array(
							'id'          => 'email_subject',
							'name'        => 'Email subject text',
							'description' => 'Please enter your desired text that will appear as the subject of the received email',
							'std' 		  => 'New form submission',
							'type'        => 'text'
						),
						array(
							'id'          => 'sent_message',
							'name'        => 'Mail sent message',
							'description' => 'Please enter your desired text that will appear after the form is successfully sent',
							'std' 		  => 'Thank you for contacting us',
							'type'        => 'text'
						),
						array(
							'id'          => 'captcha',
							'name'        => 'Show captcha',
							'description' => 'Select yes if you want to add a captcha field.',
							'type'        => 'select',
							'std'        => '0',
							'options'	  => array( '0' => 'No' , '1' => 'Yes' )
						),
						array(
							'id'            => 'redirect_to_url',
							'name'          => 'Redirect after submit',
							'description'   => 'Select if you want to redirect to another page after a successful submit',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),
						array(
							'id'          => 'redirect_url',
							'name'        => 'Redirect URL',
							'description' => 'Please enter the page where you want to redirect the user after submit',
							'std' 		  => '',
							'type'        => 'text',
							'dependency'  => array( 'element' => 'redirect_to_url' , 'value'=> array('yes') ),
						),
				)
			),
			'fields' => array(
				'title' => 'Fields',
				'options' => array(
					array(
							'id'         	=> 'fields',
							'name'       	=> '',
							'description' 	=> 'Here you can create your contact form fields',
							'type'        	=> 'group',
							'sortable'	  	=> true,
							'element_title' => 'name',
							'subelements' 	=> array(
													array(
														'id'          => 'name',
														'name'        => 'Field name',
														'description' => 'Please enter a name for this field',
														'type'        => 'text'
													),
													array(
														'id'          => 'type',
														'name'        => 'Field type',
														'description' => 'Please select the field type',
														'type'        => 'select',
														'options'	  => array( 'text' => 'Text' , 'textarea' => 'Textarea', 'select' => 'Select', 'checkbox' => 'Checkbox', 'output' => 'Output' )
													),
													array(
														'id'          => 'select_option',
														'name'        => 'Select option',
														'description' => 'Please add your values for the select options in the following format : value:option name, value2:option name 2. For example "house:House, car:Car, piano:Piano"',
														'type'        => 'text',
	'dependency' => array( 								'element' => 'type' , 'value'=> array('select') )
													),
													array(
														'id'          => 'width',
														'name'        => 'Field width',
														'description' => 'Please select the field width',
														'type'        => 'select',
														'options'	  => array( 'col-sm-12' => 'Full width' , 'col-sm-6' => 'Half width' )
													),
													array(
														'id'          => 'validation',
														'name'        => 'Field validation',
														'description' => 'Please select the field validation',
														'type'        => 'select',
														'std'		  => 'not_empty',
														'options'	  => array( 'none' => 'No validation' , 'not_empty' => 'Value not empty' , 'is_email' => 'Value is email')
													),
													array(
														'id'          => 'is_email_field',
														'name'        => 'Is email field ?',
														'description' => 'Select yes if this is the email field. If yes, then you can send a confirmation email to this address. Also, this email will be used as the Reply to when receiving an email from this form.',
														'type'        => 'select',
														'std'		  => '0',
														'options'	  => array( '0' => 'No' , '1' => 'Yes' )
													),
													array(
														'id'          => 'send_confirmation',
														'name'        => 'Send confirmation email to this address?',
														'description' => 'Select yes if you want to send a confirmation email to this address. The options below will be used.',
														'type'        => 'select',
														'std'		  => '0',
														'options'	  => array( '0' => 'No' , '1' => 'Yes' ),
														'dependency'  => array( 'element' => 'is_email_field' , 'value'=> array('1') ),
													),
													array(
														'id'          => 'confirmation_subject',
														'name'        => 'Confirmation email subject',
														'description' => 'Specify the subject of the confirmation email',
														'type'        => 'text',
														'dependency'  => array( 'element' => 'is_email_field' , 'value'=> array('1') ),
													),
													array(
														'id'          => 'confirmation_message',
														'name'        => 'Confirmation message',
														'description' => 'Fill in the body of the confirmation email.',
														'type'        => 'visual_editor',
														'class'		=> 'zn_full',
														'std'		=> '',
														'dependency'  => array( 'element' => 'is_email_field' , 'value'=> array('1') ),
													),
													//array(
													//    'id'          => 'confirmation_from',
													//    'name'        => 'Confirmation from email',
													//    'description' => 'Specify the email address that should send the confirmation email. Please use an address from your local domain.',
													//    'type'        => 'text',
													//    'dependency'  => array( 'element' => 'is_email_field' , 'value'=> array('1') ),
													//),
											)

						)
				)
			),
		);	
		

		return $options;

	}

	function element() {
		$title = ( $this->opt('title') ) ? '<h2 class="zn_title">'.$this->opt('title').'</h2>'  : '';
		$description = $this->opt('description')  ? $this->opt('description') : '';

		$submit_label = ( $this->opt('submit_label') ) ? $this->opt('submit_label') : 'Send message';
		$button_style = $this->opt('button_style', 'zn_btn_3d');
		
		$fields = ( $this->opt('fields') ) ? $this->opt('fields') : '';
		$captcha = ( $this->opt('captcha') ) ? $this->opt('captcha') : '';
		$sent_message = ( $this->opt('sent_message') ) ? $this->opt('sent_message') : '';

		$redirect_to_url = $this->opt('redirect_to_url') === 'yes' ? true : false;
		$redirect_url = $this->opt('redirect_url','');

		$response = '';
		self::$form_id++;

		if ( empty( $fields ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options and add your contact fields.</div>';
			return;
		}

	?>

		<div class="zn_contact_form_container contactForm <?php echo $this->data['uid']; ?>">
			<?php echo $title; ?>
			<?php if (!empty($description)) { ?>
				<div class="zn_description"><?php echo wpautop($description); ?></div>
			<?php } ?>
			<?php
			if ( $fields ) {

				echo '<form action="'.esc_url( get_permalink( zn_get_the_id() ) ).'" method="post" class="zn_contact_form row" >';

					if ( $captcha ) {
						$fields[] = array( 'name' => 'zn_captcha' , 'type' => 'captcha' , 'validation' => 'captcha' , 'width' => 'col-sm-12' );
					}
					$fields[] = array( 'name' => 'zn_pb_form_submit_'.self::$form_id ,'validation' => 'none', 'type' => 'hidden', 'width' => 'col-sm-12' );
					
					$this->form_fields = $fields;

					// PRINT OUT THE FORM FIELDS
					echo $this->create_form_elements();

					echo '<div class="col-sm-12">';

					if ( $this->submit && $this->form_send() ){
						$response = $sent_message;
					}
					elseif( isset( $_POST['zn_pb_form_submit_'.self::$form_id] ) ){
						$response = __( 'There was a problem submiting your message. Please try again.', 'zn_framework' );
					}

					echo '<div class="zn_contact_ajax_response titleColor" id="zn_form_id'.self::$form_id.'" >'.$response.'</div>';

					echo' <span class="zn_submit_container"><button class="zn_contact_submit btn '.$button_style.'" type="submit">'.$submit_label.'</button></span></div>';

					if ($redirect_to_url && !empty($redirect_url)){
						echo '<input type="hidden" class="zn_form_field_redirect_url" value="'.esc_attr($redirect_url).'"/>';
					}

				echo '</form>';


			}
			?>

		</div>

	<?php
	}

	function create_form_elements() {

		// THIS WILL BE INCREMENTED IF THE GENERATED ID IS NOT OK
		$i = 0;

		foreach( $this->form_fields as $key => $field )
		{
			if( isset($field['type']) && method_exists($this, $field['type']))
			{
				$value = $validation_class = '';

				//** For output element, set its value to its name
				if( $field['type'] == 'output' ) {
					$value = $field['name'];
				}
				
				// SET THE FIELD ID FROM NAME AND FALLBACK TO THE INCREMENTED ID
				$id = zn_sanitize_string( $field['name'] , false , true );
				if( $field['type'] != 'hidden' ) {
					$id = 'zn_form_field_'.$id.$i;
				}
				$i++;
				

				//$validation_class = $field['validation'] != 'none' ? $field['validation'] : '';

				// ADD THE VALUE IF IT'S SET
				if ( !empty( $_POST[$id] ) ) $value = $_POST[$id];

				// PERFORM THE VALUE VALIDATION
				if ( $field['validation'] != 'none' && isset( $_POST[$id] ) ) {
					$validation_class .= ' '.$this->validate_field( $field , $id , $value );
				}

				echo '<p class="'.$field['width'].' '.$validation_class.' zn_form_field zn_'.$field['type'].'">';
					//$this->$field['type']( $field , $id , $value );
					call_user_func(array($this,$field['type']), $field , $id , $value); //** This fixes incompatibility with PHP 7.0.3
				echo '</p>';

			}
		}

	}


/* WILL OUTPUT A TEXT FIELD */
	function text( $field , $id , $value ) {

		echo '<input type="text" name="'.$id.'" id="'.$id.'" placeholder="'.esc_attr($field['name']).'" value="'.esc_attr($value).'" class="zn_form_input zn_validate_'.$field['validation'].'" />';

	}

/* WILL OUTPUT A TEXT FIELD */
	function hidden( $field , $id , $value ) {
		echo '<input type="hidden" name="'.$id.'" id="'.$id.'" placeholder="'.esc_attr($field['name']).'" value="'.esc_attr($value).'" class="zn_form_input zn_validate_'.$field['validation'].'" />';
	}

/* Will output a checkbox */
	function checkbox( $field , $id , $value ){

		$checked = true === $value ? 'checked="checked"' : '';

		echo '<input '.$checked.' type="checkbox" name="'.$id.'" class="zn_form_input zn_validate_'.$field['validation'].'" id="'.$id.'" value="true"/>';
		echo '<label for="'.$id.'">'.$field['name'].'</label>';
	}

/* WILL OUTPUT A TEXT FIELD */
	function select( $field , $id , $value ) {

		$select_options = explode(',',$field['select_option']);

		if( is_array($select_options) ) {
			echo '<select name="'.$id.'" id="'.$id.'" class="zn_form_input zn_validate_'.$field['validation'].'">';
				//if ( !empty( $field['name'] ) ) { echo '<option value="">'.$field['name'].'</option>'; }
				foreach ($select_options as $key => $value) {
					$options = explode( ':',$value );
					if ( is_array($options) ) {
						$select_key = trim($options[0]);
						$select_value = trim($options[1]);

						$selected = $select_key == $value ? 'selected="selected"' : '';

						echo '<option value="'.esc_attr($select_key).'" '.$selected.'>'.$select_value.'</option>';
					}

				}
			echo '</select>';
		}

	}

/* WILL OUTPUT A CAPTCHA FIELD */
	function captcha( $field , $id , $value ) {
		echo '<span class="zn_contact_captcha_text">'. __('Just to prove you are a human, please solve the following equation :', 'zn_framework') .'</span>';

		$captcha_val = rand( 123456789, 987654321 );
		$captcha_val 	= strrev( $captcha_val ); // We need to convert to string..somehow :)
		$correct_answer = $captcha_val[5];
		$number_1	= rand(0, $correct_answer);
		$number_2	= $correct_answer - $number_1;

		$math = $number_1.' + '.$number_2;

		echo '<input type="hidden" name="'.$id.'_captcha" value="'.$captcha_val.'" class="zn_form_input '.$id.'_captcha" />';
		echo '<input type="text" name="'.$id.'" id="'.$id.'" class="zn_form_input zn_validate_'.$field['validation'].'" />';
		echo '<span class="zn_captcha_text">'.$math.' : </span>';

	}

/* WILL OUTPUT A TEXTAREA FIELD */
	function textarea( $field , $id , $value ) {
		echo '<textarea name="'.$id.'" class="zn_form_input zn_validate_'.$field['validation'].'" id="'.$id.'" placeholder="'.esc_attr( $field['name'] ).'" cols="40" rows="6">'.$value.'</textarea>';
	}

	/* WILL OUTPUT A INFO TEXT FIELD */
	function output( $field , $id , $value ) {
		echo '<span class="zn_form_output">'.$value.'</span>';
	}
	
	function validate_field( $field, $id , $value ){

		switch ( $field['validation'] ) 
		{
			case 'not_empty':

				if( !empty( $value ) ) return "zn_field_valid";

			break;

			case 'is_email':

				if( is_email( $value ) ) return "zn_field_valid";

			break;

			case 'captcha':

				if ( !empty( $_POST[$id.'_captcha'] ) ) {
					$captcha_val = $_POST[$id.'_captcha'];
					$correct_answer = $captcha_val[5];

					if ( $correct_answer == $_POST[$id] ) {
						return "";
					}
				}
				
			break;

		}

		$this->submit = false;
		return 'zn_field_not_valid';

	}

	function form_send() {

		$to = $this->opt('email') ? $this->opt('email') : '';
		$subject = $this->opt('email_subject') ? $this->opt('email_subject') : __('New form submission','zn_framework');
		$message = '';
		//$headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
		$attachments = '';

		$i = 0;

		// DEFAULT FROM
		$from = 'no-reply@your-domain.com';
		$default_from = parse_url(home_url());
		if ( !empty($default_from['host']) ) { $from = "no-reply@".$default_from['host'];} 
		//$default_confirmation_from = $from;

		foreach ( $this->form_fields as $field ) {

			// SET THE FIELD ID FROM NAME AND FALLBACK TO THE INCREMENTED ID
			$id = zn_sanitize_string( $field['name'] , false , true );
			if( $field['type'] != 'hidden' ) {
				$id = 'zn_form_field_'.$id.$i;
			}
			$i++;

			if ( isset( $_POST[$id] ) ) {
				if($field['type'] != 'hidden' && $field['type'] != 'captcha')
				{
					if ( $field['is_email_field'] ) {
						$from = $_POST[$id];
						//** Send confirmation email
						if ($field['send_confirmation'] == "1") {
							//$confirmation_from = $field['confirmation_from'];
							//if (empty($confirmation_from)) { $confirmation_from = $default_confirmation_from; }
							$confirmation_headers = array(
								//'From: '.$confirmation_from.' <'.$confirmation_from.'>',
								'Content-Type: text/html; charset=UTF-8'
							);
							wp_mail( $from,$field['confirmation_subject'], $field['confirmation_message'], $confirmation_headers );
						}
					}
					$message .= $field['name'] .' : '.$_POST[$id] .'<br/>';
				}
			}

		}

		// GENERATE THE FINAL HEADER AND SEND THE FORM
		//$headers = 'From: '. $from . " <".$from."> \r\n";

		$headers = array(
				'From: '.$from.' <'.$from.'>',
				'Content-Type: text/html; charset=UTF-8'
			);
		return wp_mail( $to, $subject, $message, $headers );

	}

}


?>
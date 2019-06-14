<?php
/*--------------------------------------------------------------------------------------------------

	File: theme-ajax.php

	Description: This file contains all frontend ajax related functions
	Please be carefull when editing this file

--------------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------
	POSTS HEART FUNCTIONALITY
--------------------------------------------------------------------------------------------------*/
function zn_heart_ajax_callback(){

	if( isset( $_POST['post_id'] ) ) 

	$post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : false;
	$likes = get_post_meta($post_id, '_zn_framework_likes', true);
	if( isset($_COOKIE['_zn_liked_'. $post_id]) || !$post_id ) {
		if (ob_get_contents()) ob_end_clean();
		echo $likes;
		die();
	}

	$likes++;
	setcookie('_zn_liked_'. $post_id, $post_id, time()+60*60*24*30, '/');
	update_post_meta( $post_id, '_zn_framework_likes', $likes );
	
	if (ob_get_contents()) ob_end_clean();
	echo $likes;
	die();

}  

add_action('wp_ajax_zn_heart_ajax_callback', 'zn_heart_ajax_callback');           // for logged in user  
add_action('wp_ajax_nopriv_zn_heart_ajax_callback', 'zn_heart_ajax_callback');    // if user not logged in  

/*--------------------------------------------------------------------------------------------------
	MAILCHIMP PAGEBUILDER ELEMENT SUBSCRIBE
--------------------------------------------------------------------------------------------------*/
function zn_mailchimp_subscribe(){

	$return = array();

	if ( isset ( $_POST['email'] ) && isset( $_POST['mailchimp_list'] ) ) {
	
		if( $mailchimp_api = zget_option( 'mailchimp_api' , 'general_options' ) ) {
		
			if( is_email( $_POST['email'] ) ){
				require_once ( THEME_BASE .'/framework/classes/class-mailchimp.php' );

				$mailchimp = new ZnMailChimp($mailchimp_api);

				$email = $_POST['email'];


				$mailchimp_data = array( 
						'id' => $_POST['mailchimp_list'], 
						'email' => array( 'email' => $_POST['email'] )
				);

				if (!empty($_POST['otherFields'])) {
					if( is_array( $_POST['otherFields'] ) ){
						foreach( $_POST['otherFields'] as $key => $value ){
							$mailchimp_data['merge_vars'][$key] = $value;
						}
					}
				}

				$message = $mailchimp->call( 'lists/subscribe' , $mailchimp_data );

				if ( !empty( $message['error'] ) ) {
					$return['error'] = true;
					$return['message'] = '<div class="alert alert-success alert-dismissable">'. $message['error'] .'</div>';
				}
				else {
					//print_z($mailchimp_data);
					$return['message'] = '<div class="alert alert-success alert-dismissable">'. __( 'Thank you for subscribing !', 'zn_framework') .'</div>';
				}

			}
			else{
				$return['error'] = true;
				$return['message'] = '<div class="alert alert-danger alert-dismissable">'. __( 'Please enter a valid email address !', 'zn_framework') .'</div>';
			}

		}

	}

	wp_send_json($return);

}  

add_action('wp_ajax_zn_mailchimp_subscribe', 'zn_mailchimp_subscribe');           // for logged in user  
add_action('wp_ajax_nopriv_zn_mailchimp_subscribe', 'zn_mailchimp_subscribe');    // if user not logged in  

?>
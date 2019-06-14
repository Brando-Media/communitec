<?php
/*--------------------------------------------------------------------------------------------------

	File: functions-pagebuilder.php

	Description: This file will contain various filters applied to the pagebuilder
--------------------------------------------------------------------------------------------------*/


	add_action( 'zn_before_page_load', 'zn_add_inline_css' );
	add_filter("zn_pb_categories", "zn_set_elements_categories");
	
	/* HERE WE CAN ADD SOME EXTRA CSS TO THE PAGE BASED ON THE PAGE SETTINGS ( ONLY FOR PAGEBUILDER ENABLED PAGES ) */
	function zn_add_inline_css(){
		global $zn_framework;

	}

	function zn_set_elements_categories($categories){
		$categories = array(
			"layout"	=> "Layout",
			"content"	=> "Content",
			"fullwidth" => "Full width",
			"media"		=> "Media"
		);
	
		return $categories;
	}

	/** Add button for transparent header only add if the transparent header is selected */
	// GET THE HEADER LAYOUT
	$header_layout = get_post_meta( get_the_ID() , 'header_style', true );
	if (empty($header_layout)) {
		$header_layout = zget_option( 'header_layout' , 'general_options', false, 'header1' );
	}
	if ( $header_layout == 'header5' ) {
		add_action( 'zn_pb_editor_right' , 'zn_tweak_header' );
		add_action( 'zn_pb_inline_js' , 'zn_tweak_header_functionality' );		
	}


	/* ADD DISABLE OBLIQUE TO EDITOR */
	function zn_tweak_header()
	{
		?>
		<div class="zn_tweak_header znpb_custom_action clearfix">
			<span><?php _e( 'Show content after header', 'zn_framework' ); ?></span>
			<span class="zn_toggle2">
				<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="zn_hide_oblique">
				<label class="slider-v3" for="zn_hide_oblique"></label>
			</span>
		</div>

	<?php
	}

	/* ADD DISABLE OBLIQUE FUNCTIONALITY TO EDITOR */
	function zn_tweak_header_functionality()
	{
	?>
	<script type="text/javascript">
	/* <![CDATA[ */

		(function ($) {

			jQuery(document).ready(function () {
				// $('body').removeClass('oblique');

				$( document ).on( 'change' , '.zn_tweak_header .onoffswitch-checkbox' , function(){
					if(this.checked) {
						$('#header').removeClass('header5');
						$('#header').addClass('header1');
						$.themejs.enable_responsive_header();
					}
					else{
						$('#header').removeClass('header1');
						$('#header').addClass('header5');
						$.themejs.enable_responsive_header();
					}
				});

			});

		})(jQuery);
		
	/* ]]> */
	</script>
	<?php
	}

?>
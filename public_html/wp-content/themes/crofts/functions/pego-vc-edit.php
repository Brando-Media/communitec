<?php
$pego_active_plugins = get_option('active_plugins');
if (in_array("js_composer/js_composer.php", $pego_active_plugins)) {
 	if (function_exists('vc_map')) {

		$pego_allPostsArray = pego_get_all_posts();
		/* new elements for builder */
		
		// get all testimonials 
		$allTest= pego_get_all_test();
		$number_of_test = count($allTest);
		$list_allTest = '';
		$current=0;
		if ($allTest) {
			foreach($allTest as $key => $value) {
				$current++;
				if ($current == $number_of_test) {
					$list_allTest .= " and ".$value;	
				}
				else
				{
					$list_allTest .= $value.", ";
				}	
			}	
		}

		
				
		/* Portfolio items
		----------------------------------------------------------  */
		vc_map( array(
		  "name" => esc_html__("Service items", "crofts"),
		  "base" => "vc_service_items",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		   "params" => array(
			array(
			  "type" => "dropdown",
			  "heading" => esc_html__("Columns", "crofts"),
			  "param_name" => "columns",
			  "value" => array(esc_html__('2', "crofts") => "2", esc_html__('3', "crofts") => "3", esc_html__('4', "crofts") => "4", esc_html__('5', "crofts") => "5", esc_html__('6', "crofts") => "6"),
			  "description" => esc_html__("Set columns.", "crofts"),
			  "dependency" => Array('element' => "type", 'value' => array('type2'))
			),
			  array(
			  "type" => "textfield",
			  "heading" => esc_html__("Number of items", "crofts"),
			  "param_name" => "number_of_items",
			  "description" => esc_html__("Set number of items to be displayed.", "crofts")
			  ),
			  array(
			  "type" => "textfield",
			  "heading" => esc_html__("Thumbnail size", "crofts"),
			  "param_name" => "thumb_size",
			  "description" => esc_html__("Insert thumb size. Example input can be 700x450. If left empty, full image size will be taken. Option is used for square types only.", "crofts"),
			  "dependency" => Array('element' => "type", 'value' => array('type2'))
			  )
		  )
		  
		) );
		
		
		 /* Testimonials
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("Testimonials", "crofts"),
		  "base" => "vc_testimonials",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		   "params" => array(
			  array(
			  "type" => "exploded_textarea",
			  "heading" => esc_html__("Testimonials", "crofts"),
			  "param_name" => "grid_categories",
			  "description" => __("If you want to narrow output, enter testimonials names here. Note: Only listed testimonials will be included. Divide testimonials with linebreaks (Enter). You may choose between: <strong>".$list_allTest."</strong>", "crofts")
			)
		   )
		) );
		
		
		/* Google maps Grayscale
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("Google Maps", "crofts"),
		  "base" => "vc_pego_maps",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		  "params" => array(
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Latitude", "crofts"),
			  "param_name" => "latitude",
			  "description" => esc_html__("Insert latitude value (decimal).", "crofts")
			  ),
		  	array(
			  "type" => "textfield",
			  "heading" => esc_html__("Longitude", "crofts"),
			  "param_name" => "longitude",
			  "description" => esc_html__("Insert longitude value (decimal)", "crofts")
			  ),
			array(
			  "type" => "attach_image",
			  "heading" => esc_html__("Pin image", "crofts"),
			  "param_name" => "image",
			  "value" => "",
			  "description" => esc_html__("Set pin image.", "crofts")
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Height", "crofts"),
			  "param_name" => "height",
			  "description" => esc_html__("Insert height, value only. If nothing set, 250 will be given.", "crofts")
			  ),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Zoom", "crofts"),
			  "param_name" => "zoom",
			  "description" => esc_html__("Insert zoom number. If nothing set, 11 will be given.", "crofts")
			  )
		  )
		 // ,  "js_view" => 'VcColLeftIconView'
		) );
		
		/* Team
		---------------------------------------------------------- */
		vc_map( array(
			 "name" => esc_html__("Team", "crofts"),
			"base" => "vc_team",
			"icon" => "icon-vc-pego",
			"category" => esc_html__('Content', 'crofts'),
		
		) );
		
		/* Portfolio items
		----------------------------------------------------------  */
		vc_map( array(
		  "name" => esc_html__("Portfolio items", "crofts"),
		  "base" => "vc_portfolio_items",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		  
		  "params" => array(
			array(
			  "type" => "dropdown",
			  "heading" => esc_html__("Columns", "crofts"),
			  "param_name" => "columns",
			  "value" => array(esc_html__('2', "crofts") => "2", esc_html__('3', "crofts") => "3", esc_html__('4', "crofts") => "4", esc_html__('5', "crofts") => "5"),
			  "description" => esc_html__("Set columns.", "crofts"),
			  "dependency" => Array('element' => "type", 'value' => array('type2'))
			),
			  array(
			  "type" => "textfield",
			  "heading" => esc_html__("Number of items", "crofts"),
			  "param_name" => "number_of_items",
			  "description" => esc_html__("Set number of items to be displayed.", "crofts")
			  ),
			  array(
			  "type" => "textfield",
			  "heading" => esc_html__("Thumbnail size", "crofts"),
			  "param_name" => "thumb_size",
			  "description" => esc_html__("Insert thumb size. Example input can be 700x450. If left empty, full image size will be taken. Option is used for square types only.", "crofts"),
			  "dependency" => Array('element' => "type", 'value' => array('type2'))
			  )
		  )
		  
		) );
		
		
		
		/* Quote
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("Quote", "crofts"),
		  "base" => "vc_quote",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		  "params" => array(
			 array(
			  "type" => "textarea",
			  "heading" => esc_html__("Content", "crofts"),
			  "param_name" => "quote_content",
			  "description" => esc_html__("Enter quote content.", "crofts")
			  ),
			  array(
			  "type" => "attach_image",
			  "heading" => esc_html__("Signature image", "crofts"),
			  "param_name" => "image",
			  "value" => "",
			  "description" => esc_html__("Set image for signature.", "crofts")
			)
		  )
		 // ,  "js_view" => 'VcColLeftIconView'
		) );
		
		
		
		/* Portfolio details
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("Portfolio details", "crofts"),
		  "base" => "vc_portfolio_details",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		  "params" => array(
			  array(
			  "type" => "textarea_html",
			  "heading" => esc_html__("Content", "crofts"),
			  "param_name" => "content",
			  "value" => __("<p>Sample content</p>", "crofts")
			  ),
		  	array(
			  "type" => "textfield",
			  "heading" => esc_html__("Title #1", "crofts"),
			  "param_name" => "title1",
			  "description" => esc_html__("Insert title #1.", "crofts")
			  ),
		  	array(
			  "type" => "textfield",
			  "heading" => esc_html__("Content #1", "crofts"),
			  "param_name" => "content1",
			  "description" => esc_html__("Insert content #1.", "crofts")
			  ),
		  	array(
			  "type" => "textfield",
			  "heading" => esc_html__("Title #2", "crofts"),
			  "param_name" => "title2",
			  "description" => esc_html__("Insert title #2.", "crofts")
			  ),
		  	array(
			  "type" => "textfield",
			  "heading" => esc_html__("Content #2", "crofts"),
			  "param_name" => "content2",
			  "description" => esc_html__("Insert content #2.", "crofts")
			  ),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Title #3", "crofts"),
			  "param_name" => "title3",
			  "description" => esc_html__("Insert title #3.", "crofts")
			  ),
		  	array(
			  "type" => "textfield",
			  "heading" => esc_html__("Content #3", "crofts"),
			  "param_name" => "content3",
			  "description" => esc_html__("Insert content #3.", "crofts")
			  ),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Title #4", "crofts"),
			  "param_name" => "title4",
			  "description" => esc_html__("Insert title #4.", "crofts")
			  ),
		  	array(
			  "type" => "textfield",
			  "heading" => esc_html__("Content #4", "crofts"),
			  "param_name" => "content4",
			  "description" => esc_html__("Insert content #4.", "crofts")
			  ),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Title #5", "crofts"),
			  "param_name" => "title5",
			  "description" => esc_html__("Insert title #5.", "crofts")
			  ),
		  	array(
			  "type" => "textfield",
			  "heading" => esc_html__("Content #5", "crofts"),
			  "param_name" => "content5",
			  "description" => esc_html__("Insert content #5.", "crofts")
			  ),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Get a quote caption", "crofts"),
			  "param_name" => "buttoncaption1",
			  "description" => esc_html__("Enter button caption. ", "crofts")
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Get a quote url", "crofts"),
			  "param_name" => "buttonurl1",
			  "description" => esc_html__("Enter button url. ", "crofts")
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Plan caption", "crofts"),
			  "param_name" => "buttoncaption2",
			  "description" => esc_html__("Enter button caption. ", "crofts")
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Plan url", "crofts"),
			  "param_name" => "buttonurl2",
			  "description" => esc_html__("Enter button url. ", "crofts")
			)
		  )
		 // ,  "js_view" => 'VcColLeftIconView'
		) );
		
		
		
		/* Col with left icon
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("Column with left icon", "crofts"),
		  "base" => "vc_column_with_left_icon",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		  "params" => array(
			   array(
			  "type" => "textfield",
			  "heading" => esc_html__("Title", "crofts"),
			  "param_name" => "title",
			  "description" => esc_html__("Enter title. ", "crofts")
			),
			 array(
			  "type" => "textfield",
			  "heading" => esc_html__("Icon code", "crofts"),
			  "param_name" => "iconcode",
			  "description" => esc_html__("Enter icon code. ", "crofts")
			),
			 array(
			  "type" => "textarea",
			  "heading" => esc_html__("Content", "crofts"),
			  "param_name" => "col_content",
			  "description" => esc_html__("Enter content.", "crofts")
			  )
		  )
		 // ,  "js_view" => 'VcColLeftIconView'
		) );
		
 		/* Counter
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("Counter", "crofts"),
		  "base" => "vc_counter",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		  "params" => array(
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Title", "crofts"),
			  "param_name" => "title",
			  "holder" => "div",
			  "value" => esc_html__("Title", "crofts"),
			  "description" => esc_html__("Counter title.", "crofts")
			  ),
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("Title color", "crofts"),
			  "param_name" => "title_color",
			  "description" => esc_html__("Choose title color.", "crofts")
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Counter value", "crofts"),
			  "param_name" => "counter_value",
			  "description" => esc_html__("Enter counter value.", "crofts")
			),
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("Value color", "crofts"),
			  "param_name" => "value_color",
			  "description" => esc_html__("Choose color for value.", "crofts")
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Icon", "crofts"),
			  "param_name" => "icon",
			  "description" => esc_html__("Input icon code.", "crofts")
			),
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("Icon color", "crofts"),
			  "param_name" => "icon_color",
			  "description" => esc_html__("Choose color icon.", "crofts")
			),
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("Background color", "crofts"),
			  "param_name" => "bg_color",
			  "description" => esc_html__("Choose background color.", "crofts")
			)
		  )
		) );
		
		
				
		 /* Circle chart
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("Circle chart", "crofts"),
		  "base" => "vc_circle_chart",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		  "params" => array(  
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("Bar color", "crofts"),
			  "param_name" => "color",
			  "value" => "#000",
			  "description" => esc_html__("Choose color for chart bar.", "crofts")
			),
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("Track color", "crofts"),
			  "param_name" => "track_color",
			   "value" => "#f1f1f1",
			  "description" => esc_html__("Choose color for chart track.", "crofts")
			),
		  array(
			  "type" => "textfield",
			  "heading" => esc_html__("Chart width", "crofts"),
			  "param_name" => "chart_width",
			  "value" => "200",
			  "description" => esc_html__("Enter value for data line width. Enter number only.", "crofts")
			),
		  array(
			  "type" => "textfield",
			  "heading" => esc_html__("Data line width", "crofts"),
			  "param_name" => "line_width",
			  "value" => "7",
			  "description" => esc_html__("Enter value for data line width. Enter number only.", "crofts")
			),
		  array(
			  "type" => "textfield",
			  "heading" => esc_html__("Value", "crofts"),
			  "param_name" => "value",
			  "description" => esc_html__("Enter value for bar chart. Enter number only [1-100].", "crofts")
			),
			array(
			  "type" => "dropdown",
			  "heading" => esc_html__("Type", "crofts"),
			  "param_name" => "type",
			  "value" => array(esc_html__('Percent', "crofts") => "percent", esc_html__('Description', "crofts") => "description", esc_html__('Icon', "crofts") => "icon"),
			  "description" => esc_html__("Select type that will appear inside the chart.", "crofts")
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Description", "crofts"),
			  "param_name" => "description",
			  "description" => esc_html__("Enter description text for inside the chart.", "crofts"),
			 "dependency" => Array('element' => "type", 'value' => array('description'))
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Description font size", "crofts"),
			  "param_name" => "description_size",
			  "description" => esc_html__("Enter size for chart description. Enter number only.", "crofts"),
			 "dependency" => Array('element' => "type", 'value' => array('description'))
			),
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("Description color", "crofts"),
			  "param_name" => "description_color",
			  "description" => esc_html__("Choose color for chart description.", "crofts"),
			  "dependency" => Array('element' => "type", 'value' => array('description'))
			),
		   array(
			  "type" => "textfield",
			  "heading" => esc_html__("Percent font size", "crofts"),
			  "param_name" => "percent_size",
			  "description" => esc_html__("Enter size for chart percent. Enter number only.", "crofts"),
			 "dependency" => Array('element' => "type", 'value' => array('percent'))
			),
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("Percent color", "crofts"),
			  "param_name" => "percent_color",
			  "description" => esc_html__("Choose color for chart percent.", "crofts"),
			  "dependency" => Array('element' => "type", 'value' => array('percent'))
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Icon", "crofts"),
			  "param_name" => "icon",
			  "description" => esc_html__("Enter chart icon code.", "crofts"),
			 "dependency" => Array('element' => "type", 'value' => array('icon'))
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Icon font size", "crofts"),
			  "param_name" => "icon_size",
			  "description" => esc_html__("Enter size for chart icon. Enter number only.", "crofts"),
			 "dependency" => Array('element' => "type", 'value' => array('icon'))
			),
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("Icon color", "crofts"),
			  "param_name" => "icon_color",
			  "description" => esc_html__("Choose color for chart icon.", "crofts"),
			  "dependency" => Array('element' => "type", 'value' => array('icon'))
			),
		   array(
			  "type" => "textarea_html",    
			  "heading" => esc_html__("Content under chart", "crofts"),
			  "param_name" => "content",
			  "value" => __("<p></p>", "crofts")
			)
		  )
		) );
		
		/* Quote
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("Gallery", "crofts"),
		  "base" => "vc_pego_gallery",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		  "params" => array(
			array(
			  "type" => "attach_images",
			  "heading" => esc_html__("Images", "crofts"),
			  "param_name" => "image",
			  "value" => "",
			  "description" => esc_html__("Set image for signature.", "crofts")
			),
			array(
			  "type" => "dropdown",
			  "heading" => esc_html__("Columns", "crofts"),
			  "param_name" => "columns",
			  "value" => array(esc_html__('2', "crofts") => "2", esc_html__('3', "crofts") => "3", esc_html__('4', "crofts") => "4", esc_html__('5', "crofts") => "5"),
			  "description" => esc_html__("Set columns.", "crofts"),
			  "dependency" => Array('element' => "type", 'value' => array('type2'))
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Thumbnail size", "crofts"),
			  "param_name" => "thumb_size",
			  "description" => esc_html__("Insert thumb size. Example input can be 700x450. If left empty, full image size will be taken. Option is used for square types only.", "crofts"),
			  "dependency" => Array('element' => "type", 'value' => array('type2'))
			  )
		  )
		 // ,  "js_view" => 'VcColLeftIconView'
		) );
		
		/* Error page construct
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("Error page shortcode", "crofts"),
		  "base" => "vc_error_page_contruct",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		  "params" => array(
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Content #1", "crofts"),
			  "param_name" => "content1",
			  "description" => esc_html__("Insert content #1.", "crofts")
			  ),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Content #2", "crofts"),
			  "param_name" => "content2",
			  "description" => esc_html__("Insert content #2.", "crofts")
			  ),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Content #3", "crofts"),
			  "param_name" => "content3",
			  "description" => esc_html__("Insert content #3.", "crofts")
			  ),
			  array(
			  "type" => "textfield",
			  "heading" => esc_html__("Button caption", "crofts"),
			  "param_name" => "buttoncaption",
			  "description" => esc_html__("Insert button caption.", "crofts")
			  ),
			  array(
			  "type" => "textfield",
			  "heading" => esc_html__("Button url", "crofts"),
			  "param_name" => "buttonurl",
			  "description" => esc_html__("Insert button url.", "crofts")
			  )
		  )
		 // ,  "js_view" => 'VcColLeftIconView'
		) );
		

		/* Error page construct
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("Error page shortcode", "crofts"),
		  "base" => "vc_error_page_contruct",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		  "params" => array(
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Content #1", "crofts"),
			  "param_name" => "content1",
			  "description" => esc_html__("Insert content #1.", "crofts")
			  ),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Content #2", "crofts"),
			  "param_name" => "content2",
			  "description" => esc_html__("Insert content #2.", "crofts")
			  ),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Content #3", "crofts"),
			  "param_name" => "content3",
			  "description" => esc_html__("Insert content #3.", "crofts")
			  ),
			  array(
			  "type" => "textfield",
			  "heading" => esc_html__("Button caption", "crofts"),
			  "param_name" => "buttoncaption",
			  "description" => esc_html__("Insert button caption.", "crofts")
			  ),
			  array(
			  "type" => "textfield",
			  "heading" => esc_html__("Button url", "crofts"),
			  "param_name" => "buttonurl",
			  "description" => esc_html__("Insert button url.", "crofts")
			  )
		  )
		 // ,  "js_view" => 'VcColLeftIconView'
		) );

		 /* Titles
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("Titles", "crofts"),
		  "base" => "vc_text_titles",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		  "params" => array(
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Title", "crofts"),
			  "param_name" => "title",
			  "holder" => "div",
			  "value" => esc_html__("Title", "crofts"),
			  "description" => esc_html__("Title content.", "crofts")
			),
			array(
			  "type" => "dropdown",
			  "heading" => esc_html__("Title type", "crofts"),
			  "param_name" => "title_type",
			  "value" => array(esc_html__('h1', "crofts") => "h1", esc_html__('h2', "crofts") => "h2", esc_html__('h3', "crofts") => "h3", esc_html__('h4', "crofts") => "h4", esc_html__('h5', "crofts") => "h5") ,
			  "description" => esc_html__("Select title type.", "crofts")
			),
		   array(
			  "type" => "dropdown",
			  "heading" => esc_html__("Title alignment", "crofts"),
			  "param_name" => "title_align",
			  "value" => array(esc_html__('Left', "crofts") => "left", esc_html__('Center', "crofts") => "center", esc_html__('Right', "crofts") => "right") ,
			  "description" => esc_html__("Select title alignment. ", "crofts")
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Subtitle top", "crofts"),
			  "param_name" => "subtitletop",
			  "description" => esc_html__("Enter subtitle top. ", "crofts")
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("Subtitle bottom", "crofts"),
			  "param_name" => "subtitlebottom",
			  "description" => esc_html__("Enter subtitle bottom. ", "crofts")
			)
		  ),
		  "js_view" => 'VcTextSeparatorView'
		) );

		

		
		/* Blockquote
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("Blockquote", "crofts"),
		  "base" => "vc_blockquote",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		  "params" => array(
			array(
			  "type" => "dropdown",
			  "heading" => esc_html__("Blockquote type", "crofts"),
			  "param_name" => "type",
			  "value" => array(esc_html__('Type#1', "crofts") => "type1", esc_html__('Type#2', "crofts") => "type2", esc_html__('Type#3', "crofts") => "type3",  esc_html__('Type#4', "crofts") => "type4"),
			  "description" => esc_html__("Select blockquote type.", "crofts")
			),
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("Border color", "crofts"),
			  "param_name" => "border_color",
			  "description" => esc_html__("Border color for blockquote.", "crofts"),
			  "dependency" => Array('element' => "type", 'value' => array('type1'))
			),
			  array(
			  "type" => "textfield",
			  "heading" => esc_html__("Border size", "crofts"),
			  "param_name" => "border_size",
			  "description" => esc_html__("Border size. Insert number only.", "crofts"),
			   "dependency" => Array('element' => "type", 'value' => array('type1'))
			  ),
			array(
			  "type" => "attach_image",
			  "heading" => esc_html__("Icon", "crofts"),
			  "param_name" => "icon_image",
			  "value" => "",
			  "description" => esc_html__("Select icon image from media library.", "crofts"),
			   "dependency" => Array('element' => "type", 'value' => array('type2', 'type3', 'type4'))
			),
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("Background color", "crofts"),
			  "param_name" => "background_color",
			  "description" => esc_html__("Background color for blockquote.", "crofts"),
			  "dependency" => Array('element' => "type", 'value' => array('type2', 'type4'))
			),
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("Icon background color", "crofts"),
			  "param_name" => "icon_background_color",
			  "description" => esc_html__("Background color for icon.", "crofts"),
			  "dependency" => Array('element' => "type", 'value' => array('type3'))
			),
			array(
			  "type" => "textarea_html",
			  "heading" => esc_html__("Text", "crofts"),
			  "param_name" => "content",
			  "value" => __("<p>Sample content</p>", "crofts")
			)
		  )
		 // ,  "js_view" => 'VcColLeftIconView'
		) );
		
		
		/* Dropcaps
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("Dropcap", "crofts"),
		  "base" => "vc_dropcap",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'crofts'),
		  "params" => array(
			array(
			  "type" => "dropdown",
			  "heading" => esc_html__("Dropcap type", "crofts"),
			  "param_name" => "type",
			  "value" => array(esc_html__('Type#1', "crofts") => "type1", esc_html__('Type#2', "crofts") => "type2"),
			  "description" => esc_html__("Select dropcap type.", "crofts")
			),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("First letter", "crofts"),
			  "param_name" => "first_letter",
			  "value" => esc_html__("A", "crofts"),
			  "description" => esc_html__("First letter.", "crofts")
			  ),
			array(
			  "type" => "textfield",
			  "heading" => esc_html__("First letter size", "crofts"),
			  "param_name" => "first_letter_size",
			  "description" => esc_html__("First letter font size. Insert number only.", "crofts")
			  ),
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("First letter color", "crofts"),
			  "param_name" => "first_letter_color",
			  "description" => esc_html__("Choose color for first letter.", "crofts"),
			  "dependency" => Array('element' => "bgcolor", 'value' => array('custom'))
			),
			array(
			  "type" => "colorpicker",
			  "heading" => esc_html__("First letter background", "crofts"),
			  "param_name" => "first_letter_bg",
			  "description" => esc_html__("Choose background color for first letter.", "crofts"),
			  "dependency" => Array('element' => "type", 'value' => array('type2'))
			),
		  array(
			  "type" => "textarea_html",
			  "heading" => esc_html__("Text", "crofts"),
			  "param_name" => "content",
			  "value" => __("<p>Sample content</p>", "crofts")
			)
		  )
		) );
		
		 /* Titles
		---------------------------------------------------------- */
		vc_map( array(
		  "name" => esc_html__("End excerpt", "inkstory"),
		  "base" => "vc_end_excerpt",
		  "icon" => "icon-vc-pego",
		  "category" => esc_html__('Content', 'inkstory'),
		) );

		
		
		
		
	function service_items_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'columns' => '2',
			'number_of_items' => '-1',
			'thumb_size' => 'full'
			
		), $atts));
    
    	$args = array('post_type'=> 'service', 'posts_per_page' => esc_html($number_of_items), 'order'=> 'ASC', 'orderby' => 'menu_order ID');	
    	$posts = get_posts($args);
   	    wp_enqueue_script('pego_isotopeJS');
   	    
   	    
   	 if($posts) {
   	 		$output = '<div class="wpb_content_element vc_service_items">';	
   	 		$random_id = rand(1, 10000);					
			$output .= '<div class="pego-isotope-wrapper service-items-wrapper service-items-'.esc_html($random_id).'">';
			$itemCount = 0;
			$idd = 0;
			$catArray = array();
			$counter = 0;
			$cats_array_filter = array();
			$margin_between_items = '';
			
			foreach($posts as $post)
			{
			
				$title = get_the_title($post->ID);
				$counter++;
				$post_thumbnail = pego_getImageBySize(array( 'post_id' => $post->ID, 'thumb_size' => $thumb_size ));
				
				$thumbnail = $post_thumbnail['thumbnail'];
				$output .= '<div class="service-items-single  service-columns'.esc_attr($columns).' isotope-item">';
				$output .= '<figure class="effect-chico">';
				
						$output .= $thumbnail;
						$output .= '<figcaption>';
							$output .= '<h2>'.esc_html($title).'</h2>';
							//$output .= '<p>Chicos main fear was missing the morning bus.</p>';
							$output .= '<a href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'"></a>';
						$output .= '</figcaption>	';		
					$output .= '</figure>';
				$output .= '</div>';	
				
			}
			
			
			$output .= '</div>';
			$output .= '</div>';
		}
		
		
		
		return $output;
		}

		add_shortcode( 'vc_service_items', 'service_items_sh' );
		
		
		
		
		function portfolio_items_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'columns' => '2',
			'number_of_items' => '-1',
			'thumb_size' => 'full'
			
		), $atts));
    
    	$args = array('post_type'=> 'portfolio', 'posts_per_page' => esc_attr($number_of_items), 'order'=> 'ASC', 'orderby' => 'menu_order ID');	
    	$posts = get_posts($args);
   	    wp_enqueue_script('pego_isotopeJS');
   	    
   	    
   	 if($posts) {
   	 		$output = '<div class="wpb_content_element vc_portfolio_items">';
			
			foreach($posts as $post)
			{
				$cats_filter = get_the_terms( $post->ID, 'portfolio_categories' );
				if ($cats_filter) {
					foreach($cats_filter as $cat_filter) {
						$cats_array_filter[] = $cat_filter->term_id;
					}
				}
			}
			$cats_array_filter = array_unique($cats_array_filter);
			if ($cats_array_filter) {
				$output .= '<ul id="filters" class="option-set" data-option-key="filter">';
					$output .= '<li class="filter-cat"><a href="#filter" data-option-value="*" class="selected">All</a></li>';
					foreach ($cats_array_filter as $cats_array_id) {
						$term =  get_term( $cats_array_id, 'portfolio_categories' );
						$output .= '<li class="filter-cat"><a href="#filter" data-option-value=".'.esc_attr($term->slug).'">'.esc_html($term->name).'</a></li>';
					}
				$output .= '</ul>';
				$output .= '<div class="clear"></div>';
			}
		
   	 		$random_id = rand(1, 10000);					
			$output .= '<div class="pego-isotope-wrapper portfolio-items-wrapper portfolio-items-'.esc_attr($random_id).'">';
			$itemCount = 0;
			$idd = 0;
			$catArray = array();
			$counter = 0;
			$cats_array_filter = array();
			$margin_between_items = '';
			foreach($posts as $post)
			{
			
				$title = get_the_title($post->ID);
				$counter++;
				$cats = get_the_terms( $post->ID, 'portfolio_categories' );
				$cats_array = array();
				$cats_slug_array = array();
				if ($cats) {
					foreach($cats as $cat) {
						$cats_array[] = $cat->name;
						$cats_slug_array[] = $cat->slug;
					}
				}
				$class_for_columns = $columns;
				/*
				if ($counter == 1) {
					$class_for_columns = '2';
				}
				*/
				$cats_string = implode(", ", $cats_array);
				$cats_slug_string = implode(" ", $cats_slug_array);
				$post_thumbnail = pego_getImageBySize(array( 'post_id' => $post->ID, 'thumb_size' => $thumb_size ));
				$portfolio_description = get_post_meta($post->ID , $GLOBALS['wpcf_prefix'].'short-description' , true);
				$thumbnail = $post_thumbnail['thumbnail'];
				$output .= '<div class="portfolio-items-single portfolio-columns'.esc_attr($class_for_columns).' isotope-item '.esc_attr($cats_slug_string).'">';
					$output .= '<a href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'" >';
						$output .= $thumbnail;
					$output .= '</a>';
					$output .= '<div class="portfolio-items-single-hover-details">';
						$output .= '<h2 class="portfolio-items-single-title"><a href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'" >'.esc_html($title).'</a></h2>';
						if ($cats_slug_string != '') {
							$output .= '<div class="portfolio-items-single-categories">'.esc_html($cats_slug_string).'</div>';
						}
					$output .= '</div>';	
				$output .= '</div>';						
				
			}
			$output .= '</div>';
			$output .= '</div>';
		}
		return $output;
		}

		add_shortcode( 'vc_portfolio_items', 'portfolio_items_sh' );
		
		
		function portfolio_details_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'title1' => '',
			'content1' => '',
			'title2' => '',
			'content2' => '',
			'title3' => '',
			'content3' => '',
			'title4' => '',
			'content4' => '',
			'title5' => '',
			'content5' => '',
			'title' => '',
			'buttoncaption1' => '',
			'buttonurl1' => '',
			'buttoncaption2' => '',
			'buttonurl2' => ''
		), $atts));
		
		$output = '<div class="wpb_content_element vc_portfolio_details">';	
				$output .= '<div class="portfolio-details-content">';
						$output .= esc_html($content);
				$output .= '</div>';
				$output .= '<div class="clear"></div>';
				$output .= '<div class="portfolio-details-bottom">';
						$extra_class = '';
						if (($title1 != '') && ($content1 != '') && ($buttoncaption1 != '') && ($buttonurl1 != '')) {
							$extra_class = ' portfolio-border';
						}
						$output .= '<div class="portfolio-details-list'.esc_attr($extra_class).'">';
							if (($title1 != '') && ($content1 != '')) {
								$output .= '<div class="single-portfolio-detail">';
									$output .= '<h3>'.esc_html($title1).'</h3>';
									$output .= '<div class="single-portfolio-detail-value"><p>'.esc_html($content1).'</p></div>';
								$output .= '</div>';
							}
							if (($title2 != '') && ($content2 != '')) {
								$output .= '<div class="single-portfolio-detail">';
									$output .= '<h3>'.esc_html($title2).'</h3>';
									$output .= '<div class="single-portfolio-detail-value"><p>'.esc_html($content2).'</p></div>';
								$output .= '</div>';
							}	
							if (($title3 != '') && ($content3 != '')) {
								$output .= '<div class="single-portfolio-detail">';
									$output .= '<h3>'.esc_html($title3).'</h3>';
									$output .= '<div class="single-portfolio-detail-value"><p>'.esc_html($content3).'</p></div>';
								$output .= '</div>';
							}
							if (($title4 != '') && ($content4 != '')) {
								$output .= '<div class="single-portfolio-detail">';
									$output .= '<h3>'.esc_html($title4).'</h3>';
									$output .= '<div class="single-portfolio-detail-value"><p>'.esc_html($content4).'</p></div>';
								$output .= '</div>';
							}
							if (($title5 != '') && ($content5 != '')) {
								$output .= '<div class="single-portfolio-detail">';
									$output .= '<h3>'.esc_html($title5).'</h3>';
									$output .= '<div class="single-portfolio-detail-value"><p>'.esc_html($content5).'</p></div>';
								$output .= '</div>';
							}
						$output .= '</div>';
						$output .= '<div class="portfolio-details-buttons">';
							if (($buttoncaption1 != '') && ($buttonurl1 != '')) {
								$output .= '<a class="portoflio-details-button1" href="'.esc_url($buttonurl1).'" title="'.esc_attr($buttoncaption1).'" >'.esc_html($buttoncaption1).'<i class="portoflio-details-button1-icon icon-right-dir"></i></a>';	
								$output .= '<div class="clear"></div>';
							}
							if (($buttoncaption2 != '') && ($buttonurl2 != '')) {
								$output .= '<a class="portoflio-details-button2" href="'.esc_url($buttonurl2).'" title="'.esc_attr($buttoncaption2).'" >'.esc_html($buttoncaption2).'</a>';	
							}
						$output .= '</div>';
						$output .= '<div class="clear"></div>';
				$output .= '</div>';
			
		$output .= '</div>';	
		
		
		
		return $output;
		}

		add_shortcode( 'vc_portfolio_details', 'portfolio_details_sh' );
		
		
		function pego_quote_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'quote_content' => '',
			'image' => '',
		), $atts));
		$img_id = preg_replace('/[^\d]/', '', $image);
		$link_to = wp_get_attachment_image_src( $img_id, 'full');
		
		$output = '<div class="wpb_content_element vc_quote">';
			$output .= '<div class="quote-content"><p>'.esc_html($quote_content).'</p></div>';
			$output .= '<div class="quote-image"><img src="'.esc_url($link_to[0]).'" /></div>';
		$output .= '</div>';		
		

		return $output;
		}

		add_shortcode( 'vc_quote', 'pego_quote_sh' );
		
		
		
		function column_with_left_icon_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'title' => '',
			'iconcode' => '',
			'col_content' => ''
		), $atts));
		$output = '<div class="wpb_content_element vc_column_with_left_icon">';
			$output .= '<div class="col-with-icon-code '.esc_attr($iconcode).'"></div>';
			$output .= '<h3 class="col-with-icon-title">'.esc_html($title).'</h3>';
			$output .= '<div class="clear"></div>';
			$output .= '<div class="col-with-icon-content">'.esc_html($col_content).'</div>';
		$output .= '</div>';
		return $output;
		}

		add_shortcode( 'vc_column_with_left_icon', 'column_with_left_icon_sh' );
		
		
		function pego_testimonials_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'grid_categories' => ''
		   ), $atts ) );
	
			$id = rand(1, 10000);
			wp_enqueue_script('pego_owl_carousel');
			$terms = array();
			$output = '<div class="vc_testimonials wpb_content_element">';
			$output .= '<div class="owl-carousel owl-theme testimonials-wrapper">';
			$allTestimonials1 = pego_get_all_test();
			if ($grid_categories != '') {
				$allTestimonials = array();
				$single_test = explode(",", $grid_categories);	
				foreach($single_test as $currentTest)  {
					$key = array_search($currentTest, $allTestimonials1); 
					$allTestimonials[$key] = $currentTest;
				}
		
			} else {
				$allTestimonials = pego_get_all_test();	
			}
			foreach($allTestimonials as $key => $singleTestimonial) {
				$currrentTestimonial = get_post($key);
				$content = $currrentTestimonial->post_content;
				$author = get_post_meta($key, $GLOBALS['wpcf_prefix'].'author-name' , true);
				$test_image = wp_get_attachment_image_src( get_post_thumbnail_id( $key ), 'single-post-thumbnail' );
				$output .= '<div class="item testimonials-wrapper">';
					$output .= '<div>';
					if ($test_image[0] != '') {
						$output .= '<div class="testimonials-image-wrapper"><img alt="'.$author.'" class="testimonial-image" src="'.esc_url($test_image[0]).'" /></div>';
					}
					$output .= '<div class="testimonial-content">'.esc_html($content).'</div>';
					
					if ($author != '' ) {
						$output .= '<div class="testimonial-author">'.esc_html($author).'</div>';
					}
					$output .= '</div>';
				$output .= '</div>';

			}
		$output .= '</div>';
		$output .= '</div>';
		return $output;
		}
		add_shortcode( 'vc_testimonials', 'pego_testimonials_sh' );
		
		
		function pego_team_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'title' => ''
		   ), $atts ) );
	
			$id = rand(1, 10000);

			$terms = array();
	
		$output = '<div class="wpb_content_element vc_team">';

			$allTeamMembers = pego_get_all_team_members();
			$counter = 0;
			foreach($allTeamMembers as $singleTeamMember) {
				$counter++;
				$currrentMember = get_post($singleTeamMember);
				$content = $currrentMember->post_content;
				$post_thumbnail = pego_getImageBySize(array( 'post_id' => $singleTeamMember, 'thumb_size' => 'full' ));
				$thumbnail = $post_thumbnail['thumbnail'];
				$extra_class = '';
				$output .= '<div class="team-member-single">';
					$output .= '<div class="team-member-single-image">';
						$output .= $thumbnail;
					$output .= '</div>';;
					$output .= '<div class="team-member-name">'.esc_html(get_the_title($singleTeamMember)).'</div>';
					if (get_post_meta($singleTeamMember, $GLOBALS['wpcf_prefix'].'position' , true) != '') {
						$output .= '<div class="team-member-position">'.esc_html(get_post_meta($singleTeamMember, $GLOBALS['wpcf_prefix'].'position' , true)).'</div>';
					}
				$output .= '</div>';
			}
			$output .= '<div class="clear"></div>';
			$output .= '</div>';
		
	
		return $output;
		}
		add_shortcode( 'vc_team', 'pego_team_sh' );	
		


		
	function pego_socials_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'title' => ''
		), $atts));
		
		$output = '';
		if ( function_exists( 'ot_get_option' ) ) {
			if (ot_get_option('pego_socials') != '') {
				$themeSocials = ot_get_option('pego_socials');
				$output .='<div class="wpb_content_element vc_socials">';
					$output .='<ul class="theme-socials">';
						foreach ($themeSocials as $themeSocial ) {
							$output .='<li><a href="'.esc_url($themeSocial['pego_socials_url']).'" title="'.esc_attr($themeSocial['title']).'" ><i class="theme-social-icons icon-'.esc_attr($themeSocial['pego_socials_type']).'" ></i></a></li>';
						}
					$output .='</ul>';
				$output .='</div>';
			}
		}
		return $output;
	}

	add_shortcode( 'vc_socials', 'pego_socials_sh' );
		
			
	function pego_counter_sh( $atts,  $content = null ) {
	   extract( shortcode_atts( array(
		'title' => '',
		'icon' => 'fa-search',
		'counter_value' => '',
		'icon_color' => '',
		'bg_color' => '',
		'title_color' => '',
		'value_color' => ''
	   ), $atts ) );
	
		$id = rand(1, 10000);

		$terms = array();
		wp_enqueue_script('pego_counter');
		$output = '<script>
		 // start all the timers
		 jQuery(document).ready(function($){
  

			function count(options) {
				var $this = $(this);
				options = $.extend({}, options || {}, $this.data("countToOptions") || {});
				$this.countTo(options);
			  }

			if (typeof jQuery.fn.waypoint !== "undefined") {
				jQuery("#counter_'.esc_attr($id).'").waypoint(function($) {
					 jQuery("#counter_'.esc_attr($id).'").each(count);
				}, { offset: "85%" });
			}
			 });
		</script>';

		if (($icon_color != '')||($value_color != '')||($bg_color != '')||($title_color != '')) {
			$output .= '<style> ';
			if ($icon_color != '') {
				$output .= '  .counter-specific-wrapper-'.esc_attr($id).' .counter-icon-wrapper .counter-icon { color: '.esc_html($icon_color).';  } ';
			}
			if ($value_color != '') {
				$output .= '  .counter-specific-wrapper-'.esc_attr($id).' .counter_execute { color: '.esc_html($value_color).';  } ';
			}
			if ($bg_color != '') {
				$output .= '  .counter-specific-wrapper-'.esc_attr($id).'  { background-color: '.esc_html($bg_color).';  } ';
			}
			if ($title_color != '') {
				$output .= '  .counter-specific-wrapper-'.esc_attr($id).' .counter-title { color: '.esc_html($title_color).';  } ';
			}
			$output .= '</style>';
		}

		$output .='<div class="wpb_content_element counter-wrapper counter-specific-wrapper-'.esc_attr($id).'">';
			if (($icon != '')&&($icon != 'no-icon')) {
				$output .= '<div class="counter-icon-wrapper"><span class="counter-icon '.esc_attr($icon).'"></span></div>';
			}
			$output .= '<b class="counter_execute" id="counter_'.esc_attr($id).'" data-from="0" data-to="'.esc_attr($counter_value).'" data-speed="1500"></b>';
			if ($title != '') {
				$output .= '<h1 class="counter-title">'.esc_html($title).'</h1>';
			}
		$output .= '</div>';
	
	return $output;
	}

	add_shortcode( 'vc_counter', 'pego_counter_sh' );	
		
		
	function pego_maps_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'latitude' => '',
			'longitude' => '',
			'image' => '',
			'height' => "250",
			'zoom' => "11"
		), $atts));
		
			$img_id = preg_replace('/[^\d]/', '', $image);
			$link_to = wp_get_attachment_image_src( $img_id, 'full');
			$output = '<style>  .mapStyleClass { height: '.esc_attr($height).'px; }  </style>';
			$output .= '
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
				
				 <script type="text/javascript">
          		  	google.maps.event.addDomListener(window, "load", init);
					function init() {
						var mapOptions = {
							zoom: '.$zoom.',
							center: new google.maps.LatLng('.esc_attr($latitude).' , '.esc_attr($longitude).'), 
							styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
						};
						var mapElement = document.getElementById("map");
						var map = new google.maps.Map(mapElement, mapOptions);
						var image = "'.esc_url($link_to[0]).'";
						var marker = new google.maps.Marker({
							position: new google.maps.LatLng('.esc_attr($latitude).' , '.esc_attr($longitude).'),
							map: map,
							icon: image
						});
					}
        </script>
				
				
				
				';
			$output .= '<div class="wpb_content_element"><div id="map" class="mapStyleClass"></div></div>';
			return $output;
		}
	
	add_shortcode( 'vc_pego_maps', 'pego_maps_sh' );
		
		
	function pego_error_page_contruct_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'content1' => '',
			'content2' => '',
			'content3' => '',
			'buttoncaption' => '',
			'buttonurl' => ''
		), $atts));
		
		$output = '<div class="vc_error_page_contruct">';	
			$output .= '<div class="error-content1">'.$content1.'</div>';
			$output .= '<div class="error-content2">'.$content2.'</div>';
			$output .= '<div class="error-content3">'.$content3.'</div>';
			if (($buttoncaption != '') && ($buttonurl != '')) {
				$output .= '<a class="error-page-url" href="'.esc_url($buttonurl).'" title="'.esc_attr($buttoncaption).'" >'.esc_html($buttoncaption).'<a/>';	
			}
		$output .= '</div>';	
		
		return $output;
	}

	add_shortcode( 'vc_error_page_contruct', 'pego_error_page_contruct_sh' );
		
		
	function pego_welcome_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'welcome_title' => ''
		), $atts));
		
		$output = '<div class="wpb_content_element vc_welcome">';
			$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';		
		

		return $output;
		}

	add_shortcode( 'vc_welcome', 'pego_welcome_sh' );

	
	function pego_text_titles_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'title' => __("Title", "crofts"),
			'title_type' => 'h1',
			'page_title_type' => '',
			'page_title_text_heading' => '',
			'title_align' => 'left',
			'css_animation' => '',
			'subtitlebottom' => '',
			'subtitletop' => '',
			'el_class' => ''
		), $atts));
		
		$output = '';
		$extra_class = '';
		if ($subtitlebottom != '') { $extra_class = ' class="has_subtitle_bottom" '; }
		$output = '<div class="vc_titles title_align_'.esc_attr($title_align).'">';
			if ($subtitletop != '') {
				$output .= '<div class="subtitle_top">'.esc_html($subtitletop).'</div>';
			}
			$output .= '<'.esc_attr($title_type).esc_attr($extra_class).'>'.$title.'</'.esc_attr($title_type).'>';
			if ($subtitlebottom != '') {
				$output .= '<div class="subtitle_bottom">'.esc_html($subtitlebottom).'</div>';
			}
		$output .= '</div>';
	

		return $output;
		}

	add_shortcode( 'vc_text_titles', 'pego_text_titles_sh' );


	function pego_custom_titles_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'title' => __("Title", "crofts"),
			'title_type' => 'h1',
			'contentsize' => '',
			'bordershow' => '',
			'buttoncaption' => '',
			'buttonurl' => '',
			'buttonsize' => 'big',
			'align' => '',
			'el_class' => ''
		), $atts));
		
		$output = '';
		$extra_css = '';
		if ($contentsize != '') {
			$extra_css = ' style = "font-size: '.esc_attr($contentsize).'px;" ';
		}
		$output = '<div class="vc_custom_titles title_align_'.esc_attr($align).'">';
			$output .= '<'.esc_attr($title_type).'>'.esc_html($title).'</'.esc_attr($title_type).'>';
			$output .= '<p'.esc_attr($extra_css).'>'.esc_html($content).'</p>';
			if ($bordershow == 'yes') {
				$output .= '<div class="custom-title-divider"></div>';
			}
			$output .= '<div class="clear"></div>';
			if (($buttoncaption != '') && ($buttoncaption != '')) {
				$output .= '<a class="custom-title-buttom-'.esc_attr($buttonsize).'" href="'.esc_url($buttonurl).'" title="'.esc_attr($buttoncaption).'">'.esc_html($buttoncaption).'</a>';
			}
		$output .= '</div>';
	

		return $output;
		}

	add_shortcode( 'vc_custom_titles', 'pego_custom_titles_sh' );


	function pego_blockquote_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'type' => 'type1',
			'border_color' => '',
			'border_size' => '',
			'icon_image' => '',
			'background_color' => '',
			'icon_background_color' => '',
			'css_animation' => '',
			'el_class' => ''
		), $atts));



		$output = '';
		$border_css = '';

		if ($type == 'type1') {
			if (($border_size != '')||($border_color != '')) {
				$border_css .= ' style=  " ';
				if ($border_size != '') {
					$border_css .= ' border-width: '.esc_attr($border_size).'px;  ';
				}
				if ($border_color != '') {
					$border_css .= ' border-color: '.esc_attr($border_color).';  ';
				}
				$border_css .= ' " ';	
			}
		}
		if ($type == 'type2') {
			if (($background_color != '')||($icon_image != '')) {
				$border_css .= ' style=  " ';		
				if ($icon_image != '') {
					$img_id = preg_replace('/[^\d]/', '', $icon_image);
					$link_to = wp_get_attachment_image_src( $img_id, 'thumbnail');
					$border_css .= ' background: url('.esc_url($link_to[0]).') no-repeat scroll 20px center; ';
				}
				if ($background_color != '') {
					$border_css .= ' background-color: '.esc_html($background_color).';  ';
				}
				$border_css .= ' " ';	
			}
		}
		$border_css = '';
		if ($type == 'type3') {
			if (($icon_background_color != '')||($icon_image != '')) {
				$border_css .= ' style=  " ';		
				if ($icon_image != '') {
					$img_id = preg_replace('/[^\d]/', '', $icon_image);
					$link_to = wp_get_attachment_image_src( $img_id, 'thumbnail');
					$border_css .= ' background: url('.esc_url($link_to[0]).') no-repeat scroll center center; ';
				}
				if ($icon_background_color != '') {
					$border_css .= ' background-color: '.esc_html($icon_background_color).';  ';
				}
				$border_css .= ' " ';	
			}
		}

		if ($type == 'type3') {
			$output .= '<div class="blockquote wpb_content_element '.esc_attr($type).'"><div class="icon_holder"'.$border_css.'></div><p>'.wpb_js_remove_wpautop($content).'</p></div>';
		} elseif ($type == 'type4') {
			$output .= '<div class="blockquote wpb_content_element '.esc_attr($type).'"'.esc_html($border_css).'><p><span>&#8220;</span>'.wpb_js_remove_wpautop($content).'<span>&#8221;</span></p></div>';
		} else {
			$output .= '<div class="blockquote wpb_content_element '.esc_attr($type).'"'.esc_html($border_css).'><p>'.wpb_js_remove_wpautop($content).'</p></div>';
		}

		if ($type == 'type4') {
			if (($background_color != '')||($icon_image != '')) {
				$border_css .= ' style=  " ';		
				if ($icon_image != '') {
					$img_id = preg_replace('/[^\d]/', '', $icon_image);
					$link_to = wp_get_attachment_image_src( $img_id, 'thumbnail');
					$border_css .= ' background: url('.esc_url($link_to[0]).') no-repeat scroll 20px center; ';
				}
				if ($background_color != '') {
					$border_css .= ' background-color: '.esc_html($background_color).';  ';
				}
				$border_css .= ' " ';	
			}
		}

		return $output;
		}

	add_shortcode( 'vc_blockquote', 'pego_blockquote_sh' );


	function pego_circle_chart_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			  'color' => '',
			'track_color' => '',
			'value' => '',
			'type' => '',
			'icon' => '',
			'icon_color' => '',
			'icon_size' => '',
			'chart_width' => '',
			'line_width' => '',
			'description_color' => '',
			'description_size' => '',
			'description' => '',
			'percent_color' => '',
			'percent_size' => '',
			'css_animation' => '',
			'el_class' => ''
		), $atts));

		$id = rand(1, 10000);

		wp_enqueue_script('pego_chart_js');
		if ($color == '') {
			$color = get_option($pego_prefix.'main_template_color');   
		 } 

		 $output = '<div class="wpb_content_element">';	
			$output .= '<style> .chart'.esc_attr($id).' { width:'.esc_attr($chart_width).'px; height:'.esc_attr($chart_width).'px; line-height:'.esc_attr($chart_width).'px; } .chart'.esc_attr($id).' .chart-percent, .chart'.esc_attr($id).' .chart-description { line-height:'.esc_attr($chart_width).'px; }   </style>';	
			$output .= '<div data-percent="'.esc_attr($value).'" data-barsize="'.esc_attr($chart_width).'" data-linewidth="'.esc_attr($line_width).'" data-trackcolor="'.esc_attr($track_color).'" data-barcolor="'.$color.'" class="easyPieChart chart'.esc_attr($id).'">';
			if($type == 'percent' ) {
				$percent_style = '';
				if (($percent_color != '')||($percent_size != '')) {
					$percent_style .= ' style= " ';
					if ($percent_color != '') {
						$percent_style .= ' color: '.esc_html($percent_color).'; ';
					}
					if ($percent_size != '') {
						$percent_style .= ' font-size: '.esc_html($percent_size).'px; ';
					}
					$percent_style .= ' " ';
				}
				$output .= '<div class="chart-percent"'.esc_html($percent_style).'><span'.esc_html($percent_style).'>'.esc_html($value).'</span>%</div>';
			}	
			if($type == 'icon' ) {
				$icon_style = '';
				if (($icon_color != '')||($icon_size != '')) {
					$icon_style .= ' style= " ';
					if ($icon_color != '') {
						$icon_style .= ' color: '.esc_html($icon_color).'; ';
					}
					if ($icon_size != '') {
						$icon_style .= ' font-size: '.esc_html($icon_size).'px; ';
					}
					$icon_style .= ' " ';
				}
				$output .= '<div class="chart-icon chart'.esc_attr($id).' '.esc_attr($icon).'"'.$icon_style.'></div>';
			}
			if($type == 'description' ) {
				$description_style = '';
				if (($description_color != '')||($description_size != '')) {
					$description_style .= ' style= " ';
					if ($description_color != '') {
						$description_style .= ' color: '.esc_html($description_color).'; ';
					}
					if ($description_size != '') {
						$description_style .= ' font-size: '.esc_html($description_size).'px; ';
					}
					$description_style .= ' " ';
				}
				$output .= '<div class="chart-description"'.$description_style.'>'.esc_html($description).'</div>';
			}
			$output .= '</div>';
			$output .= '<div class="circle-desc">'.wpb_js_remove_wpautop($content).'</div>';	
		$output .= '</div>';
		return $output;
		}

	add_shortcode( 'vc_circle_chart', 'pego_circle_chart_sh' );


	function pego_dropcap_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'first_letter' => '',
			'first_letter_bg' => '',
			'first_letter_color' => '',
			'first_letter_size' => '',
			'type' => 'type1',
			'css_animation' => '',
			'el_class' => ''
		), $atts));

		$first_letter_css = '';
		if ($type == 'type1') {
			if (($first_letter_color != '')||($first_letter_size != '')) {
				$first_letter_css .= ' style= " ';
				if ($first_letter_color != '') {
					$first_letter_css .= ' color: '.esc_html($first_letter_color).';  ';
				}
				if ($first_letter_size != '') {
					$first_letter_css .= ' font-size: '.esc_html($first_letter_size).'px !important;  ';
				}
				$first_letter_css .= ' " ';	
			}
		}

		if ($type == 'type2') {
			if (($first_letter_bg != '')||($first_letter_color != '')||($first_letter_size != '')) {
				$first_letter_css .= ' style= " ';
				if ($first_letter_bg != '') {
					$first_letter_css .= ' background-color: '.esc_html($first_letter_bg).';  ';
				}
				if ($first_letter_color != '') {
					$first_letter_css .= ' color: '.esc_html($first_letter_color).';  ';
				}
				if ($first_letter_size != '') {
					$first_letter_css .= ' font-size: '.esc_html($first_letter_size).'px !important;  ';
				}
				$first_letter_css .= ' " ';	
			}
		}

		$output = '<div class="wpb_content_element vc_dropcap"><div class="dropcap '.esc_attr($type).'"><span class="first_letter" '.$first_letter_css.'>'.esc_html($first_letter).'</span>'.wpb_js_remove_wpautop($content).'</div></div>';

		return $output;
		}

	add_shortcode( 'vc_dropcap', 'pego_dropcap_sh' );
	
	
	
	
		
	function pego_vc_gallery_sh( $atts,  $content = null ) {
		   extract( shortcode_atts( array(
			'number_of_items' => '-1',
			'thumb_size' => 'full',
			'columns' => '2',
			'image' => ''
			
		), $atts));
		wp_enqueue_script('pego_prettyphoto');
   	    $image_ids = explode(",",$image);
   	    $random_id = rand(1, 10000);
   	 	$output = '<div class="wpb_content_element vc_gallery_items">';	
		foreach ( $image_ids as $single_image_id) {
			$link_to = wp_get_attachment_image_src( $single_image_id, 'thumbnail');
			$output .= '<div class="single-gallery-item gallery-columns'.$columns.'">';
				$full_img_url = wp_get_attachment_image_src($single_image_id,'full', true);
				$output .= '<a class="single-gallery-item no-ajaxy" href="'.esc_url($full_img_url[0]).'" data-gal="prettyPhoto[pp_gal'.esc_attr($random_id).']" >';
					$post_thumbnail = pego_getImageBySize(array( 'attach_id' => $single_image_id, 'thumb_size' => $thumb_size ));
					$thumbnail = $post_thumbnail['thumbnail'];
					$output .= $thumbnail;
					$output .= '<div class="view-overlay-icon pe-7s-plus"></div>';
					$output .= '<div class="view-overlay-bg"></div>';
				$output .= '</a>';
			$output .= '</div>';
   	    }	
			$output .= '</div>';
		
		return $output;
		}

		add_shortcode( 'vc_pego_gallery', 'pego_vc_gallery_sh' );
	


	}
}


	remove_shortcode('gallery', 'gallery_shortcode');
	add_shortcode('gallery', 'pego_gallery_shortcode_fancybox');
	function pego_gallery_shortcode_fancybox($attr) {
	global $post, $wp_locale;

$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	/**
	 * Filter the default gallery shortcode output.
	 *
	 * If the filtered output isn't empty, it will be used instead of generating
	 * the default gallery template.
	 *
	 * @since 2.5.0
	 *
	 * @see gallery_shortcode()
	 *
	 * @param string $output The gallery output. Default empty.
	 * @param array  $attr   Attributes of the gallery shortcode.
	 */
	$output = apply_filters( 'post_gallery', '', $attr );
	if ( $output != '' ) {
		return $output;
	}

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] ) {
			unset( $attr['orderby'] );
		}
	}

	$html5 = current_theme_supports( 'html5', 'gallery' );
	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => $html5 ? 'figure'     : 'dl',
		'icontag'    => $html5 ? 'div'        : 'dt',
		'captiontag' => $html5 ? 'figcaption' : 'dd',
		'columns'    => 3,
		'size'       => 'full',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery' );

	$id = intval( $atts['id'] );
	if ( 'RAND' == $atts['order'] ) {
		$atts['orderby'] = 'none';
	}

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
		}
		return $output;
	}



$output = '<div class="vc_gallery">';
	$random_id = rand(1, 10000);
	foreach ( $attachments as $id => $attachment ) {
		$output .= '<div class="column4">';
			$full_img_url = wp_get_attachment_image_src($id,'full', true);
			$output .= '<a class="no-ajaxy" href="'.esc_url($full_img_url[0]).'" rel="prettyPhoto[pp_gal'.esc_attr($random_id).']" title="'.esc_attr($attachment->post_title).'" >';
			$post_thumbnail = pego_getImageBySize(array( 'attach_id' => $id, 'thumb_size' => '350x250' ));
    		$thumbnail = $post_thumbnail['thumbnail'];
			$output .= $thumbnail;
			$output .= '</a>';
		$output .= '</div>';
	}
	$output .= '<div class="clear"></div>';
	$output .= '</div>';

	return $output;
}
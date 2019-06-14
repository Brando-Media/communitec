<?php

	global $zn_framework;
	$zn_meta_locations = array( 
		array( 	'title' =>  'Page Options', 'slug'=>'post_options', 'page'=>array('post'), 'context'=>'side', 'priority'=>'default' ),
		array( 	'title' =>  'Page Options', 'slug'=>'page_options', 'page'=>array('page'), 'context'=>'side', 'priority'=>'default' ),
		array( 	'title' =>  'Page Options', 'slug'=>'portfolio_options', 'page'=>array('portfolio'), 'context'=>'side', 'priority'=>'default' ),
		array( 	'title' =>  'Page Options', 'slug'=>'woocommerce_options', 'page'=>array('product'), 'context'=>'side', 'priority'=>'default' ),
		array( 	'title' =>  'Portfolio Item Options', 'slug'=>'portfolio_item_options', 'page'=>array('portfolio'), 'context'=>'normal', 'priority'=>'high' )
	);

	$general_options_slug = array( 'page_options' , 'portfolio_options' , 'post_options', 'woocommerce_options');

	$zn_meta_elements[] = array ( 
						'slug' 			=> array( 'portfolio_item_options'),
						'id'         	=> 'project_details',
						'name'       	=> 'Project details',
						'description' 	=> 'Here you can configure the project details.',
						'type'        	=> 'group',
						"class" 		=> 'zn_full',
						'element_title'	=> 'detail_name',
						'subelements'	=> array(
												array(
													'id'			=> 'detail_name',
													'name'			=> 'Detail name',
													'description'	=> 'Please enter a name for this detail.',
													'type'			=> 'text'
												),
												array(
													'id'			=> 'detail_value',
													'name'			=> 'Detail value',
													'description'	=> 'Please enter a value for this detail.',
													'type'			=> 'text'
												),
											)

					);

	$zn_meta_elements[] = array ( 
						'slug' 			=> array( 'portfolio_item_options'),
						'id'         	=> 'project_images',
						'name'       	=> 'Project image slider',
						'description' 	=> 'Here you can configure the project images. Please note that the first image will be the featured image ( if set )',
						'type'        	=> 'gallery',
						"class" 		=> 'zn_full'
					);

	$zn_meta_elements[] = array ( 
						'slug' 			=> array( 'portfolio_item_options'),
						'id'         	=> 'button_text',
						'name'       	=> 'Details button text',
						'description' 	=> 'Please enter a text that will appear as a button bellow the social links.',
						'type'        	=> 'text',
						'std'			=> ''
					);

	$zn_meta_elements[] = array ( 
						'slug' 			=> array( 'portfolio_item_options'),
						'id'         	=> 'button_link',
						'name'       	=> 'Details button link',
						'description' 	=> 'Here you can configure your link for the details button.',
						'type'        	=> 'link'
					);


// Page description
	$zn_meta_elements[] = array ( 
							"slug" => $general_options_slug,
							"name" => "Page description",
							"description" => "Please enter a description for your page/post",
							"id" => "zn_page_subtitle",
							"std" => "",
							"type" => "text",
							"class" => 'zn_full'
							);


// Wich sidebar position
	$zn_meta_elements[] = array ( 
							"slug" => $general_options_slug,
							"name" => "Sidebar Layout",
							"description" => "Please select the sidebar layout you want to use.",
							"id" => "zn_page_sidebar_layout",
							"std" => "defaut",
							"type" => "select",
							"options" => array( 
								'default' => 'Set in theme options', 
								'sidebar_left' => 'Left sidebar', 
								'sidebar_right' => 'Right sidebar', 
								'no_sidebar' => 'No sidebar' 
							),
							"class" => 'zn_full'
						);

// Which sidebar to display
	$sidebars = array(
		'' => 'Set in theme options',
		'default_sidebar' => 'Default Sidebar'
		);

	// Add the unlimited sidebars
	$unlimited_sidebars = zget_option( 'unlimited_sidebars' , 'unlimited_sidebars' );
	if ( is_array( $unlimited_sidebars ) ) {
		foreach ($unlimited_sidebars as $key => $value) {
			$sidebars[zn_sanitize_widget_id($value['sidebar_name'])] = $value['sidebar_name'];
		}
	}

	$zn_meta_elements[] = array ( 
							"slug" => $general_options_slug,
							"name" => "Sidebar to use?",
							"description" => "Please select the sidebar that you want to use. You can create unlimited sidebars from the admin panel.",
							"id" => "zn_page_sidebar_select",
							"std" => "defaut",
							"type" => "select",
							"options" => $sidebars,
							"class" => 'zn_full'
						);

					
	$zn_meta_elements[] = array ( 
						'slug' 			=> $general_options_slug,
						'id'         	=> 'header_style',
						'name'       	=> 'Header style',
						'description' 	=> 'Select a style for the header on this page. ',
						'std'			=> '',
						"type" => "select",
						"options" => array(
									'' => 'Set in theme options', 
									'header1' => 'Logo left, top bar hidden',
									'header2' => 'Logo left, top bar shown',
									'header3' => 'Logo center, top bar hidden',
									'header4' => 'Logo center, top bar shown',
									'header5' => 'Logo left, transparent header',
									'hidden' => '- DO NOT SHOW the header -'
								),
						"class" => 'zn_full'
					);
						

	$zn_meta_elements[] = array ( 
						'slug' 			=> $general_options_slug,
						'id'         	=> 'show_footer',
						'name'       	=> 'Footer display',
						'description' 	=> 'Choose if you want to show the main footer or not on this page. ',
						'std'			=> '',
						"type" => "select",
						"options" => array( 
							'' => 'Set in theme options',
							'show_footer' => 'Show footer',
							'hide_footer' => 'Hide footer'
						),
						"class" => 'zn_full'
					);

/////////////////////////////////////////////////
// Title bar OPTIONS
	$zn_meta_elements[] = array ( 
						'slug' 			=> $general_options_slug,
						'id'         	=> 'title_bar_display',
						'name'       	=> 'Title bar display',
						'description' 	=> 'Choose how the title bar should be displayed. ',
						'std'			=> '',
						"type" => "select",
						"options" => array( 
							'' => 'Set in theme options', 
							'default_title_bar' => 'Default title bar',
							'bg_title_left' => 'Title and description on left / with background image',
							// 'bg_title_right' => 'Title and description on right / with background image',
							'bg_title_center' => 'Title and description centered / with background image'
						),
						"class" => 'zn_full'
					);

// Header color style
$zn_meta_elements[] = array(
	'slug' 			=> $general_options_slug,
	'id'          => 'header_ustyle',
	'name'        => 'Color Style',
	'std'         => '',
	'description' => 'Using this option you can use a style that was created using the custom colors option from the theme options panel.',
	'type'        => 'select',
	'options'	  => $zn_framework->unlimited_styles(),
	'dependency'	=> array( 'element' => 'title_bar_display' , 'value'=> array('bg_title_left','bg_title_right', 'bg_title_center', 'default_title_bar' ) ),
	"class" => 'zn_full'
);

$zn_meta_elements[] = array ( 
	'slug' 			=> $general_options_slug,
	'id'         	=> 'show_breadcrumb',
	'name'       	=> 'Show breadcrumbs ?',
	'description' 	=> 'Using this option you can choose if you want to show the breadcrumbs or not.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> 'yes',
	'dependency'	=> array( 'element' => 'title_bar_display' , 'value'=> array('bg_title_left','bg_title_right', 'bg_title_center', 'default_title_bar' ) ),
						"class" => 'zn_full'
);

// Logo option
$zn_meta_elements[] = array(
	'slug' 			=> $general_options_slug,
	'id'          => 'title_bar_bg',
	'name'        => 'Background image',
	'description' => 'Choose a background image for the subheader.',
	'type'        => 'background',
	'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
	'class'		  => 'zn_full',
	'std'		  => false,
	'dependency'	=> array( 'element' => 'title_bar_display' , 'value'=> array('bg_title_left','bg_title_right', 'bg_title_center', 'default_title_bar' ) ),
);

//////// END Title bar options ///////

?>

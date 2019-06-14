<?php

/*--------------------------------------------------------------------------------------------------

	File: theme-options.php

	Description: This file contains all the theme's admin panel options

--------------------------------------------------------------------------------------------------*/

global $zn_framework;

/*--------------------------------------------------------------------------------------------------
	Start General Options
--------------------------------------------------------------------------------------------------*/
$admin_options = array();

// Logo option
$admin_options[] = array(
	'slug'        => 'general_options',
	'parent'      => 'general_options',
	'id'          => 'logo',
	'name'        => 'Logo setup',
	'description' => 'Choose a logo for your site.',
	'type'        => 'media',
	'class'		  => 'zn_full',
	'std'		  => THEME_BASE_URI .'/images/logo.png'
);

$admin_options[] = array(
	'slug'        => 'general_options',
	'parent'      => 'general_options',
	'id'          => 'transparent_logo',
	'name'        => 'Transparent header logo',
	'description' => 'Choose a logo for your transparent header (select it in Header layout options).',
	'type'        => 'media',
	'class'		  => 'zn_full',
	'std'		  => THEME_BASE_URI .'/images/logo-transparent.png'
);

$admin_options[] = array ( 
	'slug'			=> 'general_options',
	'parent'     	=> 'general_options',
	'id'         	=> 'use_boxed_layout',
	'name'       	=> 'Use boxed layout',
	'description' 	=> 'Check if you want to use the boxed layout. Leave unchecked for the full width layout.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> ''
);

// Boxed background option
$admin_options[] = array(
	'slug'        => 'general_options',
	'parent'      => 'general_options',
	'id'          => 'boxed_bg',
	'name'        => 'Boxed layout background',
	'description' => 'Choose a background for the box layout.',
	'type'        => 'background',
	'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
	'class'		  => 'zn_full',
	'std'		  => '',
	'dependency'	=> array( 'element' => 'use_boxed_layout' , 'value'=> array('yes') ),
);

$admin_options[] = array ( 
	'slug' => 'general_options',
	'parent'      => 'general_options',
	'id'         	=> 'show_preloader',
	'name'       	=> 'Show page preloader',
	'description' 	=> 'Select if you want to show a page preloader.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> ''
);

// Logo option
$admin_options[] = array(
	'slug'        => 'general_options',
	'parent'      => 'general_options',
	'id'          => 'preloader_image',
	'name'        => 'Preloader image',
	'description' => 'Choose the preloader GIF image. If you leave this field empty, the default preloader image will be used.',
	'type'        => 'media',
	'class'		  => 'zn_full',
	'std'		  => THEME_BASE_URI .'/images/preload.gif',
	'dependency'	=> array( 'element' => 'show_preloader' , 'value'=> array('yes') ),
);

$admin_options[] = array ( 
	'slug' => 'general_options',
	'parent'      => 'general_options',
	'id'         	=> 'show_backtotop',
	'name'       	=> 'Show back to top ?',
	'description' 	=> 'Select if you want to show the back to top button in the footer.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> 'yes'
);

/*--------------------------------------------------------------------------------------------------
	Start Favicons Options
--------------------------------------------------------------------------------------------------*/
// Normal favicon
$admin_options[] = array(
	'slug'        => 'favicons_options',
	'parent'      => 'general_options',
	'id'          => 'favicon',
	'name'        => 'Default favicon',
	'description' => 'Choose a favicon for your site.',
	'type'        => 'media',
	'class'		  => 'zn_full',
	'std'		  => ''
);
// iPhone favicon
$admin_options[] = array(
	'slug'        => 'favicons_options',
	'parent'      => 'general_options',
	'id'          => 'iphonefavicon',
	'name'        => 'iPhone favicon',
	'description' => 'Choose an iPhone favicon for your site (this image should have 57x57px).',
	'type'        => 'media',
	'class'		  => 'zn_full',
	'std'		  => ''
);

// iPhone Hi-Res favicon
$admin_options[] = array(
	'slug'        => 'favicons_options',
	'parent'      => 'general_options',
	'id'          => 'iphonehrfavicon',
	'name'        => 'iPhone Hi-Res favicon',
	'description' => 'Choose an iPhone Hi-Res favicon for your site (this image should have 114x114px).',
	'type'        => 'media',
	'class'		  => 'zn_full',
	'std'		  => ''
);

// iPad favicon
$admin_options[] = array(
	'slug'        => 'favicons_options',
	'parent'      => 'general_options',
	'id'          => 'ipadfavicon',
	'name'        => 'iPad favicon',
	'description' => 'Choose an iPad favicon for your site (this image should have 72x72px).',
	'type'        => 'media',
	'class'		  => 'zn_full',
	'std'		  => ''
);

// iPad Hi-Res favicon
$admin_options[] = array(
	'slug'        => 'favicons_options',
	'parent'      => 'general_options',
	'id'          => 'ipadhrfavicon',
	'name'        => 'iPad Hi-Res favicon',
	'description' => 'Choose an iPad Hi-Res favicon for your site (this image should have 144x144px).',
	'type'        => 'media',
	'class'		  => 'zn_full',
	'std'		  => ''
);

/////////////////////////////////////////////////
// HIDDEN BAR

$admin_options[] = array ( 
	'slug' => 'hidden_bar',
	'parent'      => 'general_options',
	'id'         	=> 'show_hiddenbar',
	'name'       	=> 'Show sliding panel (hidden on top of the page)',
	'description' 	=> 'Choose if you want to show the top hidden bar.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> 'yes'
);

// Header height
$admin_options[] = array(
	'slug'        => 'hidden_bar',
	'parent'      => 'general_options',
	'id'          => 'hiddenbar_width',
	'name'        => 'Hidden bar width',
	'description' => 'Using this option, you can control the width of each element in the hidden bar.',
	'type'        => 'slider',
	'class'		  => 'zn_full',
	'std'        => '9',
	'dependency'	=> array( 'element' => 'show_hiddenbar' , 'value'=> array('yes') ),
	'helpers'	  => array(
		'min' => '0',
		'max' => '12'
		)
);

$admin_options[] = array(
	'slug'			=> 'hidden_bar',
	'parent'		=> 'general_options',
	'id'			=> 'hiddenbar_icon_list',
	'name'			=> 'Icon list',
	'description'	=> 'You can add here an icon list to display on the left side of the sliding panel.',
	'type'			=> 'group',
	'dependency'	=> array( 'element' => 'show_hiddenbar' , 'value'=> array('yes') ),
	'element_title'			=> 'text',
	'subelements'	=> array(
							array(
								'id'			=> 'icon',
								'name'			=> 'Icon',
								'description'	=> 'Select an icon for this element',
								'type'			=> 'icon_list',
								'class'			=> 'zn_full',
							),
							array (
								'id'			=> 'text',
								'name'			=> 'Text',
								'description'	=> 'Enter a text for this element',
								'type'			=> 'text'
							),
							array (
								'id'			=> 'link',
								'name'			=> 'Text link',
								'description'	=> 'Enter a link for this element',
								'type'			=> 'link'
							)
						)
);

$admin_options[] = array(
	'slug'			=> 'hidden_bar',
	'parent'		=> 'general_options',
	'id'			=> 'hiddenbar_social',
	'name'			=> 'Social list',
	'description'	=> 'You can add here a social icon list to display on the right side of the sliding panel.',
	'type'			=> 'group',
	'dependency'	=> array( 'element' => 'show_hiddenbar' , 'value'=> array('yes') ),
	'element_title'			=> 'Social icon',
	'subelements'	=> array(
							array(
								'id'			=> 'icon',
								'name'			=> 'Icon',
								'description'	=> 'Select an icon to display',
								'type'			=> 'icon_list',
								'class'			=> 'zn_full',
							),
							array (
								'id'			=> 'social_link',
								'name'			=> 'Button link',
								'description'	=> 'Enter a link for this element',
								'type'			=> 'link'
							),
							array(
								'id'			=> 'hover_color',
								'name'			=> 'Hover color',
								'description'	=> 'Select a hover color for this element',
								'type'			=> 'colorpicker',
								'std'			=> ''
							)
						)
);

// END HIDDEN BAR
/////////////////////////////////////////////////

/////////////////////////////////////////////////
// HEADER OPTIONS

// Header style
$admin_options[] = array(
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	'id'          => 'header_layout',
	'name'        => 'Header layout',
	'description' => 'Here you can choose the desired header layout.',
	'type'        => 'select',
	'std'        => 'header1',
	'options'        => array(
			'header1' => 'Logo left, top bar hidden',
			'header2' => 'Logo left, top bar shown',
			'header3' => 'Logo center, top bar hidden',
			'header4' => 'Logo center, top bar shown',
			'header5' => 'Logo left, transparent header',
		)
);

// Scrolling header layout
$admin_options[] = array(
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	'id'          => 'scroll_header_layout',
	'name'        => 'Scrolling header layout',
	'description' => 'Here you can choose the desired header layout while scrolling down the page.',
	'type'        => 'select',
	'std'        => 'zn_hide_show',
	'options'        => array(
			'zn_do_not_follow zn_do_not_hide' => 'Keep header on top - Don\'t show header on scrolling',
			'zn_do_not_hide' => 'Keep header on top',
			'zn_do_not_hide_small' => 'Keep header on top smaller',
			'zn_hide_show' => 'Hide on down scrolling, show on up scrolling',
		)
);

// Header height
$admin_options[] = array(
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	'id'          => 'header_height',
	'name'        => 'Logo height',
	'description' => 'Here you can enter your desired height for the logo (default is 102).',
	'type'        => 'slider',
	'class'		  => 'zn_full',
	'std'        => '102',
	'helpers'	  => array(
		'min' => '50',
		'max' => '300'
		)
);

// Header height
$admin_options[] = array(
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	'id'          => 'header_res_width',
	'name'        => 'Header responsive width',
	'description' => 'Choose the desired width when the responsive menu should appear.',
	'type'        => 'slider',
	'class'		  => 'zn_full',
	'std'        => '994',
	'helpers'	  => array(
		'min' => '50',
		'max' => '1200'
		)
);

$admin_options[] = array ( 
	'slug' => 'header_options',
	'parent'      => 'general_options',
	'id'         	=> 'show_search_icon',
	'name'       	=> 'Show search icon ?',
	'description' 	=> 'Select if you want to show the search icon or not.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> 'yes'
);

/////// WPML ///////
if ( function_exists('icl_object_id') ) {
	$admin_options[] = array ( 
		'slug' => 'header_options',
		'parent'      => 'general_options',
		'id'         	=> 'show_wpml_switcher',
		'name'       	=> 'Show WPML language switcher ?',
		'description' 	=> 'Choose if you want to show WPML language switcer.',
		'type'        	=> 'toggle2',
		'value'			=> 'yes',
		'std'			=> 'yes'
	);
}

/////// Infocard ///////
$admin_options[] = array ( 
	'slug' => 'header_options',
	'parent'      => 'general_options',
	'id'         	=> 'show_infocard',
	'name'       	=> 'Show info card?',
	'description' 	=> 'Choose if you want to show the info when hovering the logo.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> 'yes'
);

$admin_options[] = array ( 
	'slug' => 'header_options',
	'parent'      => 'general_options',
	'id'         	=> 'show_infocard_hover',
	'name'       	=> 'Show info card hover image?',
	'description' 	=> 'Choose if you want to show the info hover image next to the logo.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> 'yes',
	'dependency' => array( 'element' => 'show_infocard' , 'value'=> array('yes') )
);

$admin_options[] = array(
	'slug'        => 'header_options',
	'parent'      => 'general_options',
	'id'          => 'infocard_logo',
	'name'        => 'Infocard image',
	'description' => 'Choose an image to show in the info card.',
	'type'        => 'media',
	'class'		  => 'zn_full',
	'std'		  => THEME_BASE_URI .'/images/info-logo.png',
	'dependency' => array( 'element' => 'show_infocard' , 'value'=> array('yes') )
);

$admin_options[] = array(
	'slug'			=> 'header_options',
	'parent'		=> 'general_options',
	'id'			=> 'infocard_left',
	'name'			=> 'Infocard left description',
	'description'	=> 'Enter a text to show on the left side of the infocard (you can use HTML)',
	'type'			=> 'textarea',
	'std'			=> 'CleanLab is Multi Purpose & Responsive It&rsquo;s Suitable for Corporate, Creative, Personal, Noncommercial Needs',
	'dependency'	=> array( 'element' => 'show_infocard' , 'value'=> array('yes') )
);

$admin_options[] = array(
	'slug'			=> 'header_options',
	'parent'		=> 'general_options',
	'id'			=> 'infocard_right',
	'name'			=> 'Infocard right description',
	'description'	=> 'Enter a text to show on the right side of the infocard (you can use HTML)',
	'type'			=> 'textarea',
	'std'			=> '',
	'dependency'	=> array( 'element' => 'show_infocard' , 'value'=> array('yes') )
);

$admin_options[] = array(
	'slug'			=> 'header_options',
	'parent'		=> 'general_options',
	'id'			=> 'infocard_social',
	'name'			=> 'Social list',
	'description'	=> 'You can add here a social icon list to display in the infocard.',
	'type'			=> 'group',
	'dependency'	=> array( 'element' => 'show_infocard' , 'value'=> array('yes') ),
	'element_title'			=> 'Social icon',
	'subelements'	=> array(
							array(
								'id'			=> 'icon',
								'name'			=> 'Icon',
								'description'	=> 'Select an icon to display',
								'type'			=> 'icon_list',
								'class'			=> 'zn_full',
							),
							array (
								'id'			=> 'social_link',
								'name'			=> 'Button link',
								'description'	=> 'Enter a link for this element',
								'type'			=> 'link'
							)
						)
);
//////// END Infocard ///////

/////////////////////////////////////////////////
// Title bar OPTIONS
// Header Layout style
$admin_options[] = array(
	'slug'        => 'title_bar_options',
	'parent'      => 'general_options',
	'id'          => 'title_bar_display',
	'name'        => 'Layout Style',
	'std'         => '',
	'description' => 'Using this option you can choose how the sub-headers will be displayed.',
	'type'        => 'select',
	'options'	  => array(
		'default_title_bar' => 'Default title bar',
		'bg_title_left' => 'Title and description on left / with background image',
		// 'bg_title_right' => 'Title and description on right / with background image',
		'bg_title_center' => 'Title and description centered / with background image',
	)
);

// Header color style
$admin_options[] = array(
	'slug'        => 'title_bar_options',
	'parent'      => 'general_options',
	'id'          => 'header_ustyle',
	'name'        => 'Color Style',
	'std'         => '',
	'description' => 'Using this option you can use a style that was created using the custom colors option from the theme options panel.',
	'type'        => 'select',
	'options'	  => $zn_framework->unlimited_styles()
);

$admin_options[] = array (
	'slug'			=> 'title_bar_options',
	'parent'     	=> 'general_options',
	'id'         	=> 'show_breadcrumb',
	'name'       	=> 'Show breadcrumbs ?',
	'description' 	=> 'Using this option you can choose if you want to show the breadcrumbs or not.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> 'yes'
);

// Logo option
$admin_options[] = array(
	'slug'        => 'title_bar_options',
	'parent'      => 'general_options',
	'id'          => 'title_bar_bg',
	'name'        => 'Background image',
	'description' => 'Choose a background image for the subheader.',
	'type'        => 'background',
	'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
	'class'		  => 'zn_full',
	'std'		  => array( 'image' => THEME_BASE_URI .'/images/page-header.jpg' )
);

$admin_options[] = array(
	'slug'        => 'title_bar_options',
	'parent'      => 'general_options',
	'id'          => 'hide_title_bar',
	'name'        => 'Hide title bar',
	'description' => 'Select the pages on which you wish to hide the title bar.',
	'type'        => 'checkbox',
	'options' 	  => get_post_types(array('show_ui' => true)),
	'std'		  => '',
	'class'		  => 'zn_full'
);

/////////////////////////////////////////////////
// FOOTER OPTIONS


$admin_options[] = array ( 
					'slug'        => 'footer_options',
					'parent'      => 'general_options',
					'id'         	=> 'show_footer',
					'name'       	=> 'Show footer',
					'description' 	=> 'Choose if you want to show the main footer or not on this page. ',
					'std'			=> 'defaut',
					"type" => "select",
					"options" => array( 'show_footer' => 'Show footer' , 'hide_footer' => 'Hide footer' )
				);

// Footer Widgets rows
$admin_options[] = array(
	'slug'        => 'footer_options',
	'parent'      => 'general_options',
	'id'          => 'footer_columns',
	'name'        => 'Footer Widgets Columns',
	'description' => 'Here you can select how many widget columns you want to use for the footer.',
	'type'        => 'slider',
	'std'		  => '4',
	'class'		  => 'zn_full',
	'helpers'	  => array(
		'min' => '0',
		'max' => '4'
		),
	'dependency'	=> array( 'element' => 'show_footer' , 'value'=> array('show_footer' ) ),
);



/////////////////////////////////////////////////
// NEWS BAR

$admin_options[] = array ( 
	'slug'			=> 'news_bar',
	'parent'		=> 'general_options',
	'id'         	=> 'news_date',
	'name'       	=> 'News date',
	'description' 	=> 'Choose a date for this news.',
	'type'        	=> 'date_picker',
	'value'			=> '',
	'std'			=> ''
);

$admin_options[] = array ( 
	'slug'			=> 'news_bar',
	'parent'		=> 'general_options',
	'id'         	=> 'news_text',
	'name'       	=> 'News text',
	'description' 	=> 'Enter a text for this news.',
	'type'        	=> 'text',
	'value'			=> '',
	'std'			=> ''
);

$admin_options[] = array(
	'slug'        => 'news_bar',
	'parent'      => 'general_options',
	'id'          => 'show_news_bar',
	'name'        => 'Show news bar',
	'description' => 'Select the pages on which you wish to display the news bar.',
	'type'        => 'checkbox',
	'options' 	  => get_post_types(array('show_ui' => true)),
	'std'		  => '',
	'class'		  => 'zn_full'
);

// END NEWS BAR
///////////////////////////////////////////////////////

///////////////////////////////////////////////////////
// API Keys

/* MAILCHIMP API SETTINGS */
$admin_options[] = array(
	'slug'        => 'api_keys_options',
	'parent'      => 'general_options',
	'id'          => 'mailchimp_api',
	'name'        => 'Mailchimp api key',
	'description' => 'Please insert your <a href="http://kb.mailchimp.com/article/where-can-i-find-my-api-key" target="_blank">mailchimp api key.</a>',
	'type'        => 'text'
);

/* Google Analytics SETTINGS */
$admin_options[] = array(
	'slug'        => 'api_keys_options',
	'parent'      => 'general_options',
	'id'          => 'google_analytics',
	'name'        => 'Google Analytics',
	'description' => 'Please enter your Google Analytics Tracking ID ( a string similar to : "UA-XXXXXXXX-X" )',
	'type'        => 'text'
);

// END API Keys
///////////////////////////////////////////////////////

///////////////////////////////////////////////////////
// GOOGLE FONTS

// Google fonts
$admin_options[] = array(
	'slug'        => 'gfont_setup',
	'parent'      => 'google_font_options',
	'id'          => 'zn_google_fonts_setup',
	'name'        => 'Google Fonts Setup',
	'description' => 'Here you can setup the <a href="https://www.google.com/fonts" target="blank">Google web fonts</a> that you want to use in your site.',
	'type'        => 'zn_google_fonts_setup',
	'std'		  => array (
					'Roboto' => array (
						'font_family' => 'Roboto',
						'font_variants' => array (
							0 => 'regular',
							1 => '300',
							2 => '700',
							3 => '900',
						),
					),
				),
	'class'		  => 'zn_full'
);

// General fonts subset
$admin_options[] = array(
	'slug'        => 'gfont_setup',
	'parent'      => 'google_font_options',
	'id'          => 'zn_google_fonts_subsets',
	'name'        => 'Google Fonts Subset',
	'description' => 'Select which subsets you want to load for the Google fonts.',
	'type'        => 'checkbox',
	'options' 	  => array(
			'latin' => 'Latin',
			'latin-ext' => 'Latin Ext',
			'greek' => 'Greek',
			'cyrillic' => 'Cyrillic',
			'cyrillic-ext' => 'Cyrillic Ext',
			'khmer' => 'Khmer',
			'greek-ext' => 'Greek Ext',
			'vietnamese' => 'Vietnamese'
		),
	'std'		  => '',
	'class'		  => 'zn_full'
);

// Custom fonts subset
$admin_options[] = array(
    'slug'        => 'custom_font_setup',
    'parent'      => 'google_font_options',
    'id'          => 'zn_custom_fonts',
    'name'        => 'Custom Fonts Setup',
    'description' => 'Using this option you can add your own custom fonts to the theme.',
    'type'        => 'group',
    'subelements' => array (
        array (
            "name"        => __( "Font Name", 'zn_framework' ),
            "description" => __( "Here you can type the font name that will be used.", 'zn_framework' ),
            "id"          => "cf_name",
            "std"         => '',
            "type"        => "text",
        ),
        array (
            "name"        => __( "Custom font .woff", 'zn_framework' ),
            "description" => __( "Upload the .woff font file.", 'zn_framework' ),
            "id"          => "cf_woff",
            "std"         => '',
            "type"        => "zn_media",
            'data'        => array(
                'button_title' => 'Add .woff font',
                'media_type' => 'media_field_upload', // The text that will appear on the inser button from the media manager
                'insert_title' => 'Select font', // The text that will appear on the inser button from the media manager
                'title' => 'Add Custom Font', // The text that will appear as the main option button for adding images
                'type' => 'application/font-woff', // The media type : image, video, etc
                'state' => 'library', // The media manager state
                'frame' => 'select', // The media manager frame - can be select, post, manage, image, audio, video, edit-attachments
                'class' => 'zn-media-video media-frame', // A css class that will be applied to the modal
                'value_type' => 'url', // The media manager state
                'preview' => 'text'
            ),

        ),
        array (
            "name"        => __( "Custom font .ttf", 'zn_framework' ),
            "description" => __( "Upload the .ttf font file.", 'zn_framework' ),
            "id"          => "cf_ttf",
            "std"         => '',
            "type"        => "zn_media",
            'data'        => array(
                'button_title' => 'Add .ttf font',
                'media_type' => 'media_field_upload', // The text that will appear on the inser button from the media manager
                'insert_title' => 'Select font', // The text that will appear on the inser button from the media manager
                'title' => 'Add Custom Font', // The text that will appear as the main option button for adding images
                'type' => 'font/ttf', // The media type : image, video, etc
                'state' => 'library', // The media manager state
                'frame' => 'select', // The media manager frame - can be select, post, manage, image, audio, video, edit-attachments
                'class' => 'zn-media-video media-frame', // A css class that will be applied to the modal
                'value_type' => 'url', // The media manager state
                'preview' => 'text'
            )
        ),
        array (
            "name"        => __( "Custom font .svg", 'zn_framework' ),
            "description" => __( "Upload the .svg font file.", 'zn_framework' ),
            "id"          => "cf_svg",
            "std"         => '',
            "type"        => "zn_media",
            'data'        => array(
                'button_title' => 'Add .svg font',
                'media_type' => 'media_field_upload', // The text that will appear on the inser button from the media manager
                'insert_title' => 'Select font', // The text that will appear on the inser button from the media manager
                'title' => 'Add Custom Font', // The text that will appear as the main option button for adding images
                'type' => 'image/svg+xml', // The media type : image, video, etc
                'state' => 'library', // The media manager state
                'frame' => 'select', // The media manager frame - can be select, post, manage, image, audio, video, edit-attachments
                'class' => 'zn-media-video media-frame', // A css class that will be applied to the modal
                'value_type' => 'url', // The media manager state
                'preview' => 'text'
            )
        ),
        array (
            "name"        => __( "Custom font .eot", 'zn_framework' ),
            "description" => __( "Upload the .eot font file.", 'zn_framework' ),
            "id"          => "cf_eot",
            "std"         => '',
            "type"        => "zn_media",
            'data'        => array(
                'button_title' => 'Add .eot font',
                'media_type' => 'media_field_upload', // The text that will appear on the inser button from the media manager
                'insert_title' => 'Select font', // The text that will appear on the inser button from the media manager
                'title' => 'Add Custom Font', // The text that will appear as the main option button for adding images
                'type' => 'application/vnd.ms-fontobject', // The media type : image, video, etc
                'state' => 'library', // The media manager state
                'frame' => 'select', // The media manager frame - can be select, post, manage, image, audio, video, edit-attachments
                'class' => 'zn-media-video media-frame', // A css class that will be applied to the modal
                'value_type' => 'url', // The media manager state
                'preview' => 'text'
            )
        ),
    ),
);



// END GOOGLE FONTS
///////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////
// 
$fonts = zn_get_fonts();

// Body fonts
$admin_options[] = array(
	'slug'        => 'general_fonts',
	'parent'      => 'font_options',
	'id'          => 'body_fonts',
	'name'        => 'Main body font',
	'description' => 'Here you can set-up the main theme font.',
	'type'        => 'select',
	'std'        => 'Roboto',
	'options'        => $fonts
);

$admin_options[] = array(
	'slug'        => 'general_fonts',
	'parent'      => 'font_options',
	'id'          => 'header_fonts',
	'name'        => 'Header font',
	'description' => 'Here you can set-up the font that will be used by the header.',
	'type'        => 'select',
	'std'        => 'Roboto',
	'options'        => $fonts
);

/*--------------------------------------------------------------------------------------------------
	Unlimited Sidebars
--------------------------------------------------------------------------------------------------*/
// Unlimited Sidebars

$admin_options[] = array(
	'slug'        	=> 'unlimited_sidebars', // subpage
	'parent'     	=> 'unlimited_sidebars', // master page
	'id'         	=> 'unlimited_sidebars',
	'name'       	=> 'Unlimited Sidebars',
	'description' 	=> 'Here you can create unlimited sidebars that you can use all over the theme.',
	'type'        	=> 'group',
	'sortable'	  	=> false,
	'element_title' => 'sidebar_name',
	'subelements' 	=> array( 
							array(
								'id'          => 'sidebar_name',
								'name'        => 'Sidebar Name',
								'description' => 'Please enter a name for this sidebar. Please note that the name should only contain alphanumeric characters',
								'type'        => 'text',
								'supports'	  => 'block'
							),
					)
);

// Sidebars settings
$sidebar_options = array( 'sidebar_right' => 'Right sidebar' , 'sidebar_left' => 'Left sidebar' , 'no_sidebar' => 'No sidebar' );
$admin_options[] = array(
	'slug'        => 'sidebar_settings',
	'parent'      => 'unlimited_sidebars',
	'id'          => 'archive_sidebar',
	'name'        => 'Sidebar on archive pages',
	'description' => 'Please choose the sidebar position for the archive pages.',
	'type'        => 'sidebar',
	'class'		=> 'zn_full',
	'std'		=> array (
		'layout' => 'sidebar_right',
		'sidebar' => 'default_sidebar',
	)
);

$admin_options[] = array(
	'slug'        => 'sidebar_settings',
	'parent'      => 'unlimited_sidebars',
	'id'          => 'blog_sidebar',
	'name'        => 'Sidebar on Blog',
	'description' => 'Please choose the sidebar position for the blog page.',
	'type'        => 'sidebar',
	'class'		=> 'zn_full',
	'std'		=> array (
		'layout' => 'sidebar_right',
		'sidebar' => 'default_sidebar',
	)
);

$admin_options[] = array(
	'slug'        => 'sidebar_settings',
	'parent'      => 'unlimited_sidebars',
	'id'          => 'single_sidebar',
	'name'        => 'Sidebar on single blog post',
	'description' => 'Please choose the sidebar position for the single blog posts.',
	'type'        => 'sidebar',
	'class'		=> 'zn_full',
	'std'		=> array (
		'layout' => 'sidebar_right',
		'sidebar' => 'default_sidebar',
	)
);

$admin_options[] = array(
	'slug'        => 'sidebar_settings',
	'parent'      => 'unlimited_sidebars',
	'id'          => 'page_sidebar',
	'name'        => 'Sidebar on pages',
	'description' => 'Please choose the sidebar position for the pages.',
	'type'        => 'sidebar',
	'class'		=> 'zn_full',
	'std'		=> array (
		'layout' => 'sidebar_right',
		'sidebar' => 'default_sidebar',
	)
);

/*-----------------------------------------------------
*	COLOR settings
*----------------------------------------------------*/

//** HEADER colors
$admin_options[] = array(
	'slug'        => 'header_colors',
	'parent'      => 'style_options',
	'id'          => 'sliding_background',
	'name'        => 'Sliding panel background',
	'description' => 'This color will be used as background color for sliding panel, info card and back to top button.',
	'type'        => 'colorpicker',
	'std'		  => '#ff525e'
);

$admin_options[] = array(
	'slug'        => 'header_colors',
	'parent'      => 'style_options',
	'id'          => 'sliding_color',
	'name'        => 'Sliding panel color',
	'description' => 'This color will be used as main color for sliding panel, info card and back to top button.',
	'type'        => 'colorpicker',
	'std'		  => '#FFFFFF'
);

$admin_options[] = array(
	'slug'        => 'header_colors',
	'parent'      => 'style_options',
	'id'          => 'menu_background',
	'name'        => 'Menu background',
	'description' => 'This color will be used as background color for the menu.',
	'type'        => 'colorpicker',
	'std'		  => '#FFFFFF'
);

$admin_options[] = array(
	'slug'        => 'header_colors',
	'parent'      => 'style_options',
	'id'          => 'menu_color',
	'name'        => 'Menu color',
	'description' => 'This color will be used for the main menu items.',
	'type'        => 'colorpicker',
	'std'		  => '#bababa'
);

$admin_options[] = array ( 
	'slug'			=> 'header_colors',
	'parent'		=> 'style_options',
	'id'         	=> 'autogenerate_menu_colors',
	'name'       	=> 'Autogenerate colors?',
	'description' 	=> 'Choose if you want to autogenerate the rest of the colors starting from the menu color.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> 'yes'
);

$admin_options[] = array(
	'slug'        => 'header_colors',
	'parent'      => 'style_options',
	'id'          => 'menu_hover_color',
	'name'        => 'Menu hover color',
	'description' => 'This color will be used for the main menu hovered items and all submenu items.',
	'type'        => 'colorpicker',
	'std'		  => '#3d3d3d',
	'dependency'	=> array( 'element' => 'autogenerate_menu_colors' , 'value'=> array('','zn_dummy_value') ),
);

$admin_options[] = array(
	'slug'        => 'header_colors',
	'parent'      => 'style_options',
	'id'          => 'menu_subitems_background',
	'name'        => 'Menu subitems background',
	'description' => 'This color will be used as background color for the submenu items.',
	'type'        => 'colorpicker',
	'std'		  => '#fafafa',
	'dependency'	=> array( 'element' => 'autogenerate_menu_colors' , 'value'=> array('','zn_dummy_value') ),
);

$admin_options[] = array(
	'slug'        => 'header_colors',
	'parent'      => 'style_options',
	'id'          => 'menu_active_background',
	'name'        => 'Active Menu background',
	'description' => 'This color will be used as background color for the active submenu item.',
	'type'        => 'colorpicker',
	'std'		  => '#f4f4f4',
	'dependency'	=> array( 'element' => 'autogenerate_menu_colors' , 'value'=> array('','zn_dummy_value') ),
);

$admin_options[] = array(
	'slug'        => 'header_colors',
	'parent'      => 'style_options',
	'id'          => 'menu_border_color',
	'name'        => 'Menu border color',
	'description' => 'This color will be used for borders between submenu items.',
	'type'        => 'colorpicker',
	'std'		  => '#eee',
	'dependency'	=> array( 'element' => 'autogenerate_menu_colors' , 'value'=> array('','zn_dummy_value') ),
);

///////////////////////////
//** UNLIMITED COLORS
// USE PRINT_ARRAY IN FUTURE EXPORTS
$default_colors = array(
						array(
							'name' => 'Default Colors',
							'id'   => 'zn_default_colors',
							'std'  => array( 
								'custom_style_name' => 'Default Colors',
								)
						)
				);

$saved_colors = array(
		array( 
								'custom_style_name' => 'Default Colors',
								'primary_color' => '#ff525e',
								'secondary_color' => '#3d3d3d',
								'alternative_color' => '#ffffff',
								'section_background' => '#ffffff',
								'section_alt_background' => '#fafafa',
								'text_color' => '#a1a1a1',
								'borders_color' => '#e5e4e4'
								)
	);

$admin_options[] = array(
	'slug'        	=> 'custom_colors', // subpage
	'parent'     	=> 'style_options', // master page
	'id'         	=> 'custom_colors',
	'name'       	=> 'Unlimited colors',
	'description' 	=> 'Here you can create unlimited color styles that you can apply to each section.',
	'type'        	=> 'group',
	'sortable'	  	=> false,
	'std'	  	=> $saved_colors,
	'default_std' => $default_colors,
	'element_title' => 'custom_style_name',
	'subelements' 	=> array( 
							array(
								'id'          => 'custom_style_name',
								'name'        => 'Style Name',
								'description' => 'Please enter a name for this style. Please note that the name should be unique and can only contain alphanumeric characters',
								'type'        => 'text',
								'supports'	  => 'block'
							),
							array(
								'id'          => 'primary_color',
								'name'        => 'Primary color',
								'description' => 'This color will be used as primary color for the section.',
								'type'        => 'colorpicker',
								'std'		  => '#ed2437'
							),
							array(
								'id'          => 'secondary_color',
								'name'        => 'Secondary color',
								'description' => 'This color will be used as secondary color (titles, headings, links).',
								'type'        => 'colorpicker',
								'std'		  => '#000000'
							),
							array(
								'id'          => 'alternative_color',
								'name'        => 'Alternative color',
								'description' => 'This color will be used as alternative color (usually when in conjunction with primary color).',
								'type'        => 'colorpicker',
								'std'		  => '#ffffff'
							),
							array(
								'id'          => 'section_background',
								'name'        => 'Background color',
								'description' => 'This color will be used as background for the section.',
								'type'        => 'colorpicker',
								'std'		  => '#f3f3f3'
							),
							array(
								'id'          => 'section_alt_background',
								'name'        => 'Alternative background color',
								'description' => 'This color will be used as an alternative background for several elements ( for example breadcrumb bar ).',
								'type'        => 'colorpicker',
								'std'		  => '#f3f3f3'
							),
							array(
								'id'          => 'text_color',
								'name'        => 'Default paragraph color',
								'description' => 'This color will be used as a default color for general text.',
								'type'        => 'colorpicker',
								'std'		  => '#999'
							),
							array(
								'id'          => 'borders_color',
								'name'        => 'Default borders color',
								'description' => 'This color will be used for borders in various elements.',
								'type'        => 'colorpicker',
								'std'		  => '#e4e4e4'
							),                        
					)
);

//** END Unlimited colors
//////////////////////////

//////////////////////////
//** FOOTER colors

$admin_options[] = array(
	'slug'        => 'footer_colors',
	'parent'      => 'style_options',
	'id'          => 'footer_colors',
	'name'        => 'Footer colors',
	'description' => 'Select the default color scheme for the footer.<br/>(Refresh the page to see the newly added styles)',
	'type'        => 'select',
	'std'         => '',
	'options'     => $zn_framework->unlimited_styles, // array('dark' => 'Dark Style', 'mediumDark' => 'Medium Dark Style', 'light' => 'Light Style')
);

//** END Footer colors
//////////////////////////

$admin_options[] = array(
	'slug'        => 'misc_colors',
	'parent'      => 'style_options',
	'id'          => 'maintenance_mode_color',
	'name'        => 'Maintenance mode background color',
	'description' => 'This color will be used as background color for the maintenance mode boxes section.',
	'type'        => 'colorpicker',
	'std'		  => '#313338'
);

//////////////////////////
//** Blog options

$admin_options[] = array(
	'slug'        => 'blog_options',
	'parent'      => 'blog_options',
	'id'          => 'blog_style',
	'name'        => 'Blog archive style',
	'description' => 'Select the desired style that you want to use for the blog archive.',
	'type'        => 'select',
	'std'         => '',
	'options'     => array('' => 'Default style', 'timeline' => 'Timeline blog', 'masonry' => 'Masonry blog')
);

$admin_options[] = array(
	'slug'        => 'blog_options',
	'parent'      => 'blog_options',
	'id'          => 'columns',
	'name'        => 'Columns',
	'description' => 'Select how many columns to use for the blog archive',
	'type'        => 'select',
	'std'		  => 'col-sm-12',
	'options'	  => array( 'col-sm-12' => '1 Column', 'col-sm-6' => '2 Columns', 'col-sm-4' => '3 Columns', 'col-sm-3'=> '4 Columns' ),
	'dependency' => array( 'element' => 'blog_style' , 'value'=> array('masonry', '') )
);

$admin_options[] = array(
	'slug'        => 'blog_options',
	'parent'      => 'blog_options',
	'id'          => 'show_about_box',
	'name'        => 'Show about box on single blog posts ?',
	'description' => 'Choose if you want to show the author about box on single post pages.',
	'type'        => 'select',
	'std'         => 'yes',
	'options'     => array( 'yes' => 'Yes', 'no' => 'No' )
);

$admin_options[] = array(
	'slug'        => 'blog_options',
	'parent'      => 'blog_options',
	'id'          => 'timeline_date',
	'name'        => 'Choose the desired timeline blog date format',
	'description' => 'Select a specific date format to use on the timeline blog page.',
	'type'        => 'select',
	'std'         => 'F, y',
	'options'     => array( 
		'F, y' => 'February, 15 ( month, year )',
		'F y' => 'February 15 ( month year )',
		'y, F' => '15, February ( year month )',
		'y F' => '15 February ( year, month )',

		// With date
		'F, d' => 'February, 15 ( month, day )',
		'F d' => 'February 15 ( month day )',
		'd, F' => '15, February ( day month )',
		'd F' => '15 February ( day, month )',

	),
);

//** END Blog options
//////////////////////////


$admin_options[] = array(
	'slug'        => 'portfolio_options',
	'parent'      => 'portfolio_options',
	'id'          => 'portfolio_pagination_items',
	'name'        => 'Portfolio pagination items',
	'description' => 'Specify how many items to load on each page for the archive pages.',
	'type'        => 'text',
	'std'		  => '9'
);

$admin_options[] = array ( 
	'slug' => 'portfolio_options',
	'parent'      => 'portfolio_options',
	'id'         	=> 'port_use_heart',
	'name'       	=> 'Use hearts system for portfolio',
	'description' 	=> 'Select if you want to show the heart system / icon on portfolio pages / items',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> 'yes'
);

$admin_options[] = array ( 
	'slug' => 'portfolio_options',
	'parent'      => 'portfolio_options',
	'id'         	=> 'port_add_feat_img',
	'name'       	=> 'Use featured image in slider ?',
	'description' 	=> 'Choose if you want to add the featured image in the portfolio slider that appears on single portfolio pages.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> 'yes'
);

/*--------------------------------------------------------------------------------------------------
	Start Coming soon options
--------------------------------------------------------------------------------------------------*/
$admin_options[] = array ( 
	'slug' => 'coming_soon',
	'parent'      => 'coming_soon',
	'id'         	=> 'enable_coming_soon',
	'name'       	=> 'Enable coming soon page ?',
	'description' 	=> 'Choose if you want to enable the coming soon page. If enabled , all visitors will see a coming soon page.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> ''
);

$admin_options[] = array(
	'slug'        => 'coming_soon',
	'parent'      => 'coming_soon',
	'id'          => 'coming_soon_text1',
	'name'        => 'First text',
	'description' => 'Enter a text for the first line.',
	'type'        => 'text',
	'std'		  => 'We are working on something awesome.',
	'dependency' => array( 'element' => 'enable_coming_soon' , 'value'=> array('yes') )
);

$admin_options[] = array(
	'slug'        => 'coming_soon',
	'parent'      => 'coming_soon',
	'id'          => 'coming_soon_text2',
	'name'        => 'Second text',
	'description' => 'Enter a text for the second line.',
	'type'        => 'text',
	'std'		  => 'Please don\'t forget to check out our tweets and to subscribe to be notified!',
	'dependency' => array( 'element' => 'enable_coming_soon' , 'value'=> array('yes') )
);

$admin_options[] = array(
	'slug'        => 'coming_soon',
	'parent'      => 'coming_soon',
	'id'          => 'coming_soon_subscribe_text',
	'name'        => 'Mailchimp button text',
	'description' => 'Enter a text that appears on the subscribe button.',
	'type'        => 'text',
	'std'		  => 'Get notified',
	'dependency'  => array( 'element' => 'enable_coming_soon' , 'value'=> array('yes') )
);


$admin_options[] = array ( 
	'slug' => 'coming_soon',
	'parent'      => 'coming_soon',
	'id'         	=> 'enable_coming_soon_timer',
	'name'       	=> 'Enable coming soon countdown ?',
	'description' 	=> 'Choose if you want to enable the coming soon countdown.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> 'no',
	'dependency' => array( 'element' => 'enable_coming_soon' , 'value'=> array('yes') )
);


$admin_options[] = array ( 
	'slug' => 'coming_soon',
	'parent'      => 'coming_soon',
	'id'         	=> 'cs_date',
	'name'       	=> 'Launch date',
	'description' 	=> 'Please select the date when your site will be available.',
	'type'        	=> 'date_picker',
	'std'			=> '',
	'dependency' => array( 'element' => 'enable_coming_soon' , 'value'=> array('yes') )
);


// MAILCHIMP LIST
$admin_options[] = array ( 
	'slug' => 'coming_soon',
	'parent'      => 'coming_soon',
	'id'         	=> 'enable_coming_soon_mailchimp',
	'name'       	=> 'Enable coming soon mailchimp subscribe ?',
	'description' 	=> 'Choose if you want to enable the coming soon mailchimp.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> 'no',
	'dependency' => array( 'element' => 'enable_coming_soon' , 'value'=> array('yes') )
);
// PLACE MAILCHIMP OPTION
$admin_options[] = array ( 
	'slug' => 'coming_soon',
	'parent'      => 'coming_soon',
	'id'          => 'mailchimp_list',
	'name'        => 'Mailchimp List',
	'description' => 'Please select your desired Mailchimp list. If this is empty, please make sure that you have entered your Mailchimp API key inside the theme options panel',
	'type'        => 'select',
	'options'	  => generate_mailchimp_lists( 'mailchimp_api' , 'general_options' ),
	'dependency' => array( 'element' => 'enable_coming_soon' , 'value'=> array('yes') )
);

$admin_options[] = array(
	'slug'			=> 'coming_soon',
	'parent'		=> 'coming_soon',
	'id'			=> 'cs_social_icons',
	'name'			=> 'Social icons',
	'description'	=> 'You can add here a social icon list to display under the countdown.',
	'type'			=> 'group',
	'dependency'	=> array( 'element' => 'enable_coming_soon' , 'value'=> array('yes') ),
	'element_title'			=> 'Social icon',
	'subelements'	=> array(
							array(
								'id'			=> 'icon',
								'name'			=> 'Icon',
								'description'	=> 'Select an icon to display',
								'type'			=> 'icon_list',
								'class'			=> 'zn_full',
							),
							array (
								'id'			=> 'social_link',
								'name'			=> 'Button link',
								'description'	=> 'Enter a link for this element',
								'type'			=> 'link'
							)
						)
);

/*--------------------------------------------------------------------------------------------------
	Start Maintenance mode options
--------------------------------------------------------------------------------------------------*/
$admin_options[] = array ( 
	'slug' 			=> 'maintenance_mode',
	'parent'      	=> 'maintenance_mode',
	'id'         	=> 'enable_maintenance_mode',
	'name'       	=> 'Enable maintenance mode ?',
	'description' 	=> 'Choose if you want to enable the maintenance mode. If enabled , all visitors will see the maintenance page.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> ''
);

// Maintenance boxed bg
$admin_options[] = array(
	'slug'        => 'maintenance_mode',
	'parent'      => 'maintenance_mode',
	'id'          => 'maintenance_bg',
	'name'        => 'Maintenance boxes background',
	'description' => 'Choose a background for the boxes section.',
	'type'        => 'background',
	'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
	'class'		  => 'zn_full',
	'std'		  => '',
	'dependency'	=> array( 'element' => 'enable_maintenance_mode' , 'value'=> array('yes') ),
);

$admin_options[] = array(
	'slug'        => 'maintenance_mode',
	'parent'      => 'maintenance_mode',
	'id'          => 'maintenance_text1',
	'name'        => 'First text',
	'description' => 'Enter a text for the first line.',
	'type'        => 'text',
	'std'		  => 'Maintenance Mode',
	'dependency' => array( 'element' => 'enable_maintenance_mode' , 'value'=> array('yes') )
);

$admin_options[] = array(
	'slug'        => 'maintenance_mode',
	'parent'      => 'maintenance_mode',
	'id'          => 'maintenance_text2',
	'name'        => 'Second text',
	'description' => 'Enter a text for the second line.',
	'type'        => 'text',
	'std'		  => 'This website is currently under going maintenance.',
	'dependency' => array( 'element' => 'enable_maintenance_mode' , 'value'=> array('yes') )
);

$admin_options[] = array(
	'slug'        => 'maintenance_mode',
	'parent'      => 'maintenance_mode',
	'id'          => 'maintenance_boxes_columns',
	'name'        => 'Boxes Columns',
	'description' => 'Using this option you can select how many box columns you want to use.',
	'type'        => 'slider',
	'std'		  => '3',
	'class'		  => 'zn_full',
	'helpers'	  => array(
		'min' => '1',
		'max' => '4'
		),
	'dependency' => array( 'element' => 'enable_maintenance_mode' , 'value'=> array('yes') )
);

$admin_options[] = array(
	'slug'			=> 'maintenance_mode',
	'parent'		=> 'maintenance_mode',
	'id'			=> 'maintenance_boxes',
	'name'			=> 'Info boxes',
	'description'	=> 'You can add here info boxes that will appear bellow the titles.',
	'type'			=> 'group',
	'dependency'	=> array( 'element' => 'enable_maintenance_mode' , 'value'=> array('yes') ),
	'element_title'			=> 'title',
	'subelements'	=> array(
						array(
							'id'          => 'icon',
							'name'        => 'Icon',
							'description' => 'Please select your desired icon',
							'type'        => 'icon_list',
							'std'		  => '',
							'class' 	  => 'zn_full'
						),						
						array(
							'id'          => 'title',
							'name'        => 'Title',
							'description' => 'Please enter your desired title',
							'type'        => 'text'
						),
						array(
							'id'          => 'desc',
							'name'        => 'Description',
							'description' => 'Please enter your desired description',
							'type'        => 'textarea',
							'std' => '',
							'class'		  => 'zn_full'
						),
						array(
							'id'          => 'link',
							'name'        => 'Button link',
							'description' => 'Enter a link for this element',
							'type'        => 'link'
						),
						array(
							'id'          => 'link_text',
							'name'        => 'Button text',
							'description' => 'Enter a text for this element',
							'type'        => 'text'
						),
						array(
							'id'          => 'button_style',
							'name'        => 'Button style',
							'description' => 'Select the style for the button.',
							'type'        => 'select',
							'std'		  => 'zn_btn_simple',
							'options'	=> zn_get_button_styles(),
						)
					)
);


/*--------------------------------------------------------------------------------------------------
	Start Advanced options
--------------------------------------------------------------------------------------------------*/


$admin_options[] = array(
	'slug'        => 'advanced',
	'parent'      => 'advanced',
	'id'          => 'font_uploader',
	'name'        => 'Icon Font uploader',
	'description' => 'Please select a zip archive containing the font (generate it using http://fontello.com).',
	'type'        => 'upload',
	'supports'	  => array
	(
		'file_extension' => 'zip',
		'file_type' => 'application/octet-stream, application/zip',
	)
);

$admin_options[] = array(
	'slug'        => 'advanced',
	'parent'      => 'advanced',
	'id'          => 'zn_importer',
	'name'        => 'Import dummy data',
	'description' => 'Press this button if you want to import the dummy data.',
	'type'        => 'zn_import'
);

$admin_options[] = array(
	'slug'        => 'advanced',
	'parent'      => 'advanced',
	'id'          => 'zn_refresh_pb',
	'name'        => 'Refresh page builder data',
	'description' => 'If you have made changes to the theme\'s page builder folder or files, you will need to press this button in order to refresh their css and folder structure.',
	'type'        => 'zn_ajax_call',
	'ajax_call_setup' => array(
			'action' => 'zn_refresh_pb',
			'button_text' => 'Refresh page builder data'
		)
);

$admin_options[] = array(
	'slug'        => 'custom_css',
	'parent'      => 'advanced',
	'id'          => 'custom_css',
	'name'        => 'Custom css',
	'description' => 'Here you can enter your custom css that will be used by the theme.',
	'type'        => 'custom_css',
	'class'		  => 'zn_full'
);

/* Theme Tweaks */
$admin_options[] = array(
	'slug'        => 'tweaks',
	'parent'      => 'advanced',
	'id'          => 'no_smooth_scroll',
	'name'        => 'Disable smooth scroll for specific classes.',
	'description' => 'Here you can enter your classes where you don\'t want to enable the smooth scroll. By default, you can use the "no-scroll" css class to disable the smooth scroll. Please enter your css classes comma separated ( for example : ".noscroll1, .noscroll2" ).',
	'type'        => 'text',
);

?>
<?php
$admin_pages = array();

 $admin_pages['general_options'] =  array(
						'title' =>  'General Options',
						'submenus' => 	array(
											array( 
												'slug' => 'general_options',
												'title' =>  'General options'
											),
											array( 
												'slug' => 'favicons_options',
												'title' =>  'Favicons'
											),
											 array( 
												'slug' => 'hidden_bar',		
												'title' =>  'Sliding panel'
											),
											array( 
												'slug' => 'header_options',		
												'title' =>  'Header options'
											),
											array( 
												'slug' => 'title_bar_options',		
												'title' =>  'Title bar options'
											),
											 array( 
												'slug' => 'footer_options',		
												'title' =>  'Footer options'
											),
											 array( 
												'slug' => 'news_bar',		
												'title' =>  'News bar'
											),
											array( 
												'slug' => 'api_keys_options',		
												'title' =>  'API Keys'
											)
										)
					);

$admin_pages['google_font_options'] = array(
	'title' =>  'Fonts Setup',
	'submenus' => 	array(
			array(
				'slug' => 'gfont_setup',
				'title' =>  'Google Fonts setup'
			),
			array(
				'slug' => 'custom_font_setup',
				'title' =>  'Custom Fonts setup'
			),
		)
);

 $admin_pages['font_options'] = array( 
											'parent'=>'font_options',
											'title' =>  'Font options',
											'submenus' => 	array(
																array( 
																	'slug' => 'general_fonts',
																	'title' =>  'General font options'
																)
															)
					);

$admin_pages['unlimited_sidebars'] = array( 
											'parent'=>'unlimited_sidebars', 	
											'title' =>  'Sidebars options',
											'submenus' => 	array(
																array( 
																	'slug' => 'unlimited_sidebars', 
																	'title' =>  'Unlimited Sidebars' 
																),
																array( 
																	'slug' => 'sidebar_settings',		
																	'title' =>  'Sidebar Settings'
																)
															)
									);


$admin_pages['style_options'] = array( 
											'parent'=>'style_options',
											'title' =>  'Color options',
											'submenus' => 	array(
																array( 
																	'slug' => 'header_colors',
																	'title' =>  'Header colors'
																),
																array( 
																	'slug' => 'custom_colors',
																	'title' =>  'Unlimited colors'
																),
																array(
																	'slug'  => 'footer_colors',
																	'title' => 'Footer colors'
																),
																array(
																	'slug'  => 'misc_colors',
																	'title' => 'Misc colors'
																)
															)
					);

$admin_pages['blog_options'] = array( 
									'parent'=>'blog_options',
									'title' =>  'Blog options',
									'submenus' => 	array(
										array( 
											'slug' => 'blog_options',
											'title' =>  'Blog options' 
										)
									)
					);

$admin_pages['portfolio_options'] = array(		
										'title' =>  'Portfolio Options',
										'submenus' => 	array(
															array( 
																'slug' => 'portfolio_options',
																'title' =>  'Portfolio Options' 
															),
														)
					);   

$admin_pages['coming_soon'] = array( 
									'parent'=>'coming_soon',
									'title' =>  'Coming soon options',
									'submenus' => 	array(
										array( 
											'slug' => 'coming_soon',
											'title' =>  'Comgin soon options' 
										)
									)
					);

$admin_pages['maintenance_mode'] = array( 
									'parent'=>'maintenance_mode',
									'title' =>  'Maintenance mode options',
									'submenus' => 	array(
										array( 
											'slug' => 'maintenance_mode',
											'title' =>  'Maintenance mode options' 
										)
									)
					);

$admin_pages['advanced'] = array( 
									'parent'=>'advanced',
									'title' =>  'Advanced',
									'submenus' => 	array(
										array( 
											'slug' => 'advanced',
											'title' =>  'Advanced Options' 
										),
										array( 
											'slug' => 'custom_css',
											'title' =>  'Custom css' 
										),
										array( 
											'slug' => 'tweaks',
											'title' =>  'Theme tweaks' 
										)
									)
					);					

?>
<?php

/* FILTERS */
add_filter( 'zn_theme_pages', 'zn_woocommerce_pages' );
add_filter( 'zn_theme_options', 'zn_woocommerce_options' );

function zn_woocommerce_pages( $admin_pages ){
	$admin_pages['zn_woocommerce_options'] = array(
			'title' =>  'Woocommerce options',
			'submenus' => 	array(
					array( 
						'slug' => 'zn_woocommerce_options',
						'title' =>  'General options'
					),
					// array( 
					// 	'slug' => 'zn_woocommerce_header_options',
					// 	'title' =>  'Header options'
					// ),
				)
		);

	return $admin_pages;
}

function zn_woocommerce_options( $admin_options ){

	global $zn_framework;



$admin_options[] = array(
	'slug'        => 'sidebar_settings',
	'parent'      => 'unlimited_sidebars',
	'id'          => 'woo_archive_sidebar',
	'name'        => 'Sidebar on Shop archive pages',
	'description' => 'Please choose the sidebar position for the shop archive pages.',
	'type'        => 'sidebar',
	'class'		=> 'zn_full',
	'std'		=> array (
		'layout' => 'sidebar_left',
		'sidebar' => 'default_sidebar',
	)
);

$admin_options[] = array(
	'slug'        => 'sidebar_settings',
	'parent'      => 'unlimited_sidebars',
	'id'          => 'woo_single_sidebar',
	'name'        => 'Sidebar on Shop product page',
	'description' => 'Please choose the sidebar position for the shop product pages.',
	'type'        => 'sidebar',
	'class'		=> 'zn_full',
	'std'		=> array (
		'layout' => 'no_sidebar',
		'sidebar' => 'default_sidebar',
	)
);

/* Show cart in header */
$admin_options[] = array ( 
	'slug' 			=> 'header_options',
	'parent'     	=> 'general_options',
	'id'         	=> 'show_cart_icon',
	'name'       	=> 'Show cart icon ?',
	'description' 	=> 'Select if you want to show the cart icon or not.',
	'type'        	=> 'toggle2',
	'value'			=> 'yes',
	'std'			=> 'yes'
);


/* NUMBER OF COLUMNS */
$admin_options[] = array(
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	'id'          => 'shop_columns',
	'name'        => 'Number of columns',
	'description' => 'Please select how many columns you want to use for the shop archive pages',
	'type'        => 'select',
	'std'        => '3',
	'options'	  => array( '2' => '2 Columns', '3' => '3 Columns', '4'=> '4 Columns' )
);

/* NUMBER OF ITEMS PER PAGE */
$admin_options[] = array(
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	'id'          => 'shop_num',
	'name'        => 'Number of items per page',
	'description' => 'Please specify how many items you want to be visible on an archive page',
	'type'        => 'text',
	'std'        => '6'
);

/* NUMBER OF ITEMS PER PAGE */
$admin_options[] = array(
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	'id'          => 'shop_related_num',
	'name'        => 'Number of items related and cross-sell products to display',
	'description' => 'Here you can choose how many related and cross-sell products will be displayed on the single product page.',
	'type'        => 'text',
	'std'        => '4'
);

$admin_options[] = array(
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	'id'          => 'shop_related_columns',
	'name'        => 'Number of columns for related and cross-sell products.',
	'description' => 'Please select how many columns do you want to use for the related and cross-sell products on the single product page.',
	'type'        => 'select',
	'std'        => '4',
	'options'	  => array( '2' => '2 Columns', '3' => '3 Columns', '4'=> '4 Columns' )
);




	return $admin_options;
}

?>
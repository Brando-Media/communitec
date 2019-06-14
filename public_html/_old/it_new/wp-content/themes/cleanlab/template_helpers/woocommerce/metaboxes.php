<?php

	add_filter('zn_metabox_locations', 'zn_woo_metabox_locations' );
	add_filter('zn_metabox_elements', 'zn_woo_metabox_elements' );

	function zn_woo_metabox_locations( $zn_meta_locations ){
		$zn_meta_locations[] = array( 	'title' =>  'Item info', 'slug'=>'product_info', 'page'=>array('product'), 'context'=>'normal', 'priority'=>'default' );

		return $zn_meta_locations;
	}

	function zn_woo_metabox_elements( $zn_meta_elements ){
		$zn_meta_elements[] = array ( 
							'slug' 			=> array( 'product_info'),
							'id'         	=> 'info_columns',
							'name'       	=> 'Info boxes columns',
							'description' 	=> 'Here you can select how many columns to use for the info boxes',
							'type'        	=> 'select',
							'std'        	=> 'col-sm-4',
							'options'	=> array( 'col-sm-12' => '1 Column','col-sm-6' => '2 Columns','col-sm-4' => '3 Columns' )
						);

		$zn_meta_elements[] = array ( 
							'slug' 			=> array( 'product_info'),
							'id'         	=> 'product_info',
							'name'       	=> 'Project info boxes',
							'description' 	=> 'Here you can configure the product info boxes.',
							'type'        	=> 'group',
							"class" 		=> 'zn_full',
							'element_title'	=> 'info_name',
							'subelements'	=> array(
													array(
														'id'			=> 'info_name',
														'name'			=> 'Info name',
														'description'	=> 'Please enter a name for this detail.',
														'type'			=> 'text'
													),
													array(
														'id'			=> 'info_desc',
														'name'			=> 'Info description',
														'description'	=> 'Please enter a description for this info.',
														'type'			=> 'text'
													),
													array(
														'id'			=> 'info_icon',
														'name'			=> 'Info box icon',
														'description'	=> 'Select an icon that will appear on the left side of the name and description.',
														'type'			=> 'icon_list',
														'class'			=> 'zn_full'
													)
												)

						);

		return $zn_meta_elements;
	}

?>
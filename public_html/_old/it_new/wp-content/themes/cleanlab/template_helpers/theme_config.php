<?php

	$theme_config = array(
		'options_prefix' => 'zn_options_cleanlab', // The DB options field name
		'theme_id' => 'cleanlab', // The theme id that will be used for options field
		'name'           => 'CleanLab', // The theme name
		'supports'       => array(
			'pagebuilder'  	=> true,
			'megamenu'     	=> true,
			'iconmanager'  	=> true,
			'imageresizer' 	=> true,
			'theme_updater'	=> array(
				'author' => 'ThemeFuzz',
				'admin_parent' => 'advanced', 
			),
		)
	);
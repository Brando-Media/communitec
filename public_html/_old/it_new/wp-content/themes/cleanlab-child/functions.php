<?php

// THIS WILL ALLOW ADDING CUSTOM CSS TO THE style.css FILE and JS code to /js/zn_script_child.js

function cleanlab_child_scripts() {

	wp_enqueue_style( 'custom_theme_css', get_stylesheet_directory_uri().'/style.css' , '' , ZN_FW_VERSION );

    /* Uncomment this line if you want to add custom javascript */
	//wp_enqueue_script( 'zn_script_child', get_stylesheet_directory_uri() .'/js/zn_script_child.js' , '' , ZN_FW_VERSION , true );

}

add_action( 'wp_enqueue_scripts', 'cleanlab_child_scripts',11 );


?>
<?php if(! defined('THEME_BASE')) { exit('Invalid Request');}

add_filter( 'zn_theme_update_scripts', 'zn_cleanlab_updater_scripts' );
add_filter( 'zn_theme_normal_update_scripts', 'zn_cleanlab_normal_updates_scripts' );

/**
 *	Updates that requires DB updates ( Normally it should only be the V3 to V4 update )
 */
function zn_cleanlab_updater_scripts(){
	$updates = array();

	return $updates;
}

function zn_cleanlab_normal_updates_scripts(){
	$updates = array(
		'1.0.7' => array(
			'function' => 'zn_cleanlab_update_107'
		)
	);

	return $updates;
}

/*
 *	107 Update	
 */
function zn_cleanlab_update_107(){

	$uploads = wp_upload_dir();
	$file_path = trailingslashit( $uploads['basedir'] ) . 'zn_custom_css.css';
	// Change the custom css saving from file to DB
	if ( file_exists( $file_path ) ){
		$saved_css = file_get_contents( $file_path );
		if( ! empty( $saved_css ) ){
			update_option( 'zn_'.ZN()->theme_data['theme_id'].'_custom_css', $saved_css, false );
		}
		@unlink( $file_path );
	}
}
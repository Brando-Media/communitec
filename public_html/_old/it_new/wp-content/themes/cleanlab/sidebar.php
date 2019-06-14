<?php
		
	global $zn_config;
	
	// Check to see on what type of page we are on
	$layout = 'blog_sidebar';
	if ( !empty( $zn_config['force_sidebar'] ) ) {
		$layout = $zn_config['force_sidebar'];
	}
	else{
		if( is_page() || is_search() || is_404() || is_attachment() ) $layout = 'page_sidebar';
		elseif( is_archive() ) $layout = 'archive_sidebar';
		elseif( is_singular() ) $layout = 'single_sidebar';
	}

	// Get the sidebar position
	$sidebar_pos 	 = zn_get_content_class( $layout );
	$has_sidebar 	 = false;

	if(strpos($sidebar_pos, 'sidebar_left')  !== false) $has_sidebar = true;
	if(strpos($sidebar_pos, 'sidebar_right')  !== false) $has_sidebar = true;

	// Return if we do not have a sidebar
	if( !$has_sidebar ) return;

	// Show the sidebar already :)
	echo '<aside class="col-md-3 zn_sidebar">';

		// Check to see if this is a page and has a custom sidebar
		if ( is_singular() && $sidebar = get_post_meta( get_the_ID(), 'zn_page_sidebar_select', true ) ){
			dynamic_sidebar( $sidebar );
		}
		else {
			// Get the sidebar set in the theme options
			$sidebar = zget_option( $layout, 'unlimited_sidebars');

			dynamic_sidebar( $sidebar['sidebar'] );
		}

		
	echo '</aside>';

?>
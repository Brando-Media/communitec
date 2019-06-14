<?php

	if ( have_posts() ) {

		global $zn_config;

		$before = $after = '';
		
		$zn_config['main_class'] = isset( $zn_config['main_class'] ) ? $zn_config['main_class'] : '';
		$zn_config['blog_style'] = isset( $zn_config['blog_style'] ) ? $zn_config['blog_style'] : zget_option( 'blog_style', 'blog_options' );
		

		if ( !is_single() && ( $zn_config['blog_style'] == 'masonry' || $zn_config['blog_style'] == '' ) ) {

			$zn_config['columns'] = isset( $zn_config['columns'] ) ? $zn_config['columns'] : zget_option( 'columns', 'blog_options', false, 'col-sm-12' );
			$before = '<div class="zn-'.$zn_config['blog_style'].'-blog-container row">';
			$after = '</div>';

		}
		else {
			$zn_config['columns'] = '';
		}

		echo '<main class="zn-blog-container '.$zn_config['main_class'].' mbottom50">';

			echo $before; // NEEDED FOR MULTIPLE COLUMNS

			while ( have_posts() ) : the_post();

				get_template_part( 'template_helpers/content', 'default' );

				
				if ( is_single() ) {

					echo '<div class="separator mbottom50"></div>';

					$author_about_display = zget_option( 'show_about_box', 'blog_options', false, 'yes' );
					if ( $author_about_display == 'yes' ) {
						get_template_part( 'author', 'about' );
					}
					
				}

			endwhile;
			
			echo $after; // NEEDED FOR MULTIPLE COLUMNS

			// Blog pagination 
			echo '<div class="center zn_blog_pagination">';
				zn_pagination();
			echo '</div><!-- end pagination -->';
				
		echo '</main>';

	}
	else {
		get_template_part( 'content', 'none' );
	}

?>
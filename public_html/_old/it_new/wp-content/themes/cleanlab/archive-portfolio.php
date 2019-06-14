<?php get_header(); ?>


<?php
	global $zn_config;
	
	//** News bar
	zn_get_news_bar();
	
	//** Put the header with title and breadcrumb
	$archive_type = is_tax();
	$title = $archive_type ? get_the_archive_title() : __( 'Portfolio','zn_framework');

	zn_get_header_breadcrumb( array( 'title' => $title ) );

	// Check to see if the page has a sidebar or not
	// $zn_config['main_class'] = zn_get_content_class('portfolio_sidebar');

?>

	<!--Blog section-->
	<div class="container mbottom50">
		<div class="row">

			<!-- Main content -->
			<?php get_template_part( 'template_helpers/loop', 'portfolio' ); ?>

			<!-- sidebar -->
			<?php // get_sidebar(); ?>

		</div>
	</div>
					
	<!--END Blog section-->

<?php get_footer(); ?>
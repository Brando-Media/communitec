<?php get_header(); ?>


<?php
	global $zn_config;
	
	//** News bar
	zn_get_news_bar();
	
	//** Put the header with title and breadcrumb
	$title = get_the_archive_title();
	
	zn_get_header_breadcrumb( array( 'title' => $title ) );

	// Check to see if the page has a sidebar or not
	$zn_config['main_class'] = zn_get_content_class('blog_sidebar');

?>

	<!--Blog section-->
	<div class="container mbottom50">
		<div class="row">

			<!-- Main content -->
			<?php get_template_part( 'template_helpers/loop', 'index' ); ?>

			<!-- sidebar -->
			<?php get_sidebar(); ?>

		</div>
	</div>
					
	<!--END Blog section-->

<?php get_footer(); ?>
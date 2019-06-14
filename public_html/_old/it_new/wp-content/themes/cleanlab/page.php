<?php get_header(); ?>


<?php
	global $zn_config;
	
	//** News bar
	zn_get_news_bar();
	
	//** Put the header with title and breadcrumb
	$args = array('heading' => 'h1', );
	zn_get_header_breadcrumb( $args );

	// Check to see if the page has a sidebar or not
	$main_class = zn_get_content_class('page_sidebar');
	if( strpos( $main_class , 'sidebar_right' ) !== false || strpos( $main_class , 'sidebar_left' ) !== false ) { $zn_config['sidebar'] = true; } else { $zn_config['sidebar'] = false; }

	// GET BLOG STYLE
	$zn_config['size'] = $zn_config['sidebar'] ? 'col-sm-9' : 'col-sm-12';
	$zn_config['columns'] = '';

?>

	<!--Blog section-->
	<div class="container mbottom50">
			<div class="row">
				<div class="<?php echo $main_class; ?> mbottom50">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							// Include the page content template.
							get_template_part( 'template_helpers/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
						endwhile;
					?>
					<!-- pagination -->
					<div class="center">
					<?php zn_pagination(); ?>
					</div><!-- end pagination -->
					
				</div>
				
				<!-- sidebar -->
				<?php get_sidebar(); ?>
			</div>
		</div>
					
	<!--END Blog section-->

<?php get_footer(); ?>
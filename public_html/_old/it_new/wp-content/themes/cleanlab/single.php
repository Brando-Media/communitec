<?php get_header( );?>


<?php 
	//** News bar
	zn_get_news_bar();
	
	//** Put the header with title and breadcrumb
	$title = __( 'Blog', 'zn_framework' );
	zn_get_header_breadcrumb( array( 'title' => $title ) );
?>

<?php
	// Check to see if the page has a sidebar or not
	$main_class = zn_get_content_class('single_sidebar');
	if( strpos( $main_class , 'sidebar_right' ) !== false || strpos( $main_class , 'sidebar_left' ) !== false ) { $zn_config['sidebar'] = true; } else { $zn_config['sidebar'] = false; }
	$zn_config['size'] = $zn_config['sidebar'] ? 'col-sm-9' : 'col-sm-12';
?>
<!--Blog section-->
	<div class="container mbottom50">
			<div class="row">
				<div class="<?php echo $main_class; ?> mbottom50">
					<?php get_template_part( 'template_helpers/loop', 'index' ); ?>
					
					<?php comments_template(); ?>
					
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

<?php get_footer( );?>
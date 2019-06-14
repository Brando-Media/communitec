<?php get_header(); ?>


<?php
	global $zn_config;
	
	//** Put the header with title and breadcrumb
	zn_get_header_breadcrumb( array( 'title' => __( 'Error 404', 'zn_framework' ) ) );

?>

	<!--Blog section-->
	<div class="container mbottom50 zn_404_page">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="section-title mbottom50 center"><?php _e('Oops! Error 404. That page can\'t be found!','zn_framework'); ?></h2>
					<img src="<?php echo THEME_BASE_URI ?>/images/404.png" alt="" class="img-responsive mauto mbottom30" />
					<p class="center mbottom20"><?php _e('It looks like nothing was found at this location. Maybe try to use a search?','zn_framework'); ?></p>
					<form role="search" method="get" class="searchForm center mbottom50" action="<?php echo home_url( '/' ); ?>">
						<input name="s" type="search" placeholder="<?php _e('Search for...','zn_framework'); ?>" class="searchBox" value="">
						<button class="btn-sm btn-small" type="submit">
							<span class="icon-search3"></span>
						</button>
					</form>
				</div>
			</div>
		</div>
					
	<!--END Blog section-->

<?php get_footer(); ?>
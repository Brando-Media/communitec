<?php get_header(); ?>
	<?php
		$pego_page_titles_show = get_post_meta($post->ID , $GLOBALS['wpcf_prefix'].'hide-title' , true); 
		$pego_page_subtitle = get_post_meta($post->ID , $GLOBALS['wpcf_prefix'].'subtitle' , true);
		if ($pego_page_titles_show != '1') {
			?>
			<div class="page-title-wrapper">
				<div class="page-title">
					<h1><?php  echo esc_html(get_the_title($post->ID));  ?></h1>
					<div class="page-title-divider">
						<div class="page-title-left-divider"></div>
						<i class="page-title-icon icon-down-dir"></i>
						<div class="page-title-right-divider"></div>
					</div>
					<?php
					if ($pego_page_subtitle != '') {
					?>
						<h3><?php echo esc_html($pego_page_subtitle); ?></h3>
					<?php
					}
					?>
					<div class="clear"></div>
				</div>
			</div>	
			<div class="clear"></div>
		<?php
		}
		?>
		<div id="container"> <!-- start container -->	
			<div class="center">
				<div class="page-wrapper">
					<?php while ( have_posts() ) : the_post();  ?>				
							<?php the_content(); ?>
					<?php endwhile; ?>
				</div>
			</div>	
		</div><!-- end container -->
<?php get_footer(); ?>

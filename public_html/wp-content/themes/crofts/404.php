<?php get_header(); ?>
	<?php
		$pego_error_page_id = ot_get_option('pego_error_page');
		$pego_page_titles_show = get_post_meta($pego_error_page_id , $GLOBALS['wpcf_prefix'].'hide-title' , true); 
		$pego_page_subtitle = get_post_meta($pego_error_page_id , $GLOBALS['wpcf_prefix'].'subtitle' , true);
		if ($pego_page_titles_show != '1') {
			?>
			<div class="page-title-wrapper">
				<div class="page-title">
					<h1><?php  echo esc_html(get_the_title($pego_error_page_id));  ?></h1>
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
					<?php echo apply_filters('the_content', get_post_field('post_content', $pego_error_page_id)); ?>	
				</div>
			</div>	
		</div><!-- end container -->		
<?php get_footer(); ?>

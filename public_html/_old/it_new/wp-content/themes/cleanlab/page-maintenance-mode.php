<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!-- Set favicon -->
	<?php echo zn_favicon(); ?>

	<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
	<?php wp_head(); ?>

	<style>

	</style>
</head>

<body <?php body_class( ); ?>>
<div id="page-wrapper">
  <div id="content" class="page_content zn_maintenance_page">
	
		<?php 
			$maintenance_text1 = zget_option('maintenance_text1', 'maintenance_mode');
			$maintenance_text2 = zget_option('maintenance_text2', 'maintenance_mode');
		?>

		<?php if( !empty( $maintenance_text1 ) || !empty( $maintenance_text2 ) ) : ?>
			<div class="maintenance_header">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<?php if ( !empty( $maintenance_text1 ) ) { echo '<h1 class="center mbottom15">'. $maintenance_text1 .'</h1>'; } ?>
							<?php if ( !empty( $maintenance_text2 ) ) { echo '<p class="center size20 weight300">'. $maintenance_text2 .'</p>'; } ?>
						</div>
					</div>
				</div>
			</div>

		<?php endif; ?>
	


			<?php

				$boxes = zget_option('maintenance_boxes', 'maintenance_mode');
				$columns = zget_option('maintenance_boxes_columns', 'maintenance_mode', false, 3);

				if ( !empty($boxes) ) {

					?>
					<div class="zn_maintenance_boxes_container">
						<div class="container">
							<div class="row">
							<?php

								foreach ($boxes as $key => $box) {
									$icon = ($box['icon'] && $box['icon']['family'])  ? '<span class="ibox-icon zn-primary-color '.zn_generate_icon( $box['icon'] ).'></span>' : '';
									$link_extracted = $box['link'] ? zn_extract_link( $box['link'] , 'btn '.$box['button_style'] ) : '';
									$link_text      = $box['link_text'] ? $box['link_text'] : '';
									$class = 'col-sm-'. 12/$columns;

								?>
								<div class="<?php echo $class; ?> ">
									<div class="ibox2 style5 clearfix zn-alternative-bkg">
										<?php 
											if (!empty($box['title'])) {
												echo '<h3 class="ibox-title zn-secondary-color">'. $box['title'] .'</h3>';
											}
											echo $icon; 
											echo '<div class="ibox-desc zn-paragraph-color">'. $box['desc'] .'</div>'; 
											if (!empty($link_extracted)) {
												echo $link_extracted['start'] . $link_text . $link_extracted['end'];
											}
										?>
									</div>
								</div>
								<?php
								}
							?>
						</div>
					</div>
				</div>
				<?php
				}
			?>
	</div> 
</div>

<?php zn_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>
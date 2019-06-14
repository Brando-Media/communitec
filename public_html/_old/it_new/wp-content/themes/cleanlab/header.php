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
</head>


<body <?php body_class( ); ?>>
	<?php
		// SHOW PRELOADER  
		$show_prealoader = zget_option( 'show_preloader' , 'general_options', false, '' );
		$scroll_header_layout = zget_option( 'scroll_header_layout' , 'general_options', false, 'zn_hide_show' );
		// GET THE HEADER LAYOUT
		$header_layout = get_post_meta( get_the_ID() , 'header_style', true );
		if (empty($header_layout)) {
			$header_layout = zget_option( 'header_layout' , 'general_options', false, 'header1' );
		}
	?>

<?php if ( $show_prealoader == 'yes' ) { echo '<div class="zn_page_preloader"> <div>&nbsp;</div> </div>'; } ?>

<?php do_action('zn_body_content'); ?>


<div id="page-wrapper" class="page_content">

	<?php
		if ($header_layout !== 'hidden') {
	?>

	<header id="header" class="nav-down <?php echo $scroll_header_layout; ?> <?php echo $header_layout; ?>">

	<!-- HIDDEN BAR -->
	<?php if ( zget_option( 'show_hiddenbar' , 'general_options' ) == 'yes') { get_template_part( 'header', 'hiddenbar' ); } ?>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 zn_main_header_container">
					<div class="logo-container <?php if (zget_option( 'show_infocard' , 'general_options' ) == 'yes') { echo 'hasinfocard'; } ?> <?php if (zget_option( 'show_infocard_hover' , 'general_options' ) == 'yes') { echo 'hasinfocard_img'; } ?>">
						
						<!-- LOGO -->
						<?php echo zn_logo(); ?>
						
						<!-- INFOCARD -->
						<?php if (zget_option( 'show_infocard' , 'general_options' ) == 'yes') { get_template_part( 'header', 'infocard' ); } ?>

					</div><!-- end logo-container -->

					<div class="zn-menu-container">

						<?php 
							/** HOOK ONTO THE ICONS AREA ( SEARCH, WOOCOMMERCE CART ) **/
							do_action( 'zn_header_icons' );
						?>
						
						<?php 
							$show_search_icon = zget_option( 'show_search_icon' , 'general_options', false, 'yes' );
							if ( 'yes' == $show_search_icon ) {
								?>
									<div class="searchPanel">
										<span class="icon-search3 zn-header-icon"></span>
										<?php get_search_form(); ?>
									</div><!-- end searchPanel -->
								<?php
							}
						?>


						<div class="zn-res-menuwrapper">
							<a href="#" class="zn-res-trigger zn-header-icon"></a>
						</div><!-- end responsive menu -->
				
						<?php 
							$args = array(
									'container' => 'div',
									'container_id' => 'main-menu',
									'walker' => 'znmegamenu'
								);
							zn_show_nav( 'main_navigation','main-menu', $args );
						?>
					</div>

				</div>
			</div>
		</div>
	</header>
	<?php } ?>
  <div id="content">
    

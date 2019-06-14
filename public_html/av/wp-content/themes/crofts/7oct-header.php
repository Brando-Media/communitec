<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    
    <!-- for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	<meta name="format-detection" content="telephone=no" />
		
    <!-- Favicon Icon -->
	<?php
	$favicon = get_template_directory_uri()."/images/favicon.ico";
	if ( function_exists( 'ot_get_option' ) ) {
		if (ot_get_option('pego_favicon') != '') {
			$favicon = ot_get_option('pego_favicon');
		}
	} 
	?>
	
	<link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" type="image/vnd.microsoft.icon"/>
	<link rel="icon" href="<?php echo esc_url($favicon); ?>" type="image/x-ico"/>	
	<?php
	
	$pego_search_place = '';
	if ( function_exists( 'ot_get_option' ) ) {
		if (ot_get_option('pego_search_placeholder_text') != '') {
			$pego_search_place =  ot_get_option('pego_search_placeholder_text');
		}
	}
	?>
	
	<script type="text/javascript">
        var search_placeholder = '<?php echo esc_js($pego_search_place); ?>';
    </script>
 
	 <!--[if IE]>		
	  <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/IELow.css"/>		
	<![endif]-->

	<?php wp_head(); ?>		
</head>
<body <?php body_class(); ?>>
	<?php pego_set_overlay_search(); ?>
	<div class="animsition global-wrapper">
		<?php 
		pego_set_header(); 
		?>
		<div class="container-wrapper">
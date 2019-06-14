<?php
if ( function_exists( 'ot_get_option' ) ) {




	$bodyBgCss = '';
	if ( function_exists( 'ot_get_option' ) ) {
		$bodyBgArray = ot_get_option('pego_global_background');
		if ($bodyBgArray) {
			$bodyBgCss = ' body { background: none; ';
			if ($bodyBgArray['background-color'] != '') { $bodyBgCss .= ' background-color: '.$bodyBgArray['background-color'].'; '; }
			if ($bodyBgArray['background-repeat'] != '') { $bodyBgCss .= ' background-repeat: '.$bodyBgArray['background-repeat'].'; '; }
			if ($bodyBgArray['background-attachment'] != '') { $bodyBgCss .= ' background-attachment: '.$bodyBgArray['background-attachment'].'; '; }
			if ($bodyBgArray['background-position'] != '') { $bodyBgCss .= ' background-position: '.$bodyBgArray['background-position'].'; '; }
			if ($bodyBgArray['background-size'] != '') { $bodyBgCss .= ' background-size: '.$bodyBgArray['background-size'].'; '; }
			if ($bodyBgArray['background-image'] != '') { $bodyBgCss .= ' background-image: url("'.$bodyBgArray['background-image'].'"); '; }
			$bodyBgCss .= ' } ';
 		}
	}
	

	
	$logocss = '';	
		
	if ( function_exists( 'ot_get_option' ) ) {
		if (ot_get_option('pego_logo_width') != '') {
			$logocss .=  '  .logo-text { min-width: '.ot_get_option('pego_logo_width').'px; } ';
		}
	
	
	if ((ot_get_option('pego_logo_width') != '')||(ot_get_option('pego_logo_height') != '')) {
		$logocss .= ' .logoImageRetina { ';	
		if (ot_get_option('pego_logo_width') != '') {
			$logocss .= ' width: '.ot_get_option('pego_logo_width').'px; ';
		}
		if (ot_get_option('pego_logo_height') != '') {
			//$logocss .= ' height: '.ot_get_option('pego_logo_height').'px; ';
		}
		$logocss .= ' } ';						
	}
	
	if (ot_get_option('pego_logo_retina') != '') {
		$logocss .= ' @media
						only screen and (-webkit-min-device-pixel-ratio: 2),
						only screen and (   min--moz-device-pixel-ratio: 2),
						only screen and (     -o-min-device-pixel-ratio: 2/1),
						only screen and (        min-device-pixel-ratio: 2),
						only screen and (                min-resolution: 192dpi),
						only screen and (                min-resolution: 2dppx) { 
  
 							 .logoImageRetina {
								display: block;
 					 		}
 							 .logoImage {
								display: none;
  							}
						} ';
		}
	}
	
	echo '<style>';
		echo $bodyBgCss;
		echo $logocss;
	echo '</style>';
	
	
		//additionalCSS
	if ( function_exists( 'ot_get_option' ) ) {
		if (ot_get_option('pego_additional_css') != '') {
			echo '<style type="text/css">';	
			echo ot_get_option('pego_additional_css');
			echo '</style>';
		}
	}
}
	

?>
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

	<header id="header" class="nav-down header4 zn_do_not_hide">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 zn_main_header_container">
					<div class="logo-container hasinfocard">
					
						<!-- LOGO -->
						<?php echo zn_logo(); ?>
						
						<!-- INFOCARD -->
						<?php if (zget_option( 'show_infocard' , 'general_options' ) == 'yes') { get_template_part( 'header', 'infocard' ); } ?>
					</div><!-- end logo-container -->
				</div>
			</div>
		</div>
	</header>
  <div id="content" class="page_content zn_coming_soon_page">
	
<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?php 

					$coming_soon_text1 = zget_option( 'coming_soon_text1', 'coming_soon' );
					$coming_soon_text2 = zget_option( 'coming_soon_text2', 'coming_soon' );
					
					if ( !empty( $coming_soon_text1 ) ) { echo '<h2 class="section-title center">'. $coming_soon_text1 .'</h2>'; }
					if ( !empty( $coming_soon_text2 ) ) { echo '<h3 class="center zn-paragraph-color mbottom30">'. $coming_soon_text2 .'</h3>'; }

					?>
					<?php if ( zget_option( 'enable_coming_soon_timer' , 'coming_soon' ) == 'yes' ) {

						$date = '2020-01-01 00:00:00';
						$launch_date = zget_option( 'cs_date' , 'coming_soon' );
						if ( !empty( $launch_date['date'] ) && !empty( $launch_date['time'] ) ) {
							$date = $launch_date['date'].' '. $launch_date['time'] ;
						}

						// Load the coming soon script
						wp_enqueue_script( 'comingsooncountdown' );
					?>

						<div id="countdown" class="row">
							<div class="col-sm-12 count-widget">
								<ul class="counter reset-list" data-date="<?php echo $date;?>">
								  <li>
									<span class="days"></span>
									<p class="timeRefDays"></p>
								  </li>
								  <li>
									<span class="hours"></span>
									<p class="timeRefHours"></p>
								  </li>
								  <li>
									<span class="minutes"></span>
									<p class="timeRefMinutes"></p>
								  </li>
								  <li>
									<span class="seconds"></span>
									<p class="timeRefSeconds"></p>
								  </li>
								</ul>
							</div>
						</div>
					<?php } ?>




					<!-- MAILCHIMP SUBSCRIBE -->
					<?php 
						$mailchimp_list = zget_option( 'mailchimp_list' , 'coming_soon' );
						$coming_soon_subscribe_text = zget_option('coming_soon_subscribe_text', 'coming_soon');
						if (empty($coming_soon_subscribe_text)){
							$coming_soon_subscribe_text = __('subscribe','zn_framework');
						}
					?>
					<?php if ( zget_option( 'enable_coming_soon_mailchimp' , 'coming_soon' ) == 'yes' && !empty( $mailchimp_list ) && zget_option( 'mailchimp_api' , 'general_options' ) ) { ?>
						<div class="cs_newsletter center mbottom80">
							<form method="post" class="zn_newsletter newsletter-signup" name="newsletter_form">
								<input type="text" name="zn_mc_email" class="nl-email" value="" placeholder="<?php _e('Enter your email address', 'zn_framework'); ?>" autocomplete="off">
								<input type="hidden" name="zn_mailchimp_list_id" class="zn_mailchimp_list_id" value="<?php echo $mailchimp_list;?>">
					 
									<button type="submit" name="submit" class="nl-submit btn zn_btn_3d"><?php echo $coming_soon_subscribe_text; ?></button>
	   
							</form>
							<div class="zn_mailchimp_message"></div>
						</div>
					<?php } ?>

					<?php
						$social_list = zget_option( 'cs_social_icons' , 'coming_soon' );
					?>
					<?php if (!empty($social_list)) {
						echo '<ul class="under-social center mbottom50">';
						foreach ( $social_list as $listItem ) {
							$icon_opt		= !empty( $listItem['icon'] ) ? $listItem['icon'] : '';
							$icon			= !empty( $icon_opt['family'] )  ? '<span class="tcolor" '.zn_generate_icon( $icon_opt ).'></span>' : '';
							$link_extracted = !empty( $listItem['social_link'] ) ? zn_extract_link( $listItem['social_link'] , '' ) : '';
							if (!empty($listItem['social_link']['url'])) {
								echo '<li>' . $link_extracted['start'] . $icon . $link_extracted['end'].'</li>';
							}
							else {
								echo '<li>'.$icon.'</li>';
							}
						}
						echo '</ul>';
					}
					?>

				</div>
			</div>
		</div>

	</div> 
</div>

<?php zn_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>
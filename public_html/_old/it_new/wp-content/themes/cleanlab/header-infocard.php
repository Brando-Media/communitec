<?php
	$info_logo = zget_option( 'infocard_logo' , 'general_options' );
	$left_text = zget_option( 'infocard_left' , 'general_options' );
	$right_text = zget_option( 'infocard_right' , 'general_options' );
	$social_list = zget_option( 'infocard_social' , 'general_options' );

?>

<div id="infocard">
	<div class="row">
		<div class="col-sm-5 center">
			<?php if (!empty($info_logo)) { ?>
			<img src="<?php echo esc_url( set_url_scheme( $info_logo ) ); ?>" alt="" class="mbottom20" />
			<?php } ?>
			<?php if(!empty($left_text)) {
				echo '<div class="zn_info_left">'. $left_text .'</div>';
			} ?>
		</div>
		<div class="col-sm-7 =">
			<?php if(!empty($right_text)) {
				echo '<div class="zn_info_right">'. $right_text .'</div>';
			} ?>
			<?php if (!empty($social_list)) {
				echo '<ul class="info-social center">';
				echo '<li class="width100 mbottom10 zn_get_social">' . __('Get Social','zn_framework') . '</li>';
				foreach ( $social_list as $listItem ) {
					$icon_opt		= !empty( $listItem['icon'] ) ? $listItem['icon'] : '';
					$icon			= !empty( $icon_opt['family'] )  ? '<span class="zn_icon_box_icon" '.zn_generate_icon( $icon_opt ).'></span>' : '';
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
</div><!-- end infocard -->
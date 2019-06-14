<?php

	$hb_icon_list = zget_option( 'hiddenbar_icon_list' , 'general_options' );
	$hb_social_list = zget_option( 'hiddenbar_social' , 'general_options' );
	$hiddenbar_width = zget_option( 'hiddenbar_width' , 'general_options', false, '9' );
?>
	<div id="panel">
		<div class="container">
			<div class="row">
				<div class="col-sm-<?php echo $hiddenbar_width; ?>">
				<?php if (!empty($hb_icon_list)) { //** Start icon list on left
					echo '<ul class="info-left">';
					foreach($hb_icon_list as $listItem)
					{
						$icon_opt		= !empty( $listItem['icon'] ) ? $listItem['icon'] : '';
						$icon			= !empty( $icon_opt['family'] )  ? '<span class="zn_icon_box_icon" '.zn_generate_icon( $icon_opt ).'></span>' : '';
						$link_extracted = !empty( $listItem['link'] ) ? zn_extract_link( $listItem['link'] , '' ) : '';
						echo '<li>'.$icon.'<p>'.$link_extracted['start'].  $listItem['text'] .$link_extracted['end'].'</p>';
					}
					echo '</ul>';
				} //** End icon list on left ?>
				</div>
				<div class="col-sm-<?php echo 12 - $hiddenbar_width; ?>">
				<?php if (!empty($hb_social_list)) { //** Start social list on right
					echo '<ul class="info-right text-right">';
					$i = 0;
					foreach ($hb_social_list as $listItem) {
						$icon_opt		= !empty( $listItem['icon'] ) ? $listItem['icon'] : '';
						$icon			= !empty( $icon_opt['family'] )  ? '<span class="zn_icon_box_icon" '.zn_generate_icon( $icon_opt ).'></span>' : '';
						$link_extracted = !empty( $listItem['social_link'] ) ? zn_extract_link( $listItem['social_link'] , '' ) : '';
						if (!empty($listItem['social_link']['url'])) {
							echo '<li class="animation zn_hb_icon_'.$i++.'">' . $link_extracted['start'] . $icon . $link_extracted['end'].'</li>';
						}
					}
					echo '</ul>';
				} //** End social list on right ?>
				</div>
			</div>
		</div>
	</div>
	<div class="slide">
		<div class="container relative">
			<a href="#" class="btn-slide"><span class="icon-angle-up"></span></a>
		</div>
	</div><!-- end sliding panel -->
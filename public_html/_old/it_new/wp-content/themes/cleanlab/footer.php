<?php 
  
	$footer = get_post_meta( get_the_ID() , 'show_footer', true );
	$footer_display = !empty($footer) ? $footer : zget_option( 'show_footer', 'general_options', false, 'show_footer' );
	$css_style = zget_option('footer_colors','style_options');

	if( $footer_display != 'hide_footer' )
	{

		echo '<footer id="footer" class="'.$css_style.'">';

		$footer_columns = zget_option( 'footer_columns', 'general_options' );
		if ( $footer_columns > 0  ) {
			echo '<div class="container footer_widgets">';
				echo '<div class="row">';
				$sm_xs_class = $footer_columns > 1 ? "col-sm-6 col-xs-6" : "";
				for( $i = 1; $i<=$footer_columns; $i++ ) {
					// Get the widget id
					$id = '-'.$i;
					$class = 'zn_footer_widget_container '.$sm_xs_class.' col-md-'. 12/$footer_columns;
					if ( $i == 1 ) { $id = ''; }
					
					echo '<div class="'.$class.'">';
						if ( !dynamic_sidebar('znfooter'.$id.'') ) : endif; 
					echo '</div>';

				}
				echo '</div>';
			echo '</div>';
		}

		echo '</footer>';

	}
	?>

	</div> 
</div>

<?php
	$show_backtotop = zget_option( 'show_backtotop', 'general_options', false, 'yes' );

	if ( 'yes' == $show_backtotop ) {
		?>
			<p id="back-top">
				<a href="#top"><span class="icon-angle-up"></span></a>
			</p>
		<?php
	}
?>


<?php zn_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>
<?php

	global $zn_config;

	$size = zn_get_wp_image_size($zn_config['size']);
	$post_data['media']   = zn_get_post_image( get_the_ID(), $size['width'] , $size['height'] , array( 'class' => "img-responsive animate" ) );
	$post_data['media'] = !empty( $post_data['media'] ) ? '<div class="mediaContainer scaleRotateImg">'.$post_data['media'].'</div>' : '';
	
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Page thumbnail.
		if ( !post_password_required() || has_post_thumbnail() ) {
			echo '<div class="article_media">';
			echo $post_data['media'];
			echo '</div>';
		}
	?>

	<div class="article_content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'           => '<div class="zn_post_pagination zn-secondary-color">'. __( 'Pages: ', 'zn_framework' ),
				'after'            => '</div>'
			) );

		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
<div class="zn_blog_separator clearfix"></div>


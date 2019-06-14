<div class="blog-posted mbottom100">
	<?php echo get_avatar( get_the_author_meta( 'user_email' ), 92 ); ?>
	<span class="tcolor"><?php echo get_the_date(); ?></span>
	<?php
			printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn" href="%2$s">%3$s</a></span></span>',
				_x( 'Author', 'Used before post author name.', 'twentyfifteen' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
	?>
	<?php 
		$desc = get_the_author_meta( 'description' );
		if ( !empty( $desc ) ) {
			echo '<p>'.$desc.'</p>';
		}
	?>
</div>
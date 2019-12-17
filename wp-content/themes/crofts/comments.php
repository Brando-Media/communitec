<div class="post-desc wpb_content_element">
	<h1>
		<?php
		printf( _n( 'Comments (%1$s)', 'Comments (%1$s)', get_comments_number(), '' ), number_format_i18n( get_comments_number() ), '' . esc_html(get_the_title()) . '' );
		?>
	</h1>
	<div class="all-comments"><?php wp_list_comments( 'avatar_size=55&type=comment&callback=pego_comment' ); ?></div>
	<?php paginate_comments_links(array('prev_text' => '&lsaquo; Previous', 'next_text' => 'Next &rsaquo;')); ?>
	<?php comment_form(); ?>
	<div class="clear"></div>
</div>

<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

	 <h2 class="section-title mbottom50">
		<?php
			printf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'zn_framework' ),
				number_format_i18n( get_comments_number() ) );
		?>
	</h2>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<!-- TODO -->
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'zn_framework' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'zn_framework' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'zn_framework' ) ); ?></div>
	</nav><!-- #comment-nav-above -->

	<?php endif; // Check for comment navigation. ?>

	<ul class="comments-list clearfix" id="commentlist">
		<?php
			wp_list_comments( array(
				'style'      => 'ul',
				'short_ping' => true,
				'avatar_size'=> 80,
				'callback'=> 'zn_comment_list_callback',
			) );
		?>
	</ul><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

<!-- TODO -->
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'zn_framework' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'zn_framework' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'zn_framework' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<div class="separator mbottom50"></div>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'zn_framework' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<div class="row">
		<div class="col-sm-12">
			<?php comment_form(); ?>
		</div>
	</div>
</div><!-- #comments -->

<?php

	global $zn_config;

	$post_format 	= get_post_format() ? get_post_format() : 'standard';
	$current_post   = zn_setup_post_data( $post_format );
	$is_single = is_single();
	$post_class = $is_single ? '' : 'archive_'.$zn_config['blog_style'] .' '. $zn_config['columns'];
	$show_post_head = true;

	// Prepare the final layout
	if ( !$is_single ){
		if ( $zn_config['blog_style'] == 'masonry' ) {

			wp_enqueue_script( 'isotope' );


			// Set a different meta
			$date = get_the_date();
			$hearts = zn_show_hearts( $post, false, 'zn-secondary-color' );
			$comments = '<span class="icon-bubbles4 mleft10 mright10"><span class="mleft5 zn-secondary-color">'.get_comments_number().'</span></span>';

			$current_post['meta']  = '<div class="zn_post_meta clearfix">';
			$current_post['meta'] .= '<div class="fleft"><span itemprop="datePublished updated" content="'.$date.'">'.$date.'</span></div>';
			$current_post['meta'] .= '<div class="fright">'. $hearts . $comments .'</div>';
			$current_post['meta'] .= '</div>';

			if ( $post_format == 'quote' ){
				$title = $current_post['title'];
				$meta  = $current_post['meta'];
				$current_post['before_content'] = str_replace( '</blockquote>', '</blockquote>'.$meta, $title );
			}
			else {
				$current_post['before_content'] = $current_post['title'];
				$current_post['after_content'] = $current_post['meta']; // We need different meta
				$current_post['title'] = '';
				$current_post['meta'] = '';
			}

			$show_post_head = false;
		}
		elseif ( $zn_config['blog_style'] == 'timeline' ){
			$date_format = zget_option( 'timeline_date', 'blog_options', false, 'F, y' );
			$current_post['after_head'] = '<span class="zn_timeline_date zn-primary-as-bg zn-alternative-color">'.get_the_date( $date_format ).'</span>';
			
		}
	}


	echo $current_post['before'];

		echo '<article id="post-'.get_the_ID().'" class="clearfix '. implode ( ' ' , get_post_class('blog-post' ) ) .' '.$post_class.'" itemscope itemtype="http://schema.org/Article">';
			
			echo '<div class="zn-article-inner">';

			// POST MEDIA
			echo $current_post['media'];
			?>

				<div class="article_content">

				<?php if ( !empty( $current_post['title'] ) && !empty( $current_post['meta'] ) && $show_post_head ) : ?>
					<div class="post-head mbottom30">

						<?php echo $current_post['before_head']; ?>

							<!-- ARTICLE TITLE -->
							<?php echo $current_post['title']; ?>

							<!-- ARTICLE META -->
							<?php echo $current_post['meta']; ?>

						<?php echo $current_post['after_head']; ?>

					</div>
				<?php endif; ?>

					<div class="post-content" itemprop="articleBody">
						<?php echo $current_post['before_content']; ?>
							<!-- ARTICLE CONTENT -->
							<div class="entry-content">
								<?php echo $current_post['content']; ?>
							</div>
						<?php echo $current_post['after_content']; ?>
						<?php 
							wp_link_pages( array(
								'before'           => '<div class="zn_post_pagination zn-secondary-color">'. __( 'Pages: ', 'zn_framework' ),
								'after'            => '</div>'
							) );
						?>
					</div>

				</div>
			</div> <!-- END zn-article-inner -->
				
		</article>


	<?php echo $current_post['after']; ?>
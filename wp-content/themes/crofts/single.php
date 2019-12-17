<?php get_header(); ?>
		<div id="container"> <!-- start container -->	
			<div class="center">
				<div class="page-wrapper blog-wrapper">
				<?php
					while ( have_posts() ) : the_post(); 
						$dateFormat = get_option( 'date_format' );
						$post_date = get_the_date($dateFormat);
						$post_categories = wp_get_post_categories( $post->ID );
						$comment_caption = " Comments";
						if (get_comments_number($post->ID) == 1) {
							$comment_caption = " Comment";
						}
						?>
						<div class="blog-post">
							<?php
							if ( has_post_thumbnail() ) {
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
								?>
									<div class="post-type-on-single">
										<img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>" />
									</div>
								<?php
							}
							?>
							<div class="post-description">
								<div class="blog-post-detail blog-post-date"><i class="post-details-icon pe-7s-clock"></i><?php echo esc_html($post_date); ?></div>
								<h1 class="blog-post-title"><?php echo esc_html(get_the_title($post->ID)); ?></h1>
								<div class="blog-post-detail blog-post-comment"><i class="post-details-icon pe-7s-comment"></i><a href="<?php comments_link(); ?>" ><?php echo esc_html(get_comments_number($post->ID)); ?><span><?php echo esc_html($comment_caption); ?></span></a></div>
								<?php
									$counter = 0;
									if ($post_categories) {
										?>
										<div class="blog-post-detail blog-post-categories"><i class="post-details-icon pe-7s-note"></i>
										<?php
										foreach ($post_categories as $single_cat) {
											$cat = get_category( $single_cat );
											$cat_url =  get_category_link($cat->cat_ID);
											if ($counter != 0) {
												echo ', <a href="'.esc_url($cat_url).'" title="'.esc_attr($cat->name).'">'.esc_html($cat->name).'</a>';
											} else
											{
												echo '<a href="'.esc_url($cat_url).'" title="'.esc_attr($cat->name).'">'.esc_html($cat->name).'</a>';
											}
											$counter++;
										
										}
										?>
										</div>
										<?php
									}
									?>
							</div>
							<div class="blog-post-content">
								<?php echo the_content(); ?>
								<div class="clear"></div>
								<?php
								if( has_tag() ) {
										?>
										<div class="blog-post-detail blog-post-tags"><i class="post-details-icon pe-7s-ticket"></i>
										<?php
									 		the_tags( '', ', ', '' );
									 	?>
									 	</div>
									 	<?php
									 }
									 ?> 
								<div id="comments">
									<?php comments_template(); ?>
								</div>	
							</div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					<?php endwhile; ?>
				</div>
			</div>	
		</div><!-- end container -->
		<div class="sidebar-wrap">
			<?php
				$pego_sidebarSelected = 'blog-sidebar1';
				if ( is_active_sidebar(esc_html($pego_sidebarSelected)) ) :
					if (function_exists('dynamic_sidebar') && dynamic_sidebar(esc_html($pego_sidebarSelected))) : else : ?>

					<?php endif; ?>	
				<?php endif; ?>
			<div class="close-button" id="close-button"><i class="sidebar-close-icon pe-7s-close"></i></div>
		</div>
		<div class="sidebar-button" id="open-button"><i class="sidebar-open-icon icon-plus"></i></div>
<?php get_footer(); ?>
<?php
/*
Template Name: Template Blog
*/
?>  
<?php get_header(); ?>
		<div id="container"> <!-- start container -->	
			<div class="center">
				<div class="page-wrapper blog-wrapper">
				<?php
					if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) {$paged = get_query_var('page'); } else { $paged = 1; }
					$cat_ids = '';
					if ($cat_ids) {
						$comma_separated_cats = implode(",", $cat_ids);
						query_posts( array( 'post_type' => 'post', 'cat' => $comma_separated_cats, 'paged' => $paged ) );
					} else {
						query_posts( array( 'post_type' => 'post', 'paged' => $paged ) );
					}
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
								<a class="blog-post-thumb" href="<?php echo esc_url(get_permalink($post->ID)); ?>" title="<?php echo esc_attr(get_the_title($post->ID)); ?>" >
									<img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>" />
									<div class="view-overlay-icon pe-7s-plus"></div>
									<div class="view-overlay-bg"></div>
								</a>
								<div class="clear"></div>
								<?php
							}
							?>
							<div class="post-description">
								<div class="blog-post-detail blog-post-date"><i class="post-details-icon pe-7s-clock"></i><?php echo $post_date; ?></div>
								<h1 class="blog-post-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>" title="<?php echo esc_attr(get_the_title($post->ID)); ?>" ><?php echo esc_html(get_the_title($post->ID)); ?></a></h1>
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
								<?php 
									$content = get_the_content();
									if (strpos($content,'[vc_end_excerpt]') !== false) {
										$excerpt_part = explode("[vc_end_excerpt]", $content);
										$content =  $excerpt_part[0].'[/vc_column][/vc_row]';
										echo do_shortcode($content);
									} else {
										echo get_the_excerpt();
									}
								 ?>
								<div class="clear"></div>
								<?php
									$readmore = 'Read more';
									if ( function_exists( 'ot_get_option' ) ) {
										if (ot_get_option('pego_read_more_text') != '') {
											$readmore  = ot_get_option('pego_read_more_text');
										}
									}
								?>
								<div class="post-read-more-wrap">
									<a class="post-read-more" href="<?php echo esc_url(get_permalink($post->ID)); ?>" title="<?php echo esc_attr(get_the_title($post->ID)); ?>"><?php echo esc_html($readmore);  ?></a>
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					<?php endwhile; ?>
					<div class="pagination-wrapper">
						<?php pego_kriesi_pagination(); ?>
					</div>
				</div>
			</div>	
		</div><!-- end container -->
<?php get_footer(); ?>
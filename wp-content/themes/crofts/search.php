<?php get_header(); ?>
		<div class="page-title-wrapper">
				<div class="page-title">
					<h1><?php echo get_search_query(); ?></h1>
					<div class="page-title-divider">
						<div class="page-title-left-divider"></div>
						<i class="page-title-icon icon-down-dir"></i>
						<div class="page-title-right-divider"></div>
					</div>
					<h3><?php _e('search results','crofts'); ?></h3>
					<div class="clear"></div>
				</div>
			</div>	
		<div class="clear"></div>
		<div id="container"> <!-- start container -->	
			<div class="center">
				<div class="page-wrapper">
					<?php
						$counter = 0;
						if ( have_posts() ) : 
						while ( have_posts() ) : the_post();
							$format = get_post_format( $post->ID );	
							$post_categories = wp_get_post_categories( $post->ID );
							$dateFormat = get_option( 'date_format' );
							$post_date = get_the_date($dateFormat);
							$time_format = get_option( 'time_format' );
							$post_time = get_the_time($time_format);
							$title = get_the_title($post->ID); 
							$link = get_the_permalink();
							if ((get_post_type( $post ) == 'post')||(get_post_type( $post ) == 'portfolio')||(get_post_type( $post ) == 'page')) {
								$counter++;
								$dateFormat = get_option( 'date_format' );
								$post_date = get_the_date($dateFormat);
								$post_categories = wp_get_post_categories( $post->ID );
								$comment_caption = " Comments";
								if (get_comments_number($post->ID) == 1) {
									$comment_caption = " Comment";
								}
								$post_type = 'Post';
								if (get_post_type( $post ) == 'page') { $post_type = 'Page'; }
								if (get_post_type( $post ) == 'portfolio') { $post_type = 'Portfolio'; }
								?>
						
								<div class="search-item">
									<?php
									 if (get_post_type( $post ) == 'portfolio') {
									?>
										<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" title="<?php echo esc_attr(get_the_title($post->ID)); ?>" class="search-thumb">
											<?php
												if (has_post_thumbnail( $post->ID )) {
													echo get_the_post_thumbnail( $post->ID, 'thumbnail' );  
													echo '<div class="view-overlay-icon pe-7s-plus"></div>';
													echo '<div class="view-overlay-bg"></div>';
												} else {
													echo '<i class="search-results-icon pe-7s-pen"></i>';
												}
											?>
										</a>
									<?php
									} else {
									?>
										<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" title="<?php echo esc_attr(get_the_title($post->ID)); ?>" class="search-thumb">
											<?php
												if (has_post_thumbnail( $post->ID )) {
													echo get_the_post_thumbnail( $post->ID, 'thumbnail' );  
													echo '<div class="view-overlay-icon pe-7s-plus"></div>';
													echo '<div class="view-overlay-bg"></div>';
												} else {
													echo '<i class="search-results-icon pe-7s-pen"></i>';
												}
											?>
										</a>
									<?php
									}
									?>
									<div class="single-search-item-details">
											<?php 
											 if (get_post_type( $post ) == 'post') {
											 ?>
												 <h1 class="search-item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>" title="<?php echo esc_attr(get_the_title($post->ID)); ?>" ><?php echo esc_html(get_the_title($post->ID)); ?></a></h1>
												<ul class="search-item-details">
												<li class="search-item-detail-single"><?php echo esc_html($post_type); ?></li>
													<li class="search-item-detail-single"><?php echo esc_html($post_date); ?></li>
													<li class="search-item-detail-single"><a href="<?php comments_link(); ?>" ><?php echo esc_html(get_comments_number($post->ID)); ?><span><?php echo esc_html($comment_caption); ?></span></a></li>
													<?php
													$counter = 0;
														if ($post_categories) {
															?>
															<li class="search-item-detail-single">
															<?php
															foreach ($post_categories as $single_cat) {
																$cat = get_category( $single_cat );
																$cat_link =  get_category_link($cat->cat_ID);
																if ($counter != 0) {
																	echo ', <a href="'.esc_url($cat_link).'"  title="'.esc_attr($cat->name).'">'.esc_html($cat->name).'</a>';
																} else
																{
																	echo '<a href="'.esc_url($cat_link).'"  title="'.esc_attr($cat->name).'">'.esc_html($cat->name).'</a>';
																}
																$counter++;
															}
															?>
															</li>
															<?php
														}
														?>
													</ul>
													<?php
												
											}
											elseif (get_post_type( $post ) == 'portfolio') {
											?>
											 <h1 class="search-item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>" title="<?php echo esc_attr(get_the_title($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h1>
												<ul class="search-item-details">
													<li class="search-item-detail-single"><?php echo esc_html($post_type); ?></li>
												</ul>
												<?php
												}
												else {
												?>
													<h1 class="search-item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>" title="<?php echo esc_attr(get_the_title($post->ID)); ?>" ><?php echo esc_html(get_the_title($post->ID)); ?></a></h1>
													<ul class="search-item-details">
													<li class="search-item-detail-single"><?php echo esc_html($post_type); ?></li>
													</ul>
												<?php
												}
												?>
											
									</div>
									<div class="clear"></div>
								</div>
								<?php
								if ($counter %2 == 0) {
								?>
								<div class="clear"></div>
								<?php
								}
							}
						endwhile; 
						?>	
						<div class="pagination-wrapper">
							<?php pego_kriesi_pagination(); ?>
						</div>	
					<?php else : ?>
					<div class="page-wrapper search-header">
						<h2><?php esc_html_e('No results found.','crofts'); ?></h2>
						<p><?php esc_html_e('If you are not satisfied with search results, enter new search words.','crofts'); ?></p>
						<div class="widget_search search_page_search_form">
							<?php echo do_shortcode('[wpbsearch]'); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div> 
	</div><!-- end container -->		
<?php get_footer(); ?>
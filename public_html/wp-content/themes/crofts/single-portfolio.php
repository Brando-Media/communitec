<?php get_header(); ?>
	<div id="container"> <!-- start container -->	
	<?php
			$pego_portfolio_type = get_post_meta($post->ID , $GLOBALS['wpcf_prefix'].'portfolio-type' , true);
			if ($pego_portfolio_type == 'type1') {
				while ( have_posts() ) : the_post(); 
				$title = get_the_title($post->ID); 
				 ?>				
					<div class="portfolio-single-type1">
						<div class="portfolio-single-type1-description">
							<h1 class="portfolio-single-type1-title"><?php echo esc_html($title); ?></h1>
								<div class="portfolio-single-type1-title-divider">
								<div class="portfolio-single-type1-title-left-divider"></div>
								<i class="portfolio-single-type1-title-icon icon-down-dir"></i>
								<div class="portfolio-single-type1-title-right-divider"></div>
							</div>
							<div class="portfolio-single-content">
								<?php the_content(); ?>
							</div>
						</div>
						<div class="portfolio-single-type1-images">
						 <?php
					
							 $attachments = get_children(array( 'post_parent' => $post->ID,
													'post_status' => 'inherit',
													'post_type' => 'attachment',
													'post_mime_type' => 'image',
													'order' => 'ASC',
													'orderby' => 'menu_order ID'));
								$counter = 0;	
								$idGallery = rand(1, 10000);						  		
								foreach($attachments as $att_id => $attachment) {
									$counter++;
									$post_thumbnail = pego_getImageBySize(array(  'attach_id' => $attachment->ID, 'thumb_size' => 'full' ));
									$thumbnail = $post_thumbnail['thumbnail'];
									$image = wp_get_attachment_image_src( $attachment->ID, 'full', true ); 
									echo $thumbnail; 
								}	
							?>
						</div>
					</div>
					<?php
					endwhile;
				} elseif ($pego_portfolio_type == 'type2') {
					 ?>				
					<style> @media only screen and  (min-width: 960px)   {  .global-wrapper, .container-wrapper, #container { height: 100%; } } </style>
  				  <?php
					wp_enqueue_script('pego_bootstrap');
					while ( have_posts() ) : the_post(); 
						$title = get_the_title($post->ID); 
						?>
						<div class="portfolio-single-type2">
							<div class="portfolio-single-type2-hidden-content">
								<div class="portfolio-single-type2-visible-content">
									<i class="portfolio-single-type2-show-details-icon icon-left-dir"></i>	
									<i class="portfolio-single-type2-hide-details-icon icon-right-dir"></i>	
								</div>
								<h1 class="portfolio-single-type1-title"><?php echo esc_html($title); ?></h1>
								<div class="portfolio-single-type1-title-divider">
									<div class="portfolio-single-type1-title-left-divider"></div>
									<i class="portfolio-single-type1-title-icon icon-down-dir"></i>
									<div class="portfolio-single-type1-title-right-divider"></div>
								</div>
								<div class="portfolio-single-type2-hidden-content-inner">
									<?php the_content(); ?>
								</div>
							</div>
							<div id="myCarousel" class="carousel slide">
								 <div class="carousel-inner">
									 <?php
			
										 $attachments = get_children(array( 'post_parent' => $post->ID,
																'post_status' => 'inherit',
																'post_type' => 'attachment',
																'post_mime_type' => 'image',
																'order' => 'ASC',
																'orderby' => 'menu_order ID'));
											$counter = 0;	
											$idGallery = rand(1, 10000);						  		
											foreach($attachments as $att_id => $attachment) {
												$counter++;
												$post_thumbnail = pego_getImageBySize(array(  'attach_id' => $attachment->ID, 'thumb_size' => 'full' ));
												$thumbnail = $post_thumbnail['thumbnail'];
												$image = wp_get_attachment_image_src( $attachment->ID, 'full', true ); 
												$extra_class = '';
												if ($counter == 1) { $extra_class = ' active'; } 
												?>
												<div class="item<?php echo esc_attr($extra_class); ?>">
													<div class="fill" style="background-image:url('<?php echo esc_url($image[0]); ?>');"></div>
												</div>
							
												<?php
											}	
									?>
								</div>
								<!-- Controls -->
								<a class="left carousel-control" href="#myCarousel" data-slide="prev">
									<span class="slide-icon-prev pe-7s-angle-left"></span>
								</a>
								<a class="right carousel-control" href="#myCarousel" data-slide="next">
									<span class="slide-icon-next pe-7s-angle-right"></span>
								</a>
							</div>
						</div>
					<?php
					endwhile;
					} 
					else {
					?>
					<div class="center">
						<div class="page-wrapper">
							<?php while ( have_posts() ) : the_post();  ?>				
									<?php the_content(); ?>
							<?php endwhile; ?>
						</div>
					</div>	
						<?php
					}
					?>
		
	</div><!-- end container -->
<?php get_footer(); ?>
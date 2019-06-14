<?php get_header( );?>


<?php 
	//** News bar
	zn_get_news_bar();
	
	//** Put the header with title and breadcrumb
	$args = array(
			'heading' => 'h1',
		);
	zn_get_header_breadcrumb( $args );
?>

<?php
	global $zn_config;

?>
<!--Blog section-->
<div class="container mbottom50">
	<div class="row">
		
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php
					$image_array = $big_images = $thumbs = array();
					// GET POST IMAGE
					if ( has_post_thumbnail() && zget_option( 'port_add_feat_img', 'portfolio_options', false, 'yes' ) == 'yes' ) {
						// $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , 'full' );
						$image_array[] = get_post_thumbnail_id( $post->ID );
					}

					$custom_images = get_post_meta( $post->ID, 'project_images', true );

					if ( !empty( $custom_images ) ) {

						$attachments = get_posts(array(
							'include' => $custom_images,
							'post_status' => 'inherit',
							'post_type' => 'attachment',
							'post_mime_type' => 'image',
							'order' => 'ASC',
							'orderby' => 'post__in')
						);

						if(!empty($attachments) && is_array($attachments))
						{
							foreach ($attachments as $attachment) {
								$image_array[] = $attachment->ID;
							}
						}
					}


					if ( is_array($image_array) ) {
						foreach ($image_array as $key => $value) {
							$full_images[] = wp_get_attachment_url( $value );
							$big_images[] = zn_get_image( $value, 653, 366 );
							$thumbs[] = zn_get_image( $value, 161, 106 );
						}
					}
				?>

				<div class="col-sm-7">
					<div class="zn_portfolio_slider mbottom50">
						<div class="zn_portfolio_slider_container zn_owl_carousel" data-navigation="true">
							<?php 
								foreach ($big_images as $key => $value) {
									echo '<a data-lightbox-gallery="single_portfolio_gallery" href="'.$full_images[$key].'" class="zn-nivo-lightbox">';
										echo $value;
									echo '</a>';
								}
							?>
						</div>
						<div class="zn_portfolio_thumbs_container">
							<?php 
								foreach ($thumbs as $key => $value) {
									echo $value;
								}
							?>
						</div>
					</div>
				</div>

				<div class="col-sm-5">

					<div class="project-info">
						<!-- POST CONTENT -->
						<?php if($post->post_content != "") : ?>
							<h2 class="section-title mbottom20"><?php _e('Project Description', 'zn_framework'); ?></h2>
							<div class="mbottom30"><?php the_content(); ?></div>
						<?php endif; ?>

						<h2 class="section-title mbottom20"><?php _e('Project Details', 'zn_framework'); ?></h2>
						<ul class="info mbottom20 reset-list">

							<?php 
								$details = get_post_meta( $post->ID, 'project_details', true );

								if ( !empty( $details ) ) {
									foreach ($details as $key => $value) {
										echo '<li>';
											if ( !empty( $value['detail_name'] ) ) 
											{
												echo '<span class="zn-secondary-color">'. $value['detail_name'] .':</span>';
											}
											if ( !empty( $value['detail_value'] ) ) 
											{
												echo  $value['detail_value'];
											}
										echo '</li>';
									}
								}

							?>

							<li>
								<span class="zn-secondary-color"><?php _e( 'Date:', 'zn_framework'); ?></span><?php echo get_the_date(); ?>
							</li>

							<?php
								$posttags = get_the_terms(get_the_ID(), 'portfolio_tags');
								$the_tags = $i = 1;
								if ( !empty( $posttags ) ) {
									$count = count($posttags );
									echo '<li><span class="zn-secondary-color">'. __( 'Tags:', 'zn_framework' ).'</span>';
									foreach( $posttags as $tag ){
										echo '<a href="'.esc_url( get_term_link($tag->term_id, 'portfolio_tags' ) ).'">'.$tag->name . '</a>';
										if ( $i!=$count ) { echo ' , '; }
										$i++;
									}
									echo '</li>';
								}
							?>

						</ul>
						<ul class="project-social mbottom30 clearfix reset-list">
							<li>
								<?php zn_show_hearts( $post ); ?>
							</li>
							<li>
								<span><?php _e( 'Share on:', 'zn_framework' ); ?></span>
							</li>
							<?php zn_get_share_links(); ?>
						</ul>

						<?php
							if ( $button_text = get_post_meta( $post->ID, 'button_text', true ) ) {
								$link_extracted = zn_extract_link( get_post_meta( $post->ID, 'button_link', true ), 'btn zn_btn_3d');

								echo $link_extracted['start'] . $button_text . $link_extracted['end'];

							}
						?>

					</div>

				</div>			
					
			<?php endwhile; endif; ?>

		</div> 
	</div>
<!--END Blog section-->


<?php
	$tag_ids = wp_get_post_terms( zn_get_the_id(), 'portfolio_tags', array( 'fields' => 'ids' ) );

	if ( $tag_ids ) {
		$args = array(
			'post_type' => 'portfolio',
			'posts_per_page' =>  6,
			'post__not_in'   => array( zn_get_the_id() ),
			'tax_query' => array (
				array(
					'taxonomy' => 'portfolio_tags',
					'field' => 'id',
					'terms' =>  $tag_ids,
					'operator' => 'IN'
				)
			)
		);

		$portfolio_items = get_posts( $args );
	}
?>

<?php if (!empty($portfolio_items)) { ?>
<!-- RELATED PROJECT -->
<div class="pbottom50 zn_portfolio_related zn-alternative-bkg">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2 class="section-title mtop50"><?php _e( 'Related Projects', 'zn_framework' ); ?></h2>

				<div class="zn_portfolio_related_carousel zn_owl_carousel owl-theme solidNav overTop" data-navigation="true">

				<?php

					foreach ( $portfolio_items as $post ) {
						setup_postdata($post);

						if ( has_post_thumbnail() ) {
							// $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , 'full' );
							$image = zn_get_image( get_post_thumbnail_id( $post->ID ), 270, 215 );
						}else{
							$custom_images = get_post_meta( $post->ID, 'project_images', true );
							if( !empty( $custom_images[0]['image'] ) ) {
								$image = zn_get_image( $custom_images[0]['image'], 270, 215 );
							}
						}

						echo '<div class="item">';
							echo '<a href="'.esc_url( get_permalink() ).'">'.$image.'</a>';
							echo '<h4><a href="'.esc_url( get_permalink() ).'" title="'.esc_attr( get_the_title() ).'">'.get_the_title().'</a></h4>';
							echo '<span class="tcolor">'. get_the_date().'</span>';
						echo '</div>';

					}
				?>

				</div>
			</div>
		</div>
	</div>
</div><!-- end recent-works2 -->

<?php } ?>


<?php get_footer( );?>
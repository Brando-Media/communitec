<?php

	if ( have_posts() ) {

		global $zn_config;

		$zn_config['main_class'] = isset( $zn_config['main_class'] ) ? $zn_config['main_class'] : 'col-sm-12';
		$terms = get_terms( 'portfolio_categories' );
		$archive_type = is_tax();

	?>
		<main class="zn-portfolio-wrapper <?php echo $zn_config['main_class']; ?> mbottom50">
			
		<?php if ( !$archive_type ) : ?>
			<div class="zn-portfolio-header">
				<div  class="zn-portfolio-filters filters-nav <?php echo empty($desc) ? '' : 'mtop30'; ?>">
					<?php
						echo "<ul class='reset-list'>";
						echo '<li><a  class="filter-item is-active" href="#" title="'.esc_attr__('All', 'zn_framework').'" data-filter="*">'.__('All', 'zn_framework').'</a></li>';
						foreach ( $terms as $term ) {

							$term = sanitize_term( $term, 'portfolio_categories' );

							$term_link = get_term_link( $term, 'portfolio_categories' );

							// CHECK IF WE HAVE AN ERROR
							if ( is_wp_error( $term_link ) ) {
								continue;
							}
							echo '<li><a  class="filter-item" href="'. esc_url( $term_link ).'" title="'.esc_attr( $term->name ).'" data-filter="'.esc_attr( $term->slug ).'">' . $term->name . '</a></li>';

						}
					echo "</ul>";
					?>
				</div>
			</div>
		<?php endif; ?>
			<div class="zn-portfolio-container portfolio-wrapper row">
			<?php

				while ( have_posts() ) : the_post();
					get_template_part( 'template_helpers/portfolio', 'default' );
				endwhile;
			?>
			</div>
			<div class="center zn_blog_pagination">
				<?php zn_pagination(); ?>
			</div><!-- end pagination -->
		</main>
	<?php
	}
	else {
		get_template_part( 'content', 'none' );
	}

?>
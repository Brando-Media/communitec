<?php

	global $zn_config;

	$zn_config['main_class'] = isset( $zn_config['main_class'] ) ? $zn_config['main_class'] : '';


	if ( have_posts() ) {



		echo '<main class="zn-search-container '.$zn_config['main_class'].' mbottom50">';

			while ( have_posts() ) : the_post();

				get_template_part( 'template_helpers/content', 'search' );

				if ( is_single() ) {
					echo '<div class="separator mbottom50"></div>';
					get_template_part( 'author', 'about' );
				}

			endwhile;
			
			// Blog pagination 
			echo '<div class="center zn_blog_pagination">';
				zn_pagination();
			echo '</div><!-- end pagination -->';
				
		echo '</main>';

	}
	else {
		echo '<main class="zn-search-container '.$zn_config['main_class'].' mbottom50">';
		?>
			<article id="post-<?php echo get_the_ID(); ?>" class="clearfix <?php echo implode ( ' ' , get_post_class('blog-post col-sm-12' ) ); ?>" itemscope itemtype="http://schema.org/Article">
				<div class="zn-article-inner">
					<div class="article_content">
						<div class="post-head mbottom30">

							<!-- ARTICLE TITLE -->
							<h2 class="article_title"><?php _e('No posts matched your criteria. Please try another search', 'zn_framework'); ?></h2>

						</div>
						<div class="post-content" itemprop="articleBody">
							<!-- ARTICLE CONTENT -->
			                <p><?php _e('You might want to consider some of our suggestions to get better results:', 'zn_framework'); ?></p>
			                <ul>
			                    <li><?php _e('Check your spelling.', 'zn_framework'); ?></li>
			                    <li><?php _e('Try a different keyword', 'zn_framework'); ?></li>
			                    <li><?php _e('Try using more than one keyword.', 'zn_framework'); ?></li>
			                </ul>

						</div>
					</div>
				</div> <!-- END zn-article-inner -->
			</article> <!-- END article -->

		<?php
		echo '</main>';
	}

?>
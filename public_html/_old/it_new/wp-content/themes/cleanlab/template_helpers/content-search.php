<?php

	global $zn_config;

	$pid 		= get_the_ID();
?>

	<article id="post-<?php echo get_the_ID(); ?>" class="clearfix <?php echo implode ( ' ' , get_post_class('blog-post' ) ); ?>" itemscope itemtype="http://schema.org/Article">
		<div class="zn-article-inner">
			<div class="article_content">
				<div class="post-head mbottom30">

						<!-- ARTICLE TITLE -->
						<?php echo zn_wrap_titles( get_the_title() ); ?>

						<!-- ARTICLE META -->
						<?php 

						// DATE
						$date = get_the_date();
						echo '<time class="tcolor" itemprop="datePublished" content="'.$date.'">'.$date.'</time>';
						
						// COMMENTS
						if( get_post_type() !== "page")
						{
							if ( get_comments_number() != "0" || comments_open() )
							{
							   
								echo '<span class="icon-bubbles4 mleft10 mright10"><span class="mleft5 zn-secondary-color">';
								comments_popup_link(  "0 ".__('Comments','zn_framework'),
													  "1 ".__('Comment' ,'zn_framework'),
													  "% ".__('Comments','zn_framework'),
													  '',
													  "".__('Comments Disabled','zn_framework')
													);
								echo '</span></span>';
							}
						}

						// TAGS 
						$taxonomies  = get_object_taxonomies(get_post_type($pid));
						$cats = '';
						$excluded_taxonomies = array('post_tag','post_format');

						if(!empty($taxonomies))
						{
							foreach($taxonomies as $taxonomy)
							{
								if(!in_array($taxonomy, $excluded_taxonomies))
								{
									$cats .= get_the_term_list($pid, $taxonomy, '', ', ','').' ';
								}
							}
						}

						if(!empty($cats))
						{
							echo '<span class="blog-categories italic">'.__('in','zn_framework')." ";
							echo $cats;
							echo '</span>';
						}

						if ( current_user_can( 'edit_post', $post->ID ) ) 
						{
							echo ' <span class="edit-link tcolor italic"> <a href="'.esc_url( get_edit_post_link() ).'">'. __( ' (Edit)', 'zn_framework' ) .'</a></span>';
						}

						?>

				</div>
				<div class="post-content" itemprop="articleBody">
					<!-- ARTICLE CONTENT -->
					<div class="entry-content">
						<?php the_excerpt(); ?>
					</div>
				</div>
		</div>
	</div> <!-- END zn-article-inner -->
</article> <!-- END article -->

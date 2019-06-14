<?php

	global $zn_config, $post;
	wp_enqueue_script( 'isotope' );

	$title = get_the_title();
	$author = get_the_author();
	$link = esc_url( get_permalink() );
	$post_thumbnail_id = get_post_thumbnail_id( $post->ID );

	$posttags = get_the_terms(get_the_ID(), 'portfolio_categories');
	$postTagsFilter = '';

	if ($posttags) {
		foreach( $posttags as $tag ){
			$postTagsFilter .= $tag->slug .' ';	
		}
	}

?>
	<article id="post-<?php echo get_the_ID(); ?>" class="clearfix <?php echo implode ( ' ' , get_post_class('portfolio-post text-center col-sm-4 col-xs-12' ) ); ?>" data-filter="<?php echo esc_attr( $postTagsFilter ); ?>" itemscope itemtype="http://schema.org/Article">
		
		<div class="imgContainer borderEffectHover growEffectHover">
			<?php echo zn_get_image( $post_thumbnail_id, 360, 360, array('class' => "img-responsive"));  ?>
			<div class="first_overlay borderEffect"></div>
			<div class="second_overlay growEffect zn-alternative-color">
				<h3 class="zn-alternative-color"><a href="<?php echo $link; ?>" class="zn-alternative-color" title="<?php echo esc_attr( $title ); ?>"><?php  echo $title; ?></a></h3>
				<p><?php echo $author; ?></p>
				<a href="<?php echo $link; ?>" class="zn-alternative-color" title="<?php echo esc_attr( $title ); ?>"><?php _e('View project','zn_framework'); ?></a>
			</div>
		</div>
	
	</article>

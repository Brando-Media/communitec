<?php
/*--------------------------------------------------------------------------------------------------
	Set-up post data
--------------------------------------------------------------------------------------------------*/
if ( !function_exists('zn_setup_post_data') ){
	function zn_setup_post_data( $post_format, $post_style = false ) {

		global $zn_config, $post;

		//$content_type = !empty( $zn_config['blog_content'] ) ? $zn_config['blog_content'] : 'content';

		$imgBig = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
		$columns_size = ( strpos( $zn_config['main_class'] , 'sidebar_right' ) !== false || strpos( $zn_config['main_class'] , 'sidebar_left' ) !== false ) ? 'col-sm-9' : 'col-sm-12';
		$size = zn_get_wp_image_size( $columns_size );
		$post_data['media']   = zn_get_post_image( get_the_ID(), $size['width'] , $size['height'], array('itemprop'=>'image') );

		
		$post_data['title']   = get_the_title();
		$post_data['content'] = get_the_content(__('More info','zn_framework') );
		//$post_data['content'] = get_the_excerpt();
		$post_data['meta']    = zn_get_the_meta();

		if (!is_single() && !empty( $post_data['media'] ) ) {
			$post_data['media'] = '<a href="'.get_permalink().'">'.$post_data['media'].'</a>';
		}

		// Separate post content and media
		$post_data            = apply_filters( 'post-format-'. $post_format , $post_data , $columns_size );
		// Apply the 'the_content' filter
		$post_data['content'] = apply_filters( 'the_content' , $post_data['content'] );


		// WRAP POST MEDIA 
		// print_Z($post_data['media']);

		$post_data['media'] = !empty( $post_data['media'] ) ? '<div class="mediaContainer mbottom30">'.$post_data['media'].'</div>' : '';


		// CHECK TO SEE IF WE NEED TO WRAP THE ARTICLE
		$post_data['before'] = ''; // Before the opening article tag
		$post_data['after'] = ''; // After the closing article tag

		$post_data['before_head'] = '';
		$post_data['after_head'] = '';

		$post_data['before_content'] = ''; // After the opening article tag
		$post_data['after_content'] = ''; // Before the closing article tag

		return $post_data;
	}
}

/*--------------------------------------------------------------------------------------------------
	Wrap post titles based on page
--------------------------------------------------------------------------------------------------*/
if ( !function_exists('zn_wrap_titles') ){
	function zn_wrap_titles( $title , $link = true ){

		if ( $link ) {
			$title   = is_single() ? '<h1 class="article_title entry-title">'. $title .'</h1>' : '<h2 class="article_title entry-title"><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">'. $title .'</a></h2>';	
		}
		else {
			$title   = is_single() ? '<h1 class="article_title entry-title">'. $title .'</h1>' : '<h2 class="article_title entry-title">'. $title .'</h2>';	
		}

		return $title;
	}
}

/*--------------------------------------------------------------------------------------------------
	Returns the post meta
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_get_the_meta' ) ) {
	function zn_get_the_meta(){

		global $post;

		$date = get_the_date();
		$result = '<span class="tcolor updated" itemprop="datePublished" content="'.$date.'">'.$date.'</span>';
		$result .= zn_show_hearts( $post, false, 'zn-secondary-color' );
		$result .= '<span class="icon-bubbles4 mleft10 mright10"><span class="mleft5 zn-secondary-color">'.get_comments_number().'</span></span>';
		$result .= '<span class="italic mright10">'.get_the_category_list( ', ' ).'</span>';
		$result .= get_the_tag_list( '<span class="italic mright10">Tags: ',', ','</span>' );
		

		if ( current_user_can( 'edit_post', $post->ID ) ) {
			$result .= ' <span class="edit-link tcolor italic"> <a href="'.esc_url( get_edit_post_link() ).'">'. __( ' (Edit)', 'zn_framework' ) .'</a></span>';
		}

		return $result;
	}
}

/*--------------------------------------------------------------------------------------------------
	Post types filters
--------------------------------------------------------------------------------------------------*/
	add_filter( 'post-format-standard', 'zn_post_standard', 10, 1 );
	add_filter( 'post-format-gallery', 'zn_post_gallery', 10, 2 );
	add_filter( 'post-format-video', 'zn_post_video', 10, 2 );
	add_filter( 'post-format-audio', 'zn_post_audio', 10, 1 );
	add_filter( 'post-format-quote', 'zn_post_quote', 10, 1 );
	add_filter( 'post-format-link', 'zn_post_link', 10, 1 );

// STANDARD POST
if ( !function_exists('zn_post_standard') ){
	function zn_post_standard( $current_post ){

		$current_post['title']   = zn_wrap_titles( $current_post['title'] );

		return $current_post;
	}
}

// STANDARD POST
if ( !function_exists('zn_post_audio') ){
	function zn_post_audio( $current_post ){

		
		preg_match("!\[audio.+?\]\[\/audio\]!", $current_post['content'], $match_audio );
		
		if(!empty($match_audio))
		{
			$current_post['media']   = '<div class="zn_iframe_wrap">'.do_shortcode( $match_audio[0] ) .'</div>';
			$current_post['content'] = str_replace($match_audio[0], "", $current_post['content']);
		}
		else
		{
			preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $current_post['content'], $matches_iframe);
			if ( !empty( $matches_iframe[0] ) ) {
				$current_post['media']   = '<div class="zn_iframe_wrap">'.$matches_iframe[0] .'</div>';
				$current_post['content'] = str_replace($matches_iframe[0], "", $current_post['content']);
			}
		}

		$current_post['title']   = '';

		return $current_post;
	}
}

// GALLERY POST
if ( !function_exists('zn_post_gallery') ){
	function zn_post_gallery( $current_post , $size ) {

		preg_match("!\[(?:zn_)?gallery.+?\]!", $current_post['content'], $match_gallery);

		$current_post['title']   = zn_wrap_titles( $current_post['title'] );

		if(!empty($match_gallery))
		{
			$gallery = $match_gallery[0];

			if(strpos($gallery, 'zn_') === false)   $gallery = str_replace("gallery", 'zn_gallery', $gallery);
			if(strpos($gallery, 'style') === false) $gallery = str_replace("]", " size=\"$size\"]", $gallery);

			$current_post['media']   = do_shortcode( $gallery );
			$current_post['content'] = str_replace( $match_gallery[0], "", $current_post['content'] );

		}

		return $current_post;

	}
}

// VIDEO POST
if ( !function_exists('zn_post_video') ){
	function zn_post_video( $current_post , $size ) {

		$current_post['content'] = preg_replace( '|^\s*(https?://[^\s"]+)\s*$|im', "[embed]$1[/embed]", $current_post['content'] );
		preg_match("!\[embed.+?\]|\[video.+?video\]!", $current_post['content'] , $match_video);

		$current_post['title']   = zn_wrap_titles( $current_post['title'] );

		if(!empty($match_video))
		{
			global $wp_embed;
			$video = $match_video[0];
			$current_post['media']   = '<div class="zn_iframe_wrap">'. do_shortcode( $wp_embed->run_shortcode( $video ) ) .'</div>';
			$current_post['content'] = str_replace($match_video[0], "", $current_post['content']);
		}

		return $current_post;

	}
}

// QUOTE POST
if ( !function_exists('zn_post_quote') ){
	function zn_post_quote( $current_post ){

		$old_title = $current_post['title'];
		$current_post['title'] = '<div class="testimonials5 mbottom10 "><div class="item"><blockquote><p>'.$current_post['content'].'</p><h5>'.$current_post['title'].'</h5></blockquote></div></div>';
		$current_post['content'] = '';
		//$current_post['meta'] = '';
		return $current_post;

	}
}

// LINK POST
if ( !function_exists('zn_post_link') ){
	function zn_post_link( $current_post ) {

		$post_link = ( $has_url = get_url_in_content( $current_post['content'] ) ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
		$current_post['title'] = '<div class="post-link-attachment zn-alternative-bkg"> <span class="icon-link4 zn-primary-color"></span> <a href="'. esc_url( $post_link ).'"> '.$current_post['title'].' </a> </div>';
		$current_post['content'] = '';

		return $current_post;

	}
}

?>
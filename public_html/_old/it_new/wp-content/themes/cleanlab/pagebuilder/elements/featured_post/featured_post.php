<?php
/*
	Name: Featured Post
	Description: This element will display one of your posts
	Class: ZnFeaturedPost
	Category: content
	Level: 3
	Style: true
	
*/

class ZnFeaturedPost extends ZnElements {

	function options() {
		global $zn_framework;
		
		$options = array(
			'has_tabs'  => true,
			'featured' => array(
				'title' => 'Featured post options',
				'options' => array(
					array(
						'id'          => 'post_id',
						'name'        => 'Featured post ID',
						'description' => 'Please enter the ID of the desired post.',
						'type'        => 'text',
						'std'		=> ''
					),
					array(
						'id'            => 'custom_main_size',
						'name'          => 'Custom image size',
						'description'   => 'Select if you want to enter a custom size for the post thumbnail. If not, the full size of the image will be used.',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => 'yes'
					),
					array(
						'id'          => 'main_img_width',
						'name'        => 'Thumbnail width',
						'description' => 'Enter the desired thumbnail width.',
						'type'        => 'slider',
						'std'		  => '262',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '10',
							'max' => '1920',
							'step' => '1'
						),
						'dependency'  => array( 'element' => 'custom_main_size' , 'value'=> array('yes') ),
					),
					array(
						'id'          => 'main_img_height',
						'name'        => 'Thumbnail height',
						'description' => 'Enter the desired thumbnail height.',
						'type'        => 'slider',
						'std'		  => '209',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '10',
							'max' => '1080',
							'step' => '1'
						),
						'dependency'  => array( 'element' => 'custom_main_size' , 'value'=> array('yes') ),
					),
				)
			),
			'styling' => array(
				'title' => 'Styling options',
				'options' => array(
					array( 
						"id" => "date_style",
						"name" => "Date format",
						"description" => "Select the desired format for the date.",
						"std" => "",
						"type" => "select",
						"options" => array (""=>"Set in WordPress settings", "F j, Y" => "November 14, 2014", "l, F j, Y" => "Friday, November 14, 2014", "j F Y" => "14 November 2014", "d/m/Y" => "14/11/2014", "m/d/Y" => "11/14/2014"),
						"class" => "",
					),
				)
			),
			'related' => array(
				'title' => 'Related posts options',
				'options' => array(
					array(
						'id'            => 'show_related_posts',
						'name'          => 'Show related posts',
						'description'   => 'Select if you want to display a list of related posts. Note that only posts with featured image will be displayed.',
						'type'          => 'toggle2',
						'std'           => 'yes',
						'value'         => 'yes'
					),
				array(
						'id'          => 'count',
						'name'        => 'Number of related posts',
						'description' => 'Please choose the desired number of related posts you wish to display',
						'type'        => 'slider',
						'std'		  => '2',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '1',
							'max' => '50',
							'step' => '1'
						),
						'dependency'  => array( 'element' => 'show_related_posts' , 'value'=> array('yes') ),
					),		
					array(
						'id'          => 'columns',
						'name'        => 'Number of columns',
						'description' => 'Please choose the desired number of columns to use',
						'type'        => 'select',
						'std'			=> 'col-sm-6',
						'options'	  => array( 'col-sm-12'=>'1 Column' , 'col-sm-6' => '2 Columns' , 'col-sm-4' => '3 Columns', 'col-sm-3' => '4 Columns', 'col-sm-2' => '6 Columns'  ),
						'dependency'  => array( 'element' => 'show_related_posts' , 'value'=> array('yes') ),
					),
					array(
						'id'          => 'max_chars',
						'name'        => 'Maximum number of characters',
						'description' => 'Please enter the maximum number of characters to use from the excerpt. Leave empty if you wish to use the whole excerpt.',
						'type'        => 'text',
						'std'		=> '',
						'dependency'  => array( 'element' => 'show_related_posts' , 'value'=> array('yes') ),
					),
					array(
						'id'            => 'custom_img_size',
						'name'          => 'Custom image size',
						'description'   => 'Select if you want to enter a custom size for the images. If not, full size of each image will be used.',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => 'yes',
						'dependency'  => array( 'element' => 'show_related_posts' , 'value'=> array('yes') ),
					),
					array(
						'id'          => 'img_width',
						'name'        => 'Image width',
						'description' => 'Enter the desired image custom width.',
						'type'        => 'slider',
						'std'		  => '262',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '10',
							'max' => '1920',
							'step' => '1'
						),
						'dependency'  => array( 'element' => 'custom_img_size' , 'value'=> array('yes') ),
					),
					array(
						'id'          => 'img_height',
						'name'        => 'Image height',
						'description' => 'Enter the desired image custom height.',
						'type'        => 'slider',
						'std'		  => '190',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '10',
							'max' => '1080',
							'step' => '1'
						),
						'dependency'  => array(  'element' => 'custom_img_size' , 'value'=> array('yes') ),
					)
				)
			),
		);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
	global $post;
		$post_id = $this->opt('post_id','');
		$post = get_post($post_id);
		
		//var_dump($post);
		
		if ($post == null || $post->post_type !== 'post') {
			echo '<div class="zn-pb-notification">Post not found.</div>';
			wp_reset_query();
			return;
		}
		
		setup_postdata($post);
		
		$custom_main_size = $this->opt('custom_main_size') === 'yes' ? true : false;
		$date_style = $this->opt('date_style','');
		$show_related_posts = $this->opt('show_related_posts') !== 'yes' ? false : true;
		?>
		
		<div class="zn-featured-post <?php echo $this->data['uid']; ?>">
			<div class="zn-post-container">
				<?php if (has_post_thumbnail()) { ?>
				<a href="<?php esc_url( the_permalink() ); ?>"> 
					<?php
					if ($custom_main_size) {
							$main_img_widht = $this->opt('main_img_widht', 555);
							$main_img_height = $this->opt('main_img_height', 293);
							echo zn_get_post_image( $post_id , $main_img_widht, $main_img_height, array('class'=>'img-responsive featured-image') );
					}
					else {
						the_post_thumbnail( 'full', array('class' => 'img-responsive featured-image') ); 
					}
					?>
				</a>
				<?php } ?>
				<div class="post-header">
					<h3 class="post-title"><a href="<?php esc_url( the_permalink() ); ?>">
						<?php get_the_title() ? the_title() : the_ID(); ?>
					</a></h3>
					<span class="projects-date zn-primary-color"><?php echo get_the_date($date_style);?></span>
					<?php zn_show_hearts( $post, true,'', 'mleft10 zn-paragraph-color-light' ); ?>
					<span class="zn_comments icon-bubbles4 mleft10 zn-paragraph-color-light">
						<a href="<?php echo esc_url( the_permalink() ); ?>#comments" class="zn-paragraph-color-light">
							<?php echo comments_number( '0', '1', '%' ); ?>
						</a>
					</span>
					<span class="post-tag"><?php echo get_the_category_list( ', ' ); ?>
					</span>
				</div> <!-- Close post header -->
				<div class="post-content"><?php the_excerpt(); ?></div>
			</div> <!-- Close zn-post-container -->
		<?php
		
		wp_reset_query();
		if (!$show_related_posts) {
			echo '</div>'; //Close element
			return;
		}
		
		$categories = wp_get_post_categories($post_id);	
		$count = $this->opt('count')  ? $this->opt('count') : '4';
		$columnsClass = $this->opt('columns')  ? $this->opt('columns') : 'col-sm-3';
		$columns = ($columnsClass == 'col-sm-6' ? 2 : ($columnsClass == 'col-sm-4' ? 3 : ($columnsClass == 'col-sm-3' ? 4 : 1)));
		$custom_img_size = $this->opt('custom_img_size') === 'yes' ? true : false;
		$max_chars = $this->opt('max_chars','');
		if (!is_numeric($max_chars)) {
			$max_chars = '';
		}
		$r = new WP_Query( array('post__not_in' => array($post_id), 'posts_per_page' => $count, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'category__in' => $categories, 'meta_key' => '_thumbnail_id' ) ); //, 'meta_key' => '_thumbnail_id'
		if (!$r->have_posts()) {
			//echo '<div class="zn-pb-notification">No related posts found.</div>';
			echo '</div>'; // Close element
			return;
		}
		else {
			$i=0;
			?>
			<div class="zn-related-posts">
				<h3 class="related-text"><?php _e('Related Posts','zn_framework');?></h3>
				<div class="row latest-posts-3" >
					<?php while ( $r->have_posts() ) : $r->the_post(); global $post; ?>
					<div class="item-post <?php echo $columnsClass; ?>">
						<a href="<?php esc_url( the_permalink() ); ?>">
							<?php 
							if ($custom_img_size) {
								$img_widht = $this->opt('img_width', 653);
								$img_height = $this->opt('img_height', 300);
								//the_post_thumbnail(array($img_widht, $img_height), array('class'=>'img-responsive'));
								echo zn_get_post_image( $post->ID , $img_widht, $img_height, array('class'=>'img-responsive mbottom20') );
							}
							else {
								the_post_thumbnail( 'full', array('class' => 'img-responsive mbottom20') ); 
							}
							?>
						</a>
						<div class="zn-item-date zn-primary-color"><?php echo get_the_date($date_style); ?></div>
						<h4><a href="<?php esc_url( the_permalink() ); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h4>
						<p><?php echo zn_trim_to_size( get_the_excerpt(), $max_chars ); ?></p>
						<a href="<?php esc_url( the_permalink() ); ?>"><?php _e('More info','zn_framework'); ?></a>
					</div> <!-- Close item-post -->
					<?php 
					$i++;
					if (!($i%$columns)){
						echo '<div class="clearfix"></div>';
					}
					endwhile; ?>
				</div> <!-- Close latest-posts-3 -->
			</div>
		<?php } ?>
		</div>
		
		<?php

		// Reset the global $the_post as this query will have stomped on it
		//wp_reset_postdata();
		wp_reset_query();
	}

}

?>
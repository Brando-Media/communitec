<?php
/*
	Name: Latest Posts 2
	Description: This element will generate a list of latest posts from blog
	Class: ZnLatestPosts2
	Category: content
	Level: 3
	Style: true
	
*/

class ZnLatestPosts2 extends ZnElements {

	function options() {
		global $zn_framework;

		// GET BLOG CATEGORIES
		$args = array(
		    'type' => 'post'
		);	
				
		$post_categories = get_categories($args);

		$option_post_cat = array();

		foreach ($post_categories as $category) {
		    $option_post_cat[$category->cat_ID] = $category->cat_name;
		}
		
		$options = array(
				array(
				        'id'          => 'category',
				        'name'        => 'Categories',
				        'description' => 'Select your desired categories for post items to be displayed',
				        'type'        => 'select',
				        'options'	  => $option_post_cat,
				        'multiple'	  => true

				    ),
				array(
						'id'          => 'count',
						'name'        => 'Number of items',
						'description' => 'Please choose the desired number of items in the list',
						'type'        => 'slider',
					    'std'		  => '4',
					    'class'		  => 'zn_full',
					    'helpers'	  => array(
						    'min' => '1',
						    'max' => '50',
						    'step' => '1'
					    ),
					),		
					array(
							'id'          => 'columns',
							'name'        => 'Number of columns',
							'description' => 'Please choose the desired number of columns',
							'type'        => 'select',
							'std'			=> 'col-sm-3',
							'options'	  => array( 'col-sm-12'=>'1 Column' , 'col-sm-6' => '2 Columns' , 'col-sm-4' => '3 Columns', 'col-sm-3' => '4 Columns', 'col-sm-2' => '6 Columns'  )
					),
					array(
						'id'          => 'max_chars',
						'name'        => 'Maximum number of characters',
						'description' => 'Please enter the maximum number of characters to use from the excerpt. Leave empty for the whole excerpt.',
						'type'        => 'text',
						'std'		=> ''
					),
					array( 
						"id" => "date_style",
						"name" => "Date format",
						"description" => "Select the desired format for the date.",
							"std" => "",
							"type" => "select",
							"options" => array ( "" => "Day/Month", "md" => "Month/Day"),
							"class" => ""
					),
					array(
						'id'            => 'show_featured',
						'name'          => 'Show featured image',
						'description'   => 'Select if you want to show the featured image of the posts. For best looks, the images should have the same aspect ratio.',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => 'yes'
					),
					array(
                        'id'            => 'custom_img_size',
                        'name'          => 'Custom image size',
                        'description'   => 'Select if you want to enter a custom size for the images. If not, full size of each image will be used.',
                        'type'          => 'toggle2',
                        'std'           => '',
                        'value'         => 'yes',
						'dependency'  => array( 'element' => 'show_featured' , 'value'=> array('yes') ),
                    ),
					array(
                        'id'          => 'img_width',
                        'name'        => 'Image width',
                        'description' => 'Enter the desired image width.',
                        'type'        => 'slider',
						'std'		  => '262',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '10',
							'max' => '1920',
							'step' => '1'
						),
						'dependency'  => array( 'element' => 'show_featured' , 'value'=> array('yes') ),
                    ),
					array(
                        'id'          => 'img_height',
                        'name'        => 'Image height',
                        'description' => 'Enter the desired image height.',
                        'type'        => 'slider',
						'std'		  => '209',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '10',
							'max' => '1080',
							'step' => '1'
						),
						'dependency'  => array( 'element' => 'show_featured' , 'value'=> array('yes') ),
                    )
			);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		$category = $this->opt('category') ? $this->opt('category') : '';
		$count = $this->opt('count')  ? $this->opt('count') : '4';
		$columnsClass = $this->opt('columns')  ? $this->opt('columns') : 'col-sm-3';
		$columns = ($columnsClass == 'col-sm-6' ? 2 : ($columnsClass == 'col-sm-4' ? 3 : ($columnsClass == 'col-sm-3' ? 4 : ($columnsClass == 'col-sm-2' ? 6 : 1))));
		$max_chars = $this->opt('max_chars','');
		if (!is_numeric($max_chars)) {
			$max_chars = '';
		}
		$first = 'd';
		$second = 'm';
		$date_style = $this->opt('date_style','');
		if ($date_style === 'md') {
			$first = 'm';
			$second = 'd';
		}
		$show_featured = $this->opt('show_featured','') == 'yes' ? true : false;
		$custom_img_size = ($show_featured && $this->opt('custom_img_size') === 'yes' ) ? true : false;
		
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $count, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'category__in' => $category) ) );
		if (!$r->have_posts()) {
			echo '<div class="zn-pb-notification">No posts found.</div>';
			return;
		}
		else {
		$i=0;
		?>
			<div class="from-blog <?php echo $this->data['uid']; ?>">
			<div class="row">
			<?php while ( $r->have_posts() ) : $r->the_post(); 

				global $post;
			?>
				<div class="<?php echo $columnsClass; ?>">
					<span class="blog-date zn-primary-color"><?php the_time($first); ?>/<?php the_time($second); ?></span>
					<div class="blog-boxes zn-alternative-bkg">

									<?php if ($show_featured) { ?>
					<a href="<?php the_permalink(); ?>">
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
				<?php } ?>

						<h3><a href="<?php esc_url( the_permalink() ); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h3>
						<p class="mbottom15"><?php _e('Posted by','zn_framework'); ?> <a href="#"><?php the_author(); ?></a></p>
						<p class="mbottom15"><?php echo zn_trim_to_size(get_the_excerpt(), $max_chars); ?>
						</p>
						<a href="<?php esc_url( the_permalink() ); ?>"><?php _e('More info','zn_framework'); ?></a>
						<?php zn_show_hearts( $post, true,'', 'fright' ); ?>
					</div>
	    		</div>
			<?php 
			$i++;
			if (!($i%$columns)){
                echo '<div class="clearfix"></div>';
			}
			endwhile; ?>
			</div>
			</div>
		<?php
		}
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
	}

}

?>
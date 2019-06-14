<?php
/*
	Name: Latest Posts 3
	Description: This element will generate a list of latest posts from blog
	Class: ZnLatestPosts3
	Category: content
	Level: 3
	Style: true
	
*/

class ZnLatestPosts3 extends ZnElements {

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
				        'description' => 'Select your desired categories for post items to be displayed.  Note that only posts with featured image will be displayed.',
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
					        'std'			=> 'col-sm-6',
					        'options'	  => array( 'col-sm-12'=>'1 Column' , 'col-sm-6' => '2 Columns' , 'col-sm-4' => '3 Columns', 'col-sm-3' => '4 Columns', 'col-sm-2' => '6 Columns'  )
					),
					array(
						'id'          => 'max_chars',
						'name'        => 'Maximum number of characters',
						'description' => 'Please enter the maximum number of characters to use from the title. Leave empty if you wish to use the whole title.',
						'type'        => 'text',
						'std'		=> ''
					),
					array( 
						"id" => "date_style",
						"name" => "Date format",
						"description" => "Select the desired format for the date.",
							"std" => "F j, Y",
							"type" => "select",
							"options" => array ( "F j, Y" => "November 14, 2014", "l, F j, Y" => "Friday, November 14, 2014", "j F Y" => "14 November 2014", "d/m/Y" => "14/11/2014", "m/d/Y" => "11/14/2014"),
							"class" => ""
					),
					array(
                        'id'            => 'custom_img_size',
                        'name'          => 'Custom image size',
                        'description'   => 'Select if you want to enter a custom size for the images. If not, full size of each image will be used.',
                        'type'          => 'toggle2',
                        'std'           => '',
                        'value'         => 'yes'
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
						'dependency'  => array( 'element' => 'custom_img_size' , 'value'=> array('yes') ),
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
						'dependency'  => array( 'element' => 'custom_img_size' , 'value'=> array('yes') ),
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
		$custom_img_size = $this->opt('custom_img_size') === 'yes' ? true : false;
		$max_chars = $this->opt('max_chars','');
		if (!is_numeric($max_chars)) {
			$max_chars = '';
		}

		$date_style = $this->opt('date_style','F j, Y');
		
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $count, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'category__in' => $category, 'meta_key' => '_thumbnail_id' ) ) ); //, 'meta_key' => '_thumbnail_id'
		if (!$r->have_posts()) {
			echo '<div class="zn-pb-notification">No posts found.</div>';
			return;
		}
		else {
		$i=0;
		?>
			<div class="row latest-posts-3 <?php echo $this->data['uid']; ?>" >
			
			<?php while ( $r->have_posts() ) : $r->the_post(); 

				global $post;
			?>
			<div class="item-post <?php echo $columnsClass; ?>">
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
						<div class="zn-item-date zn-primary-color"><?php the_time($date_style); ?></div>
						<h4><a href="<?php the_permalink(); ?>">
                                <?php echo zn_trim_to_size(get_the_title() ? get_the_title() : the_ID(), $max_chars); ?>
                        </a></h4>
			</div>
			<?php 
			$i++;
			if (!($i%$columns)){
                echo '<div class="clearfix"></div>';
			}
			endwhile; ?>
			</div>
		<?php
		}
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
	}

}

?>
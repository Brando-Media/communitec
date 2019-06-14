<?php
/*
	Name: Latest Posts Slider 1
	Description: This element will generate a carousel of latest posts from blog
	Class: ZnLatestPostsSlider1
	Category: content
	Level: 3
	Style: true
	
*/

class ZnLatestPostsSlider1 extends ZnElements {

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
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
				        'id'          => 'category',
				        'name'        => 'Categories',
				        'description' => 'Select your desired categories for post items to be displayed. Note that only posts with featured image will be displayed.',
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
					//array(
					//        'id'          => 'columns',
					//        'name'        => 'Number of columns',
					//        'description' => 'Please choose the desired number of columns',
					//        'type'        => 'select',
					//        'std'			=> 'col-sm-3',
					//        'options'	  => array( 'col-sm-12'=>'1 Column' , 'col-sm-6' => '2 Columns' , 'col-sm-4' => '3 Columns', 'col-sm-3' => '4 Columns', 'col-sm-2' => '6 Columns'  )
					//),
					array(
						'id'          => 'max_chars',
						'name'        => 'Maximum number of characters',
						'description' => 'Please enter the maximum number of characters to use from the title. Leave empty if you wish to use the whole title.',
						'type'        => 'text',
						'std'		=> ''
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
						'std'		  => '653',
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
						'std'		  => '300',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '10',
							'max' => '1080',
							'step' => '1'
						),
						'dependency'  => array( 'element' => 'custom_img_size' , 'value'=> array('yes') ),
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
							"options" => array ( "" => "Day/Month", "md" => "Month/Day"),
							"class" => ""
					),
					array(
                        'id'            => 'show_bullets',
                        'name'          => 'Show bullets',
                        'description'   => 'Select if you want to show the navigation bullets',
                        'type'          => 'toggle2',
                        'std'           => 'yes',
                        'value'         => 'yes'
                    ),
					array(
                        'id'            => 'show_navigation',
                        'name'          => 'Show navigation',
                        'description'   => 'Select if you want to show the navigation arrows',
                        'type'          => 'toggle2',
                        'std'           => '',
                        'value'         => 'yes'
                    ),
					array(
							'id'            => 'nav_style',
							'name'          => 'Navigation style',
							'description'   => 'Select a style for the navigation buttons of this carousel',
							'type'          => 'select',
							'std'           => 'sideNav hollowNav',
							'options'	    => zn_get_navigation_styles(),
							'dependency'  => array( 'element' => 'show_navigation' , 'value'=> array('yes') ),
							'live' => array(
									'type'		=> 'class',
									'css_class' => '.'.$this->data['uid'].'.zn_owl_carousel'
							)
						),
				)
			),
			'misc' => array(
				'title' => 'Miscellaneous',
				'options' => array(
					array(
                        'id'            => 'auto_scroll',
                        'name'          => 'Auto scroll',
                        'description'   => 'Select if you want the carousel to scroll automatically',
                        'type'          => 'toggle2',
                        'std'           => 'yes',
                        'value'         => 'yes'
                    ),
					array(
                        'id'          => 'timeout_duration',
                        'name'        => 'Timeout duration',
                        'description' => 'Enter the time interval between scrolls (in miliseconds).',
                        'type'        => 'text',
						'std'		  => '5000',
						'dependency'  => array( 'element' => 'auto_scroll' , 'value'=> array('yes') ),
                    ),
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
		$category = $this->opt('category') ? $this->opt('category') : '';
		$count = $this->opt('count')  ? $this->opt('count') : '4';
		$autoScroll = $this->opt('auto_scroll') === 'yes' ? $this->opt('timeout_duration',5000) : 'false';
		$custom_img_size = $this->opt('custom_img_size') === 'yes' ? true : false;
		$show_bullets = $this->opt('show_bullets') === 'yes' ? 'true' : 'false';
		$show_navigation = $this->opt('show_navigation') === 'yes' ? 'true' : 'false';
		$navStyle = $this->opt('nav_style','sideNav hollowNav');
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
		
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $count, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'category__in' => $category, 'meta_key' => '_thumbnail_id' ) ) ); //, 'meta_key' => 'color'
		if (!$r->have_posts()) {
			echo '<div class="zn-pb-notification">No posts found.</div>';
			return;
		}
		else {
		?>
			<div class="news-big zn_owl_carousel owl-carousel owl-theme <?php echo $navStyle; ?> <?php echo $this->data['uid']; ?>"  data-auto="<?php echo esc_attr( $autoScroll );?>" data-pagination="<?php echo $show_bullets;?>" data-navigation="<?php echo $show_navigation;?>">
			
			<?php while ( $r->have_posts() ) : $r->the_post(); 

				global $post;
				//if (!has_post_thumbnail()) {var_dump($r);}
			?>
			<div class="item overlay overlay-effect">
				<figure>
                    <a href="<?php the_permalink(); ?>">
						<?php 
						if ($custom_img_size) {
							$img_widht = $this->opt('img_width', 653);
						    $img_height = $this->opt('img_height', 300);
						    //the_post_thumbnail(array($img_widht, $img_height), array('class'=>'img-responsive'));
							echo zn_get_post_image( $post->ID , $img_widht, $img_height, array('class'=>'img-responsive') );
						}
						else {
						    the_post_thumbnail( 'full', array('class' => 'img-responsive') ); 
						}
						?>
					</a>
					<figcaption>
						<span class="caption-date"><?php the_time("$first/$second"); ?></span>
						<a href="<?php the_permalink(); ?>">
                            <p class="mbottom10">
                                <?php echo zn_trim_to_size(get_the_title() ? get_the_title() : the_ID(), $max_chars); ?>
                            </p>
                        </a>
						<a href="<?php the_permalink(); ?>"><?php _e('More info','zn_framework'); ?></a>
						<?php zn_show_hearts( $post, true,'', '' ); ?>
						<span class="zn_comments icon-bubbles4">
							<a href="<?php echo the_permalink(); ?>#comments" class="zn-secondary-color">
								<?php echo comments_number( '0', '1', '%' ); ?>
							</a>
						</span>
					</figcaption>
                </figure>
			</div>
			<?php 
			endwhile; ?>
			</div>
		<?php
		}
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
	}

}

?>
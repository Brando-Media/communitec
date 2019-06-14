<?php
/*
	Name: Latest Posts 1
	Description: This element will generate a list of latest posts from blog
	Class: ZnLatestPosts
	Category: content
	Level: 3
	Style: true
	
*/

class ZnLatestPosts extends ZnElements {

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
		$max_chars = ( int )$this->opt('max_chars','');
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
		
		
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $count, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'category__in' => $category) ) );
		if (!$r->have_posts()) {
			echo '<div class="zn-pb-notification">No posts found.</div>';
			return;
		}
		else {
		$i=0;
		?>
			<div class="row <?php echo $this->data['uid']; ?>">
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
				<div class="<?php echo $columnsClass; ?>">
	    			<div class="news-boxes mbottom35">
	    				<div class="news-header">
								<span><?php the_time($first); ?></span>
			    				<span><?php the_time($second); ?></span>
			    			<h3><a href="<?php esc_url( the_permalink() ); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h3>
		    			</div>
		    			<div class="mbottom30"><?php echo zn_trim_to_size( get_the_excerpt(), $max_chars); ?></div>
		    			<a href="<?php esc_url( the_permalink() ); ?>"><?php _e('More info','zn_framework'); ?></a>
		    		</div>
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
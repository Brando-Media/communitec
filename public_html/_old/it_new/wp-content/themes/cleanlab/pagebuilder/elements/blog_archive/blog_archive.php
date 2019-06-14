<?php
/*
	Name: Blog Archive
	Description: This element will generate a list of latest posts from blog
	Class: ZnBlogArchive
	Category: Content
	Level: 3
	Style: true
	
*/

class ZnBlogArchive extends ZnElements {

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
					'id'          => 'blog_style',
					'name'        => 'Blog style',
					'description' => 'Select the desired style that you want to use for the blog archive.',
					'type'        => 'select',
					'std'         => '',
					'options'     => array('' => 'Default style', 'timeline' => 'Timeline blog', 'masonry' => 'Masonry blog')
				),
				array(
					'id'          => 'columns',
					'name'        => 'Columns',
					'description' => 'Select how many columns to use for the blog archive',
					'type'        => 'select',
					'std'		  => 'col-sm-12',
					'options'	  => array( 'col-sm-12' => '1 Column', 'col-sm-6' => '2 Columns', 'col-sm-4' => '3 Columns', 'col-sm-3'=> '4 Columns' ),
					'dependency' => array( 'element' => 'blog_style' , 'value'=> array('masonry', '') )
				),
				array(
					'id'          => 'category',
					'name'        => 'Categories',
					'description' => 'Select your desired categories for post items to be displayed.',
					'type'        => 'select',
					'options'	  => $option_post_cat,
					'multiple'	  => true
					),
				array(
					'id'          => 'count',
					'name'        => 'Number of items per page',
					'description' => 'Please choose the desired number of items that will be shown on a page',
					'type'        => 'slider',
					'std'		  => '4',
					'class'		  => 'zn_full',
					'helpers'	  => array(
						'min' => '1',
						'max' => '50',
						'step' => '1'
					),
				),
			);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		global $zn_config, $query_string, $wp_query, $paged, $wp_query;

		$category = $this->opt('category') ? $this->opt('category') : '';
		$count = $this->opt('count')  ? $this->opt('count') : '4';
		$blog_style = $this->opt('blog_style', '');

		// PASS DATA TO PROPERLY CONFIGURE THE ARCHIVE
		$zn_config['size'] = 'col-sm-12';
		$zn_config['columns'] = $this->opt('columns', 'col-sm-12' );
		$zn_config['blog_style'] = $blog_style;

		$args = array(
			'posts_per_page' => ( int )$count,
			'post_status' => 'publish',
			'category__in' => $category,
			'paged' => $paged
		);

		// PERFORM THE QUERY
		query_posts( $args );

		if (!have_posts()) {
			echo '<div class="zn-pb-notification">No posts found.</div>';
			return;
		}
		else {
		?>
			<div class="zn_blog_archive <?php echo $this->data['uid']; ?>" >

				<?php 
					global $more;
					$more = 0;
					get_template_part( 'template_helpers/loop', 'index' ); 
				?>
			
			</div>
		<?php
		}
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_query();
	}

}

?>
<?php
/*
	Name: Portfolio Slider 
	Description: This element will generate a portfolio slider
	Class: ZnPortfolioSlider
	Category: content
	Level: 3
	Style: true
	
*/

class ZnPortfolioSlider extends ZnElements {

	function options() {
		global $zn_framework;

		$args = array(
			'type'                     => 'portfolio',
			'child_of'                 => 0,
			'parent'                   => '',
			'orderby'                  => 'id',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,
			'taxonomy'                 => 'portfolio_categories',
			'pad_counts'               => false 
		);	
				
		$port_categories = get_categories( $args );

		$option_port_cat = array();

		foreach ($port_categories as $category) {
			$option_port_cat[$category->cat_ID] = $category->cat_name;
		}

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
							'id'          => 'title',
							'name'        => 'Element title',
							'description' => 'Enter the desired title for this element',
							'type'        => 'text',
							'std'	  	  => ''
						),
					array(
							'id'          => 'category',
							'name'        => 'Portfolio category',
							'description' => 'Select your desired categories for portfolio items to be displayed',
							'type'        => 'select',
							'options'	  => $option_port_cat,
							'multiple'	  => true
						),
						array(
							'id'          => 'post_per_page',
							'name'        => 'Number of Items',
							'description' => 'Enter a number for how many items you want to load',
							'type'        => 'text',
							'std'		  => '8'
						),
						array(
							'id'          => 'columns',
							'name'        => 'Number of columns',
							'description' => 'Select the number of columns for this element',
							'type'        => 'slider',
							'std'		  => '4',
							'class'		  => 'zn_full',
							'helpers'	  => array(
											'min' => '1',
											'max' => '12',
											'step' => '1'
											),
						),
						array(
							'id'          => 'rows',
							'name'        => 'Number of rows',
							'description' => 'Select the number of rows to display',
							'type'        => 'slider',
							'std'		  => '2',
							'class'		  => 'zn_full',
							'helpers'	  => array(
											'min' => '1',
											'max' => '5',
											'step' => '1'
											),
						),
						array(
							'id'          => 'aspect_ratio',
							'name'        => 'Image aspect ratio',
							'description' => 'Enter the desired aspect ratio for the images (width = height * aspect_ratio).',
							'type'        => 'text',
							'std'		  => '1.37'
						),
				)
			),
			'styling' => array(
				'title' => 'Styling options',
				'options' => array(
					array(
						    'id'          => 'style',
						    'name'        => 'Element style',
						    'description' => 'Select a style for the element.',
						    'type'        => 'select',
							'std'		  => 'no_gaps',
						    'options'	  => array('' => 'Style 1', 'style2' => 'Style 2'),
						    // 'live' => array(
						    // 	'type'		=> 'class',
						    // 	'css_class' => '.'.$this->data['uid']
						    // )
						),
					array(
							'id'          => 'width_style',
							'name'        => 'Width style',
							'description' => 'Select a width style for the element. (if using full width, please also set the section to full width)',
							'type'        => 'select',
							'options'	  => array('' => 'Boxed (in a column)', 'full' => 'Full width'),
							//'live' => array(
							//    'type'		=> 'class',
							//    'css_class' => '.'.$this->data['uid']
							//)
						),
						array(
							'id'            => 'show_bullets',
							'name'          => 'Show bullets',
							'description'   => 'Select if you want to show the navigation bullets',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),
						array(
							'id'            => 'show_navigation',
							'name'          => 'Show navigation',
							'description'   => 'Select if you want to show the navigation arrows',
							'type'          => 'toggle2',
							'std'           => 'yes',
							'value'         => 'yes'
						),
						array(
							'id'            => 'nav_style',
							'name'          => 'Navigation style',
							'description'   => 'Select a style for the navigation buttons of this carousel',
							'type'          => 'select',
							'std'           => 'sideNav hollowNav',
							'options'	    => zn_get_navigation_styles(),
												//array('sideNav hollowNav' => 'Side/Hollow 1',
												//     'sideNav hollowNav style2' => 'Side/Hollow 2',
												//     'sideNav solidNav' => 'Side/Solid 1',
												//     'sideNav solidNav2' => 'Side/Solid 2',
												//     'overTop hollowNav' => 'Top/Hollow 1', 
												//     'overTop hollowNav style2' => 'Top/Hollow 2',
												//     'overTop solidNav' => 'Top/Solid 1',
												//     'overTop solidNav2' => 'Top/Solid 2'),
							'dependency'  => array( 'element' => 'show_navigation' , 'value'=> array('yes') ),
							'live' => array(
									'type'		=> 'class',
									'css_class' => '.'.$this->data['uid'].' .zn_owl_carousel'
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

		$title = $this->opt('title')  ? '<h2 class="section-title">'.$this->opt('title').'</h2>' : '';
		$category = $this->opt('category', '0');
		$posts_per_page = is_numeric($this->opt('post_per_page') ) ? $this->opt('post_per_page') : '8'; // How many posts to load
		$autoScroll = $this->opt('auto_scroll') === 'yes' ? $this->opt('timeout_duration',5000) : 'false';
		$show_bullets = $this->opt('show_bullets') === 'yes' ? 'true' : 'false';
		$show_navigation = $this->opt('show_navigation') === 'yes' ? 'true' : 'false';
		$columns = $this->opt('columns', 4);
		$rows = $this->opt('rows',2);
		$nav_style = "";
		if ($show_navigation === 'true') {
			$nav_style = $this->opt('nav_style','sideNav hollowNav');
		}
		$style = $this->opt('style','');
		
		if ($this->opt('width_style','') === 'full') {
		    $imgWidth = 1980 / $columns;
			//if ($imgHeight === 0) {
			//    $imgHeight = min($imgWidth/1.6, 450);
			//}
		}
		else
		{
			//$forceHeight = ($imgHeight === 0 ? 1.6 : false);
			//$imgSize = zn_get_wp_image_size($columns, false, 15);
			//$imgWidth = $imgSize['width'];
			//if ($imgHeight === 0) {
			//    $imgHeight = $imgSize['height'];
			//}
			$imgWidth = 1140 / ( int )$columns;
		}
		$imgHeight = $imgWidth / $this->opt('aspect_ratio', 1.37);
		global $post;

		$args = array(
			'post_type' => 'portfolio',
			'posts_per_page' =>  $posts_per_page
		);
		
		if ($category != '0') {
			$args['tax_query'] = array (
				array(
					'taxonomy' => 'portfolio_categories',
					'field' => 'id',
					'terms' =>  $category 
				)
			);
		}

		$portfolio_items = get_posts( $args );

		if ( empty( $portfolio_items ) ) {
			echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
			return;
		}

		?>
		<div class="zn_portfolio_slider_element <?php echo $style.' '.$this->data['uid']; ?>">
			<?php 
				echo $title;

				//$terms = get_terms( 'portfolio_categories', array( 'include' => $category ));
			?>

			<div class="zn_portfolio_slider zn_owl_carousel owl-carousel owl-theme <?php echo $nav_style; ?>" data-items="<?php echo $columns; ?>" data-auto="<?php echo esc_attr( $autoScroll ); ?>" data-pagination="<?php echo esc_attr( $show_bullets ); ?>" data-navigation="<?php echo esc_attr( $show_navigation ); ?>">
				<?php 
					$current = 0;
					foreach ( $portfolio_items as $post ) { //** Start portfolio item
						setup_postdata($post);

			            $posttags = get_the_terms(get_the_ID(), 'portfolio_categories');
			           		            
			            $postTagsText = '';
			            $postTagsFilter = '';

			            if ($posttags) {
							foreach( $posttags as $tag ){
								$postTagsText .= $tag->name . ', ';
								$postTagsFilter .= $tag->slug .' ';
							}
							$postTagsText = rtrim($postTagsText, ", ");
			            }

						$image = '';
						if ( has_post_thumbnail() ) 
						{
							$image = zn_get_post_image( $post->ID, $imgWidth, $imgHeight , array( 'class' => 'img-responsive' ) );
						}
						else {
							continue;
						}
						
				?>
				
				<?php if ($current%$rows === 0) { ?>
				<div class="portfolio_item_column">
				<?php } ?>
				
					<div class="portfolio-item">
					
					<?php 
					//** STYLE 1
					if ($style === '') { ?>
						<div class="item-image overlay overlay-effect">
							<figure>
								<a href="<?php echo esc_url( get_permalink() ); ?>">
									<?php echo $image; ?>
								</a>
								<figcaption class="zn-alternative-color zn-primary-as-bg">
									<h3 class="zn-alternative-color"><?php echo $postTagsText; ?></h3>
									<?php zn_show_hearts( $post ); ?>
								</figcaption>
							</figure>
						</div>
					<?php } 
					
					
					//** STYLE 2
					else { ?>
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<?php echo $image; ?>
						</a>
						<h4 class="zn-title"><?php echo the_title(); ?></h4>
						<p class="zn-primary-color"><?php echo the_time('F j, Y'); ?></p>
					
					<?php } ?>
					</div>
				

				<?php
				
					$current++;
					if ($current%$rows === 0) { ?>
						</div>
					<?php }
				} //** End portfolio item
				
				if ($current%$rows !== 0) { echo '</div>'; } //** Close item if could not fill all rows on last item
				?>		     
			</div>
			   
		</div>
		<?php
	}

}

?>
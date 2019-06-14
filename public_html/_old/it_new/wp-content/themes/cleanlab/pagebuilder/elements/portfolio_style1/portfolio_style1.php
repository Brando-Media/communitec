<?php
/*
	Name: Portfolio Style 1 
	Description: This element will generate a Call to action box
	Class: ZnPortfolioStyle1
	Category: Content, Fullwidth
	Level: 3
	Style: true
	
*/

class ZnPortfolioStyle1 extends ZnElements {

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
								'id'          => 'desc',
								'name'        => 'Element description',
								'description' => 'Enter the desired description for this element. This will appear bellow the title',
								'type'        => 'text',
								'std'	  => ''
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
								'options'	  => array('' => 'Normal', 'masonry' => 'Masonry', 'no_gaps' => 'No gaps'),
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
								'options'	  => array('' => 'Boxed', 'full' => 'Full width'),
								//'live' => array(
								//    'type'		=> 'class',
								//    'css_class' => '.'.$this->data['uid']
								//)
							),
							array(
								'id'          => 'alignment',
								'name'        => 'Head alignment',
								'description' => 'Select the desired alignment for the head of the element ( title, description and categories filter )',
								'type'        => 'select',
								'options'        => array( 'text-left' => 'Left','text-center' => 'Center','text-right' => 'Right',  ),
								'std'	  	  => 'text-left',
								'live' => array(
									'type'		=> 'class',
									'css_class' => '.'.$this->data['uid'] .' .zn_forced_container > .row:first-child'
								)
							),
							array(
								'id'          => 'overlay_style',
								'name'        => 'Overlay style',
								'description' => 'Select a style for the overlay.',
								'type'        => 'select',
								'options'	  => array('' => 'Style 1', 'ostyle2' => 'Style 2'),
								// 'live' => array(
								// 	'type'		=> 'class',
								// 	'css_class' => '.'.$this->data['uid']
								// )
							),
				)
			),
			'itemsopt' => array(
				'title' => 'Items options',
				'options' => array(
					array(
								'id'          => 'category',
								'name'        => 'Portfolio category',
								'description' => 'Select your desired categories for portfolio items to be displayed. Note that only items with featured image will be shown. Please note that the category filter will not be displayed if you choose only one category.',
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
												'max' => '4',
												'step' => '1'
												),
							),
							array(
								'id'          => 'orderby',
								'name'        => 'Order by',
								'description' => 'Select an order by criteria for the items.',
								'type'        => 'select',
								'std'		  => 'date',
								'options'	  => array('none' => 'No order', 
														'ID' => 'By post id',
														'author' => 'By author',
														'title'	=> 'By title',
														'date'	=> 'By date',
														'modified' => 'By last modified date',
														'rand'	=> 'Random order',
														'comment_count' => 'By comment count'),
							),
							array(
								'id'          => 'order',
								'name'        => 'Sort order',
								'description' => 'Select a sort order for the order by criteria.',
								'type'        => 'select',
								'std'		  => 'ASC',
								'options'	  => array('ASC' => 'Ascending', 
													'DESC' => 'Descending'),
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
		$desc = $this->opt('desc')  ? '<h4 class="section-subtitle zn-paragraph-color">'.$this->opt('desc').'</h4>' : '';
		$category = $this->opt('category', '0');
		$posts_per_page = is_numeric($this->opt('post_per_page') ) ? $this->opt('post_per_page') : '8'; // How many posts to load
		$columns = zn_get_col_size($this->opt('columns', 4));	
		$overlay_style = $this->opt('overlay_style','');
		if ($this->opt('width_style','') === 'full') {
			$imgWidth = 1980 / $this->opt('columns',4);
			$imgHeight = $this->opt('style') != 'masonry' ? min($imgWidth/1.6, 450) : 0;
		}
		else
		{
			$extra_width = $this->opt('style') == 'no_gaps' || $this->opt('style') == 'masonry' ? '15' : '0' ;
			$force_height = $this->opt('style') != 'masonry' ? '1' : false ;
			$imgSize = zn_get_wp_image_size($columns, $force_height, $extra_width);
			$imgWidth = $imgSize['width'];
			$imgHeight = $imgSize['height'];
		}
		$orderby = $this->opt('orderby','date');
		$order = $this->opt('order','ASC');

		wp_enqueue_script( 'isotope' );

		$args = array(
			'post_type' => 'portfolio',
			'posts_per_page' =>  $posts_per_page,
			'orderby' => $orderby,
			'order' => $order
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

		global $post;
		$portfolio_items = get_posts( $args );

		if ( empty( $portfolio_items ) ) {
			echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
			return;
		}

		?>
		<div class="zn_portfolio_all <?php echo $this->opt('width_style','').' '.$this->opt('style','').' '.$this->data['uid'].' '.$overlay_style; ?>">
			<div class="zn_forced_container">
				<div class="row <?php echo $this->opt( 'alignment', 'text-left' );?>">
					<div class="col-md-6 col-sm-12">
						<?php 
							echo $title;
							echo $desc;

							$terms = get_terms( 'portfolio_categories', array( 'include' => $category ));

						?>
					</div>
					<?php if ( count( $terms ) != '1') : ?>
					<div class="col-md-6 col-sm-12">
						<div  class="zn-portfolio-filters filters-nav <?php echo empty($desc) ? '' : 'mtop30'; ?>">
							<?php
								echo "<ul class='reset-list'>";
								echo '<li><a  class="filter-item is-active" href="#" title="'.esc_attr__('All', 'zn_framework').'" data-filter="*">'.__('All', 'zn_framework').'</a></li>';
								foreach ( $terms as $term ) {

									$term = sanitize_term( $term, 'portfolio_categories' );

									$term_link = get_term_link( $term, 'portfolio_categories' );

									// CHECK IF WE HAVE AN ERROR
									if ( is_wp_error( $term_link ) ) {
										continue;
									}
									echo '<li><a  class="filter-item" href="'.esc_url( $term_link ).'" title="'.esc_attr( $term->name ).'" data-filter="'.esc_attr( $term->slug ).'">' . $term->name . '</a></li>';

								}
							echo "</ul>";
							?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>


			<div class="portfolio-wrapper row">
				<?php 
					foreach ( $portfolio_items as $post ) { //** Start portfolio item
						setup_postdata($post);

			            $posttags = get_the_terms(get_the_ID(), 'portfolio_categories');

			            $postTagsText = '';
			            $postTagsFilter = '';

			            if ($posttags) {
							//var_dump($posttags);
							foreach( $posttags as $tag ){
								$tagLink = get_term_link( $tag, 'portfolio_categories' );
								$postTagsText .= '<a href="'.esc_url($tagLink).'" title="'.esc_attr( $tag->name ).'"><h5 class="zn-alternative-color">'.$tag->name.'</h5></a>' . ', ';
								$postTagsFilter .= $tag->slug .' ';
								
							}

							//$postTagsText = '<h5 class="zn-alternative-color">'.rtrim($postTagsText, ", ").'</h5>';
							$postTagsText = rtrim($postTagsText, ", ");

			            }

						$image = '';
						if ( has_post_thumbnail() )
						{
							$image = zn_get_post_image( $post->ID, $imgWidth, $imgHeight , array( 'class' => 'img-responsive' ) );
						}
						// We don't have a featured image.. check to see if we have an image in gallery
						else{
							$custom_images = get_post_meta( $post->ID, 'project_images', true );
							$attachments = get_posts(array(
								'include' => $custom_images,
								'post_status' => 'inherit',
								'post_type' => 'attachment',
								'post_mime_type' => 'image',
								'order' => 'ASC',
								'orderby' => 'post__in')
							);

							if( ! empty( $attachments ) && is_array( $attachments ) && ! empty( $attachments[0] ) ){
								$image = zn_get_image( $attachments[0]->ID, $imgWidth, $imgHeight , array( 'class' => 'img-responsive' ) );
							}
						}

						if( empty( $image ) ){
							continue;
						}

				?>
				

				<div class="<?php echo $columns; ?> col-xs-12 portfolio_item_container" data-filter="<?php echo esc_attr( $postTagsFilter ); ?>">
					<div class="portfolio-item">
						<div class="item-image overlay overlay-effect">
							<figure>
								<a href="<?php the_permalink(); ?>">
									<?php echo $image; ?>
								</a>
								<figcaption class="zn-alternative-color zn-primary-as-bg">
									<a href="<?php echo esc_url( get_permalink() ); ?>">	
										<h3 class="zn-alternative-color">
											<?php echo the_title(); ?>
										</h3>
									</a>
									<?php echo $postTagsText; ?>
									<?php zn_show_hearts( $post ); ?>
								</figcaption>
							</figure>
						</div>
					</div>
				</div>

				<?php
				} //** End portfolio item
				?>		     
			</div>
			   
		</div>
		<?php
		wp_reset_postdata();
	}

}

?>
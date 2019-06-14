<?php
/*
	Name: WooCommerce Products
	Description: This element will generate an icon box
	Class: ZnWooProducts
	Category: content
	Level: 3
	Style: true
	Dependency_class: WooCommerce
*/

class ZnWooProducts extends ZnElements {

	function options() {
		global $zn_framework;


		$args = array( 'taxonomy'     => 'product_cat', 'hide_empty'               => 1, );
		$all_categories = get_categories( $args );
		$option_port_cat = array();

		foreach ($all_categories as $category) {
			$option_port_cat[$category->cat_ID] = $category->cat_name;
		}

		$options = array(
				'has_tabs'	=> true,
				'general' => array(
					'title' => 'General options',
					'options' => array(
						array(
							'id'          => 'title',
							'name'        => 'Title',
							'description' => 'Please enter your desired title',
							'type'        => 'text'
						),
						array(
							'id'          => 'category',
							'name'        => 'Products category',
							'description' => 'Please select the desired product categories you want to display',
							'type'        => 'select',
							'multiple'	  => true,
							'options'	  => $option_port_cat
						),
						array(
							'id'          => 'display_type',
							'name'        => 'Display type',
							'description' => 'Here you can select what type of products to display',
							'type'        => 'select',
							'options'	  => array(
								'latest'	=> 'Latest products',
								'featured'	=> 'Featured products',
							)
						),
						array(
							'id'          => 'post_per_page',
							'name'        => 'Number of Items',
							'description' => 'Enter a number for how many items you want to load',
							'type'        => 'text',
							'std'		  => '3'
						),
						array(
							'id'          => 'columns',
							'name'        => 'Number of columns',
							'description' => 'Select the number of columns for this element',
							'type'        => 'select',
							'options'	  => array( '2' => '2 Columns', '3' => '3 Columns', '4'=> '4 Columns' ),
							'std'		  => '3'
						),
						array(
							'id'          => 'link',
							'name'        => 'Button link',
							'description' => 'Enter a link for this element',
							'type'        => 'link',
							'dependency'  => array( 'element' => 'show_found_posts' , 'value'=> array('yes') ),
						),
						array(
							'id'          => 'link_text',
							'name'        => 'Button text',
							'description' => 'Enter a text for this element\'s button',
							'type'        => 'text',
							'std'		=> '',
							'dependency'  => array( 'element' => 'show_found_posts' , 'value'=> array('yes') ),
						),
					)
				),
				'styling' => array(
					'title' => 'Styling options',
					'options' => array(
						array(
							'id'          => 'title_tag',
							'name'        => 'Title HTML tag (Default is H2)',
							'description' => 'Select the desired title HTML tag',
							'type'        => 'select',
							'std'        => 'h2',
							'options'	  => array( 'h1' => 'H1','h2' => 'H2','h3' => 'H3','h4' => 'H4','h5' => 'H5','h6' => 'H6', )
						),
						array(
							'id'            => 'show_filter',
							'name'          => 'Show filter and found products',
							'description'   => 'Select if you want to show the filter selector',
							'type'          => 'toggle2',
							'std'           => 'yes',
							'value'         => 'yes'
						),
						array(
							'id'            => 'show_found_posts',
							'name'          => 'Show Total number of products',
							'description'   => 'Select if you want to show the total number of products',
							'type'          => 'toggle2',
							'std'           => 'yes',
							'value'         => 'yes'
						),
					)
				),
			//    'misc' => array(
			//    'title' => 'Slider options',
			//    'options' => array(
			//        array(
			//                'id'            => 'use_slider',
			//                'name'          => 'Use slider',
			//                'description'   => 'Select if you want to display this element as a slider',
			//                'type'          => 'toggle2',
			//                'std'           => '',
			//                'value'         => 'yes'
			//            ),
			//        array(
			//                'id'            => 'auto_scroll',
			//                'name'          => 'Auto scroll',
			//                'description'   => 'Select if you want the carousel to scroll automatically',
			//                'type'          => 'toggle2',
			//                'std'           => 'yes',
			//                'value'         => 'yes',
			//                'dependency'  => array( 'element' => 'use_slider' , 'value'=> array('yes') )
			//            ),
			//            array(
			//                'id'          => 'timeout_duration',
			//                'name'        => 'Timeout duration',
			//                'description' => 'Enter the time interval between scrolls (in miliseconds).',
			//                'type'        => 'text',
			//                'std'		  => '5000',
			//                'dependency'  => array( 'element' => 'use_slider' , 'value'=> array('yes') )
			//            ),
			//            array(
			//                'id'            => 'show_bullets',
			//                'name'          => 'Show bullets',
			//                'description'   => 'Select if you want to show the navigation bullets',
			//                'type'          => 'toggle2',
			//                'std'           => '',
			//                'value'         => 'yes',
			//                'dependency'  => array( 'element' => 'use_slider' , 'value'=> array('yes') )
			//            ),
			//            array(
			//                'id'            => 'show_navigation',
			//                'name'          => 'Show navigation',
			//                'description'   => 'Select if you want to show the navigation arrows',
			//                'type'          => 'toggle2',
			//                'std'           => 'yes',
			//                'value'         => 'yes',
			//                'dependency'  => array( 'element' => 'use_slider' , 'value'=> array('yes') )
			//            ),
			//            array(
			//                'id'            => 'nav_style',
			//                'name'          => 'Navigation style',
			//                'description'   => 'Select a style for the navigation buttons of this carousel',
			//                'type'          => 'select',
			//                'std'           => 'sideNav solidNav2',
			//                'options'	    => zn_get_navigation_styles(),
			//                                    //array('sideNav hollowNav' => 'Side/Hollow 1',
			//                                    //     'sideNav hollowNav style2' => 'Side/Hollow 2',
			//                                    //     'sideNav solidNav' => 'Side/Solid 1',
			//                                    //     'sideNav solidNav2' => 'Side/Solid 2',
			//                                    //     'overTop hollowNav' => 'Top/Hollow 1', 
			//                                    //     'overTop hollowNav style2' => 'Top/Hollow 2',
			//                                    //     'overTop solidNav' => 'Top/Solid 1',
			//                                    //     'overTop solidNav2' => 'Top/Solid 2'),
			//                'dependency'  => array( 'element' => 'use_slider' , 'value'=> array('yes') ),
			//                'live' => array(
			//                        'type'		=> 'class',
			//                        'css_class' => '.'.$this->data['uid'].' .zn_owl_carousel'
			//                )
			//            )
			//    )
			//)
			);

		return $options;

	}


	function element() {
		global $zn_framework, $woocommerce, $woocommerce_loop;
		
		//$style = $this->opt('style')  ? $this->opt('style') : '';
		$title = $this->opt('title','');
		$title_tag = $this->opt('title_tag','h2');
		$show_filter = $this->opt('show_filter','yes');
		$show_found_posts = $this->opt('show_found_posts','yes');
		

		$category = ( $this->opt('category') ) ? $this->opt('category') : '0';
		$posts_per_page = is_numeric($this->opt('post_per_page') ) ? $this->opt('post_per_page') : '3'; // How many posts to load

		( int )$columns = $this->opt('columns', 4);
		$display_type = $this->opt('display_type', 'latest');
		$link_text = $this->opt('link_text') ? $this->opt('link_text') : '';
		$link = $this->opt('link') ? zn_extract_link( $this->opt('link'), 'tcolor view_all_link' ) : '';

		////** Slider options
		//$use_slider = $this->opt('use_slider') == 'yes' ? true : false;
		//if ($use_slider) {
		//    $autoScroll = $this->opt('auto_scroll') === 'yes' ? $this->opt('timeout_duration',5000) : 'false';
		//    $show_bullets = $this->opt('show_bullets') === 'yes' ? 'true' : 'false';
		//    $show_navigation = $this->opt('show_navigation') === 'yes' ? 'true' : 'false';
		//    $navStyle = $this->opt('nav_style','sideNav solidNav2');
		//}

		?>
<?php

	// INIT THE LAYER NAV ( we can't check if we actually have it present on this page )
	$this->layered_nav_init();

	$loop = new WP_Query();
	WC()->query->product_query( $loop );

	$loop->set( 'post_type', 'product' );
	$loop->set( 'posts_per_page', $posts_per_page );

	// Filter by category
	if ($category != '0') {

		$tax_query = $loop->get( 'tax_query' );
		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field' => 'id',
			'terms' =>  $category 
		);

		$loop->set( 'tax_query', $tax_query );

	}

	// SHOW BASED ON OPTIONS ( Latest products and Featured products )
	switch ( $display_type ) {
		case 'latest' :
			// Do we have to do someting ?
		break;
		case 'featured' :
			$meta_query = $loop->get( 'meta_query' );
			$meta_query[] = array(
				'key'     => '_featured',
				'value'   => 'yes'
			);

			$loop->set( 'meta_query', $meta_query );

		break;
	}

	$loop->get_posts();
	remove_filter( 'posts_clauses',  array( WC()->query, 'order_by_popularity_post_clauses' ) );
	remove_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
	
?>

<div class="zn_woocoomerce_archive <?php echo $this->data['uid']; ?>">
	<div class="woocommerce <?php echo 'columns-'.$columns;?>">

	<?php 
		// SHould we show the title ?
		if ( !empty( $title ) ) { echo '<'.$title_tag.' class="page-title">'.$title.'</'.$title_tag.'>';}
	?>

		<?php if ( $loop->have_posts() ) : ?>

			<?php 
				if( $show_found_posts == 'yes' || (!empty($link_text) && is_array( $link )) ) : 
			?>
			<div class="top-shop-section">
				<?php if ( $show_found_posts == 'yes' ) : ?>
					<span class="found"><?php echo $loop->found_posts; ?> <?php _e( 'products found', 'zn_framework' ); ?></span>
				<?php endif; ?>
				<?php if (!empty($link_text) && is_array( $link )) { 
					echo $link['start'] . $link_text . $link['end']; }
				?>
			</div>

			<?php endif; ?>


			<?php 
				// SHould we show the filter ?
				if ( $show_filter == 'yes' ) { zn_woocommerce_dropdown(); }
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<?php 
					// Set-up Woocommerce speicic 
					global $woocommerce_loop;
					$woocommerce_loop['columns'] = $columns;
					wc_get_template_part( 'content', 'product' ); 

					?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	</div>
</div>



		<?php

		remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
		wp_reset_postdata();

	}

	public function layered_nav_query( $filtered_posts ) {
		global $_chosen_attributes;

		if ( sizeof( $_chosen_attributes ) > 0 ) {

			$matched_products   = array(
				'and' => array(),
				'or'  => array()
			);
			$filtered_attribute = array(
				'and' => false,
				'or'  => false
			);

			foreach ( $_chosen_attributes as $attribute => $data ) {
				$matched_products_from_attribute = array();
				$filtered = false;

				if ( sizeof( $data['terms'] ) > 0 ) {
					foreach ( $data['terms'] as $value ) {

						$posts = get_posts(
							array(
								'post_type' 	=> 'product',
								'numberposts' 	=> -1,
								'post_status' 	=> 'publish',
								'fields' 		=> 'ids',
								'no_found_rows' => true,
								'tax_query' => array(
									array(
										'taxonomy' 	=> $attribute,
										'terms' 	=> $value,
										'field' 	=> 'term_id'
									)
								)
							)
						);

						if ( ! is_wp_error( $posts ) ) {

							if ( sizeof( $matched_products_from_attribute ) > 0 || $filtered )
								$matched_products_from_attribute = $data['query_type'] == 'or' ? array_merge( $posts, $matched_products_from_attribute ) : array_intersect( $posts, $matched_products_from_attribute );
							else
								$matched_products_from_attribute = $posts;

							$filtered = true;
						}
					}
				}

				if ( sizeof( $matched_products[ $data['query_type'] ] ) > 0 || $filtered_attribute[ $data['query_type'] ] === true ) {
					$matched_products[ $data['query_type'] ] = ( $data['query_type'] == 'or' ) ? array_merge( $matched_products_from_attribute, $matched_products[ $data['query_type'] ] ) : array_intersect( $matched_products_from_attribute, $matched_products[ $data['query_type'] ] );
				} else {
					$matched_products[ $data['query_type'] ] = $matched_products_from_attribute;
				}

				$filtered_attribute[ $data['query_type'] ] = true;

				$this->filtered_product_ids_for_taxonomy[ $attribute ] = $matched_products_from_attribute;
			}

			// Combine our AND and OR result sets
			if ( $filtered_attribute['and'] && $filtered_attribute['or'] )
				$results = array_intersect( $matched_products[ 'and' ], $matched_products[ 'or' ] );
			else
				$results = array_merge( $matched_products[ 'and' ], $matched_products[ 'or' ] );

			if ( $filtered ) {

				WC()->query->layered_nav_post__in   = $results;
				WC()->query->layered_nav_post__in[] = 0;

				if ( sizeof( $filtered_posts ) == 0 ) {
					$filtered_posts   = $results;
					$filtered_posts[] = 0;
				} else {
					$filtered_posts   = array_intersect( $filtered_posts, $results );
					$filtered_posts[] = 0;
				}

			}
		}
		return (array) $filtered_posts;
	}
	public function layered_nav_init( ) {

			global $_chosen_attributes;

			$_chosen_attributes = array();

			$attribute_taxonomies = wc_get_attribute_taxonomies();
			if ( $attribute_taxonomies ) {
				foreach ( $attribute_taxonomies as $tax ) {

					$attribute       = wc_sanitize_taxonomy_name( $tax->attribute_name );
					$taxonomy        = wc_attribute_taxonomy_name( $attribute );
					$name            = 'filter_' . $attribute;
					$query_type_name = 'query_type_' . $attribute;

			    	if ( ! empty( $_GET[ $name ] ) && taxonomy_exists( $taxonomy ) ) {

			    		$_chosen_attributes[ $taxonomy ]['terms'] = explode( ',', $_GET[ $name ] );

			    		if ( empty( $_GET[ $query_type_name ] ) || ! in_array( strtolower( $_GET[ $query_type_name ] ), array( 'and', 'or' ) ) )
			    			$_chosen_attributes[ $taxonomy ]['query_type'] = apply_filters( 'woocommerce_layered_nav_default_query_type', 'and' );
			    		else
			    			$_chosen_attributes[ $taxonomy ]['query_type'] = strtolower( $_GET[ $query_type_name ] );

					}
				}
		    }

		    add_filter('loop_shop_post_in', array( $this, 'layered_nav_query' ) );
	    
	}

}

?>
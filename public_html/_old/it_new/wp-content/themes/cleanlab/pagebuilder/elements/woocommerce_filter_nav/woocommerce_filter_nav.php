<?php
/*
	Name: WooCommerce Filter Nav
	Description: This element will generate an icon box
	Class: ZnWooFilterNav
	Category: content
	Level: 3
	Style: true
	Dependency_class: WooCommerce
*/

class ZnWooFilterNav extends ZnElements {

	function options() {
		global $zn_framework;


		$attribute_array = array();
		$attribute_taxonomies = wc_get_attribute_taxonomies();
			if ( $attribute_taxonomies )
				foreach ( $attribute_taxonomies as $tax )
					if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) )
						$attribute_array[ $tax->attribute_name ] = $tax->attribute_name;

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
							'id'          => 'attribute',
							'name'        => 'Attribute',
							'description' => 'Please select the desired product categories you want to display',
							'type'        => 'select',
							'options'	  => $attribute_array
						),
					)
				),
				'styling' => array(
					'title' => 'Styling options',
					'options' => array(
						array(
							'id'          => 'title_tag',
							'name'        => 'Title HTML tag ( Default is H2 )',
							'description' => 'Select the desired title HTML tag',
							'type'        => 'select',
							'std'        => 'h2',
							'options'	  => array( 'h1' => 'H1','h2' => 'H2','h3' => 'H3','h4' => 'H4','h5' => 'H5','h6' => 'H6', )
						),
					)
				)
			);

		return $options;

	}


	function element() {

		$title = $this->opt('title','');
		$title_tag = $this->opt('title_tag','h2');

		$queried_obect = get_queried_object();
		$current_term 	= $queried_obect ? get_queried_object()->term_id : false;
		$saved_taxonomy = $this->opt( 'attribute','');
		$taxonomy 		= wc_attribute_taxonomy_name( $saved_taxonomy );
		$query_type 	= 'or';

		//print_Z( $saved_taxonomy );

		if( ! taxonomy_exists( $taxonomy ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options and select at least an attribute.</div>';
			return;
		}

		$get_terms_args = array( 'hide_empty' => '1' );
		$terms = get_terms( $taxonomy, $get_terms_args );

			$_chosen_attributes = array();

			$attribute_taxonomies = wc_get_attribute_taxonomies();
			if ( $attribute_taxonomies ) {
				foreach ( $attribute_taxonomies as $tax ) {

					$attribute       = wc_sanitize_taxonomy_name( $tax->attribute_name );
					$taxonomy_name        = wc_attribute_taxonomy_name( $attribute );
					$name            = 'filter_' . $attribute;
					$query_type_name = 'query_type_' . $attribute;

			    	if ( ! empty( $_GET[ $name ] ) && taxonomy_exists( $taxonomy_name ) ) {

			    		$_chosen_attributes[ $taxonomy_name ]['terms'] = explode( ',', $_GET[ $name ] );

			    		if ( empty( $_GET[ $query_type_name ] ) || ! in_array( strtolower( $_GET[ $query_type_name ] ), array( 'and', 'or' ) ) )
			    			$_chosen_attributes[ $taxonomy_name ]['query_type'] = apply_filters( 'woocommerce_layered_nav_default_query_type', 'and' );
			    		else
			    			$_chosen_attributes[ $taxonomy_name ]['query_type'] = strtolower( $_GET[ $query_type_name ] );

					}
				}
		    }

		    if ( count( $terms ) == 0 && empty( $title ) ) {
				echo '<div class="zn-pb-notification">Please configure the element options.</div>';
				return;
		    }

			echo '<div class="widget_layered_nav '.$this->data['uid'].'">';

			// SHOW TITLE ?
			if ( !empty( $title ) ) { echo '<'.$title_tag.' class="page-title">'.$title.'</'.$title_tag.'>';}

				// List display
				echo "<ul>";

				foreach ( $terms as $term ) {

				//	print_Z( sanitize_key( $taxonomy ) );
					//print_Z( sanitize_key(  $term->term_taxonomy_id ) );

					// Get count based on current view - uses transients
					$transient_name = 'wc_ln_count_' . md5( sanitize_key( $taxonomy ) . sanitize_key( $term->term_taxonomy_id ) );

					if ( false === ( $_products_in_term = get_transient( $transient_name ) ) ) {

						$_products_in_term = get_objects_in_term( $term->term_id, $taxonomy );

						set_transient( $transient_name, $_products_in_term );
					}


					$option_is_set = ( isset( $_chosen_attributes[ $taxonomy ] ) && in_array( $term->term_id, $_chosen_attributes[ $taxonomy ]['terms'] ) );

					// If this is an AND query, only show options with count > 0
					if ( $query_type == 'and' ) {

						$count = sizeof( array_intersect( $_products_in_term, WC()->query->filtered_product_ids ) );

						if ( $count > 0 && $current_term !== $term->term_id )
							$found = true;

						if ( $count == 0 && ! $option_is_set )
							continue;

					// If this is an OR query, show all options so search can be expanded
					} else {

							$count = sizeof( $_products_in_term );

							if ( $count > 0 )
								$found = true;

					}

					$arg = 'filter_' . sanitize_title( $saved_taxonomy );

					$current_filter = ( isset( $_GET[ $arg ] ) ) ? explode( ',', $_GET[ $arg ] ) : array();

					if ( ! is_array( $current_filter ) )
						$current_filter = array();

					$current_filter = array_map( 'esc_attr', $current_filter );

					if ( ! in_array( $term->term_id, $current_filter ) )
						$current_filter[] = $term->term_id;


					$link = get_page_link( zn_get_the_id() );

					// All current filters
					if ( $_chosen_attributes ) {
						foreach ( $_chosen_attributes as $name => $data ) {
							if ( $name !== $taxonomy ) {

								// Exclude query arg for current term archive term
								while ( in_array( $current_term, $data['terms'] ) ) {
									$key = array_search( $current_term, $data );
									unset( $data['terms'][$key] );
								}

								// Remove pa_ and sanitize
								$filter_name = sanitize_title( str_replace( 'pa_', '', $name ) );

								if ( ! empty( $data['terms'] ) )
									$link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );

								if ( $data['query_type'] == 'or' )
									$link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
							}
						}
					}

					// Min/Max
					if ( isset( $_GET['min_price'] ) )
						$link = add_query_arg( 'min_price', $_GET['min_price'], $link );

					if ( isset( $_GET['max_price'] ) )
						$link = add_query_arg( 'max_price', $_GET['max_price'], $link );

					// Orderby
					if ( isset( $_GET['orderby'] ) )
						$link = add_query_arg( 'orderby', $_GET['orderby'], $link );

					// Current Filter = this widget
					if ( isset( $_chosen_attributes[ $taxonomy ] ) && is_array( $_chosen_attributes[ $taxonomy ]['terms'] ) && in_array( $term->term_id, $_chosen_attributes[ $taxonomy ]['terms'] ) ) {

						$class = 'class="chosen"';

						// Remove this term is $current_filter has more than 1 term filtered
						if ( sizeof( $current_filter ) > 1 ) {
							$current_filter_without_this = array_diff( $current_filter, array( $term->term_id ) );
							$link = add_query_arg( $arg, implode( ',', $current_filter_without_this ), $link );
						}

					} else {

						$class = '';
						$link = add_query_arg( $arg, implode( ',', $current_filter ), $link );

					}

					// Search Arg
					if ( get_search_query() )
						$link = add_query_arg( 's', get_search_query(), $link );

					// Post Type Arg
					if ( isset( $_GET['post_type'] ) )
						$link = add_query_arg( 'post_type', $_GET['post_type'], $link );

					// Query type Arg
					if ( $query_type == 'or' && ! ( sizeof( $current_filter ) == 1 && isset( $_chosen_attributes[ $taxonomy ]['terms'] ) && is_array( $_chosen_attributes[ $taxonomy ]['terms'] ) && in_array( $term->term_id, $_chosen_attributes[ $taxonomy ]['terms'] ) ) )
						$link = add_query_arg( 'query_type_' . sanitize_title( $saved_taxonomy ), 'or', $link );

					echo '<li ' . $class . '>';

					echo ( $count > 0 || $option_is_set ) ? '<a href="' . esc_url( apply_filters( 'woocommerce_layered_nav_link', $link ) ) . '">' : '<span>';

					echo $term->name;

					echo ( $count > 0 || $option_is_set ) ? '</a>' : '</span>';

					echo ' <small class="count">' . $count . '</small></li>';

				}

				echo "</ul>";
			echo "</div>";

	}



}

?>
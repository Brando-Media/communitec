<?php

//print_z( $data );

//** SET HEADER COLORS **/
	$sliding_background	= isset($style_options['sliding_background'])	? $style_options['sliding_background']	: '#ff525e';
	$sliding_color		= isset($style_options['sliding_color'])		? $style_options['sliding_color']		: '#FFFFFF';
	$menu_background	= isset($style_options['menu_background'])		? $style_options['menu_background']		: '#FFFFFF';
	$menu_color			= isset($style_options['menu_color'])			? $style_options['menu_color']			: '#bababa';
	$switcher = 1; //** Use to lighten or darken the color
	if (adjustBrightness($menu_color,70) == "#000000"){
		//** If the menu color darken by 70% becomes black, then lighten all colors; else darken them.
		$switcher = -1;
	}
	$menu_hover_color	= isset($style_options['menu_hover_color'])		? $style_options['menu_hover_color']	: '#3d3d3d';
	if (isset($style_options['autogenerate_menu_colors']) && $style_options['autogenerate_menu_colors'] == 'yes') {
		$menu_hover_color	= adjustBrightness($menu_color, $switcher*67.2);
	}
	$switcher = 1;
	if (adjustBrightness($menu_background, 10) == "#000000"){
		//** If the menu color darken by 70% becomes black, then lighten all colors; else darken them.
		$switcher = -1;
	}
	$menu_subitems_background	= isset($style_options['menu_subitems_background'])	? $style_options['menu_subitems_background']	: '#fafafa';
	if (isset($style_options['autogenerate_menu_colors']) && $style_options['autogenerate_menu_colors'] == 'yes') {
		$menu_subitems_background = adjustBrightness($menu_background, $switcher*1.96);
	}
	$menu_active_background	= isset($style_options['menu_active_background'])	? $style_options['menu_active_background']	: '#f4f4f4';
	if (isset($style_options['autogenerate_menu_colors']) && $style_options['autogenerate_menu_colors'] == 'yes') {
		$menu_active_background	= adjustBrightness($menu_background, $switcher*4.31);
	}
	$menu_border_color	= isset($style_options['menu_border_color'])	? $style_options['menu_border_color']	: '#eeeeee';
	if (isset($style_options['autogenerate_menu_colors']) && $style_options['autogenerate_menu_colors'] == 'yes') {
		$menu_border_color = adjustBrightness($menu_background, $switcher*6.66);
	}
	//** Calculate color with alpha opacity for social icons (x,y,z,0.5)
	$sliding_social_bakground = zn_hex2rgba_str($sliding_color, 50);
	//** Calculate color for back to top button bottom margin
	$sliding_background_darker = adjustBrightnessByStep($sliding_background, -39);

echo "
	#cart .cart-container .buttons .button { background:$sliding_background; }
	.cart-container .widget_shopping_cart_content .cart_list li > span, #cart .cart-container .buttons .button {color:$sliding_background; }
	.cart-container #cart .cart-container .total { background: $menu_active_background;  }
	#cart .cart-container { background: $menu_background; }
	#cart .cart-container ul li, #cart .cart-container .total { border-top: solid 1px $menu_border_color; }
	#cart .cart-container { border: solid 1px $menu_border_color; }
	#cart .cart-container .buttons .button { color: $sliding_color; }
";


//** Set colors or defaults
foreach ( $data['style_options']['custom_colors'] as $key => $style ) {
	extract($style);

	if( !empty( $custom_style_name ) ){
		if ( $custom_style_name == 'Default Colors' ) {
			// THIS IS THE DEFAULT STYLE

			/** DARKER COLOR FOR HOVERS ( #000000 ) **/ 
			$darker_primary_color = adjustBrightnessByStep($primary_color, -39); // #d82b37
			$darker_secondary_color = adjustBrightnessByStep($secondary_color, -61); // #000
			$darker_alt_bg_color = adjustBrightnessByStep($section_alt_background, -51); // #c7c8c8
			$lighter_borders_color = adjustBrightnessByStep($borders_color, 9);
			$lighter_text_color_color = adjustBrightnessByStep($text_color, 54);


			echo "
				/* PRIMARY COLOR */
				.widget_price_filter .price_slider .ui-slider-handle,
				.woocommerce span.onsale,
				.single_add_to_cart_button,
				.widget_layered_nav ul li.chosen a:before,
				.woocommerce .products li .add_to_cart_button:before,
				.widget_shopping_cart .buttons .button,
				.woocommerce .shop_table .product-remove a,
				.woocommerce .single_add_to_cart_button:hover,
				.woocommerce .cart-collaterals .checkout-button
				{ background: $primary_color; }

				.widget_layered_nav ul li a:hover,
				.woocommerce .star-rating span:before,
				.woocommerce p.stars a.active:after,
				.woocommerce p.stars a:hover:after,
				.woocommerce-tabs ul.tabs li.active > a,
				.woocommerce .shop_table .product-subtotal .amount,
				.order-total .amount { color: $primary_color; }

				.woocommerce span.onsale:before 
				{ border-right-color: $primary_color; }

				 .woocommerce .shop_table .product-remove a:hover { background: $darker_primary_color; }
				.single_add_to_cart_button { box-shadow: 0 6px $darker_primary_color; }
				.single_add_to_cart_button:hover {box-shadow: 0 4px $darker_primary_color; }

				/* SECONDARY COLOR */
				.widget_price_filter .price_slider_amount button,
				.customer_details dt,
				.shop_table .coupon > label,
				.cart_totals .order-total th { color:$secondary_color; }


				.price > .amount,
				.woocommerce .quantity input[type=number],
				.woocommerce .quantity input,
				.dropdown-menu>li>a:hover,
				.dropdown-menu>li>a:focus,
				.woocommerce .shop_table thead,
				.woocommerce .shop_table tfoot
				{ color:$darker_secondary_color; }
				
				.widget_shopping_cart .buttons .button:hover,
				.woocommerce .cart-collaterals .checkout-button:hover
				{ background: $secondary_color; }

				/* ALTERNATIVE COLOR */
				.woocommerce span.onsale, .single_add_to_cart_button,
				.woocommerce .products li .add_to_cart_button:before,
				.widget_shopping_cart .buttons .button,
				.woocommerce .shop_table .product-remove a,
				.woocommerce .cart-collaterals .checkout-button
				{ color: $alternative_color; }

				/* BORDER COLOR */
				.widget_price_filter .price_slider { background: $borders_color; }

				.woocommerce .quantity input[type=number]:active,
				.woocommerce .quantity input[type=number]:focus
				{ border-color: $borders_color; }

				.woocommerce-tabs .panel,
				.woocommerce-tabs ul.tabs  > li > a,
				.widget_layered_nav ul li a:before {border: 1px solid $borders_color;}

				.woocommerce .quantity { box-shadow: 0 1px 1px $lighter_borders_color; }
				
				/* PARAGRAPH COLOR */
				.widget_layered_nav ul li a,
				.dropdown-menu>li>a,
				.widget_product_categories ul ul li a,
				.woocommerce .variations .label label { color: $text_color; }

				/* SECTION BG */
				.woocommerce-tabs .panel,
				.woocommerce-tabs ul.tabs li.active > a,
				.zn_woo_message_popup,
				.dropdown-menu { background-color: $section_background;  }

				/* ALTERNATIVE BG */
				.woocommerce-tabs ul.tabs  > li > a, .product-info ul li .product_info_box, 
				.woocommerce .commentlist .comment-text,
				.dropdown-menu>li>a:hover,
				.dropdown-menu>li>a:focus,
				.woocommerce .shop_table thead,
				.woocommerce .shop_table tfoot,
				.woocommerce .woocommerce-info,
				.woocommerce #payment ul
				{ background-color: $section_alt_background;  }

				.woocommerce .star-rating:before { color: $darker_alt_bg_color; }

				.woocommerce .cart-collaterals .checkout-button:hover {
					color: $section_alt_background;
				}
	

			";

			break;
		}
		else{ continue; }
	}
	
	
	// SetDynamic_primary_color($primary_color, $style_name);
	// SetDynamic_secondary_color($secondary_color, $style_name);
	// SetDynamic_alternative_color($alternative_color, $style_name);
	// SetDynamic_background_color($section_background, $style_name);
	// SetDynamic_alternative_background_color($section_alt_background, $style_name);
	// SetDynamic_default_paragraph_color($text_color, $style_name);
	// SetDynamic_default_borders_color($borders_color, $style_name);

}
?>
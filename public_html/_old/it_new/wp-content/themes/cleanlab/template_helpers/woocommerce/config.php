<?php

global $zn_config;
$zn_config['shop_related_columns'] = zget_option( 'shop_related_columns', 'zn_woocommerce_options', false, 4 );
$zn_config['shop_related_num'] = zget_option( 'shop_related_num', 'zn_woocommerce_options', false, 4 );


add_theme_support( 'woocommerce' );
define('ZN_WOOCOMMERCE_BASE_PATH', THEME_BASE.'/template_helpers/woocommerce/');
define('ZN_WOOCOMMERCE_BASE_URI', THEME_BASE_URI.'/template_helpers/woocommerce/');

// Load WOOCOMMERCE specific options
require( ZN_WOOCOMMERCE_BASE_PATH.'woo_options.php' );
require( ZN_WOOCOMMERCE_BASE_PATH.'metaboxes.php' );

// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'zn_dequeue_styles' );
function zn_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );     // Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
	return $enqueue_styles;
}



// LOAD OUR CUSTOM WOOCOMMERCE.CSS
// IN ADMIN, LOAD OUR CUSTOM CSS GENERATOR FOR WOOCOMMERCE
if(!is_admin()){
	add_action( 'wp_enqueue_scripts', 'zn_woocommerce_load_scripts', 9);
}
else{
	add_action( 'zn_generate_css', 'zn_woocommerce_styles' );
}
function zn_woocommerce_load_scripts()
{
	wp_enqueue_style( 'zn-woocommerce-css', ZN_WOOCOMMERCE_BASE_URI .'assets/css/woocommerce-styles.css');
}

function zn_woocommerce_styles( $data ){
	require( ZN_WOOCOMMERCE_BASE_PATH .'color_config.php' );
}

// Set the proper page id for the shop archive page
add_filter('zn_get_the_id','zn_set_shop_page_id', 10, 1);
function zn_set_shop_page_id($id)
{
	if(is_shop()) $id = woocommerce_get_page_id('shop');
	return $id;
}

add_action( 'woocommerce_before_main_content', 'zn_woocommerce_before_main_content' );
add_action( 'woocommerce_after_main_content', 'zn_woocommerce_after_main_content' );

function zn_woocommerce_before_main_content(){

	// SHOW THE HEADER
	if(is_shop()) $title  = get_option('woocommerce_shop_page_title');

	$shop_id = woocommerce_get_page_id('shop');
	if($shop_id && $shop_id != -1)
	{
		if(empty($title)) $title = get_the_title($shop_id);
	}

	if(!$title) $title  = __("Shop",'zn_framework');

	if(is_product_category() || is_product_tag())
	{
		global $wp_query;
		$tax = $wp_query->get_queried_object();
		$title = $tax->name;
	}

	//** Put the header with title and breadcrumb
	zn_get_header_breadcrumb( array( 'title' => $title ) );

	// Check to see if the page has a sidebar or not
	global $zn_config;
	$columns = '';
	if ( is_single() ) {
		$layout = 'woo_single_sidebar';
	}
	elseif( is_archive() ){
		$layout = 'woo_archive_sidebar';
		$saved_columns = zget_option( 'shop_columns' , 'zn_woocommerce_options' , false, '3' );
		$columns = 'zn_shop_columns'. ( int )$saved_columns;
	}

	$zn_config['force_sidebar'] = $layout;
	$main_class = zn_get_content_class($layout);
	

	global $post;

	?>
	<section class="<?php echo $columns;?> shop_page">
		<div class="container">
			<div class="row">
				<div class="<?php echo $main_class; ?>">
	<?php

}

function zn_woocommerce_after_main_content(){
	?>

				</div>
				<!-- sidebar -->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</section>
	<?php
}

/*--------------------------------------------------------------------------------------------------
	ADD PRODUCT THUMBNAIL AND DESCRIPTION ROW
--------------------------------------------------------------------------------------------------*/
function zn_single_product_class($classes) {
	if (is_singular('product')) {
		$classes[] = 'row';
	}

	return $classes;
}
add_filter('post_class', 'zn_single_product_class');

/*--------------------------------------------------------------------------------------------------
	WRAP PRODUCT THUMBNAIL
--------------------------------------------------------------------------------------------------*/
add_action( 'woocommerce_before_single_product_summary', 'zn_add_image_div', 2);
add_action( 'woocommerce_before_single_product_summary',  'zn_close_div', 20);
function zn_add_image_div()
{
	echo "<div class='single_product_main_image mbottom80 col-sm-6'>";
}

function zn_close_div()
{
	echo "</div>";
}

/*--------------------------------------------------------------------------------------------------
	WRAP PRODUCT DESCRIPTION
--------------------------------------------------------------------------------------------------*/
add_action( 'woocommerce_before_single_product_summary', 'zn_add_summary_div', 25);
add_action( 'woocommerce_after_single_product_summary',  'zn_close_div', 3);
function zn_add_summary_div()
{
	echo "<div class='single_product_summary mbottom80 col-sm-6'>";
}

/*--------------------------------------------------------------------------------------------------
	Set Cross-sells items and columns to 4
--------------------------------------------------------------------------------------------------*/
add_filter('woocommerce_cross_sells_total', 'zn_woocommerce_cross_sale_count');
add_filter('woocommerce_cross_sells_columns', 'zn_woocommerce_cross_sale_count');

function zn_woocommerce_cross_sale_count($count)
{
	return 4;
}

/*--------------------------------------------------------------------------------------------------
	ADD PROPER COLUMN CLASS FOR RELATED PRODUCTS
--------------------------------------------------------------------------------------------------*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
add_action( 'woocommerce_after_single_product_summary', 'zn_woocommerce_output_related_products', 20);

function zn_woocommerce_output_related_products()
{

	global $zn_config;
	$output = "";

	ob_start();
	woocommerce_related_products( array( 'posts_per_page' => $zn_config['shop_related_num'], 'columns' => ( int )$zn_config['shop_related_columns'] ) );
	$content = ob_get_clean();
	if($content)
	{
		$output .= "<div class='col-sm-12 zn_shop_columns".$zn_config['shop_related_columns']."'>";
		$output .= $content;
		$output .= "</div>";
	}

	echo $output;

}

/*--------------------------------------------------------------------------------------------------
	ADD PROPER COLUMN CLASS FOR UPSELL PRODUCTS
--------------------------------------------------------------------------------------------------*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display',15);
add_action( 'woocommerce_after_single_product_summary', 'zn_woocommerce_upsell_display', 15);

function zn_woocommerce_upsell_display()
{

	global $zn_config;
	$output = "";

	ob_start();
	woocommerce_upsell_display( $zn_config['shop_related_num'] , ( int )$zn_config['shop_related_columns'] );
	$content = ob_get_clean();
	if($content)
	{
		$output .= "<div class='col-sm-12 zn_shop_columns".$zn_config['shop_related_columns']."'>";
		$output .= $content;
		$output .= "</div>";
	}

	echo $output;

}

/*--------------------------------------------------------------------------------------------------
	ADD PROPER COLUMN CLASS FOR PRODUCT TABS
--------------------------------------------------------------------------------------------------*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs',10);
add_action( 'woocommerce_after_single_product_summary', 'zn_woocommerce_output_product_data_tabs', 10);

function zn_woocommerce_output_product_data_tabs()
{

	$output = "";

	ob_start();
	woocommerce_output_product_data_tabs();
	$content = ob_get_clean();
	if($content)
	{
		$output .= "<div class='col-sm-12'>";
		$output .= $content;
		$output .= "</div>";
	}

	echo $output;

}

/*--------------------------------------------------------------------------------------------------
	MOVE STUFF FOR SINGLE PRODUCT
--------------------------------------------------------------------------------------------------*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating',10);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 22);

/*--------------------------------------------------------------------------------------------------
	SHOP SINGLE EXTRA INFO
--------------------------------------------------------------------------------------------------*/
add_action( 'woocommerce_single_product_summary', 'zn_woocommerce_template_single_extra_info', 21);
function zn_woocommerce_template_single_extra_info(){

	global $post, $zn_config,$product;
	$info_boxes = get_post_meta( $post->ID, 'product_info', true ); 
	$col_num = get_post_meta( $post->ID, 'info_columns', true );
	$col_num = !empty( $col_num ) ? $col_num : 'col-sm-4';
	$show_stock = get_post_meta( $post->ID, 'show_stock_info_box', true );


	//  print_z( $info_boxes );

	if( !empty( $info_boxes ) ) {
		echo '<div class="product-info">';
			echo '<ul class="clearfix">';

				foreach ( $info_boxes as $info_box ) {
				
					$icon_opt       = !empty( $info_box['info_icon'] ) ? $info_box['info_icon'] : '';
					$icon           = !empty( $icon_opt['family'] )  ? '<span class="tcolor" '.zn_generate_icon( $icon_opt ).'></span>' : '';
					$info_name      = !empty( $info_box['info_name'] ) ? '<b>'. $info_box['info_name'] .'</b>' : '';
					$info_desc      = !empty( $info_box['info_desc'] ) ? '<b class="darker_secondary_color">'.  $info_box['info_desc'] .'</b>' : '';
					
					if( !empty( $icon ) || !empty( $info_name ) || !empty( $info_desc ) ) {
						echo '<li class="'.$col_num.'">';
							echo '<div class="product_info_box">';
								echo $icon;
								echo $info_name;
								echo $info_desc;
							echo '</div>';
						echo '</li>';
					}
				}
	
			echo '</ul>';
		echo '</div>';
	}

}


/*--------------------------------------------------------------------------------------------------
	HEADER CART
--------------------------------------------------------------------------------------------------*/
$show_search_icon = zget_option( 'show_cart_icon' , 'general_options', false, 'yes' );
if ( $show_search_icon == 'yes' ){
	add_action( 'zn_header_icons', 'zn_header_cart' );
	function zn_header_cart(){

		?>
			<div id="cart">
				<a class="icon-cart zn-header-icon" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart','zn_framework' ); ?>"></a>
				<div class="cart-container">
					<div class='widget_shopping_cart_content'><?php _e('No products in cart.','zn_framework'); ?></div> 
				</div>
			</div><!-- end cart -->
		<?php

	}
}


/*--------------------------------------------------------------------------------------------------
	REPLACE SHOP LOOP DROPDOWN
--------------------------------------------------------------------------------------------------*/
add_action( 'woocommerce_before_shop_loop', 'zn_woocommerce_dropdown', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); // Remove woo dropdown

function zn_woocommerce_dropdown(){
	
	$orderby = array( 'menu_order' => __( 'default sorting', 'zn_framework' ), 'popularity' => __( 'popularity', 'zn_framework' ), 'rating' => __( 'average rating', 'zn_framework' ), 'date' => __( 'newness', 'zn_framework' ), 'price' => __( 'price: low to high', 'zn_framework' ), 'price-desc' => __( 'price: high to low', 'zn_framework' ) );
	$orderby = apply_filters( 'woocommerce_catalog_orderby' , $orderby );
	$active_orderby = isset( $_GET['orderby'] ) ? $_GET['orderby'] : '';
	
	parse_str($_SERVER['QUERY_STRING'], $params);

?>

	<div class="select dropdown">
		<span><?php _e( 'Sort by', 'zn_framework' );?></span>
		<button class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
		<?php
			if( array_key_exists( $active_orderby, $orderby ) ) {
				echo '<span class="active_orderby">'.$orderby[$active_orderby].'</span>';
				unset($orderby[$active_orderby]);
			}
			else {
				echo __( 'Select', 'zn_framework' );
			}
		?>
		<span class="caret"></span>
		</button>
		<ul class="dropdown-menu reset-list" role="menu" aria-labelledby="dropdownMenu1">
			<?php
				foreach ( $orderby as $key => $value) {
					echo '<li><a role="menuitem" tabindex="-1" href="'.esc_url( zn_build_query_string( $params, 'orderby', $key ) ).'">'.$value.'</a>';
				}
			?>
		</ul>
	</div>
<?php
}


/*--------------------------------------------------------------------------------------------------
	Adds a Query string to the existing query
--------------------------------------------------------------------------------------------------*/
function zn_build_query_string($params = array(), $overwrite_key, $overwrite_value)
{
	$params[$overwrite_key] = $overwrite_value;
	return "?". http_build_query($params);
}


/*--------------------------------------------------------------------------------------------------
	SHOP PAGINATION
--------------------------------------------------------------------------------------------------*/
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
add_action( 'woocommerce_after_shop_loop', 'zn_woo_pagination', 10);
function zn_woo_pagination(){
	echo '<div class="zn_woo_pagination">';
		zn_pagination();
	echo '</div>';
}

/*--------------------------------------------------------------------------------------------------
	LOAD NUMBER OF ITEMS FROM THEME"S OPTIONS PANEL
--------------------------------------------------------------------------------------------------*/
add_filter( 'loop_shop_per_page', 'zn_number_of_items_shop', 20 );
function zn_number_of_items_shop( $cols ){
	$num_items = zget_option( 'shop_num' , 'zn_woocommerce_options' , false, '6' );
	return intval($num_items);
}


/*--------------------------------------------------------------------------------------------------
	Change number or products per row to value FROM THEME"S OPTIONS PANEL
--------------------------------------------------------------------------------------------------*/
//add_filter('loop_shop_columns', 'zn_loop_columns');
if (!function_exists('zn_loop_columns')) {
	function zn_loop_columns() {
		return zget_option( 'shop_columns' , 'zn_woocommerce_options' , false, '3' );
	}
}

/*--------------------------------------------------------------------------------------------------
	ADD THE ADD TO CART MESSAGE AFTER PRESSING THE ADD TO CART
--------------------------------------------------------------------------------------------------*/
global $zn_framework;
$added_to_cart_message = __('was added to cart', 'zn_framework');
$zn_add_to_cart = array ( 'zn_add_to_cart' =>
				"
					$('body').bind('added_to_cart', zn_added_to_cart_dropdown);

					function zn_added_to_cart_dropdown(){

						$('#header').removeClass('nav-up').addClass('nav-down');

						var stickier = jQuery('#header #cart'),
							product         = jQuery.extend({name:'Product', image:''}, zn_added_product);
							template = $('<div class=\"zn_woo_message_popup\">'+ product.image +' <div class=\"zn_woo_ptitle\">\"'+ product.name +'\"</div><div>$added_to_cart_message</div></div>');

						template.bind('mouseenter zn_hide', function()
						{
							template.animate({ 'opacity':0 }, function()
							{
								template.remove();
							});
							
						}).appendTo(stickier).animate({'margin-top':0},500);

						setTimeout(function(){ template.trigger('zn_hide'); }, 2500);


					}

					// GET THE PRODUCT INFO
					var zn_added_product = {};
					jQuery('body').on('click','.add_to_cart_button', function()
					{   
						var productContainer = jQuery(this).parents('.product').eq(0), product = {};
							product.name     = productContainer.find('h3').text();
							product.image    = productContainer.find('img');
							
							if(product.image.length) product.image = \"<img class='popup-product-image' src='\" + product.image.get(0).src + \"' title='' alt='' />\";
							
							zn_added_product = product;
					});

					// Fix the woocommerce tabs for smooth scroll
					$('.woocommerce-tabs li a').addClass('no-scroll');

					// Change lightbox
					$('a.zoom').nivoLightbox();

				");

$zn_framework->add_inline_js($zn_add_to_cart);

// CHANGE WOOCOMMERCE LIGHTBOX
//Remove prettyPhoto lightbox
add_action( 'wp_enqueue_scripts', 'zn_remove_woo_lightbox', 99 );
function zn_remove_woo_lightbox() {
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
}

function zn_woocommerce_single_product_image_html($html) {
    $html = str_replace('data-rel="prettyPhoto', 'data-lightbox-gallery="woo_gallery', $html);
    return $html;
}
add_filter('woocommerce_single_product_image_html', 'zn_woocommerce_single_product_image_html', 99, 1); // single image
add_filter('woocommerce_single_product_image_thumbnail_html', 'zn_woocommerce_single_product_image_html', 99, 1); // thumbnails


//REMOVE WOOCOMMERCE ACTIONS
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); // REMOVE SHPO SIDEBAR
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20); // REMOVE BREADCRUMB

// SET PROPER BREADCRUMBS
// Inspired from Avia Framework
add_filter( 'zn_breadcrumbs_elements', 'zn_change_breadcrumbs' );
function zn_change_breadcrumbs( $elements ){
	if(is_woocommerce()) 
	{

		$home 		= $elements[0];
		$shop_id 	= woocommerce_get_page_id('shop');
		$last 		= array_pop($elements);
		$taxonomy 	= "product_cat";

		if(is_shop())
		{
			if(!empty($shop_id) && $shop_id  != -1) $elements = array_merge( $elements, zn_get_parents( $shop_id ) );
			$last = '';
		}

		if(is_product())
		{
			//Check if category has parents. If not , display the category
			$product_category = $parent_cat = array();
			$temp_cats = get_the_terms(get_the_ID(), $taxonomy);

			if(!empty($temp_cats))
			{
				foreach($temp_cats as $key => $cat)
				{
					if($cat->parent != 0 && !in_array($cat->term_taxonomy_id, $parent_cat))
					{
						$product_category[] = $cat;
						$parent_cat[] = $cat->parent;
					}
				}

				//if no categories with parents use the first one
				if(empty($product_category)) $product_category[] = reset($temp_cats);

			}
			//unset the elements. We have to build it again
			unset($elements);

			$elements[0] = $home;
			if(!empty($shop_id) && $shop_id  != -1)    $elements = array_merge( $elements, zn_get_parents( $shop_id ) );
			if(!empty($parent_cat)) $elements = array_merge( $elements, zn_get_term_parents( $parent_cat[0] , $taxonomy ) );
			if(!empty($product_category)) $elements[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . esc_url( get_term_link( $product_category[0]->slug, $taxonomy ) ) . '" title="' . esc_attr( $product_category[0]->name ) . '">' . $product_category[0]->name . '</a></li>';
		}

		if(is_product_category() || is_product_tag())
		{
			if(!empty($shop_id) && $shop_id  != -1)
			{
				$shop_trail = zn_get_parents( $shop_id ) ;
				array_splice($elements, 1, 0, $shop_trail);
			}
		}

		if(is_product_tag())
		{
			$last = __("Tag",'zn_framework').": ".$last;
		}

		if(!empty($last)) $elements[] = $last;
	}

	return $elements;
}

?>
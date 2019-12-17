<?php
if ( function_exists( 'add_theme_support' ) ) {
	// Setup thumbnail support
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-formats', array( 'link', 'quote' ) );
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'gallery_grid', 705, 529, true );
	add_image_size( 'gallery_grid_large', 987, 740, true );
	add_image_size( 'gallery_masonry', 705, 9999, false );
	add_image_size( 'gallery_next_prev', 700, 350, true );
	add_image_size( 'blog', 960, 636, true );
	add_image_size( 'related_post', 190, 140, true );
}

add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
    	add_theme_support( 'woocommerce' );
}

add_filter('wp_get_attachment_image_attributes', 'photome_responsive_image_fix');

function photome_responsive_image_fix($attr) {
    if (isset($attr['sizes'])) unset($attr['sizes']);
    if (isset($attr['srcset'])) unset($attr['srcset']);
    return $attr;
}

add_filter('wp_calculate_image_sizes', '__return_false', PHP_INT_MAX);
add_filter('wp_calculate_image_srcset', '__return_false', PHP_INT_MAX);
remove_filter('the_content', 'wp_make_content_images_responsive');

/* Flush rewrite rules for custom post types. */
add_action( 'after_switch_theme', 'flush_rewrite_rules' );
?>
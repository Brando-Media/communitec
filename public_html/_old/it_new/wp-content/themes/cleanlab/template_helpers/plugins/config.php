<?php

/**
 * Array of plugin arrays. Required keys are name and slug.
 * If the source is NOT from the .org repo, then source is also required.
 */
$plugins = array(
	array(
		'name'     				=> 'Revolution Slider', // The plugin name
		'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
		'source'   				=> THEME_BASE_URI . '/template_helpers/plugins/revslider.zip', // The plugin source
		'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		'version' 				=> '5.0.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		'z_plugin_icon'		 => THEME_BASE_URI . '/template_helpers/plugins/rev_slider.png',
		'z_plugin_author'        => 'themepunch',
		'z_plugin_description'       => 'Slider Revolution is not only for “Sliders”. You can now build a beautiful one-page web presence with absolutely no coding knowledge required.',
	),
	array(
		'name'      => 'WooCommerce',
		'slug'      => 'woocommerce',
		'required'  => false,
		'version' 	=> '2.4.6',
		'z_plugin_icon'		 => THEME_BASE_URI . '/template_helpers/plugins/woocommerce.png',
		'z_plugin_author'        => 'woothemes',
		'z_plugin_description'       => 'WooCommerce is a free eCommerce plugin that allows you to sell anything, beautifully. Built to integrate seamlessly with WordPress, WooCommerce is the world’s favorite eCommerce solution that gives both store owners and developers complete control.',
	),
);

?>
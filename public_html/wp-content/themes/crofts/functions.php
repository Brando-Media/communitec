<?php

	

/***************************************************************  

Javascript files include

***************************************************************/

	function pego_javascripts() {

		wp_enqueue_script('jquery-ui-accordion'); 

		wp_enqueue_script('jquery'); 

		wp_register_script('pego_chart_js', get_template_directory_uri() . '/js/jquery.easy-pie-chart.js','','',true);

		wp_register_script('pego_owl_carousel', get_template_directory_uri() . '/js/owl.carousel.js','','',true);

		wp_register_script('pego_isotopeJS', get_template_directory_uri() . '/js/jquery.isotope.min.js','','',true);

		wp_register_script('pego_counter', get_template_directory_uri() . '/js/jquery.countTo.js','','',true);

		wp_register_script('pego_snap-svg', get_template_directory_uri() . '/js/snap.svg-min.js','','',true);

		wp_register_script('pego_classie', get_template_directory_uri() . '/js/classie.js','','',true);

		wp_register_script('pego_bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js','','',true);

		wp_register_script('pego_prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js','','',true);

		wp_enqueue_script('pego_modernizr', get_template_directory_uri() . '/js/modernizr.custom.js','','',true);

		wp_enqueue_script('pego_jquery-waypoints', get_template_directory_uri() . '/js/waypoints.min.js','','',true);

		wp_enqueue_script('pego_jquery-hoverdir', get_template_directory_uri() . '/js/jquery.hoverdir.js','','',true);

		wp_enqueue_script('pego_jquery-animsition-min', get_template_directory_uri() . '/js/jquery.animsition.min.js','','',true);

		wp_enqueue_script('pego_superfish', get_template_directory_uri() . '/js/superfish.js','','',true);

		wp_enqueue_script('pego_custom-javascript', get_template_directory_uri() . '/js/custom.js','','',true);

	}

	add_action('wp_enqueue_scripts', 'pego_javascripts');	

	

/***************************************************************  

Style files include

***************************************************************/

	function pego_theme_styles() { 

		global $pego_prefix;	

		wp_enqueue_style( 'Pe-icons-style', get_template_directory_uri() . '/css/Pe-icon-7-stroke.css', array(), '1.0', 'all' );

		wp_enqueue_style( 'animsition', get_template_directory_uri() . '/css/animsition.css', array(), '1.0', 'all' );

		wp_enqueue_style( 'fontello-style', get_template_directory_uri() . '/css/fontello.css', array(), '1.0', 'all' );

		wp_enqueue_style( 'owl-carousel-style', get_template_directory_uri() . '/css/owl.carousel.css', array(), '1.0', 'all' );

		wp_enqueue_style( 'owl-carousel-transitions', get_template_directory_uri() . '/css/owl.transitions.css', array(), '1.0', 'all' );

		wp_enqueue_style( 'prettyPhoto-style', get_template_directory_uri() . '/css/prettyPhoto.css', array(), '1.0', 'all' );	

		wp_enqueue_style( 'jscomposer-style', get_template_directory_uri() . '/css/js_composer.css', array(), '1.0', 'all' );

		wp_enqueue_style( 'default-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all' );	

		wp_enqueue_style( 'media-style', get_template_directory_uri() . '/css/media.css', array(), '1.0', 'all' );

	}	

	add_action('wp_enqueue_scripts', 'pego_theme_styles');

	



/***************************************************************  

Style files include for backend

***************************************************************/

	function pego_admin_styles() { 

        wp_enqueue_style('admin-style', get_template_directory_uri() .'/css/admin-style.css',  false, '1.0', 'all');

	}	

	add_action( 'admin_enqueue_scripts', 'pego_admin_styles' );



/***************************************************************  

 Enqueue the Google fonts

***************************************************************/

	function pego_theme_fonts() {

  	  	$protocol = is_ssl() ? 'https' : 'http';

  	  	wp_enqueue_style( 'pego_opensans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700italic,700,800,800italic" );

  	  	wp_enqueue_style( 'pego_montserrat', "$protocol://fonts.googleapis.com/css?family=Montserrat:400,700" );  	

  	  	wp_enqueue_style( 'pego_merriweather', "$protocol://fonts.googleapis.com/css?family=Merriweather:400,300italic,300,400italic,700,700italic" );  

	}

	add_action( 'wp_enqueue_scripts', 'pego_theme_fonts' );



/***************************************************************  

Javascript files include for backend

***************************************************************/	

 	function pego_admin_scripts() {

      	wp_enqueue_media(); 

      	wp_register_script('pego_admin-js', get_template_directory_uri() .'/js/admin-javascript.js', array('jquery'));

       	wp_enqueue_script('pego_admin-js');

	}

	add_action('admin_enqueue_scripts', 'pego_admin_scripts');	

	

/***************************************************************  

Menu declaration

***************************************************************/

	register_nav_menu( 'primary', esc_html__( 'Navigation Menu', 'crofts' ) );

	

/***************************************************************  

Widget areas

***************************************************************/

	function pego_new_widgets_init() {	

	

		register_sidebar(array(

			'name' => 'Sidebar #1',

			'id' => 'blog-sidebar1',

			'description'   => 'These are widgets for the sidebar.',

			'before_widget' => '<div id="%1$s" class="widget animationClass %2$s">',

			'after_widget'  => '<div class="clear"></div></div><div class="clear"></div>',

			'before_title'  => '<h3 class="sidebar-title">',

			'after_title'   => '</h3><div class="title-stripes-left"></div><div class="clear"></div>'

		));	

		

		register_sidebar(array(

			'name' => 'Sidebar #2',

			'id' => 'blog-sidebar2',

			'description'   => 'These are widgets for the sidebar.',

			'before_widget' => '<div id="%1$s" class="widget animationClass %2$s">',

			'after_widget'  => '<div class="clear"></div></div><div class="clear"></div>',

			'before_title'  => '<h3 class="sidebar-title">',

			'after_title'   => '</h3><div class="title-stripes-left"></div><div class="clear"></div>'

		));	

		

		register_sidebar(array(

			'name' => 'Sidebar #3',

			'id' => 'blog-sidebar3',

			'description'   => 'These are widgets for the sidebar.',

			'before_widget' => '<div id="%1$s" class="widget animationClass %2$s">',

			'after_widget'  => '<div class="clear"></div></div><div class="clear"></div>',

			'before_title'  => '<h3 class="sidebar-title">',

			'after_title'   => '</h3><div class="title-stripes-left"></div><div class="clear"></div>'

		));	

		

		



	}

	add_action( 'widgets_init', 'pego_new_widgets_init' );	

	

	



	

/***************************************************************  

Added support for post formats

***************************************************************/	

	add_theme_support( 'post-formats', array( 'image', 'video', 'gallery', 'audio', 'quote', 'link' ) );	

	

	add_theme_support( 'automatic-feed-links' );	



/***************************************************************  

Added support for post thumbnails

***************************************************************/

	if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );



/***************************************************************  

Pagination

***************************************************************/

	function pego_kriesi_pagination($pages = '', $range = 2) {  

		 $showitems = ($range * 2)+1;  



		 global $paged;

		 if(empty($paged)) $paged = 1;



		 if($pages == '')

		 {

			 global $wp_query;

			 $pages = $wp_query->max_num_pages;

			 if(!$pages)

			 {

				 $pages = 1;

			 }

		 }   



		 if(1 != $pages)

		 {

			 echo "<div class='pagination'>";

			 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link(1))."'>&laquo;</a>";

			 if($paged > 1 && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link($paged - 1))."'>&lsaquo;</a>";



			 for ($i=1; $i <= $pages; $i++)

			 {

				 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))

				 {

					 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".esc_url(get_pagenum_link($i))."' class='inactive' >".$i."</a>";

				 }

			 }



			 if ($paged < $pages && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link($paged + 1))."'>&rsaquo;</a>";  

			 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link($pages))."'>&raquo;</a>";

			 echo "</div>\n";

		 }

	}



/***************************************************************  

Get all posts

***************************************************************/	

	function pego_get_all_posts() {	

		//custom sidebars from admin

		$pego_argsPosts= array('post_type'=> 'post', 'posts_per_page' => -1, 'order'=> 'DESC', 'orderby' => 'post_date'  );

		$pego_allPosts = get_posts($pego_argsPosts);	

		$pego_allPostsArray = array();

		if($pego_allPosts) {

			foreach($pego_allPosts as $pego_singlePost)

			{ 	

				$pego_allPostsArray[$pego_singlePost->ID] = $pego_singlePost->post_title;						

			}

		return $pego_allPostsArray;

		}

	}



/***************************************************************  

Search shortcode

***************************************************************/

	add_shortcode('wpbsearch', 'get_search_form');



/***************************************************************  

Custom admin logo

***************************************************************/

	function pego_custom_login_logo() {

		$pego_logo_admin = get_template_directory_uri()."/images/logo-black.png";

		if ( function_exists( 'ot_get_option' ) ) {

			if (ot_get_option('pego_admin_logo') != '') {

				$pego_logo_admin = ot_get_option('pego_admin_logo');

			}

		}		

		echo '<style type="text/css">

			h1 a { background-size: auto !important; width: auto !important; background-image:url('.esc_url($pego_logo_admin).') !important;  }

		</style>';

		

    }

    add_action('login_head', 'pego_custom_login_logo');	



/***************************************************************  

Get attachment ID

***************************************************************/	

	function pego_get_attachment_id_from_src ($image_src) {

		global $wpdb;

		$id =  $wpdb->get_results( $wpdb->prepare(  "SELECT ID FROM {$wpdb->posts} WHERE guid = %s", $image_src ));

		return $id;



	}



/***************************************************************  

Get image by size

***************************************************************/	

	function pego_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => NULL, 'thumb_size' => 'thumbnail' ) ) {

		//array( 'post_id' => $post_id, 'thumb_size' => $grid_thumb_size )

		if ( (!isset($params['attach_id']) || $params['attach_id'] == NULL) && (!isset($params['post_id']) || $params['post_id'] == NULL) ) return;

		$post_id = isset($params['post_id']) ? $params['post_id'] : 0;



		if ( $post_id ) $attach_id = get_post_thumbnail_id($post_id);

		else $attach_id = $params['attach_id'];



		$thumb_size = $params['thumb_size'];



		global $_wp_additional_image_sizes;

		$thumbnail = '';

		$p_img['url'] = '';



		if ( is_string($thumb_size) && ((!empty($_wp_additional_image_sizes[$thumb_size]) && is_array($_wp_additional_image_sizes[$thumb_size])) || in_array($thumb_size, array('thumbnail', 'thumb', 'medium', 'large', 'full') ) ) ) {

			//$thumbnail = get_the_post_thumbnail( $post_id, $thumb_size );

			$thumbnail = wp_get_attachment_image( $attach_id, $thumb_size );

			//TODO APPLY FILTER

		}



		if ( $thumbnail == '' &&  $attach_id ) {

			if ( is_string($thumb_size) ) {

				$thumb_size = str_replace(array( 'px', ' ', '*' ), array( '', '', 'x' ), $thumb_size);

				$thumb_size = explode("x", $thumb_size);

			}

		

			// Resize image to custom size

			$p_img = pego_wpb_resize($attach_id, null, $thumb_size[0], $thumb_size[1], true);

			$alt = trim(strip_tags( get_post_meta($attach_id, '_wp_attachment_image_alt', true) ));



			if ( empty($alt) ) {

				$attachment = get_post($attach_id);

				$alt = trim(strip_tags( $attachment->post_excerpt )); // If not, Use the Caption

			}

			if ( empty($alt) )

				$alt = trim(strip_tags( $attachment->post_title )); // Finally, use the title

			if ( $p_img ) {

				$img_class = '';

				//if ( $grid_layout == 'thumbnail' ) $img_class = ' no_bottom_margin'; class="'.$img_class.'"

				$thumbnail = '<img src="'.$p_img['url'].'" width="'.$p_img['width'].'" height="'.$p_img['height'].'" alt="'.$alt.'" />';

				//TODO: APPLY FILTER

			}

		}

		$p_img_large = wp_get_attachment_image_src($attach_id, 'large' );

		return array( 'thumbnail' => $thumbnail, 'p_img_large' => $p_img_large, 'thumb_src' => $p_img['url'] );

	}



	if (!function_exists('pego_wpb_resize')) {

		function pego_wpb_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

			// this is an attachment, so we have the ID

			if ( $attach_id ) {

				$image_src = wp_get_attachment_image_src( $attach_id, 'full' );

				$actual_file_path = get_attached_file( $attach_id );

				// this is not an attachment, let's use the image url

			} else if ( $img_url ) {

				$file_path = parse_url( $img_url );

				$actual_file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];

				$actual_file_path = ltrim( $file_path['path'], '/' );

				$actual_file_path = rtrim( ABSPATH, '/' ).$file_path['path'];

				$orig_size = getimagesize( $actual_file_path );

				$image_src[0] = $img_url;

				$image_src[1] = $orig_size[0];

				$image_src[2] = $orig_size[1];

			}

			$file_info = pathinfo( $actual_file_path );

			$extension = '.'. $file_info['extension'];



			// the image path without the extension

			$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];



			$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;



			// checking if the file size is larger than the target size

			// if it is smaller or the same size, stop right here and return

			if ( $image_src[1] > $width || $image_src[2] > $height ) {



				// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)

				if ( file_exists( $cropped_img_path ) ) {

					$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );

					$vt_image = array (

						'url' => $cropped_img_url,

						'width' => $width,

						'height' => $height

					);

					return $vt_image;

				}



				// $crop = false

				if ( $crop == false ) {

					// calculate the size proportionaly

					$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );

					$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;



					// checking if the file already exists

					if ( file_exists( $resized_img_path ) ) {

						$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );



						$vt_image = array (

							'url' => $resized_img_url,

							'width' => $proportional_size[0],

							'height' => $proportional_size[1]

						);

						return $vt_image;

					}

				}



				// no cache files - let's finally resize it

				$img_editor =  wp_get_image_editor($actual_file_path);



				if ( is_wp_error($img_editor) || is_wp_error( $img_editor->resize($width, $height, $crop)) ) {

					return array (

						'url' => '',

						'width' => '',

						'height' => ''

					);

				}



				$new_img_path = $img_editor->generate_filename();



				if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {

					return array (

						'url' => '',

						'width' => '',

						'height' => ''

					);

				}



				if ( pego_wpb_debug() ) {

					var_dump(file_exists($actual_file_path));

					var_dump($actual_file_path);

				}



				if(!is_string($new_img_path)) {

					return array (

						'url' => '',

						'width' => '',

						'height' => ''

					);

				}



				$new_img_size = getimagesize( $new_img_path );

				$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );



				// resized output

				$vt_image = array (

					'url' => $new_img,

					'width' => $new_img_size[0],

					'height' => $new_img_size[1]

				);

				return $vt_image;

			}



			// default output - without resizing

			$vt_image = array (

				'url' => $image_src[0],

				'width' => $image_src[1],

				'height' => $image_src[2]

			);

			return $vt_image;

		}

	}

	if (!function_exists('pego_wpb_debug')) {   

		 function pego_wpb_debug() {

			if ( isset($_GET['pego_wpb_debug']) && $_GET['pego_wpb_debug'] == 'pego_wpb_debug' ) return true;

			else return false;

		}

	}





/***************************************************************  

Comment reply

***************************************************************/

	function pego_js_comment_reply(){

		if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )

			wp_enqueue_script( 'comment-reply' );

	}

	add_action('wp_print_scripts', 'pego_js_comment_reply');





/***************************************************************  

Content width defined

***************************************************************/	

	if ( ! isset( $content_width ) ) $content_width = 900;



	

/***************************************************************  

Get all categories

***************************************************************/	

function pego_get_all_categories() {	

	$pego_allcategories = get_categories();

	$pego_allCategoriesArray = array();

	$pego_allCategoriesArray[] = 'All';

	if($pego_allcategories) {

		foreach($pego_allcategories as $pego_singleCategory)

		{ 	

			$pego_allCategoriesArray[$pego_singleCategory->cat_ID] = $pego_singleCategory->name;						

		}

	return $pego_allCategoriesArray;

	}

}



/***************************************************************  

Get all testimonials

***************************************************************/	

function pego_get_all_test() {	

	//custom sidebars from admin

	$argsTest= array('post_type'=> 'testimonial', 'posts_per_page' => -1, 'order'=> 'DESC', 'orderby' => 'post_date'  );

	$allTest = get_posts($argsTest);	

	$allTestimonials = array();

	if($allTest) {

		foreach($allTest as $singleTest)

		{ 	

			$allTestimonials[$singleTest->ID] = $singleTest->post_title;						

		}

	return $allTestimonials;

	}

}



/***************************************************************  

Get header logo

***************************************************************/	

	function pego_get_header_logo() {	

		$pego_logo = get_template_directory_uri()."/images/logo-white.png";

		$pego_logo_retina = '';

		if ( function_exists( 'ot_get_option' ) ) {

			if (ot_get_option('pego_logo') != '') {

				$pego_logo = ot_get_option('pego_logo');

			}

			if (ot_get_option('pego_logo_retina') != ''){

				$pego_logo_retina = ot_get_option('pego_logo_retina');

			}

		}

	

		$output  = '<div id="logo" class="logo">';

			$output .= '<a href="'.home_url().'" title="">';

				$output .= '<img id="logoImage"  class="logoImage"  src="'.esc_url($pego_logo).'" alt="" title="" />';

				if ($pego_logo_retina != '') { 

					$output .= '<img  class="logoImageRetina"  src="'.esc_url($pego_logo_retina).'" alt="" title="" />';

				}

			$output .= '</a><div class="clear"></div>';

		$output .= '</div>';

	

		echo $output;

	

	}





/***************************************************************  

Get post excerpt from post id

***************************************************************/

function pego_get_the_excerpt($post_id) {

  global $post;  

  $save_post = $post;

  $post = get_post($post_id);

  $output = get_the_excerpt();

  $post = $save_post;

  return $output;

}



/***************************************************************  

Include php files

***************************************************************/	



	$GLOBALS['wpcf_prefix'] = 'wpcf-';

	include("functions/pego-vc-edit.php");

	include("functions/widget-commented-posts.php");

	include("functions/widget-socials.php");



/***************************************************************  

Automatic plugin include

***************************************************************/

	/**

	 * This file represents an example of the code that themes would use to register

	 * the required plugins.

	 *

	 * It is expected that theme authors would copy and paste this code into their

	 * functions.php file, and amend to suit.

	 *

	 * @package    TGM-Plugin-Activation

	 * @subpackage Example

	 * @version    2.4.2

	 * @author     Thomas Griffin

	 * @author     Gary Jones

	 * @copyright  Copyright (c) 2011, Thomas Griffin

	 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later

	 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation

	 */



	/**

	 * Include the TGM_Plugin_Activation class.

	 */

	require_once (get_template_directory() . '/functions/class-tgm-plugin-activation.php');



	add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

	/**

	 * Register the required plugins for this theme.

	 *

	 * In this example, we register two plugins - one included with the TGMPA library

	 * and one from the .org repo.

	 *

	 * The variable passed to tgmpa_register_plugins() should be an array of plugin

	 * arrays.

	 *

	 * This function is hooked into tgmpa_init, which is fired within the

	 * TGM_Plugin_Activation class constructor.

	 */

	function my_theme_register_required_plugins() {



		/*

		 * Array of plugin arrays. Required keys are name and slug.

		 * If the source is NOT from the .org repo, then source is also required.

		 */

		 $plugins = array(



			array(

				'name'               => 'Option Tree', // The plugin name.

				'slug'               => 'option-tree', // The plugin slug (typically the folder name).

				'source'             => get_stylesheet_directory() . '/lib/plugins/option-tree.2.5.5.zip', // The plugin source.

				'required'           => true, // If false, the plugin is only 'recommended' instead of required.

				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.

				'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.

				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.

				'external_url'       => '', // If set, overrides default API URL and points to an external URL.

			),



			array(

				'name'               => 'WPBakery Visual Composer', // The plugin name.

				'slug'               => 'js_composer', // The plugin slug (typically the folder name).

				'source'             => get_stylesheet_directory() . '/lib/plugins/js_composer.zip', // The plugin source.

				'required'           => true, // If false, the plugin is only 'recommended' instead of required.

				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.

				'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.

				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.

				'external_url'       => '', // If set, overrides default API URL and points to an external URL.

			),

			

			

			 array(

				'name'               => 'Types', // The plugin name.

				'slug'               => 'types', // The plugin slug (typically the folder name).

				'source'             => get_stylesheet_directory() . '/lib/plugins/types.zip', // The plugin source.

				'required'           => true, // If false, the plugin is only 'recommended' instead of required.

				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.

				'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.

				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.

				'external_url'       => '', // If set, overrides default API URL and points to an external URL.

			),

			

				array(

				'name'               => 'Revolution Slider', // The plugin name.

				'slug'               => 'revslider', // The plugin slug (typically the folder name).

				'source'             => get_stylesheet_directory() . '/lib/plugins/revslider.zip', // The plugin source.

				'required'           => true, // If false, the plugin is only 'recommended' instead of required.

				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.

				'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.

				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.

				'external_url'       => '', // If set, overrides default API URL and points to an external URL.

			)

		);



		/*

		 * Array of configuration settings. Amend each line as needed.

		 * If you want the default strings to be available under your own theme domain,

		 * leave the strings uncommented.

		 * Some of the strings are added into a sprintf, so see the comments at the

		 * end of each line for what each argument will be.

		 */

		$config = array(

			'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.

			'default_path' => '',                      // Default absolute path to pre-packaged plugins.

			'menu'         => 'tgmpa-install-plugins', // Menu slug.

			'parent_slug'  => 'themes.php',            // Parent menu slug.

			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.

			'has_notices'  => true,                    // Show admin notices or not.

			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.

			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.

			'is_automatic' => false,                   // Automatically activate plugins after installation or not.

			'message'      => '',                      // Message to output right before the plugins table.

			'strings'      => array(

				'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),

				'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),

				'installing'                      => __( 'Installing Plugin: %s', 'theme-slug' ), // %s = plugin name.

				'oops'                            => __( 'Something went wrong with the plugin API.', 'theme-slug' ),

				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).

				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).

				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'theme-slug' ), // %1$s = plugin name(s).

				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).

				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).

				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'theme-slug' ), // %1$s = plugin name(s).

				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'theme-slug' ), // %1$s = plugin name(s).

				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'theme-slug' ), // %1$s = plugin name(s).

				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'theme-slug' ),

				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'theme-slug' ),

				'return'                          => __( 'Return to Required Plugins Installer', 'theme-slug' ),

				'plugin_activated'                => __( 'Plugin activated successfully.', 'theme-slug' ),

				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'theme-slug' ), // %s = dashboard link.

				'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.

			)

		);



		tgmpa( $plugins, $config );



	}	

	

/***************************************************************  

Wp title filter

***************************************************************/	

	function pego_wp_title( $title, $sep ) {

		global $paged, $page;



		if ( is_feed() )

			return $title;



		// Add the site name.

		$title .= get_bloginfo( 'name' );



		// Add the site description for the home/front page.

		$site_description = get_bloginfo( 'description', 'display' );

		if ( $site_description && ( is_home() || is_front_page() ) )

			$title = "$title $sep $site_description";



		// Add a page number if necessary.

		if ( $paged >= 2 || $page >= 2 )

			$title = "$title $sep " . sprintf( __( 'Page %s', 'crofts' ), max( $paged, $page ) );



		return $title;

	}

	add_filter( 'wp_title', 'pego_wp_title', 10, 2 );



	

/***************************************************************  

Custom fonts in editor

***************************************************************/	



	add_filter('mce_buttons', 'pego_add_font_selection_to_tinymce');



	 function pego_add_font_selection_to_tinymce($buttons) {

		array_push($buttons, 'fontselect');

		 return $buttons;

	 }

	add_filter( 'tiny_mce_before_init', 'pego_wpex_mce_google_fonts_array' );

	

	function pego_wpex_mce_google_fonts_array( $initArray ) {

			  $pego_theme_advanced_fonts = 'Open Sans=Open Sans, sans-serif;';

			  $pego_theme_advanced_fonts .= 'Merriweather=Merriweather, serif;';

				if ( function_exists( 'ot_get_option' ) ) {

					if (ot_get_option('pego_google_fonts') != '') {

						$pego_google_fonts = ot_get_option('pego_google_fonts');

						if ($pego_google_fonts) { 

							foreach ($pego_google_fonts as $pego_google_font ) {

								$pego_familyFont =  str_replace("font-family: ","",$pego_google_font['pego_google_font_family']);

								$pego_familyFont =  str_replace("'","",$pego_familyFont);

								$pego_theme_advanced_fonts .=  esc_attr($pego_google_font['title']).'='.$pego_familyFont;

							}

						}

					}

				}

		$initArray['font_formats'] = $pego_theme_advanced_fonts;

		return $initArray;

	}

	

	

	add_action( 'admin_init', 'pego_wpex_mce_google_fonts_styles' );

	

	function pego_wpex_mce_google_fonts_styles() {

	   $pego_font1 = 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700italic,700,800,800italic';

	   add_editor_style( str_replace( ',', '%2C', $pego_font1 ) );

	   $pego_font3 = 'http://fonts.googleapis.com/css?family=Merriweather:400,300italic,300,400italic,700,700italic';

	   add_editor_style( str_replace( ',', '%2C', $pego_font3 ) );

	   if ( function_exists( 'ot_get_option' ) ) {

			if (ot_get_option('pego_google_fonts') != '') {

				$pego_google_fonts = ot_get_option('pego_google_fonts');

				if ($pego_google_fonts) { 

					foreach ($pego_google_fonts as $pego_google_font ) {

						$pego_font = 'http://'.$pego_google_font['pego_google_font_url'];

						add_editor_style( str_replace( ',', '%2C', $pego_font ) );

					}

				}

			}

		}

	}

	

/***************************************************************  

Get all team members

***************************************************************/	

function pego_get_all_team_members() {	

	$argsTeamMember= array('post_type'=> 'team-member', 'posts_per_page' => -1, 'order'=> 'DESC', 'orderby' => 'menu_order ID'  );

	$allTeamMembers = get_posts($argsTeamMember);

	$allallTeamMemberArray = array();

	if($allTeamMembers) {

		foreach($allTeamMembers as $singleTeamMember)

		{ 	

			$allallTeamMemberArray[] = $singleTeamMember->ID;						

		}

	return $allallTeamMemberArray;

	}

}	

	

/***************************************************************  

Comments

***************************************************************/		

	

	function pego_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		extract($args, EXTR_SKIP);



		if ( 'div' == $args['style'] ) {

			$tag = 'div';

			$add_below = 'comment';

		} else {

			$tag = 'li';

			$add_below = 'div-comment';

		}

	?>

		<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

		<?php if ( 'div' != $args['style'] ) : ?>

		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">

		<?php endif; ?>

		<div class="comment-author vcard">

		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>

		<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>

		</div>

		<?php if ( $comment->comment_approved == '0' ) : ?>

			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'crofts' ); ?></em>

			<br />

		<?php endif; ?>



		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">

			<?php

				/* translators: 1: date, 2: time */

				printf( '%1$s', get_comment_date() ); ?></a><?php edit_comment_link( __( '(Edit)', 'crofts' ), '  ', '' );

			?>

		</div>

		<div class="clear"></div>

		<?php comment_text(); ?>



		<div class="reply">

		<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

		</div>

		<?php if ( 'div' != $args['style'] ) : ?>

		</div>

		<?php endif; ?>

	<?php

	}





/***************************************************************  

Menu customization

***************************************************************/		



	class pego_description_walker_mobile extends Walker_Nav_Menu

	{

       function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

		global $wp_query;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';



		$class_names = $value = '';



		$classes = empty( $item->classes ) ? array() : (array) $item->classes;



		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

		$class_names = ' class="' . esc_attr( $class_names ) . '"';



		$output .= $indent . '<li id="menu-item-mobile-'. $item->ID . '"' . $value . $class_names .'>';



		

		

		$content_page_id = get_post_meta ( $item->ID, '_menu_item_object_id', true );



	   



		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';

		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';

		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		

		$item_output = $args->before;

		$item_output .= '<a'. $attributes .'>';

		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

		$item_output .= '</a>';

		$item_output .= $args->after;

		



		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );

	}

			  

	}	

	

/***************************************************************  

Set header items

***************************************************************/		

	

	function pego_set_header() {

	?>

			<div id="header" class="header-wrapper">

				<div class="header-inner-wrapper">

							<?php 

							pego_get_header_logo(); 

							if (has_nav_menu('primary')) {

							?>

								<a class="mobile-menu-show"><i class="menu-icon pe-7s-menu"></i></a>
								<?php if (has_nav_menu('primary')) {

		?>

			<div class="mobile-menu-wrapper">

				<?php wp_nav_menu(

					array(

					'theme_location' => 'primary',

					'menu_class' => 'mobile-menu',

					'walker' => new pego_description_walker_mobile()

					)); 

				?>	

			</div>

		<?php

		} ?>
								<div class="main-menu">

									<?php wp_nav_menu(

										array(

										'theme_location' => 'primary', 

										'menu_class' => 'sf-menu'

										)); 

									?>

								</div>

							<?php

							}

							?>

							<!-- <i id="trigger-overlay" class="header-search icon-search" ></i> -->
							<ul class="social-icons">

							<li class="facebook"><a href="http://www.facebook.com/communitec" target="_blank" title="Facebook">Facebook</a></li>

							<li class="twitter"><a href="http://www.twitter.com/communitecltd" target="_blank" title="Twitter">Twitter</a></li>

							<li class="linkedin"><a href="http://www.linkedin.com/company/communitec-ltd" target="_blank" title="Linkedin">Linkedin</a></li>

						</ul>
							<div class="clear"></div>

				</div>

				<div class="clear"></div>

			</div>

		<div class="clear"></div>

		<?php

		

	}

	

	

	function pego_set_overlay_search() {

		wp_enqueue_script('pego_snap-svg');

		wp_enqueue_script('pego_classie');

		?>

		<div class="fulloverlay overlay-contentscale">

			<button type="button" class="overlay-close">Close</button>

			<div class="popup-search-wrapper">

				<?php echo do_shortcode('[wpbsearch]'); ?>

			</div>

		</div>

		<?php

	} 

	

/***************************************************************  

Set footer items

***************************************************************/		



	function pego_set_footer() {

		if ( function_exists( 'ot_get_option' ) ) {

			if (ot_get_option('pego_footer_content') != '')  {

			

		?>

				<div id="footer" class="footer">

					 <div class="center">

							<?php echo do_shortcode(wp_kses( ot_get_option('pego_footer_content'), array( 'a' => array( 'href' => array(),  'title' => array()  ), 'br' => array(), 'em' => array(),  'strong' => array(), ) )); ?>

					</div>

				</div>

		<?php

			}

		}

		?>

		</div>

		<?php

		if ( function_exists( 'ot_get_option' ) ) {

			if (ot_get_option('pego_google_fonts') != '') {

				$pego_google_fonts = ot_get_option('pego_google_fonts');

				foreach ($pego_google_fonts as $pego_google_font ) {

					echo '<link href="'.$pego_google_font['pego_google_font_url'].'" rel="stylesheet" type="text/css">';

				}

			}

		}

		

		//custom CSS 

		include("functions/custom-css.php"); 

	

	}

	

	/* Sanitized footer content */

	add_filter( 'preprocess_comment', 'pego_comment_sanitize' );

	function pego_comment_sanitize( $comment_arr ) {



		// change comment content to 'hello world'

		$comment_arr['comment_content'] = wp_kses( $comment_arr['comment_content'], array( 'a' => array( 'href' => array(),  'title' => array()  ), 'br' => array(), 'em' => array(),  'strong' => array(), ));



		return  $comment_arr;

	}
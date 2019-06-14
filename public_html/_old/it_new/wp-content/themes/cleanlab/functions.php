<?php

/*--------------------------------------------------------------------------------------------------
	LOAD THE FRAMEWORK
--------------------------------------------------------------------------------------------------*/

global $zn_config;
require get_template_directory().'/framework/zn-framework.php'; // FRAMEWORK FILE

/*--------------------------------------------------------------------------------------------------
	Load theme files and widgets
--------------------------------------------------------------------------------------------------*/
/* Ajax calls */
require THEME_BASE . '/template_helpers/theme_ajax.php'; // THEME AJAX
/* Pagebuilder functions */
require THEME_BASE . '/template_helpers/pagebuilder/functions-pagebuilder.php'; // EXTRA PAGEBUILDER FUNCTIONS
/* Widgets */
require THEME_BASE . '/template_helpers/widgets/social_copyright.php';
require THEME_BASE . '/template_helpers/widgets/latest_news.php';
require THEME_BASE . '/template_helpers/widgets/mailchimp_subscribe.php';
require THEME_BASE . '/template_helpers/widgets/img_banner_ad.php';
/* Post formats */
require THEME_BASE . '/template_helpers/post-formats.php';

// ADD themes text domain
load_theme_textdomain( 'zn_framework', THEME_BASE . '/language' );

/*--------------------------------------------------------------------------------------------------
	Add theme supports
--------------------------------------------------------------------------------------------------*/
function custom_theme_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'video', 'gallery', 'quote', 'audio', 'link' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5' );
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'custom_theme_setup' );

/* Backwork compatibility for title tag */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function zn_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'zn_render_title' );
}

/*--------------------------------------------------------------------------------------------------
	Set content width
--------------------------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

/*--------------------------------------------------------------------------------------------------
	Register the menus : Main nav menu
--------------------------------------------------------------------------------------------------*/
add_action( 'init', 'zn_register_menu' );
if ( ! function_exists( 'zn_register_menu' ) ) {
	function zn_register_menu() {
		register_nav_menus( array(
			'main_navigation' => __( 'Main Navigation', 'zn_framework' ),
		) );
	}
}

/*--------------------------------------------------------------------------------------------------
	Include scripts and styles
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'theme_scripts' ) ) {
	function theme_scripts() {

		global $wp_upload_dir;

		$zn_uploads_dir = trailingslashit( $wp_upload_dir['baseurl'] );
		$zn_uploads_dir = set_url_scheme( $zn_uploads_dir );

		wp_enqueue_style( 'bootstrap', THEME_BASE_URI . '/css/bootstrap.min.css', '', ZN_FW_VERSION );
		wp_enqueue_style( 'plugins_style', THEME_BASE_URI . '/css/plugins.css', '', ZN_FW_VERSION );
		//** For nivo plugin load additional style
		wp_enqueue_style( 'nivo_theme', THEME_BASE_URI . '/images/nivo/default.css', '', ZN_FW_VERSION );
		wp_enqueue_style( 'theme_style', THEME_BASE_URI . '/css/theme-style.css', '', ZN_FW_VERSION );
		wp_enqueue_style( 'dynamic_css', $zn_uploads_dir . 'zn_dynamic.css', '', ZN_FW_VERSION );
		wp_enqueue_style( 'icons-styles', THEME_BASE_URI . '/css/icons-styles.css', '', ZN_FW_VERSION );
		wp_enqueue_style( 'responsive-devices', THEME_BASE_URI . '/css/responsive-devices.css', array('zn_pb_css'), ZN_FW_VERSION );
		//wp_enqueue_style('fullPage', THEME_BASE_URI.'/css/jquery.fullPage.css','',ZN_FW_VERSION);
		wp_register_script( 'bootstrapjs', THEME_BASE_URI . '/js/bootstrap.js', array( 'jquery' ), ZN_FW_VERSION, true );
		wp_enqueue_script( 'bootstrapjs' );

		// COMING SOON SPECIFIC
		wp_register_script( 'comingsooncountdown', THEME_BASE_URI . '/js/comingsoon-countdown.js', array( 'jquery' ), ZN_FW_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/* RESPONSIVE MENU TRIGGER */
		$res_menu_trigger = zget_option( 'header_res_width', 'general_options', false, 994 );
		$no_smooth_scroll = zget_option( 'no_smooth_scroll', 'advanced' );

		wp_enqueue_script( 'plugins_scripts', THEME_BASE_URI . '/js/plugins.js', array( 'jquery' ), ZN_FW_VERSION, true );
		wp_enqueue_script( 'zn_script', THEME_BASE_URI . '/js/zn_script.js', array( 'jquery' ), ZN_FW_VERSION, true );
		wp_localize_script( 'zn_script', 'ZnThemeAjax', array(
			'ajaxurl'          => admin_url( 'admin-ajax.php' ),
			'zn_back_text'     => __( 'Back', 'zn_framework' ),
			'res_menu_trigger' => ( int )$res_menu_trigger,
			'no_smooth_scroll' => esc_js( $no_smooth_scroll ),
		) );

	}
}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );

/*--------------------------------------------------------------------------------------------------
	Load theme's widgets
--------------------------------------------------------------------------------------------------*/


/*--------------------------------------------------------------------------------------------------
	Modify pagination style
--------------------------------------------------------------------------------------------------*/
add_filter( 'zn_pagination', 'zn_modify_pagination' );
if ( ! function_exists( 'zn_modify_pagination' ) ) {
	function zn_modify_pagination( $defaults ) {
		$args = array(
			'range'         => 2,
			'previous_text' => '&laquo;',
			'older_text'    => '&raquo;',
		);

		$args = wp_parse_args( $args, $defaults );

		return $args;
	}
}


/*--------------------------------------------------------------------------------------------------
	SET BODY CSS CLASSES
--------------------------------------------------------------------------------------------------*/
add_filter( 'body_class', 'zn_body_class_names' );
if ( ! function_exists( 'zn_body_class_names' ) ) {
	function zn_body_class_names( $classes ) {

		$boxed_layout = zget_option( 'use_boxed_layout', 'general_options' ) == 'yes' ? 'zn_boxed_layout' : '';
		$classes[]    = $boxed_layout;

		return $classes;
	}
}

/*--------------------------------------------------------------------------------------------------
	Get newsbar
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_get_news_bar' ) ) {
	function zn_get_news_bar( $date = null, $message = null, $css_class = null, $ignorePostType = false ) {

		$allowed_post_types = zget_option( 'show_news_bar', 'general_options', false, array() );
		$post_type          = get_post_type();

		$date    = ! empty( $date ) ? $date : zget_option( 'news_date', 'general_options' );
		$message = ! empty( $message ) ? $message : zget_option( 'news_text', 'general_options' );

		if ( in_array( $post_type, $allowed_post_types ) || $ignorePostType ) {
			?>
			<div id="sub-header" class="<?php echo $css_class; ?>">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<?php
							if ( ! empty( $date ) ) {
								echo '<div class="breakingnews-date"><span>' . formatDate( strtotime( $date['date'] . ' ' . $date['time'] ) ) . '</span></div>';
							}

							if ( ! empty( $message ) ) {
								echo '<div class="breakingnews-title"><span>' . $message . '</span></div>';
							}
							?>

						</div>
					</div>
				</div>
			</div><!-- end sub-header -->
		<?php
		}

	}
}

/*--------------------------------------------------------------------------------------------------
	Returns the sub-header based on arguments
	@style : Default, Title and desc left, Title and desc right, Title and desc centered
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_get_header_breadcrumb' ) ) {
	function zn_get_header_breadcrumb( $args = null, $ignorePostType = false ) {

		//** Check if the title bar is hidden
		$disallowed_post_types = zget_option( 'hide_title_bar', 'general_options', false, array() );
		$post_type          = get_post_type();
		//** If is hidden, output a div with a margin
		if ( in_array( $post_type, $disallowed_post_types ) && !$ignorePostType) {
			?>
			<div class="zn-no-titlebar"></div>
			<?php
			return;
		}

		//** The title bar is not hidden
		$id       = zn_get_the_id();
		$defaults = array(
			'title'       => get_the_title( $id ),
			'description' => get_post_meta( $id, 'zn_page_subtitle', true ),
			'show_date'   => true,
			'heading'     => 'h2',
			'class'       => '',
			'show_bread'  => zget_option( 'show_breadcrumb', 'general_options', false, 'yes' ),
			'color_style' => zget_option( 'header_ustyle', 'general_options' ),
			'layout'      => zget_option( 'title_bar_display', 'general_options' ),
			'background'  => zget_option( 'title_bar_bg', 'general_options' )
		);

		// CHECK IF WE HAVE SOME OTHER VALUES SAVED IN THE CURRENT POST META
		if ( is_single() ) {
			$post_defaults    = array();
			$title_bar_layout = get_post_meta( $id, 'title_bar_display', true );
			if ( ! empty( $title_bar_layout ) ) {
				$post_defaults = array(
					'color_style' => get_post_meta( $id, 'header_ustyle', true ),
					'show_bread'  => get_post_meta( $id, 'show_breadcrumb', true ),
					'layout'      => $title_bar_layout,
					'background'  => get_post_meta( $id, 'title_bar_bg', true ),
				);
			}
			$defaults = wp_parse_args( $post_defaults, $defaults );

		}

		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'zn_sub_header', $args );

		// Put each item in it's own var
		extract( $args );

		if ( is_array( $background ) && ! empty( $background['image'] ) ) {
			$image_url = set_url_scheme( $background['image'] );
			$background_image = "background-image: url('" . $image_url . "');";
			$background_image .= 'background-repeat:' . $background['repeat'] . ';';
			$background_image .= 'background-position:' . $background['position']['x'] . ' ' . $background['position']['y'] . ';';
			$background_image .= 'background-attachment:' . $background['attachment'] . ';';
			if ( ! empty( $background['size'] ) ) {
				$background_image .= 'background-size:' . $background['size'] . ';';
			}

			$background = 'style=" ' . $background_image . ' "';

		} else {
			$background = '';
		}

		?>
		<div <?php echo $background; ?>
			class="header-breadcrumb <?php echo $class; ?> <?php echo $layout; ?> <?php echo $color_style; ?>">
			<div class="container">
				<div class="zn-table">
					<div class="zn-td zn_title_and_desc">
						<<?php echo $heading; ?> class="section-title"><?php echo esc_attr($title); ?></<?php echo $heading; ?>>

						<div class="section-description"><?php echo esc_attr($description); ?></div>
					</div>
					<div class="zn-td zn_bread_and_date">
						<?php if ( 'yes' == $show_bread ) {
							echo zn_breadcrumbs();
						}
						?>
					</div>
				</div>
			</div>
		</div><!-- end header-breadcrumb -->
	<?php

	}
}

/*--------------------------------------------------------------------------------------------------
	SCHEMA.ORG markup helper
--------------------------------------------------------------------------------------------------*/
function zn_html_schema() {
	$base = 'http://schema.org/';
	if ( is_author() ) {
		$type = 'ProfilePage';
	} elseif ( is_search() ) {
		$type = 'SearchResultsPage';
	} else {
		$type = 'WebPage';
	}
	echo 'itemscope="itemscope" itemtype="' . $base . $type . '"';
}

/*--------------------------------------------------------------------------------------------------
	Breadcrumbs - SWITCH TO SCHEMA.ORG AS SOON AS BREADCRUMBS ARE AVAILABLE
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_breadcrumbs' ) ) {
	function zn_breadcrumbs() {

		$delimiter        = '<li>&frasl;</li>';
		$home             = __( 'Home', 'zn_framework' );
		$homeLink         = home_url();
		$showCurrent      = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$elements         = array();
		$breadcrumb_start = '<ul xmlns:v="http://rdf.data-vocabulary.org/#" class="breadcrumbs reset-list">';
		$breadcrumb_end   = '</ul>';

		$prepend = $path = '';

		global $post, $wp_query, $wp_rewrite;

		$return = '';

		if ( ! is_front_page() ) {
			$elements[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . $homeLink . '">' . $home . '</a></li>';
		}

		// IF WE ARE ON THE HOMEPAGE
		if ( is_front_page() ) {
			$elements[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" class="active" href="' . $homeLink . '">' . $home . '</a></li>';
		} // IF THIS IS THE BLOG/POST page
		elseif ( is_home() ) {
			$home_page = get_page( $wp_query->get_queried_object_id() );
			$title     = get_the_title( $home_page->ID );

			$elements[] = '<li class="active">' . $title . '</li>';
		} // POST, PAGE, ATTACHEMENT, PORTFOLIO single pages
		elseif ( is_singular() ) {

			$post_type = $post->post_type;
			$parent    = $post->post_parent;

			if ( 'page' !== $post_type && 'post' !== $post_type ) {

				$post_type_object = get_post_type_object( $post_type );

				/* If $front has been set, add it to the $path. */
				if ( 'post' == $post_type || 'attachment' == $post_type || ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front ) ) {
					$path .= trailingslashit( $wp_rewrite->front );
				}

				/* If there's a slug, add it to the $path. */
				if ( ! empty( $post_type_object->rewrite['slug'] ) ) {
					$path .= $post_type_object->rewrite['slug'];
				}

				/* If there's a path, check for parents. */
				if ( ! empty( $path ) ) {
					$elements = array_merge( $elements, zn_get_parents( '', $path ) );
				}

				/* If there's an archive page, add it to the elements. */
				if ( ! empty( $post_type_object->has_archive ) && function_exists( 'get_post_type_archive_link' ) ) {
					$elements[] = '<li typeof="v:Breadcrumb"><a href="' . get_post_type_archive_link( $post_type ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . $post_type_object->labels->name . '</a></li>';
				}
			}

			if ( ! empty( $parent ) ) {
				$elements = array_merge( $elements, zn_get_parents( $parent ) );
			}

			if ( 'post' == $post_type ) {

				// If we are on the posts page and static page is set for blog, add the Post page name
				if ( 'page' == get_option( 'show_on_front' ) ) {
					$posts_page = get_option( 'page_for_posts' );
					if ( $posts_page != '' && is_numeric( $posts_page ) ) {
						$page = get_page( $posts_page );

						$elements[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" title="' . esc_attr( get_the_title( $posts_page ) ) . '" href="' . esc_url( get_permalink( $posts_page ) ) . '">' . get_the_title( $posts_page ) . '</a></li>';
					}
				}

				// Show category name
				$cat  = get_the_category();
				$cat  = $cat[0];
				$cats = get_category_parents( $cat, true, '|zn_preg|' );

				$cats = explode( '|zn_preg|', $cats );
				foreach ( $cats as $s_cat ) {
					if ( ! empty ( $s_cat ) ) {
						$s_cat      = str_replace( '<a', '<a rel="v:url" property="v:title" ', $s_cat );
						$elements[] = '<li typeof="v:Breadcrumb">' . $s_cat . '</li>';
					}
				}
			} elseif ( 'portfolio' == $post_type ) {
				$parents = get_the_term_list( $post->ID, 'portfolio_categories', '', '|zn_preg|', '' );
				$parents = explode( '|zn_preg|', $parents );
				foreach ( $parents as $parent_item ) {
					if ( $parent_item ) {
						$elements[] = '<li typeof="v:Breadcrumb">' . $parent_item . '</li>';
					}
				}
			}

			// Show post name
			$elements[] = '<li class="active">' . get_the_title() . '</li>';

		} elseif ( is_archive() ) {


			if ( is_tax() || is_category() || is_tag() ) {

				/* Set-up the terms data. */
				$term     = $wp_query->get_queried_object();
				$taxonomy = get_taxonomy( $term->taxonomy );

				/* If the taxonomy is hierarchical, list its parent terms. */
				if ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) {
					$elements = array_merge( $elements, zn_get_term_parents( $term->parent, $term->taxonomy ) );
				}

				/* Show the term name */
				$elements[] = '<li class="active">' . $term->name . '</li>';
			} /* If viewing a post type archive. */
			elseif ( is_post_type_archive() ) {

				/* Get the post type object. */
				$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

				/* If $front has been set, add it to the $path. */
				if ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front ) {
					$path .= trailingslashit( $wp_rewrite->front );
				}

				/* If there's a slug, add it to the $path. */
				if ( ! empty( $post_type_object->rewrite['archive'] ) ) {
					$path .= $post_type_object->rewrite['archive'];
				}

				/* If there's a path, check for parents. */
				if ( ! empty( $path ) ) {
					$elements = array_merge( $elements, zn_get_parents( '', $path ) );
				}

				/* Add the post type [plural] name to the elements end. */
				$elements[] = '<li>' . $post_type_object->labels->name . '</li>';
			}


			// CUSTOM POST TYPES ARCHIVE HERE

			// TIME

			// DATE

			// AUTHOR

		} elseif ( is_search() ) {
			$elements[] = '<li class="active">' . sprintf( __( 'Search results for &quot;%1$s&quot;', 'zn_framework' ), esc_attr( get_search_query() ) ) . '</li>';

		} elseif ( is_404() ) {
			$elements[] = '<li class="active">' . __( '404 - not found', 'zn_framework' ) . '</li>';
		}

		$elements = apply_filters( 'zn_breadcrumbs_elements', $elements );

		echo $breadcrumb_start;
		foreach ( $elements as $value ) {
			echo $value;
		}
		echo $breadcrumb_end;

	}
}

if ( ! function_exists( 'zn_get_parents' ) ) {
	function zn_get_parents( $post_id ) {

		$parents = array();

		while ( $post_id ) {

			$page      = get_page( $post_id );
			$parents[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" title="' . esc_attr( get_the_title( $post_id ) ) . '" href="' . esc_url( get_permalink( $post_id ) ). '">' . get_the_title( $post_id ) . '</a></li>';
			$post_id   = $page->post_parent;
		}

		if ( ! empty( $parents ) ) {
			$parents = array_reverse( $parents );
		}

		return $parents;
	}
}

if ( ! function_exists( 'zn_get_term_parents' ) ) {
	function zn_get_term_parents( $term_id, $taxonomy ) {
		$parents = array();

		// If no post id or taxonomy was provided => return
		if ( empty( $term_id ) || empty( $taxonomy ) ) {
			return $parents;
		}

		while ( $term_id ) {
			$parent_term = get_term( $term_id, $taxonomy );
			$parents[]   = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" title="' . esc_attr( $parent_term->name ) . '" href="' . get_term_link( $parent_term ) . '">' . $parent_term->name . '</a></li>';
			$term_id     = $parent_term->parent;
		}

		return array_reverse( $parents );

	}
}


/*--------------------------------------------------------------------------------------------------
	FORMAT DATE
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'formatDate' ) ) {
	function formatDate( $time ) {
		if ( $time >= strtotime( "today 00:00" ) ) {
			return __( 'Today', 'zn_framework' ) . " - " . date_i18n( "F d, Y", $time );
		} elseif ( $time >= strtotime( "yesterday 00:00" ) ) {
			return __( 'Yesterday', 'zn_framework' ) . " - " . date_i18n( "F d, Y", $time );
		} elseif ( $time >= strtotime( "-6 day 00:00" ) ) {
			return date_i18n( "l \\a\\t g:i A", $time );
		} else {
			return date_i18n( "M j, Y", $time );
		}
	}
}

/*--------------------------------------------------------------------------------------------------
	Dynamic Sidebars Function
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_register_sidebars' ) ) {
	function zn_register_sidebars() {

		// Register the default sidebar
		register_sidebar( array(
			'name'          => 'Default Sidebar',
			'id'            => zn_sanitize_widget_id( 'Default Sidebar' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Register unlimited sidebars
		if ( $sidebars = zget_option( 'unlimited_sidebars', 'unlimited_sidebars' ) ) {

			if ( is_array( $sidebars ) ) {
				foreach ( $sidebars as $sidebar ) {
					if ( $sidebarname = $sidebar['sidebar_name'] ) {
						register_sidebar( array(
							'name'          => $sidebarname,
							'id'            => zn_sanitize_widget_id( $sidebarname ),
							'before_widget' => '<aside id="%1$s" class="widget %2$s">',
							'after_widget'  => '</aside>',
							'before_title'  => '<h3 class="widget-title">',
							'after_title'   => '</h3>',
						) );
					}
				}
			}
		}

		//Register Footer Columns
		if ( $footer_columns = zget_option( 'footer_columns', 'general_options' ) ) {
			if ( $footer_columns > 1 ) {

				$args = array(
					'name'          => 'Footer - widget %d',
					'id'            => 'znfooter',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widgettitle">',
					'after_title'   => '</h3>',
				);

				register_sidebars( $footer_columns, $args );
			} else {
				$args = array(
					'name'          => 'Footer - widget 1',
					'id'            => 'znfooter',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widgettitle">',
					'after_title'   => '</h3>',
				);
				register_sidebars( 1, $args );
			}
		}

	}
}

add_action( 'widgets_init', 'zn_register_sidebars' );


if ( ! function_exists( 'zn_get_the_meta' ) ) {
	function zn_get_the_meta() {

		global $post;

		$date   = get_the_date();
		$result = '<span class="tcolor" itemprop="datePublished updated" content="' . $date . '">' . $date . '</span>';
		$result .= zn_show_hearts( $post, false, 'zn-secondary-color' );
		$result .= '<span class="icon-bubbles4 mleft10 mright10"><span class="mleft5 zn-secondary-color">' . get_comments_number() . '</span></span>';
		$result .= '<span class="italic">' . get_the_category_list( ', ' ) . '</span>';


		if ( current_user_can( 'edit_post', $post->ID ) ) {
			$result .= ' <span class="edit-link tcolor italic"> <a href="' . get_edit_post_link() . '">' . __( ' (Edit)', 'zn_framework' ) . '</a></span>';
		}

		return $result;
	}
}

/*--------------------------------------------------------------------------------------------------
	Gallery shortcode
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_gallery' ) ) {
	function zn_gallery( $atts ) {

		extract( shortcode_atts( array(
			'order'   => 'ASC',
			'ids'     => '',
			'size'    => 'col-sm-9',
			'style'   => 'thumbnails',
			'columns' => 3,
		), $atts ) );

		$output = '';

		$attachments = get_posts( array(
				'include'        => $ids,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => 'post__in',
			)
		);

		if ( ! empty( $attachments ) && is_array( $attachments ) ) {

			global $zn_config;
			if ( ! empty( $zn_config['size'] ) ) {
				$size = $zn_config['size'];
			}

			$size = zn_get_wp_image_size( $size );

			$output .= '<div class="zn_owl_carousel owl-carousel owl-theme sideNav solidNav2" data-navigation="true">';

			foreach ( $attachments as $attachment ) {

				//$img      = wp_get_attachment_image( $attachment->ID , $size);
				$imgAttr = array( 'class' => "img-responsive animate" );

				$img = zn_get_image( $attachment->ID, $size['width'], $size['height'], $imgAttr, true );

				$output .= '<div class="item">';
				$output .= $img;
				$output .= '</div>';
			}

			$output .= '	</div>';

		}

		return $output;

	}
}
add_shortcode( 'zn_gallery', 'zn_gallery' );

/*--------------------------------------------------------------------------------------------------
	Wrap post titles based on page
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_wrap_titles' ) ) {
	function zn_wrap_titles( $title, $link = true ) {

		if ( $link ) {
			$title = is_single() ? '<h1 class="article_title">' . $title . '</h1>' : '<h2 class="article_title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $title . '</a></h2>';
		} else {
			$title = is_single() ? '<h1 class="article_title">' . $title . '</h1>' : '<h2 class="article_title">' . $title . '</h2>';
		}

		return $title;
	}
}

/*--------------------------------------------------------------------------------------------------
	Comment list callback
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_comment_list_callback' ) ) {
	function zn_comment_list_callback( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				// Display trackbacks differently than normal comments.
				?>
				<li <?php comment_class( 'clearfix mbottom30' ); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php _e( 'Pingback:', 'zn_framework' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'zn_framework' ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
			default :
				// Proceed with normal comments.
				global $post;
				?>
			<li <?php comment_class( 'clearfix' ); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment clearfix mbottom30">
					<header class="comment-meta comment-author vcard">
						<div class="fleft mright25"><?php echo get_avatar( $comment, 80 ); ?></div>
					<span>
						<span class="fn"><?php echo __( 'Posted by ', 'zn_framework' ); ?>
							<?php echo get_comment_author_link(); ?>
						</span>
						<?php echo __( ' on ', 'zn_framework' ); ?>
						<?php printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'zn_framework' ), get_comment_date(), get_comment_time() )
						); ?>
						</span>
						<span class="mleft10 mright10">|</span>
						<?php comment_reply_link( array_merge( array(
							'before' => '<span class="tcolor">',
							'after'  => '</span>'
						), array(
							'reply_text' => __( 'Reply', 'zn_framework' ),
							'depth'      => $depth,
							'max_depth'  => $args['max_depth']
						) ) ); ?>
						<span class="mleft10 mright10">|</span>
						<?php edit_comment_link( __( 'Edit', 'zn_framework' ), '', '' ); ?>
					</header>
					<!-- .comment-meta -->

					<!-- Comment awaiting moderation -->
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'zn_framework' ); ?></p>
					<?php endif; ?>
					<!-- COMMENT TEXT -->
					<section class="comment-content comment">
						<?php comment_text(); ?>
					</section>
					<!-- .comment-content -->
				</article>
				<!-- #comment-## -->
				<?php
				break;
		endswitch; // end comment_type check
	}
}


/*--------------------------------------------------------------------------------------------------
	Coming Soon Page
--------------------------------------------------------------------------------------------------*/
if ( 'yes' == zget_option( 'enable_coming_soon', 'coming_soon' ) ) {
	if ( ! function_exists( 'zn_coming_soon_redirect' ) ) {
		function zn_coming_soon_redirect() {
			if ( ! current_user_can( 'manage_options' ) ) {
				$new_template = locate_template( array( 'page-coming-soon.php' ) );
				if ( '' != $new_template ) {
					include( $new_template );
					die();
				}
			}
		}
	}
	add_filter( 'template_redirect', 'zn_coming_soon_redirect', 1 );

}

/*--------------------------------------------------------------------------------------------------
	Maintenance Mode Page
--------------------------------------------------------------------------------------------------*/
if ( 'yes' == zget_option( 'enable_maintenance_mode', 'maintenance_mode' ) ) {
	if ( ! function_exists( 'zn_maintenance_mode_redirect' ) ) {
		function zn_maintenance_mode_redirect() {
			if ( ! current_user_can( 'manage_options' ) ) {
				$new_template = locate_template( array( 'page-maintenance-mode.php' ) );
				if ( '' != $new_template ) {
					include( $new_template );
					die();
				}
			}
		}
	}
	add_filter( 'template_redirect', 'zn_maintenance_mode_redirect', 1 );

}

/*--------------------------------------------------------------------------------------------------
	TRIM CONTENT
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_trim_content' ) ) {
	function zn_trim_content( $content ) {

		$content = substr( $content, 0, 135 );

		if ( ! empty( $content ) ) {
			$content = substr( $content, 0, strrpos( $content, ' ' ) ) . " ...";
			$content .= '</br>';
			$content .= '<a class="arrowLink arrowRight" href="' . esc_url( get_permalink() ). '" title="' . get_the_title() . '">' . __( 'Continue reading', 'zn_framework' ) . '</a>';
		}

		return $content;
	}
}


// GET ARTICLE SHARE ICONS
if ( ! function_exists( 'zn_get_share_links' ) ) {
	function zn_get_share_links() {

		$icons = array();

		$url   = urlencode( esc_url( get_permalink() ) );
		$title = get_the_title();
		$desc  = get_the_excerpt();
		$img   = has_post_thumbnail() ? esc_url( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ) : '';

		$icons[] = array
		(
			'link'  => 'http://www.facebook.com/sharer.php?s=100&amp;p%5Burl%5D=' . $url . '&amp;p%5Bimages%5D%5B0%5D=' . $img . '&amp;p%5Btitle%5D=' . urlencode( $title ) . '&amp;p%5Bsummary%5D=' . urlencode( $desc ),
			'title' => 'Facebook',
			'icon'  => 'icon-facebook',
		);
		$icons[] = array
		(
			'link'  => 'https://twitter.com/share?url=' . $url . '&amp;text=' . urlencode( $title ),
			'title' => 'Twitter',
			'icon'  => 'icon-twitter',
		);
		$icons[] = array
		(
			'link'  => 'https://plus.google.com/share?url=' . $url,
			'title' => 'Google+',
			'icon'  => 'icon-googleplus2',
		);
		$icons[] = array
		(
			'link'  => 'http://www.linkedin.com/shareArticle?url=' . $url . '&amp;title=' . urlencode( $title ),
			'title' => 'Linked in',
			'icon'  => 'icon-linkedin',
		);
		$icons[] = array
		(
			'link'  => 'http://www.stumbleupon.com/submit?url=' . $url . '&amp;title=' . urlencode( $title ),
			'title' => 'StumbledUpon',
			'icon'  => 'icon-stumbleupon',
		);

		foreach ( $icons as $icon ) {
			echo '<li><a href="' . $icon['link'] . '" class="tooltip_top zn_icon ' . $icon['icon'] . '" title="' . $icon['title'] . '"></a></li>';
		}
	}
}


function zn_get_wp_image_size( $col, $ratio = false, $extra_width = 0 ) {

	switch ( $col ) {
		case 'full':
			$width  = 0 + $extra_width;
			$height = $ratio ? round( $width / $ratio ) : 0;
			break;
		case 'col-sm-12':
			$width  = 1170 + $extra_width;
			$height = $ratio ? round( $width / $ratio ) : 0;
			break;
		case 'col-sm-9':
			$width  = 870 + $extra_width;
			$height = $ratio ? round( $width / $ratio ) : 0;
			break;
		case 'col-sm-8 col-sm-offset-2':
			$width  = 770 + $extra_width;
			$height = $ratio ? round( $width / $ratio ) : 0;
			break;
		case 'col-sm-6':
			$width  = 570 + $extra_width;
			$height = $ratio ? round( $width / $ratio ) : 0;
			break;
		case 'col-sm-4':
			$width  = 370 + $extra_width;
			$height = $ratio ? round( $width / $ratio ) : 0;
			break;
		case 'col-sm-3':
			$width  = 270 + $extra_width;
			$height = $ratio ? round( $width / $ratio ) : 0;
			break;
		default:
			$width  = 0;
			$height = 0;
			break;
	}

	return array( 'width' => $width, 'height' => $height );
}


/*--------------------------------------------------------------------------------------------------
	Create Custom Post types and taxonomies - TO DO : Move this to the framework to make it more automated
--------------------------------------------------------------------------------------------------*/
// Portfolio + Portfolio Categories
add_action( 'init', 'zn_portfolio' );
add_action( 'init', 'zn_portfolio_categories' );
add_action( 'init', 'zn_portfolio_tags' );

// Add portfolio permalink options
add_filter( 'zn_allowed_post_types', 'zn_add_portfolio_slugs' );
add_filter( 'zn_allowed_taxonomies', 'zn_add_portfolio_taxonomy_slugs' );

if ( ! function_exists( 'zn_add_portfolio_slugs' ) ) {
	function zn_add_portfolio_slugs( $post_types ) {
		$post_types['portfolio'] = 'Portfolio';

		return $post_types;
	}
}

if ( ! function_exists( 'zn_add_portfolio_taxonomy_slugs' ) ) {
	function zn_add_portfolio_taxonomy_slugs( $taxonomies ) {
		$taxonomies['portfolio'][] = array(
			'id'   => 'portfolio_categories',
			'name' => 'Portfolio category',
		);
		$taxonomies['portfolio'][] = array(
			'id'   => 'portfolio_tags',
			'name' => 'Portfolio tags',
		);

		return $taxonomies;
	}
}


if ( ! function_exists( 'zn_add_portfolio_slugs' ) ) {
	function zn_add_portfolio_slugs( $post_types ) {
		$post_types['portfolio'] = 'Portfolio';
	}
}

if ( ! function_exists( 'zn_portfolio' ) ) {
	function zn_portfolio() {

		$permalinks = get_option( 'zn_permalinks' );
		$slug       = ! empty( $permalinks['portfolio'] ) ? $permalinks['portfolio'] : __( 'portfolio', 'zn_framework' );

		$args = array(
			'public'      => true,
			'label'       => __( 'Portfolio', 'zn_framework' ), //'Portfolio',
			'has_archive' => true,
			'supports'    => array( 'title', 'editor', 'thumbnail' ),
			'query_var'   => true,
			'rewrite'     => array( 'slug' => _x( $slug, 'URL slug', 'zn_framework' ), 'with_front' => true )
		);
		register_post_type( 'portfolio', $args );
	}
}

if ( ! function_exists( 'zn_portfolio_categories' ) ) {
	function zn_portfolio_categories() {

		$permalinks = get_option( 'zn_permalinks' );
		if ( ! empty( $permalinks['portfolio_categories'] ) ) {
			$slug = array( 'slug' => $permalinks['portfolio_categories'] );
		} else {
			$slug = true;
		}

		register_taxonomy(
			'portfolio_categories',
			'portfolio',
			array(
				'label'        => __( 'Portfolio category', 'zn_framework' ),
				'rewrite'      => $slug,
				'hierarchical' => true
			)
		);
	}
}

if ( ! function_exists( 'zn_portfolio_tags' ) ) {
	function zn_portfolio_tags() {

		$permalinks = get_option( 'zn_permalinks' );
		if ( ! empty( $permalinks['portfolio_tags'] ) ) {
			$slug = array( 'slug' => $permalinks['portfolio_tags'] );
		} else {
			$slug = true;
		}

		register_taxonomy(
			'portfolio_tags',
			'portfolio',
			array(
				'label'        => __( 'Portfolio tags', 'zn_framework' ),
				'rewrite'      => $slug,
				'hierarchical' => false,
			)
		);
	}
}

/*--------------------------------------------------------------------------------------------------
	Check if we are on the taxonomy archive page. We will display all items if it is selected
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_portfolio_taxonomy_pagination' ) ) {
	function zn_portfolio_taxonomy_pagination( $query ) {
		if ( is_post_type_archive( 'portfolio' ) && $query->is_main_query() ) {
			//** Set pagination items count if using pagination
			// if (zget_option( 'portfolio_pagination' , 'portfolio_options') == 'zn_portfolio_pagination') {
			//
			// }
			// else {
			$portfolio_pagination_items = zget_option( 'portfolio_pagination_items', 'portfolio_options', false, '9' );
			//}
			set_query_var( 'posts_per_page', ( int )$portfolio_pagination_items );
		}
	}
}
add_action( 'pre_get_posts', 'zn_portfolio_taxonomy_pagination' );


/*--------------------------------------------------------------------------------------------------
	Check if we are on the taxonomy archive page. We will display all items if it is selected
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_portfolio_taxonomy_pagination' ) ) {
	function zn_portfolio_taxonomy_pagination( $query ) {
		if ( is_post_type_archive( 'portfolio' ) && $query->is_main_query() ) {
			set_query_var( 'posts_per_page', '-1' );
		}
	}
}
add_action( 'pre_get_posts', 'zn_portfolio_taxonomy_pagination' );

/**
 * Add google analytics tracking code
 */
add_action( 'wp_footer', 'zn_google_analytics' );
if ( ! function_exists( 'zn_google_analytics' ) ) {
	function zn_google_analytics() {
		$tracking_id = esc_js( zget_option( 'google_analytics', 'general_options' ) );
		if ( ! empty( $tracking_id ) && strpos( $tracking_id, 'UA-' ) === 0 ) {
			echo "
				<!-- Zn Framework add google analytics -->
				<script>
				  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				  ga('create', '$tracking_id', 'auto');
				  ga('send', 'pageview');

				</script>
			";
		}
	}
}

/*--------------------------------------------------------------------------------------------------
	START HEART FUNCTIONALITY
--------------------------------------------------------------------------------------------------*/
// add_action( 'wp', 'zn_del_c');
// function zn_del_c(){
// 	setcookie('_zn_liked_'. get_queried_object_id(), $post_id, time()-3600, '/');
// }
if ( ! function_exists( 'zn_show_hearts' ) ) {
	function zn_show_hearts( $post, $echo = true, $numberClass = '', $spanClass = '' ) {

		// Hide heart system if disabled from options
		$post_type = get_post_type();
		if ( 'portfolio' == $post_type ) {
			if ( 'yes' != zget_option( 'port_use_heart', 'portfolio_options', false, 'yes' ) ) {
				return false;
			}
		}

		$class = '';
		$title = __( 'Like this', 'zn_framework' );

		if ( isset( $_COOKIE[ '_zn_liked_' . $post->ID ] ) ) {
			$class = 'inactive tcolor';
			$title = __( 'You already like this', 'zn_framework' );
		}

		$count = get_post_meta( $post->ID, '_zn_framework_likes', true );
		if ( empty( $count ) ) {
			update_post_meta( $post->ID, '_zn_framework_likes', 0, true );
			$count = 0;
		}

		$likes = '<span class="' . $spanClass . ' icon-heart2 zn_like_heart ' . $class . '" title="' . $title . '" data-post_id="' . $post->ID . '"><span class="' . $numberClass . '">' . $count . '</span></span>';

		if ( $echo ) {
			echo $likes;
		} else {
			return $likes;
		}

	}
}


/*--------------------------------------------------------------------------------------------------
	REMOVE 'Default Style' from unlimited_styles
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_unlimited_styles_filter' ) ) {
	function zn_unlimited_styles_filter( $ustyles ) {
		///if (  !empty($ustyles) ) {
		unset( $ustyles[''] );
		//}
	}
}
add_filter( 'zn_unlimited_styles', 'zn_unlimited_styles_filter' );

//LOAD CONFIG FOR WOOCOMMERCE
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require THEME_BASE . '/template_helpers/woocommerce/config.php';
}


/*--------------------------------------------------------------------------------------------------
	Button styles used as options for the pagebuilder elements. The buttons MUST already have .btn class!!!
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_get_button_styles' ) ) {
	function zn_get_button_styles() {
		return array(
			'btn-default'   => 'Style 1 (primary color)',
			'zn_btn_style2' => 'Style 2 (alternative background)',
			'zn_btn_3d'     => 'Style 3 (3D)',
			'zn_btn_simple' => 'Style 4 (simple)'
		);
	}
}

/*--------------------------------------------------------------------------------------------------
	Navigation styles used as options for the pagebuilder elements. The buttons MUST already have .btn class!!!
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_get_navigation_styles' ) ) {
	function zn_get_navigation_styles() {
		return array(
			'sideNav hollowNav'          => 'Side/Hollow 1',
			'sideNav hollowNav style2'   => 'Side/Hollow 2',
			'sideNav solidNav'           => 'Side/Solid 1',
			'sideNav solidNav2'          => 'Side/Solid 2',
			'overTop hollowNav'          => 'Top/Hollow 1',
			'overTop hollowNav style2'   => 'Top/Hollow 2',
			'overTop solidNav'           => 'Top/Solid 1',
			'overTop solidNav2'          => 'Top/Solid 2',
			'navStyle2 hollowNav'        => 'Inner/Hollow 1',
			'navStyle2 hollowNav style2' => 'Inner/Hollow 2',
			'navStyle2 solidNav'         => 'Inner/Solid 1',
			'navStyle2 solidNav2'        => 'Inner/Solid 2',
		);
	}
}
/*--------------------------------------------------------------------------------------------------
	Color styles used as options for the pagebuilder elements. The buttons MUST already have .btn class!!!
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_get_theme_color_styles' ) ) {
	function zn_get_theme_color_styles() {
		return array(
			'zn-primary-color'          => 'Primary color',
			'zn-secondary-color'        => 'Secondary color',
			'zn-alternative-color'      => 'Alternative color',
			'zn-paragraph-color'        => 'Paragraph color',
			'zn-background-color-color' => 'Background color',
			'zn-alternative-bkg-color'  => 'Alternative background color',
			'zn-border-color'           => 'Border color'
		);
	}
}


/*--------------------------------------------------------------------------------------------------
	Function to trim the text if trim size is not empty
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_trim_to_size' ) ) {
	function zn_trim_to_size( $text = '', $size = null, $ellipsis = true ) {
		if ( empty( $size ) ) {
			return $text;
		} else {
			$suffix = '';
			if ( strlen( $text ) > $size && $ellipsis ) {
				$suffix = ' [...]';
			}

			return substr( $text, 0, $size ) . $suffix;
		}
	}
}

/*--------------------------------------------------------------------------------------------------
	Add WPML languag selector
--------------------------------------------------------------------------------------------------*/
if ( function_exists('icl_disp_language') && function_exists('icl_get_languages') && zget_option( 'show_wpml_switcher' , 'general_options', false, 'yes' ) == 'yes' ) {
	add_action( 'zn_header_icons', 'zn_wpml_languages' );
}
if ( ! function_exists( 'zn_wpml_languages' ) ) {
	function zn_wpml_languages(){
	?>
	<div class="zn_language_switcher">
		<div class="zn_header_dropdown">
			<span class="globe icon-earth zn-header-icon zn_header_dropdown_trigger"></span>
			<ul class="zn_header_dropdown_holder">
			<?php

			$languages = icl_get_languages('skip_missing=0&orderby=code');
			if(!empty($languages)){
				foreach ($languages as $l ) {
					$class = '';
					if( $l['active'] ) { $class = 'zn_active_language'; }
					echo '<li>';
						echo '<a class="'.$class.'" href="'.$l['url'].'">';
							echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
							echo icl_disp_language($l['native_name'], $l['translated_name']);
						echo '</a>';
					echo '</li>';
				}
			}
			?>
			</ul>
		</div>
	</div>
	<?php
	}
}


/*--------------------------------------------------------------------------------------------------
	SHORTCODES
--------------------------------------------------------------------------------------------------*/

function theme_color_func( $atts, $content = "" ) {

	if ( isset( $atts['type'] ) ) {
		switch ( strtolower( $atts['type'] ) ) {
			case "primary":
				$type = "zn-primary-color";
				break;
			case "secondary":
				$type = "zn-secondary-color";
				break;
			case "alternative":
				$type = "zn-alternative-color";
				break;
			case "background":
				$type = "zn-background-color-color";
				break;
			case "altbackground":
				$type = "zn-alternative-bkg-color";
				break;
			case "paragraph":
				$type = "zn-paragraph-color";
				break;
			case "border":
				$type = "zn-border-color";
				break;
			default:
				$type = "zn-no-such-color";
				break;
		}
	} else {
		$type = "zn-primary-color";
	}

	return "<span class='$type'>".do_shortcode($content)."</span>";
}

add_shortcode( 'theme_color', 'theme_color_func' );

function theme_bgcolor_func( $atts, $content = "" ) {
echo $atts['type'];
	if ( isset( $atts['type'] ) ) {
		switch ( strtolower( $atts['type'] ) ) {
			case "primary":
				$type = "zn-primary-as-bg";
				break;
			case "secondary":
				$type = "zn-secondary-color-bg";
				break;
			case "alternative":
				$type = "zn-alternative-color-bg";
				break;
			case "background":
				$type = "zn-background-color";
				break;
			case "altbackground":
				$type = "zn-alternative-bkg";
				break;
			case "paragraph":
				$type = "zn-paragraph-color-bg";
				break;
			case "border":
				$type = "zn-border-color-bg";
				break;
			default:
				$type = "zn-no-such-bgcolor";
				break;
		}
	} else {
		$type = "zn-primary-as-bg";
	}

	return "<span class='$type'>$content</span>";
}

add_shortcode( 'theme_bgcolor', 'theme_bgcolor_func' );

function theme_button_func( $atts, $content = "" ) {

	$defaults = array(
		'title'  => '',
		'target' => '_blank',
		'url'    => '',
		'type'   => 'btn-default',
	);

	extract( wp_parse_args( $atts, $defaults ) );

	//** Button type
	switch ( strtolower( $type ) ) {
		case "default":
			$type = "btn-default";
			break;
		case "style2":
			$type = "zn_btn_style2";
			break;
		case "3d":
			$type = "zn_btn_3d";
			break;
		case "simple":
			$type = "zn_btn_simple";
			break;
		default:
			$type = "btn-default";
			break;
	}

	$url = esc_url( $url );
	$title = esc_attr( $title );
	$target = esc_attr( $target );
	$content = $content;

	return "<a class='btn $type' href='$url' title='$title' target='$target'>$content</a>";
}

add_shortcode( 'button', 'theme_button_func' );

function theme_quote_shortcode_func( $atts, $content = '' ) {

	$defaults = array(
		'type' => 'qleft',
	);
	extract( wp_parse_args( $atts, $defaults ) );

	switch ( strtolower( $type ) ) {
		case 'left' :
			$type = 'qleft';
			break;
		case 'right' :
			$type = 'qright';
			break;
		default:
			$type = 'qleft';
			break;
	}

	$content = $content;

	return "<blockquote class='$type'>$content</blockquote>";
}

add_shortcode( 'quote', 'theme_quote_shortcode_func' );


function theme_icon_shortcode_func( $atts ) {

	$defaults = array(
		'iconfam' => 'icomoon',
		'code' => '',
		'size' => '25'
	);
	extract( wp_parse_args( $atts, $defaults ) );

	if (!empty($code)) {

		$size = (int)$size;
		$iconfam = $iconfam;
		$code = $code;

		return "<span style='font-size:{$size}px;' data-zniconfam='$iconfam' data-zn_icon='$code'></span>";
	}

	return "";
}

add_shortcode( 'zn_icon', 'theme_icon_shortcode_func' );

/*--------------------------------------------------------------------------------------------------
	END SHORTCODES
--------------------------------------------------------------------------------------------------*/

/** Add pb content to search */
/**
 * Updates the search query to include the Page Builder elements
 *
 * @param $query
 * @return mixed
 */
function znpb_updateSearchQuery($query){
	$canSearch = ( ! is_admin() && $query->is_main_query() && is_search() && !empty($query));
	if($canSearch){
		// So we can include the post meta table
		$query->set( 'meta_query', array(
			'relation' => 'OR',
			array(
				'key'     => 'zn_page_builder_els',
				'value'	=> 'avaluethatshouldntexist',
				'compare' => 'NOT EXISTS',
			),
		) );
		add_filter( 'posts_where', 'zn_pbupdateSearchWhere', 99 , 1);
	}
	return $query;
}

/**
 * Include the custom search query in the WHERE clause.
 *
 * @see: WpkZn::updateSearchQuery()
 *
 * @param string $where
 * @return string
 */
function zn_pbupdateSearchWhere($where = ''){
	global $wpdb;

	$where .= " OR ( $wpdb->postmeta.meta_key = 'zn_page_builder_els' AND CAST($wpdb->postmeta.meta_value AS CHAR) LIKE '%".get_search_query()."%') ";

	remove_filter( 'posts_where', 'zn_pbupdateSearchWhere', 99 );

	return $where;
}
add_filter('pre_get_posts', 'znpb_updateSearchQuery');

?>
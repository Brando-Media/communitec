<?php

class ZnMegaMenu{

	var $fields = array(
		'menu_item_zn_mega_menu_enable',
		'menu_item_zn_mega_menu_headers',
		'menu_item_zn_mega_menu_label'
		);

	function __construct(){


		// ADD THE MEGA MENU WALKER AND CLASSES
		add_filter( 'wp_nav_menu_args', array(&$this,'enable_custom_walker'), 100);

		// ADD THE BACKEND WALKER
		add_filter( 'wp_edit_nav_menu_walker', array(&$this,'modify_backend_walker') , 100);

		// SAVE CUSTOM OPTIONS
		add_action( 'wp_update_nav_menu_item', array(&$this,'update_menu'), 100, 3);

	}

	/**
	 * Replaces the default arguments for the front end menu creation with new ones
	 */
	function enable_custom_walker( $arguments ) {

		if ( $arguments['walker'] == 'znmegamenu' )
		{
			$arguments['walker'] 				= new ZnWalkerNavMenu();
			$arguments['container_class'] 		= $arguments['container_class'] .= ' zn_mega_wrapper ';
			$arguments['menu_class']			= $arguments['menu_class'] .= ' zn_mega_menu ';
		}

		return $arguments;
	}

	/*
	 * SAVE / UPDATE CUSTOM OPTIONS
	 * @param int $menu_id
	 * @param int $menu_item_db
	 */
	function update_menu( $menu_id, $menu_item_db )
	{

		foreach ( $this->fields as $key )
		{
			if(!isset($_REQUEST[$key][$menu_item_db]))
			{
				$_REQUEST[$key][$menu_item_db] = "";
			}

			$value = $_REQUEST[$key][$menu_item_db];
			update_post_meta( $menu_item_db, '_'.$key , $value );
		}
	}

	function modify_backend_walker( $walker ){
		return 'ZnBackendWalker';
	}

}

/**
 * Create HTML list of nav menu items. ( COPIED FROM DEFAULT WALKER )
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker
 */
class ZnWalkerNavMenu extends Walker {
	/**
	 * What the class handles.
	 *
	 * @see Walker::$tree_type
	 * @since 3.0.0
	 * @var string
	 */
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	/**
	 * Database fields to use.
	 *
	 * @see Walker::$db_fields
	 * @since 3.0.0
	 * @todo Decouple this.
	 * @var array
	 */
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	var $mm_active = false;
	var $max_columns = 4;
	var $columns = 0;
	var $childrens_count = 0;

	function __construct(){
		$this->max_columns = apply_filters( 'zn_mega_menu_columns', 4 );
	}


	/**
	 * Perform several checks and fill the class values
	 *
	 * @param string $element The current menu item
	 * @param int    $children_elements  The element childrens
	 * @param array  $max_depth
	 * @param array  $depth
	 * @param array  $args
	 * @param array  $output
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if( $depth === 0 )
		{
			// CHECK IF MENU IS ACTIVE
			$this->mm_active = get_post_meta( $element->ID, '_menu_item_zn_mega_menu_enable', true);

			// COUNT ALL MEGA MENU CHILDRENS
			if ( $this->mm_active && !empty( $children_elements[$element->ID] ) ) {

				$this->childrens_count = count( $children_elements[$element->ID] );

			}
		}

		// DO THE NORMAL display_element();
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);

		// ADD THE MEGA MENU WRAPPER
		if ( $depth === 0 && $this->mm_active )
		{
			$output .= "\n$indent<div class='zn_mega_container container'><ul class=\"clearfix\">\n";

		}
		else {
			if( $this->mm_active ){
				$output .= "\n$indent<ul class=\"clearfix\">\n";
			}
			else{
				$output .= "\n$indent<ul class=\"sub-menu clearfix\">\n";
			}

		}

	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";

		if ( $depth === 0 ) {
			if ( $this->mm_active )
			{
				// RESET THE COUNTERS
				$output .= "</div>";
				$this->columns = 0;
			}
		}
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = $column_class = '';

		// ONLY CHECK ON LEVEL 1 SUBMENUS
		if ( $depth == 1 && $this->mm_active ) {

			$this->columns++;

			if ( $this->childrens_count > $this->max_columns )
			{
				// CHECK IF WE HAVE MORE COLUMNS THAN THE MAX COLUMNS
				if ( $this->columns > $this->max_columns )
				{

					$output .= "\n</ul><ul class=\"zn_mega_row_start\">\n";

					if ( $this->childrens_count - $this->max_columns < $this->childrens_count )
					{

						$column_class = zn_get_col_size( $this->max_columns );
					}
					else
					{
						$column_class = zn_get_col_size( $this->childrens_count - $this->max_columns );
					}
					$this->columns = 1;
				}
				else
				{
					$column_class = zn_get_col_size(  $this->max_columns );
				}
			}
			else
			{
				$column_class = zn_get_col_size(  $this->childrens_count );
			}
		}


		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Added mega menu class to parent li
		if ( $depth === 0 && $this->mm_active ){
			$classes[] = 'menu-item-mega-parent';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . ' ' .$column_class . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		// STYLE THE SUBMENU TITLES
		if ( $depth == 1 && $this->mm_active )
		{
			$atts['class']   = ' zn_mega_title ';
		}

		if ( $depth == 1 && $this->mm_active && get_post_meta( $item->ID, '_menu_item_zn_mega_menu_headers', true) )
		{
			$atts['class']   .= ' zn_mega_title_hide ';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		// SHOW BADGE
		// LABEL
		$key = 'menu_item_zn_mega_menu_label';
		$badge_text = get_post_meta( $item->ID, '_'.$key, true);

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= !empty($badge_text) ? '<span class="zn-mega-new-item">'.$badge_text.'</span>' : '';
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes $args->before, the opening <a>,
		 * the menu item's title, the closing </a>, and $args->after. Currently, there is
		 * no filter for modifying the opening and closing <li> for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of arguments. @see wp_nav_menu()
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

} // Walker_Nav_Menu


/**
 * Create HTML list of nav menu input items. ( COPIED FROM DEFAULT WALKER )
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class ZnBackendWalker extends Walker_Nav_Menu {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker_Nav_Menu::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker_Nav_Menu::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 * @param int    $id     Not used.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = get_the_title( $original_object->ID );
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( __( '%s (Invalid)', 'zn_framework' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __('%s (Pending)', 'zn_framework'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		?>
		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item', 'zn_framework' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'zn_framework'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'zn_framework'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item', 'zn_framework'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php _e( 'Edit Menu Item', 'zn_framework' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo $item_id; ?>">
							<?php _e( 'URL', 'zn_framework' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
<!-- MODIFIED BY ZN FRAMEWORK -->
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<?php _e( 'Navigation Label', 'zn_framework' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
<!-- END MODIFIED BY ZN FRAMEWORK -->
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php _e( 'Title Attribute', 'zn_framework' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
<!--
	ADDED BY ZN FRAMEWORK
	ADDED A CHECKBOX FOR SELECTING A MEGAMENU
	ADDED A CHECKBOX FOR HIDING THE MEGAMENU TITLES
-->
				<?php
					// LABEL
					$key = 'menu_item_zn_mega_menu_label';
					$value = get_post_meta( $item->ID, '_'.$key, true);
				?>
				<p class="field-mega-menu-badge description description-wide">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php _e( 'Label' , 'zn_framework' ); ?><br />
						<input type="text" id="edit-menu-item-attr-label-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-label" name="<?php echo $key; ?>[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $value ); ?>" />
					</label>
				</p>
<!-- END MODIFIED BY ZN FRAMEWORK -->


				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php _e( 'Open link in a new window/tab', 'zn_framework' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
						<?php _e( 'CSS Classes (optional)', 'zn_framework' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
						<?php _e( 'Link Relationship (XFN)', 'zn_framework' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php _e( 'Description', 'zn_framework' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'zn_framework' ); ?></span>
					</label>
				</p>

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php _e( 'Move', 'zn_framework' ); ?></span>
						<a href="#" class="menus-move-up"><?php _e( 'Up one', 'zn_framework' ); ?></a>
						<a href="#" class="menus-move-down"><?php _e( 'Down one', 'zn_framework' ); ?></a>
						<a href="#" class="menus-move-left"></a>
						<a href="#" class="menus-move-right"></a>
						<a href="#" class="menus-move-top"><?php _e( 'To the top', 'zn_framework' ); ?></a>
					</label>
				</p>
<!--
	ADDED BY ZN FRAMEWORK
	ADDED A CHECKBOX FOR SELECTING A MEGAMENU
	ADDED A CHECKBOX FOR HIDING THE MEGAMENU TITLES
-->
				<?php
					// USE AS MEGAMENU
					$title = __( 'Use as Mega Menu ?' , 'zn_framework' );
					$key = 'menu_item_zn_mega_menu_enable';
					$value = get_post_meta( $item->ID, '_'.$key, true);

					if($value != "") $value = "checked='checked'";
				?>
				<p class="field-enable-mega-menu description description-wide">
					<label for="enable-mega-menu-<?php echo $item_id; ?>">
						<input id="enable-mega-menu-<?php echo $item_id; ?>" type="checkbox" class="menu-item-checkbox" <?php echo $value; ?> name="<?php echo $key; ?>[<?php echo $item_id; ?>]">
						<?php echo $title; ?>
					</label>
				</p>

				<?php
					$title = __( 'Hide menu header' , 'zn_framework' );
					$key = 'menu_item_zn_mega_menu_headers';
					$value = get_post_meta( $item->ID, '_'.$key, true);

					if($value != "") $value = "checked='checked'";
				?>
				<p class="field-enable-mega-menu-headers description description-wide">
					<label for="enable-mega-menu-headers-<?php echo $item_id; ?>">
						<input id="enable-mega-menu-headers-<?php echo $item_id; ?>" type="checkbox" class="menu-item-checkbox" <?php echo $value; ?> name="<?php echo $key; ?>[<?php echo $item_id; ?>]">
						<?php echo $title; ?>
					</label>
				</p>
<!-- END ADDED BY ZN FRAMEWORK -->

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( __('Original: %s', 'zn_framework'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php _e( 'Remove', 'zn_framework' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel', 'zn_framework' ); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}

} // Walker_Nav_Menu_Edit



?>
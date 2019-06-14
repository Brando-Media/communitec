<?php
/*
	Name: Sitemap
	Description: This element will generate an icon box
	Class: ZnSiteMap
	Category: content
	Level: 3
	Style: true
	
*/

class ZnSiteMap extends ZnElements {

	function options() {
		global $zn_framework;

		$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		$menus_array = array('' => 'Please select a menu');

		foreach ($menus as $menu) {
			$menus_array[$menu->term_id] = $menu->name;
		}


		$options = array(
			array(
				'id'          => 'menu',
				'name'        => 'Menu',
				'description' => 'Here you need to create a menu from which the sitemap will be created',
				'type'        => 'select',
				'options'	  => $menus_array
			)
		);

		return $options;

	}


	function element() {

		//$style = $this->opt('style')  ? $this->opt('style') : '';
		$saved_menu = $this->opt('menu','');

		if( empty( $saved_menu ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options and select a menu.</div>';
			return;
		}

		echo '<div class="zn_sitemap '.$this->data['uid'].'">';
			wp_nav_menu( array( 'menu' => $saved_menu, 'container_class' => 'widget_nav_menu' ) );
		echo '</div>';

	}

}

?>
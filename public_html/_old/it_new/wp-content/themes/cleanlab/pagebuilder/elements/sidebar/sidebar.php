<?php
/*
	Name: Sidebar
	Description: This element will add a sidebar into your page
	Class: ZnSidebar
	Category: content
	Level: 3
*/

	class ZnSidebar extends ZnElements {

	function options() {
		global $zn_framework;
		
		$sidebars = array(
		'default_sidebar' => 'Default Sidebar'
		);

		// Add the unlimited sidebars
		$unlimited_sidebars_op = zget_option( 'unlimited_sidebars' , 'unlimited_sidebars' );
		if ( is_array( $unlimited_sidebars_op ) ) {
			foreach ($unlimited_sidebars_op as $key => $value) {
				$sidebars[zn_sanitize_widget_id($value['sidebar_name'])] = $value['sidebar_name'];
			}
		}
	
		$options = array(
				array(
					'id'          => 'sidebar',
					'name'        => 'Select sidebar',
					'description' => 'Select which sidebar you wish to use',
					'type'        => 'select',
					'std'		  => 'default_sidebar',
					'options'     => $sidebars
				)
			);

		return $options;

	}

	function element() {
	?>

		<aside class="zn_sidebar <?php echo $this->data['uid']; ?>">
			<?php dynamic_sidebar( $this->opt( 'sidebar', 'default_sidebar' ) ); ?>
		</asid>
	<?php
	}
	
	function element_edit() {

		echo '<div class="zn-pb-notification">This element will be rendered only in View Page Mode and not in PageBuilder Edit Mode.</div>';

	}

}

?>
<?php
add_action('widgets_init', 'zn_social_copyright_widget');

function zn_social_copyright_widget()
{
	register_widget('ZnSocialCopyright');
}

class ZnSocialCopyright extends WP_Widget {

	var $options;

	function __construct() {

		$widget_ops = array('classname' => 'widget-social-copyright', 'description' => __( "Social Copyright.", 'zn_framework') );
		parent::__construct('themefuzz-social-copyright', __('ThemeFuzz : Social Copyright', 'zn_framework'), $widget_ops);
		$this->alt_option_name = 'widget_themefuzz_social_copyright';
		
		$this->options = array(
				array(
					'id'         	=> 'logo',
					'name'       	=> 'Logo',
					'description' 	=> 'Using this option you can add the logo that will appear on top of the widget.',
					'type'        	=> 'media',
					'class'			=> 'zn_full'
				),
				array(
					'id'         	=> 'description',
					'name'       	=> 'Description',
					'description' 	=> 'Using this option you can add a description that will appear bellow the logo.',
					'type'        	=> 'textarea',
					'std'			=> '&copy; 2014 - 2015 developed by <strong>ThemeFuzz</strong>. All Rights Reserved',
					'class'			=> 'zn_full'
				),
				array(
					'id'         	=> 'icon_list',
					'name'       	=> 'Icon List',
					'description' 	=> 'Here you can add a list of links, each with its own icon',
					'type'        	=> 'group',
					'sortable'	  	=> true,
					'element_title' => 'Icon',
					'subelements'	=> array(
							array(
								'id'			=> 'icon',
								'name'			=> 'Icon',
								'description'	=> 'Select an icon to display',
								'type'			=> 'icon_list',
								'class'			=> 'zn_full',
							),
							array (
								'id'			=> 'social_link',
								'name'			=> 'Button link',
								'description'	=> 'Enter a link for this element',
								'type'			=> 'link'
							)
						)
				)
			 );
		
	}

	function widget($args, $instance) 
	{
	
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? esc_attr($instance['title']) : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $before_widget; 
		if ( $title ) echo $before_title . $title . $after_title; 
		
		// print_z($instance);
		// print_z($args);

		if ( !empty( $instance['logo'] ) ){
			echo '<a href="'.home_url('/').'"><img src="'.$instance['logo'].'" class="img-responsive" alt="'.get_bloginfo('name').'" title="'.get_bloginfo('description').'"></a>';
		}

		if ( !empty( $instance['description'] ) ) {
			echo '<p class="copyright">'. $instance['description'] .'</p>';
		}

		if ( !empty( $instance['icon_list'] ) ) {
			echo '<div class="social mtop25 mbottom30 clearfix">';
				echo '<ul class="reset-list">';
				$i = 0;
				foreach ( $instance['icon_list'] as $listItem ) {
					$icon_opt		= !empty( $listItem['icon'] ) ? $listItem['icon'] : '';
					$icon			= !empty( $icon_opt['family'] )  ? '<span class="zn_icon_box_icon" '.zn_generate_icon( $icon_opt ).'></span>' : '';
					$link_extracted = !empty( $listItem['social_link'] ) ? zn_extract_link( $listItem['social_link'] , '' ) : '';
					if (!empty($listItem['social_link']['url'])) {
						echo '<li class="animation zn_hb_icon_'.$i++.'">' . $link_extracted['start'] . $icon . $link_extracted['end'].'</li>';
					}
				}
				echo '</ul>';
			echo '</div>';
		}

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
	
		$instance = $old_instance;

		foreach( $this->options as $option ){
			$instance[$option['id']] = $new_instance[$option['id']];
			
		} 
	
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}


	function form( $instance ) {

		global $zn_framework;
		//print_z($instance);

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'zn_framework' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>


<?php

		foreach( $this->options as $option ){
			if( !empty( $instance[  $option['id'] ] ) ) {
				$option['std'] = $instance[  $option['id'] ];
			}
	
			$option['id'] = $this->get_field_name( $option['id'] );
	
			echo $zn_framework->html()->zn_render_single_option($option);
	
		}

	}
}
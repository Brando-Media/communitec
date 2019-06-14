<?php
add_action('widgets_init', 'zn_img_banner_ad_widget');

function zn_img_banner_ad_widget()
{
	register_widget('ZnImgBannerAdWidget');
}

class ZnImgBannerAdWidget extends WP_Widget {

	var $options;

	function __construct() {

		$widget_ops = array('classname' => 'widget-imgbanner-ad zn-alternative-bkg zn-paragraph-color', 'description' => __( "Img/Banner Ad.", 'zn_framework') );
		parent::__construct('themefuzz-imgbanner-ad', __('ThemeFuzz : Img/Banner Ad', 'zn_framework'), $widget_ops);
		$this->alt_option_name = 'widget_themefuzz_imgbanner_ad';
		
		$this->options = array(
				array(
					'id'         	=> 'image_list',
					'name'       	=> 'Img/Banner List',
					'description' 	=> 'Here you can add a list of img/banner ads. Note that the full size of the images will be used, so please provide images with appropriate size.',
					'type'        	=> 'group',
					'sortable'	  	=> true,
					'element_title' => 'Img/Banner',
					'subelements' 	=> array(
											array(
							                    'id'          => 'image',
							                    'name'        => 'Img/Banner',
							                    'description' => 'Select the desired image',
							                    'type'        => 'media',
												'supports'    => 'id',
							                    'class'		  => 'zn_full'
						                    ),
						                    array(
							                    'id'          => 'link',
							                    'name'        => 'Click destination',
							                    'description' => 'Enter a destination for this ad',
							                    'type'        => 'link'
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
		
		echo '<div class="zn-img-ad-widget">';
        if (!empty($instance['image_list']))
        {
		    foreach ( $instance['image_list'] as $listItem ) {
				$image_src = wp_get_attachment_image( $listItem['image'], 'full', false, array( 'class' => 'img-responsive ad-img' ) );
				$link = zn_extract_link( $listItem['link'] , ' ad ' );
				
				echo $link['start'] . $image_src . $link['end'];
		    }
        }
        echo '</div>';
        
        
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
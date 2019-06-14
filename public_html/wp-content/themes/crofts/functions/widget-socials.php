<?php
/*
	Plugin Name: Socials Widget
	Description: Plugin is used for socials.
	Author:
	Version: 1.0
	Author URI:  
*/

class pego_socials_widget extends WP_Widget {
/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function pego_socials_Widget() {

	$widget_options = array(
		'classname' => 'pego_socials_widget',
		'description' => __('Custom socials widget.','crofts'));

	$control_options = array(   
		'width' => 200,
		'height' => 400,
		'id_base' => 'pego_socials_widget'
	);

	$this->WP_Widget( 'pego_socials_widget', __('Pego - Socials Widget','crofts'), $widget_options, $control_options );
	
}
function widget( $args, $instance ) {
	
	extract( $args );
	$title = apply_filters('widget_title', $instance['title'] );
 	$icon_1_url = ( $instance['icon_1_url'] ) ? $instance['icon_1_url'] : '';
    $icon_2_url = ( $instance['icon_2_url'] ) ? $instance['icon_2_url'] : '';
    $icon_3_url = ( $instance['icon_3_url'] ) ? $instance['icon_3_url'] : '';
    $icon_4_url = ( $instance['icon_4_url'] ) ? $instance['icon_4_url'] : '';
    $icon_5_url = ( $instance['icon_5_url'] ) ? $instance['icon_5_url'] : '';
    $icon_6_url = ( $instance['icon_6_url'] ) ? $instance['icon_6_url'] : '';
    $icon_7_url = ( $instance['icon_7_url'] ) ? $instance['icon_7_url'] : '';
 	$icon_8_url = ( $instance['icon_8_url'] ) ? $instance['icon_8_url'] : '';
        
    $icon_1_path = ( $instance['icon_1_path'] ) ? $instance['icon_1_path'] : '';
    $icon_2_path = ( $instance['icon_2_path'] ) ? $instance['icon_2_path'] : '';
    $icon_3_path = ( $instance['icon_3_path'] ) ? $instance['icon_3_path'] : '';
    $icon_4_path = ( $instance['icon_4_path'] ) ? $instance['icon_4_path'] : '';
    $icon_5_path = ( $instance['icon_5_path'] ) ? $instance['icon_5_path'] : '';
    $icon_6_path = ( $instance['icon_6_path'] ) ? $instance['icon_6_path'] : '';
    $icon_7_path = ( $instance['icon_7_path'] ) ? $instance['icon_7_path'] : '';
    $icon_8_path = ( $instance['icon_8_path'] ) ? $instance['icon_8_path'] : '';
    
    
   $values = array('facebook', 'twitter', 'googleplus', 'instagram', 'linkedin', 'dribbble', 'mail', 'dropbox');
    
   $values_icons_code = array('facebook', 'twitter', 'gplus', 'instagram', 'linkedin', 'dribbble', 'mail', 'dropbox');
    
   $values_icon_title = array('Facebook', 'Twitter', 'Google Plus', 'Instagram', 'LinkedIn', 'Dribbble', 'Mail', 'Dropbox');
    
	
	echo $before_widget;	
	if ( $title )
	{
		echo $before_title;
		echo esc_html($title);
		echo $after_title;
	}
	
	?>
	<ul class="tt-wrapper">
	<?php	
	
	         $i = 0;
            for ($i = 1 ; $i <= 8 ; $i++)
            {
                $icon_url = "icon_".$i."_url";
                $icon_path = "icon_".$i."_path";
                if ($$icon_path != '') {
                	 $key = array_search($$icon_path, $values); 
					if ($values_icons_code[$key] == 'envelope') {
					?>
					<li><a class="social-widget-icon icon-<?php echo esc_attr($values_icons_code[$key]); ?>" href="mailto:<?php echo $$icon_url; ?>"><span><?php echo esc_html($values_icon_title[$key]); ?></span></a></li>
					<?php
					} else {
					?>
						<li><a class="social-widget-icon icon-<?php echo esc_attr($values_icons_code[$key]); ?>" href="<?php echo esc_url($$icon_url); ?>"><span><?php echo esc_html($values_icon_title[$key]); ?></span></a></li>
					<?php
					}
                }
                 
            }
	?>
	</ul>
	<?php
	
	
	echo $after_widget;	
}
function form( $instance ) {  

		/* Set default values. */
		$defaults = array(
		'title' => __('Socials Widget','crofts')
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$values = array('facebook', 'twitter', 'googleplus', 'instagram', 'linkedin', 'dribbble', 'mail', 'dropbox');
		
		if (!isset($instance['icon_1_url'])) $instance['icon_1_url'] = "";
        if (!isset($instance['icon_1_path'])) $instance['icon_1_path'] = ""; 
        if (!isset($instance['icon_2_url'])) $instance['icon_2_url'] = "";
        if (!isset($instance['icon_2_path'])) $instance['icon_2_path'] = "";
        if (!isset($instance['icon_3_url'])) $instance['icon_3_url'] = "";
        if (!isset($instance['icon_3_path'])) $instance['icon_3_path'] = "";
        if (!isset($instance['icon_4_url'])) $instance['icon_4_url'] = "";
        if (!isset($instance['icon_4_path'])) $instance['icon_4_path'] = "";
        if (!isset($instance['icon_5_url'])) $instance['icon_5_url'] = "";
        if (!isset($instance['icon_5_path'])) $instance['icon_5_path'] = "";
        if (!isset($instance['icon_6_url'])) $instance['icon_6_url'] = "";
        if (!isset($instance['icon_6_path'])) $instance['icon_6_path'] = "";
        if (!isset($instance['icon_7_url'])) $instance['icon_7_url'] = "";
        if (!isset($instance['icon_7_path'])) $instance['icon_7_path'] = "";
        if (!isset($instance['icon_8_url'])) $instance['icon_8_url'] = "";
        if (!isset($instance['icon_8_path'])) $instance['icon_8_path'] = "";
		
	 ?>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">
		<?php _e('Title:','crofts'); ?>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" 
				 name="<?php echo $this->get_field_name( 'title' ); ?>" 
				 value="<?php echo $instance['title']; ?>" />
		</label>
		
	
      
		
		<label for="<?php echo $this->get_field_id('icon_1_url'); ?>">
		URL #1: 
		<input id="<?php echo $this->get_field_id('icon_1_url'); ?>"
				name="<?php echo $this->get_field_name('icon_1_url'); ?>"
				value="<?php echo esc_attr( $instance['icon_1_url'] ); ?>"
                class="widefat"/>
		</label>
      
        <label for="<?php echo $this->get_field_id('icon_1_path'); ?>">
        Icon #1:
          <select name="<?php echo $this->get_field_name('icon_1_path'); ?>" 
                  id="<?php echo $this->get_field_id('icon_1_path'); ?>"
                class="widefat">
                <option value="">Select Icon</option>
          <?php 
            foreach ($values as $value)
              {     
              ?>
                <option <?php if ($instance['icon_1_path'] == $value) echo 'selected="selected"' ?>   value="<?php echo $value; ?>"><?php echo $value; ?></option>
              <?php
              }
              ?>
          </select> 
        </label>
        
        
 		<label for="<?php echo $this->get_field_id('icon_2_url'); ?>">
        URL #2: 
        <input id="<?php echo $this->get_field_id('icon_2_url'); ?>"
                name="<?php echo $this->get_field_name('icon_2_url'); ?>"
                value="<?php echo esc_attr( $instance['icon_2_url'] ); ?>"
                class="widefat"/>
        </label>
      
        
     
        <label for="<?php echo $this->get_field_id('icon_2_path'); ?>">
        Icon #2:
          <select name="<?php echo $this->get_field_name('icon_2_path'); ?>" 
                  id="<?php echo $this->get_field_id('icon_2_path'); ?>"
                class="widefat">
                <option value="">Select Icon</option>
          <?php 
            foreach ($values as $value)
              {     
              ?>
                <option <?php if ($instance['icon_2_path'] == $value) echo 'selected="selected"' ?>   value="<?php echo $value; ?>"><?php echo $value; ?></option>
              <?php
              }
              ?>
          </select> 
        </label>
        
        
                <label for="<?php echo $this->get_field_id('icon_3_url'); ?>">
        URL #3: 
        <input id="<?php echo $this->get_field_id('icon_3_url'); ?>"
                name="<?php echo $this->get_field_name('icon_3_url'); ?>"
                value="<?php echo esc_attr( $instance['icon_3_url'] ); ?>"
                class="widefat"/>
        </label>
        
        
        
        <label for="<?php echo $this->get_field_id('icon_3_path'); ?>">
        Icon #3:
          <select name="<?php echo $this->get_field_name('icon_3_path'); ?>" 
                  id="<?php echo $this->get_field_id('icon_3_path'); ?>"
                class="widefat">
                <option value="">Select Icon</option>
        <?php 
            foreach ($values as $value)
              {     
              ?>
                <option <?php if ($instance['icon_3_path'] == $value) echo 'selected="selected"' ?>   value="<?php echo $value; ?>"><?php echo $value; ?></option>
              <?php
              }
              ?>
          </select> 
        </label>
        
        
        
        <label for="<?php echo $this->get_field_id('icon_4_url'); ?>">
        URL #4: 
        <input id="<?php echo $this->get_field_id('icon_4_url'); ?>"
                name="<?php echo $this->get_field_name('icon_4_url'); ?>"
                value="<?php echo esc_attr( $instance['icon_4_url'] ); ?>"
                class="widefat"/>
        </label>
        
        
        
        <label for="<?php echo $this->get_field_id('icon_4_path'); ?>">
        Icon #4:
          <select name="<?php echo $this->get_field_name('icon_4_path'); ?>" 
                  id="<?php echo $this->get_field_id('icon_4_path'); ?>"
                class="widefat">
                <option value="">Select Icon</option>
        <?php 
            foreach ($values as $value)
              {     
              ?>
                <option <?php if ($instance['icon_4_path'] == $value) echo 'selected="selected"' ?>   value="<?php echo $value; ?>"><?php echo $value; ?></option>
              <?php
              }
              ?>
          </select> 
        </label>
        
        
        
        <label for="<?php echo $this->get_field_id('icon_5_url'); ?>">
        URL #5: 
        <input id="<?php echo $this->get_field_id('icon_5_url'); ?>"
                name="<?php echo $this->get_field_name('icon_5_url'); ?>"
                value="<?php echo esc_attr( $instance['icon_5_url'] ); ?>"
                class="widefat"/>
        </label>
        
        
        
        <label for="<?php echo $this->get_field_id('icon_5_path'); ?>">
        Icon #5:
          <select name="<?php echo $this->get_field_name('icon_5_path'); ?>" 
                  id="<?php echo $this->get_field_id('icon_5_path'); ?>"
                class="widefat">
                <option value="">Select Icon</option>
        <?php 
            foreach ($values as $value)
              {     
              ?>
                <option <?php if ($instance['icon_5_path'] == $value) echo 'selected="selected"' ?>   value="<?php echo $value; ?>"><?php echo $value; ?></option>
              <?php
              }
              ?>
          </select> 
        </label>
        
        
        
        <label for="<?php echo $this->get_field_id('icon_6_url'); ?>">
        URL #6: 
        <input id="<?php echo $this->get_field_id('icon_6_url'); ?>"
                name="<?php echo $this->get_field_name('icon_6_url'); ?>"
                value="<?php echo esc_attr( $instance['icon_6_url'] ); ?>"
                class="widefat"/>
        </label>
        
        
        
        <label for="<?php echo $this->get_field_id('icon_6_path'); ?>">
        Icon #6:
          <select name="<?php echo $this->get_field_name('icon_6_path'); ?>" 
                  id="<?php echo $this->get_field_id('icon_6_path'); ?>"
                class="widefat">
                <option value="">Select Icon</option>
        <?php 
            foreach ($values as $value)
              {     
              ?>
                <option <?php if ($instance['icon_6_path'] == $value) echo 'selected="selected"' ?>   value="<?php echo $value; ?>"><?php echo $value; ?></option>
              <?php
              }
              ?>
          </select> 
        </label>
        
        
        
        <label for="<?php echo $this->get_field_id('icon_7_url'); ?>">
        URL #7: 
        <input id="<?php echo $this->get_field_id('icon_7_url'); ?>"
                name="<?php echo $this->get_field_name('icon_7_url'); ?>"
                value="<?php echo esc_attr( $instance['icon_7_url'] ); ?>"
                class="widefat"/>
        </label>
        
        
        
        <label for="<?php echo $this->get_field_id('icon_7_path'); ?>">
        Icon #7:
          <select name="<?php echo $this->get_field_name('icon_7_path'); ?>" 
                  id="<?php echo $this->get_field_id('icon_7_path'); ?>"
                class="widefat">
                <option value="">Select Icon</option>
        <?php 
            foreach ($values as $value)
              {     
              ?>
                <option <?php if ($instance['icon_7_path'] == $value) echo 'selected="selected"' ?>   value="<?php echo $value; ?>"><?php echo $value; ?></option>
              <?php
              }
              ?>
          </select> 
        </label>
        
        
                
        <label for="<?php echo $this->get_field_id('icon_8_url'); ?>">
        URL #8: 
        <input id="<?php echo $this->get_field_id('icon_8_url'); ?>"
                name="<?php echo $this->get_field_name('icon_8_url'); ?>"
                value="<?php echo esc_attr( $instance['icon_8_url'] ); ?>"
                class="widefat"/>
        </label>
        
        
        
        <label for="<?php echo $this->get_field_id('icon_8_path'); ?>">
        Icon #8:
          <select name="<?php echo $this->get_field_name('icon_8_path'); ?>" 
                  id="<?php echo $this->get_field_id('icon_8_path'); ?>"
                class="widefat">
                <option value="">Select Icon</option>
        <?php 
            foreach ($values as $value)
              {     
              ?>
                <option <?php if ($instance['icon_8_path'] == $value) echo 'selected="selected"' ?>   value="<?php echo $value; ?>"><?php echo $value; ?></option>
              <?php
              }
              ?>
          </select> 
        </label>
        
        
        

        
        
        
        

	<?php
	}
}


/*     Adding widget to widgets_init and registering aboutme widget    */
add_action( 'widgets_init', 'pego_socials_widgets' );

function pego_socials_widgets() {
	register_widget( 'pego_socials_Widget' );
}
?>
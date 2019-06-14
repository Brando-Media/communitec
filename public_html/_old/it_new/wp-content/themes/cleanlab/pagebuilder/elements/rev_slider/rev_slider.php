<?php
/*
	Name: Revolution Slider
	Description: This element will generate a full width slider using Revolution Slider
	Class: ZnRevSlider
	Category: Media, Fullwidth
	Level: 1
	Dependency_class: UniteBaseClassRev
*/

	class ZnRevSlider extends ZnElements {

		static $revsliders;

		function ZnRevSlider( $args = array() ){
			self::$revsliders = $this->get_sliders();
			ZnElements::__construct( $args );
		}

		function get_sliders() {

			$revsliders = array();

			global $wpdb;

			if ( class_exists('UniteBaseClassRev') ) {

				// Table name
				$table_name = $wpdb->prefix . "revslider_sliders";

				// Get sliders
				$rev_sliders = $wpdb->get_results( "SELECT title,alias FROM $table_name" );

				// Iterate over the sliders
				foreach($rev_sliders as $key => $item) {
					$revsliders[$item->alias] = $item->title;
				}
			}

			return $revsliders;
		}

		function options() {

			

			$options = array(
						array (
							'id'          => 'slider',
							'name'        => 'Slider',
							'description' => 'Please enter the slider name.',
							'type'        => 'select',
							'options'	  => self::$revsliders
						),
				);
			
			return $options;

		}

		function element() {
			$slider = $this->opt('slider') ? $this->opt('slider') : '';
			$css_class = $this->opt('css_class') ? $this->opt('css_class') : '';
			$css_class = apply_filters( 'zn_pb_el_css' , $css_class , $this );
            
        
			if ( empty( self::$revsliders ) ){
				echo '<div class="zn-pb-notification">It seems that you don\'t have any sliders created. Please create at least one slider.</div>';
				return;
			}

			if ( $slider == '' ) {
				$sliders = self::$revsliders;
				reset($sliders);
				$slider = key($sliders);
			}

			echo '<div class="'.$this->data['uid'].' '.$css_class.'">'. do_shortcode( '[rev_slider '.$slider.']' ).'</div>';

		}

		function element_edit() {

			if ( empty( self::$revsliders ) ){
				echo '<div class="zn-pb-notification">It seems that you don\'t have any sliders created. Please create at least one slider.</div>';
				return;
			}

			ob_start();
				$this->element();
			$return = ob_get_clean();

			//$new_slider_str = 'rev_slider_1_1' . uniqid();

			//echo str_replace( 'rev_slider_1_1',$new_slider_str , $return );
			echo preg_replace("/(rev_slider_)(\d)_(\d)/i", '${1}${2}${3}'. uniqid(), $return);

		}
        
		//** CSS moved to dynamic_css because the slider can be used in a widget and not only on page builder element
		//function css() { 
		//    $css = ".tp-leftarrow { background-image: url('".THEME_BASE_URI."/images/arrow-left-slider.png') !important; }
		//            .tp-rightarrow { background-image: url('".THEME_BASE_URI."/images/arrow-right-slider.png') !important; }";
		//    return $css;
		//}
	}

?>
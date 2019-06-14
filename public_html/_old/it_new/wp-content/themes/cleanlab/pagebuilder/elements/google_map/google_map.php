<?php
/*
	Name: Google Map
	Description: This element will generate a simple text box
	Class: ZnGoogleMap
	Category: Content, Fullwidth
	Level: 3
	Scripts: true
	Styles: true
*/

class ZnGoogleMap extends ZnElements {

	function options() {

		$zoom = array ();

		for ( $i = 1; $i<24; $i++) {
			$zoom[$i] = $i;
		}

		$icon_sizes = array( 
			'20' => '20 x 20' ,
			'30' => '30 x 30' ,
			'40' => '40 x 40' ,
			'50' => '50 x 50' ,
			'60' => '60 x 60' ,
			'70' => '70 x 70' ,
			'80' => '80 x 80' ,
			);

		$mapstyleurl = 'http://snazzymaps.com';
			
		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
							'id'         	=> 'locations',
							'name'       	=> 'Locations',
							'description' 	=> 'Here you can add your map locations.',
							'type'        	=> 'group',
							'sortable'	  	=> true,
							'element_title' => 'Map Location',
							'subelements' 	=> array(
													array( 
														"name" => "Marker Latitude",
														"description" => "Please enter the latitude value for your location.",
														"id" => "sc_map_latitude",
														"std" => "41.447390",
														"type" => "text"
													),
													array( 
														"name" => "Marker Longitude",
														"description" => "Please enter the longitude value for your location.",
														"id" => "sc_map_longitude",
														"std" => "-72.843868",
														"type" => "text"
													),
													array( 
														"name" => "Marker tooltip",
														"description" => "Add a text that will appear when the user clicks on the marker.",
														"id" => "tooltip",
														"type" => "textarea"
													),
													array( 
														"name" => "Marker location icon",
														"description" => "Select an icon that will appear as your current location. The default icon will be used if this is left blank.",
														"id" => "sc_map_icon",
														"std" => "",
														'class' => 'zn_full',
														"type" => "media"
													),
													array( 
														"name" => "Marker animation",
														"description" => "Select an animation that the icon will use.",
														"id" => "sc_map_icon_animation",
														"std" => "",
														"type" => "select",
														"options" => array ( "" => "None", "DROP" => "Drop" , "BOUNCE" =>  "Bounce" ),
													),
													array( 
														"name" => "Icon size",
														"description" => "Select the size of the marker icon.",
														"id" => "icon_size",
														"type" => "select",
														"options" => $icon_sizes,
													)
											)

						),
						array( 
							"name" => "Zoom level",
							"description" => "Select the start zoom level you want to use for this map ( default is 14 )",
							"id" => "sc_map_zoom",
							"std" => "14",
							"type" => "select",
							"options" => $zoom,
							"class" => ""
						),
						array( 
							"name" => "Map Type",
							"description" => "Select the desired map type you want to use.",
							"id" => "sc_map_type",
							"std" => "roadmap",
							"type" => "select",
							"options" => array ( "ROADMAP" => "Roadmap", "SATELLITE" => "Satellite" , "TERRAIN" => "Terrain" , "HYBRID" => "Hybrid" ),
							"class" => ""
						),
						array( 
							"name" => "Add directions box",
							"description" => "Select if you want to add a textbox in which the user can enter a departure location and get directions to the office location (first one if there are more than one).",
							"id" => "sc_map_directions",
							"std" => 'yes',
							"type" => "toggle2",
							"value" => "yes"
						),
						array( 
							"name" => "Directions box text",
							"description" => "Please enter the direction box text you want to use.",
							"id" => "sc_map_directions_text",
							"std" => 'Visit us from...',
							"type" => "text",
							'dependency'  => array( 'element' => 'sc_map_directions' , 'value'=> array('yes') ),
						),
						array(
							'id'            => 'show_overview',
							'name'          => 'Show overview map',
							'description'   => 'Select if you wish to add the overview map option',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),
						array(
							'id'            => 'show_streetview',
							'name'          => 'Show street view',
							'description'   => 'Select if you wish to add the street view option',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),			
						array(
							'id'            => 'show_maptype',
							'name'          => 'Show map type',
							'description'   => 'Select if you wish to add the map type option',
							'type'          => 'toggle2',
							'std'           => '',
							'value'         => 'yes'
						),	
				)
			),
			'styling' => array(
				'title' => 'Styling options',
				'options' => array(
					array( 
							"name" => "Map Height",
							"description" => "Please select value in pixels for the map height.",
							"id" => "sc_map_height",
							"std" => "730",
							"type" => "slider",
							'class'		  => 'zn_full',
							'helpers'	  => array(
								'min' => '200',
								'max' => '1080',
								'step' => '1'
							),
							//** Without live because the map itself doesn't refresh height until refreshed
							//'live' => array(
							//    'type'		=> 'css',
							//    'css_class' => '.'.$this->data['uid'], 
							//    'css_rule'	=> 'height',
							//    'unit'		=> 'px'
							//)
						),
					array(
                        'id'            => 'use_custom_style',
                        'name'          => 'Map custom style',
                        'description'   => 'Use a custom map style. You can get custom styles from <a href="'. $mapstyleurl .'" target="_blank">'. $mapstyleurl .'</a>.',
                        'type'          => 'toggle2',
                        'std'           => '',
                        'value'         => 'yes'
                    ),
					array(
                        'id'          => 'custom_style',
                        'name'        => 'Normal map style',
                        'description' => 'Paste your custom style here (Javascript style array). You can get custom styles from <a href="'. $mapstyleurl .'" target="_blank">'. $mapstyleurl .'</a>.',
                        'type'        => 'textarea',
						'std'		  => '',
						'dependency'  => array( 'element' => 'use_custom_style' , 'value'=> array('yes') ),
                    ),
					array(
                        'id'          => 'custom_style_active',
                        'name'        => 'Active map style (when a popup is visible)',
                        'description' => 'Paste your custom style here (Javascript style array). You can get custom styles from <a href="'. $mapstyleurl .'" target="_blank">'. $mapstyleurl .'</a>.',
                        'type'        => 'textarea',
						'std'		  => '',
						'dependency'  => array( 'element' => 'use_custom_style' , 'value'=> array('yes') ),
                    ),
				)
			),
			'misc' => array(
				'title' => 'Miscellaneous',
				'options' => array(
					array( 
							"name" => "Allow Mousewheel",
							"description" => "Select if you want to allow map zooming using the mouse scroll (may interfere with page scroll).",
							"id" => "sc_map_zooming_mousewheel",
							"std" => "",
							"type" => "toggle2",
							"value" => "yes",
						),
						array( 
							"name" => "Map localization",
							"description" => "Force the map localization to a specific language",
							"id" => "sc_map_localization",
							"std" => "",
							"type" => "select",
							"options" => array ( '' => 'Use browser language','ar'=>'ARABIC'
																			,'eu'=>'BASQUE'
																			,'bg'=>'BULGARIAN'
																			,'bn'=>'BENGALI'
																			,'ca'=>'CATALAN'
																			,'cs'=>'CZECH'
																			,'da'=>'DANISH'
																			,'de'=>'GERMAN'
																			,'el'=>'GREEK'
																			,'en'=>'ENGLISH'
																			,'en-AU'=>'ENGLISH (AUSTRALIAN)'
																			,'en-GB'=>'ENGLISH (GREAT BRITAIN)'
																			,'es'=>'SPANISH'
																			,'eu'=>'BASQUE'
																			,'fa'=>'FARSI'
																			,'fi'=>'FINNISH'
																			,'fil'=>'FILIPINO'
																			,'fr'=>'FRENCH'
																			,'gl'=>'GALICIAN'
																			,'gu'=>'GUJARATI'
																			,'hi'=>'HINDI'
																			,'hr'=>'CROATIAN'
																			,'hu'=>'HUNGARIAN'
																			,'id'=>'INDONESIAN'
																			,'it'=>'ITALIAN'
																			,'iw'=>'HEBREW'
																			,'ja'=>'JAPANESE'
																			,'kn'=>'KANNADA'
																			,'ko'=>'KOREAN'
																			,'lt'=>'LITHUANIAN'
																			,'lv'=>'LATVIAN'
																			,'ml'=>'MALAYALAM'
																			,'mr'=>'MARATHI'
																			,'nl'=>'DUTCH'
																			,'no'=>'NORWEGIAN'
																			,'pl'=>'POLISH'
																			,'pt'=>'PORTUGUESE'
																			,'pt-BR'=>'PORTUGUESE (BRAZIL)'
																			,'pt-PT'=>'PORTUGUESE (PORTUGAL)'
																			,'ro'=>'ROMANIAN'
																			,'ru'=>'RUSSIAN'
																			,'sk'=>'SLOVAK'
																			,'sl'=>'SLOVENIAN'
																			,'sr'=>'SERBIAN'
																			,'sv'=>'SWEDISH'
																			,'tl'=>'TAGALOG'
																			,'ta'=>'TAMIL'
																			,'te'=>'TELUGU'
																			,'th'=>'THAI'
																			,'tr'=>'TURKISH'
																			,'uk'=>'UKRAINIAN'
																			,'vi'=>'VIETNAMESE'
																			,'zh-CN'=>'CHINESE (SIMPLIFIED)'
																			,'zh-TW'=>'CHINESE (TRADITIONAL)'
						  ),
							"class" => ""
						),
				)
			),
		);
			

		return $options;

	}

	function element(){

		$locations = $this->opt('locations') ? $this->opt('locations') : '';
		$sc_map_directions_text = $this->opt('sc_map_directions_text') ? $this->opt('sc_map_directions_text') : __('Visit us from...','zn_framework');

		if ( empty($locations) ) {
			echo '<div class="zn-pb-notification">Please configure the element options and add at least one location.</div>';
			return;
		}
	?>

		<div class="zn_google_map <?php echo $this->data['uid']; ?>" >
			<!-- map container -->
			<div id="zn_google_map_<?php echo $this->data['uid']; ?>" class="zn_gmap_canvas">
				<?php if ( $this->opt('sc_map_directions') === 'yes') {?>
					<div class="zn_visitUsContainer"> 
						<input type="text" required placeholder="<?php echo esc_attr($sc_map_directions_text); ?>" class="animate zn_startLocation" />
						<span class="zn_removeRoute zn_icon" data-unicode="ue855" data-zniconfam="icomoon" data-zn_icon="&#xe855;"></span>
					</div>
				<?php };?>
			</div>
		</div>

	<?php
	}

	function scripts() {
		$localization = ($this->opt('sc_map_localization') && $this->opt('sc_map_localization')!=='' ? '&language='.$this->opt('sc_map_localization') : '');
		wp_enqueue_script( 'zn_google_api', 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false'.$localization, array('jquery'), ZN_FW_VERSION, true );
		wp_enqueue_script( 'zn_gmap', THEME_BASE_URI .'/pagebuilder/elements/google_map/assets/gmaps.js', array('jquery'), ZN_FW_VERSION, true );
	}

	// Loads the required JS
	function js() {

			$locations = $this->opt('locations') ? $this->opt('locations') : array();
			$zoom = $this->opt('sc_map_zoom') ? $this->opt('sc_map_zoom') : '14' ;
			$terrain = $this->opt('sc_map_type') ? $this->opt('sc_map_type') : 'ROADMAP' ;
			$scroll = $this->opt('sc_map_zooming_mousewheel') === 'yes' ? 'true' : 'false' ;
			$routingColor = zget_option( 'sliding_background' , 'style_options' );
			$uid = $this->data['uid'];
			$mainOfficeLocation = '[0,0]';
			$markers = '';
			$use_custom_style = $this->opt('use_custom_style','');
			$custom_style = 'null';
			$custom_style_active = 'null';
			if ($use_custom_style === 'yes') {
				$custom_style = $this->opt('custom_style','null');
				$custom_style_active = $this->opt('custom_style_active','null');
			}
			$show_overview = $this->opt('show_overview') === 'yes' ? 'true' : 'false';
			$show_streetview = $this->opt('show_streetview') === 'yes' ? 'true' : 'false';
			$show_maptype = $this->opt('show_maptype') === 'yes' ? 'true' : 'false';
			
			if ( !empty( $locations ) ) 
			{
				$mainOfficeLocation = '['.$locations[0]['sc_map_latitude'].', '.$locations[0]['sc_map_longitude'].']';
				//** Build the markers [[lat, long, tooltip, icon, size, animation, anchor],...]
				$markers = '[';
				foreach ( $locations as $location ) {
					$markers .= sprintf('[%1$s,%2$s,\'%3$s\',\'%4$s\',%5$s,\'%6$s\',%7$s],',
										$location['sc_map_latitude'],
										$location['sc_map_longitude'],
										preg_replace( "/\r|\n/", "", wpautop(addslashes($location['tooltip'])) ),
										$location['sc_map_icon'],
										$location['icon_size'],
										$location['sc_map_icon_animation'],
										'');
				}
				$markers .= ']';
			
				$zn_g_map = array ( 'gmap'.$this->data['uid'] =>
						"
							var zn_google_map_$uid = new Zn_google_map('zn_google_map_$uid', $mainOfficeLocation, '$routingColor', $markers, '$terrain', $zoom, $scroll, $custom_style, $custom_style_active, $show_overview, $show_streetview, $show_maptype);
							zn_google_map_$uid.init_map();

						");
						return $zn_g_map;
			};
			

		return false;

	}
	
		/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];
		
		$css .= '.'.$uid.' {height: '. ($this->opt('sc_map_height') ? $this->opt('sc_map_height') : '730').'px;} ';

		return $css;
	}

}


?>
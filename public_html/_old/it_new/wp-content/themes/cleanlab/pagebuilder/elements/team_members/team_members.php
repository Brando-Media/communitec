<?php
/*
	Name: Team Members 1
	Description: This element will generate a list of team members
	Class: ZnTeamMembers
	Category: content
	Level: 3
	Style: true
	
*/

class ZnTeamMembers extends ZnElements {

	function options() {
		global $zn_framework;
		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
						'id'          => 'title',
						'name'        => 'Title',
						'description' => 'Please enter a title for this element',
						'type'        => 'text',
						'std'		=> ''
					),
					array(
						'id'         	=> 'members_list',
						'name'       	=> 'Members List',
						'description' 	=> 'Here you can add as many team members as you want',
						'type'        	=> 'group',
						'sortable'	  	=> true,
						'element_title' => 'member_name',
						'subelements' 	=> array(
								array(
                                    'id'          => 'member_name',
                                    'name'        => 'Name',
                                    'description' => 'Enter a name for this member',
                                    'type'        => 'text'
                                ),
								array(
                                    'id'          => 'member_position',
                                    'name'        => 'Position',
                                    'description' => 'Enter a position for this member',
                                    'type'        => 'text'
                                ),
								array(
									'id'          => 'member_avatar',
									'name'        => 'Image',
									'description' => 'Select an image for this member',
									'type'        => 'media',
									'supports'    => 'id',
									'class'       => 'zn_full'
								),
								array(
									'id'          => 'member_link',
									'name'        => 'Member page',
									'description' => 'Enter a link for this member',
									'type'        => 'link'
								),
						        array(
							        'id'          => 'member_social',
							        'name'        => 'Social list',
							        'description' => 'Here you can add a list of icon links',
							        'type'        => 'group',
									'sortable'	  	=> true,
									'element_title' => 'social link',
									'subelements' 	=> array(
											array(
												'id'          => 'member_icon_link',
												'name'        => 'Button link',
												'description' => 'Enter a link for this element',
												'type'        => 'link'
											),
											array(
                                                'id'            => 'icon_color_hover',
                                                'name'          => 'Icon hover color',
                                                'description'   => 'Choose a color for icon on mouse over',
                                                'type'          => 'colorpicker',
                                                'std'           => ''
                                            ),
											array(
												'id'          => 'member_icon',
												'name'        => 'Icon',
												'description' => 'Please select your desired icon',
												'type'        => 'icon_list',
												'class'		  => 'zn_full'
											),
											
											//array(
											//    'id'          => 'link_text',
											//    'name'        => 'Button text',
											//    'description' => 'Enter a text for this element',
											//    'type'        => 'text'
											//)
										)
                                ),
						)
					),
					array(
					    'id'          => 'count',
					    'name'        => 'Number of maximum visible images',
					    'description' => 'Please choose the desired number of maximum visible images.',
					    'type'        => 'slider',
						'std'		  => '3',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '1',
							'max' => '20',
							'step' => '1'
						),
					),
				)
			),
			'styling' => array(
				'title' => 'Styling option',
				'options' => array(
					array(
                        'id'            => 'style',
                        'name'          => 'Title uses alternative color',
                        'description'   => 'Select if you want to use the alternative color for the title.',
                        'type'          => 'toggle2',
                        'std'           => '',
                        'value'         => 'style2',
						'live' => array(
					        'type'		=> 'class',
					        'css_class' => '.'.$this->data['uid'].', .'.$this->data['uid'].' .zn_owl_carousel'
					    )
                    ),
					array(
                        'id'            => 'show_bullets',
                        'name'          => 'Show bullets',
                        'description'   => 'Select if you want to show the navigation bullets',
                        'type'          => 'toggle2',
                        'std'           => '',
                        'value'         => 'yes'
                    ),
					array(
                        'id'            => 'show_navigation',
                        'name'          => 'Show navigation',
                        'description'   => 'Select if you want to show the navigation arrows',
                        'type'          => 'toggle2',
                        'std'           => 'yes',
                        'value'         => 'yes'
                    ),
					array(
							'id'            => 'nav_style',
							'name'          => 'Navigation style',
							'description'   => 'Select a style for the navigation buttons of this carousel',
							'type'          => 'select',
							'std'           => 'overTop hollowNav style2',
							'options'	    => zn_get_navigation_styles(),
							'dependency'  => array( 'element' => 'show_navigation' , 'value'=> array('yes') ),
							'live' => array(
									'type'		=> 'class',
									'css_class' => '.'.$this->data['uid'].' .zn_owl_carousel'
							)
						),
				)
			),
			'misc' => array(
				'title' => 'Miscellaneous',
				'options' => array(
					array(
                        'id'            => 'auto_scroll',
                        'name'          => 'Auto scroll',
                        'description'   => 'Select if you want the carousel to scroll automatically',
                        'type'          => 'toggle2',
                        'std'           => '',
                        'value'         => 'yes'
                    ),
					array(
                        "id"            => "scroll_interval",
						"name"          => "Timeout duration",
						"description"   => "Enter the time interval between scrolls (in milliseconds).",
						"std"           => "4000",
						"type"          => "text",
                        'dependency'    => array( 'element' => 'auto_scroll' , 'value'=> array('yes') )
					),
				)
			),
		);	
		

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		$title = $this->opt('title','');
		$memberList = $this->opt('members_list', false);
		$count = $this->opt('count',4);
		$autoScroll = $this->opt('auto_scroll') === 'yes' ? $this->opt('scroll_interval',4000) : 'false';
		$style = ($this->opt('style','') !== 'style2' ? '' : 'style2'); //** eliminate zn_dummy_value
		$show_bullets = $this->opt('show_bullets') === 'yes' ? 'true' : 'false';
		$show_navigation = $this->opt('show_navigation') !== 'yes' ? 'false' : 'true';
		$navStyle = $this->opt('nav_style','overTop hollowNav style2');
		$responsiveClass = "";
		if ($show_navigation && strpos($navStyle, 'overTop') !== FALSE) {
			$responsiveClass = "padTitle";
		}
		
		if ( empty( $title ) && !$memberList ) {
			echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
			return;
		}
		
		
		
		?>
		
		<div class="zn-team-members <?php echo $style.' '.$responsiveClass.' '.$this->data['uid']; ?> relative">
		    <h2 class="section-title"><?php echo $title; ?></h2>
			<div class="our-team zn_owl_carousel owl-theme <?php echo $navStyle; ?>" data-auto="<?php echo esc_attr( $autoScroll ); ?>" data-pagination="<?php echo esc_attr( $show_bullets );?>" data-navigation="<?php echo esc_attr( $show_navigation );?>" data-items="<?php echo esc_attr( $count ); ?>" data-single="<?php echo $count > 1 ? 'false' : 'true';?>">
		<?php
		if (!empty($memberList))
		{
			$memberNo = 0;
		    foreach ( $memberList as $key => $member ) {
				$memberNo++;
				if (empty($member['member_avatar'])) { 
					echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
					echo '</div></div>';
					return;
				}
			
				$member_link = !empty( $member['member_link'] ) ? zn_extract_link( $member['member_link'] , '' ) : '';
			
			
			?>
			
				<div class="item overlay overlay-effect">
		    		<figure>
		    			<?php 
						echo $member_link['start']; 
						echo wp_get_attachment_image( $member['member_avatar'], 'full', false, array('class' => 'img-responsive ') );
						echo $member_link['end']; 
						?>
				        <figcaption class="zn-primary-as-bg">
							<h3 class="zn-alternative-color"><?php echo $member['member_name']; ?></h3>
							<h5 class="zn-alternative-color"><?php echo $member['member_position']; ?></h5>
							
							<?php
							if (!empty($member['member_social'])) {
							?>
							<ul class="reset-list">
							<?php 
							$iconNo = 0;
							foreach($member['member_social'] as $key => $memberSocial) {
								$iconNo++;
								$memberSocial_link = !empty( $memberSocial['member_icon_link'] ) ? zn_extract_link( $memberSocial['member_icon_link'] , 'zn-alternative-color zn-alternative-hover' ) : '';
								$member_social_icon_opt = !empty( $memberSocial['member_icon'] ) ? $memberSocial['member_icon'] : '';
								$member_social_icon = !empty( $member_social_icon_opt['family'] )  ? '<span class="zn_icon_box_icon" '.zn_generate_icon( $member_social_icon_opt ).'></span>' : '';
							?>
								<li class="animation zn_mi_<?php echo $memberNo.'-'.$iconNo; ?>">
									<?php echo $memberSocial_link['start'].$member_social_icon.$memberSocial_link['end']; ?>
								</li>
							<?php 
							}
							?>
							
							</ul>
							<?php
							}
							?>
						</figcaption>
					</figure>
		    	</div>
			
			<?php
			}
		}
		
		
		?>	
		    				
		    </div>
		</div>
		

		<?php
	}
	
		/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = "";
		$uid = $this->data['uid'];
		$memberList = $this->opt('members_list', false);
		
		if (!empty($memberList))
		{
			$memberNo = 0;
		    foreach ( $memberList as $key => $member ) {
				$memberNo++;
				$iconNo = 0;
				if ( !empty( $member['member_social'] ) ) {
					foreach($member['member_social'] as $key => $memberSocial) {
						$iconNo++;
						if (!empty($memberSocial['icon_color_hover'])) {
							$css .= ".$uid .zn_mi_$memberNo-$iconNo:hover {background-color: ".$memberSocial['icon_color_hover'].";}";
						}
					}
				}

			}
		}
		
		
		
		
		return $css;
	}

}

?>
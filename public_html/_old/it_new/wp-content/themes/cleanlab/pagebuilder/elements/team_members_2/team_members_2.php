<?php
/*
	Name: Team Members 2
	Description: This element will generate a list of team members
	Class: ZnTeamMembers2
	Category: content
	Level: 3
	Style: false
	
*/

class ZnTeamMembers2 extends ZnElements {

	function options() {
		global $zn_framework;
		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					//array(
					//    'id'          => 'title',
					//    'name'        => 'Title',
					//    'description' => 'Please enter a title for this element',
					//    'type'        => 'text',
					//    'std'		=> ''
					//),
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
									'id'			=> 'member_description',
									'name'			=> 'Description',
									'description'	=> 'Enter a description for this member',
									'type'			=> 'textarea',
									'std'			=> '',
									'class'			=> 'zn_full'
								),
								array(
									'id'          => 'member_avatar',
									'name'        => 'Image (mandatory)',
									'description' => 'Select an image for this member. Members without an image will not be rendered!',
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
											//array(
											//    'id'            => 'icon_color_hover',
											//    'name'          => 'Icon hover color',
											//    'description'   => 'Choose a color for icon on mouse over',
											//    'type'          => 'colorpicker',
											//    'std'           => ''
											//),
											array(
												'id'          => 'member_icon',
												'name'        => 'Icon',
												'description' => 'Please select your desired icon',
												'type'        => 'icon_list',
												'class'		  => 'zn_full'
											),
										)
                                ),
						)
					),
				)
			),
			'styling' => array(
				'title' => 'Styling options',
				'options' => array(
					array(
					    'id'            => 'style',
					    'name'          => 'Carousel style',
					    'description'   => 'Select a style for this carousel',
					    'type'          => 'select',
					    'std'           => '',
					    'options'	    => array('' => 'Style 1', 
												'style2' => 'Style 2')
					),
					array(
						'id'          => 'alignment',
						'name'        => 'Alignment',
						'description' => 'Select the horizontal alignment of the text and image.',
						'type'        => 'select',
						'std'		  => '',
						'options'        => array( '' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
						'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid']
						)
					),
					array(
                        'id'            => 'show_bullets',
                        'name'          => 'Show bullets',
                        'description'   => 'Select if you want to show the navigation bullets',
                        'type'          => 'toggle2',
                        'std'           => 'yes',
                        'value'         => 'yes'
                    ),
					array(
                        'id'            => 'show_navigation',
                        'name'          => 'Show navigation',
                        'description'   => 'Select if you want to show the navigation arrows',
                        'type'          => 'toggle2',
                        'std'           => '',
                        'value'         => 'yes'
                    ),
					array(
					    'id'            => 'nav_style',
					    'name'          => 'Navigation style',
					    'description'   => 'Select a style for the navigation buttons of this carousel',
					    'type'          => 'select',
					    'std'           => 'sideNav hollowNav',
					    'options'	    => array('sideNav hollowNav' => 'Side/Hollow 1',
												 'sideNav hollowNav style2' => 'Side/Hollow 2',
												 'sideNav solidNav' => 'Side/Solid 1',
												 'sideNav solidNav2' => 'Side/Solid 2',
												 'overTop hollowNav' => 'Top/Hollow 1', 
												 'overTop hollowNav style2' => 'Top/Hollow 2',
												 'overTop solidNav' => 'Top/Solid 1',
												 'overTop solidNav2' => 'Top/Solid 2'),
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
						"description"   => "Enter the time interval between scrolls (in miliseconds).",
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
		//$title = $this->opt('title','');
		$memberList = $this->opt('members_list', false);
		$autoScroll = $this->opt('auto_scroll') === 'yes' ? $this->opt('scroll_interval',4000) : 'false';
		$style = $this->opt('style','');
		$alignment = $this->opt('alignment','');
		$show_bullets = $this->opt('show_bullets') === 'yes' ? 'true' : 'false';
		$show_navigation = $this->opt('show_navigation') !== 'yes' ? 'false' : 'true';
		$nav_style = "";
		if ($show_navigation === 'true') {
			$nav_style = $this->opt('nav_style','sideNav hollowNav');
		}
		
		if ( !$memberList ) {
			echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
			return;
		}
		
		
		?>
		
		<div class="zn_team_members_2 <?php echo $style.' '.$alignment.' '.$this->data['uid']; ?>">
		<?php 
		//if (!empty($title)) {
		//    echo "<h2 class='section-title mbottom30'>$title</h2>";
		//} 
		?>
		<div class="our-team-one-carousel zn_owl_carousel <?php echo esc_attr( $nav_style ); ?>" data-auto="<?php echo esc_attr( $autoScroll ); ?>" data-pagination="<?php echo esc_attr( $show_bullets ); ?>" data-navigation="<?php echo esc_attr( $show_navigation ) ;?>">
		<?php
			$memberNo = 0;
		    foreach ( $memberList as $key => $member ) {
				$memberNo++;
				if (empty($member['member_avatar'])) {
					echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
					echo '</div></div>';
					return;
				}
			
				$member_link = zn_extract_link( $member['member_link']);
				$description = wpautop($member['member_description']);
			
			?>
			
				<?php 
				//** STYLE 1
				if ($style === '') {
				?>
				<div class="item zn-alternative-bkg">
		    		<div class="row">
						<div class="col-sm-6">
							<?php 
							echo $member_link['start'];
							//echo zn_get_image($member['member_avatar'], 245, 245, array('class' => "img-responsive"));
							echo wp_get_attachment_image( $member['member_avatar'], 'full', false, array('class' => 'img-responsive ') );
							echo $member_link['end']; 
							?>
						</div>
						<div class="col-sm-6 right-carousel">
							<h6 class="zn-secondary-color"><?php echo $member['member_name']; ?></h6>
							<div class="zn-position mbottom30"><?php echo $member['member_position']; ?></div>
							<div class="mbottom30"><?php echo $description; ?></div>
							<?php
							if (!empty($member['member_social'])) {
							?>
							<div class="social-member-carousel">
							<?php 
							foreach($member['member_social'] as $key => $memberSocial) {
								$memberSocial_link = zn_extract_link( $memberSocial['member_icon_link'] , 'zn-primary-color zn-alternative-hover' );
								$member_social_icon_opt = !empty( $memberSocial['member_icon'] ) ? $memberSocial['member_icon'] : '';
								$member_social_icon = !empty( $member_social_icon_opt['family'] )  ? '<span class="zn_icon_box_icon animation" '.zn_generate_icon( $member_social_icon_opt ).'></span>' : '';
								
								echo $memberSocial_link['start'].$member_social_icon.$memberSocial_link['end'];
							}
							?>
							</div>
							<?php
							}
							?>
						</div>
					</div>
		    	</div>
			
			<?php
			} //** END STYLE 1
			else { //** START STYLE 2 ?>
			
				<div class="item">
					<?php 
					echo $member_link['start'];
					//echo zn_get_image($member['member_avatar'], 245, 245, array('class' => "img-responsive"));
					echo wp_get_attachment_image( $member['member_avatar'], 'full', false, array('class' => 'img-responsive mbottom30') );
					echo $member_link['end']; 
					?>
					<h6 class="zn-member-name"><?php echo $member['member_name']; ?></h6>
					<p class="zn-primary-color mbottom20"><?php echo $member['member_position']; ?></p>
					<div><?php echo $description; ?></div>
					<?php
					if (!empty($member['member_social'])) {
					?>
					<div class="social-member-carousel">
					<?php 
					foreach($member['member_social'] as $key => $memberSocial) {
						$memberSocial_link = zn_extract_link( $memberSocial['member_icon_link'] , 'zn-primary-color zn-alternative-hover' );
						$member_social_icon_opt = !empty( $memberSocial['member_icon'] ) ? $memberSocial['member_icon'] : '';
						$member_social_icon = !empty( $member_social_icon_opt['family'] )  ? '<span class="zn_icon_box_icon animation" '.zn_generate_icon( $member_social_icon_opt ).'></span>' : '';
								
						echo $memberSocial_link['start'].$member_social_icon.$memberSocial_link['end'];
					}
					?>
					</div>
					<?php
					}
					?>
				</div>
			
			<?php
			} //** END STYLE 2
			}
		
		
		?>	
		    				
		</div>
		</div>
		

		<?php
	}

}

?>
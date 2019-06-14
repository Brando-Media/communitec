<?php
/*
	Name: Collapsible List
	Description: This element will generate a collapsible list
	Class: ZnCollapsibleList
	Category: content
	Level: 3
    Style: true
*/

class ZnCollapsibleList extends ZnElements {

	function options() {
		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					 array(
							'id'          => 'list',
							'name'        => 'Collapsible groups',
							'description' => 'Here you can add as many collapsible groups as you like. Inside each group, add one or more columns then their content.',
							'type'        => 'group',
                            'sortable'	  	=> false,
                            'element_title' => 'title',
                            'subelements' 	=> array(
                                    array(
                                        'id'            => 'title',
                                        'name'          => 'Title',
                                        'description'   => 'Enter a title for this group',
                                        'type'          => 'text'
                                    ),
									array(
										'id'          => 'icon',
										'name'        => 'Icon',
										'description' => 'Select an icon for the header of this group',
										'type'        => 'icon_list',
										'std'		  => '',
										'class' 	  => 'zn_full'
									),
									
                            )
                            
						),
				)
			),
			'styling' => array(
				'title' => 'Styling option',
				'options' => array(
					array(
						    'id'          => 'style',
						    'name'        => 'Element Style',
						    'description' => 'Please choose the desired layout you want to use',
						    'type'        => 'select',
						    'std'         => 'vertical',
						    'options'	  => array( ''=>'Style 1' , 'style2' => 'Style 2', 'style3' => 'Style 3'),
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid']
							)
						),
						array(
							'id'            => 'accordion',
							'name'          => 'Accordion Style',
							'description'   => 'Select if you want to autocollapse one group when expanding another.',
							'type'          => 'toggle2',
							'std'           => 'yes',
							'value'         => 'yes'
						),
						array(
							'id'            => 'expand_first',
							'name'          => 'Expand first group',
							'description'   => 'Select if you want to autoexpand the first group on page load.',
							'type'          => 'toggle2',
							'std'           => 'yes',
							'value'         => 'yes'
						),
				)
			),
		);

		return $options;

	}

	function element(){


		global $zn_framework;
        
        $list = $this->opt('list', false);
		$accordion = $this->opt('accordion','yes') === 'yes' ? true : false;
		$expand_first = $this->opt('expand_first','yes') === 'yes' ? true : false;
		$style = $this->opt('style','');
		//$colorStyle = $this->opt('color_style') ? $this->opt('color_style') : '';
        

        if ( empty( $list ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}
        
        $uid = $this->data['uid']; ?>
		
        <div class="zn-collapsible panel-group <?php echo $style.' '.$uid; ?>" id="<?php echo $uid; ?>">
        
		<?php
        $listCount = count($list);
		for ($i = 0; $i < $listCount; $i++ ) {
		?>
			<div class="panel panel-default zn-background-color">
				<div class="panel-heading">
					<h4 class="panel-title">
					<a class="zn-alternative-bkg no-scroll <?php echo ($i===0 && $expand_first) ? '' : 'collapsed'; ?>" data-toggle="collapse" <?php if ($accordion) {echo 'data-parent="#'.$uid.'"';} ?> href="#<?php echo $uid.'_'.$i;?>">
					<?php echo ($list[$i]['icon'] && $list[$i]['icon']['family'])  ? '<span class="zn-col-icon zn-paragraph-color" '.zn_generate_icon( $list[$i]['icon'] ).'></span>' : ''; ?>
					<?php echo $list[$i]['title'] ? $list[$i]['title'] : ' '; ?> </a>
					</h4>
				</div>
				<div id="<?php echo $uid.'_'.$i;?>" class="panel-collapse collapse <?php if ($i===0 && $expand_first) {echo 'in';}?>">
					<div class="panel-body">
						<div class="row tabPaneContainer zn_columns_container zn_content" data-droplevel="1">
						<?php 
						if ( empty( $this->data['content'][$i] ) ) {
							$column = $zn_framework->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' );
							$this->data['content'][$i] = array ( $column );
						} 

						if ( !empty( $this->data['content'][$i] ) ) {
							$zn_framework->pagebuilder->zn_render_content( $this->data['content'][$i] );
						} 

						?>
						</div>
					</div>
				</div>
			</div>
		<?php 
		}
		?>
			
		</div>
		
		<?php
	}
    
    	// Loads the required JS
	//function js() {

	//    $uid = $this->data['uid'];
	//    $myFunction = "
	//        $('.$uid>.tabNamesContainer>ul>li>a[data-toggle=\"tab\"]').on('shown.bs.tab', function(e) 
	//            { 
	//                $.themejs.enable_generic_slider($(''+$(this).attr('href')+''));
	//                $.themejs.enable_browserSlider($(''+$(this).attr('href')+''));
	//                $.themejs.enable_galery_post($(''+$(this).attr('href')+''));
	//                $.themejs.enable_portfolio_carousel($(''+$(this).attr('href')+''));
	//                $.themejs.enable_image_slider($(''+$(this).attr('href')+''));
	//            });
	//    ";		
		
	//    $myJs = array($uid => $myFunction);
	//    return $myJs;
	//}
    
        /**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	//function css(){
	//    $css = '';
	//    $uid = $this->data['uid'];

	//    return $css;
	//}

}


?>
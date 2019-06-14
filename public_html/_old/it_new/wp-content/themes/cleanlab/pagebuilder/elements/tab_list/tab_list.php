<?php
/*
	Name: Tab List
	Description: This element will generate a list of tabs, each with its own content
	Class: ZnTabList
	Category: content
	Level: 3
    Style: true
*/

class ZnTabList extends ZnElements {

	function options() {
	$options = array(
			'has_tabs'  => true,
			'tabs' => array(
				'title' => 'Tabs',
				'options' => array(
					array(
						'id'          => 'tab_list',
						'name'        => 'Tab list',
						'description' => 'Here you can add as many tabs as you like',
						'type'        => 'group',
                        'sortable'	  	=> false,
                        'element_title' => 'title',
                        'subelements' 	=> array(
                                array(
                                    'id'            => 'title',
                                    'name'          => 'Title',
                                    'description'   => 'Enter a title for this tab',
                                    'type'          => 'text'
                                )
                        )
                            
					),
				)
			),
			'styling' => array(
				'title' => 'Styling options',
				'options' => array(
					array(
						'id'          => 'style',
						'name'        => 'Element Style',
						'description' => 'Please choose the desired style you want to use',
						'type'        => 'select',
						'std'         => '',
						'options'	  => array(''=>'Horizontal', 'vertical'=>'Vertical'),
						'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid']
							)
					),
					array(
						'id'          => 'color_style',
						'name'        => 'Color Style',
						'description' => 'Please choose the desired color style you want to use',
						'type'        => 'select',
						'std'         => 'colored',
						'options'	  => array('simple'=>'Simple', 'colored'=>'Colored'),
						'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid']
							)
					),
					array(
						'id'          => 'alignment',
						'name'        => 'Tabs Alignment',
						'description' => 'Please select an alignment for the tab names',
						'type'        => 'select',
						'std'         => '',
						'options'	  => array(''=>'Left', 'center'=>'Center', 'right'=>'Right'),
						'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid']
							)
					),
				)
			)
		);
	
		return $options;

	}

	function element(){


		global $zn_framework;
        
        $tabsList = $this->opt('tab_list', false);
		$style = $this->opt('style','');
		$color_style = $this->opt('color_style','');
		$alignment = $this->opt('alignment','');        

        if ( empty( $tabsList ) ) {
			echo '<div class="zn-pb-notification">Please configure the element and add at least one tab.</div>';
			return;
		}
        
        $uid = $this->data['uid'];
		
        echo '<div class="zn_tabList '.$uid.' '.$style. ' '.$color_style.' '.$alignment.'">';
        
        $tabsListCount = count($tabsList);
        
        echo '<!--TAB NAMES-->';
        echo '<div class="zn_tab_names mbottom50">';

        echo '<ul class="nav nav-tabs reset-list tabListNames" role="tablist" >';
        echo '<li class="active"><a href="#'.$uid.'_0'.'" class="no-scroll zn-alternative-bkg" role="tab" data-toggle="tab">'.($tabsList[0]['title'] ? $tabsList[0]['title'] : ' ').'</a></li>';
        for ($i = 1; $i < $tabsListCount; $i++ ) {
            $title = $tabsList[$i]['title'] ? $tabsList[$i]['title'] : ' ';
            echo '<li><a href="#'.$uid.'_'.$i.'" class="no-scroll zn-alternative-bkg" role="tab" data-toggle="tab">'.$title.'</a></li>';
        }
        echo '</ul>';
        echo '</div>';
        
        echo '<!--TAB PANES-->';
        echo '<div class="tab-content">';
             
        for ($i = 0; $i < $tabsListCount; $i++ ) {
            echo '<div id="'.$uid.'_'.$i.'" class="tab-pane fade '.($i === 0 ? 'in active' : '').'">';
            echo '   <div class="row tabPaneContainer zn_columns_container zn_content" data-droplevel="1">';

				if ( empty( $this->data['content'][$i] ) ) {
					$column = $zn_framework->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array(), 'col-sm-12' );
					$this->data['content'][$i] = array ( $column );
				} 

                if ( !empty( $this->data['content'][$i] ) ) {
                    $zn_framework->pagebuilder->zn_render_content( $this->data['content'][$i] );
                }
            echo '   </div>';
            echo '</div>';
            
        }
        echo '</div>';
        echo '<!--END TAB PANES-->';
        echo '</div>';
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
	function css(){
        $css = '';
        $uid = $this->data['uid'];

		return $css;
	}

}


?>
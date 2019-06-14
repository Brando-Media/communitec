<?php
/*
	Name: Icon List 2
	Description: This element will generate a simple icon list
	Class: ZnIconList2
	Category: content
	Level: 3
*/

class ZnIconList2 extends ZnElements {

	function options() {

		$options = array(
							//array(
							//    'id'          => 'list_style',
							//    'name'        => 'List style',
							//    'description' => 'Select the desired style for this list.',
							//    'type'        => 'select',
							//    'std'		  => '',
							//    'options'        => array( 'style1' => 'Style 1', 'style2' => 'Style 2', 'style3' => 'Style 3'),
							//    'live' => array(
							//        'type'		=> 'class',
							//        'css_class' => '.'.$this->data['uid']
							//    )
							//),
							array(
							    'id'          => 'alignment',
							    'name'        => 'Alignment',
							    'description' => 'Select the horizontal alignment of the icons.',
							    'type'        => 'select',
							    'std'		  => 'left',
							    'options'        => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
								    'live' => array(
							        'type'		=> 'class',
							        'css_class' => '.'.$this->data['uid']
							    )
							),
							array(
							    'id'         	=> 'icon_list',
							    'name'       	=> 'Icon List',
							    'description' 	=> 'Here you can add a list of texts or links, each with its own icon',
							    'type'        	=> 'group',
							    'sortable'	  	=> true,
							    'element_title' => 'link_text',
							    'subelements' 	=> array(
													    array(
							                                'id'          => 'icon',
							                                'name'        => 'Icon',
							                                'description' => 'Please select your desired icon',
							                                'type'        => 'icon_list',
							                                'class'		  => 'zn_full'
						                                ),
														//array(
														//    'id'          => 'link_text',
														//    'name'        => 'Text',
														//    'description' => 'Enter a text for this element',
														//    'type'        => 'text'
														//),
						                                array(
							                                'id'          => 'link',
							                                'name'        => 'Icon link',
							                                'description' => 'Enter a link for this element',
							                                'type'        => 'link'
						                                )						                                
											    )
						    ),
				);
		return $options;

	}

	function element(){
        $iconList = $this->opt('icon_list') ? $this->opt('icon_list') : false;
		$alignment = $this->opt('alignment','left');
		//$columnsClass = $this->opt('columns') ? $this->opt('columns') : 'col-sm-12';
		//$columns = ($columnsClass == 'col-sm-6' ? 2 : ($columnsClass == 'col-sm-4' ? 3 : ($columnsClass == 'col-sm-3' ? 4 : 1)));
        //$list_style = $this->opt('list_style') ? $this->opt('list_style') : '';
        
        
		if ( empty( $iconList ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}

        
		echo '<ul class="zn-icon-list2 reset-list '.$alignment.' '. $this->data['uid'] .'">';
		////$i = 0;
		if (!empty($iconList))
		{
		    foreach ( $iconList as $key => $listItem ) {
		        //$i++;
		        $icon_opt = !empty( $listItem['icon'] ) ? $listItem['icon'] : '';
		        $icon = !empty( $icon_opt['family'] )  ? '<span class="zn_icon_box_icon zn-paragraph-color zn-secondary-hover animation " '.zn_generate_icon( $icon_opt ).'></span>' : '';
		        $link_extracted = zn_extract_link( $listItem['link'] , '' );
		        //$link_text      = !empty( $listItem['link_text'] ) ? '<h4>'.$listItem['link_text'].'</h4>' : '';
				
				echo '<li>'.$link_extracted['start'] .$icon . $link_extracted['end'].'</li>';
		        //** Add a clearfix when the row is complete
		        //if (!($i%$columns))
		        //    echo '<div class="clearfix"></div>';
		    }
		}
		echo '</ul>';

	}
    
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
<?php
/*
	Name: Icon List 1
	Description: This element will generate a simple icon list
	Class: ZnIconList
	Category: content
	Level: 3
*/

class ZnIconList extends ZnElements {

	function options() {

		$options = array(
                            array(
							    'id'          => 'list_style',
							    'name'        => 'List style',
							    'description' => 'Select the desired style for this list.',
							    'type'        => 'select',
							    'std'		  => '',
							    'options'        => array( 'style1' => 'Style 1', 'style2' => 'Style 2', 'style3' => 'Style 3'),
                                'live' => array(
								    'type'		=> 'class',
								    'css_class' => '.'.$this->data['uid']
							    )
						    ),
							//array(
							//    'id'          => 'columns',
							//    'name'        => 'Number of columns',
							//    'description' => 'Select the desired number of columns to use.',
							//    'type'        => 'select',
							//    'std'		  => 'col-sm-12',
							//    'options'        => array( 'col-sm-12' => '1 Column', 'col-sm-6' => '2 Columns', 'col-sm-4' => '3 Columns', 'col-sm-3' => '4 Columns' )
							//),
							//array(
							//    'id'          => 'item_alignment',
							//    'name'        => 'Item alignment',
							//    'description' => 'Select the horizontal alignment of the items.',
							//    'type'        => 'select',
							//    'std'		  => '',
							//    'options'        => array( 'text-left' => 'Left', 'text-center' => 'Center', 'text-right' => 'Right' )
							//),
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
														array(
							                                'id'          => 'link_text',
							                                'name'        => 'Text',
							                                'description' => 'Enter a text for this element',
							                                'type'        => 'text'
						                                ),
						                                array(
							                                'id'          => 'link',
							                                'name'        => 'Button link',
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
		//$columnsClass = $this->opt('columns') ? $this->opt('columns') : 'col-sm-12';
		//$columns = ($columnsClass == 'col-sm-6' ? 2 : ($columnsClass == 'col-sm-4' ? 3 : ($columnsClass == 'col-sm-3' ? 4 : 1)));
        $list_style = $this->opt('list_style') ? $this->opt('list_style') : '';
        
        
		if ( empty( $iconList ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options and create at least one item in the list.</div>';
			return;
		}

        
		echo '<ul class="zn-icon-list '.$list_style.' '. $this->data['uid'] .'">';
		////$i = 0;
		if (!empty($iconList))
		{
		    foreach ( $iconList as $key => $listItem ) {
		        //$i++;
		        $icon_opt = !empty( $listItem['icon'] ) ? $listItem['icon'] : '';
		        $icon = !empty( $icon_opt['family'] )  ? '<span class="zn_icon_box_icon zn-secondary-color" '.zn_generate_icon( $icon_opt ).'></span>' : '';
		        $link_extracted = zn_extract_link( $listItem['link'] , '' );
		        $link_text      = !empty( $listItem['link_text'] ) ? '<h4>'.$listItem['link_text'].'</h4>' : '';
				
				echo '<li>'.$link_extracted['start'] .$icon . $link_text . $link_extracted['end'].'</li>';
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
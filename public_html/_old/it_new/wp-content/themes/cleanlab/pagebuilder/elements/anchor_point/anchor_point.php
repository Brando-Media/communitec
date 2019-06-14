<?php
/*
	Name: Anchor Point
	Description: This element will generate an empty element with an unique ID that can be used as an achor point
	Class: ZnAnchorPoint
	Category: content
	Level: 3
	
*/

	class ZnAnchorPoint extends ZnElements {

    function options() {

		$options = array(
					array (
						'id'          => 'id',
						'name'        => 'ID',
						'description' => 'Please enter an id for this anchor point. You can use this #id for an anchor href.',
                        'std'         => $this->data['uid'],
						'type'        => 'text'
					)
			);

		return $options;

	}

	function element(){
         $element_id = $this->opt('id') ? $this->opt('id') : $this->data['uid'];
			echo '<div id="'.esc_attr( $element_id ).'" class="zn_anchor_point"></div>';
	}
    

	function element_edit() {

		$element_id = $this->opt('id') ? $this->opt('id') : $this->data['uid'];
		echo '<div id="'.esc_attr( $element_id ).'" class="zn_anchor_point">'.$element_id.'</div>';

	}
	}

?>
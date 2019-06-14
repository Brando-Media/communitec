<?php
/*
	Name: Text List
	Description: This element will generate a text box with a title, subtitle and description
	Class: ZnTextList
	Category: content
	Level: 3
	Style: true
	
*/

class ZnTextList extends ZnElements {

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
					    'std'		=> '',
					),
					array(
						'id'          => 'description',
						'name'        => 'Description',
						'description' => 'Please enter a description for this element',
						'type'        => 'visual_editor',
						'class'		=> 'zn_full',
						'std'		=> ''
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
					array(
						'id'          => 'columns',
						'name'        => 'Number of columns',
						'description' => 'Select the desired number of columns for the icon list.',
						'type'        => 'select',
						'std'		  => 'col-sm-12',
						'options'        => array( 'col-sm-12' => '1 Column', 'col-sm-6' => '2 Columns', 'col-sm-4' => '3 Columns', 'col-sm-3' => '4 Columns', 'col-sm-2' => '6 Columns' )
					),
					array(
						'id'          => 'link',
						'name'        => 'Button link',
						'description' => 'Enter a link for this element',
						'type'        => 'link'
					),
					array(
						'id'          => 'link_text',
						'name'        => 'Button text',
						'description' => 'Enter a text for this element\'s button',
						'type'        => 'text',
						'std'		=> ''
					),
				)
			),
			'styling' => array(
				'title' => 'Styling options',
				'options' => array(
					array(
					    'id'          => 'style',
					    'name'        => 'Style',
					    'description' => 'Select a style for this element',
					    'type'        => 'select',
					    'options'	  => array( ''=>'Style 1' , 'style2' => 'Style 2'),
					    'live' => array(
					        'type'		=> 'class',
					        'css_class' => '.'.$this->data['uid']
					    )
					),
					array(
					    'id'          => 'alignment',
					    'name'        => 'Alignment',
					    'description' => 'Select the horizontal alignment.',
					    'type'        => 'select',
					    'std'		  => 'left',
					    'options'        => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
					    'live' => array(
					        'type'		=> 'class',
					        'css_class' => '.'.$this->data['uid'] //.' > div:first-child'
					    )
					),
					array(
						'id'          => 'link_style',
						'name'        => 'Button style',
						'description' => 'Select a style for this button',
						'type'        => 'select',
						'std'		=> 'btn-default',
						'options'	=> zn_get_button_styles(),
						'live' => array(
					        'type'		=> 'class',
					        'css_class' => '.'.$this->data['uid'] .' .btn'
					    )
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
		$title = $this->opt('title')  ? $this->opt('title') : '';
		//$subTitle = $this->opt('subtitle')  ? $this->opt('subtitle') : '';
		$description = $this->opt('description')  ? $this->opt('description') : '';
		$alignment = $this->opt('alignment')  ? $this->opt('alignment') : '';
		$style = $this->opt('style', '');
		$link_text = $this->opt('link_text') ? $this->opt('link_text') : '';
		$link_style = $this->opt('link_style','btn-default');
		$link = zn_extract_link( $this->opt('link') , 'btn '.$link_style );
		$iconList = $this->opt('icon_list', '');
		$columnsClass = $this->opt('columns') ? $this->opt('columns') : 'col-sm-12';
        $columns = ($columnsClass == 'col-sm-6' ? 2 : ($columnsClass == 'col-sm-4' ? 3 : ($columnsClass == 'col-sm-3' ? 4 : ($columnsClass == 'col-sm-2' ? 6 : 1))));
		
		if ( empty($subTitle) && empty($description) && empty($link_text) && empty($iconList) ) {
			echo '<div class="zn-pb-notification row">Please configure the element options!</div>';
			return;
		}
	
		
		?>
		
		<div class="zn_textlist <?php echo $alignment.' '.$style.' '.$this->data['uid']; ?>">
			<?php if (!empty($title)) { ?>
			<h3 class="section-title zn_title"><?php echo $title; ?></h3>
			<?php } ?>
			<?php if (!empty($description)) { ?>
				<div class="zn_description"><?php echo wpautop($description); ?></div>
			<?php } 
			
			$i = 0;
			if (!empty($iconList))
			{
				echo '<div class="row mbottom15">';
				foreach ( $iconList as $key => $listItem ) {
					$i++;
					$icon_opt = !empty( $listItem['icon'] ) ? $listItem['icon'] : '';
					$icon = !empty( $icon_opt['family'] )  ? '<span class="zn-txt-list-icon zn-primary-color" '.zn_generate_icon( $icon_opt ).'></span>' : '';
					$ilink_extracted = zn_extract_link( $listItem['link'] , '' );
					$ilink_text      = !empty( $listItem['link_text'] ) ? '<span class="zn-txt-list-item">'.$listItem['link_text'].'</span>' : '';
				
					echo '<div class="zn-txtlst-item '.$columnsClass.'">'.$ilink_extracted['start'] .$icon . $ilink_text . $ilink_extracted['end'].'</div>';
					//** Add a clearfix when the row is complete
					if (!($i%$columns))
					    echo '<div class="clearfix"></div>';
				}
				echo '</div>';
			}
			
			echo $link['start'] . $link_text . $link['end']; 
			?>
		</div>

		<?php
	}

}

?>
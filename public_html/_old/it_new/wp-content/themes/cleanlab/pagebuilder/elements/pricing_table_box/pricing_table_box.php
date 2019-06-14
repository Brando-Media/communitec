<?php
/*
	Name: Pricing Table Box
	Description: This element will generate a box for a pricing table
	Class: ZnPricingTableBox
	Category: content
	Level: 3
	Styles: true
*/

class ZnPricingTableBox extends ZnElements {

	function options() {
	//global $zn_framework;
	
	//$newStyles = array('' => 'Use section colors', 'defaultStyle' => 'Default Style');
	//$old = $zn_framework->unlimited_styles;
	//unset( $old[''] );
	//$newStyles = array_merge($newStyles,   $old );
	
	$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
						'id'          => 'box_title',
						'name'        => 'Pricing box title',
						'description' => 'Enter a title for this box (ex: Standard)',
						'type'        => 'text'
					),
					array(
						'id'          => 'box_price',
						'name'        => 'Price',
						'description' => 'Enter a price for this box (ex: $23)',
						'type'        => 'text'
					),
					array(
						'id'          => 'box_period',
						'name'        => 'Period',
						'description' => 'Enter a period for this box (ex: /month)',
						'type'        => 'text'
					),
					array(
						'id'         	=> 'rows',
						'name'       	=> 'Rows',
						'description' 	=> 'Here you can add rows to your pricing table box',
						'type'        	=> 'group',
						'sortable'	  	=> true,
						'element_title' => 'text',
						'subelements' 	=> array(
											//array(
											//    'id'          => 'row_type',
											//    'name'        => 'Row type',
											//    'description' => 'Please choose the row type',
											//    'type'        => 'select',
											//    'std'         => '',
											//    'options'	  => array( ''=>'Standard' , 'zn_pb_title zn_pb_title_bkg' => 'Title' , 'zn_pb_subtitle zn_pb_title_bkg' => 'Subtitle', 'zn_pb_description' => 'Description', 'zn_pb_enumeration' => 'Enumeration title'  ),
											//),
											array(
												'id'          => 'text',
												'name'        => 'Text',
												'description' => 'Enter a text for this row.',
												'type'        => 'text'
											),
									)
					),
					array(
						'id'          => 'link',
						'name'        => 'Button link',
						'description' => 'Enter a link for the button',
						'type'        => 'link'
					),
					array(
						'id'          => 'link_text',
						'name'        => 'Button text',
						'description' => 'Enter a text for the button',
						'type'        => 'text'
					),
					array(
						'id'          => 'image',
						'name'        => 'Image',
						'description' => 'Select the image you want to use for this box',
						'type'        => 'media',
						'supports'    => 'id',
						'class'		  => 'zn_full',
						'dependency'  => array( 'element' => 'style' , 'value'=> array('style2') ),
					),
					array(
						'id'            => 'custom_img_size',
						'name'          => 'Custom image size',
						'description'   => 'Select if you want to enter a custom size for the images. If not, full size of each image will be used.',
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => 'yes',
						'dependency'  => array( 'element' => 'style' , 'value'=> array('style2') ),
					),
					array(
						'id'          => 'img_width',
						'name'        => 'Image width',
						'description' => 'Enter the desired image width.',
						'type'        => 'slider',
						'std'		  => '360',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '10',
							'max' => '1920',
							'step' => '1'
						),
						'dependency'  => array( 'element' => 'style' , 'value'=> array('style2') ),
					),
					array(
						'id'          => 'img_height',
						'name'        => 'Image height',
						'description' => 'Enter the desired image height.',
						'type'        => 'slider',
						'std'		  => '250',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '10',
							'max' => '1080',
							'step' => '1'
						),
						'dependency'  => array( 'element' => 'style' , 'value'=> array('style2') ),
					),
				)
			),
			'styling' => array(
				'title' => 'Styling options',
				'options' => array(
					//array(
					//    'id'          => 'link_style',
					//    'name'        => 'Button style',
					//    'description' => 'Select a style for this button',
					//    'type'        => 'select',
					//    'std'		=> 'btn-default',
					//    'options'	=> zn_get_button_styles(),
					//    'live' => array(
					//        'type'		=> 'class',
					//        'css_class' => '.'.$this->data['uid'] .' .btn'
					//    )
					//),
					//array(
					//    'id'          => 'icon',
					//    'name'        => 'Button Icon',
					//    'description' => 'Select an icon for the button',
					//    'type'        => 'icon_list',
					//    'class'		  => 'zn_full'
					//),
					array(
							'id'          => 'style',
							'name'        => 'Element Style',
							'description' => 'Please choose the desired style you want to use. If you choose style 2, return to General options and set the image options.',
							'type'        => 'select',
							'std'		  => 'style1',
							'options'	  => array( 'style1'=>'Style 1 (Color)' , 'style2' => 'Style 2 (Image)' ),
							//'live' => array(
							//    'type'		=> 'class',
							//    'css_class' => '.'.$this->data['uid']
							//)
						),
					array(
						'id'          => 'main_color',
						'name'        => 'Box main color',
						'description' => 'Select a color for this box (leave empty if you wish to use the default primary color).',
						'type'        => 'colorpicker',
						'std'		  => '',
						//'dependency'  => array( 'element' => 'style' , 'value'=> array('style1') ),
					),
					array(
                        "id"            => "scale_hover",
						"name"          => "Scale on hover",
						"description"   => "Choose if you wish to scale up this box on mouse hover.",
						"type"          => "toggle2",
                        "value"         => "scale-hover",
                        "std"           => "scale-hover",
						'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid'] 
							)
					),
					array(
                        "id"            => "highlight",
						"name"          => "Important box",
						"description"   => "Choose if you wish make this box slightly bigger.",
						"type"          => "toggle2",
                        "value"         => "highlight",
                        "std"           => "",
						'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid']
							)
					),
				)
			),
			'misc' => array(
				'title' => 'Miscellaneous',
				'options' => array(
					array(
					    "id"            => "corner",
					    "name"          => "Corner highlight",
					    "description"   => "Choose if you wish apply a text on the top right corner of the box.",
					    "type"          => "toggle2",
					    "value"         => "yes",
					    "std"           => ""
					),
					array(
					    'id'          => 'corner_text',
					    'name'        => 'Corner text',
					    'description' => 'Enter a text for the corner',
					    'type'        => 'text',
					    'dependency' => array( 'element' => 'corner' , 'value'=> array('yes') )
					),
					array(
					    'id'          => 'corner_background',
					    'name'        => 'Corner background color',
					    'description' => 'Select a color for the corner background.',
					    'type'        => 'colorpicker',
					    'std'		  => '#19be57',
					    'dependency' => array( 'element' => 'corner' , 'value'=> array('yes') ),
					    'live' => array(
					        'type'		=> 'css',
					        'css_class' => '.'.$this->data['uid']. ' .corner', 
					        'css_rule'	=> 'background-color',
					        'unit'		=> ''
					    )
					),
				)
			),
		);

		return $options;

	}

	function element(){
		$box_title = $this->opt('box_title', '');
		$box_price = $this->opt('box_price','');
		$box_period = $this->opt('box_period','');
		$rows = $this->opt('rows') ? $this->opt('rows') : false;
		$style = $this->opt('style') ? $this->opt('style') : '';
		$image_src = '';
		if($style === 'style2') {
			$image = $this->opt('image') ? $this->opt('image') : '';
			
			if ($this->opt('custom_img_size') === 'yes') {
				$img_width = $this->opt('img_width', 360);
				$img_height = $this->opt('img_height', 250);
				$image_src = zn_get_image( $image , $img_width, $img_height, array('class' => 'img-responsive ') );
			}
			else {
				$image_src = wp_get_attachment_image( $image, 'full', false, array('class' => 'img-responsive ') );
			}
			
			//$image_src = wp_get_attachment_image( $image, 'full', false, array('class' => 'img-responsive '.$this->data['uid']) );;
		}
		$scale_hover = $this->opt('scale_hover','scale-hover') === 'scale-hover' ? 'scale-hover' : '';
		$highlight = $this->opt('highlight', '') === 'highlight' ? 'highlight' : '';
		//$link_style = $this->opt('link_style','btn-default');
		$link_text = $this->opt('link_text') ? $this->opt('link_text') : '';
		$link = zn_extract_link( $this->opt('link') , 'btn zn-alternative-color zn-alt-col-bg-hover' );
		
		$corner = $this->opt('corner') ? $this->opt('corner') : '';
		$corner_text = $this->opt('corner_text') ? $this->opt('corner_text') : '';		
		
		if ( empty( $rows ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}
		
	?>

	
    <div class="pricing-table animateFast <?php echo $scale_hover.' '.$highlight.' '.$style.' '.$this->data['uid']; ?>">
		<?php 
		if ($corner == 'yes'){
		    echo '<div class="zn_corner"></div>';
		    echo '<div class="zn-alternative-color zn_corner_text">'.$corner_text.'</div>';
		}
		?>
		<div class="pricing-header">
			<?php if ($style === 'style2') { 
				echo $image_src; 
			} else { ?>
			<h3 class="zn-alternative-color"><?php echo $box_title; ?></h3>
			<div class="price zn-alternative-color-bg">
				<span class="price-value zn-secondary-color"><?php echo $box_price; ?></span>
				<span class="period zn-paragraph-color"><?php echo $box_period; ?></span>
			</div>
			<?php } ?>
		</div>
		<ul class="reset-list">
		<?php
			if ($style === 'style2') { ?>
				<li class="title zn-alternative-bkg">
					<h3 class="zn-secondary-color"><?php echo $box_title; ?></h3>
					<p class="price-value zn-secondary-color">
						<span class="price-value zn-secondary-color"><?php echo $box_price; ?></span>
						<span class="period zn-paragraph-color"><?php echo $box_period; ?></span>
					</p>
				</li>
			<?php }
			$i=0;
			foreach ( $rows as $key => $myRow ) {
				$row_text = !empty( $myRow['text'] ) ? $myRow['text'] : '';
				$row_class= ($style !== 'style2' && $i%2==0 && $i>0 ? 'zn-alternative-bkg' : 'zn-background-color');
				echo '<li class="'.$row_class.'">'.$row_text.'</li>';
				$i++;
			}
			if (!empty($link_text)){
				echo '<li class="order zn-alternative-bkg">' .$link['start'] . $link_text . $link['end'] . '</li>';
			}
		?>
		</ul>
    </div>
	<?php
	}
	
	
	function css(){
		global $zn_framework;
        $css = '';
        $uid = $this->data['uid'];
		$style = $this->opt('style') ? $this->opt('style') : '';
		//$main_color = $this->opt('main_color') ? ' '.$this->opt('main_color').' ' : '';
		$main_color = $this->opt('main_color','');
		
		if (empty($main_color)) { //** Set the default primay color as main color
				$allStyles = zget_option( 'custom_colors' , 'style_options' );
		        foreach ($allStyles as $currentStyle) {
		            if ($currentStyle['custom_style_name'] === 'Default Colors'){
		                $main_color = $currentStyle['primary_color'];
		                break;
		            }
		        }
		}
		
		$main_color2 = adjustBrightnessByStep($main_color, 26);
		
		$corner_background = $this->opt('corner_background') ? $this->opt('corner_background') : $main_color2;
		
		$bkg_gradient_str = "
				.$uid.pricing-table .pricing-header {
				background: $main_color; /* Old browsers */
				background: -moz-linear-gradient(-45deg,  $main_color2 0%, $main_color2 41%, $main_color2 41%, $main_color 41%, $main_color 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,$main_color2), color-stop(41%,$main_color2), color-stop(41%,$main_color2), color-stop(41%,$main_color), color-stop(100%,$main_color)); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(-45deg,  $main_color2 0%,$main_color2 41%,$main_color2 41%,$main_color 41%,$main_color 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(-45deg,  $main_color2 0%,$main_color2 41%,$main_color2 41%,$main_color 41%,$main_color 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(-45deg,  $main_color2 0%,$main_color2 41%,$main_color2 41%,$main_color 41%,$main_color 100%); /* IE10+ */
				background: linear-gradient(148deg,  $main_color2 0%,$main_color2 41%,$main_color2 41%,$main_color 41%,$main_color 100%); /* W3C */
			}";
		
		$css .= $bkg_gradient_str;
		$css .= ".$uid .btn {background-color: $main_color;}";
		$css .= ".$uid .btn:hover, .$uid.style2 ul li:before {color: $main_color; }";
		$css .= ".$uid .zn_corner {border-bottom-color: $corner_background;}";
		
		$css .= "";
		return $css;
	}

}


?>
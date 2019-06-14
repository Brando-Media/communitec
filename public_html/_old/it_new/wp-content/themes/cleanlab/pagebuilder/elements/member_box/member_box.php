<?php
/*
	Name: Member Box
	Description: This element will generate a team member box.
	Class: ZnMemberBox
	Category: content
	Level: 3
    Style: true
*/

class ZnMemberBox extends ZnElements {

	function options() {
        $options = array(
                        array(
                            'id'          => 'avatar',
							'name'        => 'Image',
							'description' => 'Please select an image for this box',
							'type'        => 'media',
                            'class'       => 'zn_full',
							'supports'	  => 'id'
						),
                        array(
                            'id'            => 'title',
                            'name'          => 'Title',
                            'description'   => 'Enter a title for the member box',
                            'type'          => 'text'
                        ),
                        array(
                            'id'            => 'subtitle',
                            'name'          => 'Subtitle',
                            'description'   => 'Enter a subtitle for the member box',
                            'type'          => 'textarea'
                        ),
						array(
							'id'          => 'member_link',
							'name'        => 'Member page',
							'description' => 'Enter a link for this member',
							'type'        => 'link'
						),
						array(
							'id'          => 'link',
							'name'        => 'Button link',
							'description' => 'Enter a link for this element\'s button',
							'type'        => 'link'
						),
						array(
							'id'          => 'link_text',
							'name'        => 'Button text',
							'description' => 'Enter a text for this element\'s button',
							'type'        => 'text',
							'std'		=> ''
						),
						array(
							'id'          => 'link_style',
							'name'        => 'Button style',
							'description' => 'Select a style for this button',
							'type'        => 'select',
							'std'		=> 'zn_btn_simple',
							'options'	=> zn_get_button_styles(),
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$this->data['uid'] .' .btn'
							)
						),
						array(
							'id'          => 'style',
							'name'        => 'Style',
							'description' => 'Select a style for this element',
							'type'        => 'select',
							'options'	  => array( ''=>'Style 1' , 'style2' => 'Style 2'),
							//'live' => array(
							//    'type'		=> 'class',
							//    'css_class' => '.'.$this->data['uid']
							//)
						),
						array(
							'id'          => 'hover_text1',
							'name'        => 'Hover text 1',
							'description' => 'Enter a text to use as hover text 1 for style 2',
							'type'        => 'text',
							'std'		  => '',
							'dependency'  => array( 'element' => 'style' , 'value'=> array('style2') )
						),
						array(
							'id'          => 'hover_text2',
							'name'        => 'Hover text 2',
							'description' => 'Enter a text to use as hover text 2 for style 2',
							'type'        => 'text',
							'std'		  => '',
							'dependency'  => array( 'element' => 'style' , 'value'=> array('style2') )
						),
			        );

		return $options;

	}

	function element(){


		global $zn_framework;
        
		$style = $this->opt('style', '');
        $avatar = $this->opt('avatar') ? $this->opt('avatar') : '';
        $title = $this->opt('title') ? $this->opt('title') : '';
        $subtitle = $this->opt('subtitle') ? $this->opt('subtitle') : '';
		$member_link = zn_extract_link($this->opt('member_link'));
        $link_text = $this->opt('link_text') ? $this->opt('link_text') : '';
		$link_style = $this->opt('link_style','btn-default');
		$link = zn_extract_link( $this->opt('link') , 'btn '.$link_style );
		$hover_text1 = $this->opt('hover_text1');
		$hover_text2 = $this->opt('hover_text2');
        
		if (empty($title) && empty($subtitle) && empty($avatar))
		{
			echo '<div class="zn-pb-notification">Please configure the element options.</div>';
			return;
		}
		
	?>
        <div class="memberBox text-center <?php echo $this->data['uid'].' '.$style;?>">
        <?php 
        if (!empty($avatar)) 
			if ($style === 'style2') {
			?>	
			<div class="imgContainer borderEffectHover growEffectHover">
				<?php echo zn_get_image($avatar, 245, 245, array('class' => "img-responsive"));  ?>
				<div class="first_overlay borderEffect"></div>
				<div class="second_overlay growEffect zn-alternative-color">
					<h3 class="zn-alternative-color"><?php echo $hover_text1; ?></h3>
					<p><?php echo $hover_text2; ?></p>
					<?php echo $link['start'] . $link_text . $link['end']; ?>
				</div>
			</div>
			<?php
			}
			else {
				echo $member_link['start'];
				echo zn_get_image($avatar, 245, 245, array('class' => "img-responsive"));
				echo $member_link['end'];
			}
        ?>
			<?php echo $member_link['start']; ?>
            <h4 class="title zn-secondary-color"><?php echo $title; ?></h4>
			<?php echo $member_link['end'];  ?>
            <div class="description zn-paragraph-color"><?php echo $subtitle; ?></div>
			<div class="link">
			<?php if ($style === '') {
				echo $link['start'] . $link_text . $link['end']; 
				}?>
			</div>
        </div>
	<?php
	}

    
}


?>
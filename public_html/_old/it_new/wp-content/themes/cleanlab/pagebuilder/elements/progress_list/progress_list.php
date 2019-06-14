<?php
/*
	Name: Progress List
	Description: This element will generate a list of progress bars
	Class: ZnProgressList
	Category: content
	Level: 3
	Styles: true
*/

class ZnProgressList extends ZnElements {

	function options() {

		$options = array(
                            array(
                                'id'            => 'list_title',
                                'name'          => 'Title',
                                'description'   => 'Enter a title for your list.',
                                'type'          => 'text'
                                 ),
                            array(
							    'id'          => 'title_alignment',
							    'name'        => 'Title alignment',
							    'description' => 'Select the horizontal alignment of the title.',
							    'type'        => 'select',
							    'std'		  => 'text-left',
							    'options'        => array( 'text-left' => 'Left', 'text-center' => 'Center', 'text-right' => 'Right' ),
                                'live' => array(
								    'type'		=> 'class',
								    'css_class' => '.'.$this->data['uid'] .' > .zn_title'
							    )
						    ),
                            array(
							    'id'          => 'columns',
							    'name'        => 'Number of columns',
							    'description' => 'Select the desired number of columns to use.',
							    'type'        => 'select',
							    'std'		  => 'col-sm-12',
							    'options'        => array( 'col-sm-12' => '1 Column', 'col-sm-6' => '2 Columns', 'col-sm-4' => '3 Columns', 'col-sm-3' => '4 Columns' )
						    ),
							array(
							    'id'         	=> 'progress_list',
							    'name'       	=> 'Progress Bar List',
							    'description' 	=> 'Here you can add a list of progress bars',
							    'type'        	=> 'group',
							    'sortable'	  	=> true,
							    'element_title' => 'progress_text',
							    'subelements' 	=> array(
						                                array(
							                                'id'          => 'progress_text',
							                                'name'        => 'Progress bar text',
							                                'description' => 'Enter a text for this element',
							                                'type'        => 'text'
						                                ),
                                                        array(
						                                    'id'          => 'progress_percent',
						                                    'name'        => 'Progress bar percent',
						                                    'description' => 'Set the fill percent of the progress bar.',
						                                    'type'        => 'slider',
						                                    'std'		  => '90',
						                                    'class'		  => 'zn_full',
						                                    'helpers'	  => array(
							                                    'min' => '0',
							                                    'max' => '100',
							                                    'step' => '1'
						                                    )
											            ),
														array(
															'id'          => 'progress_color',
															'name'        => 'Progress color',
															'description' => 'Please select a color for the progress foreground color',
															'type'        => 'colorpicker',
															'std'         => '#ff525e'
														),
						                            )
                            ),
                            
				);
		return $options;

	}

	function element(){
        $progressList = $this->opt('progress_list') ? $this->opt('progress_list') : false;
        $listTitle = $this->opt('list_title') ? $this->opt('list_title') : '';
        $columns = $this->opt('columns') ? $this->opt('columns') : 'col-sm-12';
        $columnsNo = ($columns == 'col-sm-6' ? 2 : ($columns == 'col-sm-4' ? 3 : ($columns == 'col-sm-3' ? 4 : 1)));
        $titleAlignment = $this->opt('title_alignment') ? $this->opt('title_alignment') : 'text-left';
        
		if ( empty( $progressList ) && empty($listTitle)) {
			echo '<div class="zn-pb-notification">Please configure the element options and create at least one item in the list.</div>';
			return;
		}

        
        echo '<div class="progress_bar_list row ' . $this->data['uid'] .'">';
        if(!empty($listTitle)) echo '<h3 class="col-sm-12 zn_title '.$titleAlignment.'">'.$listTitle.'</h3>';
        $i = 0;
        if (!empty($progressList))
		foreach ( $progressList as $key => $listItem ) {
            $i++;
            $progressText = !empty( $listItem['progress_text'] ) ? $listItem['progress_text'] : '';
            $progressPercent = !empty( $listItem['progress_percent'] ) ? $listItem['progress_percent'] : '0';
			$bkgColor = !empty($listItem['progress_color']) ? $listItem['progress_color'] : '#ff525e';
            
            echo '<div class="'.$columns.'">';
            echo '<h6>'.$progressText.'</h6>';
            ?>
            <div class="progress zn-alternative-bkg">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo esc_attr( $progressPercent ); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo esc_attr( $progressPercent ); ?>%; background-color: <?php echo esc_Attr( $bkgColor ); ?>;">
					<?php echo $progressPercent; ?>%
                </div>
            </div>
            <?php
            echo '</div>';
            //** Add a clearfix when the row is complete
            if (!($i%$columnsNo))
                echo '<div class="clearfix"></div>';                        
		}
        echo '</div>';

	}
    
}

?>
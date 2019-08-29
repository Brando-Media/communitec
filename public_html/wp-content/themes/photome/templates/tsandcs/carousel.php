<?php
$services    = get_sub_field('services');
$title = get_sub_field('title');
$buttonname = get_sub_field('button_name');
$first = 0;
?>
<div id="page_content_wrapper" class=" ">
    <div class="inner">
    	<div class="inner_wrapper">
    		<div class="sidebar_content full_width">
    <div id="page_content_wrapper" class=" ">
        <div class="inner">
            <div class="inner_wrapper">
                <div class="sidebar_content full_width">
                    <div>
                        <button class="accordiond"><?php echo $buttonname; ?></button>
                            <div class="paneld">
                                <?php foreach($services as $servicerow){ ?>   
                                    <div style="font-weight:bold; margin-top:15px;"> <?php echo $servicerow['heading'];  ?> </div>
                                    <div style="margin-left:15px;"> <?php echo $servicerow['text_field'] ?> </div>
                                <?php } ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div></div></div></div>
<?php

if( empty($data) ) {

	if ( empty( ZN()->theme_data['options_prefix'] ) ) {
		return false;
	}
	$data = get_option( ZN()->theme_data['options_prefix'] );
}

/*--------------------------------------------------------------------------------------------------
Start Fonts options
--------------------------------------------------------------------------------------------------*/
// Body fonts
if ( $body_font = $data['font_options']['body_fonts'] ) {
	echo "body { font-family:$body_font, Helvetica, Arial, sans-serif; }";
}

// header fonts
if ( $header_font = $data['font_options']['header_fonts'] ) {
	echo "header#header { font-family:$header_font, Helvetica, Arial, sans-serif; }";
}

/** RESPONSIVE MENU TRIGGER */
$menu_trigger = !empty($data['general_options']['header_res_width']) ? $data['general_options']['header_res_width'] : 994;
$menu_trigger2 = $menu_trigger + 1;
echo "
@media (max-width: {$menu_trigger}px) {
	#main-menu { display: none !important;}
}
@media (min-width: {$menu_trigger2}px) {
	.zn-res-menuwrapper { display: none;}
}
";

// PAGE PRELOADER 
if ( $preloader_image = $data['general_options']['preloader_image'] ) {
	$url = preg_replace('#^https?://#', '//', $preloader_image);
	echo ".zn_page_preloader > div { background-image: url($url) }";
}

/*--------------------------------------------------------------------------------------------------
Boxed layout background
--------------------------------------------------------------------------------------------------*/
if ( 'yes' == $data['general_options']['use_boxed_layout'] ){
	if (  $boxed_bg = $data['general_options']['boxed_bg'] ) {

		if ( $boxed_bg && !empty( $boxed_bg['image'] ) ){
			$background_image = "background-image: url('".$boxed_bg['image']."');";
			$background_image .= 'background-repeat:'. $boxed_bg['repeat'].';';
			$background_image .= 'background-position:'. $boxed_bg['position']['x'].' '.$boxed_bg['position']['y'].';';
			$background_image .= 'background-attachment:'. $boxed_bg['attachment'].';';
			if (!empty($boxed_bg['size'])) {
				$background_image .= 'background-size:'. $boxed_bg['size'].';';
			}

			echo "body{ $background_image }";

		}
		
	}
}


//** Hover color for social icons from hidden bar
if ( $hb_social_list = $data['general_options']['hiddenbar_social']){
	$i = 0;
	foreach($hb_social_list as $listItem) {
		echo '#panel ul.info-right li.zn_hb_icon_'.$i++.':hover {background-color: '.$listItem['hover_color'].'}';
	}
}

/*--------------------------------------------------------------------------------------------------
Start HEADER HEIGHT
--------------------------------------------------------------------------------------------------*/
$header_height = zget_option( 'header_height' , 'general_options', false, 110 );
$header_height = is_numeric( $header_height ) ? $header_height : 110;
$scroll_header_layout = zget_option( 'scroll_header_layout' , 'general_options', false, 'zn_hide_show' );
$offset = 0;
// CHECK TO SEE IF WE HAVE THE HIDDEN BAR
if ( zget_option( 'show_hiddenbar' , 'general_options' ) == 'yes' ){
	$offset = '4'; // Default header top border
}

echo "
	#header .zn-header-icon, #header #main-menu>ul>li>a, #header #logo a { height: ".$header_height."px;line-height: ".$header_height."px; }
";

/* STYLE 1, 3, 5 */
if ( $scroll_header_layout != 'zn_do_not_follow zn_do_not_hide' ) {
	echo "
		#header.header1+#content { margin-top: ".($header_height+$offset)."px; }
		#header.header2+#content { margin-top: ".($header_height+$offset+36)."px; }
		#header.header3+#content { margin-top: ".($header_height+$offset+49)."px; }
		#header.header4+#content { margin-top: ".($header_height+$offset+89)."px; }
	";
}


SetDynamic_menu_colors($data['style_options']);




/*--------------------------------------------------------------------------------------------------
Start Unlimited colors
--------------------------------------------------------------------------------------------------*/
foreach ( $data['style_options']['custom_colors'] as $key => $style ) {
	extract($style);

	if( !empty( $custom_style_name ) ){
		if ( $custom_style_name == 'Default Colors' ) {
			$style_name = '.page_content'; // Clear for default colors
			SetDefaultStaticColors($style);
		}
		else{
			//$style_name = '.zn_us_' . strtolower ( str_replace(' ','_',$custom_style_name ) );
			$style_name = '.zn_cs_' . preg_replace("/[^a-zA-Z0-9]+/", "", $custom_style_name);
		}
	}
	else{ continue; }
	
	SetDynamic_primary_color($primary_color, $style_name);
	SetDynamic_secondary_color($secondary_color, $style_name);
	SetDynamic_alternative_color($alternative_color, $style_name);
	SetDynamic_background_color($section_background, $style_name);
	SetDynamic_alternative_background_color($section_alt_background, $style_name);
	SetDynamic_default_paragraph_color($text_color, $style_name);
	SetDynamic_default_borders_color($borders_color, $style_name);

}

/* SET MAINTENANCE MODE PAGE COLORS */
if ( $maintenance_bg = $data['style_options']['maintenance_mode_color'] ) {
	echo ".zn_maintenance_boxes_container { background-color: $maintenance_bg;  }";
}

if ( isset( $data['maintenance_mode']['maintenance_bg'] ) ) {
	$maintenance_bg_image = $data['maintenance_mode']['maintenance_bg'];
	if ( !empty( $maintenance_bg_image['image'] ) ){
		$background_image = "background-image: url('".$maintenance_bg_image['image']."');";
		$background_image .= 'background-repeat:'. $maintenance_bg_image['repeat'].';';
		$background_image .= 'background-position:'. $maintenance_bg_image['position']['x'].' '.$maintenance_bg_image['position']['y'].';';
		$background_image .= 'background-attachment:'. $maintenance_bg_image['attachment'].';';
		if (!empty($maintenance_bg_image['size'])) {
			$background_image .= 'background-size:'. $maintenance_bg_image['size'].';';
		}

		echo ".zn_maintenance_boxes_container { $background_image }";

	}
}


///////////////////////////////////////////////////////////////////////
//** THIS WILL RUN ONLY FOR DEFAULT COLORS

function SetDefaultStaticColors($style){
	extract($style);

	// COMING SOON OPTIONS
	echo "
		.zn_coming_soon_page #countdown span { color:$primary_color;border: solid 1px $primary_color; }
	";

	/* SET MAINTENANCE MODE PAGE COLORS */
	echo "
		.page_content .zn_maintenance_boxes_container { border-top: solid 7px $primary_color; }
	";

}

///////////////////////////////////////////////////////////////////////
//** FUNCTIONS

function SetDynamic_menu_colors($style_options){

	/////////////////////////////////////////////
	///// MENU COLORS

	$sliding_background	= isset($style_options['sliding_background'])	? $style_options['sliding_background']	: '#ff525e';
	$sliding_color		= isset($style_options['sliding_color'])		? $style_options['sliding_color']		: '#FFFFFF';
	$menu_background	= isset($style_options['menu_background'])		? $style_options['menu_background']		: '#FFFFFF';
	$menu_color			= isset($style_options['menu_color'])			? $style_options['menu_color']			: '#bababa';
	$switcher = 1; //** Use to lighten or darken the color
	if (adjustBrightness($menu_color,70) == "#000000"){
		//** If the menu color darken by 70% becomes black, then lighten all colors; else darken them.
		$switcher = -1;
	}
	$menu_hover_color	= isset($style_options['menu_hover_color'])		? $style_options['menu_hover_color']	: '#3d3d3d';
	if (isset($style_options['autogenerate_menu_colors']) && $style_options['autogenerate_menu_colors'] == 'yes') {
		$menu_hover_color	= adjustBrightness($menu_color, $switcher*67.2);
	}
	$switcher = 1;
	if (adjustBrightness($menu_background, 10) == "#000000"){
		//** If the menu color darken by 70% becomes black, then lighten all colors; else darken them.
		$switcher = -1;
	}
	$menu_subitems_background	= isset($style_options['menu_subitems_background'])	? $style_options['menu_subitems_background']	: '#fafafa';
	if (isset($style_options['autogenerate_menu_colors']) && $style_options['autogenerate_menu_colors'] == 'yes') {
		$menu_subitems_background = adjustBrightness($menu_background, $switcher*1.96);
	}
	$menu_active_background	= isset($style_options['menu_active_background'])	? $style_options['menu_active_background']	: '#f4f4f4';
	if (isset($style_options['autogenerate_menu_colors']) && $style_options['autogenerate_menu_colors'] == 'yes') {
		$menu_active_background	= adjustBrightness($menu_background, $switcher*4.31);
	}
	$menu_border_color	= isset($style_options['menu_border_color'])	? $style_options['menu_border_color']	: '#eeeeee';
	if (isset($style_options['autogenerate_menu_colors']) && $style_options['autogenerate_menu_colors'] == 'yes') {
		$menu_border_color = adjustBrightness($menu_background, $switcher*6.66);
	}
	//** Calculate color with alpha opacity for social icons (x,y,z,0.5)
	$sliding_social_bakground = zn_hex2rgba_str($sliding_color, 50);
	//** Calculate color for back to top button bottom margin
	$sliding_background_darker = adjustBrightnessByStep($sliding_background, -39);

	/* MENU BACKGROUND */
	echo " 
		#header, #main-menu .zn_mega_container,
		#zn-res-menu,
		#zn-res-menu li ul.sub-menu,
		#zn-res-menu li div.zn_mega_container
		{background-color: $menu_background;}
	";
	
	

	/* MENU COLOR */
	echo "
		#main-menu a, #header .searchBox,
		#zn-res-menu a,
		#zn-res-menu .zn_res_submenu_trigger 
		{color: $menu_color}
	";

	/* SLIDING PANNEL BACKGROUND */
	echo "
		#infocard, #panel, .slide span, #back-top, #cart .cart-container .checkout, #main-menu ul .zn-mega-new-item {background-color:$sliding_background}
		#header .slide {border-top-color: $sliding_background}
		#cart .cart-container .close-btn {color: $sliding_background;}
		#main-menu ul ul li:hover > a, #main-menu ul ul li.current-menu-parent a, #main-menu ul ul li.current-menu-item a, #main-menu ul .zn-mega-new-item:before  {border-right-color:$sliding_background}
		#main-menu .zn_mega_container, #main-menu ul > li > ul.sub-menu { border-top:3px solid $sliding_background}
		#main-menu ul ul.sub-menu li:hover > a, #main-menu ul ul.sub-menu li.active a {
			border-right: solid 3px $sliding_background;
		}
	";

	/* SLIDING BACKGROUND DARKER */
	echo "#back-top {border-bottom-color:$sliding_background_darker;}";

	/* MENU HOVER COLOR */
	echo "
		#main-menu li:hover > a,
		#main-menu ul ul li a,
		#main-menu ul ul li a:not(:only-child):after,
		#main-menu li.current-menu-ancestor > a,
		#main-menu li.current-menu-item > a,
		#main-menu ul ul li.current-menu-parent a, 
		#main-menu ul ul li.current-menu-item a,
		.searchPanel > span,
		#cart > span,
		.zn_header_dropdown > .zn_header_dropdown_trigger,
		#zn-res-menu li.current-menu-item > a,
		#zn-res-menu li:hover > a
		{color: $menu_hover_color}
	";

	echo	".zn-res-menuwrapper .zn-res-trigger:after {background-color:$menu_hover_color}";
	echo	".zn-res-menuwrapper .zn-res-trigger:after {box-shadow: 0 8px 0 $menu_hover_color, 0 16px 0 $menu_hover_color;}";
	echo	"#panel ul.info-left a, #panel ul.info-left li, #panel ul.info-right li span,
	#panel, .slide span, #infocard, #infocard h2, #infocard .info-social li a, #back-top a, #main-menu ul .zn-mega-new-item {color : $sliding_color}";
	echo	"#panel ul.info-right li {background-color: $sliding_social_bakground}";
	echo	"#main-menu ul ul.sub-menu li a {background-color: $menu_subitems_background;}";
	
	echo	"
		#main-menu ul ul.sub-menu li:hover > a,
		#main-menu ul ul.sub-menu li.current-menu-parent a,
		#main-menu ul ul.sub-menu li.current-menu-item a,
		#cart .cart-container .total
		{ background-color: $menu_active_background; }
	";
	echo	"#main-menu ul ul li a {border-bottom-color: $menu_border_color;}";
	echo 	".page_content #zn-res-menu * { border-color: $menu_border_color;}";

	/* MEGAMENU WRAPPER */
	echo "
		#main-menu .zn_mega_container li a:before { background: $menu_color; }
		#main-menu .zn_mega_container li a:hover:before,#main-menu .zn_mega_container li.current-menu-item > a:before { background: $sliding_background; }
		#main-menu .zn_mega_container li.current-menu-item > a { color: $sliding_background; }
	";

	/* Search box */
	echo "#header .searchBox {background-color: $menu_background; border-color: $menu_subitems_background; color: $menu_hover_color; }";
	echo "#header .searchBox::-webkit-input-placeholder {color: $menu_color;} 
		  #header .searchBox:-moz-placeholder { color: $menu_color; }
		  #header .searchBox::-moz-placeholder { color: $menu_color; } 
		  #header .searchBox:-ms-input-placeholder {  color: $menu_color; }";
	echo "#header .searchPanel .searchForm:after {border-bottom-color: $menu_background;}";
	echo "#header .searchPanel .searchForm:before {border-bottom-color: $menu_subitems_background;}";

	/* GENERAL DROPDOWN */
	echo " #header .zn_header_dropdown_holder { background-color: $menu_background; color: $menu_hover_color; border-color: $menu_border_color; } ";
	echo "#header .zn_header_dropdown .zn_header_dropdown_holder:after {border-bottom-color: $menu_background;}";
	echo "#header .zn_header_dropdown .zn_header_dropdown_holder:before {border-bottom-color: $menu_subitems_background;}";
	echo ".zn_language_switcher .zn_header_dropdown_holder li a.zn_active_language, .zn_language_switcher .zn_header_dropdown_holder li a:hover { background-color: $menu_active_background; }";
// 

	//echo "/*---DEBUG---*/".
	//    "/*menu_color: $menu_color ".
	//    "menu_hover_color $menu_hover_color (#3d3d3d)".
	//    "menu_background: $menu_background".
	//    "menu_subitems_background $menu_subitems_background (#fafafa)".
	//    "menu_active_background $menu_active_background (#f4f4f4)".
	//    "menu_border_color $menu_border_color (#eeeeee)".
	//    "*/";


	///// END MENU COLORS
	/////////////////////////////////////////////

}


function SetDynamic_primary_color($color, $style_name) {

	//** color
	//** #ff525e
	echo " 
		$style_name .zn-primary-color, 
		$style_name .zn-primary-hover:hover,
		$style_name .services-box span, 
		$style_name .news-boxes span,
		$style_name .tcolor,
		$style_name a.tcolor,$style_name .tcolor > a,
		$style_name .pagination > li:first-child > a, 
		$style_name .pagination > li:last-child > a,
		$style_name .widget_nav_menu ul li:before, 
		$style_name .widget_pages ul li:before,
		$style_name .testimonials3-carousel.style3 .item blockquote:before,
		$style_name .zn-collapsible.style2 .panel-title > a:not(.collapsed):after,
		$style_name .breadcrumbs li:after,
		$style_name .zn_tabList.simple .nav-tabs > li.active > a
		{ color: $color; }
	";

	//** border-bottom-color
	//** #ff525e
	echo "
		$style_name .news-boxes span:first-child, 
		$style_name .feedback-box:hover,
		$style_name .zn_textbox.style4
		{border-bottom-color: $color; }
	";
	
	//** border-top-color
	//** #ff525e
	echo "
		$style_name .feedback-box:hover:before,
		$style_name .zn_callToAction.style6
		{border-top-color: $color;}
	";
	
	//** border-color
	//** #ff525e
	echo "
		$style_name .zn_owl_carousel.hollowNav .owl-buttons .owl-prev i:hover, 
		$style_name .zn_owl_carousel.hollowNav .owl-buttons .owl-next i:hover,
		$style_name .tagcloud a:hover,
		$style_name .tp-leftarrow.default:hover, 
		$style_name .tp-rightarrow.default:hover,
		$style_name .social-member-carousel span
		{border-color: $color }
	";
	
	//** background-color
	//** #ff525e
	//** Am scos linia asta pt ca facea override la stilul generat pt team members
	//$style_name li[class^='zn_mi_']:hover, $style_name li[class*=' zn_mi_']:hover,
	echo "
		$style_name .filters-nav ul li a.filter-item.is-active, 
		$style_name .zn-primary-as-bg,
		$style_name .zn-primary-as-bg-hover:hover,
		
		$style_name .zn_owl_carousel.hollowNav .owl-buttons .owl-prev i:hover, 
		$style_name .zn_owl_carousel.hollowNav .owl-buttons .owl-next i:hover,
		$style_name .btn-default,
		$style_name input[type=submit], $style_name input[type=reset],
		$style_name button:not(.zn_btn_simple):not(.zn_btn_style2),
		$style_name .blog-post .testimonials5 .item,
		$style_name .zn_owl_carousel.solidNav .owl-buttons .owl-prev i:hover,
		$style_name .zn_owl_carousel.solidNav .owl-buttons .owl-next i:hover,
		$style_name .zn_owl_carousel.solidNav .owl-buttons .owl-prev i,
		$style_name .zn_owl_carousel.solidNav .owl-buttons .owl-next i,
		$style_name #wp-calendar tbody td#today,
		$style_name .tagcloud a:hover,
		$style_name .tp-leftarrow.default:hover, 
		$style_name .tp-rightarrow.default:hover,
		$style_name input[type=\"checkbox\"]:checked,
		$style_name #sub-header,
		$style_name .zn_btn_3d, $style_name .zn_btn_3d:hover,
		$style_name .owl-theme .owl-controls .owl-page.active span,
		$style_name .owl-theme .owl-controls.clickable .owl-page:hover span,
		$style_name .services-box.style5 > span:after,
		$style_name .zn_tabList.colored .nav-tabs > li.active > a,
		$style_name .social-member-carousel span:hover,
		$style_name .ibox2.style5 .ibox-icon,
		$style_name .zn-collapsible .panel-title > a:after,
		$style_name .zn_textbox.style5 .zn_description:after,
		$style_name .zn-collapsible.style2 .panel-title > a:not(.collapsed),
		$style_name .services-box.style11:hover
		{background-color:$color;}
	";
	
	echo "$style_name ::selection { background: $color;}
		  $style_name	::-moz-selection { background: $color;}";

	echo "
		$style_name blockquote { border-left:5px solid $color; }
	";	
	echo "
		$style_name blockquote.qleft {border-right:5px solid $color;}
	";

	//** BORDER TOP COLOR
	echo "
		footer#footer".($style_name===".page_content" ? "" : $style_name).
		"{border-top: 6px solid $color;}
	";

	$darker_primary_color = adjustBrightnessByStep($color, -51);
	echo "
		$style_name .filters-nav ul li a.filter-item.is-active,
		$style_name .zn_owl_carousel.solidNav .owl-buttons .owl-prev i:active,
		$style_name .zn_owl_carousel.solidNav .owl-buttons .owl-prev i,
		$style_name .zn_owl_carousel.solidNav .owl-buttons .owl-next i:active,
		$style_name .zn_owl_carousel.solidNav .owl-buttons .owl-next i
		{border-color:$darker_primary_color;}";
	
	echo "
		$style_name .zn_btn_3d		 { box-shadow: 0 4px $darker_primary_color; }
		$style_name .zn_btn_3d:hover { box-shadow: 0 2px $darker_primary_color; }
	";
	
	echo "
		$style_name .zn_tabList.colored .nav-tabs > li.active > a,
		$style_name .zn_tabList.colored .nav-tabs > li.active > a:hover,
		$style_name .timer-box
		{border-bottom-color: $darker_primary_color;}
	";
	
	$colorTransparent = zn_hex2rgba_str($color, 50);
	echo "
		$style_name .news-big .overlay figcaption
		{background-color: $colorTransparent;}
	";
	
	$colorTransparent2 = zn_hex2rgba_str($color, 72);
	echo "
		$style_name .memberBox.style2 .second_overlay,
		$style_name .zn_portfolio_all.ostyle2 .overlay-effect figcaption,
		$style_name .zn-portfolio-wrapper article .second_overlay
		{background-color: $colorTransparent2;}
	";
}

function SetDynamic_secondary_color($color, $style_name) {

	echo "
		$style_name h1,$style_name h2,$style_name h3,$style_name h4,$style_name h5,$style_name h6, 
		$style_name a, $style_name .zn_btn_simple,
		$style_name .zn-secondary-color, 
		$style_name .zn-secondary-hover:hover,
		$style_name .zn-portfolio-filters ul li a.filter-item,
		$style_name .zn_owl_carousel.hollowNav .owl-buttons .owl-prev i,
		$style_name .zn_owl_carousel.hollowNav .owl-buttons .owl-next i,
		$style_name .header-breadcrumb ul li.active,
		$style_name.header-breadcrumb ul li.active,
		$style_name .pagination > .active > a:hover, 
		$style_name .pagination > .active > span:hover,
		$style_name .pagination > .active > a, 
		$style_name .pagination > .active > span,
		$style_name .zn_btn_3d,
		$style_name .testimonials-carousel .item blockquote,
		$style_name .zn-primary-as-bg .tcolor,
		$style_name .zn_owl_carousel.solidNav2 .owl-buttons .owl-prev,
		$style_name .zn_owl_carousel.solidNav2 .owl-buttons .owl-next,
		$style_name .services-box.style11 > p
		{ color:$color;}";
		
	/** DARKER COLOR FOR HOVERS ( #000000 ) **/ 
	$darker_secondary_color = adjustBrightnessByStep($color, -61);
	echo "
		$style_name a:hover, 
		$style_name a:focus, 
		$style_name .darker_secondary_color,
		$style_name .zn_btn_simple:hover,
		$style_name .zn_btn_simple:focus 
		{ color:$darker_secondary_color; }
	";

	$blockquote_color =  adjustBrightnessByStep($color, -39);
	echo "
		$style_name blockquote { color: $blockquote_color; }
	";

	echo "
		$style_name .btn-default:hover, 
		$style_name input[type=submit]:hover, 
		$style_name input[type=reset]:hover,
		$style_name button:not(.zn_btn_simple):not(.zn_btn_style2):not(.zn_btn_3d):hover
		{background-color: $color; }";

	// SET BUTTONS HOVER COLORS BASED ON THE BG COLOR
		if ( get_brightness( $color, 160 ) ) {
			echo "$style_name .btn-default:hover { color:#000; }";
		}
		else {
			echo "$style_name .btn-default:hover { color:#fff; }";
		}

	echo "
		$style_name .pagination > .active > a:hover, 
		$style_name .pagination > .active > span:hover,
		$style_name .pagination > .active > a, 
		$style_name .pagination > .active > span
		{border-color:$color;}
	";
	
	echo "$style_name .zn-secondary-color-bg {background-color: $color;}";
}

function SetDynamic_alternative_color($color, $style_name) {

	//** Am scos astea. Se foloseau la latest posts slider 2. Am pus in stilurile generale de navigatie
	//$style_name .zn_owl_carousel.navStyle2 .owl-buttons .owl-prev i,
	//$style_name .zn_owl_carousel.navStyle2 .owl-buttons .owl-next i,

	echo "
		$style_name .zn-alternative-color, $style_name .zn-alternative-hover:hover,
		$style_name .filters-nav ul li a.is-active,
		$style_name .zn-team-members.style2>h2,
		$style_name .blog-post.format-quote .zn_post_meta span,
		$style_name .zn_owl_carousel.hollowNav.style2 .owl-buttons .owl-prev i,
		$style_name .zn_owl_carousel.hollowNav.style2 .owl-buttons .owl-next i,
		$style_name .btn-default, $style_name .zn_btn_3d, $style_name .zn_btn_3d:hover,
		$style_name input[type=submit],$style_name input[type=reset],$style_name button,
		$style_name .blog-post .testimonials5 .item, 
		$style_name .blog-post .testimonials5 blockquote,
		$style_name .blog-post .testimonials5 h5,$style_name .blog-post .testimonials5 blockquote:before,
		$style_name #wp-calendar tbody td#today,
		$style_name .tagcloud a:hover,
		$style_name #sub-header,
		$style_name .zn_owl_carousel.solidNav .owl-buttons .owl-prev i,
		$style_name .zn_owl_carousel.solidNav .owl-buttons .owl-next i,
		$style_name .services-box.style5:hover > span,
		$style_name .services-box.style6 span, 
		$style_name .testimonials3-carousel.style2 .position,
		$style_name .zn_title.style2,
		$style_name .zn_tabList.colored .nav-tabs > li.active > a,
		$style_name .news-big .overlay figcaption,
		$style_name .news-big .overlay figcaption a,
		$style_name .memberBox.style2 .second_overlay a,
		$style_name .zn_owl_carousel.solidNav2 .owl-buttons .owl-prev:hover i,
		$style_name .zn_owl_carousel.solidNav2 .owl-buttons .owl-next:hover i,
		$style_name .ibox2.style5 .ibox-icon,
		$style_name .zn-collapsible .panel-title > a:after,
		$style_name .zn-collapsible.style2 .panel-title > a:not(.collapsed),
		$style_name .zn-collapsible.style2 .panel-title > a:not(.collapsed) .zn-col-icon,
		$style_name .services-box.style11:hover > span,
		$style_name .services-box.style11:hover > h3,
		$style_name .services-box.style11:hover > p
		{color: $color;}
		";
	echo "$style_name ::selection { color: $color;}
		  $style_name	::-moz-selection { color: $color;}";
	echo "
		$style_name .zn-alternative-color-bg,
		$style_name .zn-alt-col-bg-hover:hover,
		$style_name .zn-collapsible.style2 .panel-title > a:not(.collapsed):after
		{background-color: $color}";
	
	$colorTransparent = zn_hex2rgba_str($color, 50);
	echo "$style_name .memberBox.style2 .second_overlay p {border-top-color: $colorTransparent;}";
}

function SetDynamic_background_color($color, $style_name) {
	echo "
		body $style_name, $style_name .zn-background-color, 
		$style_name .zn-portfolio-filters ul li a.filter-item,
		$style_name .zn_tabList .nav-tabs > li.active > a,
		$style_name .testimonials3-carousel.style5 .item
		{background-color: $color;}
		";
	echo "$style_name .zn-testimonial-box .feedback-box:hover:after {border-top-color: $color;}";
	echo "
		$style_name #wp-calendar tbody td { border-color:$color;}
	";
	echo "$style_name .zn-background-color-color {color: $color;}";
	echo "
		$style_name .zn_tabList:not(.colored):not(.vertical) .nav-tabs > li.active > a
		{border-bottom-color: $color;}
	";
}

function SetDynamic_alternative_background_color($color, $style_name) {
	// $meta_color = adjustBrightness($color, 6.66);

	// echo "
	// input:not([type=submit]):not([type=file]):not([type=reset]):not([type=checkbox]):not([type=radio]):not([type=button]):not([type=range]):not([type=color]), textarea, select { box-shadow: inset 0 1px 0 $meta_color; }
	// ";


	echo "
		$style_name .zn-alternative-bkg,
		$style_name input[type=date],
		$style_name input[type=datetime],
		$style_name input[type=datetime-local],
		$style_name input[type=email],
		$style_name input[type=month],
		$style_name input[type=number],
		$style_name input[type=password],
		$style_name input[type=search],
		$style_name input[type=tel],
		$style_name input[type=text],
		$style_name input[type=time],
		$style_name input[type=url],
		$style_name input[type=week], 
		$style_name textarea, 
		$style_name select,
		$style_name #wp-calendar tbody td,
		$style_name .header-breadcrumb,
		$style_name .pagination li a:hover,
		$style_name .zn_btn_style2,
		$style_name .owl-theme .owl-controls .owl-page span,
		$style_name .zn_tabList .nav-tabs > li > a,
		$style_name .zn_textbox.style4,
		$style_name .zn_callToAction.style6,
		$style_name .testimonials3-carousel.style3 blockquote,
		$style_name .testimonials3-carousel.style4 .item,
		$style_name .zn_owl_carousel.solidNav2 .owl-buttons .owl-prev i,
		$style_name .zn_owl_carousel.solidNav2 .owl-buttons .owl-next i,
		$style_name .blog-post.archive_masonry .zn-article-inner,
		$style_name .blog-post.sticky
		{background-color: $color; }
	";

	echo "$style_name .testimonials3-carousel.style3 .item blockquote:after {border-top-color: $color;}";
	
	//**Am scos asta de aici pt ca nu era ok
	// $style_name .btn-default:hover,
	echo "
		$style_name .zn-alternative-bkg-color, 
		$style_name input[type=submit]:hover, 
		$style_name input[type=reset]:hover,
		$style_name button:hover,
		$style_name .zn_btn_style2:hover
		{color: $color; }
	";
		
	echo "
		$style_name .from-blog .blog-boxes:after,
		$style_name .zn_tabList .nav-tabs > li > a
		{border-bottom-color:$color}
	";
	
	//** Set transparency to background color
	$colorTransparent = zn_hex2rgba_str($color, 50);
	echo "
		$style_name .testimonials3-carousel blockquote
		{background-color: $colorTransparent;}
	";
	echo "$style_name .testimonials3-carousel .item blockquote:after {border-top-color: $colorTransparent;}";
	
	$colorTransparent2 = zn_hex2rgba_str($color, 25);
	echo "
		$style_name .zn-icon-list.style3 > li
		{background-color: $colorTransparent2;}
	";
	
	/** DARKER ALTERNATIVE **/
	$darker_alternative_bg_color = adjustBrightnessByStep($color, -35);
	echo "
		$style_name .zn-timeline-content { box-shadow: 0 3px 0 $darker_alternative_bg_color; }
	";


}

function SetDynamic_default_paragraph_color($color, $style_name) {
	echo "
		body $style_name, 
		$style_name .zn-paragraph-color,
		$style_name .breadcrumbs li a ,
		$style_name .pagination>li>a:hover, 
		$style_name .pagination>li>span:hover, 
		$style_name .pagination>li>a:focus, 
		$style_name .pagination>li>span:focus,
		$style_name .pagination>li>a, 
		$style_name .pagination>li>span,
		$style_name code,
		$style_name .zn_btn_style2,
		$style_name .testimonials3-carousel.style4 h4,
		$style_name .testimonials3-carousel.style5 h4
		{ color: $color; }";
		
	echo "
		$style_name .zn-paragraph-color-bg,
		$style_name .zn_btn_style2:hover
		{background-color: $color;}
	";
	
	//** Make a lighter paragraph color (for some meta elements)
	$lighterColor = adjustBrightnessByStep($color, 32);
	
	echo "
		$style_name .zn-paragraph-color-light, 
		$style_name .zn-featured-post .zn-post-container .post-tag a
		{color: $lighterColor; }
	";
}

function SetDynamic_default_borders_color($color, $style_name) {
	echo "$style_name .zn-border-color {color: $color; }";
	echo "
		$style_name *,
		$style_name .tagcloud a,
		$style_name .pagination>li>a, 
		$style_name .pagination>li>span, 
		$style_name .pagination>li>a:hover, 
		$style_name .pagination>li>span:hover, 
		$style_name .pagination>li>a:focus, 
		$style_name .pagination>li>span:focus
		{border-color: $color;}
	";

	echo "
		$style_name hr {border-top:1px solid $color;}
	";

	/** DARKER BORDER FOR INPUTS */
	$darker = adjustBrightnessByStep($color, -42);
	$darker2 = adjustBrightnessByStep($color, -49);
	echo "

		$style_name input[type=date]:hover,
		$style_name input[type=datetime]:hover,
		$style_name input[type=datetime-local]:hover,
		$style_name input[type=email]:hover,
		$style_name input[type=month]:hover,
		$style_name input[type=number]:hover,
		$style_name input[type=password]:hover,
		$style_name input[type=search]:hover,
		$style_name input[type=tel]:hover,
		$style_name input[type=text]:hover,
		$style_name input[type=time]:hover,
		$style_name input[type=url]:hover,
		$style_name input[type=week]:hover, 
		$style_name textarea:hover, 
		$style_name select:hover {
			border-color: $darker;
		}

		$style_name input[type=date]:focus,
		$style_name input[type=datetime]:focus,
		$style_name input[type=datetime-local]:focus,
		$style_name input[type=email]:focus,
		$style_name input[type=month]:focus,
		$style_name input[type=number]:focus,
		$style_name input[type=password]:focus,
		$style_name input[type=search]:focus,
		$style_name input[type=tel]:focus,
		$style_name input[type=text]:focus,
		$style_name input[type=time]:focus,
		$style_name input[type=url]:focus,
		$style_name input[type=week]:focus, 
		$style_name textarea:focus, 
		$style_name select:focus {
			border-color: $darker2;
		}


	";
	
	echo "
		$style_name .zn-border-color-bg,
		$style_name .zn_timeline_container::before {background-color: $color}
	";
}


// Add some extra css :)
do_action('zn_generate_css',$data);

?>
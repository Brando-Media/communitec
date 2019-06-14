﻿/*global jQuery */
/*jshint browser:true */

(function ($) {
	"use strict";

	$.ZnThemeJs = function () {
		this.scope = $(document);
		this.isMobile = jQuery.browser.mobile;
		this.zinit();
		this.isPageLoaded = '';
	};

	$.ZnThemeJs.prototype = {

		zinit : function()
		{
			var fw = this;

			fw.addactions();
			fw.enable_sliding_panel();
			fw.enable_search_panel();
			fw.enable_header_dropdown();
			fw.enable_mini_header();
			fw.enable_back_top_and_transparent_menu();
			fw.enable_responsive_menu();
			fw.enable_responsive_header();
			
			
			fw.enable_smooth_scroll();
			

			// ENABLE FOLLOW MENU

			$('.main-menu').ZnMegaMenu();

			// EVENTS THAT CAN BE REFRESHED
			fw.refresh_events(false);

		},

		refresh_events : function( content ) {

			var fw = this;
			// FITVIDS
			fw.enable_fitvids( content );

			fw.enable_owl_carousel( content );
			fw.enable_portfolio_thumbs_slider( content );
			fw.enable_zn_likes(content);
			fw.enable_mailchimp_subscribe(content);
			//** Enable parallax image backgrounds on sections
			fw.enable_parallax(content);
			fw.enable_circular_progress_bar(content);
			fw.enable_number_box(content);
			fw.enable_full_page_slider(content);
			// ENABLE CONTACT FORMS
			fw.enable_contact_forms(content);
			fw.enable_testimonials_masonry(content);
			// ENABLE MASONRY
			fw.enable_general_masonry(content);
			fw.enable_blog_masonry(content);
			// ENABLE PORTFOLIO MASONRY
			fw.enable_portfolio_masonry();
			// ENABLE LIGHTBOX
			fw.enable_lightbox();

		},

		RefreshOnWidthChange : function(content) {

			// Masonry
			var isotope_items = $( content ).find('.zn_masory_gallery_container, .zn-masonry-blog-container, .zn_testimonials_list, .portfolio-wrapper');
			
			if ( isotope_items.length > 0 ) {
				isotope_items.isotope('layout');
			}
			
			// OWL CAROUSEL
			$( content ).find('.owl-carousel').each(function(){
				$(this).data('owlCarousel').updateVars();
			});
		},

		addactions : function()
		{
			var fw = this;

			// Refresh events on new content
			fw.scope.on('ZnWidthChanged',function(e){
				fw.RefreshOnWidthChange(e.content);
				$(window).trigger('resize');
			});

			// Refresh events on new content
			fw.scope.on('ZnNewContent',function(e){
				fw.refresh_events( e.content );
				//alert('triggered');
			});
		},

		enable_contact_forms : function ( scope )
		{
			var fw = this,
			element = (scope) ? scope.find('.zn_contact_form_container > form') : $('.zn_contact_form_container > form');

			element.on( 'submit', function(e){

				e.preventDefault();

				if ( fw.form_submitting === true ) { return false; }

				fw.form_submitting = true;

				var form = $(this),
					response_container = form.find('.zn_contact_ajax_response:eq(0)'),
					has_error   = false,
					inputs = 
					{ 
						fields: form.find('textarea, select, input[type=text], input[type=checkbox]:checked, input[type=hidden]')
					},
					response_message = response_container.attr('id'),
					submit_button = form.find('.zn_contact_submit'),
					redirect_url = form.find('.zn_form_field_redirect_url').length ? form.find('.zn_form_field_redirect_url').val() : '';

				// FADE THE BUTTON
				submit_button.addClass('zn_form_loading');

				// PERFORM A CHECK ON ELEMENTS :
				inputs.fields.each(function()
				{
					var field       = $(this),
						p_container = field.parent();
						
					p_container.removeClass('zn_field_not_valid');

					// Check fields that needs to be filled 
					if ( field.hasClass('zn_validate_not_empty') ) {                
						if ( field.val() === '' ) 
						{ 
							p_container.addClass('zn_field_not_valid');
							has_error = true; 
						}
					}
					else if ( field.hasClass('zn_validate_is_email') ) {
						if ( !field.val().match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/) ) 
						{ 
							p_container.addClass('zn_field_not_valid'); 
							has_error = true; 
						}
					}
					else if ( field.hasClass('zn_validate_captcha') ) {
						var captcha_val = form.find("." + field.attr('name') + "_captcha").val(),
							correct_answer = captcha_val.charAt( captcha_val.length-4 );

						if ( field.val() != correct_answer ) 
						{ 
							p_container.addClass('zn_field_not_valid');
							has_error = true;
						}
					}

				});

				if ( has_error ) 
				{ 
					submit_button.removeClass('zn_form_loading');
					fw.form_submitting = false;
					return false;
				}

				response_container.load( form.attr('action')+' #'+response_message , inputs.fields , function()
				{
					// DO SOMETHING
					fw.form_submitting = false;
					submit_button.removeClass('zn_form_loading');
					inputs.fields.val('');
					if (redirect_url.length) {
						window.location.href = redirect_url;
					}
				});

				return false;

			});

		},

		enable_portfolio_masonry : function( scope ){
			var element = (scope) ? scope.find('.portfolio-wrapper') : $('.portfolio-wrapper');

			if (!element.length ) { return false; }

			element.each(function(){
				var current_element = $(this),
					main_wrapper = current_element.closest('.zn_portfolio_all,.zn-portfolio-wrapper'),
					filters_container = main_wrapper.find( '.zn-portfolio-filters' );

				current_element.imagesLoaded( function() {

					current_element.isotope({
						filter: '*',
						animationOptions: {
							duration: 750,
							easing: 'linear',
							queue: false
						}
					});

					filters_container.find('ul li a').on("click", function(e) {

						var msaonry_container = filters_container.closest('.zn_portfolio_all,.zn-portfolio-wrapper').find('.portfolio-wrapper');

						e.preventDefault();
						filters_container.find('ul li a').removeClass('is-active');
						$(this).addClass('is-active');
						var selector = $(this).data('filter');
						
						if(selector !== "") {
							msaonry_container.isotope({filter:function(){

								if ( selector == '*' ) {
									return true;
								}

								var itemCategories = $(this).data('filter');

								if ( itemCategories !== "" ) {
									var reg = new RegExp(selector, 'g');
									return itemCategories.match(reg);
								}
								else {
									return false;
								}

							}});
						} 
					});
				});

			});



		},

		enable_blog_masonry : function( scope ) {
			var element = (scope) ? scope.find('.zn-masonry-blog-container') : $('.zn-masonry-blog-container');

			if( !element.length ) { return false; }

			element.imagesLoaded( function() {
				element.isotope({
					masonry: {
						columnWidth: 'article.archive_masonry',
						gutter: 0
					},
					itemSelector: 'article.archive_masonry'
				});
			});
		},

		enable_general_masonry : function( scope ){
			var element = (scope) ? scope.find('.zn_masory_gallery_container') : $('.zn_masory_gallery_container');

			if (!element.length ) { return false; }

			element.each(function(){

				var el = $(this),
					container = el.parent('.zn_masonry_gallery');

				el.imagesLoaded( function() {

					// console.log(container.outerHeight());
					// console.log(container.offset().top);
					// console.log($('#footer').outerHeight());
					// console.log($(window).height());

					// This will fix the extra gap calculated by isotope
					if( container.outerHeight() + container.offset().top + $('#footer').outerHeight() > $(window).height())
					{
						$('html').css({'overflow-y':'scroll'});
					}

					el.isotope({
						masonry: {
							columnWidth: '.zn_masonry_entry',
							gutter: 0
						},
						itemSelector: '.zn_masonry_entry'
					});

					// el.isotope('bindResize');
					// el.isotope( 'on', 'layoutComplete',
					// 	function( isoInstance, laidOutItems ) {
					// 		console.log( 'Isotope layout completed on ' +
					// 		laidOutItems.length + ' items' );

					// 		el.addClass('zn_isotope_enabled');
					// 	}
					// );

				});
			});



		},

		enable_testimonials_masonry : function( scope ){
			var element = (scope) ? scope.find('.zn_testimonials_list') : $('.zn_testimonials_list');

			if (!element.length ) { return false; }

			element.imagesLoaded( function() {

				element.isotope({
					filter: '*',
					animationOptions: {
						duration: 750,
						easing: 'linear',
						queue: false
					}
				});
			});

		},

		enable_zn_likes : function( scope ){
			var element = (scope) ? scope.find('.zn_like_heart') : $('.zn_like_heart');

			element.on( 'click', function(){

				var link = $(this),
				data = {
					action: 'zn_heart_ajax_callback',
					post_id: link.data('post_id')
				};

				if ( link.hasClass( 'inactive' ) ) { return false; }

				// SHOW A LOADING ICON
				$.post(ZnThemeAjax.ajaxurl, data, function(response) {

					link.children('span').html(response);
					link.addClass( 'inactive tcolor' );
					// ADD THE RESPONSE TO THE MESAGE CONTAINER
					//console.log( response );

				});

			});

		},

		enable_responsive_header : function(){
			var header = $( '#header' );

			if ( header.hasClass('zn_do_not_follow') ) { 
				return; 
			}

			$(window).on('debouncedresize', function(){

				// Disable header transparency based on the responsive trigger ( when the responsive menu appears )
				if ( header.hasClass('header5') ) {
					// fix transparent menu on responsive
					if ( $(window).width() < ZnThemeAjax.res_menu_trigger ) {
						var header_height = header.outerHeight();
						$('#content').css('margin-top',header_height);
						header.addClass( 'fillbg' );
					}
					else{
						header.removeClass( 'fillbg' );
						$('#content').css('margin-top','0'); return;
					}
					
				}
				
				var header_height = header.outerHeight();
				$('#content').css('margin-top',header_height);

			}).trigger('debouncedresize');
		},

		enable_smooth_scroll: function () {

			// Let's the user add extra css classes that will not be applied for the smooth scroll.
			var not_extra = '';
			if ( ZnThemeAjax.no_smooth_scroll.length != 0 ) {
				not_extra = ZnThemeAjax.no_smooth_scroll;
			}

			$('body').on('click','a[href*="#"]:not([href="#"]):not(.no-scroll,.ui-tabs-anchor):not('+not_extra+')', function(e){
				if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
					if (target.length) {

						var header = $('#header'),
							offset = target.offset().top;

						// We need to take in account the different headers
						if( ( header.hasClass( 'zn_do_not_hide_small' ) || header.hasClass('zn_do_not_hide') ) && ! header.hasClass('zn_do_not_follow') ){
							offset -= header.outerHeight();
						}

						$('html,body').animate({
							scrollTop: offset
						}, 1000);
						return false;
					}
				}
			});
		},

		enable_responsive_menu : function(){

			var page_wrapper = $('#page-wrapper'),
				responsive_trigger = $('.zn-res-trigger'),
				menu_activated = false,
				back_text = '<li class="zn_res_menu_go_back"><span class="zn_res_back_icon icon-angle-left"></span><a href="#">'+ZnThemeAjax.zn_back_text+'</a></li>',
				cloned_menu = $('#main-menu > ul').clone().attr({id:"zn-res-menu", "class":""});

			var start_responsive_menu = function(){

				var responsive_menu = cloned_menu.prependTo(page_wrapper);

				// BIND OPEN MENU TRIGGER
				responsive_trigger.click(function(e){
					e.preventDefault();
					
					responsive_menu.addClass('zn-menu-visible');
					set_height();

				});

				// Close the menu when a link is clicked
				responsive_menu.find( 'a' ).click( function(e){
					$( '.zn_res_menu_go_back' ).first().trigger( 'click' );
				});

				// ADD ARROWS TO SUBMENUS TRIGGERS
				responsive_menu.find('li:has(> ul.sub-menu), li:has(> div.zn_mega_container)').addClass('zn_res_has_submenu').prepend('<span class="zn_res_submenu_trigger icon-angle-right"></span>');
				// ADD BACK BUTTONS
				responsive_menu.find('.zn_res_has_submenu > ul.sub-menu, .zn_res_has_submenu > div.zn_mega_container').addBack().prepend(back_text);

				// REMOVE BACK BUTTON LINK
				$( '.zn_res_menu_go_back' ).click(function(e){
					e.preventDefault();
					var active_menu = $(this).closest('.zn-menu-visible');
					active_menu.removeClass('zn-menu-visible');
					set_height();
					if( active_menu.is('#zn-res-menu') ) {
						page_wrapper.css({'height':'auto'});
					}
				});

				// OPEN SUBMENU'S ON CLICK
				$('.zn_res_submenu_trigger').click(function(e){
					e.preventDefault();
					$(this).siblings('ul,.zn_mega_container').addClass('zn-menu-visible');
					set_height();
				});

			}

			var set_height = function(){
				var height = $('.zn-menu-visible').last().css({height:'auto'}).outerHeight(true),
					window_height  = $(window).height(),
					adminbar_height = 0,
					admin_bar = $('#wpadminbar');

				// CHECK IF WE HAVE THE ADMIN BAR VISIBLE
				if(height < window_height) {
					height = window_height;
					if ( admin_bar.length > 0 ) {
						adminbar_height = admin_bar.outerHeight(true);
						height = height - adminbar_height;
					}
				}

				$('.zn-menu-visible').last().attr('style','');
				page_wrapper.css({'height':height});
			};

			// MAIN TRIGGER FOR ACTIVATING THE RESPONSIVE MENU
			$( window ).on( 'debouncedresize' , function(){
				if ( $(window).width() < ZnThemeAjax.res_menu_trigger ) {
					if ( !menu_activated ){
						start_responsive_menu();
						menu_activated = true;
					}
					page_wrapper.addClass('zn_res_menu_visible');
				}
				else{
					// WE SHOULD HIDE THE MENU
					$('.zn-menu-visible').removeClass('zn-menu-visible');
					page_wrapper.css({'height':'auto'}).removeClass('zn_res_menu_visible');
				}
			}).trigger('debouncedresize'); //** Fix for triggering the responsive menu
		},

		enable_back_top_and_transparent_menu : function(){
			var pageHeaderBar = $('#page-wrapper > header'),
				backtop = $("#back-top");
			backtop.hide();

			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					backtop.fadeIn();
					pageHeaderBar.addClass('fillbg');
				} else {
					backtop.fadeOut();
					pageHeaderBar.removeClass('fillbg');
				}
			});

			// scroll body to 0px on click
			backtop.children('a').click(function () {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
		},

		enable_mini_header : function(){

			if ( $('#header').hasClass('zn_do_not_hide') ) {
				return false;
			}

			// Hide Header on on scroll down
			var didScroll;
			var lastScrollTop = 0;
			var delta = 5;
			var navbarHeight = $('#header').outerHeight();

			if ( $('#header').hasClass('zn_do_not_hide_small') ) {
				$(window).scroll(function(event){

					var st = $(this).scrollTop();

					if ( st > navbarHeight ){
						$('#header').addClass( 'zn_header_smaller' );
					}
					else{
						$('#header').removeClass( 'zn_header_smaller' );
					}
				});
				
				return false;
			}

			$(window).scroll(function(event){
				didScroll = true;
			});

			setInterval(function() {
				if (didScroll) {
					var st = $(this).scrollTop();
				
					// Make sure they scroll more than delta
					if(Math.abs(lastScrollTop - st) <= delta)
						return;
				
					// If they scrolled down and are past the navbar, add class .nav-up.
					// This is necessary so you never see what is "behind" the navbar.
					if (st > lastScrollTop && st > navbarHeight){
						// Scroll Down
						$('#header').removeClass('nav-down').addClass('nav-up');
					} else {
						// Scroll Up
						if(st + $(window).height() < $(document).height()) {
							$('#header').removeClass('nav-up').addClass('nav-down');
						}
					}
				
					lastScrollTop = st;
					didScroll = false;
				}
			}, 250);
		},

		enable_fitvids : function ( scope ) {

			var iframes = (scope) ? scope.find('iframe') : $('iframe');
			iframes.wrap("<div class='zn_iframe_wrap'/>");

			var element = (scope) ? scope.find('.zn_iframe_wrap') : $('.zn_iframe_wrap');
			if (element.length === 0) { return; }

			element.fitVids();

		},

		enable_sliding_panel : function(){
			$(".btn-slide").click(function(){
				$("#panel").slideToggle("fast", "linear" );
				$(this).toggleClass("active-panel"); return false;
			});
		},

		enable_search_panel : function(){
			$(document).click(function () {
				$('.searchForm').removeClass('active');
			});
			$('.searchForm').click(function (e) {
				e.stopPropagation();
			});
			$('.searchPanel span').click(function (e) {
				e.stopPropagation();
				if ($('.searchForm').hasClass('active')) {
					$('.searchForm').removeClass('active');
				} else {
					$('.searchForm').addClass('active');
				}
			});
		},

		enable_header_dropdown : function(){
			$(document).click(function () {
				$('.zn_header_dropdown_holder').removeClass('active');
			});
			$('.zn_header_dropdown_holder').click( function (e) {
				e.stopPropagation();
			});
			$('.zn_header_dropdown > span').click( function (e) {
				e.stopPropagation();
				if ( $( this ).next('.zn_header_dropdown_holder').hasClass('active')) {
					$( this ).next('.zn_header_dropdown_holder').removeClass('active');
				} else {
					$( this ).next('.zn_header_dropdown_holder').addClass('active');
				}
			});
		},

		enable_lightbox: function (scope) {
			var element = (scope) ? scope.find('.zn-nivo-lightbox') : $('.zn-nivo-lightbox');

			element.each(function () {
				$(this).nivoLightbox();
			});
		},

		enable_owl_carousel : function( content ){
			var fw = this,
				element = (content) ? content.find('.zn_owl_carousel') : $('.zn_owl_carousel');

			var defaults = {
				navigation : false, // Show next and prev buttons
				autoPlay: true,
				slideSpeed : 300,
				paginationSpeed : 400,
				pagination: false,
				singleItem:true,
				navigationText: [
					"<i class='icon-angle-left animation'></i>",
					"<i class='icon-angle-right animation'></i>"
				]
			};

			element.each(function(){

				var customSettings = {
					autoPlay: $(this).is("[data-auto]") ? $(this).data('auto') : defaults.autoPlay,
					pagination:  $(this).is("[data-pagination]") ? $(this).data('pagination') : defaults.pagination,
					navigation:  $(this).is("[data-navigation]") ? $(this).data('navigation') : defaults.navigation,
					items: $(this).is("[data-items]") ? $(this).data('items') : 1,
					singleItem: $(this).is("[data-single]") ? $(this).data('single') : defaults.singleItem
				};

				//** Portfolio related specific settings
				if ($(this).hasClass('zn_portfolio_related_carousel')) {
					$.extend(customSettings, {
						items: 4,
						singleItem: false
					});
					//defaults.items = 4;
					//defaults.singleItem = false;
				}
				//** Our team carousel specific settings
				else if ($(this).hasClass('our-team')) {
					$.extend(customSettings, {
						//items: 4,
						itemsDesktop: [1199, 3],
						itemsDesktopSmall: [979, 3],
						//singleItem: false
					});
				}
				//** Testimonials carousel specific settings
				else if ($(this).hasClass('testimonials-carousel')) {
					$.extend(customSettings, {
						singleItem: true,
						transitionStyle: 'fade'
					});
				}
				//** Latest posts carusel 1
				else if ($(this).hasClass('news-big')) {
					$.extend(customSettings, {
						singleItem: true,
					});
				}
				//** Latest posts carusel 2
				else if ($(this).hasClass('news-small')) {
					$.extend(customSettings, {
						singleItem: false,
					});
				}
					//** Portfolio slider
				else if ($(this).hasClass('zn_portfolio_slider')) {
					$.extend(customSettings, {
						singleItem: false,
					})
				}
				//** Image slider 3
				else if ($(this).hasClass('zn_secondary_owl'))
				{
					// Connect the thumbs to main carousel
					//var zn_port_item_carousel = element.closest('.zn_connected_owl').children('.zn_main_owl');
					var zn_port_item_carousel = $(this).prev();
					$(this).find('.owl-secondary-item').each(function (index) {
						$(this).on('click', function () {
							$(zn_port_item_carousel).trigger('owl.goTo', index);
						});
					});
				}

				var that = this;
				$(this).imagesLoaded(function () {
					$(that).owlCarousel($.extend({}, defaults, customSettings));
				});

			});


		},

		enable_portfolio_thumbs_slider : function( content ){
			var fw = this,
				element = (content) ? content.find('.zn_portfolio_thumbs_container') : $('.zn_portfolio_thumbs_container');

			element.owlCarousel({
				navigation : false, // Show next and prev buttons
				autoPlay: true,
				slideSpeed : 300,
				paginationSpeed : 400,
				items: 4,
				itemsTablet: [768, 4],
				itemsMobile: [479,3],
				pagination: false
			});

			// Connect the thumbs to carousel
			var zn_port_item_carousel = element.closest('.zn_portfolio_slider').children('.zn_owl_carousel');
			element.find('.owl-item').each(function(e){
				$(this).on('click', function(){
					$(zn_port_item_carousel).trigger('owl.goTo', $(this).index());
				});
			});

		},

		enable_mailchimp_subscribe: function (scope) {
			var element = (scope) ? scope.find('.zn_newsletter') : $('.zn_newsletter');

			element.on('submit', function (e) {

				e.preventDefault();

				var el = $(this);

				var msg_container = el.next('.zn_mailchimp_message').hide(),
				data = {
					action: 'zn_mailchimp_subscribe',
					mailchimp_list: el.find('input.zn_mailchimp_list_id').val(),
					email: el.find('input.nl-email').val()
				};

				data.otherFields = {};

				el.find('input.subscribe-field').each(function () {
					data.otherFields[$(this).data("field-tag")] = $(this).val();
				});

	
				// SHOW A LOADING ICON
				$.post(ZnThemeAjax.ajaxurl, data, function (response) {

					console.log(data);
					// ADD THE RESPONSE TO THE MESAGE CONTAINER
					el.fadeOut("fast", function () {
						msg_container.html(response.message).fadeIn('fast', function () {
							//  if ( response.error ) {
							setTimeout(function () {
								msg_container.fadeOut('fast', function () {
									el.fadeIn("fast");
									//el.trigger("reset");
								});
							}, 2000);
							//  }

						});
					});


					// HIDE THE LOADING ICON
				});

				return false;
			});
		},

		enable_parallax: function(scope) {
			var element = (scope) ? scope.find('.zn_parallax') : $('.zn_parallax');

			element.each(function () {
				$(this).parallax("50%", 0.5);
			});
		},

		enable_circular_progress_bar: function (scope) {
			var element = scope ? scope.find('.zn_dial') : $('.zn_dial');

			element.each(function () {
				//var perc = $(this).attr("value");
				var that = $(this);

				$(this).knob({
					'value': 0,
					'min': 0,
					'max': 100,
					"skin": "tron",
					"readOnly": true,
					//"thickness": .1,
					'dynamicDraw': true,
					"displayInput": false
				});

				$(this).prev().appear(function () {
					$({value:0}).animate({ value: that.attr('value') }, {
						duration: that.data('speed'),
						easing: 'swing',
						progress: function () {
							that.val(Math.ceil(this.value)).trigger('change')
						}
					});
				});

			});
		},

		enable_number_box: function (scope) {
			var element = scope ? scope.find('.zn_timer') : $('.zn_timer');

			element.each(function () {
				$(this).appear(function () {
					if ($.isNumeric($(this).data('from')) && $.isNumeric($(this).data('to'))) {
						$(this).countTo({ speed: $(this).data('speed') });
					}
				});
			});

		},

		enable_full_page_slider: function (scope) {
			var fw = this,
				element = (scope) ? scope.find('.zn_fullPage') : $('.zn_fullPage');

			element.each(function () {
				var that = this;
				$(this).imagesLoaded(function () {
					$(that).fullpage({
						verticalCentered: false,
						//autoScrolling: $(that).data("autoplay"),
						//scrollingSpeed: $(that).data("timeout"),
						//loopBottom: true
					});
				});
			});
		}
	};

	$(document).ready(function () {
	  // Call this on document ready
	  $.themejs = new $.ZnThemeJs();
   }); 


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////  WINDOW LOAD   //////
	$(window).load(function () {
		// REMOVE PRELOADER 
		var preloader = $('.zn_page_preloader');
		if ( preloader.length > 0 ) {
			preloader.fadeOut( "fast", function() {
				preloader.remove();
			});
		}

		//** Scroll the page with animation to the hash from the url. That's only when the page is loaded from an external url that contains a #
		if (window.location.hash) {
			var target = $(window.location.hash);
			if (target.length) {
				var header = $('#header'),
							offset = target.offset().top;
				if ((header.hasClass('zn_do_not_hide_small') || header.hasClass('zn_do_not_hide')) && !header.hasClass('zn_do_not_follow')) {
					offset -= header.outerHeight();
				}

				window.scrollTo(0, 0);
				$('html,body').animate({ scrollTop: offset }, 1500);
			}
		}

	});
	////// END WINDOW LOAD
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* -----------------------------------------------------------
*   MEGA MENU
*-----------------------------------------------------------*/
	$.fn.ZnMegaMenu = function( args )
	{

		var defaults =
		{
			delay:300,
			megamenu:true,
			responsive:true,
			parentContainer: $( '#header > .container' )
		};

		var options = $.extend( defaults, args ),
			closing = {};


		// function MegaShow(menu){
		// 	menu.addClass('znisvisible');
		// }

		// function MegaHide( menu ){
		
		//  	menu.removeClass('znisvisible');
		// }

		return this.each(function(i)
		{
			var menu = $(this),
				menuitems = menu.find(">li"),
				menuActive = menu.find('>.current-menu-item>a, >.current_page_item>a'),
				dropdown = menuitems.find('>ul').parent(),
				MegaDropdown = menuitems.find('>.zn_mega_container').parent(),
				active_items = {};

			MegaDropdown.find('>ul').addBack().each(function()
			{
				var currentItem = $(this),
					submenu = currentItem.find('.zn_mega_container:first'),
					currentAnchor = currentItem.children('a');

				// // BIND THE SHOW HIDE FUNCTIONALITY
				// $(currentItem).hover(

				// 	function()
				// 	{
				// 		MegaShow(currentItem);
				// 	},

				// 	function()
				// 	{
				// 		MegaHide(currentItem);
				// 	}
				// );

				// MODIFY THE MEGA WRAPPER WIDTH BASED ON THE HEADER CONTAINER DISTANCE FROM THE ACTUAL MENU
				$( window ).on( 'debouncedresize' , function(){
					var parentContainerPosition = options.parentContainer.offset(),
						submenuPosition = currentItem.offset(),
						correctPosition = submenuPosition.left - parentContainerPosition.left;

						submenu.css({left: (correctPosition* -1)});
				}).trigger('debouncedresize');

			});



		});

	};



})(jQuery);

/* Modernizr 2.6.2 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-cssanimations-csstransitions-touch-shiv-cssclasses-prefixed-teststyles-testprop-testallprops-prefixes-domprefixes-load
 */
;window.Modernizr=function(a,b,c){function z(a){j.cssText=a}function A(a,b){return z(m.join(a+";")+(b||""))}function B(a,b){return typeof a===b}function C(a,b){return!!~(""+a).indexOf(b)}function D(a,b){for(var d in a){var e=a[d];if(!C(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function E(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:B(f,"function")?f.bind(d||b):f}return!1}function F(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+o.join(d+" ")+d).split(" ");return B(b,"string")||B(b,"undefined")?D(e,b):(e=(a+" "+p.join(d+" ")+d).split(" "),E(e,b,c))}var d="2.6.2",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m=" -webkit- -moz- -o- -ms- ".split(" "),n="Webkit Moz O ms",o=n.split(" "),p=n.toLowerCase().split(" "),q={},r={},s={},t=[],u=t.slice,v,w=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},x={}.hasOwnProperty,y;!B(x,"undefined")&&!B(x.call,"undefined")?y=function(a,b){return x.call(a,b)}:y=function(a,b){return b in a&&B(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=u.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(u.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(u.call(arguments)))};return e}),q.touch=function(){var c;return"ontouchstart"in a||a.DocumentTouch&&b instanceof DocumentTouch?c=!0:w(["@media (",m.join("touch-enabled),("),h,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(a){c=a.offsetTop===9}),c},q.cssanimations=function(){return F("animationName")},q.csstransitions=function(){return F("transition")};for(var G in q)y(q,G)&&(v=G.toLowerCase(),e[v]=q[G](),t.push((e[v]?"":"no-")+v));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)y(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},z(""),i=k=null,function(a,b){function k(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function l(){var a=r.elements;return typeof a=="string"?a.split(" "):a}function m(a){var b=i[a[g]];return b||(b={},h++,a[g]=h,i[h]=b),b}function n(a,c,f){c||(c=b);if(j)return c.createElement(a);f||(f=m(c));var g;return f.cache[a]?g=f.cache[a].cloneNode():e.test(a)?g=(f.cache[a]=f.createElem(a)).cloneNode():g=f.createElem(a),g.canHaveChildren&&!d.test(a)?f.frag.appendChild(g):g}function o(a,c){a||(a=b);if(j)return a.createDocumentFragment();c=c||m(a);var d=c.frag.cloneNode(),e=0,f=l(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function p(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return r.shivMethods?n(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+l().join().replace(/\w+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(r,b.frag)}function q(a){a||(a=b);var c=m(a);return r.shivCSS&&!f&&!c.hasCSS&&(c.hasCSS=!!k(a,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),j||p(a,c),a}var c=a.html5||{},d=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,e=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,f,g="_html5shiv",h=0,i={},j;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",f="hidden"in a,j=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){f=!0,j=!0}})();var r={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,supportsUnknownElements:j,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:q,createElement:n,createDocumentFragment:o};a.html5=r,q(b)}(this,b),e._version=d,e._prefixes=m,e._domPrefixes=p,e._cssomPrefixes=o,e.testProp=function(a){return D([a])},e.testAllProps=F,e.testStyles=w,e.prefixed=function(a,b,c){return b?F(a,b,c):F(a,"pfx")},g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+t.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};

/*!
 * imagesLoaded PACKAGED v3.1.4
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */
(function(){function e(){}function t(e,t){for(var n=e.length;n--;)if(e[n].listener===t)return n;return-1}function n(e){return function(){return this[e].apply(this,arguments)}}var i=e.prototype,r=this,o=r.EventEmitter;i.getListeners=function(e){var t,n,i=this._getEvents();if("object"==typeof e){t={};for(n in i)i.hasOwnProperty(n)&&e.test(n)&&(t[n]=i[n])}else t=i[e]||(i[e]=[]);return t},i.flattenListeners=function(e){var t,n=[];for(t=0;e.length>t;t+=1)n.push(e[t].listener);return n},i.getListenersAsObject=function(e){var t,n=this.getListeners(e);return n instanceof Array&&(t={},t[e]=n),t||n},i.addListener=function(e,n){var i,r=this.getListenersAsObject(e),o="object"==typeof n;for(i in r)r.hasOwnProperty(i)&&-1===t(r[i],n)&&r[i].push(o?n:{listener:n,once:!1});return this},i.on=n("addListener"),i.addOnceListener=function(e,t){return this.addListener(e,{listener:t,once:!0})},i.once=n("addOnceListener"),i.defineEvent=function(e){return this.getListeners(e),this},i.defineEvents=function(e){for(var t=0;e.length>t;t+=1)this.defineEvent(e[t]);return this},i.removeListener=function(e,n){var i,r,o=this.getListenersAsObject(e);for(r in o)o.hasOwnProperty(r)&&(i=t(o[r],n),-1!==i&&o[r].splice(i,1));return this},i.off=n("removeListener"),i.addListeners=function(e,t){return this.manipulateListeners(!1,e,t)},i.removeListeners=function(e,t){return this.manipulateListeners(!0,e,t)},i.manipulateListeners=function(e,t,n){var i,r,o=e?this.removeListener:this.addListener,s=e?this.removeListeners:this.addListeners;if("object"!=typeof t||t instanceof RegExp)for(i=n.length;i--;)o.call(this,t,n[i]);else for(i in t)t.hasOwnProperty(i)&&(r=t[i])&&("function"==typeof r?o.call(this,i,r):s.call(this,i,r));return this},i.removeEvent=function(e){var t,n=typeof e,i=this._getEvents();if("string"===n)delete i[e];else if("object"===n)for(t in i)i.hasOwnProperty(t)&&e.test(t)&&delete i[t];else delete this._events;return this},i.removeAllListeners=n("removeEvent"),i.emitEvent=function(e,t){var n,i,r,o,s=this.getListenersAsObject(e);for(r in s)if(s.hasOwnProperty(r))for(i=s[r].length;i--;)n=s[r][i],n.once===!0&&this.removeListener(e,n.listener),o=n.listener.apply(this,t||[]),o===this._getOnceReturnValue()&&this.removeListener(e,n.listener);return this},i.trigger=n("emitEvent"),i.emit=function(e){var t=Array.prototype.slice.call(arguments,1);return this.emitEvent(e,t)},i.setOnceReturnValue=function(e){return this._onceReturnValue=e,this},i._getOnceReturnValue=function(){return this.hasOwnProperty("_onceReturnValue")?this._onceReturnValue:!0},i._getEvents=function(){return this._events||(this._events={})},e.noConflict=function(){return r.EventEmitter=o,e},"function"==typeof define&&define.amd?define("eventEmitter/EventEmitter",[],function(){return e}):"object"==typeof module&&module.exports?module.exports=e:this.EventEmitter=e}).call(this),function(e){function t(t){var n=e.event;return n.target=n.target||n.srcElement||t,n}var n=document.documentElement,i=function(){};n.addEventListener?i=function(e,t,n){e.addEventListener(t,n,!1)}:n.attachEvent&&(i=function(e,n,i){e[n+i]=i.handleEvent?function(){var n=t(e);i.handleEvent.call(i,n)}:function(){var n=t(e);i.call(e,n)},e.attachEvent("on"+n,e[n+i])});var r=function(){};n.removeEventListener?r=function(e,t,n){e.removeEventListener(t,n,!1)}:n.detachEvent&&(r=function(e,t,n){e.detachEvent("on"+t,e[t+n]);try{delete e[t+n]}catch(i){e[t+n]=void 0}});var o={bind:i,unbind:r};"function"==typeof define&&define.amd?define("eventie/eventie",o):e.eventie=o}(this),function(e,t){"function"==typeof define&&define.amd?define(["eventEmitter/EventEmitter","eventie/eventie"],function(n,i){return t(e,n,i)}):"object"==typeof exports?module.exports=t(e,require("eventEmitter"),require("eventie")):e.imagesLoaded=t(e,e.EventEmitter,e.eventie)}(this,function(e,t,n){function i(e,t){for(var n in t)e[n]=t[n];return e}function r(e){return"[object Array]"===d.call(e)}function o(e){var t=[];if(r(e))t=e;else if("number"==typeof e.length)for(var n=0,i=e.length;i>n;n++)t.push(e[n]);else t.push(e);return t}function s(e,t,n){if(!(this instanceof s))return new s(e,t);"string"==typeof e&&(e=document.querySelectorAll(e)),this.elements=o(e),this.options=i({},this.options),"function"==typeof t?n=t:i(this.options,t),n&&this.on("always",n),this.getImages(),a&&(this.jqDeferred=new a.Deferred);var r=this;setTimeout(function(){r.check()})}function c(e){this.img=e}function f(e){this.src=e,v[e]=this}var a=e.jQuery,u=e.console,h=u!==void 0,d=Object.prototype.toString;s.prototype=new t,s.prototype.options={},s.prototype.getImages=function(){this.images=[];for(var e=0,t=this.elements.length;t>e;e++){var n=this.elements[e];"IMG"===n.nodeName&&this.addImage(n);for(var i=n.querySelectorAll("img"),r=0,o=i.length;o>r;r++){var s=i[r];this.addImage(s)}}},s.prototype.addImage=function(e){var t=new c(e);this.images.push(t)},s.prototype.check=function(){function e(e,r){return t.options.debug&&h&&u.log("confirm",e,r),t.progress(e),n++,n===i&&t.complete(),!0}var t=this,n=0,i=this.images.length;if(this.hasAnyBroken=!1,!i)return this.complete(),void 0;for(var r=0;i>r;r++){var o=this.images[r];o.on("confirm",e),o.check()}},s.prototype.progress=function(e){this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded;var t=this;setTimeout(function(){t.emit("progress",t,e),t.jqDeferred&&t.jqDeferred.notify&&t.jqDeferred.notify(t,e)})},s.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";this.isComplete=!0;var t=this;setTimeout(function(){if(t.emit(e,t),t.emit("always",t),t.jqDeferred){var n=t.hasAnyBroken?"reject":"resolve";t.jqDeferred[n](t)}})},a&&(a.fn.imagesLoaded=function(e,t){var n=new s(this,e,t);return n.jqDeferred.promise(a(this))}),c.prototype=new t,c.prototype.check=function(){var e=v[this.img.src]||new f(this.img.src);if(e.isConfirmed)return this.confirm(e.isLoaded,"cached was confirmed"),void 0;if(this.img.complete&&void 0!==this.img.naturalWidth)return this.confirm(0!==this.img.naturalWidth,"naturalWidth"),void 0;var t=this;e.on("confirm",function(e,n){return t.confirm(e.isLoaded,n),!0}),e.check()},c.prototype.confirm=function(e,t){this.isLoaded=e,this.emit("confirm",this,t)};var v={};return f.prototype=new t,f.prototype.check=function(){if(!this.isChecked){var e=new Image;n.bind(e,"load",this),n.bind(e,"error",this),e.src=this.src,this.isChecked=!0}},f.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},f.prototype.onload=function(e){this.confirm(!0,"onload"),this.unbindProxyEvents(e)},f.prototype.onerror=function(e){this.confirm(!1,"onerror"),this.unbindProxyEvents(e)},f.prototype.confirm=function(e,t){this.isConfirmed=!0,this.isLoaded=e,this.emit("confirm",this,t)},f.prototype.unbindProxyEvents=function(e){n.unbind(e.target,"load",this),n.unbind(e.target,"error",this)},s});


/*!
* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/
(function($){$.fn.fitVids=function(options){var settings={customSelector:null};if(!document.getElementById("fit-vids-style")){var head=document.head||document.getElementsByTagName("head")[0];var css=".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}";var div=document.createElement("div");div.innerHTML='<p>x</p><style id="fit-vids-style">'+
css+"</style>";head.appendChild(div.childNodes[1])}if(options)$.extend(settings,options);return this.each(function(){var selectors=["iframe[src*='player.vimeo.com']","iframe[src*='youtube.com']","iframe[src*='youtube-nocookie.com']","iframe[src*='kickstarter.com'][src*='video.html']","object","embed"];if(settings.customSelector)selectors.push(settings.customSelector);var $allVideos=$(this).find(selectors.join(","));$allVideos=$allVideos.not("object object");$allVideos.each(function(){var $this=$(this);
if(this.tagName.toLowerCase()==="embed"&&$this.parent("object").length||$this.parent(".fluid-width-video-wrapper").length)return;if(!$this.css("height")&&!$this.css("width")&&(isNaN($this.attr("height"))||isNaN($this.attr("width")))){$this.attr("height",9);$this.attr("width",16)}var height=this.tagName.toLowerCase()==="object"||$this.attr("height")&&!isNaN(parseInt($this.attr("height"),10))?parseInt($this.attr("height"),10):$this.height(),width=!isNaN(parseInt($this.attr("width"),10))?parseInt($this.attr("width"),
10):$this.width(),aspectRatio=height/width;if(!$this.attr("id")){var videoID="fitvid"+Math.floor(Math.random()*999999);$this.attr("id",videoID)}$this.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",aspectRatio*100+"%");$this.removeAttr("height").removeAttr("width")})})}})(window.jQuery||window.Zepto);

// Owl Carousel v1.3.3
"function" !== typeof Object.create && (Object.create = function (f) { function g() { } g.prototype = f; return new g });
(function (f, g, k) {
	var l = {
		init: function (a, b) { this.$elem = f(b); this.options = f.extend({}, f.fn.owlCarousel.options, this.$elem.data(), a); this.userOptions = a; this.loadContent() }, loadContent: function () {
			function a(a) { var d, e = ""; if ("function" === typeof b.options.jsonSuccess) b.options.jsonSuccess.apply(this, [a]); else { for (d in a.owl) a.owl.hasOwnProperty(d) && (e += a.owl[d].item); b.$elem.html(e) } b.logIn() } var b = this, e; "function" === typeof b.options.beforeInit && b.options.beforeInit.apply(this, [b.$elem]); "string" === typeof b.options.jsonPath ?
			(e = b.options.jsonPath, f.getJSON(e, a)) : b.logIn()
		}, logIn: function () { this.$elem.data("owl-originalStyles", this.$elem.attr("style")); this.$elem.data("owl-originalClasses", this.$elem.attr("class")); this.$elem.css({ opacity: 0 }); this.orignalItems = this.options.items; this.checkBrowser(); this.wrapperWidth = 0; this.checkVisible = null; this.setVars() }, setVars: function () {
			if (0 === this.$elem.children().length) return !1; this.baseClass(); this.eventTypes(); this.$userItems = this.$elem.children(); this.itemsAmount = this.$userItems.length;
			this.wrapItems(); this.$owlItems = this.$elem.find(".owl-item"); this.$owlWrapper = this.$elem.find(".owl-wrapper"); this.playDirection = "next"; this.prevItem = 0; this.prevArr = [0]; this.currentItem = 0; this.customEvents(); this.onStartup()
		}, onStartup: function () {
			this.updateItems(); this.calculateAll(); this.buildControls(); this.updateControls(); this.response(); this.moveEvents(); this.stopOnHover(); this.owlStatus(); !1 !== this.options.transitionStyle && this.transitionTypes(this.options.transitionStyle); !0 === this.options.autoPlay &&
			(this.options.autoPlay = 5E3); this.play(); this.$elem.find(".owl-wrapper").css("display", "block"); this.$elem.is(":visible") ? this.$elem.css("opacity", 1) : this.watchVisibility(); this.onstartup = !1; this.eachMoveUpdate(); "function" === typeof this.options.afterInit && this.options.afterInit.apply(this, [this.$elem])
		}, eachMoveUpdate: function () {
			!0 === this.options.lazyLoad && this.lazyLoad(); !0 === this.options.autoHeight && this.autoHeight(); this.onVisibleItems(); "function" === typeof this.options.afterAction && this.options.afterAction.apply(this,
			[this.$elem])
		}, updateVars: function () { "function" === typeof this.options.beforeUpdate && this.options.beforeUpdate.apply(this, [this.$elem]); this.watchVisibility(); this.updateItems(); this.calculateAll(); this.updatePosition(); this.updateControls(); this.eachMoveUpdate(); "function" === typeof this.options.afterUpdate && this.options.afterUpdate.apply(this, [this.$elem]) }, reload: function () { var a = this; g.setTimeout(function () { a.updateVars() }, 0) }, watchVisibility: function () {
			var a = this; if (!1 === a.$elem.is(":visible")) a.$elem.css({ opacity: 0 }),
			g.clearInterval(a.autoPlayInterval), g.clearInterval(a.checkVisible); else return !1; a.checkVisible = g.setInterval(function () { a.$elem.is(":visible") && (a.reload(), a.$elem.animate({ opacity: 1 }, 200), g.clearInterval(a.checkVisible)) }, 500)
		}, wrapItems: function () { this.$userItems.wrapAll('<div class="owl-wrapper">').wrap('<div class="owl-item"></div>'); this.$elem.find(".owl-wrapper").wrap('<div class="owl-wrapper-outer">'); this.wrapperOuter = this.$elem.find(".owl-wrapper-outer"); this.$elem.css("display", "block") },
		baseClass: function () { var a = this.$elem.hasClass(this.options.baseClass), b = this.$elem.hasClass(this.options.theme); a || this.$elem.addClass(this.options.baseClass); b || this.$elem.addClass(this.options.theme) }, updateItems: function () {
			var a, b; if (!1 === this.options.responsive) return !1; if (!0 === this.options.singleItem) return this.options.items = this.orignalItems = 1, this.options.itemsCustom = !1, this.options.itemsDesktop = !1, this.options.itemsDesktopSmall = !1, this.options.itemsTablet = !1, this.options.itemsTabletSmall =
			!1, this.options.itemsMobile = !1; a = f(this.options.responsiveBaseWidth).width(); a > (this.options.itemsDesktop[0] || this.orignalItems) && (this.options.items = this.orignalItems); if (!1 !== this.options.itemsCustom) for (this.options.itemsCustom.sort(function (a, b) { return a[0] - b[0] }), b = 0; b < this.options.itemsCustom.length; b += 1) this.options.itemsCustom[b][0] <= a && (this.options.items = this.options.itemsCustom[b][1]); else a <= this.options.itemsDesktop[0] && !1 !== this.options.itemsDesktop && (this.options.items = this.options.itemsDesktop[1]),
			a <= this.options.itemsDesktopSmall[0] && !1 !== this.options.itemsDesktopSmall && (this.options.items = this.options.itemsDesktopSmall[1]), a <= this.options.itemsTablet[0] && !1 !== this.options.itemsTablet && (this.options.items = this.options.itemsTablet[1]), a <= this.options.itemsTabletSmall[0] && !1 !== this.options.itemsTabletSmall && (this.options.items = this.options.itemsTabletSmall[1]), a <= this.options.itemsMobile[0] && !1 !== this.options.itemsMobile && (this.options.items = this.options.itemsMobile[1]); this.options.items > this.itemsAmount &&
			!0 === this.options.itemsScaleUp && (this.options.items = this.itemsAmount)
		}, response: function () { var a = this, b, e; if (!0 !== a.options.responsive) return !1; e = f(g).width(); a.resizer = function () { f(g).width() !== e && (!1 !== a.options.autoPlay && g.clearInterval(a.autoPlayInterval), g.clearTimeout(b), b = g.setTimeout(function () { e = f(g).width(); a.updateVars() }, a.options.responsiveRefreshRate)) }; f(g).resize(a.resizer) }, updatePosition: function () { this.jumpTo(this.currentItem); !1 !== this.options.autoPlay && this.checkAp() }, appendItemsSizes: function () {
			var a =
			this, b = 0, e = a.itemsAmount - a.options.items; a.$owlItems.each(function (c) { var d = f(this); d.css({ width: a.itemWidth }).data("owl-item", Number(c)); if (0 === c % a.options.items || c === e) c > e || (b += 1); d.data("owl-roundPages", b) })
		}, appendWrapperSizes: function () { this.$owlWrapper.css({ width: this.$owlItems.length * this.itemWidth * 2, left: 0 }); this.appendItemsSizes() }, calculateAll: function () { this.calculateWidth(); this.appendWrapperSizes(); this.loops(); this.max() }, calculateWidth: function () {
			this.itemWidth = Math.round(this.$elem.width() /
			this.options.items)
		}, max: function () { var a = -1 * (this.itemsAmount * this.itemWidth - this.options.items * this.itemWidth); this.options.items > this.itemsAmount ? this.maximumPixels = a = this.maximumItem = 0 : (this.maximumItem = this.itemsAmount - this.options.items, this.maximumPixels = a); return a }, min: function () { return 0 }, loops: function () {
			var a = 0, b = 0, e, c; this.positionsInArray = [0]; this.pagesInArray = []; for (e = 0; e < this.itemsAmount; e += 1) b += this.itemWidth, this.positionsInArray.push(-b), !0 === this.options.scrollPerPage && (c = f(this.$owlItems[e]),
			c = c.data("owl-roundPages"), c !== a && (this.pagesInArray[a] = this.positionsInArray[e], a = c))
		}, buildControls: function () { if (!0 === this.options.navigation || !0 === this.options.pagination) this.owlControls = f('<div class="owl-controls"/>').toggleClass("clickable", !this.browser.isTouch).appendTo(this.$elem); !0 === this.options.pagination && this.buildPagination(); !0 === this.options.navigation && this.buildButtons() }, buildButtons: function () {
			var a = this, b = f('<div class="owl-buttons"/>'); a.owlControls.append(b); a.buttonPrev =
			f("<div/>", { "class": "owl-prev", html: a.options.navigationText[0] || "" }); a.buttonNext = f("<div/>", { "class": "owl-next", html: a.options.navigationText[1] || "" }); b.append(a.buttonPrev).append(a.buttonNext); b.on("touchstart.owlControls mousedown.owlControls", 'div[class^="owl"]', function (a) { a.preventDefault() }); b.on("touchend.owlControls mouseup.owlControls", 'div[class^="owl"]', function (b) { b.preventDefault(); f(this).hasClass("owl-next") ? a.next() : a.prev() })
		}, buildPagination: function () {
			var a = this; a.paginationWrapper =
			f('<div class="owl-pagination"/>'); a.owlControls.append(a.paginationWrapper); a.paginationWrapper.on("touchend.owlControls mouseup.owlControls", ".owl-page", function (b) { b.preventDefault(); Number(f(this).data("owl-page")) !== a.currentItem && a.goTo(Number(f(this).data("owl-page")), !0) })
		}, updatePagination: function () {
			var a, b, e, c, d, g; if (!1 === this.options.pagination) return !1; this.paginationWrapper.html(""); a = 0; b = this.itemsAmount - this.itemsAmount % this.options.items; for (c = 0; c < this.itemsAmount; c += 1) 0 === c % this.options.items &&
			(a += 1, b === c && (e = this.itemsAmount - this.options.items), d = f("<div/>", { "class": "owl-page" }), g = f("<span></span>", { text: !0 === this.options.paginationNumbers ? a : "", "class": !0 === this.options.paginationNumbers ? "owl-numbers" : "" }), d.append(g), d.data("owl-page", b === c ? e : c), d.data("owl-roundPages", a), this.paginationWrapper.append(d)); this.checkPagination()
		}, checkPagination: function () {
			var a = this; if (!1 === a.options.pagination) return !1; a.paginationWrapper.find(".owl-page").each(function () {
				f(this).data("owl-roundPages") ===
				f(a.$owlItems[a.currentItem]).data("owl-roundPages") && (a.paginationWrapper.find(".owl-page").removeClass("active"), f(this).addClass("active"))
			})
		}, checkNavigation: function () {
			if (!1 === this.options.navigation) return !1; !1 === this.options.rewindNav && (0 === this.currentItem && 0 === this.maximumItem ? (this.buttonPrev.addClass("disabled"), this.buttonNext.addClass("disabled")) : 0 === this.currentItem && 0 !== this.maximumItem ? (this.buttonPrev.addClass("disabled"), this.buttonNext.removeClass("disabled")) : this.currentItem ===
			this.maximumItem ? (this.buttonPrev.removeClass("disabled"), this.buttonNext.addClass("disabled")) : 0 !== this.currentItem && this.currentItem !== this.maximumItem && (this.buttonPrev.removeClass("disabled"), this.buttonNext.removeClass("disabled")))
		}, updateControls: function () { this.updatePagination(); this.checkNavigation(); this.owlControls && (this.options.items >= this.itemsAmount ? this.owlControls.hide() : this.owlControls.show()) }, destroyControls: function () { this.owlControls && this.owlControls.remove() }, next: function (a) {
			if (this.isTransition) return !1;
			this.currentItem += !0 === this.options.scrollPerPage ? this.options.items : 1; if (this.currentItem > this.maximumItem + (!0 === this.options.scrollPerPage ? this.options.items - 1 : 0)) if (!0 === this.options.rewindNav) this.currentItem = 0, a = "rewind"; else return this.currentItem = this.maximumItem, !1; this.goTo(this.currentItem, a)
		}, prev: function (a) {
			if (this.isTransition) return !1; this.currentItem = !0 === this.options.scrollPerPage && 0 < this.currentItem && this.currentItem < this.options.items ? 0 : this.currentItem - (!0 === this.options.scrollPerPage ?
			this.options.items : 1); if (0 > this.currentItem) if (!0 === this.options.rewindNav) this.currentItem = this.maximumItem, a = "rewind"; else return this.currentItem = 0, !1; this.goTo(this.currentItem, a)
		}, goTo: function (a, b, e) {
			var c = this; if (c.isTransition) return !1; "function" === typeof c.options.beforeMove && c.options.beforeMove.apply(this, [c.$elem]); a >= c.maximumItem ? a = c.maximumItem : 0 >= a && (a = 0); c.currentItem = c.owl.currentItem = a; if (!1 !== c.options.transitionStyle && "drag" !== e && 1 === c.options.items && !0 === c.browser.support3d) return c.swapSpeed(0),
			!0 === c.browser.support3d ? c.transition3d(c.positionsInArray[a]) : c.css2slide(c.positionsInArray[a], 1), c.afterGo(), c.singleItemTransition(), !1; a = c.positionsInArray[a]; !0 === c.browser.support3d ? (c.isCss3Finish = !1, !0 === b ? (c.swapSpeed("paginationSpeed"), g.setTimeout(function () { c.isCss3Finish = !0 }, c.options.paginationSpeed)) : "rewind" === b ? (c.swapSpeed(c.options.rewindSpeed), g.setTimeout(function () { c.isCss3Finish = !0 }, c.options.rewindSpeed)) : (c.swapSpeed("slideSpeed"), g.setTimeout(function () { c.isCss3Finish = !0 },
			c.options.slideSpeed)), c.transition3d(a)) : !0 === b ? c.css2slide(a, c.options.paginationSpeed) : "rewind" === b ? c.css2slide(a, c.options.rewindSpeed) : c.css2slide(a, c.options.slideSpeed); c.afterGo()
		}, jumpTo: function (a) {
			"function" === typeof this.options.beforeMove && this.options.beforeMove.apply(this, [this.$elem]); a >= this.maximumItem || -1 === a ? a = this.maximumItem : 0 >= a && (a = 0); this.swapSpeed(0); !0 === this.browser.support3d ? this.transition3d(this.positionsInArray[a]) : this.css2slide(this.positionsInArray[a], 1); this.currentItem =
			this.owl.currentItem = a; this.afterGo()
		}, afterGo: function () { this.prevArr.push(this.currentItem); this.prevItem = this.owl.prevItem = this.prevArr[this.prevArr.length - 2]; this.prevArr.shift(0); this.prevItem !== this.currentItem && (this.checkPagination(), this.checkNavigation(), this.eachMoveUpdate(), !1 !== this.options.autoPlay && this.checkAp()); "function" === typeof this.options.afterMove && this.prevItem !== this.currentItem && this.options.afterMove.apply(this, [this.$elem]) }, stop: function () { this.apStatus = "stop"; g.clearInterval(this.autoPlayInterval) },
		checkAp: function () { "stop" !== this.apStatus && this.play() }, play: function () { var a = this; a.apStatus = "play"; if (!1 === a.options.autoPlay) return !1; g.clearInterval(a.autoPlayInterval); a.autoPlayInterval = g.setInterval(function () { a.next(!0) }, a.options.autoPlay) }, swapSpeed: function (a) { "slideSpeed" === a ? this.$owlWrapper.css(this.addCssSpeed(this.options.slideSpeed)) : "paginationSpeed" === a ? this.$owlWrapper.css(this.addCssSpeed(this.options.paginationSpeed)) : "string" !== typeof a && this.$owlWrapper.css(this.addCssSpeed(a)) },
		addCssSpeed: function (a) { return { "-webkit-transition": "all " + a + "ms ease", "-moz-transition": "all " + a + "ms ease", "-o-transition": "all " + a + "ms ease", transition: "all " + a + "ms ease" } }, removeTransition: function () { return { "-webkit-transition": "", "-moz-transition": "", "-o-transition": "", transition: "" } }, doTranslate: function (a) {
			return {
				"-webkit-transform": "translate3d(" + a + "px, 0px, 0px)", "-moz-transform": "translate3d(" + a + "px, 0px, 0px)", "-o-transform": "translate3d(" + a + "px, 0px, 0px)", "-ms-transform": "translate3d(" +
				a + "px, 0px, 0px)", transform: "translate3d(" + a + "px, 0px,0px)"
			}
		}, transition3d: function (a) { this.$owlWrapper.css(this.doTranslate(a)) }, css2move: function (a) { this.$owlWrapper.css({ left: a }) }, css2slide: function (a, b) { var e = this; e.isCssFinish = !1; e.$owlWrapper.stop(!0, !0).animate({ left: a }, { duration: b || e.options.slideSpeed, complete: function () { e.isCssFinish = !0 } }) }, checkBrowser: function () {
			var a = k.createElement("div"); a.style.cssText = "  -moz-transform:translate3d(0px, 0px, 0px); -ms-transform:translate3d(0px, 0px, 0px); -o-transform:translate3d(0px, 0px, 0px); -webkit-transform:translate3d(0px, 0px, 0px); transform:translate3d(0px, 0px, 0px)";
			a = a.style.cssText.match(/translate3d\(0px, 0px, 0px\)/g); this.browser = { support3d: null !== a && 1 === a.length, isTouch: "ontouchstart" in g || g.navigator.msMaxTouchPoints }
		}, moveEvents: function () { if (!1 !== this.options.mouseDrag || !1 !== this.options.touchDrag) this.gestures(), this.disabledEvents() }, eventTypes: function () {
			var a = ["s", "e", "x"]; this.ev_types = {}; !0 === this.options.mouseDrag && !0 === this.options.touchDrag ? a = ["touchstart.owl mousedown.owl", "touchmove.owl mousemove.owl", "touchend.owl touchcancel.owl mouseup.owl"] :
			!1 === this.options.mouseDrag && !0 === this.options.touchDrag ? a = ["touchstart.owl", "touchmove.owl", "touchend.owl touchcancel.owl"] : !0 === this.options.mouseDrag && !1 === this.options.touchDrag && (a = ["mousedown.owl", "mousemove.owl", "mouseup.owl"]); this.ev_types.start = a[0]; this.ev_types.move = a[1]; this.ev_types.end = a[2]
		}, disabledEvents: function () { this.$elem.on("dragstart.owl", function (a) { a.preventDefault() }); this.$elem.on("mousedown.disableTextSelect", function (a) { return f(a.target).is("input, textarea, select, option") }) },
		gestures: function () {
			function a(a) { if (void 0 !== a.touches) return { x: a.touches[0].pageX, y: a.touches[0].pageY }; if (void 0 === a.touches) { if (void 0 !== a.pageX) return { x: a.pageX, y: a.pageY }; if (void 0 === a.pageX) return { x: a.clientX, y: a.clientY } } } function b(a) { "on" === a ? (f(k).on(d.ev_types.move, e), f(k).on(d.ev_types.end, c)) : "off" === a && (f(k).off(d.ev_types.move), f(k).off(d.ev_types.end)) } function e(b) {
				b = b.originalEvent || b || g.event; d.newPosX = a(b).x - h.offsetX; d.newPosY = a(b).y - h.offsetY; d.newRelativeX = d.newPosX - h.relativePos;
				"function" === typeof d.options.startDragging && !0 !== h.dragging && 0 !== d.newRelativeX && (h.dragging = !0, d.options.startDragging.apply(d, [d.$elem])); (8 < d.newRelativeX || -8 > d.newRelativeX) && !0 === d.browser.isTouch && (void 0 !== b.preventDefault ? b.preventDefault() : b.returnValue = !1, h.sliding = !0); (10 < d.newPosY || -10 > d.newPosY) && !1 === h.sliding && f(k).off("touchmove.owl"); d.newPosX = Math.max(Math.min(d.newPosX, d.newRelativeX / 5), d.maximumPixels + d.newRelativeX / 5); !0 === d.browser.support3d ? d.transition3d(d.newPosX) : d.css2move(d.newPosX)
			}
			function c(a) {
				a = a.originalEvent || a || g.event; var c; a.target = a.target || a.srcElement; h.dragging = !1; !0 !== d.browser.isTouch && d.$owlWrapper.removeClass("grabbing"); d.dragDirection = 0 > d.newRelativeX ? d.owl.dragDirection = "left" : d.owl.dragDirection = "right"; 0 !== d.newRelativeX && (c = d.getNewPosition(), d.goTo(c, !1, "drag"), h.targetElement === a.target && !0 !== d.browser.isTouch && (f(a.target).on("click.disable", function (a) { a.stopImmediatePropagation(); a.stopPropagation(); a.preventDefault(); f(a.target).off("click.disable") }),
				a = f._data(a.target, "events").click, c = a.pop(), a.splice(0, 0, c))); b("off")
			} var d = this, h = { offsetX: 0, offsetY: 0, baseElWidth: 0, relativePos: 0, position: null, minSwipe: null, maxSwipe: null, sliding: null, dargging: null, targetElement: null }; d.isCssFinish = !0; d.$elem.on(d.ev_types.start, ".owl-wrapper", function (c) {
				c = c.originalEvent || c || g.event; var e; if (3 === c.which) return !1; if (!(d.itemsAmount <= d.options.items)) {
					if (!1 === d.isCssFinish && !d.options.dragBeforeAnimFinish || !1 === d.isCss3Finish && !d.options.dragBeforeAnimFinish) return !1;
					!1 !== d.options.autoPlay && g.clearInterval(d.autoPlayInterval); !0 === d.browser.isTouch || d.$owlWrapper.hasClass("grabbing") || d.$owlWrapper.addClass("grabbing"); d.newPosX = 0; d.newRelativeX = 0; f(this).css(d.removeTransition()); e = f(this).position(); h.relativePos = e.left; h.offsetX = a(c).x - e.left; h.offsetY = a(c).y - e.top; b("on"); h.sliding = !1; h.targetElement = c.target || c.srcElement
				}
			})
		}, getNewPosition: function () {
			var a = this.closestItem(); a > this.maximumItem ? a = this.currentItem = this.maximumItem : 0 <= this.newPosX && (this.currentItem =
			a = 0); return a
		}, closestItem: function () {
			var a = this, b = !0 === a.options.scrollPerPage ? a.pagesInArray : a.positionsInArray, e = a.newPosX, c = null; f.each(b, function (d, g) {
				e - a.itemWidth / 20 > b[d + 1] && e - a.itemWidth / 20 < g && "left" === a.moveDirection() ? (c = g, a.currentItem = !0 === a.options.scrollPerPage ? f.inArray(c, a.positionsInArray) : d) : e + a.itemWidth / 20 < g && e + a.itemWidth / 20 > (b[d + 1] || b[d] - a.itemWidth) && "right" === a.moveDirection() && (!0 === a.options.scrollPerPage ? (c = b[d + 1] || b[b.length - 1], a.currentItem = f.inArray(c, a.positionsInArray)) :
				(c = b[d + 1], a.currentItem = d + 1))
			}); return a.currentItem
		}, moveDirection: function () { var a; 0 > this.newRelativeX ? (a = "right", this.playDirection = "next") : (a = "left", this.playDirection = "prev"); return a }, customEvents: function () {
			var a = this; a.$elem.on("owl.next", function () { a.next() }); a.$elem.on("owl.prev", function () { a.prev() }); a.$elem.on("owl.play", function (b, e) { a.options.autoPlay = e; a.play(); a.hoverStatus = "play" }); a.$elem.on("owl.stop", function () { a.stop(); a.hoverStatus = "stop" }); a.$elem.on("owl.goTo", function (b, e) { a.goTo(e) });
			a.$elem.on("owl.jumpTo", function (b, e) { a.jumpTo(e) })
		}, stopOnHover: function () { var a = this; !0 === a.options.stopOnHover && !0 !== a.browser.isTouch && !1 !== a.options.autoPlay && (a.$elem.on("mouseover", function () { a.stop() }), a.$elem.on("mouseout", function () { "stop" !== a.hoverStatus && a.play() })) }, lazyLoad: function () {
			var a, b, e, c, d; if (!1 === this.options.lazyLoad) return !1; for (a = 0; a < this.itemsAmount; a += 1) b = f(this.$owlItems[a]), "loaded" !== b.data("owl-loaded") && (e = b.data("owl-item"), c = b.find(".lazyOwl"), "string" !== typeof c.data("src") ?
			b.data("owl-loaded", "loaded") : (void 0 === b.data("owl-loaded") && (c.hide(), b.addClass("loading").data("owl-loaded", "checked")), (d = !0 === this.options.lazyFollow ? e >= this.currentItem : !0) && e < this.currentItem + this.options.items && c.length && this.lazyPreload(b, c)))
		}, lazyPreload: function (a, b) {
			function e() {
				a.data("owl-loaded", "loaded").removeClass("loading"); b.removeAttr("data-src"); "fade" === d.options.lazyEffect ? b.fadeIn(400) : b.show(); "function" === typeof d.options.afterLazyLoad && d.options.afterLazyLoad.apply(this,
				[d.$elem])
			} function c() { f += 1; d.completeImg(b.get(0)) || !0 === k ? e() : 100 >= f ? g.setTimeout(c, 100) : e() } var d = this, f = 0, k; "DIV" === b.prop("tagName") ? (b.css("background-image", "url(" + b.data("src") + ")"), k = !0) : b[0].src = b.data("src"); c()
		}, autoHeight: function () {
			function a() { var a = f(e.$owlItems[e.currentItem]).height(); e.wrapperOuter.css("height", a + "px"); e.wrapperOuter.hasClass("autoHeight") || g.setTimeout(function () { e.wrapperOuter.addClass("autoHeight") }, 0) } function b() {
				d += 1; e.completeImg(c.get(0)) ? a() : 100 >= d ? g.setTimeout(b,
				100) : e.wrapperOuter.css("height", "")
			} var e = this, c = f(e.$owlItems[e.currentItem]).find("img"), d; void 0 !== c.get(0) ? (d = 0, b()) : a()
		}, completeImg: function (a) { return !a.complete || "undefined" !== typeof a.naturalWidth && 0 === a.naturalWidth ? !1 : !0 }, onVisibleItems: function () {
			var a; !0 === this.options.addClassActive && this.$owlItems.removeClass("active"); this.visibleItems = []; for (a = this.currentItem; a < this.currentItem + this.options.items; a += 1) this.visibleItems.push(a), !0 === this.options.addClassActive && f(this.$owlItems[a]).addClass("active");
			this.owl.visibleItems = this.visibleItems
		}, transitionTypes: function (a) { this.outClass = "owl-" + a + "-out"; this.inClass = "owl-" + a + "-in" }, singleItemTransition: function () {
			var a = this, b = a.outClass, e = a.inClass, c = a.$owlItems.eq(a.currentItem), d = a.$owlItems.eq(a.prevItem), f = Math.abs(a.positionsInArray[a.currentItem]) + a.positionsInArray[a.prevItem], g = Math.abs(a.positionsInArray[a.currentItem]) + a.itemWidth / 2; a.isTransition = !0; a.$owlWrapper.addClass("owl-origin").css({
				"-webkit-transform-origin": g + "px", "-moz-perspective-origin": g +
				"px", "perspective-origin": g + "px"
			}); d.css({ position: "relative", left: f + "px" }).addClass(b).on("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend", function () { a.endPrev = !0; d.off("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend"); a.clearTransStyle(d, b) }); c.addClass(e).on("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend", function () { a.endCurrent = !0; c.off("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend"); a.clearTransStyle(c, e) })
		}, clearTransStyle: function (a,
		b) { a.css({ position: "", left: "" }).removeClass(b); this.endPrev && this.endCurrent && (this.$owlWrapper.removeClass("owl-origin"), this.isTransition = this.endCurrent = this.endPrev = !1) }, owlStatus: function () { this.owl = { userOptions: this.userOptions, baseElement: this.$elem, userItems: this.$userItems, owlItems: this.$owlItems, currentItem: this.currentItem, prevItem: this.prevItem, visibleItems: this.visibleItems, isTouch: this.browser.isTouch, browser: this.browser, dragDirection: this.dragDirection } }, clearEvents: function () {
			this.$elem.off(".owl owl mousedown.disableTextSelect");
			f(k).off(".owl owl"); f(g).off("resize", this.resizer)
		}, unWrap: function () { 0 !== this.$elem.children().length && (this.$owlWrapper.unwrap(), this.$userItems.unwrap().unwrap(), this.owlControls && this.owlControls.remove()); this.clearEvents(); this.$elem.attr("style", this.$elem.data("owl-originalStyles") || "").attr("class", this.$elem.data("owl-originalClasses")) }, destroy: function () { this.stop(); g.clearInterval(this.checkVisible); this.unWrap(); this.$elem.removeData() }, reinit: function (a) {
			a = f.extend({}, this.userOptions,
			a); this.unWrap(); this.init(a, this.$elem)
		}, addItem: function (a, b) { var e; if (!a) return !1; if (0 === this.$elem.children().length) return this.$elem.append(a), this.setVars(), !1; this.unWrap(); e = void 0 === b || -1 === b ? -1 : b; e >= this.$userItems.length || -1 === e ? this.$userItems.eq(-1).after(a) : this.$userItems.eq(e).before(a); this.setVars() }, removeItem: function (a) { if (0 === this.$elem.children().length) return !1; a = void 0 === a || -1 === a ? -1 : a; this.unWrap(); this.$userItems.eq(a).remove(); this.setVars() }
	}; f.fn.owlCarousel = function (a) {
		return this.each(function () {
			if (!0 ===
			f(this).data("owl-init")) return !1; f(this).data("owl-init", !0); var b = Object.create(l); b.init(a, this); f.data(this, "owlCarousel", b)
		})
	}; f.fn.owlCarousel.options = {
		items: 5, itemsCustom: !1, itemsDesktop: [1199, 4], itemsDesktopSmall: [979, 3], itemsTablet: [768, 2], itemsTabletSmall: !1, itemsMobile: [479, 1], singleItem: !1, itemsScaleUp: !1, slideSpeed: 200, paginationSpeed: 800, rewindSpeed: 1E3, autoPlay: !1, stopOnHover: !1, navigation: !1, navigationText: ["prev", "next"], rewindNav: !0, scrollPerPage: !1, pagination: !0, paginationNumbers: !1,
		responsive: !0, responsiveRefreshRate: 200, responsiveBaseWidth: g, baseClass: "owl-carousel", theme: "owl-theme", lazyLoad: !1, lazyFollow: !0, lazyEffect: "fade", autoHeight: !1, jsonPath: !1, jsonSuccess: !1, dragBeforeAnimFinish: !0, mouseDrag: !0, touchDrag: !0, addClassActive: !1, transitionStyle: !1, beforeUpdate: !1, afterUpdate: !1, beforeInit: !1, afterInit: !1, beforeMove: !1, afterMove: !1, afterAction: !1, startDragging: !1, afterLazyLoad: !1
	}
})(jQuery, window, document);

/*
 * debouncedresize: special jQuery event that happens once after a window resize
 *
 * latest version and complete README available on Github:
 * https://github.com/louisremi/jquery-smartresize
 *
 * Copyright 2012 @louis_remi
 * Licensed under the MIT license.
 *
 * This saved you an hour of work? 
 * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON
 */
(function($) {

var $event = $.event,
	$special,
	resizeTimeout;

$special = $event.special.debouncedresize = {
	setup: function() {
		$( this ).on( "resize", $special.handler );
	},
	teardown: function() {
		$( this ).off( "resize", $special.handler );
	},
	handler: function( event, execAsap ) {
		// Save the context
		var context = this,
			args = arguments,
			dispatch = function() {
				// set correct event type
				event.type = "debouncedresize";
				$event.dispatch.apply( context, args );
			};

		if ( resizeTimeout ) {
			clearTimeout( resizeTimeout );
		}

		execAsap ?
			dispatch() :
			resizeTimeout = setTimeout( dispatch, $special.threshold );
	},
	threshold: 150
};

})(jQuery);


/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

(function ($) {
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function (xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;

		//get the starting position of each element to have parallax applied to it		
		$this.each(function () {
			firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function (jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function (jqo) {
				return jqo.height();
			};
		}

		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;

		// function to be called whenever the window is scrolled or resized
		function update() {
			var pos = $window.scrollTop();

			$this.each(function () {
				var $element = $(this);
				var top = $element.offset().top;
				var height = getHeight($element);

				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}

				$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
			});
		}

		$window.bind('scroll', update).resize(update);
		update();
	};
})(jQuery);




/*
 * jQuery.appear
 * https://github.com/bas2k/jquery.appear/
 * http://code.google.com/p/jquery-appear/
 * http://bas2k.ru/
 *
 * Copyright (c) 2009 Michael Hixson
 * Copyright (c) 2012-2014 Alexander Brovikov
 * Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
 */
(function ($) {
	$.fn.appear = function (fn, options) {

		var settings = $.extend({

			//arbitrary data to pass to fn
			data: undefined,

			//call fn only on the first appear?
			one: true,

			// X & Y accuracy
			accX: 0,
			accY: 0

		}, options);

		return this.each(function () {

			var t = $(this);

			//whether the element is currently visible
			t.appeared = false;

			if (!fn) {

				//trigger the custom event
				t.trigger('appear', settings.data);
				return;
			}

			var w = $(window);

			//fires the appear event when appropriate
			var check = function () {

				//is the element hidden?
				if (!t.is(':visible')) {

					//it became hidden
					t.appeared = false;
					return;
				}

				//is the element inside the visible window?
				var a = w.scrollLeft();
				var b = w.scrollTop();
				var o = t.offset();
				var x = o.left;
				var y = o.top;

				var ax = settings.accX;
				var ay = settings.accY;
				var th = t.height();
				var wh = w.height();
				var tw = t.width();
				var ww = w.width();

				if (y + th + ay >= b &&
					y <= b + wh + ay &&
					x + tw + ax >= a &&
					x <= a + ww + ax) {

					//trigger the custom event
					if (!t.appeared) t.trigger('appear', settings.data);

				} else {

					//it scrolled out of view
					t.appeared = false;
				}
			};

			//create a modified fn with some additional logic
			var modifiedFn = function () {

				//mark the element as visible
				t.appeared = true;

				//is this supposed to happen only once?
				if (settings.one) {

					//remove the check
					w.unbind('scroll', check);
					var i = $.inArray(check, $.fn.appear.checks);
					if (i >= 0) $.fn.appear.checks.splice(i, 1);
				}

				//trigger the original fn
				fn.apply(this, arguments);
			};

			//bind the modified fn to the element
			if (settings.one) t.one('appear', settings.data, modifiedFn);
			else t.bind('appear', settings.data, modifiedFn);

			//check whenever the window scrolls
			w.scroll(check);

			//check whenever the dom changes
			$.fn.appear.checks.push(check);

			//check now
			(check)();
		});
	};

	//keep a queue of appearance checks
	$.extend($.fn.appear, {

		checks: [],
		timeout: null,

		//process the queue
		checkAll: function () {
			var length = $.fn.appear.checks.length;
			if (length > 0) while (length--) ($.fn.appear.checks[length])();
		},

		//check the queue asynchronously
		run: function () {
			if ($.fn.appear.timeout) clearTimeout($.fn.appear.timeout);
			$.fn.appear.timeout = setTimeout($.fn.appear.checkAll, 20);
		}
	});

	//run checks when these methods are called
	$.each(['append', 'prepend', 'after', 'before', 'attr',
		'removeAttr', 'addClass', 'removeClass', 'toggleClass',
		'remove', 'css', 'show', 'hide'], function (i, n) {
			var old = $.fn[n];
			if (old) {
				$.fn[n] = function () {
					var r = old.apply(this, arguments);
					$.fn.appear.run();
					return r;
				}
			}
		});

})(jQuery);
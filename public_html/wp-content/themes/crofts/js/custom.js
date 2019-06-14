/*	Menu START */
jQuery(function(){
	"use strict";
	// main navigation init
	jQuery('.sf-menu').superfish({
		delay:	300,	// one second delay on mouseout 
		animation:   {opacity:'show',height:'show'}, // fade-in and slide-down animation
		speed:       'fast',  // faster animation speed 
		autoArrows:  true,   // generation of arrow mark-up (for submenu) 
		dropShadows: false
	});
});
 /*	Menu END */
 
/*	Heights START */
 jQuery(document).ready(function(){
 	var logoHeight = jQuery('#logoImage').height() + 16;
 	var serachTop = (logoHeight-39)/2;
	var headerHeight = document.getElementById('header').offsetHeight;
	jQuery(".container-wrapper").css("padding-top", logoHeight+"px");
	jQuery(".main-menu ul.sf-menu > li > a").css("line-height", logoHeight+"px");
	jQuery(".header-wrapper").css("height", logoHeight+"px");
	jQuery(".header-search").css("top", serachTop+"px");
	
	if (jQuery("#footer").length > 0) {
		var footerHeight = document.getElementById('footer').offsetHeight;
		jQuery(".container-wrapper").css("padding-bottom", footerHeight+"px");
	}
	
});

jQuery(window).load(function(){
 	var logoHeight = jQuery('#logoImage').height() + 16;
 	var serachTop = (logoHeight-39)/2;
	var headerHeight = document.getElementById('header').offsetHeight;
	jQuery(".container-wrapper").css("padding-top", logoHeight+"px");
	jQuery(".main-menu ul.sf-menu > li > a").css("line-height", logoHeight+"px");
	jQuery(".header-wrapper").css("height", logoHeight+"px");
	jQuery(".header-search").css("top", serachTop+"px");
	
	if (jQuery("#footer").length > 0) {
		var footerHeight = document.getElementById('footer').offsetHeight;
		jQuery(".container-wrapper").css("padding-bottom", footerHeight+"px");
	}
});
/*	Heights END */
 
 /* loading animation START */
 
 jQuery(document).ready(function($) {
  
  $(".animsition").animsition({
  
    inClass               :   'overlay-slide-in-top',
    outClass              :   'overlay-slide-out-top',
    inDuration            :    1500,
    outDuration           :    800,
    linkElement           :   '.animsition-link',
    // e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
    loading               :    true,
    loadingParentElement  :   'body', //animsition wrapper element
    loadingClass          :   'animsition-loading',
    unSupportCss          : [ 'animation-duration',
                              '-webkit-animation-duration',
                              '-o-animation-duration'
                            ],
    //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
    //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
    
    overlay               :   true,
    
    overlayClass          :   'animsition-overlay-slide',
    overlayParentElement  :   'body'
  });
});

/* loading animation START */



if (jQuery("#trigger-overlay").length > 0) {
	(function() {
		var container = document.querySelector( 'div.global-wrapper' ),
			triggerBttn = document.getElementById( 'trigger-overlay' ),
			overlay = document.querySelector( 'div.fulloverlay' ),
			closeBttn = overlay.querySelector( 'button.overlay-close' );
			transEndEventNames = {
				'WebkitTransition': 'webkitTransitionEnd',
				'MozTransition': 'transitionend',
				'OTransition': 'oTransitionEnd',
				'msTransition': 'MSTransitionEnd',
				'transition': 'transitionend'
			},
			transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
			support = { transitions : Modernizr.csstransitions };

		function toggleOverlay() {
			if( classie.has( overlay, 'open' ) ) {
				classie.remove( overlay, 'open' );
				classie.remove( container, 'overlay-open' );
				classie.add( overlay, 'close' );
				var onEndTransitionFn = function( ev ) {
					if( support.transitions ) {
						if( ev.propertyName !== 'visibility' ) return;
						this.removeEventListener( transEndEventName, onEndTransitionFn );
					}
					classie.remove( overlay, 'close' );
				};
				if( support.transitions ) {
					overlay.addEventListener( transEndEventName, onEndTransitionFn );
				}
				else {
					onEndTransitionFn();
				}
			}
			else if( !classie.has( overlay, 'close' ) ) {
				classie.add( overlay, 'open' );
				classie.add( container, 'overlay-open' );
			}
		}

		triggerBttn.addEventListener( 'click', toggleOverlay );
		closeBttn.addEventListener( 'click', toggleOverlay );
	})();
}


/*	Testimonials START */
if (jQuery(".owl-carousel.testimonials-wrapper").length > 0) {
jQuery(document).ready(function() {
  var owl = jQuery(".owl-carousel.testimonials-wrapper");
  owl.owlCarousel({
     
      itemsCustom : [
        [0, 1],
        [450, 1],
        [600, 1],
        [700, 1],
        [1000, 1],
        [1200, 1],
        [1400, 1],
        [1600, 1]
      ],
      navigation : false,
      pagination : true,
      autoPlay: 5000
  });
});
}
/*	Testimonials END */

/* Circle progress bar START */
function easyCharts() {
	   jQuery('.easyPieChart').each(function () {
			var $this, $parent_width, $chart_size;
			$this =jQuery(this);
			$parent_width = jQuery(this).parent().width();
			$chart_size = $this.attr('data-barSize');
			if (!$this.hasClass('chart-animated')) {
				$this.easyPieChart({
					animate: 3000,
					lineCap: 'round',
					lineWidth: $this.attr('data-lineWidth'),
					size: $chart_size,
					barColor: $this.attr('data-barColor'),
					trackColor: $this.attr('data-trackColor'),
					scaleColor: 'transparent',
					onStep: function (value) {
						this.$el.find('.chart-percent span').text(Math.ceil(value));
					}
				});
			}
		});
 }

jQuery(document).ready(function () {
	easyCharts();
});

/* Circle progress bar END */

/* pretty photo START */
jQuery(window).load(function(){
	if (jQuery("a[data-gal^='prettyPhoto']").length > 0) {
		jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({hook: 'data-gal'});
	}
});
/* pretty photo END */	



/* Carousel START */
if (jQuery(".carousel").length > 0) {
jQuery(document).ready(function() {
	jQuery('.carousel').carousel({
        interval: 5000 //changes the speed
    })
});
}
/* Carousel END */

/* Portfolio single slide START */
jQuery(document).ready(function() {
	var folio_details_opened = false;
	jQuery(".portfolio-single-type2-visible-content").click(function(){
		
		if (folio_details_opened == false) {
			jQuery(".carousel").addClass('shrink');
			jQuery(".portfolio-single-type2-hidden-content").addClass('showit');
			jQuery(".portfolio-single-type2-visible-content").addClass('showit');
			folio_details_opened = true;
		}
		else {
			jQuery(".carousel").removeClass('shrink');
			jQuery(".portfolio-single-type2-hidden-content").removeClass('showit');
			jQuery(".portfolio-single-type2-visible-content").removeClass('showit');
			folio_details_opened = false;
		}
  	});
  	
  	var sidebar_opened = false;
  	jQuery(".sidebar-open-icon").click(function(){
		jQuery(".sidebar-wrap").addClass('showit');
  	});
  	jQuery(".close-button").click(function(){
		jQuery(".sidebar-wrap").removeClass('showit');
  	});
  });
/* Portfolio single slide START */

/* mobile menu */

jQuery(document).ready(function($){
	var slide = false;
	$(".mobile-menu-show").click(function(){
	
		if (slide == false) {
			$(".mobile-menu-wrapper").slideDown("slow");
			slide = true;
		}
		else {
			$(".mobile-menu-wrapper").slideUp("slow");
			slide = false;
		}
  	});
});

/* Portfolio filter */
if (jQuery(".pego-isotope-wrapper").length > 0) {	
jQuery(document).ready(function(){

 jQuery(function() {
	var container = jQuery(".pego-isotope-wrapper");
	      container.isotope({
			itemSelector : ".isotope-item",
			layoutMode: "masonry",
			transitionDuration: "0.7s"	
      });
      var optionSets = jQuery(".option-set"),
          optionLinks = optionSets.find("a");

      optionLinks.click(function(){
        var $this = jQuery(this);
        
        if ( $this.hasClass("selected") ) {
          return false;
        }
        var optionSet = $this.parents(".option-set");
        optionSet.find(".selected").removeClass("selected");
        $this.addClass("selected");
  
        var options = {},
            key = optionSet.attr("data-option-key"),
            value = $this.attr("data-option-value");
     
        value = value === "false" ? false : value;
        options[ key ] = value;
        if ( key === "layoutMode" && typeof changeLayoutMode === "function" ) {
         
          changeLayoutMode( $this, options )
        } else {
          // otherwise, apply new options
          container.isotope( options );
        }
        
        return false;
      });
	
	
 });
});  

jQuery(window).load(function(){
	var container = jQuery(".pego-isotope-wrapper");
	    container.isotope({
		itemSelector : ".isotope-item",
		layoutMode: "masonry",
		transitionDuration: "0.7s"	
    });
});

jQuery(window).load(function(){
 	setTimeout(function(){
		var container = jQuery(".pego-isotope-wrapper");
	        container.isotope({
			itemSelector : ".isotope-item",
			layoutMode: "masonry",
			transitionDuration: "0.7s"	
      });
	  },700);
});

(function($,sr){

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 100);
      };
  }
  // smartresize 
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');


jQuery(window).smartresize(function(){
	"use strict";
  	var container = jQuery(".pego-isotope-wrapper");
	    container.isotope({
		itemSelector : ".isotope-item",
		layoutMode: "masonry",
		transitionDuration: "0.7s"	
    });
});
}

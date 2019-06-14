<?php
/**
 * Template Name: Service Template 4
 * The main template file for display service page.
 *
 * @package WordPress
 */

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

$page_ft_vimeo = get_post_meta($post->ID, 'page_ft_vimeo', true);

//important to apply dynamic header & footer style
global $pp_homepage_style;
$pp_homepage_style = 'fullscreen';

get_header();
?>
<style type="text/css">
.cs-col img,.logo-landing{max-width:100%}#cs1-form,.header_style_wrapper{display:none!important}html[data-style=fullscreen],html[data-style=fullscreen] body{overflow:visible!important;height:auto;max-height:auto}.cs-col{float:left;padding-left:2%;padding-right:2%;margin-bottom:30px}.cs-col-3{width:25%;text-align:center;margin-bottom:0;padding:0}.landing-nav .cs-col a{padding:15px 0;width:100%;font-size:16px;position:relative;border:1px solid #000;float:left}.landing-nav .cs-col a:hover{background:#000;content:#fff}.cs-col-4{width:29.3333%}.cs-col-6{width:50%;margin-bottom:0;padding:0}.cs-col-12{width:100%;margin-bottom:-5px;padding:0}.cs-col-4-nav{width:33.3333%;text-align:center;margin-bottom:0;padding:0}.landing-soc{position:absolute;top:20px;right:50px}.rev-cont{padding:0 50px;float:left}.rev-cont-cs{padding:20px;float:left}.rev-cont-cs-cont{max-width:1180px;margin:auto}.rev-cont .textwidget{max-width:500px;width:100%}.wpac .wp-google-place{background-color:#222!important;color:#fff!important}.wpac .wp-google-right .wp-google-name a span{color:#fff!important}.wpac .wp-google-place .wp-google-left img{opacity:0}.show-form{width:100%;float:left;background:#222;padding-top:20px;padding-bottom:20px;margin-bottom:0}.show-form h2{font-size:22px;line-height:49px}@media screen and (min-width:992px){.push-right{float:right}.push-left{float:left}}@media screen and (max-width:991px){.landing-soc{position:relative;top:0;right:0}.cs-col{padding-left:0;padding-right:0}.cs-col-3,.cs-col-4,.cs-col-4-nav,.cs-col-6{width:100%;overflow:hidden}.rev-cont{padding:0}.landing-nav .cs-col a{border-left:none!important;border-right:none!important}.landing-nav .cs-col-4-nav{display:none}@media screen and (max-width:963px){.woocommerce #content table.cart td.actions .coupon .input-text,.woocommerce table.cart td.actions .coupon .input-text,.woocommerce-page #content table.cart td.actions .coupon .input-text,.woocommerce-page table.cart td.actions .coupon .input-text,input.wpcf7-text,input[type=date],input[type=email],input[type=password],input[type=text],input[type=url],select{padding:5px!important}.cs-form-gr input[type=submit]{padding:5px 10px;width:120px}.cs-form-gr{text-align:center}.show-form h2{font-size:20px;line-height:15px}.cs-form-gr-c{display:none}.show-form h2 span{border:1px solid #fff;padding:2px 5px;text-align:center;box-shadow:0 0 4px #ccc}}}
</style>
<div id="landing-page-new">
	<div class="landing-nav" style="float:left;width: 100%;height: 100%">
		<div style="text-align: center; width: 100%; height: 100%; float: left; position: relative;">
		<div class="landing-soc">
			<div class="social_wrapper">
				<ul style="text-align: right;">
				<li class="facebook"><a target="_blank" title="Houzz" href="http://www.houzz.co.uk/pro/communitec/__public"><i class="icon-houzz-dark"></i></a></li>
				<li class="facebook"><a target="_blank" href="https://www.facebook.com/communitec"><i class="fa fa-facebook"></i></a></li>
				<li class="twitter"><a target="_blank" href="http://twitter.com/communitecltd"><i class="fa fa-twitter"></i></a></li>
				<li class="linkedin"><a target="_blank" title="Linkedin" href="https://www.linkedin.com/company/communitec-ltd"><i class="fa fa-linkedin"></i></a></li>
				<li class="pinterest"><a target="_blank" title="Pinterest" href="http://pinterest.com/communitec"><i class="fa fa-pinterest"></i></a></li>
				<li class="instagram"><a target="_blank" title="Instagram" href="http://instagram.com/communitec"><i class="fa fa-instagram"></i></a></li>
				</ul>
			</div>
		</div>
			<a href="http://av.communitec.co/"><img src="<?php bloginfo('url'); ?>/wp-content/uploads/2016/06/Comtec_Logo_B.png" alt="communitec" class="logo-landing"></a></div>
		<div class="cs-col cs-col-4-nav">
			<a class="anchor-link" href="#Reviews">Reviews</a>
		</div>
		<div class="cs-col cs-col-4-nav">
			<a class="anchor-link" href="#About-Us">About Us</a>
		</div>
		<div class="cs-col cs-col-4-nav">
			<a target="_blank" href="http://av.communitec.co/brochure/">Brochure</a>
		</div>
	</div>

	<div class="rev-s" style="float:left;width: 100%;height: 100%; border-top: 10px solid #000">
		<?php echo do_shortcode('[rev_slider alias="lpsecurity"]') ?>
	</div>
	<div class="show-form" style="display: block !important;float:left;width: 100%;height: 100%;"><?php echo do_shortcode( '[contact-form-7 id="4592" title="Free Consultation"]' ); ?></div>
	<div style="text-align: center;float:left;width: 100%;height: 100%;padding-top: 30px;padding-bottom: 30px;border-bottom: 2px solid #222;" id="About-Us">
		<div class="page_title_wrapper">
			<div class="page_title_inner">
			<h2>About Us</h2>
			</div>
		</div>

		<div class="ppb_wrapper">
			<div class="one withsmallpadding ppb_text" style="padding:30px; max-width: 992px; margin-left:auto;margin-left:right;">
				<p style="text-align: center;">A smart home needs smart security, and here at Communitec AV we provide cutting edge security solutions from market leaders such as HikVision, Lilin, Invixium and Texecom. We fully integrate CCTV, alarms, and smart locking using systems such as fingerprint recognition – and can integrate these systems to be monitored from your phone or tablet. So wherever you are in the world, you can have total peace of mind about the safety of your home.</p>
			</div>
		</div>
		<div class="one withsmallpadding ppb_text" style="padding:30px; padding-top: 0;">
			<p style="text-align: center;"><img style="max-width: 100%;" src="http://av.communitec.co/wp-content/uploads/2017/02/Security-Brands.jpg" alt=""></p>
		</div>

		<div class="ppb_wrapper">
			<div class="one withsmallpadding ppb_text" style="padding:30px; max-width: 600px; margin-left:auto;margin-left:right;text-align: center;">
				<p style="text-align: center;"><div><strong>Call us for a free consultation: </strong><br /><span class="number">+44 (0) 203-700-8585</span></div></p>
			</div>
		</div>
	</div>
	<div style="text-align: center;float:left;width: 100%;height: 100%;padding-top: 30px;" id="Services">
		<div class="page_title_wrapper">
			<div class="page_title_inner">
			<h2 style="padding-bottom: 30px;">SECURITY</h2>
			</div>
		</div>

	<div class="ppb_wrapper" style="float:left;width: 100%;height: 100%">
		<div class="cs-col cs-col-12 withsmallpadding ppb_text">
			<div class="cs-col cs-col-6">
				<div>
					<a href="http://av.communitec.co/portfolios/security/"><img src="http://av.communitec.co/wp-content/uploads/2016/11/COMMUNITEC.016.jpg" alt="Smart, TV, Home, Automation, London"></a>
				</div>
			</div>
			<div class="cs-col cs-col-6">
				<div style="padding:20px; max-width: 768px;">
					<h4 style="text-align: left;">CCTV</h4>
					<p style="text-align: left;">We install durable and secure CCTV solutions, which can be viewed remotely, via a mobile phone or tablet. We offer a wide range of possible CCTV systems with features including nightvision, 360 coverage and motion detection.</p>
				</div>
			</div>
		</div>
		<div class="cs-col cs-col-12 withsmallpadding ppb_text">					
			<div class="cs-col cs-col-6 push-right">
				<div>
					<a href="http://av.communitec.co/portfolios/security/"><img src="http://av.communitec.co/wp-content/uploads/2017/02/alarm.jpg" alt="savant, alarm, smart home, smarthome, remote"></a>
				</div>
			</div>
			<div class="cs-col cs-col-6 push-left">
				<div style="padding:20px; max-width: 768px;" class="push-right">
					<h4 style="text-align: left;">Alarms</h4>
					<p style="text-align: left;">We install high quality, responsive alarms, which cover front and back entries, to full, floor-specific alarm systems. Crucially, these systems are capable of being securely armed or disarmed remotely.</p>
				</div>
			</div>
		</div>	
		<div class="cs-col cs-col-12 withsmallpadding ppb_text">
			<div class="cs-col cs-col-6">
				<div>
					<a href="http://av.communitec.co/portfolios/security/"><img src="http://av.communitec.co/wp-content/uploads/2016/06/4.414A9648-1.jpg" alt="Home, Cinema, TV, Projector, Speakers, Surround Sound, Lighting"></a>
				</div>
			</div>
			<div class="cs-col cs-col-6">
				<div style="padding:20px; max-width: 768px;">
					<h4 style="text-align: left;">Door Entry</h4>
					<p style="text-align: left;">Our door entry systems provide video and audio, directly from a property’s front door or gate. Alternatively, these door entry systems can be seen, heard and controlled through a mounted wall device, as well as through the internal phone line.</p>
				</div>
			</div>
		</div>
		<div class="cs-col cs-col-12 withsmallpadding ppb_text">					
			<div class="cs-col cs-col-6 push-right">
				<div>
					<a href="http://av.communitec.co/portfolios/security/"><img src="http://av.communitec.co/wp-content/uploads/2017/03/invixium.jpg" alt="Savant, Wall, Control, Home, Control, Smart"></a>					
				</div>
			</div>
			<div class="cs-col cs-col-6 push-left">
				<div style="padding:20px; max-width: 768px;" class="push-right">				
					<h4 style="text-align: left;">Biometric Systems</h4>		
					<p style="text-align: left;">The use of biometric systems is becoming much more prominent in security systems worldwide. Fingerprint and iris scanning door access and door entry systems provide an additional level of safety and protection to any premises and can also be remotely managed, allowing users to monitor exactly who has access to specific locations.</p>
				</div>
			</div>
		</div>	
	</div>
	<div class="ppb_wrapper">
			<div class="one withsmallpadding ppb_text" style="padding:30px; max-width: 600px; margin-left:auto;margin-left:right; text-align: center;">
				<p style="text-align: center;"><div><strong>For more information, no obligation, call us today: </strong><br /><span class="number">+44 (0) 203-700-8585</span></div></p>
			</div>
		</div>
	</div>
	<!-- <div style="border-top: 2px solid #222; border-bottom: 2px solid #222; text-align: center;float:left;width: 100%;height: 100%;padding-top: 30px;padding-bottom: 5px;">
		<div class="page_title_wrapper">
			<div class="page_title_inner">
			<h2>Savant can integrate with Brands such as</h2>
			<p><strong style="text-transform: uppercase; font-size: 20px">Some of the brands we integrate:</strong></p>
			</div>
		</div>
		<div class="ppb_wrapper">
			<div class="one withsmallpadding ppb_text" style="padding:30px; padding-top: 0;">
				<p style="text-align: center;"><img style="max-width: 100%;" src="http://av.communitec.co/wp-content/uploads/2017/03/Savant-brands.jpg" alt="Nest, Amina Speakers, Lutron Lighting, Samsung, Sony, Heatmiser, Aquavision, Sonos"></p>
			</div>
		</div>
	</div> -->
	
	
	<div style="width: 100%;margin: 20px auto; float: left; height: 100%; border-top: 2px solid #222; margin-top: 0; padding-top: 50px" id="Reviews">
		<div style="width: 100%;margin:auto;  max-width: 90%;">
			<div class="page_title_wrapper">
				<div class="page_title_inner" style="text-align: center;">
				<h2 style="padding-bottom: 30px">Reviews</h2>
				</div>
			</div>
			<div class="rev-cont-cs-cont">
				<div class="cs-col cs-col-4">
					<div class="rev-cont-cs">
						<a target="_blank" href="https://biid.org.uk/about/registered">
						<img style="max-width: 100%" src="http://av.communitec.co/wp-content/uploads/2017/02/BIID_MEMBER.jpg" alt="BIID, Interior Design"></a>
						<h4>BIID</h4>
						<p>Only professionals that have over 6 years of industry experience can achieve the highest standards set by Britain’s most prestigious interior design body. We are proud to be one of their premier suppliers.</p>
					</div>
				</div>
				<div class="cs-col cs-col-4">
					<div class="rev-cont-cs">
						<a target="_blank" href="http://www.cedia.co.uk/about-cedia">
						<img style="max-width: 100%" src="http://av.communitec.co/wp-content/uploads/2017/02/CEDIA_Member.jpg" alt="CEDIA, Communitec"></a>
						<h4>CEDIA</h4>
						<p>The CEDIA mark guarantees the highest levels of ethics, expertise and customer satisfaction from AV companies. It means you can be certain of our ethics and acumen.</p>
					</div>
				</div>
				<div class="cs-col cs-col-4">
					<div class="rev-cont-cs">
						<a target="_blank" href="https://www.houzz.co.uk/pro/communitec/__public">
						<img style="max-width: 100%" src="http://av.communitec.co/wp-content/uploads/2017/02/best-of-houzz-20172.jpg" alt="Houzz, Communitec, Best, Service, 2017"></a>
						<h4>Best of Houzz Customer Service 2017</h4>
						<p>Selected through a community of over 40 million Houzz users, Communitec AV has been recognised and awarded as an outstanding leader in customer service.</p>
					</div>
				</div>
			</div>
			<div class="cs-col cs-col-6">
				<div class="rev-cont" style="    float: right; max-width: 500px">
					<?php echo do_shortcode( '[widget id="grw_widget-3"]' ); ?>
				</div>
			</div>
			<div class="cs-col cs-col-6">
				<div class="rev-cont">
					<?php echo do_shortcode( '[widget id="text-2"]' ); ?>
				</div>
			</div>
	</div>
	<div class="show-form" style="width: 100%;float: left;background: #222;margin-bottom: 0;padding-top: 20px;"><?php echo do_shortcode( '[contact-form-7 id="4592" title="Free Consultation"]' ); ?></div>
	<div style="float:left;width: 100%;height: 100%;">
		<div class="page_title_wrapper" style="text-align: center; padding: 20px 0;">
			<div class="page_title_inner">
			<h2>Portfolio projects:</h2>
			</div>
		</div>
	</div>
	<div class="rev-s" style="float:left;width: 100%;height: 100%;">
		<?php echo do_shortcode('[rev_slider alias="landing"]') ?>
	</div>
	<div class="ppb_wrapper">
			<div class="one withsmallpadding ppb_text" style="padding:30px; max-width: 600px; margin-left:auto;margin-left:right; text-align: center;">
				<p style="text-align: center;"><div><strong>Call us for a free consultation: </strong><br /><span class="number">+44 (0) 203-700-8585</span></div></p>
			</div>
		</div>
	<div class="rev-s" style="float:left;width: 100%;height: 100%; border-top: 10px solid #000">
		<?php echo do_shortcode('[rev_slider alias="landing-brochure"]') ?>
	</div>
	<div style="width: 90%;float: left;background: #fff;margin-bottom: 20px;padding-top: 20px;margin-left: 5%;margin-right: auto;">
		<p style="padding: 20px 5px; text-align: center;">Communitec Ltd<br />Company Number: 06235021 <br />VAT Number: GB110350187<br /><strong>Communitec Ltd Professionals in Smart Home Solutions and Integrations</strong></p>
		<div class="cs-col cs-col-6">
			<p>© Copyright Communitec AV 2017</p>
		</div>
		<div class="cs-col cs-col-6">
			<div class="social_wrapper">
				<ul style="text-align: right;">
				<li class="facebook"><a target="_blank" title="Houzz" href="http://www.houzz.co.uk/pro/communitec/__public"><i class="icon-houzz-dark"></i></a></li>
				<li class="facebook"><a target="_blank" href="https://www.facebook.com/communitec"><i class="fa fa-facebook"></i></a></li>
				<li class="twitter"><a target="_blank" href="http://twitter.com/communitecltd"><i class="fa fa-twitter"></i></a></li>
				<li class="linkedin"><a target="_blank" title="Linkedin" href="https://www.linkedin.com/company/communitec-ltd"><i class="fa fa-linkedin"></i></a></li>
				<li class="pinterest"><a target="_blank" title="Pinterest" href="http://pinterest.com/communitec"><i class="fa fa-pinterest"></i></a></li>
				<li class="instagram"><a target="_blank" title="Instagram" href="http://instagram.com/communitec"><i class="fa fa-instagram"></i></a></li>
				</ul>
			</div>
		</div>
	</div>


</div>
<script type="text/javascript">
(function($) {  
	$(document).on('click', 'a.anchor-link', function(event){
	    event.preventDefault();

	    $('html, body').animate({
	        scrollTop: $( $.attr(this, 'href') ).offset().top
	    }, 500);
	});
	$('#cs-drop-consultations h2.title').on('click', function () {
		$('.cs-form-gr-c').toggle('slow');
	});
	})(jQuery);
</script>
<?php
	get_footer();
?>
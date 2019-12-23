<?php
/**
 * Template Name: Fullscreen Vimeo Video
 * The main template file for display viemo video fullscreen.
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
	.header_style_wrapper, #cs1-form {
		display: none !important;
	}
	html[data-style=fullscreen], html[data-style=fullscreen] body {
		overflow: visible !important;
		height: auto;
		max-height: auto;
	}
	.cs-col {
		float: left;
		padding-left: 2%;
		padding-right: 2%;
		margin-bottom: 30px;
	}
	.cs-col img {
		max-width: 100%;
	}
	.cs-col-3 {
		width: 25%;
    	text-align: center;
    	margin-bottom: 0;
    	padding: 0;
	}
	.landing-nav .cs-col a {
		padding: 15px 0;
		width: 100%;
		font-size: 16px;
		position: relative;
		border: 1px solid #000;
		float: left;
	}
	.landing-nav .cs-col a:hover {
		background: #000;
		content: #fff;
	}
	.cs-col-4 {
		width: 29.3333%;;
	}
	.cs-col-6 {
		width: 50%;		
    	margin-bottom: 0;
    	padding: 0;
	}
	.logo-landing {
		max-width: 100%;
	}
	.landing-soc {
		position: absolute;
		top: 20px;
		right: 50px;
	}
	.rev-cont {
		padding: 0 50px;
		float: left;
	}
	.rev-cont-cs {
		padding: 20px;
		float: left;
	}
	.rev-cont-cs-cont {
		max-width: 1180px;
		margin: auto;
	}
	.rev-cont .textwidget {
		 max-width: 500px;
		 width: 100%;
	}
	.wpac .wp-google-place {		
	    background-color: #222 !important;
	    color: #fff !important;
	}
	.wpac .wp-google-right .wp-google-name a span{
		color: #fff !important;
	}
	.wpac .wp-google-place .wp-google-left img {
		opacity: 0;
	}
	.show-form {
		width: 100%;
		float: left;
		background: #222;
		margin-bottom: 20px;
		padding-top: 20px;
		padding-bottom: 20px;
	}
	.show-form {
		margin-bottom: 0;
	}
	.show-form h2 {
		font-size: 22px;
		line-height: 49px;
	}
	@media screen and (max-width: 991px) {
		.landing-soc {
			position: relative;
			top: 0;
			right: 0;			
		}
		.cs-col {
			padding-left: 0;
			padding-right: 0;
		}
		.cs-col-6,.cs-col-4, .cs-col-3 {
			width: 100%;
			overflow: hidden;
		}
		.rev-cont {
			padding: 0 0;
		}
		.landing-nav .cs-col a {
			border-left: none !important;
			border-right: none !important;
		}
	}
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
			<a href="<?php bloginfo('url') ?>"><img src="<?php bloginfo('url') ?>/wp-content/uploads/2016/06/Comtec_Logo_B.png" alt="" class="logo-landing"></a></div>
		<div class="cs-col cs-col-3">
			<a class="anchor-link" href="#Reviews">Reviews</a>
		</div>
		<div class="cs-col cs-col-3">
			<a class="anchor-link" href="#About-Us">About Us</a>
		</div>
		<div class="cs-col cs-col-3">
			<a class="anchor-link" href="#Services">Services</a>
		</div>
		<div class="cs-col cs-col-3">
			<a target="_blank" href="<?php bloginfo('url') ?>/brochure/">Brochure</a>
		</div>
	</div>

	<div class="rev-s" style="float:left;width: 100%;height: 100%; border-top: 10px solid #000">
		<?php echo do_shortcode('[rev_slider alias="landing-portfolio"]') ?>
	</div>
	<div class="show-form" style="display: block !important;float:left;width: 100%;height: 100%;"><?php echo do_shortcode( '[contact-form-7 id="4592" title="Free Consultation"]' ); ?></div>
	<div style="text-align: center;float:left;width: 100%;height: 100%;padding-top: 30px;padding-bottom: 30px;border-bottom: 2px solid #222;" id="About-Us">
		<div class="page_title_wrapper">
			<div class="page_title_inner">
			<h2>About Us</h2>
			</div>
		</div>

		<div class="ppb_wrapper">
			<div class="one withsmallpadding ppb_text" style="padding:30px; max-width: 600px; margin-left:auto;margin-left:right;">
				<p style="text-align: center;">Communitec AV is built on an excellent reputation and flawless customer satisfaction. As leaders in AV home integration, with years of experience in IT and AV, we ensure that all our systems are exceedingly secure, intuitive and reliable.</p>
			</div>
		</div>

		<div class="ppb_wrapper">
			<div class="one withsmallpadding ppb_text" style="padding:30px; max-width: 600px; margin-left:auto;margin-left:right;text-align: center;">
				<p style="text-align: center;"><div><strong>Call us for a free consultation: </strong><br /><span class="number">+44 (0) 203-700-8585</span></div></p>
			</div>
		</div>
	</div>
	<div style="text-align: center;float:left;width: 100%;height: 100%;padding-top: 30px;padding-bottom: 30px;" id="Services">
		<div class="page_title_wrapper">
			<div class="page_title_inner">
			<h2 style="padding-bottom: 15px;">Services</h2>
			</div>
		</div>

	<div class="ppb_wrapper" style="float:left;width: 100%;height: 100%">
		<div class="cs-col cs-col-4 withsmallpadding ppb_text">
			<a href="http://av.communitec.co/portfolios/smart-control/"><img src="http://av.communitec.co/wp-content/uploads/2016/11/Integrated-Control2-705x407.jpg" alt=""></a>
			<h4 style="text-align: center;padding-left: 10px;padding-right: 10px;">Smart Control</h4>
			<p style="text-align: center;padding-left: 10px;padding-right: 10px;">User-friendly, intuitive control systems: Control all the features of your home such as, security, lighting and audio-visual devices from one simple device such as an iPad, iPhone or from one of our cutting-edge handsets.</p>
		</div>
		<div class="cs-col cs-col-4 withsmallpadding ppb_text">
			<a href="http://av.communitec.co/portfolios/lighting-shading/"><img src="http://av.communitec.co/wp-content/uploads/2016/06/Lightingresized-705x407.jpg" alt=""></a>
			<h4 style="text-align: center;padding-left: 10px;padding-right: 10px;">Lighting and Shading</h4>
			<p style="text-align: center;padding-left: 10px;padding-right: 10px;">Energy saving, ultra-responsive lighting solutions: Let your home respond organically to your day; set the lights to turn down when you head to bed, or your blinds to close as a film begins. These dynamic solutions can be creatively designed and seamslessly integrated by our engineers.</p>
		</div>
		<div class="cs-col cs-col-4 withsmallpadding ppb_text">
			<a href="http://av.communitec.co/portfolios/home-cinema/"><img src="http://av.communitec.co/wp-content/uploads/2016/06/Home-Cinema-1-705x407.jpg" alt=""></a>
			<h4 style="text-align: center;padding-left: 10px;padding-right: 10px;">Home Cinema</h4>
			<p style="text-align: center;padding-left: 10px;padding-right: 10px;">4K, 7.2 or 5.1 Surround Sound: Experience the highest quality, world-leading cinematic configurations – from epic cinema rooms, to placing discrete, or hidden HDTVs. Customise your surround sound and lighting solutions to create the perfect environment for your viewing pleasure, all controlled by a mobile device.</p>
		</div>
		<div class="cs-col cs-col-4 withsmallpadding ppb_text">
			<a href="http://av.communitec.co/portfolios/security/"><img src="http://av.communitec.co/wp-content/uploads/2016/06/Security-2-705x407.jpg" alt=""></a>
			<h4 style="text-align: center;padding-left: 10px;padding-right: 10px;">Security</h4>
			<p style="text-align: center;padding-left: 10px;padding-right: 10px;">Monitor your house 24/7 from a mobile device, whether your home or away through a variety of security solutions that include CCTV, alarms, smart-lock systems and fingerprint readers. Which can all give you complete control of your home wherever you are in the world.</p>
		</div>
		<div class="cs-col cs-col-4 withsmallpadding ppb_text">
			<a href="http://av.communitec.co/portfolios/av-distribution/"><img src="http://av.communitec.co/wp-content/uploads/2016/11/integrated-audio.jpg" alt=""></a>
			<h4 style="text-align: center;padding-left: 10px;padding-right: 10px;">AV Distribution</h4>
			<p style="text-align: center;padding-left: 10px;padding-right: 10px;">Never have to compromise on sound quality: Communitec are specialists in the distribution of Audio and Visual media around yor home. You can route any media to any room allowing for the specifation of equipment, which reduces cost.</p>
		</div>
		<div class="cs-col cs-col-4 withsmallpadding ppb_text">
			<a href="http://av.communitec.co/portfolios/climate-control/"><img src="http://av.communitec.co/wp-content/uploads/2016/06/IMG_1346-1-705x407.jpg" alt=""></a>
			<h4 style="text-align: center;padding-left: 10px;padding-right: 10px;">Climate Control</h4>
			<p style="text-align: center;padding-left: 10px;padding-right: 10px;">Customised comfort, energy saving climate controls: Remotely alter your home’s temperature, or allow our intelligent systems to respond to your schedule and comfort levels automatically. We install solutions from Heatmiser to Nest, that connect to your Smart Home control for a fully integrated solution.</p>
		</div>
	</div>
	</div>
	<div style="border-top: 2px solid #222; border-bottom: 2px solid #222; text-align: center;float:left;width: 100%;height: 100%;padding-top: 30px;padding-bottom: 5px;">
		<div class="page_title_wrapper">
			<div class="page_title_inner">
			<h2>Some of the brands we integrate:</h2>
			<!-- <p><strong style="text-transform: uppercase; font-size: 20px">Some of the brands we integrate:</strong></p> -->
			</div>
		</div>
		<div class="ppb_wrapper">
			<div class="one withsmallpadding ppb_text" style="padding:30px; padding-top: 0;">
				<p style="text-align: center;"><img style="max-width: 100%;" src="http://av.communitec.co/wp-content/uploads/2017/02/Landing-Page-Brands2.jpg" alt=""></p>
			</div>
		</div>

		<div class="ppb_wrapper">
			<div class="one withsmallpadding ppb_text" style="padding:30px; max-width: 600px; margin-left:auto;margin-left:right; text-align: center;">
				<p style="text-align: center;"><div><strong>For more information, no obligation, call us today: </strong><br /><span class="number">+44 (0) 203-700-8585</span></div></p>
			</div>
		</div>
	</div>
	
	
	<div style="width: 100%;margin: 20px auto; float: left; height: 100%; " id="Reviews">
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
	})(jQuery);
</script>
<?php
	get_footer();
?>
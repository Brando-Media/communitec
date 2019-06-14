<?php
/**
 * The main template file for display gallery page.
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

//Check if gallery template
global $page_gallery_id;
if(!empty($page_gallery_id))
{
	$current_page_id = $page_gallery_id;
}

//Check if password protected
get_template_part("/templates/template-password");

//Get gallery images
$all_photo_arr = get_post_meta($current_page_id, 'wpsimplegallery_gallery', true);

//Get global gallery sorting
$all_photo_arr = pp_resort_gallery_img($all_photo_arr);

get_header();

wp_enqueue_script("photome-custom-mixed_masonry", get_template_directory_uri()."/js/custom_mixed_masonry.js", false, THEMEVERSION, true);
?>

<?php
	//Include custom header feature
	get_template_part("/templates/template-header");
?>

<!-- Begin content -->
<?php
	
?>
    
<div class="inner">

	<div class="inner_wrapper nopadding">
	
	<div id="page_main_content" class="sidebar_content full_width nopadding fixed_column">
	
	<div id="portfolio_mixed_filter_wrapper" class="portfolio_mixed_filter_wrapper gallery three_cols portfolio-content section content clearfix" data-columns="3">
	
	<?php
		$tg_lightbox_enable_caption = kirki_get_option('tg_lightbox_enable_caption');
		
		$large_counter = 1;
		$next_number_to_add = 4;
		$next_trigger = 1;
	
	    foreach($all_photo_arr as $key => $photo_id)
	    {
	        $small_image_url = '';
	        $image_url = '';
	        
	        //Calculated columns size
			$grid_wrapper_class = 'classic3_cols';
			$column_class = 'one_third gallery3';
			$photome_image_size = 'gallery_grid';
			
			$large_counter_trigger = FALSE;
			
			if($next_trigger == $key+1)
			{
				$large_counter_trigger = TRUE;
				$next_trigger = $next_trigger+$next_number_to_add;
				
				if($next_number_to_add == 4)
				{
					$next_number_to_add = 2;
				}
				else if($next_number_to_add==2)
				{
					$next_number_to_add = 4;
				}
			}
			
			if($large_counter_trigger)
			{
				$wrapper_class = 'three_cols double_size';
				$grid_wrapper_class = 'classic3_cols double_size';
				$column_class = 'one_third gallery3 double_size';
				$photome_image_size = 'gallery_grid_large';
			}
			
			$large_counter++;
	        
	        if(!empty($photo_id))
	        {
	        	$image_url = wp_get_attachment_image_src($photo_id, 'original', true);
	        	$small_image_url = wp_get_attachment_image_src($photo_id, $photome_image_size, true);
	        }
	        
	        //Get image meta data
	        $image_caption = get_post_field('post_excerpt', $photo_id);
	        $image_alt = get_post_meta($photo_id, '_wp_attachment_image_alt', true);
	?>
	<div class="element grid <?php echo esc_attr($grid_wrapper_class); ?>">
	
		<div class="<?php echo esc_attr($column_class); ?> static filterable gallery_type animated<?php echo esc_attr($key+1); ?>" data-id="post-<?php echo esc_attr($key+1); ?>">
		
			<?php 
			    if(isset($image_url[0]) && !empty($image_url[0]))
			    {
			?>		
			    <a <?php if(!empty($tg_lightbox_enable_caption)) { ?>title="<?php if(!empty($image_caption)) { ?><?php echo esc_attr($image_caption); ?><?php } ?>"<?php } ?> class="fancy-gallery" href="<?php echo esc_url($image_url[0]); ?>">
			        <img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
			    </a>
			<?php
			    }		
			?>
		
		</div>
		
	</div>
	<?php
		}
	?>
		
	</div>
	
	</div>

</div>
</div>

</div>
<?php get_footer(); ?>
<!-- End content -->
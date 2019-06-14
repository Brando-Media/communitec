<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

get_header();

global $global_pp_topbar;

/**
*	Get current page id
**/

$current_page_id = $post->ID;

//If display feat content
$tg_blog_feat_content = kirki_get_option('tg_blog_feat_content');

/**
*	Get current page id
**/

$current_page_id = $post->ID;
$post_gallery_id = '';
if(!empty($tg_blog_feat_content))
{
	$post_gallery_id = get_post_meta($current_page_id, 'post_gallery_id', true);
}

//Include custom header feature
get_template_part("/templates/template-post-header");
?>
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">
					
<?php
if (have_posts()) : while (have_posts()) : the_post();

    $small_image_url = wp_get_attachment_image_src(get_the_ID(), 'blog_f', true);
?>
    					
<!-- Begin each blog post -->
<div class="post_wrapper">

    <?php
    	if(isset($small_image_url[0]) && !empty($small_image_url[0]))
    	{	
    		//Get image meta data
    		$image_caption = get_post_field('post_excerpt', get_the_ID());
    		$image_description = get_post_field('post_content', get_the_ID());
    ?>

    <div class="image_classic_frame single">
    	<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class=""/>
    	<div class="image_caption"><?php echo $image_caption;?></div>
    	<div class="image_description"><?php echo $image_description;?></div>
    </div>
    
    <?php
    	}
    ?>
    
</div>
<!-- End each blog post -->


<?php
if (comments_open($post->ID)) 
{
?>
<div class="fullwidth_comment_wrapper">
	<?php comments_template( '', true ); ?>
</div>
<?php
}
?>

<?php endwhile; endif; ?>
    	
    	</div>
    
    </div>
    <!-- End main content -->
   
</div>

<br class="clear"/><br/><br/>
</div>
<?php get_footer(); ?>
<?php 
/*
 * Template Name: tsandcs
 * Template Post Type: post, page, product
 */
$completed = get_field('what_we_done');
$colour = get_field('header_colour');
$title = get_field('title');
get_header(); 
?>
<style>
.accordiond {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.actived, .accordiond:hover {
  background-color: #ccc; 
}

.paneld {
  padding: 0 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}
</style>

        <main>
        <div class="page_title_wrapper" style="margin-bottom:20px;">
            <div class="page_title_inner" style="text-align:center;">
                <h1><?php echo $title ?></h1>
            </div>
        </div>
        <?php 
        if(have_rows('content')){
            while(have_rows('content')){
                the_row();
                if(get_row_layout() == 'carousel') get_template_part('templates/tsandcs/carousel');
            }
        }
        ?>
        </main>
        <div style="margin-bottom:20px"></div>
<?php 
get_footer();
 ?>

    <script>
var acc = document.getElementsByClassName("accordiond");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("actived");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>
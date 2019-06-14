<?php
$pego_search_placeholder = "";
if ( function_exists( 'get_option_tree' ) ) {
	if ( get_option_tree( 'pego_search_placeholder' ) ) {
		$pego_search_placeholder = esc_html(get_option_tree( 'pego_search_placeholder' ));
	}
}
?>
<form role="search" method="get" id="searchform" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div>
        <input type="text" id="s" name="s" value="<?php echo esc_attr($pego_search_placeholder); ?>" onfocus="if(this.value=='<?php echo esc_attr($pego_search_placeholder); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo esc_attr($pego_search_placeholder); ?>';" autocomplete="off">
    </div>
</form>
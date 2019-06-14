<form role="search" method="get" class="searchForm" action="<?php echo home_url( '/' ); ?>">
	<input name="s" type="search" placeholder="<?php esc_attr_e('Search for...','zn_framework'); ?>" class="searchBox" value="<?php echo get_search_query() ?>">
</form>

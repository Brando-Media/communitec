<?php
function acx_fsmi_hook_function($function_name)
{
	if($function_name!="")
	{
		if(function_exists($function_name))
		{
			$function_name();	
		}
	}
}
/* Option Page */
function acx_fsmi_hook_option_above_ifpost()
{
	do_action('acx_fsmi_hook_option_above_ifpost');
}
function acx_fsmi_hook_option_onpost()
{
	do_action('acx_fsmi_hook_option_onpost');
}
function acx_fsmi_hook_option_postelse()
{
	do_action('acx_fsmi_hook_option_postelse');
}
function acx_fsmi_hook_option_after_else()
{
	do_action('acx_fsmi_hook_option_after_else');
}
 function acx_fsmi_hook_option_above_page_left()
{
	do_action('acx_fsmi_hook_option_above_page_left');

}

function acx_fsmi_hook_option_form_head()
{
	do_action('acx_fsmi_hook_option_form_head');
}
function acx_fsmi_hook_option_fields()
{
	do_action('acx_fsmi_hook_option_fields');
}
function acx_fsmi_hook_option_form_footer()
{
	do_action('acx_fsmi_hook_option_form_footer');
}
function acx_fsmi_hook_option_sidebar()
{
	do_action('acx_fsmi_hook_option_sidebar');
}

function acx_fsmi_hook_option_footer()
{
	do_action('acx_fsmi_hook_option_footer');
}
function acx_fsmi_icons_option_field()
{
	do_action('acx_fsmi_icons_option_field');
}

/* Misc Page */

function acx_fsmi_misc_hook_option_onpost()
{
	do_action('acx_fsmi_misc_hook_option_onpost');
}
function acx_fsmi_misc_hook_option_postelse()
{
	do_action('acx_fsmi_misc_hook_option_postelse');
}
function acx_fsmi_misc_hook_option_after_else()
{
	do_action('acx_fsmi_misc_hook_option_after_else');
}
function acx_fsmi_misc_hook_option_fields()
{
	do_action('acx_fsmi_misc_hook_option_fields');
}
function acx_fsmi_misc_hook_option_above_page_left()
{
	do_action('acx_fsmi_misc_hook_option_above_page_left');
}
function acx_fsmi_misc_hook_option_form_head()
{
	do_action('acx_fsmi_misc_hook_option_form_head');
}
function acx_fsmi_misc_hook_option_form_footer()
{
	do_action('acx_fsmi_misc_hook_option_form_footer');
}
function acx_fsmi_misc_hook_option_sidebar()
{
	do_action('acx_fsmi_misc_hook_option_sidebar');
}
function acx_fsmi_misc_hook_option_footer()
{
	do_action('acx_fsmi_misc_hook_option_footer');
}
/* Premium Page */
function acx_fsmi_premium_hook_option_footer()
{
	do_action('acx_fsmi_premium_hook_option_footer');
}
/* Help Page */
function acx_fsmi_help_hook_option_form_head()
{
	do_action('acx_fsmi_help_hook_option_form_head');
}
function acx_fsmi_help_hook_option_above_page_left()
{
	do_action('acx_fsmi_help_hook_option_above_page_left');
}
function acx_fsmi_help_hook_option_sidebar()
{
	do_action('acx_fsmi_help_hook_option_sidebar');
} 
function acx_fsmi_help_hook_option_fields()
{
	do_action('acx_fsmi_help_hook_option_fields');
}
/* Expert Page */

function acx_fsmi_exprt_hook_option_exprt_quick()
{
	do_action('acx_fsmi_exprt_hook_option_exprt_quick');
}
function acx_fsmi_exprt_hook_option_above_page_left()
{
	do_action('acx_fsmi_exprt_hook_option_above_page_left');
}
function acx_fsmi_exprt_hook_option_sidebar()
{
	do_action('acx_fsmi_exprt_hook_option_sidebar');
} 
function acx_fsmi_exprt_hook_option_form_head()
{
	do_action('acx_fsmi_exprt_hook_option_form_head');
}
?>
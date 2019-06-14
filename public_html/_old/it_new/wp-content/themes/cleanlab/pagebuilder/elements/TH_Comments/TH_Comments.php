<?php if(! defined('THEMENAME')){ return; }
/*
 Name: Comments
 Description: Create and display the current page content
 Class: TH_Comments
 Category: content
 Level: 3
*/

/**
 * Class TH_Comments
 *
 * Create and display the current page content
 *
 * @package  CleanLab
 * @category Page Builder
 * @author   ThemeFuzz
 * @since    4.0.0
 */
class TH_Comments extends ZnElements
{
    public static function getName(){
        return __( "Comments", THEMENAME );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        echo '<div class="zn_page_comments_element '.$this->data['uid'].'">';
            comments_template();
        echo '</div>';
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    // function element_edit()
    // {
    //     echo '<div class="zn-pb-notification">This element will be rendered only in View Page Mode and not in PageBuilder Edit Mode.</div>';
    // }

}

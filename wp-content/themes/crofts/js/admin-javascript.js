jQuery(document).ready(function(t){var e;t(".upload_image_button_custom_field").click(function(a){a.preventDefault(),e=wp.media.frames.file_frame=wp.media({title:"Choose Image",button:{text:"Choose Image"},multiple:!1});var i=this.id;e.on("select",function(){attachment=e.state().get("selection").first().toJSON(),t("#"+i+"_input").val(attachment.url),t("#"+i+"_preview_img").attr("src",attachment.url)}),e.open()});var a;t(".upload_mp3_button_custom_field").click(function(e){e.preventDefault(),a=wp.media.frames.file_frame=wp.media({title:"Choose MP3",button:{text:"Choose MP3"},multiple:!1});var i=this.id;a.on("select",function(){attachment=a.state().get("selection").first().toJSON(),t("#"+i+"_input").val(attachment.url)}),a.open()})});
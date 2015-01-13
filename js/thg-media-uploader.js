(function($) {
	$(document).ready( function(){
	 	function media_upload( button_class ) {
		    var _custom_media = true,
		    	_orig_send_attachment = wp.media.editor.send.attachment,
		    	ctr = 1;

		    $("body").on("click", '.custom_media_upload', function(e) {
		        var button = $(this),
			        send_attachment_bkp = wp.media.editor.send.attachment,
            		widget_content = button.closest(".widget-content");
		        _custom_media = true;
		        wp.media.editor.send.attachment = function(props, attachment){
	               $('.custom_media_id', widget_content).val(attachment.id); 
	               $('.custom_media_url', widget_content).val(attachment.url);
	               $('.custom_media_image', widget_content).attr('src',attachment.url).css('display','block');   
		        }
		        wp.media.editor.open(button);
		        return false;
		    });

		}
		media_upload();
	});
})(jQuery)
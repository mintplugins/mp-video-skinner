jQuery(document).ready(function($){
	/**
	 * Load the skin's styling options
	 *
	 * @since    1.0.0
	 * @link     http://moveplugins.com/doc/
	 */
	$('#mp_video_skinner_skin_slug').on('change', function(event){
		 
		mp_video_skinner_load_skin_shortcode_options();
		 
	});
	mp_video_skinner_load_skin_shortcode_options();
	 
	function mp_video_skinner_load_skin_shortcode_options(){
		
		//Hide the ajax content field till content is loaded
		$('.mp_video_skinner_skin_options_field').html('Loading Options');
		$('.mp_video_skinner_skin_options_field').css('display', 'block');
		
		//Show correct content type metaboxes by looping through each item in the 1st drodown
		var values = $("#mp_video_skinner_skin_slug>option:selected").map(function() { 
						
			// Set the callback to be 'skinname_shortcode_options' - which will call the function wp_ajax_skinname_shortcode_options
			var postData = {
				action: $(this).val() + '_shortcode_options',
			};
			
			//Ajax to make new stack
			$.ajax({
				type: "POST",
				data: postData,
				url: mp_stacks_vars.ajaxurl,
				success: function (response) {
					
					if (response != 0){
						//Remove any options that may have previously been added
						$('.mp_video_skinner_skin_options_field').empty();
						
						//Add Options for this skin to the shortcode editor
						$('.mp_video_skinner_skin_options_field').append(response);
						
						//Apply color picker to newly loaded fields
						$('.of-color').wpColorPicker();
						
						$('.mp_video_skinner_skin_options_field').css('display', 'block');
					}
					else{
						$('.mp_video_skinner_skin_options_field').css('display', 'none');
					}
					
				}
			}).fail(function (data) {
				console.log(data);
			});
			
		});
		
	 };
});
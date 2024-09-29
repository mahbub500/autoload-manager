let oam_modal = ( show = true ) => {
	if(show) {
		jQuery('#option-autoload-manager-modal').show();
	}
	else {
		jQuery('#option-autoload-manager-modal').hide();
	}
}

jQuery(function($){

	 $(document).ready(function() {
	    $('.oam-form').on('submit', function(e) {
	    e.preventDefault(); 
	        
        var submitButton = $(this).find('input[type="submit"]:focus');
        var data_id = submitButton.data('id'); 
        var radioName = 'action_' + data_id; 
        var radioValue = $(this).find('input[name="' + radioName + '"]:checked').val();
        oam_modal();

        $.ajax({
            url: OPTION_AUTOLOAD_MANAGER.ajaxurl, 
            type: 'POST',
            data: {
                action: 'update-autoload-status', 
                _wpnonce : OPTION_AUTOLOAD_MANAGER._wpnonce,
                id: data_id,
                status: radioValue,
            },
            success: function(response) {
                var $targetRow = $('.oam-id[data-id="' + data_id + '"]');
                if ( radioValue == 1 ) {
                	$targetRow.find('.oam-autoload_status').text('on');
                }else if(radioValue == 0){
                	$targetRow.find('.oam-autoload_status').text('off');
               	}
               	oam_modal(false);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });


	    });
	});


	// $('.oam-container').infiniteScroll({

	//   path: '.pagination__next',
	//   append: '.post',
	//   history: false,
	// });
})
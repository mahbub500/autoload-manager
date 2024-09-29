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


	    });
	});


	// $('.oam-container').infiniteScroll({

	//   path: '.pagination__next',
	//   append: '.post',
	//   history: false,
	// });
})
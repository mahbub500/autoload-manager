let oam_modal = ( show = true ) => {
	if(show) {
		jQuery('#options-autoload-manager-modal').show();
	}
	else {
		jQuery('#options-autoload-manager-modal').hide();
	}
}

jQuery(function($){
	
	$('#options-autoload-manager_report-copy').click(function(e) {
		e.preventDefault();
		$('#options-autoload-manager_tools-report').select();

		try {
			if( document.execCommand('copy') ){
				$(this).html('<span class="dashicons dashicons-saved"></span>');
			}
		} catch (err) {
			console.log('Oops, unable to copy!');
		}
	});
})
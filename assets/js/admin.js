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
        $('input[type="checkbox"]').change(function() {
            var $this = $(this);
            var $parentRow = $this.closest('tr.oam-id'); 
            var dataId = $parentRow.data('id'); 

            var isChecked = $this.is(':checked'); 

            console.log('Checkbox ID:', dataId);
            console.log('Is checked:', isChecked);

           
            $.ajax({
                url: OPTION_AUTOLOAD_MANAGER.ajaxurl,
                type: 'POST',
                data: {
                    action: 'update-autoload-status',
                    _wpnonce: OPTION_AUTOLOAD_MANAGER._wpnonce,
                    id: dataId,
                    status: isChecked ? '1' : '0',  
                },
                success: function(response) {
                   
                    $parentRow.find('.oam-autoload_status').text(isChecked ? 'on' : 'off');
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
    let table = new DataTable('#oam-container');
})
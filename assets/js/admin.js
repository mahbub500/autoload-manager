let oam_modal = ( show = true ) => {
    if(show) {
        jQuery('#option-autoload-manager-modal').show();
    }
    else {
        jQuery('#option-autoload-manager-modal').hide();
    }
}

jQuery(function($){ 

    var rows = $('.oam-id');
    rows.hide().filter('.oam-status-on').show();

    $(document).ready(function() {
        $('.oam-checkbox').change(function(e) {
            e.preventDefault();
            var $this = $(this);
            var $parentRow = $this.closest('tr.oam-id'); 
            var dataId = $parentRow.data('id'); 

            var isChecked = $this.is(':checked'); 
           
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

    $('.oam-filter').on('click', function() {
        var filter = $(this).data('filter');
        var rows = $('.oam-id');
        
        if (filter === 'all') {
            rows.show();
        } 
        else if (filter === 'on') {
            rows.hide().filter('.oam-status-on').show();
        } 
        else if (filter === 'off') {
            rows.hide().filter('.oam-status-off').show();
        }
    });

     $('#select-all').on('change', function() {
        $('.select-row').prop('checked', this.checked);
    });

     $('.select-row').on('change', function() {
        if (!this.checked) {
            $('#select-all').prop('checked', false);
        }
        
        if ($('.select-row:checked').length === $('.select-row').length) {
            $('#select-all').prop('checked', true);
        }
    });

     $('.oam-bulk-update').on('click', function() {
        var selectedIds = [];
        
        $('.select-row:checked').each(function() {
            var id = $(this).closest('tr').data('id');
            selectedIds.push( id );
        });

        if (confirm("Are you want to turn off autoload all selectd item?")) {
            $.ajax({
                url: OPTION_AUTOLOAD_MANAGER.ajaxurl,
                type: 'POST',
                data: {
                    action: 'oam-bulk-update',
                    _wpnonce: OPTION_AUTOLOAD_MANAGER._wpnonce,
                    id: selectedIds,
                    status: 1,  
                },
                success: function(response) {

                    console.log( response );
                   
                    // $parentRow.find('.oam-autoload_status').text(isChecked ? 'on' : 'off');
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }         
    });

    $("#oem-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#oam-container tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });



    // let table = new DataTable('#oam-container');
})
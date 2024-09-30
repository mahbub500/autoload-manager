<?php 

use Codexpert\Option_Autoload_Manager\Helper;
global $wpdb;

$table_name = $wpdb->prefix . 'options'; 

$query = "SELECT * FROM $table_name";
$results = $wpdb->get_results($query);

if ($results) {
    echo '<div >';

    // Add Filter Buttons
    echo '<div class="oam-filter-buttons">';
    echo '<button type="button" class="oam-filter" data-filter="all">' . __( 'All', 'option-autoload-manager' ) . '</button>';
    echo '<button type="button" class="oam-filter" data-filter="on">' . __( 'On', 'option-autoload-manager' ) . '</button>';
    echo '<button type="button" class="oam-filter" data-filter="off">' . __( 'Off', 'option-autoload-manager' ) . '</button>';
    echo '</div>';
    

    echo '<form class="oam-form" method="post">';
    echo '<table id="oam-container" class="wp-list-table widefat fixed striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>' . __( 'Option ID', 'option-autoload-manager' ) . '</th>';
    echo '<th>' . __( 'Option Name', 'option-autoload-manager' ) . '</th>';
    echo '<th>' . __( 'Option Value', 'option-autoload-manager' ) . '</th>';
    echo '<th>' . __( 'Autoload Status', 'option-autoload-manager' ) . '</th>';
    echo '<th>' . __( 'Action', 'option-autoload-manager' ) . '</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($results as $row) {
        $switch_name = 'switch_' . esc_html($row->option_id);
        $autoload_status = esc_html($row->autoload);
        $checked = ($autoload_status === 'on' || $autoload_status === 'auto') ? 'checked' : '';

        // Helper::pri( $autoload_status );
        $css = '';
        if ( $autoload_status == 'on'  || $autoload_status == 'auto'  ) {
            $css = 'oam-status-on';
        }else{
            $css = 'oam-status-off';
        }

        echo '<tr  class="oam-id '. $css .'" data-id="'. esc_html( $row->option_id ) . '">';
        echo '<td>' . esc_html($row->option_id) . '</td>';
        echo '<td>' . esc_html(substr($row->option_name, 0, 20)) . '</td>';
        echo '<td>' . esc_html(substr($row->option_value, 0, 20)) . '</td>';
        echo '<td class="oam-autoload_status ">' . esc_html($autoload_status) . '</td>';
        echo '<td>               
              <label class="oam-switch">
                <input type="checkbox" name="' . $switch_name . '" value="1" ' . $checked . ' id="switch_' . esc_html($row->option_id) . '">
                <span class="oam-slider oam-round"></span>
              </label>
              </td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</form>';
    echo '</div>';
} else {
    echo 'No data found!';
}
?>

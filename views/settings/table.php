<?php
global $wpdb;

$table_name = $wpdb->prefix . 'options'; 

$query = "SELECT * FROM $table_name";
$results = $wpdb->get_results($query);

if ($results) {
    echo '<div >';
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
        $radio_name = 'action_' . esc_html($row->option_id);
        $autoload_status = esc_html($row->autoload);
        $on_checked = ($autoload_status === 'on' || $autoload_status === 'auto') ? 'checked' : '';
        $off_checked = ($autoload_status !== 'on' && $autoload_status !== 'auto') ? 'checked' : '';

        echo '<tr class="oam-id" data-id="' . esc_html($row->option_id) . '">';
        echo '<td>' . esc_html($row->option_id) . '</td>';
        echo '<td>' . esc_html(substr($row->option_name, 0, 20)) . '</td>';
        echo '<td>' . esc_html(substr($row->option_value, 0, 20)) . '</td>';
        echo '<td class="oam-autoload_status">' . esc_html($autoload_status) . '</td>';
        echo '<td>
                <label><input type="radio" name="' . $radio_name . '" value="1" ' . $on_checked . '> On</label>
                <label><input type="radio" name="' . $radio_name . '" value="0" ' . $off_checked . '> Off</label>
                <input type="submit" value="Submit" class="oam-submit-button" data-id="' . esc_html($row->option_id) . '">
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

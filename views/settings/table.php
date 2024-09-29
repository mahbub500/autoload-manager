<?php
global $wpdb;

$table_name = $wpdb->prefix . 'options'; 

$query = "SELECT * FROM $table_name";
$results = $wpdb->get_results($query);

if ($results) {
    // Start the HTML table
    echo '<form method="post">';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>' . __( 'Option ID', 'user-switcher' ) . '</th>';
    echo '<th>' . __( 'Option Name', 'user-switcher' ) . '</th>';
    echo '<th>' . __( 'Option Value', 'user-switcher' ) . '</th>';
    echo '<th>' . __( 'Autoload Status', 'user-switcher' ) . '</th>';
    echo '<th>' . __( 'Action', 'user-switcher' ) . '</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($results as $row) {
        $radio_name = 'action_' . esc_html($row->option_id); // Unique name for radio buttons per row
        $autoload_status = esc_html($row->autoload);

        // Check if 'autoload' is 'on' or 'auto' to pre-select the "On" radio button
        $on_checked = ($autoload_status === 'on' || $autoload_status === 'auto') ? 'checked' : '';
        $off_checked = ($autoload_status !== 'on' && $autoload_status !== 'auto') ? 'checked' : '';

        echo '<tr>';
        echo '<td>' . esc_html($row->option_id) . '</td>';
        echo '<td>' . esc_html(substr($row->option_name, 0, 20)) . '</td>';
        echo '<td>' . esc_html(substr($row->option_value, 0, 20)) . '</td>';
        echo '<td>' . esc_html($autoload_status) . '</td>';
        echo '<td>
                <label><input type="radio" name="' . $radio_name . '" value="1" ' . $on_checked . '> On</label>
                <label><input type="radio" name="' . $radio_name . '" value="0" ' . $off_checked . '> Off</label>
                <input type="submit" name="submit_action" value="Submit" class="btn btn-primary">
              </td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</form>';
} else {
    echo 'No data found!';
}
?>

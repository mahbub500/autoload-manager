<?php
global $wpdb;

$table_name = $wpdb->prefix . 'options'; 

$query = "SELECT * FROM $table_name";
$results = $wpdb->get_results($query);

if ($results) {
    echo '<div class="oam-container">';
    echo '<form class="oam-form" method="post">';
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
        $radio_name = 'action_' . esc_html($row->option_id);
        $autoload_status = esc_html($row->autoload);
        $on_checked = ($autoload_status === 'on' || $autoload_status === 'auto') ? 'checked' : '';
        $off_checked = ($autoload_status !== 'on' && $autoload_status !== 'auto') ? 'checked' : '';

        echo '<tr class="post">';
        echo '<td class="oam-id" data-id="' . esc_html($row->option_id) . '">' . esc_html($row->option_id) . '</td>';
        echo '<td>' . esc_html(substr($row->option_name, 0, 20)) . '</td>';
        echo '<td>' . esc_html(substr($row->option_value, 0, 20)) . '</td>';
        echo '<td>' . esc_html($autoload_status) . '</td>';
        echo '<td>
                <label><input type="radio" name="' . $radio_name . '" value="1" ' . $on_checked . '> On</label>
                <label><input type="radio" name="' . $radio_name . '" value="0" ' . $off_checked . '> Off</label>
                <input type="submit" name="change_autoload_status" value="Submit" class="btn btn-primary" data-id="' . esc_html($row->option_id) . '">
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

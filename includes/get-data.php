<?php 

global $wpdb;

    $table_name = $wpdb->prefix . 'my_addresses';

    $data = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

    echo '<div class="wrap">
        <h1>Address List</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip Code</th>
                    <th>Address URL</th>
					<th>City URL</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';

    foreach ($data as $row) {
        echo '<tr>';
        foreach ($row as $cell) {
            echo "<td>$cell</td>";
        }
        echo '</tr>';
    }

    echo '</tbody>
        </table>
    </div>';


 ?>
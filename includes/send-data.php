<?php

define('WP_DEBUG', true);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include WordPress bootstrap
    require_once("../../../../wp-load.php");

    // Escape user inputs for security
    $address = sanitize_text_field($_POST['address']);
    $status = sanitize_text_field($_POST['status']);
    $redirect_url = sanitize_text_field($_POST['redirect_url']);
    $city_url = sanitize_text_field($_POST['city_url']);
    $city = sanitize_text_field($_POST['city']);
    $state = sanitize_text_field($_POST['state']);
    $zip_code = sanitize_text_field($_POST['zip_code']);

    // Get global $wpdb variable
    global $wpdb;

    // WordPress database table name
    $table_name = $wpdb->prefix . 'my_addresses';

    $data = array(
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'zip_code' => $zip_code,
        'status' => $status,
        'redirect_url' => $redirect_url,
        'city_url' => $city_url
    );

    $format = array('%s', '%s', '%s', '%s', '%s', '%s', '%s');

    $result = $wpdb->insert($table_name, $data, $format);

    if ($result !== false) {
        // Redirect to the specified URL on success
        wp_redirect(admin_url('admin.php?page=my-addresses&success'));
        exit;
    } else {
        // Output an error message
        echo "Error updating record";
    }

} else {
    // Output an error message
    echo "Record not updated";
}
?>

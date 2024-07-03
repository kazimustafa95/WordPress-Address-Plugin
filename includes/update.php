<?php
include("../../../../wp-config.php");
global $wpdb;

$table_name = $wpdb->prefix . 'my_addresses';

if (isset($_POST['status']) && isset($_POST['id'])) {
    $status = $_POST['status'];
    $id = $_POST['id'];

    $update_query = $wpdb->prepare("UPDATE $table_name SET status = %s WHERE id = %d", $status, $id);

    if ($wpdb->query($update_query) !== false) {
        echo "Record updated successfully";
        wp_redirect(admin_url('admin.php?page=my-addresses&upated-successfully'));
        exit;
    } else {
        echo "Error: " . $wpdb->last_error;
    }
} else {
    echo "Record error";
}

?>

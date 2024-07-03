<?php

include("../../../../wp-config.php");

global $wpdb;

$table_name = $wpdb->prefix . 'my_addresses';

$id = $_GET["id"];
$delete_query = $wpdb->prepare("DELETE FROM $table_name WHERE id = %d", $id);

if ($wpdb->query($delete_query) !== false) {
    wp_redirect(admin_url('admin.php?page=my-addresses&delete'));
    exit;
} else {
    echo "Error deleting record: " . $wpdb->last_error;
}

?>

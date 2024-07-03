<?php
// If uninstall is not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}

// Delete options and tables
delete_option('my_plugin_version');

global $wpdb;
$table_name = $wpdb->prefix . 'my_addresses';
$wpdb->query("DROP TABLE IF EXISTS $table_name");

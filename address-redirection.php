<?php
/*
Plugin Name: Address Redirection
Description: A simple plugin to manage addresses.
Version: 5.8.2
Requires at least: 6.2
Requires PHP: 7.4
Author: Kazi Mustafa
License: GPL v2 or later
*/

// Activation Hook
register_activation_hook(__FILE__, 'address_activate');

function address_activate() {
    global $wpdb;

    // Creating 'my_addresses' table
    $addresses_table_name = $wpdb->prefix . 'my_addresses';

    $charset_collate = $wpdb->get_charset_collate();

    $addresses_sql = "CREATE TABLE $addresses_table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        address varchar(255) NOT NULL,
        city varchar(100) NOT NULL,
        state varchar(100) NOT NULL,
        zip_code varchar(20) NOT NULL,
        redirect_url varchar(255) NOT NULL,
		city_url varchar(255) NOT NULL,
        status varchar(20) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    // Execute the SQL query
    $wpdb->query($addresses_sql);
}

// Admin Menu Hook
add_action('admin_menu', 'address_menu');

function address_menu() {
    add_menu_page(
        'My Addresses', 
        'Add Addresses', 
        'manage_options', 
        'my-addresses', 
        'address_add_address_form',
        'dashicons-location',
        30
    );
    
    add_action('admin_post_address_submit_form', 'address_handle_form_submission');
}

// Form Display Function
function address_add_address_form() {
   include 'includes/add-adddress.php';
}
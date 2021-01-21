<?php
require_once( 'wp-load.php' );

$billing_card_number = $_GET['billing_card_number'];
$billing_exp_date = $_GET['billing_exp_date'];
$billing_cvc = $_GET['billing_cvc'];

global $wpdb;
$table_name = $wpdb->prefix . "card_info";
$current_user = wp_get_current_user();
$user_id = $current_user->ID;

$wpdb->insert($table_name, array(
		'user_id' => $user_id,
		'card_number' => $billing_card_number,
        'exp_date' => $billing_exp_date,
        'cvc' => $billing_cvc
    ),array(
    	'%d',
    	'%s',
    	'%s',
        '%s'
    )
);

echo '1';
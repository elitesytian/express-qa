<?php

// DATABASE PREFIX
function alpha_check_database_prefix() {
	global $wpdb;
	$wp_database_prefix = $wpdb->prefix;

	if ($wp_database_prefix != 'wp_') {
		return addCheck();
	} else {
		return addCross();
	}
}
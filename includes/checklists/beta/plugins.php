<?php

// PLUGINS
function beta_check_plugin($args) {
	$all_plugins    = get_plugins();
	$active_plugins = get_option('active_plugins');

	$plugin_path   = $args['path'];
	$plugin_status = $args['status'];

	if ($args['status'] == 'active') {
		if (in_array($plugin_path, $active_plugins)) {
			return addCheck();
		} else {
			return addCross();
		}
	} elseif ($args['status'] == 'installed') {
		if (array_key_exists($plugin_path, $all_plugins) && !in_array($plugin_path, $active_plugins)) {
			return addCheck();
		} else {
			return addCross();
		}
	} else {
		return addCross();
	}
}
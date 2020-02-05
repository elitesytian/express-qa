<?php

// NODE MODULES
function beta_check_node_modules() {
	$node_modules_folder = get_template_directory() . "/node_modules";

	if (file_exists( $node_modules_folder )) {
		return addCross();
		clearstatcache();
	} else {
		return addCheck();
	}
}

// SRDB
function beta_check_srdb() {
	$srdb_folder = get_home_path() . "srdb";

	if (file_exists( $srdb_folder )) {
		return addCross();
		clearstatcache();
	} else {
		return addCheck();
	}
}
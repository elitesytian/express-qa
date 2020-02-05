<?php

// WP DEBUG
function alpha_check_robots() {
	$robots_url = get_home_path() . "robots.txt";

	if (file_exists( $robots_url )) {
		return addCheck();
	} else {
		return addCross();
	}
}
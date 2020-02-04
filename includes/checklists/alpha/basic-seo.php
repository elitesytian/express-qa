<?php

// WP DEBUG
function alpha_check_robots() {
	$robots_url = get_site_url() . "/robots.txt";

	if (file_exists( $robots_url )) {
		return addCheck();
	} else {
		return addCross();
	}
}
<?php

// THEME NAME
function alpha_check_theme_name() {
	$site_name = get_bloginfo('name') . " Theme";

	$theme = wp_get_theme();

	$theme_name = $theme->Name;

	if ($theme_name == $site_name) {
		return addCheck();
	} else {
		return addCross();
	}
}

// THEME SCREENSHOT
function alpha_check_theme_screenshot() {
	$theme = wp_get_theme();

	$theme_screenshot = $theme->get_screenshot();

	$file = basename($theme_screenshot);
	$info = pathinfo($file);
	$name = basename($file,'.'.$info['extension']);

	if ($name == "screenshot") {
		return addCheck();
	} else {
		return addCross();
	}
}
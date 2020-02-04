<?php

// THEME NAME
function initial_check_theme_name() {
	$theme = wp_get_theme();

	$theme_name = $theme->Name;

	if ($theme_name != "") {
		return addCheck();
	} else {
		return addCross();
	}
}

// THEME SCREENSHOT
function initial_check_theme_screenshot() {
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

// THEME AUTHOR
function initial_check_theme_author() {
	$theme = wp_get_theme();

	$theme_author = $theme->display( 'Author', FALSE );

	if (getCurrentClient() == 'clickclickmedia' && $theme_author == 'ClickClickMedia') {
		return addCheck();
	} elseif (getCurrentClient() == 'jackpoyntz' && $theme_author == 'JackPoyntz') {
		return addCheck();
	} elseif (getCurrentClient() == 'veedigital' && $theme_author == 'VeeDigital') {
		return addCheck();
	} else {
		return addCross();
	}
}

// THEME AUTHOR URL
function initial_check_theme_author_uri() {
	$theme = wp_get_theme();

	$theme_author_uri = $theme->display( 'AuthorURI', FALSE );

	if (getCurrentClient() == 'clickclickmedia' && $theme_author_uri == 'https://clickclick.media/') {
		return addCheck();
	} elseif (getCurrentClient() == 'jackpoyntz' && $theme_author_uri == 'https://www.jackpoyntz.com/') {
		return addCheck();
	} elseif (getCurrentClient() == 'veedigital' && $theme_author_uri == 'https://veedigital.com/') {
		return addCheck();
	} else {
		return addCross();
	}
}

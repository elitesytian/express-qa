<?php

// SITE TITLE
function initial_check_site_title() {
	$site_name = get_bloginfo('name');

	if ($site_name != '') {
		return addCheck();
	} else {
		return addCross();
	}
}

// TAGLINE
function initial_check_tagline() {
	$tagline = get_bloginfo('description');

	if (checkIfTaglineShouldBeEmpty()) {
		if ($tagline != "") {
			return addCheck();
		} else {
			return addCross();
		}
	} else {
		if ($tagline == "") {
			return addCheck();
		} else {
			return addCross();
		}
	}
}

// FAVICON
function initial_check_favicon() {
	$favicon = get_option('site_icon', false);

	if ($favicon) {
		return addCheck();
	} else {
		return addCross();
	}
}

// DATE FORMAT
function initial_check_date_format() {
	$date_format = get_option('date_format', false);

	if ($date_format == "d/m/Y") {
		return addCheck();
	} else {
		return addCross();
	}
}

// START OF WEEK
function initial_check_start_of_week() {
	$start_of_week = get_option('start_of_week', false);

	// 0 = Sunday
	// 1 = Monday
	// 2 = Tuesday
	// 3 = Wednesday
	// 4 = Thursday
	// 5 = Friday
	// 6 = Saturday

	if ($start_of_week == 0) {
		return addCheck();
	} else {
		return addCross();
	}
}
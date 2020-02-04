<?php

// USER EMAIL
function alpha_check_email_address() {
	$allUsers = get_users();

	foreach ($allUsers as $user) {
		$user_login = $user->user_login;
		$user_email = $user->user_email;
		$user_roles = $user->roles;

		if (in_array("administrator", $user_roles)) {
			if (getCurrentClient() == 'clickclickmedia') {
				if ($user_email == "rik@clickclickmedia.com.au") {
					return addCheck();
					break;
				}
			} elseif (getCurrentClient() == 'jackpoyntz') {
				if ($user_email == "dev.jackpoyntz@gmail.com") {
					return addCheck();
					break;
				}
			} elseif (getCurrentClient() == 'veedigital') {
				if ($user_email == "yukis@veedigital.com") {
					return addCheck();
					break;
				}
			} else {
				return addCross();
			}
		}

	}
}

// DATE FORMAT
function alpha_check_date_format() {
	$date_format = get_option('date_format', false);

	if ($date_format == "d/m/Y") {
		return addCheck();
	} else {
		return addCross();
	}
}

// TIMEZONE
function alpha_check_timezone() {
	$timezone_string = get_option('timezone_string');

	$client_timezone = '';
	if (getCurrentClient() == 'clickclickmedia') {
		$client_timezone = 'Australia';
	} elseif (getCurrentClient() == 'jackpoyntz') {

	} elseif (getCurrentClient() == 'veedigital') {

	}

	if (strpos($timezone_string, $client_timezone) !== false) {
		return addCheck();
	} else {
		return addCross();
	}
}

// START OF WEEK
function alpha_check_start_of_week() {
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

// SITE LANGUAGE
function alpha_check_site_language() {
	$site_language = get_bloginfo('language');

	// en-AU
	// en-US
	// en-GB

	$expected_language = '';
	if (getCurrentClient() == 'clickclickmedia') {
		$expected_language = 'en-AU';
	} elseif (getCurrentClient() == 'jackpoyntz') {

	} elseif (getCurrentClient() == 'veedigital') {

	}

	if ($site_language == $expected_language) {
		return addCheck();
	} else {
		return addCross();
	}
}

// POSTS PER PAGE
function alpha_check_posts_per_page() {
	$posts_per_page = get_option('posts_per_page');

	if ($posts_per_page == 10) {
		return addCheck();
	} else {
		return addCross();
	}
}

// SEARCH ENGINE VISIBILITY
function alpha_check_search_engine_visibility() {
	$search_engine_visibility = get_option('blog_public');

	if ($search_engine_visibility == 0) {
		return addCheck();
	} else {
		return addCross();
	}
}
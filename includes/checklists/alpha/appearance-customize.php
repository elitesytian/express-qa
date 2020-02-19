<?php

// SITE TITLE
function alpha_check_site_title() {
	$site_name = get_bloginfo('name');

	if ($site_name != '') {
		return addCheck();
	} else {
		return addCross();
	}
}

// SITE TAGLINE
function alpha_check_tagline() {
	$site_tagline = get_bloginfo('description');

	if (checkIfTaglineShouldBeEmpty()) {
		if ($site_tagline != "") {
			return addCheck();
		} else {
			return addCross();
		}
	} else {
		if ($site_tagline == "") {
			return addCheck();
		} else {
			return addCross();
		}
	}
}

// FAVICON
function alpha_check_site_icon() {
	$favicon = get_option('site_icon', false);

	if ($favicon) {
		return addCheck();
	} else {
		return addCross();
	}
}

// MENUS
// UNSUSED FOR NOW
function alpha_check_menus() {
	$menus = get_registered_nav_menus();

	if (count($menus) < 1) {
		return addCross();
	} else {
		return addCheck();
	}
}

// HOMEPAGE STATIC
function alpha_check_homepage() {
	$page_on_front = get_option('page_on_front');

	if ($page_on_front != 0) {
		return addCheck();
	} else {
		return addCross();
	}
}

// POSTSPAGE STATIC
function alpha_check_postspage() {
	$page_for_posts = get_option('page_for_posts');

	if ($page_for_posts != 0) {
		return addCheck();
	} else {
		return addCross();
	}
}
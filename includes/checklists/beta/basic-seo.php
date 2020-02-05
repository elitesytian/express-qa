<?php

// SEARCH ENGINE VISIBILITY
function beta_check_search_engine_visibility() {
	$search_engine_visibility = get_option('blog_public');

	if ($search_engine_visibility == 1) {
		return addCheck();
	} else {
		return addCross();
	}
}
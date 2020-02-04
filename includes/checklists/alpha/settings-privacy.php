<?php

// MEDIA UPLOADS
function alpha_check_privacy_page() {
	$page_for_privacy_policy = get_option( "wp_page_for_privacy_policy" );

	if ($page_for_privacy_policy != 0) {
		return addCheck();
	} else {
		return addCross();
	}
}
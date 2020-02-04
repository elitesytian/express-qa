<?php

// MEDIA UPLOADS
function alpha_check_media_uploads() {
	$uploads_use_yearmonth_folders = get_option( "uploads_use_yearmonth_folders" );

	if ($uploads_use_yearmonth_folders != 1) {
		return addCheck();
	} else {
		return addCross();
	}
}
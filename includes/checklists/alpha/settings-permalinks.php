<?php

// PERMALINKS
function alpha_check_permalinks() {
	$permalink_structure = get_option( "permalink_structure" );

	if ($permalink_structure == "/%category%/%postname%/" || $permalink_structure == "/%postname%/") {
		return addCheck();
	} else {
		return addCross();
	}
}
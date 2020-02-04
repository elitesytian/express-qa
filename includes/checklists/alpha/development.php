<?php

// WP DEBUG
function alpha_check_wp_debug() {
	if (defined('WP_DEBUG')) {
		return addCheck();
	} else {
		return addCross();
	}
}
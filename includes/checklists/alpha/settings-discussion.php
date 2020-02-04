<?php

// COMMENT MODERATION
function alpha_check_comment_moderation() {
	$comment_moderation = get_option( "comment_moderation" );

	if ($comment_moderation == 1) {
		return addCheck();
	} else {
		return addCross();
	}
}
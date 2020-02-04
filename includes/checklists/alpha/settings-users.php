<?php

// USER EMAIL
function alpha_check_user_email($args) {
	$allUsers = get_users();

	$target_username = $args['target_username'];
	$target_email    = $args['target_email'];

	foreach ($allUsers as $user) {
		$user_login = $user->user_login;
		$user_email = $user->user_email;

		if ($user_login == $target_username && $user_email == $target_email) {
			$output = addCheck();
			break;
		} else {
			$output = addCross();
		}
	}

	return $output;
}
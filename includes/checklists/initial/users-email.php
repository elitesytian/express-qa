<?php

// USER EMAIL
function initial_check_user_email() {
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
<?php

function alpha_check_page_template($args) {
	if (locate_template($args) != '') {
		return addCheck();
	} else {
		return addCross();
	}
}
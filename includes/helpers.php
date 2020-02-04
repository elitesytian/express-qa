<?php

// GET CURRENT CLIENT
function getCurrentClient() {
	$client = get_option("eqa_settings");

	return $client['eqa_client_field'] ? $client['eqa_client_field'] : "";
}

// GET CURRENT QA TYPE
function getCurrentQAType() {
	$client = get_option("eqa_settings");

	return $client['eqa_type_field'] ? $client['eqa_type_field'] : "";
}

// CHECK MARK
function addCheck() {
	return "<span class='pass green'>&#10004;</span>";
}

// CROSS MARK
function addCross() {
	return "<span class='fail'>&#10008;</span>";
}

function addChecklistRow($criteria, $expected, $callback, $param = null) {
	echo '<tr class="checklist-row">';
	echo '	<td class="criteria">' . $criteria . '</td>';
	echo '	<td class="expected">' . $expected . '</td>';
	echo '	<td class="status">' . call_user_func($callback, $param) . '</td>';
	echo '</tr>';
}

function addChecklistRowHeading() {
	echo '<tr>';
	echo '	<td class="criteria"><em>Criteria</em></td>';
	echo '	<td class="expected"><em>Expected</em></td>';
	echo '	<td class="status"><em>Status</em></td>';
	echo '</tr>';
}

function addChecklistTitle($title) {
	echo '<tr>';
	echo '	<th colspan="3"><strong>' . $title . '</strong></th>';
	echo '</tr>';
}
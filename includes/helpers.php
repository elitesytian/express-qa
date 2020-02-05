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
	$GLOBALS['items_passed'] += 1;

	return "<span class='pass green'>&#10004;</span>";
}

// CROSS MARK
function addCross() {
	return "<span class='fail'>&#10008;</span>";
}

function addChecklistRow($criteria, $expected, $callback, $param = null) {
	$GLOBALS['total_items'] += 1;

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
	echo '<tr class="heading">';
	echo '	<td colspan="3">' . $title . '</td>';
	echo '</tr>';
}

function getProgress() {
	$total_items  = $GLOBALS['total_items'];
	$items_passed = $GLOBALS['items_passed']; 

	$percentage = ($items_passed / $total_items) * 100 ?>

	<style>
		.progress-bar {
			background: linear-gradient(90deg, rgba(0,115,170,1) 0%, rgba(0,115,170,1) <?php echo $percentage; ?>%, rgba(116,200,241,1) <?php echo $percentage; ?>%, rgba(116,200,241,1) 100%);
		}
	</style>

	<div class="progress-bar">
		<span><?php echo $items_passed . " / " . $total_items; ?></span>
	</div>

<?php }
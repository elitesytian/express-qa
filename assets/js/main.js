// READY
$(document).ready(function() {
	checkFailedItems();
});

// LOAD
$(window).on("load", function() {

});

// RESIZE
$(window).resize(function() {

});

// ORIENTATION CHANGE
$(window).resize(function() {

});


function checkFailedItems() {
	$('.wrap table tr[class="checklist-row"]').each(function() {
		var status = $(this).find('.status span');
		if (status.hasClass('fail')) {
			status.closest('.checklist-row').find('td').addClass('red');
		}
	});
}
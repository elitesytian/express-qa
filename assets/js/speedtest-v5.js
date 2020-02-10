// READY
$(document).ready(function() {
	$('.results-new').hide();
});

// LOAD
$(window).on("load", function() {

});


// FUNCTION
function queryPageSpeed(url) {
	var domain = url;

	// New
	if ( domain.length > 0 && domain != '' && domain.match(/^(?:http([s]?):\/\/|www)/) && !domain.includes('localhost') && !domain.includes('webserver') ) {

		var desktop_labdata = '';
		var mobile_labdata  = '';

		$('#pre-loader').addClass('active');
		$('.results-new').hide();

		$.when(
			// Desktop
			$.ajax({
				url : 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed',
				type : 'GET',
				dataType: 'json',
				data : {
					url : domain,
					strategy: 'desktop'
				},
				beforeSend: function() {
					console.log('Desktop Start');
				},
				success: function(response_desktop) {
					$('.results-new .results-desktop .summary').html('');
					desktop_labdata = getPageSpeedLabData(response_desktop);

					getPageSpeedScore(response_desktop, $('#desktop-score'));

					console.log('Desktop End');
				}
			}),

			// Mobile
			$.ajax({
				url : 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed',
				type : 'GET',
				dataType: 'json',
				data : {
					url : domain,
					strategy: 'mobile'
				},
				beforeSend: function() {
					console.log('Mobile Start');
				},
				success: function(response_mobile) {
					$('.results-new .results-mobile .summary').html('');
					mobile_labdata = getPageSpeedLabData(response_mobile);

					getPageSpeedScore(response_mobile, $('#mobile-score'));

					console.log('Mobile End');
				}
			}),
		).then(function() {
			$('#pre-loader').removeClass('active');

			$('.results-new').show();
			$('.results-new .results-desktop h3').show();
			$('.results-new .results-mobile h3').show();

			$('.results-new .results-desktop .summary').html(desktop_labdata);
			$('.results-new .results-mobile .summary').html(mobile_labdata);
		});
	} else {
		alert('Your site is currently in an invalid location (eg. localhost). It must be http or https.');
	}
}

function getPageSpeedLabData(data) {
	var htmlProcessed = '';

	// GET AUDIT REFS FOR METRICS
	var auditRefs = data.lighthouseResult.categories.performance.auditRefs;

	var auditRefs_IDs = [];

	for (var i = 0; i < auditRefs.length; i++) {
		if (auditRefs[i].group == 'metrics') {
			auditRefs_IDs.push(auditRefs[i].id);
		}
	}

	// GET AUDITS FOR LAB DATA
	var audits = data.lighthouseResult.audits;

	htmlProcessed += '<div class="metrics"><ul>';

	auditRefs_IDs.forEach(function(item, index) {
		var custom_class = '';
		if (audits[item] != null) {

			var audit_score = audits[item].score * 100;

			if (audit_score >= 0 && audit_score <= 49) {
				custom_class = 'poor';
			} else if (audit_score >= 50 && audit_score <= 89) {
				custom_class = 'average';
			} else if (audit_score >= 90 && audit_score <= 100) {
				custom_class = 'good';
			}

			htmlProcessed += '<li><span class="title">' + audits[item].title + '</span><span class="score ' + custom_class + '">' + audits[item].displayValue + '</span></li>';
		}
	});

	htmlProcessed += '</div></ul>';

	return htmlProcessed;
}

function getPageSpeedScore(data, target) {
	var score_raw = data.lighthouseResult.categories.performance.score;

	console.log(score_raw);

	var score = parseInt((score_raw * 10000) / 100);

	console.log(score);

	if ( score >= 0 && score <= 49 ) {
		// Low
		target.find('.circle-progress').css({
			'stroke' : '#ff4e42'
		});
		target.find('.score-val').text(score).css({
			'color' : '#ff4e42'
		});
		target.find('.score-icon').css({
			'color' : '#ff4e42'
		});
	} else if ( score >= 50 && score <= 89 ) {
		// Medium
		target.find('.circle-progress').css({
			'stroke' : '#ffa400'
		});
		target.find('.score-val').text(score).css({
			'color' : '#ffa400'
		});
		target.find('.score-icon').css({
			'color' : '#ffa400'
		});
	} else if ( score >= 90 && score <= 100 ) {
		// High
		target.find('.circle-progress').css({
			'stroke' : '#0cce6b'
		});
		target.find('.score-val').text(score).css({
			'color' : '#0cce6b'
		});
		target.find('.score-icon').css({
			'color' : '#0cce6b'
		});
	} else {
		// Fallback
		target.find('.circle-progress').css({
			'stroke' : '#007cba'
		});
		target.find('.score-val').text(score).css({
			'color' : '#007cba'
		});
		target.find('.score-icon').css({
			'color' : '#007cba'
		});
	}
	setTimeout(function(){
		target.find('.circle-progress').animate({
			strokeDashoffset: (255 - 1.64*score) + "%"
		},
		{
			//animation setting
			duration: 800,
			easing:'linear'
		});
	}, 800);
}
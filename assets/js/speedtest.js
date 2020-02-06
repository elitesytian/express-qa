// READY
$(document).ready(function() {
	$('#result').hide();
});

// LOAD
$(window).on("load", function() {

});


// FUNCTIONS
function runSpeedTest($url) {
	var domain = $url;
	var status = 0;
	// && domain.includes('localhost')
	if ( domain.length > 0 && domain != '' && domain.match(/^(?:http([s]?):\/\/|www)/) && !domain.includes('localhost') ) {
		$.ajax({
			url : 'https://www.googleapis.com/pagespeedonline/v1/runPagespeed',
			type : 'GET',
			dataType: 'json',
			data : {
				url : domain,
				screenshot: true,
				strategy: 'desktop'
			},
			beforeSend: function(){
				console.log('Sending 1');
				$('#pre-loader').addClass('active');
				$('#result').hide();
			},
			success: function(desktop){

				console.log('Success 1');

				$.ajax({
					url : 'https://www.googleapis.com/pagespeedonline/v1/runPagespeed',
					type : 'GET',
					dataType: 'json',
					data : {
						url : domain,
						screenshot: true,
						strategy: 'mobile'
					},
					beforeSend: function() {
						console.log('Sending 2');
					},
					success: function(mobile) {

						console.log('Success 2');

						var screenshot = desktop.screenshot;
						var rawImage   = screenshot.data.replace(/_/g, '/').replace(/-/g, '+');

						$('#site-image').find('img').attr('src', 'data:'+screenshot.mime_type+';base64,'+rawImage);
						$('#domain-value').text(domain);
						$('#pre-loader').removeClass('active');
						$('#result').show();

						results(desktop.formattedResults.ruleResults);

						score(desktop.score, '#desktop-score');
						score(mobile.score, '#mobile-score');

						customAccordion();

					}
				});

			}
		});
	} else {
		alert('Your site is currently in an invalid location (eg. localhost). It must be http or https.');
	}
}

function score($score, $target) {
	var value = Number($score);
	if ( value >= 0 && value <= 49 ) {
		// Low
		$($target).find('.circle-progress').css({
			'stroke' : '#ff4e42'
		});
		$($target).find('.score-val').text(value).css({
			'color' : '#ff4e42'
		});
		$($target).find('.score-icon').css({
			'color' : '#ff4e42'
		});

	} else if ( value >= 50 && value <= 89 ) {
		// Medium
		$($target).find('.circle-progress').css({
			'stroke' : '#ffa400'
		});
		$($target).find('.score-val').text(value).css({
			'color' : '#ffa400'
		});
		$($target).find('.score-icon').css({
			'color' : '#ffa400'
		});
	} else if ( value >= 90 && value <= 100 ) {
		// High
		$($target).find('.circle-progress').css({
			'stroke' : '#0cce6b'
		});
		$($target).find('.score-val').text(value).css({
			'color' : '#0cce6b'
		});
		$($target).find('.score-icon').css({
			'color' : '#0cce6b'
		});
	} else {
		// Fallback
		$($target).find('.circle-progress').css({
			'stroke' : '#007cba'
		});
		$($target).find('.score-val').text(value).css({
			'color' : '#007cba'
		});
		$($target).find('.score-icon').css({
			'color' : '#007cba'
		});
	}
	setTimeout(function(){
		$($target).find('.circle-progress').animate({
			strokeDashoffset: (255 - 1.64*value) + "%"
		},
		{
			//animation setting
			duration: 800,
			easing:'linear'
		});
	}, 800);
}

function results($details) {
	var format = '<div class="accordion" id="results">'+resultLoop($details)+'</div>';
	$('#result-value').html(format);
}

function resultLoop($details) {
	var format = '';
	$.each($details, function(index) {
		var html = '<div class="card">\
			<div class="card-header" id="heading-'+index+'">\
				<button class="btn button-primary btn-link" type="button" data-toggle="collapse" data-target="#collapse-'+index+'" aria-expanded="true" aria-controls="collapseOne">'+$details[index].localizedRuleName+'</button>\
			</div>\
			<div id="collapse-'+index+'" class="collapse" aria-labelledby="headingOne" data-parent="#results"><div class="result-container">'+urlBlocks($details[index].urlBlocks)+urls($details[index].urlBlocks)+'</div></div>\
		</div>';
		format += html;
	});
	return format;
}

function urlBlocks($details) {
	var format = '';
	$.each($details, function(index) {
		if (countProperties($details[index].header.args) >= 1) {
			var html = '<p>'+strReplace( $details[index].header.format, $details[index].header.args )+'</p>';
		} else {
			var html = '<p>'+$details[index].header.format+'</p>';
		}
		format += html;
		if(index == 0) {
			if ($details[index].header.args) {
				if( $details[index].header.args[0].value.match(/^(?:http([s]?):\/\/|www)/) ) {
					format += '<p class="link"><a href="'+$details[index].header.args[0].value+'" target="_BLANK">'+$details[index].header.args[0].value+'</a></p>';
				}
			}
		}
	});
	return format;
}

function urls($details) {
	var format = '';
	format += '<div class="suggestions">';
	$.each($details, function(index) {
		if ( countProperties($details[index].urls) > 1) {
			var html = urlsFormat($details[index].urls);
		} else {
			var html =  '';
		}
		format += html;
	});
	format += '</div>';
	return format;
}

function urlsFormat($details) {
	var format = '';
	$.each($details, function(index) {
		if (countProperties($details[index].result.args) >= 1) {
			var html = '<p>'+strReplace( $details[index].result.format, $details[index].result.args )+'</p>';
		} else {
			var html = '<p>'+$details[index].result.format+'</p>';
		}
		format += html;
	});
	return format;
}

function strReplace($format, $args) {
	var str    = $format;
	var html   = '';
	var format = '';
	$.each($args, function(index) {
		str    = str.replace('$'+(index+1), $args[index].value);
		format = str;
	});
	html = format;
	return html;
}

function countProperties($obj) {
	var prop;
	var propCount = 0;

	for (prop in $obj) {
		propCount++;
	}
	return propCount;
}

function customAccordion() {
	var allPanels = $('.card .collapse').hide();

	$('.card .btn').click(function() {
		allPanels.slideUp();
		$(this).parent().next().slideDown();
		return false;
	});
}
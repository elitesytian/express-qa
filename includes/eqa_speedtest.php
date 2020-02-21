<?php

// EXPRESS QA SPEEDTEST
function eqa_speedtest() { ?>

	<div class="wrap">
		<h2>Speedtest</h2>
		<h3>Pagespeed Insights</h3>

		<div class="speedtest-wrap">
			<section class="main">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h1>Website Analyzer Test</h1>
							<button class="button button-primary" id="run-test-button">Run Test</button>
						</div>
					</div>
				</div>
			</section>

			<div id="pre-loader">
				<div class="lds-ring">
					<div></div>
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>

			<div class="results-new">
				<div class="container scores">
					<div class="row">
						<div class="col-12 col-md-6">
							<h4>Desktop Score</h4>
							<div class="score-item" id="desktop-score">
								<svg class="circle-svg" xmlns="http://www.w3.org/2000/svg">
									<circle class="circle-grey" cx="50%" cy="50%" r="35%" stroke-width="5%"></circle>
									<circle class="circle-progress" cx="50%" cy="50%" r="35%" stroke-width="5%"></circle>
								</svg>
								<div class="score-wrap">
									<i class="fas fa-desktop score-icon"></i>
									<div class="score-val">0</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<h4>Mobile Score</h4>
							<div class="score-item" id="mobile-score">
								<svg class="circle-svg" xmlns="http://www.w3.org/2000/svg">
									<circle class="circle-grey" cx="50%" cy="50%" r="35%" stroke-width="5%"></circle>
									<circle class="circle-progress" cx="50%" cy="50%" r="35%" stroke-width="5%"></circle>
								</svg>
								<div class="score-wrap">
									<i class="fas fa-mobile score-icon"></i>
									<div class="score-val">0</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container lab-data">
					<div class="row">
						<div class="col-12 col-md-6 results-desktop">
							<h3 style="display: none;">Desktop</h3>
							<div class="summary"></div>
						</div>
						<div class="col-12 col-md-6 results-mobile">
							<h3 style="display: none;">Mobile</h3>
							<div class="summary"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row previous-results">
				<div class="col-12 col-md-6">
					<table class="desktop-results">
						<thead>
							<tr>
								<td>Setting</td>
								<td colspan="5">Previous Results (Oldest to Newest)</td>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="col-12 col-md-6">
					<table class="mobile-results">
						<thead>
							<tr>
								<td>Setting</td>
								<td colspan="5">Previous Results (Oldest to Newest)</td>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<?php
		$site_path = get_site_url();
		// $site_path = 'https://www.google.com/';
	?>

	<script>
		$('#run-test-button').click(function() {
			queryPageSpeed('<?php echo $site_path; ?>');
		});
	</script>


<?php }
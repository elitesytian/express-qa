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

			<section id="result">
				<div class="container">
					<div class="row">
						<div class="col-12 col-md-6 col-lg-4">
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
						<div class="col-12 col-md-6 col-lg-4">
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
						<div class="col-12 col-md-6 col-lg-4">
							<h4>Wordpress Score</h4>
							<div class="score-item" id="wp-score">
								<svg class="circle-svg" xmlns="http://www.w3.org/2000/svg">
									<circle class="circle-grey" cx="50%" cy="50%" r="35%" stroke-width="5%"></circle>
									<circle class="circle-progress" cx="50%" cy="50%" r="35%" stroke-width="5%" id="wp-progress"></circle>
								</svg>
								<div class="score-wrap">
									<i class="fab fa-wordpress score-icon"></i>
									<div class="score-val">0</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row" id="result-details">
						<div class="col-12 order-md-2 col-md-6">
							<div class="screenshot" id="site-image">
								<img src="https://via.placeholder.com/320x179" alt="Screenshot">
							</div>
						</div>
						<div class="col-12 order-md-1 col-md-6">
							<div id="result-value"></div>
						</div>
					</div>
				</div>
			</section>

		</div>
	</div>

	<?php
		$site_path = get_site_url();
	?>

	<script>
		$('#run-test-button').click(function() {
			console.log('Click');
			runSpeedTest('<?php echo $site_path; ?>');
		});
	</script>


<?php }
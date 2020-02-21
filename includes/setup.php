<?php

// EXPRESS QA ADMIN MENU
add_action( 'admin_menu', '_plugin_setup' );
function _plugin_setup() {
	add_menu_page( 'Express QA', 'Express QA', 'manage_options', 'express-qa', 'eqa_settings_page', 'dashicons-groups' );

	// add_submenu_page( 'express-qa', 'Initial QA', 'Initial QA', 'manage_options', 'express-qa-initial', 'eqa_initial' );
	// add_submenu_page( 'express-qa', 'Alpha QA', 'Alpha QA', 'manage_options', 'express-qa-alpha', 'eqa_alpha' );
	// add_submenu_page( 'express-qa', 'Beta QA', 'Beta QA', 'manage_options', 'express-qa-beta', 'eqa_beta' );
}

// EXPRESS QA ENQUEUE SCRIPTS AND STYLES
add_action('admin_enqueue_scripts', 'eqa_enqueue_scripts_styles', 10);
function eqa_enqueue_scripts_styles() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', '//code.jquery.com/jquery-3.4.1.js', false, '3.4.1', false);

	$currQAType = getCurrentQAType();
	if ($currQAType == 'speedtest') {
		wp_enqueue_style('bootstrap-css', plugin_dir_url( __FILE__ ) . '../assets/css/vendor/bootstrap-grid.min.css');
		wp_enqueue_style('fontawesome-css', plugin_dir_url( __FILE__ ) . '../assets/css/vendor/fontawesome.min.css');
		wp_enqueue_style('speedtest-v5-css', plugin_dir_url( __FILE__ ) . '../assets/css/speedtest-v5.css');

		wp_enqueue_script('speedtest-v5-js', plugin_dir_url( __FILE__ ) . '../assets/js/speedtest-v5.js', array('jquery'), '1', true);
	}

	$page = $_GET["page"];

	if ( $page == "express-qa" ) {
		wp_enqueue_style('plugin-css', plugin_dir_url( __FILE__ ) . '../assets/css/main.css');
		wp_enqueue_script('plugin-js', plugin_dir_url( __FILE__ ) . '../assets/js/main.js', array('jquery'), '1', true);
	}

	// AJAX
	wp_localize_script( 'speedtest-v5-js', 'ajax_object', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	));
}

// EXPRESS QA SETTINGS
add_action( 'admin_init', 'eqa_settings_init' );
function eqa_settings_init() {
	register_setting( 'expressQAPlugin', 'eqa_settings' );
	// register_setting( 'expressQAPlugin', 'eqa_pagespeed_results' );

	add_settings_section( 'eqaPlugin_section', 'Control Panel', 'eqaPlugin_section_callback', 'expressQAPlugin' );

	add_settings_field( 'eqa_field_select_client', 'Client', 'eqa_field_select_client_render', 'expressQAPlugin', 'eqaPlugin_section' );
	add_settings_field( 'eqa_field_select_type', 'QA Type', 'eqa_field_select_type_render', 'expressQAPlugin', 'eqaPlugin_section' );

	add_settings_field( 'eqa_field_checkbox_tagline', 'Tagline provided?', 'eqa_field_checkbox_tagline_render', 'expressQAPlugin', 'eqaPlugin_section' );

	// EQA PAGESPEED RESULTS INITIAL
	// DESKTOP
	add_option('eqa_pagespeed_desktop_fcp', []);
	add_option('eqa_pagespeed_desktop_fmp', []);
	add_option('eqa_pagespeed_desktop_si', []);
	add_option('eqa_pagespeed_desktop_tti', []);
	add_option('eqa_pagespeed_desktop_fci', []);
	add_option('eqa_pagespeed_desktop_mpfid', []);
	add_option('eqa_pagespeed_desktop_os', []);
	// MOBILE
	add_option('eqa_pagespeed_mobile_fcp', []);
	add_option('eqa_pagespeed_mobile_fmp', []);
	add_option('eqa_pagespeed_mobile_si', []);
	add_option('eqa_pagespeed_mobile_tti', []);
	add_option('eqa_pagespeed_mobile_fci', []);
	add_option('eqa_pagespeed_mobile_mpfid', []);
	add_option('eqa_pagespeed_mobile_os', []);
}

function eqaPlugin_section_callback() {
	echo __( 'Control various parts of the plugin', 'eqa' );
}

// CUSTOM FIELDS
function eqa_field_select_client_render() {

	// EXPECTED VALUES - clickclickmedia, jackpoyntz, veedigital
	$options = get_option( 'eqa_settings' ); ?>

	<select name='eqa_settings[eqa_client_field]'>
		<option value='clickclickmedia' <?php selected( $options['eqa_client_field'], 'clickclickmedia', true ); ?>>ClickClickMedia</option>
		<option value='jackpoyntz' <?php selected( $options['eqa_client_field'], 'jackpoyntz', true ); ?>>Jackpoyntz</option>
		<option value='veedigital' <?php selected( $options['eqa_client_field'], 'veedigital', true ); ?>>VeeDigital</option>
	</select>

<?php }

function eqa_field_select_type_render() {

	$options = get_option( 'eqa_settings' ); ?>

	<select name='eqa_settings[eqa_type_field]'>
		<option value='initial' <?php selected( $options['eqa_type_field'], 'initial', true ); ?>>Initial</option>
		<option value='alpha' <?php selected( $options['eqa_type_field'], 'alpha', true ); ?>>Alpha</option>
		<option value='beta' <?php selected( $options['eqa_type_field'], 'beta', true ); ?>>Beta</option>
		<option value='speedtest' <?php selected( $options['eqa_type_field'], 'speedtest', true ); ?>>Speedtest</option>
	</select>

<?php }

function eqa_field_checkbox_tagline_render() {

	$options = get_option( 'eqa_settings' ); ?>

	<input type="checkbox" id="eqa_tagline_field" name="eqa_settings[eqa_tagline_field]" value="1" <?php checked( 1, $options['eqa_tagline_field'], true ); ?>/>

<?php }

// SETTINGS PAGE
function eqa_settings_page() { ?>
	<form action='options.php' method='post'>
		<!-- <h1>Express QA Settings</h1> -->

		<?php
			settings_fields( 'expressQAPlugin' );
			do_settings_sections( 'expressQAPlugin' );
			submit_button('Apply Settings');
		?>

	</form>

	<?php
		$currQAType = getCurrentQAType();
		if ($currQAType == 'initial') {
			eqa_initial();
		} elseif ($currQAType == 'alpha') {
			eqa_alpha();
		} elseif ($currQAType == 'beta') {
			eqa_beta();
		} elseif ($currQAType == 'speedtest') {
			eqa_speedtest();
		} else {
			echo "No Initial Settings!";
		}
}


// AJAX

// FIRST CONTENTFUL PAINT
add_action('wp_ajax_storeFCPData','storeFCPData');
add_action('wp_ajax_nopriv_storeFCPData','storeFCPData');
function storeFCPData() {
	$fcp  = isset( $_POST['fcp'] ) ? $_POST['fcp'] : '';
	$type = isset( $_POST['test_type'] ) ? $_POST['test_type'] : '';

	if ($fcp != '') {
		if ($type == 'desktop') {

			$fcp_option = get_option('eqa_pagespeed_desktop_fcp');
			if (count($fcp_option) < 6) {
				array_push($fcp_option, $fcp);
				update_option('eqa_pagespeed_desktop_fcp', $fcp_option);
			} else {
				array_shift($fcp_option);
				array_push($fcp_option, $fcp);
				update_option('eqa_pagespeed_desktop_fcp', $fcp_option);
			}

		} elseif ($type == 'mobile') {

			$fcp_option = get_option('eqa_pagespeed_mobile_fcp');
			if (count($fcp_option) < 6) {
				array_push($fcp_option, $fcp);
				update_option('eqa_pagespeed_mobile_fcp', $fcp_option);
			} else {
				array_shift($fcp_option);
				array_push($fcp_option, $fcp);
				update_option('eqa_pagespeed_mobile_fcp', $fcp_option);
			}

		}
	}

	wp_die();
}

// FIRST MEANINGFUL PAINT
add_action('wp_ajax_storeFMPData','storeFMPData');
add_action('wp_ajax_nopriv_storeFMPData','storeFMPData');
function storeFMPData() {
	$fmp  = isset( $_POST['fmp'] ) ? $_POST['fmp'] : '';
	$type = isset( $_POST['test_type'] ) ? $_POST['test_type'] : '';

	if ($fmp != '') {
		if ($type == 'desktop') {

			$fmp_option = get_option('eqa_pagespeed_desktop_fmp');
			if (count($fmp_option) < 6) {
				array_push($fmp_option, $fmp);
				update_option('eqa_pagespeed_desktop_fmp', $fmp_option);
			} else {
				array_shift($fmp_option);
				array_push($fmp_option, $fmp);
				update_option('eqa_pagespeed_desktop_fmp', $fmp_option);
			}

		} elseif ($type == 'mobile') {

			$fmp_option = get_option('eqa_pagespeed_mobile_fmp');
			if (count($fmp_option) < 6) {
				array_push($fmp_option, $fmp);
				update_option('eqa_pagespeed_mobile_fmp', $fmp_option);
			} else {
				array_shift($fmp_option);
				array_push($fmp_option, $fmp);
				update_option('eqa_pagespeed_mobile_fmp', $fmp_option);
			}

		}
	}

	wp_die();
}

// SPEED INDEX
add_action('wp_ajax_storeSIData','storeSIData');
add_action('wp_ajax_nopriv_storeSIData','storeSIData');
function storeSIData() {
	$si   = isset( $_POST['si'] ) ? $_POST['si'] : '';
	$type = isset( $_POST['test_type'] ) ? $_POST['test_type'] : '';

	if ($si != '') {
		if ($type == 'desktop') {

			$si_option = get_option('eqa_pagespeed_desktop_si');
			if (count($si_option) < 6) {
				array_push($si_option, $si);
				update_option('eqa_pagespeed_desktop_si', $si_option);
			} else {
				array_shift($si_option);
				array_push($si_option, $si);
				update_option('eqa_pagespeed_desktop_si', $si_option);
			}

		} elseif ($type == 'mobile') {

			$si_option = get_option('eqa_pagespeed_mobile_si');
			if (count($si_option) < 6) {
				array_push($si_option, $si);
				update_option('eqa_pagespeed_mobile_si', $si_option);
			} else {
				array_shift($si_option);
				array_push($si_option, $si);
				update_option('eqa_pagespeed_mobile_si', $si_option);
			}

		}
	}

	wp_die();
}

// TIME TO INTERACTIVE
add_action('wp_ajax_storeTTIData','storeTTIData');
add_action('wp_ajax_nopriv_storeTTIData','storeTTIData');
function storeTTIData() {
	$tti  = isset( $_POST['tti'] ) ? $_POST['tti'] : '';
	$type = isset( $_POST['test_type'] ) ? $_POST['test_type'] : '';

	if ($tti != '') {
		if ($type == 'desktop') {

			$tti_option = get_option('eqa_pagespeed_desktop_tti');
			if (count($tti_option) < 6) {
				array_push($tti_option, $tti);
				update_option('eqa_pagespeed_desktop_tti', $tti_option);
			} else {
				array_shift($tti_option);
				array_push($tti_option, $tti);
				update_option('eqa_pagespeed_desktop_tti', $tti_option);
			}

		} elseif ($type == 'mobile') {

			$tti_option = get_option('eqa_pagespeed_mobile_tti');
			if (count($tti_option) < 6) {
				array_push($tti_option, $tti);
				update_option('eqa_pagespeed_mobile_tti', $tti_option);
			} else {
				array_shift($tti_option);
				array_push($tti_option, $tti);
				update_option('eqa_pagespeed_mobile_tti', $tti_option);
			}

		}
	}

	wp_die();
}

// FIRST CPU IDLE
add_action('wp_ajax_storeFCIData','storeFCIData');
add_action('wp_ajax_nopriv_storeFCIData','storeFCIData');
function storeFCIData() {
	$fci  = isset( $_POST['fci'] ) ? $_POST['fci'] : '';
	$type = isset( $_POST['test_type'] ) ? $_POST['test_type'] : '';

	if ($fci != '') {
		if ($type == 'desktop') {

			$fci_option = get_option('eqa_pagespeed_desktop_fci');
			if (count($fci_option) < 6) {
				array_push($fci_option, $fci);
				update_option('eqa_pagespeed_desktop_fci', $fci_option);
			} else {
				array_shift($fci_option);
				array_push($fci_option, $fci);
				update_option('eqa_pagespeed_desktop_fci', $fci_option);
			}

		} elseif ($type == 'mobile') {

			$fci_option = get_option('eqa_pagespeed_mobile_fci');
			if (count($fci_option) < 6) {
				array_push($fci_option, $fci);
				update_option('eqa_pagespeed_mobile_fci', $fci_option);
			} else {
				array_shift($fci_option);
				array_push($fci_option, $fci);
				update_option('eqa_pagespeed_mobile_fci', $fci_option);
			}

		}
	}

	wp_die();
}

// MAX POTENTIAL FIRST INPUT DELAY
add_action('wp_ajax_storeMPFIDData','storeMPFIDData');
add_action('wp_ajax_nopriv_storeMPFIDData','storeMPFIDData');
function storeMPFIDData() {
	$mpfid = isset( $_POST['mpfid'] ) ? $_POST['mpfid'] : '';
	$type  = isset( $_POST['test_type'] ) ? $_POST['test_type'] : '';

	if ($mpfid != '') {
		if ($type == 'desktop') {

			$mpfid_option = get_option('eqa_pagespeed_desktop_mpfid');
			if (count($mpfid_option) < 6) {
				array_push($mpfid_option, $mpfid);
				update_option('eqa_pagespeed_desktop_mpfid', $mpfid_option);
			} else {
				array_shift($mpfid_option);
				array_push($mpfid_option, $mpfid);
				update_option('eqa_pagespeed_desktop_mpfid', $mpfid_option);
			}

		} elseif ($type == 'mobile') {

			$mpfid_option = get_option('eqa_pagespeed_mobile_mpfid');
			if (count($mpfid_option) < 6) {
				array_push($mpfid_option, $mpfid);
				update_option('eqa_pagespeed_mobile_mpfid', $mpfid_option);
			} else {
				array_shift($mpfid_option);
				array_push($mpfid_option, $mpfid);
				update_option('eqa_pagespeed_mobile_mpfid', $mpfid_option);
			}

		}
	}

	wp_die();
}

// OVERALL SCORE
add_action('wp_ajax_storeOSData','storeOSData');
add_action('wp_ajax_nopriv_storeOSData','storeOSData');
function storeOSData() {
	$os   = isset( $_POST['os'] ) ? $_POST['os'] : '';
	$type = isset( $_POST['test_type'] ) ? $_POST['test_type'] : '';

	if ($os != '') {
		if ($type == 'desktop') {

			$os_option = get_option('eqa_pagespeed_desktop_os');
			if (count($os_option) < 6) {
				array_push($os_option, $os);
				update_option('eqa_pagespeed_desktop_os', $os_option);
			} else {
				array_shift($os_option);
				array_push($os_option, $os);
				update_option('eqa_pagespeed_desktop_os', $os_option);
			}

		} elseif ($type == 'mobile') {

			$os_option = get_option('eqa_pagespeed_mobile_os');
			if (count($os_option) < 6) {
				array_push($os_option, $os);
				update_option('eqa_pagespeed_mobile_os', $os_option);
			} else {
				array_shift($os_option);
				array_push($os_option, $os);
				update_option('eqa_pagespeed_mobile_os', $os_option);
			}

		}
	}

	wp_die();
}

// ALL PREVIOUS RESULTS
add_action('wp_ajax_getAllPreviousResults','getAllPreviousResults');
add_action('wp_ajax_nopriv_getAllPreviousResults','getAllPreviousResults');
function getAllPreviousResults() {
	$type   = isset( $_POST['result_type'] ) ? $_POST['result_type'] : '';

	getIndividualPreviousResults('os', $type, 'Overall Score');
	getIndividualPreviousResults('fcp', $type, 'First Contentful Paint');
	getIndividualPreviousResults('fmp', $type, 'First Meaningful Paint');
	getIndividualPreviousResults('si', $type, 'Speed Index');
	getIndividualPreviousResults('tti', $type, 'Time to Interactive');
	getIndividualPreviousResults('fci', $type, 'First CPU Idle');
	getIndividualPreviousResults('fcp', $type, 'First Contentful Paint');
	getIndividualPreviousResults('mpfid', $type, 'Max Potential First Input Delay');
}
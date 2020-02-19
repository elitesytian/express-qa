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
}

// EXPRESS QA SETTINGS
add_action( 'admin_init', 'eqa_settings_init' );
function eqa_settings_init() {
	register_setting( 'expressQAPlugin', 'eqa_settings' );

	add_settings_section( 'eqaPlugin_section', 'Control Panel', 'eqaPlugin_section_callback', 'expressQAPlugin' );

	add_settings_field( 'eqa_field_select_client', 'Client', 'eqa_field_select_client_render', 'expressQAPlugin', 'eqaPlugin_section' );
	add_settings_field( 'eqa_field_checkbox_tagline', 'Tagline provided?', 'eqa_field_checkbox_tagline_render', 'expressQAPlugin', 'eqaPlugin_section' );
	add_settings_field( 'eqa_field_select_type', 'QA Type', 'eqa_field_select_type_render', 'expressQAPlugin', 'eqaPlugin_section' );
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
			echo "Test";
		}
}


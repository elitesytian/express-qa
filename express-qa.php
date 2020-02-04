<?php
/*
 * Plugin Name: Express QA
 * Plugin URI:
 * Description: Sytian Express QA
 * Version: 1.0
 * Author: Yuki Saito
 * Author URI:
 *
 */

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !class_exists( 'EQA' ) ) {
	class EQA {
		function __construct() {}

		function initialize() {
			// variables
			$basename = plugin_basename( __FILE__ );
			$path     = plugin_dir_path( __FILE__ );
			$url      = plugin_dir_url( __FILE__ );

			// includes
			include( $path . '/includes/setup.php' );
			include( $path . '/includes/helpers.php' );
			// include( $path . '/includes/variables.php' );

			include( $path . '/includes/eqa_initial.php' );
			include( $path . '/includes/eqa_alpha.php' );
			include( $path . '/includes/eqa_beta.php' );
		}
	}

	// initialize functions
	function eqa() {
		global $eqa;

		// initialize eqa class
		if ( !isset( $acf ) ) {
			$eqa = new EQA();
			$eqa->initialize();
		}
	}

	// initialize plugin
	eqa();
}
<?php

require_once( $path . 'includes/checklists/initial/_variables.php' );

require_once( $path . 'includes/checklists/initial/settings-general.php' );
require_once( $path . 'includes/checklists/initial/users-email.php' );
require_once( $path . 'includes/checklists/initial/appearance-theme.php' );
require_once( $path . 'includes/checklists/initial/plugins.php' );
require_once( $path . 'includes/checklists/initial/page-templates.php' );

// EXPRESS QA INITIAL
function eqa_initial() { ?>

	<div class="wrap">
		<h2>Initial QA</h2>
		<!-- SETTINGS - GENERAL -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Settings - General');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// TAGLINE
					addChecklistRow( "Tagline", "Empty unless specified", "initial_check_tagline" );

					// FAVICON
					addChecklistRow( "Favicon", "Image 16x16", "initial_check_favicon" );

					// DATE FORMAT
					addChecklistRow( "Date Format", "d/m/Y", "initial_check_date_format" );

					// START OF WEEK
					addChecklistRow( "Start of Week", "Sunday", "initial_check_start_of_week" );
				?>
			</tbody>
		</table>

		<!-- USERS - EMAIL -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Users - Email');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// USER EMAIL
					$user_email = 'Nothing set';
					if (getCurrentClient() == 'clickclickmedia') {
						$user_email = 'rik@clickclickmedia.com.au';
					} elseif (getCurrentClient() == 'jackpoyntz') {
						$user_email = 'dev.jackpoyntz@gmail.com';
					} elseif (getCurrentClient() == 'veedigital') {
						$user_email = 'yukis@veedigital.com';
					}
					addChecklistRow( "User Email", "$user_email", "initial_check_user_email" );
				?>
			</tbody>
		</table>

		<!-- APPEARANCE - THEME -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Appearance - Theme');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// THEME NAME
					addChecklistRow( "Theme Name", "Not empty", "initial_check_theme_name" );

					// THEME SCREENSHOT
					addChecklistRow( "Theme Screenshot", "Image named 'screenshot' must be present in Theme's root directory", "initial_check_theme_screenshot" );

					// THEME AUTHOR
					addChecklistRow( "Theme Author", "ClickClickMedia", "initial_check_theme_author" );

					// THEME AUTHOR URI
					addChecklistRow( "Theme Author URI", "https://clickclick.media/", "initial_check_theme_author_uri" );
				?>
			</tbody>
		</table>

		<!-- PLUGINS - GENERAL -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Plugins - General');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// PLUGIN CHECK LOOP USING CONSTANT ARRAY
					foreach (INITIAL_PLUGINS_TO_CHECK as $plugin) {
						// Values passed to callback
						$args['path']   = $plugin['path'];
						$args['status'] = $plugin['status'];

						$name        = $plugin['name'];
						$status_text = ucfirst($plugin['status']);

						addChecklistRow( $name, $status_text, "initial_check_plugin", $args );
					}
				?>
			</tbody>
		</table>

		<!-- PLUGINS - CLIENT SPECIFIC -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Plugins - Client Specific');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					if (getCurrentClient() == 'clickclickmedia') {
						foreach (INITIAL_PLUGINS_TO_CHECK_CCM as $plugin) {
							$args['path']   = $plugin['path'];
							$args['status'] = $plugin['status'];

							$name        = $plugin['name'];
							$status_text = ucfirst($plugin['status']);

							addChecklistRow( $name, $status_text, "initial_check_plugin", $args );
						}
					} elseif (getCurrentClient() == 'jackpoyntz') {
						foreach (INITIAL_PLUGINS_TO_CHECK_JP as $plugin) {
							$args['path']   = $plugin['path'];
							$args['status'] = $plugin['status'];

							$name        = $plugin['name'];
							$status_text = ucfirst($plugin['status']);

							addChecklistRow( $name, $status_text, "initial_check_plugin", $args );
						}
					} else {
						echo '<tr>';
						echo '	<td colspan="3" class="criteria">No specific plugins required for current client</td>';
						echo '</tr>';
					}
				?>
			</tbody>
		</table>

		<!-- PAGE TEMPLATES - GENERAL -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Page Templates - General');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// PAGE TEMPLATE - 404
					$args = '404.php';
					addChecklistRow( "404 Page", "404.php in theme files", "initial_check_page_template", $args );

					// PAGE TEMPLATE - THANK YOU PAGE
					$args = array(
						"templates/template-thank-you.php",
						"templates/template-thankyou.php",
						"templates/thank-you.php",
						"templates/thankyou.php"
					);
					addChecklistRow( "Thank You Page", "Must be present in theme's template files", "initial_check_page_template", $args );
				?>
			</tbody>
		</table>
	</div>

<?php }
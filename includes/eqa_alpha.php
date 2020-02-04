<?php

require_once( $path . 'includes/checklists/alpha/_variables.php' );

require_once( $path . 'includes/checklists/alpha/appearance-theme.php' );
require_once( $path . 'includes/checklists/alpha/appearance-customize.php' );
require_once( $path . 'includes/checklists/alpha/settings-general.php' );
require_once( $path . 'includes/checklists/alpha/settings-discussion.php' );
require_once( $path . 'includes/checklists/alpha/settings-media.php' );
require_once( $path . 'includes/checklists/alpha/settings-permalinks.php' );
require_once( $path . 'includes/checklists/alpha/settings-privacy.php' );
require_once( $path . 'includes/checklists/alpha/settings-users.php' );
require_once( $path . 'includes/checklists/alpha/database-setup.php' );
require_once( $path . 'includes/checklists/alpha/plugins.php' );
require_once( $path . 'includes/checklists/alpha/development.php' );
require_once( $path . 'includes/checklists/alpha/page-templates.php' );
require_once( $path . 'includes/checklists/alpha/basic-seo.php' );

// EXPRESS QA ALPHA
function eqa_alpha() { ?>

	<div class="wrap">
		<h2>Alpha QA</h2>
		<!-- APPREARANCE - THEME -->
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
					$expected_theme_name = get_bloginfo('name') . " Theme";
					addChecklistRow( "Theme Name", $expected_theme_name, "alpha_check_theme_name" );

					// THEME SCREENSHOT
					addChecklistRow( "Theme Screenshot", "Image named 'screenshot' must be present in Theme's root directory", "alpha_check_theme_screenshot" );
				?>
			</tbody>
		</table>

		<!-- APPEARANCE - CUSTOMIZE -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Appearance - Customize');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// SITE TITLE
					addChecklistRow( "Site Title", "Not empty", "alpha_check_site_title" );

					// TAGLINE
					addChecklistRow( "Tagline", "Empty unless specified", "alpha_check_tagline" );

					// SITE ICON
					addChecklistRow( "Site Icon", "Image 16x16", "alpha_check_site_icon" );

					// HOME PAGE
					addChecklistRow( "Home Page", "Must be set to a static page", "alpha_check_homepage" );

					// POSTS PAGE
					addChecklistRow( "Posts Page", "Must be set to a static page", "alpha_check_postspage" );
				?>
			</tbody>
		</table>

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
					$user_email    = 'Nothing set';
					$timezone      = 'Nothing set';
					$site_language = 'Nothing set';

					if (getCurrentClient() == 'clickclickmedia') {
						$user_email    = 'rik@clickclickmedia.com.au';
						$timezone      = 'Australia';
						$site_language = 'en-AU';
					} elseif (getCurrentClient() == 'jackpoyntz') {
						$user_email = 'dev.jackpoyntz@gmail.com';
					} elseif (getCurrentClient() == 'veedigital') {
						$user_email = 'yukis@veedigital.com';
					}

					// EMAIL ADDRESS
					addChecklistRow( "Email Address", "$user_email", "alpha_check_email_address" );

					// DATE FORMAT
					addChecklistRow( "Date Format", "d/m/Y", "alpha_check_date_format" );

					// TIMEZONE
					addChecklistRow( "Timezone", $timezone, "alpha_check_timezone" );

					// START OF WEEK
					addChecklistRow( "Start of Week", "Sunday", "alpha_check_start_of_week" );

					// SITE LANGUAGE
					addChecklistRow( "Site Language", $site_language, "alpha_check_site_language" );

					// POSTS PER PAGE
					addChecklistRow( "Posts Per Page", "10 posts by default", "alpha_check_posts_per_page" );

					// SEARCH ENGINE VISIBILITY
					addChecklistRow( "Search Engine Visibility", "Checked", "alpha_check_search_engine_visibility" );
				?>
			</tbody>
		</table>

		<!-- SETTINGS - DISCUSSION -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Settings - Discussion');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// COMMENT MODERATION
					addChecklistRow( "Manually Approve Comments", "Checked", "alpha_check_comment_moderation" );
				?>
			</tbody>
		</table>

		<!-- SETTINGS - MEDIA -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Settings - Media');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// MEDIA UPLOADS
					addChecklistRow( "Uploading Files", "Uncheck Month and Year Uploads", "alpha_check_media_uploads" );
				?>
			</tbody>
		</table>

		<!-- SETTINGS - PERMALINKS -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Settings - Permalinks');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// PERMALINKS
					addChecklistRow( "Permalinks", "/%category%/%postname%/ or /%postname%/", "alpha_check_permalinks" );
				?>
			</tbody>
		</table>

		<!-- SETTINGS - PRIVACY -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Settings - Privacy');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// PRIVACY PAGE
					addChecklistRow( "Privacy Page", "Static Privacy page must be set", "alpha_check_privacy_page" );
				?>
			</tbody>
		</table>

		<!-- SETTINGS - USERS -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Settings - Users');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// USERS - dev-site
					$args['target_username'] = 'dev-site';
					$args['target_email']    = 'rik@clickclickmedia.com.au';
					addChecklistRow( "User - dev-site", "dev-site, rik@clickclickmedia.com.au", "alpha_check_user_email", $args );

					// USERS - clickclickmedia
					$args['target_username'] = 'clickclickmedia';
					$args['target_email']    = 'clients@clickclickmedia.com.au';
					addChecklistRow( "User - clickclickmedia", "clickclickmedia, clients@clickclickmedia.com.au", "alpha_check_user_email", $args );
				?>
			</tbody>
		</table>

		<!-- DATABASE - SETUP -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Database - Setup');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// PRIVACY PAGE
					addChecklistRow( "Database Prefix", "Must not be 'wp_'", "alpha_check_database_prefix" );
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
					foreach (ALPHA_PLUGINS_TO_CHECK as $plugin) {
						// Values passed to callback
						$args['path']   = $plugin['path'];
						$args['status'] = $plugin['status'];

						$name        = $plugin['name'];
						$status_text = ucfirst($plugin['status']);

						addChecklistRow( $name, $status_text, "alpha_check_plugin", $args );
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
						foreach (ALPHA_PLUGINS_TO_CHECK_CCM as $plugin) {
							$args['path']   = $plugin['path'];
							$args['status'] = $plugin['status'];

							$name        = $plugin['name'];
							$status_text = ucfirst($plugin['status']);

							addChecklistRow( $name, $status_text, "alpha_check_plugin", $args );
						}
					} elseif (getCurrentClient() == 'jackpoyntz') {
						foreach (ALPHA_PLUGINS_TO_CHECK_JP as $plugin) {
							$args['path']   = $plugin['path'];
							$args['status'] = $plugin['status'];

							$name        = $plugin['name'];
							$status_text = ucfirst($plugin['status']);

							addChecklistRow( $name, $status_text, "alpha_check_plugin", $args );
						}
					} else {
						echo '<tr>';
						echo '	<td colspan="3" class="criteria">No specific plugins required for current client</td>';
						echo '</tr>';
					}
				?>
			</tbody>
		</table>

		<!-- DEVELOPMENT -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Development');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// WP DEBUG
					addChecklistRow( "WP Debug", "Must be set to false", "alpha_check_wp_debug" );
				?>
			</tbody>
		</table>

		<!-- PAGE TEMPLATES -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Page Templates');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// PAGE TEMPLATE - 404
					$args = '404.php';
					addChecklistRow( "404 Page", "404.php in theme files", "alpha_check_page_template", $args );

					// PAGE TEMPLATE - THANK YOU PAGE
					$args = array(
						"templates/template-thank-you.php",
						"templates/template-thankyou.php",
						"templates/thank-you.php",
						"templates/thankyou.php"
					);
					addChecklistRow( "Thank You Page", "Must be present in theme's template files", "alpha_check_page_template", $args );
				?>
			</tbody>
		</table>

		<!-- BASIC SEO -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<?php
					addChecklistTitle('Basic SEO');

					addChecklistRowHeading();
				?>
			</thead>

			<tbody>
				<?php
					// ROBOTS.TXT
					addChecklistRow( "Robots.txt", "Must be present in theme's root directory", "alpha_check_robots", );
				?>
			</tbody>
		</table>
	</div>

<?php }
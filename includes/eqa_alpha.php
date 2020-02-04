<?php

require_once( $path . 'includes/checklists/alpha/appearance-theme.php' );
require_once( $path . 'includes/checklists/alpha/appearance-customize.php' );
require_once( $path . 'includes/checklists/alpha/settings-general.php' );
require_once( $path . 'includes/checklists/alpha/settings-discussion.php' );
require_once( $path . 'includes/checklists/alpha/settings-media.php' );
require_once( $path . 'includes/checklists/alpha/settings-permalinks.php' );
require_once( $path . 'includes/checklists/alpha/settings-privacy.php' );

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



		<!-- Plugins -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<tr>
					<th colspan="4"><strong>Plugins -> Installed Plugins</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$plugins = get_plugins();
					$pluginList = array( "Advanced Custom Fields Pro", "Akismet Anti-Spam", "Autoptimize", "BackWPup", "Duplicator", "Gravity Forms", "Hello Dolly", "reSmush.it Image Optimizer", "Super Progressive Web Apps", "WebP Express", "Wordfence Security", "Yoast SEO" );
					$activePlugins = get_option('active_plugins');

					foreach ( $pluginList as $key => $p ) {
						$isInstalled = false;
						$isActive = false;
						$textDomain = "";

						if ( $plugins ) {
							foreach ( $plugins as $key => $plugin ) {
								$apTitle = null;
								if ( $plugin["Title"] == $p ) {
									$isInstalled = true;
									$textDomain = $key;
								}
							}
						}

						if ( in_array( $textDomain, $activePlugins ) ) {
							$isActive = true;
						}

						$installedText = ( $isInstalled == true ) ? 'Installed' : 'Not Installed';
						$activeText = ( $isActive == true ) ? 'Active' : 'Not Active';

						echo "<tr>";
						echo "<td>".$p."</td>";
						echo "<td>".$installedText."</td>";
						echo "<td>".$activeText."</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>

		<!-- USERS -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<tr>
					<th colspan="4"><strong>User Settings</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php
					//global $wpdb; var_dump($wpdb->prefix);
					$allUsers = get_users();
					$requiredUsers = [];
					foreach ( $allUsers as $key => $user ) {
						$userLogin = $user->data->user_login;
						$userEmail = $user->data->user_email;
						if ( $userLogin == "clickclickmedia" || $userLogin == "dev-site" ) {
							echo "<tr>";
							echo "<td>".$userLogin."</td>";
							echo "<td>".$userEmail."</td>";
							echo "<td class='check' style='font-weight: bold; font-size: 16px;'>";
							if ( preg_match( '/\bsytian\b/', $userEmail ) ) {
								echo "<span style='color: red;'>x</span>";
							} else {
								echo "<span style='color: green;'>✓</span>";
							}
							echo "</td>";
							echo "</tr>";
						}
					}
				?>
			</tbody>
		</table>

		<!-- OTHER SETTINGS -->
		<table class="widefat striped" style="margin-top: 30px;">
			<thead>
				<tr>
					<th colspan="4"><strong>Other Settings</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php
					// page settings -- blog page

					global $wpdb;
					$wpPrefix = $wpdb->prefix;

					echo "<tr>";
					echo "<td>Database Prefix:</td>";
					echo "<td>".$wpPrefix."</td>";
					echo "<td class='check' style='font-weight: bold; font-size: 16px;'>";
					if ( $wpPrefix == "wp_" ) {
						echo "<span style='color: red;'>x</span>";
					} else {
						echo "<span style='color: green;'>✓</span>";
					}
					echo "</td>";
					echo "</tr>";

					$robotsUrl = get_site_url() . "/robots.txt";
				?>
				<tr>
					<td>robots.txt</td>
					<td><?php echo file_exists( $robotsUrl ) ? "Found" : "Not Found"; ?></td>
					<td class="check" style='font-weight: bold; font-size: 16px;'><?php
						if ( !file_exists( $robotsUrl ) ) {
							echo "<span style='color: red;'>x</span>";
						} else {
							echo "<span style='color: green;'>✓</span>";
						}
					?></td>
				</tr>
			</tbody>
		</table>

	</div>

<?php }
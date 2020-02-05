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

$GLOBALS['total_items']  = 0;
$GLOBALS['items_passed'] = 0;

// EXPRESS QA ALPHA
function eqa_alpha() { ?>

	<div class="wrap">
		<h2>Alpha QA</h2>

		<table class="widefat striped" style="margin-top: 30px;">
			<tbody>
				<?php
					addChecklistTitle('Appearance - Theme');
					addChecklistRowHeading();
					// THEME NAME
					$expected_theme_name = get_bloginfo('name') . " Theme";
					addChecklistRow( "Theme Name", $expected_theme_name, "alpha_check_theme_name" );
					// THEME SCREENSHOT
					addChecklistRow( "Theme Screenshot", "Image named 'screenshot' must be present in Theme's root directory", "alpha_check_theme_screenshot" );


					addChecklistTitle('Appearance - Customize');
					addChecklistRowHeading();
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


					addChecklistTitle('Settings - General');
					addChecklistRowHeading();

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


					addChecklistTitle('Settings - Discussion');
					addChecklistRowHeading();
					// COMMENT MODERATION
					addChecklistRow( "Manually Approve Comments", "Checked", "alpha_check_comment_moderation" );


					addChecklistTitle('Settings - Media');
					addChecklistRowHeading();
					// MEDIA UPLOADS
					addChecklistRow( "Uploading Files", "Uncheck Month and Year Uploads", "alpha_check_media_uploads" );


					addChecklistTitle('Settings - Permalinks');
					addChecklistRowHeading();
					// PERMALINKS
					addChecklistRow( "Permalinks", "/%category%/%postname%/ or /%postname%/", "alpha_check_permalinks" );


					addChecklistTitle('Settings - Privacy');
					addChecklistRowHeading();
					// PRIVACY PAGE
					addChecklistRow( "Privacy Page", "Static Privacy page must be set", "alpha_check_privacy_page" );


					addChecklistTitle('Settings - Users');
					addChecklistRowHeading();
					// USERS - dev-site
					$args['target_username'] = 'dev-site';
					$args['target_email']    = 'rik@clickclickmedia.com.au';
					addChecklistRow( "User - dev-site", "dev-site, rik@clickclickmedia.com.au", "alpha_check_user_email", $args );
					// USERS - clickclickmedia
					$args['target_username'] = 'clickclickmedia';
					$args['target_email']    = 'clients@clickclickmedia.com.au';
					addChecklistRow( "User - clickclickmedia", "clickclickmedia, clients@clickclickmedia.com.au", "alpha_check_user_email", $args );


					addChecklistTitle('Database - Setup');
					addChecklistRowHeading();
					// PRIVACY PAGE
					addChecklistRow( "Database Prefix", "Must not be 'wp_'", "alpha_check_database_prefix" );


					addChecklistTitle('Plugins - General');
					addChecklistRowHeading();
					// PLUGINS - GENERAL
					foreach (ALPHA_PLUGINS_TO_CHECK as $plugin) {
						$args['path']   = $plugin['path'];
						$args['status'] = $plugin['status'];

						$name        = $plugin['name'];
						$status_text = ucfirst($plugin['status']);

						addChecklistRow( $name, $status_text, "alpha_check_plugin", $args );
					}


					addChecklistTitle('Plugins - Client Specific');
					addChecklistRowHeading();
					// PLUGINS - CLIENT SPECIFIC
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


					addChecklistTitle('Development');
					addChecklistRowHeading();
					// WP DEBUG
					addChecklistRow( "WP Debug", "Must be set to false", "alpha_check_wp_debug" );


					addChecklistTitle('Page Templates');
					addChecklistRowHeading();
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


					addChecklistTitle('Basic SEO');
					addChecklistRowHeading();
					// ROBOTS.TXT
					addChecklistRow( "Robots.txt", "Must be present in Wordpress' root directory", "alpha_check_robots", );
				?>
			</tbody>
		</table>

		<h3>Checklist Progress</h3>
		<?php getProgress(); ?>
	</div>

<?php }
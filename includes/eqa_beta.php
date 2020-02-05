<?php

require_once( $path . 'includes/checklists/beta/_variables.php' );

require_once( $path . 'includes/checklists/beta/theme-files.php' );
require_once( $path . 'includes/checklists/beta/basic-seo.php' );
require_once( $path . 'includes/checklists/beta/plugins.php' );

$GLOBALS['total_items']  = 0;
$GLOBALS['items_passed'] = 0;

// EXPRESS QA BETA
function eqa_beta() { ?>
	
	<div class="wrap">
		<h2>Beta QA</h2>

		<table class="widefat striped" style="margin-top: 30px;">
			<tbody>
				<?php
					addChecklistTitle('Theme - Files');
					addChecklistRowHeading();
					// NODE MODULES
					addChecklistRow( "Node Modules", "Must not be present in theme directory", "beta_check_node_modules" );
					// SRDB
					addChecklistRow( "SRDB", "Must not be present in theme directory", "beta_check_srdb" );


					addChecklistTitle('Basic SEO');
					addChecklistRowHeading();
					// SEARCH ENGINE VISIBILITY
					addChecklistRow( "Search Engine Visibility", "Unchecked", "beta_check_search_engine_visibility" );


					addChecklistTitle('Plugins - Client Specific');
					addChecklistRowHeading();
					// PLUGINS - CLIENT SPECIFIC
					if (getCurrentClient() == 'clickclickmedia') {
						foreach (BETA_PLUGINS_TO_CHECK_CCM as $plugin) {
							$args['path']   = $plugin['path'];
							$args['status'] = $plugin['status'];

							$name        = $plugin['name'];
							$status_text = ucfirst($plugin['status']);

							addChecklistRow( $name, $status_text, "beta_check_plugin", $args );
						}
					} else {
						echo '<tr>';
						echo '	<td colspan="3" class="criteria">No specific plugins required for current client</td>';
						echo '</tr>';
					}
				?>
			</tbody>
		</table>

		<h3>Checklist Progress</h3>
		<?php getProgress(); ?>
	</div>

<?php }
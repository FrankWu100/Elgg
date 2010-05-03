<?php

/**
 * Elgg river dashboard plugin
 *
 * @package ElggRiverDash
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Curverider Ltd <info@elgg.com>
 * @copyright Curverider Ltd 2008-2010
 * @link http://elgg.org/
 */

function riverdashboard_init() {

	global $CONFIG;

	// Register and optionally replace the dashboard
	if (get_plugin_setting('useasdashboard', 'riverdashboard') == 'yes') {
		register_page_handler('dashboard', 'riverdashboard_page_handler');
	} else {
		// Activity main menu
		if (isloggedin()) {
			add_menu(elgg_echo('activity'), $CONFIG->wwwroot . "mod/riverdashboard/");
		}
	}

	// Page handler
	register_page_handler('riverdashboard', 'riverdashboard_page_handler');

	elgg_extend_view('css', 'riverdashboard/css');

	add_widget_type('river_widget', elgg_echo('river:widget:title'), elgg_echo('river:widget:description'));
}

/**
 * Page handler for riverdash
 *
 * @param array $page
 */
function riverdashboard_page_handler($page) {

	include(dirname(__FILE__) . "/index.php");
	return TRUE;
}

function riverdashboard_dashboard() {

	include(dirname(__FILE__) . '/index.php');
}

register_elgg_event_handler('init', 'system', 'riverdashboard_init');

// Register actions
register_action("riverdashboard/add", FALSE, $CONFIG->pluginspath . "riverdashboard/actions/add.php", TRUE);
register_action("riverdashboard/delete", FALSE, $CONFIG->pluginspath . "riverdashboard/actions/delete.php", TRUE);

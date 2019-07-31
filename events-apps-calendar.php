<?php
/**
 * Plugin Name: Events APPS Calendar
 * Plugin URI:  
 * Description: Basic WordPress Plugin Header Comment
 * Version:     1.3.0
 * Author:      The Programmers
 * Author URI:  
 * Text Domain: 
 * Domain Path: 
 * License:     
 */

/**
 * Define the plugin version
 */

if (!defined('ABSPATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	die();
}

/********** INCLUDES **********/

// Includes
include_once 'includes/db-connect.php';
include 'includes/functions.php';

// Assets
include 'assets/asset_controller.php';


/********** Display **********/
function display_events_apps_calendar(){
    include_once 'view/view-calendar.html';
    // include_once 'view/view-calendar2.html';
}
add_shortcode('apps_cal_show_static_calendar', 'display_events_apps_calendar');
?>
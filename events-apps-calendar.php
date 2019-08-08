<?php
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');
/**
 * Plugin Name: Events APPS Calendar
 * Plugin URI:  
 * Description: Basic WordPress Plugin Header Comment
 * Version:     1.3.1
 * Author:      The Programmers
 * Author URI:  
 * Text Domain: 
 * Domain Path: 
 * License:     
 */

/**
 * Define the plugin version
 */

// register_activation_hook( __FILE__, 'eventsCalendar_create_tables' );

// Include Javascript library
// wp_enqueue_script('inkthemes', plugins_url( '/controller/calendar-ajax.js' , __FILE__ ) , array( 'jquery' ));
// including ajax script in the plugin Myajax.ajaxurl
// wp_localize_script( 'inkthemes', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php')));

/********** INCLUDES **********/

//Controller
include_once 'controller/connect.php';
include 'controller/calendar.php';

// Assets
include 'assets/asset_controller.php';

// Includes
include 'includes/wp_event_calendar_menu.php';



/********** Display **********/
function display_events_apps_calendar(){
    // include_once 'view/view-calendar.html';
	// include_once 'view/view-calendar2.html';
	// echo '<div class="calendar-wrapper">
	// 		<button id="btnPrev" type="button">Prev</button>
	// 		<button id="btnNext" type="button">Next</button>
	// 		<div id="divCalendar"></div>
	// 	</div>';
	echo '<div id="calendar_div">'.	getCalender().'</div>';
}
add_shortcode('apps_cal_show_static_calendar', 'display_events_apps_calendar');
?>
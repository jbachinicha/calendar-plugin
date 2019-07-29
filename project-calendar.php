<?php
/**
 * The main plugin file
 *
 * @package WordPress_Plugins
 * @subpackage OS_Disable_WordPress_Updates
 */

/*
Plugin Name: Project Calendar
Description: This is the very first plugin I ever created.
Plugin URI:  
Version:     1.2.0
Author:      The Programmers
Author URI:  
License:	 

Copyright 2019
*/

/**
 * Define the plugin version
 */


add_action( 'wp_enqueue_scripts', 'prj_cal_style' );
add_action( 'wp_enqueue_scripts', 'prj_cal_scripts' );
function prj_cal_style(){
    wp_register_style( 'custom-style', plugins_url( '/assets/css/calendar-style-ver1.min.css', __FILE__ ), array(), '20120208', 'all' );
    wp_register_style( 'custom-style', plugins_url( '/assets/css/font-awesome.min.css', __FILE__ ), array(), '20120208', 'all' );
        wp_enqueue_style( 'custom-style' );
}
function prj_cal_scripts(){
    wp_register_script( 'custom-script', plugins_url( '/assets/js/calendar.min.js', __FILE__ ) );
        wp_enqueue_script( 'custom-script' );
}

function prj_cal_display_calendar(){
    include_once 'view/view-calendar.html';
}
add_shortcode('prj_cal_show_static_calendar', 'prj_cal_display_calendar');


?>
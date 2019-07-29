<?php
/**
* Plugin Name: Project Calendar
* Description: This is the very first plugin I ever created.
* Version: 1.0
* Author#: 654
**/

function prj_cal_style(){
    // Register the style like this for a plugin:
    wp_register_style( 'custom-style', plugins_url( '/assets/css/calendar-style.css', __FILE__ ), array(), '20120208', 'all' );
    // wp_register_style( 'custom-style', plugins_url( '/assets/css/demo.css', __FILE__ ), array(), '20120208', 'all' );
 
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'custom-style' );
}
function prj_cal_scripts(){
    // Register the script like this for a plugin:
    wp_register_script( 'custom-script', plugins_url( '/calendar/caleandar.js', __FILE__ ) );
    // wp_register_script( 'custom-script', plugins_url( '/calendar/caleandar.js', __FILE__ ), array( 'jquery', 'jquery-ui-core' ), '20120208', true );
 
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'prj_cal_style' );
add_action( 'wp_enqueue_scripts', 'prj_cal_scripts' );

function prj_cal_display_calendar(){
    include_once 'controller/create-calendar.php';
}
add_shortcode('prj_cal_show_static_calendar', 'prj_cal_display_calendar');


?>
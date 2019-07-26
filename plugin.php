<?php
/**
* Plugin Name: Project Calendar
* Description: This is the very first plugin I ever created.
* Version: 1.0
* Author#: 654
**/

function prj_cal_style_scripts(){
    // Register the style like this for a plugin:
    wp_register_style( 'custom-style', plugins_url( '/css/calendar-style.css', __FILE__ ), array(), '20120208', 'all' );
    // or
    // Register the style like this for a theme:
    // wp_register_style( 'custom-style', get_template_directory_uri() . '/css/calendar-style.css', array(), '20120208', 'all' );
 
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'custom-style' );
}
add_action( 'wp_enqueue_scripts', 'prj_cal_style_scripts' );


function prj_cal_display_calendar(){
    include_once 'controller/create-calendar.php';
}
add_shortcode('prj_cal_show_static_calendar', 'prj_cal_display_calendar');


?>
<?php
if (!defined('ABSPATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	die();
}

add_action( 'wp_enqueue_scripts', 'prj_cal_style' );
add_action( 'wp_enqueue_scripts', 'prj_cal_scripts' );
function prj_cal_style(){
    wp_register_style( 'custom-style', plugins_url( '/css/calendar-style-ver1.min.css', __FILE__ ), array(), '20120208', 'all' );
    wp_register_style( 'custom-style', plugins_url( '/css/font-awesome.min.css', __FILE__ ), array(), '20120208', 'all' );
        wp_enqueue_style( 'custom-style' );
}
function prj_cal_scripts(){
    wp_register_script( 'custom-script', plugins_url( '/js/calendar.min.js', __FILE__ ) );
        wp_enqueue_script( 'custom-script' );
}
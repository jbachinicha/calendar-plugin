<?php
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');


add_action( 'wp_enqueue_scripts', 'cal_style' );
add_action( 'wp_enqueue_scripts', 'cal_scripts' );
function cal_style(){
    wp_register_style( 'custom-calendar-style', plugins_url( '/css/style.min.css', __FILE__ ), array(), '20120208', 'all' );
    // removed bootstrap styles
    //wp_register_style( 'bootstrap-style', plugins_url( '/css/bootstrap.min.css', __FILE__ ), array(), '20120208', 'all' );
    //wp_register_style( 'bootstrap-calendar-style', plugins_url( '/css/style2.min.css', __FILE__ ), array(), '20120208', 'all' );
        wp_enqueue_style( 'custom-calendar-style' );
          // removed bootstrap styles
        //wp_enqueue_style( 'bootstrap-style' );
        //wp_enqueue_style( 'bootstrap-calendar-style' );
}

function cal_scripts(){
    wp_register_script( 'custom-script', plugins_url( '/js/jquery-3.3.1.min.js', __FILE__ ) );
    wp_register_script( 'calendar-ajax', plugins_url( '../controller/calendar-ajax.min.js', __FILE__ ) );
    wp_enqueue_script( 'custom-script' );
    wp_enqueue_script( 'calendar-ajax' );
}

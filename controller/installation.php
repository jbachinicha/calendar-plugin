<?php
if (!defined('ABSPATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	die();
}


register_activation_hook( __FILE__, 'events_apps_cal_activation' );
function events_apps_cal_activation() {
  add_option( 'events_apps_cal_activated', time() );
}
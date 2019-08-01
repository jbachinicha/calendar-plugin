<?php
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');

$db_name = $wpdb->prefix . 'events_apps_calendar';
 
// function to create the DB / Options / Defaults					
function your_plugin_options_install() {
   	global $wpdb;
  	global $db_name;
 
	// create the ECPT metabox database table
	if($wpdb->get_var("show tables like '$db_name'") != $db_name) 
	{
		$sql = "CREATE TABLE " . $db_name . " (
		`id` INT NOT NULL AUTO_INCREMENT,
		`title` VARCHAR(255) NOT NULL,
		`date` DATE NOT NULL,
		`description` VARCHAR(255) NOT NULL,
		UNIQUE KEY id (id)
		);";
 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
 
}
// run the install scripts upon plugin activation
register_activation_hook(__FILE__,'your_plugin_options_install');

// function jal_install () {
// 	global $wpdb;
 
// 	$charset_collate = $wpdb->get_charset_collate();
// 	$table_name = $wpdb->prefix . "events_apps_calendar"; 

// 	$sql = "CREATE TABLE $table_name (
// 		id mediumint(9) NOT NULL AUTO_INCREMENT,
// 		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
// 		name tinytext NOT NULL,
// 		text text NOT NULL,
// 		url varchar(55) DEFAULT '' NOT NULL,
// 		PRIMARY KEY  (id)
// 	  ) $charset_collate;";
	  
// 	  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
// 	  dbDelta( $sql );
//  }

// register_activation_hook( __FILE__, 'events_apps_cal_create_db' );
// function events_apps_cal_create_db() {

// 	global $wpdb;
//   	$version = get_option( 'events_apps_cal_version', '1.0' );
// 	$charset_collate = $wpdb->get_charset_collate();
// 	$table_name = $wpdb->prefix . 'events_apps_cal';

// 	$sql = "CREATE TABLE $table_name (
// 		id mediumint(9) NOT NULL AUTO_INCREMENT,
// 		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
// 		views smallint(5) NOT NULL,
// 		clicks smallint(5) NOT NULL,
// 		UNIQUE KEY id (id)
// 	) $charset_collate;";

// 	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
// 	dbDelta( $sql );
	
// 	if ( version_compare( $version, '2.0' ) < 0 ) {
// 		$sql = "CREATE TABLE $table_name (
// 		  id mediumint(9) NOT NULL AUTO_INCREMENT,
// 		  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
// 		  views smallint(5) NOT NULL,
// 		  clicks smallint(5) NOT NULL,
// 		  blog_id smallint(5) NOT NULL,
// 		  UNIQUE KEY id (id)
// 		) $charset_collate;";
// 		dbDelta( $sql );
	
// 	  	update_option( 'events_apps_cal_version', '2.0' );
		
// 	}

	
// }
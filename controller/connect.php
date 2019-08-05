<?php 
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');

// function eventsCalendar_create_tables($wpdb) {
    
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    // $db = new mysqli($servername, $username, $password, $dbName); 

    $sql = "CREATE TABLE `{$wpdb->base_prefix}events_calendar` (
        `id` int NOT NULL AUTO_INCREMENT,
        `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `date` date NOT NULL,
        `created` datetime NOT NULL,
        `modified` datetime NOT NULL,
        `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active | 0=Inactive',
        PRIMARY KEY (`id`)
    )";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
// }


/*
 * Update database ... NOT YET WORKING
 */
// function upgrade() {
//     $saved_version = (int) get_site_option('wp_cli_login_db_version');

//     if ($saved_version < 200 && upgrade_200()) {
//         update_site_option('wp_cli_login_db_version', 200);
//     }
// }


/*
 * RAW DB CONNECT
 */
// // Database configuration 
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbName = "sampleDB";
// $tableName = "events";

// $db = new mysqli($servername, $username, $password, $dbName); 

// // Connect to MySQL
// $conn = new mysqli($servername, $username, $password);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // If database is not exist create one
// if (!mysqli_select_db($conn,$dbName)){
//     $sql = "CREATE DATABASE ".$dbName;

//     if ($conn->query($sql) === TRUE) {
//         echo "Database created successfully";
//     }else {
//         // echo "Error creating database: " . $conn->error;
//         $conn->close();
//     }
// }

// if (!mysqli_select_db($conn,$tableName)){    
//     $sql_table = "CREATE TABLE ".$tableName." (
//         `id` int(11) NOT NULL AUTO_INCREMENT,
//         `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
//         `date` date NOT NULL,
//         `created` datetime NOT NULL,
//         `modified` datetime NOT NULL,
//         `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active | 0=Inactive',
//         PRIMARY KEY (`id`)
//        )";

//        if ($conn->query($sql_table) === TRUE) {
//            echo "Table events created successfully";
//        } else {
//         //    echo "Error creating table: " . $conn->error;
//             $conn->close();
//        }
// }


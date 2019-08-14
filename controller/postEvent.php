<?php 

if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');

/* 
 * Load function based on the Ajax request 
 */ 
if(isset($_POST['post']) && !empty($_POST['post'])){

    // switch($_POST['post']){ 
    //     case 'getCalender': 
    //         getCalender($_POST['year'],$_POST['month']); 
    //         break; 
    //     case 'getEvents': 
    //         getEvents($_POST['date']); 
    //         break; 
    //     //For Add Event
    //     case 'addEvent':
    //         postEvent($_POST['date'],$_POST['title']);
    //         break;
    //     default: 
    //         break; 
    // } 
    $post = $_POST['post'];
    echo $post;
}

require_once('./Calendar.php');
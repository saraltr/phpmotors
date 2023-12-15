<?php
// this is the main controller

// Create or access a Session
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// get the custom functions
require_once 'library/functions.php';


// Get the array of classifications
$classifications = getClassifications();

// testing
// var_dump($classifications);
// 	exit;

// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

// testing
// echo $navList;
// exit;

// check if the firstname cookie exists, get its value
// if(isset($_COOKIE['firstname'])){
//     $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// }

switch ($action){
    case 'template':
        include 'view/template.php';
        break;
    default:
        include 'view/home.php';
}

?>
<?php
/* PHPMotors Main Controller
    * This file is accessed at http://lvh.me/phpmotors/
    * or at http://lvh.me/phpmotors/index.php
    * 
    * This file controls all traffic to the http://lvh.me/phpmotors/ URL
*/
// Create or access a session
session_start();
// Get the functions library
require_once 'library/functions.php';

// Get the database connection file.
require_once 'library/connections.php';

// Get the PHP Motors model for use as needed.
require_once 'model/main-model.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

// Gets the array of classifications
$classifications = getClassifications();
/* 
// Test data received from the database.
echo "<pre>";
var_dump($classifications);
echo "</pre>";
exit; */

// Get navBar
$navigation = navBar($classifications);

// Check if the firstname cookie exists, and get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
}
// Switch gthe pages to show
switch ($action) {
    case 'something':
        # code...
        break;
    
    default:
        # code...
        include 'view/home.php';
        break;
}











?>
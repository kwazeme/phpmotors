<?php
/* PHPMotors Accounts Controller
    * This file is accessed at http://lvh.me/accounts/
    * or at http://lvh.me/accounts/index.php
    * 
    * This file controls all traffic to the http://lvh.me/accounts/ URL
*/

// Get the database connection file.
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed.
require_once '../model/main-model.php';

// Get the Accouunt model for use as needed.
require_once '../accounts/index.php';

// Gets the array of classifications
$classifications = getClassifications();
/* 
// Test data received from the database.
echo "<pre>";
var_dump($classifications);
echo "</pre>";
exit; */


// Navigation bar using the $classifications array.
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title= 'View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';
// $login = "<a href='/accounts/index.php?action=".urlencode($action['login'])."' title='Login to your account'>My Account</a>";
/* // Test Navigation List
echo $navList;
exit; */ 


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}



switch ($action) {
    case 'login':
        # code...
        include '../view/login.php';
        break;
    case 'register':
            # code...
        include '../view/register.php';
        break;
    default:
        # code...
        include '../view/home.php';
        break;
}











?>
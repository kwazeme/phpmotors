<?php
/* PHPMotors Main Controller
    * This file is accessed at http://lvh.me/phpmotors/
    * or at http://lvh.me/phpmotors/index.php
    * 
    * This file controls all traffic to the http://lvh.me/phpmotors/ URL
*/

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


// Navigation bar using the $classifications array.
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title= 'View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
/* $navList .= '</ul>';
// Test Navigation List
echo $navList;
exit; */


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
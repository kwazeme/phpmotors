<?php
/* PHPMotors Vehicles Controller
    * This file is accessed at http://lvh.me/vehicles/
    * or at http://lvh.me/vehicles/index.php
    * 
    * This file controls all traffic to the http://lvh.me/vehicles/ URL
*/

// Get the database connection file.
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed.
require_once '../model/main-model.php';

// Get the vehicles model
require_once '../model/vehicles-model.php';

// Gets the array of classificationList & classifications
$classificationsList = getClassificationList();
$classifications = getClassifications();
/* 
// Test data received from the database.
echo "<pre>";
var_dump($classificationsList);
echo "</pre>";
exit;
 */

// Navigation bar using the $classifications array.
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title= 'View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

// Create a $classificationList variable to build a dynamic drop-down select list. The classificationName must appear in the browser as an option to select, but the classificationId must be the value of each option
// $classificationList = '<form action="">';
$classificationList = '<select id="cars" name="classificationId">';
$classificationList .= '<option value="" disabled selected hidden>Choose Car Classification</option>';
foreach ($classificationsList as $classItem) {
    # code...
    $classificationList .="<option value='$classItem[classificationId]'>$classItem[classificationName]</option>";
}
$classificationList .= '</select>';
// echo $classificationList;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'addclassification':
        # code...
        // Filter and store vehicle classification received from form
        $classificationName = filter_input(INPUT_POST, 'classificationName');
        // Check for missing data
        if (empty($classificationName)) {
            # code...
            $message = "<p class='error'>&#9888;&#65039; <br>Please provide Vehicle classification Name.</p>";
            include '../view/add-classification.php';
            exit;
            }
        // If data is in form, start processing to add to database
        $classOutcome = addClassification($classificationName);
        // Check and report the result
        if($classOutcome === 1){
            # code...
            include '../view/vehicle-man.php';
            exit;
        } else {
            $message = "<pclass='error'>&#9888;&#65039; <br>Vehicle Classification was not added. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
            }
        break;
    case 'addVehicle':
        // Filter and store vehicle details received from form
        $invMake = filter_input(INPUT_POST, 'invMake');
        $invModel = filter_input(INPUT_POST, 'invModel');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invImage = filter_input(INPUT_POST, 'invImage');
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invColor = filter_input(INPUT_POST, 'invColor');
        $classificationId = filter_input(INPUT_POST, 'classificationId');
        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            # code...
            $message = "<p class='error'>&#9888;&#65039; <br>Please provide information for all required vehicle details form fields.</p>";
            include '../view/add-vehicle.php';
            exit;
            }
        // If data is in form, start processing to add to database
        $addOutcome = addVehicle($invMake,$invModel,$invDescription,$invImage,$invThumbnail,$invPrice,$invStock,$invColor,$classificationId);
        // Check and report the result
        if($addOutcome === 1){
            # code...
            $message = "<p class='success'>&#10003;<br>Your vehicle has been added to the Inventory. To add another more fill the details below.</p>";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<pclass='error'>&#9888;&#65039; <br>Vehicle Classification was not added. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
            }
            # code...
        include '../view/add-vehicle.php';
        break;
    case 'manage':
        include '../view/vehicle-man.php';
        break;
    default:
        # code...
        include '../view/vehicle-man.php';
        break;
}











?>
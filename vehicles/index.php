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

// Get functions.php into scope
require_once '../library/functions.php';

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
// $navList = '<ul>';
// $navList .= "<li><a href='/phpmotors/index.php' title= 'View the PHP Motors home page'>Home</a></li>";
// foreach ($classifications as $classification) {
//     $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
// }
// $navList .= '</ul>';

// Create a $classificationList variable to build a dynamic drop-down select list. The classificationName must appear in the browser as an option to select, but the classificationId must be the value of each option
// $classificationList = '<form action="">';
// $classificationList = '<select id="cars" name="classificationId">';
// $classificationList .= '<option value="" disabled selected hidden>Choose Car Classification</option>';
// foreach ($classificationsList as $classItem) {
//     # code...
//     $classificationList .="<option value='$classItem[classificationId]'>$classItem[classificationName]</option>";
// }
// $classificationList .= '</select>';
// echo $classificationList;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'add-classification':
        # code...
        include '../view/add-classification.php';
        break;
    case 'add-Vehicle':
        # code...
        include '../view/add-vehicle.php';
        break;    
    case 'addclassification':
        # code...
        // Filter and store vehicle classification received from form
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // Check classificationName against required pattern
        $checkNamelength = checkNamelength($classificationName);
        // Check for missing data
        if (empty($checkNamelength)) {
            # code...
            $message = "<p class='error'>&#9888;&#65039; <br>Please provide Vehicle classification Name. Lowercase, minimun 3 and maximum 30 characters and no special character except underscore or hyphen</p>";
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
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_URL));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_URL));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
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
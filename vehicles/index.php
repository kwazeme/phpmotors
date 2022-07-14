<?php
/* PHPMotors Vehicles Controller
    * This file is accessed at http://lvh.me/vehicles/
    * or at http://lvh.me/vehicles/index.php
    * 
    * This file controls all traffic to the http://lvh.me/vehicles/ URL
*/
// Create or access a session
session_start();

// Get the database connection file.
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed.
require_once '../model/main-model.php';

// Get the vehicles model
require_once '../model/vehicles-model.php';

// Get reviews php into scope
require_once '../model/reviews-model.php';

// Get functions.php into scope
require_once '../model/uploads-model.php';

// Get upload model into scope
require_once '../library/functions.php';

// Gets the array of classificationList & classifications
$classificationsList = getClassificationList();
$classifications = getClassifications();

// Get the function for logged in no reviews HTML
// $revInvite = reviewInvite($clientScreenName);

// // Get all reviews from the table
// $reviews = getReviews();

// // Build review HTML
// $reviewDisplay = buildReviewDisplay($reviews);

// Get navBar
$navigation = navBar($classifications);
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
            // include '../view/vehicle-man.php';
            header("Location:/phpmotors/vehicles/");
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
    /* * **************************************
    * Get vehicles by classificationId
    *
    * Used for starting update & Delete process
    ******************************************I*/
    case 'getInventoryItems':
        # Get the classificationId
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from DB
        $invetoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back
        echo json_encode($invetoryArray);
        break;
    case 'mod':
        # code...
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        // Get Inventory Information with invId
        $invInfo = getInvItemInfo($invId);
        // Check if $invInfo has data
        if (count($invInfo)<1) {
            # code...
            $message = 'Sorry, no vehicle information could be found.';
        }
        // Get view to display information for editing
        include '../view/vehicle-update.php';
        break;
    case 'updateVehicle':
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
        // Filter and store primary key passed by the form
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            # code...
            $message = "<p class='error'>&#9888;&#65039; <br>Please complete all information for the updated item! Double check the classification of the vehicle.</p>";
            include '../view/vehicle-update.php';
            exit;
            }
        // If data is in form, start processing to add to database
        $updateResult = updateVehicle($invId,$invMake,$invModel,$invDescription,$invImage,$invThumbnail,$invPrice,$invStock,$invColor,$classificationId);
        // Check and report the result
        if($updateResult === 1){
            # code...
            $message = "<p class='success'>&#10003;<br>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='error'>&#9888;&#65039; <br>Error. The vehicle update was not successful.</p>";
            }
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        break;
    case 'del':
        # code...
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        // Get Inventory Information with invId
        $invInfo = getInvItemInfo($invId);
        // Check if $invInfo has data
        if (count($invInfo)<1) {
            # code...
            $message = 'Sorry, no vehicle information could be found.';
        }
        // Get view to display information for editing
        include '../view/vehicle-delete.php';
        break;
    case 'deleteVehicle':
        # code...
        // Filter and store vehicle details received from form
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // Filter and store primary key passed by the form
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        // If data is in form, start processing to add to database
        $deleteResult = deleteVehicle($invId);
        // Check and report the result
        if($deleteResult === 1){
            # code...
            $message = "<p class='success'>&#10003;<br>Congratulations, the $invMake $invModel was successfully <u>deleted</u>.</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='error'>&#9888;&#65039; <br>Error. The $invMake $invModel deletion was not successful.</p>";
            }
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        break;
    case 'classification':
        # code...
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);
        // Check if vehicles arrays were returned or not
        if (!count($vehicles)) {
            $message = "<p class='error'>&#9888;&#65039; <br>Sorry. No $classificationName vehicles could be found.</p>";
        } else {
            # code...
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        // echo $vehicleDisplay;
        // exit;
        include '../view/classification.php';
        break;
    case 'viewVehicle':
        // echo "vehicle.php";
        $invId = trim(filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $vehicleDetail = getVehicleDetail($invId);
        $thumbImages = getImageThumbnails($invId);
        // var_dump($thumbImages);
        // exit;
        // Check if vehicles arrays were returned or not
        if (empty($vehicleDetail)) {
            $message = "<p class='error'>&#9888;&#65039; <br>Sorry. No such vehicles could be found.</p>";
        } else {
            # code...
            $vehicleDetailDisplay = buildVehicleDetailDisplay($vehicleDetail);
            $thumbImagesDisplay = buildThumbImagesDisplay($thumbImages);
            // var_dump($thumbImagesDisplay);
            // exit;
            // Build review List for specific vehicle
            // Get all reviews from the table
            $reviews = getReviewsByInvid($invId);
            // Check for no Reviews present for vehicle
            if (!count($reviews)) {
                # code...
                $beFirst = "<h3 class='error'>&#11088;&#11088;&#11088;&#11088;&#11088;&#11088; Be the first to write a review for...";
                $_SESSION['beFirst'] = $beFirst;
            } else {
                # code...
                // Build review HTML
                $reviewDisplay = buildReviewDisplay($reviews);
            }
        }
        include '../view/vehicle-detail.php';

        break;


    default:
        # Build the select list to display in the vehicle management view.
        $classificationList = buildClassificationList($classifications);
        include '../view/vehicle-man.php';
        break;
}











?>
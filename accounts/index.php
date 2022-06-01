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
// require_once '../accounts/index.php';

// Get the sccounts model
require_once '../model/accounts-model.php';

// Get the functions library
require_once '../library/functions.php';

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
    case 'registration':
            # code...
        include '../view/registration.php';
        break;
    case 'register':
        // echo 'You are in the register case statment';

        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // validate and return valid email address
        $clientEmail = checkEmail($clientEmail);
        // validate $clientPassword
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            # code...
            $message = "<p class='error'>&#9888;&#65039; <br>Please provide information for all required form fields.</p>";
            include '../view/registration.php';
            exit;
        }
        // Hash the checked password
        $hashedPassword = password_hash($checkPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname,$clientLastname,$clientEmail,$hashedPassword);
        // var_dump ($clientFirstname, $clientLastname, $clientEmail, $clientPassword);
        // exit;

        // Check and report the result
        if ($regOutcome === 1) {
            # code...
            $message = "<p class='success'>&#10003;<br> Thanks for registering $clientFirstname. <br> 
            Please use your email and password to login.</p>";
            require '../view/login.php';
            exit;
        } else {
            # code...
            $message = "<p class='error'>&#x27F3; <br>Sorry $clientFirstname, <br> but the registration failed. Please try again</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'Login':
        # code...
        # echo 'sends login data to server';
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // validate and return valid email address
        $clientEmail = checkEmail($clientEmail);
        // validate $clientPassword
        $checkPassword = checkPassword($clientPassword);
        // Check for missing data
        if (empty($clientEmail) || empty($checkPassword)) {
            # code...
            $message = "<p class='error'>&#9888;&#65039; <br>Please provide information for all required form fields.</p>";
            include '../view/login.php';
            exit;
        }
        break;
    default:
        # code...
        include '../view/home.php';
        break;
}











?>
<?php
/* PHPMotors Accounts Controller
    * This file is accessed at http://lvh.me/accounts/
    * or at http://lvh.me/accounts/index.php
    * 
    * This file controls all traffic to the http://lvh.me/accounts/ URL
*/

// Create or access a session
session_start();

// Get the database connection file.
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed.
require_once '../model/main-model.php';

// Get the Accouunt model for use as needed.
// require_once '../accounts/index.php';

// Get the sccounts model
require_once '../model/accounts-model.php';
// Get the reviews model
require_once '../model/reviews-model.php';

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

// Get navBar
$navigation = navBar($classifications);

// Get Vehicles and Classification Management Panel link
$manLink = manageLink();

// Get User Information update link
$admLink = adminLink();

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
        // validate $clientPassword meets strong password requirements
        $checkPassword = checkPassword($clientPassword);

        // Check for existing email
        $existingEmail = checkExistingEmail($clientEmail);
        // Handle exisitng email found during registration
        if ($existingEmail) {
            # code...
            $message = "<p class='error'>&#9888;&#65039; <br>The email address already exists. Do you want to login instead?</p>";
            include '../view/login.php';
            exit;
        }

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
            # Set registration success cookie
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            // Success Message
            // $message = "<p class='success'>&#10003;<br> Thanks for registering $clientFirstname. <br> 
            // Please use your email and password to login.</p>";
            // Success message using session
            $_SESSION['message'] = "<p class='success'>&#10003;<br> Thanks for registering $clientFirstname. <br> Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=login');
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
        // validate and return valid email address
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        // validate $clientPassword
        $passwordCheck = checkPassword($clientPassword);
        // Check for missing data
        if (empty($clientEmail) || empty($passwordCheck)) {
            # code...
            $message = "<p class='error'>&#9888;&#65039; <br>Please provide information for all required form fields.</p>";
            include '../view/login.php';
            exit;
        }
        // A valid password exists, proceed with the login process
        // Query the client data based on email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against the hashed password for matching
        $hashCheck = password_verify($passwordCheck, $clientData['clientPassword']);
        // If hashes don't match create error and return to the login view

        if (!$hashCheck) {
            # code...
            $message = "<p class='error'>&#9888;&#65039; <br>Please check your email or password and try again.</p>";
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop functino removes the last element from an array
        array_pop($clientData);
        // Store the array in the session
        $_SESSION['clientData'] = $clientData;      
        // Send Logged in user to the admin view
        // Get the logged in Client Reviews
        $clientId = $_SESSION['clientData']['clientId'];
        // Get Reviews by clientId
        $clientReviews = getReviewsByclientId($clientId);
        // Build client review HTML
        $reviewList = buildClientReviewList($clientReviews);
       
        include '../view/admin.php';
        // echo "include '../view/admin.php'";
        exit;
        break;
    case 'admin':
        # code...
        // Send Logged in user to the admin view
        // Get the logged in Client Reviews
        $clientId = $_SESSION['clientData']['clientId'];
        // Get Reviews by clientId
        $clientReviews = getReviewsByclientId($clientId);
        // Build client review HTML
        $reviewList = buildClientReviewList($clientReviews);
        include '../view/admin.php';
        break;
    case 'logout':
            # code...
            session_start();
            unset($_SESSION['loggedin']);
            if (ini_get("session.use_cookies")) {
                # Get cookie variables and destroy session to log out user in all views.
                $params = session_get_cookie_params();
                setcookie('firstname', $clientFirstname, strtotime('-1 year'), '/');
            }
            session_destroy();
            include '../view/home.php';
            break;

    case 'updateUser':
        # code...
        include '../view/client-update.php';
        break;
    case 'updateAccount':
        # code...
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        // Filter and store primary key passed by the form
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        // Check if Email is different from session email
        if (($_SESSION['clientData']['clientEmail'] != $clientEmail)) {
            // validate and return valid email address
            $clientEmail = checkEmail($clientEmail);
            // Check for existing email
            $existingEmail = checkExistingEmail($clientEmail);
            if ($existingEmail) {
                # code...
                $message = "<p class='error'>&#9888;&#65039; <br>The email address already exists. Enter a different email address?</p>";
                include '../view/client-update.php';
                exit;
            }
            // Check for missing data
            if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
                # code...
                $message = "<p class='error'>&#9888;&#65039; <br>Please provide information for all required fields to Update information.</p>";
                include '../view/client-update.php';
                exit;
            }
            // Send the data to the model for Update
            $updateOutcome = updateClient($clientFirstname,$clientLastname,$clientEmail,$clientId);
            // Check and report the result
            if ($updateOutcome === 1) {
                // Query the client data based on email address
                $clientData = getClient($clientEmail);
                // Store the array in the session
                $_SESSION['clientData'] = $clientData; 
                // Success Message
                $_SESSION['message'] = "<p class='success'>&#10003;<br>  $clientFirstname User Information was Updated<br> Please use your updated email and password when logging in.</p>";
                header('Location: /phpmotors/accounts/?action=admin');
                exit;
            } else {
                # code...
                $message = "<p class='error'>&#x27F3; <br>Sorry $clientFirstname, <br> but the update failed. Please try again</p>";
                include '../view/client-update.php';
                exit;
            }
        } else {
                $message = "<p class='error'>&#9888;&#65039; <br>Please update your Email and try again.</p>";
                include '../view/client-update.php';
                exit;
        }
        break;
    case 'updatePass':
         // Filter and collect User data
         $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // Filter and store primary key passed by the form
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        // validate $clientPassword meets strong password requirements
        $checkPassword = checkPassword($clientPassword);
        // Check pattern not matched
        if (empty($checkPassword)) {
            # code...
            $message = "<p class='error'>&#9888;&#65039; <br>Please check that your password matches the strength required and try again.</p>";
            include '../view/client-update.php';
            exit;
        }
        // Hash the new checked password
        $hashedPassword = password_hash($checkPassword, PASSWORD_DEFAULT);
         // Send the data to the model for Update
         $updateOutcome = updatePassword($hashedPassword,$clientId);
         // Check and report the result
         if ($updateOutcome === 1) {
             // Success Message
             $_SESSION['message'] = "<p class='success'>&#10003;<br>  $clientFirstname your password has been update<br> Please use your email and updated password when logging in.</p>";
             header('Location: /phpmotors/accounts/?action=admin');
             exit;
         } else {
             # code...
             $message = "<p class='error'>&#x27F3; <br>Sorry $clientFirstname, <br> but the password update failed. Please try again</p>";
             include '../view/client-update.php';
             exit;
         }
        break;    
    
        
    // default:
    //     # code...
    //     include '../view/home.php';
    //     break;
}











?>
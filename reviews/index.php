<?php
/* PHPMotors reviews Controller
    * This file is accessed at http://lvh.me/reviews/
    * or at http://lvh.me/reviews/index.php
    * 
    * This file controls all traffic to the http://lvh.me/reviews/ URL
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

// // Get all reviews from the table
// $reviews = getReviews();

// // Build review HTML
// $reviewDisplay = buildReviewDisplay($reviews);

// Get navBar
$navigation = navBar($classifications);

// // Get the function for logged in no reviews HTML
// $revInvite = reviewInvite();

// Get and filter inputs
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'addReview':
        # code...
        // Filter and store review details received from form
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        $clientScreenName = trim(filter_input(INPUT_POST, 'clientScreenName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // Check for missing data
        if (empty($reviewText)) {
            # code...
            $message = "<p class='error'>&#9888;&#65039; <br>Please provide your review in the review input box.</p>";
            include '../view/vehicle-detail.php';
            exit;
            }
        // If data is in form, start processing to add to database
        $addOutcome = addReview($reviewText,$invId,$clientId,$clientScreenName);
        // Check and report the result
        if($addOutcome === 1){
            # code...
            $message = "<p class='success'>&#10003;<br>Your review has been added successfully. Check other vehicles to add more reviews.</p>";
            include '../view/vehicle-detail.php';
            exit;
        } else {
            $message = "<pclass='error'>&#9888;&#65039; <br>Review was not added successfully. Please try again.</p>";
            include '../view/vehicle-detail.php';
            exit;
            }
            # code...
        include '../view/vehicle-detail.php';
        break;
    case 'mod':
        # code...
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        // Get Review Information with reviewId
        $reviewInfo = getreviewItemInfo($reviewId);
        // Check if $invInfo has data
        if (empty($reviewInfo)<1) {
            # code...
            $message = 'Sorry, no review information could be found.';
        }
        $revInfo = $reviewInfo[0];
        // Get view to display information for editing
        include '../view/review-update.php';
        break;
    case 'updateReview':
        // Filter and store review details received from form
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // Filter and store primary key passed by the form
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        // Check for missing data
        if (empty($reviewText) || empty($reviewId)) {
            # code...
            $message = "<p class='error'>&#9888;&#65039; <br>Please complete your review update or modification and submit again.</p>";
            include '../view/review-update.php';
            exit;
            }
        // If data is in form, start processing to add to database
        $updateResult = updateReviewById($reviewId, $reviewText);
        // Check and report the result
        if($updateResult === 1){
            # code...
            $message = "<p class='success'>&#10003;<br>Congratulations, your review was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/reviews/');
            exit;
        } else {
            $message = "<p class='error'>&#9888;&#65039; <br>Error. The review update was not successful.</p>";
            }
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews/');
            exit;
        break;
    case 'del':
        # code...
        $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT));
        // Get review Information with reviewId
        $reviewInfo = getreviewItemInfo($reviewId);
        // Check if $invInfo has data
        if (empty($revInfo)<1) {
            # code...
            $message = 'Sorry, no review information could be found.';
        }
        // var_dump($revInfo);
        $revInfo = $reviewInfo[0];
        include '../view/review-delete.php';
        break;
    case 'deleteReview':
        // Filter reviewId and delete review from database
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // If data is in form, start processing to add to database
        $deleteResult = deleteReviewById($reviewId);
        // Check and report the result
        if($deleteResult === 1){
            # code...
            $message = "<p class='success'>&#10003;<br>Congratulations, your review was successfully <u>deleted</u>.</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/reviews/');
            exit;
        } else {
            $message = "<p class='error'>&#9888;&#65039; <br>Error. Your Review deletion was not successful.</p>";
            }
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews/');
            exit;
        break;
default:
        include '../view/admin.php';
        break;
}











?>
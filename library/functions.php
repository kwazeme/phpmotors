<?php
// // Get the database connection file.
// require_once 'library/connections.php';

// // Get the PHP Motors model for use as needed.
// require_once '../model/main-model.php';

// validate email from registration form
function checkEmail($clientEmail)
{
    # code...
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// validate password from registration form
function checkPassword($clientPassword)
{
    # code...
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

// validate classificationName character length with pattern
function checkNamelength($classificationName)
{
    # code...
    $pattern = '/[A-Za-z0-9-_]{3,30}$/';
    return preg_match($pattern, $classificationName);
}



// // Gets the array of classifications
// $classifications = getClassifications();

// Build Navigation bar for all views in phpmotors
function navBar($classifications)
{
    # code...
    // Navigation bar using the $classifications array.
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title= 'View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Function to call for management panel to be loaded
function manageLink()
{   
    $link = "<a href='/phpmotors/vehicles/' title='Manage Vehicles & Classifications'>Management Panel</a>";
    $linkDiv = '<div>';
    $linkDiv .= '<h2>Vehicles Management </h2><p>Use this link to Update Inventory</p>';
    $linkDiv .= "$link";
    $linkDiv .= '</div>';
    return $linkDiv;
}

// function to call admin panel link to load
function adminLink()
{   
    $link = "<a href='/phpmotors/accounts/index.php?action=updateUser' title='update account information'>update account info</a>";
    $adminDiv = '<h2>User Management </h2><p>Use this link to Update User Information</p>';
    $adminDiv .= "$link";
    $adminDiv .= '</div>';
    return $adminDiv;
}


function buildClassificationList($classifications) {
    $classificationList = '<select id="classificationList" name="classificationId">';
    $classificationList .= '<option value="" disabled selected hidden>Choose Car Classification</option>';
    foreach ($classifications as $classItem) {
        # code...
        $classificationList .="<option value='$classItem[classificationId]'";
        if (isset($classificationId)) {
        # code...
        if ($classItem['classificationId'] === $classificationId) {
            # code...
            $classificationList .= ' selected ';
        }
        }
        $classificationList .= ">$classItem[classificationName]</option>";
    }
    $classificationList .= '</select>';

    return $classificationList;
}






?>
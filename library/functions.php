<?php
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



?>
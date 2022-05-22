<?php
/*
 *  Accounts Model
 *
 */


//  Register a new client
function regClient($clientFirstname,$clientLastname,$clientEmail,$clientPassword) {
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO clients (clientFirstname,clientLastname,clientEmail,clientPassword)
            VALUES (:clientFirstname,:clientLastname,:clientEmail,:clientPassword)';

// Create the prepared statment using the php_motors connection
$stmt = $db->prepare($sql);
// The next four lines replaces the placeholders in the SQL 
// statement with the actual values in the variables and tell
// the database the type of data it is.
$stmt->bindValue(':clientFirstname',$clientFirstname,PDO::PARAM_STR);
$stmt->bindValue(':clientLastname',$clientLastname,PDO::PARAM_STR);
$stmt->bindValue(':clientEmail',$clientEmail,PDO::PARAM_STR);
$stmt->bindValue(':clientPassword',$clientPassword,PDO::PARAM_STR);
// Insert the data
// var_dump($clientFirstname, $clientLastname, $clientEmail, $clientPassword);
// exit;
$stmt->execute();

// Ask how many rows changed as a result of the insert.
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}

?>
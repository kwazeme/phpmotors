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

// Checks for an existing email address
function checkExistingEmail($clientEmail) {
    $db = phpmotorsConnect();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email',$clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if (empty($matchEmail)) {
        # code...
        return 0;
    } else {
        # code...
        return 1;
    }
}

// Get client data based on an email address
function getClient($clientEmail) {
    $db = phpmotorsConnect;
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword
            FROM clients
            WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}
?>
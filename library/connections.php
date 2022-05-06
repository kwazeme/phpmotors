<?php
/*
* Proxy connection to the phpmotors database
*/
function phpmotorsConnect(){
    $server = 'mysql';
    $dbname = 'phpmotors';
    $username = 'dbuser';
    $password = 'dbpass';
    $dsn = "mysql:host=$server;$dbname=$@dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // ACTUAL CONNECTION OBJECT CREATED AND ASSIGNED TO A VARIALBLE
    try {
        $link = new PDO($dsn, $username, $password, $options);
        // if (is_object($link)) {
        //     # code...
        //     echo 'It worked';
        // }
        return $link;
    } catch (PDOException $e) {
        header('location: /phpmotors/view/500.php');
        //throw $th;
        // echo "It didn't work, error: ". $e->getMessage();
        // exit;
    }

}
// phpmotorsConnect();
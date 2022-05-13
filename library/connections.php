<?php
/*
* Proxy connection to the phpmotors database
*/
function phpmotorsConnect(){
    $server = 'mysql';
    $dbname = 'phpmotors';
    $username = 'dbuser';
    $password = 'dbpass';
<<<<<<< HEAD
    $dsn = "mysql:host=$server;dbname=$dbname";
=======
    $dsn = "mysql:host=$server;$dbname=$@dbname";
>>>>>>> 47e4a01c8011472d8b0a1a581600d7b0d804fad2
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
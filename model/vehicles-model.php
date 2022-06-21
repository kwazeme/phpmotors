<?php
/* 
This is the Main PHP Vehicles Model

 */
function getClassificationList(){
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect(); 
    // The SQL statement to be used with the database 
    $sql = 'SELECT classificationId, classificationName FROM carclassification ORDER BY classificationName ASC'; 
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    // The next line runs the prepared statement 
    $stmt->execute(); 
    // The next line gets the data from the database and 
    // stores it as an array in the $classifications variable 
    $classificationList = $stmt->fetchAll(); 
    // The next line closes the interaction with the database 
    $stmt->closeCursor(); 
    // The next line sends the array of data back to where the function 
    // was called (this should be the controller) 
    return $classificationList;
  }

//  a function for inserting a new classification to the carclassifications table
function addClassification($classificationName) {
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'INSERT INTO carclassification (classificationName)
          VALUES (:classificationName)';

// Create the prepared statment using the php_motors connection
$stmt = $db->prepare($sql);
// Replace the placeholders in the SQL 
// statement with the actual values in the variables and tell 
$stmt->bindValue(':classificationName',$classificationName,PDO::PARAM_STR);
// Insert the data
$stmt->execute();
// Ask how many rows changed as a result of the insert.
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}

//  function for inserting a new vehicle to the inventory table.
function addVehicle($invMake,$invModel,$invDescription,$invImage,$invThumbnail,$invPrice,$invStock,$invColor,$classificationId) {
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'INSERT INTO inventory (invMake,invModel,invDescription,invImage,invThumbnail,invPrice,invStock,invColor,classificationId)
          VALUES (:invMake,:invModel,:invDescription,:invImage,:invThumbnail,:invPrice,:invStock,:invColor,:classificationId)';

// Create the prepared statment using the php_motors connection
$stmt = $db->prepare($sql);
// Replace the placeholders in the SQL 
// statement with the actual values in the variables and tell 
$stmt->bindValue(':invMake',$invMake,PDO::PARAM_STR);
$stmt->bindValue(':invModel',$invModel,PDO::PARAM_STR);
$stmt->bindValue(':invDescription',$invDescription,PDO::PARAM_STR);
$stmt->bindValue(':invImage',$invImage,PDO::PARAM_STR);
$stmt->bindValue(':invThumbnail',$invThumbnail,PDO::PARAM_STR);
$stmt->bindValue(':invPrice',$invPrice,PDO::PARAM_STR);
$stmt->bindValue(':invStock',$invStock,PDO::PARAM_STR);
$stmt->bindValue(':invColor',$invColor,PDO::PARAM_STR);
$stmt->bindValue(':classificationId',$classificationId,PDO::PARAM_STR);
// Insert the data
$stmt->execute();
// Ask how many rows changed as a result of the insert.
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $inventory; 
 }

//  Ger vehicle information by invId
function getInvItemInfo($invId) {
  $db = phpmotorsConnect();
  $sql = 'SELECT * FROM inventory WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue('invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $invInfo;
}

//  function for inserting a new vehicle to the inventory table.
function updateVehicle($invId,$invMake,$invModel,$invDescription,$invImage,$invThumbnail,$invPrice,$invStock,$invColor,$classificationId) {
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId 
                          WHERE invId = :invId';

// Create the prepared statment using the php_motors connection
$stmt = $db->prepare($sql);
// Replace the placeholders in the SQL 
// statement with the actual values in the variables and tell 
$stmt->bindValue(':invMake',$invMake,PDO::PARAM_STR);
$stmt->bindValue(':invModel',$invModel,PDO::PARAM_STR);
$stmt->bindValue(':invDescription',$invDescription,PDO::PARAM_STR);
$stmt->bindValue(':invImage',$invImage,PDO::PARAM_STR);
$stmt->bindValue(':invThumbnail',$invThumbnail,PDO::PARAM_STR);
$stmt->bindValue(':invPrice',$invPrice,PDO::PARAM_STR);
$stmt->bindValue(':invStock',$invStock,PDO::PARAM_STR);
$stmt->bindValue(':invColor',$invColor,PDO::PARAM_STR);
$stmt->bindValue(':classificationId',$classificationId,PDO::PARAM_STR);
// add bindValue for $invId
$stmt->bindValue(':invId',$invId, PDO::PARAM_INT);
// Insert the data
$stmt->execute();
// Ask how many rows changed as a result of the insert.
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}

function deleteVehicle($invId) {
  $db = phpmotorsConnect();
  $sql = 'DELETE FROM inventory WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
 }

// Get a list of vehicles based on classification
function getVehiclesByClassification($classificationName) {
  $db = phpmotorsConnect();
  $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
  $stmt->execute();
  $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $vehicles;

}

// Build an unordered list of vehicles
function buildVehiclesDisplay($vehicles){
  $dv = '<ul id="inv-display">';
  foreach ($vehicles as $vehicle) {
   $dv .= '<li>';
   $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
   $dv .= '<hr>';
   $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
   $dv .= "<span>$vehicle[invPrice]</span>";
   $dv .= '</li>';
  }
  $dv .= '</ul>';
  return $dv;
 }


?>

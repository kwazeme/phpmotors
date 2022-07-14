<?php
/*****************************
 *  Reviews Model
 *
 ***************************/



 //  function for inserting a new Client Reviews to the reviews table.
function addReview($reviewText,$invId,$clientId,$clientScreenName) {
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO reviews (reviewText,invId,clientId,clientScreenName)
            VALUES (:reviewText,:invId,:clientId,:clientScreenName)';
    // Create the prepared statment using the php_motors connection
    $stmt = $db->prepare($sql);
    // Replace the placeholders in the SQL 
    // statement with the actual values in the variables and tell 
    $stmt->bindValue(':reviewText',$reviewText,PDO::PARAM_STR);
    $stmt->bindValue(':invId',$invId,PDO::PARAM_INT);
    $stmt->bindValue(':clientId',$clientId,PDO::PARAM_INT);
    $stmt->bindValue(':clientScreenName',$clientScreenName,PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of the insert.
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

 // Get reviews for a specific inventory item 
 function getReviewsByInvid($invId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT * 
            FROM reviews 
            WHERE reviews.invId = :invId 
            ORDER BY reviews.reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewDetail = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewDetail;
  }

// Build reviews display HTML
function buildReviewDisplay($reviews) {
    $revDiv = '<hr><div class=revDiv>';
    $revDiv .= '<ul class=reviewList>';
    foreach ($reviews as $review) {
        # code...
        $revDiv .= "$review[clientScreenName] wrote on $review[reviewDate]:<br>";
        $revDiv .= "<li>$review[reviewText]</li><br><br>";
    }
    $revDiv .= '</ul></div>';
    return $revDiv;
}

 // Get reviews written by a specific client 
 function getReviewsByclientId($clientId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT * 
            FROM reviews 
            JOIN inventory
            WHERE reviews.clientId = :clientId
            AND reviews.invId = inventory.invId
            ORDER BY reviews.reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewDetail = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewDetail;
  }

// Build reviews display HTML
function buildClientReviewList($clientReviews) {
    $revDiv = '<div class="revDiv">';
    $revDiv .= '<ul class="clientRevList">';
    $revDiv .= '<h2>Manage Your Product Reviews</h2>';
    foreach ($clientReviews as $review) {
        # code...
        $revDate = date("F j, Y, \a\\t g:i a", strtotime($review['reviewDate']));
        $revDiv .= "<li>&#10035; &ensp; $review[invMake]'s $review[invModel] &emsp; [Reviewed on $revDate]: &emsp; <a href='/phpmotors/reviews/index.php?action=mod&reviewId=".urlencode($review['reviewId'])."' title='Edit Your Review for $review[invMake]&#39;s $review[invModel]'>EDIT</a> &emsp;| &emsp;<a href='/phpmotors/reviews/index.php?action=del&reviewId=".urlencode($review['reviewId'])."' title='Delete Your Review for $review[invMake]&#39;s $review[invModel]'>DELETE</a><br>";
        $revDiv .= "</li><br><br>";
    }
    $revDiv .= '</ul></div>';
    return $revDiv;
}

 // Get reviews by reviewId and join and corresponding inventory information for del case
 function getreviewItemInfo($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT *
            FROM reviews
            JOIN inventory
            ON reviews.invId = inventory.invId
            WHERE reviews.reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_STR);
    $stmt->execute();
    $revDetail = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $revDetail;
  }

// Delete review by Id from reviews table
function deleteReviewById($reviewId) {
  $db = phpmotorsConnect();
  $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}
// Update review with updated or modified reviewText
function updateReviewById($reviewId,$reviewText) {
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'UPDATE reviews SET reviewText = :reviewText 
                          WHERE reviewId = :reviewId';
  // Create the prepared statment using the php_motors connection
  $stmt = $db->prepare($sql);
  // Replace the placeholders in the SQL 
  // statement with the actual values in the variables and tell 
  $stmt->bindValue(':reviewText',$reviewText,PDO::PARAM_STR);
  // add bindValue for $reviewId
  $stmt->bindValue(':reviewId',$reviewId, PDO::PARAM_INT);
  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of the insert.
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}
























?>
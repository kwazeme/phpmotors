<?php 

if (isset($_SESSION['loggedin'])) {
    # code...
    $fname = $_SESSION['clientData']['clientFirstname'];
    $lname = $_SESSION['clientData']['clientLastname'];
    $email = $_SESSION['clientData']['clientEmail'];
    $level = $_SESSION['clientData']['clientLevel'];
    $clientId = $_SESSION['clientData']['clientId'];

    $sN = substr($fname,0,1);
    $sN .= substr($lname,0,1);
    $sN .= substr($lname,1);
    $clientScreenName = $sN;

    $Model = $_SESSION['model'];
    $Make = $_SESSION['make'];
}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kwazeme Ogubie">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400;0,500;1,400;1,500&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/phpmotors/css/normalize.css">
    <link rel="stylesheet" href="/phpmotors/css/base.css">
    <link rel="stylesheet" href="/phpmotors/css/medium.css">
    <link rel="stylesheet" href="/phpmotors/css/large.css">
    <title><?php echo $_SESSION['model'] .' ' . $_SESSION['make']; ?> | PHP Motors, Inc.</title>
</head>
<body>
    <!-- Require page header -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
<!-- require page navigation -->
    <nav class="clearfix">
    <?php echo "$navigation";
    // echo navBar($classifications); //echo "$navList";
    # require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php';
    ?>
</nav>

<main class="content formpage">
    <!-- MAIN CONTENT GOES HERE -->
<h1>VEHICLE INFORMATION</h1>
<div class="imgDisplay">

<div class="car-details">
<?php if (isset($vehicleDetailDisplay)) {
    echo $vehicleDetailDisplay;
} ?>
</div>
<aside class="thumbDiv">
<?php if (isset($thumbImagesDisplay)) {
    echo $thumbImagesDisplay;
} ?>
</aside>
</div>
<hr>
<div id="reviews-wrap">
    <h2>Customer Reviews</h2>
    <?php if (isset($message)) {
        echo $message;
    } ?>
        <?php if (isset($_SESSION['loggedin'])) {
            # code... for logged in with no review
            // echo '<h3>Be the first to write a review for this vehicle</h3>';
            echo '<form id="review-form" action="/phpmotors/reviews/index.php" method="post">';
            echo  '<p>';
            echo "<h4>Review the $Make's $Model</h4>";
            echo "<label for='clientScreenName'>Screen Name</label><span style='color:#B30000'>*</span><br />";
            echo "<input type='text' id='clientScreenName' name='clientScreenName' value='$clientScreenName' readonly>";
            echo '</p>';
            echo '<p>';
            echo '<p>';
            echo '<label for="reviewText">Client Review</label><span style="color:#B30000">*</span><br />';
            echo "<textarea rows='10' id='reviewText' name='reviewText' required placeholder='Enter your review here'}/></textarea>";
            echo '</p>';
            echo '<p>';
            echo '<input type="submit" name="submit" id="regbtn" value="submit review">';
            echo '<input type="hidden" name="action" value="addReview">';
            echo "<input type='hidden' name='invId' value='$invId'>";
            echo "<input type='hidden' name='clientId' value='$clientId'>";
            echo '</p>';
            echo '</form>';
        } else {
            # code...
            echo "<p>Login or Register to leave a review <a href='/phpmotors/accounts/index.php?action=login' title='login to my account'>My Account</a></p>";
        } 
        ?>
<?php 
if (isset($beFirst)) {
    # code... no review available
    echo $beFirst; echo "$Make's $Model</h3>";
}
echo $reviewDisplay; ?> 
</div>
</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>
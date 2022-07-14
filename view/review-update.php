<?php
// Access control for users logged in and not more than level 1
$level = $_SESSION['clientData']['clientLevel'];
  if ($level < 1) {
    # Redirect to home page if not logged in.
    header('Location:/phpmotors/');
  }

  $revDate = $revInfo['reviewDate'];
  $revDate = date("F j, Y, g:i a", strtotime($revDate));
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
    <title><?php
    if (isset($revInfo["invMake"]) && isset($revInfo["invModel"])) {
        # code...
        echo "Modify your review for $revInfo[invMake]'s $revInfo[invModel]";
    } elseif (isset($invMake) && isset($invModel)) {
        # code...
        echo "Modify your review for $invMake $invModel";
    }
    ?> | PHP Motors</title>
</head>
<body>
    <!-- Require page header -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
<!-- require page navigation -->
    <nav class="clearfix">
    <?php echo "$navigation";
    //echo navBar($classifications); //echo "$navList";
    # require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php';
    ?>
</nav>
<main class="content clearfix formpage">
    <!-- MAIN CONTENT GOES HERE -->
    <h1>
    <?php
    if (isset($revInfo['invMake']) && isset($revInfo['invModel'])) {
        # code...
        echo "Modify your review for $revInfo[invMake] $revInfo[invModel]";
    } elseif (isset($invMake) && isset($invModel)) {
        # code...
        echo "Modify your review for $invMake $invModel";
    }
    ?></h1>  
      <?php 
      if (isset($message) && isset($_POST['submit'])) {
        # code...
        echo "$message";
      }
      ?> <h2>Reviewed on <?php if(isset($revInfo['reviewDate'])) { echo "$revDate";} else {
        echo "$revInfo[reviewDate]";}?></h2>
        <form id="review-form" action="/phpmotors/reviews/" method="post">
            <p>
            <label for="reviewText">Review Text</label><span style="color:#B30000">*</span><br />
            <textarea rows='4' id='reviewText' name='reviewText'><?php if(isset($revInfo['reviewText'])) { echo "$revInfo[reviewText]"; } elseif (isset($reviewText)) {echo "$reviewText]";}?></textarea>
            </p>
            <p>
            <input type="submit" name="submit" id="Updatebtn" value="Update Review">
            <input type="hidden" name="action" value="updateReview">
            <input type="hidden" name="reviewId" value="<?php if (isset($revInfo['reviewId'])) {
            echo $revInfo['reviewId'];} elseif (isset($reviewId)) { echo $reviewId;} ?>">
            </p>
        </form>
    <?php //echo $revDate; ?>
</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>
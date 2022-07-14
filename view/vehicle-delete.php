<?php
$classificationList = '<select id="classificationId" name="classificationId">';
$classificationList .= '<option value="" disabled selected hidden>Choose Car Classification</option>';
foreach ($classificationsList as $classItem) {
    # code...
    $classificationList .="<option value='$classItem[classificationId]'";
    if (isset($classificationId)) {
      # code...
      if ($classItem['classificationId'] === $classificationId) {
        # code...
        $classificationList .= ' selected ';
      } 
    } elseif (isset($invInfo['classificationId'])) {
        # code...
        if ($classItem['classificationId'] === $invInfo['classificationId']) {
            # code...
            $classificationList .= ' selected ';
        }
      }
    $classificationList .= ">$classItem[classificationName]</option>";
}
$classificationList .= '</select>';

// Access control for users logged in and not more than level 1
$level = $_SESSION['clientData']['clientLevel'];
  if ($level < 2) {
    # Redirect to home page if logged in and level is 1.
    header('Location:/phpmotors/');
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
    <title><?php
    if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
        # code...
        echo "Delete $invInfo[invMake] $invInfo[invModel]";
    } elseif (isset($invMake) && isset($invModel)) {
        # code...
        echo "Delete $invMake $invModel";
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
    if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
        # code...
        echo "Delete $invInfo[invMake] $invInfo[invModel]";
    } elseif (isset($invMake) && isset($invModel)) {
        # code...
        echo "Delete $invMake $invModel";
    }
    ?> Inventory
    </h1>  
      <?php 
      if (isset($message) && isset($_POST['submit'])) {
        # code...
        echo "$message";
      }
      ?> 
<div id="register-form-wrap">

  <form id="register-form" action="/phpmotors/vehicles/index.php" method="post">
    <p>
        Confirm Vehicle Deletion. The delete is permanent.
    </p>
    <p>
      <?php echo "$classificationList"; ?>
    </p>
    <p>
    <label for="invMake">Vehicle Make</label><span style="color:#B30000">*</span><br />
    <input type="text" id="invMake" name="invMake" readonly <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
    </p>
    <p>
    <label for="invModel">Vehicle Model</label><span style="color:#B30000">*</span><br />
    <input type="text" id="invModel" name="invModel" readonly <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
    </p>
    <p>
    <label for="invDescription">Vehicle Description</label><span style="color:#B30000">*</span><br />
    <textarea name="invDescription" id="invDescription" rows="5" cols="25" readonly><?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
    </p>
    <p>
    <input type="submit" name="submit" id="vehiclebtn" value="Delete Vehicle">
    <input type="hidden" name="action" value="deleteVehicle">
    <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
      echo $invInfo['invId'];} elseif (isset($invId)) { echo $invId;} ?>">
    </p>
  </form>
</div>
<?php var_dump($invInfo);?>
</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>
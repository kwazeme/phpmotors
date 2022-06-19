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
  if ($level == 1 && ($_SESSION['loggedin'])) {
    # Redirect to home page if logged in and level is 1.
    header('Location:/phpmotors/');
  } elseif (!$_SESSION['loggedin']) {
    # Redirect to home page if not logged in.
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
        echo "Modify $invInfo[invMake] $invInfo[invModel]";
    } elseif (isset($invMake) && isset($invModel)) {
        # code...
        echo "Modify $invMake $invModel";
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
        echo "Update/Modify $invInfo[invMake] $invInfo[invModel]";
    } elseif (isset($invMake) && isset($invModel)) {
        # code...
        echo "Update/Modify $invMake $invModel";
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
        Please provide information for all empty form fields.
    </p>
    <p>
      <?php echo "$classificationList"; ?>
    </p>
    <p>
    <label for="invMake">Vehicle Make</label><span style="color:#B30000">*</span><br />
    <input type="text" id="invMake" name="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
    </p>
    <p>
    <label for="invModel">Vehicle Model</label><span style="color:#B30000">*</span><br />
    <input type="text" id="invModel" name="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
    </p>
    <p>
    <label for="invDescription">Vehicle Description</label><span style="color:#B30000">*</span><br />
    <textarea name="invDescription" id="invDescription" rows="5" cols="25" required><?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
    </p>
    <p>
    <label for="invImage">Vehicle Image</label><span style="color:#B30000">*</span><br />
    <input type="url" id="invImage" name="invImage" value="http://phpmotors/images/no-image.png" required <?php if(isset($InvImage)){ echo "value='$InvImage'"; } elseif(isset($invInfo['InvImage'])) {echo "value='$invInfo[InvImage]'"; }?>>
    </p>
    <p>
    <label for="invThumbnail">Vehicle Thumbnail</label><span style="color:#B30000">*</span><br />
    <input type="url" id="invThumbnail" name="invThumbnail" value="http://phpmotors/images/no-image.png" required <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>>
    </p>
    <p>
    <label for="invPrice">Vehicle Price</label><span style="color:#B30000">*</span><br />
    <input type="number" id="invPrice" name="invPrice" required <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>>
    </p>
    <p>
    <label for="invStock"># in Stock</label><span style="color:#B30000">*</span><br />
    <input type="number" id="invStock" name="invStock" required <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>>
    </p>
    <p>
    <label for="invColor">Vehicle color</label><span style="color:#B30000">*</span><br />
    <input type="text" id="invColor" name="invColor" required <?php if(isset($invColor)){ echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>>
    </p>
    <p>
    <input type="submit" name="submit" id="vehiclebtn" value="Update Vehicle">
    <input type="hidden" name="action" value="updateVehicle">
    <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
      echo $invInfo['invId'];} elseif (isset($invId)) { echo $invId;} ?>">
    </p>
  </form>
</div>
</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>
<?php
$classificationList = '<select id="cars" name="classificationId">';
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
    <title>Add New Vehicle Classification</title>
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
    <h1>Add Vehicles to Inventory</h1>  
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
    <input type="text" id="invMake" name="invMake" <?php if (isset($invMake)){echo "value='$invMake'";}?> required>
    </p>
    <p>
    <label for="invModel">Vehicle Model</label><span style="color:#B30000">*</span><br />
    <input type="text" id="invModel" name="invModel" <?php if (isset($invModel)){echo "value='$invModel'";}?> required>
    </p>
    <p>
    <label for="invDescription">Vehicle Description</label><span style="color:#B30000">*</span><br />
    <input type="text" id="invDescription" name="invDescription" <?php if (isset($invDescription)){ echo "value='$invDescription'";} ?> required>
    </p>
    <p>
    <label for="invImage">Vehicle Image</label><span style="color:#B30000">*</span><br />
    <input type="url" id="invImage" name="invImage" value="http://phpmotors/images/no-image.png" <?php if (isset($invImage)) {echo "value='$invImage'";} ?> required>
    </p>
    <p>
    <label for="invThumbnail">Vehicle Thumbnail</label><span style="color:#B30000">*</span><br />
    <input type="url" id="invThumbnail" name="invThumbnail" value="http://phpmotors/images/no-image.png" <?php if (isset($invThumbnail)) {echo "value='$invThumbnail'";} ?> required>
    </p>
    <p>
    <label for="invPrice">Vehicle Price</label><span style="color:#B30000">*</span><br />
    <input type="number" id="invPrice" name="invPrice" <?php if (isset($invPrice)) {echo "value='$invPrice'";} ?> required>
    </p>
    <p>
    <label for="invStock"># in Stock</label><span style="color:#B30000">*</span><br />
    <input type="number" id="invStock" name="invStock" <?php if (isset($inStock)){ echo "value='$invStock'";} ?> required>
    </p>
    <p>
    <label for="invColor">Vehicle color</label><span style="color:#B30000">*</span><br />
    <input type="text" id="invColor" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";} ?> required>
    </p>
    <p>
    <input type="submit" name="submit" id="vehiclebtn" value="Add Vehicle">
    <input type="hidden" name="action" value="addVehicle">
    </p>
  </form>
</div>
</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>
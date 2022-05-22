<!DOCTYPE html>
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
    <?php echo "$navList";
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
    <input type="text" id="invMake" name="invMake" required>
    </p>
    <p>
    <label for="invModel">Vehicle Model</label><span style="color:#B30000">*</span><br />
    <input type="text" id="invModel" name="invModel" required>
    </p>
    <p>
    <label for="invDescription">Vehicle Description</label><span style="color:#B30000">*</span><br />
    <input type="text" id="invDescription" name="invDescription" required>
    </p>
    <p>
    <label for="invImage">Vehicle Image</label><span style="color:#B30000">*</span><br />
    <input type="url" id="invImage" name="invImage" value="http://phpmotors/images/no-image.png" required>
    </p>
    <p>
    <label for="invThumbnail">Vehicle Thumbnail</label><span style="color:#B30000">*</span><br />
    <input type="url" id="invThumbnail" name="invThumbnail" value="http://phpmotors/images/no-image.png" required>
    </p>
    <p>
    <label for="invPrice">Vehicle Price</label><span style="color:#B30000">*</span><br />
    <input type="number" id="invPrice" name="invPrice" required>
    </p>
    <p>
    <label for="invStock"># in Stock</label><span style="color:#B30000">*</span><br />
    <input type="number" id="invStock" name="invStock" required>
    </p>
    <p>
    <label for="invColor">Vehicle color</label><span style="color:#B30000">*</span><br />
    <input type="text" id="invColor" name="invColor" required>
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
<?php 
if ($_SESSION['clientData']['clientLevel'] < 2) {
    # Redirect to home page
    header('Location: /phpmotors/');
    exit;
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
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
    <title>PHP Motors, Vehicle Management</title>
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
<main class="content clearfix formpage">
    <!-- MAIN CONTENT GOES HERE -->
    <h1>Vehicles Management </h1>   
    <div id="register-form-wrap">
   <form action="/phpmotors/vehicles/index.php">
    <input type="submit" class="addClassification" value="Add Classification">
    <input type="hidden" name="action" value="add-classification">
    </form>
    <br />
    <form action="/phpmotors/vehicles/index.php">
    <input type="submit" class="addVehicle" value="Add Vehicle">
    <input type="hidden" name="action" value="add-Vehicle">
    </form>
    <?php
    if (isset($message)) {
        # code...
        echo $message;
    }
    if (isset($classificationList)) {
        # code...
        echo '<h2>Vehicles By Classification</h2>';
        echo '<p>Choose a classification to see those vehicles</p>';
        echo $classificationList;
    }
    ?>
    <noscript>
        <p><strong>JavaScript Must be Enabled to Use this Page.</strong></p>
    </noscript>
    <table id="inventoryDisplay"></table>
    </div>
</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
<script src="../js/inventory.js"></script>
</body>
</html><?php  unset($_SESSION['message']);?>

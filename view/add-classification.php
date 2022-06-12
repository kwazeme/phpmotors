<?php
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
    <h1>Add Car Classification</h1>  
      <?php 
      if (isset($message) && isset($_POST['submit'])) {
        # code...
        echo "$message";
      }
      ?> 
<div id="register-form-wrap">

  <form id="register-form" action="/phpmotors/vehicles/index.php" method="post">
    <p>
        Please provide information for all empty form fields. Maximum 30 characters
    </p>  
    <p>
    <label for="className">classification Name</label><span style="color:#B30000">*</span><br />
    <input type="text" id="className" name="classificationName" placeholder="eg off-road" pattern="[a-zA_Z0-9-_]{3,30}" title="Only 3-30 characters and no symbols" required>
    </p>
    <p>
    <input type="submit" name="submit" id="classbtn" value="Add">
    <input type="hidden" name="action" value="addclassification">
    </p>
  </form>
</div>
</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>
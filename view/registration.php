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
    <title>PHP Motors</title>
</head>
<body>
    <!-- Require page header -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
<!-- require page navigation -->
    <nav class="clearfix">
    <?php echo "$navigation";
    // echo navBar($classifications); //echo "$navList";
    // require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php';
    ?>
</nav>

<main class="content clearfix formpage">
    <!-- MAIN CONTENT GOES HERE -->
    <h1> User Registration Form </h1>   
    <div id="register-form-wrap">
      <?php 
      if (isset($message)) {
        echo "$message";
      }
      ?>
  <form id="register-form" action="/phpmotors/accounts/index.php" method="post">
  <p>
    <label for="clientFirstname">Firstname</label><span style="color:#B30000">*</span><br />
    <input type="text" id="clientFirstname" name="clientFirstname" placeholder="Firstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>
    </p>
    <p>
    <p>
    <label for="clientLastname">Lastname</label><span style="color:#B30000">*</span><br />
    <input type="text" id="clientLastname" name="clientLastname" placeholder="Lastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required>
    </p>
    <p>
    <label for="clientEmail">Username</label><span style="color:#B30000">*</span><br />
    <input type="email" id="clientEmail" name="clientEmail" placeholder="Enter a valid email address" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
    </p>
    <p>
    <span>Make sure password is at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character.</span>
    <label for="clientPassword">Enter Password</label><span style="color:#B30000">*</span><br />
    <input type="password" id="clientPassword" name="clientPassword" placeholder="Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" >
    </p>
    <p>
    <input type="submit" name="submit" id="regbtn" value="register">
    <input type="hidden" name="action" value="register">
    </p>
  </form>
</div><!--form-wrap-->
</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>
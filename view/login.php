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
    <h1> User Login Form </h1>   
    <div id="login-form-wrap">
    <?php 
      if (isset($message)) {
        # code...
        echo "$message";
      }

      if (isset($_SESSION['message'])) {
        # code...
        echo $_SESSION['message'];
      }
      ?>
  <form id="login-form" method="post" action="/phpmotors/accounts/">
    <p>
    <label for="cEmail">Username</label><span style="color:#B30000">*</span><br />
    <input type="email" id="cEmail" name="clientEmail" placeholder="email@gmail.com" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <span>Remember valid password is at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character.</span><br>
    <label for="cPassword">Your Password</label><span style="color:#B30000">*</span><br />
    <input type="password" id="cPassword" name="clientPassword" placeholder="Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <input type="hidden" name="action" value="Login">
    <input type="submit" id="login" value="login">
    </p>
  </form>
  <div id="create-account-wrap">
    No account? 
    <?php echo "<a href='/phpmotors/accounts/index.php?action=registration".urlencode($register['registration'])."' title='Create your account'>Create Account</a>" ?>
  </div><!--create-account-wrap-->
</div><!--login-form-wrap-->
</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>
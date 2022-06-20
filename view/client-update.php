<?php 

if (!isset($_SESSION['loggedin'])) {
    # code...
    header('Location: /phpmotors/accounts/');

} else {
    # code...
    $Fname = $_SESSION['clientData']['clientFirstname'];
    $Lname = $_SESSION['clientData']['clientLastname'];
    $Email = $_SESSION['clientData']['clientEmail'];
    $Level = $_SESSION['clientData']['clientLevel'];
    $clientId = $_SESSION['clientData']['clientId'];
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
    <h1> User Account Update </h1>   
    <div id="login-form-wrap">
      <?php 
      if (isset($message)) {
        echo "$message";
      }
      ?>
    <h2>Account Details Update</h2>

  <form id="login-form" action="/phpmotors/accounts/index.php" method="post">
  <p>
    <label for="clientFirstname">Firstname</label><span style="color:#B30000">*</span><br />
    <input type="text" id="clientFirstname" name="clientFirstname" placeholder="Firstname" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($Fname)) {echo "value='$Fname'"; }?>>
    </p>
    <p>
    <label for="clientLastname">Lastname</label><span style="color:#B30000">*</span><br />
    <input type="text" id="clientLastname" name="clientLastname" placeholder="Lastname" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($Lname)) {echo "value='$Lname'"; }?> >
    </p>
    <p>
    <label for="clientEmail">Username</label><span style="color:#B30000">*</span><br />
    <input type="email" id="clientEmail" name="clientEmail" placeholder="Enter a valid email address"  required <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($Email)) {echo "value='$Email'"; }?>>
    </p>
    <p>
    <input type="submit" name="submit" id="updateUserbtn" value="Update Account">
    <input type="hidden" name="action" value="updateAccount">
    <input type="hidden" name="clientId" value="<?php if (isset($clientId)) {
      echo $clientId;}?>">
    </p>
  </form>
</div><!--form-wrap-->
<div id="register-form-wrap">
<h2>Change Password</h2>
<p id="info">The password you enter here will replace your existing password:
    <span>Make sure password is at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character.</span></p>  
  <form id="register-form" action="/phpmotors/accounts/index.php" method="post">
    <p>
  <label for="clientPassword">Enter Password</label><span style="color:#B30000">*</span><br />
    <input type="password" id="clientPassword" name="clientPassword" placeholder="Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" >
    </p>
    <p>
    <input type="submit" name="submit" id="updatePassbtn" value="Update Password">
    <input type="hidden" name="action" value="updatePass">
    <input type="hidden" name="clientId" value="<?php if (isset($clientId)) {
      echo $clientId;}?>">
    </p>
  </form>
</div><!--form-wrap-->
</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>
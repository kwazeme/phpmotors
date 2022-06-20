<?php 

if (!isset($_SESSION['loggedin'])) {
    # code...
    header('Location: /phpmotors/accounts/');

} else {
    # code...
    $fname = $_SESSION['clientData']['clientFirstname'];
    $lname = $_SESSION['clientData']['clientLastname'];
    $email = $_SESSION['clientData']['clientEmail'];
    $level = $_SESSION['clientData']['clientLevel'];
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
    <h1><?php echo "<span>$fname $lname</span>";?></h1>  
    <?php 
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
    if (isset($message)) {
    # code...
    echo "$message";
      }
      ?>  
    <div id="login-form-wrap">
        <h4>You are logged in. </h4>
        <ul>
            <li>First name: <?php echo $fname;?></li>
            <li>Last name: <?php echo $lname;?></li>
            <li>Email: <?php echo $email;?></li>
        </ul>
        <div id="create-account-wrap">
        <?php if ($level > 1) {
            # code...
            echo $manLink;
            # code...
            echo "<hr>";
            echo $admLink;
        } ?>
        </div>
    </div>

</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>
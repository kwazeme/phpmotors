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
    <?php echo "$navList";
    // require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php';
    ?>
</nav>

<main class="content clearfix">
    <!-- MAIN CONTENT GOES HERE -->
    <h1> User Registration Form </h1>   
    <div id="register-form-wrap">
  <form id="register-form">
  <p>
    <label for="clientFirstname">Firstname</label><span style="color:#B30000">*</span><br />
    <input type="text" id="clientFirstname" class="required-field" name="clientFirstname" placeholder="Firstname" required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <p>
    <label for="clientLastname">Lastname</label><span style="color:#B30000">*</span><br />
    <input type="text" id="clientLastname" name="clientLastname" placeholder="Lastname" required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <label for="username">Username</label><span style="color:#B30000">*</span><br />
    <input type="email" id="username" name="username" placeholder="email@gmail.com" required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <label for="password">Password</label><span style="color:#B30000">*</span><br />
    <input type="password" id="password" name="password" placeholder="Password" required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <input type="submit" id="login" value="Register">
    </p>
  </form>
</div><!--form-wrap-->
</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>
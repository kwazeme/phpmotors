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
    //echo navBar($classifications); //echo "$navList";
    # require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php';
    ?>
</nav>

<main class="content clearfix">
    <!-- MAIN CONTENT GOES HERE -->
<h1>Welcome to PHP Motors!</h1>
<aside>
    <h2>DMC Delorean</h2>
    <p>3 Cup holders 
    <br />Superman doors
    <br />Fuzzy dice!
    </p>
</aside>
<img src="/phpmotors/images/site/own_today150.png" alt="own delorean">
<picture class="delorean">
    <source media="(max-width: 200px)" srcset="/phpmotors/uploads/images/vehicles/delorean.jpg">
    <source media="(max-width: 800px)" srcset="/phpmotors/uploads/images/vehicles/delorean-tn.jpg">
    <img src="/phpmotors/uploads/images/vehicles/delorean.jpg" alt="delorean-img">
</picture>
<section class="ftop">
    <div class="reviews">
        <h3>DMC Delorean Reviews</h3>
        <ul>
            <li>"So fast its almost like travelling in time" (4/5)</li>
            <li>"Coolest ride on the road" (4/5)</li>
            <li>"I'm feeling Marty McFly!" (5/5)</li>
            <li>"The most futeristic ride of our day"</li>
            <li>"80's livin and I love it!" (5/5)</li>
        </ul>
    </div>
    <div class="upgrades">
        <h3>Delorean Upgrades</h3>
        <div class="container">
        <div class="box"><figure><img src="/phpmotors/images/upgrades/flux-cap.png" alt="flux-capacitor"><figcaption><a href="#">Flux Capacitor</a></figcaption></figure></div>
        <div class="box"><figure><img src="/phpmotors/images/upgrades/flame.jpg" alt="flame-Decals"><figcaption><a href="#">Flame Decals</a></figcaption></figure></div>
        <div class="box"><figure><img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="bumper-sticker"><figcaption><a href="#">Bumper sticker</a></figcaption></figure></div>
        <div class="box"><figure><img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub-cap"><figcaption><a href="#">Hub caps</a></figcaption></figure></div>
        </div>
    </div>    
</section>

</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>
<header class="clearfix">

    <figure>
        <img src="/phpmotors/images/site/logo.png" alt="phpmotors_logo">
       <?php echo "<a href='/phpmotors/accounts/index.php?action=login".urlencode($_action['login'])."' title='Login to your account'>My Account</a>";?>
    </figure>
    <?php                // Check if the firstname cookie exists, get its value
        if (isset($cookieFirstname)) {
            echo "<div class='greeting'>Welcome $cookieFirstname</div>";
            # code...
        }?>

</header>

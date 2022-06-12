<header class="clearfix">
<?php 
if (isset($_SESSION['loggedin'])) {
    # code...
    $fname = $_SESSION['clientData']['clientFirstname'];
    echo "<figure>
    <img src='/phpmotors/images/site/logo.png' alt='phpmotors_logo'> <a href='/phpmotors/accounts/index.php?action=logout' title='log out'>Logout</a> &nbsp; <a href='/phpmotors/accounts/index.php?action=admin' title='admin panel'>Welcome $fname |</a> 
    </figure>";
} else {    
    # code...
    echo "<figure>
    <img src='/phpmotors/images/site/logo.png' alt='phpmotors_logo'>
    <a href='/phpmotors/accounts/index.php?action=login' title='login to my account'>My Account</a>
    </figure>";
}


?>


</header>

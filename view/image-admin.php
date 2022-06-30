<?php 
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
    <title>PHP Motors | Image Management</title>
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

<main class="content formpage clearfix">
    <!-- MAIN CONTENT GOES HERE -->
<h1>Image Management Here</h1>
<div id="upload-form-wrap">
<p class="info">Welcome to the image management view. <br>
Choose one of the options below to start:</p>
<h2 id="uh2">Add New Vehicle Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>
<form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data" id="upload-form">
 <!-- <label>Vehicle</label> -->
	<?php echo $prodSelect; ?><br><br>
	<fieldset>
		<label>Is this the main image for the vehicle?</label>
		<label for="priYes" class="pImage">Yes</label>
		<input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
		<label for="priNo" class="pImage">No</label>
		<input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
	</fieldset><br>
 <label>Upload Image:</label>
 <input type="file" name="file1"><br><br>
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>
</div>
<hr>
<h2>Existing Images</h2>
<p id="info">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>
</main>
<!-- Require page footer -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>
<?php unset($_SESSION['message']); ?>
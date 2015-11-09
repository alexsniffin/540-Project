<?php

//take in user info from form
$usrName = $_POST["user"];
$pass1 = $_POST["pwrd1"];
$pass2 = $_POST["pwrd2"];
$eAdd = $_POST["emadd"];
$gend = $_POST["sex"];
$age = $_POST["age"];
$ip = 0;

// Compare passwords and make sure they are the servername

if($pass1 != $pass2)
{
  die("Passwords do not match!");
}

// sql call to create account
$crtUserACC = "CALL createUser('" . $eAdd . "', '" . $pass1 . "', '" . $usrName . "', '" . $gend . "', " . $age . ", " . $ip . ", NULL, NOW())";
$res = NULL;

function callCreate($crtACC)
{
  $servername = "24.197.117.117";
  $username = "darth";
  $password = "ineedhelp";
  $dbname = "pollApp";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if($conn->connect_error)
  {
    die("Connection failed: " . $conn->conect_error);
  }
  $res = mysqli_query($conn, $crtACC) or die("Email address allready in use");

  $conn->close();
}

?>
<html lang = "en">

	<head>
		<title>Polling App</title>
		<meta charset = "utf-8">
		<meta name = "viewport" content = "width = device-width, initial-scale = 1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
  		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</head>

	<body>

		<!-- Logo -->
		<img class="logo" src="imgs/logo_2x.png"></img>

		<!-- Top of page text -->
		<div class="signIn">
      <?php
        
        $res = callCreate($crtUserACC);
      ?>
        <p> You Succsefully created an account. Click <a href="index.php">here</a> to login </p>
    </div>
  </html>

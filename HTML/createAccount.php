<?php

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

//check to make sure characters are valid entries and
//won't destroy the database functionallity
$illegal = "#$%^&*()+=-[]';,./{}|:<>?~";

$Check = (false === strpbrk($usrName, $illegal)) ? 'Allowed' : 'Disallowed';
	
if($Check == 'Disallowed')
{
	header('Location: index.php?log=fail');
}
$Check = (false === strpbrk($eAdd, $illegal)) ? 'Allowed' : 'Disallowed';
	
if($Check == 'Disallowed')
{
	header('Location: index.php?log=fail');
}

$illegal = "[]';,./{}|:<>?~";

$Check = (false === strpbrk($pass1, $illegal)) ? 'Allowed' : 'Disallowed';
	
if($Check == 'Disallowed')
{
	header('Location: index.php?log=fail');
}

// sql call to create account
$crtUserACC = "CALL createUser('" . $eAdd . "','" . $pass1 ."','" . $usrName . "','" . $gend . "'," . $age . "," . $ip . ",NULL,NOW())";
$res = NULL;

function callCreate($crtACC){}

$res = mysqli_query($conn, $crtUserACC) or die("Query fail: " . mysqli_error()); //or die("There was an error with your Account Creation, please try again");
$conn->close();



?>
<html lang = "en">

	<head>
		<title>Create Account | Polling App</title>
		<link rel="icon" type="image/png" href="imgs/favicon.png">
		<meta charset = "utf-8">
		<meta name = "viewport" content = "width = device-width, initial-scale = 1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/styles.css">
  		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</head>

	<body>
	
	<div class="main-content login">

		<!-- Logo -->
		<img class="logo" src="imgs/logo_2x.png"></img>

		<!-- Top of page text -->
		<div class="signIn">
      <?php
        
        $res = callCreate($crtUserACC);
      ?>
        <p> You Succsefully created an account. Click <a href="index.php">here</a> to login </p>
    </div>
    
    </div>
  </html>

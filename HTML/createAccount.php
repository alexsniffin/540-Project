<?php
//conect to database
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
$gender = $_POST["gender"];

// Compare passwords and make sure they are the servername

if($pass1 != $pass2)
{
  die("Passwords do not match!");
}

//check for username uniqueness

//check for email uniqueness

//create account

?>

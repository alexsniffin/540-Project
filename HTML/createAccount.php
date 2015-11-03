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

$sqlInsert

$userID = 1;

$incr1 = 0;

//loads in user input in order to create SQL call function string
function loadArray()
{
$buff;

$buff[0][0] = $_POST['user'];
$buff[0][1] = $_POST['pwrd1'];
$buff[0][2] = $_POST['emadd'];
$buff[0][3] = $_POST['gender'];

// $GLOBALS['incr1']++;

return $buff;
}
?>

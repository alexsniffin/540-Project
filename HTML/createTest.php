<?php
$email = 'med@me.com';
$pass = 'pass';
$user = 'dong';
$gender = 'male';
$age = 24;
$ip = 0;

$crtUserACC = "CALL createUser('me@me.com', 'pass', 'me', 'Male', 24, 0, NULL, NOW())";
$crtUserACC1 = "CALL createUser('" . $email . "', '" . $pass . "', '" . $user . "', '" . $gender . "', " . $age . ", " . $ip . ", NULL, NOW())";
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

echo $crtUserACC;
echo $crtUserACC1;
callCreate($crtUserACC1);


?>

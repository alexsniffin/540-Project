<?php

session_start();


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
 //$ress = 1;
 //echo $ress;

 //echo $ress;
 //return $ress;

$user = $_POST["user"];
$pass = $_POST["pwrd"];

//check for username and password being valid
$login = "SELECT login('" . $user . "', '" . $pass . "')";

$res = mysqli_query($conn, $login) or die("UserName or password do not match");
$conn->close();

$logPass = mysqli_fetch_array($res);

$userID = $logPass[0];

$_SESSION['arrLogin'] = $userID;

$res = -1;

if($userID==-1)
{
	header('Location: index.php?log=fail');
}
else
{
  // create cookies
  //echo $res;
  //$cookie_name = $user;
  //$cookie_value = $res; //will be unique id of user
  //setcookie($cookie_name, $cookie_value, time()+(86400), "/");
  header('Location: home.html');
}

?>

<?php

$user = $_POST["user"];
$pass = $_POST["pwrd"];

//check for username and password being valid


// create cookies
$cookie_name = $user;
$cookie_value = 1; //will be unique id of user
setcookie($cookie_name, $cookie_value, time()+(86400), "/");

?>

<!DOCTYPE html>

<html lang = "en">

	<head>
		<title>Polling App</title>
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
		<div class="login-text">
		<?php
		
		//Check to see if user has failed a login attempt
		if(isset($_GET["log"]))
		{
			echo "<strong>Login failed! Please enter in your appropriate Email and Password.</strong>";
		}
		else
		{
			echo "Sign in using your username and password or create a new account";
		}
		?>
		</div>

		<!-- Sign in  -->
        <div class="signIn">
			<form action="login.php" class="create-signIn" method="post">
				<label for="Email"><strong>Email: </strong></label>
				<br>
				<input type="email" required name="user" id="Email" >
				<br>
				<label for="passWord"><strong>Password: </strong></label>
				<br>
				<input type="password" required name="pwrd" id="passWord">
				<br>
				<input class="submit-button login" type="submit" value="Submit">
			</form>

			<p>Don't have an account? <a href="createAccount.html">Create One</a></p>
        </div>

	</body>


</html>

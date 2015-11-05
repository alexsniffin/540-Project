<!DOCTYPE html>

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
		<div class="login-text">
		Sign in using your username and password or create a new account
		</div>

					<!-- Sign in  -->
        <div class="signIn">
					<form action="login.php" class="create-signIn">
						<label for="userName"><strong>Username: </strong></label><input type="text" name="user" id="userName" >
						<br>
						<label for="passWord"><strong>Password: </strong></label><input type="password" name="pwrd" id="passWord">
						<br>
						<input class="submit-button login" type="submit" value="Submit">
					</form>

					<p>Don't have an account? <a href="createAccount.html">Create One</a></p>
        </div>

	</body>


</html>

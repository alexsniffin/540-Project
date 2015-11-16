<!DOCTYPE html>



<html lang = "en">
<?php 
session_start();

//a single int representing the User ID in the database.
//used for calling procedures.
$userID = $_SESSION['arrLogin'];

//An array containing User Profile information
//index 0 = email (string)
//index 1 = display name (string)
//index 2 = coins (int)
//index 3 = gender (string)
//index 4 = age (int)
//index 5 = creation date (timestamp) ----NOT RETURNED----
//index 6 = total votes (int)		  ----NOT RETURNED----
$user = $_SESSION['userProfile'];

?>

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
	
	<!-- Navbar -->
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    	<div class="navbar-header">
      		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span> 
      		</button>
      	<a class="navbar-brand" href="home.php"><img src ="imgs/pollingApp_icon_2x.png"> <span>Polling App</span></a>
   		 </div>
    		<div class="collapse navbar-collapse" id="myNavbar">
     		    <ul class="nav navbar-nav">
        			<li><a href="createPoll.php">Create</a></li>
        			<li><a href="votepublic.php">Vote</a></li>
       			    <li><a href="privatepoll.php">Private Polls</a></li> 
					
      			</ul>
      			<ul class="nav navbar-nav navbar-right">
      				<li><a href="index.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li> 
     			</ul>
    		</div>
  		</div>
	</nav>
	
	<!-- User Bar -->
	<div class="userbar">
		<ul>
			<li><a href="profile.php"><img src ="imgs/user_icon_2x.png"><?php echo $user[1]; ?></a></li>
			<li><img src ="imgs/coin_icon_2x.png"><?php echo $user[2]; ?></li>
		<ul>
	</div>
	
	<!-- Start main content -->
	<div class="main-content">
	
		<!-- Top of page text -->
		<div class="top">
		<h2>Ready to share your<br/>opinions with the world?</h2>
		</div>
	
		<!-- Vote Now Button -->
		<div class="round-button-container">
			<div class="round-button">
			<a href="votepublic.php?cat">Vote</br>Now</a>
			</div>
		</div>	
		
		<!-- Bottom of page text -->
		<div class="bottom">
		<p>or choose from<br/></p> <a href="categories.php">Categories</a>
		<p>you can even<br/></p> <a href="createPoll.php">Create your own poll</a>
		</div>
		
	</div>
			
	</body>

	
</html>
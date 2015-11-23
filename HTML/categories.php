<!DOCTYPE html>

<html lang = "en">
<?php session_start();
$user=$_SESSION['userProfile'];
?>
	<head>
		<title>Categories</title>
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
      	<a class="navbar-brand" href="home.html"><img src ="imgs/pollingApp_icon_2x.png"> <span>Polling App</span></a>
   		 </div>
    		<div class="collapse navbar-collapse" id="myNavbar">
     		    <ul class="nav navbar-nav">
        			<li><a href="createPoll.php">Create</a></li>
        			<li><a href="votepublic.php?cat">Vote</a></li>
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
			<li><a href="profile.html"><img src ="imgs/user_icon_2x.png"><?php echo $user[1]; ?></a></li>
			<li><img src ="imgs/coin_icon_2x.png"><?php echo $user[2];?></li>
		<ul>
	</div>
	
	<!-- Start main content -->
	<div class="main-content">
	
		<!-- Top of page text -->
		<div class="top">
		<h2>Choose a category</h2>
		</div>

		<!-- Red divider -->
		<div class="red-divider">
		</div>
	
		<!-- List of categories -->
		<!-- This will need to be populated from the database, and clicking each category will filter the polls -->
		<div class="category-container">
			<ul>
				<li><a href="votepublic.php?cat=science">Science</a></li>
				<li><a href="votepublic.php?cat=lit">Literature</a></li>
				<li><a href="votepublic.php?cat=tech">Technology</a></li>
				<li><a href="votepublic.php?cat=music">Music</a></li>
				<li><a href="votepublic.php?cat=movies">Movies</a></li>
				<li><a href="votepublic.php?cat=curEvent">Current Events</a></li>
				<li><a href="votepublic.php?cat=game">Gaming</a></li>
				<li><a href="votepublic.php?cat=food">Food & Drink</a></li>
				<li><a href="votepublic.php?cat=poli">Politics</a></li>
			</ul>	
		</div>
	
	</div>
		
	</body>
	
</html>
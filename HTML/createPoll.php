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

<!-- basic poll creation page
The first line below, where action = "xxxx" is the page that will
load when submit is pressed. -->

	<!-- Navbar -->
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    	<div class="navbar-header">
      		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span> 
      		</button>
      	<a class="navbar-brand" href="index.html"><img src ="imgs/pollingApp_icon_2x.png"> <span>Polling App</span></a>
   		 </div>
    		<div class="collapse navbar-collapse" id="myNavbar">
     		    <ul class="nav navbar-nav">
        			<li><a href="createPoll.php">Create</a></li>
        			<li><a href="votepublic.html">Vote</a></li>
       			    <li><a href="privatepoll.html">Private Polls</a></li> 
      			</ul>
    		</div>
  		</div>
	</nav>
	
	<!-- User Bar -->
	<div class="userbar">
		<ul>
			<li><a href="#"><img src ="imgs/user_icon_2x.png">pollshark567</a></li>
			<li><img src ="imgs/coin_icon_2x.png">12</li>
		<ul>
	</div>
	
	<!-- Start main content -->
	<div class="main-content">
	
		<!-- Top of page text -->
		<div class="top">
		<h2>Create a Poll</h2>
		</div>

		<!-- Red divider -->
		<div class="red-divider">
		</div>
	
		<!-- Create poll form -->
		<form action="createPollBackend.php" method="post" class="create-form">
			Enter in a question: <input type="text" name="quest"><br>
			Answer One:  <input type="text" name="ans1"><br>
			Answer Two:  <input type="text" name="ans2"><br>
			Answer Three:  <input type="text" name="ans3"><br>
			Answer Four:  <input type="text" name="ans4"><br>
			Answer Five:  <input type="text" name="ans5"><br>
			Answer Six:  <input type="text" name="ans6"><br>
			
			<input type="submit" class="submit-button">
		</form>

	</div>

</body>
</html>
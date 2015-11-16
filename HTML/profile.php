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
		<title><?php echo $user[1]; ?>| Polling App</title>
		<meta charset = "utf-8">
		<meta name = "viewport" content = "width = device-width, initial-scale = 1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  		<script type="text/javascript" src="js/bootstrap.min.js"></script>
  		
		<link rel="stylesheet" type="text/css" href="css/styles.css">
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
        			<li><a href="votepublic.php">Vote</a></li>
       			    <li><a href="privatepoll.html">Private Polls</a></li> 
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
			<li><img src ="imgs/coin_icon_2x.png"><?php echo $user[2]; ?></li>
		<ul>
	</div>
	
	<!-- Start main content -->
	<div class="main-content">
	
		<!-- Username and info -->
		<div class="user-header">
		<h2><?php echo $user[2]; ?></h2>
		<ul>
			<li><strong>12</strong> Votes</li>
			<li><strong>4</strong> Polls Created</li>
		</ul>
		</div>

		<!-- Red divider -->
		<div class="red-divider">
		</div>
		
		<!-- Poll Info -->
		<div class="info-container">
			<ul class="nav nav-pills">
				<li class="active"><a data-toggle="pill" href="#menu1">Polls</a></li>
				<li><a data-toggle="pill" href="#menu2">Votes</a></li>
				<li><a data-toggle="pill" href="#menu3">Private Polls</a></li>
			</ul>

			<div class = "tab-content">
				<div id="menu1" class="tab-pane active">
				
				  <table class="table table-hover">
					<thead>
					  <tr>
						<th>Title</th>
						<th>Votes</th>
						<th>Created</th>
						<th>Expiration Date</th>
						<th>Status</th>
						<th>Results</th>
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<td>Poll 1</td>
						<td>54</td>
						<td>3/6/2015</td>
						<td>4/9/2015</td>
						<td>Closed</td>
						<td><a href="/immedresults.html">View</a></td>
					  </tr>
					  <tr>
						<td>Poll 2</td>
						<td>54</td>
						<td>10/6/2015</td>
						<td>11/9/2015</td>
						<td>Open</td>
						<td><a href="/immedresults.html">View</a></td>
					  </tr>
					  <tr>
						<td>Poll 3</td>
						<td>54</td>
						<td>3/6/2015</td>
						<td>4/9/2015</td>
						<td>Closed</td>
						<td><a href="/immedresults.html">View</a></td>
					  </tr>
					</tbody>
				  </table>
				  
				</div>
				
				
				<div id="menu2" class="tab-pane">
				
					<table class="table table-hover">
					<thead>
					  <tr>
						<th>Title</th>
						<th>Results</th>
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<td>Poll 1</td>
						<td><a href="/immedresults.html">View</a></td>
					  </tr>
					  <tr>
						<td>Poll 2</td>
						<td><a href="/immedresults.html">View</a></td>
					  </tr>
					  <tr>
						<td>Poll 3</td>
						<td><a href="/immedresults.html">View</a></td>
					  </tr>
					</tbody>
				  </table>
				  
				</div>
				
				
				<div id="menu3" class="tab-pane">
				
				  <table class="table table-hover">
					<thead>
					  <tr>
						<th>Title</th>
						<th>Votes</th>
						<th>Created</th>
						<th>Expiration Date</th>
						<th>Status</th>
						<th>Results</th>
						<th>Share Code</th>
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<td>Poll 1</td>
						<td>54</td>
						<td>3/6/2015</td>
						<td>4/9/2015</td>
						<td>Closed</td>
						<td><a href="/immedresults.html">View</a></td>
						<td>00000000</td>
					  </tr>
					  <tr>
						<td>Poll 2</td>
						<td>54</td>
						<td>10/6/2015</td>
						<td>11/9/2015</td>
						<td>Open</td>
						<td><a href="/immedresults.html">View</a></td>
						<td>00000000</td>
					  </tr>
					  <tr>
						<td>Poll 3</td>
						<td>54</td>
						<td>3/6/2015</td>
						<td>4/9/2015</td>
						<td>Closed</td>
						<td><a href="/immedresults.html">View</a></td>
						<td>00000000</td>
					  </tr>
					</tbody>
				  </table>
				  
				</div>
			</div>
		</div>	
			
			
		</div>	

	</div>

</body>


</html>
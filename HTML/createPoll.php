<!DOCTYPE html>

<html lang = "en">

	<head>
		<title>Polling App</title>
		<meta charset = "utf-8">
		<meta name = "viewport" content = "width = device-width, initial-scale = 1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  		<script type="text/javascript" src="js/bootstrap.min.js"></script>
  		
  		<!-- For calendar input -->
  		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  		
  		
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
	
		<div class="create-container">
		
			<!-- Category selection -->
			<div class="form-group">
  				<label for="categoryselection"><strong>Choose a category:</strong> </label>
  				<select class="form-control" id="categoryselection">
  				  	<option>Science</option>
					<option>Literature</option>
					<option>Technology</option>
					<option>Music</option>
					<option>Movies</option>
					<option>Current Events</option>
					<option>Gaming</option>
					<option>Food & Drink</option>
					<option>Politics</option>
  				</select>
			</div>
			
			<!-- Date selection -->
			<div class="form-group">
				<label for="exp_date"><strong>Expiration Date:</strong> </label>
				<!-- Need to somehow get result of this and give to database -->
				<input id="datepicker" class="calendar-input"/>
			</div>
			
			<!-- Private Poll Checkbox -->
			<div class="checkbox">
  				<label><input type="checkbox" value="">This is a private poll</label>
			</div>
		
			<!-- Create poll form -->
			<form action="createPollBackend.php" method="post" class="create-form">
				<strong>Enter a question:</strong> <input type="text" name="quest"><br>
				Choice One:  <input type="text" name="ans1"><br>
				Choice Two:  <input type="text" name="ans2"><br>
				Choice Three:  <input type="text" name="ans3"><br>
				Choice Four:  <input type="text" name="ans4"><br>
				Choice Five:  <input type="text" name="ans5"><br>
				Choice Six:  <input type="text" name="ans6"><br>
			
				<input type="submit" class="submit-button">
			</form>
			
		</div>	

	</div>
	
	<!-- Calendar input -->
	<script> $(document).ready(function()
	{
		$("#datepicker").datepicker();
	});
	
	</script>

</body>


</html>
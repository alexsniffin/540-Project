<!DOCTYPE html>

<html lang = "en">
<?php
//====================================BEGIN PHP CODE============================================//
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
	
	
	//Connect to database
	$servername = "24.197.117.117";
	$username = "darth";
	$password = "ineedhelp";
	$dbname = "pollApp";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	//winning
	$winning = true;
	
	$shareKey = $_POST['sharecode'];
	//echo $shareKey;
	

	//This sequence of instructions fetches a random poll id from
	//other users every time the page is loaded
	$privSQLQuery = "CALL private_poll('". $shareKey ."');";
	$privIDTransfer = mysqli_query($conn,$privSQLQuery) or die("Query fail: " . mysqli_error());
	$privID = mysqli_fetch_array($privIDTransfer);
	$conn->close();

	//If there are no available polls, reload home page and inform user
	if($privID[0] == '')
	{
		header('Location: home.php?pol=noPolls');
	}
	
	//echo $privID[0];
	//If there are no available polls, reload home page and inform user
	//if($randID[0] == '')
	//{
	//	header('Location: home.php?pol=noPolls');
	//}
	
	//Print Poll question
	function callQuestion($temp, $connection)
	{
		$sqlLine = "CALL getPollQuestion(" . $temp . ");";
		$question = mysqli_query($connection, $sqlLine) or die("Query fail: " . mysqli_error());

		// print out Question answers.
		while ($row = mysqli_fetch_array($question))
		{
			echo $row[0] . " - " . $row[1] . " - " . $row[2];
		}
	}
	
	// Return poll answers from database into array
	function callAnswers($temp, $connection)
	{
		$sqlLine = "CALL getPollAnswers(" . $temp . ");";
		$question = mysqli_query($connection, $sqlLine) or die("Query fail: " . mysqli_error());
		$incr = 0;
		$arrReturn = array();
	
		// print out Question answers.
		while ($row = mysqli_fetch_array($question))
		{
			$arrReturn[$incr][0] = $row[0];
			$arrReturn[$incr][1] = $row[1];
			$arrReturn[$incr][2] = $row[2];
			$incr++;
		}
		return $arrReturn;
	}
	
	//Call Answers and store them into answerArray to print on radio buttons
	$conn = new mysqli($servername, $username, $password, $dbname);
	$answerArray = callAnswers($privID[0],$conn) or die("Query fail: " . mysqli_error());
	
	$_SESSION['arrReturn'] = $answerArray;
	
	
	$conn->close();
	
	
//=============================END PHP CODE=================================//
?>
	<head>
		<title>Private Poll</title>
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
        			<li><a href="votepublic.php?catVote</a></li>
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
			<li><img src ="imgs/coin_icon_2x.png"><?php echo $user[2]; ?></li>
		<ul>
	</div>
	
	<!-- Start main content -->
	<div class="main-content">
	
		<!-- Question -->
		<div class="question">
			<div class="question-text">
				<?php
				//Call question and print it out.
				$conn = new mysqli($servername, $username, $password, $dbname);
				$quest = callQuestion($privID[0], $conn);
				$conn->close();
				?>
			</div>
			<div class="right-arrow"></div>
		</div>
	
		
		<!-- Choices -->
		<div class="choices">
			<ul>
				<form action="immedresults.php" method="post">
				<?php 
					
					
				for($i=0; $i<count($answerArray); $i++)
				{
					echo "<li><div class='choice-text'><input type='radio' id='choice' name='choice' value='choice".$i
						."'>".$answerArray[$i][1]."</div></li>";
				}
					
				?>
				<input type="submit" class="submit-button">  
				</form>
			</ul>
		</div>	

	</div>

	</body>

</html>
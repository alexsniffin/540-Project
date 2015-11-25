<html>

<?php

session_start();
$userID=$_SESSION['arrLogin'];
$user=$_SESSION['userProfile'];

//Answer Array that contains all answers from the question
//index 0 is the poll id (i think)
//index 1 is the answer string
//index 2 is the number of votes an answer has
//$answerArray = 
	
//Connect to database
$servername = "24.197.117.117";
$username = "darth";
$password = "ineedhelp";
$dbname = "pollApp";

$pollID = $_GET["pol"];

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
$answerArray = callAnswers($pollID,$conn) or die("Query fail: " . mysqli_error());
$conn->close();

//winning
$winning = true;

//Get the total amount of votes for all answers
$totalVotes = 0;
for($i = 0; $i < count($answerArray); $i++)
{
	$totalVotes += $answerArray[$i][2];
}
			
?>

	<head>
		<title>Results | Polling App</title>
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
			<li><img src ="imgs/coin_icon_2x.png"><?php echo $user[2]; ?></li>
		<ul>
	</div>
	
	<!-- Start main content -->
	<div class="main-content">
			
		<!-- Question -->
		<div class="question">
			<div class="left-arrow inactive"></div>
			<div class="question-text">
				<?php
				//Call question and print it out.
				$conn = new mysqli($servername, $username, $password, $dbname);
				$quest = callQuestion($pollID, $conn);
				$conn->close();
				?>
			</div>
			<div class="right-arrow"></div>
		</div>
		
		<!-- Results -->
		<div class="choices">
			<ul class="results">
				<?php 
					for($i=0; $i<count($answerArray); $i++)
					{
						$percentage = round(((($answerArray[$i][2] + 1) / $totalVotes) * 100), 1);
						echo "<li><div class='result-text'><strong>".$answerArray[$i][1]."</strong></div><div class='result-percentage'><strong>"
								.$percentage."%</strong></div><div class='result-bar selected' style='width:".$percentage."%;'></div></li>";		
					}	
				?>
			</ul>	
		</div>

	</div>
	
	</body>
	
	<!-- Just brings in a new poll by essentially refreshing the page right now -->
	<script type="text/javascript">
		$(document).ready(function(){
		
			//declare click handler for right arrow
			$(document).on('click', '.right-arrow', function()
			{	

				window.location.href = 'votePublic.php';
			});	
		});
	</script>

</html>
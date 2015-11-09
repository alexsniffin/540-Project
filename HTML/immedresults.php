<html>

<?php

$ansRes = $_POST["choice"];

echo $ansRes;
	
//Connect to database
$servername = "24.197.117.117";
$username = "darth";
$password = "ineedhelp";
$dbname = "pollApp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//winning
$winning = true;

//This sequence of instructions fetches a random poll id from
//other users every time the page is loaded
$randSQLQuery = "CALL random_public_poll(3);";
$randIDTransfer = mysqli_query($conn,$randSQLQuery) or die("Query fail: " . mysqli_error());
$randID = mysqli_fetch_array($randIDTransfer);

	
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
$answerArray = callAnswers($randID[0],$conn) or die("Query fail: " . mysqli_error());

			
echo "worked";
			
switch($choice)
{
	case choice1:
		$resAnswer = $answerArray[0][0];
		break;
	case choice2:
		$resAnswer = $answerArray[1][0];
			break;
	case choice3:
		$resAnswer = $answerArray[2][0];
		break;
	case choice4:
		$resAnswer = $answerArray[3][0];
		break;
	case choice5:
		$resAnswer = $answerArray[4][0];
		break;
	case choice6:
		$resAnswer = $answerArray[5][0];
		break;
	case choice7:
		$resAnswer = $answerArray[6][0];
		break;
	case choice8:
		$resAnswer = $answerArray[7][0];
		break;
	case choice9:
		$resAnswer = $answerArray[8][0];
		break;
	case choice10:
		$resAnswer = $answerArray[9][0];
		break;
	case choice11:
		$resAnswer = $answerArray[10][0];
		break;
	case choice12:
		$resAnswer = $answerArray[11][0];
		break;
}
				
$builtString = "CALL userVote(" . 2 . "," . $resAnswer . ")";
		
echo $builtString;
				
$conn = new mysqli($servername, $username, $password, $dbname);
	
//Attempt to insert data into database
$insert = mysqli_query($conn, $builtString) or die("Query fail: " . mysqli_error()); 
	
?>
	
	
	<head>
		<title>Vote</title>
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
        			<li><a href="votepublic.html">Vote</a></li>
       			    <li><a href="privatepoll.html">Private Polls</a></li> 
      			</ul>
    		</div>
  		</div>
	</nav>
	
	<!-- User Bar -->
	<div class="userbar">
		<ul>
			<li><a href="profile.html"><img src ="imgs/user_icon_2x.png">pollshark567</a></li>
			<li><img src ="imgs/coin_icon_2x.png">12</li>
		<ul>
	</div>
	
	<!-- Start main content -->
	<div class="main-content">
	
		<!-- Question -->
		<!-- Will need to be populated from database -->
		<div class="question">
			<div class="left-arrow"></div>
			<div class="question-text">
				What is your favorite answer?
			</div>
			<div class="right-arrow"></div>
		</div>
	
	
		<!-- Results -->
		<!-- Will need to be populated from database -->
		<div class="choices">
			<ul class="results">
				<li>
					<div class="result-text">
						The first answer
					</div>
					<div class="result-percentage">
						25%
					</div>
					<!-- Hopefully this width value can be populated from database as well -->
					<div class="result-bar" style="width:25%;"></div>
				</li>
				<li>
					<div class="result-text">
						The second answer
					</div>
					<div class="result-percentage">
						50%
					</div>
					<div class="result-bar" style="width:50%;"></div>
				</li>
				<li>
					<div class="result-text">
						A longer answer that takes up multiple lines blah blah blah blah
					</div>
					<div class="result-percentage">
						25%
					</div>
					<div class="result-bar" style="width:25%;"></div>
				</li>
			</ul>	
		</div>
		</form>
		
	</div>
			
	
	</body>

	
</html>
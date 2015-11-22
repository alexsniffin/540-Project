<html>

<?php

session_start();
$userID=$_SESSION['arrLogin'];
$user = $_SESSION['userProfile'];

//Answer Array that contains all answers from the question
//index 0 is the poll id (i think)
//index 1 is the answer string
//index 2 is the number of votes an answer has
$answerArray = $_SESSION['arrReturn'];
$choice = $_POST['choice'];
$pollID = $_SESSION['pollID'];
	
//Connect to database
$servername = "24.197.117.117";
$username = "darth";
$password = "ineedhelp";
$dbname = "pollApp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//winning
$winning = true;

			
switch($choice)
{
	case "choice0":
		$resAnswer = $answerArray[0];
		break;
	case "choice1":
		$resAnswer = $answerArray[1];
		break;
	case "choice2":
		$resAnswer = $answerArray[2];
		break;
	case "choice3":
		$resAnswer = $answerArray[3];
		break;
	case "choice4":
		$resAnswer = $answerArray[4];
		break;
	case "choice5":
		$resAnswer = $answerArray[5];
		break;
	case "choice6":
		$resAnswer = $answerArray[6];
		break;
	case "choice7":
		$resAnswer = $answerArray[7];
		break;
	case "choice8":
		$resAnswer = $answerArray[8];
		break;
	case "choice9":
		$resAnswer = $answerArray[9];
		break;
	case "choice10":
		$resAnswer = $answerArray[10];
		break;
	case "choice11":
		$resAnswer = $answerArray[11];
		break;
}


//Get the total amount of votes for all answers
$totalVotes = 1;
for($i = 0; $i < count($answerArray); $i++)
{
	$totalVotes += $answerArray[$i][2];
}
			
//echo $totalVotes;
			
$builtString = "CALL userVote(" . $userID . "," . $resAnswer[0] . ")";
				
$conn = new mysqli($servername, $username, $password, $dbname);
	
//Attempt to insert data into database
$insert = mysqli_query($conn, $builtString) or die("Query fail: " . mysqli_error()); 
$conn->close();

//==================================Print the question again===========================
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

//==================================Add Coins==========================================
$conn = new mysqli($servername, $username, $password, $dbname);

$coinString = "call addCoins(".$userID.",".$pollID.")";
mysqli_query($conn,$coinString) or die("Query fail: " . mysqli_error());
$conn->close();

//===================================Update User Account===============================
$conn = new mysqli($servername, $username, $password, $dbname);
$sqlQuery = "call getProfile(".$userID.");";

$getProfile = mysqli_query($conn, $sqlQuery) or die ("Query fail: " . mysqli_error());
$conn->close();

$profile = array();//mysqli_fetch_array($getProfile);
while ($row = mysqli_fetch_array($getProfile))
{
	for($i=0; $i < 5; $i++)
	{
		$profile[$i] = $row[$i];
	}
}

$_SESSION['userProfile'] = $profile;

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
			<li><a href="profile.html"><img src ="imgs/user_icon_2x.png"><?php echo $user[1]; ?></a></li>
			<li><img src ="imgs/coin_icon_2x.png"><?php echo $user[2]; ?></li>
		<ul>
	</div>
	
	<!-- Start main content -->
	<div class="main-content">
			
		<!-- Question -->
		<div class="question">
			<div class="left-arrow"></div>
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
	
		<div class="top">
			<h2>
				<?php
					echo "You answered: " . $resAnswer[1] . ".<br>Number of Shared Opinions: " . $resAnswer[2]+1;
					
					// Testing to see what the $resAnswer array is holding
						// foreach ($resAnswer as $element)
						// echo '<br> -' . $element;
				?>
			</h2>
	
			<form action="votepublic.php?cat" method="post">
				<input type="submit" class="submit-button login" value="Vote Again">
			</form>
				
			</br></br></br>	
			
			<form action="home.php" method="post">
				<input type="submit" class="submit-button login" value="Go to Home">
			</form>
		
		</div>

	</div>
	
	</body>	

</html>
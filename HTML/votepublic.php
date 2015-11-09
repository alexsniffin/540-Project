<!DOCTYPE html>

<html lang = "en">
<?php
//====================================BEGIN PHP CODE============================================//
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
	$conn->close();

	echo $randID[0];
	
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
	$answerArray = callAnswers($randID[0],$conn) or die("Query fail: " . mysqli_error());
	

	
	
	
	
	$conn->close();
	
	
	
//=============================END PHP CODE=================================//
?>
	<head>
		<title>Vote</title>
		<meta charset = "utf-8">
		<meta name = "viewport" content = "width = device-width, initial-scale = 1">
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
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
			<li><a href="profile.html"><img src ="imgs/user_icon_2x.png">pollshark567</a></li>
			<li><img src ="imgs/coin_icon_2x.png">12</li>
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
				$quest = callQuestion($randID[0], $conn);
				$conn->close();
				?>
			</div>
			<div class="right-arrow"></div>
		</div>
	
	
		<!-- Choices -->
		<div class="choices">
			<ul>
				<li>
					<div class="radio-button" id="choice_1"></div>
					<div class="choice-text">
						<?php
							echo $answerArray[0][1];
							
						?>
					</div>
				</li>
				<li>
					<div class="radio-button" id="choice_2"></div>
					<div class="choice-text">
						<?php
							echo $answerArray[1][1];
						?>
					</div>
				</li>
				<li>
					<div class="radio-button" id="choice_3"></div>
					<div class="choice-text">
						<?php
							echo $answerArray[2][1];
						?>
					</div>
				</li>
				<li>
					<div class="radio-button" id="choice_4"></div>
					<div class="choice-text">
						<?php
							echo $answerArray[3][1];
						?>
					</div>
				</li>
				<li>
					<div class="radio-button" id="choice_5"></div>
					<div class="choice-text">
						<?php
							echo $answerArray[5][1];
						?>
					</div>
				</li>
				<li>
					<div class="radio-button" id="choice_6"></div>
					<div class="choice-text">
						<?php
							echo $answerArray[6][1];
						?>
					</div>
				</li>
				<li>
					<div class="radio-button" id="choice_6"></div>
					<div class="choice-text">
						<?php
							echo $answerArray[7][1];
						?>
					</div>
				</li>
				<li>
					<div class="radio-button" id="choice_6"></div>
					<div class="choice-text">
						<?php
							echo $answerArray[8][1];
						?>
					</div>
				</li>
				<li>
					<div class="radio-button" id="choice_6"></div>
					<div class="choice-text">
						<?php
							echo $answerArray[9][1];
						?>
					</div>
				</li>
				<li>
					<div class="radio-button" id="choice_6"></div>
					<div class="choice-text">
						<?php
							echo $answerArray[10][1];
						?>
					</div>
				</li>
				<li>
					<div class="radio-button" id="choice_6"></div>
					<div class="choice-text">
						<?php
							echo $answerArray[11][1];
						?>
					</div>
				</li>
				
			</ul>	
		</div>
		
		<!-- TEMPORARY: Submit button to submit poll and take user to immediate result page -->
		<!-- Button is inactive until a choice is selected -->
		<!-- Needs to also actually submit the answer to database -->
<!-- 
		<a href="immedresults.html"><div class="submit-button temp inactive">
		<h2>Submit</h2>
		</div>
		</a>
 -->
		
	</div>
	

			
	<!-- Radio button and poll submission functionality-->			
	<script type="text/javascript">
		
		$(document).ready(function(){
			
			//declare click handler for choices
			$(document).on('click', '.choices li', function(e)
			{
				var element;
				
				if($(e.target).is('li'))
				{
					element = e.target;
				}
				else
				{
			    	element = $(e.target).parents('li');
				}
				
				//remove check from previously selected choice
				$('.choices li.selected').each(function(i, button)
				{
					$(button).removeClass('selected');
				});
				
				//add check to the one we just clicked
				$(element).addClass('selected');
				
				//turn right arrow into submit button
				$('.right-arrow').addClass('submit');
				
				//turn submit button into active submit button
				$('.submit-button.temp').removeClass('inactive');
			});
			
			//declare click handler for submit button
			$(document).on('click', '.right-arrow.submit', function()
			{
				window.location.href = 'immedresults.html';
			});
			
			//on click, load question
			$('.right-arrow').on('click', function()
			{
  				$('.question-text').text("<?php
				//Call question and print it out.
				//$conn = new mysqli($servername, $username, $password, $dbname);
				//$quest = callQuestion($randID[0] + 1, $conn);
				//$conn->close();
				?>");
				window.location.href = "votepublic.php";
			});
			
			//on left swipe, load question
			$('.question').on('swipeleft', function()
			{
  				$('.question-text').text("<?php
				//Call question and print it out.
				//$conn = new mysqli($servername, $username, $password, $dbname);
				//$quest = callQuestion($randID[0] + 1, $conn);
				//$conn->close();
				
				?>");
				window.location.href = "votepublic.php";
			});

		});
		
	</script>
	
	</body>

	
</html>
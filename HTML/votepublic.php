<!DOCTYPE html>

<html lang = "en">
<?php
//====================================BEGIN PHP CODE============================================//
	session_start();

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
	
	$_SESSION['arrReturn'] = $answerArray;
	
	
	$conn->close();
	
	
//=============================END PHP CODE=================================//
?>

	
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
					<form action="immedresults.php" method="post">
					<input type="radio" id="choice_1" name="choice" value="choice1">
					
						<?php
							echo $answerArray[0][1];
						
						
						?>		
					<input type="radio" id="choice_2" name="choice" value="choice2">
					
						<?php
							echo $answerArray[1][1];
							
						?>
					<input type="radio" id="choice_3" name="choice" value="choice3">
					
						<?php
							echo $answerArray[2][1];
							
						?>
					<input type="radio" id="choice_4" name="choice" value="choice4">
					
						<?php
							echo $answerArray[3][1];
							
						?>
					<input type="radio" id="choice_5" name="choice" value="choice5">
					
						<?php
							echo $answerArray[4][1];
							
						?>
					<input type="radio" id="choice_6" name="choice" value="choice6">
					
						<?php
							echo $answerArray[5][1];
							
						?>
					<input type="radio" id="choice_7" name="choice" value="choice7">
					
						<?php
							echo $answerArray[6][1];
							
						?>
					<input type="radio" id="choice_8" name="choice" value="choice8">
					
						<?php
							echo $answerArray[7][1];
							
						?>
					<input type="radio" id="choice_9" name="choice" value="choice9">
					
						<?php
							echo $answerArray[8][1];
							
						?>
					<input type="radio" id="choice_10" name="choice" value="choice10>
			
						<?php
							echo $answerArray[9][1];
							
						?>
					<input type="radio"id="choice_11" name="choice"  value="choice11">
					
						<?php
							echo $answerArray[10][1];
							
						?>
					<input type="radio" id="choice_12" name="choice" value="choice12">
						<?php
							echo $answerArray[11][1];
							
						?>
						
					<input type="submit">   
					</form>
				
			 
			
	
	</body>

	
</html>
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
	
	$shareKey = $_POST['sharecode'];
	//echo $shareKey;
	

	//This sequence of instructions fetches a random poll id from
	//other users every time the page is loaded
	$privSQLQuery = "CALL private_poll('". $shareKey ."');";
	$privIDTransfer = mysqli_query($conn,$privSQLQuery) or die("Query fail: " . mysqli_error());
	$privID = mysqli_fetch_array($privIDTransfer);
	$conn->close();

	//echo $privID[0];
	
	
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

	
	
		<!-- Question -->
		<div class="question">
			<div class="left-arrow"></div>
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
					<form action="immedresults.php" method="post">
					<?php 
					
					
					for($i=0;$i<count($answerArray); $i++)
					{
						echo "<input type='radio' id='choice' name='choice' value='choice".$i."'>".$answerArray[$i][1]."<br>";
					}
					
					?>
					<input type="submit">   
					</form>

	</body>

</html>
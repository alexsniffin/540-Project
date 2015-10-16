<html>
<body>

<!-- Initial inputs to test out various functions in the PHP body below -->
<!-- IMPORTANT!!! Code is unoptimized so far -->


<?php
//Connect to database
$servername = "24.197.117.117";
$username = "darth";
$password = "ineedhelp";
$dbname = "pollApp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
// this statement can be removed later
echo "Connected successfully<br><br>";

//winning
$winning = true;

$randSQLQuery = "CALL random_public_poll(3);";
$randIDTransfer = mysqli_query($conn,$randSQLQuery) or die("Query fail: " . mysqli_error());

$randID = mysqli_fetch_array($randIDTransfer);

echo $randID[0] . " random test <br><br>";
$conn->close();

function callQuestion($temp, $connection)
{
	
	$sqlLine = "CALL getPollQuestion(" . $temp . ", NULL);";

	$question = mysqli_query($connection, $sqlLine) or die("Query fail: " . mysqli_error());

	
	// print out Question answers.
	while ($row = mysqli_fetch_array($question))
	{
		echo $row[0] . " - " . $row[1] . " - " . $row[2];
	}
	echo "<br>";
	
	
}

function callAnswers($temp, $connection)
{
	
	$sqlLine = "CALL getPollAnswers(" . $temp . ");";

	$question = mysqli_query($connection, $sqlLine) or die("Query fail: " . mysqli_error());
	
	
	$incr = 0;
	
	$arrReturn = array();
	// print out Question answers.
	while ($row = mysqli_fetch_array($question))
	{
		$arrReturn[$incr] = $row[0];
		$incr++;
	}
	
	return $arrReturn;
	
}

echo "========================TEST==============================<br>";


//Call question and print it out.
$conn = new mysqli($servername, $username, $password, $dbname);
$quest = callQuestion($randID[0], $conn);
$conn->close();

//Call Answers and print them out
$conn = new mysqli($servername, $username, $password, $dbname);
$answerArray = callAnswers($randID[0], $conn);
$conn->close();

for($i = 0; $i < count($answerArray); $i++)
{
	echo $answerArray[$i]."<br>";
}

//Open connection for debugging purposes.
$conn = new mysqli($servername, $username, $password, $dbname);



echo "========================TEST==============================<br><br>";

//End connection with database
$conn->close();

echo "<br><br>";

?>

<!-- Test out the poll creation again -->

	<form action="pollVote.php" method="post">
	
	Try again?
	<input type="submit">
	</form>

</body>
</html>
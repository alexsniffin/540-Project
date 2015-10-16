<html>
<body>

<!-- Initial inputs to test out various functions in the PHP body below -->
<!-- IMPORTANT!!! Code is unoptimized so far -->


<!-- For debugging purposes. -->>
	<?php echo $_POST["quest"]; ?><br>
	<?php echo $_POST["ans1"]; ?><br>
	<?php echo $_POST["ans2"]; ?><br>
	<?php echo $_POST["ans3"]; ?><br>
	<?php echo $_POST["ans4"]; ?><br>
	<?php echo $_POST["ans5"]; ?><br>
	<?php echo $_POST["ans6"]; ?><br>


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
echo "Connected successfully";

//Variable that will hold string to send to SQL server for poll input
$sqlInsert;

//User ID initialized to 1 for debugging purposes
$userID = 1;

//Vistigial incrementer for now
$incr1 = 0;

//winning
$winning = true;

//Loads in user input in order to create SQL call function string
//Currently uses 2D Array 
function loadArray()
{
	$buff;
	
	$buff[0][0] = $_POST['quest'];
	$buff[0][1] = $_POST['ans1'];
	$buff[0][2] = $_POST['ans2'];
	$buff[0][3] = $_POST['ans3'];
	$buff[0][4] = $_POST['ans4'];
	$buff[0][5] = $_POST['ans5'];
	$buff[0][6] = $_POST['ans6'];
	
	// $GLOBALS['incr1']++;
	
	return $buff;
}

//"Why do I need this?" Incrementer
// Disregard this function for now
function ydintIncr($incr)
{
	return $incr+1;
}

// printArray -- Use this to test out arrays.
// Could be useful for printing to main vote screen.
function printArray($tempArray)
{
	for ($i = 0; $i < count($tempArray); $i++)
	{
		for ($j = 0; $j < count($tempArray[$i]); $j++)
		{
			if ($tempArray[$i][$j] == $tempArray[$i]["0"])
			{
				echo "<h2>" . "----=" .  $tempArray[$i][$j] . "=----<br>" . "</h2>" ;
			}
			else
			{
				echo $j . ". " . $tempArray[$i][$j]. "<br>";
			}
		}
		echo "<br>";
	}
}

// Takes in user input and concatenates into a string to send to SQL for insertion
function buildSQLString($tempArray, $ID)
{
	
	$builtString = "CALL create_poll(".$ID.","."'".$tempArray[0][0]."',"."NULL,"."30,";
	
	for ($i = 0; $i < count($tempArray); $i++)
	{
		for ($j = 1; $j < count($tempArray[$i]); $j++)
		{
				$builtString .= "'" . $tempArray[$i][$j] . "',";
		}
	
	$builtString .= "NULL,NULL,NULL,NULL,NULL,NULL)";
	
		
	}
	return $builtString;
}

//utilization of functions for insertion purposes

$sqlInsert = loadArray($incr1);

//build SQL string statement
$sqlInsertString = buildSQLString($sqlInsert,$userID);

//Attempt to insert data into database
$insert = mysqli_query($conn, $sqlInsertString) or die("Query fail: " . mysqli_error());
$conn->close();

echo "<br>";

?>

<!-- Test out the poll creation again -->

	<form action="createPoll.php" method="post">
	
	Try again?
	<input type="submit">
	</form>

</body>
</html>
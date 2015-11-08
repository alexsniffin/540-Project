<html>
<body>

<!-- Initial inputs to test out various functions in the PHP body below -->
<!-- IMPORTANT!!! Code is unoptimized so far -->


<!-- For debugging purposes. -->>
	<?php echo $_POST["quest"]; ?><br>
	
	<?php echo $_POST["categoryselection"]; ?><br>
	<?php echo $_POST["datepicker"]; ?><br>
	
	
	
	
	
	
	<?php echo $_POST["ans1"]; ?><br>
	<?php echo $_POST["ans2"]; ?><br>
	<?php echo $_POST["ans3"]; ?><br>
	<?php echo $_POST["ans4"]; ?><br>
	<?php echo $_POST["ans5"]; ?><br>
	<?php echo $_POST["ans6"]; ?><br>
	<?php echo $_POST["ans7"]; ?><br>
	<?php echo $_POST["ans8"]; ?><br>
	<?php echo $_POST["ans9"]; ?><br>
	<?php echo $_POST["ans10"]; ?><br>
	<?php echo $_POST["ans11"]; ?><br>
	<?php echo $_POST["ans12"]; ?><br>
	<?php echo "end debug printout"; ?><br>
	


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

$isPrivate;

if(isset($_POST["pubOpriv"]))
{
	$isPrivate = "yes";
}
else
{
	$isPrivate = "no";
}

//winning
$winning = true;

//Loads in user input in order to create SQL call function string
//Currently uses 2D Array 
function loadArray()
{
	$buff;
	$increment;
	
	$buff[0][0] = $_POST['quest'];
	
	for($i = 1; $i <= 12; $i++)
	{
		$increment = 'ans' . $i;
	
		echo $increment . '<br>';
	
		if(isset($_POST["$increment"]) && !empty($_POST["$increment"]))
		{
			$buff[0][$i] = $_POST["$increment"];
		}
		else
		{
			$buff[0][$i] = 'NULL';
		}
	
	}
	// $GLOBALS['incr1']++;
	
	return $buff;
}

//Generate a pseudo-random 8 digit share key for unique id purposes
//Needs to be optimized and strengthened, as well as adding
//a check function to see if it exists already in the database.
function buildShareKey()
{
	$shareKey = '';
	
	$alphnums = array_merge(range(0,9), range('a','z'));
	
	for($i = 0; $i < 8; $i++)
	{
		$shareKey .= $alphnums[array_rand($alphnums)];
	}
	
	return $shareKey;
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
function publicPoll($tempArray, $ID)
{
	
	$builtString = "CALL create_poll(".$ID.","."'".$tempArray[0][0]."',"."NULL,"."'NULL',"."30,";
	
	for ($i = 0; $i < count($tempArray); $i++)
	{
		for ($j = 1; $j < count($tempArray[$i]); $j++)
		{
				if($j < count($tempArray[$i]) - 1)
				{
					$builtString .= "'" . $tempArray[$i][$j] . "',";
				}
				else
				{
					$builtString .= "'" . $tempArray[$i][$j] . "');";
				}
		}
		
	}
	
	//$buildString .= "'" . $tempArray[0][12] . "');";
	
	return $builtString;
}

// Takes in user input and concatenates with a unique key into a string to send to SQL for insertion
function privatePoll($tempArray, $ID, $shareKey)
{
	
	$builtString = "CALL create_poll(".$ID.","."'".$tempArray[0][0]."','".$shareKey."',NULL," . "30,";
	
	for ($i = 0; $i < count($tempArray); $i++)
	{
		for ($j = 1; $j < count($tempArray[$i]); $j++)
		{
				if($j < count($tempArray[$i]) - 1)
				{
					$builtString .= "'" . $tempArray[$i][$j] . "',";
				}
				else
				{
					$builtString .= "'" . $tempArray[$i][$j] . "');";
				}
				
		}
		
	}
	
	//$buildString .= "'" . $tempArray[0][12] . "');";
	
	return $builtString;
}

//utilization of functions for insertion purposes

$key = buildShareKey();


$sqlInsert = loadArray();
if(isset($_POST["pubOpriv"]))
{
	//build SQL string statement
	$sqlInsertString = privatePoll($sqlInsert,$userID, $key);

	echo '<br>' . $sqlInsertString . '<br>';

	$insert = mysqli_query($conn, $sqlInsertString) or die("Query fail: " . mysqli_error());
	$conn->close();
	echo "sent to private<br>";
	echo "<br> Share Key is: " . $key;
	
	
}
else
{
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sqlInsertString = publicPoll($sqlInsert,$userID);
	
	echo '<br>' . $sqlInsertString . '<br>';
	
	//Attempt to insert data into database
	$insert = mysqli_query($conn, $sqlInsertString) or die("Query fail: " . mysqli_error());
	$conn->close();
	
	echo "sent to public<br>";
	
	
}






echo "<br>";

?>

<!-- Test out the poll creation again -->

	<form action="createPoll.php" method="post">
	
	Try again?
	<input type="submit">
	</form>

</body>
</html>
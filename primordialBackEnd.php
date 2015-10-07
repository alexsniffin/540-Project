<html>
<body>

<!-- Initial inputs to test out various functions in the PHP body below -->

	<?php echo $_POST["quest"]; ?><br>
	<?php echo $_POST["ans1"]; ?><br>
	<?php echo $_POST["ans2"]; ?><br>
	<?php echo $_POST["ans3"]; ?><br>
	<?php echo $_POST["ans4"]; ?><br>
	<?php echo $_POST["ans5"]; ?><br>
	<?php echo $_POST["ans6"]; ?><br>

<?php

// Main Buffer Array for sending polls to database
$buffInArr = array(array());

// incrementers for 2D array buffArr
$incr1 = 0;
$incr2 = 0;

// Secondary buffer in Array -- not implemented
$buffInArr2;

// incremeneters for 2d array buffArr2
$incr3 = 0;
$incr4 = 0;

// test array
$testArr=array
(
array("What band is cool?","Alice in Chains","Limp Bizkit","Lady Gaga"),
array("What are the best kind of aliens?","aliens","illegal aliens","smelly"),
array("If you were a transformer you would be...", "Optimus Prime", "Megatron","Starscream","Bundle-of-sticks-atron","Bumblebee","Megan Fox")
);



function loadArray($incr)
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

//"Why do I need this?"" Incrementer
function ydintIncr($incr)
{
	return $incr+1;
}

function createPoll()
{

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

printArray($testArr);

$buffInArr = loadArray($incr1);

printArray($buffInArr);

$incr1++;

echo $incr1;

?>

	<form action="backEndTestCase.php" method="post">
	
	Try again?
	<input type="submit">
	</form>

</body>
</html>
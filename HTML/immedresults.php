
<html>

<?php

session_start();
$userID=$_SESSION['arrLogin'];
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
			
echo "You answered: " . $resAnswer[1] . ".<br>Number of Shared Opinions: " . $resAnswer[2]; 
				
$builtString = "CALL userVote(" . $userID . "," . $resAnswer[0] . ")";
				
$conn = new mysqli($servername, $username, $password, $dbname);
	
//Attempt to insert data into database
$insert = mysqli_query($conn, $builtString) or die("Query fail: " . mysqli_error()); 
$conn->close();

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
<br><br>
<form action="votepublic.php?cat" method="post">
	
	Vote Again.
	<input type="submit">
</form>
	
<form action="home.php" method="post">
	
	Go to Home.
	<input type="submit">
</form>

	

</html>
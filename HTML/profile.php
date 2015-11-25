<!DOCTYPE html>

<html lang = "en">

<?php
session_start();

//a single int representing the User ID in the database.
//used for calling procedures.
$userID = $_SESSION['arrLogin'];

//An array containing User Profile information
//index 0 = email (string)
//index 1 = display name (string)
//index 2 = coins (int)
//index 3 = gender (string)
//index 4 = age (int)
//index 5 = creation date (timestamp) ----NOT RETURNED----
//index 6 = total votes (int)		  ----NOT RETURNED----
$user = $_SESSION['userProfile'];


 ?>
	<head>
		<title><?php echo $user[1]; ?>| Polling App</title>
		<meta charset = "utf-8">
		<meta name = "viewport" content = "width = device-width, initial-scale = 1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  		<script type="text/javascript" src="js/bootstrap.min.js"></script>

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
      	<a class="navbar-brand" href="home.php"><img src ="imgs/pollingApp_icon_2x.png"> <span>Polling App</span></a>
   		 </div>
    		<div class="collapse navbar-collapse" id="myNavbar">
     		    <ul class="nav navbar-nav">
        			<li><a href="createPoll.php">Create</a></li>
        			<li><a href="votepublic.php?cat">Vote</a></li>
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
			<li><a href="profile.php"><img src ="imgs/user_icon_2x.png"><?php echo $user[1]; ?></a></li>
			<li><img src ="imgs/coin_icon_2x.png"><?php echo $user[2]; ?></li>
		<ul>
	</div>

	<!-- Start main content -->
	<div class="main-content">

		<!-- Username and info -->
		<div class="user-header">
		<h2><?php echo $user[1]; ?></h2>
		<ul>
			<li><strong>12</strong> Votes</li>
			<li><strong>4</strong> Polls Created</li>
		</ul>
		</div>

		<!-- Red divider -->
		<div class="red-divider">
		</div>

		<!-- Poll Info -->
		<div class="info-container">
			<ul class="nav nav-pills">
				<li class="active"><a data-toggle="pill" href="#menu1">Polls</a></li>
				<li><a data-toggle="pill" href="#menu2">Votes</a></li>
				<li><a data-toggle="pill" href="#menu3">Private Polls</a></li>
			</ul>

			<div class = "tab-content">
				<div id="menu1" class="tab-pane active">

				  <table class="table table-hover">
					<thead>
					  <tr>
						<th>Title</th>
						<th>Votes</th>
						<th>Created</th>
						<th>Expiration Date</th>
						<th>Status</th>
						<th>Results</th>
					  </tr>
					</thead>
					<tbody>
            <?php
            $servername = "24.197.117.117";
            $username = "darth";
            $password = "ineedhelp";
            $dbname = "pollApp";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if($conn->connect_error)
            {
            	die("Connection failed: " . $conn->conect_error);
            }
            $getUsrPoll = "CALL getUserPolls(" . $userID . " )";
            $res = mysqli_query($conn, $getUsrPoll) or die("Query fail: " . mysqli_error()); //or die("There was an error retreiving your account information");
            $conn->close();

            $numOfPolls = 0;
            $polls = array();//mysqli_fetch_array($res);
            while ($row = mysqli_fetch_array($res))
            {
            	$polls[$numOfPolls][0] = $row[0];
              $polls[$numOfPolls][1] = $row[1];
              $polls[$numOfPolls][2] = $row[2];
              $polls[$numOfPolls][3] = $row[3];
              $polls[$numOfPolls][4] = $row[4];
              $polls[$numOfPolls][5] = $row[5];
              $numOfPolls++;
            }
            ?>
            <?php for($p = 0; $p < $numOfPolls; $p++): ?>
            <tr>
            <?php
            $servername = "24.197.117.117";
            $username = "darth";
            $password = "ineedhelp";
            $dbname = "pollApp";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            $conn1 = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if($conn->connect_error)
            {
              die("Connection failed: " . $conn->conect_error);
            }
              $pollID = (int)$polls[$p][0];
              $pollInfo = "CALL getPollQuestion(" . $pollID . ")";
              $getPollQuestion = mysqli_query($conn, $pollInfo) or die("Query fail: " . mysqli_error()); //or die("There was an error retreiving poll question");
              $conn->close();
              $pollQuestion = mysqli_fetch_array($getPollQuestion);
              $getPollAnswers = "CALL getPollAnswers(" . $pollID . ")";
              $pollAnswers = mysqli_query($conn1, $getPollAnswers);
              $conn1->close();
              $totalVotes = 0;
              while ($answers = mysqli_fetch_array($pollAnswers))
              {
                $totalVotes += $answers[2];
              }


            ?>
            <td><?php echo $pollQuestion[0]; ?></td>
            <td><?php echo $totalVotes; ?></td>
            <td><?php echo $polls[$p][4]; ?></td>
            <td><?php echo $polls[$p][5]; ?></td>
            <td>
              <?php
              $today = getdate();
              if($today > $polls[$p][5])
              {
                echo "Open";
              }
              else
              {
                echo "Closed";
              }
              ?>
            </td>
            <td><a href="immedresults.php">View</a>
            <?php endfor; ?>
            </tr>
					</tbody>
				  </table>

				</div>


				<div id="menu2" class="tab-pane">

					<table class="table table-hover">
					<thead>
					  <tr>
						<th>Title</th>
						<th>Results</th>
					  </tr>
					</thead>
					<tbody>



					  <tr>
						<td>Poll 1</td>
						<td><a href="/immedresults.html">View</a></td>
					  </tr>
					  <tr>
						<td>Poll 2</td>
						<td><a href="/immedresults.html">View</a></td>
					  </tr>
					  <tr>
						<td>Poll 3</td>
						<td><a href="/immedresults.html">View</a></td>
					  </tr>
					</tbody>
				  </table>

				</div>


				<div id="menu3" class="tab-pane">

				  <table class="table table-hover">
					<thead>
					  <tr>
						<th>Title</th>
						<th>Votes</th>
						<th>Created</th>
						<th>Expiration Date</th>
						<th>Status</th>
						<th>Results</th>
						<th>Share Code</th>
					  </tr>
					</thead>
					<tbody>
            <?php for($p = 0; $p < $numOfPolls; $p++): ?>
              <?php if(!(empty($polls[$p][3]))): ?>
                <tr>
                <?php
                  $servername = "24.197.117.117";
                  $username = "darth";
                  $password = "ineedhelp";
                  $dbname = "pollApp";

                  // Create connection
                  $conn = new mysqli($servername, $username, $password, $dbname);
                  $conn1 = new mysqli($servername, $username, $password, $dbname);

                  // Check connection
                  if($conn->connect_error)
                  {
                    die("Connection failed: " . $conn->conect_error);
                  }
                    $pollID = (int)$polls[$p][0];
                    $pollInfo = "CALL getPollQuestion(" . $pollID . ")";
                    $getPollQuestion = mysqli_query($conn, $pollInfo) or die("Query fail: " . mysqli_error()); //or die("There was an error retreiving poll question");
                    $conn->close();
                    $pollQuestion = mysqli_fetch_array($getPollQuestion);
                    $getPollAnswers = "CALL getPollAnswers(" . $pollID . ")";
                    $pollAnswers = mysqli_query($conn1, $getPollAnswers);
                    $conn1->close();
                    $totalVotes = 0;
                    while ($answers = mysqli_fetch_array($pollAnswers))
                    {
                      $totalVotes += $answers[2];
                    }


                    ?>
                    <td><?php echo $pollQuestion[0]; ?></td>
                    <td><?php echo $totalVotes; ?></td>
                    <td><?php echo $polls[$p][4]; ?></td>
                    <td><?php echo $polls[$p][5]; ?></td>
                    <td>
                    <?php
                    $today = getdate();
                    if($today > $polls[$p][5])
                    {
                      echo "Open";
                    }
                    else
                    {
                      echo "Closed";
                    }
                    ?>
                </td>
                <td><a href="immedresults.php">View</a>
                <td><?php echo $polls[$p][3];  ?></td>
                </tr>
              <?php endif; ?>
            <?php endfor; ?>
					</tbody>
				  </table>

				</div>
			</div>
		</div>


		</div>

	</div>

</body>

<?php $conn->close(); ?>
</html>

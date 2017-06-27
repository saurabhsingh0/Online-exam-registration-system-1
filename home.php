<?php
	session_start();

	//if not logged in, go to home1.php
	if(!isset($_SESSION['username'])){
    	header("location: home1.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>

<h1>Home</h1>
<div><h4>Welcome <?php echo $_SESSION['username']; ?></h4></div>



<div><a href="examdescription.php">Exam Description</a></div><br>

<div><a href="examlist.php">Exam list - Registration is now open!</a></div>
<div><a href="page1.php">Register for the test</a></div><br>

<div><a href="myaccount.php">My account</a></div>
<div><a href="personalhistory.php">My registration history</a></div><br>

<div><a href="logout.php">Logout</a></div>
</body>
</html>
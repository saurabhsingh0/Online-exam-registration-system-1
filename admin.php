<?php
	session_start();

	$admin = $_SESSION['admin'];

	if(!isset($_SESSION['username'])){
    	header("location: home1.php");
	} else if ($admin == 'NO'){
		header("location: home.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin page</title>
</head>
<body>

<h1>Admin page</h1>
<div><h4>Welcome <?php echo $_SESSION['username']; ?></h4></div>
<div><a href="adminmemberlist.php">Member list</a></div>
<br>
<div><a href="adminexam.php">Exam</a></div>
<br>
<div><a href="adminregistration.php">View all registration</a></div>
<div><a href="adminexamresult.php">View all exam results</a></div>
<br>
<div><a href="adminbranch.php">Branch</a></div>
<br>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
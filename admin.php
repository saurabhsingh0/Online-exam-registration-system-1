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
<div><a href="memberlist.php">Member list</a></div>
<div><a href="examlist.php">Exam list</a></div>
<div><a href="myaccount.php">My account</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
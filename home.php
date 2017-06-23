<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>

<h1>Home</h1>
<div><h4>Welcome <?php echo $_SESSION['username']; ?></h4></div>
<div><a href="page1.php">Register for the test</a></div>
<div><a href="personalhistory.php">My registration history</a></div>
<div><a href="examlist.php">Exam list</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
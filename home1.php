<?php
	session_start();

	//if logged in, go to home.php
	if(isset($_SESSION['username'])){
    	header("location: home.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>

<h1>Home</h1>
<div><h4>Welcome</h4></div>
<div><a href="login.php">Login</a></div>
<div><a href="signup.php">Sign up</a></div>
<div><a href="page1.php">Register for the test</a></div>
</body>
</html>
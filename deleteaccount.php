<?php
	session_start();
	//connect to database
	$db = mysqli_connect("localhost", "root", "vdxd", "examination");

	$username = $_SESSION['username'];
	
	if (isset($_POST['delete_btn'])){
		$sql = "DELETE FROM member WHERE username = '$username';";
        $result = mysqli_query($db, $sql) or die(mysqli_error($db));
            
        session_destroy();
		unset($_SESSION['username']);
		unset($_SESSION['admin']);

		header("location: home1.php");
    } else if (isset($_POST['cancel_btn'])){
		header("location: myaccount.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete my account</title>
</head>
<body>
<div class = "header">
	<h1>Delete my account</h1>
	<h4>You are about to permanently delete your account. Are you sure?</h4>
</div>

<form method="post" action="deleteaccount.php">
	<td><input type="submit" name="delete_btn" value="Yes"></td>
	<td><input type="submit" name="cancel_btn" value="Cancel"></td>
</form>
</body>
</html>



<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class = "header">
	<h1>My Account</h1>
</div>

<?php
	session_start();

	$db = mysqli_connect("localhost", "root", "vdxd", "examination");
	// Check connection 
	if (!$db) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	$username = $_SESSION['username'];
	$sql = "SELECT * FROM member WHERE username = '$username';";
	$result = mysqli_query($db, $sql);

	if (mysqli_num_rows($result) == 1) {
		echo '<table cellpadding="10">';
        echo '<th>Username</th><th>Name</th><th>Date of Birth</th><th>Phone</th><th>Email address</th>';
        $row = mysqli_fetch_assoc($result);
        $_SESSION['phone'] = $row["phone"];
        $_SESSION['email'] = $row["email"];
        echo '<tr><td align = center>'.$row["username"].'</td><td>'.$row["member_name"].'</td><td align = center>'.$row["dob"].'</td><td align = center>'.$row["phone"].'</td><td align = center>'.$row["email"].'</td><td><form method = "post" action = "myaccount.php"><input type="submit" name = "edit_btn" value = "Edit"></form></td></tr>';
        echo '</table>';
	} else {
    	echo "Unknown error";
    }

	if (isset($_POST['edit_btn'])){
		header("location: editaccount.php");
	}
	mysqli_close($db);

?>

<br>
<div><a href="deleteaccount.php">Delete my account</a></div>
<br>
<div><a href="home.php">Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
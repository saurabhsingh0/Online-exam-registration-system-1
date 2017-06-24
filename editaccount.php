<?php
	session_start();
	//connect to database
	$db = mysqli_connect("localhost", "root", "vdxd", "examination");

	$username = $_SESSION['username'];
	
	if (isset($_POST['change_btn'])){
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$password2 = mysqli_real_escape_string($db, $_POST['password2']);
		$phone = mysqli_real_escape_string($db, $_POST['phone']);
		$email = mysqli_real_escape_string($db, $_POST['email']);

		if ($password != '' && $password2 != '' && $password == $password2) {
			$password = md5($password); //hash password before storing for security purposes
			$sql = "UPDATE member SET phone = '$phone', email = '$email', password = '$password' WHERE username = '$username';";
            $result = mysqli_query($db, $sql) or die(mysqli_error($db));
            
            echo "Updated data successfully\n";
			header("location: myaccount.php");
		}
		else{
			echo "The two passwords do not match";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Change Account Settings</title>
</head>
<body>
<div class = "header">
	<h1>Change Account Settings</h1>
</div>

<form method="post" action="editaccount.php">
	<table>
		<tr>
			<td>Username:</td>
			<td><?php echo $_SESSION['username'];?></td>
		</tr>
		<tr>
			<td>New password:</td>
			<td><input type="password" name="password" class="textInput"></td>
		</tr>
		<tr>
			<td>Password again:</td>
			<td><input type="password" name="password2" class="textInput"></td>
		</tr>
		<tr>
			<td>New phone number:</td>
			<td><input type="text" name="phone" value = <?php echo $_SESSION['phone']?> class="textInput"></td>
		</tr>
		<tr>
			<td>New email address:</td>
			<td><input type="email" name="email" value = <?php echo $_SESSION['email']?> class="textInput"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="change_btn" value="Change"></td>
		</tr>

	</table>
</form>
</body>
</html>
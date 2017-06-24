<?php
	session_start();

	//connect to database
	$db = mysqli_connect("localhost","root","vdxd","examination");

	if (isset($_POST['login_btn'])){
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		$password = md5($password);
		$sql = "SELECT * FROM member WHERE username = '$username' AND password = '$password'";
		$result = mysqli_query($db, $sql);

		if (mysqli_num_rows($result) == 1){
			$_SESSION['message'] = "You are now logged in";
			$result = mysqli_fetch_assoc($result);
			$username = $result["username"];
			$admin = $result["admin"];

			$_SESSION['admin'] = $admin;
			$_SESSION['username'] = $username;
			if ($admin == 'NO'){
				header("location: home.php");
			} else {
				header("location: admin.php");
			}
		}else{
			$_SESSION['message'] = "Username/password combination incorrect";
		}
		echo $_SESSION['message'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
<div class = "header">
	<h1>Login</h1>
</div>

<form method = "post" action = "login.php">
	<table>
		<tr>
			<td>Username:</td>
			<td><input type = "text" name = "username" class = "textInput"></td>
		</tr>
		<tr>
			<td>User password:</td>
			<td><input type = "password" name = "password" class = "textInput"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name = "login_btn" value = "Login"></td>
		</tr>
	</table>
</form>
</body>
</html>
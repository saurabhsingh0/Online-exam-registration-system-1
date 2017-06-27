<?php
	session_start();
	//connect to database
	$db = mysqli_connect("localhost", "root", "vdxd", "examination");
	//$test = mysqli_query($db, "SELECT * FROM member");
	//while ($row = $test->fetch_assoc()) {
    //	echo "username: ".$row['username']."<br>";
	//}

	if (isset($_POST['register_btn'])){
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$member_name = mysqli_real_escape_string($db, $_POST['member_name']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$password2 = mysqli_real_escape_string($db, $_POST['password2']);
		$dob = mysqli_real_escape_string($db, $_POST['dob']);
		$phone = mysqli_real_escape_string($db, $_POST['phone']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$admin = mysqli_real_escape_string($db, $_POST['admin']);

	if ($password != '' && $password2 != '' && $password == $password2) {
		//create user
		$password = md5($password); //hash password before storing for security purposes
		if(!$admin){
			$admin = 'NO';
		}
		$sql = "INSERT INTO member(username, member_name, dob, phone, email, password, admin) VALUES('".$username."','".$member_name."','".$dob."','".$phone."','".$email."','".$password."','".$admin."');";
		$result = mysqli_query($db, $sql);

		$_SESSION['message']="You are now logged in";
		$_SESSION['admin'] = $admin;
		$_SESSION['username']=$username;
		
		if ($admin == 'NO'){
			header("location: home.php");
		} else {
			header("location: admin.php");
		}
	}
	else{
		$_SESSION['message']="The two passwords do not match";
	}
	echo $_SESSION['message'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
</head>
<body>
<div class = "header">
	<h1>Sign up</h1>
</div>

<form method="post" action="signup.php">
	<table>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="username" class="textInput"></td>
		</tr>
		<tr>
			<td>User password:</td>
			<td><input type="password" name="password" class="textInput"></td>
		</tr>
		<tr>
			<td>Password again:</td>
			<td><input type="password" name="password2" class="textInput"></td>
		</tr>
		<tr>
			<td>Name:</td>
			<td><input type="text" name="member_name" class="textInput"></td>
		</tr>
		<tr>
			<td>Date of birth:</td>
			<td><input type="text" name="dob" class="textInput"></td>
		</tr>
		<tr>
			<td>Phone number:</td>
			<td><input type="text" name="phone" class="textInput"></td>
		</tr>
		<tr>
			<td>Email address:</td>
			<td><input type="email" name="email" class="textInput"></td>
		</tr>
		<tr>
			<td>Admin:</td>
			<td><input type="radio" name="admin" value = NO> No<br>
  				<input type="radio" name="admin" value = YES> Yes<br></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="register_btn" value="Register"></td>
		</tr>

	</table>
</form>
</body>
</html>
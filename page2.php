<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class = "header">
	<h1>Successfully registered for the test!</h1>
</div>

<form method="post" action="page1.php">
	<table>
		<tr>
			<td>username:</td>
			<td><?php echo $_SESSION['username'];?>
  			</td>
		</tr>
		<tr>
			<td>subject:</td>
			<td><?php echo $_SESSION['subject'];?>
  			</td>
		</tr>
		<tr>
			<td>exam date:</td>
			<td><?php echo $_SESSION['examdate'];?>
  			</td>
		</tr>
		<tr>
			<td>location:</td>
			<td><?php echo $_SESSION['examareaname'];?>
  			</td>
		</tr>
		<tr>
			<td>text service:</td>
			<td><?php echo $_SESSION['textservice'];?>
  			</td>
		</tr>
	</table>
</form>
<br><br>
<div><a href="home.php">Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
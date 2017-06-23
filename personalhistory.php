<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class = "header">
	<h1>My Registration History</h1>
</div>

<?php
	session_start();

	$db = mysqli_connect("localhost", "root", "vdxd", "examination");
	// Check connection 
	if (!$db) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	/*if(isset($_SESSION['username'])){
    	$username = $_SESSION['username'];
    }else {
    	echo 'noo';
	}*/

	$username = $_SESSION['username'];
	$sql = "SELECT * FROM testregister NATURAL JOIN subject WHERE username = '$username' ORDER BY examyear, examperiod;";
	$result = mysqli_query($db, $sql);
	//$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
		echo '<table>';
		echo '<th>registration #</th><th>subject</th><th>year</th><th>period</th>';
    	while($row = mysqli_fetch_assoc($result)) {
    		echo '<tr><td align = center>'.$row["registrationnum"].'</td><td>'.$row["subjectname"].'</td><td align = center>'.$row["examyear"].'</td><td align = center>'.$row["examperiod"].'</td></tr>';
    	}
    	echo '</table>';
	} else {
    	echo "No result";
	}
	mysqli_close($db);
?>

<br><br>
<div><a href="home.php">Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
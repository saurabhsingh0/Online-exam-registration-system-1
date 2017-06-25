<!DOCTYPE html>
<html>
<head>
	<title>Admin branch</title>
</head>
<body>

<h1>Admin branch</h1>

<?php
	session_start();

	$admin = $_SESSION['admin'];

	if(!isset($_SESSION['username'])){
    	header("location: home1.php");
	} else if ($admin == 'NO'){
		header("location: home.php");
	}

	$db = mysqli_connect("localhost", "root", "vdxd", "examination");
    // Check connection 
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

	$sql1 = "SELECT * FROM branch;";
    $result1 = mysqli_query($db, $sql1) or die(mysqli_error($db));
    if (mysqli_num_rows($result1) > 0) {
    	while($row1 = mysqli_fetch_assoc($result1)) {
	        echo '<table cellpadding="10" width = "300">';
    	    echo '<tr><th colspan = "3">'.$row1["branchname"].'('.$row1["branchcode"].', '.$row1["representative"].')</th></tr>';
    	    $branchname = $row1["branchname"];
		    $sql2 = "SELECT * FROM branch NATURAL JOIN examarea WHERE branchname = '$branchname';";
   		 	$result2 = mysqli_query($db, $sql2) or die(mysqli_error($db));
   			if (mysqli_num_rows($result2) > 0) {
        		while($row2 = mysqli_fetch_assoc($result2)) {
           			echo '<tr><td align = center>'.$row2["examareaid"].'</td><td>'.$row2["examareaname"].'</td><td align = center>'.$row2["capacity"].'</td></tr>';
	 		    }
       			echo '</table><br>';
       		}
    	}
	} else {
        echo "0 results";
    }
?>


<br>
<div><a href="admin.php">Admin Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
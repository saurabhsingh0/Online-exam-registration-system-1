<!DOCTYPE html>
<html>
<head>
    <title>Admin Exam Period</title>
</head>
<body>
<div class = "header">
    <h1>Admin Exam Period</h1>
    <h4>Ignore the year.</h4>
</div>

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
	
	$sql = "SELECT * FROM examperiodlist;";
    $result = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        echo '<table cellpadding="10">';
        echo '<th>Exam Period</th><th>Registration<br>Start date(w)</th><th>Registration<br>End date(w)</th><th>Exam date(w)</th><th>result(w)</th><th>Registration<br>Start date(p)</th><th>Registration<br>End date(p)</th><th>Exam date(p)</th><th>Final Result</th>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr><td align = center>'.$row["examperiod"].'</td><td>'.$row["wregstart"].'</td><td align = center>'.$row["wregend"].'</td><td align = center>'.$row["writtentest"].'</td><td align = center>'.$row["wresult"].'</td><td align = center>'.$row["pregstart"].'</td><td align = center>'.$row["pregend"].'</td><td align = center>'.$row["performancetest"].'</td><td align = center>'.$row["finalresult"].'</td></tr>';
        }
        echo '</table>';
    } else {
        echo "0 results";
    }

	echo '<br><form method = "post" action = "adminexamperiodadd.php"><input type="submit" name = "add_btn" value = "Add"></form>   <form method = "post" action = "adminexamperioddelete.php"><input type="submit" name = "delete_btn" value = "Delete"></form>';
 
	if (isset($_POST['add_btn'])){
		header("location: adminexamperiodadd.php");
	} else if (isset($_POST['delete_btn'])){
		header("location: adminexamperioddelete.php");
	}
    mysqli_close($db);
?>
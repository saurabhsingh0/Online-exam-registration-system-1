<?php
	session_start();
	//connect to database
	$db = mysqli_connect("localhost", "root", "vdxd", "examination");
	
	if (isset($_POST['testregister_btn'])){
		$username = mysqli_real_escape_string($db, $_SESSION['username']);
		$subject = mysqli_real_escape_string($db, $_POST['subject']);
		$examtype = mysqli_real_escape_string($db, $_POST['examtype']);
		$examperiod = mysqli_real_escape_string($db, $_POST['examperiod']);
		$examarea = mysqli_real_escape_string($db, $_POST['examarea']);
		$textservice = mysqli_real_escape_string($db, $_POST['textservice']);

		$examareaname = explode(' ',$examarea);
		$examareaname = $examareaname[2].' '.$examareaname[3];
		
		$result = mysqli_query($db, "SELECT examareaid FROM examarea WHERE examareaname = '$examareaname'");
		if (!$result) {
    		echo 'Could not run query: ' . mysql_error();
    		exit;
		}
		$examareaid = mysqli_fetch_row($result);

		$result = mysqli_query($db, "SELECT subjectid FROM subject WHERE subjectname = '$subject'");
		if (!$result) {
    		echo 'Could not run query: ' . mysql_error();
    		exit;
		}
		$subjectid = mysqli_fetch_row($result);

		$sql = "INSERT INTO testregister(username,date,subjectid,examyear,examperiod,examtype,examareaid,textservice) VALUES('".$username."',curdate(),'".$subjectid[0]."', YEAR(curdate()),'".$examperiod."','".$examtype."','".$examareaid[0]."','".$textservice."');";
		$result = mysqli_query($db, $sql);

		if($examtype == 'written'){
			$sql = "SELECT DATE_FORMAT((SELECT writtentest FROM examperiodlist WHERE examperiod = '$examperiod'), '%M %D');";
			$result = mysqli_query($db, $sql);
			$examdate = mysqli_fetch_row($result);
			$_SESSION['examdate'] = $examdate[0].', '.date("Y");
		}else{
			$sql = "SELECT DATE_FORMAT((SELECT performancetest FROM examperiodlist WHERE examperiod = '$examperiod'), '%M %D');";
			$result = mysqli_query($db, $sql);
			$examdate = mysqli_fetch_row($result);
			$_SESSION['examdate'] = $examdate[0].', '.date("Y");
		}

		$_SESSION['subject'] = $subject;
		$_SESSION['examareaname'] = $examareaname;
		$_SESSION['textservice'] = $textservice;
		header("location: page2.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register for the test</title>
</head>
<body>
<div class = "header">
	<h1>Register for the test</h1>
	<table style="width:20%">
		<tr><th>exam period</th><th>written</th><th>performance</th></tr>
		<tr><td align = center>A</td><td align = center>Jan 14</td><td align = center>Mar 31</td></tr>
		<tr><td align = center>B</td><td align = center>Mar 25</td><td align = center>May 20</td></tr>
		<tr><td align = center>C</td><td align = center>Jun 10</td><td align = center>Sep 09</td></tr>
	</table>
	<br>
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
			<td><select name = "subject">
				<option>Electric Railway</option>
				<option>Electricity</option>
				<option>Information Processing</option>
				<option>Office Automation</option>
				<option>Metal</option>	
				<option>Rolling</option></td>
		</tr>
		<tr>
			<td>exam period:</td>
			<td><select name = "examperiod">
				<option>A</option>
				<option>B</option>
				<option>C</option></td>
		</tr>
		<tr>
			<td>exam type:</td>
			<td><select name = "examtype">
				<option>written</option>
				<option>performance</option></td>
		</tr>
		<tr>
			<td>area:</td>
			<td><select name = "examarea">
				<option>Seoul - Sehwa HS</option>
				<option>Seoul - Ewha HS</option>
				<option>Anyang - Gwiin MS</option>	
				<option>Anyang - Sinki MS</option>	
				<option>Daegu - Kyungdong ES</option>
				<option>Daegu - Sungdong ES</option>
				<option>Busan - Haeundae MS</option></td>
		</tr>
		<tr>
			<td>text service:</td>
			<td><input type="radio" name="textservice" value = Yes> Yes<br>
  				<input type="radio" name="textservice" value = No> No<br></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="testregister_btn" value="Register"></td>
		</tr>

	</table>
</form>

<br><br>
<div><a href="home.php">Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
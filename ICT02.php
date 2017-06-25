<!DOCTYPE html>
<html>
<head>
    <title>Exam description - Office Automation</title>
</head>
<body>
<div class = "header">
    <h1>Exam description - Office Automation</h1>
</div>
<style>
table, th, td {
    border: 1px solid black;
}
</style>

<?php
    session_start();

    $db = mysqli_connect("localhost", "root", "vdxd", "examination");
    // Check connection 
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM subject NATURAL JOIN exam WHERE subjectid = 'ICT02' AND examtype = 'written';";
    $result = mysqli_query($db, $sql) or die(mysqli_error($db));
    $sql = "SELECT * FROM subject NATURAL JOIN exam WHERE subjectid = 'ICT02' AND examtype = 'performance';";
    $result1 = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        echo '<table width = "700" cellpadding="10" >';
        echo '<th>Subject ID</th><th>Subject name</th><th>Subject area</th><th>Written<br>Test Fee</th><th>Performance<br>Test Fee</th>';
        $row = mysqli_fetch_assoc($result);
        $row1 = mysqli_fetch_assoc($result1);
        echo '<tr><td align = center>'.$row["subjectid"].'</td><td align = center>'.$row["subjectname"].'</td><td align = center>'.$row["subjectarea"].'</td><td align = center>'.$row["registrationfee"].'</td><td align = center>'.$row1["registrationfee"].'</td></tr>
        <th colspan="5">Description</th>
        <tr><td colspan="5">'.$row["description"].'</td></tr>';
        echo '</table>';
    } else {
        echo "0 results";
    }

    mysqli_close($db);
?>

<br><br>
<div><a href="examdescription.php">Back</a></div>
<div><a href="home.php">Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
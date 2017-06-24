<!DOCTYPE html>
<html>
<head>
    <title>Exam description - Information Processing</title>
</head>
<body>
<div class = "header">
    <h1>Exam description - Information Processing</h1>
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

    $sql = "SELECT * FROM subject WHERE subjectid = 'ICT01';";
    $result = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        echo '<table width="400" cellpadding="10">';
        echo '<th>Subject ID</th><th>Subject name</th><th>Subject area</th>';
        $row = mysqli_fetch_assoc($result);
        echo '<tr><td align = center>'.$row["subjectid"].'</td><td align = center>'.$row["subjectname"].'</td><td align = center>'.$row["subjectarea"].'</td></tr>
        <th colspan="3">Description</th>
        <tr><td colspan="3">'.$row["description"].'</td></tr>';
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
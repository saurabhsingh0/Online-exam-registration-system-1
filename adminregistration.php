<!DOCTYPE html>
<html>
<head>
    <title>Exam Registration</title>
</head>
<body>
<div class = "header">
    <h1>Exam Registration</h1>
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

    //$username = $_SESSION['username'];
    $sql = "SELECT * FROM testregister;";
    $result = mysqli_query($db, $sql);
    //$result = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        echo '<table cellpadding="10">';
        echo '<th>Registration #</th><th>username</th><th>Registration date</th><th>Subject</th><th>Exam year</th><th>Exam period</th><th>Exam type</th><th>Area</th><th>Text service</th>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr><td align = center>'.$row["registrationnum"].'</td><td>'.$row["username"].'</td><td align = center>'.$row["date"].'</td><td align = center>'.$row["subjectid"].'</td><td align = center>'.$row["examyear"].'</td><td align = center>'.$row["examperiod"].'</td><td align = center>'.$row["examtype"].'</td><td align = center>'.$row["examareaid"].'</td><td align = center>'.$row["textservice"].'</td></tr>';
        }
        echo '</table>';
    } else {
        echo "0 results";
    }
    mysqli_close($db);
?>

<br><br>
<div><a href="admin.php">Admin Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
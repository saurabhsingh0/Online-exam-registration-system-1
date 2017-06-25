<!DOCTYPE html>
<html>
<head>
    <title>Exam Results</title>
</head>
<body>
<div class = "header">
    <h1>Exam Results</h1>
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
    $sql = "SELECT * FROM examresult NATURAL JOIN testregister;";
    $result = mysqli_query($db, $sql);
    //$result = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        echo '<table cellpadding="10">';
        echo '<th>Registration #</th><th>username</th><th>Subject ID</th><th>Year</th><th>Exam period</th><th>Exam type</th><th>Exam date</th><th>score</th><th>Pass/Fail</th>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr><td align = center>'.$row["registrationnum"].'</td><td align = center>'.$row["username"].'</td><td>'.$row["subjectid"].'</td><td align = center>'.$row["examyear"].'</td><td align = center>'.$row["examperiod"].'</td><td align = center>'.$row["examtype"].'</td><td align = center>'.$row["examdate"].'</td><td align = center>'.$row["score"].'</td><td align = center>'.$row["passorfail"].'</td></tr>';
        }
        echo '</table>';
    } else {
        echo "0 results";
    }

    echo '<br><form method = "post" action = "adminexamresultadd.php"><input type="submit" name = "addresult_btn" value = "Update result"></form>';
 
    if (isset($_POST['addresult_btn'])){
        header("location: adminexamresultadd.php");
    };

    mysqli_close($db);
?>

<br><br>
<div><a href="admin.php">Admin Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
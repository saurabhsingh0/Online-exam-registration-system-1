<!DOCTYPE html>
<html>
<head>
    <title>Exam description</title>
</head>
<body>
<div class = "header">
    <h1>Exam description</h1>
</div>

<?php
    session_start();

    $db = mysqli_connect("localhost", "root", "", "examination");
    // Check connection 
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM subject;";
    $result = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        echo '<table cellpadding="10">';
        echo '<th>Subject ID</th><th>Subject name</th><th>Subject area</th>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr><td align = center>'.$row["subjectid"].'</td><td><a href="'.$row["subjectid"].'.php">'.$row["subjectname"].'</a></td><td align = center>'.$row["subjectarea"].'</td></tr>';
        }
        echo '</table>';
    } else {
        echo "0 results";
    }




    mysqli_close($db);
?>

<br><br>
<div><a href="home.php">Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
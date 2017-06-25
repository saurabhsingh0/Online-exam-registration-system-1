<!DOCTYPE html>
<html>
<head>
    <title>Admin Exam List</title>
</head>
<body>
<div class = "header">
    <h1>Admin Exam List</h1>
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
        die("Connection failed: ".mysqli_connect_error());
    }
    
    $sql = "SELECT DISTINCT subjectid, examyear, examperiod from examlist;";
    $result = mysqli_query($db, $sql) or die(mysqli_error($db));

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        echo '<table cellpadding="10">
        <th>Subject ID</th><th>Exam Year</th><th>Period</th>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr><td align = center>'.$row["subjectid"].'</td><td align = center>'.$row["examyear"].'</td><td align = center>'.$row["examperiod"].'</td></tr>';
        }
        echo '</table>';
    }

    echo '<br><form method = "post" action = "adminexamadd.php"><input type="submit" name = "add_btn" value = "Add"></form>   <form method = "post" action = "adminexamdelete.php"><input type="submit" name = "delete_btn" value = "Delete"></form>';
 
    if (isset($_POST['add_btn'])){
        header("location: adminexamadd.php");
    } else if (isset($_POST['delete_btn'])){
        header("location: adminexamdelete.php");
    }
    mysqli_close($db);
?>
<br>
<div><a href="admin.php">Admin Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
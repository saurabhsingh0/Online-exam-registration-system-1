<!DOCTYPE html>
<html>
<head>
    <title>Admin Exam description</title>
</head>
<body>
<div class = "header">
    <h1>Admin Exam description</h1>
</div>
<style>
table, th, td {
    border: 1px solid black;
}
</style>

<br>

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

    $sql = "SELECT * FROM subject NATURAL JOIN exam WHERE examtype = 'written';";
    $result = mysqli_query($db, $sql) or die(mysqli_error($db));
    $sql = "SELECT * FROM subject NATURAL JOIN exam WHERE examtype = 'performance';";
    $result1 = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $row1 = mysqli_fetch_assoc($result1);
                echo '<table width = "700" cellpadding="10" >';
                echo '<th>Subject ID</th><th>Subject name</th><th>Subject area</th><th>Written<br>Test Fee</th><th>Performance<br>Test Fee</th>';
                echo '<tr><td align = center>'.$row["subjectid"].'</td><td align = center>'.$row["subjectname"].'</td><td align = center>'.$row["subjectarea"].'</td><td align = center>'.$row["registrationfee"].'</td><td align = center>'.$row1["registrationfee"].'</td></tr>
                <th colspan="5">Description</th>
                <tr><td colspan="5">'.$row["description"].'</td></tr>';
                echo '</table><br><br>';
        }
    } else {
        echo "0 results";
    }

    if (isset($_POST['edit_btn'])){
        header("location: adminexamdescedit.php");
    }else if (isset($_POST['add_btn'])){
        header("location: adminexamdescadd.php");
    }if (isset($_POST['delete_btn'])){
        header("location: adminexamdescdelete.php");
    }
    
    echo '</table><form method = "post" action = "adminexamdesc.php"><td><input type="submit" name = "edit_btn" value = "Edit"></td><td>   <input type="submit" name = "add_btn" value = "Add"></td><td>   <input type="submit" name = "delete_btn" value = "Delete"></td></form>';

    

    mysqli_close($db);
?>

<br><br>
<div><a href="adminexam.php">Back to Admin Exam</a></div>
<div><a href="admin.php">Admin Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
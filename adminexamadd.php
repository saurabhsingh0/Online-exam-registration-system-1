<!DOCTYPE html>
<html>
<head>
    <title>Admin Exam Add</title>
</head>
<body>
<div class = "header">
    <h1>Admin Exam Add</h1>
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

    if (isset($_POST['add1_btn'])){
        $subjectid = mysqli_real_escape_string($db, $_POST['subjectid']);
        $examyear = mysqli_real_escape_string($db, $_POST['examyear']);
        $examperiod = mysqli_real_escape_string($db, $_POST['examperiod']);

        $sql1 = "INSERT INTO examlist VALUES('".$subjectid."','".$examyear."','".$examperiod."','written'),('".$subjectid."','".$examyear."','".$examperiod."','performance');";
        $result = mysqli_query($db, $sql1) or die(mysqli_error($db));
        header("location: adminexamadd.php");
        //mysqli_close($db);
    } else if(isset($_POST['cancel1_btn'])){
        header("location: adminexamlist.php");
    }
?>

<br><br>
<form method="post" action="adminexamadd.php">
<table><tr>
    <td>Subject ID : </td><td><input type="text" name="subjectid" class="textInput"></td></tr>
    <tr><td>Exam year : </td><td><input type="text" name="examyear" class="textInput"></td></tr>
    <tr><td>Exam period : </td>
    <td><select name = "examperiod">
            <?php
                $epresult = mysqli_query($db, "SELECT examperiod FROM examperiodlist") or die(mysqli_error($db));
                while($epresultrow = mysqli_fetch_assoc($epresult)){
                    echo '<option>'.$epresultrow["examperiod"].'</option>';
                }
            ?></td></tr>
<tr>
    <td><input type="submit" name = "add1_btn" value = "Add Exam">   <input type="submit" name = "cancel1_btn" value = "Back to Exam List"></td>
</tr></table>
</form>

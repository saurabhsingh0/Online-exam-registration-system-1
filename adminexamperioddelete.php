<!DOCTYPE html>
<html>
<head>
    <title>Admin Exam Period Delete</title>
</head>
<body>
<div class = "header">
    <h1>Admin Exam Period Delete</h1>
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
    }

    if (isset($_POST['delete1_btn'])){
        $examperiod = mysqli_real_escape_string($db, $_POST['examperiod']);

        $sql1 = "DELETE FROM examperiodlist WHERE examperiod = '$examperiod';";
        $result = mysqli_query($db, $sql1) or die(mysqli_error($db));
            
        header("location: adminexamperiod.php");
        //mysqli_close($db);
    } else if(isset($_POST['cancel1_btn'])){
        header("location: adminexamperiod.php");
    }
?>


<form method="post" action="adminexamperioddelete.php">
<table><tr>
    <td>Insert exam period to delete : <input type="text" name="examperiod" class="textInput"></td>
    <td><input type="submit" name = "delete1_btn" value = "Delete">   <input type="submit" name = "cancel1_btn" value = "Cancel"></td>
</tr></table>
</form>

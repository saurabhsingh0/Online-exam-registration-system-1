<!DOCTYPE html>
<html>
<head>
    <title>Admin Exam Result Add</title>
</head>
<body>
<div class = "header">
    <h1>Admin Exam Result Add</h1>
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

    if (isset($_POST['addresult1_btn'])){
        $registrationnum = mysqli_real_escape_string($db, $_POST['registrationnum']);
        $score = mysqli_real_escape_string($db, $_POST['score']);
        $passorfail = mysqli_real_escape_string($db, $_POST['passorfail']);

        $sql1 = "UPDATE examresult SET score = '$score', passorfail = '$passorfail' WHERE registrationnum = '$registrationnum';";
        $result = mysqli_query($db, $sql1) or die(mysqli_error($db));
            
        header("location: adminexamresult.php");
        //mysqli_close($db);
    } else if(isset($_POST['cancel2_btn'])){
        header("location: adminexamresult.php");
    }
?>

<br>
<form method="post" action="adminexamresultadd.php">
<table>
    <tr><td>Registration # : </td><td><input type="text" name="registrationnum" class="textInput"></td></tr>
    <tr><td>score : </td><td><input type="text" name="score" class="textInput"></td></tr>
    <tr><td>Pass or Fail : </td><td><input type="text" name="passorfail" class="textInput"></td></tr>
</table>
<table>
<tr>
    <td><input type="submit" name = "addresult1_btn" value = "Update">   <input type="submit" name = "cancel2_btn" value = "Cancel"></td>
</tr></table>
</form>

<br><br>
<div><a href="admin.php">Admin Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
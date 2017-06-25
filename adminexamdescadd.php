<!DOCTYPE html>
<html>
<head>
    <title>Admin Add Exam description</title>
</head>
<body>
<div class = "header">
    <h1>Admin Add Exam description</h1>
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

    mysqli_autocommit($db, false);
    $flag = true;

    if (isset($_POST['add_btn'])){
        $subjectid = mysqli_real_escape_string($db, $_POST['subjectid']);
        $subjectname = mysqli_real_escape_string($db, $_POST['subjectname']);
        $subjectarea = mysqli_real_escape_string($db, $_POST['subjectarea']);
        $wtfee = mysqli_real_escape_string($db, $_POST['wtfee']);
        $ptfee = mysqli_real_escape_string($db, $_POST['ptfee']);
        $description = mysqli_real_escape_string($db, $_POST['description']);

        $sql1 = "INSERT INTO subject VALUES('".$subjectid."','".$subjectname."','".$subjectarea."','".$description."');";
        $sql2 = "INSERT INTO exam VALUES('".$subjectid."','written','".$wtfee."');";
        $sql3 = "INSERT INTO exam VALUES('".$subjectid."','performance','".$ptfee."');";
        $result = mysqli_query($db, $sql1);
        if(!$result){
            $flag = false;
            echo "Error details : ".mysqli_error($db).".";
        }
        $result = mysqli_query($db, $sql2);
        if(!$result){
            $flag = false;
            echo "Error details : ".mysqli_error($db).".";
        }
        $result = mysqli_query($db, $sql3);
        if(!$result){
            $flag = false;
            echo "Error details : ".mysqli_error($db).".";
        }

        if($flag){
            mysqli_commit($db);
            echo "Saved successfully.";
        } else{
            mysqli_rollback($db);
            echo "All queries were rolled back";
        }
    }

    mysqli_close($db);
?>

<form method="post" action="adminexamdescadd.php">
    <table>
        <tr>
            <td>Subject ID:</td>
            <td><input type="text" name="subjectid" class="textInput"></td>
        </tr>
        <tr>
            <td>Subject Name:</td>
            <td><input type="text" name="subjectname" class="textInput"></td>
        </tr>
        <tr>
            <td>Subject Area:</td>
            <td><input type="text" name="subjectarea" class="textInput"></td>
        </tr>
        <tr>
            <td>Written test fee:</td>
            <td><input type="text" name="wtfee" class="textInput"></td>
        </tr>
        <tr>
            <td>Performance test fee:</td>
            <td><input type="text" name="ptfee" class="textInput"></td>
        </tr>
        <tr>
            <td>Description:</td><td><textarea name="description" rows="4" cols="30"></textarea></td></tr>
        <tr>
            <td></td>
            <td><input type="submit" name="add_btn" value="Add"></td>
        </tr>

    </table>
</form>
<br><br>
<div><a href="adminexam.php">Back to Admin Exam</a></div>
<div><a href="admin.php">Admin Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Exam description Delete</title>
</head>
<body>
<div class = "header">
    <h1>Admin Exam description Delete</h1>
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

    mysqli_autocommit($db, false);
    $flag = true;

    if (isset($_POST['delete_btn'])){
        $subjectid = mysqli_real_escape_string($db, $_POST['subjectid']);

        $sql1 = "DELETE FROM subject WHERE subjectid = '$subjectid';";
        $sql2 = "DELETE FROM exam WHERE subjectid = '$subjectid';";

        $result = mysqli_query($db, $sql1) or die(mysqli_error($db));
        if(!$result){
            $flag = false;
            echo "Error details : ".mysqli_error($db).".";
        }
        $result = mysqli_query($db, $sql2) or die(mysqli_error($db));
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

        echo "Updated successfully\n";
        header("location: adminexamdesc.php");
    }

?>

<br>
<form method="post" action="adminexamdescdelete.php">
    <table>
        <tr>
            <td>Subject ID:</td>
            <td><input type="text" name="subjectid" class="textInput"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="delete_btn" value="Delete"></td>
        </tr>

    </table>
</form>
<br>



<br>
<div><a href="adminexam.php">Back to Admin Exam</a></div>
<div><a href="admin.php">Admin Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
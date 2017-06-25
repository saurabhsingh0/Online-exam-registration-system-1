<!DOCTYPE html>
<html>
<head>
    <title>Member List</title>
</head>
<body>
<div class = "header">
    <h1>Member List</h1>
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

    $sql = "SELECT * FROM member;";
    $result = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        echo '<table cellpadding="10">';
        echo '<th>Username</th><th>Name</th><th>Date of Birth</th><th>Phone</th><th>Email address</th><th>Admin</th>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr><td align = center>'.$row["username"].'</td><td>'.$row["member_name"].'</td><td align = center>'.$row["dob"].'</td><td align = center>'.$row["phone"].'</td><td align = center>'.$row["email"].'</td><td align = center>'.$row["admin"].'</td></tr>';
        }
        echo '</table><br><form method = "post" action = "adminmemberlist.php"><input type="submit" name = "edit_btn" value = "Edit">   <input type="submit" name = "delete_btn" value = "Delete"></form>';
    } else {
        echo "0 results";
    }

    if (isset($_POST['edit_btn'])){
        header("location: adminmemberlistedit.php");
    } else if(isset($_POST['delete_btn'])){
        header("location: adminmemberlistdelete.php");
    } 

    mysqli_close($db);
?>

<br><br>
<div><a href="admin.php">Admin Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
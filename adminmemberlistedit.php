<!DOCTYPE html>
<html>
<head>
    <title>Admin Edit Member</title>
</head>
<body>
<div class = "header">
    <h1>Admin Edit Member</h1>
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
        echo '</table>';
    } else {
        echo "0 results";
    }

    if (isset($_POST['change_btn'])){
        $usernametoedit = mysqli_real_escape_string($db, $_POST['usernametoedit']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $email = mysqli_real_escape_string($db, $_POST['email']);

        $sql = "UPDATE member SET phone = '$phone', email = '$email' WHERE username = '$usernametoedit';";
        $result = mysqli_query($db, $sql) or die(mysqli_error($db));
            
        echo "Updated successfully\n";
        header("location: adminmemberlist.php");
    }

?>

<br>
<form method="post" action="adminmemberlistedit.php">
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="usernametoedit" class="textInput"></td>
        </tr>
        <tr>
            <td>New phone number:</td>
            <td><input type="text" name="phone" class="textInput"></td>
        </tr>
        <tr>
            <td>New email address:</td>
            <td><input type="email" name="email" class="textInput"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="change_btn" value="Change"></td>
        </tr>

    </table>
</form>
<br>
<div><a href="admin.php">Admin Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
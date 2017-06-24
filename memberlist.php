<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<div class = "header">
    <h1>Member List</h1>
</div>

<?php
    session_start();

    $db = mysqli_connect("localhost", "root", "vdxd", "examination");
    // Check connection 
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    /*if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }else {
        echo 'noo';
    }*/

    //$username = $_SESSION['username'];
    $sql = "SELECT * FROM member;";
    $result = mysqli_query($db, $sql);
    //$result = mysqli_query($db, $sql) or die(mysqli_error($db));
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
    mysqli_close($db);
?>

<br><br>
<div><a href="home.php">Home</a></div>
<div><a href="logout.php">Logout</a></div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<div class = "header">
    <h1>Exam List</h1>
</div>
<div>
    <?php echo "Today is " . date("Y-m-d") . "<br>"?>
</div>
<div><a href="page1.php">Register Now!</a></div>

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
    $sql = "SELECT * FROM examlist NATURAL JOIN examperiodlist NATURAL JOIN subject ORDER BY examyear,examperiod,examtype,subjectid;";
    $result = mysqli_query($db, $sql);
    //$result = mysqli_query($db, $sql) or die(mysqli_error($db));
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        echo '<table cellpadding="10">';
        echo '<th>Subject ID</th><th>Subject</th><th>Year</th><th>Period</th><th>Type</th><th>Registration fee</th><th>Registration<br>Start date</th><th>Registration<br>End date</th><th>Exam date</th>';
        while($row = mysqli_fetch_assoc($result)) {
            if($row["examtype"] == 'written'){
            echo '<tr><td align = center>'.$row["subjectid"].'</td><td>'.$row["subjectname"].'</td><td align = center>'.$row["examyear"].'</td><td align = center>'.$row["examperiod"].'</td><td align = center>'.$row["examtype"].'</td><td align = center>'.$row["registrationfee"].'</td><td align = center>'.$row["examyear"].'-'.date('m',strtotime($row["wregstart"])).'-'.date('d',strtotime($row["wregstart"])).'</td><td align = center>'.$row["examyear"].'-'.date('m',strtotime($row["wregend"])).'-'.date('d',strtotime($row["wregend"])).'</td><td align = center>'.$row["examyear"].'-'.date('m',strtotime($row["writtentest"])).'-'.date('d',strtotime($row["writtentest"])).'</td></tr>';}
            else{echo '<tr><td align = center>'.$row["subjectid"].'</td><td>'.$row["subjectname"].'</td><td align = center>'.$row["examyear"].'</td><td align = center>'.$row["examperiod"].'</td><td align = center>'.$row["examtype"].'</td><td align = center>'.$row["registrationfee"].'</td><td align = center>'.$row["examyear"].'-'.date('m',strtotime($row["pregstart"])).'-'.date('d',strtotime($row["pregstart"])).'</td><td align = center>'.$row["examyear"].'-'.date('m',strtotime($row["pregend"])).'-'.date('d',strtotime($row["pregend"])).'</td><td align = center>'.$row["examyear"].'-'.date('m',strtotime($row["performancetest"])).'-'.date('d',strtotime($row["performancetest"])).'</td></tr>';}
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
<?php
 include '../../partials/_dbconnect.php';
 $username = $_GET['username'];
 $sql1 = "DELETE FROM users WHERE username='$username' and role='0';";
 $res1 = mysqli_query($conn,$sql1);

 $sql2 = "SELECT * FROM booking WHERE username='$username'";
 $res2 = mysqli_query($conn,$sql2);
 while($row=mysqli_fetch_assoc($res2))
 {
    $tickets = $row['no_of_tickets'];
    $train_id = $row['train_id'];
    $date = $row['departure_date'];
    $date1 = strtotime($date);
    $day = date("D",$date1);
    $sql3 = "UPDATE seats SET no_of_seats=no_of_seats+$tickets WHERE train_id='$train_id' AND day='$day';";
    $sql4 = "DELETE FROM booking WHERE train_id='$train_id' AND departure_date='$date';";
    $res3 = mysqli_query($conn,$sql3);
    $res4 = mysqli_query($conn,$sql4);
 }
        
 header("location: ../manage_users.php");
?>
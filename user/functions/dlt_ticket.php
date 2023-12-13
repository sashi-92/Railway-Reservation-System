<?php
    include '../../partials/_dbconnect.php';
    $ticket_id = $_GET['ticket_id'];
    $train_id = $_GET['train_id'];
    $date = $_GET['date'];
    $no_of_tickets = (int)$_GET['no_of_tickets'];
    
    $sql1 = "DELETE FROM booking WHERE ticket_id='$ticket_id';";
    $res1 = mysqli_query($conn,$sql1);
    
    $sql3 = "UPDATE `seats` SET ticket_booked=ticket_booked-$no_of_tickets WHERE `train_id`='$train_id' AND `date`='$date';";
    $res3 = mysqli_query($conn,$sql3);
    $sql4 = "DELETE FROM seats WHERE ticket_booked=0";
    $res4 = mysqli_query($conn,$sql4);

    header("location: ../show_booking.php");
?>
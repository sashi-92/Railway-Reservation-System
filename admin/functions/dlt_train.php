<?php
 include '../../partials/_dbconnect.php';
 $train_id = $_GET['train_id'];
 $train_name = $_GET['train_name'];
 $sql1 = "DELETE FROM `seats` WHERE train_id='$train_id'";
 $sql2 = "DELETE FROM `train` WHERE train_id='$train_id' and train_name='$train_name';";
 $sql3 = "DELETE FROM `booking` WHERE train_id='$train_id'";
 $res = mysqli_query($conn,$sql1);
 $res = mysqli_query($conn,$sql2);
 $res = mysqli_query($conn,$sql3);
 header("location: ../delete_train.php");
?>
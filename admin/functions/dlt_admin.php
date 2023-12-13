<?php
 include '../../partials/_dbconnect.php';
 $username = $_GET['username'];
 $sql = "DELETE FROM users WHERE username='$username' and role='1';";
 $result = mysqli_query($conn,$sql);
 header("location:../delete_admin.php");
?>
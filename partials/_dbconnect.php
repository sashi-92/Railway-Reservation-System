<?php
    // Connecting to database

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "railway";

    $conn = mysqli_connect($server,$username,$password,$database);
    if(!$conn)
    {
        die("Error".mysqli_connect_error());
    }
?>
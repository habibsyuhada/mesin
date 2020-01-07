<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "silateks";
    $conn = mysqli_connect($host, $username, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to Database Server: " . mysqli_connect_error();
        exit();
    }
?>
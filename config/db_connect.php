<?php
    // Connnection to the Local Host DB
    // Super Secret File
    $servername = "localhost";
    $username = "aslota";
    $password = "jetadmin";
    $db = "blog";

    // Database Connection Code
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); // in case of error
    }else{
        echo "Database Connected successfully"; // in case of success
    }
?>
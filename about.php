<?php
    /* Austin Reaper
    *  Programmer
    *  March 2021
    *  Goose Corp.
    */

    ob_start();
    session_start();
    require 'config/db_connect.php';
    require 'config/pdo_connect.php'; 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php require 'shared/header.php' ?>
<body>
    <p>Git hub projects</p>
    <p>Other impressive projects</p>
    <p>Maybe something about wood working</p>
</body>
</html>
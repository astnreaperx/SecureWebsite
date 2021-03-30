<?php 
    /* Austin Reaper
    *  Programmer
    *  March 2021
    *  Goose Corp.
    */
    
session_start();
session_destroy();

echo "Session Username is ".$_SESSION['username'];

header("location:index.php");
?>


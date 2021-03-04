<?php 
session_start();
session_destroy();

echo "Session Username is ".$_SESSION['username'];

header("location:index.php");
?>


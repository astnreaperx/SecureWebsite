<?php
require 'config/db_connect.php';
require 'config/pdo_connect.php'; 

if(isset($_POST['ptitle']))
{

}

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
    <form action="" method="post">
        <label for="ptitle">Post Title:</label><br>
        <input type="text" id="ptitle" name="ptitle"><br>

        <label for="pcontent">Post Content:</label><br>
        <textarea id="pcontent" name="pcontent" rows="10" ></textarea><br>

    </form>
</body>
</html>
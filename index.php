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
    
    require 'vendor/autoload.php';
    use PhpRbac\Rbac;
    $rbac = new Rbac();

    $data = $db->prepare("SELECT * FROM posts ORDER BY created_at DESC");
	$data->execute();
	$posts = $data->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php require 'shared/header.php'; ?>
<body>
    <div>
        <?php foreach($posts as $post): ?>
            <h1><?= $post['title'] ?></h1>
            <p><?= $post['content'] ?></p>
        <?php endforeach; ?>
    </div>
</body>
</html>

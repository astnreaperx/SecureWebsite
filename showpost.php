<?php    
require 'config/db_connect.php';
require 'config/pdo_connect.php';

$post_id = $_GET['id'];

$query = "SELECT * FROM posts WHERE id=:id";

$posts = $db->prepare($query);
$posts->bindValue(':id',$post_id);
$posts->execute();
$post = $posts->fetch();

echo $post['title'];

if($posts->rowCount() == 0)
{
    echo("error");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.css">
    <script src="css/bootstrap.bundle.js"></script>
    <title>Document</title>
</head>
<div class="container">
<?php require 'shared/header.php'; ?>

    <body>

        <h1><?= $post['title'] ?></h1>
        <p><?= $post['content']?></p>

    </body>

</div>
</html>
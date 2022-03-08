<?php    

require 'config/pdo_connect.php';

$post_id = $_GET['id'];

$query = "SELECT * FROM posts WHERE id=:id";

$posts = $db->prepare($query);
$posts->bindValue(':id',$post_id);
$posts->execute();
$post = $posts->fetch();

if($posts->rowCount() == 0)
{
    echo("error");
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require 'shared/head.php'; ?>
<div class="container">
<?php require 'shared/header.php'; ?>

    <body>
        <a href="index.php">Back</a>

        <h1><?= $post['title'] ?></h1>
        <p><?= $post['content']?></p>

    </body>

</div>
</html>
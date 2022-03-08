<?php
    /* Austin Reaper
    *  Programmer
    *  March 2021
    *  Goose Corp.
    */
    
	ob_start();
	session_start();
    
    require 'config/pdo_connect.php';
    require __DIR__.'/vendor/autoload.php';
    #require_once 'PhpRbac/autoload.php'; 

    // //Error HEAR
    // use PhpRbac\Rbac;
    // $rbac = new Rbac();

    $data = $db->prepare("SELECT * FROM posts"); //ORDER BY created_at ASC
	$data->execute();
	$posts = $data->fetchAll();
?>

<!DOCTYPE html>

<?php require 'shared/head.php'; ?>

<div class="container">
<?php require 'shared/header.php'; ?>
    <body>
        <div class="row">
            <div class="col-md-9">
                <?php foreach($posts as $post): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="showpost.php?id=<?= $post['id'];?>" ><?= $post['title'];?> </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-3">
                <h2>Testing like an article thing</h2>
                <p>que, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at</p>
            </div>
        </div>
    </body>
<?php require 'shared/footer.php'; ?>
<link href="images/favicon.ico" rel="icon" type="image/x-icon" />
</div>
</html>

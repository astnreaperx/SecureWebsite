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
?>

<!DOCTYPE html>

<?php require 'shared/head.php'; ?>

<div class="container">
<?php require 'shared/header.php'; ?>
    <body>
       
    </body>
<?php require 'shared/footer.php'; ?>
<link href="images/favicon.ico" rel="icon" type="image/x-icon" />
</div>
</html>

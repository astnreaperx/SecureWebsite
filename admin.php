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
    $role_id = $rbac->Roles->returnId('admin');

    $g_page = 'admin';

    $form = <<<EOD
    <form action="scripts/check_admin_post.php" method="post">
    <label for="ptitle">Post Title:</label><br>
    <input type="text" id="ptitle" name="ptitle"><br>
    <label for="pPoster">Post Author:</label><br>
    <input type="text" id="pPoster" name="pPoster"><br>
    <label for="pcontent">Post Content:</label><br>
    <textarea id="pcontent" name="pcontent" rows="10" ></textarea><br>
    <input type="submit" value="Post">
    </form>
    EOD;

    
    // Verify User
    if ($rbac->Users->hasRole($role_id, $_SESSION['userid']))
    {
        $var_testoutput = $form;
    }
    else {
        $var_testoutput ="<h2>You should not be here!</h2>";
    }	


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
    <?php echo($var_testoutput) ?>
</body>
</html>
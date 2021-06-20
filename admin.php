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
    require_once 'vendor/autoload.php';
    use PhpRbac\Rbac;
    $rbac = new Rbac();
    // Admin page was not loading, the fix was to get the proper role
    $role_id = $rbac->Roles->returnId('aslota');

    $g_page = 'admin';

    $form = <<<EOD
    <form action="scripts/check_admin_post.php" method="post">
    <label for="ptitle">Post Title:</label><br>
    <input type="text" id="ptitle" name="ptitle"><br>
    <label for="author">Post Author:</label><br>
    <input type="text" id="author" name="author"><br>
    <label for="pcontent">Post Content:</label><br>
    <textarea id="pcontent" name="pcontent" rows="10" ></textarea><br>
    <input type="submit" value="Post">
    </form>
    EOD;

    echo("Test");
    // Verify User
    if ($rbac->Users->hasRole($role_id, $_SESSION['userid']) ){
        $var_testoutput = $form;
        echo("Your Admin");
        
    }
    else {
        echo("Not Admin");
        $var_testoutput = "<h2>You should not be here!</h2>";
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
    <?php echo $var_testoutput; ?>
</body>
</html>